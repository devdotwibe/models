<?php 
session_start(); 
include('includes/config.php');
include('includes/helper.php');
$table_name = "tickets";
$perPage = 20;
$output = array();
$output['status']= 'error';
$output['message']= 'There is some problem.';
if(isset($_SESSION['log_user_id'])){
	$user_id = $_SESSION['log_user_id'];
	$arr = array('name','description');
	//$post_data = array_from_post($arr);
	$post_data = array_from_get($arr);
	$post_data['user_id'] = $user_id;
	$post_data['created_at'] = date('Y-m-d H:i:s');
	
	DB::insert('tickets', $post_data);
	$joe_id = DB::insertId();

	$output['status']= 'ok';
	$output['message']= '';
}
else{
$output['status']= 'error';
$output['message']= 'Please login first!';
}
echo json_encode($output);
?>
