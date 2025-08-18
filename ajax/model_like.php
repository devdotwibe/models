<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();

if(isset($_SESSION['log_user_id'])) {

    $user_id = $_SESSION['log_user_id'];

    $modelid = $_GET['modelid'];

            $model_detail = get_data('model_user', ['id' => $modelid], true);

            $privacy_setting =  getModelPrivacySettings($model_detail['unique_id']);

            $checkSql = "SELECT id FROM user_model_likes WHERE user_id = ?";

            $field_name = 'like';

            $value = 'Yes';

            $timestamp = date('Y-m-d H:i:s');

            $checkSql = "SELECT id FROM user_model_likes WHERE user_id = ? AND model_id = ?";

            $stmt = $con->prepare($checkSql);
            $stmt->bind_param("ii", $user_id, $modelid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
     
                $updateSql = "UPDATE user_model_likes SET `$field_name` = ?, updated_at = ? WHERE user_id = ? AND model_id = ?";
                $updateStmt = $con->prepare($updateSql);
                $updateStmt->bind_param("ssii", $value, $timestamp, $user_id, $modelid);
                $updateStmt->execute();
            } else {
            
                $insertSql = "INSERT INTO user_model_likes (user_id, model_id, `$field_name`, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = $con->prepare($insertSql);
                $insertStmt->bind_param("iisss", $user_id, $modelid, $value, $timestamp, $timestamp);
                $insertStmt->execute();
            }

            echo json_encode([
                'status' => 'success',
                'message' =>  $privacy_setting['message_template']??'User liked successfully',
            ]);
            exit;

            // echo json_encode($output);

        }
?>
