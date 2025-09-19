<?php

session_start();

include('../includes/config.php');
include('../includes/helper.php');

if (isset($_SESSION["log_user_id"])) {
    
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {

	if (isset($_POST['action']) && $_POST['action'] == 'submit_launch') {

            $user_unique_id = mysqli_real_escape_string($con, $_POST['user_unique_id']);
            $plan_type = mysqli_real_escape_string($con, $_POST['plan_type']);
            $target_audience = mysqli_real_escape_string($con, $_POST['target_audience']);
            $location = mysqli_real_escape_string($con, $_POST['location']);
            $age_range = mysqli_real_escape_string($con, $_POST['age_range']);
            $budget = mysqli_real_escape_string($con, $_POST['budget']);
            $duration = mysqli_real_escape_string($con, $_POST['duration']);
            $total_amount = mysqli_real_escape_string($con, $_POST['total_amount']);
            $expected_views_range = mysqli_real_escape_string($con, $_POST['expected_views_range']);
            $reached_views_range = mysqli_real_escape_string($con, $_POST['reached_views_range']);

            $ad_id = mysqli_real_escape_string($con, $_POST['ad_id']);
            

        if ($userDetails['balance'] >= $budget) {

            $query = "INSERT INTO boost_avertisement (
                        user_unique_id, plan_type, target_audience, location, age_range,
                        budget, duration, total_amount, expected_views_range, reached_views_range,ad_id,
                        created_at, updated_at
                    ) VALUES (
                        '$user_unique_id', '$plan_type', '$target_audience', '$location', '$age_range',
                        '$budget', '$duration', '$total_amount', '$expected_views_range', '$reached_views_range',$ad_id,
                        NOW(), NOW()
                    )";

            if (mysqli_query($con, $query)) {

                $boostId = mysqli_insert_id($con);

                $coins = $total_amount;

                $date = date('Y-m-d H:i:s');

                DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $coins, $user_unique_id);

                DB::insert('model_user_transaction_history', array(
                    'user_id' => $userDetails['id'],
                    'other_id' => $boostId,
                    'amount' => $coins,
                    'type' => 'views_boost',
                    'created_at' => $date,
                ));

                echo json_encode(['status' => 'success', 'message' => 'Boost advertisement created successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database insert failed', 'error' => mysqli_error($conn)]);
            }
        }
        else
        {
            echo json_encode(['status' => 'success','message'=>'You dont have sufficiant coins in your wallet for buying it.']);
        }

    }
    
    } else {
		echo "<script>alert('Please login');</script>";
		echo "<script>window.location='login.php'</script>";
	}
} else {
	echo "<script>alert('Please login');</script>";
	echo "<script>window.location='login.php'</script>";
}

?>