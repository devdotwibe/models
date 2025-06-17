<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
  
  // die();
  if( isset($_GET['pra']) && $_GET['user'] == 'viewer' && $_POST['user'] != 'user_true' )  {
    header('Location: '.SITEURL);
  }
  if( isset($_GET['user']) && $_GET['user'] == 'streamer' ) {
    if( isset($_SESSION['log_user_unique_id']) && isset($_GET['unique_model_id']) && $_SESSION['log_user_unique_id'] == $_GET['unique_model_id'] ) {
      $sql = "SELECT * FROM tlm_private_live_chat_url WHERE model_id='".$_GET['unique_model_id']."'";
      // $sql = "UPDATE tlm_private_live_chat_url SET video_url='https://thelivemodels.com/live-chat/index.php?user=streamer&unique_model_id=model-10651&pvt=private' WHERE model_id=''";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $true = '';
              if( isset($_GET['pra']) && !empty($_GET['pra']) ) {
                $true = 'true';
              }
              $sql = "UPDATE tlm_private_live_chat_url SET video_url='".$true."' WHERE id=".$row['id'];
              if ($con->query($sql) === TRUE) {
                // echo "Record updated successfully1111";
              } else {
                // echo "Error updating record: " . $con->error;
              }
          }
      }else{
        $sql = "INSERT INTO tlm_private_live_chat_url (model_id, video_url, meta)VALUES ('".$_GET['unique_model_id']."', '', '')";
        if ($con->query($sql) === TRUE) {
          // echo "New record created successfully";
        } else {
          // echo "Error: " . $sql . "<br>" . $con->error;
        }
      }
      // var_dump($con->query($sql));
      // if ($con->query($sql) === TRUE) {
      //   echo "Record updated successfully";
      // } else {
      //   // if ($con->query($sql) === TRUE) {
      //     // echo "New record created successfully1";
      //   // } else {
      //     // echo "Error: " . $sql . "<br>" . $con->error;
      //   // }
      //   // echo "Error updating record: " . $con->error;
      // }
      $sql = "SELECT * FROM `tlm_live_model_notifications` WHERE `user_model_id`='".$_GET['unique_model_id']."'";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $datas = unserialize($row['meta']);
          foreach( $datas as $data ) {
            if( $data['status'] == 'pending' ) {
              $meta = array(
                'msg' => 'Now Model ('.$_SESSION["log_user"].') is Online Click on this link For view the live model video <a href="https://thelivemodels.com/single-profile.php?m_unique_id='.$_GET['unique_model_id'].'" >Live Video</a>',
              );
              $sql = "INSERT INTO tlm_notification (user_model_id, userid, meta) VALUES ('".$data['user_id']."', ' ', '".serialize($meta)."')";
              if ($con->query($sql) === TRUE) {
                $sql = "UPDATE tlm_live_model_notifications SET meta='".serialize(array())."' WHERE id=".$row['id'];
                if ($con->query($sql) === TRUE) {
                  // echo "Record updated successfully";
                } else {
                  // echo "Error updating record: " . $con->error;
                }
                // echo "Success";
              } else {
                  // echo "false";
              }
            }
          }
        }
      }
    }else{
      header('Location: https://thelivemodels.com/');
    }
  }
  if( !isset($_SESSION['log_user_id']) || empty($_SESSION['log_user_id']) ) {
    header('Location: https://thelivemodels.com/');
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Stacia | Your Agency Name</title>
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- <link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png"> -->
    <!-- <link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2"> -->
    <link href='<?='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script'?>' rel='stylesheet' type='text/css'>
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
<link rel='stylesheet' id='model-details-custom_profile-styles-css'  href='<?='../assets/wp-content/themes/theagency3/framework/assets/css/styles-custom_profile.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='model-Error creating table: " . $con->errordetails-pricing-styles-css'  href='<?='../assets/wp-content/themes/theagency3/framework/assets/css/styles-pricing.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wp-block-library-css'  href='<?='../assets/wp-includes/css/dist/block-library/style.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='<?='../assets/wp-content/plugins/spiffy-calendar/styles/default.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='<?='../assets/wp-includes/css/dashicons.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/css/style.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  
href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css' 
href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='<?='https://fonts.googleapis.com/css?family=Rokkitt'?>' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='<?='../assets/wp-content/plugins/rich-reviews/css/rich-reviews.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='<?='../assets/wp-content/themes/theagency3/library/css/style.css'?>' type='text/css' media='all' />
<!-- <script type='text/javascript' src='<?='../assets/wp-content/plugins/rich-reviews/js/rich-reviews.js'?>' id='rich-reviews-js'></script> -->
<script type='text/javascript' src='<?='../assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js'?>' id='bones-modernizr-js'></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'?>"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
<link rel="stylesheet" href="<?='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'?>">
<script>

</script>
<style type="text/css">
    .tlm_msg_date_time {
        font-size: 13px !important;
        margin-left: 15px !important;
        width: 100%;
        text-align: right;
        color: #ffffff;
        opacity: 0.8;
    }
	.navbar>.container, .navbar>.container-fluid{
		display: inline-block !important;
	}
      .main_img_div{
      height: 350px;
      border-radius: 30px;
      overflow: hidden;
      text-align: right;
      position: relative;
      }
      .img-scd{
      /*height: 350px;*/
      transition: 1s ease;
      }
      .img-scd:hover{
      transform: scale(1.7);
      /*height: 350px;*/
      overflow: hidden;
      }
      .banner_img{
      width: 100%;
      background-repeat: no-repeat;
      height: 450px;
      /*margin-left: 10%;*/
      /*margin-right: 10%;*/
      border-radius: 0px 0px 20px 20px;
      }
      .banner_img_dynmic{
      width: 100%;
      background-repeat: no-repeat;
      height: 450px;
      border-radius: 0px 0px 20px 20px;
      }
      .cir_img{
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border:2px solid red;
      overflow: hidden;
      }
      .cir_img img{
      width: 120px;
      height: 120px;
      /*border-radius: 50%;
      border:2px solid red;
      overflow: hidden;*/
      }
      .mol_name{
      font-size: 22px;
      font-weight: bold;
      text-transform: capitalize;
      vertical-align: middle;
      padding-top: 20px;
      /*color: #4c4b4b;*/
      color: #ffffff;
      margin: unset;
      }
      .main_idv{
      height: 350px;
      border-radius: 30px;
      overflow: hidden;
      }
      .post_img:hover{
      transform: scale(1.2);
      }
      .my_dvf{
      padding-top: 20px;
      padding-bottom: 20px;
      float: left;
      }
      .menuyg{
      padding-top: 15px;
      padding-bottom: 15px;
      }
      .profil_img{
      /*width: 40px;
      height: 40px;*/
      }
    </style>
    <style>    
      .gallery img { 
      width: 100%; 
      height: 100%; 
      transition: 1s ease; 
      vertical-align: top;
      border: 2px solid #968e75;
      } 
      .mn-dv-img{
      width: 100%; 
      height: 100%; 
      position: relative;
      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      vertical-align: top;
      }
      .main-uper-div-img{
      position: absolute;
      top: 0px;
      left: 0px;
      /*background: #6d5a139e;*/
      width: 100%; 
      height: 100%;
      border-radius: 30px;
      border: 1px solid #ff2424;
      }
      .mn-dv-vdo{
      width: 100%; 
      height: 100%; 
      position: relative;
      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      vertical-align: top;
      }
      .main-uper-div-vdo{
      position: absolute;
      top: 0px;
      left: 0px;
      background: #968e75;
      width: 100%; 
      height: 100%;
      border-radius: 30px;
      border: 1px solid #ff2424;
      }
      .gallery .free-video { 
      width: 100%; 
      height: 100%; 
      transition: 1s ease; 
      /*margin-left: 10px;
      margin-right: 10px;*/
      margin-top: 10px;
      margin-bottom: 20px;
      border: 2px solid #968e75;
      }
      .gallery .paid-video { 
      /*width: 200px; */
      /*height: 300px; */
      transition: 1s ease; 
      /*margin-left: 10px;
      margin-right: 10px;*/
      /*margin-top: 10px;*/
      margin-bottom: 20px;
      border: 2px solid #968e75;
      }
      .gallery img:hover { 
      filter: drop-shadow(4px 4px 6px gray); 
      transform: scale(1.0); 
      } 
      .free-image{
      margin-top: 10px;
      margin-bottom: 20px;
      }
      @media only screen and (max-width: 600px) {
      h4 {
      font-size: 14px !important;
      }
       .fancy_button{
        padding: 6px 8px !important;
      }
      .book
      {
        width: 120px !important;
      }
      .btn-chng_pp
      {
            right: 88px !important;
      }
      .btn-chng_dp
      {
        top: 338px !important;
      }
      .gallery {
      text-align: center !important;
      }
      .banner_img{
      width: 100%;
      background-repeat: no-repeat;
      height: auto;
      margin-left: 0%;
      margin-right: 0%;
      }
      .main_img_wdth{
      width: 100% !important;
      }
      }
      .icn-vdo{
      font-size:26px;
      color: #ff2424;
      margin-left: 15px;
      margin-top: 15px;
      }
      .icn-img{
      font-size:26px;
      color: #ff2424;
      margin-left: 15px;
      margin-top: 15px;
      }
      .mybtn{
      border: 1px solid white;
      border-radius: 10%;
      font-size: 15px;
      color: white;
      background: transparent;
      transition: 1s ease;
      margin-left: 30%;
      margin-right: 30%;
      margin-top: 100px;
      margin-bottom: 100px;
      padding: 5px 20px;
      }
      .mybtn:hover{
      border: 1px solid #e2e2e2;
      border-radius: 10%;
      font-size: 15px;
      color: white;
      background: red;
      }
      .coin_icon{
      font-size: 18px;
      color: #ff2424;
      display: inline;
      }
      .full_img{
      }
      .main_img_wdth{
      width: 80%;
      margin: auto;
      background: #e54720;
      border-radius: 0px 0px 20px 20px;
      }
      .myleft_dv{
      text-align: center;
      padding: 8px;
      }
      .past_heade{
      font-weight: bold;
      /*color: #4c4b4b;*/
       color: #ffffff;
      }
      .angle_dwn{
      font-weight: normal;  
      }
      #mol-des{
      margin: 10px 0px;
      }
      .table{
      width: 100%;
      margin: auto;
      }
      .tab_head{
      padding:20px;
      /*margin-top: unset;*/
      /*margin-bottom: unset;*/
      }
      .view_div{
      cursor: pointer;
      color: red;
      text-align: right;  
      font-size: 14px;
      }
    </style>
    <style type="text/css">
      .i_main {
      cursor:pointer;
      color:#e54720;
      transition:1s;
      }
      .i_main:hover {
      color:#666;
      }
      .i_main:before {
      font-family:fontawesome;
      content:'\f08a';
      font-style:normal;
      font-size: 16px;
      }
      .i_inverse {
      cursor:pointer;
      color:#aaa;
      transition:1s;
      }
      .i_inverse:hover {
      color:#666;
      }
      .i_inverse:before {
      font-family:fontawesome;
      content:'\f004';
      font-style:normal;
      color: #e54720;
      font-size: 35px;
      }
      #unflow, #flow{
      color: #e54720;
      }
      .new_p_head{
        font-size: 18px;
        font-weight: bold;
        float:left;
      }
      .post_btn{
        float: right;
        border: none;
        padding: 5px 20px;
        border-radius: 30px;
        background-color: red;
        color: white;
        font-weight: bold;
        font-family: system-ui;
        margin-top: 6px;
        margin-right: 20px;
      }

      .inp_post{
        border: none;
        box-shadow: none;
        width: 100%;
        padding: 20px;
      }
      .file-upload{
        /*height:100px;
        width:100px;
        margin:40px auto;*/
        /*border:1px solid #f0c0d0;*/
        border-radius:100px;
        overflow:hidden;
        position:relative;
            text-align: center;
      }
      .file-upload input{
        position:absolute;
        height:400px;
        /*width:400px;
        left:-200px;*/
        top:-200px;
        background:transparent;
        opacity:0;
        -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: alpha(opacity=0);  
      }
      .file-upload img{
        height:170px;
        width:170px;
        margin:15px;
      }
      .bor_div{
        border-bottom: 1px solid #efefef;
      }
      .coin_fle{
        border: none;
        padding: 10px;
        border-bottom: 1px solid #efefef;
        width: 100%;
      }
      .post_radio{
        margin-left: 15px !important;
        margin-right: 15px !important;
      }
      .share
      {
        color: #ffffff;
      }
      .fil_radio{
        margin-left: 15px !important;
        margin-right: 15px !important;
      }
      .post_t_div{
        padding: 10px;
        margin-left: 10px;
      }
      .file_t_div{
        padding: 10px;
        margin-left: 10px;
      }
      .file-upload{
        display: none;
      }
      .file_t_div{
        display: none;
      }
      .post_t_div{
        display: none;
      }
      .fancy_button{
        transition: 1s ease;
        padding: 6px 15px;
      }
      .fancy_button:hover{
        color: #f5b8b8;
      }
    </style>
    <style type="text/css">

.bot_plus{
  transition: 0.3s !important;
}
.bot_plus:hover{
  transform: scale(1.1);
}
.navbar{
  padding-top: 20px;
  padding-bottom: 20px;
}
nav{
  border-bottom: 2px solid #d83b1b;
}
.loader {
  border: 4px solid #f3f3f3;
  border-radius: 50%;
  border-top: 4px solid #3498db;
  width: 15px;
  height: 15px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media screen and (max-width: 600px) {
  .navbar-collapse .navbar-responsive-collapse .collapse .in{
    width: 100% !important;
  }
  .side-menu
  {
    display: none !important;
  }
  
}
@media screen and (min-width: 600px) {
  .navbar-collapse .navbar-responsive-collapse .collapse .in{
    width: 100% !important;
  }
  
  body{
    overflow-x: hidden !important;
  }
}
</style>
 
  <!-- </head> -->
<!-- <head> -->
	<link rel="stylesheet" href="<?='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'?>" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?='assest/style.css'?>">
  <?php include('../includes/header.php'); ?>
</head>
<body>
  
	<?php 
		$sqls = "SELECT * FROM model_user WHERE unique_id = '".$_GET['unique_model_id']."'";
		$resultd = mysqli_query($con, $sqls);
		  if (mysqli_num_rows($resultd) > 0) {
			$rowesdw = mysqli_fetch_assoc($resultd);
			if( isset($rowesdw) && !empty($rowesdw) ) {
        ?>
          <input type="hidden" name="login_user_name" value="<?php echo isset($_SESSION['log_user'])?$_SESSION['log_user']:''; ?>">
          <input type="hidden" value="<?php echo isset($_GET['pra'])?'true':''; ?>" id="tlm_limit_user">
          <input type="hidden" name="tlm_user" id="tlm_usere" value="<?php echo $_GET['user'] ?>" id="">
          <input type="hidden" name="tlm_camera_id" id="tlm_camera_id" value="<?php echo isset($_POST['tlm_camera_id'])?$_POST['tlm_camera_id']:''; ?>" />
          <?PHP 
            if( isset( $_GET['unique_model_id'] ) ) {
              if( isset($_GET['pra']) ) {
                $room_id = 'prov'.$_GET['unique_model_id'];
              }else{
                $room_id = $_GET['unique_model_id'];
              }
            }
          ?>
          <input type="text" style="display:none" id="room-id" value="<?php echo !empty($room_id)?$room_id:'' ?>" autocorrect=off autocapitalize=off size=20>
          <button id="open-room" style="display:none"></button>
          <button id="join-room" value="<?php echo isset($_SESSION['log_user_id'])?$_SESSION['log_user_id']:''; ?>" style="display:none"></button>
					<section class="chat_wrap">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-6 col-md-12 p-0 thelive_padd">
									<div class="str_live_video_wrap" style="border:2px solid blue;">
										<div class="str_live_video_wrapper">
											<div class="live_video">
                        <div id="videos-container" style="margin: 20px 0;">
                        <img src="https://thelivemodels.com/uploads/live-model-logo.png" class="tlm_img_chat" alt="">
                          <div class="tlm_video_not_started text-center"> 
                            Model Currently offline 
                            <p>
                                Click here to know when the <b><?php echo isset($rowesdw['name'])?$rowesdw['name']:''; ?></b> comes online..<br>
                                <button class="btn btn-primary" id="tlm_status_notify">Notify me</button>
                            </p> 
                          </div>
                          <div class="wth_live_btn_wrap" style="">
                            <button class="wth_live_btn" id="tlm_start_private" style="display:none !important;">
                                <!-- <span class="wth_circle"></span> -->
                                <!-- LIVE -->
                                Start Private
                                <!-- <img src="play-button-arrowhead.png" alt="" class="img-fuild"> -->
                            </button>
                            <button class="wth_live_btn" id="tlm_send_tip" style="display:none !important;">
                                <!-- <span class="wth_circle"></span> -->
                                <!-- LIVE -->
                                Send Tip
                                <!-- <img src="play-button-arrowhead.png" alt="" class="img-fuild"> -->
                            </button>
                          </div>
                        </div>
												<!-- <iframe width="700" height="360" id="local_vid" autoplay></iframe> -->
                      </div>
                      <div class="str_bottom_btn">
                        <div class="str_video_like">
                          <p><i class="fa fa-heart-o" aria-hidden="true"></i><span class="like_count">5K</span></p>           
                        </div>
                        <div class="str_right_btn">
                          <!-- <span class="str_btn">
                            <select name="tlm_aspect_ratio" id="tlm_aspect_ratio" >
                              <option value=""></option>
                            </select>
                          </span> -->
                          <?php 
                            if( !isset($_GET['pra']) || empty($_GET['pra']) ) {
                              ?>
                                <span class="str_btn">
                                  <button class="btn" data-toggle="modal" data-target="#tlm_start_private_popup" id="tlm_start_private_video">Start Private</button>
                                </span>
                              <?php   
                            }
                          ?>
                          <?php 
            if( isset($_GET['user']) && $_GET['user'] == 'streamer' && !isset($_GET['pra']) ) {
              ?>
                <!-- <button id="tlm_start_live_private" data-toggle="modal" data-target="#tlm_start_private_popup11"></button> -->
                <div class="modal fade tlm_send_tip_popup" id="tlm_start_private_popup11" tabindex="-1" role="dialog" aria-labelledby="tlm_start_private_popup11Title" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Send Tip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                            <h3> Go To Private Live Video Chat </h3>
                      </div>
                      <div class="modal-footer">
                        <a href="https://thelivemodels.com/live-chat/index.php?user=streamer&unique_model_id=<?php echo $_GET["unique_model_id"] ?>&pra=private"><button type="button" class="btn btn-secondary" id="tlm_close_tip_box" data-dismiss="modal">GO</button></a>
                        <!-- <button type="button" id="tlm_send_tip_main_btn" class="btn btn-primary">Send Tip</button> -->
                      </div>
                    </div>
                  </div>
                </div>
              <?php
            }
          ?>
                          <!-- Modal -->
                          <div class="modal fade tlm_send_tip_popup" id="tlm_start_private_popup" tabindex="-1" role="dialog" aria-labelledby="tlm_start_private_popupTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Send Tip</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                
                                <div class="modal-body">
                                  <?php 
                                    $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
                                    $result = mysqli_query($con,$sql);
                                    if (mysqli_num_rows($result) > 0) {
                                      $row1 = mysqli_fetch_assoc($result);
                                      $wallet_coins = $row1['wallet_coins'];
                                      ?>
                                        <div>
                                          Your Coin :- <span class="tlm_show_coins_private_chat"><?php echo $wallet_coins ?></span>
                                        </div>
                                      <?php
                                    }else{
                                      ?>
                                        <div>
                                          Your Coin :- <?php echo 0 ?>
                                        </div>
                                      <?php
                                    }
                            
                                  ?>
                                  <div id="tlm_wait_for_connection">
                                    <div class="title">
                                      <span class="">Pay tokens for start private chat</span>
                                    </div>
                                    <div class="send-tip-form">
                                      <div class="choices">
                                          <div class="radio-wrapper">
                                            <div class="radio radio-container">
                                              <input class="inline-block radio radio-input radio-medium theme-default" type="radio" checked="" name="tlm_private_chat_tip" id="radio-sendTip-1" value="100">
                                              <label class="radio-label" for="radio-sendTip-1"><strong>100</strong> Tokens</label>
                                            </div>
                                            <div class="description media-up-to-s-hidden">
                                              <div class="description-inner"><span class="">Tip the model <strong>100</strong> Tokens</span></div>
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" id="tlm_close_private_chat_box" data-dismiss="modal">Close</button>
                                  <div class="loader" id="tlm_loader" style="display:none"></div>
                                  <button type="button" id="tlm_private_chat_main_btn" class="btn btn-primary">Send</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <span class="str_btn">
                            <button class="btn btn_send_tip" data-toggle="modal" data-target="#tlm_send_tip_popup">Send Tip</button>
                          </span>
                          <!-- Modal -->
                          <div class="modal fade tlm_send_tip_popup" id="tlm_send_tip_popup" tabindex="-1" role="dialog" aria-labelledby="tlm_send_tip_popupTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                <?php 
                                    $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
                                    $result = mysqli_query($con,$sql);
                                    if (mysqli_num_rows($result) > 0) {
                                      $row1 = mysqli_fetch_assoc($result);
                                      $wallet_coins = $row1['wallet_coins'];
                                      ?>
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                          Your Coin :- <span class="tlm_show_coins"><?php echo $wallet_coins ?></span>
                                        </h5>
                                      <?php
                                    }else{
                                      ?>
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                          Your Coin :- <?php echo 0 ?>
                                        </h5>
                                      <?php
                                    }
                                  ?>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="title">
                                    <span class="">How many tokens would you like to tip?</span>
                                  </div>
                                  <div class="send-tip-form">
                                    <div class="choices">
                                      <?php 
                                        for( $i=1;$i<5;$i++ ) {
                                          ?>
                                            <div class="radio-wrapper">
                                              <div class="radio radio-container">
                                                <input class="inline-block radio radio-input radio-medium theme-default" <?php if($i == 1){ echo 'checked=""'; } ?> type="radio" name="tlm_sendTip" id="radio-sendTip-<?php echo $i*10 ?>" value="<?php echo $i*10 ?>">
                                                <label class="radio-label" for="radio-sendTip-<?php echo $i*10 ?>"><strong><?php echo $i*10 ?></strong> Tokens</label>
                                              </div>
                                              <div class="description media-up-to-s-hidden">
                                                <div class="description-inner"><span class="">Tip the model <strong><?php echo $i*10 ?></strong> Tokens</span></div>
                                              </div>
                                            </div>
                                          <?php
                                        }
                                      ?>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer" style="align-items:baseline !important;">
                                  <button type="button" class="btn btn-secondary" id="tlm_close_tip_box" data-dismiss="modal">Close</button>
                                  <button type="button" id="tlm_send_tip_main_btn" class="btn btn-primary">Send Tip</button>
                                  <div class="loader" id="tlm_loader" style="display:none"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
										</div>
									</div>
								</div>
				<div class="col-lg-6 col-md-12 p-0 thelive_padd" style="border:2px solid red;">
									<div class="chat_coment_wrap">
										<div class="str_chat_container">
											<div class="str_main_panel">
                      <img src="https://thelivemodels.com/uploads/live-model-logo.png" class="tlm_img_chat1" alt="">
                        <div class="str_chat_header" style="border:1px solid blue;">
													<!-- <div class="str_chat_avtar" style="width: 40px;height: 40px;    flex-basis: 40px;line-height: 40px;font-size: 20px;">
														<img src="<?php //echo isset($rowesdw['profile_pic'])?'../'.$rowesdw['profile_pic']:''; ?>" class="img-fluid" style="width: 40px; height: 40px; flex-basis: 40px;object-fit: cover;">
													</div> -->
													<!-- <div class="str_heder_left">
														<p class="str_title"><?php //echo isset($rowesdw['name'])?$rowesdw['name']:''; ?></p>
														<p class="str_member"></p>
                          </div> -->
                          
                          <div class="str_pub_wrap tlm_chat_top_tab active" data-chat="tlm_public_chat">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <span class="str_label">Public</span>
                          </div>
                          <div class="str_pub_wrap tlm_chat_top_tab" data-chat="tlm_private_chat">
                          <i class="fa fa-commenting" aria-hidden="true"></i>
                            <span class="str_label">Private</span>
                          </div>
                          <div class="str_pub_wrap tlm_chat_top_tab" data-chat="tlm_total_user">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="str_label" id="tlm_user">408</span>
                          </div>
                        </div>
				        <div class="str_chat_list tlm_display_chat tlm_public_chat" id="tlm_public_chat" style="border:1px solid yellow;">
													<div class="str_chat_scroll">
														<ul class="str-chat_ul" id="tlm_all_msg">
															<!-- <li>
																<div class="d-flex align-items-center m-4">
																	<hr class="str_chat_sep_line">
																	<div class="str_chat_date">22/01/2021</div>
																</div>
															</li> -->
														</ul>
													</div>
                        </div>
                        <div class="str_chat_list tlm_display_chat tlm_private_chat" id="tlm_private_chat">
													<div class="str_chat_scroll">
                            <?php 
                              // print_r($_SESSION);
                            ?>
														<ul class="str-chat_ul" id="tlm_all_privatemsg">
															<!-- <li>
																<div class="d-flex align-items-center m-4">
																	<hr class="str_chat_sep_line">
																	<div class="str_chat_date">22/01/2021</div>
																</div>
															</li> -->
														</ul>
													</div>
                        </div>
                        <div class="str_chat_list tlm_display_chat tlm_total_user" id="tlm_total_user">
													<div class="str_chat_scroll">
														<ul class="str-chat_ul" id="tlm_total_user_display">
															<!-- <li>
																<div class="d-flex align-items-center m-4">
																	<hr class="str_chat_sep_line">
																	<div class="str_chat_date">22/01/2021</div>
																</div>
															</li> -->
														</ul>
													</div>
                        </div>

												<div class="str_chat_input tlm_display_chat tlm_public_chat" style="display:block !important;">
													<div class="str_chat_input_wrap">
														<div class="str_chat_input_wrapper">
                              <div class="str_chat_textarea" <?php echo isset($_SESSION['log_user_id'])&& !empty($_SESSION['log_user_id'])?'':'data-toggle="tooltip" data-placement="top" title="SIGN UP FOR CHAT"' ?>>
                                <span class="chat_bottom_img">
                                  <img src="../uploads/profile_pic/live-chat-icon.png" class="img-fluid">
                                </span>
																<input style="height: 45px;" <?php echo isset($_SESSION['log_user_id'])&& !empty($_SESSION['log_user_id'])?'':'disabled'; ?> id="tlm_send_msg" class="str_textarea" placeholder="Type your message">
															</div>
															<button data-model_id="<?php echo $_GET['unique_model_id'] ?>" class="str_chat_send_btn tlm_send_btn_css">
																<span>Send</span>
															</button>
														</div>
													</div>
												</div>
                        <div class="str_chat_input tlm_display_chat tlm_private_chat" style="display:none !important;">
													<div class="str_chat_input_wrap">
														<div class="str_chat_input_wrapper">
															<div class="str_chat_textarea" <?php echo isset($_SESSION['log_user_id'])&& !empty($_SESSION['log_user_id'])?'':'data-toggle="tooltip" data-placement="top" title="SIGN UP FOR CHAT"' ?>>
																<input <?php echo isset($_GET['pra'])?'':'disabled=""'; ?> style="height: 45px;"  <?php echo isset($_SESSION['log_user_id'])&& !empty($_SESSION['log_user_id'])?'':'disabled'; ?> id="tlm_send_privatemsg" class="str_textarea" placeholder="Type your message">
															</div>
															<button <?php echo isset($_GET['pra'])?'':'disabled=""'; ?> data-model_id="<?php echo $_GET['unique_model_id'] ?>" data-userid="<?php echo isset($_SESSION['log_user_id']) && !empty($_SESSION['log_user_id'])?$_SESSION['log_user_id']:''; ?>" class="str_privatechat_send_btn2 tlm_send_btn_css">
																<span>Send</span>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
            <div>
               <form style="display:none;" action="https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id=<?php echo $_GET["unique_model_id"] ?>&pra=private" method="post">
                  <input type="hidden" value="user_true" name="user">
                  <input type="submit" value="submit" id="tlm_user_private_vidchat">
               </form>
            </div>
          </section>
          <form action="" style="display:none">
            <script
              src="<?='https://checkout.razorpay.com/v1/checkout.js'?>"
              data-key="rzp_test_4M7P3ViBucYNrF"
              data-amount="5000"
              data-buttontext="Pay with Razorpay"
              data-name="The Live Model"
              data-description="Test Txn with RazorPay"
              data-image="https://thelivemodels.com/uploads/live-model-logo.png"
              data-prefill.name="<?php echo $_SESSION["log_user"]; ?>"
              data-prefill.email="<?php echo $_SESSION["log_user_email"]; ?>"
              data-theme.color="#F37254">
            </script>
          </form>
				<?php
			}
		}
  ?>
<?php /*?><script src="<?='https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js'?>"></script>
<script src="<?='https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js'?>"></script>
<?php */?>

<?php /*?><script src="<?='https://cdn.jsdelivr.net/npm/rtcmulticonnection@3.7.1/dist/RTCMultiConnection.min.js'?>"></script>
<script src="<?='https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.0/socket.io.js'?>"></script><?php */?>
<script src="<?='https://muazkhan.com:9001/dist/RTCMultiConnection.min.js'?>"></script>
<script src="<?='https://muazkhan.com:9001/socket.io/socket.io.js'?>"></script>

  <script>
      <?php 
        if( isset($_GET['user']) && $_GET['user'] == 'streamer' ) {
          if( isset($_GET['unique_model_id']) ) {
            unlink($_GET['unique_model_id'].".txt");
            unlink('total_user'.$_GET['unique_model_id'].'prav'.".txt");
          }
          ?>
          $(function() {
            $('#open-room').click();
          });
          <?php
        }
        if( isset($_GET['user']) && $_GET['user'] == 'viewer' ) {
          if( isset($_GET['unique_model_id']) && !empty($_SESSION['log_user_id']) ) {
            // unlink('total_user'.$_GET['unique_model_id'].$_SESSION['log_user_id'].".txt");
          }
          ?>
          $(function() {
            $('#join-room').click();
          });
          <?php
        }
      ?>
      
  </script>

  <link rel="stylesheet" href="<?='dev/getHTMLMediaElement.css'?>">
  <script src="<?='dev/getHTMLMediaElement.js'?>"></script>
	<script src="<?='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'?>" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
  
  <script src="<?='assest/script.js'?>"></script> 
</body>
</html>