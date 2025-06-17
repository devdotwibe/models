<?php //session_start(); ?>
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
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='http://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
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
<style type="text/css">
  .allcreators{
    margin: 20px 0px 0px 40px;
    text-align: center;
  }
  .creator-list{
    /*width: 300px;
    height: 300px;*/
    border-radius: 10%;
    overflow: hidden;
    border: 2px solid #e45238;
    border-radius: 10%;
    
  }
  .col-md-3{
    text-align: center;
  }
  .creator-list video{
    width: 300px;
    height: 300px;
    /*border-radius: 10%;
    overflow: hidden;*/
  }
  .creator-list img{
    width: 300px;
    height: 300px;
    
  }
  
  span{
    color: white; 
  }
  .allcreators{
    display: unset;
  }
</style>
	</head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
  <?php include('includes/header.php'); ?>
  <div class="container">
    <div class="row">
      <h2 class="page_heading">My Purchase</h2>

      <h4>Images and Video's</h4>
      <?php
      $count = 1;
       $log_user_id = $_SESSION["log_user_unique_id"];
       $sqls = "SELECT * FROM user_purchased_image WHERE user_unique_id = '".$log_user_id."' ORDER BY id DESC";
        $resultd = mysqli_query($con, $sqls);
          if (mysqli_num_rows($resultd) > 0) {
            while($rowesdw = mysqli_fetch_assoc($resultd)) {
               $file_id = $rowesdw['file_unique_id'];
               $file_type = $rowesdw['file_type'];
               $model_unique_id = $rowesdw['model_unique_id'];


              $sql = "SELECT * FROM model_images WHERE id = '".$file_id."'";
              $result = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $url = $row['file'];
                  $image_text = $row['image_text'];
                }
              }

            $sql1 = "SELECT * FROM model_user WHERE unique_id = '".$model_unique_id."'";
              $result1 = mysqli_query($con, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
      ?>
      <div class="col-md-3">
        <?php if($file_type == 'Image'){ ?>
          <div class="creator-list" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
            <img class="bot_plus" src="../<?php echo $url; ?>" alt="photo" />
          </div>
        
          <span><?php echo $image_text; ?></span>
        <?php }else{ ?>
          <div class="creator-list" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
            <video class="paid-video" controls> <source src="../<?php echo $url; ?>" type="video/mp4"> </video>
          </div>
         
          <span><?php echo $image_text; ?></span>
        <?php } ?>
      </div>

      <div class="modal fade" id="myModal<?php echo $count; ?>" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  
                  <?php if($file_type == 'Image'){ ?>
                  <img class="full_img" src="../<?php echo $url; ?>" alt="photo">
                  <?php }else{ ?>
                    <video class="full_img" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
                      <source src="../<?php echo $url; ?>" type="video/mp4">
                    </video>
                  <?php } ?>
                </div>
                <div class="col-md-6">
                  <button type="button" class="close" data-dismiss="modal" style="padding-right: 15px;padding-top: 15px;">×</button>
                  <div class="usern model-prof">
                    <a title="" href="single-profile.php?model=<?php echo $row1['username']; ?>&m_id=<?php echo $row1['id']; ?>&m_unique_id=<?php echo $row1['unique_id'];?>" >
                      <figure class="user_profile">
                        <img alt="image" class="profil_img" src="<?php echo $row1['photo_2'] ?>">
                      </figure>
                      <span>
                        <p class="username"><?php echo $row1['username']; ?></p>
                      </span>
                    </a>      
                  </div>
                  <p><?php echo $image_text; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php  
      }    
        $count++;
        }
          } else {
            //echo "0 results";
          }
      ?>
      <!-- <h4>Subscription</h4>

      <h4>Video/Audio calls</h4> -->
    </div>
  </div>


    <?php
          $count = 1;
            $sqls = "SELECT * FROM casting WHERE status = 'Published' Order by id ASC LIMIT 6 ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw1 = mysqli_fetch_assoc($resultd)) {
                    
                    $sql1 = "SELECT * FROM model_images WHERE unique_model_id = '".$rowesdw1['unique_id']."' Order by id DESC LIMIT 1 ";
                    $result1 = mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                      $rowes1 = mysqli_fetch_assoc($result1);
          ?>
<div class="modal fade" id="myModal<?php echo $count; ?>" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            
            <?php if($rowes1['file_type'] == 'Image'){ ?>
            <img src="<?php echo $rowes1['file']; ?>" style="height: 500px;border-radius: 20px 0 0 20px;" alt="image">
            <?php }else{ ?>
              <video style="height: 500px;border-radius: 20px 0 0 20px;" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>"poster= "https://media.geeksforgeeks.org/wp-content/cdn-uploads/20190710102234/download3.png">
                <source src="<?php echo $rowes1['file']; ?>" type="video/mp4">
              </video>
            <?php } ?>
          </div>
          <div class="col-md-6">
            <button type="button" class="close" data-dismiss="modal" style="padding-right: 15px;padding-top: 15px;">×</button>
            <div class="usern model-prof">
              <a title="" href="single-profile.php?model=<?php echo $rowesdw1['username']; ?>&m_id=<?php echo $rowesdw1['id']; ?>&m_unique_id=<?php echo $rowesdw1['unique_id'];?>" >
                <figure class="user_profile">
                  <img alt="images"> src="<?php echo $rowesdw1['photo_2'] ?>">
                </figure>
                <span>
                  <a title="" href="#" style="background: unset;"><?php echo $rowesdw1['username']; ?></a>
                </span>
              </a>      
            </div>
            <p><?php echo $rowes1['image_text'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php
                    } 
    $count++;
    }
      } else {
        echo "Currently you bucket is empty.";
      }
  ?>
  <?php include('includes/footer.php'); ?>
</body>

</html> 
