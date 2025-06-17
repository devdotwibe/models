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

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<!-- <style>
body, .visual-form-builder label, label.vfb-desc { color:#999999; font-family:georgia, serif; font-weight:Normal; font-size:17px; }
h1,h2,h3,h4,h5,h6, #footer h4 { color:#ffffff; font-family:"Georgia", Helvetica, serif; font-weight:normal; font-size:36px; }
a {color:#BDB392}.navbar.navbar-default.navbar-inverse.navbar-right, .dropdown-menu {background:#222222}.td-vam-inner.border-top-bottom, .td-vam-inner.border-bottom {border-color:#ffffff}.navbar-inverse .navbar-nav > li > a, .dropdown-menu > li > a {color:#999999}.navbar-inverse .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover {color:#ffffff}a:hover, .btn.btn-facebook:hover {color:#ffffff}#content, #footer, #sub-floor, .protable-outer, ul.profile span:first-child, ul.profile span + span {background:#181818}.google-mixed { color:#ffffff; font-family:Georgia, serif; font-weight:Normal; font-size:38px; }
.google-mixed-2 { color:#999999; font-family:Georgia, serif; font-weight:Normal; font-size:20px; }
</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-image: url("../assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
</style> -->
<style type="text/css">
  .attachment-testimonial_photo.wp-post-image{
    margin-bottom: 0px; 
  }
  .close
  {
  	color: #ffffff !important;
  }
  .modal-content{
    background-color: #131313 !important;
  }
  input.vfb-text, input.vfb-text[type="text"], input.vfb-text[type="tel"], input.vfb-text[type="email"], input.vfb-text[type="url"], textarea.vfb-textarea, select.vfb-select{
    background-color: rgb(39 39 39) !important;
  }
  ul li{
    list-style-type: none;
  }
</style>

  </head>

<body class="page-template-default page page-id-311 custom-background">
<?php include('../includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
         
           <?php //include('../model-panel/sidebar.php'); ?>

          <div id="main" class="col-md-12 col-xs-12 col-sm-12 clearfix" role="main">
            
            <p>Your Images purchased by users.</p>
            <table>
            	<tr>
            		<td><b>File</b></td>
            		<td><b>Purchaser name</b></td>
            		<td><b>Type</b></td>
            		<td><b>Coins</b></td>
            		<td><b>Purchase Date</b></td>
            	</tr>
            <?php
              $un_id = $_SESSION["log_user_unique_id"];
                            
              $sql = "SELECT * FROM user_purchased_image WHERE model_unique_id = '".$un_id."'";
              $result = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                  $image_id = $row['file_unique_id'];
                  $user_unique_id = $row['user_unique_id'];


                      $sql1 = "SELECT * FROM model_images WHERE unique_image_id = '".$image_id."'";
                      $result1 = mysqli_query($con, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                        $row1 = mysqli_fetch_assoc($result1);
                          $file = $row1['file'];
                      } else {
                        echo '<tr><td scope="row">Currently you dont have any Image/Video.</td></tr>';
                      }

                      $sql2 = "SELECT * FROM model_user WHERE unique_id = '".$user_unique_id."'";
                      $result2 = mysqli_query($con, $sql2);
                      if (mysqli_num_rows($result2) > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                           $username = $row2['username'];
                      } else {
                        echo '<tr><td scope="row">Currently you dont have any Image/Video.</td></tr>';
                      }
                         
            ?>
            <form action="act-img-delete.php" method="post" > 
	            <tr>
  	        		<td>
  	        			<?php if($row['file_type'] == 'Image'){ ?>
  		        			<a href="../<?php echo $row1['file']; ?>">
  		        			<img width="100" height="100" src="../<?php echo $row1['file']; ?>" class="attachment-testimonial_photo size-testimonial_photo wp-post-image" alt="" loading="lazy" srcset="../<?php echo $row1['file']; ?>" sizes="(max-width: 100px) 100vw, 100px" />
  		        			</a>
  	        			<?php }else{ ?>
  	        				<video width="100" height="100" controls>
      							  <source src="../<?php echo $row1['file']; ?>" type="video/mp4">
      							</video>
  	        			<?php } ?>
  	        		</td>
  	        		<td>
  	        			<p class="testimonial-text" ><?php echo $username; ?></p>
  	        		</td>
  	        		<td>
  	        			<p class="testimonial-text" ><?php echo $row['file_type']; ?></p>
  	        		</td>
  	        		<td>
  	        			<p class="testimonial-text" ><?php echo $row['file_coins']; ?></p>
  	        		</td>
  	        		<td>
  	        			<p>
                    <?php 
                      $unixtime = $row['purchase_date'];
                      echo $time = date('d - m - Y',strtotime($unixtime));;
                      //echo $row['purchase_date']; ?>
                      
                    </p>
  	        		</td>
	        	  </tr>
        	  </form>
          <?php
          $total_coins += $row['file_coins'];
          }
            } else {
              echo '<tr><td scope="row">Currently you dont have any Image/Video.</td></tr>';
            }
          ?>
          </table>  


          <h5>You need Atleast 2000 Coins in your Model Wallet for creating the amount withdrawal request.</h5>
            <small>Please check our coins/payment withdrawal policy for further info <a href="#">Read Here.</a></small>
            <br>
            <h3>Current Model Wallet status: <i class="fas fa-coins" style="font-size:15px;color:gold" aria-hidden="true"></i>&nbsp;<?php echo $total_coins; ?>.</h3>
            <?php if($total_coins > 2000){ ?>
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="margin-bottom: 30px;">Withdrawal request</button>
            <?php }else{ ?>
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="margin-bottom: 30px;" disabled="disabled">Withdrawal request</button>
            <?php } ?>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="act-amount-withdrawal.php" enctype= multipart/form-data>

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Bank Details</h4>
                  </div>
                  <div class="modal-body">
                    
                      <ul class="vfb-section vfb-section-1">

                        <li class="vfb-item vfb-item-select vfb-right-half" id="item-vfb-44">
                          <label for="vfb-44" class="vfb-desc">Coins You want to submit: <span class="vfb-required-asterisk">*</span></label>
                          <select name="coins" id="vfb-44" class="vfb-select  vfb-medium " required="required">
                              <option value="" selected='selected'></option>
                              <option value="2000">2000</option>
                              <option value="4000">4000</option>
                              <option value="6000">6000</option>
                              <option value="8000">8000</option>
                              <option value="10000">10000</option>
                          </select>
                        </li>

                        <p>User details</p>
                        <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-22">
                          <label for="vfb-22" class="vfb-desc">User name:<span class="vfb-required-asterisk">*</span></label>
                          <input type="text" name="u_name" id="vfb-22" class="vfb-text  vfb-medium  required " value="<?php echo $_SESSION["log_user"]; ?>" readonly/>
                        </li>
                        <li class="vfb-item vfb-item-text  " id="item-vfb-24">
                          <label for="vfb-24" class="vfb-desc">User email:</label>
                          <input type="text" name="u_email" id="vfb-24" class="vfb-text  vfb-medium " value="<?php echo $_SESSION["log_user_email"]; ?>" readonly />
                        </li>
                        <li class="vfb-item vfb-item-select vfb-right-half" >
                          <label for="vfb-44" class="vfb-desc">User id: <span class="vfb-required-asterisk">*</span></label>
                          <input type="text" name="u_id" id="vfb-24" class="vfb-text  vfb-medium " value="<?php echo $_SESSION["log_user_unique_id"]; ?>" readonly/>
                        </li>

                        <p>Bank Details: </p>
                        <li class="vfb-item vfb-item-text  " >
                          <label for="vfb-24" class="vfb-desc" id="">Bank Name & Branch: </label>
                          <input type="text" name="bank_name_branch" id="vfb-24" value="" class="vfb-text  vfb-medium   " />
                        </li>
                        <li class="vfb-item vfb-item-text  " >
                          <label for="vfb-24" class="vfb-desc" id="">Account Holder name: </label>
                          <input type="text" name="account_h_name" id="vfb-24" value="" class="vfb-text  vfb-medium   " />
                        </li>
                        <li class="vfb-item vfb-item-text  " >
                          <label for="vfb-24" class="vfb-desc" id="">Account number: </label>
                          <input type="text" name="acc_num" id="vfb-24" value="" class="vfb-text  vfb-medium   " />
                        </li>
                        <li class="vfb-item vfb-item-text  " >
                          <label for="vfb-24" class="vfb-desc" id="">IFSC Code: </label>
                          <input type="text" name="ifsc_code" id="vfb-24" value="" class="vfb-text  vfb-medium   " />
                        </li>
                      </ul>
                    
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="upload_data" value="Send to Admin">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                  </div>
                  </form>
                </div>

              </div>
            </div>   
          </div>
        </div> <!-- end #content -->
      </div> <!-- end .container -->
      <?php include('../includes/footer.php'); ?>
      
  </body>


</html> 
