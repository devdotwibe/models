<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
  $output = array();
  
  
  $limit = 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;
$html = '';
$sqls = "SELECT * FROM all_notifications WHERE receiver_id = ".$_SESSION['log_user_id']."  Order by notification_id DESC LIMIT $limit OFFSET $offset";
$resultd = mysqli_query($con, $sqls);

                if (mysqli_num_rows($resultd) > 0) { 
				
				while($rowesdw = mysqli_fetch_assoc($resultd)) {
					
					$get_modal = DB::query('select name,username,profile_pic,unique_id from model_user where id='.$rowesdw['sender_id']);
					if(!empty($get_modal)){
						$profilepic = $get_modal[0]['profile_pic'];
						if(!empty($get_modal[0]['username'])){
							 $modalname = $get_modal[0]['username'];
						 }else{
							 $modalname = $get_modal[0]['name'];
						 }
						 $unique_id = $get_modal[0]['unique_id'];
					}else{
						$profilepic = 'assets/images/model-gal-no-img.jpg';
						$modalname = '';
						$unique_id = '';
					}
					 
				$html .= '<div class="notification-card ultra-glass p-6 rounded-2xl border border-white/10 all '.$rowesdw['notification_type'] .' ">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="'.SITEURL . 'ajax/noimage.php?image=' . $profilepic.'?w=60&h=60&fit=crop&crop=faces" alt="'.ucfirst($modalname).'." class="w-12 h-12 rounded-full object-cover border-2 border-purple-500">
                        <div class="absolute top-4 left-4 status-unread w-3 h-3 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold premium-text">'.ucfirst($rowesdw['notification_type']).' Request</h3>
                            <span class="text-sm text-white/50">15 minutes ago</span>
                        </div>
                        <p class="text-white/80 mb-4">';
						 if($rowesdw['notification_type'] == 'follow'){ 
                            $html .= '<strong class="text-indigo-400">'.$modalname.'.</strong> wants to follow you and get updates about your content and availability.';
                         }else if($rowesdw['notification_type'] == 'requests'){ 
							$html .= '<strong class="text-indigo-400">'.$modalname.'.</strong> has requested a <strong class="text-pink-400">Chat & Watch</strong> session for tonight at 8 PM.
                            <span class="text-green-400 font-semibold">$150</span> for 1 hour.';
						 }else if($rowesdw['notification_type'] == 'tips'){ 
							$html .= '<strong class="text-indigo-400">'.$modalname.'.</strong> sent you a tip of <strong class="text-green-400">$50</strong> with the message:
                            <em class="text-white/60">"Amazing show last night! You are incredible! 🔥"</em>';
						 }else if($rowesdw['notification_type'] == 'system'){ 
							$html .= '<div class="flex items-center justify-between mb-2">
								<h3 class="text-lg font-semibold premium-text">🎉 Congratulations!</h3>
								<span class="text-sm text-white/50">1 hour ago</span>
							</div>
							<p class="text-white/80 mb-4">
								Your request has been approved! You are now a <strong class="text-green-400">verified live model</strong>.
								Start building your fanbase to earn more. Upload your videos/images now to attract more clients.
							</p>';
						}else{ 
						$html .= '<strong class="text-indigo-400">'.$modalname.'.</strong>	';
						 } 
						$html .= '</p>';
						if(!empty($unique_id)){
                        $html .= '<div class="flex space-x-3">
                            <button class="btn-success px-6 py-2 rounded-lg text-white font-semibold" onclick="acceptFollow()">
                                ✓ Accept
                            </button>
                            <button class="btn-danger px-6 py-2 rounded-lg text-white font-semibold" onclick="declineFollow()">
                                ✗ Decline
                            </button>
                            <button class="btn-secondary px-6 py-2 rounded-lg text-white font-semibold" onclick="viewProfile("'.$unique_id.'")">
                                View Profile
                            </button>
                        </div>';
						}
                    </div>
                </div>
            </div>';
    }
}
if($total <= $offset) $output['loadmore'] = 'no';
else $output['loadmore'] = 'yes';
$output['html'] = $html;
echo json_encode($output);
?>
