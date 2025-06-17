<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
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

     $d_a_address = $_POST["d_a_address"];
     $d_a_service = $_POST["d_a_service"];
	 if($d_a_service){
	     $d_a_service = implode(',',$d_a_service);
	 }
	 else{
	     $d_a_service = '';
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

   $i_t_day = $_POST['i_t_day'];
   $i_t_week = $_POST['i_t_week'];
   $i_t_month = $_POST['i_t_month'];
   $i_t_annual = $_POST['i_t_annual'];
   $i_t_schedule = implode(',',$_POST['i_t_schedule']);
   $i_t_country = implode(',',$_POST['i_t_country']);
   
   $lc_per_show_amount = $_POST['lc_per_show_amount'];
   $lc_private = $_POST['lc_private'];
   $lc_ownsite = $lc_platforms ='0';
  if($_POST['lc_ownsite']){
    $lc_ownsite ='1';
  }
  
  if($_POST['lc_platforms']){
    $lc_platforms ='1';
  }

     $video_pictures = $_POST["video_pictures"];

     $modeling_porn_assignment = $_POST["modeling_porn_assignment"];

    if($_POST["modeling_porn_assignment"] == 'No'){
      $perhourshoot = "";
    }else{
      $perhourshoot = $_POST["perhourshoot"];
    }

    $all_access = $_POST["all_access"];
    if($_POST["all_access"] == 'Yes'){
      $all_access_price = $_POST["all_access_price"];
    }else{
      $all_access_price = "";
    }

DB::delete('model_user_dating_time', 'user_id=%s', $_SESSION['log_user_id']);
if($es_work=='Yes'){
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

	
   
    //echo $que = "UPDATE model_extra_details SET live_cam = '".$live_cam."', insta_p_url = '".$insta_p_url."', insta_tokens = '".$insta_tokens."', snap_p_url = '".$snap_p_url."', snap_tokens = '".$snap_tokens."', group_show = '".$group_show."', gs_min_member = '".$min_member."', gs_token_price = '".$t_price_member."', work_escort = '".$es_work."', ws_2hour = '".$ws_2hour."', ws_4hour = '".$ws_4hour."', ws_overnight ='".$ws_overnight."', International_tours = '".$inter_tour."', two_hour_rates = '".$to_hour."', four_hour_rates = '".$for_hour."', nght_rates = '".$overnight."', video_pictures = '".$video_pictures."', modeling_porn_assignment = '".$modeling_porn_assignment."', shoot_per_hour_price = '".$perhourshoot."' WHERE unique_model_id ='".$log_user_id."'";

$que = "UPDATE `model_extra_details` SET `live_cam`='".$live_cam."',`insta_p_url`='".$insta_p_url."',`insta_tokens`='".$insta_tokens."',
`snap_p_url`='".$snap_p_url."',`snap_tokens`='".$snap_tokens."',
`group_show`='".$group_show."',`gs_min_member`='".$min_member."',`gs_token_price`='".$t_price_member."',`work_escort`='".$es_work."',
`in_per_hour`='".$in_per_hour."',`in_overnight`='".$in_overnight."',`out_overnight`='".$out_overnight."',`out_per_hour`='".$out_per_hour."',
`d_a_address`='".$d_a_address."',`d_a_service`='".$d_a_service."',
`International_tours`='".$inter_tour."',`two_hour_rates`='".$to_hour."',`four_hour_rates`='".$for_hour."',`nght_rates`='".$overnight."',
`i_t_day`='".$i_t_day."',`i_t_week`='".$i_t_week."',`i_t_month`='".$i_t_month."',
`i_t_annual`='".$i_t_annual."',`i_t_schedule`='".$i_t_schedule."',`i_t_country`='".$i_t_country."',
`video_pictures`='".$video_pictures."',`modeling_porn_assignment`='".$modeling_porn_assignment."',`shoot_per_hour_price`='".$perhourshoot."', 
`m_a_available`='".$m_a_available."',`m_a_interested`='".$m_a_interested."',
`m_a_comfortable_camera`='".$m_a_comfortable_camera."',`m_a_paid`='".$m_a_paid."',
`m_a_service`='".$m_a_service."',`m_a_payout`='".$m_a_payout."',
`lc_platforms`='".$lc_platforms."',`lc_ownsite`='".$lc_ownsite."',
`lc_per_show_amount`='".$lc_per_show_amount."',`lc_private`='".$lc_private."',

`all_30day_access`='".$all_access."',`all_30day_access_price`='".$all_access_price."'
WHERE unique_model_id ='".$log_user_id."'";
    

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Your Details Successfully Updated.")
      window.location="edit-extra-details.php"</script>';
      
         
    }else {
      echo '<script>alert("Oops! Fund some Error in Details Updation.")
              window.location="edit-extra-details.php"</script>';
          }
      
    }
?>