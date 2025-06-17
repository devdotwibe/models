<?php  session_start(); ?>
<?php 
$footer_hide_script=true;
include('includes/config.php');
include('includes/helper.php');
$error = '';
if(isset($_SESSION['log_user_unique_id'])){
  $getUserData = get_data('model_extra_details',array('unique_model_id'=>$_SESSION['log_user_unique_id']),true);
  if($getUserData){
	  if(empty($getUserData['insta_tokens'])){
		  $error = 'empty';
	  }
	  else if(empty($getUserData['snap_tokens'])){
		  $error = 'empty';
	  }
  }
  else{
	  $error = 'empty';
  }
}
else{
  $error = 'login';
}
?>

                          
<?php
  $sql_ap = "SELECT * FROM user_all_access WHERE model_id = '".$_GET['m_unique_id']."' AND user_id = '".$_SESSION['log_user_unique_id']."' and status=1";
  $res_ap = mysqli_query($con, $sql_ap);
  if (mysqli_num_rows($res_ap) > 0) {
    $row_ap = mysqli_fetch_assoc($res_ap);
     $status = $row_ap['status'];
     $end_date = $row_ap['end_date'];

      if($status == '1' && $end_date == date("Y-m-d") || $end_date < date("Y-m-d")){
        $sql_us = "UPDATE `user_all_access` SET `status` = '0' WHERE model_id = '".$_GET['m_unique_id']."' AND user_id = '".$_SESSION['log_user_unique_id']."'";
        if (mysqli_query($con, $sql_us)) {
          echo '<script>alert("Your 30 days access has expired. please renew it.")</script>';
        }
      }

      if($status == '1' && $end_date != date("Y-m-d") || $end_date > date("Y-m-d")){
        echo '<script>window.location.href="single-profile-all-access.php?m_unique_id='.$_GET['m_unique_id'].'"</script>';
      }
  }



?>
<!doctype html>
<html lang="en-US">
  <head>
    <title>Stacia | Your Agency Name</title>
    <meta name="MobileOptimized" content="320">
    
    <link rel='stylesheet' id='model-details-custom_profile-styles-css'  href='<?=SITEURL?>assets/wp-content/themes/theagency3/framework/assets/css/styles-custom_profile.css' type='text/css' media='all' />
    <link rel='stylesheet' id='model-details-pricing-styles-css'  href='<?=SITEURL?>assets/wp-content/themes/theagency3/framework/assets/css/styles-pricing.css' type='text/css' media='all' />
    
<?php include('includes/head.php'); ?>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!--    <script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'?>"></script>-->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
    <link rel="stylesheet" href="<?='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'?>">
    <script>
      $(document).ready(function(){
           $(document).bind("contextmenu",function(e){
              return false;
          });
          $(document).on('click', '.tlm_live_chat_btn', function(){
            // console.log('test');
          });
          function getConnectedDevices(type, callback) {
              navigator.mediaDevices.enumerateDevices()
                  .then(devices => {
                      const filtered = devices.filter(device => device.kind === type);
                      callback(filtered);
                  });
          }
          count = 0;
          getConnectedDevices('videoinput', cameras =>   cameras.forEach(function(value){
            count++;
            $('#tlm_camera_id').append('<option value="'+value.deviceId+'">Camera '+count+'</option>');
          }));
      });
    </script>
    <style type="text/css">
      .tlm_camera_id {
          display: inline-block;
          max-width: 118px;
          margin-left: 10px;
          padding: 5px 7px;
          background-color: #d83b21;
          color: #fff;
          font-weight: 600;
          border: 0;
          border-radius: 4px;
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

.post_img, .vid_tg{
	border:none;
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
      /*height: 100%;*/ 
      position: relative;
/*      float: left;
      margin-left: 10px;
      margin-right: 10px;*/
	  
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
/*      border-radius: 30px;
      border: 1px solid #ff2424;*/
      }
      .mn-dv-vdo{
      width: 100%; 
/*      height: 100%; */
      position: relative;
/*      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;*/
      margin-bottom: 20px;
      vertical-align: top;
      }
      .main-uper-div-vdo{
      position: absolute;
      top: 0px;
      left: 0px;
/*      background: #968e75;*/
      background: transparent;

      width: 100%; 
      height: 100%;
/*      border-radius: 30px;
      border: 1px solid #ff2424;*/
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
@media (max-width: 576px) {
	.mybtn{display:block;}
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
      .modal-titlea{
        color: white;
        border-bottom: 1px solid black;
        padding: 5px 0px 10px 10px;
        margin-bottom: 10px;
      }
      .modal-headera{
        border:none!important;
      }
      .modal-bodya{
        color: white;
      }
      .modal-titlea {
      font-size: 25px;
      }
      .followbers_popup p:hover{
       color:#d83b21;
      }

    </style>
<style>
.model-item-li{
	border:1px solid #ff2424;
	margin-bottom:10px;
	padding:10px;
	border-radius:10px
}
.model-items{
	display:flex;
    flex-direction: row;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.user-like-count{
	margin-top:5px;
	display:block;
}
.pay-btn{
	display: flex;
	justify-content: center;
}
.modal-content h1,
.modal-content h2,
.modal-content h3,
.modal-content h4,
.modal-content h5,
.modal-content h6{
	color:#000;
}

</style>
      
<script>

    function like( postid,userid ){
        
        if( userid==0 ){
           alert("Create Account First");
        }
        else{
        
            //alert("uid-" +userid  );
        
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById( "likebody"+postid ).innerHTML = this.responseText;
              }
            };
            xmlhttp.open("GET", "get-like.php?q=" + postid +"&uid="+ userid , true);
            xmlhttp.send();
            
        }
        
        
        
    }
      
</script>
      
<script>

    function share(){
        var dummy = document.createElement('input'),
        text = window.location.href;

        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        
        alert("Link Copyied To Clipboard Now Share Profile Anywhere");
    }
      
</script>      
      
  </head>
  <body class="models-template-default single single-models postid-410 custom-background">
    <?php include('includes/header.php'); ?> 
    <?php
      $sqls = "SELECT * FROM model_user WHERE unique_id = '".$_GET['m_unique_id']."'";
      $resultd = mysqli_query($con, $sqls);
        if (mysqli_num_rows($resultd) > 0) {
          $rowesdw = mysqli_fetch_assoc($resultd);
          $movel_name = $rowesdw['username'];
      
          // $sql_sl = "SELECT * FROM model_social_link WHERE unique_model_id = '".$_GET['m_unique_id']."' ";
          // $result_sl = mysqli_query($con, $sql_sl);
          //   if (mysqli_num_rows($result_sl) > 0) {
          //     $row_sl = mysqli_fetch_assoc($result_sl);
          //   }

          $sql_sl = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET['m_unique_id']."' ";
          $result_sl = mysqli_query($con, $sql_sl);
            if (mysqli_num_rows($result_sl) > 0) {
              $row_sl = mysqli_fetch_assoc($result_sl);
            }
      
      ?>
    <div class="ban_img_dv">
      <div class="main_img_wdth">
        <?php
          $sql_bi = "SELECT * FROM model_dp_banner WHERE unique_model_id = '".$_GET['m_unique_id']."'";
          $res_bi = mysqli_query($con, $sql_bi);
            if (mysqli_num_rows($res_bi) > 0) {
              $row_bi = mysqli_fetch_assoc($res_bi);
          
          ?>
        <img alt="models" class="banner_img_dynmic" src="<?php echo $row_bi['model_banner_pic']; ?>">
        <?php }else{?>
        <img alt="modelss" class="banner_img" src="assets/images/bg.jpg">
        <?php }?>
        <?php 
        $session_id = $_GET['m_unique_id'];
        if($_SESSION["log_user_unique_id"]== $session_id){ ?>
          <button style="" class="btn-chng_dp" data-toggle="modal" data-target="#myModadp">+</button>
        <?php }?>
      </div>
    </div>
    <div class="container">
      <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      </div>
      <div class="row menuyg">
        <div class="col-md-2 col-sm-6 col-xs-6 ">
          <div class="cir_img">
            <img  src="<?php echo !empty($rowesdw['profile_pic'])?$rowesdw['profile_pic']:SITEURL.'assets/images/girl.png'; ?>">
          </div>
          <?php $session_id = $_GET['m_unique_id'];
        if($_SESSION["log_user_unique_id"]== $session_id){ ?>
            <button style="" class="btn-chng_pp" data-toggle="modal" data-target="#myModapp">+</button>
          <?php } ?>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
          <p class="mol_name" id="show"><?php echo $rowesdw['name']; ?> <!--<i class="fa fa-angle-down angle_dwn" style="font-size:25px"></i><i class="fa fa-angle-up angle_up" style="font-size:25px"></i>--> 
            <?php 
              if($_SESSION["log_user"]){ 
              
                $sql_folo = "SELECT * FROM model_follow WHERE unique_model_id = '".$_GET['m_unique_id']."' AND unique_user_id = '".$_SESSION['log_user_unique_id']."' AND status = 'Follow'";
              
                $res_folo = mysqli_query($con, $sql_folo);
                  if (mysqli_num_rows($res_folo) > 0) {
              ?>
          <form>
            <input type="hidden" name="model_id" id="model_id" value="<?php echo $_GET['m_unique_id']; ?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['log_user_unique_id']; ?>">
            <div id="flow">
              <i class="i_inverse"></i>&nbsp;Unfollow
            </div>
          </form>
          <?php }else{ ?>
          <form>
            <input type="hidden" name="model_id" id="model_id" value="<?php echo $_GET['m_unique_id']; ?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['log_user_unique_id']; ?>">
            <div id="unflow">
              <i class="i_main"></i>&nbsp;Follow
            </div>
          </form>
          <?php } ?>
          </p>
          <?php } ?>
          <p id="mol-des">
            <?php if($row_sl['insta_p_url']){ ?>
            <a href="<?php echo $row_sl['insta_p_url']; ?>" style="color: black;">
              <img alt="modelss" src="assets/images/instagram.jpg" style="width: 25px;">
            </a>
            <?php }?>
            <?php if($row_sl['snap_p_url']){ ?>
              &nbsp;|&nbsp;
            <a href="<?php echo $row_sl['snap_p_url']; ?>">
              <img alt="modelss" src="assets/images/snapchat.png" style="width: 25px;">
            </a>
            <?php } ?>
          </p>
          <small>@<?php echo $rowesdw['username']; ?></small>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
          <div class="row">
            <?php
              $sql_img = "SELECT COUNT(file_type) FROM model_images WHERE unique_model_id = '".$_GET['m_unique_id']."' AND file_type = 'Image' Order by id DESC";
                 $result_img = mysqli_query($con, $sql_img);
                 if (mysqli_num_rows($result_img) > 0) {
                  $row_img = mysqli_fetch_assoc($result_img);
                  $num1 = $row_img['COUNT(file_type)'];
                 }
              
                 $sql_vdo = "SELECT COUNT(file_type) FROM model_images WHERE unique_model_id = '".$_GET['m_unique_id']."' AND file_type = 'Video' Order by id DESC";
                 $result_vdo = mysqli_query($con, $sql_vdo);
                 if (mysqli_num_rows($result_vdo) > 0) {
                  $row_vdo = mysqli_fetch_assoc($result_vdo);
                  $num2 = $row_vdo['COUNT(file_type)'];
                 }
              
                   $sql_flow = "SELECT COUNT(status) FROM model_follow WHERE unique_model_id = '".$_GET['m_unique_id']."' AND status = 'Follow' Order by id DESC";
                   //echo $sql_flow." sql query1"."<br>";
                   $result_flow = mysqli_query($con, $sql_flow);
                   if (mysqli_num_rows($result_flow) > 0) {
                     $row_flow = mysqli_fetch_assoc($result_flow);
                     $num3 = $row_flow['COUNT(status)'];
                   }
              
              
              ?>

            <div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
              <h4 class="past_heade">Total Post</h4>
              <p><?php echo $num1; ?></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
              <h4 class="past_heade">Photo</h4>
              <p><?php echo $num2; ?></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
              <h4 class="past_heade">Videos</h4>
              <p><?php echo $num1 + $num2; ?></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
              <div class="followbers_popup">
                <h4 class="past_heade">Followers</h4>
               <!-- <a href="#"><p><?php echo $num3; ?></p></a> -->
               <!-- <button style="background: none;" type="button" data-toggle="modal" data-target="#exampleModal"> -->
              <p style="cursor:pointer;" data-toggle="modal" data-target="#exampleModal"><?php echo $num3 ; ?></p>
            </button>

              </div>
            </div>

                        <!-- Button trigger modal get followbers id -->
            
          
                

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style=" width: 50%;margin: auto;background: #6d1e11 ">
                  <div class="modal-headera">
                    <div class="modal-titlea" id="exampleModalLabel"> Followers</div>
                    <button style="margin-top: -45px;margin-right:7px; opacity: 1; color: white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-bodya">
                      <a href=""><table style="color: white;">
                        <tr><td style="padding: 10px;">
                                         
                            <?php
                    
                     //$x = $_GET['m_unique_id'];

                    // echo $x;
                      
                    $query = "SELECT * from model_follow where unique_model_id ='".$_GET['m_unique_id']."' AND status = 'Follow' ";
                    
                     //echo $query;
                    $resultd = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($resultd)){

                      if(isset($row))
                      {
                       // echo $row['unique_user_id'];
                        // echo $row['unique_user_id']."<br>";
                        $query1 = "SELECT * from model_user where unique_id ='".$row['unique_user_id']."'";
                    
                         //echo $query;
                        $resultd1 = mysqli_query($con, $query1);
                        while ($row1 = mysqli_fetch_assoc($resultd1)){

                          if(isset($row1))
                          {
                                     // echo $row['unique_user_id'];
                                     // echo $row[0];
                                       echo $row1['name']."<br><br>";
                                    }
                                  }
                                }
                              }
                              
                               ?>
                                     <?php //echo $row['unique_user_id']?>

                                      </td></tr>
                                </table></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>

            <br>
            <br>
            <div></div>
            <button class="fancy_button mb-1"  data-toggle="modal" data-target="#myModal_v_sf">ABOUT</button>
            <button class="fancy_button mb-1" data-toggle="modal" data-target="#myModal_v_faci">SERVICES</button><!--style="padding: 8px;" -->
           
            
            <?php if($_GET['m_unique_id'] != $_SESSION["log_user_unique_id"]){ ?>
              <button class="fancy_button mb-1"  data-toggle="modal" data-target="#all_access">ALL ACCESS (30 DAYS)</button>
            <?php } ?>
            <?php 
              if($_SESSION["log_user_unique_id"]== $session_id) { 
                ?>
                  <form style="display:inline-block; width:50%;" method="post" action="https://thelivemodels.com/live-chat/index.php?user=streamer&unique_model_id=<?php echo isset($_GET['m_unique_id'])?$_GET['m_unique_id']:''; ?>">
                    <button type="submit" class="fancy_button" style="padding: 8px;">GO LIVE</button>
                    <select name="tlm_camera_id" class="form-control tlm_camera_id" id="tlm_camera_id" required="required">
                    </select>
                  </form>
                <?php
              }else if( isset($_SESSION['log_user_id']) && $_SESSION['log_user_id'] != '' ){
                ?>
                  <form style="display:inline-block" method="post" action="https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id=<?php echo isset($_GET['m_unique_id'])?$_GET['m_unique_id']:''; ?>">
                    <button type="submit" class="fancy_button" style="padding: 8px;">WATCH LIVE</button>
                  </form>
            
            
                <?php    
              }
            ?>
            <!-- <p class="view_div fancy_button" data-toggle="modal" data-target="#myModal_v_sf">View Other Facilities</p>
            <p class="view_div fancy_button" data-toggle="modal" data-target="#myModal_v_faci">View Other Facilities</p> -->

            <br>
            <br>

            <p style="padding: 10px;"> 
              <?php
                $sql_fwa = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET["m_unique_id"]."'";
                $result_fwa = mysqli_query($con,$sql_fwa);
                if (mysqli_num_rows($result_fwa) > 0) {
                  $row_fwa = mysqli_fetch_assoc($result_fwa);
                  $insta_coins = $row_fwa['insta_tokens'];
                  $snap_coins = $row_fwa['snap_tokens'];
                  echo 'Book a video call on:';

                  if($insta_coins){
              ?>
              <button style="padding: 5px 10px;" data-toggle="modal" data-target="#myModalinsta">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </button> 
              <?php } if($snap_coins){ ?>
              | 
              <button style="padding: 5px 10px;" data-toggle="modal" data-target="#myModalsnap">
                <i class="fa fa-snapchat" aria-hidden="true"></i>
              </button>
              <?php } ?>
              <?php
                }  
              ?>
              
              
            </p>

          </div>
        </div>
        <div class="arrow-down" style="position: absolute;left: 37%;" onclick="this.classList.toggle('active')"></div>
      </div>
      <!-- <hr style="margin-top: 0px;"> -->
      <?php if($_SESSION["log_user_unique_id"] == $_GET["m_unique_id"]){ ?>
      <div class="row">
        <div class="col-md-12" style="font-family: system-ui;">
          <form method="post" action="post-up.php" enctype="multipart/form-data">
            <input type="hidden" name="m_uni_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
            <div style="border: 1px solid #d83b21;height: 50px;border-radius: 10px 10px 1px 0px;">
              <p class="new_p_head" style="margin-left: 20px;">NEW POST</p>
              <button type="submit" name="upload_image" class="post_btn">POST</button>
            </div>
            <div style="border: 1px solid #d83b21;border-top: none;border-radius: 0px 0px 10px 10px;">
              <!-- <div class="bor_div"></div> -->
              <input type="text" name="img_text" placeholder="Compose new post..." class="inp_post" >
              <p style="padding: 20px;">Upload your image or video here...</p>
              <!-- <button class="up_med">Upload Media</button> -->
              <p class="fancy_button up_med" style="padding: 6px;width: max-content;margin-left: 20px;" >Upload Media</p>
              <div class="file-upload">
                <img alt="modelss" src="https://i.stack.imgur.com/dy62M.png" id="blah" />
                <input type="file" name="filess" id="imgInp" />
              </div>
              <div class="file_t_div">
                File Type:
                <input type="radio" name="file" value="Image" class="fil_radio">Image
                <input type="radio" name="file" value="Video" class="fil_radio">Video
              </div>
              <div class="post_t_div">
                Post Type:
                <input type="radio" name="file_type_price" value="Free" class="post_radio">Free
                <input type="radio" name="file_type_price" value="Paid" class="post_radio">Paid
              </div>
              <div>
                <input type="text" name="coins" placeholder="Enter coins for post.." class="coin_fle" id="coin_field">
              </div>
            </div>
            <script>
              $(document).ready(function(){
                $("#coin_field").hide();
                // $(".file-upload").hide();
                // $(".file_t_div").hide();
                // $(".post_t_div").hide();
                $('input:radio[name="file_type_price"]').change(function(){
                  if(this.value == 'Paid'){
                    $("#coin_field").show();
                  }else{
                    $("#coin_field").hide();
                  }
                });
                $('.up_med').click(function(){
                  $(".file-upload").toggle();
                });
                $("#imgInp").change(function(){
                  $(".file_t_div").show();
                });
                $(".fil_radio").change(function(){
                  $(".post_t_div").show();
                });
               });
                function readURL(input) {
                  if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                  }
                }
                
                $("#imgInp").change(function(){
                    readURL(this);
                });
             
            </script>
            <!-- <div class="bor_div"></div> -->
          </form>
        </div>
      </div>
      <?php } ?>


      <p style="padding: 10px;"></p>
      <div class="row model-items">
        <?php
          $log_user_id = $_SESSION["log_user_unique_id"];
          $count = 1;
            $sql = "SELECT * FROM model_images WHERE unique_model_id = '".$rowesdw['unique_id']."' Order by id DESC";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($rowes = mysqli_fetch_assoc($result)){
                $unique_image_id = $rowes['id'];
               $stat = "";
          
              $sql45 = "SELECT * FROM user_purchased_image WHERE file_unique_id = '".$unique_image_id."' AND user_unique_id = '".$log_user_id."'";
             $result45 = mysqli_query($con, $sql45);
             if (mysqli_num_rows($result45) > 0) {
               $stat = "Purchased";
             }
          ?>
        <?php if($rowes['img_type_price'] == 'Free'){ ?>
        <div class="col-md-3 col-xs-12 "><!--my_dvf-->
        <div class="model-item-li">
          <?php if($rowes['file_type'] == 'Image'){ ?>
          <div class="main_idv" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
            <img alt="modelss" class="post_img" src="<?php echo $rowes['file']; ?>" >  
          </div>
          <?php }else{ ?>
          <video class="vid_tg" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>" >
            <source src="<?php echo $rowes['file']; ?>" type="video/mp4">
          </video>
          <?php } ?>
          <p class="img_desc"><?php echo $rowes['image_text']; ?></p>
          <!-- <p style="font-size: 12px;text-align: center;"><span><a href="#" class="share">buy</a> | <a href="#" class="share">like</a> | <a href="#" class="share">share</a> |<a href="#" class="share"> comment </a>| <a href="#" class="share">download</a></span></p> -->
            
            <div style="color:white;">
			<span >
<button class="btn-primary btn-xs" style="color:white; " onClick="openPostModal(<?=$rowes["id"]?>)" >
<i class="fa fa-comments" ></i> Comments</button> 
<span id="likebody<?=$rowes["id"]?>">
<?php
	$pid=$rowes["id"];
	
	if( !empty( $_SESSION["log_user_id"] ) ){ $uid=$_SESSION["log_user_id"]; }
	else{ $uid=0; }
									 
	$onclick ='onclick="like( ' .$pid .' ,' .$uid .' )"';						 
	$qurdd=mysqli_query($con,"select * from postlike where pid='$pid' and uid='$uid'");
	$userLiketxt = '';
	if( mysqli_num_rows( $qurdd )>0 ){
		$onclick ='readonly';						 
		$userLiketxt ='You & ';
	}
?>
<button class="btn-primary btn-xs" style="color:white; " <?=$onclick?>>
    <i class="fa fa-thumbs-up" style="<?=$onclick=='readonly'?'color:green':''?>"></i> Like
</button>
<button class="btn-primary btn-xs" onclick="share()" ><i class="fa fa-share"></i> Share</button> 
</span>
</span>
<?php                                                     

$qurlike=mysqli_query($con,"select * from postlike where pid='$pid'");
echo '<span class="user-like-count">'.$userLiketxt.mysqli_num_rows( $qurlike ) ." Users Liked</span>";

?>
            </div>
            
        </div>
<!-- Modal -->
<div id="myModal<?php echo $count; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content" style="border-radius: 20px;">
  <div class="modal-body">
    <button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
    <div class="row">
      <div class="col-md-6"><img alt="modelss" class="full_img" src="<?php echo $rowes['file']; ?>" ></div>
      <div class="col-md-6">
        <div class="usern model-prof">
          <a title="" href="single-model.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>" >
            <figure class="user_profile">
              <img alt="modelss" class="profil_img" src="<?php echo $rowesdw['profile_pic'] ?>">
            </figure>
            <span><?php echo $rowesdw['username']; ?></span>
          </a>      
        </div>
        <hr>
        <p><?php echo $rowes['image_text'] ?></p>
      </div>
    </div>
  </div>
</div>
</div>
</div><!--modal-->
        </div>
        <?php }else if($rowes['img_type_price'] == 'Paid'){ ?>
        <div class="col-md-3 col-xs-12 "><!--my_dvf-->
        <div class="model-item-li">

          <?php if($rowes['file_type'] == 'Image'){ ?>

          <?php if($stat == "Purchased"){ ?>
          <div class="main_idv" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
            <img alt="modelss" class="post_img" src="<?php echo $rowes['file']; ?>" >  
          </div>
          <?php }else{ ?>
          <div class="mn-dv-img">
            <form method="post" action="file-process.php">
              <input type="hidden" name="file_id" value="<?php echo $rowes['id']; ?>">
              <input type="hidden" name="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
              <input type="hidden" name="coins" value="<?php echo $rowes["coins"]; ?>">
              <input type="hidden" name="file_type" value="<?php echo $rowes['file_type']; ?>">
              <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
              <input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>">
              <input type="hidden" name="model_id" value="<?php echo $rowesdw['id']; ?>">
              
              <input type="hidden" name="model" value="<?php echo $_GET['model']; ?>">
              <img alt="modelss" style="filter: blur(10px);" class="post_img" src= "<?php echo $rowes["file"]; ?>">
              <div class="main-uper-div-img">
                <i class="fa fa-image icn-img" ></i>
                <div class="pay-btn">
                <button class="mybtn"  type="submit" name="submit">
                <i class="fa fa-database coin_icon" aria-hidden="true"></i>&nbsp;<?php echo $rowes["coins"]; ?>
                </button>
                </div>
              </div>
            </form>
          </div>
          <?php }?>

          <?php }else{ ?>

          <?php if($stat == "Purchased"){ ?>

          <video class="vid_tg" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>" >
            <source src="<?php echo $rowes['file']; ?>" type="video/mp4">
          </video>

          <?php }else{ ?>

          <div class="mn-dv-vdo">
            <form method="post" action="file-process.php">
              <input type="hidden" name="file_id" value="<?php echo $rowes['id']; ?>">
              <input type="hidden" name="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
              <input type="hidden" name="coins" value="<?php echo $rowes["coins"]; ?>">
              <input type="hidden" name="file_type" value="<?php echo $rowes['file_type']; ?>">
              <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
              <input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>">
              <input type="hidden" name="model" value="<?php echo $_GET['model']; ?>">
              <input type="hidden" name="model_id" value="<?php echo $rowesdw['id']; ?>">
              
              <video class="paid-video vid_tg" controls poster="assets/images/unnamed.jpg" style="filter: blur(14px);">
                <!--<source src="../<?php echo $rowes["file"]; ?>" type="video/mp4">-->
              </video>
              <div class="main-uper-div-vdo">
                <i class="fa fa-play icn-vdo" ></i>
                <div class="pay-btn">
                <button class="mybtn" type="submit" name="submit" >
                <i class="fa fa-database coin_icon" aria-hidden="true"></i>&nbsp;<?php echo $rowes["coins"]; ?>
                </button>
                </div>
              </div>
            </form>
          </div>
          <?php } ?>

          <?php } ?>
          <p class="img_desc"><?php echo $rowes['image_text']; ?></p>
            <div style="color:white;">
<span >
<button class="btn-primary btn-xs" style="color:white; " onClick="openPostModal(<?=$rowes["id"]?>)" >
<i class="fa fa-comments" ></i> Comments</button> 
<span id="likebody<?=$rowes["id"]?>">
<?php
	$pid=$rowes["id"];
	
	if( !empty( $_SESSION["log_user_id"] ) ){ $uid=$_SESSION["log_user_id"]; }
	else{ $uid=0; }
									 
	$onclick ='onclick="like( ' .$pid .' ,' .$uid .' )"';						 
	$qurdd=mysqli_query($con,"select * from postlike where pid='$pid' and uid='$uid'");
	$userLiketxt = '';
	if( mysqli_num_rows( $qurdd )>0 ){
		$onclick ='readonly';						 
		$userLiketxt ='You & ';
	}
?>
<button class="btn-primary btn-xs" style="color:white; " <?=$onclick?>>
    <i class="fa fa-thumbs-up" style="<?=$onclick=='readonly'?'color:green':''?>"></i> Like
</button>
<button class="btn-primary btn-xs" onclick="share()" ><i class="fa fa-share"></i> Share</button> 
</span>
</span>
<?php                                                     
                    
                    $qurlike=mysqli_query($con,"select * from postlike where pid='$pid'");
                    echo '<span class="user-like-count">'.$userLiketxt.mysqli_num_rows( $qurlike ) ." Users Liked</span>";
                
                ?>
            </div>
        </div>

<!-- Modal -->
<div id="myModal<?php echo $count; ?>" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-body">
                <button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
                <div class="row">
                  <div class="col-md-6"><img src="<?php echo $rowes['file']; ?>" alt="modelss" class="full_img" /></div>
                  <div class="col-md-6">
                    <div class="usern model-prof">
                      <a title="" href="single.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>" >
                        <figure class="user_profile">
                          <img alt="modelss" class="profil_img" src="<?php echo $rowesdw['profile_pic'] ?>">
                        </figure>
                        <span><?php echo $rowesdw['username']; ?></span>
                      </a>      
                    </div>
                    <hr>
                    <p><?php echo $rowes['image_text'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- Modal -->
        
        </div>
        
        <?php } ?>
        <?php
          $count++;
          }
          } else {
          echo "<center><h3>This Model Does not have post.</h3></center>";
          }
          ?>
      </div>
    </div>
    <?php
      } else {
        echo "No Record Found";
      }
      ?>
    <div id="myModal_v_sf" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px;">
          <div class="modal-body">
            <button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
            <p class="tab_head">Profile: </p>
              <?php
                $sql_d = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET['m_unique_id']."'";
                $result_d = mysqli_query($con, $sql_d);
                if (mysqli_num_rows($result_d) > 0) {
                  $row_d = mysqli_fetch_assoc($result_d);  
              ?>
              <table class="table">
                <p style="font-size: 16px;font-weight: bold;padding-left: 30px;">Figure and Stats:</p>
                <tr>
                  <td>Bust size</td>
                  <td><?php echo $row_d['bust_size']; ?></td>
                </tr>
                <tr>
                  <td>Cup size</td>
                  <td><?php echo $row_d['cup_size']; ?></td>
                </tr>
                <tr>
                  <td>Waist size</td>
                  <td><?php echo $row_d['waist_size']; ?></td>
                </tr>
                <tr>
                  <td>Ethnicity</td>
                  <td><?php echo $row_d['ethnicity']; ?></td>
                </tr>
                <tr>
                  <td>Height</td>
                  <td><?php echo $row_d['height']; ?></td>
                </tr>
                <tr>
                  <td>Weight</td>
                  <td><?php echo $row_d['weight']; ?></td>
                </tr>
                <tr>
                  <td>Eye color</td>
                  <td><?php echo $row_d['eye_color']; ?></td>
                </tr>
                <tr>
                  <td>Hair color</td>
                  <td><?php echo $row_d['hair_color']; ?></td>
                </tr>
              </table>
              <?php }else{ ?>
                <p style="padding-left: 20px;">No Details Found.</p>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div id="myModal_v_faci" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px;">
          <div class="modal-body" style="padding: 15px;">
        		<button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
            <p style="font-size: 16px;font-weight: bold;padding-left: 10px;">Other Facilities:</p>
            <?php
              $sql_d = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET['m_unique_id']."'";
              $result_d = mysqli_query($con, $sql_d);
              if (mysqli_num_rows($result_d) > 0) {
                $row_d = mysqli_fetch_assoc($result_d);  
            ?>
            <table class="table">
              <?php if($row_d['live_cam'] == 'Yes'){ ?>
                <tr>
                  <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/live.png">&nbsp;&nbsp;Live cam</td>
                  <td class="book"><a href="#" onclick="alert('Please Use Profile Page option for book call.')" class="fancy_button" >Book Now</a></td>
                </tr>
              <?php }?>
              <?php if($row_d['group_show'] == 'Yes'){ ?>
                <tr>
                  <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/group.png">&nbsp;&nbsp;Group Show</td>
                  <td><a href="booking-forms/group-show.php?model=<?php echo $movel_name; ?>&m_id=<?php echo $_GET['m_unique_id']; ?>" class="fancy_button">Book Now</a></td>
                </tr>
              <?php }?> 
              <?php if($row_d['work_escort'] == 'Yes'){ ?>
                <tr>
                  <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/girl.png">&nbsp;&nbsp;Dating assignments</td>
                  <td><a href="booking-forms/as-an-escorts.php?model=<?php echo $movel_name; ?>&m_id=<?php echo $_GET['m_unique_id']; ?>" class="fancy_button" >Book Now</a></td>
                </tr>
              <?php }?> 
              <?php if($row_d['International_tours'] == 'Yes'){ ?>
                <tr>
                  <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/earth-globe.png">&nbsp;&nbsp;International Tours</td>
                  <td><a href="booking-forms/international-tour.php?model=<?php echo $movel_name; ?>&m_id=<?php echo $_GET['m_unique_id']; ?>" class="fancy_button">Book Now</a></td>
                </tr>
              <?php }?> 
                <tr>
                  <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/film.png">&nbsp;&nbsp;Selling Video's & Picture's</td>
                  <td><a href="https://thelivemodels.com/single-profile.php?m_unique_id=<?php echo $_SESSION["log_user_unique_id"]; ?>" class="fancy_button">View Now</a></td>
                </tr>
              <?php if($row_d['modeling_porn_assignment'] == 'Yes'){ ?>
                <tr>
                  <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/porn.png">&nbsp;&nbsp;Modeling/Movie Assignment's?</td>
                  <td><a href="booking-forms/modeling-movie-assignment.php?model=<?php echo $movel_name; ?>&m_id=<?php echo $_GET['m_unique_id']; ?>" class="fancy_button">Book Now</a></td>
                </tr>
              <?php }?>
            </table>
            <?php }else{ ?>
              <p style="padding-left: 20px;">The model is not offering any services at the moment.
              </p>
              <div style="padding: 10px;">
              <a href="#" class="fancy_button">Request Services</a></div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div id="all_access" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 style="color: grey;" class="modal-title">Confirmation</h4>
          </div>
          <div class="modal-body" style="padding: 15px;">
            <?php if( !$_SESSION["log_user"] ){ ?>
                <h4 style="color: grey;">You need to login/register first. Going to login...</h4>
                <a style="transition: 1s ease;" class="btn btn-default" href="login.php">Login</a>
            <?php }else{ ?>
                <h5 style="color: grey;">Are you sure to continue. Once you have click then the amount will be deducted from your account and your 30 day's counted from today. If you agree please click on pay and continue.</h5>
                <a class="btn btn-default" href="all-access-processing.php?model_id=<?php echo $_GET['m_unique_id'];?>&user_id=<?php echo $_SESSION['log_user_unique_id']; ?>&action=all_access" style="transition: 1s ease;">Pay and Continue</a>
            <?php } ?>
            <!-- <table class="table">
              <tr>
                <td><img alt="modelss" style="width: 28px;" src="assets/images/facility-icon/film.png">&nbsp;&nbsp;Selling Video's & Picture's</td>
                <td><a href="https://thelivemodels.com/single-profile.php?m_unique_id=<?php echo $_SESSION["log_user_unique_id"]; ?>" class="fancy_button">View Now</a></td>
              </tr>
            </table> -->
          </div>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php'); ?> 
    <script>
      $(document).ready(function(){
        $(".angle_dwn").show();
        $(".angle_up").hide();
        $("#mol-des").hide();
        $(".angle_dwn").click(function(){
            $(".angle_up").show();
            $(".angle_dwn").hide();
            $("#mol-des").show();
        });
        $(".angle_up").click(function(){
            $(".angle_dwn").show();
            $(".angle_up").hide();
            $("#mol-des").hide();
        });
      });
    </script>
    <script>
      $(function() {
          $( ".i_inverse" ).click(function() {
            $( ".i_inverse,.s_inverse" ).toggleClass( "press", 1000 );
            var model_id = $('#model_id').val();
            var user_id = $('#user_id').val();
      
            if(model_id!="" && user_id!=""){
              $.ajax({
                url: "unfollow_model.php",
                type: "POST",
                data: {
                  model_id: model_id,
                  user_id: user_id        
                },
                cache: false,
                success: function(dataResult){
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==2000){
                    //$("#btn-inverse").removeAttr("disabled");
                    //$('#fupForm').find('input:text').val('');
                    //$("#success").show();
                    //$('#success').html('Model Unfollow successfully !'); 
                    location.reload();           
                    $("#flow").show();
                    $("#unflow").hide();
                  }
                  else if(dataResult.statusCode==2001){
                     alert("Error occured !");
                  }
                }
              });
            }
            else{
              alert('Please fill all the field !');
            }
          });
          $( ".i_main" ).click(function() {
            $( ".i_main,.s_main" ).toggleClass( "press", 1000 );
      
            $("#i_main").css('color','#e54720');
            var model_id = $('#model_id').val();
            var user_id = $('#user_id').val();
      
            if(model_id!="" && user_id!=""){
              $.ajax({
                url: "follow_model.php",
                type: "POST",
                data: {
                  model_id: model_id,
                  user_id: user_id        
                },
                cache: false,
                success: function(dataResult){
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                    //$("#btn").removeAttr("disabled");
                    //$('#fupForm').find('input:text').val('');
                    //$("#success").show();
                    //$('#success').html('Model Follow successfully !');  
                    location.reload();
                    $("#flow").hide();
                    $("#unflow").show();          
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                }
              });
            }
            else{
              alert('Please fill all the field !');
            }
          });
      });
      
    </script>
    <div class="modal fade" id="myModadp" role="dialog">
      <div class="modal-dialog">
      
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Banner image</h4>
          </div>
          <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="act-single-profile.php" style="padding: 20px;">
              <?php $log_user_id = $_SESSION["log_user_unique_id"]; ?>
              <input type="hidden" name="u_id" value="<?php echo $log_user_id; ?>">
              <input type="hidden" name="get_path" value="1">
              <label>Banner Image</label>
              <input type="file" name="banner_pic">
              <input type="submit" class="fancy_button" name="submit_pic" value="upload image" style="margin-top: 20px;">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    <div class="modal fade" id="myModapp" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Profile picture</h4>
          </div>
          <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="act-single-profile.php" style="padding: 20px;">
              <?php $log_user_id = $_SESSION["log_user_unique_id"]; ?>
              <input type="hidden" name="u_id" value="<?php echo $log_user_id; ?>">
              <input type="hidden" name="get_path" value="1">
              <label>Profile Image</label>
              <input type="file" name="profile_img">
              <input type="submit" class="fancy_button" name="submit_profile_pic" value="upload image" style="margin-top: 20px;">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>

    <div class="modal fade" id="myModalinsta" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Instagram Call</h4>
          </div>
          <div class="modal-body">
<?php
if($error=='login'){
?>
<center>
<h4>Please Login First!!</h4>
</center>
<?php
}
else if($error=='empty'){
?>
<center>
<h4>Please fill your social media link!!</h4>
</center>
<?php
}
else{
$sql_fwa = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
$result_fwa = mysqli_query($con,$sql_fwa);
if (mysqli_num_rows($result_fwa) > 0) {
$row_fwa = mysqli_fetch_assoc($result_fwa);
$insta_coins = $row_fwa['insta_tokens'];
}  
?>
<center>
<h4>ADD CALL ON INSTA</h4>
<p><i class="fas fa-coins" style="font-size:15px;color:gold" aria-hidden="true"></i><?php echo $insta_coins; ?>.</p>
<ul class="mmInstaList" style="list-style-type: none;">
<li>1 time Private Video Call(10 mins)</li>
<li>Please allow 4-6 hours for activation</li>
</ul>
<form method="post" enctype="multipart/form-data" action="act-insta_call.php" style="padding: 20px;">
<input type="hidden" name="u_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
<input type="hidden" name="m_unique_id" value="<?php echo $_GET["m_unique_id"]; ?>">
<input type="hidden" name="coins" value="<?php echo $insta_coins; ?>">
<input type="text" name="i_username" placeholder="Instagram Username" style="padding: 6px;width: 70%;">
<br>
<input type="email" name="i_email" placeholder="Email Address" style="padding: 6px;width: 70%;margin-top: 10px;">
<br>
<input type="submit" class="fancy_button" name="submit_insta_call" value="Add Call" style="margin-top: 20px;padding: 5px 15px;">
</form>
</center>
<?php
}

?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModalsnap" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Snapchat call</h4>
          </div>
          <div class="modal-body">
            <?php
if($error=='login'){
?>
<center>
<h4>Please Login First!!</h4>
</center>
<?php
}
else if($error=='empty'){
?>
<center>
<h4>Please fill your social media link!!</h4>
</center>
<?php
}
else{
  $sql_fwa = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
  $result_fwa = mysqli_query($con,$sql_fwa);
  if (mysqli_num_rows($result_fwa) > 0) {
	  $row_fwa = mysqli_fetch_assoc($result_fwa);
	  $snap_coins = $row_fwa['snap_tokens'];
  }  
?>
<center>
  <h4>ADD CALL ON SNAP</h4>
  <p><i class="fas fa-coins" style="font-size:15px;color:gold" aria-hidden="true"></i><?php echo $snap_coins;?>.</p>
  <ul class="mmInstaList" style="list-style-type: none;">
	<li>1 time Private Video Call(10 mins)</li>
	<li>Please allow 4-6 hours for activation</li>
  </ul>
  <form method="post" enctype="multipart/form-data" action="act-insta_call.php" style="padding: 20px;">
	<input type="hidden" name="u_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
	<input type="hidden" name="m_unique_id" value="<?php echo $_GET["m_unique_id"]; ?>">
	<input type="hidden" name="coins" value="<?php echo $snap_coins;?>">
	<input type="text" name="s_username" placeholder="Snapchat Username" style="padding: 6px;width: 70%;">
	<input type="email" name="s_email" placeholder="Email Address" style="padding: 6px;width: 70%;margin-top: 10px;">
	<br>
	<input type="submit" class="fancy_button" name="submit_snap_call" value="Add Call" style="margin-top: 20px;padding: 5px 15px;">
  </form>
</center>
<?php
}
?>            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

                           <!-- header.php included get following data -->

                          
                          <!-- The Modal -->
                           

<div id="post-modal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content" style="border-radius: 20px;">
  <div class="modal-body">
  </div>
</div>
</div>
</div>    

<script src="<?=SITEURL?>assets/plugins/jquery.validate.js"></script>   
<script>
function openPostModal(id){
	$('#post-modal').modal();
	ajaxPostModal(id);
}
function ajaxPostModal(id){
	$('#post-modal .modal-body').html('<div class="text-center">Loading..</div>');
	$.ajax({
		type: 'GET',
		url : "<?php echo SITEURL.'modalprofile/ajax_comment.php'?>",
		data:{id:id},
		dataType:'json',
		success: function(response){
			$('#post-modal .modal-body').html('<button type="button" class="close close_stle" data-dismiss="modal">&times;</button>'+response.html);
		}
	});
	
}
</script>
    
  </body>
</html>

