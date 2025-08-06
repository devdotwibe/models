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
    <title>Promote Advertisement - The Live Models</title>
    <meta name="description" content="Book your exclusive international tour experience with verified models">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
	<?php  include('includes/head.php'); ?>

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
   
</head>
<body class="enhanced5 optim-services socialwall-page">

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

        $model_bookings = DB::query("SELECT * FROM model_booking WHERE model_unique_id =  %s ", $model_unique_id);

        $pending_count = 0;

        $accept_count = 0;

        $completed_count = 0;

        $declined_count = 0;

        foreach($model_bookings as $item) { 

            if ($item['status'] === 'Accept') {

              $accept_count++;

            } else if ($item['status'] === 'Completed') {

                $completed_count++;

            } else if ($item['status'] === 'Decline') {

               $declined_count++;

            } else {

                $pending_count++;

            }
        }

    ?>
	
	<main class="max-w-7xl mx-auto px-4 py-5 main-content">

    <!-- PROMINENT Main Tabs -->
    <div class="main-tabs">
      <button class="tab-button active" onclick="ServiceTab('all_status',this)" data-tab="all">
        All Services
      </button>
      <button class="tab-button"  onclick="ServiceTab('pending_status',this)" data-tab="pending">
        Pending <span class="tab-count"><?php echo $pending_count ?></span>
      </button>
      <button class="tab-button" onclick="ServiceTab('approved_status',this)" data-tab="approved">
        Approved <span class="tab-count"><?php echo $accept_count ?></span>
      </button>
      <button class="tab-button" onclick="ServiceTab('completed_status',this)" data-tab="completed">
        Completed <span class="tab-count"><?php echo $completed_count ?></span>
      </button>
    </div>

    <!-- Filters -->
    <div class="filters">
      <button class="filter-btn active" data-filter="all" onclick="FilterTab('all_type',this)">All Types</button>
      <button class="filter-btn" data-filter="group" onclick="FilterTab('Group',this)" >Group Chat</button>
      <button class="filter-btn" data-filter="dating" onclick="FilterTab('International',this)">International Tour</button>
      <button class="filter-btn" data-filter="modeling" onclick="FilterTab('Luxury',this)">Luxury Companion</button>
      <button class="filter-btn" data-filter="international" onclick="FilterTab('premium-experience',this)">premium-experience</button>
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

              if($item['status'] ==='Accept') { 

                  $staus = "approved_status";
              }
              else if($item['status'] ==='Completed')
              {
                 $staus = "completed_status";
              }
              else if($item['status'] ==='Decline')
              {
                 $staus = "decline_status";
              }
              else
              {
                 $staus = "pending_status";
              }
        ?>

            <div class="service-card fade-in-up <?php echo $staus ?> <?php echo $item['booking_type'] ?> all_status all_type" data-status="pending" data-type="group">
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
                        <span class="service-meta <?php if($item['status'] ==='Accept' || $item['status'] =='Decline' ) { ?>text-pink-400 <?php } else { ?> text-orange-400 <?php } ?>  "><?php echo $item['booking_for'] ?> • <?php echo $formattedDate ?>, <?php echo $item['meeting_time'] ?></span>
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

                    <?php if(!empty($token_amount)) { ?>

                        <span class="amount-display">$<?php echo $token_amount ?></span>

                    <?php }?>

                    <?php if($item['status'] ==='Accept') { ?>

                          <span class="status-badge badge-approved">Approved</span>

                    <?php } else if($item['status'] ==='Decline') { ?>

                       <span class="status-badge badge-pending">Rejected</span>

                    <?php } else {  ?>

                        <span class="status-badge badge-pending" id="when_approved_status<?php echo $item['id'] ?>">Pending</span>

                    <?php } ?>

                    </div>
                </div>

                <div class="flex gap-2 flex-wrap">

                <?php if($item['status'] ==='Accept') { ?>
                 
                    <!-- <button class="btn btn-primary" onclick="prepareSession('robert')">Prepare Session</button>
                    <button class="btn btn-message" onclick="openMessage(this)">Message</button> -->

                  <button class="btn btn-message" data-id="<?php echo $item['id'] ?>" onclick="OpenRequest(this)">Request Complete</button>

                <?php } else if($item['status'] ==='Decline') { ?>


                <?php } else { ?>
                    
                    <button class="btn btn-success when_aprrove_button<?php echo $item['id'] ?>" data-id="<?php echo $item['id']; ?>" onclick="acceptRequest(this)">Accept</button>
                    <button class="btn btn-danger when_aprrove_button<?php echo $item['id'] ?>" data-id="<?php echo $item['id']; ?>" onclick="declineRequest(this)">Decline</button>
                    <button class="btn btn-message when_aprrove_button<?php echo $item['id'] ?>" onclick="openMessage(this)">Message</button>

                <?php }?>

                    <button class="btn btn-secondary" id="when_aprrove_button<?php echo $item['id'] ?>" data-id="<?php echo $item['id'] ?>" onclick="showBookingModal(this)">Details</button>

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

    <div class="modal-overlay" id="conform_modal">
          <div class="modal">
              <div class="modal-header">
              <h2 class="modal-title">Accept</span></h2>
              <button class="close-modal" type="button" onclick="CloseModal('conform_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
              </div>

              <div class="modal-body">

              <p>Do you want to <span id="button_status">Accept</span> </span>request</strong>?</p>

                <div style="margin-top: 20px;">

                    <input type="hidden" name="accept_id" id="accept_id" >
                    <button class="btn-primary px-7 sm:px-3 py-6  text-white" type="button" id="accept_conform_btn" onclick="AcceptConform('Accept')" >Yes, Accept</button>
                    <button class="btn btn-secondary" type="button" onclick="CloseModal('conform_modal')">Cancel</button>
                </div>

              </div>

          </div>
      </div>


      <div class="modal-overlay" id="request_modal">
          <div class="modal">
              <div class="modal-header">
              <h2 class="modal-title">Accept</span></h2>
              <button class="close-modal" type="button" onclick="CloseModal('request_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
              </div>

              <div class="modal-body">

              <p>Do you want to <span id="button_status">request to </span> </span>Complete</strong>?</p>

                <div style="margin-top: 20px;">

                    <input type="hidden" name="request_id" id="request_id" >

                    <button class="btn-primary px-7 sm:px-3 py-6  text-white" type="button" id="request_conform_btn" onclick="RequestComplete()" >Yes, Accept</button>
                    <button class="btn btn-secondary" type="button" onclick="CloseModal('request_modal')">Cancel</button>
                </div>

              </div>

          </div>
      </div>

    <div class="modal-overlay" id="success_modal">
      <div class="modal">
          <div class="modal-header">
              <h2 class="modal-title">Success</h2>
              <button class="close-modal" id="closeTipModal" type="button" onclick="CloseModal('success_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
          </div>
          <div class="modal-body" id="modal_success_message">
              

              <button class="btn btn-primary" type="button" onclick="CloseModal('success_modal')">Close</button>
          </div>
      </div>
    </div>



    <div class="modal-overlay" id="details_modal">
      <div class="modal">
          <div class="modal-header">
              <h2 class="modal-title">Booking Details</h2>
              <button class="close-modal" type="button" onclick="CloseModal('details_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
          </div>

          <div class="modal-body">

              <div class="booking-info">

                <p style="margin-top: 20px;"><strong>Your Contact Details </strong></p>

                  <p><strong>Booking Type:</strong> <span id="booking_type"></span></p>
                  <p><strong>Booking For:</strong> <span id="booking_for"></span></p>
                  <p><strong>Country:</strong> <span id="booking_country"></span></p>

              </div>

              <p style="margin-top: 20px;"><strong>Instructions </strong></p>

              <p id="booking_description" style="margin-top: 10px;"></p>

              <div class="booking-time-info">

                  <p><strong>Booking Date:</strong> <span id="booking_date"></span></p>
                  <p><strong>Booking Time:</strong> <span id="booking_time"></span></p>
<!-- 
                  <p><strong>Meeting duration:</strong><span id="booking_hour"></span></p> -->
                  
              </div>

          </div>
      </div>
  </div>

	
   <?php include('includes/footer.php'); ?>

    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   <script>

    function FilterTab(tab,element)
    {
        $('.filter-btn').removeClass('active');

        $(element).addClass('active');

        $('.all_type').hide();

        $(`.${tab}`).show();
    }

    function ServiceTab(tab,element)
    {

        $('.tab-button').removeClass('active');

        $(element).addClass('active');

        $('.all_status').hide();

        $(`.${tab}`).show();
    }

    function showBookingModal(element)
    {
        var accept_id = $(element).data('id');

         $.ajax({
            url: 'act_model_booking.php',
            type: 'POST',
            data: {
              action:'get_book_details',
              accept_id:accept_id
            },
            dataType: 'json',
            success: function (response) {
                
                if (response.status === 'success') {

                    var data = response.data;

                    $('#booking_type').text(data.booking_type);
                    $('#booking_for').text(data.booking_for);
                    $('#booking_country').text(data.country);
                    $('#booking_description').text(data.instructions);

                    $('#booking_date').text(data.meeting_date);
                    // $('#booking_hour').text(data.duration);
                    $('#booking_time').text(data.meeting_time);

                    $('#details_modal').addClass('active');
                    
                }
            },

            error: function (xhr, status, error) {
          
            }
          });

    }

    function OpenRequest(element)
    {
       var id = $(element).data('id');

       $('#request_id').val(id);

        $('#request_modal').addClass('active');

    }

    function RequestComplete()
    {
       var id = $('#request_id').val();

         $.ajax({
            url: 'act_model_booking.php',
            type: 'POST',
            data: {
              action:'complete_request',
              request_id:id,
              status:'requested',
            },
            dataType: 'json',
            success: function (response) {
                
                console.log(response);

                if (response.status === 'success') {

                    $('#modal_success_message').prepend(`<p class="success-text">${response.message}</p>`);

                    $('#request_modal').removeClass('active');

                    $('#success_modal').addClass('active');

                    setTimeout(function()
                    {
                          $('#success_modal').removeClass('active');

                    },3000);
                }
            },

            error: function (xhr, status, error) {
          
            }
          });
    }

    function acceptRequest(element)
    {
      
        var id = $(element).data('id');

        $('#conform_modal').addClass('active');

        $('#button_status').text('Accept');

        $('#accept_id').val(id);

    }

    function declineRequest(element)
    {
      
        var id = $(element).data('id');

        $('#conform_modal').addClass('active');

        $('#button_status').text('Decline');

       $('#accept_conform_btn').attr('onclick', "AcceptConform('Decline')");

        $('#accept_id').val(id);

    }

    function AcceptConform(status)
    {
        var accept_id = $('#accept_id').val();

          $.ajax({
            url: 'act_model_booking.php',
            type: 'POST',
            data: {
              action:'accept_request',
              accept_id:accept_id,
              status:status,
            },
            dataType: 'json',
            success: function (response) {
                
                console.log(response);

                if (response.status === 'success') {

                    $('#modal_success_message').prepend(`<p class="success-text">${response.message}</p>`);

                    $('#conform_modal').removeClass('active');

                    $('#success_modal').addClass('active');

                    if(response.action =='Accept')
                    {
                         $(`#when_approved_status${accept_id}`).replaceWith(`<span class="status-badge badge-approved">Approved</span>`);

                        $(`.when_aprrove_button${accept_id}`).remove();

                        $(`#when_aprrove_button${accept_id}`).before(`
                          <button class="btn btn-primary" onclick="prepareSession('robert')">Prepare Session</button>
                          <button class="btn btn-message" onclick="openMessage(this)">Message</button>
                        `);
                    }

                    setTimeout(function()
                    {
                          $('#success_modal').removeClass('active');

                    },3000);
                }
            },

            error: function (xhr, status, error) {
          
            }
          });

    }

    function CloseModal(id)
    {

       $(`#${id}`).removeClass('active');
    }







   </script>

</body>
</html>