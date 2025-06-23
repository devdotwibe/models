<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

if (isset($_SESSION['log_user_id'])) {
	$id = 0;
	//create post data
	if ($_GET['id']) {
		$id = $_GET['id'];
		$form_data = DB::queryFirstRow("select * from banners where id='" . $id . "' and user_id='" . $_SESSION['log_user_id'] . "' ");
		if ($form_data) {
		} else {
			header("Location: " . SITEURL . "advertisement/list.php");
		}
	} else {
		header("Location: " . SITEURL . "advertisement/list.php");
	}
		
	if ($_POST) {

		$user_id = $_SESSION['log_user_id'];
		$arr = array('name', 'subtitle', 'description', 'category', 'service', 'country', 'state', 'city','terms_conditions');
		$post_data = array_from_post($arr);

		DB::update('banners', $post_data, "id=%s", $id);

		$error = '';
		
		//Image upload
		
			$existing_image_array =array(); 
			$removed_image_array =array();
			if(!empty($form_data['image'])){ 
				$existing_image_array[0] = $form_data['image']; 
			} 
			if(!empty($form_data['additionalimages'])) {
				$existing_image_array = array_merge($existing_image_array,explode('|',$form_data['additionalimages']));
			}
			if(isset($_POST['remobved_image'])){
				$removed_image_array = explode('|',$_POST['remobved_image']);
			}
			$result_array = array_diff($existing_image_array, $removed_image_array);
		
		if(isset($_POST['save_image_file'])){
			$additional_img = '';
			$exp_file_img = explode('|',$_POST['save_image_file']);
			$joe_id = DB::update('banners', array('image' => $exp_file_img[0]), "id=%s", $id);
			if(count($exp_file_img) > 1){
				for ($i = 1; $i < count($exp_file_img); $i++) {
					$additional_img .= $exp_file_img[$i].'|';
				}
			}
			if(!empty($result_array)){
				foreach($result_array as $arr){
					$additional_img .= $arr.'|';
				}
			}
			$joe_id = DB::update('banners', array('additionalimages' => rtrim($additional_img, "|")), "id=%s", $id);
		}else{
			$additional_img = '';
			if(!empty($result_array)){
				$joe_id = DB::update('banners', array('image' => $result_array[0]), "id=%s", $id);
				if(count($result_array) > 1){
					for ($i = 1; $i < count($result_array); $i++) {
						$additional_img .= $result_array[$i].'|';
					}
				}
				$joe_id = DB::update('banners', array('additionalimages' => rtrim($additional_img, "|")), "id=%s", $id);
			}
		}
		
		//Video upload
		$existing_vd_array =array(); 
		$removed_vd_array =array();
			if(!empty($form_data['video'])) {
				$existing_vd_array = array_merge($existing_vd_array,explode('|',$form_data['video']));
			}
			if(isset($_POST['remobved_video'])){
				$removed_vd_array = explode('|',$_POST['remobved_video']);
			}
			$result_array_vd = array_diff($existing_vd_array, $removed_vd_array);
			$additional_vd = '';
			if(!empty($result_array_vd)){
				foreach($result_array_vd as $arrv){
					$additional_vd .= $arrv.'|';
				}
			}
			
		if(isset($_POST['save_video_file'])){
			if(!empty($additional_vd)){
			$joe_id = DB::update('banners', array('video' => $_POST['save_video_file'].'|'.$additional_vd), "id=%s", $id);
			}else{
				$joe_id = DB::update('banners', array('video' => $_POST['save_video_file']), "id=%s", $id);
			}
		}else{
			if(!empty($additional_vd)){
			$joe_id = DB::update('banners', array('video' => $_POST['save_video_file'].'|'.$additional_vd), "id=%s", $id);
			}
		}
		/*if (isset($_FILES["files"])) {
			$totalFiles = count($_FILES['files']['name']);
			$additional_img = '';
			$target_dir_profile = "../uploads/banners/";
			
				$target_file1 = $target_dir_profile . basename($_FILES["files"]["name"][0]);
				$target_profile = basename($_FILES["files"]["name"][0]);
				if (move_uploaded_file($_FILES["files"]["tmp_name"][0], $target_file1)) {
					$joe_id = DB::update('banners', array('image' => $target_profile), "id=%s", $id);
				} 
			if($totalFiles > 1){
				for ($i = 1; $i < $totalFiles; $i++) {
					$target_file1 = $target_dir_profile . basename($_FILES["files"]["name"][$i]);
					$target_profile = basename($_FILES["files"]["name"][$i]);
					if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $target_file1)) {
						$additional_img .= $target_profile.'|';
					}
				}
				if(!empty($additional_img)){ 
					$joe_id = DB::update('banners', array('additionalimages' => rtrim($additional_img, "|")), "id=%s", $id);
				}
			}
			
			
		}
		
		if (isset($_FILES["video_file"])) {
			$totalFiles_v = count($_FILES['video_file']['name']);
			$additional_vd = '';
			$target_dir_profile = "../uploads/banners/";
				for ($i = 0; $i < $totalFiles_v; $i++) {
					$target_file1 = $target_dir_profile . basename($_FILES["video_file"]["name"][$i]);
					$target_profile = basename($_FILES["video_file"]["name"][$i]);
					if (move_uploaded_file($_FILES["video_file"]["tmp_name"][$i], $target_file1)) {
						$additional_vd .= $target_profile.'|';
					}
				}
				if(!empty($additional_vd)){ 
					$joe_id = DB::update('banners', array('video' => rtrim($additional_vd, "|")), "id=%s", $id);
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
		

		if ($_FILES["video_file"]["name"]) {
			$target_dir_profile = "../uploads/banners/";
			$target_file1 = $target_dir_profile . basename($_FILES["video_file"]["name"]);
			$target_profile = basename($_FILES["video_file"]["name"]);
			if (move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file1)) {
				$joe_id = DB::update('banners', array('video' => $target_profile), "id=%s", $id);
			} else {
				$error .= ' Video Not Updated';
			}
		}*/

		if ($error) {
			echo '<script>alert("' . $error . '");</script>';
		}
		echo '<script>window.location="' . SITEURL . 'advertisement/list.php"</script>';
		
		
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
	<title>Create Advertisement - The Live Models</title>
	<?php include('../includes/head.php'); ?>
	<style>
		.thumbnail {
			background: #FFF;
		}
		.invalid {
			border: 3px solid red;
		}
	</style>
		
</head>

<body class="creare-ad min-h-screen text-white socialwall-page">

<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

	<?php //include('../includes/header.php'); ?>
	<?php  include('../includes/side-bar.php'); ?>
	<?php  include('../includes/profile_header_index.php'); ?>
	
	<main class="py-12">
    <div class="container mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-4">Create New Advertisement</h1>
            <p class="text-lg text-white/70 max-w-2xl mx-auto">Showcase your services and attract more clients with a premium advertisement</p>
        </div>

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" id="step1">1</div>
            <div class="step" id="step2">2</div>
            <div class="step" id="step3">3</div>
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto">
            <?php /*?><form class="ultra-glass p-8 md:p-12 rounded-3xl shadow-2xl" onsubmit="submitForm(event)"><?php */ ?>
			<form action="" method="post" class="ultra-glass p-8 md:p-12 rounded-3xl shadow-2xl" role="form" onsubmit="submitForm(event)" enctype="multipart/form-data" >

                <!-- Step 1: Basic Information -->
                <div id="formStep1" class="form-step">
                    <h2 class="text-2xl font-bold premium-text mb-8 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Basic Information
                    </h2>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-white font-semibold mb-3">Category *</label>
							<select name="category" class="form-input w-full px-6 py-4 rounded-xl adv_category" id="adv_category"  required>
												<option value="">Select Category</option>
												<?php
												foreach ($category_list as $val) {
												?>
													<option value="<?= $val ?>" <?= $form_data['category'] == $val ? 'selected' : '' ?>><?= $val ?></option>
												<?php
												}
												?>
											</select>
                            <span class="err_adv_category" style="color:red;"></span>
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-3">I Am *</label>
							<select name="service" class="form-input w-full px-6 py-4 rounded-xl adv_am" id="adv_am" required>
												<?php
												foreach ($serviceArr as $val) {
												?>
													<option value="<?= $val ?>"><?= $val ?></option>
												<?php
												}
												?>
											</select>
                            <span class="err_adv_am" style="color:red;"></span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <label class="block text-white font-semibold mb-3">Advertisement Title *</label>
                        <input type="text" name="name" value="<?= $form_data['name'] ?>" class="form-input w-full px-6 py-4 rounded-xl adm_title" id="adm_title" placeholder="Enter a catchy title for your advertisement..." required />
						<p class="text-white/50 text-sm mt-2">💡 Tip: Use engaging words that describe your unique services</p>
						<span class="err_adv_title" style="color:red;"></span>
					</div>
					
					<div class="mt-8">
                        <label class="block text-white font-semibold mb-3">Advertisement Subtitle</label>
                        <input type="text" name="subtitle" value="<?= $form_data['subtitle'] ?>" class="form-input w-full px-6 py-4 rounded-xl adm_subtitle" id="adm_subtitle" placeholder="Enter a catchy title for your advertisement..."  />
						<p class="text-white/50 text-sm mt-2">💡 Tip: Subtitle of advertisement</p>
						<span class="err_adv_subtitle" style="color:red;"></span>
                    </div>

                    <div class="mt-8">
                        <label class="block text-white font-semibold mb-3">Description *</label>
                        <textarea name="description" class="form-input w-full px-6 py-4 rounded-xl h-40 resize-none adv_desc" id="adv_desc" placeholder="Describe your services in detail. What makes you special? What can clients expect?" required><?= $form_data['description'] ?></textarea>
						<div class="flex justify-between items-center mt-2">
                            <p class="text-white/50 text-sm">💡 Be specific about your services, rates, and availability</p>
                            <span class="text-white/50 text-sm" id="charCount">0/500</span>
                        </div>
						<span class="err_adv_desc" style="color:red;"></span>
                    </div>
					
					<div class="mt-8">
                        <label class="block text-white font-semibold mb-3">Terms and Conditions</label>
                        <textarea name="terms_conditions" class="form-input w-full px-6 py-4 rounded-xl h-40 resize-none adv_terms" id="adv_terms" placeholder="Describe your terms and conditions related to this advertisement." ><?= $form_data['terms_conditions'] ?></textarea>
						<div class="flex justify-between items-center mt-2">
                            <p class="text-white/50 text-sm">💡 Be specific about your services, rates, and availability</p>
                            <span class="text-white/50 text-sm" id="charCount">0/500</span>
                        </div>
                    </div>
					
                </div>

                <!-- Step 2: Location & Pricing -->
                <div id="formStep2" class="form-step hidden">
                    <h2 class="text-2xl font-bold premium-text mb-8 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Location & Pricing
                    </h2>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-3">Country *</label>
							<select name="country" id="i-hs-country" onChange="select_hs_country('')" class="form-input w-full px-6 py-4 rounded-xl adv_country" id="adv_country" required>
												<option value="" data-id="">Select Country</option>
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
                            <span class="err_adv_country" style="color:red;"></span>
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-3">State/Province *</label>
							<select name="state" id="i-hs-state" onChange="select_hs_state('')" class="form-input w-full px-6 py-4 rounded-xl adv_state" id="adv_state" required ></select>
                            <span class="err_adv_state" style="color:red;"></span>
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-3">City *</label>
							<select name="city" id="i-hs-city" class="form-input w-full px-6 py-4 rounded-xl adv_city" id="adv_city" required ></select>
                            <span class="err_adv_city" style="color:red;"></span>
                        </div>
                    </div>

                    
                </div>

                <!-- Step 3: Media Upload -->
                <div id="formStep3" class="form-step hidden">
                    <h2 class="text-2xl font-bold premium-text mb-8 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="9" cy="9" r="2"></circle>
                            <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                        </svg>
                        Photos & Videos
                    </h2> 

                    <!-- Photo Upload Section -->
                    <div class="mb-12">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold premium-text">Photos</h3>
                            <span class="text-white/60 text-sm">Maximum 10 photos • JPG, PNG, GIF up to 10MB each</span>
                        </div>

                        <div class="upload-area rounded-2xl p-8 text-center mb-6" id="photoUploadArea">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 text-white/50">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="9" cy="9" r="2"></circle>
                                <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                            </svg>
                            <h4 class="text-xl font-semibold text-white mb-2">Upload Your Photos</h4>
                            <p class="text-white/70 mb-4">Drag and drop your photos here, or click to browse</p>
                            <button type="button" class="btn-primary px-8 py-3 rounded-xl font-semibold" onclick="document.getElementById('photoInput').click()">
                                Choose Photos
                            </button>
                            <input type="file" name="files[]" id="photoInput" class="hidden" multiple accept=".jpg,.jpeg,.png,.gif" onchange="handlePhotoUpload(event)" >
							<input type="hidden" name="save_image_file" value="" id="save_image_file">
							
							<input type="hidden" name="remobved_image" value="" id="remobved_image">
							
							
                        </div>

                        <!-- Photo Preview Grid -->
                        <div id="photoPreviewGrid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 ">
                            <!-- Photo previews will be inserted here -->
							<?php if(!empty($form_data['image']) ){ ?>
							<div class="media-preview relative">
								<img src="<?php echo SITEURL . 'uploads/banners/' . $form_data['image']; ?>" alt="Photo preview" class="w-full h-32 object-cover rounded-xl">
								<button type="button" class="remove-btn" onclick="removePhoto_saved('<?php echo $form_data['image']; ?>')">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg>
								</button>
							</div>
							<?php } if(!empty($form_data['additionalimages']) ){ 
								$additionalimages = explode('|',$form_data['additionalimages']);
								foreach($additionalimages as $add_img){	?>
							<div class="media-preview relative">
								<img src="<?php echo SITEURL . 'uploads/banners/' . $add_img; ?>" alt="Photo preview" class="w-full h-32 object-cover rounded-xl">
								<button type="button" class="remove-btn" onclick="removePhoto_saved('<?php echo $add_img; ?>')">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg>
								</button>
							</div>
							<?php 
								}
							 } ?>
							
                        </div>
                    </div>

                    <!-- Video Upload Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold premium-text">Videos</h3>
                            <span class="text-white/60 text-sm">Maximum 5 videos • MP4, MOV, AVI up to 100MB each</span>
                        </div>

                        <div class="upload-area rounded-2xl p-8 text-center mb-6" id="videoUploadArea">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 text-white/50">
                                <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                            </svg>
                            <h4 class="text-xl font-semibold text-white mb-2">Upload Your Videos</h4>
                            <p class="text-white/70 mb-4">Drag and drop your videos here, or click to browse</p>
                            <button type="button" class="btn-primary px-8 py-3 rounded-xl font-semibold" onclick="document.getElementById('videoInput').click()">
                                Choose Videos
                            </button>
                            <input type="file" name="video_file[]" id="videoInput" class="hidden" multiple accept=".mp4,.mov,.avi" onchange="handleVideoUpload(event)">
							<input type="hidden" name="save_video_file" value="" id="save_video_file">
							
							<input type="hidden" name="remobved_video" value="" id="remobved_video">
							
						</div>

                        <!-- Video Preview Grid -->
                        <div id="videoPreviewGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 hidden1">
                            <!-- Video previews will be inserted here -->
							<?php if(!empty($form_data['video']) ){ 
								$video = explode('|',$form_data['video']);
								foreach($video as $add_vd){	?>
							<div class="media-preview relative">
							
								<video src="<?php echo SITEURL . 'uploads/banners/' . $add_vd; ?>" class="w-full h-48 object-cover rounded-xl" controls></video>
								<button type="button" class="remove-btn" onclick="removeVideo('<?php echo $add_vd; ?>')">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg>
								</button>
							
							</div>
							<?php 
								}
							 } ?>
                        </div>
                    </div>

                    <!-- Upload Progress -->
                    <div id="uploadProgress" class="hidden mb-8">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-white font-semibold">Uploading...</span>
                            <span class="text-white/70" id="progressText">0%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill w-[0%]" id="progressFill"></div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-12 pt-8 border-t border-white/10">
                    <button type="button" id="backBtn" class="btn-danger px-8 py-4 rounded-xl font-semibold hidden" onclick="previousStep()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                        Back
                    </button>

                    <div class="flex space-x-4 ml-auto">
                        <!-- <button type="button" class="btn-secondary px-8 py-4 rounded-xl font-semibold" onclick="saveDraft()">
                            Save Draft
                        </button> -->
                        <button type="button" id="nextBtn" class="btn-primary px-8 py-4 rounded-xl font-semibold" onclick="nextStep()">
                            Next Step
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 inline">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                        <button type="submit" id="submitBtn" class="btn-primary px-8 py-4 rounded-xl font-semibold hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline">
                                <path d="M5 12l5 5l10-10"></path>
                            </svg>
                            Edit Advertisement
                        </button>
						<a class="btn-primary px-8 py-4 rounded-xl font-semibold hidden adv-back-btn" href="<?= SITEURL . 'advertisement/list.php' ?>" class="btn btn-default">Back</a>
                    </div>
                </div>
            </form>
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
					selected: state,
					option:''
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
					state: state,
					option:''
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
	
	<script>
    // Premium JavaScript Functionality
    document.addEventListener('DOMContentLoaded', function() {
        initializePremiumFeatures();
        initializeFormFeatures();
    });

    let currentStep = 1;
    let uploadedPhotos = [];
    let uploadedVideos = [];

    function initializePremiumFeatures() {
        // Premium Particle System
        function createPremiumParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 12 + 's';
            particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
            particle.style.opacity = Math.random() * 0.8 + 0.2;

            const colors = [
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.6)',
                'rgba(6, 182, 212, 0.7)'
            ];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;

            document.getElementById('particles').appendChild(particle);

            setTimeout(() => {
                if (particle.parentNode) {
                    particle.remove();
                }
            }, 12000);
        }

        setInterval(createPremiumParticle, 150);
    }

    function initializeFormFeatures() {
        // Character counter for description
        const descriptionTextarea = document.querySelector('textarea');
        const charCount = document.getElementById('charCount');

        descriptionTextarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = `${count}/500`;
            if (count > 500) {
                charCount.style.color = '#ef4444';
            } else {
                charCount.style.color = 'rgba(255, 255, 255, 0.5)';
            }
        });

        // Drag and drop functionality
        setupDragAndDrop();
    }

    function setupDragAndDrop() {
        const photoUploadArea = document.getElementById('photoUploadArea');
        const videoUploadArea = document.getElementById('videoUploadArea');

        // Photo upload area
        photoUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        photoUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        photoUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
            handlePhotoFiles(files);
        });

        // Video upload area
        videoUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        videoUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        videoUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('video/'));
            handleVideoFiles(files);
        });
    }

    function nextStep() {
        if (currentStep < 3) { 
			var allow_next = true;
			if(currentStep == 1){
				if(jQuery('.adv_category').val() == ''){
					jQuery('.adv_category').addClass('invalid');
					allow_next = false;
				}else jQuery('.adv_category').removeClass('invalid');
				
				if(jQuery('.adv_am').val() == ''){
					jQuery('.adv_am').addClass('invalid');
					allow_next = false;
				}else jQuery('.adv_am').removeClass('invalid');
				
				if(jQuery('.adm_title').val() == ''){
					jQuery('.adm_title').addClass('invalid');
					allow_next = false;
				}else jQuery('.adm_title').removeClass('invalid');
				
				if(jQuery('.adv_desc').val() == ''){
					jQuery('.adv_desc').addClass('invalid');
					allow_next = false;
				}else jQuery('.adv_desc').removeClass('invalid');
			}
			
			if(currentStep == 2){
				if(jQuery('.adv_country').val() == ''){
					jQuery('.adv_country').addClass('invalid');
					allow_next = false;
				}else jQuery('.adv_country').removeClass('invalid');
				
				if(jQuery('.adv_state').val() == ''){
					jQuery('.adv_state').addClass('invalid');
					allow_next = false;
				}else jQuery('.adv_state').removeClass('invalid');
				
				if(jQuery('.adv_city').val() == ''){
					jQuery('.adv_city').addClass('invalid');
					allow_next = false;
				}else jQuery('.adv_city').removeClass('invalid');
			}
			
			if(allow_next){
            // Hide current step
            document.getElementById(`formStep${currentStep}`).classList.add('hidden');
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.getElementById(`step${currentStep}`).classList.add('completed');

            // Show next step
            currentStep++;
            document.getElementById(`formStep${currentStep}`).classList.remove('hidden');
            document.getElementById(`step${currentStep}`).classList.add('active');

            // Update buttons
            document.getElementById('backBtn').classList.remove('hidden');

            if (currentStep === 3) {
                document.getElementById('nextBtn').classList.add('hidden');
                document.getElementById('submitBtn').classList.remove('hidden');
            }
			
			}
			
        }
    }

    function previousStep() {
        if (currentStep > 1) {
            // Hide current step
            document.getElementById(`formStep${currentStep}`).classList.add('hidden');
            document.getElementById(`step${currentStep}`).classList.remove('active');

            // Show previous step
            currentStep--;
            document.getElementById(`formStep${currentStep}`).classList.remove('hidden');
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.getElementById(`step${currentStep}`).classList.remove('completed');

            // Update buttons
            if (currentStep === 1) {
                document.getElementById('backBtn').classList.add('hidden');
            }

            if (currentStep < 3) {
                document.getElementById('nextBtn').classList.remove('hidden');
                document.getElementById('submitBtn').classList.add('hidden');
            }
        }
    }

  let selectedFiles_img = [];
    function handlePhotoUpload(event) {
        const files = Array.from(event.target.files);
		
		selectedFiles_img = selectedFiles_img.concat(files);
		
        handlePhotoFiles(files);
    }
    function handlePhotoFiles(files) {
        if (uploadedPhotos.length + files.length > 10) {
            alert('Maximum 10 photos allowed');
            return;
        }

        files.forEach(file => {
            if (file.size > 10 * 1024 * 1024) {
                alert(`File ${file.name} is too large. Maximum size is 10MB.`);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const photoData = {
                    file: file,
                    url: e.target.result,
                    id: Date.now() + Math.random()
                };

                uploadedPhotos.push(photoData);
                displayPhotoPreview(photoData);
            };
            reader.readAsDataURL(file);
        });
		
		
		const dataTransfer = new DataTransfer();
		selectedFiles_img.forEach(file => dataTransfer.items.add(file)); 
		document.getElementById('photoInput').files = dataTransfer.files; console.log(dataTransfer.files);
		
    }

    function displayPhotoPreview(photoData) {
        const grid = document.getElementById('photoPreviewGrid');
        grid.classList.remove('hidden');

        const previewDiv = document.createElement('div');
        previewDiv.className = 'media-preview relative';
        previewDiv.innerHTML = `
            <img src="${photoData.url}" alt="Photo preview" class="w-full h-32 object-cover rounded-xl">`;
          /*  `<button type="button" class="remove-btn" onclick="removePhoto('${photoData.id}')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        `;*/

        grid.appendChild(previewDiv);
    }
let selectedFiles_video = [];
    function handleVideoUpload(event) {
        const files = Array.from(event.target.files);
		selectedFiles_video = selectedFiles_video.concat(files);
        handleVideoFiles(files);
    }

    function handleVideoFiles(files) {
        if (uploadedVideos.length + files.length > 5) {
            alert('Maximum 5 videos allowed');
            return;
        }

        files.forEach(file => {
            if (file.size > 100 * 1024 * 1024) {
                alert(`File ${file.name} is too large. Maximum size is 100MB.`);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const videoData = {
                    file: file,
                    url: e.target.result,
                    id: Date.now() + Math.random()
                };

                uploadedVideos.push(videoData);
                displayVideoPreview(videoData);
            };
            reader.readAsDataURL(file);
        });
		
		const dataTransfer = new DataTransfer();
		selectedFiles_video.forEach(file => dataTransfer.items.add(file)); 
		document.getElementById('videoInput').files = dataTransfer.files; //console.log(dataTransfer.files);
		
    }

    function displayVideoPreview(videoData) {
        const grid = document.getElementById('videoPreviewGrid');
        grid.classList.remove('hidden');

        const previewDiv = document.createElement('div');
        previewDiv.className = 'media-preview relative';
        previewDiv.innerHTML = `
            <video src="${videoData.url}" class="w-full h-48 object-cover rounded-xl" controls></video>
			<div class="absolute bottom-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                ${formatFileSize(videoData.file.size)}
            </div>`;
          /*  <button type="button" class="remove-btn" onclick="removeVideo('${videoData.id}')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
        `; */

        grid.appendChild(previewDiv);
    }

    function removePhoto(id) {
        uploadedPhotos = uploadedPhotos.filter(photo => photo.id !== id);
        refreshPhotoGrid();
    }
	
	function removePhoto_saved(id) { 
       var remobved_image = jQuery('#remobved_image').val();
	   if(remobved_image == '') jQuery('#remobved_image').val(id);
	   else jQuery('#remobved_image').val(remobved_image+'|'+id);
	   
	   const el = event.target;

		// If it's an SVG or child element inside the button, go up to the button
		const button = el.closest('button');

		// Then remove the outer .media-preview div
		const wrapper = button.closest('.media-preview');
		if (wrapper) wrapper.remove();
    }
	function removePhoto_saved1(el, imageName) { 
		/*
		// Optional: Send AJAX request to delete the file from server
		fetch('<?=SITEURL?>/ajax/delete_saved_image.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: 'image=' + encodeURIComponent(imageName)
		})
		.then(response => response.text())
		.then(result => {
			console.log('Server says:', result);
		})
		.catch(error => {
			console.error('Error deleting image:', error);
		}); */
	}

    function removeVideo(id) {
        //uploadedVideos = uploadedVideos.filter(video => video.id !== id);
        //refreshVideoGrid();
		
		var remobved_video = jQuery('#remobved_video').val();
	   if(remobved_video == '') jQuery('#remobved_video').val(id);
	   else jQuery('#remobved_video').val(remobved_video+'|'+id);
	   
	   const el = event.target;

		// If it's an SVG or child element inside the button, go up to the button
		const button = el.closest('button');

		// Then remove the outer .media-preview div
		const wrapper = button.closest('.media-preview');
		if (wrapper) wrapper.remove();
    }

    function refreshPhotoGrid() {
        const grid = document.getElementById('photoPreviewGrid');
        grid.innerHTML = '';

        if (uploadedPhotos.length === 0) {
            grid.classList.add('hidden');
        } else {
            uploadedPhotos.forEach(photo => displayPhotoPreview(photo));
        }
    }

    function refreshVideoGrid() {
        const grid = document.getElementById('videoPreviewGrid');
        grid.innerHTML = '';

        if (uploadedVideos.length === 0) {
            grid.classList.add('hidden');
        } else {
            uploadedVideos.forEach(video => displayVideoPreview(video));
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function saveDraft() {
        alert('💾 Draft saved successfully! You can continue editing later.');
    }

    function submitForm(event) {
        event.preventDefault();

        // Show upload progress
        const progressDiv = document.getElementById('uploadProgress');
        const progressFill = document.getElementById('progressFill');
        const progressText = document.getElementById('progressText');

        progressDiv.classList.remove('hidden');
		
		// Simulate upload progress
        let progress = 0;
		
		var photoInput = document.getElementById('photoInput');
		var files_img = photoInput.files;  // Get all selected images
		
		var videoInput = document.getElementById('videoInput');
		var files_vd = videoInput.files;  // Get all selected videos
		
		//uploading Image files

		if (files_img.length > 0) {
			// Create a new FormData object
			var formData = new FormData();
			var uploaded_file = [];
			for (var i = 0; i < files_img.length; i++) {
				formData.append('uploaded_file[]', files_img[i]);  
			}
			
			progressFill.style.width = '25%';
            progressText.textContent = '25%';
			progress = 25;
			
			// Send the FormData object using Fetch API
			fetch('<?=SITEURL.'/ajax/adv_upload.php'?>', {
				method: 'POST',
				body: formData
			})
			.then(response => response.text())
			.then(data => { 
				if(data == 'No files were uploaded.'){
					alert(data);
				}else if(data == 'Error'){
					alert('Sorry, there was an error uploading the images.')
				}else{
					jQuery('#save_image_file').val(data);
				}
				if (files_vd.length > 0) {
				progressFill.style.width = '50%';
				progressText.textContent = '50%';
				progress = 50;
				}else{
				progressFill.style.width = '100%';
				progressText.textContent = '100%';
				progress = 100;
				}
				
				if(progress >= 100){
				setTimeout(() => {
                    event.target.submit();
                }, 1000);
			} 
			})
			.catch(error => {
				console.error('Upload failed:', error);
			});
				if (files_vd.length > 0) progress = 50;
				else progress = 100;
			
		}
		//uploading video files

		if (files_vd.length > 0) {
			// Create a new FormData object
			var formDataV = new FormData();
			var uploaded_file = [];
			for (var i = 0; i < files_vd.length; i++) {
				formDataV.append('uploaded_file[]', files_vd[i]);  
			}
			
			if (files_img.length > 0) {
			progressFill.style.width = '75%';
            progressText.textContent = '75%';	
			progress = 75;
			}else{
			progressFill.style.width = '25%';
            progressText.textContent = '25%';
			progress = 25;			
			}
			// Send the FormData object using Fetch API
			fetch('<?=SITEURL.'/ajax/adv_upload.php'?>', {
				method: 'POST',
				body: formDataV
			})
			.then(response => response.text())
			.then(data => { 
				if(data == 'No files were uploaded.'){
					alert(data);
				}else if(data == 'Error'){
					alert('Sorry, there was an error uploading the video.')
				}else{
					jQuery('#save_video_file').val(data);
				}
				progressFill.style.width = '100%';
				progressText.textContent = '100%';
				progress = 100;
				if(progress >= 100){
				setTimeout(() => {
                    event.target.submit();
                }, 1000);
			} 
				
			})
			.catch(error => {
				console.error('Upload failed:', error);
			});
			progress = 100;
			
		}
		
		//uploading complete
		
		if (files_vd.length <= 0  && files_img.length <= 0) {
        // Simulate upload progress
        
        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 100) progress = 100;

            progressFill.style.width = progress + '%';
            progressText.textContent = Math.round(progress) + '%';

            if (progress >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    event.target.submit();
                }, 500);
            }
        }, 200); 
		}else{ 
			if(progress >= 100){
				setTimeout(() => {
                  //  event.target.submit();
                }, 1000);
			} 
		}
    }
</script>

	<link href="<?= SITEURL ?>assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="<?= SITEURL ?>assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script>

</body>

</html>