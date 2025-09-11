<?php
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');

$perPage = 6;
$output  = [
    'result' => 'ok',
    'total'  => 0
];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page_number = max(1, $page);
$offset = ($page_number - 1) * $perPage;

$sort_by   = ' ORDER BY tb.is_paid DESC, tb.id DESC';
$sort_type = $_GET['sort_type'] ?? '';
$sort_col  = $_GET['sort_column'] ?? '';



 $blocked_users = [];


if (isset($_SESSION["log_user_id"])) {

    $userDetails     = get_data('model_user', ['id'=>$_SESSION["log_user_id"]], true);

    $boosted_ad_ids  = BoostedModelIdsByUser($userDetails, $con);

     $blocked_users = BlockedUsers($_SESSION["log_user_id"]);

} else {
    $boosted_ad_ids  = BoostedModelIds($con);
}



$order = "";

    if (!empty($boosted_ad_ids)) {
        $boosted_ad_ids = array_unique(array_map('intval', $boosted_ad_ids));

        $ordered_ids    = implode(',', $boosted_ad_ids);
        
        if (!empty($ordered_ids)) {

            // $order   = " ORDER BY FIELD(tb.id, $ordered_ids)";

            $order = " ORDER BY FIELD(tb.id, $ordered_ids) DESC, tb.id DESC";

            $sort_by = ""; // override default sort
        }

    } else {
        $order = " ORDER BY tb.id DESC";
        $sort_by = "";
    }

// ------------------ BASE QUERY ------------------
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

// ------------------ FILTERS ------------------
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

    if (!empty($blocked_users)) {
                                
        $blocked_ids = implode(',', array_map('intval', $blocked_users));

       $where[] = "mu.id NOT IN ($blocked_ids) ";
        
    }   

if (!empty($where)) {
    $stringQuery .= " AND " . implode(" AND ", $where);
}

// ------------------ FINAL QUERY ------------------
$orderBy = !empty($order) ? $order : $sort_by;
$limited = " LIMIT $offset, " . (int)$perPage;


$finalQuery = $stringQuery . $orderBy . $limited;

echo  $finalQuery ;

die();


$all_data   = DB::query($finalQuery, ...$params);

// print_r($all_data); die();

// ------------------ TOTAL COUNT ------------------
$totalQuery = "SELECT COUNT(*) AS cnt FROM (" . $stringQuery . ") AS t";
$totalRow   = DB::queryFirstRow($totalQuery, ...$params);

$output['total']          = $totalRow['cnt'] ?? 0;
$output['total_page_all'] = $stringQuery;
$output['total_page']     = (int) ceil($output['total'] / $perPage);
$output['page']           = $page_number;

// ------------------ HTML ------------------
ob_start();
include 'ajax_item.php';
$html = ob_get_clean();

$output['html'] = $html;

// ------------------ RETURN ------------------
echo json_encode($output);
exit;
