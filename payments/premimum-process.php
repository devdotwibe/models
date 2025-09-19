<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

if(isset($_SESSION["log_user_id"])){
$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){


	if (isset($_SESSION['user_timezone'.$userDetails['id']]) && in_array($_SESSION['user_timezone'.$userDetails['id']], timezone_identifiers_list())) {

            date_default_timezone_set($_SESSION['user_timezone'.$userDetails['id']]);

	} else {
	
		date_default_timezone_set('Asia/Kolkata');
	}

	$date = date('Y-m-d H:i:s');
	
	$payment_status = $_POST['payment_status'];
	$payment_id = $_POST['payment_id'];

       	// $query1 = "INSERT INTO model_user_payment(`unique_id`, `user_name`, `user_email`, `payment_id`, `payment_amount`, `coins`,`created_date`, `status`) VALUES ('".$_SESSION["log_user_unique_id"]."','".$_SESSION["log_user"]."','".$_SESSION["log_user_email"]."','".$payment_id."','".$_SESSION["pay_amount"]."','".$_SESSION["pay_coins"]."','".$date."','Success')";

        // $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
        // $result = mysqli_query($con, $sql);

        //   if (mysqli_num_rows(result: $result) > 0) {

        //     $row1 = mysqli_fetch_assoc($result);
             
        //     $wallet_coins = $row1['wallet_coins'];

        //    $Total_coins = $_SESSION["pay_coins"] + $row1['wallet_coins'];

        //     $query2 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$Total_coins."' WHERE `model_user_wallet`.`user_unique_id` = '".$_SESSION["log_user_unique_id"]."'";
        // }else{
        // 	$query2 = "INSERT INTO `model_user_wallet`(`user_unique_id`, `user_email`, `wallet_amount`, `wallet_coins`, `wallet_status`) VALUES ('".$_SESSION["log_user_unique_id"]."','".$_SESSION["log_user_email"]."','".$_SESSION["pay_amount"]."','".$_SESSION["pay_coins"]."','1')";
        // }       


        // if (mysqli_query($con, $query1)) {

				// $insertedPaymentId = mysqli_insert_id($con);

				// $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
				// $result = mysqli_query($con, $sql);

				// if (mysqli_num_rows($result) > 0) {

					// if (mysqli_query($con, $query2)) {

						// // Update user balance
						// DB::query(
						// 	"UPDATE model_user SET balance = ROUND(balance + %d) WHERE id = %s",
						// 	$_SESSION["pay_coins"],
						// 	$userDetails['id']
						// );

                        $amount = $_SESSION["pay_amount"];
                        $plan_status = $_SESSION["plan_status"];
                        $plan_type = $_SESSION["plan_type"];

                        // DB::insert("INSERT INTO premium_users (user_id, plan_type, amount, plan_status, created_at, updated_at) VALUES (%i, %s, %i, %s, %s, %s)",
                        // $userDetails['id'], $plan_type, $amount, $plan_status, $date, $date);

                        DB::insert('premium_users',[
                            'user_id'    => $userDetails['id'],
                            'plan_type'  => $plan_type,
                            'amount'     => $amount,
                            'plan_status'=> $plan_status,
                            'created_at' => $date,
                            'updated_at' => $date,
                        ]);

                        $insertedPremiumUserId = DB::insertId();

                        DB::insert('model_user_transaction_history', [
							'user_id'    => $userDetails['id'],
							'other_id'   => $insertedPremiumUserId,
							'amount'     => $amount,
							'type'       => 'premium-purchase',
							'created_at' => $date,
						]);

						$token_get = 0;

						if($plan_status =='basic')
						{
							$token_get = 500;
						}
						else
						{
							$token_get = 2000;
						}


						DB::query(
							"UPDATE model_user SET balance = ROUND(balance + %d) WHERE id = %s",
							$token_get,
							$userDetails['id']
						);

						DB::insert('model_user_transaction_history', [
							'user_id'    => $userDetails['id'],
							'other_id'   => $insertedPremiumUserId,
							'amount'     => $token_get,
							'type'       => 'premium-purchase-token',
							'created_at' => $date,
						]);

                        unset($_SESSION["pay_amount"], $_SESSION["plan_status"], $_SESSION["plan_type"]);

						if (isset($_SESSION["payment_done"])) {

							unset($_SESSION["payment_done"]);
						}

						$_SESSION["payment_done"] = "Payment Successfully Completed";

						echo "<script>window.location='" . SITEURL . "all-members';</script>";

					// } else {
					// 	echo "Error in wallet update: " . mysqli_error($con);
					// }
				// }
				// else {
				// 	echo "Error in wallet update: " . mysqli_error($con);
				// }
			// }
		// else{
        // 	echo "<script>alert('Your Payment Data will not be inserted');</script>";
        // 	echo "<script>window.location='success.php'</script>";
        // 	unset($_SESSION["pay_amount"]);
        // 	unset($_SESSION["pay_coins"]);
        // } 
	}
	else{
		echo "<script>alert('Please login');</script>";
		echo "<script>window.location='login'</script>";
	}
}
else{
	echo "<script>alert('Please login');</script>";
	echo "<script>window.location='login'</script>";
}
 // you can write your database insertation code here

 // after successfully insert transaction in database, pass the response accordingly


?>

