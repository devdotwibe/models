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


// $name = $_GET['q'];
// if($name){
//     $url .= 'q='.$name.'&';
//     $where_clause .= " (lower(name) like '%".strtolower($name)."%' ) and";
// }

$sort_by = ' order by tb.is_paid desc, tb.id desc';
$sort_column = $_GET['sort_column'];
$sort_type = $_GET['sort_type'];

   if(isset($_SESSION["log_user_id"])){
        
        $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

        $boosted_ad_ids = BoostedModelIdsByUser($userDetails,$con);
    }
    else
    {
            $boosted_ad_ids = BoostedModelIds($con);
    }



    if (!empty($boosted_ad_ids)) {

        $boosted_ad_ids = array_map('intval', $boosted_ad_ids);

        $ordered_ids = implode(',',  $boosted_ad_ids); 

        $order = " ORDER BY FIELD(tb.id, $ordered_ids) DESC";

        $sort_by="";
        
    } else {

        $order = " ORDER BY tb.id DESC"; 

        $sort_by="";
    }


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
        ";
    } else {
        $stringQuery = "
            SELECT tb.*, mu.age 
            FROM banners tb 
            JOIN model_user mu ON mu.id = tb.user_id 
            WHERE 1 = 0
        "; 
    }

    $params = [];
    $where  = [];

    $category = $_GET['category'] ?? '';
    $country  = $_GET['country'] ?? '';

    if (!empty($category)) {
        $where[]  = "tb.category = %s";
        $params[] = $category;
    }

    if (!empty($country)) {
        $where[]  = "tb.country = %s";
        $params[] = $country;
    }

    if (!empty($where)) {
        $stringQuery .= " AND " . implode(" AND ", $where);
    }

    $orderBy = !empty($order) ? " $order " : "";
    $limited = " LIMIT $offset, " . (int)$perPage;


    $finalQuery = $stringQuery . $orderBy . $limited;

    echo $finalQuery ; die();
    
    $all_data   = DB::query($finalQuery, ...$params);

    $totalQuery = "SELECT COUNT(*) AS cnt FROM (" . $stringQuery . ") AS t";
    $total   = DB::queryFirstRow($totalQuery, ...$params);

    $output['total']          = $total['cnt'];
    $output['total_page_all'] = $stringQuery;

// if($where_clause){

  
//     $finalQuery = $stringQuery . " " . $orderBy . " " . $limited;

//     // $all_data = DB::query($stringQuery." where ".$where_clause." ".$sort_by.$limited,...$params);

//     $all_data = DB::query($finalQuery, ...$params);

//     // $total = $output['total'] = DB::numRows($stringQuery." where ".$where_clause );
	
// 	// $output['total_page_all'] = $stringQuery." where ".$where_clause;

//     $totalQuery = $stringQuery;
//     $total      = DB::query($totalQuery, ...$params);
//     $output['total'] = DB::numRows();
//     $output['total_page_all'] = $totalQuery;

// }
// else{
//     $all_data = DB::query($stringQuery." ".$sort_by.$limited );
//     $total = $output['total'] = DB::numRows($stringQuery);
	
// 	$output['total_page_all'] = $stringQuery;
// }

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
