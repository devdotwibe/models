<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$table_name = "countries";
$output = array();
$country = $_GET['country'];
$option = $_GET['option'];
$country_list = DB::query('select id,name,sortname from countries order by name asc');
$html = '';
if($option){
	$html .='<option value="'.$option.'">'.$option.'</option>';
}
if($country_list){
	foreach($country_list as $set_country){
		$selected = '';
		if($country==$set_country['id']||$country==$set_country['sortname']){
				$selected = 'selected';
		}
		$html .='<option value="'.$set_country['id'].'" '.$selected.'>'.$set_country['name'].'</option>';
	}
}
$output['list']= $html;
echo json_encode($output);
?>
