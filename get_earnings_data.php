<?php
session_start();
include('includes/config.php');
include('includes/helper.php');

if (isset($_SESSION["log_user_id"])) {
    $userDetails = get_data('model_user', ['id' => $_SESSION["log_user_id"]], true);

    if ($userDetails) {
        if (isset($_POST['action']) && isset($_POST['period'])) {
            $user_id = $userDetails['id'];
            $period = $_POST['period'];

            $data = [
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
            ";

            $today = date('Y-m-d');
            $currentYear = date('Y');
            $currentMonth = date('m');

            if ($period == 'week') {
          
                $monday = date('Y-m-d', strtotime('monday this week'));
                $sunday = date('Y-m-d', strtotime('sunday this week'));
                $sql .= " AND DATE(created_at) BETWEEN '$monday' AND '$sunday'";
            } elseif ($period == 'month') {
                $sql .= " AND YEAR(created_at) = '$currentYear' AND MONTH(created_at) = '$currentMonth'";
            } elseif ($period == 'year') {
                $sql .= " AND YEAR(created_at) = '$currentYear'";
            }

            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $dayOfWeek = date('l', strtotime($row['created_at']));
                    if (isset($data[$dayOfWeek])) {
                        $data[$dayOfWeek] += (float)$row['amount'];
                    }
                }
            }

            echo json_encode([
                'status' => 'success',
                'period' => $period,
                'data' => $data
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
