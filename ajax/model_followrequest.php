<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();
$modelid = $_GET['modelid'];
$notification_type = $_GET['notification_type'];
if(isset($_SESSION['log_user_id']) && isset($modelid) && !empty($modelid)) {

$post_data = array();
$user_id = $_SESSION['log_user_id'];
$post_data['sender_id'] = $user_id;
$post_data['receiver_id'] = $modelid;
$post_data['notification_type'] = $notification_type;
$post_data['notification_date'] = date('Y-m-d H:i:s');
$post_data['notification_status'] = 'Pending';

DB::insert('all_notifications', $post_data);
$created_id = DB::insertId();

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
