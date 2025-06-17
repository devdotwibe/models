<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$html = "";
if(isset($_SESSION["log_user_id"])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="login.php"</script>';
	}
	$id=$_GET['id'];
	if(!$id){
		echo '<script>window.location.href="'.SITEURL.'chat"</script>';
	}
	else if($id==$_SESSION["log_user_id"]){
		echo '<script>window.location.href="'.SITEURL.'chat"</script>';
	}
	$user_data = get_data('model_user',array('id'=>$id),true);
	if(!$user_data){
		echo '<script>window.location.href="'.SITEURL.'chat"</script>';
	}
	$uDefaultImage =SITEURL."/assets/images/girl.png";
	if($user_data['gender']=='Male'){
		$uDefaultImage =SITEURL."/assets/images/profile.png";
	}
	if(!empty($user_data['profile_pic'])){
		$uDefaultImage = SITEURL.$user_data['profile_pic'];
	}

$mDefaultImage =SITEURL."/assets/images/girl.png";
if($userDetails['gender']=='Male'){
	$mDefaultImage =SITEURL."/assets/images/profile.png";
}
if(!empty($userDetails['profile_pic'])){
	$mDefaultImage = SITEURL.$userDetails['profile_pic'];
}
	
	//get message
	$string ="select tb.id,tb.user_id,tb.sender_id,tb.message,tb.created_date 
	from model_user_message tb 
	where (sender_id=".$userDetails['id']." and user_id=".$id.") 
	or (user_id=".$userDetails['id']." and sender_id=".$id.") 
	order by id asc";
	$all_message_data = DB::query($string);
	ob_start();
	include 'ajax_message_item.php';
	$html= ob_get_clean();

	
}
else{
	echo '<script>window.location.href="login.php"</script>';
}
?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Chat | The Live Model</title>
<?php  include('../includes/head.php'); ?>
<link rel='stylesheet' href='<?=SITEURL?>assets/css/chat.css?v=<?=time()?>' type='text/css' media='all' />
<style>
#frame .content .contact-profile {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
#frame .content .contact-profile .social-media >span{
	margin: 0;
}
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
	#frame .content{
		height:calc(100vh - 49px);
	}
  #frame #sidepanel {
	display:none;
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
        <div class="back-btn" onClick="closeChat()"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
	      
    <div class="contact-profile-text">
	      <img src="<?=$uDefaultImage?>" alt="" />
    	  <p><?=$user_data['username']?></p>
      </div>
      <div class="social-media">
        <span>
		<a href="<?=SITEURL.'single-profile.php?m_unique_id='.$user_data['unique_id']?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
		<a href="javascript:;"><i class="fa fa-phone" aria-hidden="true"></i></a>
		<a href="javascript:;" ><i class="fa fa-video-camera" aria-hidden="true"></i></a>
		</span>
      </div>
    </div>
    <div class="messages">
      <ul>
<?php
echo $html;
?>       
      </ul>
    </div>
    <div class="message-input">
      <div class="wrap">
<form action="" method="post" class="form-horizontal edit-form" role="form" enctype="multipart/form-data">
<input type="hidden" name="user_id" value="<?=$user_data['id']?>">
	<input type="text" name="message" id="i-message" placeholder="Write your message..." />
	<button class="submit" class="submitBtn"><i class="glyphicon-send glyphicon" aria-hidden="true"></i></button>
</form>
      </div>
    </div>
  </div>
</div>

            
          </div>
      
        </div>

      </div> 

 <?php include('../includes/footer.php'); ?>

<script src="<?=SITEURL?>assets/plugins/jquery.validate.js"></script>   
<script type="text/javascript">
$(".edit-form" ).validate({
    submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-notch-o fa-spin"></i>';
		$('.submitBtn').prop('disabled', true).html(loadingText);
		$('.message').html('');
		$.ajax({ 
			type: 'GET',
			url: '<?=SITEURL.'chat/act_send.php'?>', 
			data: $(".edit-form").serialize(),
			dataType: 'json',
			success: function(response) { 
				$(".btn-login").html('<i class="glyphicon-send glyphicon" aria-hidden="true"></i>').prop('disabled', false);
				if(response.status=='ok'){
					$('#i-message').val('');
            		$('.messages ul').append(response.message);
/*					$(".messages ul").animate({
						scrollTop:  scrolled
					});*/
					$(".messages").animate({
						scrollTop: $('html, body').get(0).scrollHeight
					}, 2000);
				}
				else{
            		$('.message').html('<div class="alert alert-danger">'+response.message+'</div>');
				} 
	        }
		});
		return false;
	}
});
$(".messages").animate({
	scrollTop: $('html, body').get(0).scrollHeight
}, 2000);

function closeChat(){
	$('.content').hide();
	$('#sidepanel').show();
}
</script>


  </body>


</html> 
