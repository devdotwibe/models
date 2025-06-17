<?php 
  session_start(); 
  include('includes/config.php');
?>

<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Model Search </title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

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

<script type='text/javascript' src='assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

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

    <div class="container">
      <div class="row">
        <h2 class="page_heading">Search Results for: <?php echo $_GET['country']; ?></h2>
        <?php
          $country = $_GET['country'];

          $count = 1;
            $sqls = "SELECT * FROM casting WHERE status = 'Published' AND country = '".$country."' Order by id ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw = mysqli_fetch_assoc($resultd)) {
                     $unique_id = $rowesdw['unique_id'];

                      $sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result = mysqli_query($con, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while($rowe = mysqli_fetch_assoc($result)) {
                           $image_c = $rowe["count(*)"];
                        }
                      }
                      $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result1 = mysqli_query($con, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                        while($rowe1 = mysqli_fetch_assoc($result1)) {
                           $vdo_c = $rowe["count(*)"];
                        }
                      }                           


          ?>
        <div class="col-md-3">
          <div id="creator-list">
            <div class="creator">
                <a href="single-model.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>">
                    <figure><img src="<?php echo $rowesdw['photo_1']; ?>" alt="picture" /></figure>
                    <h5><?php echo $rowesdw['username']; ?></h5>
                    <div class="cr_posts">
                        <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                          <small><?php if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                            <small><?php if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
                    </div>
                    <div class="cr_rating"></div>
                </a>
            </div>
            <span></span>
          </div>
        </div>
        <?php
          $count++;
          }
            } else {
              echo "0 results";
            }
        ?>
      </div>
    </div>

      <!-- <div class="container-fluid">

        <div id="content" class="clearfix row">
        
       <section>
    <div class="container">
        <div class="allcreators">
          <?php
          // $country = $_GET['country'];

          // $count = 1;
          //   $sqls = "SELECT * FROM casting WHERE status = 'Published' AND country = '".$country."' Order by id ";
          //     $resultd = mysqli_query($con, $sqls);
          //       if (mysqli_num_rows($resultd) > 0) {
          //         while($rowesdw = mysqli_fetch_assoc($resultd)) {
          //            $unique_id = $rowesdw['unique_id'];

          //             $sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
          //             $result = mysqli_query($con, $sql);
          //             if (mysqli_num_rows($result) > 0) {
          //               while($rowe = mysqli_fetch_assoc($result)) {
          //                  $image_c = $rowe["count(*)"];
          //               }
          //             }
          //             $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
          //             $result1 = mysqli_query($con, $sql1);
          //             if (mysqli_num_rows($result1) > 0) {
          //               while($rowe1 = mysqli_fetch_assoc($result1)) {
          //                  $vdo_c = $rowe["count(*)"];
          //               }
          //             }                           


          ?>
            <div id="creator-list">
                <div class="creator">
                    <a href="single-model.php?model=<?php// echo $rowesdw['username']; ?>&m_id=<?php //echo $rowesdw['id']; ?>&m_unique_id=<?php //echo $rowesdw['unique_id'];?>">
                        <figure><img src="<?php //echo $rowesdw['photo_1']; ?>" alt="" /></figure>
                        <h5><?php //echo $rowesdw['username']; ?></h5>
                        <div class="cr_posts">
                            <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                              <small><?php //if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                                <small><?php //if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
                        </div>
                        <div class="cr_rating"></div>
                    </a>
                </div>
             
              
                <span></span>
            </div>
             <?php
            // $count++;
            // }
            //   } else {
            //     echo "0 results";
            //   }
          ?>
        </div>
    </div>
</section>


                  
        </div>
      </div>  -->

   <?php include('includes/footer.php'); ?>
  </body>


</html> 
