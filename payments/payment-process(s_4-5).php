<?php
	session_start();
	include('../includes/config.php');
?>
<?php
    
 $data = [ 
         
         'payment_id' => $_POST['razorpay_payment_id'],
         'amount' => $_SESSION["pay_amount"],
         'product_id' => $_SESSION["pay_coins"],
         'username' => $_SESSION["log_user"],
         'email' => $_SESSION["log_user_email"],
         'user_id' => $_SESSION["log_user_unique_id"],
        ];
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // echo $data["razorpay_payment_id"];

         $payment_id = $_POST['razorpay_payment_id'];

       	$query1 = "INSERT INTO model_user_payment(`unique_id`, `user_name`, `user_email`, `payment_id`, `payment_amount`, `coins`, `status`) VALUES ('".$_SESSION["log_user_unique_id"]."','".$_SESSION["log_user"]."','".$_SESSION["log_user_email"]."','".$payment_id."','".$_SESSION["pay_amount"]."','".$_SESSION["pay_coins"]."','Success')";


        $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
        $result = mysqli_query($con,$sql);

          if (mysqli_num_rows($result) > 0) {

            $row1 = mysqli_fetch_assoc($result);
             
            $wallet_coins = $row1['wallet_coins'];
            $Total_coins =  $_SESSION["pay_coins"] + $row1['wallet_coins'];

            $query2 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$Total_coins."' WHERE `model_user_wallet`.`user_unique_id` = '".$_SESSION["log_user_unique_id"]."'";
        }else{
        	$query2 = "INSERT INTO `model_user_wallet`(`user_unique_id`, `user_email`, `wallet_amount`, `wallet_coins`, `wallet_status`) VALUES ('".$_SESSION["log_user_unique_id"]."','".$_SESSION["log_user_email"]."','".$_SESSION["pay_amount"]."','".$_SESSION["pay_coins"]."','1')";
        }       


        if (mysqli_query($con,$query1) && mysqli_query($con,$query2)) {
        	echo "<script>alert('Your Payment Data will be inserted');</script>";
        	echo "<script>window.location='success.php'</script>";
        	unset($_SESSION["pay_amount"]);
        	unset($_SESSION["pay_coins"]);
        }else{
        	echo "<script>alert('Your Payment Data will not be inserted');</script>";
        	echo "<script>window.location='success.php'</script>";
        	unset($_SESSION["pay_amount"]);
        	unset($_SESSION["pay_coins"]);
        }
        
 // you can write your database insertation code here

 // after successfully insert transaction in database, pass the response accordingly


?>

