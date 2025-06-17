<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
if ($_SESSION["log_user"]) {
  $userDetails = get_data('model_user', array('id' => $_SESSION['log_user_id']), true);
  if (!$userDetails) {
    header("Location: ../login.php");
  }
}
if (isset($_POST['submit'])) {
  $user_unique_id = $_POST['user_unique_id'];
  $model_data = get_data('model_user', array('unique_id' => $_POST['model_id']), true);
  if (!$model_data) {
    echo '<script>alert("There is no model.")</script>';
    echo '<script>window.history.back();</script>';
    die;
  }
  $model_extra_data = get_data('model_extra_details', array('unique_model_id' => $_POST['model_id']), true);
  if (!$model_extra_data) {
    echo '<script>alert("There is no service in this model.")</script>';
    echo '<script>window.history.back();</script>';
    die;
  }
  if ($model_extra_data['work_escort'] != 'Yes') {
    echo '<script>alert("There is no service in this modelsss.")</script>';
    echo '<script>window.history.back();</script>';
    die;
  }

  $total_mem = $_POST['total_mem'];
  $model_id = $_POST['model_id'];
  $duration = $_POST['duration'];
  $instructions = $_POST['instructions'];

  $bookingslot = $_POST['bookingslot'];
  if ($bookingslot == 'new') {
    $meeting_date = $_POST['meeting_date'];
    $meeting_time_hour = $_POST['meeting_time_hour'];
    $meeting_time_min = $_POST['meeting_time_min'];
    $ampm = $_POST['ampm'];
    $gs_token_price = $model_extra_data['gs_token_price'];
    $meeting_time = date("H:i", strtotime($meeting_time_hour.':'.$meeting_time_min.' '.$ampm));

  } else {
    $bookingslot = json_decode($_POST['bookingslot']);
    $meeting_date = $bookingslot->dates;
    $gs_token_price = $bookingslot->amount;
    $meeting_time = $bookingslot->times;
    $meeting_time_hour = $meeting_time_min = $ampm = '';
  }


  $total_token = $gs_token_price * $total_mem;
  $wallet_coins = $userDetails['balance'];

  $email = $model_data['email'];

  if ($total_token < $wallet_coins) {
    $post_data = array(
      'model_unique_id'  => $model_data['id'],
      'user_unique_id'  => $userDetails['id'],
      
      'total_member'  => $total_mem,
      'meeting_date'  => $meeting_date,
      'meeting_date'  => $meeting_date,
      'meeting_time'  => $meeting_time,
      'meeting_time_hour'  => $meeting_time_hour,
      'meeting_time_min'  => $meeting_time_min,
      'ampm'              => $ampm,
      'instruction'       => $instructions,
      'duration'       => $duration,
      'coins'       => $total_token,
      
      
    );
//printR($post_data);die;
    DB::insert('booking_group_show', $post_data);
    $bookingID = DB::insertId();
      $date =date('Y-m-d H:i:s');
      DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE unique_id=%s", $total_token, $model_id);
      DB::insert('model_user_transaction_history', array(
        'user_id'=>$model_data['id'],
        'other_id'=>$bookingID,
        'amount'=>$total_token,
        'type'=>'user-booking-group-show',
        'created_at'  => $date,
      ));

      DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE unique_id=%s", $total_token, $user_unique_id);
      DB::insert('model_user_transaction_history', array(
        'user_id'=>$userDetails['id'],
        'other_id'=>$bookingID,
        'amount'=>$total_token,
        'type'=>'booking-group-show',
        'created_at'  => $date,
      ));
      echo '<script>alert("Your Booking for Group show has been Successfully Send to model.")</script>';

      //***********send notfication code start
      $notification_text = "" . $_SESSION["log_user"] . " has send you the group show request.";

      $notification_text1 = "You have send the group show requset to " . $model_name . ". Waiting for approval.";

      $que1 = "INSERT INTO `notification`(`sender_user`, `reciver_user`, `notification_text`) VALUES ('" . $user_unique_id . "','" . $model_id . "','" . $notification_text . "')";
      $que2 = "INSERT INTO `notification`(`reciver_user`, `notification_text`) VALUES ('" . $user_unique_id . "','" . $notification_text1 . "')";

      if (mysqli_query($con, $que1) && mysqli_query($con, $que2)) {
        echo '<script>alert("notification send to user.")</script>';
      }


      //***********send notfication code end

      //echo file_get_contents('../mail/test-mail.php');

      $email_to = $email;
      $subject = "Model booking for Group Show | The Live Model";

      $header = "From: The live models <prashant.systos@gmail.com>\r\n";
      $header .= "MIME-version:1.0\r\n";
      $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      // $htmlContent = file_get_contents("../mail/test-mail.php");
      // $message = $htmlContent;

      $message = '
           <html>
            <body style="width:80%;margin:auto;border:3px solid #000;">
            <div style="width: 100%; auto;">
              <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="https://thelivemodels.com/uploads/live-model-logo.png" alt="" />
              </center>
            </div>
            <div style="padding: 20px;">

            <h2>Dear Model, </h2>
            <p>You have got one Group show from user please check their details:
              <table style="width:100%">
        			  
        			  <tr>
        			    <td><b>Email</b></td>
        			    <td>' . $_SESSION["log_user_email"] . '</td>
        			  </tr>
        			  <tr>
                <tr>
                  <td><b>Total Member</b></td>
                  <td>' . $total_mem . '</td>
                </tr>
                <tr>
        			    <td><b>Duration</b></td>
        			    <td>' . $duration . '</td>
        			  </tr>
                <tr>
                  <td><b>Meeting Date</b></td>
                  <td>' . $meeting_date . '</td>
                </tr>
                <tr>
                  <td><b>Meeting Time</b></td>
                  <td>' . $meeting_time.'</td>
                </tr>
                <tr>
                  <td><b>Instructions</b></td>
                  <td>' . $instructions . '</td>
                </tr>
        			</table>
            </div>
            </body>
           </html>';

      $email_to1 = $_SESSION["log_user_email"];
      $subject1 = "Model booking for Group Show | The Live Model";

      $header1 = "From: The live models <prashant.systos@gmail.com>\r\n";
      $header1 .= "MIME-version:1.0\r\n";
      $header1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $message1 = '
           <html>
            <body style="width:80%;margin:auto;border:3px solid #000;">
            <div style="width: 100%; height: auto;">
              <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="https://thelivemodels.com/uploads/live-model-logo.png" alt="" />
              </center>
            </div>
            <div style="padding: 20px;">

            <h2>Dear User, </h2>
            <p>Thanks for chossing the service offered from <b>The live Models</b>:
            <p>Your request for Group show has been successfull sent to ' . $model_name . '.</p>
            <p>We will inform you when she will accept your request. </p>
            </div>
            </body>
           </html>';
           
        if (mail($email_to, $subject, $message, $header) && mail($email_to1, $subject1, $message1, $header1)) {
        echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
        echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
      } else {
        echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
        echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
      }
  } else {
    echo '<script>alert("Oops!! You dont have coins for using these service")</script>';
    echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
  }
}
?>