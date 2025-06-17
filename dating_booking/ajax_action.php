<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$table_name = "countries";
$output = array('status'=>'error','message'=>'there is some problem.');
if(isset($_SESSION['log_user_id'])){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
		$id = $_GET['id'];
		$type = $_GET['type'];
		if($id&&$type){
			$check_data = get_data('booking_dating_assignments',array('model_unique_id'=>$userDetails['unique_id'],'id'=>$id),true);
			if($check_data){
				if($check_data['status']=='pending'){
					$output = array('status'=>'ok','message'=>'');
					if($type=='accept'){
						$post_data = array('status'=>'accept');
					}
					else{
						$post_data = array('status'=>'reject');
					}
					DB::update('booking_dating_assignments', $post_data, "id=%s", $id);
				}
				else{
					$output['message'] = 'You already set action!!';
				}
			}
			else{
				$output['message'] = 'There is no request!!';
			}
		}
	}
	else{
		$output['message'] = 'Please login first!!';
	}
}
echo json_encode($output);
?>
