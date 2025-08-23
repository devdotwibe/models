<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
if (isset($_SESSION["log_user_id"])) {
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {

		if (isset($_POST['submit'])) {
			$file_id = $_POST['file_id'];
			$user_id = $_POST['user_id'];
			$coins = $_POST['coins'];
			$file_type = $_POST['file_type'];

			$m_unique_id = $_POST['m_unique_id'];
			$m_id = $_POST['m_id'];
			$model = $_POST['model'];
			$model_id = $_POST['model_id'];

			//get model
			$modelDetails = get_data('model_user', array('id' => $model_id), true);
			if ($modelDetails) {
				// echo '<script>alert("Are you Sure want to buy it.");</script>';
				//printR($_POST);die;

				$sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '" . $user_id . "'";
				$result_fwa = mysqli_query($con, $sql_fwa);
				if (mysqli_num_rows($result_fwa) > 0) {
					$row_fwa = mysqli_fetch_assoc($result_fwa);
					$wallet_coins = $row_fwa['wallet_coins'];
				}

				if ($userDetails['balance'] >= $coins) {
					$date = date('Y-m-d H:i:s');

					//   	$remain_coin = $userDetails['balance']-$coins;
					//$sql1 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$remain_coin."' WHERE `model_user_wallet`.`user_unique_id` = '".$user_id."'";
					// $sql2 = "INSERT INTO `user_purchased_image`(`user_unique_id`, `model_unique_id`, `file_unique_id`, `file_type`, `file_coins`) VALUES ('".$user_id."','".$m_unique_id."','".$file_id."','".$file_type."','".$coins."')";
					// DB::query($sql2);

					$post_data = array(
						'user_unique_id' => $user_id,
						'model_unique_id' => $m_unique_id,

						'file_unique_id' => $file_id,
						'file_type' => $file_type,
						'file_coins' => $coins,
					);
					//printR($post_data);die;
					DB::insert('user_purchased_image', $post_data);
					$bookingID = DB::insertId();

					DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $coins, $modelDetails['id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $modelDetails['id'],
						'other_id' => $bookingID,
						'amount' => $coins,
						'type' => 'user-purchase-image',
						'created_at' => $date,
					));
					DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $coins, $userDetails['id']);

					DB::insert('model_user_transaction_history', array(
						'user_id' => $userDetails['id'],
						'other_id' => $bookingID,
						'amount' => $coins,
						'type' => 'purchase-image',
						'created_at' => $date,
					));

					echo json_encode(['status' => 'buynow','message'=>''.$_POST['coins'].' tokens deducted! '.$_POST['file_type'].' unlocked.']);

				} else {
				
					echo json_encode(['status' => 'buynow','message'=>'You dont have sufficiant coins in your wallet for buying it.']);
				}
			}//modal condition
			else {
			
				echo json_encode(['status' => 'success','message'=>'There is no model!!']);
			}
		}
	} else {
		echo "<script>alert('Please login');</script>";
		echo "<script>window.location='login.php'</script>";
	}
} else {
	echo "<script>alert('Please login');</script>";
	echo "<script>window.location='login.php'</script>";
}
?>