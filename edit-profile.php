<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$usern = $_SESSION["log_user"];
$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
$country_list = DB::query('select id,name,sortname from countries order by name asc');

if($userDetails){}
else{
	echo '<script>window.location.href="login.php"</script>';
}
	

$dob = date('d-m-Y');
if(!empty($userDetails["dob"])&&$userDetails["dob"]!='0000-00-00'){
	$dob= h_dateFormat($userDetails["dob"],'d-m-Y');
}
$activeTab = 'basic';
    

?>
<html lang="en-US" class="no-js">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Edit Profile | Your Agency Name</title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='<?='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script'?>' rel='stylesheet' type='text/css'>

<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="assets/wp-content/themes/theagency3/library/images/win8-tile-icon.png">
<link rel="pingback" href="../xmlrpc.php">


<style type="text/css">
label
{
  color: #ffffff !important;
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

<script type='text/javascript' src='<?='assets/wp-includes/js/jquery/jquery.js'?>' id='jquery-core-js'></script>

<script type='text/javascript' src='<?='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js'?>' id='rich-reviews-js'></script>
<script type='text/javascript' src='<?='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js'?>' id='bones-modernizr-js'></script>
<?php include('includes/head_css.php'); ?>

<!-- <style>
body, .visual-form-builder label, label.vfb-desc { color:#999999; font-family:georgia, serif; font-weight:Normal; font-size:17px; }
h1,h2,h3,h4,h5,h6, #footer h4 { color:#ffffff; font-family:"Georgia", Helvetica, serif; font-weight:normal; font-size:36px; }
a {color:#BDB392}.navbar.navbar-default.navbar-inverse.navbar-right, .dropdown-menu {background:#222222}.td-vam-inner.border-top-bottom, .td-vam-inner.border-bottom {border-color:#ffffff}.navbar-inverse .navbar-nav > li > a, .dropdown-menu > li > a {color:#999999}.navbar-inverse .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover {color:#ffffff}a:hover, .btn.btn-facebook:hover {color:#ffffff}#content, #footer, #sub-floor, .protable-outer, ul.profile span:first-child, ul.profile span + span {background:#181818}.google-mixed { color:#ffffff; font-family:Georgia, serif; font-weight:Normal; font-size:38px; }
.google-mixed-2 { color:#999999; font-family:Georgia, serif; font-weight:Normal; font-size:20px; }
</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-image: url("assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
</style> -->

<style>
.vfb-section{
	list-style:none;
	padding:0;
}
.vfb-section li{
	margin-bottom:20px;
}
</style>
	</head>

<body class="page-template page-template-page-custom-sidebar page-template-page-custom-sidebar-php page page-id-865 custom-background">
   <?php include('includes/header.php'); ?>
      <div class="container">

<?php
include('user_tab/edit_profile_menu_tab.php');
?>
        
      <div id="content" class="clearfix row">

        
          <div id="main" class="col-md-8 clearfix" role="main">

          
                        
            <article id="post-865" class="clearfix post-865 page type-page status-publish hentry" role="article" itemscope itemtype="https://schema.org/BlogPosting">
              
              <header class="page-head article-header">
                
                <div class="headline-outer"><h1 itemprop="headline" class="page-title entry-title"><div class="prefancy fancy"><span>Edit Profile</span></div></h1></div>
              
              </header> <!-- end article header -->
            
              <section class="page-content entry-content clearfix" itemprop="articleBody"><div class="artivle-body-bg">
			  	
             

<div id="vfb-form-3" class="visual-form-builder-container">
   
      <input type="hidden" name="form_id" value="3" />
      <fieldset class="vfb-fieldset vfb-fieldset-2 personal-information " id="item-vfb-33">
          <div class="vfb-legend">
            <h3>Change Profile Picture</h3>
          </div>
          <form method="post" action="act-edit-profile.php" enctype="multipart/form-data">
            <input type="hidden" name="use_id" value="<?php echo $_SESSION["log_user_id"]; ?>">
            <ul class="vfb-section vfb-section-2">
              <li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29">
                <label for="vfb-29" class="vfb-desc">Profile picture </label>
                <input type="file" name="pic_img" id="vfb-29" class="vfb-text vfb-medium" required />
              </li>
              <li class="vfb-item vfb-item-submit" id="item-vfb-28">
                <input type="submit" name="submit_image" id="vfb-28" value="Update Picture" class="vfb-submit " />
              </li>
            </ul>
          </form>
      </fieldset> 
<form method="post" action="act-edit-profile.php"  enctype="multipart/form-data">
      <fieldset class="vfb-fieldset vfb-fieldset-1 your-contact-details " id="item-vfb-25">
         <div class="vfb-legend">
            <h3>General Information</h3>
         </div>
           <ul class="vfb-section vfb-section-1">
              <li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29"><label for="vfb-29" class="vfb-desc">Name  <span class="vfb-required-asterisk">*</span></label>
                  <input type="text" name="name" id="vfb-29" value="<?php echo $userDetails['name']; ?>" class="vfb-text  vfb-medium" required />
               </li>
               

<li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29">
<label for="vfb-29" class="vfb-desc">DOB  <span class="vfb-required-asterisk">*</span></label>
<input type="text" name="dob" value="<?=$dob?>" class="vfb-text  vfb-medium i-date" data-date-format="dd-mm-yyyy" autocomplete="off" required/>
</li>

              <li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29">
                <label for="vfb-29" class="vfb-desc">Gender  <span class="vfb-required-asterisk">*</span></label>

<label style="padding-right: 20px;">Male
<input type="radio" name="gender" value="Male" class="vfb-text  vfb-medium" <?=$userDetails['gender']=='Male'?'checked':''?> required />
</label>

<label style="padding-right: 20px;">Female
<input type="radio" name="gender" value="Female" class="vfb-text  vfb-medium" <?=$userDetails['gender']=='Female'?'checked':''?> required />
</label>

<label style="padding-right: 20px;">Transgender
<input type="radio" name="gender" value="Transgender" class="vfb-text  vfb-medium" <?=$userDetails['gender']=='Transgender'?'checked':''?> required />
</label>

<label style="padding-right: 20px;">Couple 
<input type="radio" name="gender" value="Couple" class="vfb-text  vfb-medium" <?=$userDetails['gender']=='Couple'?'checked':''?> required />
</label>
                
              </li>
              <input type="hidden" name="use_id" value="<?php echo $_SESSION["log_user_id"]; ?>">
               <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30">
                 <label for="vfb-30" class="vfb-desc">Country <span class="vfb-required-asterisk">*</span></label>
<select name="country" class="form-control select2" required>
  <option value="">Select</option>
  <?php
  foreach($country_list as $val){
      ?>
      <option value="<?=$val['name']?>" <?=$userDetails['country']==$val['name']?'selected':''?>><?=$val['name']?></option>
      <?php	
  }
  ?>
</select>                   
               </li>
               
                <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30"><label for="vfb-30" class="vfb-desc">City <span class="vfb-required-asterisk">*</span></label>
                    <input type="text" value="<?php echo $userDetails['city']; ?>" name="city" id="vfb-30" value="" class="vfb-text  vfb-medium email " required/>
               </li>
			   
			   <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30"><label for="vfb-30" class="vfb-desc">Services </label>
                    <select name="services" class="form-control select2">
                                        <option value="" class="bg-gray-900">Select Your Services</option>
                                        <option value="Chat Only" <?php if($userDetails['services'] == 'Chat Only') echo 'selected'; ?> class="bg-gray-900">💬 Chat Only</option>
                                        <option value="Chat & Watch" <?php if($userDetails['services'] == 'Chat & Watch') echo 'selected'; ?> class="bg-gray-900">💬📹 Chat & Watch</option>
                                        <option value="Chat, Watch & Meet" <?php if($userDetails['services'] == 'Chat, Watch & Meet') echo 'selected'; ?> class="bg-gray-900">💬📹🤝 Chat, Watch & Meet</option>
                                        <option value="Premium Experience" <?php if($userDetails['services'] == 'Premium Experience') echo 'selected'; ?> class="bg-gray-900">👑 Premium Experience</option>
                                    </select>
               </li>
			   
			   <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30"><label for="vfb-30" class="vfb-desc">Bio </label>
                    <textarea  name="user_bio" id="vfb-30" class="vfb-text user_bio vfb-medium email " ><?php echo $userDetails['user_bio']; ?></textarea>
               </li> 
			   
			   <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30"><label for="vfb-30" class="vfb-desc">Current Status </label>
                    <textarea  name="user_current_status" id="vfb-30" class="vfb-text user_current_status vfb-medium email " ><?php echo $userDetails['user_current_status']; ?></textarea>
               </li> 
			   
           </ul>
         &nbsp;
      </fieldset>
      <fieldset class="vfb-fieldset vfb-fieldset-2 personal-information " id="item-vfb-33">
         <div class="vfb-legend">
            <h3>Account Information</h3>
         </div>
         <ul class="vfb-section vfb-section-2">
            <li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29"><label for="vfb-29" class="vfb-desc">Username  <span class="vfb-required-asterisk">*</span></label>
            <input type="text" name="username" value="<?php echo $userDetails['username']; ?>" id="vfb-29" class="vfb-text  vfb-medium" required /></li>
           
           <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30"><label for="vfb-30" class="vfb-desc">Your Email  <span class="vfb-required-asterisk">*</span></label><input type="email"  value="<?php echo $userDetails['email']; ?>" name="email" id="vfb-30" class="vfb-text  vfb-medium  required" required /></li>
                <li class="vfb-item vfb-item-submit" id="item-vfb-28">
                 <input type="submit" name="submit_name" id="vfb-28" value="Update" class="vfb-submit " />
              </li>
           
         </ul>
         &nbsp;
      </fieldset>
 </form>
      
      <fieldset class="vfb-fieldset vfb-fieldset-3 short-bio " id="item-vfb-40">
         <div class="vfb-legend">
            <h3>Change Password</h3>
         </div>
         <form method="post" action="act-edit-profile.php">
           <ul class="vfb-section vfb-section-3">
              <input type="hidden" name="use_id" value="<?php echo $_SESSION["log_user_id"]; ?>">
              <li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29"><label for="vfb-29" class="vfb-desc">Current Password  <span class="vfb-required-asterisk">*</span></label><input type="password" name="current_pass" id="vfb-29" value="" class="vfb-text  vfb-medium" required /></li>
              <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-30"><label for="vfb-30" class="vfb-desc">New Password <span class="vfb-required-asterisk">*</span></label><input type="password" name="new_password" id="vfb-30" value="" class="vfb-text  vfb-medium  required  email " /></li>
                 <li class="vfb-item vfb-item-text   vfb-left-half" id="item-vfb-29"><label for="vfb-29" class="vfb-desc">Confirm Password  <span class="vfb-required-asterisk">*</span></label><input type="password" name="confirm_pass" id="vfb-29" value="" class="vfb-text  vfb-medium" required /></li>
                  <li class="vfb-item vfb-item-submit" id="item-vfb-28">
                 <input type="submit" name="submit_pass" id="vfb-28" value="Submit" class="vfb-submit " />
              </li>
           </ul>
         </form>
         &nbsp;
      </fieldset>
         
    </div>
  </div>
  </section> 
<footer>
                                
              </footer> 
            
            </article>
                    
          </div> 

          <div class="col-md-4 clearfix"><div class="sidebar_content widget"><div class="img-responsive">
<img loading="lazy" class="alignnone wp-image-881 size-full" src="assets/wp-content/uploads/2016/01/casting-sb2.jpg" alt="profile" width="360" height="2681" />
</div></div></div>      
        </div> <!-- end #content -->

      </div> <!-- end .container -->

    <?php include('includes/footer.php'); ?>
<link href="<?=SITEURL?>assets/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="<?=SITEURL?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	$('.i-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});


});
</script>   
  </body>
</html> 

