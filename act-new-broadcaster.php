<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
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
     $d_a_address = $_POST["d_a_address"];
     $d_a_service = $_POST["d_a_service"];
	 if($d_a_service){
	     $d_a_service = implode(',',$d_a_service);
	 }
	 else{
	     $d_a_service = '';
	 }

     $inter_tour = $_POST["inter_tour"];
/*     $to_hour = $_POST["to_hour"];
     $for_hour = $_POST["for_hour"];
     $overnight = $_POST["overnight"];*/

     $to_hour = $for_hour = $overnight =0;
	 $i_t_day = $_POST['i_t_day'];
	 $i_t_week = $_POST['i_t_week'];
	 $i_t_month = $_POST['i_t_month'];
	 $i_t_annual = $_POST['i_t_annual'];
	 if($_POST['i_t_schedule']){
		 $i_t_schedule = implode(',',$_POST['i_t_schedule']);
	 }
	 else{
		 $i_t_schedule = '';
	 }
	 if($_POST['i_t_country']){
		 $i_t_country = implode(',',$_POST['i_t_country']);
	 }
	 else{
		 $i_t_country = '';
	 }
    
     $s_v_p = $_POST["s_v_p"];
     $modeling_porn_assignment = $_POST["modeling_porn_assignment"];
//     $perhourshoot = $_POST["perhourshoot"];
     $perhourshoot = '';
 
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
//printR($_SESSION);

//printR($_POST['time_schedule']);
DB::delete('model_user_group_show', 'user_id=%s', $_SESSION['log_user_id']);
if($group_show=='Yes'){
     $group_show_option = $_POST['group_show_option'];
	//$group_show_option = $_POST['options_data'];
	if($group_show_option){
		foreach($group_show_option as $val){
               $p_data = array(
                         'user_id'	=> $_SESSION['log_user_id'],
                         'dates'	=> h_dateFormat($val['dates'],'Y-m-d'),
                         'times'	=> $val['times'],
                         'amount'	=> $val['amount'],
               );
               DB::insert('model_user_group_show', $p_data);
		}
	}
}

DB::delete('model_user_dating_time', 'user_id=%s', $_SESSION['log_user_id']);
if($w_aa_es=='Yes'){
	$time_schedule = $_POST['time_schedule'];
	if($time_schedule){
		foreach($time_schedule as $set_time_schedule){
			if(isset($set_time_schedule['week'])){
				$p_data = array(
						'user_id'	=> $_SESSION['log_user_id'],
						'week_name'	=> $set_time_schedule['week'],
						'f_time'	=> $set_time_schedule['from'],
						't_time'	=> $set_time_schedule['to'],
				);
				DB::insert('model_user_dating_time', $p_data);
			}
		}
	}
}

if($_POST['m_a_available']){ $m_a_available = implode(',',$_POST['m_a_available']);}
else{  $m_a_available = '';}
if($_POST['m_a_interested']){ $m_a_interested = implode(',',$_POST['m_a_interested']);}
else{  $m_a_interested = '';}
if($_POST['m_a_comfortable_camera']){ $m_a_comfortable_camera = implode(',',$_POST['m_a_comfortable_camera']);}
else{  $m_a_comfortable_camera = '';}

if($_POST['m_a_service']){ $m_a_service = implode(',',$_POST['m_a_service']);}
else{  $m_a_service = '';}

$m_a_paid = $_POST['m_a_paid'];
$m_a_payout =$perhourshoot= $_POST['m_a_payout'];

if (move_uploaded_file($_FILES["govt_id"]["tmp_name"], $target_file)){
$que = "INSERT INTO `model_extra_details`(`unique_model_id`, `live_cam`, `insta_p_url`, `insta_tokens`, `snap_p_url`, `snap_tokens`,`group_show`, 
`gs_min_member`, `gs_token_price`, `work_escort`, `in_per_hour`, `in_overnight`, `out_per_hour`, `out_overnight`,`d_a_address`,`d_a_service`, 
`International_tours`, `two_hour_rates`, `four_hour_rates`, `nght_rates`, 
`i_t_day`,`i_t_week`,`i_t_month`,`i_t_annual`,`i_t_schedule`,`i_t_country`,
`video_pictures`, `modeling_porn_assignment`, `shoot_per_hour_price`,
`m_a_available`,`m_a_interested`,`m_a_comfortable_camera`,`m_a_paid`,`m_a_service`,`m_a_payout`,
`govt_id_proof`, `choose_document`, `bust_size`, `cup_size`, `waist_size`, `ethnicity`, `height`, `weight`, 
`eye_color`, `hair_color`) 
VALUES ('".$log_user_id."','".$live_cam."','".$insta_p_url."','".$insta_tokens."','".$snap_p_url."','".$snap_tokens."','".$group_show."',
'".$min_member."','".$t_price_member."','".$w_aa_es."','".$in_per_hour."','".$in_overnight."','".$out_per_hour."','".$out_overnight."','".$d_a_address."','".$d_a_service."',
'".$inter_tour."','".$to_hour."','".$for_hour."','".$overnight."',
'".$i_t_day."','".$i_t_week."','".$i_t_month."','".$i_t_annual."','".$i_t_schedule."','".$i_t_country."',

'".$s_v_p."','".$modeling_porn_assignment."','".$perhourshoot."',
'".$m_a_available."', '".$m_a_interested."', '".$m_a_comfortable_camera."', '".$m_a_paid."', '".$m_a_service."', '".$m_a_payout."',
'".$target_file."','".$choose_document."','".$bust_size."','".$cup_size."','".$waist_size."','".$ethnicity."','".$height."','".$weight."',
'".$eye_color."','".$hair_color."')";
        if(mysqli_query($con,$que)){
          echo '<script>alert("Your Details Successfully Added.")
          window.location="new-broadcaster.php"</script>';
        }else {
          echo '<script>alert("Oops! Fund some Error in Details Addition.")
                  window.location="new-broadcaster.php"</script>';
		}
    }
}

