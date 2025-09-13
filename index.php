<?php  session_start();
include('includes/config.php');
include('includes/helper.php');

$country_list = DB::query('select id,name,sortname from countries order by name asc');

?>
<!doctype html>
<html lang="en-US" class="no-js">
  <head>
    <title>Chat, Watch & Meet top Models | The Live Models transparent</title>
    <meta name="description" content="The live model is one of the world's leading professional networks for models and escorts. Chat watch and meet with your favorite models from the comfort of your home.">
	<link rel="canonical" href="https://thelivemodels.com/" />

<?php include('includes/head.php'); ?>

    <link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />

    <style>

    </style>
    <!-- <style type="text/css" id="custom-background-css">
      body.custom-background { background-image: url("assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
    </style> -->
    <style type="text/css">
    	.gallery-icon img{
    		width: 100%;
    	}
    	.wp-caption-text .gallery-caption{
    		width: 100%;
    	}
      .img_hme{
        height: 180px !important;
        border-radius: 20px;
      }
      .heading_txt{
        font-weight: bolder;
        padding-top: 10px;
        margin-bottom: 20px;
        border-bottom: 1px solid lightgrey;
        padding-bottom: 20px;
      }
      .larg_img{
      	width: 100%;
      	height: 430px !important;
      	border-radius: 20px;
      }
      .banner_section_mobile
      {
      	display: none;
      }
      @media screen and (max-width: 767px) {
			  .larg_img {
			    height: auto !important;
			    padding: 10px;
			  }
			  .img_hme{
			  	height: auto !important;
			  	width: 100% !important;
			  	padding: 10px;
			  }
			  .owl-carousel .owl-item img{
			  	margin: auto !important;
			  }
			  .banner_section
			  {
			  	display: none;
			  }
			  .banner_section_mobile
			  {
			  	display: block;
			  }
			  .tokan-a img{
			  	margin-top: 0px!important;
			  	width: 95% !important;
			  }
			}
      .p_for{
        font-size: 18px;
        font-family: sans-serif;
        color: #ffffff;
      }
    </style>
  </head>
  <body class="min-h-screen bg-animated text-white home-page socialwall-page optim-services enhanced5">
  <!-- Premium Particle System -->
  <div class="particles" id="particles"></div>
    <!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>
<main class="home-page">    <!-- Ultra Premium Hero Section with Side-by-Side Layout -->
    <!-- Ultra Premium Hero Section with Side-by-Side Layout -->
    <section class="py-24 md:py-32 relative overflow-hidden home-banner">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/30 via-purple-900/20 to-pink-900/30"></div>
        <div class="container mx-auto relative z-10">
            <div class="hero-grid">
                <!-- Left Column - Content -->
                <div class="space-y-10 scroll-reveal-left">
                    <div class="inline-flex items-center px-6 py-3 ultra-glass rounded-full text-indigo-300 font-medium text-sm border border-indigo-500/30 floating">
                        <span class="live-indicator mr-3 w-3 h-3 bg-red-500 rounded-full"></span>
                        Where Premium Connections Begin
                    </div>

                    <h1 class="text-5xl md:text-6xl xl:text-7xl font-bold heading-font leading-tight">
                        <span class="gradient-text text-glow">Chat, Watch</span><br>
                        <span class="premium-text">and Meet</span><br>
                        <span class="text-xl md:text-2xl text-white/70 font-normal">Your Perfect Match Awaits</span>
                    </h1>

                    <p class="text-xl md:text-2xl text-white/80 leading-relaxed max-w-2xl">
                        Discover verified models who offer personalized experiences. From intimate conversations to exclusive content and real meetings - your desires become reality.
                    </p>

                    <div class="space-y-6">
                        <div class="relative homebtn">

                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Find your perfect match..."

                                oninput="handleSearchInput(this)"

                                class="w-full px-8 py-5 ultra-glass border border-white/10 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-white text-lg shadow-2xl transition duration-300"
                            >

                            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 btn-primary text-white px-8 py-3 rounded-xl font-semibold shadow-lg"   onclick="handleSearchInput(document.getElementById('searchInput'))">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                                Discover
                            </button>

                            <div id="searchResults" style="display: none;" class="absolute w-full bg-white rounded-xl mt-2 shadow-lg hidden max-h-60 overflow-y-auto overflow-x-hidden text-black z-[9999]">
                                <!-- Results appear here dynamically -->
                            </div>

                            <!-- <div id="searchSuggestions" class="search-suggestions">
                                <div class="suggestion-item" onclick="selectSuggestion('aria')">
                                    <div class="flex items-center space-x-4">
                                        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=50&h=50&fit=crop&crop=faces" alt="Aria" class="w-10 h-10 rounded-full">
                                        <div>
                                            <div class="font-semibold text-white">Aria M.</div>
                                            <div class="text-sm text-white/60">Online • Chat, Watch & Meet</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="suggestion-item" onclick="selectSuggestion('phoenix')">
                                    <div class="flex items-center space-x-4">
                                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=50&h=50&fit=crop&crop=faces" alt="Phoenix" class="w-10 h-10 rounded-full">
                                        <div>
                                            <div class="font-semibold text-white">Phoenix R.</div>
                                            <div class="text-sm text-white/60">Online • Premium Model</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="suggestion-item" onclick="handleSearch()">
                                    <div class="flex items-center space-x-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                                        <span class="text-white/80 font-medium">Search for "blonde models"</span>
                                    </div>
                                </div>
                            </div> -->

                        </div>

                        <div class="flex flex-wrap gap-4">

                            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white/80 hover:bg-white/10 transition duration-300 cursor-pointer border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterModels('featured')">✨ Featured</button>

                            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white/80 hover:bg-white/10 transition duration-300 cursor-pointer border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterModels('trending')">🔥 Trending</button>

                            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white/80 hover:bg-white/10 transition duration-300 cursor-pointer border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterModels('new')">💫 New Models</button>

                            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white/80 hover:bg-white/10 transition duration-300 cursor-pointer border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterModels('available')">💋 Available Now</button>

                            <button class="px-6 py-3 ultra-glass rounded-full text-sm font-medium text-white/80 hover:bg-white/10 transition duration-300 cursor-pointer border border-white/10 hover:border-indigo-500/50 hover-lift" onclick="filterModels('vip')">👑 VIP</button>
                        </div>
                    </div>

                    <!-- Premium Stats -->
                    <div class="flex premium-status items-center space-x-8">
                        <div class="flex -space-x-4">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop&crop=faces" alt="User 1" class="w-14 h-14 rounded-full border-3 border-indigo-500 shadow-xl object-cover hover:scale-110 transition duration-300 cursor-pointer floating">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=faces" alt="User 2" class="w-14 h-14 rounded-full border-3 border-indigo-500 shadow-xl object-cover hover:scale-110 transition duration-300 cursor-pointer floating">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=faces" alt="User 3" class="w-14 h-14 rounded-full border-3 border-indigo-500 shadow-xl object-cover hover:scale-110 transition duration-300 cursor-pointer floating">
                            <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=150&h=150&fit=crop&crop=faces" alt="User 4" class="w-14 h-14 rounded-full border-3 border-indigo-500 shadow-xl object-cover hover:scale-110 transition duration-300 cursor-pointer floating">
                            <div class="w-14 h-14 rounded-full border-3 border-indigo-500 shadow-xl gradient-bg flex items-center justify-center text-white font-bold text-sm hover:scale-110 transition duration-300 cursor-pointer floating">+10K</div>
                        </div>
                        <div>
                            <div class="font-bold text-3xl stats-counter" data-target="50000">0</div>
                            <div class="text-sm text-white/70 font-medium">Verified Models & Members</div>
                        </div>
                    </div>

                    <!-- Premium Trust Indicators -->
                    <div class="flex flex-wrap gap-4 items-center">
                        <div class="flex items-center space-x-3 ultra-glass px-6 py-3 rounded-full border border-green-500/30 hover:bg-green-500/10 transition duration-300 hover-lift">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <span class="text-sm font-semibold text-white/80">100% Verified</span>
                        </div>
                        <div class="flex items-center space-x-3 ultra-glass px-6 py-3 rounded-full border border-blue-500/30 hover:bg-blue-500/10 transition duration-300 hover-lift">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><circle cx="12" cy="16" r="1"></circle><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            <span class="text-sm font-semibold text-white/80">Secure & Private</span>
                        </div>
                        <div class="flex items-center space-x-3 ultra-glass px-6 py-3 rounded-full border border-purple-500/30 hover:bg-purple-500/10 transition duration-300 hover-lift">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            <span class="text-sm font-semibold text-white/80">Instant Connect</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Ultra Premium Signup Form (NO FLOATING) -->
                <div class="scroll-reveal-right">
                    <div class="ultra-glass p-10 rounded-3xl shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-pink-500/15 to-purple-500/15 rounded-full blur-2xl"></div>
                        <div class="relative z-10">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold premium-text mb-3 heading-font text-glow">Join Our Exclusive Community</h2>
                                <p class="text-white/70 text-lg">Create your profile and start connecting</p>
                                <div class="mt-4 text-sm text-white/60">
                                    <span class="inline-flex items-center">
                                        <span class="w-3 h-3 bg-green-400 rounded-full mr-3 animate-pulse"></span>
                                        <span class="stats-counter text-lg" data-target="2847">0</span>
                                        <span class="ml-2 font-medium">people joined today</span>
                                    </span>
                                </div>
                            </div>

							<?php

                          /*$sqls = "SELECT * FROM model_user WHERE unique_id='model-67054'";

                            $resultd = mysqli_query($con, $sqls);
							$count = 1;

                              if (mysqli_num_rows($resultd) > 0) {

                                while ($rowesdw = mysqli_fetch_assoc($resultd)){
									echo '<pre>'; print_r($rowesdw); echo '</pre>';
									if($count == 1){
										break;
									}
								}

							  } */

							?>

                            <!-- <div class="flex space-x-4 mb-8 h-banner-btns">
                                <button id="userTab" class="flex-1 py-4 px-6 bg-white text-indigo-600 rounded-xl font-semibold transition duration-300 shadow-lg relative overflow-hidden hover-lift" onclick="switchTab('user')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    I'm a User
                                </button>
                                <button id="modelTab" class="flex-1 py-4 px-6 ultra-glass text-white rounded-xl font-semibold transition duration-300 relative overflow-hidden hover-lift" onclick="switchTab('model')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    I'm a Model
                                </button>
                            </div> -->

                            <form id="signupForm" class="space-y-5" method="post" enctype="multipart/form-data"  onsubmit="return SubmitForm()"  action="act-register.php">


                                <?php if(isset($_SESSION["user_name_exist"] )) { ?>

                                <h2><span class="text-danger"><?php echo $_SESSION["user_name_exist"]  ?></span></h2>

                                <?php } ?>

                                <?php if(isset($_SESSION["email_exist"] )) { ?>

                                    <h2><span class="text-danger"><?php echo $_SESSION["email_exist"]  ?></span></h2>

                                <?php } ?>

                                <?php if(isset($_SESSION["email_error"] )) { ?>

                                    <h2><span class="text-danger"><?php echo $_SESSION["email_error"]  ?></span></h2>

                                <?php } ?>

                                <?php if(isset($_SESSION["not_registred"] )) { ?>

                                    <h2><span class="text-danger"><?php echo $_SESSION["not_registred"]  ?></span></h2>

                                <?php } ?>

                                <?php
                                    
                                    if (isset($_SESSION["user_name_exist"])) {
                                        unset($_SESSION["user_name_exist"]);
                                    }

                                    if (isset($_SESSION["email_exist"])) {
                                        unset($_SESSION["email_exist"]);
                                    }

                                    if (isset($_SESSION["email_error"])) {
                                        unset($_SESSION["email_error"]);
                                    }

                                    if (isset($_SESSION["not_registred"])) {
                                        unset($_SESSION["not_registred"]);
                                    }
                                ?>

                                <input type="text" name="name" placeholder="Full Name" class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>

                                 <div>

                                    <input type="text" name="username" placeholder="Username" id="username" class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>

                                      <div id="error_username" class="text-red-500 text-sm mt-1"></div>

                                 </div>

                                <input type="email" name="email" placeholder="Email Address" class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>


								<input type="hidden" name="user_type" id="user_type" class="user_type" value="user">

                                <div class="relative ">
                                    <input type="password" id="passwordInput" name="password" placeholder="Password" class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>
                                    <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 hover:text-white transition duration-300" onclick="togglePasswordVisibility()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                </div>

                                <select name="country" class="w-full px-6 py-4 rounded-xl ultra-glass text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>
                                    <option value="" class="bg-gray-900">Select Country</option>
                                    <!-- <option value="US" class="bg-gray-900">🇺🇸 United States</option>
                                    <option value="UK" class="bg-gray-900">🇬🇧 United Kingdom</option>
                                    <option value="CA" class="bg-gray-900">🇨🇦 Canada</option>
                                    <option value="AU" class="bg-gray-900">🇦🇺 Australia</option>
                                    <option value="IN" class="bg-gray-900">🇮🇳 India</option>
                                    <option value="JP" class="bg-gray-900">🇯🇵 Japan</option>
                                    <option value="DE" class="bg-gray-900">🇩🇪 Germany</option>
                                    <option value="FR" class="bg-gray-900">🇫🇷 France</option>
                                    <option value="BR" class="bg-gray-900">🇧🇷 Brazil</option>
									<option value="NZ" class="bg-gray-900">🇳z New Zealand</option>
									<option value="CL" class="bg-gray-900">CL Columbia</option>
									<option value="TH" class="bg-gray-900">TH Thailand</option>
                                    <option value="Other" class="bg-gray-900">🌍 Other</option> -->
                                    <?php  foreach ($country_list as $val) { ?>

                                          <option value="<?= $val['id'] ?>" class="bg-gray-900"><?= $val['name'] ?></option>

                                    <?php } ?>
                                    
                                </select>

                                <div class="flex banner-select flex-wrap space-x-6">
                                    <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                        <input type="radio" name="gender" value="male" class="form-radio text-indigo-600 w-5 h-5" required>
                                        <span class="font-medium">Male</span>
                                    </label>
                                    <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                        <input type="radio" name="gender" value="female" class="form-radio text-indigo-600 w-5 h-5" required>
                                        <span class="font-medium">Female</span>
                                    </label>
                                    <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                        <input type="radio" name="gender" value="other" class="form-radio text-indigo-600 w-5 h-5" required>
                                        <span class="font-medium">Other</span>
                                    </label>
                                </div>

                                <!-- <div id="creatorFields" class="hidden space-y-5">
                                    <select name="services" class="w-full px-6 py-4 rounded-xl ultra-glass text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10">
                                        <option value="" class="bg-gray-900">Select Your Services</option>
                                        <option value="Chat Only" class="bg-gray-900">💬 Chat Only</option>
                                        <option value="Chat & Watch" class="bg-gray-900">💬📹 Chat & Watch</option>
                                        <option value="Chat, Watch & Meet" class="bg-gray-900">💬📹🤝 Chat, Watch & Meet</option>
                                        <option value="Premium Experience" class="bg-gray-900">👑 Premium Experience</option>
                                    </select>
                                    <textarea name="user_bio" placeholder="Tell potential matches about yourself..." class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 h-28 resize-none shadow-lg transition duration-300 border border-white/10"></textarea>
                                </div> -->

                                <button type="submit" name="vfb-submit"  value="submit" class="create-profilebtn w-full btn-primary text-white font-bold py-4 rounded-xl transition duration-300 relative overflow-hidden text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M5 12l5 5l10-10"></path></svg>
                                    CREATE MY PROFILE
                                </button>
                            </form>

                            <div class="mt-8 text-center">
                                <p class="text-white/50 text-sm">
                                    By joining, you agree to our <a href="<?= SITEURL.'tls-tom.php'?>" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium read-more-btn">Terms</a> and <a href="<?= SITEURL.'privacy-policy.php'?>" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium read-more-btn">Privacy Policy</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced VIP Section with Floating Animation and Better Content -->
    <section class="py-20 relative scroll-reveal join-sec">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-6 text-glow">Premium Experience</h2>
                <p class="text-xl text-white/70 max-w-2xl mx-auto">Unlock the full potential of authentic connections with our premium features</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="vip-section ultra-glass vip-enhanced p-12 rounded-3xl">
                    <div class="grid md:grid-cols-3 gap-12">

                        <div  <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> class="text-center hover-lift">
                            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 feature-icon shadow-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold premium-text mb-4">Verified Profiles</h3>
                            <p class="text-white/70 text-lg">Connect with 100% verified models and members for authentic experiences</p>
                        </div>

                        <div <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> class="text-center hover-lift">
                            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 feature-icon shadow-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold premium-text mb-4">Privacy Protection</h3>
                            <p class="text-white/70 text-lg">Advanced encryption and privacy controls keep your interactions secure</p>
                        </div>

                        <div <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> class="text-center hover-lift">
                            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 feature-icon shadow-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold premium-text mb-4">Smart Matching</h3>
                            <p class="text-white/70 text-lg">AI-powered compatibility matching for meaningful connections</p>
                        </div>


                    </div>
                    <div class="mt-12 text-center">
                        <div class="grid md:grid-cols-2 gap-8 mb-8">
                            <div class="ultra-glass p-6 rounded-2xl border border-purple-500/30">
                                <h4 class="text-xl font-bold premium-text mb-3">Quality Connections</h4>
                                <p class="text-white/70">Experience genuine interactions with verified community members who value authentic relationships</p>
                            </div>
                            <div class="ultra-glass p-6 rounded-2xl border border-blue-500/30">
                                <h4 class="text-xl font-bold premium-text mb-3">Advanced Features</h4>
                                <p class="text-white/70">Access premium tools for enhanced communication, privacy controls, and personalized experiences</p>
                            </div>
                        </div>
                        <button type="button" class="btn-primary px-12 py-4 text-white rounded-xl font-bold text-lg shadow-2xl" <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> >
                            Explore Premium Features
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<?php $sqls_model = "SELECT * FROM model_user WHERE as_a_model = 'Yes' Order by id DESC LIMIT 4";

              $resultd_model = mysqli_query($con, $sqls_model);

                if (mysqli_num_rows($resultd_model) > 0) {

                  ?>

    <!-- Ultra Premium Featured Models Section -->
    <section class="py-24 relative scroll-reveal discover-sec">
        <div class="container mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-5xl md:text-6xl font-bold heading-font gradient-text mb-6 text-glow">Discover Your Perfect Match</h2>
                <p class="text-2xl text-white/70 max-w-3xl mx-auto">Explore our selection of verified models ready to connect with you</p>
            </div>

            <div class="discover-outerdiv">

			<?php while($rowesdw = mysqli_fetch_assoc($resultd_model)) {

			$unique_id = $rowesdw['unique_id'];

					$sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";

                      $result = mysqli_query($con, $sql);

                      if (mysqli_num_rows($result) > 0) {

                        while($rowe = mysqli_fetch_assoc($result)) {

                           $image_c = $rowe["count(*)"];

                        }

                      }

                      $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";

                      $result1 = mysqli_query($con, $sql1);

                      if (mysqli_num_rows($result1) > 0) {

                        while($rowe1 = mysqli_fetch_assoc($result1)) {

                           $vdo_c = $rowe["count(*)"];

                        }

                      }

							if(empty($rowesdw['name'])){
								$modelname = ucfirst($rowesdw['username']);
							}else{
								$modelname = ucfirst($rowesdw['name']);
							}


			?>

                <!-- Model Card 1 - Aria -->

                 <!-- onclick="openModelPreview_new('')" -->

                <div class="model-card rounded-2xl overflow-hidden hover-lift"  >
                    <div class="relative">
                        <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="<?php $rowesdw['name']; ?>" class="w-full h-80 object-cover model-image">
                        <div class="absolute top-4 right-4 status-online w-4 h-4 rounded-full"></div>
                        <div class="absolute top-4 left-4 verified-badge text-white px-3 py-1 rounded-full text-xs font-semibold">
                            ✓ Verified
                        </div>
                        <div class="absolute bottom-4 left-4 ultra-glass text-white px-4 py-2 rounded-full text-sm font-medium">
                            🔴 Live Now
                        </div>
                    </div>
                    <div class="mod-card-content flex flex-col" onclick="window.location.href='<?php echo SITEURL; ?>single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>'" >
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-2xl font-bold premium-text"><?php echo $modelname; ?></h4>
							<?php if(!empty($rowesdw['age'])){ ?>
                            <span class="text-lg text-white/60 font-medium"><?php echo $rowesdw['age']; ?></span>
							<?php } ?>
                        </div>
						<?php
						$services = '';
						if(!empty($rowesdw['services'])){
							if($rowesdw['services'] == 'Chat Only') $services = '💬 '.$rowesdw['services'];
							else if($rowesdw['services'] == 'Chat & Watch') $services = '💬📹 '.$rowesdw['services'];
							else if($rowesdw['services'] == 'Chat, Watch & Meet') $services = '💬📹🤝 '.$rowesdw['services'];
							else if($rowesdw['services'] == 'Premium Experience') $services = '👑 '.$rowesdw['services'];
						 ?>
                        <p class="text-indigo-400 font-semibold mb-3 text-lg"><?php echo $services; ?></p>
						<?php } ?>

						<?php if(!empty($rowesdw['user_bio'])){ ?>
                        <div class="flex-1 mb-6">
                            <p class="text-white/70 text-base description-text" data-full-text="Let me be your escape from reality. I promise an unforgettable experience that will leave you wanting more and more. Every moment with me is crafted to perfection.">
                                <span class="description-preview"><?php echo substr($rowesdw['user_bio'], 0, 20).'...'; ?></span>
                                <button  onclick="window.location.href='<?php echo SITEURL; ?>single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>'"  class="read-more-btn text-indigo-400 hover:text-indigo-300 ml-2 text-sm font-medium hidden" >Read more</button>
                            </p>
                        </div>
						<?php } ?>
                        <div class="flex justify-between text-base text-white/60 mb-6">
                            <span class="font-medium">❤️ 2.4K Likes</span>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="#667eea" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span class="font-semibold">4.9</span>
                            </div>
                        </div>

                        <button <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?>  class="w-full btn-primary text-white font-bold py-4 rounded-xl mt-auto text-lg"  >
                            💕 Connect Now
                        </button>

                    </div>
                </div>

			<?php }  ?>
            </div>

            <div class="mt-16 text-center">
                <button  class="btn-secondary px-12 py-4 text-white rounded-xl hover:bg-white/20 transition duration-300 text-lg font-semibold" onclick="viewAllModels()">
                    View All Models
                </button>
            </div>
        </div>
    </section>

				<?php } ?>

    <!-- Ultra Premium Services Section -->
    <section class="py-24 relative scroll-reveal preminum-sersec">
        <div class="container mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-5xl md:text-6xl font-bold heading-font gradient-text mb-6 text-glow">Experience the Connection</h2>
                <p class="text-2xl text-white/70 max-w-3xl mx-auto">Choose how you want to connect and create unforgettable moments</p>
            </div>

            <div class="exp-grid">

                <div <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> class="exp-content ultra-glass p-10 rounded-2xl hover:scale-105 transition duration-500 shadow-2xl hover-lift">
                    <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-8 feature-icon shadow-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold premium-text mb-6 text-center">Chat</h3>
                    <p class="text-white/70 leading-relaxed mb-8 text-lg text-center">Engage in intimate conversations that spark connection. Our models are ready to chat about anything that interests you.</p>
                    <ul class="text-base text-white/60 space-y-3">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Real-time messaging</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Photo sharing</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Voice messages</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Private conversations</span>
                        </li>
                    </ul>
                </div>

                <div <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> class="exp-content ultra-glass p-10 rounded-2xl hover:scale-105 transition duration-500 shadow-2xl hover-lift">
                    <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-8 feature-icon shadow-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                    </div>
                    <h3 class="text-3xl font-bold premium-text mb-6 text-center">Watch</h3>
                    <p class="text-white/70 leading-relaxed mb-8 text-lg text-center">Experience private shows tailored to your desires. HD streaming with interactive features for an immersive experience.</p>
                    <ul class="text-base text-white/60 space-y-3">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">HD video streaming</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Interactive controls</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Private shows</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Custom requests</span>
                        </li>
                    </ul>
                </div>

                <div <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> class="exp-content ultra-glass p-10 rounded-2xl hover:scale-105 transition duration-500 shadow-2xl hover-lift">
                    <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-8 feature-icon shadow-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold premium-text mb-6 text-center">Meet</h3>
                    <p class="text-white/70 leading-relaxed mb-8 text-lg text-center">Take your connection to the next level with in-person meetings. All meetings are verified and secure.</p>
                    <ul class="text-base text-white/60 space-y-3">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Verified meetings</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Secure arrangements</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Location flexibility</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="font-medium">Safety protocols</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Single Premium Testimonial Section -->
    <section class="py-24 relative scroll-reveal premium-testsec">
        <div class="container mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-5xl md:text-6xl font-bold heading-font gradient-text mb-6 text-glow">Success Story</h2>
                <p class="text-2xl text-white/70 max-w-3xl mx-auto">Hear from our premium community members</p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="ultra-glass p-12 rounded-3xl shadow-2xl floating hover-lift">
                    <div class="flex flex-col md:flex-row items-center gap-12">
                        <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=300&h=300&fit=crop&crop=faces" alt="Success Story" class="w-40 h-40 rounded-2xl object-cover shadow-2xl">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-6 opacity-50"><path d="M10 11h-4a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v6c0 2.667-1.333 4.333-4 5"></path><path d="M19 11h-4a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v6c0 2.667-1.333 4.333-4 5"></path></svg>
                            <p class="text-2xl italic premium-text mb-8 leading-relaxed">I was skeptical at first, but the connections I've made here are genuine. I've found not just clients, but people who truly appreciate me for who I am. This platform changed my life completely.</p>
                            <div>
                                <p class="font-bold text-xl premium-text">Elena V.</p>
                                <p class="text-indigo-400 text-lg font-medium">Top Model, 2 years</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ultra Premium Call to Action -->
    <section class="py-24 gradient-bg relative overflow-hidden ultra-premiumsec">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="container mx-auto relative z-10">
            <div class="text-center text-white">
                <h2 class="text-5xl md:text-7xl font-bold heading-font mb-8 text-glow">Ready to Find Your Connection?</h2>
                <div class="ultra-intro">
                     <p class="text-2xl mb-12 opacity-90 max-w-4xl mx-auto">Join thousands of models and users already experiencing meaningful connections on our premium platform</p>
                 </div>



                <div class="ul-premiumdiv flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">

                    <button class="px-12 py-5 bg-white text-indigo-600 font-bold rounded-xl hover:bg-gray-100 transition duration-300 shadow-2xl text-xl hover-lift" <?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?>>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        Become a Model
                    </button>

                    <button class="px-12 py-5 bg-transparent border-3 border-white text-white font-bold rounded-xl hover:bg-white/10 transition duration-300 text-xl hover-lift"<?php if (!isset($_SESSION["log_user_id"])) { ?>   onclick="window.location.href='<?= SITEURL.'login.php' ?>'" <?php }?> >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        Join as Member
                    </button>

                </div>

                <div class="ultra-glass p-8 rounded-2xl max-w-3xl mx-auto border border-white/20 floating">
                    <p class="text-2xl italic mb-3">"The chemistry of connection cannot be faked. Find your authentic match today."</p>
                    <p class="text-lg opacity-75">- Live Models Philosophy</p>
                </div>
            </div>
        </div>
    </section>
</main>


    <div class="modal-overlay" id="success_modal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Explore Premium Features</h2>
                <button class="close-modal" type="button" onclick="CloseModal('success_modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modal_success_message">

                <p>👑 Premium Features - Exploring advanced platform capabilities...</p>

                <a class="btn btn-primary" onclick="CloseModal('success_modal')" >Ok</a>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        function SubmitForm() {

            let username = $("#username").val().trim();
            let errorEl  = $("#error_username");
            errorEl.text("");

            if (/\s/.test(username)) {
                errorEl.text("❌ Username must not contain spaces.");
                return false;
            }

            return true; 
        }


        function ShowExplore()
        {
            $('#success_modal').addClass('active');
        }

        function CloseModal(id)
        {

        $(`#${id}`).removeClass('active');
        }


        function handleSearchInput(element) {
            let value = element.value.trim();
            if (value.length > 0) {
                $.ajax({
                    url: 'ajax/search.php',
                    type: 'POST',
                    data: { search: value },
                    success: function (response) {
                        $('#searchResults').html(response).show();
                    }
                });
            } else {
                $('#searchResults').hide().html('');
            }
        }

        $(document).on('click', function (e) {

            if (!$(e.target).closest('#searchInput, #searchResults').length) {
                $('#searchResults').hide().html('');
            }
        });

        function filterModels(link) {
   
            window.location.href = 'all-models.php?filter=' + encodeURIComponent(link);
            return false;
        }

    </script>


    <?php  include('includes/footer.php'); ?>


  </body>
</html>




