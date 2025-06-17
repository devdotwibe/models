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

<link rel="apple-touch-icon" href="../assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="../assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="../assets/wp-content/themes/theagency3/library/images/win8-tile-icon.png">
<link rel="pingback" href="../xmlrpc.php">

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
<link rel='stylesheet' id='visual-form-builder-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='vfb-jqueryui-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/smoothness/jquery-ui-1.10.3.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='https://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='../assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='../assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='../assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='../assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='../assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="../assets/wp-json/index.html" /><link rel="alternate" type="application/json" href="../assets/wp-json/wp/v2/pages/311.json" /><link rel='shortlink' href='../index2e31.html?p=311' />
<link rel="alternate" type="application/json+oembed" href="../assets/wp-json/oembed/1.0/embed53cd.json?url=http%3A%2F%2Ftheagency.escortthemes.com%2Fbooking%2F" />
<link rel="alternate" type="text/xml+oembed" href="../assets/wp-json/oembed/1.0/embed3ed2?url=http%3A%2F%2Ftheagency.escortthemes.com%2Fbooking%2F&amp;format=xml" />

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
          <!-- <div id="main" class="col-md-8 clearfix" role="main">
Welcome <?php //echo $_SESSION["log_user"]; ?>,
          </div> -->


              <div class="headline-outer col-md-12 col-xs-12 col-sm-12 clearfix">
                <h4 class="page-title entry-title" itemprop="headline">
                  <div class="prefancy fancy"><span>Rates</span></div>
                </h4>
              </div>
              <span id="state"></span>    
              <form action="act-rate.php" method="post" enctype="multipart/form-data" class="rr_review_form" >
                <input type="hidden" id="_wpnonce" name="_wpnonce" value="23bd502a6e" /><input type="hidden" name="_wp_http_referer" value="/model/stacia/" />      <input type="hidden" name="rRating" id="rRating" value="0" />
                <input type="hidden" name="model_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
                <table class="form_table">
                  <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required" >
                      Price in   
                    </td>
                    <td class="rr_form_input">
                      <span class="form-err"></span>     
                      <select name="currency" required="required">
                        <option>Select</option>
                        <option value="inr">INR</option>
                        <option value="usd">USD</option>
                      </select>
                    </td>
                  </tr>
                  <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required" >
                      1 Hour    
                    </td>
                    <td class="rr_form_input">
                      <span class="form-err"></span>   
                       <input class="rr_small_input" type="text" name="one_hours_price" placeholder="" value=""   required />
                    </td>
                  </tr>
                  <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required" >
                      2 Hours   
                    </td>
                    <td class="rr_form_input">
                      <span class="form-err"></span>     
                      <input class="rr_small_input" type="text" name="two_hours_price" placeholder="" value="" required />
                    </td>
                  </tr>
                  <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required" >
                      3 Hours
                    </td>
                    <td class="rr_form_input">
                      <span class="form-err"></span>
                      <input class="rr_small_input" type="text" name="three_hours_price" placeholder="" value="" required />
                    </td>
                  </tr>
                  <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required">4+ Hours</td>
                     <td class="rr_form_input">
                      <span class="form-err"></span>  
                      <input class="rr_small_input" type="text" name="four_hours_price" placeholder="" value="" required />
                    </td>
                  </tr>
                   <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required">1 Day</td>
                     <td class="rr_form_input">
                      <span class="form-err"></span>      
                      <input class="rr_small_input" type="text" name="one_day_price" placeholder="" value="" required />
                    </td>
                  </tr>
                   <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required">2 Days</td>
                     <td class="rr_form_input">
                      <span class="form-err"></span>    
                      <input class="rr_small_input" type="text" name="two_day_price" placeholder="" value="" required />
                    </td>
                  </tr>
                   <tr class="rr_form_row">
                    <td class="rr_form_heading rr_required">Special Events</td>
                     <td class="rr_form_input">
                      <span class="form-err"></span>    
                      <input class="rr_small_input" type="text" name="special_event_price" placeholder="" value="" required />
                    </td>
                  </tr>
                
                  <tr class="rr_form_row">
                    <td></td>
                    <td class="rr_form_input"><input id="submitReview" name="submitButton" type="submit" value="Submit"/></td>
                  </tr>
                </table>
              </form>
        </div> <!-- end #content -->

      </div> <!-- end .container -->
<?php include('../includes/footer.php'); ?>
  </body>


</html> 
