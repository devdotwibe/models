<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
  $output = array();
  
  
  $limit = 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;
$html = '';
$sqls = "SELECT * FROM all_notifications WHERE receiver_id = ".$_SESSION['log_user_id']." OR sender_id = ".$_SESSION['log_user_id']."  Order by notification_id DESC LIMIT $limit OFFSET $offset";

		
$resultd = mysqli_query($con, $sqls);

                if (mysqli_num_rows($resultd) > 0) { 
				
				while($rowesdw = mysqli_fetch_assoc($resultd)) {
					
					// $get_modal = DB::query('select id,name,username,profile_pic,unique_id from model_user where id IN ('.$rowesdw['sender_id'].', '.$rowesdw['receiver_id'].')');


					// if(!empty($get_modal)){  
					// 	foreach($get_modal as $md){
					// 		if($md['id'] == $rowesdw['sender_id']){
					// 			$profilepic = $md['profile_pic'];
					// 			if(!empty($md['username'])){
					// 				 $modalname = $md['username'];
					// 			 }else{
					// 				 $modalname = $md['name'];
					// 			 }
					// 			 $unique_id = $md['unique_id'];
					// 			 $modal_senderid = $md['id'];
					// 		}else if($md['id'] == $rowesdw['receiver_id']){
					// 			 $unique_rec_id = $md['unique_id'];
					// 			 $modal_senderid = $md['id'];
					// 		}
					// 	}
						
					// }else{
					// 	$profilepic = 'assets/images/model-gal-no-img.jpg';
					// 	$modalname = '';
					// 	$unique_id = ''; $modalid = '';
					// }

					$modalname = '';

                    $unique_id = '';

                     $modalid = '';

                    $sender_email = '';

                    $follow_title = '';

                    $follow_content = '';

                    $sender_user = false;

                    if($rowesdw['sender_id'] == $log_user_id)
                    {
                         $notify_user = DB::queryFirstRow("SELECT id,name,username,profile_pic,unique_id,email FROM model_user WHERE id =  %s ", $rowesdw['receiver_id']);

                        $profilepic = $notify_user['profile_pic'];

                       	if(!empty($notify_user['username'])){
                            $modalname = $notify_user['username'];
                        }else{
                            $modalname = $notify_user['name'];
                        }

                        $unique_id =  $notify_user['unique_id'];

                        $modalid =  $notify_user['id'];

                        $sender_email =  $notify_user['email'];

                        $follow_title = 'Follow Request Sent';

                        $sender_user = true;

                        $follow_content = 'You have requested to follow  <strong class="text-indigo-400"> '.$modalname.' </strong>. Wait until they accept or decline your request.';

                    }


                    if($rowesdw['receiver_id'] == $log_user_id)
                    {
                         $notify_user = DB::queryFirstRow("SELECT id,name,username,profile_pic,unique_id,email FROM model_user WHERE id =  %s ", $rowesdw['sender_id']);

                        $profilepic = $notify_user['profile_pic'];

                       	if(!empty($notify_user['username'])){
                            $modalname = $notify_user['username'];
                        }else{
                            $modalname = $notify_user['name'];
                        }

                        $unique_id =  $notify_user['unique_id'];

                        $modalid =  $notify_user['id'];

                        $sender_email =  $notify_user['email'];

                        $follow_title = 'Follow Request';


                        $follow_content = ' <strong class="text-indigo-400"> '.$modalname.'</strong> wants to follow you and get updates about your content and availability.';

                        if(empty($profilepic))
                        {
                               $profilepic = 'assets/images/model-gal-no-img.jpg';
                        }

                    }


					 
				$html .= '<div class="notification-card ultra-glass p-6 rounded-2xl border border-white/10 all '.$rowesdw['notification_type'] .' ">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="'.SITEURL . 'ajax/noimage.php?image=' . $profilepic.'?w=60&h=60&fit=crop&crop=faces" alt="'.ucfirst($modalname).'." class="w-12 h-12 rounded-full object-cover border-2 border-purple-500">
                        <div class="absolute top-4 left-4 status-unread w-3 h-3 rounded-full"></div>
                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between mb-2">


                            <h3 class="text-lg font-semibold premium-text">'. ucfirst($follow_title);'.</h3>';



                        $date1 = new DateTime($rowesdw['notification_date']);
							$now = new DateTime(); 
							$diff = $now->diff($date1);
							$notf_diff = '';
							if($diff->format('%R%a') != 0){
								$notf_diff = $diff->format('%R%a days');
							}else if($diff->format('%H') != 0){
								$notf_diff = $diff->format('%H hours');
							}else{
								$notf_diff = $diff->format('%I minutes');
							}
							if(!empty($notf_diff)){
								$html .= '<span class="text-sm text-white/50">'.$notf_diff.' ago</span>';
							}
                        $html .= '</div>

                        <p class="text-white/80 mb-4">';

						 if($rowesdw['notification_type'] == 'follow'){ 

                            $html .= $follow_content;


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
							$get_modal_notif = DB::query('select status,follow_date from model_follow where unique_model_id = "'.$unique_rec_id.'" AND unique_user_id = "'.$unique_id.'"');
							$followstatus = ''; $followdate = '';
							if(!empty($get_modal_notif)){
								$followstatus = $get_modal_notif[0]['status'];
								$followdate = $get_modal_notif[0]['follow_date'];
							}


                        $html .= '<div class="flex space-x-3">';


							if($sender_user) {

								$html .=  '<button id="dec_'.$unique_id.'" class="btn-danger px-6 py-2 rounded-lg text-white font-semibold" ';

										if($followstatus == 'Follow') $html .= ' disabled ';

										$html .= ' onclick="CancelFollow(\''.$unique_id.'\',\''.$modalname.'\')">';

										$html .= '✗ Cancel Request ';

										$html .= '</button>';


							}
							if(!$sender_user) {

								$html .= '<button id="acc_'.$unique_id.'"  class="btn-success px-6 py-2 rounded-lg text-white font-semibold"';

								if($followstatus == 'Follow') $html .= ' disabled ';

								$html .=' onclick="acceptFollow(\''.$unique_id.'\',\''.$unique_rec_id.'\',\''.$modalname.'\')">';

								if($followstatus == 'Follow'){ $html .= 'Accepted on '.date('d/m/Y',strtotime($followdate)); 


								}else{ $html .= '✓ Accept'; }	

								$html .='</button>


								<button id="dec_'.$unique_id.'" class="btn-danger px-6 py-2 rounded-lg text-white font-semibold" ';
								if($followstatus == 'Unfollow') $html .= ' disabled ';
								$html .= ' onclick="declineFollow(\''.$unique_id.'\',\''.$unique_rec_id.'\',\''.$modalname.'\')">';
								if($followstatus == 'Unfollow'){ $html .= 'Declined on '.date('d/m/Y',strtotime($followdate)); 
								}else{ $html .= '✗ Decline'; }
								$html .= '</button>';

							 }

							
								$html .=
								'<button class="btn-secondary px-6 py-2 rounded-lg text-white font-semibold" onclick="viewProfile(\''.$unique_id.'\')">
									View Profile
								</button>

                        </div>';
						}
                    $html .= '</div>
                </div>
            </div>';
    }
}
if($total <= $offset) $output['loadmore'] = 'no';
else $output['loadmore'] = 'yes';
$output['html'] = $html;
echo json_encode($output);
?>
