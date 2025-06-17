<?php  session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array(
    'status' => 'error',
    'message' => 'There is some problem',
);
if($_SESSION["log_user_id"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
        if($_GET['model_id']&&$_GET['id']) {
            $emoji = get_data('emoji',array('id'=>$_GET['id']),true);
            $model_data = get_data('model_user',array('unique_id'=>$_GET['model_id']),true);
            if($emoji){
                if($emoji['price']<=$userDetails['balance']){
                    $output = array(
                        'status' => 'ok',
                        'message' => '',
                    );
                    $model_id = $_GET['model_id'];
                    $date = date("d-m-Y");
                    $time = date("H:i");
                    if(file_exists($model_id.'.txt')){
                    }else{
                        $myfile = fopen($model_id.'.txt', "w"); 
                    }
                    $message = '<img src="'.SITEURL.'assets/emoji/'.$emoji['image'].'" class="chat-message-img" />';
                    $name = isset($_SESSION['log_user'])?$_SESSION['log_user']:'unknown';
                    $res = fwrite(fopen($model_id.'.txt', 'a'), "<li class='str_chat_li'><div class='str_chat_message'><div class='str_chat_mess_left'><div class='str_chat_avtar'><img src='../uploads/profile_pic/icons-user.jpg' class='img-fluid'></div></div><div class='str_chat_mess_right'><div class='str_chat_list_con'><div class='str_live_chat_author'><strong>$name</strong><span class='tlm_msg_date_time'>$time | $date</span></div><div class='str_content'><p>$message</p></div></div></div></div></li>\n");
                    if($res){
                        $dates =date('Y-m-d H:i:s');

                        DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $emoji['price'], $userDetails['id']);
                        DB::insert('model_user_transaction_history', array(
                            'user_id'=>$userDetails['id'],
                            'other_id'=>$model_data?$model_data['id']:0,
                            'amount'=>$emoji['price'],
                            'type'=>'emoji-used',
                            'created_at'  => $dates,
                        ));
                    }
                }
            }
            
        }

    }
    else{
        $output['message'] = 'login First';
    }
}
else{
    $output['message'] = 'login First';
}


echo json_encode($output);

