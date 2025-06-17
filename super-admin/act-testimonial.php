<?php
session_start();
include('includes/config.php');
if (isset($_POST['save_test'])) { 

  $test_name = $_POST['test_name'];
  $test_description = $_POST['test_description'];
  $target_dir = "../uploads/testimonial-img/";
  $target_dir1 = "uploads/testimonial-img/";

  $target_file = $target_dir . basename($_FILES["test_img"]["name"]);
  $target_file1 = $target_dir1 . basename($_FILES["test_img"]["name"]);

  if (move_uploaded_file($_FILES["test_img"]["tmp_name"], $target_file)) {

    echo "<script>alert('Status: Image Successfully Uploaded')</script>";

    $que = "INSERT INTO `testimonials`(`testmonial_name`, `testmonial_description`, `testmonial_image`) VALUES ('".$test_name."','".$test_description."','".$target_file1."')";
 
    if(mysqli_query($con, $que)){

       echo '<script>alert("Testimonail Successfully Added");
        window.location="add-testimonials.php"</script>';
      }
      else{
       echo '<script>alert("Oops! Found some error in Testimonail Addition.");
         window.location="add-testimonials.php"</script>';
      }
  
    } else {
        echo '<script>alert("Oops! Error in file uploading.");
        window.location="add-testimonials.php";</script>';
    }

}
if (isset($_POST['del_test'])) { 
    
  $id = $_POST['id'];
  $que1 = "DELETE FROM `testimonials` WHERE id = '".$id."'";
 
  if(mysqli_query($con, $que1)){
      echo '<script>alert("Testimonail Successfully Deleted");
        window.location="add-testimonials.php"</script>';
  }else{
   echo '<script>alert("Oops! Found some error in Testimonail Deletion.");
     window.location="add-testimonials.php"</script>';
  }
  
  
}
?>