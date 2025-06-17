<!doctype html>
<?php 
  session_start();
  include('includes/config.php');  
?>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>
  Testimonials</title>
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

<script type='text/javascript' src='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="assets/wp-json/index.html" />
<!-- <style>
body, .visual-form-builder label, label.vfb-desc { color:#999999; font-family:georgia, serif; font-weight:Normal; font-size:17px; }
h1,h2,h3,h4,h5,h6, #footer h4 { color:#ffffff; font-family:"Georgia", Helvetica, serif; font-weight:normal; font-size:36px; }
a {color:#BDB392}.navbar.navbar-default.navbar-inverse.navbar-right, .dropdown-menu {background:#222222}.td-vam-inner.border-top-bottom, .td-vam-inner.border-bottom {border-color:#ffffff}.navbar-inverse .navbar-nav > li > a, .dropdown-menu > li > a {color:#999999}.navbar-inverse .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover {color:#ffffff}a:hover, .btn.btn-facebook:hover {color:#ffffff}#content, #footer, #sub-floor, .protable-outer, ul.profile span:first-child, ul.profile span + span {background:#181818}.google-mixed { color:#ffffff; font-family:Georgia, serif; font-weight:Normal; font-size:38px; }
.google-mixed-2 { color:#999999; font-family:Georgia, serif; font-weight:Normal; font-size:20px; }
</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-image: url("assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
</style> -->
	</head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
<?php include('includes/header.php'); ?>
      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">

          <div class="headline-outer"><h4 itemprop="headline" class="page-title entry-title"><div class="prefancy fancy"><span>All Testimonials</span></div></h4></div>
          <?php
            $sql_test = "SELECT * FROM testimonials Order by id DESC ";
              $result_test = mysqli_query($con, $sql_test);
                if (mysqli_num_rows($result_test) > 0) {
                  $count = 1;
                  while($row_test = mysqli_fetch_assoc($result_test)) {
          ?>
             
                <article id="post-461" class="testimonial post-461 testimonials type-testimonials status-publish has-post-thumbnail hentry">
                    
                    <div class="entry-testimonial-content">
					<div class="pull-left client-info" style="margin-top:35px;margin-right:20px;margin-left:20px;"><img width="100" height="100" src="<?php echo $row_test['testmonial_image']; ?>" class="attachment-testimonial_photo size-testimonial_photo wp-post-image" alt="" loading="lazy" srcset="<?php echo $row_test['testmonial_image']; ?>" sizes="(max-width: 100px) 100vw, 100px" /></div>
                        <p class="testimonial-text" style="padding-bottom:5px;"><span class="fa fa-quote-left" style="margin-right:5px;"></span><?php echo $row_test['testmonial_description']; ?> <span class="fa fa-quote-right t-client" style="margin-left:5px;"></span></span><span></span></p>
						<p class="testimonial-client-name"><cite class="t-client"><?php echo $row_test['testmonial_name']; ?></cite></p><div class="clearfix"></div>
                    </div>
                </article>
 <?php
        $count++;
        }
          } else {
            echo "0 results";
          }
      ?>
             
  
                    
          </div> <!-- end #main -->

        </div> <!-- end #content -->

      </div> <!-- end .container -->

 <?php include('includes/footer.php'); ?>

	
    <script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/FitVids.js-master/jquery.fitvids.js' id='fitvids-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/fitvid.js' id='fitvids-xtra-js'></script>
<script type='text/javascript' src='assets/wp-includes/js/imagesloaded.min.js' id='imagesloaded-js'></script>
<script type='text/javascript' src='assets/wp-includes/js/masonry.min.js' id='masonry-js'></script>
<script type='text/javascript' src='assets/wp-includes/js/jquery/jquery.masonry.min.js' id='jquery-masonry-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/scripts.js' id='bones-js-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/bootstrap.min.js' id='bones-bootstrap-js'></script>
<script type='text/javascript' src='assets/wp-includes/js/wp-embed.min.js' id='wp-embed-js'></script>
<script type='text/javascript' src='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/owl.carousel.min.js' id='wpgt-gallery-owlcarousel-js'></script>
<script type='text/javascript' src='assets/wp-content/plugins/wpgt-gallery/includes/js/imagesloaded.pkgd.min.js' id='wordpresscanvas-imagesloaded-js'></script>
<script type='text/javascript' src='assets/wp-content/plugins/wpgt-gallery/includes/js/gallery.js' id='wpgt-gallery-js'></script>

  </body>
</html> 
