<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

$activeTab = 'group-show';
$m_link= SITEURL.'user/group-show/';

if(isset($_SESSION["log_user_id"])){

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
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Model Profile - Million Dollar Page</title>
<meta name="description" content="Connect with amazing models for chat, watch and meet experiences. The premier social dating platform for authentic connections.">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />

</head>

<body class="enhanced5 min-h-screen bg-animated text-white">


 <?php  include('../../includes/profile_header.php'); ?>


<main>
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container mx-auto relative z-10">
            <div class="profile-info pt-32 sm:pt-40 md:pt-48 pb-6 px-4 md:px-0">
                <div class="flex flex-col md:flex-row items-start md:items-end gap-4 md:gap-6">
                    <div class="profile-avatar-container">
                        <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $userDetails['profile_pic']; ?>" alt="Urdevilicifer" class="profile-avatar">
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h1 class="text-3xl sm:text-4xl font-bold heading-font gradient-text mb-1"><?php echo $userDetails['name'] ?></h1>
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                                    <span class="text-white/70">@devil</span>
                                    <span class="status-badge status-online">
                                        <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                        Online
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 text-white/70 mb-2 sm:mb-3 text-sm sm:text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    <?php echo $userDetails['country'] ?> <?php echo $userDetails['name'] ?>
                                </div>
                                <div class="bg-purple-600/20 text-purple-300 px-3 py-1 rounded-full text-xs sm:text-sm inline-flex items-center mb-2 sm:mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                    Fashion Model
                                </div>
                                <div class="flex items-center gap-2 text-white/80 text-sm sm:text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <span class="font-medium">Chat, Watch & Meet</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 sm:gap-3 mt-2 md:mt-0">
                                <button class="btn-primary px-4 sm:px-6 py-2 rounded-full text-white font-semibold text-sm sm:text-base" id="openServicesBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    Message
                                </button>
                                <button class="btn-secondary px-4 sm:px-6 py-2 rounded-full text-white font-semibold text-sm sm:text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                    Follow
                                </button>


                                

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
                            <div class="action-item" id="liveBtn" bis_skin_checked="1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="4"></circle>
                                </svg>
                                On Live
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
                                    <img src="./assets/images/all-links.svg" />
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
                <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">
                    <h2 class="text-xl font-bold mb-4 premium-text">About Me</h2>
                    <p class="text-white/80 mb-4">Professional fashion model with 5+ years of experience. Available for photoshoots, runway shows, and brand collaborations. Let's create something beautiful together!</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-indigo-600/20 text-indigo-300 px-3 py-1 rounded-full text-xs sm:text-sm">#fashion</span>
                        <span class="bg-indigo-600/20 text-indigo-300 px-3 py-1 rounded-full text-xs sm:text-sm">#model</span>
                        <span class="bg-indigo-600/20 text-indigo-300 px-3 py-1 rounded-full text-xs sm:text-sm">#photoshoot</span>
                        <span class="bg-indigo-600/20 text-indigo-300 px-3 py-1 rounded-full text-xs sm:text-sm">#runway</span>
                        <span class="bg-indigo-600/20 text-indigo-300 px-3 py-1 rounded-full text-xs sm:text-sm">#losangeles</span>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="border-b border-white/10 mb-6 sm:mb-8">
                    <div class="tabs-container flex">
                        <button class="px-4 sm:px-6 py-3 font-medium tab-active whitespace-nowrap">All Content</button>
                        <button class="px-4 sm:px-6 py-3 font-medium tab-inactive whitespace-nowrap">Photos</button>
                        <button class="px-4 sm:px-6 py-3 font-medium tab-inactive whitespace-nowrap">Videos</button>
                        <button class="px-4 sm:px-6 py-3 font-medium tab-inactive whitespace-nowrap">Exclusive</button>
                    </div>
                </div>

                <!-- Media Grid -->
                <div class="media-grid">
                    <!-- Media Item 1 -->
                    <div class="media-item">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600&h=600&fit=crop" alt="Fashion model in yellow outfit">
                        <div class="media-overlay">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-medium">Hello guys!</div>
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
                    </div>

                    <!-- Media Item 2 (Video) -->
                    <div class="media-item">
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/50 sm:w-48 sm:h-48"><circle cx="12" cy="12" r="10"></circle><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>
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
                    </div>

                    <!-- Media Item 3 (Video) -->
                    <div class="media-item">
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/50 sm:w-48 sm:h-48"><circle cx="12" cy="12" r="10"></circle><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>
                        </div>
                        <div class="media-overlay">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-medium">My first video</div>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                        <span class="ml-1">84</span>
                                    </span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <span class="ml-1">Tip</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Item 4 -->
                    <div class="media-item">
                        <img src="https://images.unsplash.com/photo-1581044777550-4cfa60707c03?w=600&h=600&fit=crop" alt="Fashion model">
                        <div class="media-overlay">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-medium">My first paid image. Hope you enjoy it!</div>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                        <span class="ml-1">92</span>
                                    </span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <span class="ml-1">Tip</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Item 5 -->
                    <div class="media-item">
                        <img src="https://images.unsplash.com/photo-1550928431-ee0ec6db30d3?w=600&h=600&fit=crop" alt="Fashion model in winter coat">
                        <div class="media-overlay">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-medium">Morning sunshine ☀️</div>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                        <span class="ml-1">36</span>
                                    </span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <span class="ml-1">Tip</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Item 6 -->
                    <div class="media-item">
                        <div class="w-full h-full bg-gradient-to-br from-red-500/30 to-purple-500/30 flex items-center justify-center">
                            <span class="text-lg font-bold">Red Hot Chili</span>
                        </div>
                        <div class="media-overlay">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-medium">Red Hot Chili</div>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                        <span class="ml-1">78</span>
                                    </span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <span class="ml-1">Tip</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="mt-6 sm:mt-8 text-center">
                    <button class="btn-secondary px-6 sm:px-8 py-2 sm:py-3 rounded-xl text-white font-semibold">
                        Load More
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1">
                <!-- Stats Card -->
                <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">
                    <h2 class="text-xl font-bold mb-4 premium-text">Stats</h2>

                    <div class="post-div flex flex-wrap gap-8 text-center">
                        <div>
                            <div class="text-xl sm:text-2xl font-bold gradient-text">128</div>
                            <div class="text-xs sm:text-sm text-white/60">Total Posts</div>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-bold gradient-text">42</div>
                            <div class="text-xs sm:text-sm text-white/60">Photos</div>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-bold gradient-text">86</div>
                            <div class="text-xs sm:text-sm text-white/60">Videos</div>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-bold gradient-text">15.4k</div>
                            <div class="text-xs sm:text-sm text-white/60">Followers</div>
                        </div>
                    </div>


                    


                </div>


                <form id="createPostForm">

                    <div class="ultra-glass rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">

                        <h2 class="text-xl font-bold mb-4 premium-text">Create New Post</h2>

                        <textarea name="post_content"  class="w-full bg-white/5 border border-white/10 rounded-xl p-3 sm:p-4 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4 text-sm sm:text-base" rows="3" placeholder="What's on your mind?"></textarea>

                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $userDetails['id'] ?>">

                        <div class="flex justify-between items-center">


                             <label for="post_image" class="cursor-pointer flex items-center text-white/70 hover:text-white transition duration-300 text-sm sm:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                Upload

                            </label>

                            <input type="file" name="post_image" id="post_image" accept="/*images">

                            <button type="submit"  class="btn-primary px-4 sm:px-6 py-2 rounded-xl text-white font-semibold text-sm sm:text-base">
                                Post
                            </button>
                        </div>

                    </div>
                </form>


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
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full gradient-bg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                            </div>
                            <div>
                                <div class="font-semibold text-sm sm:text-base">Watch</div>
                                <div class="text-xs sm:text-sm text-white/60">Live streams & content</div>
                            </div>
                        </li>
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
                <div class="ultra-glass rounded-2xl p-4 sm:p-6">
                    <h2 class="text-xl font-bold mb-4 premium-text">Similar Models</h2>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=100&h=100&fit=crop&crop=faces" alt="Aria" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-sm sm:text-base">Aria M.</div>
                                <div class="text-xs sm:text-sm text-white/60">Fashion Model</div>
                            </div>
                            <button class="btn-secondary px-2 sm:px-3 py-1 rounded-full text-xs text-white font-semibold">
                                Follow
                            </button>
                        </div>
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&h=100&fit=crop&crop=faces" alt="Phoenix" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-sm sm:text-base">Phoenix R.</div>
                                <div class="text-xs sm:text-sm text-white/60">Fashion Model</div>
                            </div>
                            <button class="btn-secondary px-2 sm:px-3 py-1 rounded-full text-xs text-white font-semibold">
                                Follow
                            </button>
                        </div>
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1488161628813-04466f872be2?w=100&h=100&fit=crop&crop=faces" alt="Zara" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-sm sm:text-base">Zara C.</div>
                                <div class="text-xs sm:text-sm text-white/60">Fashion Model</div>
                            </div>
                            <button class="btn-secondary px-2 sm:px-3 py-1 rounded-full text-xs text-white font-semibold">
                                Follow
                            </button>
                        </div>
                    </div>
                    <button class="w-full btn-secondary text-white font-semibold py-2 rounded-xl mt-4 text-sm sm:text-base">
                        View More
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>



    <!-- ======================== -->


    <!-- About Modal -->
<div class="modal-overlay" id="aboutModalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">About Urdevilicifer</h2>
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
                <p>Professional fashion model with 5+ years of experience in the industry. I've worked with top brands and photographers across the country. My passion is creating art through modeling and connecting with my audience. Available for photoshoots, runway shows, and brand collaborations. Let's create something beautiful together!</p>
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
            
            <div class="about-section">
                <h3 class="about-section-title">Location</h3>
                <p>Based in Los Angeles, CA. Available for travel worldwide.</p>
            </div>
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
        
        <div class="modal-body">
            <div class="about-section">
                <h3 class="about-section-title">Chat Services</h3>
                <div class="attributes-grid">
                    <div class="attribute">
                        <div class="attribute-label">1-on-1 Chat Session</div>
                        <div class="attribute-value">$50/hr</div>
                        <p>Exclusive private chat sessions where we can discuss anything you'd like.</p>
                        <button class="btn btn-primary">Book Now</button>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Private Messaging</div>
                        <div class="attribute-value">$25/day</div>
                        <p>Priority responses to your messages throughout the day.</p>
                        <button class="btn btn-primary">Book Now</button>
                    </div>
                </div>
            </div>
            
            <div class="about-section">
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
            </div>
            
            <div class="about-section">
                <h3 class="about-section-title">Meet Services</h3>
                <div class="attributes-grid">
                    <div class="attribute">
                        <div class="attribute-label">Dating Experiences</div>
                        <div class="attribute-value">Custom</div>
                        <p>Enjoy a personalized date experience.</p>
                        <button class="btn btn-primary">Book Now</button>
                    </div>
                    <div class="attribute">
                        <div class="attribute-label">Travel & Tours Together</div>
                        <div class="attribute-value">Custom</div>
                        <p>Travel with me to exciting destinations.</p>
                        <button class="btn btn-primary">Book Now</button>
                    </div>
                </div>
            </div>
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
           
          
            
            <div class="wishlist-item">


                <div class="all-linkdiv">

                    <div class="ss-icons">
                        <img src="./assets/images/ss-facebook.svg" alt="social-icon" />
                    </div>
                    <div class="ss-icons">
                        <img src="./assets/images/ss-instagram.svg" alt="social-icon" />
                    </div>
                    <div class="ss-icons">
                        <img src="./assets/images/ss-whatsapp.svg" alt="social-icon" />
                    </div>

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




    <script>

        $(document).ready(function () {

            $('#createPostForm').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this); 

                $.ajax({
                    url: 'ajax/save_post.php', 
                    type: 'POST',
                    data: formData,
                    contentType: false, 
                    processData: false, 
                    success: function (response) {
                        alert("Post submitted successfully!");
                        console.log(response);
                        $('#createPostForm')[0].reset();
                    },
                    error: function (xhr) {
                        alert("An error occurred while submitting the post.");
                        console.log(xhr.responseText);
                    }
                });
            });
        });

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