<?php 
session_start();
include('includes/config.php');
include('includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
		header("Location: ".SITEURL."single-profile.php?m_unique_id=".$userDetails['unique_id']);
	}
}

?>
<!doctype html>

<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Sign In here | Newmodels</title>
<meta name="description" content="Connect and interact with a wide range of models from around the globe. Login to enjoy all the service and features. Find more option to connect with The Live Models by signing in with The Live Models account.">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<link rel='stylesheet' id='visual-form-builder-css-css'  href='<?='assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css'?>' type='text/css' media='all' />
<?php include('includes/head.php'); ?>


<style type="text/css">
.my_login_div{
	width: 50%;
	margin: auto;
}
@media screen and (max-width: 600px) {
  .my_login_div {
	width: 100%;
	/*margin: auto;*/
  }
}

.btn-googleplus {
    color: #ffffff !important;
    background-color: #dd4b39 !important;
}
</style>
	</head>

<body class="page-template-default page page-id-507 custom-background">
  <?php include('includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">

          
                        
            <article id="post-507" class="clearfix post-507 page type-page status-publish hentry" role="article" itemscope itemtype="https://schema.org/BlogPosting">
              
              <header class="page-head article-header">
                
                <div class="headline-outer"><h1 itemprop="headline" class="page-title entry-title"><div class="prefancy fancy"><span>Login</span></div></h1></div>
              
              </header> <!-- end article header -->
            
              <section class="page-content entry-content clearfix" itemprop="articleBody"><div class="artivle-body-bg row">
			  	
                <!-- <h4 class="headline-title entry-title" itemprop="headline2"><div class="prefancy fancy"><span class="hdln-badge">+1 000 00 0000</span></div></h4> -->
<!-- <h3 style="text-align: center;">Our Location: London, United Kingdom</h3> -->
<div id="vfb-form-2 " class="visual-form-builder-container my_login_div" >
	<form id="contact-2" class="visual-form-builder vfb-form-2 " method="post" enctype="multipart/form-data" action="act-login.php">
			<input type="hidden" name="form_id" value="2" />
			<fieldset class="vfb-fieldset vfb-fieldset-1 send-a-quick-message " id="item-vfb-17">
				<!-- <div class="vfb-legend">
					<h3>Send a quick message!</h3>
				</div> -->
                <div class="text-center">
<h4 class="pop-had-sty"> Login With </h4>
<a href="<?=SITEURL.'libss/google_login.php'?>" class="btn btn-googleplus "> <span class="btn-label"><i class="fa fa-google-plus"></i> </span>Google+</a>                
</div>
				<ul class="vfb-section vfb-section-1">
					<li class="vfb-item vfb-item-text   " id="item-vfb-21">
						<label for="vfb-21" class="vfb-desc">Username:  <span class="vfb-required-asterisk">*</span></label>
						<input type="text" name="username" id="vfb-21" class="vfb-text  vfb-medium" required/>
					</li>
					<li class="vfb-item vfb-item-email   " id="item-vfb-22"><label for="vfb-22" class="vfb-desc">Password:  <span class="vfb-required-asterisk">*</span></label>
						<input type="password" name="password" id="vfb-24" class="vfb-text  vfb-medium email " required />
					</li>
					<!-- <li class="vfb-item vfb-item-text  " id="item-vfb-24"><label for="vfb-24" class="vfb-desc">Subject </label><input type="text" name="vfb-24" id="vfb-24" value="" class="vfb-text  vfb-medium   " /></li>

					<li class="vfb-item vfb-item-textarea  " id="item-vfb-23"><label for="vfb-23" class="vfb-desc">Your Message  <span class="vfb-required-asterisk">*</span></label><div><textarea name="vfb-23" id="vfb-23" class="vfb-textarea  vfb-medium  required "></textarea></div></li>-->
					<ul class="vfb-section vfb-section-2">
					<li class="vfb-item vfb-item-submit" id="item-vfb-20">
						<input type="submit" name="vfb-submit" id="vfb-20" value="Submit" class="vfb-submit " />&nbsp;<a href="register.php">&nbsp;Register Now&nbsp;</a>
					</li>

					<li class="vfb-item vfb-item-submit" id="item-vfb-20">
<a href="forgotpassword.php">Forgot your password?</a>
					</li>
					</ul>
				</ul>&nbsp;
			</fieldset>
			
            
              </div></section> <!-- end article section -->
              
             
            </article>     
          </div> 
        </div> 
      </div> 

  <?php include('includes/footer.php'); ?>


	
   

  </body>


</html> 
