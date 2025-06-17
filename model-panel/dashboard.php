<?php 
  session_start(); 
  include('../includes/config.php');
?>
<?php 
    session_start(); 
    $usern = $_SESSION["log_user"];
    
    if( !$usern ){
        echo '<script>window.location.href="../login.php"</script>';
    }
?>
<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Booking | Your Agency Name</title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


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
  <link rel='stylesheet' id='wp-block-library-css'  href='../assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='../assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='../assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<!-- <link rel='stylesheet' id='visual-form-builder-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='vfb-jqueryui-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/smoothness/jquery-ui-1.10.3.min.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='wpgt-gallery-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='options_typography_Rokkitt-css'  href='https://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='rich-reviews-css'  href='../assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' /> -->
<link rel='stylesheet' id='bones-stylesheet-css'  href='../assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='../assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<!-- <script type='text/javascript' src='../assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script> -->
<!-- <script type='text/javascript' src='../assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script> -->


<!-- <style>
body, .visual-form-builder label, label.vfb-desc { color:#999999; font-family:georgia, serif; font-weight:Normal; font-size:17px; }
h1,h2,h3,h4,h5,h6, #footer h4 { color:#ffffff; font-family:"Georgia", Helvetica, serif; font-weight:normal; font-size:36px; }
a {color:#BDB392}.navbar.navbar-default.navbar-inverse.navbar-right, .dropdown-menu {background:#222222}.td-vam-inner.border-top-bottom, .td-vam-inner.border-bottom {border-color:#ffffff}.navbar-inverse .navbar-nav > li > a, .dropdown-menu > li > a {color:#999999}.navbar-inverse .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover {color:#ffffff}a:hover, .btn.btn-facebook:hover {color:#ffffff}#content, #footer, #sub-floor, .protable-outer, ul.profile span:first-child, ul.profile span + span {background:#181818}.google-mixed { color:#ffffff; font-family:Georgia, serif; font-weight:Normal; font-size:38px; }
.google-mixed-2 { color:#999999; font-family:Georgia, serif; font-weight:Normal; font-size:20px; }
</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-image: url("../assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
</style> -->
  </head>

<body class="page-template-default page page-id-311 custom-background">
<?php include('../includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
          <?php //include('../model-panel/sidebar.php'); ?>
          <div id="main" class="col-md-12 col-xs-12 col-sm-12 clearfix dash_up" role="main">
            <p style="padding: 20px;">Welcome <?php echo $_SESSION["log_user"]; ?>,</p>
            <?php
              $sqls = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
          $resultd = mysqli_query($con, $sqls);
            if (mysqli_num_rows($resultd) > 0) {
              $rowesdw = mysqli_fetch_assoc($resultd);
              $video_pictures = $rowesdw['video_pictures'];
          }
                if($video_pictures == 'Yes'){


            ?>  
            <p style="padding: 20px;">Start cashing your videos and images. </p>
              <a style="" class="dash_up_btn" href="images.php"> Upload now </a> 
            <?php }   ?>
          </div>
        </div> <!-- end #content -->

      </div> <!-- end .container -->
<?php include('../includes/footer.php'); ?>
  </body>


</html> 
