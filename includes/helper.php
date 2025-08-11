<?php
include('custom_helper.php');

function h_my_ip_address(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else{
	  $ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}	

function updateUserActivity($userId) {
    $cacheDir = __DIR__ . '/cache/user_activity/';

    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0777, true);
    }

    $file = $cacheDir . 'user_' . $userId . '.txt';

    file_put_contents($file, time());
}

function getModelFollowerIds($model_id) {
    $query = "SELECT unique_model_id FROM model_follow WHERE unique_user_id = %s AND status = 'Follow'";
    
    $results = DB::query($query, $model_id);

    $followerIds = [];

    foreach ($results as $row) {
        $followerIds[] = $row['unique_model_id'];
    }

    return $followerIds;
}

	function isUserHaveExtraDetail($uni_id,$con)
	{
		$check_sql = "SELECT COUNT(*) AS count FROM model_extra_details WHERE unique_model_id = '".$uni_id."'";
		$result = mysqli_query($con, $check_sql);
		$row = mysqli_fetch_assoc($result);

		if ($row['count'] > 0) {

			return true;

		} else {
			
			return false;
		}
	}

function BoostedModelIds($con) {

	$today = new DateTime();

	$query = "SELECT user_unique_id, created_at, duration, total_amount 
			FROM boost_avertisement";

	$result = mysqli_query($con, $query);

	$validBoosts = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$createdAt = new DateTime($row['created_at']);
		$duration = (int)$row['duration'];
		
		$expiryDate = clone $createdAt;
		$expiryDate->modify("+$duration days");

		if ($today <= $expiryDate) {
		
			$validBoosts[] = [
				'user_unique_id' => $row['user_unique_id'],
				'total_amount' => (float)$row['total_amount'] 
			];
		}
	}

	usort($validBoosts, function ($a, $b) {
		return $a['total_amount'] <=> $b['total_amount'];
	});

	return $sortedUserIds = array_column($validBoosts, 'user_unique_id');

}

	function PermiumFilterids($con) {

		$query = "SELECT unique_model_id, verified_photos 
				FROM model_privacy_settings";

		$result = mysqli_query($con, $query);

		$validPreminumids = [];

		while ($row = mysqli_fetch_assoc($result)) {

			if($row['verified_photos'])
			{
				$validPreminumids[] = [
					'user_unique_id' => $row['unique_model_id']
				];
			}
			
		}

		 return array_column($validPreminumids, 'user_unique_id');
	}

	function ExcludeMessageIds($con)
	{
		
	}

	function BoostedModelIdsByUser($userDetails, $con) {

		$today = new DateTime();
		$user_gender = strtolower($userDetails['gender']);

		$user_country_id = $userDetails['country'];

		if($user_gender =='Female' || $user_gender=='female')
		{
			$user_gender = 'women';
		}

		if($user_gender =='male' || $user_gender=='Male')
		{
			$user_gender = 'men';
		}

		if($user_gender =='Couple' || $user_gender=='couple')
		{
			$user_gender = 'couples';
		}

		$query = "SELECT user_unique_id, created_at, duration, total_amount, target_audience 
				FROM boost_avertisement";

		$result = mysqli_query($con, $query);

		$validBoosts = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$createdAt = new DateTime($row['created_at']);
			$duration = (int)$row['duration'];

			$expiryDate = clone $createdAt;
			$expiryDate->modify("+$duration days");

			if ($today <= $expiryDate) {

				$targetAudience = array_map('trim', explode(',', strtolower($row['target_audience'])));

				if (in_array($user_gender, $targetAudience) || in_array('all', $targetAudience)) {

					$allowBoost = true;

					if (strtolower($row['location']) === 'national') {
						
						$boostUser = get_data('model_user', ['unique_id' => $row['user_unique_id']], true);

						if (!$boostUser || $boostUser['country'] != $user_country_id) {

							$allowBoost = false;
						}
					}

					if ($allowBoost) {
						$validBoosts[] = [
							'user_unique_id' => $row['user_unique_id'],
							'total_amount' =>  (float)$row['total_amount'] 
						];
					}
				}
			}
		}

		usort($validBoosts, function ($a, $b) {
			return $a['total_amount'] <=> $b['total_amount'];
		});

		return array_column($validBoosts, 'user_unique_id');
	}



function checkUserFollow($model_id, $user_id) {
	
    $where_clause = " unique_model_id = %s AND unique_user_id = %s AND status = 'Follow' ";
    $query = "SELECT * FROM model_follow WHERE $where_clause LIMIT 1";
    
    $result = DB::queryFirstRow($query, $model_id, $user_id);

    return $result ? true : false;
}

	function filterFollowedModelIdsByPrivacy($con, $followed_model_unique_ids, $userDetails, $privacy)
	{
		$followed_user_ids = [];

		$current_user_gender = $userDetails['gender'];

		$current_user_country = $userDetails['country'];

		if (empty($followed_model_unique_ids)) {
			return $followed_user_ids;
		}

		$placeholders = implode(',', array_fill(0, count($followed_model_unique_ids), '?'));
		$types = str_repeat('s', count($followed_model_unique_ids));
		$query = "SELECT id,unique_id,gender,age,country FROM model_user WHERE unique_id IN ($placeholders)";
		$stmt = $con->prepare($query);

		if (!$stmt) {
			die("Prepare failed (fetching numeric ids): " . $con->error);
		}

		$stmt->bind_param($types, ...$followed_model_unique_ids);
		$stmt->execute();
		$result = $stmt->get_result();

		while ($row = $result->fetch_assoc()) {

			$target_gender = $row['gender'];

			$target_country = $row['country'];

			$allow = false;

			if ($current_user_gender === "Male") {
				if (
					($privacy['male_to_female'] && $target_gender === "Female") ||
					($privacy['male_to_male'] && $target_gender === "Male")
				) {
					$allow = true;
				}
			} elseif ($current_user_gender === "Female") {
				if (
					($privacy['female_to_male'] && $target_gender === "Male") ||
					($privacy['female_to_female'] && $target_gender === "Female")
				) {
					$allow = true;
				}
			}

			if ($privacy['transgender'] && $target_gender === "Couple") {
				$allow = true;
			}

			if ($privacy['country_enable']) {

				if ($target_country !== $current_user_country) {
					$allow = false;
				}
			}

			$privacy_model =  getModelPrivacySettings($row['unique_id']);

			if (!$privacy_model['profile_visibility']) {
				
					$allow = false;
			}

			if ($privacy['apply_age_range']) {
				
				if($row['age'] > $privacy['age_range'])
				{
						$allow = false;
				}
				
			}


			if ($allow) {
				$followed_user_ids[] = (int)$row['id'];
			}
		}

		return $followed_user_ids;
	}


function getModelPrivacySettings($model_id) {
    $where_clause = " unique_model_id = %s ";
    $query = "SELECT * FROM model_privacy_settings WHERE $where_clause LIMIT 1";
    
    $result = DB::queryFirstRow($query, $model_id);

    return $result ? $result : null;
}


function isUserOnline($userId, $minutes = 5) {
    $cacheDir = __DIR__ . '/cache/user_activity/';
    $file = $cacheDir . 'user_' . $userId . '.txt';

    if (!file_exists($file)) {
        return 'Offline';
    }

	$userDetails = get_data('model_user', ['id' => $userId], true);

	$privacySetting = getModelPrivacySettings($userDetails['unique_id']);

    if (!empty($privacySetting) && $privacySetting['appear_offline'] == 1) {
        return 'Offline'; 
    }

    $lastSeen = (int)file_get_contents($file);
    $now = time();

    return ($now - $lastSeen <= ($minutes * 60)) ? 'Online' : 'Offline';
}

function getUserLastSeenAgo($userId) {
    $cacheDir = __DIR__ . '/cache/user_activity/';
    $file = $cacheDir . 'user_' . $userId . '.txt';

    $userDetails = get_data('model_user', ['id' => $userId], true);

    if (!$userDetails) {
        return 'Few days ago';
    }

    $privacySetting = getModelPrivacySettings($userDetails['unique_id']);
    if (!empty($privacySetting) && $privacySetting['appear_offline'] == 1) {
        return 'Few days ago'; 
    }

    if (!file_exists($file)) {
        return 'A few days ago';
    }

    $lastSeen = (int)file_get_contents($file);
    $now = time();
    $diff = $now - $lastSeen;

    if ($diff < 60) {
        return 'Just now';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return 'Few days ago';
    }
}


function getTotalOnlineUsers($minutes = 5) {
    $cacheDir = __DIR__ . '/cache/user_activity/';
    $onlineCount = 0;

    if (!is_dir($cacheDir)) {
        return 0;
    }

    $files = glob($cacheDir . 'user_*.txt');

    foreach ($files as $file) {
        $userId = (int)preg_replace('/[^0-9]/', '', basename($file)); // Extract numeric user ID

        if (isUserOnline($userId, $minutes) === 'Online') {
            $onlineCount++;
        }
    }

    return $onlineCount;
}

if (!empty($_SESSION['log_user_id'])) {

    updateUserActivity($_SESSION['log_user_id']);
}

	function getActiveUsers($user_id, $con) {

		$userDetails = get_data('model_user', ['id' => $user_id], true);
		if (!$userDetails || !isset($userDetails['unique_id'])) {
			return ['count' => 0, 'user_ids' => []];
		}

		$unique_user_id = $userDetails['unique_id'];

		$interactedUserIds = [];

		$sql1 = "SELECT unique_model_id FROM model_follow WHERE unique_user_id = '$unique_user_id'";
		$result1 = mysqli_query($con, $sql1);
		while ($row = mysqli_fetch_assoc($result1)) {
			$interactedUserIds[] = $row['unique_model_id'];
		}

		$sql2 = "SELECT DISTINCT lp.post_author 
				FROM live_comments lc 
				JOIN live_posts lp ON lc.comment_post_ID = lp.id 
				WHERE lc.user_id = '$user_id'";
		$result2 = mysqli_query($con, $sql2);
		while ($row = mysqli_fetch_assoc($result2)) {
		
			$authorId = $row['post_author'];
			$author = get_data('model_user', ['id' => $authorId], true);
			if ($author && isset($author['unique_id'])) {
				$interactedUserIds[] = $author['unique_id'];
			}
		}

		$sql3 = "SELECT model_unique_id FROM user_purchased_image WHERE user_unique_id = '$unique_user_id'";
		$result3 = mysqli_query($con, $sql3);
		while ($row = mysqli_fetch_assoc($result3)) {
			$interactedUserIds[] = $row['model_unique_id'];
		}

		$sql4 = "SELECT model_unique_id FROM user_purchased_social WHERE user_unique_id = '$unique_user_id'";
		$result4 = mysqli_query($con, $sql4);
		while ($row = mysqli_fetch_assoc($result4)) {
			$interactedUserIds[] = $row['model_unique_id'];
		}

		$uniqueActiveUserIds = array_unique(array_filter($interactedUserIds, function ($id) use ($unique_user_id) {
			return $id !== $unique_user_id;
		}));

		return [
			'count' => count($uniqueActiveUserIds),
			'user_ids' => array_values($uniqueActiveUserIds)
		];
	}

	function getUserTotalTransactionAmount($con, $userId) {

		$sql = "
			SELECT SUM(amount) as total 
			FROM model_user_transaction_history 
			WHERE user_id = ? 
			AND type IN (
				'user-purchase-image',
				'user-purchase-social',
				'user-booking-group-show'
			)
		";

		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$totalAmount = 0;
		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$totalAmount = $row['total'] ?? 0;
		}

		return $totalAmount;
	}


	function getUserMonthlyTransactionAmount($con, $userId) {

		$sql = "
			SELECT SUM(amount) as total 
			FROM model_user_transaction_history 
			WHERE user_id = ? 
			AND type IN (
				'user-purchase-image',
				'user-purchase-social',
				'user-booking-group-show'
			)
			AND YEAR(created_at) = YEAR(CURDATE())
			AND MONTH(created_at) = MONTH(CURDATE())
		";

		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$totalAmount = 0;
		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$totalAmount = $row['total'] ?? 0;
		}

		return $totalAmount;
	}


	function getTopEarningTimeSlot($con, $userId) {

		$sql = "
			SELECT 
				HOUR(created_at) AS hour,
				SUM(amount) AS total
			FROM model_user_transaction_history
			WHERE user_id = ?
			AND type IN (
				'user-purchase-image',
				'user-purchase-social',
				'user-booking-group-show'
			)
			GROUP BY HOUR(created_at)
			ORDER BY total DESC
			LIMIT 3
		";

		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$hours = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$hours[] = $row['hour'];
		}

		  if (count($hours) > 0) {
				$startHour = min($hours);
				$endHour = max($hours) + 1;

				$startFormatted = formatHourTo12H($startHour);
				$endFormatted = formatHourTo12H($endHour);

				return "$startFormatted - $endFormatted";
			}

		return "N/A";
	}

	function formatHourTo12H($hour) {
		return date("g:i A", strtotime("$hour:00"));
	}

	function getTopEarningDays($con, $userId) {
		$sql = "
			SELECT 
				DAYNAME(created_at) AS day,
				AVG(amount) AS avg_amount
			FROM model_user_transaction_history
			WHERE user_id = ?
			AND type IN (
				'user-purchase-image',
				'user-purchase-social',
				'user-booking-group-show'
			)
			GROUP BY DAYNAME(created_at)
			ORDER BY avg_amount DESC
			LIMIT 2
		";

		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$days = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$days[] = $row['day'];
		}

		return $days;
	}


function checkImageExists($relativePath) {

    $rootPath = $_SERVER['DOCUMENT_ROOT']; 

    $imagePath = $rootPath . '/' . ltrim($relativePath, '/');

    return !empty($relativePath) && file_exists($imagePath);
}


function extra_setting($field,$default=false,$set_zero=false){
	$where_clause = " `fields` = '".$field."' ";

	$string ="select * from extra_setting where ".$where_clause;
	$form_data = DB::queryFirstRow($string);
	if($form_data){
		return $form_data['value'];
	}
	else{
		if($set_zero){
			return '0';
		}
		else if($default)
			return $default;
		else
			return '';
	}
}


function get_time($AM=false){	 
	$options = array();
	foreach (range(00,23) as $fullhour) 
	{
		$parthour = $fullhour > 12 ? $fullhour - 12 : $fullhour;
		$sufix = $fullhour > 11 ? " PM" : " AM";
		$fullhour = $fullhour<10 ? "0".$fullhour : $fullhour;
		if($AM){
			$options["$fullhour:00"] = $parthour.":00".$sufix;
			$options["$fullhour:30"] = $parthour.":30".$sufix;
		}
		else{
			$options["$fullhour:00"] = "$fullhour:00";
			$options["$fullhour:30"] = "$fullhour:30";
		}
	}
	return $options;
}

function get_week(){	 
	$days = array(
		0 => 'monday',
		1 => 'tuesday',
		2 => 'wednesday',
		3 => 'thursday',
		4 => 'friday',
		5 => 'saturday',
		6 => 'sunday'
	);
	return $days;
}



function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function h_get_age($date){
	//date_default_timezone_set(TIMEZONE); 
	$dob = strtotime(str_replace("/","-",$date));       
	$tdate = time();		
	$age = 0;
	while( $tdate > $dob = strtotime('+1 year', $dob))
	{
		++$age;
	}
	return $age;
}


function get_count($table,$array,$id='id'){
	$output = 0;

	$output = array();
	$where_clause = '';
	if($array){
		foreach($array as $key=>$val){
			$where_clause .= " `".$key."` = '".$val."' and";
		}
	}

	$where_clause = rtrim($where_clause,'and');

	$string ="select $id from ".$table." where ".$where_clause;
	$form_data = DB::query($string);
	$output = DB::numRows();
	
/*	if($form_data){
		$output = count($form_data);
	}*/
//	$output =  $form_data;
	return $output;
}

function get_data($table,$array,$single=false){
	$output = array();
	$where_clause = '';
	if($array){
		foreach($array as $key=>$val){
			$where_clause .= " `".$key."` = '".$val."' and";
		}
	}

	$where_clause = rtrim($where_clause,'and');

	$string ="select * from ".$table." where ".$where_clause;
	if($single){
		$form_data = DB::queryFirstRow($string);
	}
	else{
		$form_data = DB::query($string);
	}
	$output =  $form_data;
	return $output;
}

	function search_user($table, $array = [], $single = false)
	{
		$where_clause = '';
		if (!empty($array)) {
			$conditions = [];
			foreach ($array as $field => $value) {
				$conditions[] = "`$field` LIKE '%$value%'";
			}
			$where_clause = implode(' OR ', $conditions);
		}

		$query = "SELECT * FROM $table";
		if ($where_clause) {
			$query .= " WHERE $where_clause";
		}

		if ($single) {
			return DB::queryFirstRow($query);
		} else {
			return DB::query($query);
		}
	}


function print_value($table,$array,$show,$default=false,$set_zero=false){
	$where_clause = '';
	if($array){
		foreach($array as $key=>$val){
			$where_clause .= " `".$key."` = '".$val."' and";
		}
	}

	$where_clause = rtrim($where_clause,'and');

	$string ="select * from ".$table." where ".$where_clause;
	$form_data = DB::queryFirstRow($string);
	if($form_data){
		return $form_data[$show];
	}
	else{
		if($set_zero){
			return '0';
		}
		else if($default)
			return $default;
		else
			return '-';
	}
}


function array_from_post($fields){
	$data = array();
	foreach ($fields as $field) {
		$data[$field] = isset($_POST[$field])?$_POST[$field]:'';
	}
	return $data;
}
function array_from_get($fields){
	$data = array();
	foreach ($fields as $field) {
		$data[$field] = isset($_GET[$field])?$_GET[$field]:'';
	}
	return $data;
}


function h_dateFormat($date,$format){
	$new_date = date($format,strtotime($date));
	return $new_date;
}

function get_sort_month(){	 
	$options = array('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
	return $options;
}
function get_month_name($index=false){
  if($index){
		$templates = array(
				'01'	=>'January',
				'02'	=>'February',
				'03'		=>'March',
				'04'		=>'April',
				'05'		=>'May',
				'06'		=>'June',
				'07'		=>'July',
				'08'	=>'August',
				'09'	=>'September',
				'10'	=>'October',
				'11'	=>'November',
				'12'	=>'December',
			);
  }
  else{
	$templates = array(
				'January'	=>'January',
				'February'	=>'February',
				'March'		=>'March',
				'April'		=>'April',
				'May'		=>'May',
				'June'		=>'June',
				'July'		=>'July',
				'August'	=>'August',
				'September'	=>'September',
				'October'	=>'October',
				'November'	=>'November',
				'December'	=>'December',
			);			
  }
	return $templates;
}

function get_country_name(){
$templates = array(
"AF" => "Afghanistan",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"BQ" => "British Antarctic Territory",
"IO" => "British Indian Ocean Territory",
"VG" => "British Virgin Islands",
"BN" => "Brunei",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CT" => "Canton and Enderbury Islands",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos [Keeling] Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo - Brazzaville",
"CD" => "Congo - Kinshasa",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"CI" => "Côte d'Ivoire",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"NQ" => "Dronning Maud Land",
"DD" => "East Germany",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"FQ" => "French Southern and Antarctic Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GG" => "Guernsey",
"GN" => "Guinea",
"GW" => "Guinea-Bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and McDonald Islands",
"HN" => "Honduras",
"HK" => "Hong Kong SAR China",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran",
"IQ" => "Iraq",
"IE" => "Ireland",
"IM" => "Isle of Man",
"IL" => "Israel",
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JE" => "Jersey",
"JT" => "Johnston Island",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Laos",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macau SAR China",
"MK" => "Macedonia",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"FX" => "Metropolitan France",
"MX" => "Mexico",
"FM" => "Micronesia",
"MI" => "Midway Islands",
"MD" => "Moldova",
"MC" => "Monaco",
"MN" => "Mongolia",
"ME" => "Montenegro",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar [Burma]",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NT" => "Neutral Zone",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"KP" => "North Korea",
"VD" => "North Vietnam",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PC" => "Pacific Islands Trust Territory",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territories",
"PA" => "Panama",
"PZ" => "Panama Canal Zone",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"YD" => "People's Democratic Republic of Yemen",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn Islands",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RO" => "Romania",
"RU" => "Russia",
"RW" => "Rwanda",
"RE" => "Réunion",
"BL" => "Saint Barthélemy",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"MF" => "Saint Martin",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and the Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"RS" => "Serbia",
"CS" => "Serbia and Montenegro",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and the South Sandwich Islands",
"KR" => "South Korea",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syria",
"ST" => "São Tomé and Príncipe",
"TW" => "Taiwan",
"TJ" => "Tajikistan",
"TZ" => "Tanzania",
"TH" => "Thailand",
"TL" => "Timor-Leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UM" => "U.S. Minor Outlying Islands",
"PU" => "U.S. Miscellaneous Pacific Islands",
"VI" => "U.S. Virgin Islands",
"UG" => "Uganda",
"UA" => "Ukraine",
"SU" => "Union of Soviet Socialist Republics",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"ZZ" => "Unknown or Invalid Region",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VA" => "Vatican City",
"VE" => "Venezuela",
"VN" => "Vietnam",
"WK" => "Wake Island",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe",
"AX" => "Aland Islands",
);					
	return $templates;
}
function printR($data,$var_dump=false){
	echo '<pre>';
	if($var_dump){
		var_dump($data);
	}
	else{
		print_r($data);
	}
	echo '</pre>';
}