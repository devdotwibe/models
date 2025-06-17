<?php
session_start();
include('../includes/config.php');

if (isset($_POST['upload_image'])) {

  if($_POST['file_type'] === 'Image'){

    $m_uni_id = $_POST['m_uni_id'];
    $file_type = $_POST['file_type'];
    $img_text = $_POST['img_text'];
    $file_type_price = $_POST['file_type_price'];
    $coins = $_POST['coins'];
    $category = $_POST['category'];
      
    $target_dir_photo = "../uploads/casting/all-images/";
    $img_unique_id = $_SESSION["log_user"].rand(10000,99999);

    $target_file1 = $target_dir_photo . basename($_FILES["filess"]["name"]);
    $target_file = "uploads/casting/all-images/" . basename($_FILES["filess"]["name"]);
  
  
  if (move_uploaded_file($_FILES["filess"]["tmp_name"], $target_file1)) {

    //echo "<script>alert('Status: Photo Successfully Uploaded')</script>";

       $que = "INSERT INTO `model_images` (`unique_model_id`, `unique_image_id`, `file_type`, `file`, `image_text`, `img_type_price`, `coins`, `category`) 
                VALUES ('".$m_uni_id."', '".$img_unique_id."', '".$file_type."', '".$target_file."', '".$img_text."', '".$file_type_price."', '".$coins."', '".$category."');";
  
      if(mysqli_query($con,$que)){
        echo  '<script>alert("Image Addedd Successfully")</script>';
        if ($_POST['foote_val'] == 1) {
          echo '<script>window.location="single-profile.php?m_unique_id='.$m_uni_id.'"</script>';
        }else{
          echo '<script>window.location="images.php"</script>';
        }
      }
      else{
        echo  '<script>alert("Error in Image Addedd")</script>';
        echo  '<script>window.location="images.php"</script>';
      }
  
    } else {
        echo  "<script>alert('Sorry, there was an error uploading your File.')</script>";
        echo  '<script>window.location="images.php"</script>';
    }
  }else{

    $m_uni_id = $_POST['m_uni_id'];
    $file_type = $_POST['file_type'];
    $img_text = $_POST['img_text'];
    $file_type_price = $_POST['file_type_price'];
    $coins = $_POST['coins'];
    $category = $_POST['category'];
      
    $target_dir_photo = "../uploads/casting/all-videos/";

    $target_file1 = $target_dir_photo . basename($_FILES["filess"]["name"]);
    $target_file = "uploads/casting/all-videos/" . basename($_FILES["filess"]["name"]);
  
  
  if (move_uploaded_file($_FILES["filess"]["tmp_name"], $target_file1)) {

    //echo "<script>alert('Status: Photo Successfully Uploaded')</script>";

       $que = "INSERT INTO `model_images` (`unique_model_id`, `file_type`, `file`, `image_text`, `img_type_price`, `coins`, `category`) 
                VALUES ('".$m_uni_id."', '".$file_type."', '".$target_file."', '".$img_text."', '".$file_type_price."', '".$coins."', '".$category."');";
  
      if(mysqli_query($con,$que)){
        echo  '<script>alert("Video Addedd Successfully")</script>';
       echo  '<script>window.location="ingle-profile.php?m_unique_id='.$m_uni_id.'"</script>';
      }
      else{
       echo  '<script>alert("Error in Video Addedd")</script>';
         echo  '<script>window.location="ingle-profile.php?m_unique_id='.$m_uni_id.'"</script>';
      }
  
    } else {
        echo  "<script>alert('Sorry, there was an error uploading your File.')</script>";
        echo  '<script>window.location="ingle-profile.php?m_unique_id='.$m_uni_id.'"</script>';
    }

  }

}
?>