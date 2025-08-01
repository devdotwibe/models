<?php session_start(); 

include('includes/config.php');
include('includes/helper.php');

if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);

	if(!$userDetails){
		echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
		echo "<script>window.location='".SITEURL."/login.php';</script>";
		die;
	}
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."/login.php';</script>";
	die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Live Models - Services Dashboard</title>
    <meta name="description" content="Book your exclusive international tour experience with verified models">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
	<?php  include('includes/head.php'); ?>

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
   
</head>
<body class="optim-services socialwall-page">

    <?php

        $currentUrl = $_SERVER['REQUEST_URI'];

        if (isset($_SESSION["log_user_id"])) {
            
            if ($currentUrl === "/optimized_services") {

                include('includes/side-bar.php');
                
                include('includes/service_header.php');

            } else {

                include('includes/side-bar.php');
                include('includes/profile_header_index.php');
            }

        } else {

            include('includes/header.php');
    } 
    
        $model_unique_id = $userDetails['unique_id'];

        $model_bookings = DB::query("SELECT name FROM model_booking WHERE model_unique_id =  %s ", $model_unique_id);
    ?>
	
	<main class="max-w-7xl mx-auto px-4 py-5 main-content">

    <!-- PROMINENT Main Tabs -->
    <div class="main-tabs">
      <button class="tab-button active" data-tab="all">
        All Services
      </button>
      <button class="tab-button" data-tab="pending">
        Pending <span class="tab-count">2</span>
      </button>
      <button class="tab-button" data-tab="approved">
        Approved <span class="tab-count">3</span>
      </button>
      <button class="tab-button" data-tab="completed">
        Completed <span class="tab-count">5</span>
      </button>
    </div>

    <!-- Filters -->
    <div class="filters">
      <button class="filter-btn active" data-filter="all">All Types</button>
      <button class="filter-btn" data-filter="group">Group Show</button>
      <button class="filter-btn" data-filter="dating">Dating</button>
      <button class="filter-btn" data-filter="modeling">Modeling</button>
      <button class="filter-btn" data-filter="international">International</button>
    </div>

    <div id="services-list" class="space-y-3">

    <?php if(!empty($model_bookings) && count($model_bookings) > 0) { ?>

      <?php foreach($model_bookings as $item) { 
        

            $bookeduser = DB::queryFirstRow("SELECT name FROM model_user WHERE unique_id =  %s ", $item['user_unique_id']);

            $defaultImage =SITEURL."/assets/images/girl.png";

            if($bookeduser['gender']=='Male'){

                $defaultImage =SITEURL."/assets/images/profile.jpg";
            }

            if(!empty($bookeduser['profile_pic']))
            {
                if (checkImageExists($bookeduser['profile_pic'])) {
            
                    $defaultImage = SITEURL . $bookeduser['profile_pic'];
                }
            }
        
        ?>

            <div class="service-card fade-in-up" data-status="pending" data-type="group">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                    <img src="<?php echo $defaultImage ?>" alt="Client" class="client-avatar border-orange-400">
                    <div>
                        <h3 class="client-name"><?php echo $item['name'] ?> </h3>

                        <?php 

                            $meeting_date = $item['meeting_date']; //Y-m-d format;

                            $formattedDate = date('M d', strtotime($meeting_date)); 
                        ?>
                        <span class="service-meta text-orange-400"><?php echo $item['booking_for'] ?> • <?php echo $formattedDate ?>, <?php echo $item['meeting_time'] ?></span>
                    </div>
                    </div>

                    <?php 

                    	$extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $item['user_unique_id']); 

                        $token_amount = "";

                       if( $item['service_name'] =='Group Chat')
                       {
                            $token_amount = $extra_details['group_chat_tocken'];
                       }
                       elseif( $item['service_name'] =='Overnight Social')
                       {
                             $token_amount = $extra_details['in_overnight'];
                       }
                       elseif($item['service_name'] =='Extended Social')
                       {
                             $token_amount = $extra_details['extended_rate'];
                       }
                       elseif($item['service_name'] =='Private Chat')
                       {
                             $token_amount = $extra_details['private_chat_token'];
                       }
                        elseif($item['service_name'] =='Local Meetup')
                       {
                             $token_amount = $extra_details['in_per_hour'];
                       }
                    ?>
                    <div class="flex items-center gap-3 mt-2">
                    <span class="amount-display">$<?php echo $token_amount ?></span>
                    <span class="status-badge badge-pending">Pending</span>
                    </div>
                </div>

                <div class="flex gap-2 flex-wrap">
                    <button class="btn btn-success" onclick="acceptRequest(this)">Accept</button>
                    <button class="btn btn-danger" onclick="declineRequest(this)">Decline</button>
                    <button class="btn btn-message" onclick="openMessage(this)">Message</button>
                    <button class="btn btn-secondary" onclick="viewDetails(this)">Details</button>
                </div>
                </div>
            </div>

      <?php } ?>

    <?php } ?>

 
      <!-- <div class="service-card fade-in-up" data-status="approved" data-type="dating">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Client" class="client-avatar border-green-400">
              <div>
                <h3 class="client-name">Robert Kim</h3>
                <span class="service-meta text-pink-400">Dating Assignment • Today, 6:30 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$900</span>
              <span class="status-badge badge-approved">Approved</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-primary" onclick="prepareSession('robert')">Prepare Session</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
            <button class="btn btn-secondary" onclick="viewDetails(this)">Details</button>
          </div>
        </div>
      </div> -->



      <!-- Completed Service -->

      <!-- <div class="service-card fade-in-up" data-status="completed" data-type="group">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Client" class="client-avatar border-indigo-400">
              <div>
                <h3 class="client-name">Thomas Anderson</h3>
                <span class="service-meta text-pink-400">Group Show • Dec 15, 8:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$600</span>
              <span class="status-badge badge-completed">Completed</span>
              <span class="rating-stars">★★★★★</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-secondary" onclick="openReviewModal('Thomas Anderson', 'Group Show', '$600')">Write Review</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
          </div>
        </div>
      </div> -->

   
    </div>

  </main>

  <!-- Mobile Navigation -->
  <nav class="mobile-nav md:hidden">
    <div class="mobile-nav-grid">
      <div class="mobile-nav-item active">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5 mb-1">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        <span class="text-xs font-medium">Services</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5 mb-1">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <span class="text-xs font-medium">Messages</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5 mb-1">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span class="text-xs font-medium">Profile</span>
      </div>
    </div>
  </nav>

  <!-- Notification -->
  <div id="notification" class="notification"></div>

  <!-- Review Modal -->
  <div id="reviewModal" class="modal-overlay">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title">Write Review</h3>
        <button class="modal-close" id="closeReviewModal">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p class="text-xs text-gray-300 mb-1">Client</p>
          <p class="font-semibold text-base" id="reviewClientName">Client Name</p>
        </div>
        <div class="mb-3">
          <p class="text-xs text-gray-300 mb-1">Service</p>
          <p class="font-semibold text-sm" id="reviewServiceType">Service Type</p>
        </div>
        <div class="mb-3">
          <p class="text-xs text-gray-300 mb-1">Amount</p>
          <p class="font-semibold text-yellow-400" id="reviewAmount">$0</p>
        </div>

        <div class="form-group">
          <label class="form-label">Rating</label>
          <div class="star-rating" id="starRating">
            <span class="star" data-rating="1">★</span>
            <span class="star" data-rating="2">★</span>
            <span class="star" data-rating="3">★</span>
            <span class="star" data-rating="4">★</span>
            <span class="star" data-rating="5">★</span>
          </div>
        </div>

        <div class="form-group">
          <label for="reviewText" class="form-label">Your Review</label>
          <textarea id="reviewText" class="form-control" placeholder="Write your review here..."></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Would you work with this client again?</label>
          <div class="flex gap-4 mt-2">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="workAgain" value="yes" checked class="w-4 h-4 accent-indigo-500">
              <span class="text-sm">Yes</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="workAgain" value="no" class="w-4 h-4 accent-pink-500">
              <span class="text-sm">No</span>
            </label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" id="cancelReview">Cancel</button>
        <button class="btn btn-primary" id="submitReview">Submit Review</button>
      </div>
    </div>
  </div>
	
   <?php include('includes/footer.php'); ?>

    
</body>
</html>