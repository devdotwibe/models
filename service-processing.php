<?php
session_start();
include('includes/config.php');
include('includes/helper.php');

if (isset($_SESSION["log_user_id"])) {
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {
	} else {
		echo '<script>window.location.href="login.php"</script>';
		die;
	}
} else {
	echo '<script>window.location.href="login.php"</script>';
	die;
}

$usern = $_SESSION["log_user"];

if (!$usern) {
	echo '<script>window.location.href="login.php"</script>';
	die;
}
if ($_GET['service_id']) {
	$date = date('Y-m-d H:i:s');
	if ($_GET['service-name'] == 'group_show') {
		$stringQuery = "SELECT tb.*,mu.username,mu.profile_pic FROM booking_group_show tb 
		join model_user mu on mu.id = tb.user_unique_id
		where model_unique_id='" . $userDetails['id'] . "' and tb.id=" . $_GET['service_id'];

		$check_data = DB::queryFirstRow($stringQuery);
		if ($check_data) {
			if ($check_data['status'] == 'accept' || $check_data['status'] == 'reject') {
				echo '<script>
					alert("You Already set action");
					window.location="services-requested.php";
					</script>';
			} else {
				if ($_GET['action'] == 'accept') {
					$sql_gs = 'UPDATE `booking_group_show` SET `status` = "accept" WHERE `booking_group_show`.`id` = ' . $_GET['service_id'] . '';
					if (mysqli_query($con, $sql_gs)) {
						echo '<script>
										alert("Request has Accepted Successfully");
										window.location="services-requested.php";
									</script>';
					}
				} else if ($_GET['action'] == 'reject') {

					DB::query('UPDATE `booking_group_show` SET `status` = "reject" WHERE `id` = ' . $_GET['service_id']);

					DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $check_data['coins'], $userDetails['id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $userDetails['id'],
						'other_id' => $check_data['id'],
						'amount' => $check_data['coins'],
						'type' => 'reject-group-show',
						'created_at'  => $date,
					));

					//for user
					DB::query("UPDATE model_user SET balance=round(balance+%d) WHERE id=%s", $check_data['coins'], $check_data['user_unique_id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $check_data['user_unique_id'],
						'other_id' => $check_data['id'],
						'amount' => $check_data['coins'],
						'type' => 'model-reject-group-show',
						'created_at'  => $date,
					));
					echo '<script>
					alert("Request has reject Successfully");
					window.location="services-requested.php";
				</script>';
					die;
				}
			}
		}
	} elseif ($_GET['service-name'] == 'internation_tour') {
		$stringQuery = "SELECT tb.*,mu.username,mu.profile_pic FROM booking_international_tour tb 
		join model_user mu on mu.id = tb.user_id
		where model_id='" . $userDetails['id'] . "' and tb.id=" . $_GET['service_id'];

		$check_data = DB::queryFirstRow($stringQuery);
		if ($check_data) {
			if ($check_data['status'] == 'accept' || $check_data['status'] == 'reject') {
				//echo 'You Already set action';die;
				echo '<script>
							alert("You Already set action");
							window.location="services-requested.php";
							</script>';
			} else {
				if ($_GET['action'] == 'accept') {
					$sql_gs = 'UPDATE `booking_international_tour` SET `status` = "accept" WHERE `id` = ' . $_GET['service_id'] . '';
					if (mysqli_query($con, $sql_gs)) {
						echo '<script>
												alert("Request has Accepted Successfully");
												window.location="services-requested.php";
											</script>';
						die;
					}
				} else if ($_GET['action'] == 'reject') {

					DB::query('UPDATE `booking_international_tour` SET `status` = "reject" WHERE `id` = ' . $_GET['service_id']);

					DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $check_data['amount'], $userDetails['id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $userDetails['id'],
						'other_id' => $check_data['id'],
						'amount' => $check_data['amount'],
						'type' => 'reject-internation-tour',
						'created_at'  => $date,
					));

					//for user
					DB::query("UPDATE model_user SET balance=round(balance+%d) WHERE id=%s", $check_data['amount'], $check_data['user_id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $check_data['user_id'],
						'other_id' => $check_data['id'],
						'amount' => $check_data['amount'],
						'type' => 'model-reject-internation-tour',
						'created_at'  => $date,
					));
					echo '<script>
							alert("Request has reject Successfully");
							window.location="services-requested.php";
						</script>';
					die;
				}
			}
		}
	} elseif ($_GET['service-name'] == 'movie_assignments') {
$stringQuery = "SELECT tb.*,mu.username,mu.profile_pic,mu.id as user_id FROM booking_movie_assignments tb 
join model_user mu on mu.unique_id = tb.unique_user_id
where model_unique_id='".$userDetails['unique_id']."' and tb.id=" . $_GET['service_id'];

		$check_data = DB::queryFirstRow($stringQuery);
		if ($check_data) {
			if ($check_data['status'] == 'accept' || $check_data['status'] == 'reject') {
				//echo 'You Already set action';die;
				echo '<script>
					alert("You Already set action");
					window.location="services-requested.php";
					</script>';
			} else {
				if ($_GET['action'] == 'accept') {
					$sql_gs = 'UPDATE `booking_movie_assignments` SET `status` = "accept" WHERE `id` = ' . $_GET['service_id'] . '';
					if (mysqli_query($con, $sql_gs)) {
						echo '<script>
										alert("Request has Accepted Successfully");
										window.location="services-requested.php";
									</script>';
						die;
					}
				} else if ($_GET['action'] == 'reject') {

					DB::query('UPDATE `booking_movie_assignments` SET `status` = "reject" WHERE `id` = ' . $_GET['service_id']);

					DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $check_data['amount'], $userDetails['id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $userDetails['id'],
						'other_id' => $check_data['id'],
						'amount' => $check_data['amount'],
						'type' => 'reject-movie-assignments',
						'created_at'  => $date,
					));

					//for user
					DB::query("UPDATE model_user SET balance=round(balance+%d) WHERE id=%s", $check_data['amount'], $check_data['user_id']);
					DB::insert('model_user_transaction_history', array(
						'user_id' => $check_data['user_id'],
						'other_id' => $check_data['id'],
						'amount' => $check_data['amount'],
						'type' => 'model-reject-movie-assignments',
						'created_at'  => $date,
					));
					echo '<script>
					alert("Request has reject Successfully");
					window.location="services-requested.php";
				</script>';
					die;
				}
			}
		}
	} elseif ($_GET['service-name'] == 'dating_assignments' && $_GET['action'] == 'accept') {
		$sql_gs5 = 'UPDATE `booking_dating_assignments` SET `status` = "accept" WHERE `id` = ' . $_GET['service_id'] . ';';
		if (mysqli_query($con, $sql_gs5)) {
			echo '<script>
							alert("Request has Accepted Successfully");
							window.location="services-requested.php";
						</script>';
		}
	} elseif ($_GET['service-name'] == 'dating_assignments' && $_GET['action'] == 'reject') {
		$sql_gs6 = 'UPDATE `booking_dating_assignments` SET `status` = "reject" WHERE `id` = ' . $_GET['service_id'] . ';';
		if (mysqli_query($con, $sql_gs6)) {
			echo '<script>
							alert("Request has Rejected Successfully");
							window.location="services-requested.php";
						</script>';
		}
	} 
} else {
	echo '<script>
alert("There is no data");
window.location="services-requested.php";
</script>';
}
