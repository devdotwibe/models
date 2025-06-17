<?php 
session_start(); 
include('includes/config.php');
include('includes/helper.php');
$table_name = "tickets";
$perPage = 20;
$output = array();
$output['result']= 'ok';
if(isset($_SESSION['log_user_id'])){
	$user_id = $_SESSION['log_user_id'];
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
	
	$html = '';
	if($all_data){
		foreach($all_data as $set_data){
			$html .= '<tr>';
			$html .= '<td>'.$set_data['id'].'</td>';
			$html .= '<td>'.$set_data['name'].'</td>';
			if($set_data['status']=='pending'){
				$status = '<span class="badge bg-primary text-white">Pending</span>';
			}
			else{
				$status = '<span class="badge bg-primary text-white">'.$set_data['status'].'</span>';
			}
			$html .= '<td>'.$status.'</td>';
			$html .= '<td>'.h_dateFormat($set_data['created_at'],'d M, Y').'</td>';
			$html .= '<td><a href="'.SITEURL.'viewsupport.php?id='.$set_data['id'].'" class="btn btn-blue text-white">View</a></td>';
			$html .= '</tr>';
		}
	}
	else{
		$html .= '<tr>';
		$html .= '<td colspan="4">There is no data</td>';
		$html .= '</tr>';
	}
	$output['html'] = $html;
	$output['total_page'] = (int) ceil($total/ $perPage);
	$output['page'] = $page_number;
}
else{
}
echo json_encode($output);
?>
