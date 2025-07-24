<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
if(isset($_SESSION["log_user_id"])){


$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){

      if (isset($_POST['action']) && isset($_POST['period'])) {

            $user_id = $userDetails['id'];

            $currentYear = date('Y');

            $currentMonth = date('m');

            $weeklyTotals = [
                'Monday' => 0,
                'Tuesday' => 0,
                'Wednesday' => 0,
                'Thursday' => 0,
                'Friday' => 0,
                'Saturday' => 0,
                'Sunday' => 0
            ];

            $sql = "
                SELECT amount, created_at 
                FROM model_user_transaction_history 
                WHERE user_id = '$user_id' 
                AND type IN (
                    'user-purchase-image',
                    'user-purchase-social',
                    'user-booking-group-show'
                )
                AND YEAR(created_at) = '$currentYear'
                AND MONTH(created_at) = '$currentMonth'
            ";

            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $dayOfWeek = date('l', strtotime($row['created_at']));

                    if(isset($weeklyTotals[$dayOfWeek])) {
                        $weeklyTotals[$dayOfWeek] += (float)$row['amount'];
                    }
                }
            }

            echo json_encode([
                'status' => 'success',
                'weekly_totals' => $weeklyTotals
            ]);
            exit;
        }
}
else{
	echo "User not found.";
	
}
}
else{
	echo "User not found.";
}
?>