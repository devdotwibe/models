<?php
  include('includes/config.php');

    if ($_POST['submit_name']) {
      
      $user_id = $_POST['use_id'];
      $name = $_POST['name'];
      $country = $_POST['country'];
      $city = $_POST['city'];
      $gender = $_POST['gender'];

    $sql = "UPDATE model_user SET name = '".$name."', country = '".$country."',  city = '".$city."',  gender = '".$gender."'  WHERE id = '".$user_id."'";

      if(mysqli_query($con,$sql)){
     
          echo '<script>alert("Your Profile Successfully Updated");
           window.location="edit-profile.php"
          </script>';
      }
      else{
          echo '<script>alert("Your Profile Not Updated");
           window.location="edit-profile.php"
          </script>';
      }

    }else if(isset($_POST['submit_pass'])){

      $user_id = $_POST['use_id'];
      $name = $_POST['name'];
      $country = $_POST['country'];
      $current_pass = $_POST['current_pass'];
      $new_password = $_POST['new_password'];
      $confirm_pass = $_POST['confirm_pass'];


        $select = "SELECT * FROM model_user WHERE id = '".$user_id."'";
        $result = mysqli_query($con, $select);
        if(mysqli_num_rows($result) > 0){
          $row1 = mysqli_fetch_array($result);
             $password = $row1['password']; 
        }

        if($password == $current_pass){
              
        if($confirm_pass == $new_password){

          $sql = "UPDATE model_user SET password = '".$new_password."' WHERE id = '".$user_id."'";
        
          if(mysqli_query($con, $sql)){
            echo '<script>alert("Your Password Successfully Updated");
             window.location="edit-profile.php"
            </script>';
          }else{
            echo '<script>alert("Your Password Not Updated");
             window.location="edit-profile.php"
            </script>';
          }  
        
        }else{

            echo '<script>alert("Password and confirm password Doesnt match");
              window.location="edit-profile.php"
            </script>'; 
        }
            
        }else{
            echo '<script>alert("This Password is not in our Records");
                window.location="edit-profile.php"
              </script>';
        }
    }else if(isset($_POST['submit_image'])){

     // $user_id = $_POST['pic_img'];
      $use_id = $_POST['use_id'];

      $target_dir_profile = "uploads/profile_pic/";
      $target_file1 = $target_dir_profile . basename($_FILES["pic_img"]["name"]);
      $target_profile = "uploads/profile_pic/" . basename($_FILES["pic_img"]["name"]);

      if (move_uploaded_file($_FILES["pic_img"]["tmp_name"], $target_file1)){

          echo '<script>alert("Your Profile Picture Successfully Uploaded");</script>';

          $sql = "UPDATE model_user SET profile_pic = '".$target_profile."' WHERE id = '".$use_id."'";
        
          if(mysqli_query($con, $sql)){
            echo '<script>alert("Your Profile Picture Successfully Updated");
             window.location="edit-profile.php"</script>';
          }else{
            echo '<script>alert("Profile Picture Not Updated.\nPlease try again later.");
             window.location="edit-profile.php"</script>';
          }  

      }else{
          echo '<script>alert("Error in Image uploading");
             window.location="edit-profile.php"
            </script>';
      }
        
        
    }
 
?>