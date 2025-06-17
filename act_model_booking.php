<?php

include('includes/config.php');
if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $age = $_POST['age'];
   $model_name = $_POST['model_name'];
   $duration = $_POST['duration'];
   $meeting_date = $_POST['meeting_date'];
   $meeting_time = $_POST['meeting_time'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $zip_code = $_POST['zip_code'];
   $country = $_POST['country'];
   $instructions = $_POST['instructions'];

 	$que = "INSERT INTO `model_booking` (`name`, `phone`, `email`, `age`, `model_name`,`duration`,`meeting_date`,`meeting_time`,`address`,`city`,`state`,`zip_code`,`country`,`instructions`) VALUES ('".$name."', '".$phone."', '".$email."', '".$age."', '".$model_name."', '".$duration."', '".$meeting_date."','".$meeting_time."','".$address."','".$city."','".$state."','".$zip_code."','".$country."','".$instructions."')";

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Boking Successfully")</script>';
      
      	 $email_to = 'akashsystos@gmail.com';
         $subject = "Booking Details From The Live Model";

         $header = "From: Model Project <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;height: 500px;">
            <img src="https://thelivemodels.com/assets/wp-content/themes/theagency3/images/default-bg.jpg" style="width: 100%;height: 100%;">
          </div>
          <div style="padding: 20px;">
          <h2>Dear '.$name.', </h2>
          <p>Please check your details:
            <table style="width:100%">
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
			    <td><b>Model Name</b></td>
			    <td>'.$model_name.'</td>
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
          <td>'.$meeting_time.'</td>
        </tr>
         <tr>
          <td><b>Address</b></td>
          <td>'.$address.'</td>
        </tr>
         <tr>
          <td><b>City</b></td>
          <td>'.$city.'</td>
        </tr>
         <tr>
          <td><b>State</b></td>
          <td>'.$state.'</td>
        </tr>
			  <tr>
			    <td><b>Zip Code</b></td>
			    <td>'.$zip_code.'</td>
			  </tr>
         <tr>
          <td><b>Country</b></td>
          <td>'.$country.'</td>
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
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }

    }
    else{
      echo '<script>alert("You have Not Booked")</script>';
      echo '<script>window.location="booking.php"</script>';
    }

 
}
?>