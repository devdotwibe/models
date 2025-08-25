<?php 
    session_start(); 
	include('includes/config.php');
	include('includes/helper.php');


    if(isset($_GET['email']) && isset($_GET['token'])){
        $email = mysqli_real_escape_string($con, $_GET['email']);
        $token = mysqli_real_escape_string($con, $_GET['token']);

        $sql = "SELECT * FROM model_user WHERE email='$email' AND verify_token='$token' AND verified=0 LIMIT 1";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) == 1){
            $update = "UPDATE model_user SET verified=1 WHERE email='$email'";
            if(mysqli_query($con, $update)){
                echo "<h2>Email Verified Successfully. You can now <a href='" . SITEURL . "/login.php'>Login</a></h2>";
            }
        } else {
            echo "<h2>Invalid or Expired Verification Link.</h2>";
        }
    } else {
        echo "<h2>Invalid Request.</h2>";
    }
?>
