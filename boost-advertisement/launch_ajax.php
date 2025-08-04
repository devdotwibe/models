<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

	if (isset($_POST['action']) && $_POST['action'] == 'submit_launch') {

        $user_unique_id = mysqli_real_escape_string($conn, $_POST['user_unique_id']);
        $plan_type = mysqli_real_escape_string($conn, $_POST['plan_type']);
        $target_audience = mysqli_real_escape_string($conn, $_POST['target_audience']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $age_range = mysqli_real_escape_string($conn, $_POST['age_range']);
        $budget = mysqli_real_escape_string($conn, $_POST['budget']);
        $duration = mysqli_real_escape_string($conn, $_POST['duration']);
        $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
        $expected_views_range = mysqli_real_escape_string($conn, $_POST['expected_views_range']);
        $reached_views_range = mysqli_real_escape_string($conn, $_POST['reached_views_range']);

        $query = "INSERT INTO boost_avertisement (
                    user_unique_id, plan_type, target_audience, location, age_range,
                    budget, duration, total_amount, expected_views_range, reached_views_range,
                    created_at, updated_at
                ) VALUES (
                    '$user_unique_id', '$plan_type', '$target_audience', '$location', '$age_range',
                    '$budget', '$duration', '$total_amount', '$expected_views_range', '$reached_views_range',
                    NOW(), NOW()
                )";

        if (mysqli_query($conn, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Boost advertisement created successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database insert failed', 'error' => mysqli_error($conn)]);
        }

    }

?>