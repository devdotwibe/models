<?php 
session_start(); 
include('../includes/config.php');
include('../includes/constant.php');
include('../../includes/helper.php');
include('../includes/auth.php');

$m_link= ADMINURL.'withdrawal/';
$table_name = "users_withdrow_request";
$output = array('status'=>'error','message'=>'There is some problem.');
$id = $_GET['id'];
$type = $_GET['type'];
if($type&&$id){
$stringQuery = "SELECT tb.* FROM ".$table_name." tb 
 left join model_user mu on mu.id=tb.user_id where tb.id='".$id."'";
	$check_data = DB::queryFirstRow($stringQuery);
	if($check_data){
		if($check_data['status']==0){
			if($type=='accept'){
				$post_data = array('status'=>1);
			}
			else{
				$post_data = array('status'=>2);
			}
			DB::update($table_name, $post_data, "id=%s", $id);
			if($type=='accept'){

				$date = date('Y-m-d H:i:s');

				DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $check_data['coins'], $check_data['user_id']);

				DB::insert('model_user_transaction_history', array(
					'user_id' => $check_data['user_id'],
					'other_id' =>$check_data['tb.id'],
					'amount' =>  $check_data['coins'],
					'type' => 'withdrawal-coins',
					'created_at' => $date,
				));
			}
		$output = array('status'=>'ok','message'=>'');
			
		}
		else{
			$output['message'] = 'You alrady set action.';
		}
	}
	else{
		$output['message'] = 'There is no data';
	}
	
}
echo json_encode($output);
?>
