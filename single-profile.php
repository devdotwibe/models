<?php session_start(); 

include('includes/config.php');
include('includes/helper.php');
$error = '';
if (isset($_SESSION['log_user_unique_id'])) {
  $getUserData = get_data('model_social_link', array('unique_model_id' => $_SESSION['log_user_unique_id']), true);

 $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

  if ($getUserData) {
    if (empty($getUserData['i_username'])) {
      $error = 'empty';
    } else if (empty($getUserData['s_username'])) {
      $error = 'empty';
    }
  } else {
    $error = 'empty';
  }
} else {
  $error = 'login';

    echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
}
$showMessgeBtn = 0;
if (isset($_SESSION['log_user_unique_id']) && $_GET['m_unique_id']) {
  $showMessgeBtn = h_checkMessageShowBtn($_GET['m_unique_id'], $_SESSION['log_user_unique_id']);
}
$session_id = $_GET['m_unique_id'];

$activeTab = 'group-show';
$m_link= SITEURL.'user/group-show/';


$sql_ap = "SELECT * FROM user_all_access WHERE model_id = '" . $_GET['m_unique_id'] . "' AND user_id = '" . $_SESSION['log_user_unique_id'] . "' and status=1";
$res_ap = mysqli_query($con, $sql_ap);
if (mysqli_num_rows($res_ap) > 0) {
  $row_ap = mysqli_fetch_assoc($res_ap);
  $status = $row_ap['status'];
  $end_date = $row_ap['end_date'];

  if ($status == '1' && $end_date == date("Y-m-d") || $end_date < date("Y-m-d")) {
    $sql_us = "UPDATE `user_all_access` SET `status` = '0' WHERE model_id = '" . $_GET['m_unique_id'] . "' AND user_id = '" . $_SESSION['log_user_unique_id'] . "'";
    if (mysqli_query($con, $sql_us)) {
      echo '<script>alert("Your 30 days access has expired. please renew it.")</script>';
    }
  }

  if ($status == '1' && $end_date != date("Y-m-d") || $end_date > date("Y-m-d")) {
    echo '<script>window.location.href="single-profile-all-access.php?m_unique_id=' . $_GET['m_unique_id'] . '"</script>';
  }
}

?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Model Profile - Million Dollar Page</title>
<meta name="description" content="Connect with amazing models for chat, watch and meet experiences. The premier social dating platform for authentic connections.">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
<?php  include('includes/head.php'); ?>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script>
    function like(postid, userid) {

      if (userid == 0) {
        alert("Create Account First");
      } else {

        //alert("uid-" +userid  );

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("likebody" + postid).innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "get-like.php?q=" + postid + "&uid=" + userid, true);
        xmlhttp.send();

      }



    }
  </script>

  <script>
    function share() {
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

<body class="enhanced5 min-h-screen bg-animated text-white socialwall-page">
<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

  <?php if (isset($_SESSION["log_user_id"])) { ?>
 
    <?php  include('includes/side-bar.php'); ?>

    <?php  include('includes/profile_header_index.php'); ?>  
 
  <?php } else{ ?>
  
	<?php include('includes/header.php'); ?>
	
  <?php } ?>


  


  <?php
  $sqls = "SELECT * FROM model_user WHERE unique_id = '" . $_GET['m_unique_id'] . "'";
  $resultd = mysqli_query($con, $sqls);
  if (mysqli_num_rows($resultd) > 0) {
    $rowesdw = mysqli_fetch_assoc($resultd);
    $movel_name = $rowesdw['username'];

    $model_id =  $rowesdw['id'];

    $user_mode_id = $userDetails['id']; 

    if ($user_mode_id != $model_id) {

        $checkSql = "SELECT id FROM model_user_profile_views WHERE profile_user_id = ? AND viewer_user_id = ?";
        $stmt = $con->prepare($checkSql);
        $stmt->bind_param("ii", $model_id, $user_mode_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $stmt->close();

            $insertSql = "INSERT INTO model_user_profile_views (profile_user_id, viewer_user_id, viewed_at) VALUES (?, ?, ?)";
            $stmt = $con->prepare($insertSql);

            $currentDatetime = date('Y-m-d H:i:s');
            $stmt->bind_param("iis", $model_id, $user_mode_id, $currentDatetime);

            $stmt->execute();
            $stmt->close();
        } else {
            $stmt->close();
        }
    }



    // $sql_sl = "SELECT * FROM model_social_link WHERE unique_model_id = '".$_GET['m_unique_id']."' ";
    // $result_sl = mysqli_query($con, $sql_sl);
    //   if (mysqli_num_rows($result_sl) > 0) {
    //     $row_sl = mysqli_fetch_assoc($result_sl);
    //   }

    $sql_sl = "SELECT * FROM model_extra_details WHERE unique_model_id = '" . $_GET['m_unique_id'] . "' ";
    $result_sl = mysqli_query($con, $sql_sl);
    if (mysqli_num_rows($result_sl) > 0) {
      $row_sl = mysqli_fetch_assoc($result_sl);
    }
	
	$mDefaultImage =SITEURL."/assets/images/girl.png";
	if($rowesdw['gender']=='Male'){
		$mDefaultImage =SITEURL."/assets/images/profile.png";
	}
	if(!empty($rowesdw['profile_pic'])){
		$mDefaultImage = SITEURL.$rowesdw['profile_pic'];
	}

	$modal_img_list = DB::query('select * from model_images where unique_model_id="'.$_GET['m_unique_id'].'" AND category = "Profile" Order by id DESC');
	$modal_img_list_array = array();
	if(!empty($modal_img_list)){ 
		
		foreach($modal_img_list as $uplds){ 
					
			if(!empty($uplds['file']) && $uplds['file_type'] == 'Image'){
				$modal_img_list_array[] = SITEURL.'uploads/profile_pic/'.$uplds['file'];		
				
			}
					
		}
	}

    $model_posts =  DB::query('select * from live_posts where post_author="'.$model_id.'" Order by id DESC');

    $user_purchased_ids = DB::query('select * from user_purchased_image where user_unique_id="'.$_SESSION['log_user_unique_id'].'" AND model_unique_id="'.$_GET['m_unique_id'].'" Order by id DESC');

    $puschased_post_ids = [];

    if(!empty($user_purchased_ids) && count($user_purchased_ids) > 0)
    {
        foreach($user_purchased_ids as $pur_posts)
        {
        
            $puschased_post_ids[] = $pur_posts['file_unique_id'];
        }
    }

  ?>
    
<main>
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container mx-auto relative z-10">
            <div class="profile-info pt-32 sm:pt-40 md:pt-48 pb-6 px-4 md:px-0">
                <div class="profile-flex-wrapp flex flex-col md:flex-row items-start md:items-end gap-4 md:gap-6">
                    <div class="profile-avatar-container">
 
                            <?php
                               $profile_pic = $rowesdw['profile_pic'] ?? '';

                                if (file_exists($profile_pic) || !empty($modal_img_list_array)) {

                                  $modal_img_list_array[] = SITEURL . $profile_pic; 
								  
								  $randomKey = array_rand($modal_img_list_array);
								  $randomImage = $modal_img_list_array[$randomKey];

                              ?>

                                <img src="<?php echo $randomImage; ?>" alt="Profile Pic<?php //echo $rowesdw['name']; ?>" class="profile-avatar">

                            <?php }else{ ?>

                                <img src="<?php echo SITEURL; ?>assets/images/model-gal-no-img.jpg" alt="<?php echo $rowesdw['name']; ?>" class="profile-avatar">

                            <?php } ?>

                    </div>
                    <div class="flex-1 profile-wrapp1">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h1 class="text-3xl sm:text-4xl font-bold heading-font gradient-text mb-1"><?php echo ucfirst($rowesdw['name']); ?></h1>
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                                    <span class="text-white/70">@<?php echo $rowesdw['username']; ?></span>
                                    <span class="status-badge status-online">
                                        <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                        Online 
                                    </span>
                                </div>
								<?php 
									$country_list = DB::query('select name from countries where id="'.$rowesdw['country'].'"');
									$state_list = DB::query('select name from states where id="'.$rowesdw['state'].'"');
									$city_list = DB::query('select name from cities where id="'.$rowesdw['city'].'"');
									if(!empty($country_list) && !empty($country_list[0]['name'])){ ?>
                                <div class="flex items-center gap-2 text-white/70 mb-2 sm:mb-3 text-sm sm:text-base image-center-profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    
									<?php echo $city_list[0]['name'].', '.$state_list[0]['name'].', '.$country_list[0]['name']; ?>
									
                                </div>
								<?php } ?>
								
                                <div class="bg-purple-600/20 text-purple-300 px-3 py-1 rounded-full text-xs sm:text-sm inline-flex items-center mb-2 sm:mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                    Fashion Model
                                </div>
								
								<?php if(!empty($rowesdw['services'])){ ?>
								
                                <div class="flex items-center gap-2 text-white/80 text-sm sm:text-base">
									<?php if($rowesdw['services'] == 'Chat Only' || $rowesdw['services'] == 'Chat & Watch' || $rowesdw['services'] == 'Chat, Watch & Meet'){ ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <?php } ?>
									<?php if($rowesdw['services'] == 'Chat & Watch' || $rowesdw['services'] == 'Chat, Watch & Meet'){ ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
									<?php } ?>
									<?php if($rowesdw['services'] == 'Chat, Watch & Meet'){ ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <?php } ?>
									<?php if($rowesdw['services'] == 'Premium Experience'){ echo '👑'; } ?>
									<span class="font-medium"><?php echo $rowesdw['services']; ?></span>
                                </div>
								
								<?php } ?>
                            </div>


                            <div class="flex flex-wrap gap-2 sm:gap-3 mt-2 md:mt-0">

                                    <button class="btn-primary px-4 sm:px-6 py-2 rounded-full text-white font-semibold text-sm sm:text-base" id="openServicesBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                        Message
                                    </button>

                                <?php if (isset($_SESSION['log_user_unique_id']) && $_GET['m_unique_id'] != $_SESSION['log_user_unique_id']) { 
                                    
                                        $model_unique_id = $_GET['m_unique_id'];

                                        $user_unique_id = $_SESSION['log_user_unique_id'];

                                        $user_follow_status = checkUserFollow($model_unique_id, $user_unique_id);
                                    ?>

                                <?php if ($user_follow_status) { ?>

                                    <button   class="btn-secondary px-4 sm:px-6 py-2 rounded-full text-white font-semibold text-sm sm:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                        <span id="follow_status">Following</span>
                                    </button>

                                <?php } else { ?>

                                    <button onclick="FollowModel('<?= $model_unique_id ?>', '<?= $user_unique_id ?>')"  class="btn-secondary px-4 sm:px-6 py-2 rounded-full text-white font-semibold text-sm sm:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                        <span id="follow_status">Follow</span>
                                    </button>

                                <?php } } ?>

                                    <div class="action-dropdown" id="moreActions">

                                        <button class="btn-secondary px-3 py-2 rounded-full text-white" id="moreActionsBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </button>


                                        <div class="action-menu" bis_skin_checked="1">

                                <div class="action-item" id="aboutBtn" bis_skin_checked="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    About
                                </div>
                                <div class="action-item" id="servicesBtn" bis_skin_checked="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                    Services
                                </div>
                                <div class="action-item" id="wishlistBtn" bis_skin_checked="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                    Wishlist
                                </div>

                                
                                <?php
                                        $uniqueModelId = isset($_GET['m_unique_id']) ? $_GET['m_unique_id'] : '';
                                        if ($_SESSION["log_user_unique_id"] == $session_id) {
                                            $link = SITEURL . 'live-stream/stream.php?user=streamer&unique_model_id=' . $uniqueModelId;
                                        } else {
                                            $link = SITEURL . 'live-stream/view.php?user=viewer&unique_model_id=' . $uniqueModelId;
                                        }
                                    ?>

                                    <div class="action-item" id="liveBtn" bis_skin_checked="1" onclick="window.location.href='<?php echo $link; ?>' ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <circle cx="12" cy="12" r="4"></circle>
                                        </svg>
                                        Go Live
                                    </div>


                                <div class="action-item" id="tipBtn" bis_skin_checked="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                    Send Tip
                                </div>


                                <div class="action-item" id="giftBtn" bis_skin_checked="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                                        <path d="M12 8v13"></path>
                                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                                    </svg>
                                    Send Gift
                                </div>

                                

                                <div class="action-item" id="allLinkBtn" bis_skin_checked="1">

                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        
                                        <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                                        <path d="M12 8v13"></path>
                                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                                    </svg> -->

                                    <div class="all-link-btn">
                                        <img src="<?=SITEURL?>assets/images/all-links.svg" />
                                    </div>

                                    All my links
                                </div>



                                    </div>
                                        
                                    </div>

                                
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Bio & Stats -->
    <div class="container mx-auto py-6 sm:py-8 px-4 md:px-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <div class="md:col-span-2">
			<?php if(!empty($rowesdw['user_bio']) || !empty($rowesdw['hobbies'])){ ?>
                <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">
				<?php if(!empty($rowesdw['user_bio'])){ ?>
                    <h2 class="text-xl font-bold mb-4 premium-text">About Me</h2>
                    <p class="text-white/80 mb-4"><?php echo $rowesdw['user_bio']; ?></p>
				<?php } ?>
				<?php if(!empty($rowesdw['hobbies']) && $rowesdw['hobbies'] != 'null'){ 
				$hobbies = json_decode($rowesdw['hobbies']); 
				?>
                    <div class="flex flex-wrap gap-2 hobbies-sec">
					<?php foreach($hobbies as $hb){ ?>
					
                        <span class="bg-indigo-600/20 text-indigo-300 px-3 py-1 rounded-full text-xs sm:text-sm"><?php echo $hb; ?></span>
                        
					<?php } ?>
					
                    </div>
				<?php } ?>
                </div>
			<?php } ?>
			
			<?php 
			
			  if(!empty($model_posts) && count($model_posts ) > 0){
			
			?>

                <!-- Tabs -->
                <div class="border-b border-white/10 mb-6 sm:mb-8">
                    <div class="tabs-container flex">
                        <button type="button" onclick="TabChange(this,'all')" class="px-4 sm:px-6 py-3 font-medium tab-active whitespace-nowrap tab_menu">All Content</button>
                        <button type="button" onclick="TabChange(this,'image')" class="px-4 sm:px-6 py-3 font-medium tab-inactive whitespace-nowrap tab_menu">Photos</button>
                        <button type="button" onclick="TabChange(this,'video')" class="px-4 sm:px-6 py-3 font-medium tab-inactive whitespace-nowrap tab_menu">Videos</button>
                        <button type="button" onclick="TabChange(this,'exclusive')" class="px-4 sm:px-6 py-3 font-medium tab-inactive whitespace-nowrap tab_menu">Exclusive</button>
                    </div>
                </div>

                <!-- Media Grid -->
                <div class="media-grid">
				
				<?php foreach($model_posts as $uplds){ 

				if(!empty($uplds['post_image'])){
					
					if($uplds['post_mime_type'] == 'Image'){

                         $post_image = $uplds['post_image'];

                         if (checkImageExists($post_image)) {

                            $imageUrl = SITEURL . $post_image;
                        }

                        $blur_class="";

                        if($uplds['post_type'] =='paid' && $user_mode_id != $uplds['post_author'] && !in_array($uplds['ID'], $puschased_post_ids))
                        {
                            $imageUrl = "";

                                $blur_class="style='filter: blur(10px);'";
                        }
				?>
                    <!-- Media Item Image -->
                    <div class="media-item images_tab all_items_tab">

                        <img src="<?php echo $imageUrl ?>" <?php echo $blur_class ?> alt="<?php echo ucfirst($uplds['post_image']); ?>">


                            <div class="media-overlay">
                                <div class="flex justify-between items-center">
                                    <?php /*<div class="text-sm font-medium"><?php echo ucfirst($uplds['image_text']); ?></div> */ ?>
                                    <div class="flex items-center gap-2">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                            <span class="ml-1">48</span>
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <span class="ml-1">Tip</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <?php if($uplds['post_type'] =='paid' && $user_mode_id != $uplds['post_author'] && !in_array($uplds['ID'], $puschased_post_ids) ) {?>

                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                                        <div class="token-btn inline-flex items-center justify-center bg-gradient-to-r from-indigo-600 to-indigo-500 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-md cursor-pointer hover:from-indigo-700 hover:to-indigo-600 gap-2">

                                            <form method="post" action="file-process.php">

                                                <input type="hidden" name="file_id" value="<?php echo $uplds['ID']; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['log_user_unique_id']?>">
                                                <input type="hidden" name="coins" value="<?php echo $uplds["token"]; ?>">
                                                <input type="hidden" name="file_type" value="<?php echo $uplds['post_mime_type']; ?>">
                                                <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
                                                <input type="hidden" name="model_id" value="<?php echo $uplds['post_author']; ?>">
                                                
                                                <button class="mybtn"  type="submit" name="submit">

                                                    <i class="fas fa-database" aria-hidden="true"></i>
                                                    <span> <?php echo $uplds['token']  ?></span>
                                                </button>

                                             </form>
                                        </div>
                                    </div>

                            <?php } ?>

                    </div>
					
					<?php } else if($uplds['post_mime_type'] == 'Video'){ 
                        
                               $post_video = $uplds['post_image'];

                                if (checkImageExists($post_video)) {

                                    $videoUrl = SITEURL . $post_video;
                                }

                                $blur_class="";

                                if($uplds['post_type'] =='paid' && $user_mode_id != $uplds['post_author'] && !in_array($uplds['ID'], $puschased_post_ids) )
                                {
                                    $videoUrl = "";

                                     $blur_class="style='filter: blur(10px);'";
                                }

                            
                        ?>

                    <!-- Media Item Video -->
                    <div class="media-item videos_tab all_items_tab">
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center" <?php echo $blur_class ?> >
                            <video class="video-ci" controls  >
								<source src="<?php echo $videoUrl ?>" type="video/mp4">
							</video>
                        </div>

                            <div class="media-overlay">
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-medium">Play this!!</div>
                                    <div class="flex items-center gap-2">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                            <span class="ml-1">88</span>
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <span class="ml-1">Tip</span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                        <?php if($uplds['post_type'] =='paid' && $user_mode_id != $uplds['post_author'] && !in_array($uplds['ID'], $puschased_post_ids) ) {?>

                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                                    <div class="token-btn inline-flex items-center justify-center bg-gradient-to-r from-indigo-600 to-indigo-500 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-md cursor-pointer hover:from-indigo-700 hover:to-indigo-600 gap-2">

                                        <form method="post" action="file-process.php">

                                            <input type="hidden" name="file_id" value="<?php echo $uplds['ID']; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['log_user_unique_id']?>">
                                            <input type="hidden" name="coins" value="<?php echo $uplds["token"]; ?>">
                                            <input type="hidden" name="file_type" value="<?php echo $uplds['post_mime_type']; ?>">
                                            <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
                                            <input type="hidden" name="model_id" value="<?php echo $uplds['post_author']; ?>">
                                            
                                            <button class="mybtn"  type="submit" name="submit">

                                                <i class="fas fa-database" aria-hidden="true"></i>
                                                <span> <?php echo $uplds['token']  ?></span>
                                            </button>

                                        </form>
                                    </div>
                                </div>

                        <?php } ?>

                    </div>
					
					<?php } ?>

				<?php } } ?>
				
                </div>

				
			  <?php } ?>
				
            </div>
			
			<?php
			
			$sql_post = "SELECT COUNT(ID) FROM live_posts WHERE post_author = " . $rowesdw['id'];

            $result_post = mysqli_query($con, $sql_post);

            if (mysqli_num_rows($result_post) > 0) {

              $row_post = mysqli_fetch_assoc($result_post);

              $num_posts = $row_post['COUNT(ID)'];

            }

            $sql_img = "SELECT COUNT(file_type) FROM model_images WHERE unique_model_id = '" . $_GET['m_unique_id'] . "' AND file_type = 'Image' AND category = 'Profile' Order by id DESC";

            $result_img = mysqli_query($con, $sql_img);

            if (mysqli_num_rows($result_img) > 0) {

              $row_img = mysqli_fetch_assoc($result_img);

              $num1 = $row_img['COUNT(file_type)'];

            }



            $sql_vdo = "SELECT COUNT(file_type) FROM model_images WHERE unique_model_id = '" . $_GET['m_unique_id'] . "' AND file_type = 'Video' AND category = 'Profile' Order by id DESC";

            $result_vdo = mysqli_query($con, $sql_vdo);

            if (mysqli_num_rows($result_vdo) > 0) {

              $row_vdo = mysqli_fetch_assoc($result_vdo);

              $num2 = $row_vdo['COUNT(file_type)'];

            }



            $sql_flow = "SELECT COUNT(status) FROM model_follow WHERE unique_model_id = '" . $_GET['m_unique_id'] . "' AND status = 'Follow' Order by id DESC";

            //echo $sql_flow." sql query1"."<br>";

            $result_flow = mysqli_query($con, $sql_flow);

            if (mysqli_num_rows($result_flow) > 0) {

              $row_flow = mysqli_fetch_assoc($result_flow);

              $num3 = $row_flow['COUNT(status)'];

            }





            ?>


                <div class="md:col-span-1">
                    <!-- Stats Card -->
                    <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">
                        <h2 class="text-xl font-bold mb-4 premium-text">Status</h2>

                        <div class="post-div flex flex-wrap gap-8 text-center">
                            <div>
                                <div class="text-xl sm:text-2xl font-bold gradient-text"><?php echo $num_posts; ?></div>
                                <div class="text-xs sm:text-sm text-white/60">Total Posts</div>
                            </div>
                            <div>
                                <div class="text-xl sm:text-2xl font-bold gradient-text"><?php echo $num1; ?></div>
                                <div class="text-xs sm:text-sm text-white/60">Photos</div>
                            </div>
                            <div>
                                <div class="text-xl sm:text-2xl font-bold gradient-text"><?php echo $num2; ?></div>
                                <div class="text-xs sm:text-sm text-white/60">Videos</div>
                            </div>
                            <div>
                                <div class="text-xl sm:text-2xl font-bold gradient-text"><p style="cursor:pointer;" data-toggle="modal" data-target="#exampleModal"><?php echo $num3; ?></p></div>
                                <div class="text-xs sm:text-sm text-white/60">Followers</div>
                            </div>
                        </div>


                        


                    </div>

            <?php if (isset($_SESSION['log_user_unique_id']) && $_GET['m_unique_id'] == $_SESSION['log_user_unique_id']) { ?>

                    <form id="createPostForm"  enctype="multipart/form-data" method="post">

                        <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">

                            <h2 class="text-xl font-bold mb-4 premium-text">Create New Post</h2>

                            
                            <input type="text" name="post_title" 
                                class="w-full bg-white/5 border border-white/10 rounded-xl p-3 sm:p-4 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4 text-sm sm:text-base" 
                                placeholder="Post title">

                            <textarea name="post_content"  class="w-full bg-white/5 border border-white/10 rounded-xl p-3 sm:p-4 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4 text-sm sm:text-base" rows="3" placeholder="What's on your mind?"></textarea>

                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $rowesdw['id'] ?>">

                            <div class="flex justify-between items-center">


                                <label for="post_image" id="post_image_label" class="cursor-pointer flex items-center text-white/70 hover:text-white transition duration-300 text-sm sm:text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                    Upload

                                </label>

                                <input style="display:none;" type="file" onchange="ImageShow(this)" name="post_image" id="post_image" accept="image/*,video/*">

                                <div class="relative inline-block" style="display:none" id="filePreview_div">
                                    
                                    <img id="filePreview" src="" alt="Preview" class="w-32 h-32 object-cover mt-4 rounded-xl hidden">

                                </div>

                            <div class="file-type-section flex flex-col sm:flex-row gap-4 mt-4 file_type_sec" style="display:none;">

                                <div class="flex flex-col text-white text-sm sm:text-base file_type_sec">
                                        <label class="mb-2">File Type:</label>
                                        <div class="flex flex-col gap-2">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="file_type" value="Image" onchange="ShowPostType()" class="accent-indigo-500">
                                                <span>Image</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="file_type" value="Video" onchange="ShowPostType()" class="accent-indigo-500">
                                                <span>Video</span>
                                            </label>
                                        </div>
                                    </div>

                                <div class="flex flex-col text-white text-sm sm:text-base post_type_sec" style="display:none;">
                                        <label class="mb-2">Post Type:</label>
                                        <div class="flex flex-col gap-2">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="post_type" value="free" onchange="PostType(this)" class="accent-indigo-500">
                                                <span>Free</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="post_type" value="paid" onchange="PostType(this)" class="accent-indigo-500">
                                                <span>Paid</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="file-type-section flex flex-col sm:flex-row gap-4 mt-4 token_sec" style="display:none;">

                                <div class="flex flex-col text-white text-sm sm:text-base">

                                        <label class="mb-2">Token</label>

                                        <input type="text" oninput="TypeNumber()" name="token" placeholder="Enter token amount" class="w-full bg-white/5 border border-white/10 rounded-xl p-3 sm:p-4 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm sm:text-base">

                                    </div>

                                </div>


                                <button type="submit"  class="btn-primary px-4 sm:px-6 py-2 rounded-xl text-white font-semibold text-sm sm:text-base">
                                    Post
                                </button>
                            </div>

                        </div>
                    </form>
                    
            <?php } ?>


                    <!-- Services Card -->
                    <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">
                        <h2 class="text-xl font-bold mb-4 premium-text">My Services</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full gradient-bg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm sm:text-base">Chat</div>
                                    <div class="text-xs sm:text-sm text-white/60">Private messaging</div>
                                </div>
                            </li>


                            <?php
                                    if ($_SESSION["log_user_unique_id"] == $session_id) {
                                    } else if (isset($_SESSION['log_user_id']) && $_SESSION['log_user_id'] != '') {
                                    ?>

                                <li class="flex items-center gap-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full gradient-bg flex items-center justify-center">

                                        <form style="display:inline-block" method="post" action="<?php echo SITEURL .'live-stream/view.php?user=viewer&unique_model_id='?><?php echo isset($_GET['m_unique_id']) ? $_GET['m_unique_id'] : ''; ?>">

                                            <button type="submit" class="fancy_button" style="padding: 8px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
                                        </form>
                                        
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm sm:text-base">Watch</div>
                                        <div class="text-xs sm:text-sm text-white/60">Live streams & content</div>
                                    </div>
                                </li>

                            <?php } ?>


                            <?php
                                    if ($_SESSION["log_user_unique_id"] == $session_id) {?>
                                
                                <li class="flex items-center gap-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full gradient-bg flex items-center justify-center">

                                        <form style="display:inline-block" method="post" action="<?php echo SITEURL .'live-stream/stream.php?user=streamer&unique_model_id='?><?php echo isset($_GET['m_unique_id']) ? $_GET['m_unique_id'] : ''; ?>">

                                            <button type="submit" class="fancy_button" style="padding: 8px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
                                        </form>
                                        
                                    </div>

                                   

                                    <div>
                                        <div class="font-semibold text-sm sm:text-base">Go live</div>
                                        <div class="text-xs sm:text-sm text-white/60">Live streams & content</div>
                                    </div>
                                </li>

                            <?php } ?>
                                    
                            <li class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full gradient-bg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm sm:text-base">Meet</div>
                                    <div class="text-xs sm:text-sm text-white/60">In-person experiences</div>
                                </div>
                            </li>
                        </ul>
                        <button class="w-full btn-primary text-white font-semibold py-2 sm:py-3 rounded-xl mt-4 text-sm sm:text-base" id="viewServicesBtn">
                            View All Services
                        </button>
                    </div>

                    <!-- Similar Models Card -->

                <?php if($_GET['m_unique_id'] == $_SESSION['log_user_unique_id']) { ?>

                    <div class="ultra-glass rounded-2xl p-4 sm:p-6">
                        <h2 class="text-xl font-bold mb-4 premium-text">Similar Models</h2>
                        <div class="space-y-4">
                        
                        <?php $sqls_m = "SELECT * FROM model_user WHERE as_a_model = 'Yes' AND unique_id != '" . $_GET['m_unique_id'] . "'  Order by RAND() DESC LIMIT 3";

                        $resulmd = mysqli_query($con, $sqls_m);
                        
                        if (mysqli_num_rows($resulmd) > 0) { 
                    
                        while($rows_md = mysqli_fetch_assoc($resulmd)) {
                        
                        if(!empty($rows_md['profile_pic'])){
                            $profile_pic = SITEURL.$rows_md['profile_pic'];
                        }else{
                            $profile_pic = SITEURL.'assets/images/model-gal-no-img.jpg';
                        }
                        
                        if(!empty($rows_md['username'])){
                            $modalname = $rows_md['username'];
                        }else{
                            $modalname = $rows_md['name'];
                        }
                        
                        ?>
                            <div class="flex items-center gap-3">
                                <img src="<?php echo $profile_pic; ?>" alt="<?php echo ucfirst($modalname); ?>" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover">
                                <div class="flex-1">
                                    <div class="font-semibold text-sm sm:text-base"><?php echo ucfirst($modalname); ?>.</div>
                                    <div class="text-xs sm:text-sm text-white/60">Fashion Model</div>
                                </div>
                                <button class="btn-secondary px-2 sm:px-3 py-1 rounded-full text-xs text-white font-semibold">
                                    Follow
                                </button>
                            </div>
                            
                        <?php } } ?>
                            
                            
                        </div>
                        <button onclick="navigateTo('all-models.php')" class="w-full btn-secondary text-white font-semibold py-2 rounded-xl mt-4 text-sm sm:text-base">
                            View More
                        </button>
                    </div>

                <?php } ?>

                </div>


        </div>
    </div>
</main>



    <!-- ======================== -->


    <!-- About Modal -->
<div class="modal-overlay" id="aboutModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">About <?php echo ucfirst($rowesdw['name']); ?></h2>
            <button class="close-modal" id="closeAboutModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="about-section">
                <h3 class="about-section-title">Bio</h3>
                <?php echo $rowesdw['user_bio']; ?>
            </div>
            
            <div class="about-section">
                <h3 class="about-section-title">Model Type</h3>
                <p>Fashion Model | Commercial Model | Content Creator</p>
            </div>
            
            <div class="about-section">
                <h3 class="about-section-title">Physical Attributes</h3>
                <div class="attributes-grid">
                    <div class="attribute">
                        <div class="attribute-label">Height</div>
                        <div class="attribute-value">5'9" (175 cm)</div>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Weight</div>
                        <div class="attribute-value">125 lbs (57 kg)</div>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Hair Color</div>
                        <div class="attribute-value">Blonde</div>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Eye Color</div>
                        <div class="attribute-value">Blue</div>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Dress Size</div>
                        <div class="attribute-value">4 US</div>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Shoe Size</div>
                        <div class="attribute-value">8 US</div>
                    </div>
                </div>
            </div>
            
            <div class="about-section">
                <h3 class="about-section-title">Experience</h3>
                <p>5+ years professional modeling experience with top agencies in Los Angeles and New York. Featured in Vogue, Elle, and Cosmopolitan. Runway experience with major fashion brands during Fashion Week events.</p>
            </div>
            <?php if(!empty($country_list) && !empty($country_list[0]['name'])){ ?>
            <div class="about-section">
                <h3 class="about-section-title">Location</h3>
                <p><?php echo $city_list[0]['name'].', '.$state_list[0]['name'].', '.$country_list[0]['name']; ?></p>
            </div>
			<?php } ?>
        </div>
    </div>
</div>

<!-- Services Modal -->
<div class="modal-overlay" id="servicesModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Premium Services</h2>
            <button class="close-modal" id="closeServicesModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
		
		<?php 
		//$serv_chats = DB::queryFirstRow('select * from model_service_chat where model_unique_id="'.$_GET['m_unique_id'].'"');
		//$serv_meets = DB::queryFirstRow('select * from model_service_meet where model_unique_id="'.$_GET['m_unique_id'].'"');
		$extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $_GET['m_unique_id']);
		?>
        
        <div class="modal-body">
		<?php if(!empty($extra_details) && !empty($extra_details['live_cam']) && $extra_details['live_cam'] == 'Yes'){ ?>
            <div class="about-section">
                <h3 class="about-section-title">Chat Services</h3>
                <div class="attributes-grid">
				<?php if($extra_details['group_chat_tocken']){ ?>
                    <div class="attribute">
                        <div class="attribute-label">Group Chat</div>
                        <div class="attribute-value">$50/hr</div>
						<div class="attribute-value">Tokens <?php echo $extra_details['group_chat_tocken']; ?>/min </div>
                        <p>Exclusive private chat sessions where we can discuss anything you'd like.</p>
                        <a class="btn btn-primary" href='<?=SITEURL?>booking.php?type=chat&service=Group Chat&m_id=<?php echo $_GET["m_unique_id"]; ?>' >Book Now</a>
                    </div>
				<?php } ?>
				<?php if($extra_details['private_chat_token']){ ?>
                    <div class="attribute">
                        <div class="attribute-label">Private Chat</div>
                        <div class="attribute-value">$25/day</div>
						<div class="attribute-value">Tokens <?php echo $extra_details['private_chat_token']; ?>/min </div>
                        <p>Priority responses to your messages throughout the day.</p>
                        <a class="btn btn-primary" href='<?=SITEURL?>booking.php?type=chat&service=Private Chat&m_id=<?php echo $_GET["m_unique_id"]; ?>' >Book Now</a>
                    </div>
				<?php } ?>
                </div>
            </div>
		<?php } ?>
            
            <?php /*?><div class="about-section">
                <h3 class="about-section-title">Watch/Stream Services</h3>
                <div class="attributes-grid">
                    <div class="attribute">
                        <div class="attribute-label">Live Video Stream</div>
                        <div class="attribute-value">$100</div>
                        <p>Private live stream just for you.</p>
                        <button class="btn btn-primary">Watch Now</button>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Group Interactive Stream</div>
                        <div class="attribute-value">$30</div>
                        <p>Join my exclusive group streams with interactive features.</p>
                        <button class="btn btn-primary">Join Now</button>
                    </div>
                </div>
            </div> <?php */  ?>
            <?php if(!empty($extra_details) && !empty($extra_details['work_escort']) && $extra_details['work_escort'] == 'Yes'){ ?>
            <div class="about-section">
                <h3 class="about-section-title">Meet Services</h3>
                <div class="attributes-grid">
				<?php if($extra_details['in_per_hour']){ ?>
                    <div class="attribute">
                        <div class="attribute-label">Local Meetup</div>
						<div class="attribute-value">Tokens <?php echo $extra_details['in_per_hour']; ?>/hr </div>
                        <p>Enjoy a personalized date experience.</p>
                        <a class="btn btn-primary" href='<?=SITEURL?>booking.php?type=meet&service=Local Meetup&m_id=<?php echo $_GET["m_unique_id"]; ?>' >Book Now</a>
                    </div>
				<?php } ?>
				<?php if($extra_details['extended_rate']){ ?>
                    <div class="attribute">
                        <div class="attribute-label">Extended Social</div>
                        <div class="attribute-value">Tokens <?php echo $extra_details['extended_rate']; ?>/hr </div>
                        <p>Enjoy a personalized date experience.</p>
                        <a class="btn btn-primary" href='<?=SITEURL?>booking.php?type=meet&service=Extended Social&m_id=<?php echo $_GET["m_unique_id"]; ?>' >Book Now</a>
                    </div>
				<?php } ?>
				<?php if($extra_details['in_overnight']){ ?>
                    <div class="attribute">
                        <div class="attribute-label">Overnight Social</div>
                        <div class="attribute-value">Tokens <?php echo $extra_details['in_overnight']; ?>/hr </div>
                        <p>Enjoy a personalized date experience.</p>
                        <a class="btn btn-primary" href='<?=SITEURL?>booking.php?type=meet&service=Overnight Social&m_id=<?php echo $_GET["m_unique_id"]; ?>' >Book Now</a>
                    </div>
				<?php } ?>
                </div>
            </div>
			<?php } ?>
        </div>
    </div>
</div>

<!-- Subscription Modal -->
<div class="modal-overlay" id="subscriptionModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Subscription Plans</h2>
            <button class="close-modal" id="closeSubscriptionModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="about-section">



                <div class="attribute mod-rel1">
                    <div class="attribute-label">Basic</div>

                    <div class="attribute-value">$9.99/mo</div>

                    <ul>

                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Access to all free content</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Direct messaging</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>100 tokens monthly</span>
                        </li>

                    </ul>
                    <button class="btn btn-primary">Subscribe</button>
                </div>



                
                <div class="attribute mod-rel2">
                    
                    <div class="mod-inner-rel">POPULAR</div>
                    <div class="attribute-label">Premium</div>
                    <div class="attribute-value">$24.99/mo</div>


                    <ul>

                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>All Basic features</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Access to exclusive content</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>300 tokens monthly</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Weekly exclusive live streams</span>
                        </li>
                    </ul>


                    <button class="">Subscribe</button>
                </div>
                
                <div class="attribute mod-rel3">
                    <div class="attribute-label">VIP</div>
                    <div class="attribute-value">$49.99/mo</div>


                    <ul>


                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>All Premium features</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>1-on-1 video calls (30 min monthly)</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>750 tokens monthly</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Early access to all new content</span>
                        </li>

                        
                    </ul>


                    <button class="btn btn-primary">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gift Modal -->
<div class="modal-overlay" id="giftModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Send a Gift</h2>
            <button class="close-modal" id="closeGiftModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="gift-grid">
                <div class="gift-item">
                    <div class="gift-emoji">🌹</div>
                    <div class="gift-name">Rose</div>
                    <div class="gift-price">$5</div>
                </div>
                <div class="gift-item">
                    <div class="gift-emoji">❤️</div>
                    <div class="gift-name">Heart</div>
                    <div class="gift-price">$10</div>
                </div>
                <div class="gift-item">
                    <div class="gift-emoji">👑</div>
                    <div class="gift-name">Crown</div>
                    <div class="gift-price">$25</div>
                </div>
                <div class="gift-item">
                    <div class="gift-emoji">💎</div>
                    <div class="gift-name">Diamond</div>
                    <div class="gift-price">$50</div>
                </div>
                <div class="gift-item">
                    <div class="gift-emoji">🚀</div>
                    <div class="gift-name">Rocket</div>
                    <div class="gift-price">$75</div>
                </div>
                <div class="gift-item">
                    <div class="gift-emoji">🔥</div>
                    <div class="gift-name">Fire</div>
                    <div class="gift-price">$15</div>
                </div>
            </div>
            
            <textarea class="gift-message" placeholder="Add a personal message (optional)"></textarea>
            
            <button class="btn btn-primary">Send Gift</button>
        </div>
    </div>
</div>

<!-- Tip Modal -->
<div class="modal-overlay" id="tipModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Send a Tip</h2>
            <button class="close-modal" id="closeTipModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="tip-options">
                <div class="tip-option">
                    <div class="tip-amount">$10</div>
                    <div class="tip-label">Coffee</div>
                </div>
                <div class="tip-option">
                    <div class="tip-amount">$25</div>
                    <div class="tip-label">Lunch</div>
                </div>
                <div class="tip-option">
                    <div class="tip-amount">$50</div>
                    <div class="tip-label">Dinner</div>
                </div>
                <div class="tip-option">
                    <div class="tip-amount">$100</div>
                    <div class="tip-label">VIP</div>
                </div>
            </div>
            
            <div class="custom-tip">
                <span>$</span>
                <input type="number" class="custom-tip-input" placeholder="Custom amount" min="1">
            </div>
            
            <textarea class="gift-message" placeholder="Add a personal message (optional)"></textarea>
            
            <button class="btn btn-primary">Send Tip</button>
        </div>
    </div>
</div>

<!-- Wishlist Modal -->
<div class="modal-overlay" id="wishlistModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">My Wishlist</h2>
            <button class="close-modal" id="closeWishlistModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="wishlist-item">
                <img src="https://images.unsplash.com/photo-1575695342320-d2d2d2f9b73f?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80" alt="Luxury Handbag" class="wishlist-image">
                <div class="wishlist-info">
                    <div class="wishlist-name">Luxury Designer Handbag</div>
                    <div class="wishlist-price">$1,200</div>
                    <div class="wishlist-progress">
                        <div class="wishlist-progress-bar w-[65%]"></div>
                    </div>
                    <div class="wishlist-progress-text">
                        <span>$780 raised</span>
                        <span>65%</span>
                    </div>
                    <button class="btn btn-primary">Contribute</button>
                </div>
            </div>
            
            <div class="wishlist-item">
                <img src="https://images.unsplash.com/photo-1581338834647-b0fb40704e21?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80" alt="Vacation" class="wishlist-image">
                <div class="wishlist-info">
                    <div class="wishlist-name">Weekend Getaway to Malibu</div>
                    <div class="wishlist-price">$800</div>
                    <div class="wishlist-progress">
                        <div class="wishlist-progress-bar w-[40%]"></div>
                    </div>
                    <div class="wishlist-progress-text">
                        <span>$320 raised</span>
                        <span>40%</span>
                    </div>
                    <button class="btn btn-primary">Contribute</button>
                </div>
            </div>
            
            <div class="wishlist-item">
                <img src="https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80" alt="Camera" class="wishlist-image">
                <div class="wishlist-info">
                    <div class="wishlist-name">Professional Camera Setup</div>
                    <div class="wishlist-price">$2,500</div>
                    <div class="wishlist-progress">
                        <div class="wishlist-progress-bar w-[25%]"></div>
                    </div>
                    <div class="wishlist-progress-text">
                        <span>$625 raised</span>
                        <span>25%</span>
                    </div>
                    <button class="btn btn-primary">Contribute</button>
                </div>
            </div>
            
            <button class="btn btn-secondary mb-[20px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add New Wishlist Item
            </button>
        </div>
    </div>
</div>


 <div class="modal-overlay" id="allLinkModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">All My Links</h2>
            <button class="close-modal" id="closeAllLinkModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="modal-body">
           
        <?php $sql_sc = "SELECT * FROM model_social_link WHERE unique_model_id = '" . $_GET['m_unique_id'] . "' AND  public='yes'";
			  $res_sc = mysqli_query($con, $sql_sc);  
		?>
            
            <div class="wishlist-item">


                <div class="all-linkdiv">
				
				<?php 
				
				if (mysqli_num_rows($res_sc) > 0) { 
                    
                        while($rows_sc = mysqli_fetch_assoc($res_sc)) {
							
						if(!empty($rows_sc['URL'])){
							
							if($rows_sc['platform'] == 'Instagram'){
								$sc_image = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>';
							}else if($rows_sc['platform'] == 'Twitter'){
								$sc_image = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
              </svg>';
							}else if($rows_sc['platform'] == 'TikTok'){
								$sc_image = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-.88-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
              </svg>';
							} else if($rows_sc['platform'] == 'OnlyFans'){
								$sc_image = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
              </svg>';
							} else if($rows_sc['platform'] == 'Snapchat'){
								$sc_image = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.748-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-12C24.007 5.367 18.641.001 12.017.001z"/>
              </svg>';
							} else{
								$sc_image = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
				</svg>';
							}
							
	$user_purchased_sids = DB::query('select * from user_purchased_social where user_unique_id="'.$_SESSION['log_user_unique_id'].'" AND model_unique_id="'.$_GET['m_unique_id'].'" Order by id DESC');

    $puschased_sc_ids = [];

    if(!empty($user_purchased_sids) && count($user_purchased_sids) > 0)
    {
        foreach($user_purchased_sids as $pur_posts)
        {
        
            $puschased_sc_ids[] = $pur_posts['social_id'];
        }
    }  
						
						$blur_class= '';	
						if($rows_sc['status'] == 'paid' && $_SESSION['log_user_unique_id'] != $rows_sc['unique_model_id'] && !in_array($rows_sc['id'], $puschased_sc_ids)){ 
							$blur_class="style='filter: blur(10px);'";
							
						}	
							
							
				?>

                    <div class="ss-icons ssicons_<?php echo $rows_sc['id']; ?>">
                        <a <?php echo $blur_class; ?> <?php if(empty($blur_class)){ ?>href="<?=$rows_sc['URL']?>"<?php } ?> target="_blank" 
						alt="<?php echo $rows_sc['platform']; ?>" title="<?php echo $rows_sc['platform']; ?>" >
						<?php if(!empty($blur_class)){ ?>
						<button class="social-paid-btn socialpaidbtn socl_<?php echo $rows_sc['id']; ?>" 
						id="<?php echo $rows_sc['id']; ?>" 
						tokens="<?php echo $rows_sc["tokens"]; ?>" 
						platform="<?php echo $rows_sc['platform']; ?>" 
						m_unique_id="<?php echo $_GET['m_unique_id']; ?>" 
						model_id = "<?php echo $rows_sc['unique_model_id']; ?>"
						type="button"   >

                                                    <i class="fas fa-database" aria-hidden="true"></i>
                                                    <span> <?php echo $rows_sc['tokens']  ?></span>
                                                </button>
						<?php } ?>
						<?=$sc_image?>
						</a>
                    </div>
					
						<?php } }
						
				} else echo 'No social links found.'; ?>
					
                </div>
               
                
            </div>
            
           

        </div>
    </div>
</div> 

<!-- Services Popup -->


 <div id="servicesPopup" class="service-popup">

    <div class="service-content">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl sm:text-2xl font-bold premium-text">Services</h3>
            <button id="closeServicesBtn" class="text-white/70 hover:text-white transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="space-y-6">
         
            <div>
                <h4 class="text-lg sm:text-xl font-bold gradient-text mb-4">💬 Chat</h4>
                <div class="space-y-4">
                    <div class="service-item">
                        <div class="flex justify-between items-start mb-2">

                            <h5 class="text-base sm:text-lg font-semibold">1-on-1 Chat Session</h5>
                            <span class="bg-indigo-600/20 text-indigo-300 px"></span>


                        </div>

                    </div>

                </div>

            </div>
        </div>


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

                      <a href="">

                        <table style="color: white;">

                          <tr>

                            <td style="padding: 10px;">



                              <?php


                              $query = "SELECT * from model_follow where unique_model_id ='" . $_GET['m_unique_id'] . "' AND status = 'Follow' ";

                              $resultd = mysqli_query($con, $query);

                              while ($row = mysqli_fetch_assoc($resultd)) {



                                if (isset($row)) {

                                  $query1 = "SELECT * from model_user where unique_id ='" . $row['unique_user_id'] . "'";



                                  //echo $query;

                                  $resultd1 = mysqli_query($con, $query1);

                                  while ($row1 = mysqli_fetch_assoc($resultd1)) {



                                    if (isset($row1)) {

                                      echo $row1['name'] . "<br><br>";

                                    }

                                  }

                                }

                              }



                              ?>


                            </td>

                          </tr>

                        </table>

                      </a>

                    </div>

                  </div>

                </div>

              </div>

            </div>
	
	
  <?php
  } else {
    echo "No Record Found";
  }
  ?>
  
  
  
  
  <?php include('includes/footer.php'); ?>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
jQuery('.socialpaidbtn').click(function(e){
	var id= jQuery(this).attr('id');
	var tokens = jQuery(this).attr('tokens');
	var platform= jQuery(this).attr('platform');
	var m_unique_id = jQuery(this).attr('m_unique_id');
	var model_id = jQuery(this).attr('model_id');
	
	<?php if(isset($_SESSION["log_user_id"])){ ?>
	if (!confirm("Are you Sure want to buy it?")) {
        e.preventDefault(); // stops the action (e.g. link navigation)
    }else{
	jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'social-process.php'?>",
				data:{id:id,tokens:tokens,platform:platform,m_unique_id:m_unique_id,model_id:model_id,},
				dataType:'json',
				success: function(response){ 
					if(response.msg == 'loginerror'){
						alert('Please login');
						window.location='login.php'
					}else if(response.msg == 'modelerror'){
						alert('There is no model!!');
						window.location='single-profile.php?m_unique_id=<?php echo $_GET['m_unique_id']; ?>';
					}else if(response.msg == 'sufficianterror'){
						alert('You dont have sufficiant coins in your wallet for buying it.');
						window.location='single-profile.php?m_unique_id=<?php echo $_GET['m_unique_id']; ?>';
					}else if(response.msg == 'success'){
						alert('Social link added successfully in your account.');
						window.location='single-profile.php?m_unique_id=<?php echo $_GET['m_unique_id']; ?>';
					}

				}
			});
	}
	<?php } else{ ?>
		alert('Please login');
		window.location='login.php'
	<?php } ?>
});
</script>

    <script>

        function TabChange(el,type)
        {
            $('.tab_menu').removeClass('tab-active');

            $('.tab_menu').addClass('tab-inactive');

            $(el).addClass('tab-active');

            $('.all_items_tab').hide();

            if(type =='all')
            {
                $('.all_items_tab').show();
            }
            else if(type =='image')
            {
                $('.images_tab').show();
            }
            else if(type == 'video')
            {
                $('.videos_tab').show();
            }
        }

        function ImageShow(input) {

            console.log('file upalod start');

            const file = input.files[0];

            const preview = document.getElementById('filePreview');
            const fileType = file.type;

            if (!file) {
                preview.style.display = 'none';
                return;
            }

            if (fileType.startsWith('image/')) {

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);

            } else if (fileType.startsWith('video/')) {

                preview.src = 'https://thumbs.dreamstime.com/b/video-file-icon-364440376.jpg';
                preview.style.display = 'block';
            } else {

                preview.style.display = 'none';
            }

            $('#filePreview').after(`<button class="remove-btn absolute top-0 right-0" onclick="removePreview(this)">×</button>`);

            $('#filePreview_div').show();

            $('.file_type_sec').show();

            $('#post_image_label').hide();
            
        }

        function TypeNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
        }
        function PostType(el)
        {
            var value = $(el).val();

            if(value =='paid')
            {
                $('.token_sec').show();
            }
            else
            {
                 $('.token_sec').hide();
            }
        }

        function ShowPostType()
        {
             $('.post_type_sec').show();

        }

        function removePreview(el)
        {
            $(el).remove();

            $('#filePreview').attr('src',"");

            $('#filePreview_div').hide();

            $('.file_type_sec').hide();

            $('.post_type_sec').hide();

            $('#post_image_label').show();

            $('.token_sec').hide();
        }


        $(document).ready(function () {

            $('#createPostForm').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this); 

                $.ajax({
                    url: 'user/profile/savepost.php', 
                    type: 'POST',
                    data: formData,
                    contentType: false, 
                    processData: false, 
                    success: function (response) {
           
                        console.log(response);

                       if (response.trim() === 'success') {
                                   
                            alert("Post submitted successfully!");
                            $('#createPostForm')[0].reset();

                            $('#filePreview').attr('src',"");

                            $('#filePreview_div').hide();

                            $('.file_type_sec').hide();

                            $('.post_type_sec').hide();

                            $('#post_image_label').show();

                            $('.token_sec').hide();

                            window.location.reload();

                        }
                        else
                        {
                            alert(response);
                        }
                    },
                    error: function (xhr) {
                        alert("An error occurred while submitting the post.");
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function FollowModel(model_id,user_id)
        {

            $.ajax({
                url: 'follow_model.php', 
                type: 'POST',
                data:{
                    model_id: model_id,
                    user_id: user_id
                },
                success: function (response) {
        
                    $('#follow_status').text('Following');
                    $('#follow_status').removeClass('bg-gray-500').addClass('bg-blue-500');
               
                },
                error: function (xhr) {
                  
                }
            });

        }

        // Initialize Modal Functions
   document.addEventListener('DOMContentLoaded', function() {
    // More Actions Dropdown
    const moreActionsBtn = document.getElementById('moreActionsBtn');
    const moreActions = document.getElementById('moreActions');
    
    if (moreActionsBtn && moreActions) {
        moreActionsBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            moreActions.classList.toggle('active');
        });
        
        document.addEventListener('click', function(e) {
            if (!moreActions.contains(e.target)) {
                moreActions.classList.remove('active');
            }
        });
    }
    
    // Modal Functions
    function openModal(modalId) {
        const modalOverlay = document.getElementById(modalId);
        if (modalOverlay) {
            modalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeModal(modalId) {
        const modalOverlay = document.getElementById(modalId);
        if (modalOverlay) {
            modalOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
    
    // About Modal
    const aboutBtn = document.getElementById('aboutBtn');
    const closeAboutModal = document.getElementById('closeAboutModal');
    
    if (aboutBtn) {
        aboutBtn.addEventListener('click', function() {
            openModal('aboutModalOverlay');
            moreActions.classList.remove('active');
        });
    }
    
    if (closeAboutModal) {
        closeAboutModal.addEventListener('click', function() {
            closeModal('aboutModalOverlay');
        });
    }
    
    // Services Modal
    const servicesBtn = document.getElementById('servicesBtn');
    const closeServicesModal = document.getElementById('closeServicesModal');
    
    if (servicesBtn) {
        servicesBtn.addEventListener('click', function() {
            openModal('servicesModalOverlay');
            moreActions.classList.remove('active');
        });
    }
    
    if (closeServicesModal) {
        closeServicesModal.addEventListener('click', function() {
            closeModal('servicesModalOverlay');
        });
    }
    
    // Subscription Modal
    const subscribeBtn = document.getElementById('subscribeBtn');
    const closeSubscriptionModal = document.getElementById('closeSubscriptionModal');
    
    if (subscribeBtn) {
        subscribeBtn.addEventListener('click', function() {
            openModal('subscriptionModalOverlay');
        });
    }
    
    if (closeSubscriptionModal) {
        closeSubscriptionModal.addEventListener('click', function() {
            closeModal('subscriptionModalOverlay');
        });
    }
    
    // Gift Modal
    const giftBtn = document.getElementById('giftBtn');
    const closeGiftModal = document.getElementById('closeGiftModal');
    
    if (giftBtn) {
        giftBtn.addEventListener('click', function() {
            openModal('giftModalOverlay');
            moreActions.classList.remove('active');
        });
    }
    
    if (closeGiftModal) {
        closeGiftModal.addEventListener('click', function() {
            closeModal('giftModalOverlay');
        });
    }
    
    // Tip Modal
    const tipBtn = document.getElementById('tipBtn');
    const closeTipModal = document.getElementById('closeTipModal');
    
    if (tipBtn) {
        tipBtn.addEventListener('click', function() {
            openModal('tipModalOverlay');
            moreActions.classList.remove('active');
        });
    }
    
    if (closeTipModal) {
        closeTipModal.addEventListener('click', function() {
            closeModal('tipModalOverlay');
        });
    }
    
    // Wishlist Modal
    const wishlistBtn = document.getElementById('wishlistBtn');
    const closeWishlistModal = document.getElementById('closeWishlistModal');
    
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            openModal('wishlistModalOverlay');
            moreActions.classList.remove('active');
        });
    }
    
    if (closeWishlistModal) {
        closeWishlistModal.addEventListener('click', function() {
            closeModal('wishlistModalOverlay');
        });
    }


   


    // Wishlist Modal
    const allLinkBtn = document.getElementById('allLinkBtn');
    const closeAllLinkModal = document.getElementById('closeAllLinkModal');
    
    if (allLinkBtn) {
        allLinkBtn.addEventListener('click', function() {
            openModal('allLinkModalOverlay');
            moreActions.classList.remove('active');
        });
    }
    
    if (closeAllLinkModal) {
        closeAllLinkModal.addEventListener('click', function() {
            closeModal('allLinkModalOverlay');
        });
    }








    
    // Close modals when clicking outside
    const modalOverlays = document.querySelectorAll('.modal-overlay');
    modalOverlays.forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
  
    });








    
    // Initialize Tabs
    const tabs = document.querySelectorAll('.tab');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Here you would typically show/hide content based on the selected tab
            const tabType = this.getAttribute('data-tab');
            console.log(`Selected tab: ${tabType}`);
        });
    });








    
    
    // Initialize Gift Items
    const giftItems = document.querySelectorAll('.gift-item');
    
    giftItems.forEach(item => {
        item.addEventListener('click', function() {
            giftItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Initialize Tip Options
    const tipOptions = document.querySelectorAll('.tip-option');
    
    tipOptions.forEach(option => {
        option.addEventListener('click', function() {
            tipOptions.forEach(o => o.classList.remove('active'));
            this.classList.add('active');
        });
    });





    
    // Initialize Follow Button
    const followBtn = document.getElementById('followBtn');
    let isFollowing = false;
    
    if (followBtn) {
        followBtn.addEventListener('click', function() {
            if (isFollowing) {
                followBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    Follow
                `;
            } else {
                followBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    Unfollow
                `;
            }
            
            isFollowing = !isFollowing;
        });
    }
    
    // Initialize Unlock Buttons
    const unlockBtns = document.querySelectorAll('.unlock-btn');
    
    unlockBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const contentItem = this.closest('.content-item');
            const tokenOverlay = contentItem.querySelector('.token-overlay');
            const tokens = tokenOverlay.textContent.split(' ')[0];
            
            const confirmed = confirm(`Do you want to unlock this content for ${tokens} tokens?`);
            if (confirmed) {
                alert(`Content unlocked successfully! ${tokens} tokens have been deducted from your account.`);
                
                // Remove blur and unlock button
                contentItem.classList.remove('paid-content');
                this.style.display = 'none';
                tokenOverlay.style.display = 'none';
            }
        });
    });
    
    // Initialize Post Type Radio Buttons
    const postTypeRadios = document.querySelectorAll('input[name="post-type"]');
    const tokenInput = document.getElementById('tokenInput');
    
    if (tokenInput) {
        tokenInput.disabled = true;
    }
    
    postTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'paid' && tokenInput) {
                tokenInput.disabled = false;
                tokenInput.focus();
            } else if (tokenInput) {
                tokenInput.disabled = true;
            }
        });
    });
});
    </script>

  
</body>

</html>