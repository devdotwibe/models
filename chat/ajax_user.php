<?php
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$html = "";
if(isset($_SESSION['log_user_id'])){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
		$type = $_GET['type'];
		if($type=='main'){
		$string ="select distinct(tb.id),tb.gender,tb.username,tb.profile_pic from model_user tb where
unique_id in (select unique_model_id from model_follow where unique_user_id='".$userDetails['unique_id']."')
and unique_id in (select unique_user_id from model_follow where unique_model_id='".$userDetails['unique_id']."')
";
		}
		else{
		$string ="select distinct(tb.id),tb.gender,tb.username,tb.profile_pic from model_user tb where
unique_id in (select unique_model_id from model_follow where unique_user_id='".$userDetails['unique_id']."' )
or unique_id in (select unique_user_id from model_follow where unique_model_id='".$userDetails['unique_id']."')
";
		}
$all_data = DB::query($string);

	ob_start();
	include 'ajax_list_item.php';
	$html= ob_get_clean();

	}
}
echo json_encode(array('html'=>$html));

?>
