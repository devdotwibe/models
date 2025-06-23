<?php
  include('includes/config.php');
  if(isset($_POST['vfb-submit'])){
    $userid = $_POST['username'];
    $password = $_POST['password'];

  //  echo '<script>alert("'.$userid.'");</script>';
    // echo '<script>alert("'.$password.'");</script>';

      
      $sql1 = "SELECT * FROM model_user WHERE username = '".$userid."' and password = '".$password."'";
      $result1 = mysqli_query($con,$sql1);

      if (mysqli_num_rows($result1) > 0) {

        $row1 = mysqli_fetch_assoc($result1);
         $user_id1 = $row1['id'];
         $user_name1 = $row1['username'];
         $unique_id = $row1['unique_id'];
         $email = $row1['email'];
         $city = $row1['city'];
         $user_type = 'User';
         if($row1['as_a_model'] == 'Yes'){
          $user_type = 'Model';
         }
         
          
          $sql = "SELECT * FROM model_dp_banner WHERE unique_model_id = '".$unique_id."'";
          $result = mysqli_query($con,$sql);

          if (mysqli_num_rows($result) > 0) {
            $row1 = mysqli_fetch_assoc($result);
             $model_profile_pic = $row1['model_profile_pic'];
          }

      }


      $count1 = mysqli_num_rows($result1);
      
      if($count1 == 1) {
        session_start();
         $_SESSION["log_user_id"] = $user_id1;
         $_SESSION["log_user"] = $user_name1;
         $_SESSION["log_user_unique_id"] = $unique_id;
         $_SESSION["log_user_email"] = $email;
         $_SESSION["log_user_pro_pic"] = $model_profile_pic;
         $_SESSION["user_type"] = $user_type;
         $_SESSION["city"] = $city;


         echo "<script> window.location.href = 'user/profile/index.php'; </script>";
      }else{
        echo "<script>alert('Incorrect Login Detail');
                 window.location='login.php'

        </script>";
      }
  }
?>