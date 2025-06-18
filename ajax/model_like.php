<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();
$modelid = $_GET['modelid'];
//Get like count
$get_like = DB::query('select like_count from model_user where id='.$modelid);
$post_data = array();
$post_data['like_count'] = $get_like[0]['like_count']+1;
DB::update('model_user', $post_data, "id=%s", $modelid);
$output['suc']= 'success';
echo json_encode($output);
?>
