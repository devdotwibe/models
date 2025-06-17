<?php
session_start();
include('../includes/config.php');
if (isset($_POST["submitButton"])) {
    // echo "ok";
     $log_user_id = $_SESSION["log_user_unique_id"];
    
    $model_id = $_POST["model_id"];
    $i_username = $_POST["i_username"];
    $i_plink = $_POST["i_plink"];
    $s_username = $_POST["s_username"];
    $s_plink = $_POST["s_plink"];

    $que = "INSERT INTO `model_social_link`(`unique_model_id`, `i_username`, `i_plink`, `s_username`, `s_plink`) VALUES ('".$model_id."','".$i_username."','".$i_plink."','".$s_username."','".$s_plink."')";
 

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Your Details Successfully Added.")
      window.location="social-media.php"</script>';
      
         
    }else {
            echo '<script>alert("Oops! Fund some Error in Details Addition.")
              window.location="social-media.php"
              </script>';
          }
      
    }
?>  