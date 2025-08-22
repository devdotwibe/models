	
<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');

      $use_id = $_SESSION["log_user_id"];

      $target_dir_profile = "uploads/profile_pic/"; 


	  if (isset($_FILES["pic_img"]) && !empty($_FILES["pic_img"]['name'])) {


        $target_file1 = $target_dir_profile . basename($_FILES["pic_img"]["name"]);

        $target_profile = "uploads/profile_pic/" . basename($_FILES["pic_img"]["name"]);

                if (move_uploaded_file($_FILES["pic_img"]["tmp_name"], $target_file1)){

                    $sql = "UPDATE model_user SET profile_pic = '".$target_profile."' WHERE id = '".$use_id."'";
                
                    if(mysqli_query($con, $sql)){
        
                         echo json_encode(['status' => 'success']);
                         
                    }else{
            
                        echo json_encode(['status' => 'success']);
                    }  
                }
      }

     echo json_encode(['status' => 'Sorry, there was an error uploading your file.']);
?>