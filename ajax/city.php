<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$table_name = "countries";
$output = array();
$state = $_GET['state'];
$selected = $_GET['selected'];
$option = $_GET['option'];
$get_list = DB::query('select id,name from cities where state_id="'.$state.'" order by name asc');
$html = '';
if($option){
	$html .='<option value="'.$option.'">'.$option.'</option>';
}
if($get_list){
	foreach($get_list as $set_country){
		$selectedTxt = '';
		if($selected==$set_country['id']){
				$selectedTxt = 'selected';
		}
		$html .='<option value="'.$set_country['id'].'" '.$selectedTxt.'>'.$set_country['name'].'</option>';
	}
}
$output['list']= $html;
echo json_encode($output);
?>
