<?php if(!empty($get_modal_user[0]['profile_pic']) && file_exists($get_modal_user[0]['profile_pic'])){
				$prof_img = SITEURL.$get_modal_user[0]['profile_pic'];
			} else{
				$prof_img = SITEURL.'assets/images/model-gal-no-img.jpg';
			} ?>

  <!-- Header -->
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
          <img src="<?php echo $prof_img; ?>" alt="Profile" class="w-10 h-10 rounded-full border-2 border-purple-500">
          <div class="online-dot"></div>
        </div>
      </div>
    </div>
  </header>
