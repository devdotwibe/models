<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();

if(isset($_SESSION['log_user_id'])) {

    $user_id = $_SESSION['log_user_id'];

    $adver_id = $_POST['adver_id'];

    $value = $_POST['value'];

            $field_name = 'liked';

            $timestamp = date('Y-m-d H:i:s');

            $checkSql = "SELECT id FROM avertisement_like WHERE adver_id = ? AND user_id = ?";

            $stmt = $con->prepare($checkSql);
            $stmt->bind_param("ii", $adver_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
     
                $updateSql = "UPDATE avertisement_like SET  WHERE adver_id = ? AND user_id = ?";
                $updateStmt = $con->prepare($updateSql);
                $updateStmt->bind_param("ii",  $adver_id, $user_id);
                $updateStmt->execute();
            } else {
            
                $insertSql = "INSERT INTO avertisement_like (adver_id, user_id, `$field_name`, created_at) VALUES (?, ?, ?, ?)";
                $insertStmt = $con->prepare($insertSql);
                $insertStmt->bind_param("iiss", $adver_id, $user_id, $value, $timestamp);
                $insertStmt->execute();
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'User liked successfully',
            ]);
            exit;

        }
?>
