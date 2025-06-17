<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

if (isset($_SESSION['log_user_id'])) {
	//create post data
	if ($_POST) {

		$user_id = $_SESSION['log_user_id'];
		$arr = array('name', 'subtitle', 'description', 'category','service', 'country', 'state', 'city','terms_conditions');
		$post_data = array_from_post($arr);
		//$post_data = array_from_get($arr);
		$post_data['user_id'] = $user_id;
		$post_data['created_at'] = date('Y-m-d H:i:s');

		DB::insert('banners', $post_data);
		$created_id = DB::insertId();

		$error = '';
		if ($_FILES["files"]["name"]) {
			$target_dir_profile = "../uploads/banners/";
			$target_file1 = $target_dir_profile . basename($_FILES["files"]["name"]);
			$target_profile = basename($_FILES["files"]["name"]);
			if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file1)) {
				$joe_id = DB::update('banners', array('image' => $target_profile), "id=%s", $created_id);
			} else {
				$error .= 'Image Not Updated';
			}
		}

		if ($_FILES["video_file"]["name"]) {
			$target_dir_profile = "../uploads/banners/";
			$target_file1 = $target_dir_profile . basename($_FILES["video_file"]["name"]);
			$target_profile = basename($_FILES["video_file"]["name"]);
			if (move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file1)) {
				$joe_id = DB::update('banners', array('video' => $target_profile), "id=%s", $created_id);
			} else {
				$error .= '. Video Not Updated';
			}
		}
		
		if (isset($_FILES["additionalimages"])) {
			$totalFiles = count($_FILES['additionalimages']['name']);
			$additional_img = '';
			$target_dir_profile = "../uploads/banners/";
			for ($i = 0; $i < $totalFiles; $i++) {
				$target_file1 = $target_dir_profile . basename($_FILES["additionalimages"]["name"][$i]);
				$target_profile = basename($_FILES["additionalimages"]["name"][$i]);
				if (move_uploaded_file($_FILES["additionalimages"]["tmp_name"][$i], $target_file1)) {
					$additional_img .= $target_profile.'|';
				}
			}
			if(!empty($additional_img)){ 
				$joe_id = DB::update('banners', array('additionalimages' => rtrim($additional_img, "|")), "id=%s", $id);
			}
		}

		if ($error) {
			echo '<script>alert("' . $error . '");</script>';
		}
		echo '<script>window.location="' . SITEURL . 'advertisement/list.php"</script>';
		
		/*  if (move_uploaded_file($_FILES["pic_img"]["tmp_name"], $target_file1)){
	
		  echo '<script>alert("Your Profile Picture Successfully Uploaded");</script>';
	
		  $sql = "UPDATE model_user SET profile_pic = '".$target_profile."' WHERE id = '".$use_id."'";
		
		  if(mysqli_query($con, $sql)){
			echo '<script>alert("Your Profile Picture Successfully Updated");
			 window.location="edit-profile.php"</script>';
		  }else{
			echo '<script>alert("Profile Picture Not Updated.\nPlease try again later.");
			 window.location="edit-profile.php"</script>';
		  }  
	
	  }
	  else{
		  echo '<script>alert("Error in Image uploading");
			 window.location="edit-profile.php"
			</script>';
	  }*/
	}

	$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
	$category_list = adv_category_list();
} else {
	header("Location: login.php");
}
$serviceArr = array('Providing services', 'Looking for services');
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
	

        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	
</head>

<body class="page-template-default page page-id-319 custom-background advt-page">

	<?php include('../includes/header.php'); ?>
	
	<!-- Main Content -->
    <main class="main">

	<div class="container">

		<div id="content" class="clearfix row">

			<div id="main" class="col-md-12 clearfix">
				<div class="panel bg-blue">
					<div class="panel-body">
						<div>
							<form action="" method="post" class="form-horizontal edit-form" role="form" enctype="multipart/form-data">
								<div class="form-body">

									<div class="form-group row">
										<label class="col-md-3 control-label">Category *</label>
										<div class="col-md-9">
											<select name="category" class="form-control" required>
												<option value="">Select</option>
												<?php
												foreach ($category_list as $val) {
												?>
													<option value="<?= $val ?>"><?= $val ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">I Am *</label>
										<div class="col-md-9">
											<select name="service" class="form-control" required>
												<?php
												foreach ($serviceArr as $val) {
												?>
													<option value="<?= $val ?>"><?= $val ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">Title *</label>
										<div class="col-md-9">
											<input type="text" name="name" value="" class="form-control" required />
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-md-3 control-label">Subtitle </label>
										<div class="col-md-9">
											<input type="text" name="subtitle" value="" class="form-control" />
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">Description</label>
										<div class="col-md-9">
											<textarea name="description" class="form-control" required></textarea>
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
														<option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
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




									<div class="form-group row">
										<label class="col-md-3 control-label">Image *</label>
										<div class="col-md-9">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
													<img src="<?= '../assets/images/no-image.gif' ?>" />
												</div>
												<div>
													<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
														<input type="file" name="files" value="" class="form-control" required /></span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>

										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 control-label">Video</label>
										<div class="col-md-9">
											<input type="file" name="video_file" value="" class="form-control" />
											<span>Upload only MP4 file</span>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-md-3 control-label">Additional Images</label>
										<div class="col-md-9">
										
										<?php /*?><div class="dropzone" id="mydropzone">
											<div class="dropzone-previews"></div>
										</div><?php */ ?>
										
										<input type="file" name="additionalimages[]" id="imageInput_addt" multiple  accept=".jpg,.jpeg,.png" />
										<div id="preview_addt">
										
										
										
										<?php 
										if(!empty($form_data['additionalimages'])){
											$additionalimages = explode('|',$form_data['additionalimages']);
											foreach($additionalimages as $add_img){
												echo '<img src="'.SITEURL . 'uploads/banners/' . $add_img.'" alt="' . $add_img.'" >';  
											}
										} ?>
										
										
										</div>
										
										</div>
										
									</div>
									
									<div class="form-group row">
										<label class="col-md-3 control-label">Terms and Conditions</label>
										<div class="col-md-9">
											<textarea name="terms_conditions" class="form-control" ></textarea>
										</div>
									</div>





								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-9 offset-md-3">
											<button type="submit" class="btn btn-info submitBtn btn-primary">Save</button>
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
	
	</main>

	<?php include('../includes/footer.php'); ?>
	<style>
        #imageInput_addt img {
            max-width: 150px;
            margin: 10px;
        }
    </style>
	<script>
        /*const imageInput_addt = document.getElementById('imageInput_addt');
        const preview_addt = document.getElementById('preview_addt');

        imageInput_addt.addEventListener('change', function () {
            preview_addt.innerHTML = ''; // clear previous previews
            const files = this.files;

            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview_addt.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }); */
		
		
		const imageInput_addt = document.getElementById('imageInput_addt');
  const preview_addt = document.getElementById('preview_addt');
  let selectedFiles = [];

  imageInput_addt.addEventListener('change', function () {
    // Add new selected files to existing array
    const newFiles = Array.from(this.files);
    selectedFiles = selectedFiles.concat(newFiles);
    renderPreviews();
    updateInputFiles();
  });

  function renderPreviews() {
    preview_addt.innerHTML = '';

    selectedFiles.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = function (e) {
        const container = document.createElement('div');
        container.className = 'image-container';

        const img = document.createElement('img');
        img.src = e.target.result;

        const removeBtn = document.createElement('button');
        removeBtn.className = 'remove-btn';
        removeBtn.textContent = '×';
        removeBtn.onclick = () => {
          selectedFiles.splice(index, 1);
          renderPreviews();
          updateInputFiles();
        };

        container.appendChild(img);
        container.appendChild(removeBtn);
        preview_addt.appendChild(container);
      };
      reader.readAsDataURL(file);
    });
  }

  function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    imageInput_addt.files = dataTransfer.files;
  }
		
    </script>
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

		select_hs_country('');
	</script>
	<style>
		label.error {
			font-size: 13px;
			color: #F00;
		}
	</style>

	<link href="<?= SITEURL ?>assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="<?= SITEURL ?>assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script>

	<script type="text/javascript">

        Dropzone.options.imageUpload = {

        maxFilesize:1,

        acceptedFiles: ".jpeg,.jpg,.png,.gif"

    };

</script>

</body>

</html>