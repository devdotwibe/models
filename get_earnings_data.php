<?php
session_start();
include('includes/config.php');
include('includes/helper.php');

if (isset($_SESSION["log_user_id"])) {
    $userDetails = get_data('model_user', ['id' => $_SESSION["log_user_id"]], true);

    if ($userDetails) {
        
       if (isset($_POST['action']) && $_POST['action'] == 'get_earnings_data' && isset($_POST['period'])) {

            $user_id = $userDetails['id'];
            $period = $_POST['period'];

            $data = [];

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

                $data = [
                    'Monday' => 0,
                    'Tuesday' => 0,
                    'Wednesday' => 0,
                    'Thursday' => 0,
                    'Friday' => 0,
                    'Saturday' => 0,
                    'Sunday' => 0
                ];
            } elseif ($period == 'month') {
                $sql .= " AND YEAR(created_at) = '$currentYear' AND MONTH(created_at) = '$currentMonth'";

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                for ($i = 1; $i <= $daysInMonth; $i++) {
                    $data[$i] = 0;
                }
            } elseif ($period == 'year') {
                $sql .= " AND YEAR(created_at) = '$currentYear'";

                // init months
                $months = [
                    'Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Dec'
                ];
                foreach ($months as $m) {
                    $data[$m] = 0;
                }
            }

            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($period == 'week') {
                        $dayOfWeek = date('l', strtotime($row['created_at']));
                        $data[$dayOfWeek] += (float)$row['amount'];
                    } elseif ($period == 'month') {
                        $day = (int)date('j', strtotime($row['created_at']));
                        $data[$day] += (float)$row['amount'];
                    } elseif ($period == 'year') {
                        $monthIndex = (int)date('n', strtotime($row['created_at'])) - 1;
                        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        $monthName = $months[$monthIndex];
                        $data[$monthName] += (float)$row['amount'];
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

        if (isset($_POST['action']) &&  $_POST['action'] =='setting_data' && isset($_POST['value']) && isset($_POST['field_name'])) {

            $unique_model_id = $userDetails['unique_id'];

            $value = ($_POST['value'] === 'Y') ? 1 : 0;  

            $field_name = $_POST['field_name'];

            if($field_name == 'weight_max' || $field_name == 'weight_min' || $field_name == 'height_max' || $field_name == 'height_min' ||  $field_name == 'age_min' ||  $field_name == 'age_max' ||  $field_name == 'age_range' || $field_name == 'message_template' || $field_name == 'children_preference' || $field_name == 'education_level' || $field_name == 'height_range' || $field_name == 'weight_range' )
            {
                $value = $_POST['value'];
            }

            $allowed_fields = ['male_to_female', 
                                'male_to_male',
                                'female_to_male',
                                'female_to_female',
                                'transgender',
                                'country_enable',
                                'profile_visibility',
                                'apply_age_range',
                                'age_min',
                                'age_max',
                                'weight_min',
                                'weight_max',
                                'height_min',
                                'height_max',
                                'age_range',
                                'read_receipt',
                                'show_visit',
                                'appear_offline',
                                'show_join_date',
                                'priority_message',
                                'verified_photos',
                                'exclude_message_already',
                                'show_liked',
                                'message_template',
                                'children_preference',
                                'education_level',
								'height_range',
								'weight_range'
                                ];

            if (!in_array($field_name, $allowed_fields)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid field']);
                exit;
            }

            $checkSql = "SELECT id FROM model_privacy_settings WHERE unique_model_id = ?";
            $stmt = $con->prepare($checkSql);
            $stmt->bind_param("s", $unique_model_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $timestamp = date('Y-m-d H:i:s');

            if ($result->num_rows > 0) {
   
                if( $field_name == 'message_template' || $field_name == 'children_preference' || $field_name == 'education_level' ||  $field_name == 'age_min' || $field_name == 'age_max'  || $field_name == 'height_min' || $field_name == 'height_max' || $field_name == 'weight_min' || $field_name == 'weight_max' )
                {
                    $updateSql = "UPDATE model_privacy_settings SET `$field_name` = ?, updated_at = ? WHERE unique_model_id = ?";
                    $updateStmt = $con->prepare($updateSql);
                    $updateStmt->bind_param("sss", $value, $timestamp, $unique_model_id);
                    $updateStmt->execute();
                }
                else
                {
                    $updateSql = "UPDATE model_privacy_settings SET `$field_name` = ?, updated_at = ? WHERE unique_model_id = ?";
                    $updateStmt = $con->prepare($updateSql);
                    $updateStmt->bind_param("iss", $value, $timestamp, $unique_model_id);
                    $updateStmt->execute();

                }
        
            } else {
           
                if( $field_name == 'message_template' || $field_name == 'children_preference' || $field_name == 'education_level' ||  $field_name == 'age_min' || $field_name == 'age_max'  || $field_name == 'height_min' || $field_name == 'height_max' || $field_name == 'weight_min' || $field_name == 'weight_max')
                {
                    $insertSql = "INSERT INTO model_privacy_settings (unique_model_id, `$field_name`, created_at, updated_at)
                            VALUES (?, ?, ?, ?)";
                    $insertStmt = $con->prepare($insertSql);
                    $insertStmt->bind_param("ssss", $unique_model_id, $value, $timestamp, $timestamp);
                    $insertStmt->execute();
                }
                else
                {
                    $insertSql = "INSERT INTO model_privacy_settings (unique_model_id, `$field_name`, created_at, updated_at)
                            VALUES (?, ?, ?, ?)";
                    $insertStmt = $con->prepare($insertSql);
                    $insertStmt->bind_param("siss", $unique_model_id, $value, $timestamp, $timestamp);
                    $insertStmt->execute();
                }
     
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Setting updated successfully',
                'field' => $field_name,
                'value' => $value
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
