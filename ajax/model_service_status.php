<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();
$bookingId = $_GET['bookingId'];
$status = $_GET['status'];
if(isset($_SESSION['log_user_id']) && isset($bookingId) && !empty($bookingId)) {
		$post_data = array();
		$post_data['status'] = $status;
		$post_data['changed_date'] = date('Y-m-d H:i:s');
		DB::update('model_booking', $post_data, "id=%s", $bookingId);
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
