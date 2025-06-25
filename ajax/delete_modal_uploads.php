<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$table_name = "countries";
$output = array();
$upl_name = $_GET['upl_name'];
$unique_id = $_GET['unique_id'];

if(!empty($upl_name) && !empty($unique_id)){
	$sql_delete = "DELETE FROM `model_images` WHERE `model_images`.`unique_model_id` = '".$unique_id."' AND `model_images`.`file` = '".$upl_name."' AND `model_images`.`category` = 'Profile' ";
	if(mysqli_query($con,$sql_delete)){
		$output['status']= 'success';
	}else $output['status']= 'error';
}else $output['status']= 'error';
echo json_encode($output);
?>