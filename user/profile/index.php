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

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

<title>Bookging | The Live Model</title>

<?php  include('../../includes/head.php'); ?>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />

</head>

<body class="socialwall-page">

  <div class="sidebar-overlay" id="sidebarOverlay"></div>
  <div class="sidebar-menu" id="sidebarMenu">
    <div class="p-6 flex flex-col items-center">
      <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-20 h-20 rounded-full">
      <h3 class="text-xl font-bold mt-3">Sophie</h3>
      <div class="flex items-center mt-2">
        <div class="flex items-center mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
          </svg>
          <span>0</span>
        </div>
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="menu-stats">
      <div class="menu-stat">
        <div class="menu-stat-value">2</div>
        <div class="menu-stat-label">Followers</div>
      </div>
      <div class="menu-stat">
        <div class="menu-stat-value">0</div>
        <div class="menu-stat-label">Following</div>
      </div>
    </div>

    <div class="menu-item" onclick="navigateTo('edit-profile')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
      </svg>
      Edit Profile Detail
    </div>

    <div class="menu-item" onclick="navigateTo('my-profile')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      My Profile
    </div>

    <div class="menu-item" onclick="navigateTo('social-links')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
      </svg>
      Add Social Links
    </div>

    <div class="menu-item" onclick="navigateTo('wallet')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
      </svg>
      Wallet
    </div>

    <div class="menu-item" onclick="navigateTo('services')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
      </svg>
      Services
    </div>

    <div class="menu-item" onclick="navigateTo('advertisement')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
      </svg>
      Advertisement
    </div>

    <div class="menu-item" onclick="navigateTo('chat')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
      </svg>
      Chat
    </div>

    <div class="menu-item" onclick="navigateTo('support')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
      </svg>
      Support
    </div>

    <div class="menu-item" onclick="logout()">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
      Logout
    </div>
  </div>

  <header class="glass-effect sticky top-0 z-50 border-b border-white/10">
    <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
      <div class="flex items-center">
        <div class="hamburger mr-4" id="hamburgerMenu">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="flex items-center">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-2rqoMgilFSKGHIOncdCmYHiKATfRw2.png" alt="The Live Models" class="h-10 mr-3">
          <h1 class="logo-text text-2xl font-bold gradient-text heading-font">The Live Models</h1>
        </div>
      </div>
      <div class="flex items-center space-x-4">
        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-4">
          <button class="p-2 glass-effect rounded-full hover:bg-white/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </button>
          <button class="p-2 glass-effect rounded-full hover:bg-white/10 transition-colors relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
          </button>
        </div>

        <!-- Profile Image -->
        <div class="relative">
          <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-10 h-10 rounded-full border-2 border-purple-500">
          <div class="online-dot"></div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 main-content">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 py-6">

      <div class="sidebar lg:col-span-1">

        <div class="model-card text-center">
          <div class="relative inline-block mb-4">
            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Your profile" class="w-20 h-20 rounded-full mx-auto border-3 border-purple-500">
            <div class="online-dot"></div>
          </div>
          <h3 class="font-bold text-lg gradient-text">Sophie, 24</h3>
          <p class="text-white/60 text-sm mb-2">San Francisco, CA</p>
          <div class="flex justify-center mb-4">
            <span class="verified-badge">✓ Verified</span>
          </div>
          <div class="space-y-2">
            <button class="btn-primary w-full" onclick="editProfile()">Edit Profile</button>
            <button class="btn-secondary w-full" onclick="viewProfile()">View Profile</button>
          </div>
        </div>

        <!-- Online Users -->
        <div class="model-card">
          <h3 class="font-bold mb-4 gradient-text">Online Now</h3>
          <div class="space-y-3">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/25.jpg" alt="User" class="w-12 h-12 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3">
                <p class="font-medium">Sarah, 26</p>
                <p class="text-xs text-white/60">2 miles away</p>
              </div>
            </div>
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/37.jpg" alt="User" class="w-12 h-12 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3">
                <p class="font-medium">Emma, 23</p>
                <p class="text-xs text-white/60">1 mile away</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="model-card">
          <h3 class="font-bold mb-4 gradient-text">Your Stats</h3>
          <div class="space-y-3">
            <div class="flex justify-between">
              <span class="text-white/70">Profile Views</span>
              <span class="font-bold text-purple-400">1,247</span>
            </div>
            <div class="flex justify-between">
              <span class="text-white/70">Connections</span>
              <span class="font-bold text-purple-400">89</span>
            </div>
            <div class="flex justify-between">
              <span class="text-white/70">Messages</span>
              <span class="font-bold text-purple-400">156</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Feed -->


      <div class="main-feed lg:col-span-3">

        <h2 class="text-2xl md:text-3xl font-bold mb-6 gradient-text heading-font">Your Feed</h2>

        <!-- Post 1 -->
        <div class="model-card">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3 md:ml-4">
                <div class="flex items-center flex-wrap">
                  <h4 class="font-bold text-base md:text-lg">Sophia, 25</h4>
                  <span class="verified-badge ml-2">✓</span>
                </div>
                <p class="text-xs md:text-sm text-white/60">2 hours ago • 3 miles away</p>
              </div>
            </div>
            <span class="status-online">Connected</span>
          </div>

          <p class="mb-4 text-sm md:text-base text-white/90">Just finished an amazing yoga session! Who wants to join me for a hike this weekend? 🧘‍♀️✨</p>

          <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&h=400&fit=crop" alt="Yoga" class="w-full h-48 md:h-64 object-cover rounded-lg mb-4">

          <div class="flex justify-between items-center">
            <div class="flex space-x-4 md:space-x-6">
              <button class="like-btn flex items-center text-white/70 hover:text-pink-400 transition-colors" onclick="toggleLike(this)">
                <svg class="w-5 md:w-6 h-5 md:h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="text-sm md:text-base">47</span>
              </button>
              <button class="flex items-center text-white/70 hover:text-blue-400 transition-colors">
                <svg class="w-5 md:w-6 h-5 md:h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <span class="text-sm md:text-base">12</span>
              </button>
            </div>
            <button class="btn-secondary text-sm md:text-base">Message</button>
          </div>

          <!-- Comments -->
          <div class="mt-6 pt-4 border-t border-white/10">
            <div class="flex items-start mb-4">
              <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="User" class="w-8 md:w-10 h-8 md:h-10 rounded-full">
              <div class="ml-3 glass-effect rounded-lg p-3 flex-1">
                <p class="font-medium text-xs md:text-sm">Alex M.</p>
                <p class="text-xs md:text-sm text-white/80">Count me in for the hike! I know some great trails 🥾</p>
              </div>
            </div>
            <div class="flex items-center">
              <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Your profile" class="w-8 md:w-10 h-8 md:h-10 rounded-full">
              <input type="text" placeholder="Write a comment..." class="ml-3 glass-effect rounded-full py-2 px-4 flex-1 text-sm bg-transparent border border-white/20 focus:border-purple-500 focus:outline-none">
            </div>
          </div>
        </div>

       

        <!-- Divider -->
        <div class="text-center my-8">
          <div class="inline-flex items-center px-6 py-3 glass-effect rounded-full">
            <span class="gradient-text font-semibold">Discover New People</span>
          </div>
        </div>

        <!-- Suggested Users -->
        <h2 class="text-2xl md:text-3xl font-bold mb-6 gradient-text heading-font">People You May Like</h2>

        <!-- Suggestion 1 -->
        <div class="model-card">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/71.jpg" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3 md:ml-4">
                <div class="flex items-center flex-wrap">
                  <h4 class="font-bold text-base md:text-lg">Maya, 26</h4>
                  <span class="verified-badge ml-2">✓</span>
                </div>
                <p class="text-xs md:text-sm text-white/60">Active now • 3 miles away</p>
              </div>
            </div>
            <button class="btn-primary text-sm md:text-base" onclick="toggleConnect(this)">Connect</button>
          </div>

          <p class="mb-4 text-sm md:text-base text-white/90">Love dancing and traveling! Looking for adventure buddies 💃✈️</p>

          <div class="grid grid-cols-3 gap-2 mb-4">
            <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=200&h=150&fit=crop" alt="Dancing" class="w-full h-20 md:h-24 object-cover rounded-lg">
            <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=200&h=150&fit=crop" alt="Travel" class="w-full h-20 md:h-24 object-cover rounded-lg">
            <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?w=200&h=150&fit=crop" alt="Beach" class="w-full h-20 md:h-24 object-cover rounded-lg">
          </div>

          <div class="flex justify-between text-xs md:text-sm text-white/60">
            <span>🎯 95% match</span>
            <span>📍 3 miles</span>
            <span>⭐ 4.9 rating</span>
          </div>
        </div>

        <!-- Suggestion 2 -->
        <div class="model-card">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop&crop=faces" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">
                <span class="absolute bottom-0 right-0 w-4 h-4 bg-yellow-400 border-2 border-white rounded-full"></span>
              </div>
              <div class="ml-3 md:ml-4">
                <div class="flex items-center flex-wrap">
                  <h4 class="font-bold text-base md:text-lg">Zoe, 24</h4>
                  <span class="premium-badge ml-2">★ Premium</span>
                </div>
                <p class="text-xs md:text-sm text-white/60">Online 1h ago • 5 miles away</p>
              </div>
            </div>
            <button class="btn-primary text-sm md:text-base" onclick="toggleConnect(this)">Connect</button>
          </div>

          <p class="mb-4 text-sm md:text-base text-white/90">Artist and coffee lover ☕🎨 Let's create something beautiful together!</p>

          <img src="https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=600&h=300&fit=crop" alt="Art" class="w-full h-40 md:h-48 object-cover rounded-lg mb-4">

          <div class="flex justify-between text-xs md:text-sm text-white/60">
            <span>🎯 87% match</span>
            <span>📍 5 miles</span>
            <span>⭐ 4.7 rating</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Mobile Navigation -->
  <nav class="mobile-nav md:hidden">
    <div class="flex justify-around">
      <div class="mobile-nav-item active">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
        </svg>
        <span>Feed</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span>Search</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <span>Messages</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span>Profile</span>
      </div>
    </div>
  </nav>

  <!-- JavaScript -->
  <script>
    // Hamburger menu functionality
    const hamburger = document.getElementById('hamburgerMenu');
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');

    hamburger.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    function toggleSidebar() {
      hamburger.classList.toggle('open');
      sidebar.classList.toggle('open');
      overlay.classList.toggle('open');

      // Prevent body scrolling when sidebar is open
      if (sidebar.classList.contains('open')) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = '';
      }
    }

    // Simple like function
    function toggleLike(button) {
      const span = button.querySelector('span');
      const currentCount = parseInt(span.textContent);

      if (button.classList.contains('liked')) {
        button.classList.remove('liked');
        span.textContent = currentCount - 1;
      } else {
        button.classList.add('liked');
        span.textContent = currentCount + 1;
      }
    }

    // Simple connect function
    function toggleConnect(button) {
      if (button.textContent === 'Connect') {
        button.textContent = 'Connected';
        button.style.background = 'linear-gradient(45deg, #10b981, #34d399)';
      } else {
        button.textContent = 'Connect';
        button.style.background = 'var(--primary-gradient)';
      }
    }

    // Navigation functions
    function navigateTo(page) {
      alert(`Navigating to ${page} page...`);
      toggleSidebar(); // Close sidebar after navigation
    }

    // Profile functions
    function viewProfile() {
      alert('Opening your profile...');
    }

    function editProfile() {
      alert('Opening profile editor...');
    }

    function logout() {
      if (confirm('Are you sure you want to logout?')) {
        alert('Logging out...');
      }
    }

    // Message button functionality
    document.querySelectorAll('button').forEach(button => {
      if (button.textContent === 'Message') {
        button.addEventListener('click', function() {
          alert('Opening chat...');
        });
      }
    });

    // Mobile navigation
    document.querySelectorAll('.mobile-nav-item').forEach(item => {
      item.addEventListener('click', function() {
        document.querySelectorAll('.mobile-nav-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>

</body>


</html> 
