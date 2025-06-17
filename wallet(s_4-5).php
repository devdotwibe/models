<?php 
  session_start(); 
  include('includes/config.php');
?>
<?php 
    session_start(); 
    $usern = $_SESSION["log_user"];
    
    if( !$usern ){
        echo '<script>window.location.href="login.php"</script>';
    }
?>
<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Purchase </title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='<?='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script'?>' rel='stylesheet' type='text/css'>

  <script src='<?='https://kit.fontawesome.com/a076d05399.js'?>'></script>

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
  <link rel='stylesheet' id='wp-block-library-css'  href='<?=SITEURL?>assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='<?=SITEURL?>assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='<?=SITEURL?>assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='<?='http://fonts.googleapis.com/css?family=Rokkitt'?>' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='<?=SITEURL?>assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='<?=SITEURL?>assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='<?=SITEURL?>assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='<?=SITEURL?>assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='<?=SITEURL?>assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="<?='https://api.w.org/'?>" href="assets/wp-json/index.html" />
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

          <!-- <div class="headline-outer">
            <h4 itemprop="headline" class="page-title entry-title">
              <div class="prefancy fancy">
                <span>Current Wallet Status</span>
              </div>
            </h4>
          </div> -->
          <?php
            $log_user_id = $_SESSION["log_user_unique_id"];
            $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$log_user_id."'";
            $result = mysqli_query($con,$sql);

              if (mysqli_num_rows($result) > 0) {

                $row1 = mysqli_fetch_assoc($result);
                 
                $wallet_coins = $row1['wallet_coins'];
            }       
          ?>
          <h3>Currently you have <i class="fas fa-coins" style="font-size:15px;color:gold" aria-hidden="true"></i> <?php echo $wallet_coins; ?> coins in your wallet.</h3>
             <div class="panel panel-default">
            <a class="panel-heading collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq-925">
    <h4 class="panel-title">
        <span class="pull-right icon"></span>For Indian Users (in INR.)</h4>
</a>
            <div id="faq-925" class="panel-collapse ">
              <div class="panel-body">
                <table style="width:100%">
                  <tr>
                    <form method="post" action="payments/index.php">
                      <input type="hidden" name="coins" value="50coins">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10 Coins</th>
                      <input type="hidden" name="amount" value="100">
                      <input type="hidden" name="coins" value="10">
                      <th>Rs. 100</th>
                      <th><button type="submit" class="btn fancy_button" name="submit100" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;50 Coins</th>
                      <input type="hidden" name="amount" value="500">
                      <input type="hidden" name="coins" value="50">
                      <th>Rs. 500</th>
                      <th><button type="submit" class="btn fancy_button" name="submit500" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;100 Coins</th>
                      <input type="hidden" name="amount" value="900">
                      <input type="hidden" name="coins" value="100">
                      <th>Rs. 900</th>
                      <th><button type="submit" class="btn fancy_button" name="submit900" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;200 Coins</th>
                      <input type="hidden" name="amount" value="1500">
                      <input type="hidden" name="coins" value="200">
                      <th>Rs. 1500</th>
                      <th><button type="submit" class="btn fancy_button" name="submit1500" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;300 Coins</th>
                      <input type="hidden" name="amount" value="1900">
                      <input type="hidden" name="coins" value="300">
                      <th>Rs. 1900</th>
                      <th><button type="submit" class="btn fancy_button" name="submit2000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;500 Coins</th>
                      <input type="hidden" name="amount" value="3000">
                      <input type="hidden" name="coins" value="500">
                      <th>Rs. 3000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit3000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;700 Coins</th>
                      <input type="hidden" name="amount" value="4000">
                      <input type="hidden" name="coins" value="700">
                      <th>Rs. 4000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit4000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1000 Coins</th>
                      <input type="hidden" name="amount" value="5000">
                      <input type="hidden" name="coins" value="1000">
                      <th>Rs. 5000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit5000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2500 Coins</th>
                      <input type="hidden" name="amount" value="10000">
                      <input type="hidden" name="coins" value="2500">
                      <th>Rs. 10,000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit10000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5000 Coins</th>
                      <input type="hidden" name="amount" value="15000">
                      <input type="hidden" name="coins" value="5000">
                      <th>Rs. 15,000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit15000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7500 Coins</th>
                      <input type="hidden" name="amount" value="20000">
                      <input type="hidden" name="coins" value="7500">
                      <th>Rs. 20,000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit20000" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9999 Coins</th>
                      <input type="hidden" name="amount" value="25000">
                      <input type="hidden" name="coins" value="9999">
                      <th>Rs. 25,000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit25000" >Purchase Now</button></th>
                    </form>
                  </tr>

                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;20000 Coins</th>
                      <input type="hidden" name="amount" value="50000">
                      <input type="hidden" name="coins" value="20000">
                      <th>Rs. 50,000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit50000" >Purchase Now</button></th>
                    </form>
                  </tr>

                  <tr>
                    <form method="post" action="payments/index.php">
                      <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;40000 Coins</th>
                      <input type="hidden" name="amount" value="100000">
                      <input type="hidden" name="coins" value="40000">
                      <th>Rs. 1,00,000</th>
                      <th><button type="submit" class="btn fancy_button" name="submit100000" >Purchase Now</button></th>
                    </form>
                  </tr>
                </table>
               
              </div>
            </div>
          </div>
                              <div class="panel panel-default">
            <a class="panel-heading collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq-924">
    <h4 class="panel-title">
        <span class="pull-right icon"></span>For Foreign Users (in USD.)</h4>
</a>
            <div id="faq-924" class="panel-collapse ">
              <div class="panel-body">
                <table style="width:100%">
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10 Coins</th>
                    <input type="hidden" name="amount" value="00.99">
                    <input type="hidden" name="coins" value="10">
                    <th>$ 00.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f0" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;50 Coins</th>
                    <input type="hidden" name="amount" value="5.99">
                    <input type="hidden" name="coins" value="50">
                    <th>$ 5.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f5" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;100 Coins</th>
                    <input type="hidden" name="amount" value="9.99">
                    <input type="hidden" name="coins" value="100">
                    <th>$ 9.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f9" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;200 Coins</th>
                    <input type="hidden" name="amount" value="14.99">
                    <input type="hidden" name="coins" value="200">
                    <th>$ 14.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f14" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;300 Coins</th>
                    <input type="hidden" name="amount" value="19.99">
                    <input type="hidden" name="coins" value="300">
                    <th>$ 19.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f19" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;500 Coins</th>
                    <input type="hidden" name="amount" value="29.99">
                    <input type="hidden" name="coins" value="500">
                    <th>$ 29.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f29" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;700 Coins</th>
                    <input type="hidden" name="amount" value="39.99">
                    <input type="hidden" name="coins" value="700">
                    <th>$ 39.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f39" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1000 Coins</th>
                    <input type="hidden" name="amount" value="49.99">
                    <input type="hidden" name="coins" value="1000">
                    <th>$ 49.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f49" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2500 Coins</th>
                    <input type="hidden" name="amount" value="99.99">
                    <input type="hidden" name="coins" value="2500">
                    <th>$ 99.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f99" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5000 Coins</th>
                    <input type="hidden" name="amount" value="149.99">
                    <input type="hidden" name="coins" value="5000">
                    <th>$ 149.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f149" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7500 Coins</th>
                    <input type="hidden" name="amount" value="199.99">
                    <input type="hidden" name="coins" value="7500">
                    <th>$ 199.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f199" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9999 Coins</th>
                    <input type="hidden" name="amount" value="249.99">
                    <input type="hidden" name="coins" value="9999">
                    <th>$ 249.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f249" >Purchase Now</button></th>
                    </form>
                  </tr>
                  
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;20000 Coins</th>
                    <input type="hidden" name="amount" value="499.99">
                    <input type="hidden" name="coins" value="20000">
                    <th>$ 499.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f499" >Purchase Now</button></th>
                    </form>
                  </tr>
                  <tr>
                    <form method="post" action="payments/index.php">
                    <th><i class='fas fa-coins' style='font-size:25px;color:gold'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;40000 Coins</th>
                    <input type="hidden" name="amount" value="999.99">
                    <input type="hidden" name="coins" value="40000">
                    <th>$ 999.99</th>
                    <th><button type="submit" class="btn fancy_button" name="submit_f999" >Purchase Now</button></th>
                    </form>
                  </tr>
                </table>
              </div>
            </div>
          </div>
                
 
             
                    
          </div> <!-- end #main -->

                  
        </div>
      </div> 

   <?php include('includes/footer.php'); ?>
  </body>


</html> 
