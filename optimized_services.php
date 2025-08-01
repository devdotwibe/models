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
$m_id = $_GET["m_id"];
$model_data = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id =  %s ", $m_id);
if(!$model_data){
	echo '<script>window.history.back();</script>';
	die;
}else{
$model_name = $model_data['name'];
$model_ID = $model_data['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking for <?=$_GET['service']?> - Live Models</title>
    <meta name="description" content="Book your exclusive international tour experience with verified models">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
	<?php  include('includes/head.php'); ?>

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
   
</head>
<body class="min-h-screen text-white booking-form text-white socialwall-page">
	
	
	<?php if (isset($_SESSION["log_user_id"])) { ?>
 
    <?php  include('includes/side-bar.php'); ?>

    <?php  include('includes/profile_header_index.php'); ?>  
 
  <?php } else{ ?>
  
	<?php include('includes/header.php'); ?>
	
  <?php } ?>
	
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

    <!-- Services List -->
    <div id="services-list" class="space-y-3">

      <!-- Pending Service -->
      <div class="service-card fade-in-up" data-status="pending" data-type="group">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Client" class="client-avatar border-orange-400">
              <div>
                <h3 class="client-name">Alex Johnson</h3>
                <span class="service-meta text-orange-400">Group Show • Dec 20, 8:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$500</span>
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

      <!-- Pending Service -->
      <div class="service-card fade-in-up" data-status="pending" data-type="dating">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Client" class="client-avatar border-orange-400">
              <div>
                <h3 class="client-name">Michael Chen</h3>
                <span class="service-meta text-orange-400">Dating Assignment • Dec 22, 7:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$800</span>
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

      <!-- Approved Services -->
      <div class="service-card fade-in-up" data-status="approved" data-type="group">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/28.jpg" alt="Client" class="client-avatar border-green-400">
              <div>
                <h3 class="client-name">James Rodriguez</h3>
                <span class="service-meta text-pink-400">Group Show • Today, 9:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$400</span>
              <span class="status-badge badge-approved">Approved</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-primary" onclick="prepareSession('james')">Prepare Session</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
            <button class="btn btn-secondary" onclick="viewDetails(this)">Details</button>
          </div>
        </div>
      </div>

      <!-- Approved Service -->
      <div class="service-card fade-in-up" data-status="approved" data-type="dating">
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
      </div>

      <!-- Approved Service -->
      <div class="service-card fade-in-up" data-status="approved" data-type="modeling">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Client" class="client-avatar border-green-400">
              <div>
                <h3 class="client-name">David Wilson</h3>
                <span class="service-meta text-pink-400">Movie/Modeling • Tomorrow, 10:00 AM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$1,200</span>
              <span class="status-badge badge-approved">Approved</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-primary" onclick="prepareSession('david')">Prepare Session</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
            <button class="btn btn-secondary" onclick="viewDetails(this)">Details</button>
          </div>
        </div>
      </div>

      <!-- Completed Service -->
      <div class="service-card fade-in-up" data-status="completed" data-type="group">
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
      </div>

      <!-- Completed Service -->
      <div class="service-card fade-in-up" data-status="completed" data-type="dating">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/61.jpg" alt="Client" class="client-avatar border-indigo-400">
              <div>
                <h3 class="client-name">Mark Johnson</h3>
                <span class="service-meta text-pink-400">Dating Assignment • Dec 12, 7:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$800</span>
              <span class="status-badge badge-completed">Completed</span>
              <span class="rating-stars">★★★★☆</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-secondary" onclick="openReviewModal('Mark Johnson', 'Dating Assignment', '$800', true)">Edit Review</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
          </div>
        </div>
      </div>

      <!-- More completed services -->
      <div class="service-card fade-in-up" data-status="completed" data-type="modeling">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/72.jpg" alt="Client" class="client-avatar border-indigo-400">
              <div>
                <h3 class="client-name">Carlos Martinez</h3>
                <span class="service-meta text-pink-400">Modeling Session • Dec 10, 2:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$1,500</span>
              <span class="status-badge badge-completed">Completed</span>
              <span class="rating-stars">★★★★★</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-secondary" onclick="openReviewModal('Carlos Martinez', 'Modeling Session', '$1,500', true)">Edit Review</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
          </div>
        </div>
      </div>

      <div class="service-card fade-in-up" data-status="completed" data-type="group">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/84.jpg" alt="Client" class="client-avatar border-indigo-400">
              <div>
                <h3 class="client-name">Ryan Thompson</h3>
                <span class="service-meta text-pink-400">Group Show • Dec 8, 9:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$450</span>
              <span class="status-badge badge-completed">Completed</span>
              <span class="rating-stars">★★★★☆</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-secondary" onclick="openReviewModal('Ryan Thompson', 'Group Show', '$450', true)">Edit Review</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
          </div>
        </div>
      </div>

      <div class="service-card fade-in-up" data-status="completed" data-type="international">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
              <img src="https://randomuser.me/api/portraits/men/91.jpg" alt="Client" class="client-avatar border-indigo-400">
              <div>
                <h3 class="client-name">Ahmed Hassan</h3>
                <span class="service-meta text-pink-400">International Event • Dec 5, 7:00 PM</span>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-2">
              <span class="amount-display">$2,200</span>
              <span class="status-badge badge-completed">Completed</span>
              <span class="rating-stars">★★★★★</span>
            </div>
          </div>

          <div class="flex gap-2 flex-wrap">
            <button class="btn btn-secondary" onclick="openReviewModal('Ahmed Hassan', 'International Event', '$2,200', true)">Edit Review</button>
            <button class="btn btn-message" onclick="openMessage(this)">Message</button>
          </div>
        </div>
      </div>
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