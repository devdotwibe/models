<?php
function adv_category_list(){
	/*$arr = array(
	'live cam girl', 'Group Cam girl', 'Escort', 
	'International Touring girl', 
	'Movies and Modeling', 'Sell Videos & Images');*/
	$arr = array(
	'Live streams',
	'Looking for Companion',
	'Travel Girls',
	'Movies and Modelling',
	'Content Ceator/Influencer',
	'Looking for a Serious Relationship',
	'Just Here to Make Friends',
	'Casual Dating Only',
	'Exploring New Connections',
	'Fitness or Hobby Partner',
	'Adult entertainmen');
	return $arr;
}

function modal_language_list(){
	$arr = array(
	'English',
	'Spanish',
	'French',
	'German',
	'Italian',
	'Portuguese',
	'Russian',
	'Chinese (Mandarin)',
	'Japanese',
	'Korean',
	'Arabic',
	'Hindi');
	return $arr;
	
}

function h_checkMessageShowBtn($modal_id,$user_id){
	$output = 0;
	$string ="select id from model_follow where 
	(unique_user_id='".$user_id."' and unique_model_id='".$modal_id."')
	or (unique_user_id='".$modal_id."' and unique_model_id='".$user_id."')";
	$form_data = DB::query($string);
	$output = DB::numRows();
	
	return $output;
}

function h_generate_model_id($user_id){
	while(true){
		$rdm = rand(10000,99999);
		$uni_id = 'model-'.$rdm;
		$form_data = DB::queryFirstRow("select id from model_user where unique_id='".$uni_id."' ");
		if(!$form_data){
			DB::update('model_user', array('unique_id'=>$uni_id), "id=%s", $user_id);
			return $uni_id;
		}
	}
}

function h_generate_username($string_name){
	while(true){
		$username = strtolower($string_name);
		$form_data = DB::queryFirstRow("select id from model_user where lower(username)='".$username."' ");
		if(!$form_data){
			return $username;
		}
		else{
			$r = preg_match_all("/.*?(\d+)$/", $string_name, $matches);
			if($r>0) {
				$string_name++;
			}
			else{
				$string_name = $string_name.'1';
			}
		}
	}
}
