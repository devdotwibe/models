<?php
session_start();
include('../includes/config.php');
if (isset($_POST["submitButton"])) {

     $log_user_id = $_SESSION["log_user_unique_id"];

     $live_cam = $_POST["live_cam"];

     if($_POST["live_cam"] == 'No'){
      $insta_p_url = "";
       $insta_tokens = "";
       $snap_p_url = "";
       $snap_tokens = "";
     }else{
       $insta_p_url = $_POST["insta_p_url"];
       $insta_tokens = $_POST["insta_tokens"];
       $snap_p_url = $_POST["snap_p_url"];
       $snap_tokens = $_POST["snap_tokens"];
     }

     $group_show = $_POST["group_show"];

    if($_POST["group_show"] == 'No'){
      $min_member = "";
      $t_price_member = "";
    }else{
      $min_member = $_POST["min_member"];
      $t_price_member = $_POST["t_price_member"];  
    }
    
     $es_work = $_POST["es_work"];

    if($_POST["es_work"] == 'No'){
      $in_per_hour = "";
      $in_overnight = "";
      $out_overnight = "";
      $out_per_hour = "";
    }else{
      $in_per_hour = $_POST["in_per_hour"];
      $in_overnight = $_POST["in_overnight"];
      $out_overnight = $_POST["out_overnight"];
      $out_per_hour = $_POST["out_per_hour"];
    }

     $inter_tour = $_POST["inter_tour"];
    if($_POST["inter_tour"]== 'No'){
      $to_hour = "";
      $for_hour = "";
      $overnight = "";
    }else{
      $to_hour = $_POST["to_hour"];
      $for_hour = $_POST["for_hour"];
      $overnight = $_POST["overnight"];
    }

     $video_pictures = $_POST["video_pictures"];

     $modeling_porn_assignment = $_POST["modeling_porn_assignment"];

    if($_POST["modeling_porn_assignment"] == 'No'){
      $perhourshoot = "";
    }else{
      $perhourshoot = $_POST["perhourshoot"];
    }

    $all_access = $_POST["all_access"];
    if($_POST["all_access"] == 'No'){
      $all_access_price = "";
    }else{
      $all_access_price = $_POST["all_access_price"];
    }
   
    //echo $que = "UPDATE model_extra_details SET live_cam = '".$live_cam."', insta_p_url = '".$insta_p_url."', insta_tokens = '".$insta_tokens."', snap_p_url = '".$snap_p_url."', snap_tokens = '".$snap_tokens."', group_show = '".$group_show."', gs_min_member = '".$min_member."', gs_token_price = '".$t_price_member."', work_escort = '".$es_work."', ws_2hour = '".$ws_2hour."', ws_4hour = '".$ws_4hour."', ws_overnight ='".$ws_overnight."', International_tours = '".$inter_tour."', two_hour_rates = '".$to_hour."', four_hour_rates = '".$for_hour."', nght_rates = '".$overnight."', video_pictures = '".$video_pictures."', modeling_porn_assignment = '".$modeling_porn_assignment."', shoot_per_hour_price = '".$perhourshoot."' WHERE unique_model_id ='".$log_user_id."'";

     echo $que = "UPDATE `model_extra_details` SET `live_cam`='".$live_cam."',`insta_p_url`='".$insta_p_url."',`insta_tokens`='".$insta_tokens."',`snap_p_url`='".$snap_p_url."',`snap_tokens`='".$snap_tokens."',`group_show`='".$group_show."',`gs_min_member`='".$min_member."',`gs_token_price`='".$t_price_member."',`work_escort`='".$es_work."',`in_per_hour`='".$in_per_hour."',`in_overnight`='".$in_overnight."',`out_overnight`='".$out_overnight."',`out_per_hour`='".$out_per_hour."',`International_tours`='".$inter_tour."',`two_hour_rates`='".$to_hour."',`four_hour_rates`='".$for_hour."',`nght_rates`='".$overnight."',`video_pictures`='".$video_pictures."',`modeling_porn_assignment`='".$modeling_porn_assignment."',`shoot_per_hour_price`='".$perhourshoot."',`all_30day_access`='".$all_access."',`all_30day_access_price`='".$all_access_price."' WHERE unique_model_id ='".$log_user_id."'";
    

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Your Details Successfully Updated.")
      window.location="edit-extra-details.php"</script>';
      
         
    }else {
      echo '<script>alert("Oops! Fund some Error in Details Updation.")
              window.location="edit-extra-details.php"</script>';
          }
      
    }
?>