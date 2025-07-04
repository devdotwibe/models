<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$table_name = "banners";
$output = array();
$output['result']= 'ok';
if(isset($_SESSION['log_user_id'])){
	$user_id = $_SESSION['log_user_id'];
	$output['total'] = 0;
	$where_clause = '';
	$perPage = $_GET['limit'];

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
	
	$name = '';
	if(isset($_GET['q'])){ $name = $_GET['q']; }
	if($name){
		$url .= 'q='.$name.'&';
		$where_clause .= " (lower(name) like '%".strtolower($name)."%' ) and";
	}

	$sort_by = ' ORDER BY tb.id desc ';
	//$sort_column = $_GET['sort_column'];
	//$sort_type = $_GET['sort_type'];
	$sort_column = '';
	$sort_type = '';
	if($sort_column){
		if($sort_column=='id'){$sort_by = ' ORDER BY tb.id '.$sort_type.' ';}
		else {$sort_by = ' ORDER BY lower(tb.'.$sort_column.') '.$sort_type.' ';}
		
	}
	$stringQuery = "SELECT * FROM ".$table_name." tb where user_id=".$user_id;

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
else{
}
echo json_encode($output);
?>
