<?php session_start(); ?>
<?php include('includes/config.php'); ?>
<?php
	
	$model_id = $_POST['model_id'];
	$user_id = $_POST['user_id'];
	$status = 'Follow';
	
	$sql = "INSERT INTO `model_follow`(`unique_model_id`, `unique_user_id`, `status`) VALUES ('".$model_id."','".$user_id."','".$status."')";
	
	if (mysqli_query($con, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($con);
?>