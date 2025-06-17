<?php session_start(); ?>
<?php include('includes/config.php'); ?>
<?php
	
	$model_id = $_POST['model_id'];
	$user_id = $_POST['user_id'];
	$status = 'Unfollow';
	
	$sql = "UPDATE `model_follow` SET `status` = 'Unfollow' WHERE `unique_model_id` = '".$model_id."' AND `unique_user_id` = '".$user_id."';";
	
	if (mysqli_query($con, $sql)) {
		echo json_encode(array("statusCode"=>2000));
	} 
	else {
		echo json_encode(array("statusCode"=>2001));
	}
	mysqli_close($conn);
?>