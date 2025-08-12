<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

if(isset($_SESSION["log_user_id"])){
$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){
	$date = date('Y-m-d H:i:s');
	
	$payment_status = $_POST['payment_status'];
	$payment_id = $_POST['payment_id'];
 

       	$query1 = "INSERT INTO model_user_payment(`unique_id`, `user_name`, `user_email`, `payment_id`, `payment_amount`, `coins`,`created_date`, `status`) VALUES ('".$_SESSION["log_user_unique_id"]."','".$_SESSION["log_user"]."','".$_SESSION["log_user_email"]."','".$payment_id."','".$_SESSION["pay_amount"]."','".$_SESSION["pay_coins"]."','".$date."','Success')";

        $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
        $result = mysqli_query($con, $sql);

          if (mysqli_num_rows(result: $result) > 0) {

            $row1 = mysqli_fetch_assoc($result);
             
            $wallet_coins = $row1['wallet_coins'];

           $Total_coins = $_SESSION["pay_coins"] + $row1['wallet_coins'];

            $query2 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$Total_coins."' WHERE `model_user_wallet`.`user_unique_id` = '".$_SESSION["log_user_unique_id"]."'";
        }else{
        	$query2 = "INSERT INTO `model_user_wallet`(`user_unique_id`, `user_email`, `wallet_amount`, `wallet_coins`, `wallet_status`) VALUES ('".$_SESSION["log_user_unique_id"]."','".$_SESSION["log_user_email"]."','".$_SESSION["pay_amount"]."','".$_SESSION["pay_coins"]."','1')";
        }       


        if (mysqli_query($con,$query1) && mysqli_query($con,$query2) || true) {
			$post_data = array(
				'balance'=>round($userDetails['balance']+$_SESSION["pay_coins"])
			);
			DB::update('model_user', $post_data, "id=%s", $userDetails['id']);

			DB::insert('model_user_transaction_history', array(
				'user_id' => $userDetails['id'],
				'other_id' => $payment_id,
				'amount' =>  $_SESSION["pay_coins"],
				'type' => 'coin_parchase',
				'created_at' => $date,
			));
	
        	echo "<script>alert('Your Payment Data will be inserted');</script>";
        	echo "<script>window.location='success.php'</script>";
        	unset($_SESSION["pay_amount"]);
        	unset($_SESSION["pay_coins"]);
        }
		else{
        	echo "<script>alert('Your Payment Data will not be inserted');</script>";
        	echo "<script>window.location='success.php'</script>";
        	unset($_SESSION["pay_amount"]);
        	unset($_SESSION["pay_coins"]);
        } 
	}
	else{
		echo "<script>alert('Please login');</script>";
		echo "<script>window.location='login.php'</script>";
	}
}
else{
	echo "<script>alert('Please login');</script>";
	echo "<script>window.location='login.php'</script>";
}
 // you can write your database insertation code here

 // after successfully insert transaction in database, pass the response accordingly


?>

