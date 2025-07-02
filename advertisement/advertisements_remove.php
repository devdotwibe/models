<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();
$id = $_GET['id'];
if(isset($_SESSION['log_user_id'])){
	if(!empty($id)){
		$sql_delete = "DELETE FROM banners WHERE id = ".$id;
		if(mysqli_query($con,$sql_delete)){
			$output['msg'] = 'success';
		}else $output['msg'] = 'Not deleted.';
	}else $output['msg'] = 'No advertisement id found.';
	
}else{
	$output['msg'] = 'Not logged.';
}
echo json_encode($output);