<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

$activeTab = 'group-show';
$m_link= SITEURL.'user/group-show/';

if(isset($_SESSION["log_user_id"])){


    $log_user_id = $_SESSION['log_user_id'];

	$get_modal_user = DB::query('select * from model_user where id='.$log_user_id);

	// if(!empty($get_modal_user[0]['username'])){
	// 	$modalname = ucfirst($get_modal_user[0]['username']);
	// }else{
	// 	$modalname = ucfirst($get_modal_user[0]['name']);
	// }
	// $as_a_model = $get_modal_user[0]['as_a_model'];
	// $unique_id = $get_modal_user[0]['unique_id'];


	$usern = $_SESSION["log_user"];

	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
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

    $user_id = $userDetails['unique_id']; 

    $user_mode_id = $userDetails['id']; 

    $posts = [];

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $followQuery = "SELECT unique_model_id FROM model_follow WHERE unique_user_id = ? AND status = 'Follow'";
    $stmt = $con->prepare($followQuery);

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query failed: " . $stmt->error);
    }

    $followed_model_unique_ids = [];
    while ($row = $result->fetch_assoc()) {
        $followed_model_unique_ids[] = $row['unique_model_id'];
    }

    $followed_user_ids = [];

    $followed_user_ids[] = $userDetails['unique_id'];

    if (!empty($followed_model_unique_ids)) {
        $placeholders = implode(',', array_fill(0, count($followed_model_unique_ids), '?'));
        $types = str_repeat('s', count($followed_model_unique_ids));
        $query = "SELECT id FROM model_user WHERE unique_id IN ($placeholders)";
        $stmt = $con->prepare($query);

        if (!$stmt) {
            die("Prepare failed (fetching numeric ids): " . $con->error);
        }

        $stmt->bind_param($types, ...$followed_model_unique_ids);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $followed_user_ids[] = (int)$row['id']; 
        }
    }


    if (!empty($followed_user_ids)) {

        $placeholders = implode(',', array_fill(0, count($followed_user_ids), '?'));
        $types = str_repeat('i', count($followed_user_ids));


        $sql = "
            SELECT 
                live_posts.*, 
                model_user.name AS author_name, 
                model_user.email AS author_email,
                model_user.country,
                model_user.profile_pic,
                model_user.id AS user_id
            FROM live_posts
            JOIN model_user ON live_posts.post_author = model_user.id
            WHERE post_author IN ($placeholders)
            ORDER BY post_date DESC
        ";

        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Prepare failed (fetching posts): " . $con->error);
        }

        $stmt->bind_param($types, ...$followed_user_ids);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {

            $post_id = $row['ID'];

              // $comment_query = $con->prepare("SELECT * FROM live_comments WHERE comment_post_ID = ?");

              $comment_query = $con->prepare("
                  SELECT 
                      live_comments.*, 
                      model_user.name AS author_name, 
                      model_user.email AS author_email, 
                      model_user.profile_pic AS author_profile_pic 
                  FROM live_comments 
                  LEFT JOIN model_user ON live_comments.user_id = model_user.id 
                  WHERE live_comments.comment_post_ID = ?
              ");

              $comment_query->bind_param("i", $post_id);

              $comment_query->execute();

              $comment_result = $comment_query->get_result();

              $comments = [];
              while ($comment = $comment_result->fetch_assoc()) {
                  $comments[] = $comment;
              }

              $row['comments'] = $comments;

               $post_like = $con->prepare("
                  SELECT 
                      postlike.*, 
                      model_user.name AS author_name,
                      model_user.id AS user_id
                  FROM postlike 
                  LEFT JOIN model_user ON postlike.uid = model_user.id 
                  WHERE postlike.pid = ?
              ");

              $post_like->bind_param("i", $post_id);

              $post_like->execute();

              $like_result = $post_like->get_result();

              $likes = [];

              while ($like = $like_result->fetch_assoc()) {
                  $likes[] = $like;
              }

              $row['like'] = $likes;

              $row['like_count'] = $like_result->num_rows;

              $posts[] = $row;

        }

    }
?>

    <div class="particles" id="particles"></div>

    <div class="chat-container">
        <!-- Header -->
        <div class="chat-header">
            <div class="header-left">

                <div class="avatar-container">

                    <div class="model-avatar">

                        <div class="avatar-placeholder"><img src="<?= SITEURL . 'ajax/noimage.php?image=' . $get_modal_user[0]['profile_pic']; ?>" alt="Profile" class="w-20 h-20 rounded-full"></div>

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

        <!-- Messages -->
        <div class="chat-messages" id="chatMessages">
            <!-- User Message -->
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

     
            <div class="message user">
                <div class="message-avatar">
                    <div class="avatar-placeholder user-avatar-placeholder">U</div>
                </div>
                <div class="message-content">
                    <div class="message-text">These look amazing! Do you have any videos to share?</div>
                    <div class="timestamp">10:08 AM ✓✓</div>
                </div>
            </div>

        

            <div class="message user">
                <div class="message-avatar">
                    <div class="avatar-placeholder user-avatar-placeholder">U</div>
                </div>
                <div class="message-content">
                    <div class="message-text">I love the free content! Can I see more?</div>
                    <div class="timestamp">10:15 AM ✓✓</div>
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

        <!-- Input Area -->
        <div class="chat-input-area">
            <input type="text" class="message-input" id="messageInput" placeholder="Type a message..." onkeypress="handleKeyPress(event)">
            
            <!-- Combined Attachment Button -->
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
