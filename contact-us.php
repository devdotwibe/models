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
<title>Purchase </title>
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
.clearfix{
  text-align: center;
}
.contact-form{
  width: 50%;
  margin:auto;
  border: 1px solid #d3d3d3;
  padding: 35px 25px 55px;

}
.label_form{
  color: #ffffff;
  font-family: georgia, serif;
  margin: 0;
  padding: 10px 0px 10px 0px;
  font-weight: normal;
  font-size: 16px;
  float: left;
}
.star{
  color: red;
}
.text-design{
  background: #16161e;
  opacity: 1;
  padding: 20px 2px!important;
  clear: both;
  border: 1px solid #b9b5b5;
}
.main-contai{
  margin-bottom: 30px;
}
@media screen and (max-width: 767px) {
  .contact-form{
    width: 100%;
  }
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
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='http://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="assets/wp-json/index.html" />

  </head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
    <?php include('includes/header.php'); ?>

      <div class="container-fluid main-contai">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">
          
            <h3>Contact us  </h3>

            <div class="contact-form" >
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
                <div class="form-group">

                  <label class="label_form" for="Name">Name <span class=" star vfb-required-asterisk">*</span></label>
                  <input type="text" name="name" class="form-control text-design"  aria-describedby="emailHelp" required >

                  <label class="label_form" for="Email">Email <span class=" star vfb-required-asterisk">*</span></label>
                  <input type="email" name="email" class="form-control text-design"  aria-describedby="emailHelp" required >

                  <label class="label_form" for="Phone">Phone <span class=" star vfb-required-asterisk">*</span></label>
                  <input type="tel" name="phone" class="form-control text-design"  aria-describedby="emailHelp" required  >

                  <label class="label_form" for="Subject">Subject <span class=" star vfb-required-asterisk">*</span></label>
                  <input type="text" name="subject" class="form-control text-design"  aria-describedby="emailHelp" required >

                  <label class="label_form" for="Message">Message <span class=" star vfb-required-asterisk">*</span></label>
                  <textarea row="5" cols="50" name="message" class="form-control text-design"  aria-describedby="emailHelp" required ></textarea> 

                  
                  
                    
                  
                  <!-- <label class="label_form" for="exampleInputEmail1">Created <span class=" star vfb-required-asterisk">*</span></label>
                  <input type="text" name="created" class="form-control text-design"  aria-describedby="emailHelp" required > -->
                  
                </div>
                
                <!-- <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
 -->            <button   style="float: left; padding: 10px 20px; margin-left: 5px;" type="submit" 
               name="submit" class="btn btn-primary ">Submit</button>
              </form>
            </div>
                    
          </div> 

                  
        </div>
      </div> 

   <?php include('includes/footer.php'); ?>
  </body>
</html>

<?php
 
  if(isset($_POST['submit'])){
    $Created = $_POST['unique_id'];
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Subject = $_POST['subject'];
    $Message = $_POST['message'];
    $unique_id = '';
    if ($_SESSION['log_user']) {
      $unique_id = $_SESSION['log_user_unique_id'];
    }  


  $que = "INSERT INTO `contac_us`( `user_unique_id`,`name`, `email`, `phone`, `subject`, `message`) 
  VALUES ('".$unique_id."','".$Name."','".$Email."','".$Phone."','".$Subject."','".$Message."')";

   if(mysqli_query($con,$que))
    {
      echo '<script>alert("Thanks for contacting us. We have raise a ticket for you. Admin will contact you soon.")</script>';
      echo '<script>window.history.back();</script>';
       
    }
    else{
      echo '<script> alert(" Oops!! Found some error in ticket raising. Please try again later. ")</script>';
      echo '<script>window.history.back();</script>';
    }
  }   

?>
