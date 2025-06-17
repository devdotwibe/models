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



<style type="text/css">
  body {
    padding : 10px ;
    
  }

  #exTab1 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
  }

  #exTab2 h3 {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
  }

  /* remove border radius for the tab */

  #exTab1 .nav-pills > li > a {
    border-radius: 0;
  }

  /* change border radius for the tab , apply corners on top*/

  #exTab3 .nav-pills > li > a {
    border-radius: 4px 4px 0 0 ;
  }

  #exTab3 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
  }
</style>
  </head>

<body class="page-template-default page page-id-311 custom-background">
<?php include('../includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
         
         <?php //include('../model-panel/sidebar.php'); ?>
      
        <div class="container">
          <h4>Add for coins Insta and Snap:</h4>
          <div class="row" style="width: 80%;margin: auto;margin-top: 50px;margin-bottom: 50px;">
            <form method="post" action="act-insta-snap.php">
              <input type="hidden" name="model_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
              <div class="form-group">
                <label for="exampleInputEmail1">Coins for Instagram (Per call)</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Instagram coins" name="i_coins">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Coins for SnapChat (Per call)</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter SnapChat coins" name="s_coins">
              </div>
              <small id="emailHelp" class="form-text text-muted">These will only for per user single call.</small>
              <br>
              <button type="submit" name="submit" class="btn btn-primary fancy_button" style="padding: 5px 15px;">Submit</button>
            </form>
          </div>
        </div>

        </div> <!-- end #content -->

      </div> <!-- end .container -->
      
<?php include('../includes/footer.php'); ?>
  </body>


</html> 
