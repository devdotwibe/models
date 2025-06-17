<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		header("Location: ../login.php");
	}
}
if (isset($_POST['submit'])) {

	$user_unique_id = $_POST['user_unique_id'];
	$model_data = get_data('model_user',array('unique_id'=>$_POST['model_id']),true);
	if(!$model_data){
		echo '<script>alert("There is no model.")</script>';
		echo '<script>window.history.back();</script>';
		die;
	}
	$model_extra_data = get_data('model_extra_details',array('unique_model_id'=>$_POST['model_id']),true);
	if(!$model_extra_data){
		echo '<script>alert("There is no service in this model.")</script>';
		echo '<script>window.history.back();</script>';
		die;
	}
	if($model_extra_data['work_escort']!='Yes'){
		echo '<script>alert("There is no service in this modelsss.")</script>';
		echo '<script>window.history.back();</script>';
		die;
	}
	
	//get book type and amount
	$call = $_POST['call'];
	$book_for = $_POST['book_for'];
	$amount = 0;
	if($call=='Outcall'){
		if($book_for<'8'){
			$amount= $book_for*$model_extra_data['out_per_hour'];
		}
		else{
			$amount= $model_extra_data['out_overnight'];
		}
	}
	else{
		$call = "Incall";
		if($book_for<'8'){
			$amount= $book_for*$model_extra_data['in_per_hour'];
		}
		else{
			$amount= $model_extra_data['in_overnight'];
		}
	}
  $post_data  = array(
  			'age'	=> $_POST['age'],
  			'model_unique_id'	=> $_POST['model_id'],
  			'meeting_date'	=> $_POST['meeting_date'],
  			'for_call'	=> $call,
  			'meeting_time_hour'	=> $_POST['meeting_time_hour'],
  			'meeting_time_min'	=> $_POST['meeting_time_min'],
  			'instructions'	=> $_POST['instructions'],
  			'ampm'	=> $_POST['ampm'],
  			'user_unique_id'	=> $user_unique_id,
  			'booking_for'	=> $book_for,
  			'amount'	=> $amount,
  			'created_date'	=> date('Y-m-d H:i:s'),
			
  ); 
  //printR($_POST);
	DB::insert('booking_dating_assignments', $post_data);
//	echo DB::lastQuery();
	$created_id = DB::insertId();

	$notification_text = "".$_SESSION["log_user"]." has send you the request for Dating Assignments .";
	
	$notification_text1 = "You have send the request for Dating Assignments to ".$model_data['username'].". Waiting for approval.";
	
	$que1 = "INSERT INTO `notification`(`sender_user`, `reciver_user`, `notification_text`) VALUES ('".$user_unique_id."','".$_POST['model_id']."','".$notification_text."')";
	$que2 = "INSERT INTO `notification`(`reciver_user`, `notification_text`) VALUES ('".$user_unique_id."','".$notification_text1."')";
        if(mysqli_query($con, $que1) && mysqli_query($con, $que2)){
           /* echo '<script>alert("notification send to user.")</script>';*/
        }
	
 
/*      echo '<script>alert("Your Booking for Dating Assignments has been Successfully Send to model.")</script>';*/

      	$email_to = $email;
         $subject = "Model booking for Dating Assignment | The Live Model";

         $header = "From: The live model <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%; height: auto;">
            <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="'.SITEURL.'uploads/live-model-logo.png" alt="" />
              </center>
          </div>
          <div style="padding: 20px;">

          <h2>Dear Model, </h2>
          <p>You have got one Dating Assignment from user please check their details:
            <table style="width:100%">
      			  <tr> 
      			    <td><b>Email</b></td>
      			    <td>'.$_SESSION["log_user_email"].'</td>
      			  </tr>
              <tr>
                <td><b>Call</b></td>
                <td>'.$call.'</td>
              </tr>
              <tr>
                <td><b>Booking For</b></td>
                <td>'.$book_for.'</td>
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
         $subject1 = "Model booking for Dating Assignment | The Live Model";

         $header1 = "From: The live models <prashant.systos@gmail.com>\r\n";
         $header1 .= "MIME-version:1.0\r\n";
         $header1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message1 = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%; height: auto;">
            <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="'.SITEURL.'uploads/live-model-logo.png" alt="" />
              </center>
          </div>
          <div style="padding: 20px;">

          <h2>Dear User, </h2>
          <p>Thanks for chossing the service offered from <b>The live Models</b>:
          <p>Your request for Dating Assignment has been successfull sent to '.$model_data['username'].'.</p>
          <p>We will inform you when she will accept your request. </p>
          </div>
          </body>
         </html>';
/*		 echo $subject1;
		 echo '<br>'.$header1;
		 echo '<br>'.$message1;*/
         if (mail($email_to, $subject, $message, $header) && mail($email_to1, $subject1, $message1, $header1)) {
            echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
            echo '<script>window.location="'.SITEURL.'single-profile.php?m_unique_id='.$_POST['model_id'].'"</script>';
         }else{
            echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
            echo '<script>window.location="'.SITEURL.'single-profile.php?m_unique_id='.$_POST['model_id'].'"</script>';
         }
      echo '<script>window.location="'.SITEURL.'single-profile.php?m_unique_id='.$_POST['model_id'].'"</script>';

}
?>