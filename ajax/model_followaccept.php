<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();
$sender = $_GET['sender'];
$reciever = $_GET['reciever'];
if(isset($_SESSION['log_user_id']) && isset($sender) && !empty($sender)) {

$post_data = array();
$user_id = $_SESSION['log_user_id'];
$get_modal_notif = DB::query('select * from model_follow where unique_model_id = "'.$reciever.'" AND unique_user_id = "'.$sender.'"');
	if(empty($get_modal_notif)){
		$post_data['unique_model_id'] = $reciever;
		$post_data['unique_user_id'] = $sender;
		$post_data['status'] = 'Follow';
		$post_data['follow_date'] = date('Y-m-d H:i:s');

		DB::insert('model_follow', $post_data);
		$created_id = DB::insertId();				
	}else{
		$id = $get_modal_notif[0]['id'];
		$post_data = array();
		$post_data['status'] = 'Follow';
		$post_data['follow_date'] = date('Y-m-d H:i:s');
		DB::update('model_follow', $post_data, "id=%s", $id);
	}
$output['status']= 'success';	
}else{
	if(!isset($_SESSION['log_user_id'])){
		$output['status']= 'You are not logged.';
	}else{
		$output['status']= 'Invalid modal ID';
	}

}
echo json_encode($output);
?>
