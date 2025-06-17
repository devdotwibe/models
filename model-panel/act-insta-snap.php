<?php
session_start();
include('../includes/config.php');
if (isset($_POST["submit"])) {
    
    $model_id = $_POST["model_id"];
    $i_coins = $_POST["i_coins"]; 
    $s_coins = $_POST["s_coins"];
  
    $que = "INSERT INTO `insta_snap_coins`(`unique_model_id`, `insta_coins`, `snap_coins`) VALUES ('".$model_id."','".$i_coins."','".$s_coins."')";
 
    if(mysqli_query($con,$que)){
      echo '<script>alert("Your Details Successfully Added.")
      window.location="insta-snap.php"</script>';
    }else {
      echo '<script>alert("Oops! Fund some Error in Details Addition.")
        window.location="insta-snap.php"</script>';
    }  
  }
?>  