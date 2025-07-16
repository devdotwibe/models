<?php 
session_start(); 

include('../../includes/config.php');
include('../../includes/helper.php');

$output = array('status'=>'error','message'=>'There is some problem');

if(isset($_SESSION['log_user_id'])){

	$usern = $_SESSION["log_user"];

	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

	if($userDetails){
	
		$post =  array_from_get(array('user_id','message','type','user_time'));

        if($post['type'] =='send'){

            if($post['user_id']&&$post['message']){

                $date = date('Y-m-d H:i:s');
                $post_data = $post;
                $post_data['created_date'] = $date;
                $post_data['sender_id'] = $userDetails['id'];
                DB::insert('model_user_message', $post_data);
                $joe_id = DB::insertId();
            
                $display_date =  date('h:i A', strtotime($date));

                $type ="replies";
                if($userDetails['gender']=='Male'){
                    $defaultImage =SITEURL."/assets/images/profile.png";
                }
                if(!empty($userDetails['profile_pic'])){
                    $defaultImage = SITEURL.$userDetails['profile_pic'];
                }

                $output['status']= 'ok';

                $result = '<div class="message user">
                                <div class="message-avatar">
                                    <div class="avatar-placeholder user-avatar-placeholder">
                                        <img src="' . $defaultImage . '">
                                    </div>
                                </div>
                                <div class="message-content">
                                    <div class="message-text">' . htmlspecialchars($post['message']) . '</div>
                                    <div class="timestamp">' . $display_date . ' ✓✓</div>
                                </div>
                            </div>';


                $output['message']= $result;
                
            }
        }


         if($post['type'] =='recievie'){

            if($post['user_id']){

                $user_time = $post['user_time'];

                $date = date('Y-m-d H:i:s');

                $string = "SELECT tb.id, tb.user_id, tb.sender_id, tb.message, tb.created_date 
                   FROM model_user_message tb 
                   WHERE ((user_id = " . $userDetails['id'] . " AND sender_id = " . $post['user_id'] . "))
                           
                     AND created_date > '" . $user_time . "'
                   ORDER BY id ASC";

                $all_message_data = DB::query($string);  
            
                $user_data = get_data('model_user',array('id'=>$post['user_id']),true);

                $defaultImage = SITEURL . "/assets/images/profile.png";
                if (!empty($user_data['profile_pic'])) {
                    $defaultImage = SITEURL . $user_data['profile_pic'];
                }

                $output['status'] = 'ok';

                $result = '';

                $user_time ="";

                foreach ($all_message_data as $messageRow) {

                    $user_time = $messageRow['created_date'];

                    $display_date = date('h:i A', strtotime($messageRow['created_date']));

                    $result .= '<div class="message">
                                    <div class="message-avatar">
                                        <div class="avatar-placeholder">
                                            <img src="' . $defaultImage . '">
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <div class="message-text">' . htmlspecialchars($messageRow['message']) . '</div>
                                        <div class="timestamp">' . $display_date . ' ✓</div>
                                    </div>
                                </div>';
                     }

                $output['message']= $result;

                $output['user_time'] = $user_time;
                
            }
        }


	}
	
}
echo json_encode($output);


?>
