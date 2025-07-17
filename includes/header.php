<?php
//session_start(); 
include('config.php');
$hShowIcon = false;
$hCoin = 0;
if (isset($_SESSION["log_user_id"])) {
  $usern = $_SESSION["log_user"];
  $userDetails = DB::queryFirstRow("SELECT * FROM model_user WHERE id = %s ", $_SESSION['log_user_id']);
  if ($userDetails) {
    $hShowIcon = true;
    $hCoin = $userDetails['balance'];
  }
}

?>
<!--<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<script src="<?= 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js' ?>"></script>-->
<link rel="stylesheet" type="text/css" href="<?= SITEURL . 'includes/foot-style.css' ?>">
<style type="text/css">
  .bot_plus {
    transition: 0.3s !important;
  }

  .bot_plus:hover {
    transform: scale(1.1);
  }

  .navbar {
    padding-top: 20px;
    padding-bottom: 20px;
  }

  nav {
    border-bottom: 2px solid #d83b1b;
  }

  .side-menu-list {
    overflow-y: scroll;
    height: calc(100vh - 170px);
  }

  @media screen and (max-width: 600px) {
    .navbar-collapse .navbar-responsive-collapse .collapse .in {
      width: 100% !important;
    }

    .side-menu {
      display: none !important;
    }

  }

  @media screen and (min-width: 600px) {
    .navbar-collapse .navbar-responsive-collapse .collapse .in {
      width: 100% !important;
    }

    body {
      overflow-x: hidden !important;
    }
  }

  @media screen and (max-width: 767px) {
    .desktop-view {
      display: none !important;
    }

    .mobail-view img {
      display: block !important;
    }
  }

  .mobail-view img {
    height: 65px;
    width: 93%;
    margin-left: 10px;
    padding: 10px 0px 0px 0px;
    display: none;
  }
</style>

<style>
  .logo {
    width: 410px;
  }

  @media screen and (min-width: 767px) {
    .show-mobile {
      display: none;
    }
  }

  @media screen and (max-width: 767px) {
    .logo {
      width: auto;
      padding-left: 0;
    }

    .far {
      font-weight: 900;
    }

    .navbar-toggle {
      /* margin-right: 0; */

    }

    /* .navbar-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
  } */

  }
</style>
<!-- <script>
$(document).ready(function(){
  $("#darkmode1").click(function(){
     //alert("ok");
    $("#darkmode_text1").text("Normal Mode");
    $("body").toggleClass("dark-mode");
    $("p").toggleClass("dark-mode-for-tag");
    $("h1").toggleClass("dark-mode-for-tag");
    $("h2").toggleClass("dark-mode-for-tag");
    $("h3").toggleClass("dark-mode-for-tag");
    $("h4").toggleClass("dark-mode-for-tag");
    $("h5").toggleClass("dark-mode-for-tag");
    $("h6").toggleClass("dark-mode-for-tag");
    $("span").toggleClass("dark-mode-for-tag");
    $("button").toggleClass("dark-mode-for-tag");
    $("#menu").toggleClass("dark-mode");
    $("#menu").toggleClass("dark-mode");
    $("#footer li").toggleClass("dark-mode");
    $("#menuToggle input:checked ~ span").toggleClass("dark-mode-for-tag");
    $(".btn-success").toggleClass("dark-mode-for-tag");
    $(".btn-info").toggleClass("dark-mode-for-tag");
    $("select").toggleClass("dark-mode");
    $("#sub-floor").toggleClass("dark-mode");
    $(".footer-tint").toggleClass("dark-mode");
    $(".navbar-inverse").toggleClass("dark-mode");
    $(".sml_tst").toggleClass("dark-mode");
    $("header").toggleClass("dark-mode");
    $("footer").toggleClass("dark-mode");
    $(".modal-content").toggleClass("dark-mode-for-model");
  });
});
</script> -->

<header class="ultra-glass sticky top-0 z-50 border-b border-white/10 <?php if (basename($_SERVER['PHP_SELF']) == 'all-models.php') { echo 'header'; } ?> ">
    <div class="container mx-auto py-4 flex justify-between items-center">
        <a href="<?= SITEURL ?>" class="text-2xl font-bold flex items-center group">
            <img src="<?= SITEURL ?>uploads/live-model-logo-new.png" alt="The Live Models" class="h-12 mr-3 group-hover:scale-110 transition duration-500">
        </a>
        <div class="flex items-center space-x-8 <?php if (basename($_SERVER['PHP_SELF']) == 'all-models.php') { echo 'header-content'; } ?>">
		<?php if (basename($_SERVER['PHP_SELF']) == 'all-models.php') { ?>
				<div class="header-actions">
                   <button class="header-btn active" title="Grid View" id="gridViewBtn" style="display:none;">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="header-btn" title="Menu" id="menuBtn" style="display:none;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="header-btn" title="Advanced Filters" id="filterBtn">
                        <i class="fas fa-filter"></i>
                    </button>
                    
                   <div class="sort-dropdown" style="display:none;">
                        <button class="sort-btn" id="sortBtn">
                            <span>Sort by</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="sort-options" id="sortOptions">
                            <div class="sort-option" data-sort="newest">Newest First</div>
                            <div class="sort-option" data-sort="online">Online Now</div>
                            <div class="sort-option" data-sort="popular">Most Popular</div>
                            <div class="sort-option" data-sort="distance">Distance</div>
                            <div class="sort-option" data-sort="price">Price: Low to High</div>
                        </div>
                    </div>
                    
                    <button class="premium-btn" style="display:none;">
                        <i class="fas fa-crown"></i>
                        Go Premium
                    </button>
                </div>
		<?php } else{ ?>
            <div class="hidden lg:flex items-center space-x-8">
                <div class="flex items-center space-x-3 text-sm text-white/80 hover-lift">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="stats-counter text-lg" data-target="50000">0</span>
                    <span class="font-medium">+ Online Now</span>
                </div>
                <div class="flex items-center space-x-3 text-sm text-white/80 hover-lift">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span class="font-medium">24/7 Support</span>
                </div>
                <div class="flex items-center space-x-3 text-sm text-white/80 hover-lift">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-400"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span class="font-medium">100% Secure</span>
                </div>
            </div>
		<?php } ?>
			
				<?php if ($_SESSION["log_user"]) { ?>
			
                <a class="btn-primary px-8 py-3 rounded-full font-semibold shadow-lg" href="<?= SITEURL ?>logout.php">
                Logout
                </a>

                <?php } else { ?>
                <a class="btn-primary px-8 py-3 rounded-full font-semibold shadow-lg" href="<?= SITEURL ?>login.php">
                Sign In
                </a>
              <?php } ?>
			
			
            
        </div>
    </div>
</header>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GD6CJ961PF"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-GD6CJ961PF');
</script>

