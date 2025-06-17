<?php
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$perPage = 20;
$output = array();
$output['result']= 'ok';
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

$sort_by = ' order by tb.is_paid desc, tb.id desc';
$sort_column = $_GET['sort_column'];
$sort_type = $_GET['sort_type'];

$stringQuery = " select tb.*,mu.age from banners tb
join model_user mu on mu.id=tb.user_id ";//where status

if($_GET['country']){
    $where_clause .= " tb.country='".$_GET['country']."' and";
}
if($_GET['category']){
    $where_clause .= " tb.category='".$_GET['category']."' and";
}
if($_GET['service']){
    $where_clause .= " tb.service='".$_GET['service']."' and";
}
if($_GET['state']){
    $where_clause .= " tb.state='".$_GET['state']."' and";
}
if($_GET['city']){
    $where_clause .= " tb.city='".$_GET['city']."' and";
}

$limited = " limit $offset, ".$perPage;
$where_clause = rtrim($where_clause,'and');
if($where_clause){
    //echo $stringQuery." where ".$where_clause." ".$sort_by.$limited;
    $all_data = DB::query($stringQuery." where ".$where_clause." ".$sort_by.$limited);
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
echo json_encode($output);
?>
