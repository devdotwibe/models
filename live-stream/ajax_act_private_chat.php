<?php session_start();
include('../includes/config.php');
include('../includes/helper.php');
$ChatLink  = SITEURL . 'live-chat/';
$output = array('status' => 'error', 'message' => 'there is some problem');
//printR($_SESSION);

if ($_SESSION["log_user"]) {
    $userDetails = get_data('model_user', array('id' => $_SESSION['log_user_id']), true);
    if (!$userDetails) {
        $output['message'] = 'Please login first!!';
        echo json_encode($output);
        die;
    }
} else {
    $output['message'] = 'Please login first!!';
    echo json_encode($output);
    die;
}
if($_GET['id']&&$_GET['type']){
    $id = $_GET['id'];
    $type = $_GET['type'];
    
    $string = "select tb.*,ms.username,ms.profile_pic,ms.id as userid 
    from tlm_private_live_chat_url tb 
    join model_user ms on ms.id= tb.user_id 
    where is_used=0 and tb.status=0 and model_id='" . $_SESSION["log_user_unique_id"] . "' and tb.id=".$id;
    $checPrivate = DB::queryFirstRow($string);
    if ($checPrivate) {
        $output = array('status' => 'ok', 'message' => '');
        if($type=='accept'){
            $output['message'] = 'accept';
		    DB::update('tlm_private_live_chat_url', array('status'=>'1','start_video_time'=>date('Y-m-d H:i:s')), "id=%s", $id); 
        }
        else{
            $output['message'] = 'delete';
            DB::delete('tlm_private_live_chat_url', 'id=%s', $id);
        }
    }
}
echo json_encode($output);

die();
