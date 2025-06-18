<?php 
session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
if (isset($_SESSION['log_user_id'])) {
	
} else {
	header("Location: login.php");
}
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifications - The Live Models</title>
<meta name="description" content="Stay updated with all your notifications, requests, and interactions on The Live Models platform.">
<script src="https://cdn.tailwindcss.com"></script>

<?php include('includes/head.php'); ?>

<style>






    .heading-font {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        letter-spacing: -0.02em;
    }

    /* Premium Gradients */
    .gradient-bg {
        background: var(--primary-gradient);
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradient-shift 3s ease-in-out infinite;
    }

    @keyframes gradient-shift {
        0%, 100% { filter: hue-rotate(0deg); }
        50% { filter: hue-rotate(30deg); }
    }

    .premium-gradient {
        background: var(--premium-gold);
    }

    /* Ultra Advanced Glass Morphism */
    .glass-effect {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow:
            0 8px 32px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    .ultra-glass {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(40px);
        -webkit-backdrop-filter: blur(40px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.08),
            0 0 0 1px rgba(139, 92, 246, 0.1);
        position: relative;
    }

    .ultra-glass::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(236, 72, 153, 0.05) 100%);
        border-radius: inherit;
        z-index: -1;
    }

    /* Premium Floating Particles */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.8) 0%, transparent 70%);
        border-radius: 50%;
        animation: float-premium 12s infinite linear;
        filter: blur(0.5px);
    }

    .particle:nth-child(2n) {
        background: radial-gradient(circle, rgba(236, 72, 153, 0.6) 0%, transparent 70%);
        animation-duration: 15s;
    }

    .particle:nth-child(3n) {
        background: radial-gradient(circle, rgba(6, 182, 212, 0.7) 0%, transparent 70%);
        animation-duration: 18s;
    }

    @keyframes float-premium {
        0% {
            opacity: 0;
            transform: translateY(100vh) translateX(0px) scale(0) rotate(0deg);
        }
        10% {
            opacity: 1;
            transform: translateY(90vh) translateX(20px) scale(1) rotate(45deg);
        }
        90% {
            opacity: 1;
            transform: translateY(10vh) translateX(200px) scale(1.2) rotate(315deg);
        }
        100% {
            opacity: 0;
            transform: translateY(-10vh) translateX(300px) scale(0) rotate(360deg);
        }
    }

    /* Premium Buttons */
    .btn-primary {
        background: var(--primary-gradient);
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        border: none;
        cursor: pointer;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.875rem;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.8s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a67d8, #6b46c1);
        transform: translateY(-3px) scale(1.02);
        box-shadow:
            0 25px 50px rgba(139, 92, 246, 0.5),
            0 0 0 1px rgba(139, 92, 246, 0.4),
            0 0 30px rgba(139, 92, 246, 0.3);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateY(-3px) scale(1.02);
        box-shadow:
            0 20px 40px rgba(255, 255, 255, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981, #34d399);
        transition: all 0.4s ease;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #059669, #10b981);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #f87171);
        transition: all 0.4s ease;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
    }

    /* Premium Typography */
    .premium-text {
        background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Notification Cards */
    .notification-card {
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .notification-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
        transition: left 0.6s ease;
        z-index: 1;
    }

    .notification-card:hover::before {
        left: 100%;
    }

    .notification-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow:
            0 20px 40px rgba(139, 92, 246, 0.3),
            0 0 0 1px rgba(139, 92, 246, 0.2);
        border-color: rgba(139, 92, 246, 0.4);
    }

    /* Status Indicators */
    .status-new {
        background: linear-gradient(45deg, #3b82f6, #60a5fa);
        animation: pulse-blue 2s infinite;
    }

    .status-unread {
        background: linear-gradient(45deg, #f59e0b, #fbbf24);
        animation: pulse-yellow 2s infinite;
    }

    .status-read {
        background: rgba(107, 114, 128, 0.6);
    }

    @keyframes pulse-blue {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
        }
        50% {
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.8);
        }
    }

    @keyframes pulse-yellow {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.6);
        }
        50% {
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(245, 158, 11, 0.8);
        }
    }

    /* Premium Badges */
    .premium-badge {
        background: var(--premium-gold);
        color: #1a1a1a;
        font-weight: 700;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        animation: premium-shimmer 4s infinite;
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
    }

    @keyframes premium-shimmer {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(255, 215, 0, 0.8);
        }
    }

    /* Responsive Design */
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 1rem;
        }
    }

    /* Floating Animation */
    .floating {
        animation: floating 6s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Hover Effects */
    .hover-lift {
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(139, 92, 246, 0.2);
    }
</style>
</head>
<body class="tlm-notification min-h-screen text-white">
<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

   <?php include('includes/header.php'); ?>

     <?php /*?> <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">
            <ul class="notify">
            <?php 
              
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

      </div> <?php */ ?>
	  
	  
<main class="py-12">
    <div class="container mx-auto">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-bold heading-font gradient-text mb-6">Notifications</h1>
            <p class="text-xl text-white/70 max-w-2xl mx-auto">Stay updated with all your interactions, requests, and platform updates</p>
        </div>

        <!-- Notification Filters -->
        <div class="flex flex-wrap gap-4 mb-8 justify-center">
            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white hover:bg-white/10 transition duration-300 border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterNotifications('all')">
                All Notifications
            </button>
            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white hover:bg-white/10 transition duration-300 border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterNotifications('requests')"> 
                Service Requests
            </button>
            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white hover:bg-white/10 transition duration-300 border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterNotifications('follow')">
                Follow Requests
            </button>
            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white hover:bg-white/10 transition duration-300 border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterNotifications('tips')">
                Tips & Payments
            </button>
            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white hover:bg-white/10 transition duration-300 border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterNotifications('system')"> 
                System Updates
            </button>
        </div>

        <!-- Notifications List -->
        <div class="max-w-4xl mx-auto space-y-6">
		
		<?php
		
		$limit = 1; 
			if(isset($_GET['offset'])){
			$offset = $_GET['offset'];
			}else $offset = 0;
			
			$sqls_count = "SELECT COUNT(*) AS total FROM all_notifications WHERE receiver_id = ".$_SESSION['log_user_id'];
            $result_count = mysqli_query($con, $sqls_count);
			$row_cnt = mysqli_fetch_assoc($result_count);
			
			$sqls = "SELECT * FROM all_notifications WHERE receiver_id = ".$_SESSION['log_user_id']."  Order by notification_id DESC LIMIT $limit OFFSET $offset";

              $resultd = mysqli_query($con, $sqls);

                if (mysqli_num_rows($resultd) > 0) { 
				
				while($rowesdw = mysqli_fetch_assoc($resultd)) {
					
					$get_modal = DB::query('select name,username,profile_pic from model_user where id='.$rowesdw['sender_id']);
					if(!empty($get_modal)){
						$profilepic = $get_modal[0]['profile_pic'];
						if(!empty($get_modal[0]['username'])){
							 $modalname = $get_modal[0]['username'];
						 }else{
							 $modalname = $get_modal[0]['name'];
						 }
					}else{
						$profilepic = 'assets/images/model-gal-no-img.jpg';
						$modalname = '';
					}
		
		?>

            
            <div class="notification-card ultra-glass p-6 rounded-2xl border border-white/10 all <?php echo $rowesdw['notification_type'];  ?>">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $profilepic; ?>?w=60&h=60&fit=crop&crop=faces" alt="Emma L." class="w-12 h-12 rounded-full object-cover border-2 border-purple-500">
                        <div class="absolute top-4 left-4 status-unread w-3 h-3 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold premium-text"><?php echo ucfirst($rowesdw['notification_type']); ?> Request</h3>
                            <span class="text-sm text-white/50">15 minutes ago</span>
                        </div>
                        <p class="text-white/80 mb-4">
						<?php if($rowesdw['notification_type'] == 'follow'){ ?>
                            <strong class="text-indigo-400"><?php echo $modalname; ?>.</strong> wants to follow you and get updates about your content and availability.
                        <?php }else if($rowesdw['notification_type'] == 'requests'){ ?>
							<strong class="text-indigo-400"><?php echo $modalname; ?>.</strong> has requested a <strong class="text-pink-400">Chat & Watch</strong> session for tonight at 8 PM.
                            <span class="text-green-400 font-semibold">$150</span> for 1 hour.
						<?php }else if($rowesdw['notification_type'] == 'tips'){ ?> 
							<strong class="text-indigo-400"><?php echo $modalname; ?>.</strong> sent you a tip of <strong class="text-green-400">$50</strong> with the message:
                            <em class="text-white/60">"Amazing show last night! You're incredible! 🔥"</em>
						<?php }else if($rowesdw['notification_type'] == 'system'){ ?>
							<div class="flex items-center justify-between mb-2">
								<h3 class="text-lg font-semibold premium-text">🎉 Congratulations!</h3>
								<span class="text-sm text-white/50">1 hour ago</span>
							</div>
							<p class="text-white/80 mb-4">
								Your request has been approved! You are now a <strong class="text-green-400">verified live model</strong>.
								Start building your fanbase to earn more. Upload your videos/images now to attract more clients.
							</p>
						<?php }else{ ?>
						<strong class="text-indigo-400"><?php echo $modalname; ?>.</strong>	
						<?php } ?>
						</p>
                        <div class="flex space-x-3">
                            <button class="btn-success px-6 py-2 rounded-lg text-white font-semibold" onclick="acceptFollow('emma')">
                                ✓ Accept
                            </button>
                            <button class="btn-danger px-6 py-2 rounded-lg text-white font-semibold" onclick="declineFollow('emma')">
                                ✗ Decline
                            </button>
                            <button class="btn-secondary px-6 py-2 rounded-lg text-white font-semibold" onclick="viewProfile('emma')">
                                View Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            
			<?php } ?>
			
			<?php if($row_cnt['total'] > 1){ ?>
			
			<!-- Load More Button -->
			<div class="allonly text-center mt-12">
				<button class="btn-secondary px-8 py-4 text-white rounded-xl hover:bg-white/20 transition duration-300 text-lg font-semibold" onclick="loadMoreNotifications()">
					Load More Notifications
				</button>
			</div>
			
			<?php } ?>

				<?php } else{
					echo '<p class="not-found-model">No notifications found.</p>';
				} ?>
			
			

        </div>

        
    </div>
</main>
	  

 <?php include('includes/footer.php'); ?>
 
 
 <script>
    // Premium JavaScript Functionality
    document.addEventListener('DOMContentLoaded', function() {
        initializePremiumFeatures();
    });

    function initializePremiumFeatures() {
        // Premium Particle System
        function createPremiumParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 12 + 's';
            particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
            particle.style.opacity = Math.random() * 0.8 + 0.2;

            const colors = [
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.6)',
                'rgba(6, 182, 212, 0.7)'
            ];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;

            document.getElementById('particles').appendChild(particle);

            setTimeout(() => {
                if (particle.parentNode) {
                    particle.remove();
                }
            }, 12000);
        }

        setInterval(createPremiumParticle, 150);
    }

    // Notification Action Functions
    function acceptRequest(type, userId) {
        alert(`✅ ${type} request from ${userId} accepted! You'll be connected shortly.`);
        // Remove notification or mark as handled
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function declineRequest(type, userId) {
        alert(`❌ ${type} request from ${userId} declined.`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function acceptFollow(userId) {
        alert(`✅ Follow request from ${userId} accepted! They can now see your updates.`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function declineFollow(userId) {
        alert(`❌ Follow request from ${userId} declined.`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function acceptMeeting(userId) {
        alert(`✅ Meeting request from ${userId} accepted! Check your messages for details.`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function declineMeeting(userId) {
        alert(`❌ Meeting request from ${userId} declined.`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function negotiateMeeting(userId) {
        alert(`💬 Opening negotiation chat with ${userId}...`);
    }

    function acceptDating(userId) {
        alert(`✅ Dating assignment from ${userId} accepted!`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function declineDating(userId) {
        alert(`❌ Dating assignment from ${userId} declined.`);
        event.target.closest('.notification-card').style.opacity = '0.5';
    }

    function discussTerms(userId) {
        alert(`💬 Opening terms discussion with ${userId}...`);
    }

    function thankUser(userId) {
        alert(`💕 Thank you message sent to ${userId}!`);
    }

    function viewProfile(userId) {
        alert(`👤 Opening ${userId}'s profile...`);
    }

    function uploadContent() {
        alert(`📸 Redirecting to content upload page...`);
    }

    function setupProfile() {
        alert(`⚙️ Opening profile setup wizard...`);
    }

    function startModelJourney() {
        alert(`🚀 Starting your model journey! Welcome aboard!`);
    }

    function learnMore() {
        alert(`📚 Opening model guide and tutorials...`);
    }

    function checkStatus() {
        alert(`📋 Your application status: Under Review (2-4 days remaining)`);
    }

    function contactSupport() {
        alert(`💬 Opening support chat...`);
    }

    function filterNotifications(type) {
        //alert(`🔍 Filtering notifications by: ${type}`);
        document.querySelectorAll('.notification-card').forEach(card => {
				card.style.display = 'none';
			});
			document.querySelectorAll('.allonly').forEach(card => {
				card.style.display = 'none';
			});
		if(type == 'follow'){ 
			document.querySelectorAll('.follow').forEach(card => {
				card.style.display = 'block';
			});
		}else if(type == 'requests'){
			document.querySelectorAll('.requests').forEach(card => {
				card.style.display = 'block';
			});
		}else if(type == 'tips'){
			document.querySelectorAll('.tips').forEach(card => {
				card.style.display = 'block';
			});
		}else if(type == 'system'){
			document.querySelectorAll('.system').forEach(card => {
				card.style.display = 'block';
			});
		}else{
			document.querySelectorAll('.notification-card').forEach(card => {
				card.style.display = 'block';
			});
			document.querySelectorAll('.allonly').forEach(card => {
				card.style.display = 'block';
			});
		}
    }

    function loadMoreNotifications() {
        alert(`📥 Loading more notifications...`);
    }
</script>
 
 
 
  </body>


</html> 
