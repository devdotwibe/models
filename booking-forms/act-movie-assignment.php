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

  $model_data = get_data('model_user', array('unique_id' => $_POST['model_id']), true);
  if (!$model_data) {
    echo '<script>alert("There is no model.")</script>';
    echo '<script>window.history.back();</script>';
    die;
  }

  $name = $_POST['name'];
  // $phone = $_POST['phone'];
  // $email = $_POST['email'];
  $age = $_POST['age'];
  $du_movie_modeling = $_POST['du_movie_modeling'];
  $model_name = $_POST['model_name'];
  $model_id = $_POST['model_id'];
  $meeting_date = $_POST['meeting_date'];
  $meeting_time_hour = $_POST['meeting_time_hour'];
  $meeting_time_min = $_POST['meeting_time_min'];
  $ampm = $_POST['ampm'];
  $instructions = $_POST['instructions'];
  $user_unique_id = $_POST['user_unique_id'];
  // $address = $_POST['address'];
  // $city = $_POST['city'];
  // $state = $_POST['state'];
  // $zip_code = $_POST['zip_code'];
  // $country = $_POST['country'];

  $sql = "SELECT * FROM model_extra_details WHERE unique_model_id = '" . $model_id . "'";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row1 = mysqli_fetch_assoc($result);
    $shoot_per_hour_price = $row1['shoot_per_hour_price'];
  }

  $total_token = $shoot_per_hour_price * $du_movie_modeling;

  $sql_fwa = "SELECT * FROM model_user WHERE unique_id = '" . $_SESSION["log_user_unique_id"] . "'";
  $result_fwa = mysqli_query($con, $sql_fwa);
  if (mysqli_num_rows($result_fwa) > 0) {
    $row_fwa = mysqli_fetch_assoc($result_fwa);
    $wallet_coins = $row_fwa['balance'];
  }

  $sql_fwa1 = "SELECT * FROM model_user WHERE unique_id = '" . $model_id . "'";
  $result_fwa1 = mysqli_query($con, $sql_fwa1);
  if (mysqli_num_rows($result_fwa1) > 0) {
    $row_fwa1 = mysqli_fetch_assoc($result_fwa1);
    $email = $row_fwa1['email'];
  }
  if ($total_token < $wallet_coins) {

    $que = "INSERT INTO `booking_movie_assignments`(`name`, `age`, `du_movie_modeling`, `unique_user_id`, `model_name`, `model_unique_id`, `meeting_date`, `meeting_time_hour`, `meeting_time_min`, `ampm`, `instructions`, `amount`) 
   VALUES ('" . $name . "', '" . $age . "', '" . $du_movie_modeling . "', '" . $user_unique_id . "', '" . $model_name . "', '" . $model_id . "', '" . $meeting_date . "', '" . $meeting_time_hour . "', '" . $meeting_time_min . "', '" . $ampm . "', '" . $instructions . "', '" . $total_token . "')";
    if (mysqli_query($con, $que)) {
      $bookingID = $con->insert_id;
      $date = date('Y-m-d H:i:s');

      DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE unique_id=%s", $total_token, $model_id);
      DB::insert('model_user_transaction_history', array(
        'user_id' => $model_data['id'],
        'other_id' => $bookingID,
        'amount' => $total_token,
        'type' => 'user-booking-movie-assignments',
        'created_at'  => $date,
      ));


      DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE unique_id=%s", $total_token, $user_unique_id);
      DB::insert('model_user_transaction_history', array(
        'user_id' => $userDetails['id'],
        'other_id' => $bookingID,
        'amount' => $total_token,
        'type' => 'booking-movie-assignments',
        'created_at'  => $date,
      ));
      echo '<script>alert("Your Booking for Modeling/Movie Assignment has been Successfully Send to model.")</script>';

      //***********send notfication code start
      $notification_text = "" . $_SESSION["log_user"] . " has send you the request for Modeling/Movie Assignment.";

      $notification_text1 = "You have send the request for Modeling/Movie Assignments to " . $model_name . ". Waiting for approval.";

      $que1 = "INSERT INTO `notification`(`sender_user`, `reciver_user`, `notification_text`) VALUES ('" . $user_unique_id . "','" . $model_id . "','" . $notification_text . "')";
      $que2 = "INSERT INTO `notification`(`reciver_user`, `notification_text`) VALUES ('" . $user_unique_id . "','" . $notification_text1 . "')";

      if (mysqli_query($con, $que1) && mysqli_query($con, $que2)) {
        echo '<script>alert("notification send to user.")</script>';
      }

      //***********send notfication code end

      $email_to = $email;
      $subject = "Model booking for Modeling/Movie Assignment | The Live Model";

      $header = "From: The Live Model <prashant.systos@gmail.com>\r\n";
      $header .= "MIME-version:1.0\r\n";
      $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;">
            <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="https://thelivemodels.com/uploads/live-model-logo.png" alt="" />
              </center>
          </div>
          <div style="padding: 20px;">

          <h2>Dear Model, </h2>
          <p>You have got one modeling/movie assignment from user please check their details:
            <table style="width:100%">
      			  <tr>
      			    <td><b>Email</b></td>
      			    <td>' . $email . '</td>
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
                <td>' . $meeting_time_hour . ':' . $meeting_time_min . ' ' . $ampm . '</td>
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
      $subject1 = "Model booking for Modeling/Movie Assignment | The Live Model";

      $header1 = "From: The live models <prashant.systos@gmail.com>\r\n";
      $header1 .= "MIME-version:1.0\r\n";
      $header1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $message1 = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;">
            <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="https://thelivemodels.com/uploads/live-model-logo.png" alt="" />
              </center>
          </div>
          <div style="padding: 20px;">

          <h2>Dear User, </h2>
          <p>Thanks for chossing the service offered from <b>The live Models</b>:
          <p>Your request for Modeling/Movie Assignment has been successfull sent to ' . $model_name . '.</p>
          <p>We will inform you when she will accept your request. </p>
          </div>
          </body>
         </html>';

      if (mail($email_to, $subject, $message, $header) && mail($email_to1, $subject1, $message1, $header1)) {
        echo '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
        echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
      } else {
        echo '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
        echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
      }
      echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
    } else {
      echo '<script>alert("Oops!! Found Some error.")</script>';
      echo '<script>window.location="https://thelivemodels.com"</script>';
    }
  } else {
    echo '<script>alert("Oops!! You dont have coins for using these service.")</script>';
    echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id=' . $model_id . '"</script>';
  }
}
