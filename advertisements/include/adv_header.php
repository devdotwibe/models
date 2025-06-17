<link rel="stylesheet" type="text/css" href="<?= SITEURL . 'includes/foot-style.css' ?>">
<header class="ultra-glass sticky top-0 z-50 border-b border-white/10">
    <div class="container mx-auto py-4 flex justify-between items-center">
        <a href="<?= SITEURL ?>" class="text-2xl font-bold flex items-center group">
            <img src="<?= SITEURL ?>uploads/live-model-logo-new.png" alt="The Live Models" class="h-12 mr-3 group-hover:scale-110 transition duration-500">
        </a>
        <div class="flex items-center space-x-8">
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
			
				<?php if ($_SESSION["log_user"]) { ?>
			
				<a class="btn-primary px-8 py-3 rounded-full font-semibold shadow-lg" href="<?= SITEURL ?>logout.php">
				 Logout
				</a>

                <?php } else { ?>
                <button class="btn-primary px-8 py-3 rounded-full font-semibold shadow-lg" onclick="handleSignIn()">
                Sign In
				</button>
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