<?php

//not user now
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$html = "";
if(isset($_SESSION['log_user_id'])){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
	$id=$_GET['id'];
	if($id){
$string ="select tb.id,tb.message,tb.created_date 
from model_user_message tb 
where (sender_id=".$userDetails['id']." and user_id=".$id.") 
or (user_id=".$userDetails['id']." and sender_id=".$id.") 
order by id desc";
$all_data = DB::query($string);

	ob_start();
	include 'ajax_message_item.php';
	$html= ob_get_clean();
	}
	}
}
echo json_encode(array('html'=>$html));

?>
