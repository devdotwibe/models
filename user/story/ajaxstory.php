<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

$output = array();
$output['status']= 'ok';
$model_id = $_GET['id'];

$output['html'] = 'There is no story';
if($model_id){
	$viewBtn =false;
    $story_list =  get_data('model_user_story',array('user_id'=>$model_id));

	if(isset($_SESSION['log_user_id'])){
        $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
        if($userDetails){
            if($story_list['user_id']==$userDetails['id']){
				$viewBtn =true;
			}
		}
	}	
	
    ob_start();
	include 'ajaxstoryitem.php';
	$html= ob_get_clean();
	$output['html'] = $html;
}
echo json_encode($output);
?>
