<?php 
session_start(); 
include('../includes/config.php');
include('../includes/constant.php');
include('../../includes/helper.php');
include('../includes/auth.php');
//include('../../includes/helper.php');

$m_link= ADMINURL.'withdrawal/';
//printR($_SERVER);
$table_name = "users_withdrow_request";
$perPage = 20;
$output = array();
$output['result']= 'ok';

$output['total'] = 0;
$where_clause = '';

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

$stringQuery = "SELECT tb.*,mu.username FROM ".$table_name." tb 
 left join model_user mu on mu.id=tb.user_id ";

	$limited = " limit $offset, ".$perPage;
	$where_clause = rtrim($where_clause,'and');
	if($where_clause){
		$all_data = DB::query($stringQuery." where ".$where_clause." ".$sort_by.$limited);
		$total = $output['total'] = DB::numRows($stringQuery." where ".$where_clause);
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

echo json_encode($output);
?>
