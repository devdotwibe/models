<?php

include('includes/config.php');
if (isset($_POST['submitButton'])) {

    $name = $_POST['rName'];
   $email = $_POST['rEmail'];
   $review_title = $_POST['rTitle'];
  // $rating = $_POST['whatever3'];
    $review_content  = $_POST['w3review'];
   
   $m_unique_id= $_POST['m_unique_id'];
   $m_id= $_POST['m_id'];
   $model= $_POST['model'];
        

	$que = "INSERT INTO `user_review` (`m_unique_id`, `name`,`email`, `review_title`, `review_content`) VALUES ('".$m_unique_id."', '".$name."', '".$email."', '".$review_title."','".$review_content."')";

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("You have Successfully Review")
      window.location="single-model.php?model='.$model.'&m_id='.$m_id.'&m_unique_id='.$m_unique_id.'"
      </script>';
      
      	 
    }else {
            echo '<script>alert("Error in Review")
              window.location="single-model.php?model='.$model.'&m_id='.$m_id.'&m_unique_id='.$m_unique_id.'"
              </script>';
          }
      
    }
?>