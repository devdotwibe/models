<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
if (isset($_SESSION['log_user_id'])) {
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {
	} else {
		echo '<script>window.location.href="' . SITEURL . 'login.php"</script>';
		die;
	}
} else {
	echo '<script>window.location.href="' . SITEURL . 'login.php"</script>';
	die;
}

$model_extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $_SESSION['log_user_unique_id']);
//echo DB::lastQuery();
if (!$model_extra_details) {
	header("Location: " . SITEURL . "new-broadcaster.php");
}

$time_list = get_time(true);
$week_list = get_week();
$month_list = get_sort_month();
$country_list = DB::query("SELECT id,name from countries order by name asc");
if ($userDetails['gender'] == 'Male') {
	$dating_service_list = DB::query("SELECT id,name from dating_assignment_service where status=1 and type='male'  order by name asc");
} else {
	$dating_service_list = DB::query("SELECT id,name from dating_assignment_service where status=1 and type='female' order by name asc");
}

$heightArr = array(
	'4.5', '4.6', '4.7', '4.8', '4.9', '4.10', '4.11', '5', '5.1', '5.2', '5.3',
	'5.4', '5.5', '5.6', '5.7', '5.8', '5.9', '5.10', '5.11', '6',
	'6.1', '6.2', '6.3', '6.4', '6.5', '6.6', 'Other'
);
$colorArr = array("Hazel", "Brown", "Blue", "Green", "Black", "Grey", "Other");

$m_a_comfortable_camera = $m_a_interested  = $m_a_available = array();
$m_a_paid = 'One Time';

$International_tours = "";
$es_work = "";


$sql1 = "SELECT * FROM model_extra_details WHERE unique_model_id = '" . $_SESSION["log_user_unique_id"] . "'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) > 0) {
	$rowes1 = mysqli_fetch_assoc($result1);
	// echo '<pre>';
	// print_r($rowes1);
	// echo '</pre>';
	// $my_va = $rowes1['International_tours'];

}
if (!empty($rowes1['m_a_comfortable_camera'])) {
	$m_a_comfortable_camera = explode(',', $rowes1['m_a_comfortable_camera']);
}
if (!empty($rowes1['m_a_interested'])) {
	$m_a_interested = explode(',', $rowes1['m_a_interested']);
}

if (!empty($rowes1['m_a_available'])) {
	$m_a_available = explode(',', $rowes1['m_a_available']);
}

if (!empty($rowes1['m_a_paid'])) {
	$m_a_paid = $rowes1['m_a_paid'];
}
$group_show_list = DB::query("SELECT * from model_user_group_show where user_id='" . $_SESSION['log_user_id'] . "'");

$activeTab = 'about';

?>
<html lang="en-US" class="no-js">
<!DOCTYPE html>
<html>

<head>
	<title>Edit Extra Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel='stylesheet' href='<?= '../assets/wp-content/themes/theagency3/library/css/style.css' ?>' type='text/css' media='all' />
	<!-- <script src="<?= 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' ?>"></script> -->
	<link rel="icon" href="<?= '../assets/wp-content/themes/theagency3/favicon5e1f.png?v=2' ?>">
	<script type='text/javascript' src='<?= '../assets/wp-includes/js/jquery/jquery.js' ?>' id='jquery-core-js'></script>
	<link href="<?= 'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css' ?>" rel="stylesheet">
	<script src="<?= 'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js' ?>"></script>
	<?php include('../includes/head_css.php'); ?>

	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
	<script src="<?= 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js' ?>"></script>
	<style type="text/css">
		.my_form {
			width: 71%;
			margin: 0px auto 0px auto;
			padding: 20px 0 20px 0;
		}

		label {
			color: #ffffff;
		}

		.login-signup {
			padding: 0 0 25px;
		}

		.nav-tab-holder {
			/* padding: 0 0 0 30px;
			float: right; */
		}

		.nav-tab-holder .nav-tabs {
			border: 0;
			float: none;
			display: table;
			table-layout: fixed;
			width: 83%;
			margin: auto;
		}

		.nav-tab-holder .nav-tabs>li {
			margin-bottom: -3px;
			text-align: center;
			padding: 0;
			display: table-cell;
			float: none;
			padding: 0;
		}

		.nav-tab-holder .nav-tabs>li>a {
			background: #d9d9d9;
			color: #6c6c6c;
			margin: 0;
			font-size: 18px;
			font-weight: 300;
		}

		.nav-tab-holder .nav-tabs>li.active>a,
		.nav-tabs>li.active>a:hover,
		.nav-tabs>li.active>a:focus {
			color: #FFF;
			background-color: #c9381b;
			border: 0;
			border-radius: 0;
		}

		.mobile-pull {
			float: right;
		}

		@media screen and (max-width: 600px) {
			.my_form {
				width: 100%;
				margin: auto;
			}

			.nav-tab-holder .nav-tabs {
				width: 100% !important;
			}

			.nav-tab-holder .nav-tabs>li {
				width: 100px;
			}
		}
	</style>
	<style>
		.mb-3 {
			margin-bottom: 1rem;
		}

		.d-flex {
			display: flex;
		}
	</style>
</head>

<body>
	<?php include('../includes/header.php'); ?>
	<div class="login-signup" style="background-color: #16161e;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
<?php
include('../user_tab/edit_profile_menu_tab.php');
?>
				</div>

			</div>
			<div class="">
					<?php
					$sql1 = "SELECT * FROM model_extra_details WHERE unique_model_id = '" . $_SESSION["log_user_unique_id"] . "'";
					$result1 = mysqli_query($con, $sql1);
					if (mysqli_num_rows($result1) > 0) {
						$rowes1 = mysqli_fetch_assoc($result1);
						// echo '<pre>';
						// print_r($rowes1);
						// echo '</pre>';
						// $my_va = $rowes1['International_tours'];

					}
					?>

					<form id="casting-3" class="my_form" action="update-new-broadcaster.php" method="post" enctype="multipart/form-data">
						<div class="vfb-legend">
							<h3>Stats and Figure:</h3>
						</div>
						<?php
						if ($userDetails['gender'] == 'Female') {
						?>
							<div class="form-group">
								<label for="exampleInputEmail1">Bust Size :</label>
								<select class="form-control" name="bust-size" id="bust-size">
									<option value="" selected='selected'>Select Bust Size </option>
									<option value="30" <?= $rowes1['bust_size'] == 30 ? 'selected' : '' ?>>30</option>
									<option value="32" <?= $rowes1['bust_size'] == 32 ? 'selected' : '' ?>>32</option>
									<option value="34" <?= $rowes1['bust_size'] == 34 ? 'selected' : '' ?>>34</option>
									<option value="36" <?= $rowes1['bust_size'] == 36 ? 'selected' : '' ?>>36</option>
									<option value="38" <?= $rowes1['bust_size'] == 38 ? 'selected' : '' ?>>38</option>
									<option value="40" <?= $rowes1['bust_size'] == 40 ? 'selected' : '' ?>>40</option>
									<option value="42" <?= $rowes1['bust_size'] == 42 ? 'selected' : '' ?>>42</option>
									<option value="44" <?= $rowes1['bust_size'] == 44 ? 'selected' : '' ?>>44</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Cup Size :</label>
								<select class="form-control" name="cup-size" id="bust-size">
									<option value="" selected='selected'>Select Cup Size </option>

									<option value="A" <?= ($rowes1['cup_size'] == 'A') ? 'selected' : '' ?>>A</option>
									<option value="B" <?= ($rowes1['cup_size'] == 'B') ? 'selected' : '' ?>>B</option>
									<option value="C" <?= ($rowes1['cup_size'] == 'C') ? 'selected' : '' ?>>C</option>
									<option value="D" <?= ($rowes1['cup_size'] == 'D') ? 'selected' : '' ?>>D</option>
									<option value="DD" <?= ($rowes1['cup_size'] == 'DD') ? 'selected' : '' ?>>DD</option>
									<option value="E" <?= ($rowes1['cup_size'] == 'E') ? 'selected' : '' ?>>E</option>
									<option value="F" <?= ($rowes1['cup_size'] == 'F') ? 'selected' : '' ?>>F</option>
								</select>
							</div>
						<?php
						}
						?>

						<div class="form-group">
							<label for="exampleInputEmail1">Waist Size :</label>
							<select class="form-control" name="waist-size" id="bust-size">
								<option value="" selected='selected'>Select Waist Size </option>
								<?php
								for ($i = 22; $i <= 42; $i++) {
								?>
									<option value="<?= $i ?>" <?= $i == $rowes1['waist_size'] ? 'selected' : '' ?>><?= $i ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Ethnicity:</label>
							<input type="text" name="ethnicity" value="<?php echo $rowes1['ethnicity']; ?>" class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Height:</label>
							<select class="form-control" name="height" id="bust-size">
								<option value="" selected='selected'>Select Height</option>
								<?php
								foreach ($heightArr as $setHeight) {
								?>
									<option value="<?= $setHeight ?>" <?= $setHeight == $rowes1['height'] ? 'selected' : '' ?>><?= $setHeight ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Weight (enter weight in pounds) :</label>
							<input type="text" name="weight" value="<?php echo $rowes1['weight']; ?>" class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Eye Color :</label>
							<select class="form-control" name="eye-color" id="bust-size">
								<option value="" selected='selected'>Select Eye Color </option>

								<?php
								foreach ($colorArr as $seColor) {
								?>
									<option value="<?= $seColor ?>" <?= $seColor == $rowes1['eye_color'] ? 'selected' : '' ?>><?= $seColor ?></option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Hair Color :</label>
							<select class="form-control" name="hair-color" id="bust-size">
								<option value="" selected='selected'>Select Hair Color</option>
								<?php if ($rowes1['hair_color'] == 'Blonde') { ?>
									<option value="Blonde" selected="selected">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Dirty Blonde') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde" selected="selected">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Platinum Blonde') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde" selected="selected">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Strawberry Blonde') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde" selected="selected">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Black') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black" selected="selected">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Brown') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown" selected="selected">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Brunette') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette" selected="selected">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Red') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red" selected="selected">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Salt n Pepper') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper" selected="selected">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } elseif ($rowes1['hair_color'] == 'Other') { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other" selected="selected">Other</option>
								<?php } else { ?>
									<option value="Blonde">Blonde</option>
									<option value="Dirty Blonde">Dirty Blonde</option>
									<option value="Platinum Blonde">Platinum Blonde</option>
									<option value="Strawberry Blonde">Strawberry Blonde</option>
									<option value="Black">Black</option>
									<option value="Brown">Brown</option>
									<option value="Brunette">Brunette</option>
									<option value="Red">Red</option>
									<option value="Salt n Pepper">Salt n Pepper</option>
									<option value="Other">Other</option>
								<?php } ?>
							</select>
						</div>

						&nbsp;
						<input type="submit" name="submitButton" class="fancy_button" style="padding: 7px 20px;" value="Submit">
					</form>
			</div>
		</div>
	</div>
	</div>
	<?php include('../includes/footer.php'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#escorts_details").hide();
			$("#internation_tour_details").hide();


			var International_tours = "<?php echo $International_tours; ?>";
			if (International_tours == "No") {
				$("#internation_tour_details").hide();
			} else if (International_tours == "Yes") {
				$("#internation_tour_details").show();
			} else {
				$("#internation_tour_details").hide();
			}

			var es_work = "<?php echo $es_work; ?>";
			if (es_work == "No") {
				$("#escorts_details").hide();
			} else if (es_work == "Yes") {
				$("#escorts_details").show();
			} else {
				$("#escorts_details").hide();
			}

			$('#escorts').on('change', function() {
				var escorts = $("#escorts").val();
				if (escorts == "Yes") {
					$("#escorts_details").show();
				} else if (escorts == "No") {
					$("#escorts_details").hide();
				}
			});
			$('#internation_tour').on('change', function() {
				var internation_tour = $("#internation_tour").val();
				if (internation_tour == "Yes") {
					$("#internation_tour_details").show();
				} else if (internation_tour == "No") {
					$("#internation_tour_details").hide();
				}
			});
		});

		function changeOption(type) {
			var vl = $('#i-' + type).val();
			console.log(vl + ' #' + type + '_option');
			if (vl == 'Yes') {
				$('#' + type + '_option').show();
			} else {
				$('#' + type + '_option').hide();
			}
		}
		changeOption('all_access');
		changeOption('movie-assignment');
		changeOption('live_cam')
	</script>

	<link rel="stylesheet" href="<?= SITEURL ?>assets/plugins/select2/dist/css/select2.css">
	<script src="<?= SITEURL ?>assets/plugins/select2/dist/js/select2.js"></script>

	<link href="<?= SITEURL ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?= SITEURL ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


	<script>
		$('#i-i_t_country').select2({
			placeholder: "Select Country",
		});
		$('#i-d_a_service').select2({
			placeholder: "Select Service",
		});
		$('#i-m_a_service').select2({
			placeholder: "Select Service",
		});
	</script>
	<style>
		/*.select2-container--default.select2-container--focus .select2-selection--multiple */
		.select2-container--default .select2-selection--multiple {
			background-color: #2a2a31;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li,
		.select2-container .select2-search--inline {
			float: initial;
			display: inline-block;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
			padding: 0px 10px !important
		}
	</style>

	<script>
		function select_week(type) {
			setTimeout(function() {
				$('.cp-' + type).hide();
				if ($('.i-' + type).prop("checked") === true) {
					$('.cp-' + type).show();
				}
			}, 300);
		}
	</script>


	<script id="options_script" type="text/html">
		<tr class="product-item" id="i-l-%%IDS%%">
			<td><input type="text" name="group_show_option[%%IDS%%][dates]" class="form-control i-date required" placeholder="Date" data-date-format="dd-mm-yyyy" autocomplete="off" required /></td>
			<td><select name="group_show_option[%%IDS%%][times]" class="form-control required" required>
					<?php
					foreach ($time_list as $t_key => $t_val) {
					?>
						<option value="<?= $t_key ?>"><?= $t_val ?></option>
					<?php
					}
					?>
				</select>
			</td>

			<td><input type="number" name="group_show_option[%%IDS%%][amount]" value="1" min="1" class="form-control " required></td>
			<td><button type="button" class="btn btn-xs btn-default btn-close" onclick="remove_option(%%IDS%%)"><i class="fa fa-times"></i></button></td>
		</tr>
	</script>

	<script>
		var j = parseInt(<?= $i_j++ ?>);
		var wrapper = $(".option-list-wp"); //Fields wrapper
		function add_option() { //on add input button click
			j++;
			name = $('#i-product option:selected').text();
			html = $('#options_script').html();
			html = html.replace(/%%IDS%%/g, j);
			$(wrapper).append(html);

			setTimeout(function() {
				$('.i-date').datepicker({
					dateFormat: 'mm-dd-yy',
					altField: '#input-date_alt',
					altFormat: 'yy-mm-dd'
				}).on('changeDate', function(e) {
					$(this).datepicker('hide');
				});
			}, 200);

			//$('#i-l-'+j+' .tag_field').select2({placeholder: "Select"});
		}

		function remove_option(id) {
			$('#i-l-' + id).remove();
		}

		$('.i-date').datepicker({
			dateFormat: 'mm-dd-yy',
			altField: '#input-date_alt',
			altFormat: 'yy-mm-dd'
		}).on('changeDate', function(e) {
			$(this).datepicker('hide');
		});
	</script>
<script>
function select_lc(type) {
	setTimeout(function() {
		$('.'+type+'-option').hide();
		if ($('.i-' + type).prop("checked") === true) {
			$('.'+type+'-option').show();
		}
	}, 300);

}

select_lc('lc_ownsite');
select_lc('lc_platforms');
</script>

</body>

</html>