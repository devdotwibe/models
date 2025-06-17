<?php
	session_start();
  include('includes/config.php');

	if(isset($_POST['acceptprofile'])){

		 $uni_id = $_POST['uni_id'];
     $email = $_POST['email'];

	 	 $sql = "UPDATE model_extra_details SET status = 'Published' WHERE unique_model_id = '".$uni_id."'";
     $sql1 = "UPDATE model_user SET as_a_model = 'Yes' WHERE unique_id = '".$uni_id."'";

		if(mysqli_query($con,$sql) && mysqli_query($con,$sql1)){

			echo "<script>alert('Profile Accepted and Published Successfully');</script>";

          $sqls = "SELECT * FROM model_user WHERE unique_id = '".$_SESSION["log_user_unique_id"]."'";
          $resultd = mysqli_query($con, $sqls);
            if (mysqli_num_rows($resultd) > 0) {
              $rowesdw = mysqli_fetch_assoc($resultd);
          	  $name = $rowesdw['username'];
          }else{
          	  $name = $rowesdw['username'];;
          }


         $email_to = $email;
         $subject = "You Are Accepted as a Model";

         $header = "From: The Live Model <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         $htmlContent = file_get_contents("../mail/new-broadcaster-mail.php");
         $message = $htmlContent;

         if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="new_broadcasters.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="new_broadcasters.php"</script>';
         }
		}else{
			echo "<script>alert('Oops!! Error In Profile Accepted and Published');
                 window.location='new_broadcasters.php'

        </script>";
		}
	}

?>