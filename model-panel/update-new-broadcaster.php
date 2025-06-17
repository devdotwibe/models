<?php
session_start();
include('includes/config.php');
if (isset($_POST["submitButton"])) {
	   $log_user_id = $_SESSION["log_user_unique_id"];
	   $bust_size = $_POST["bust-size"];
     $cup_size = $_POST["cup-size"];
     $waist_size = $_POST["waist-size"];
     $ethnicity = $_POST["ethnicity"];
     $height = $_POST["height"];
     $weight = $_POST["weight"];
     $eye_color = $_POST["eye-color"];
     $hair_color = $_POST["hair-color"];

  $que = "UPDATE `model_extra_details` SET `bust_size`='".$bust_size."',`cup_size`='".$cup_size."',`waist_size`='".$waist_size."',`ethnicity`='".$ethnicity."',`height`='".$height."',`weight`='".$weight."',`eye_color`='".$eye_color."',`hair_color`='".$hair_color."' WHERE unique_model_id ='".$log_user_id."'";


    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Your Details Successfully Updated.")
      window.location="edit-extra-details.php"</script>';
      
         
    }else {
      echo '<script>alert("Oops! Fund some Error in Details Updation.")
              window.location="edit-extra-details.php"</script>';
          }
      
    }

 ?>