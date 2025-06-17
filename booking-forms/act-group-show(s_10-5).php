<?php
session_start();
include('../includes/config.php');
if (isset($_POST['submit'])) {

   $user_unique_id = $_POST['user_unique_id'];
   $age = $_POST['age'];
   $total_mem = $_POST['total_mem'];
   $model_name = $_POST['model_name'];
   $model_id = $_POST['model_id'];
   $duration = $_POST['duration'];
   $meeting_date = $_POST['meeting_date'];
   $meeting_time_hour = $_POST['meeting_time_hour'];
   $meeting_time_min = $_POST['meeting_time_min'];
   $ampm = $_POST['ampm'];
   $instructions = $_POST['instructions'];

  $sql = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$model_id."'";
  $result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) > 0) {
    $row1 = mysqli_fetch_assoc($result);
    $gs_token_price = $row1['gs_token_price'];
  }
  $total_token = $gs_token_price * $total_mem;

  $sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
  $result_fwa = mysqli_query($con,$sql_fwa);
  if (mysqli_num_rows($result_fwa) > 0) {
      $row_fwa = mysqli_fetch_assoc($result_fwa);
      $wallet_coins = $row_fwa['wallet_coins'];
  }

  $sql_fwa1 = "SELECT * FROM model_user WHERE unique_id = '".$model_id."'";
  $result_fwa1 = mysqli_query($con,$sql_fwa1);
  if (mysqli_num_rows($result_fwa1) > 0) {
      $row_fwa1 = mysqli_fetch_assoc($result_fwa1);
      $email = $row_fwa1['email'];
  }

  if($total_token < $wallet_coins){

    $remain_coin = $wallet_coins - $total_token;
    $sql1 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$remain_coin."' WHERE `model_user_wallet`.`user_unique_id` = '".$user_unique_id."'";

 	  $que = "INSERT INTO `booking_group_show`(`user_unique_id`, `age`, `total_member`, `model_name`, `model_unique_id`, `duration`, `meeting_date`, `meeting_time_hour`, `meeting_time_min`, `ampm`, `instruction`) VALUES ('".$user_unique_id."','".$age."','".$total_mem."','".$model_name."', '".$model_id."','".$duration."','".$meeting_date."','".$meeting_time_hour."','".$meeting_time_min."','".$ampm."','".$instructions."')";

    if(mysqli_query($con,$que) && mysqli_query($con,$sql1)){
   
      echo '<script>alert("Your Booking for Group show has been Successfully Send to model.")</script>';
        
          //***********send notfication code start
          $notification_text = "".$_SESSION["log_user"]." has send you the group show request.";

          $notification_text1 = "You have send the group show requset to ".$model_name.". Waiting for approval.";

           $que1 = "INSERT INTO `notification`(`sender_user`, `reciver_user`, `notification_text`) VALUES ('".$user_unique_id."','".$model_id."','".$notification_text."')";
           $que2 = "INSERT INTO `notification`(`reciver_user`, `notification_text`) VALUES ('".$user_unique_id."','".$notification_text1."')";
           
            if(mysqli_query($con, $que1) && mysqli_query($con, $que2)){
                echo '<script>alert("notification send to user.")</script>';
            }
           
            //***********send notfication code end

            ?>
            <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
            <script>
                var val = <?php echo $total_mem ?>;
                $.ajax({
                    type: "POST",
                    url: "../mail/test-mail.php",
                    data:'primary_cat='+val,
                    success: function(data){
                        alert('send');
                    }
                });
              </script>
            <?php
            echo file_get_contents('../mail/test-mail.php');
            
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
        			    <td>'.$_SESSION["log_user_email"].'</td>
        			  </tr>
        			  <tr>
                <tr>
                  <td><b>Total Member</b></td>
                  <td>'.$total_mem.'</td>
                </tr>
                <tr>
        			    <td><b>Duration</b></td>
        			    <td>'.$duration.'</td>
        			  </tr>
                <tr>
                  <td><b>Meeting Date</b></td>
                  <td>'.$meeting_date.'</td>
                </tr>
                <tr>
                  <td><b>Meeting Time</b></td>
                  <td>'.$meeting_time_hour.':'.$meeting_time_min.' '.$ampm.'</td>
                </tr>
                <tr>
                  <td><b>Instructions</b></td>
                  <td>'.$instructions.'</td>
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
            <p>Your request for Group show has been successfull sent to '.$model_name.'.</p>
            <p>We will inform you when she will accept your request. </p>
            </div>
            </body>
           </html>';

          if (mail($email_to, $subject, $message, $header) && mail($email_to1, $subject1, $message1, $header1)) {
            echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
            echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$model_id.'"</script>';
          }else{
            echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
            echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$model_id.'"</script>';
          }
        
      }
      else{
        echo '<script>alert("You have Not Registered")</script>';
        echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$model_id.'"</script>';
      }
    }else{
      echo '<script>alert("Oops!! You dont have coins for using these service")</script>';
      echo '<script>window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$model_id.'"</script>';
    } 
  }
?>