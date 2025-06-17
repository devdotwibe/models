<?php
	session_start();
	include('../includes/config.php');

	if (isset($_POST['delete_img'])) {

		$id = $_POST['id'];
		$unique_model_id = $_POST['unique_model_id'];

		$que = "DELETE FROM `model_images` WHERE id = '".$id."' AND unique_model_id = '".$unique_model_id."'";

		if(mysqli_query($con, $que)){
			echo  '<script>alert("Image Successfully Deleted")</script>';
			echo  '<script>window.location="images.php"</script>';
		}
		else{
			echo  '<script>alert("Error in Image Deletion")</script>';
			echo  '<script>window.location="images.php"</script>';
		} 
	}
?>