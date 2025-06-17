<?php 
include('includes/config.php'); 
include('includes/helper.php'); 
if($_POST){
	$email = $_POST['email'];
	if($email){
		$get_data = get_data('model_user',array('email'=>$email),true);
		if($get_data){
/*			$code =rand(100000,999999);
			$post_data =array(
				'reset_password'	=> $code,
			);
			DB::update('model_user', $post_data, "id=%s", $get_data['id']);*/
			
			$email_to = $get_data['email'];
//			$email_to = 'pvsysgroup01@gmail.com';
			$subject = "Mail Verification for Model Project";
			
			$header = "From: Forgot Password <prashant.systos@gmail.com>\r\n";
			$header .= "MIME-version:1.0\r\n";
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$htmlContent = file_get_contents("mail/forgotpassword-mail.php");
			$message = $htmlContent;
			$message = str_replace('{username}', $get_data['username'], $message);
			$message = str_replace('{name}', $get_data['name'], $message);
			$message = str_replace('{password}', $get_data['password'], $message);
			
//			echo $message;die;

         if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="forgotpassword.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="forgotpassword.php"</script>';
         }
		}
		else{
echo "<script>alert('Invalid email-address');
window.location='forgotpassword.php';
</script>";
		}
		printR($get_data);
		die;
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
<link rel='stylesheet' id='visual-form-builder-css-css'  href='assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css' type='text/css' media='all' />
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
</style>
	</head>

<body class="page-template-default page page-id-507 custom-background">
  <?php include('includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">

          
                        
            <article id="post-507" class="clearfix post-507 page type-page status-publish hentry" role="article" itemscope itemtype="https://schema.org/BlogPosting">
              
              <header class="page-head article-header">
                
                <div class="headline-outer"><h1 itemprop="headline" class="page-title entry-title"><div class="prefancy fancy">
                <span>Forgot Your Password</span></div></h1></div>
              
              </header> <!-- end article header -->
            
              <section class="page-content entry-content clearfix" itemprop="articleBody"><div class="artivle-body-bg row">
			  	
                <!-- <h4 class="headline-title entry-title" itemprop="headline2"><div class="prefancy fancy"><span class="hdln-badge">+1 000 00 0000</span></div></h4> -->
<!-- <h3 style="text-align: center;">Our Location: London, United Kingdom</h3> -->
<div id="vfb-form-2 " class="visual-form-builder-container my_login_div" >
	<form id="contact-2" class="visual-form-builder vfb-form-2 " method="post" enctype="multipart/form-data" action="">
			<input type="hidden" name="form_id" value="2" />
			<fieldset class="vfb-fieldset vfb-fieldset-1 send-a-quick-message " id="item-vfb-17">
				<!-- <div class="vfb-legend">
					<h3>Send a quick message!</h3>
				</div> -->
				<ul class="vfb-section vfb-section-1">
					<li class="vfb-item vfb-item-text   " id="item-vfb-21">
						<label for="vfb-21" class="vfb-desc">Email-address:  <span class="vfb-required-asterisk">*</span></label>
						<input type="email" name="email" class="vfb-text  vfb-medium" required/>
					</li>
					
					<ul class="vfb-section vfb-section-2">
					<li class="vfb-item vfb-item-submit" id="item-vfb-20">
						<input type="submit" name="vfb-submit" id="vfb-20" value="Submit" class="vfb-submit " />
					</li>

					</ul>
				</ul>
			</fieldset>
			
            
              </div></section> <!-- end article section -->
              
             
            </article>     
          </div> 
        </div> 
      </div> 

  <?php include('includes/footer.php'); ?>


	
   

  </body>


</html> 
