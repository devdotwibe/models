<?php 
  session_start(); 
  include('includes/config.php');

    include("data.php");
?>

<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Services</title>
<meta name="description" content="Follow and interact with models from around the globe. Interact using social media platforms, private messaging and get to meet the model of your choice. Choose from a wide range of exclusive and premium features models. Start flirting now !!">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="assets/wp-content/themes/theagency3/library/images/win8-tile-icon.png">
<link rel="pingback" href="../xmlrpc.php">
<link rel='dns-prefetch' href='https://fonts.googleapis.com/' />
<link rel='dns-prefetch' href='https://s.w.org/' />
<link rel="alternate" type="application/rss+xml" title="Your Agency Name &raquo; Feed" href="../feed/index.html" />
<link rel="alternate" type="application/rss+xml" title="Your Agency Name &raquo; Comments Feed" href="../comments/feed/index.html" />
<link rel="alternate" type="application/rss+xml" title="Your Agency Name &raquo; Testimonials Feed" href="feed/index.html" />
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
.creator{
  width: 270px;
}
</style> -->
<style type="text/css">
       .login-signup {
  padding: 0 0 25px;
}

    .nav-tab-holder {
  padding: 0 0 0 30px;
  float: right;
}

.nav-tab-holder .nav-tabs {
  border: 0;
  float: none;
  display: table;
  table-layout: fixed;
  width: 70%;
    margin: auto;
}

.nav-tab-holder .nav-tabs > li {
  margin-bottom: -3px;
  text-align: center;
  padding: 0;
  display: table-cell;
  float: none;
  padding: 0;
}

.nav-tab-holder .nav-tabs > li > a {
  background: #d9d9d9;
  color: #6c6c6c;
  margin: 0;
  font-size: 18px;
  font-weight: 300;
}

.nav-tab-holder .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  color: #FFF;
  background-color: #c9381b;
  border: 0;
  border-radius: 0;
}

.mobile-pull {
  float: right;
}
@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
.nav-tab-holder .nav-tabs
{
  width: 100% !important;
}
.nav > li > a
{
  padding: 10px 0px !important;
}
}
</style>
  </head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
    <?php include('includes/header.php'); ?>

    <div class="container" stye="border:1px solid green;">
        <?php 
        
        if( $_GET["type"]=="livecam" ){ 
            //echo 'livecam'; 
            $qur=mysqli_query($con,"select * from model_extra_details where live_cam='Yes' ");
            $bod="Live Cams";
        }
        elseif( $_GET["type"]=="groupshow" ){ 
            //echo 'groupshow'; 
            $qur=mysqli_query($con,"select * from model_extra_details where group_show='Yes' ");
            $bod="Group Shows";
        }
        elseif( $_GET["type"]=="dating" ){ 
            //echo 'dateing'; 
            $qur=mysqli_query($con,"select * from model_extra_details where work_excort='Yes' ");
            $bod="Dating Assignments";
        }
        elseif( $_GET["type"]=="invite" ){ 
            //echo 'invite'; 
            $qur=mysqli_query($con,"select * from model_extra_details where international_tours='Yes' ");
            $bod="Accept Invitation Tours";
        }
        elseif( $_GET["type"]=="content" ){ 
            //echo 'content'; 
            $qur=mysqli_query($con,"select * from model_extra_details where video_pictures='Yes' ");
            $bod="With Pictures And Videos";
        }
        elseif( $_GET["type"]=="modeling" ){ 
            //echo 'modeling'; 
            $qur=mysqli_query($con,"select * from model_extra_details where modeling_porn_assignment='Yes' ");
            $bod="Modeling & Video Assignments";
        }
        elseif( $_GET["type"]=="30days" ){ 
            //echo '30days'; 
            $qur=mysqli_query($con,"select * from model_extra_details where all_30day_access='Yes' ");
            $bod="30 Days Account Acccess";
        }
        
        ?>
        
        <div class="row">
            <form action="" method="get">
            <div class="col-sm-8">
                <h2 class="page_heading" style="text-align:left;">All Models With <?php echo $bod; ?></h2>
            </div>
            <div class="col-sm-2">
                
                <input type="hidden" name="type" value="<?php echo $_GET["type"]; ?>" />
                <select name="country" class="vfb-text  vfb-medium" style="padding: 13px; width: 100%; margin-top:10px;" onchange="this.form.submit()">
                    <option value="all">All</option>
                    <?php 
                        foreach( $datacontry as $x ){ 
                            echo '<option '; 
                            
                            if( !empty( $_GET["country"] ) ){ if( $_GET["country"]==$x ){ echo ' selected '; } }
                            
                            echo ' value="' .$x .'">'; 
                            echo $x; 
                            echo '</option>'; 
                        } 
                    ?>        
                </select>
                
            </div>
            <div class="col-sm-2">
                <select name="gen" class="vfb-text  vfb-medium" style="padding: 13px; width: 100%; margin-top:10px;" onchange="this.form.submit()">
                <option value="all" <?php if( !empty( $_GET["gen"] ) ){ if( $_GET["gen"]=="all" ){ echo ' selected '; } } ?> >All</option>
                <option value="Female" <?php if( !empty( $_GET["gen"] ) ){ if( $_GET["gen"]=="Female" ){ echo ' selected '; } } ?> >Female</option>    
                <option value="Male" <?php if( !empty( $_GET["gen"] ) ){ if( $_GET["gen"]=="Male" ){ echo ' selected '; } } ?> >Male</option>    
                <option value="Couple" <?php if( !empty( $_GET["gen"] ) ){ if( $_GET["gen"]=="Couple" ){ echo ' selected '; } } ?> >Couple</option>    
                </select>
            </div>
            </form>
        </div>
        
        <div class="row" style="border:0px solid green;">
            
        <?php 
            while( $row=mysqli_fetch_array( $qur ) ){
                $umid=$row["unique_model_id"];
                
                if( strlen( $umid )>3 ){
                    
                    $run=$run="select * from model_user where unique_id='$umid' ";
                    
                    if( !empty( $_GET["country"] ) ){
                        if( $_GET["country"]!="all" ){
                            $contry=$_GET["country"];
                            $run.=" and country='$contry' ";
                        }
                    }
                    
                    if( !empty( $_GET["gen"] ) ){
                        if( $_GET["gen"]!="all" ){
                            $gen=$_GET["gen"];
                            $run.=" and gender='$gen' ";
                        }
                    }
                    
                    
                    
                    $run.=" order by id desc";
                    
                    $qurin=mysqli_query($con,$run);
                    
                    while( $rowin=mysqli_fetch_array( $qurin ) ){
                        
                        //echo $rowin["id"] .'<br/>';

                        $dp=$rowin["profile_pic"];
                        $username=$rowin["username"];

                        $qurim=mysqli_query($con,"select * from model_images where unique_model_id='$umid' and file_type='Image' ");
                        $imgcount=mysqli_num_rows( $qurim ); 

                        $qurvid=mysqli_query($con,"select * from model_images where unique_model_id='$umid' and file_type='Video' ");
                        $vidcount=mysqli_num_rows( $qurvid ); 

                        echo '
                        <div class="col-md-3" style="border:0px solid blue;">
                            <div id="creator-list">
                              <div class="creator">
                                    <a href="single-profile.php?m_unique_id=' .$umid .'">
                                        <figure><img src="' .$dp .'" alt="" /></figure>
                                        <h5 class="model_name">' .$username .'</h5>
                                        <div class="cr_posts">
                                            <span><i class="fa fa-picture-o" aria-hidden="true"></i><small>' .$imgcount .'</small>
                                            </span><span><i class="fa fa-video-camera" aria-hidden="true"></i><small>' .$vidcount .'</small></span>
                                        </div>
                                        <div class="cr_rating"></div>
                                    </a>
                                </div>
                                <span></span>
                            </div>
                        </div>
                        ';
                        
                    }
                    
                }
                
            }    
        ?>
            
        </div>    
        
        
        
</div>
        
        
        
        
        


<!--       <div class="container-fluid">

        <div id="content" class="clearfix row">
        
       <section>
    <div class="container">
        <div class="allcreators">
          <?php
          // $country = $_GET['country'];

          // $count = 1;
          //   $sqls = "SELECT * FROM casting WHERE status = 'Published' Order by id ";
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
                    <a href="single-model.php?model=<?php// echo $rowesdw['username']; ?>&m_id=<?php// echo $rowesdw['id']; ?>&m_unique_id=<?php// echo $rowesdw['unique_id'];?>">
                        <figure><img src="<?php// echo $rowesdw['photo_1']; ?>" alt="" /></figure>
                        <h5 class="model_name"><?php// echo $rowesdw['username']; ?></h5>
                        <div class="cr_posts">
                            <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                              <small><?php// if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                                <small><?php// if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
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
      </div> --> 

   <?php include('includes/footer.php'); ?>
  </body>


</html> 
