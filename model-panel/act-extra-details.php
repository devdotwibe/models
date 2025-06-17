<?php
session_start();
include('../includes/config.php');
if (isset($_POST["submitButton"])) {

    $log_user_id = $_SESSION["log_user_unique_id"];
    $live_cam = $_POST["live_cam"];

    $insta_p_url = $_POST["insta_p_url"];
    $insta_tokens = $_POST["insta_tokens"];
    $snap_p_url = $_POST["snap_p_url"];
    $snap_tokens = $_POST["snap_tokens"];

    $group_show = $_POST["group_show"];
    $min_member = $_POST["min_member"];
    $t_price_member = $_POST["t_price_member"];
    $inter_tour = $_POST["inter_tour"];
    $to_hour = $_POST["to_hour"];
    $for_hour = $_POST["for_hour"];
    $overnight = $_POST["overnight"];
    $modeling_porn_assignment = $_POST["modeling_porn_assignment"];
    $perhourshoot = $_POST["perhourshoot"];

    $que = "INSERT INTO `model_extra_details`(`unique_model_id`, `live_cam`, `insta_p_url`, `insta_tokens`, `snap_p_url`, `snap_tokens`, `group_show`, `gs_min_member`, `gs_token_price`, `International_tours`, `two_hour_rates`, `four_hour_rates`, `nght_rates`, `modeling_porn_assignment`, `shoot_per_hour_price`) VALUES ('".$log_user_id."','".$live_cam."','".$insta_p_url."','".$insta_tokens."','".$snap_p_url."','".$snap_tokens."','".$group_show."','".$min_member."','".$t_price_member."','".$inter_tour."','".$to_hour."','".$for_hour."','".$overnight."','".$modeling_porn_assignment."','".$perhourshoot."')";
 

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Your Details Successfully Added.")
      window.location="extra-details.php"</script>';
      
         
    }else {
      echo '<script>alert("Oops! Fund some Error in Details Addition.")
              window.location="extra-details.php"</script>';
          }
      
    }
?>