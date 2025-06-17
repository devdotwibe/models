<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		header("Location: login.php");
	}
	$model_extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $_SESSION['log_user_unique_id']);
	//echo DB::lastQuery();
	if($model_extra_details){
		header("Location: model-panel/edit-extra-details.php");
	}
}
else{
	header("Location: login.php");
}

	
$time_list = get_time(true);
$week_list = get_week();
$month_list = get_sort_month();
$country_list = DB::query("SELECT id,name from countries order by name asc");
if($userDetails['gender']=='Male'){
	$dating_service_list = DB::query("SELECT id,name from dating_assignment_service where status=1 and type='male'  order by name asc");
}
else{
	$dating_service_list = DB::query("SELECT id,name from dating_assignment_service where status=1 and type='female' order by name asc");
}
//printR($country_list);

?>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Broadcaster | The Live Model</title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="<?='assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png'?>">
<link rel="icon" href="<?='assets/wp-content/themes/theagency3/favicon5e1f.png?v=2'?>">
<link href='<?='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script'?>' rel='stylesheet' type='text/css'>

      <style type="text/css">
img.wp-smiley,
img.emoji {
   display: inline !important;
   border: none !important;
   box-shadow: none !important;
   height: 1em !important;
   width: 1em !important;
   margin: 0 .07em !important;
   vertical-align: -0.1em !important;
   background: none !important;
   padding: 0 !important;
}

</style>
   <link rel='stylesheet' id='wp-block-library-css'  href='<?='assets/wp-includes/css/dist/block-library/style.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='<?='assets/wp-content/plugins/spiffy-calendar/styles/default.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='<?='assets/wp-includes/css/dashicons.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='visual-form-builder-css-css'  href='<?='assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='vfb-jqueryui-css-css'  href='<?='assets/wp-content/plugins/visual-form-builder/public/assets/css/smoothness/jquery-ui-1.10.3.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/css/style.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='<?='https://fonts.googleapis.com/css?family=Rokkitt'?>' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='<?='assets/wp-content/plugins/rich-reviews/css/rich-reviews.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='<?='assets/wp-content/themes/theagency3/library/css/style.css'?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?='assets/css/custom.css'?>' type='text/css' media='all' />

<!--<script type='text/javascript' src='<?='assets/wp-includes/js/jquery/jquery.js'?>' id='jquery-core-js'></script>-->

<script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'?>"></script>
<script type='text/javascript' src='<?='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js'?>' id='rich-reviews-js'></script>
<script type='text/javascript' src='<?='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js'?>' id='bones-modernizr-js'></script>



   </head>

<body class="page-template page-template-page-custom-sidebar page-template-page-custom-sidebar-php page page-id-865 custom-background">
   <?php include('includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-8 clearfix" role="main">

          
                        
            <article id="post-865" class="clearfix post-865 page type-page status-publish hentry" role="article" itemscope itemtype="https://schema.org/BlogPosting">
              
              <header class="page-head article-header">
                
                <div class="headline-outer"><h1 itemprop="headline" class="page-title entry-title"><div class="prefancy fancy"><span>New Broadcaster</span></div></h1></div>
              
              </header> <!-- end article header -->
            
              <section class="page-content entry-content clearfix" itemprop="articleBody"><div class="artivle-body-bg">
            
                <h3 style="text-align: center;">We are always hiring! Submit your details for our review and we&#8217;ll be in touch shortly.</h3>
<hr />
<div class="headline-outer">
   <h4 class="page-title-satin entry-title" itemprop="headline">
      <div class="prefancy fancy"><span>Apply Now!</span></div>
   </h4>
</div>
<div id="vfb-form-3" class="visual-form-builder-container">
   <form id="casting-3" class="visual-form-builder vfb-form-3 " action="act-new-broadcaster.php" method="post" enctype="multipart/form-data">
      <fieldset class="vfb-fieldset vfb-fieldset-4 stats " id="item-vfb-42">
         <div class="vfb-legend">
            <h3>Govt Id proof:</h3>
         </div>

         <ul class="vfb-section vfb-section-3">
              <li class="vfb-item vfb-item-select   vfb-left-half" id="item-vfb-43">
               <label for="vfb-43" class="vfb-desc">Choose Document Type   <span class="vfb-required-asterisk">*</span></label>
               <select name="choose_document" id="vfb-43" class="vfb-select  vfb-medium  required ">
                  <option value="" selected='selected'>Choose Document</option>
                  <option value="Passport">Passport</option>
                  <option value="Driving License">Driving License</option>
                  <option value="National ID">National ID</option>
                  <option value="Pan Card">Pan Card</option>
                  <option value="Aadhar">Aadhar</option>
                </select>
            </li>
            <li class="vfb-item vfb-item-textarea vfb-left-half" id="item-vfb-41">
               <label for="vfb-41" class="vfb-desc">Upload ID Card  <span class="vfb-required-asterisk">*</span></label>
               <input type="file" name="govt_id" >
            </li>
         </ul>
      </fieldset>

      <fieldset class="vfb-fieldset vfb-fieldset-4 stats " id="item-vfb-42">
         <div class="vfb-legend">
            <h3>Stats and Figure:</h3>
         </div>
         <ul class="vfb-section vfb-section-4">
            <li class="vfb-item vfb-item-select   vfb-left-half" id="item-vfb-43">
               <label for="vfb-43" class="vfb-desc">Bust Size  <span class="vfb-required-asterisk">*</span></label>
               <select name="bust-size" id="vfb-43" class="vfb-select  vfb-medium  required ">
                  <option value="" selected='selected'></option>
                  <option value="30">30</option>
                  <option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
               </select>
            </li>
            <li class="vfb-item vfb-item-select   vfb-right-half" id="item-vfb-44">
               <label for="vfb-44" class="vfb-desc">Cup Size  <span class="vfb-required-asterisk">*</span></label>
               <select name="cup-size" id="vfb-44" class="vfb-select  vfb-medium  required ">
                  <option value="" selected='selected'></option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
               </select>
            </li>
            <li class="vfb-item vfb-item-select   vfb-left-half" id="item-vfb-57">
               <label for="vfb-57" class="vfb-desc">Waist Size  <span class="vfb-required-asterisk">*</span></label>
               <select name="waist-size" id="vfb-57" class="vfb-select  vfb-medium  required ">
                  <option value="" selected='selected'></option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
               </select>
            </li>
            <li class="vfb-item vfb-item-text   vfb-right-half" id="item-vfb-56">
            	<label for="vfb-56" class="vfb-desc">Ethnicity  <span class="vfb-required-asterisk">*</span></label>
            	<input type="text" name="ethnicity" id="vfb-56" value="" class="vfb-text  vfb-medium  required  " />
            </li>
            <li class="vfb-item vfb-item-select   vfb-left-half" id="item-vfb-45">
               <label for="vfb-45" class="vfb-desc">Height  <span class="vfb-required-asterisk">*</span></label>
               <select name="height" id="vfb-45" class="vfb-select  vfb-medium  required ">
                  <option value="" selected='selected'></option>
                  <option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
               </select>
            </li>
            <li class="vfb-item vfb-item-text   vfb-right-half" id="item-vfb-47">
            	<label for="vfb-47" class="vfb-desc">Weight (enter weight in pounds)  <span class="vfb-required-asterisk">*</span></label>
            	<input type="text" name="weight" id="vfb-47" value="" class="vfb-text  vfb-medium  required  " />
            </li>
            <li class="vfb-item vfb-item-select   vfb-left-half" id="item-vfb-48">
               <label for="vfb-48" class="vfb-desc">Eye Color  <span class="vfb-required-asterisk">*</span></label>
               <select name="eye-color" id="vfb-48" class="vfb-select  vfb-medium  required ">
                  <option value="" selected='selected'></option>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
               </select>
            </li>
            <li class="vfb-item vfb-item-select   vfb-right-half" id="item-vfb-49">
               <label for="vfb-49" class="vfb-desc">Hair Color </label>
               <select name="hair-color" id="vfb-49" class="vfb-select  vfb-medium  ">
                  <option value="" selected='selected'></option>
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
               </select>
            </li>
         </ul>
         &nbsp;
      </fieldset>

      <fieldset class="vfb-fieldset vfb-fieldset-1 your-contact-details " id="item-vfb-25">
         <div class="vfb-legend">
            <h3>Live Cam:</h3>
         </div>
         <input type="hidden" name="uni_id" value="<?php echo $unique_id; ?>"> 
            <p class="text-white ps-4-5">Do you want to perform on live camera for viewers?</p>
         <ul class="vfb-section vfb-section-1">
            <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-29">
              <!--  <label for="vfb-29" class="vfb-desc">Live Cam: <span class="vfb-required-asterisk">*</span></label>
               <select name="live_cam" required="required" id="live_cam" class="vfb-select  vfb-medium  required ">
                  <option>Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select> -->
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">Yes</span></label>
                <input type="radio" name="live_cam" id="live_cam" value="Yes" required>
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">No</span></label>
                <input type="radio" name="live_cam" id="live_cam" value="No" required>
            </li>
            <li class="vfb-item vfb-item-text vfb-left-half" id="insta_p_url" >
               <label for="vfb-31" class="vfb-desc">Instagram Profile URL: <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="insta_p_url" placeholder="Instagram Profile URL" id="vfb-31" class="vfb-text vfb-medium required" />
            </li>
            <li class="vfb-item vfb-item-text vfb-right-half" id="insta_tokens">
               <label for="vfb-32" class="vfb-desc">Tokens: </label>
               <input type="text" name="insta_tokens" id="vfb-32" class="vfb-text vfb-medium" />
            </li>
            <li class="vfb-item vfb-item-text vfb-left-half" id="snap_p_url" >
               <label for="vfb-31" class="vfb-desc">Snapchat Profile URL:  <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="snap_p_url" id="vfb-31" class="vfb-text vfb-medium required " />
            </li>
            <li class="vfb-item vfb-item-text vfb-right-half" id="snap_tokens">
               <label for="vfb-32" class="vfb-desc">Tokens: </label>
               <input type="text" name="snap_tokens" id="vfb-32" class="vfb-text vfb-medium " />
            </li>
         </ul>
         <!-- &nbsp; -->
      </fieldset>
      <fieldset class="vfb-fieldset vfb-fieldset-2 personal-information " id="item-vfb-33">
         <div class="vfb-legend">
            <h3>Group show's</h3>
         </div>
         <p class="text-white ps-4-5">Group shows enables you to create groups of people and perform a camera show for all at once. Do you want to perform in Group shows?</p>
         <ul class="vfb-section vfb-section-2">
         <li class="vfb-item vfb-item-email vfb-left-half" id="item-vfb-30">
               <!-- <label for="vfb-30" class="vfb-desc">Group show: <span class="vfb-required-asterisk">*</span></label>
               <select name="group_show" required="required" id="group_show" class="vfb-select  vfb-medium  required ">
                  <option>Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
 -->            
             <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">Yes</span></label>
                <input type="radio" name="group_show" id="group_show" value="Yes" required>
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">No</span></label>
                <input type="radio" name="group_show" id="group_show" value="No" required>

         </li>
            <li class="vfb-item vfb-item-text vfb-left-half" id="min_member" >
               <label for="vfb-31" class="vfb-desc">Min members::  <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="min_member" id="vfb-31" value="" class="vfb-text  vfb-medium  required  " />
            </li>
            <li class="vfb-item vfb-item-text vfb-right-half" id="t_price_mem">
               <label for="vfb-32" class="vfb-desc">Token Price per member: </label>
               <input type="text" name="t_price_member" id="vfb-32" class="vfb-text  vfb-medium   " />
            </li>
         </ul>
      </fieldset>

      <fieldset class="vfb-fieldset vfb-fieldset-2 personal-information " id="item-vfb-33">
         <div class="vfb-legend">
            <h3>Dating Assignment</h3>
         </div>
         <p class="text-white ps-4-5">Do you want to work as an escorts?</p>
         <ul class="vfb-section vfb-section-2">
         	<li class="vfb-item vfb-item-email vfb-left-half" id="item-vfb-30">
               <label for="vfb-30" class="vfb-desc">Accept Dating Assignment: <span class="vfb-required-asterisk">*</span></label>
               <!-- <select name="w_aa_es" required="required" id="w_aa_es" class="vfb-select  vfb-medium  required ">
                  <option>Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select> -->
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">Yes</label>
                <input type="radio" name="w_aa_es" id="w_aa_es" value="Yes" required>
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">No</label>
                <input type="radio" name="w_aa_es" id="w_aa_es" value="No" required>
            </li>
	</ul>            


            

            <div id="2hours_es">
         <ul class="vfb-section vfb-section-2">
	            <li>For Incall</li>
	            <li class="vfb-item vfb-item-date vfb-left-half" >
	               <label for="vfb-35" class="vfb-desc">Per Hours Rates (In $): </label>
	               <input type="text" name="in_per_hour" id="vfb-35" class="vfb-text vfb-date-picker  vfb-medium  required "  />
	            </li>
	            <li class="vfb-item vfb-item-text vfb-right-half" >
	               <label for="vfb-38" class="vfb-desc">Overnight Rates (In $): </label>
	               <input type="text" name="in_overnight" id="vfb-38" class="vfb-text  vfb-medium  required  " />
	            </li>
	            <li>For Outcall</li>
	            <li class="vfb-item vfb-item-date vfb-left-half" >
	               <label for="vfb-35" class="vfb-desc">Per Hours Rates (In $): </label>
	               <input type="text" name="out_per_hour" id="vfb-35" class="vfb-text vfb-date-picker  vfb-medium  required "  />
	            </li>
	            <li class="vfb-item vfb-item-text vfb-right-half" >
	               <label for="vfb-38" class="vfb-desc">Overnight Rates (In $): </label>
	               <input type="text" name="out_overnight" id="vfb-38" class="vfb-text vfb-medium required " />
	            </li>
	            <li><small style="font-size: 13px;">** You can leave blank if you want to only one.</small></li>
                </ul>
                
            </div>

            
<div class="p-4">
<div class="row dating-assignment-option">
<div class="col-md-6 mb-3" >
<label for="vfb-35" class="vfb-desc">Service: </label>
<select name="d_a_service[]" class="vfb-select  vfb-medium  required " id="i-d_a_service" multiple style="width:100%" >
<?php
if($dating_service_list){
	foreach($dating_service_list as $set_d){
?>
<option value="<?=$set_d['id']?>"><?=$set_d['name']?></option>
<?php		
	}
}
?>
</select>
</div>
<div class="col-md-6 mb-3" >
<label for="i-d_a_address" class="vfb-desc">Address: </label>
<input type="text" name="d_a_address" id="i-d_a_address" class="vfb-text  vfb-medium  required  " />
</div>
</div>
</div>

<div class="dating-assignment-option" style="padding:0px 20px;">
<div class="row">
<div class="col-md-12  mb-3" >
<label class="vfb-desc">Schedule : <span class="vfb-required-asterisk">*</span></label>
<div class="d-flex " style="flex-wrap: wrap;">
<?php
foreach($week_list as $key=>$val){
?><div class="col-md-12 d-flex " style="flex: 0 0 auto;    padding: 10px 30px;
    border: solid 1px #CCC;
    margin-bottom: 2px;">
<label class="checkbox-inline" style="display:inline-block;width:100px">
<input type="checkbox" name="time_schedule[<?=$val?>][week]" onClick="select_week('<?=$val?>')" value="<?=$val?>" class="i-<?=$val?>"><?=ucfirst($val)?></label>
<div >
<div class="week-time-list cp-<?=$val?>" style="display:none" >
<select class="form-control" name="time_schedule[<?=$val?>][from]" >
<option value="">From</option>
<?php
foreach($time_list as $t_key=>$t_val){
?>
<option value="<?=$t_key?>"><?=$t_val?></option>
<?php
}
?>
</select>
</div>
</div>
<div >
<div class="week-time-list cp-<?=$val?>" style="display:none" >
<select class="form-control" name="time_schedule[<?=$val?>][to]" >
<option value="">To</option>
<?php
foreach($time_list as $t_key=>$t_val){
?>
<option value="<?=$t_key?>"><?=$t_val?></option>
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

      </fieldset>

      <fieldset class="vfb-fieldset vfb-fieldset-3 short-bio " id="item-vfb-40">
         <div class="vfb-legend">
            <h3>International tours</h3>
         </div>
         <p class="text-white ps-4-5">Fly to the client. Do you want to accept International tours?</p>
<ul class="vfb-section vfb-section-2">
<li class="vfb-item vfb-item-date vfb-left-half" id="item-vfb-34">
   <label for="vfb-34" class="vfb-desc">Accept International tours: <span class="vfb-required-asterisk">*</span></label>
  <!--  <select name="inter_tour" required="required" id="inter_tour" class="vfb-select vfb-medium required">
      <option>Select</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select> -->
     <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">Yes</label>
    <input type="radio" name="inter_tour" id="inter_tour" value="Yes" required>
    <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">No</label>
    <input type="radio" name="inter_tour" id="inter_tour"  value="No" required>
</li>
</ul>
<div class="row">
<div class="col-md-6 international-tours-option mb-3" >
<label class="vfb-desc">Schedule : <span class="vfb-required-asterisk">*</span></label>
<div class="d-flex " style="flex-wrap: wrap;">
<?php
foreach($month_list as $key=>$val){
?><div class="col-md-3" style="flex: 0 0 auto;">
<label class="checkbox-inline" style="display:inline-block;margin-left:20px; padding-left:10px">
<input type="checkbox" name="i_t_schedule[]" value="<?=$key?>" class=""><?=$val?></label>
</div>
<?php
}
?>
</div>
</div>

<div class="col-md-6 international-tours-option mb-3" >
<label for="vfb-35" class="vfb-desc">Rates Per Day: <span class="vfb-required-asterisk">*</span></label>
<div class="">
	<input type="number" name="i_t_day" value="0" min="0" class="vfb-text vfb-date-picker vfb-medium  required "  />
</div>
</div>
</div>

<div class="row">
<div class="col-md-6 international-tours-option mb-3" >
<label for="vfb-35" class="vfb-desc">Week: <span class="vfb-required-asterisk">*</span></label>
<div class="">
	<input type="number" name="i_t_week" value="0" min="0" class="vfb-text vfb-date-picker vfb-medium  required "  />
</div>
</div>

<div class="col-md-6 international-tours-option mb-3" >
<label for="vfb-35" class="vfb-desc">Month: <span class="vfb-required-asterisk">*</span></label>
<div class="">
	<input type="number" name="i_t_month" value="0" min="0" class="vfb-text vfb-date-picker vfb-medium  required "  />
</div>
</div>

<div class="col-md-6 international-tours-option mb-3" >
<label for="vfb-35" class="vfb-desc">Annual: <span class="vfb-required-asterisk">*</span></label>
<div class="">
	<input type="number" name="i_t_annual" value="0" min="0" class="vfb-text vfb-date-picker vfb-medium  required "  />
    <div style="font-size:12px">* Extra for Visa Travel and accommodation if not staying home</div>
</div>
</div>
<div class="col-md-6 international-tours-option mb-3" >
<label for="vfb-35" class="vfb-desc">Countries To Travel: <span class="vfb-required-asterisk">*</span></label>
<div class="">
<select name="i_t_country[]" class="vfb-select  vfb-medium  required " id="i-i_t_country" style="width:100%" multiple>
<?php
foreach($country_list as $val){
?>
<option value="<?=$val['id']?>"><?=$val['name']?></option>
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
      </fieldset>

      <fieldset class="vfb-fieldset vfb-fieldset-1 your-contact-details " id="item-vfb-25">
         <div class="vfb-legend">
            <h3>Video/Pictures</h3>
         </div>
         <ul class="vfb-section vfb-section-1">
            <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-29">
               <label for="vfb-29" class="vfb-desc">Sell Video/Pictures: <span class="vfb-required-asterisk">*</span></label>
              <!--  <select name="s_v_p" required="required" id="s_v_p" class="vfb-select  vfb-medium  required ">
                  <option>Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select> -->
               <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">Yes</span></label>
                <input type="radio" name="s_v_p" id="s_v_p" value="Yes" required>
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">No</span></label>
                <input type="radio" name="s_v_p" id="s_v_p"  value="No" required>
            </li> 
            <li class="vfb-item vfb-item-text">* you can add the price with each post</li>
         </ul>
      </fieldset>

      <fieldset class="vfb-fieldset vfb-fieldset-4 stats " id="item-vfb-42">
         <div class="vfb-legend">
            <h3>Modeling/ Movie assignment</h3>
         </div>

         <ul class="vfb-section vfb-section-3">
            <li class="vfb-item vfb-item-textarea vfb-left-half" id="item-vfb-41">
               <label for="vfb-41" class="vfb-desc">Accept Modeling/ Movie assignment?  <span class="vfb-required-asterisk">*</span></label>
             <!--   <select name="modeling_porn_assignment" required="required" id="modeling_porn_assignment" class="vfb-select vfb-medium required">
                  <option>Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select> -->
                 <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">Yes</span></label>
                <input type="radio" name="modeling_porn_assignment" id="modeling_porn_assignment" value="Yes" required>
                <label for="vfb-31" style="display: inline;padding: 0px 8px 0px 8px;">No</span></label>
                <input type="radio" name="modeling_porn_assignment" id="modeling_porn_assignment"  value="No" required>
            </li>
         
            <li class="vfb-item vfb-item-select  vfb-left-half" id="perhourshoot">
               <label for="vfb-43" class="vfb-desc">Per hour price of shoot? (In $):  <span class="vfb-required-asterisk">*</span></label>
               <input type="text" name="perhourshoot" id="vfb-38" value="" class="vfb-text  vfb-medium  required  " />
            </li>
            
         </ul>
       
      </fieldset>
      <fieldset class="vfb-fieldset vfb-fieldset-5 your-portfolio " id="item-vfb-58">
         <ul class="vfb-section vfb-section-5">
            <li class="vfb-item vfb-item-submit" id="item-vfb-28">
               <input type="submit" name="submit" id="vfb-28" value="Submit" class="vfb-submit " />
            </li>
         </ul>
      </fieldset>
     
   </form>
</div>
<!-- .visual-form-builder-container -->
</div></section> <!-- end article section -->

            
            </article> <!-- end article -->
                    
          </div> <!-- end #main -->

          <div class="col-md-4 clearfix"><div class="sidebar_content widget"><div class="img-responsive">
<img loading="lazy" class="alignnone wp-image-881 size-full" src="assets/wp-content/uploads/2016/01/casting-sb2.jpg" alt="models" width="360" height="2681" sizes="(max-width: 360px) 100vw, 360px" />
</div></div></div>      
        </div> <!-- end #content -->

      </div> <!-- end .container -->
  

<script type="text/javascript">
$("#min_member").hide();
  $("#t_price_mem").hide();
  $("#2hours").hide();
  $("#4hours").hide();
  $("#overnight").hide();
  $("#perhourshoot").hide();
  $("#2hours_es").hide();
  $("#insta_p_url").hide();
  $("#insta_tokens").hide();
  $("#snap_p_url").hide();
  $("#snap_tokens").hide();

$(document).on("change","input[type=radio]",function(){
    var live=$('[name="live_cam"]:checked').val();
    if (live == 'Yes') {
      $("#insta_p_url").show();
      $("#insta_tokens").show();
      $("#snap_p_url").show();
      $("#snap_tokens").show();
    }else if (live == 'No'){
      $("#insta_p_url").hide();
      $("#insta_tokens").hide();
      $("#snap_p_url").hide();
      $("#snap_tokens").hide();
    }else{
      $("#insta_p_url").hide();
      $("#insta_tokens").hide();
      $("#snap_p_url").hide();
      $("#snap_tokens").hide();
    }

var group=$('[name="group_show"]:checked').val();
 if (group == 'Yes') {
      $("#min_member").show();
      $("#t_price_mem").show();
    }else if (group == 'No'){
      $("#min_member").hide();
      $("#t_price_mem").hide();
    }else{
      $("#min_member").hide();
      $("#t_price_mem").hide();
    }

    var w_aa_es=$('[name="w_aa_es"]:checked').val();
     if (w_aa_es == 'Yes') {
      $("#2hours_es").show();
	  $('.dating-assignment-option').show();
    }else if (w_aa_es == 'No'){
      $("#2hours_es").hide();
	  $('.dating-assignment-option').hide();
      }else{
      $("#2hours_es").hide();
	  $('.dating-assignment-option').hide();
    }

    var inter_tour=$('[name="inter_tour"]:checked').val();
    if (inter_tour == 'Yes') {
		$('.international-tours-option').show();
		$('.international-tours-option .required').attr('required',true);

    }else if (inter_tour == 'No'){
		$('.international-tours-option').hide();
		$('.international-tours-option .required').attr('required',false);
    }else{
		$('.international-tours-option').hide();
		$('.international-tours-option .required').attr('required',false);
    }

    var modeling_porn_assignment=$('[name="modeling_porn_assignment"]:checked').val();
     if (modeling_porn_assignment == 'Yes') {
      $("#perhourshoot").show();
    }else if (modeling_porn_assignment == 'No'){
      $("#perhourshoot").hide();
    }else{
      $("#perhourshoot").hide();
    }
});

//
$('.international-tours-option').hide();
$('.international-tours-option .required').attr('required',false);

$('.dating-assignment-option').hide();
$('.dating-assignment-option .required').attr('required',false);


</script>
    <?php include('includes/footer.php'); ?>
<link rel="stylesheet" href="<?=SITEURL?>assets/plugins/select2/dist/css/select2.css">
<script src="<?=SITEURL?>assets/plugins/select2/dist/js/select2.js"></script> 
<script>
$('#i-i_t_country').select2({
		placeholder: "Select Country",
});
$('#i-d_a_service').select2({
		placeholder: "Select Service",
});
</script>   
<style>
/*.select2-container--default.select2-container--focus .select2-selection--multiple */
.select2-container--default .select2-selection--multiple{
    background-color: #2a2a31;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li,
.select2-container .select2-search--inline{
	float:initial;
	display:inline-block;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li{
padding:0px 10px !important
}
</style>
<script>
function select_week(type){
	setTimeout(function() {
		$('.cp-'+type).hide();
		if($('.i-'+type).prop("checked")===true){
			$('.cp-'+type).show();
		}
	},300);
}
</script>
  </body>

</html> 

