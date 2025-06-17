<?php
  session_start();

  include('includes/config.php');

  if (isset($_POST["submit_pic"])) {

    $log_user_id = $_POST['u_id'];
    
    $target_dir_banner = "uploads/banner_pic/";
    $target_file = $target_dir_banner . basename($_FILES["banner_pic"]["name"]);
    $target_banner = "uploads/banner_pic/" . basename($_FILES["banner_pic"]["name"]);


    if(move_uploaded_file($_FILES["banner_pic"]["tmp_name"], $target_file)){
        //echo '<script>alert("File Successfully Uploaded.")</script>';

        $que = "UPDATE `model_dp_banner` SET `model_banner_pic` = '".$target_banner."' WHERE `model_dp_banner`.`unique_model_id` = '".$log_user_id."';";
   
        if(mysqli_query($con,$que)){

              echo '<script>alert("Your images Successfully Added.")
          window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$log_user_id.'"</script>';
      
        }else {
          echo '<script>alert("Oops! Found some Error in image Addition.")
          window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$log_user_id.'"</script>';
        }
    
      }else{
        echo '<script>alert("Oops! Found some Error in image uploading.")
          window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$log_user_id.'"</script>';
      }
  }else if (isset($_POST["submit_profile_pic"])) {

    $log_user_id = $_POST['u_id'];
    
    $target_dir_banner = "uploads/profile_pic/";
    $target_file = $target_dir_banner . basename($_FILES["profile_img"]["name"]);
    $target_banner = "uploads/profile_pic/" . basename($_FILES["profile_img"]["name"]);


    if(move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file)){
        //echo '<script>alert("File Successfully Uploaded.")</script>';

        $que = "UPDATE `model_user` SET `profile_pic` = '".$target_banner."' WHERE `unique_id` = '".$log_user_id."';";
   
        if(mysqli_query($con,$que)){

              echo '<script>alert("Your images Successfully Added.")
          window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$log_user_id.'"</script>';
      
        }else {
          echo '<script>alert("Oops! Found some Error in image Addition.")
          window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$log_user_id.'"</script>';
        }
    
      }else{
        echo '<script>alert("Oops! Found some Error in image uploading.")
          window.location="https://thelivemodels.com/single-profile.php?m_unique_id='.$log_user_id.'"</script>';
      }
  }
?>