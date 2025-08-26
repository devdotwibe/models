<?php
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$perPage = 20;
$output = array();
$output['result']= 'ok';
$output['total'] = 0;

$where_clause = '';
$perPage =6;

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

   if(isset($_SESSION["log_user_id"])){
        
        $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

        $boosted_user_ids = BoostedModelIdsByUser($userDetails,$con);
    }
    else
    {
            $boosted_user_ids = BoostedModelIds($con);
    }


    $filter_follower_ids = [];

    if (!empty($boosted_user_ids)) {

        $in_clause = implode(',', array_fill(0, count($boosted_user_ids), '?'));

        $types_follower = str_repeat('s', count($boosted_user_ids));

        $followQuery = "SELECT id FROM model_user WHERE unique_id IN ($in_clause)";

        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }
        $stmt->bind_param($types_follower, ...$boosted_user_ids);
        $stmt->execute();
        $result = $stmt->get_result();

      
        while ($row = $result->fetch_assoc()) {
            $filter_follower_ids[] = $row['id'];
        }

    }

    print_r($filter_follower_ids); die(); 

    if (!empty($filter_follower_ids)) {

        $ordered_ids = implode(',',  $filter_follower_ids); 
        $order = " ORDER BY FIELD(tb.user_id, $ordered_ids) DESC";

        $sort_by="";
        
    } else {

        $order = " ORDER BY tb.user_id DESC"; 

        $sort_by="";
    }


    // $allowedOrders = ['mu.id ASC', 'mu.id DESC', 'mu.age ASC', 'mu.age DESC'];

    // $order = in_array($_GET['order'] ?? 'mu.id DESC', $allowedOrders) ?  'mu.id DESC' : 'mu.id DESC';

// $stringQuery = " select tb.*,mu.age from banners tb join model_user mu on mu.id=tb.user_id ";//where status


// $stringQuery = "
//     SELECT tb.*, mu.age 
//     FROM banners tb 
//     JOIN model_user mu ON mu.id = tb.user_id 
//     WHERE mu.verified = '1' AND mu.id IN ($basicList)
//     $order
// ";

    $basic_filed_users = GetUsersWithBasicFilled();

    if (!empty($basic_filed_users)) {

        $basic_filed_users = array_map('intval', $basic_filed_users);
        $basicList = implode(',', $basic_filed_users);

        $stringQuery = "
            SELECT tb.*, mu.age 
            FROM banners tb 
            JOIN model_user mu ON mu.id = tb.user_id 
            WHERE mu.verified = '1' 
            AND mu.id IN ($basicList)
            $order
        ";
    } else {
   
        $stringQuery = "
            SELECT tb.*, mu.age 
            FROM banners tb 
            JOIN model_user mu ON mu.id = tb.user_id 
            WHERE 1 = 0 $order
        "; 

    }


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
    $all_data = DB::query($stringQuery." where ".$where_clause." ".$sort_by.$limited );
    $total = $output['total'] = DB::numRows($stringQuery." and ".$where_clause );
	
	$output['total_page_all'] = $stringQuery." and ".$where_clause;
}
else{
    $all_data = DB::query($stringQuery." ".$sort_by.$limited );
    $total = $output['total'] = DB::numRows($stringQuery);
	
	$output['total_page_all'] = $stringQuery;
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
