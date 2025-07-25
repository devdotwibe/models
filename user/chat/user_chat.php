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
    
        <div class="chat-header">
            <div class="header-left">

                <div class="avatar-container">

                    <div class="model-avatar">

                        <div class="avatar-placeholder"><img src="<?php echo $uDefaultImage; ?>" alt="Profile" class="w-20 h-20 rounded-full"></div>

                    </div>

                    <div class="online-indicator"></div>

                </div>

                <div class="model-info">
                    <h2> <?php echo $user_data['username'] ;?></h2>
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

        
        <?php foreach($all_message_data as $set_user) { 
            
                $defaultImage =SITEURL."/assets/images/girl.png";
                $type ="sent";
            
                if($set_user['sender_id']==$userDetails['id']){

                    $type ="replies";
                    if($userDetails['gender']=='Male'){
                        $defaultImage =SITEURL."/assets/images/profile.png";
                    }
                    if(!empty($userDetails['profile_pic'])){
                        $defaultImage = SITEURL.$userDetails['profile_pic'];
                    }
                }
                else{
                    $type ="sent";
                    if($user_data['gender']=='Male'){
                        $defaultImage =SITEURL."/assets/images/profile.png";
                    }
                    if(!empty($user_data['profile_pic'])){
                        $defaultImage = SITEURL.$user_data['profile_pic'];
                    }
                }

                $date = $set_user['created_date']; 
                $display_date =  date('h:i A', strtotime($date));
                    
            ?>

            <?php if($type =='replies') { ?>

                <div class="message user">
                    <div class="message-avatar">
                        <div class="avatar-placeholder user-avatar-placeholder"><img src="<?php echo $defaultImage ?>"> </div>
                    </div>
                    <div class="message-content">
                        <div class="message-text"> <?php echo $set_user['message'] ?> </div>
                        <div class="timestamp"><?php echo $display_date?> ✓✓</div>
                    </div>
                </div>

            <?php } else { ?>


                <div class="message">
                    <div class="message-avatar">
                        <div class="avatar-placeholder"><img src="<?php echo $defaultImage ?>"></div>
                    </div>
                    <div class="message-content">
                        <div class="message-text"> <?php echo $set_user['message'] ?></div>
                        <div class="timestamp"><?php echo $display_date?> ✓</div>
                    </div>
                </div>

            <?php } ?>

        <?php }?>

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


            <input type="text" class="message-input" id="i-message" placeholder="Type a message...">
            
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

            <input type="hidden" name="user_id" id="replay_user" value="<?=$user_data['id']?>">

            <input type="hidden" name="user_time" id="user_time" value="<?php echo date('Y-m-d H:i:s') ?>">
            
            <button class="send-btn" type="button" id="submitBtn" onclick="sendMessage()">
                <div class="send-icon"></div>
            </button>

        </div>
    </div>

    <input type="file" id="fileInput" style="display:none" onchange="handleFile(event)" />



<?php /* include('../../includes/footer.php'); */ ?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


<script>

    $(function()
    {
        $("#chatMessages").animate({
           scrollTop: $("#chatMessages")[0].scrollHeight
        }, 1000);

        setInterval(function() {

            recieveMessage();
            }, 5000);

        });

    $('#i-message').on('keypress', function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault(); // Prevents line break on Enter
            sendMessage();
        }
    });


    function sendMessage()
    {
        var loadingText = '<i class="fa fa-circle-notch-o fa-spin"></i>';

        $('.submitBtn').prop('disabled', true).html(loadingText);

        // $('#chatMessages').html('');

        var user_id = $('#replay_user').val();

        var message = $('#i-message').val();

        var user_time = $('#user_time').val();

        $.ajax({ 
            type: 'GET',
            url: '<?=SITEURL.'user/chat/act_send.php'?>', 
            data: {
                user_id: user_id,
                message:message,
                type:'send',
                user_time:user_time
            },
            dataType: 'json',
            success: function(response) { 

                $(".btn-login").html('<div class="send-icon"></div>').prop('disabled', false);

                $('.submitBtn').prop('disabled', true).html(loadingText);
                if(response.status=='ok'){

                    $('#i-message').val('');

                    $('#typingIndicator').before(response.message);

                    $("#chatMessages").animate({
                        scrollTop: $("#chatMessages")[0].scrollHeight
                    }, 500);
                }
                else{
                    $('#chatMessages').html('<div class="alert alert-danger">'+response.message+'</div>');
                } 
            }
        });
        
          $("#chatMessages").animate({
            scrollTop: $("#chatMessages")[0].scrollHeight
        }, 500);
    }


    function recieveMessage()
    {
       
        var user_id = $('#replay_user').val();

        var user_time = $('#user_time').val();

        $.ajax({ 
            type: 'GET',
            url: '<?=SITEURL.'user/chat/act_send.php'?>', 
            data: {
                user_id: user_id,
                user_time:user_time,
                type:'recievie'
            },
            dataType: 'json',
            success: function(response) { 

                if(response.status=='ok')
                {
                    $('#user_time').val(response.user_time);

                    $('#typingIndicator').before(response.message);

                    $("#chatMessages").animate({
                        scrollTop: $("#chatMessages")[0].scrollHeight
                    }, 500);
                }
             
            }
        });
    
    }
                

</script>

</body>


</html> 
