<?php 
    session_start(); 
	include('includes/config.php');
	include('includes/helper.php');

?>
<style type="text/css">
        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
        }
        
        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        
        span.preheader {
            display: none;
            font-size: 1px;
        }
        
        html {
            width: 100%;
        }
        
        table {
            font-size: 14px;
            border: 0;
        }
        /* ----------- responsivity ----------- */
        
        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
            /*----- main image -------*/
            .main-image img {
                width: 440px !important;
                height: auto !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 320px !important;
                height: auto !important;
            }
            .team-img img {
                width: 100% !important;
                height: auto !important;
            }
        }
        
        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;
            }
            .main-section-header {
                font-size: 26px !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 280px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 280px !important;
            }
            .container590 {
                width: 280px !important;
            }
            .container580 {
                width: 260px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 280px !important;
                height: auto !important;
            }
        }
    </style>
<?php 


  

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

  $token = md5(uniqid(rand(), true)); 

  $sql_u = "SELECT * FROM model_user WHERE username='$user_name'"; 
    $sql_e = "SELECT * FROM model_user WHERE email='$email'"; 
    $res_u = mysqli_query($con, $sql_u);
    $res_e = mysqli_query($con, $sql_e); 
   if (mysqli_num_rows($res_u) > 0) { 

        // echo  '<script>alert("Sorry... username already taken")</script>';

        echo '<script>window.location="login.php?register=success"</script>';

    }else if(mysqli_num_rows($res_e) > 0){

      echo  '<script>alert("Sorry... email already taken")</script>';
      
                echo '<script>window.location="login.php"</script>';  
    }else{

   
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);


 	// $que = "INSERT INTO `model_user` (`unique_id`, `name`, `username`, `email`, `password`, `country`,`gender`,`as_a_model`,`user_bio`,`services`) 
	// VALUES ('".$uni_id."', '".$name."', '".$user_name."', '".$email."', '".$password_hashed."', '".$country."', '".$gender."', '".$as_a_model."', '".$user_bio."', '".$services."')";

    $que = "INSERT INTO `model_user` (`unique_id`, `name`, `username`, `email`, `password`, `country`,`gender`,`user_bio`,`services`,`verified`,`verify_token`) 

	VALUES ('".$uni_id."', '".$name."', '".$user_name."', '".$email."', '".$password_hashed."', '".$country."', '".$gender."','".$user_bio."', '".$services."', 0, '".$token."')";


    if(mysqli_query($con,$que)){
      
      	 $email_to = $email;

         $subject = "Mail Verification for Model Project";

        $header = "From: Model Project <prashant.systos@gmail.com>\r\n";
        $header .= "MIME-version:1.0\r\n";
        $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $verify_link = "https://models.staging3.dotwibe.com/verify.php?email=".$email."&token=".$token;


         $htmlContent = file_get_contents("mail/email_verfiy.php");

          $message = str_replace("{{VERIFY_LINK}}", $verify_link, $htmlContent);

        //  $message = $htmlContent;

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

 } 
/*}else{
 	echo '<script>alert("Oops!! Password and Confirm Password Not Same.");</script>';
  echo '<script>window.location="register.php"</script>';
 }*/
  
 
}
?>