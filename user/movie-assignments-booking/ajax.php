<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');
$m_link= SITEURL.'movie-assignments-booking/';

$table_name = "booking_movie_assignments";
$perPage = 20;
$output = array();
$output['result']= 'ok';
if(isset($_SESSION['log_user_id'])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){
	$output['total'] = 0;
	$where_clause = '';
	$perPage =10;

	$list_data = $perPage;
	$page = $_GET['page'];
	if(!$page){
		$page_number =1;
		$offset = 0;
	}else{
		$offset = $page*$perPage-$perPage;
		$page_number = $page;
	}
	$list_data = $perPage;
	

	$name = $_GET['q'];
	if($name){
		$url .= 'q='.$name.'&';
		$where_clause .= " (lower(name) like '%".strtolower($name)."%' ) and";
	}

	$sort_by = ' ORDER BY tb.id desc ';
	$sort_column = $_GET['sort_column'];
	$sort_type = $_GET['sort_type'];

$stringQuery = "SELECT tb.*,mu.username,mu.profile_pic,mu.id as userid FROM ".$table_name." tb 
join model_user mu on mu.unique_id = tb.model_unique_id
where unique_user_id='".$userDetails['unique_id']."' ";

	$limited = " limit $offset, ".$perPage;
	$where_clause = rtrim($where_clause,'and');
	if($where_clause){
		$all_data = DB::query($stringQuery." and ".$where_clause." ".$sort_by.$limited);
		$total = $output['total'] = DB::numRows($stringQuery." and ".$where_clause);
	}
	else{
		$all_data = DB::query($stringQuery." ".$sort_by.$limited);
		$total = $output['total'] = DB::numRows($stringQuery);
	}
	$output['total_page'] = (int) ceil($total/ $perPage);
	$output['page'] = $page_number;

	ob_start();
	include 'ajax_item.php';
	$html= ob_get_clean();

	$output['html'] = $html;
	$output['total_page'] = (int) ceil($total/ $perPage);
	$output['page'] = $page_number;
}
}
else{
}
echo json_encode($output);
?>
