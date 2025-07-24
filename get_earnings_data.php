<?php
session_start();
include('includes/config.php');
include('includes/helper.php');

if (isset($_SESSION["log_user_id"])) {
    $userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);

    if ($userDetails) {
        if (isset($_POST['action']) && isset($_POST['period'])) {
            $user_id = $userDetails['id'];
            $period = $_POST['period'];
            $resultData = [];

            if ($period == 'month') {
       
                $currentYear = date('Y');
                $currentMonth = date('m');

                $resultData = [
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
            } elseif ($period == 'week') {
    
                $monday = date('Y-m-d', strtotime('monday this week'));
                $sunday = date('Y-m-d', strtotime('sunday this week'));

                $resultData = [
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
                    AND DATE(created_at) BETWEEN '$monday' AND '$sunday'
                ";
            } elseif ($period == 'year') {
        
                $currentYear = date('Y');

                $resultData = [
                    'January' => 0,
                    'February' => 0,
                    'March' => 0,
                    'April' => 0,
                    'May' => 0,
                    'June' => 0,
                    'July' => 0,
                    'August' => 0,
                    'September' => 0,
                    'October' => 0,
                    'November' => 0,
                    'December' => 0
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
                ";
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid period.']);
                exit;
            }

            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $created_at = $row['created_at'];
                    $amount = (float)$row['amount'];

                    if ($period == 'month' || $period == 'week') {
                        $day = date('l', strtotime($created_at)); 
                        if (isset($resultData[$day])) {
                            $resultData[$day] += $amount;
                        }
                    } elseif ($period == 'year') {
                        $month = date('F', strtotime($created_at));
                        if (isset($resultData[$month])) {
                            $resultData[$month] += $amount;
                        }
                    }
                }
            }

            echo json_encode([
                'status' => 'success',
                'period' => $period,
                'data' => $resultData
            ]);
            exit;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
}
?>
