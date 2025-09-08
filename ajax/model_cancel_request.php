<?php 
session_start();
include('../includes/config.php');
include('../includes/helper.php');

    header('Content-Type: application/json');
    $output = [];

    if (!isset($_SESSION['log_user_id'])) {
        $output['status']  = 'error';
        $output['message'] = 'User not logged in';
        echo json_encode($output);
        exit;
    }

    if (empty($_GET['reciever'])) {
        $output['status']  = 'error';
        $output['message'] = 'Receiver ID missing';
        echo json_encode($output);
        exit;
    }

    $user_id  =  $_SESSION['log_user_id'];

    $receiver =  $_GET['reciever'];

    $rows_deleted = DB::query(
        "DELETE FROM all_notifications WHERE sender_id = %s AND receiver_id = %s AND notification_type = 'follow'",
        $user_id,
        $receiver
    );

    if (DB::affectedRows() > 0) {
        $output['status']  = 'success';
        $output['message'] = 'Request Cancelled Successfully';
    } else {
        $output['status']  = 'error';
        $output['message'] = 'No follow request found to cancel';
    }

    echo json_encode($output);
?>
