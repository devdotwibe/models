<?php
  // echo 'Hello';
  session_start();
  include('../includes/config.php');
  if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $model_name = $_POST['model_name'];
    $model_id = $_POST['model_id'];
    $duration = $_POST['duration'];
    $meeting_date = $_POST['meeting_date'];
    $meeting_time_hour = $_POST['meeting_time_hour'];
    $meeting_time_min = $_POST['meeting_time_min'];
    $ampm = $_POST['ampm'];
    $instructions = $_POST['instructions'];

    $que = "INSERT INTO `booking_live` (`name`, `phone`, `email`, `age`, `model_name`, `model_unique_id`, `duration`, `meeting_date`, `meeting_time_hour`, `meeting_time_min`, `ampm`, `instructions`) VALUES ('".$name."', '".$phone."', '".$email."', '".$age."', '".$model_name."', '".$model_id."', '".$duration."', '".$meeting_date."', '".$meeting_time_hour."', '".$meeting_time_min."', '".$ampm."', '".$instructions."')";

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("You Booking has been Successfully Send to model.")</script>';
         $email_to = $email;
         $subject = "Model booking for Live Call | The Live Model";

         $header = "From: The live Model <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%; ">
            <center>
              <img width="100" border="0" style="display: block; width: 100px;" src="https://thelivemodels.com/uploads/live-model-logo.png" alt="" />
              </center>
          </div>
          <div style="padding: 20px;">

          <h2>Dear Model, </h2>
          <p>You have got one live call from user please check their details:
            <table style="width:100%">
              <tr>
                <td><b>Name</b></td>
                <td>'.$name.'</td>
              </tr>
              <tr>
                <td><b>Phone</b></td>
                <td>'.$phone.'</td>
              </tr>
              <tr>
                <td><b>Email</b></td>
                <td>'.$email.'</td>
              </tr>
              <tr>
                <td><b>Age</b></td>
                <td>'.$age.'</td>
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

        if (mail($email_to, $subject, $message, $header)) {
          echo '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
          echo '<script>window.location="https://thelivemodels.com/"</script>';
        }else{
          echo '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
          echo '<script>window.location="https://thelivemodels.com/"</script>';
        }
    }
    else{
      echo '<script>alert("You have Not Registered")</script>';
      echo '<script>window.location="https://thelivemodels.com/"</script>';
    }
  }
?>