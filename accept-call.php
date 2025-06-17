<?php 
session_start(); 
include('includes/config.php');
?>


<!doctype html>

<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>FAQ | The Live Model</title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

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
	<link rel='stylesheet' id='wp-block-library-css'  href='assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='https://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />
<!--[if lt IE 9]>
<link rel='stylesheet' id='bones-ie-only-css'  href='https://theagency.escortthemes.com/wp-content/themes/theagency3/library/css/ie.css' type='text/css' media='all' />
<![endif]-->
<script type='text/javascript' src='assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="assets/wp-json/index.html" /><link rel="alternate" type="application/json" href="assets/wp-json/wp/v2/pages/319.json" /><link rel='shortlink' href='../index63fb.html?p=319' />
<link rel="alternate" type="application/json+oembed" href="assets/wp-json/oembed/1.0/embedefe0.json?url=http%3A%2F%2Ftheagency.escortthemes.com%2Ffaq%2F" />
<link rel="alternate" type="text/xml+oembed" href="assets/wp-json/oembed/1.0/embede9d9?url=http%3A%2F%2Ftheagency.escortthemes.com%2Ffaq%2F&amp;format=xml" />
<style type="text/css">
	.text_call{
		text-align: center;
		font-size: 20px;
	}
	.text_call_li{
		color: #d83b1b;
    font-size: 17px;
	}
	.text_call_head{
		text-align: center;
		font-size: 16px;
	}
	.acc_btn{
		padding: 6px 15px;
    margin-left: 35px;
	}
</style>

	</head>

<body class="page-template-default page page-id-319 custom-background">
  <?php include('includes/header.php'); ?>
    <div class="container-fluid">
      <div id="content" class="clearfix row">
        <div id="main" class="col-md-12 clearfix" role="main">
        	<?php
        		$sql_fwa = "SELECT * FROM insta_snap_call WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
			      $result_fwa = mysqli_query($con,$sql_fwa);
			      if (mysqli_num_rows($result_fwa) > 0) {
			          $row_fwa = mysqli_fetch_assoc($result_fwa);
			          $user_id = $row_fwa['unique_user_id'];


			          $sql_fwa1 = "SELECT * FROM model_user WHERE unique_id = '".$user_id."'";
					      $result_fwa1 = mysqli_query($con,$sql_fwa1);
					      if (mysqli_num_rows($result_fwa1) > 0) {
					          $row_fwa1 = mysqli_fetch_assoc($result_fwa1);

			      
        	?>
        	<form method="post" >
	        	<p class="text_call"><?php echo $row_fwa1['username']; ?> <br> has requested to video call on  <br> <?php echo $row_fwa['call_on']; ?> <br> Approv their request and set a time for call and inform <?php echo $row_fwa1['username']; ?></p>
	        	<hr style="margin-top: 20px;">
	        	<p class="text_call_head">Instagram Details</p>
	        	<hr style="margin-bottom: 20px;">
	          <ul  style="list-style-type: none;">
	          	<li class="text_call_li" >Username: <?php echo $row_fwa['username']; ?></li>
	          	<li class="text_call_li">Email: <?php echo $row_fwa['email']; ?></li>
	          </ul>
	          <input type="hidden" name="user_id" value="<?php echo $row_fwa['unique_user_id']; ?>">
	          <input type="hidden" name="model_id" value="<?php echo $row_fwa['unique_model_id']; ?>">
	          <input class="fancy_button acc_btn" type="submit" name="accept_call" value="Accept Call">
	        </form>
    			<?php } ?>
    			<?php } ?>
        </div> 
      </div>
    </div> 
 	<?php include('includes/footer.php'); ?>
</body>
<?php
	if ($_POST['accept_call']) {
		$user_id = $_POST['user_id'];
		$model_id = $_POST['model_id'];

		$sql = "UPDATE `insta_snap_call` SET `status` = 'Approved' WHERE `unique_user_id` = '".$user_id."' AND `unique_model_id` = '".$model_id."'";
		if (mysqli_query($con,$sql)) {
			echo '<script>alert("You have successfully accept their request.");</script>';
			echo "<script>window.location='notifications.php';</script>";
		}else{
			echo '<script>alert("Oops!! We found some error in accept request.");</script>';
			echo "<script>window.location='notifications.php';</script>";
		}

	}

?>

</html> 
