<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

if (isset($_SESSION['log_user_id'])) {
	$id = 0;
	//create post data
	if ($_GET['id']) {
		$id = $_GET['id'];
        $form_data = DB::queryFirstRow("SELECT * FROM banners_campaign WHERE banner_id = %s ",$set_data['id'],true);
		if ($form_data) {
		} else {
            $form_data = array('name','description','gender','age','goal','country','city','state',);
		}
	} else {
		header("Location: " . SITEURL . "advertisement/list.php");
	}
	if ($_POST) {

		$user_id = $_SESSION['log_user_id'];
        $arr = array('name','description','gender','age','goal','country','city','state',);
		$post_data = array_from_post($arr);
		$post_data['banner_id'] = $id;

        if(isset($form_data['id'])){
		    DB::update('banners_campaign', $post_data, "id=%s", $form_data['id']);
        }else{
		    DB::insert('banners_campaign', $post_data);
        }
		//		$created_id = DB::insertId();

		echo '<script>window.location="' . SITEURL . 'advertisement/list.php"</script>';
        die;
	}

} else {
	header("Location: login.php");
}
$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
$goal_list = array('Views', 'Website Visits', 'Post Engagements', 'International Reach', 'Local Reach');

?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<title>Notification | The Live Model</title>
	<?php include('../includes/head.php'); ?>
	<style>
		.thumbnail {
			background: #FFF;
		}
	</style>
</head>

<body class="page-template-default page page-id-319 custom-background">
	<?php include('../includes/header.php'); ?>

	<div class="container">

		<div id="content" class="clearfix row">

			<div id="main" class="col-md-12 clearfix">
				<div class="panel bg-white">
					<div class="panel-body">
						<div>
							<form action="" method="post" class="form-horizontal edit-form" role="form" enctype="multipart/form-data">
								<div class="form-body">

									<div class="form-group row">
										<label class="col-md-3 control-label">Goal *</label>
										<div class="col-md-9">
											<select name="goal" class="form-control">
												<option value="">Select</option>
												<?php
												foreach ($goal_list as $val) {
												?>
													<option value="<?= $val ?>" <?= $form_data['goal'] == $val ? 'selected' : '' ?>><?= $val ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">Gender *</label>
										<div class="col-md-9">
											<select name="gender" class="form-control" required >
                        <option value="all" <?=$form_data['gender']=='all'?'selected':''?>>All</option>
                        <option value="Male" <?=$form_data['gender']=='Male'?'selected':''?>>Male</option>
                        <option value="Female" <?=$form_data['gender']=='Female'?'selected':''?>>Female</option>
                        </select>

										</div>
									</div>									


                        
                        <div class="form-group row">
										<label class="col-md-3 control-label">Age *</label>
										<div class="col-md-9">
                                        <select name="age" class="form-control" required >
                        <option value="">Select</option>
                        <option value="all" <?=$form_data['age']=='all'?'selected':''?>>All</option>
                        <option value="18" <?=$form_data['age']=='18'?'selected':''?>>under 18</option>
                        <option value="25" <?=$form_data['age']=='25'?'selected':''?>>18-25</option>
                        <option value="26" <?=$form_data['age']=='26'?'selected':''?>>26 above</option>
                        </select>
                                    </div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">Title *</label>
										<div class="col-md-9">
											<input type="text" name="name" value="<?= $form_data['name'] ?>" class="form-control" required />
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">Description</label>
										<div class="col-md-9">
											<textarea name="description" class="form-control" required><?= $form_data['description'] ?></textarea>
										</div>
									</div>


									<div class="form-group row">
										<label class="col-md-3 control-label">Country *</label>
										<div class="col-md-9">
											<select name="country" id="i-hs-country" onChange="select_hs_country('')" class="form-control" required>
												<option value="" data-id="">Select</option>
												<?php
												if ($f_country_list) {
													foreach ($f_country_list as $val) {
												?>
														<option value="<?= $val['id'] ?>" <?= $form_data['country'] == $val['id'] ? 'selected' : '' ?>><?= $val['name'] ?></option>
												<?php
													}
												}

												?>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">State *</label>
										<div class="col-md-9">
											<select name="state" id="i-hs-state" onChange="select_hs_state('')" class="form-control"></select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">City *</label>
										<div class="col-md-9">
											<select name="city" id="i-hs-city" class="form-control"></select>

										</div>
									</div>

								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-9 offset-md-3">
											<button type="submit" class="btn btn-info submitBtn">Save</button>
											<a href="<?= SITEURL . 'advertisement/list.php' ?>" class="btn btn-default">Back</a>
										</div>
									</div>
								</div>
							</form>
							<div style="clear:both"></div>

						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<?php include('../includes/footer.php'); ?>
	<script src="<?= SITEURL ?>assets/plugins/jquery.validate.js"></script>
	<script type="text/javascript">
		$(".edit-form").validate({
			submitHandler: function(form) {
				var loadingText = '<i class="fa fa-circle-notch fa-spin"></i> Saving..';
				$('.submitBtn').prop('disabled', true).html(loadingText);
				$('.message').html('');
				return true;
			}
		});
	</script>

	<script>
		function select_hs_country(state) {
			$("#i-hs-city").html('<option value="">Select</option>');
			$("#i-hs-state").html('<option value="">Select</option>');
			var country = $('#i-hs-country').val();
			//	var country = $('#i-hs-country :selected').attr('data-id');
			$.ajax({
				url: '<?= SITEURL . 'ajax/state.php' ?>',
				type: 'get',
				data: {
					country: country,
					selected: state
				},
				dataType: 'json',
				success: function(res) {
					$("#i-hs-state").html('<option value="">Select</option>' + res.list);
					select_hs_state('<?= $form_data['city'] ?>');
				}
			})
		}

		function select_hs_state(city) {
			$("#i-hs-city").html('<option value="">Select</option>');
			var state = $('#i-hs-state').val();
			$.ajax({
				url: '<?= SITEURL . 'ajax/city.php' ?>',
				type: 'get',
				data: {
					selected: city,
					state: state
				},
				dataType: 'json',
				success: function(res) {
					$("#i-hs-city").html('<option value="">Select</option>' + res.list);
				}
			})
		}

		select_hs_country('<?= $form_data['state'] ?>');
	</script>
	<style>
		label.error {
			font-size: 13px;
			color: #F00;
		}
	</style>

	<link href="<?= SITEURL ?>assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="<?= SITEURL ?>assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script>

</body>

</html>