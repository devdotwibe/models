<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
if(isset($_SESSION["log_user_id"])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="login.php"</script>';
	}
}
else{
	echo '<script>window.location.href="login.php"</script>';
}

$mDefaultImage =SITEURL."/assets/images/girl.png";
if($userDetails['gender']=='Male'){
	$mDefaultImage =SITEURL."/assets/images/profile.png";
}
if(!empty($userDetails['profile_pic'])){
	$mDefaultImage = SITEURL.$userDetails['profile_pic'];
}

?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Chat | The Live Model</title>
<?php  include('../includes/head.php'); ?>
<link rel='stylesheet' href='<?=SITEURL?>assets/css/chat.css?v=<?=time()?>' type='text/css' media='all' />
<style>
@media screen and (max-width: 735px){
	#frame .content {
		display:none;
	}
}
</style>

<style>
@media screen and (max-width: 735px) {
	.header,#sub-floor{
		display:none;
	}
	#content{
		padding-top:0;
/*		padding:*/
	}
	#content> .col-md-12{
		padding:0;
	}
  #frame .content .contact-profile {
    display: flex;
    justify-content: space-between;
	align-items: center;
  }
  .back-btn{
    padding: 10px;
	width: 30px;
  }
 .contact-profile-text{
    display: flex;
	align-items: center;
  }
  #frame .content .contact-profile img{
	  margin:0px 10px 0 0px;
  }
}

@media screen and (min-width: 735px) {
  .back-btn{
	display:none;
  }
}

</style>

  </head>

<body class="page-template-default page page-id-319 custom-background">
   <?php include('../includes/header.php'); ?>

      <div class="container">

        <div id="content" class="clearfix row">
        
          <div class="col-md-12 clearfix" >
<div id="frame">
<?php 
include('left_menu.php');
?>
  
  <div class="content">
    <div class="contact-profile">
      <img src="<?=$mDefaultImage?>" alt="" />
      <p><?=$userDetails['username']?></p>
      
    </div>
    <div class="messages">
      
    </div>
    <div class="message-input">
      <!--<div class="wrap">
      <input type="text" placeholder="Write your message..." />
      <button class="submit"><i class="glyphicon-send glyphicon" aria-hidden="true"></i></button>
      </div>-->
    </div>
  </div>
</div>

            
          </div>
      
        </div>

      </div> 

 <?php include('../includes/footer.php'); ?>

  </body>


</html> 
