<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();

if(isset($_SESSION['log_user_id'])) {

    $user_id = $_SESSION['log_user_id'];

    $modelid = $_GET['modelid'];

// $get_like = DB::query('select like_count from model_user where id='.$modelid);

// $post_data = array();
// $post_data['like_count'] = $get_like[0]['like_count']+1;

// DB::update('model_user', $post_data, "id=%s", $modelid);

// $output['suc']= 'success';

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
                'message' => 'User liked successfully',
            ]);
            exit;

            // echo json_encode($output);

        }
?>
