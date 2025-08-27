<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();

$upl_name = $_GET['upl_name'];
$adv_id = $_GET['adv_id'];
$adv_type = $_GET['adv_type'];

	if(!empty($upl_name) && !empty($adv_id)){

		$form_data = DB::queryFirstRow("select image,additionalimages,video from banners where id='" . $adv_id . "' and user_id='" . $_SESSION['log_user_id'] . "' ");

		if($adv_type == 'video'){

			if(!empty($form_data['video']) ){

				$video = explode('|',$form_data['video']);

				$additional_vd = '';

				$image = '';

				foreach($video as $add_vd){	

					$image = $add_vd;

					if($add_vd != $upl_name){

						$additional_vd .= $add_vd.'|';
					}
				}

				$joe_id = DB::update('banners', array('video' => rtrim($additional_vd, "|")), "id=%s", $adv_id);
				
			 	$output['status'] = 'success';

			}
			}else if($adv_type == 'image'){
				
			}
			else
			{
				$output['status']  = 'error';
				$output['message'] = 'Invalid type or no data found';
			}
		
	}

	else {

		   $output['status']  = 'error';
           $output['message'] = 'Banner not found';

	}

echo json_encode($output);
?>