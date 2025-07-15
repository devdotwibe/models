<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

$activeTab = 'group-show';
$m_link= SITEURL.'user/group-show/';

if(isset($_SESSION["log_user_id"])){


    $log_user_id = $_SESSION['log_user_id'];

	$get_modal_user = DB::query('select * from model_user where id='.$log_user_id);


        $usern = $_SESSION["log_user"];

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


	if($userDetails){}
	else{
		echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
		die;
	}
}
else{
	echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
	die;
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

<title>Bookging | The Live Model</title>

<?php  include('../../includes/head.php'); ?>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />

<link rel='stylesheet' href='<?=SITEURL?>assets/css/user_chat.css?v=<?=time()?>' type='text/css' media='all' />

</head>

<body class="socialwall-page">

 <?php /*  include('../../includes/profile_header_index.php'); */?>

<?php

        if(!empty($get_modal_user[0]['profile_pic'])){

            $prof_img = SITEURL.$get_modal_user[0]['profile_pic'];

        } else{

            $prof_img = SITEURL.'assets/images/model-gal-no-img.jpg';
        }
?>

    <div class="particles" id="particles"></div>

    <div class="chat-container">
        <!-- Header -->
        <div class="chat-header">
            <div class="header-left">

                <div class="avatar-container">

                    <div class="model-avatar">

                        <div class="avatar-placeholder"><img src="<?php echo $prof_img; ?>" alt="Profile" class="w-20 h-20 rounded-full"></div>

                    </div>

                    <div class="online-indicator"></div>

                </div>

                <div class="model-info">
                    <h2>Aria M.</h2>
                    <div class="model-status">
                        <div class="status-dot"></div>
                        <span>Online Now</span>
                    </div>
                </div>
            </div>
            <div class="token-balance">
                <span>💎</span>
                <span id="tokenCount">3,500</span>
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">

        
            <div class="message user">
                <div class="message-avatar">
                    <div class="avatar-placeholder user-avatar-placeholder">U</div>
                </div>
                <div class="message-content">
                    <div class="message-text">Hi there Aria! I loved your latest photos 👋</div>
                    <div class="timestamp">10:00 AM ✓✓</div>
                </div>
            </div>

            <!-- Model Message -->
            <div class="message">
                <div class="message-avatar">
                    <div class="avatar-placeholder">AM</div>
                </div>
                <div class="message-content">
                    <div class="message-text">Hello! Thanks for the compliment! I have some special content just for you today 💕</div>
                    <div class="timestamp">10:01 AM ✓</div>
                </div>
            </div>

     

            <div class="message hidden" id="typingIndicator">
                <div class="message-avatar">
                    <div class="avatar-placeholder">AM</div>
                </div>
                <div class="message-content">
                    <div class="typing-indicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="chat-input-area">
            <input type="text" class="message-input" id="messageInput" placeholder="Type a message..." onkeypress="handleKeyPress(event)">
            
            <div class="attachment-container">
                <button class="attachment-btn" id="attachmentBtn" onclick="toggleAttachmentMenu()">
                    📎
                </button>
                <div class="attachment-menu" id="attachmentMenu">
                    <button class="attachment-option" onclick="handleAttachmentOption('audio')">
                        🎤 Audio Call
                    </button>
                    <button class="attachment-option" onclick="handleAttachmentOption('video')">
                        📹 Video Call
                    </button>
                    <button class="attachment-option" onclick="handleAttachmentOption('file')">
                        📁 Attach File
                    </button>
                </div>
            </div>
            
            <button class="send-btn" onclick="sendMessage()">
                <div class="send-icon"></div>
            </button>
        </div>
    </div>

    <input type="file" id="fileInput" style="display:none" onchange="handleFile(event)" />



<?php /* include('../../includes/footer.php'); */ ?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>



</body>


</html> 
