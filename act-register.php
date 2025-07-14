<?php 

//include('includes/config.php');
if (isset($_POST['vfb-submit'])) {

   $user_name = $_POST['username'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $country = $_POST['country'];
   $password = $_POST['password'];
   // $c_pasword = $_POST['c_password'];
   $gender = $_POST['gender'];
   $services = $_POST['services'];
   $user_bio = $_POST['user_bio'];
    $rdm = rand(10000,99999);
    $uni_id = 'model-'.$rdm;
	
	$user_type = $_POST['user_type'];
	$as_a_model = 'No';
	if($user_type == 'model'){
		$as_a_model = 'Yes';
	}else{
		$as_a_model = 'No';
	}

 //if($password == $c_pasword){

  /*   $sql_u = "SELECT * FROM model_user WHERE username='$user_name'";
    $sql_e = "SELECT * FROM model_user WHERE email='$email'";
    $res_u = mysqli_query($con, $sql_u);
    $res_e = mysqli_query($con, $sql_e);
   if (mysqli_num_rows($res_u) > 0) { 
        echo  '<script>alert("Sorry... username already taken")</script>';
                echo '<script>window.location="login.php"</script>';
    }else if(mysqli_num_rows($res_e) > 0){
      echo  '<script>alert("Sorry... email already taken")</script>';
                echo '<script>window.location="login.php"</script>';  
    }else{

 	$que = "INSERT INTO `model_user` (`unique_id`, `name`, `username`, `email`, `password`, `country`,`gender`,`as_a_model`,`user_bio`,`services`) 
	VALUES ('".$uni_id."', '".$name."', '".$user_name."', '".$email."', '".$password."', '".$country."', '".$gender."', '".$as_a_model."', '".$user_bio."', '".$services."')";

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("You have Successfully Registered")</script>';
      
      	 $email_to = $email;
         $subject = "Mail Verification for Model Project";

         $header = "From: Model Project <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         $htmlContent = file_get_contents("mail/registration-mail.php");
         $message = $htmlContent;

         if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }

    }
    else{
      echo '<script>alert("You have Not Registered")</script>';
      echo '<script>window.location="register.php"</script>';
    }

 } */
/*}else{
 	echo '<script>alert("Oops!! Password and Confirm Password Not Same.");</script>';
  echo '<script>window.location="register.php"</script>';
 }*/
  
 
}
?>