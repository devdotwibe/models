<?php
	session_start();
	include('includes/config.php');
	if (isset($_POST['reply'])) { 

	  $unique_id = $_POST['unique_id'];
	  $refund_coin = $_POST['refund_coin'];
	  $r_message = $_POST['message'];
	  $email = $_POST['email'];

      $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$unique_id."'";
      $result = mysqli_query($con,$sql);

      	if (mysqli_num_rows($result) > 0) {

        	$row1 = mysqli_fetch_assoc($result);
         
        	$wallet_coins = $row1['wallet_coins'];
      }  
      $new_coins = $wallet_coins + $refund_coin;

	  $que = "INSERT INTO `refund_coins`(`unique_user_id`, `refund_coins`, `message`) VALUES ('".$unique_id."', '".$refund_coin."', '".$r_message."')";

	  $que1 = "UPDATE `model_user_wallet` SET `wallet_coins` = ".$new_coins." WHERE `user_unique_id` = '".$unique_id."'";
	 
	  if(mysqli_query($con, $que) && mysqli_query($con, $que1)){
	  	echo 'succsess';
     	 $email_to = $email;
		 $subject = "Reply from The Live Model || ".$r_subject."";

		 $header = "From: The Live Model <prashant.systos@gmail.com>\r\n";
		 $header .= "MIME-version:1.0\r\n";
		 $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		 $message = 'Thanks for Contacting us. <br> Admin has Refund <b>'.$refund_coin.'</b> a coins to you. These coins will be added in your account..<br> Total Refunded Coins: '.$refund_coin.'<br>Message: '.$r_message.' ';

		 if (mail($email_to, $subject, $message, $header)) {
		       	echo '<script>alert("Refund coins has been sent Successfully.\nMessage Successfully Sent to Respective Mail id.")</script>';
		        echo '<script>window.history.back()</script>';
		 }else{
		      echo  '<script>alert("Error in Message Sent to Respective Mail id.")</script>';
		        echo '<script>window.history.back()</script>';
		 }
	  }else{
	    echo '<script>alert("Oops! Found some error in Coins refund.");
	       window.history.back();</script>';
	  }
	  
	}
?>