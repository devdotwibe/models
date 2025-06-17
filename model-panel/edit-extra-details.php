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
$activeTab = 'services';

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
			<div class="tab-content">
				<div role="tabpanel" class=" my_form tab-pane active" id="home">
					<form method="post" action="update-extra-details.php">
						<h3>Live Cam:</h3>
						<p>Do you want to perform on live camera for viewers?</p>
						<div class="form-group">
							<label for="exampleInputEmail1">
								<!-- Live Cam: -->
							</label>
							<select class="form-control" name="live_cam" id="i-live_cam" onchange="changeOption('live_cam')">
								<option value="">Select Option</option>
								<option value="Yes" <?= $rowes1['live_cam'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
								<option value="No" <?= $rowes1['live_cam'] == 'No' ? 'selected' : '' ?>>No</option>
							</select>
						</div>
						<!-- <input type="checkbox" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"> -->
						<div id="live_cam_option">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">You want to accept private show requests:</label>
									<select class="form-control" name="lc_private">
										<option value="">Select Option</option>
										<option value="Yes" <?= $rowes1['lc_private'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
										<option value="No" <?= $rowes1['lc_private'] == 'No' ? 'selected' : '' ?>>No</option>
									</select>

								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<div class="checkbox">
										<label><input type="checkbox" name="lc_ownsite" value="1" class="i-lc_ownsite" onclick="select_lc('lc_ownsite')" <?= $rowes1['lc_ownsite'] == 1 ? 'checked' : '' ?>>Thelivemodels Only</label>
									</div>
								</div>
							</div>
							<div class="row lc_ownsite-option" style="display:none">
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Tokens per show:</label>
									<input type="number" class="form-control" name="lc_per_show_amount" 
									value="<?php echo $rowes1['lc_per_show_amount']; ?>" placeholder="Tokens per show">
								</div>
							</div>


							<div class="row">
								<div class="form-group col-md-6">
									<div class="checkbox">
										<label><input type="checkbox" name="lc_platforms" value="1" class="i-lc_platforms" onclick="select_lc('lc_platforms')"  <?= $rowes1['lc_platforms'] == 1 ? 'checked' : '' ?>>Other Platforms</label>
									</div>

								</div>
							</div>
							<div class="lc_platforms-option" style="display:none">
							<p>Connect your social media account</p>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Instagram Profile URL:</label>
									<input type="text" class="form-control" name="insta_p_url" value="<?php echo $rowes1['insta_p_url']; ?>" placeholder="Instagram Profile URL">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Tokens:</label>
									<input type="text" class="form-control" name="insta_tokens" value="<?php echo $rowes1['insta_tokens']; ?>" placeholder="Tokens">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Snapchat Profile URL:</label>
									<input type="text" class="form-control" name="snap_p_url" value="<?php echo $rowes1['snap_p_url']; ?>" placeholder="Snapchat Profile URL">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Tokens:</label>
									<input type="text" class="form-control" name="snap_tokens" value="<?php echo $rowes1['snap_tokens']; ?>" placeholder="Tokens">
								</div>
							</div>
							</div>

						</div>
						<div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>

						<h3>Group show:</h3>
						<p>Group shows enables you to create groups of people and perform a camera show for all at once. Do you want to perform in Group shows?</p>
						<div class="form-group">
							<label for="exampleInputPassword1">
								<!-- Group show: -->
							</label>
							<select class="form-control" name="group_show" id="i-group-show" onchange="changeOption('group-show')">
								<option>Select Option</option>
								<option value="Yes" <?= ($rowes1['group_show'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
								<option value="No" <?= ($rowes1['group_show'] == 'No') ? 'selected' : '' ?>>No</option>

							</select>
						</div>
						<div id="group-show_option">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Min members:</label>
									<input type="text" name="min_member" value="<?php echo $rowes1['gs_min_member']; ?>" class="form-control" placeholder="Min members:">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Token Price per member:</label>
									<input type="text" name="t_price_member" value="<?php echo $rowes1['gs_token_price']; ?>" class="form-control" placeholder="Token Price per member:">
								</div>
							</div>

							<div class="p-4 ">
								<button type="button" onclick="add_option()" class="btn btn-primary">Add Group show</button>
								<table class="table assign-table">
									<thead class="thead-light">
										<tr>
											<th>Date</th>
											<th>Time</th>
											<th>Token Price per member</th>
											<th style="width:10px">&nbsp;</th>
										</tr>
									</thead>
									<tbody class="option-list-wp files-list">
										<?php
										$i_j = 0;
										if ($group_show_list) {
											foreach ($group_show_list as $set_group_show_list) {
												$showDate = h_dateFormat($set_group_show_list['dates'], 'd-m-Y');
												$i_j++;
										?>
												<tr class="product-item" id="i-l-<?= $i_j ?>">
													<td><input type="text" name="group_show_option[<?= $i_j ?>][dates]" value="<?= $showDate ?>" class="form-control i-date required" placeholder="Date" data-date-format="dd-mm-yyyy" autocomplete="off" required /></td>
													<td><select name="group_show_option[<?= $i_j ?>][times]" class="form-control required" required>
															<?php
															foreach ($time_list as $t_key => $t_val) {
															?>
																<option value="<?= $t_key ?>" <?= $set_group_show_list['times'] == $t_key ? 'selected' : '' ?>><?= $t_val ?></option>
															<?php
															}
															?>
														</select>
													</td>

													<td><input type="number" name="group_show_option[<?= $i_j ?>][amount]" value="<?= $set_group_show_list['amount'] ?>" min="1" class="form-control " required></td>
													<td><button type="button" class="btn btn-xs btn-default btn-close" onclick="remove_option(<?= $i_j ?>)"><i class="fa fa-times"></i></button></td>
												</tr>

										<?php
											}
										}
										?>

									</tbody>
								</table>


							</div>
						</div>

						<div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
						<h3>Dating assignments:</h3>
						<p>Do you want to work as an escorts?</p>
						<div class="form-group">
							<label for="exampleInputPassword1">
								<!-- Dating assignments: -->
							</label>
							<select class="form-control" name="es_work" id="escorts">
								<option>Select Option</option>
								<option value="Yes" <?= $rowes1['work_escort'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
								<option value="No" <?= $rowes1['work_escort'] == 'No' ? 'selected' : '' ?>>No</option>
							</select>
						</div>
						<?php //if($rowes1['work_escort'] == 'Yes'){ 
						?>
						<?php $es_work = $rowes1['work_escort']; ?>
						<div id="escorts_details">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Incall per Hours Rates (In $):</label>
									<input type="text" name="in_per_hour" value="<?php echo $rowes1['in_per_hour']; ?>" class="form-control" placeholder="Incall per Hours Rates (In $)">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Incall Overnight Rates (In $):</label>
									<input type="text" name="in_overnight" value="<?php echo $rowes1['in_overnight']; ?>" class="form-control" placeholder="Incall Overnight Rates (In $)">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Outcall per Hours Rates (In $):</label>
									<input type="text" name="out_per_hour" value="<?php echo $rowes1['out_per_hour']; ?>" class="form-control" placeholder="Outcall per Hours Rates (In $)">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Outcall Overnight Rates (In $):</label>
									<input type="text" name="out_overnight" value="<?php echo $rowes1['out_overnight']; ?>" class="form-control" placeholder="Outcall Overnight Rates (In $)">
								</div>
							</div>
							<div class="p-4">
								<div class="row dating-assignment-option">
									<div class="col-md-6 mb-3">
										<?php
										$d_a_serviceSelected = array();
										if (!empty($rowes1['d_a_service'])) {
											$d_a_serviceSelected = explode(',', $rowes1['d_a_service']);
										}
										?>
										<label for="vfb-35" class="vfb-desc">Service: </label>
										<select name="d_a_service[]" class="vfb-select  vfb-medium  required " id="i-d_a_service" multiple style="width:100%">
											<?php
											if ($dating_service_list) {
												foreach ($dating_service_list as $set_d) {
											?>
													<option value="<?= $set_d['id'] ?>" <?= $d_a_serviceSelected && in_array($set_d['id'], $d_a_serviceSelected) ? 'selected' : '' ?>><?= $set_d['name'] ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
									<div class="col-md-6 mb-3">
										<label for="i-d_a_address" class="vfb-desc">Address: </label>
										<input type="text" name="d_a_address" value="<?= $rowes1['d_a_address'] ?>" id="i-d_a_address" class="form-control" />
									</div>
								</div>
							</div>

							<div class="dating-assignment-option" style="">
								<div class="row">
									<div class="col-md-12  mb-3">
										<label class="vfb-desc">Schedule : <span class="vfb-required-asterisk">*</span></label>
										<div class="d-flex " style="flex-wrap: wrap;">
											<?php
											foreach ($week_list as $key => $val) {
												$week_data = DB::queryFirstRow("SELECT * FROM model_user_dating_time WHERE user_id = %s and week_name=%s", $_SESSION['log_user_id'], $val);
											?>

												<div class="col-md-12 d-flex " style="flex: 0 0 auto;    padding: 10px 30px;
    border: solid 1px #CCC;
    margin-bottom: 2px;">
													<label class="checkbox-inline" style="display:inline-block;width:100px">
														<input type="checkbox" name="time_schedule[<?= $val ?>][week]" onClick="select_week('<?= $val ?>')" value="<?= $val ?>" class="i-<?= $val ?>" <?= $week_data ? 'checked' : '' ?>><?= ucfirst($val) ?></label>
													<div>
														<div class="week-time-list cp-<?= $val ?>" style=" <?= $week_data ? '' : 'display:none' ?>">
															<select class="form-control" name="time_schedule[<?= $val ?>][from]">
																<option value="">From</option>
																<?php
																foreach ($time_list as $t_key => $t_val) {
																?>
																	<option value="<?= $t_key ?>" <?= $week_data && $week_data['f_time'] == $t_key ? 'selected' : '' ?>><?= $t_val ?></option>
																<?php
																}
																?>
															</select>
														</div>
													</div>
													<div>
														<div class="week-time-list cp-<?= $val ?>" style=" <?= $week_data ? '' : 'display:none' ?>">
															<select class="form-control" name="time_schedule[<?= $val ?>][to]">
																<option value="">To</option>
																<?php
																foreach ($time_list as $t_key => $t_val) {
																?>
																	<option value="<?= $t_key ?>" <?= $week_data && $week_data['t_time'] == $t_key ? 'selected' : '' ?>><?= $t_val ?></option>
																<?php
																}
																?>
															</select>
														</div>
													</div>
												</div>
											<?php
											}
											?>
										</div>
									</div>


								</div>
							</div>
						</div>

						<div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
						<?php //} 
						?>
						<h3>Accept International tours:</h3>
						<p>Fly to the client. Do you want to accept International tours?</p>
						<div class="form-group">
							<label for="exampleInputPassword1">Accept International tours:</label>
							<select class="form-control" name="inter_tour" id="internation_tour">
								<option>Select Option</option>
								<option value="Yes" <?= $rowes1['International_tours'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
								<option value="No" <?= $rowes1['International_tours'] == 'No' ? 'selected' : '' ?>>No</option>
							</select>
						</div>
						<?php //if($rowes1['International_tours'] == 'Yes'){ 
						?>
						<?php $International_tours = $rowes1['International_tours']; ?>
						<div id="internation_tour_details">

							<div class="row">
								<div class="col-md-6 international-tours-option mb-3">
									<label for="vfb-35" class="vfb-desc">Schedule : <span class="vfb-required-asterisk">*</span></label>
									<div class="d-flex " style="flex-wrap: wrap;">
										<?php
										$i_t_scheduleSelected  = array();
										if (!empty($rowes1['i_t_schedule'])) {
											$i_t_scheduleSelected = explode(',', $rowes1['i_t_schedule']);
										}
										foreach ($month_list as $key => $val) {
										?><div class="col-md-3" style="flex: 0 0 auto;">
												<label class="checkbox-inline" style="display:inline-block;margin-left:20px; padding-left:10px">
													<input type="checkbox" name="i_t_schedule[]" value="<?= $key ?>" <?= $i_t_scheduleSelected && in_array($key, $i_t_scheduleSelected) ? 'checked' : '' ?>><?= $val ?></label>
											</div>
										<?php
										}
										?>
									</div>
								</div>

								<div class="col-md-6 international-tours-option mb-3">
									<label for="vfb-35" class="vfb-desc">Rates Per Day: <span class="vfb-required-asterisk">*</span></label>
									<div class="">
										<input type="number" name="i_t_day" value="<?= $rowes1['i_t_day'] ?>" min="0" class="vfb-text vfb-date-picker vfb-medium  required " />
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 international-tours-option mb-3">
									<label for="vfb-35" class="vfb-desc">Week: <span class="vfb-required-asterisk">*</span></label>
									<div class="">
										<input type="number" name="i_t_week" value="<?= $rowes1['i_t_week'] ?>" min="0" class="vfb-text vfb-date-picker vfb-medium  required " />
									</div>
								</div>

								<div class="col-md-6 international-tours-option mb-3">
									<label for="vfb-35" class="vfb-desc">Month: <span class="vfb-required-asterisk">*</span></label>
									<div class="">
										<input type="number" name="i_t_month" value="<?= $rowes1['i_t_month'] ?>" min="0" class="vfb-text vfb-date-picker vfb-medium  required " />
									</div>
								</div>

								<div class="col-md-6 international-tours-option mb-3">
									<label for="vfb-35" class="vfb-desc">Annual: <span class="vfb-required-asterisk">*</span></label>
									<div class="">
										<input type="number" name="i_t_annual" value="<?= $rowes1['i_t_annual'] ?>" min="0" class="vfb-text vfb-date-picker vfb-medium  required " />
										<div style="font-size:12px">* Extra for Visa Travel and accommodation if not staying home</div>
									</div>
								</div>
								<div class="col-md-6 international-tours-option mb-3">
									<label for="vfb-35" class="vfb-desc">Countries To Travel: <span class="vfb-required-asterisk">*</span></label>
									<div class="">
										<select name="i_t_country[]" class="vfb-select  vfb-medium  required " id="i-i_t_country" style="width:100%" multiple>
											<?php
											$i_t_countrySelected  = array();
											if (!empty($rowes1['i_t_country'])) {
												$i_t_countrySelected = explode(',', $rowes1['i_t_country']);
											}

											foreach ($country_list as $val) {
											?>
												<option value="<?= $val['id'] ?>" <?= $i_t_countrySelected && in_array($val['id'], $i_t_countrySelected) ? 'selected' : '' ?>><?= $val['name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>



								<!--            <li class="vfb-item vfb-item-date   vfb-right-half" id="2hours">
               <label for="vfb-35" class="vfb-desc">2 Hours Rates (In $): <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="to_hour" id="vfb-35" value="" class="vfb-text vfb-date-picker  vfb-medium  required "  />
            </li>
            <li class="vfb-item vfb-item-text   vfb-left-half" id="4hours">
               <label for="vfb-37" class="vfb-desc">4 Hours Rates (In $): <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="for_hour" id="vfb-37" value="" class="vfb-text  vfb-medium  required  " />
            </li>
            <li class="vfb-item vfb-item-text   vfb-right-half" id="overnight">
               <label for="vfb-38" class="vfb-desc">Overnight Rates (In $): <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="overnight" id="vfb-38" value="" class="vfb-text  vfb-medium  required  " />
            </li>-->
							</div>
						</div>
						<div style="width: 100%; border-bottom: 2px solid #c9381b;padding: 6px ; margin-bottom: 25px;"></div>
						<?php //} 
						?>
						<h3>Sell Video and Images:</h3>
						<div class="form-group">
							<label for="exampleInputPassword1">
								<!-- Sell Video and Image's: -->
							</label>
							<select class="form-control" name="video_pictures" id="sell_video_image">
								<option>Select Option</option>
								<?php if ($rowes1['video_pictures'] == 'Yes') { ?>
									<option value="Yes" selected="selected">Yes</option>
									<option value="No">No</option>
								<?php } elseif ($rowes1['video_pictures'] == 'No') { ?>
									<option value="Yes">Yes</option>
									<option value="No" selected="selected">No</option>
								<?php } else { ?>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								<?php } ?>
							</select>
						</div>
						<div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
						<h3>Accept Modeling/ Movie assignment</h3>
						<div class="form-group">
							<label for="exampleInputPassword1">
								<!-- Accept Modeling/ Movie assignment? -->
							</label>
							<select class="form-control" name="modeling_porn_assignment" id="i-movie-assignment" onchange="changeOption('movie-assignment')">
								<option>Select Option</option>
								<option value="Yes" <?= ($rowes1['modeling_porn_assignment'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
								<option value="No" <?= ($rowes1['modeling_porn_assignment'] == 'No') ? 'selected' : '' ?>>No</option>

							</select>
						</div>
						<!-- <div class="row" id="modeling_porn_details">
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Per hour price of shoot? (In $)</label>
			    <input type="text" name="perhourshoot" value="<?php echo $rowes1['shoot_per_hour_price']; ?>" class="form-control" placeholder="Per hour price of shoot? (In $)">
			  </div>
		  </div> -->

						<div class="p-4 " id="movie-assignment_option">
							<p>The form will be kept private*</p>
							<div class="row ">
								<div class="col-md-6  mb-3">
									<label class="vfb-desc">I am available </label>
									<div class="">
										<div class="checkbox-inline">
											<input type="checkbox" name="m_a_available[]" value="To travel" <?= in_array('To travel', $m_a_available) ? 'checked' : '' ?> />To Travel
										</div>
										<div class="checkbox-inline">
											<input type="checkbox" name="m_a_available[]" value="In my city" <?= in_array('In my city', $m_a_available) ? 'checked' : '' ?> />In My City
										</div>
									</div>
								</div>

								<div class="col-md-6  mb-3">
									<label class="vfb-desc">I will be interested in </label>
									<div class="">
										<div class="checkbox-inline">
											<input type="checkbox" name="m_a_interested[]" value="Cute & Casual" <?= in_array('Cute & Casual', $m_a_interested) ? 'checked' : '' ?> />Cute & Casual
										</div>

										<div class="checkbox-inline">
											<input type="checkbox" name="m_a_interested[]" value="Lingerie/Bikini" <?= in_array('Lingerie/Bikini', $m_a_interested) ? 'checked' : '' ?> />Lingerie/Bikini
										</div>

										<div class="checkbox-inline">
											<input type="checkbox" name="m_a_interested[]" value="(Hot & Bold) Adult" <?= in_array('(Hot & Bold) Adult', $m_a_interested) ? 'checked' : '' ?> />(Hot & Bold) Adult
										</div>
									</div>
								</div>

							</div>

							<div class="row ">
								<div class="col-md-6  mb-3">
									<label class="vfb-desc">I am comfortable on camera </label>
									<div class="">
										<div class="checkbox">
											<input type="checkbox" name="m_a_comfortable_camera[]" value="Open" <?= in_array('Open', $m_a_comfortable_camera) ? 'checked' : '' ?> /> Open (With Face,Public Profile)
										</div>
										<div class="checkbox">
											<input type="checkbox" name="m_a_comfortable_camera[]" value="Discreet" <?= in_array('Discreet', $m_a_comfortable_camera) ? 'checked' : '' ?> /> Discreet (Without Face,Public Profile)
										</div>
										<div class="checkbox">
											<input type="checkbox" name="m_a_comfortable_camera[]" value="Show" <?= in_array('Show', $m_a_comfortable_camera) ? 'checked' : '' ?> /> Show my profile only to Modelling agencies
										</div>
									</div>
								</div>

								<div class="col-md-6  mb-3">
									<label class="vfb-desc">I want to be paid </label>
									<div class="">
										<div class="radio">
											<input type="radio" name="m_a_paid" value="One Time" <?= $m_a_paid == 'One Time' ? 'checked' : '' ?> />
											One Time ( We will make you a one time payment. You agree to the use of the content on all platforms)
										</div>
										<div class="radio">
											<input type="radio" name="m_a_paid" value="Share Of Profits" <?= $m_a_paid == 'Share Of Profits' ? 'checked' : '' ?> /> Share of profits ( Co-Own your content with us. We share the profits from all platforms sources
										</div>
									</div>
								</div>

							</div>


							<div class="row ">
								<div class="col-md-6  mb-3">
									<label class="vfb-desc">Expected Payout per shoot in NZD</label>
									<input type="number" name="m_a_payout" value="<?= $rowes1['m_a_payout'] ?>" min="0" class="form-control required  " />
								</div>
								<div class="col-md-6  mb-3">
									<label class="vfb-desc">Services</label>
									<select name="m_a_service[]" class="vfb-select  vfb-medium  required " id="i-m_a_service" multiple style="width:100%">
										<?php
										$m_a_serviceSelected  = array();
										if (!empty($rowes1['m_a_service'])) {
											$m_a_serviceSelected = explode(',', $rowes1['m_a_service']);
										}


										if ($dating_service_list) {
											foreach ($dating_service_list as $set_d) {
										?>
												<option value="<?= $set_d['id'] ?>" <?= $m_a_serviceSelected && in_array($set_d['id'], $m_a_serviceSelected) ? 'selected' : '' ?>><?= $set_d['name'] ?></option>
										<?php
											}
										}
										?>
									</select>

								</div>

							</div>

						</div>

						<div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
						<?php //} 
						?>
						<h3>All 30 Days Access:</h3>
						<div class="form-group">
							<?php
							//	  printR($rowes1);
							?>
							<label for="exampleInputPassword1">
								<!-- All 30 Days Access -->
							</label>
							<select class="form-control" name="all_access" id="i-all_access" onChange="changeOption('all_access')">
								<option value="">Select Option</option>
								<option value="Yes" <?= $rowes1['all_30day_access'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
								<option value="No" <?= $rowes1['all_30day_access'] == 'No' ? 'selected' : '' ?>>No</option>
							</select>
						</div>
						<div class="row" id="all_access_option">
							<div class="form-group col-md-6">
								<label for="exampleInputPassword1">All 30 Days access coins? </label>
								<input type="text" name="all_access_price" value="<?= $rowes1['all_30day_access_price'] ?>" class="form-control" placeholder="All 30 Days access coins?">
							</div>
						</div>
						<input type="submit" name="submitButton" class="fancy_button" style="padding: 7px 20px;" value="Submit">
					</form>
				</div>

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