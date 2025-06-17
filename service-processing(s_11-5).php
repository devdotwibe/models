<?php 
	session_start(); 
	include('includes/config.php');

	$usern = $_SESSION["log_user"];

	if( !$usern ){
	    echo '<script>window.location.href="login.php"</script>';
	}
	if($_GET['service-name']=='group_show' && $_GET['action']=='accept'){
		//echo 'accept';
		$sql_gs = 'UPDATE `booking_group_show` SET `status` = "Accepted" WHERE `booking_group_show`.`id` = '.$_GET['service_id'].'';
		if (mysqli_query($con, $sql_gs)) {
			echo '<script>
							alert("Request has Accepted Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='group_show' && $_GET['action']=='reject') {
		$sql_gs2 = 'UPDATE `booking_group_show` SET `status` = "Reject" WHERE `booking_group_show`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs2)) {
			echo '<script>
							alert("Request has Rejected Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='internation_tour' && $_GET['action']=='accept') {
		$sql_gs3 = 'UPDATE `booking_international_call` SET `status` = "Accepted" WHERE `booking_international_call`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs3)) {
			echo '<script>
							alert("Request has Accepted Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='internation_tour' && $_GET['action']=='reject') {
		$sql_gs4 = 'UPDATE `booking_international_call` SET `status` = "Reject" WHERE `booking_international_call`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs4)) {
			echo '<script>
							alert("Request has Rejected Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='dating_assignments' && $_GET['action']=='accept') {
		$sql_gs5 = 'UPDATE `booking_dating_assignments` SET `status` = "Accepted" WHERE `booking_dating_assignments`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs5)) {
			echo '<script>
							alert("Request has Accepted Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='dating_assignments' && $_GET['action']=='reject') {
		$sql_gs6 = 'UPDATE `booking_dating_assignments` SET `status` = "Reject" WHERE `booking_dating_assignments`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs6)) {
			echo '<script>
							alert("Request has Rejected Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='movie_assignments' && $_GET['action']=='accept') {
		$sql_gs7 = 'UPDATE `booking_movie_assignments` SET `status` = "Accepted" WHERE `booking_movie_assignments`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs7)) {
			echo '<script>
							alert("Request has Accepted Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}elseif ($_GET['service-name']=='movie_assignments' && $_GET['action']=='reject') {
		$sql_gs8 = 'UPDATE `booking_movie_assignments` SET `status` = "Reject" WHERE `booking_movie_assignments`.`id` = '.$_GET['service_id'].';';
		if (mysqli_query($con, $sql_gs8)) {
			echo '<script>
							alert("Request has Rejected Successfully");
							window.location="services-requested.php";
						</script>';
		}
	}
?>
