<?php
session_start();
include('includes/config.php');
if (isset($_POST["submit"])) {

     $log_user_id = $_SESSION["log_user_unique_id"];
     $choose_document = $_POST["choose_document"];
     $live_cam = $_POST["live_cam"];

     $insta_p_url = $_POST["insta_p_url"];
     $insta_tokens = $_POST["insta_tokens"];
     $snap_p_url = $_POST["snap_p_url"];
     $snap_tokens = $_POST["snap_tokens"];

     $group_show = $_POST["group_show"];
     $min_member = $_POST["min_member"];
     $t_price_member = $_POST["t_price_member"];

     $w_aa_es = $_POST["w_aa_es"];
     $in_per_hour = $_POST["in_per_hour"];
     $in_overnight = $_POST["in_overnight"];
     $out_per_hour = $_POST["out_per_hour"];
     $out_overnight = $_POST["out_overnight"];

     $inter_tour = $_POST["inter_tour"];
     $to_hour = $_POST["to_hour"];
     $for_hour = $_POST["for_hour"];
     $overnight = $_POST["overnight"];
    
     $s_v_p = $_POST["s_v_p"];
     $modeling_porn_assignment = $_POST["modeling_porn_assignment"];
     $perhourshoot = $_POST["perhourshoot"];
 
     $target_dir_document = "uploads/casting/document/";
     $target_file = $target_dir_document . basename($_FILES["govt_id"]["name"]);

     $bust_size = $_POST["bust-size"];
     $cup_size = $_POST["cup-size"];
     $waist_size = $_POST["waist-size"];
     $ethnicity = $_POST["ethnicity"];
     $height = $_POST["height"];
     $weight = $_POST["weight"];
     $eye_color = $_POST["eye-color"];
     $hair_color = $_POST["hair-color"];

    if (move_uploaded_file($_FILES["govt_id"]["tmp_name"], $target_file)){
        $que = "INSERT INTO `model_extra_details`(`unique_model_id`, `live_cam`, `insta_p_url`, `insta_tokens`, `snap_p_url`, `snap_tokens`,`group_show`, `gs_min_member`, `gs_token_price`, `work_escort`, `in_per_hour`, `in_overnight`, `out_per_hour`, `out_overnight`, `International_tours`, `two_hour_rates`, `four_hour_rates`, `nght_rates`, `video_pictures`, `modeling_porn_assignment`, `shoot_per_hour_price`, `govt_id_proof`, `choose_document`, `bust_size`, `cup_size`, `waist_size`, `ethnicity`, `height`, `weight`, `eye_color`, `hair_color`) VALUES ('".$log_user_id."','".$live_cam."','".$insta_p_url."','".$insta_tokens."','".$snap_p_url."','".$snap_tokens."','".$group_show."','".$min_member."','".$t_price_member."','".$w_aa_es."','".$in_per_hour."','".$in_overnight."','".$out_per_hour."','".$out_overnight."','".$inter_tour."','".$to_hour."','".$for_hour."','".$overnight."','".$s_v_p."','".$modeling_porn_assignment."','".$perhourshoot."','".$target_file."','".$choose_document."','".$bust_size."','".$cup_size."','".$waist_size."','".$ethnicity."','".$height."','".$weight."','".$eye_color."','".$hair_color."')";
     

        if(mysqli_query($con,$que)){
     
          echo '<script>alert("Your Details Successfully Added.")
          window.location="new-broadcaster.php"</script>';
          
             
        }else {
          echo '<script>alert("Oops! Fund some Error in Details Addition.")
                  window.location="new-broadcaster.php"</script>';
              }
    }
      
}
?>