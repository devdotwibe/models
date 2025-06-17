<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
		echo "<script>window.location='".SITEURL."/login.php';</script>";
		die;
	}
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."/login.php';</script>";
	die;
}
$m_id = $_POST["model_id"];
if(!$m_id){
	echo '<script>window.history.back();</script>';
	die;
}

$model_data = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id =  %s ", $m_id);
if(!$model_data){
	echo '<script>window.history.back();</script>';
	die;
}
$model_name = $model_data['name'];
$model_extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id =  %s ", $model_data['unique_id']);
if(!$model_extra_details){
	echo '<script>alert("Model has no service to booking.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}

if($model_extra_details['International_tours']!='Yes'){
	echo '<script>alert("Model has no service to booking.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}

$wallet_coins = $userDetails['balance'];
$email = $model_data['email'];


if (isset($_POST['submit'])) {
  // $name = $_POST['name'];
  // $phone = $_POST['phone'];
  // $email = $_POST['email'];
	$arr = array('book_for','country','booking_type','meeting_date','meeting_time_hour','meeting_time_min','ampm','instructions');
	$post_data = array_from_post($arr);
	if($post_data['booking_type']=='Annual'){
		$r_amount = $model_extra_details['i_t_annual'];
	}
	else if($post_data['booking_type']=='Month'){
		$r_amount = $model_extra_details['i_t_month'];
	}
	else if($post_data['booking_type']=='Week'){
		$r_amount = $model_extra_details['i_t_week'];
	}
	else{
		$r_amount = $model_extra_details['i_t_day'];
	}
	

  if ($book_for == '2') {
    $total_token = $two_hour_rates * $book_for;
  }else if($book_for == '4'){
    $total_token = $four_hour_rates * $book_for;
  }else if($book_for == '8'){
    $total_token = $nght_rates;
  }

  if($total_token < $wallet_coins){
    $post_data['amount'] = round($post_data['book_for']*$r_amount);
    $post_data['user_id'] = $userDetails['id'];
    $post_data['model_id'] = $model_data['id'];
    $post_data['created_date'] = date('Y-m-d H:i:s');
    $remain_coin = $wallet_coins - $total_token;
	DB::insert('booking_international_tour', $post_data);

	DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $total_token, $model_data['id']);

	DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $total_token, $userDetails['id']);

    echo '<script>alert("Your Booking for International Tour has been Successfully Send to model.")</script>';

    //***********send notfication code start
    $notification_text = "".$_SESSION["log_user"]." has send you the request for International Tour.";

    $notification_text1 = "You have send the request for International Tour to ".$model_name.". Waiting for approval.";

    $que1 = "INSERT INTO `notification`(`sender_user`, `reciver_user`, `notification_text`) VALUES ('".$user_unique_id."','".$model_id."','".$notification_text."')";
    $que2 = "INSERT INTO `notification`(`reciver_user`, `notification_text`) VALUES ('".$user_unique_id."','".$notification_text1."')";
     
    if(mysqli_query($con, $que1) && mysqli_query($con, $que2)){
      echo '<script>alert("notification send to user.")</script>';
    }
    //***********send notfication code end
      
      $email_to = $email;
      $subject = "Model booking for International Tour | The Live Model";

       $header = "From: The Live Model <prashant.systos@gmail.com>\r\n";
       $header .= "MIME-version:1.0\r\n";
       $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

       $message = '
       <html>
        <body style="width:80%;margin:auto;border:3px solid #000;">
        <div style="width: 100%;">
         <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="'.SITEURL.'uploads/live-model-logo.png" alt="" />
              </center>
        </div>
        <div style="padding: 20px;">

        <h2>Dear Model, </h2>
        <p>You have got one International tour from user please check their details:
          <table style="width:100%">
    			  <tr>
    			    <td><b>Email</b></td>
    			    <td>'.$_SESSION["log_user_email"].'</td>
    			  </tr>
            <tr>
              <td><b>Meeting Date</b></td>
              <td>'.$post_data['meeting_date'].'</td>
            </tr>
            <tr>
              <td><b>Meeting Time</b></td>
              <td>'.$post_data['meeting_time_hour'].':'.$post_data['meeting_time_min'].' '.$post_data['ampm'].'</td>
            </tr>
            <tr>
              <td><b>Instructions</b></td>
              <td>'.$post_data['instructions'].'</td>
            </tr>
    			</table>
        </div>
        </body>
       </html>';


       $email_to1 = $_SESSION["log_user_email"];
       $subject1 = "Model booking for International tour | The Live Model";

       $header1 = "From: The live models <prashant.systos@gmail.com>\r\n";
       $header1 .= "MIME-version:1.0\r\n";
       $header1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

       $message1 = '
       <html>
        <body style="width:80%;margin:auto;border:3px solid #000;">
        <div style="width: 100%;">
          <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="'.SITEURL.'uploads/live-model-logo.png" alt="" />
              </center>
        </div>
        <div style="padding: 20px;">

        <h2>Dear User, </h2>
        <p>Thanks for chossing the service offered from <b>The live Models</b>:
        <p>Your request for  International tour has been successfull sent to '.$model_name.'.</p>
        <p>We will inform you when she will accept your request. </p>
        </div>
        </body>
       </html>';
		
/*		echo $subject;
		echo '<br>';
		echo $message;
		echo '<br>';
		echo $subject1;
		echo '<br>';
		echo $message1;*/
       if (mail($email_to, $subject, $message, $header) && mail($email_to1, $subject1, $message1, $header1)) {
             echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
             echo '<script>window.location="'.SITEURL.'single-profile.php?m_unique_id='.$m_id.'"</script>';
       }else{
            echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
            echo '<script>window.location="'.SITEURL.'single-profile.php?m_unique_id='.$m_id.'"</script>';
			die;
       }
  }else{
    echo '<script>alert("Oops!! You dont have coins for using these service.")</script>';
	/*echo '<script>window.history.back();</script>';*/
	die;
  } 
 
  
 
}
?>