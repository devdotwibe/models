<?php
	session_start();
	include('includes/config.php');
	if (isset($_POST['reply'])) { 

	  $query_id = $_POST['query_id'];
	  $user_unique_id = '';
	  if($_POST['user_unique_id']){
	  	$user_unique_id = $_POST['user_unique_id'];
	  }
	  $r_subject = $_POST['subject'];
	  $r_message = $_POST['message'];
	  $email = $_POST['email'];

	  $que = "INSERT INTO `contact_query`(`query_id`, user_unique_id, `subject`, `message`) VALUES ('".$query_id."', '".$user_unique_id."', '".$r_subject."','".$r_message."')";

	  if(mysqli_query($con, $que)){

	    echo '<script>alert("Reply has been sent Successfully.");</script>';

	     $email_to = $email;
			 $subject = "Reply from The Live Model || ".$r_subject."";

			 $header = "From: The Live Model <prashant.systos@gmail.com>\r\n";
			 $header .= "MIME-version:1.0\r\n";
			 $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			 $message = 'Thanks for Contacting us. <br> You have send a query with us from that one of our member will replying you.<br> Your reply is:- <br><b>'.$r_message.'</b> ';

			 if (mail($email_to, $subject, $message, $header)) {
			       echo  '<script>alert("Message Successfully Sent to Respective Mail id.")</script>';
			        echo '<script>window.history.back()</script>';
			 }else{
			      echo  '<script>alert("Error in Message Sent to Respective Mail id.")</script>';
			        echo '<script>window.history.back()</script>';
			 }
		  }else{
		    echo '<script>alert("Oops! Found some error in send reply.");
		       window.history.back();</script>';
		  }
	  
	}
?>