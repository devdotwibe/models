<?php
  session_start();

  include('../includes/config.php');

  if (isset($_POST["submit_pic"])) {

    $log_user_id = $_POST['u_id'];
    
    // $target_dir_profile = "../uploads/profile_pic/";
    // $target_file1 = $target_dir_profile . basename($_FILES["profile_pic"]["name"]);
    // $target_profile = "uploads/profile_pic/" . basename($_FILES["profile_pic"]["name"]);
    
    $target_dir_banner = "../uploads/banner_pic/";
    $target_file2 = $target_dir_banner . basename($_FILES["banner_pic"]["name"]);
    $target_banner = "uploads/banner_pic/" . basename($_FILES["banner_pic"]["name"]);


    if (move_uploaded_file($_FILES["banner_pic"]["tmp_name"], $target_file2)){
        //echo '<script>alert("File Successfully Uploaded.")</script>';

        $que = "INSERT INTO `model_dp_banner`(`unique_model_id`, `model_banner_pic`) VALUES ('".$log_user_id."','".$target_banner."')";
   
        if(mysqli_query($con,$que)){

              echo '<script>alert("Your images Successfully Added.")
          window.location="images.php"</script>';
      
        }else {
          echo '<script>alert("Oops! Found some Error in image Addition.")
          window.location="images.php"</script>';
        }
    
      }else{
        echo '<script>alert("Oops! Found some Error in image uploading.")
          window.location="images.php"</script>';
      }
  }
?>