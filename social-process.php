<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
  $output = array();

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$coins = isset($_GET['tokens']) ? $_GET['tokens'] : 0;
$platform = isset($_GET['platform']) ? $_GET['platform'] : '';
$m_unique_id = isset($_GET['m_unique_id']) ? $_GET['m_unique_id'] : '';
$model_id = isset($_GET['model_id']) ? $_GET['model_id'] : '';
$user_id = $_SESSION['log_user_unique_id'];

if(!empty($id)){
	
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){
	//get model
$modelDetails = get_data('model_user',array('unique_id'=>$model_id),true);
		if($modelDetails){
			
			$sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$user_id."'";
			$result_fwa = mysqli_query($con,$sql_fwa);
			if (mysqli_num_rows($result_fwa) > 0) {
				$row_fwa = mysqli_fetch_assoc($result_fwa);
				$wallet_coins = $row_fwa['wallet_coins'];
			}  
	
			if($userDetails['balance'] >= $coins){
				$date =date('Y-m-d H:i:s');
		

				$post_data = array(
					'user_unique_id'  => $user_id,
					'model_unique_id'  => $m_unique_id,
					'social_id'  => $id,
					'platform'  => $platform,
					'purchased_coins'  => $coins,
				  );
			  //printR($post_data);die;
				  DB::insert('user_purchased_social', $post_data);
				  $bookingID = DB::insertId();

				DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $coins, $modelDetails['id']);
				DB::insert('model_user_transaction_history', array(
					'user_id'=>$modelDetails['id'],
					'other_id'=>$bookingID,
					'amount'=>$coins,
					'type'=>'user-purchase-social',
					'created_at'  => $date,
				  ));		
				DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $coins, $userDetails['id']);

				DB::insert('model_user_transaction_history', array(
					'user_id'=>$userDetails['id'],
					'other_id'=>$bookingID,
					'amount'=>$coins,
					'type'=>'purchase-image',
					'created_at'  => $date,
				  ));
				$retmsg = "success";
		
			}else{
				$retmsg = "sufficianterror";
			}
			
			
		}else{
			$retmsg = 'modelerror';
		}
	
}else{
	$retmsg = 'loginerror';
}
	
	
}else{
	$retmsg = 'No social liks found';
}

$output['msg'] = $retmsg;
echo json_encode($output);
?>