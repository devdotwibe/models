<?php 
session_start(); 
include('includes/config.php');
?>

<html>

<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Notification | The Live Model</title>
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
.notifikasion{
  padding: 15px;
  border-bottom: 1px solid #f1eeee;
}
.active{
  color: #6d6c6c;
  font-weight: 600;
}
.active{
  color: #6d6c6c;
  font-weight: 600;
}
.not-active{
  color: #d6d6d6;
  font-weight: 500;
}
.not-active a{
  color: #d6d6d6;
  font-weight: 500;
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
<!--[if lt IE 9]>
<link rel='stylesheet' id='bones-ie-only-css'  href='https://theagency.escortthemes.com/wp-content/themes/theagency3/library/css/ie.css' type='text/css' media='all' />
<![endif]-->
<script type='text/javascript' src='assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="assets/wp-json/index.html" /><link rel="alternate" type="application/json" href="assets/wp-json/wp/v2/pages/319.json" /><link rel='shortlink' href='../index63fb.html?p=319' />
<link rel="alternate" type="application/json+oembed" href="assets/wp-json/oembed/1.0/embedefe0.json?url=http%3A%2F%2Ftheagency.escortthemes.com%2Ffaq%2F" />
<link rel="alternate" type="text/xml+oembed" href="assets/wp-json/oembed/1.0/embede9d9?url=http%3A%2F%2Ftheagency.escortthemes.com%2Ffaq%2F&amp;format=xml" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	</head>

<body class="page-template-default page page-id-319 custom-background">
   <?php include('includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">
            <ul class="notify">
            <?php 
              // $sql = "CREATE TABLE tlm_private_live_chat_url (
              // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              // model_id VARCHAR(500) NOT NULL,
              // video_url VARCHAR(1000),
              // meta VARCHAR(10000),
              // r_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
              // )";
              // if ($con->query($sql) === TRUE) {
              //   echo "Table MyGuests created successfully";
              // } else {
              //   echo "Error creating table: " . $con->error;
              // }
              $sql = "SELECT * FROM `tlm_notification` WHERE `user_model_id`='".$_SESSION['log_user_id']."' ";
              $result = $con->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $data = unserialize($row['meta']);
                  echo '<li class="notifikasion van" style="">' .$data['msg'].' date : '.$row['r_date'].'</li>';
                }
              }
            ?>
            <?php
              $log_user_id = $_SESSION["log_user_unique_id"];

              $sql1 = "SELECT * FROM model_user WHERE unique_id = '".$log_user_id."'";
              $result1 = mysqli_query($con,$sql1);
                
                $srno=1;
                
              if (mysqli_num_rows($result1) > 0) {

                echo '<li class="notifikasion van" style="">Welcome <?php echo $_SESSION["log_user"]; ?>You can now become a model and start earning. Create a fanbase and interact with audiences around the world. 
                 <a href="https://thelivemodels.com/new-broadcaster.php"><b>CLICK HERE.</b></a></li>';  
                  
                  $srno++;
              }


              $sql2 = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$log_user_id."' AND status = 'Pending'";
              $result2 = mysqli_query($con,$sql2);
              if (mysqli_num_rows($result2) > 0) {
                echo '<script>$( ".van" ).addClass( "not-active" );</script>';
                echo '<li class="notifikasion too" style="" >Your request has been successfully sent for approval. It will take us 2-5 days to review. Thanks for your patience.</li>';
              }

              $sql3 = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$log_user_id."' AND status = 'Published'";
              $result3 = mysqli_query($con,$sql3);
              if (mysqli_num_rows($result3) > 0) {
              echo '<script>$( ".van" ).addClass( "not-active" );</script>';
              // echo '<script>$( ".too" ).addClass( "not-active" );</script>';
                echo '<li class="notifikasion thrii" style="">Your request has been successfully sent for approval. It will take us 2-5 days to review. Thanks for your patience.</li>';
                  
                  echo '
                <li class="notifikasion too not-active" style="">Congratulations!!
                  Your request had been approved. You are now a live model. Start building your fanbase to earn more.  <a href="https://thelivemodels.com/single-profile.php?m_unique_id='.$_SESSION["log_user_unique_id"].'">Upload your Video/ images now.</a></li>';
                
                
              }

              $sql4 = "SELECT * FROM insta_snap_call WHERE unique_model_id = '".$log_user_id."' ";
              $result4 = mysqli_query($con,$sql4);
              
              if (mysqli_num_rows($result4) > 0) {
                $row_fwa = mysqli_fetch_assoc($result4);
                echo '<script>$( ".van" ).addClass( "not-active" );</script>';
                echo '<script>$( ".too" ).addClass( "not-active" );</script>';
                echo '<script>$( ".thrii" ).addClass( "not-active" );</script>';

                echo '<li class="notifikasion thrii not-active" style="" >Congratulations!!
                  Your request had been approved. You are now a live model. Start building your fanbase to earn more.  <a href="https://thelivemodels.com/single-profile.php?m_unique_id='.$_SESSION["log_user_unique_id"].'">Upload your Video/ images now.</a></li>';

                echo '<li class="notifikasion too ">Someone has book a call on "'.$row_fwa['call_on'].'" with you. want to know <a href="accept-call.php">Click here</a></li>';
              }

              $sql4 = "SELECT * FROM insta_snap_call WHERE unique_user_id = '".$log_user_id."' AND status = 'Approved'";
              $result4 = mysqli_query($con,$sql4);
              
              if (mysqli_num_rows($result4) > 0) {
                $row_fwa = mysqli_fetch_assoc($result4);

                echo '<script>$( ".van" ).addClass( "not-active" );</script>';
                echo '<script>$( ".too" ).addClass( "not-active" );</script>';
                echo '<script>$( ".thrii" ).addClass( "not-active" );</script>';

                echo '<li class="notifikasion ">Your "'.$row_fwa['call_on'].'" Call request has been successfully Accepted by the model. She will call you on "'.$row_fwa['call_on'].'". Be ready for fun.</li>';
              }

            ?>
            

            
            <?php
                $sql5 = "SELECT * FROM notification WHERE reciver_user = '".$log_user_id."' order by notification_id DESC";
                $result5 = mysqli_query($con,$sql5);
              
              if (mysqli_num_rows($result5) > 0) {
                $row_fw5 = mysqli_fetch_assoc($result5);

                echo '<li class="notifikasion ">'.$row_fw5['notification_text'].'</li>';
              }

            ?>
            </ul>
    
          </div>
      
        </div>

      </div> 

 <?php include('includes/footer.php'); ?>
  </body>


</html> 
