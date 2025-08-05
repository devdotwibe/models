<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<!-- Mobile Navigation -->
<div class="mobile-nav" id="mobileNav">
    <div class="flex justify-between items-center mb-8">
        <a href="#" class="text-2xl font-bold flex items-center">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-jXeBRuA3MHFzdzWLPiwsY7t7uYmioN.png" alt="The Live Models" class="h-10 mr-2">
        </a>
        <button id="closeMobileNav" class="text-white/70 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    <nav class="mb-8">
        <ul class="space-y-4">
            <li><a href="#" class="block py-3 px-2 text-white/90 hover:text-white hover:bg-white/5 rounded-lg transition duration-300">Home</a></li>
            <li><a href="#" class="block py-3 px-2 text-white/90 hover:text-white hover:bg-white/5 rounded-lg transition duration-300">Models</a></li>
            <li><a href="#" class="block py-3 px-2 text-white/90 hover:text-white hover:bg-white/5 rounded-lg transition duration-300">Services</a></li>
            <li><a href="#" class="block py-3 px-2 text-white/90 hover:text-white hover:bg-white/5 rounded-lg transition duration-300">Gallery</a></li>
            <li><a href="#" class="block py-3 px-2 text-white/90 hover:text-white hover:bg-white/5 rounded-lg transition duration-300">Contact</a></li>
        </ul>
    </nav>
    <div class="flex items-center space-x-3 text-sm text-white/80 mb-6">
        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
        <span class="font-medium">50K+ Online</span>
    </div>
    <button class="btn-primary w-full px-6 py-3 rounded-full font-semibold shadow-lg mb-4">
        Sign In
    </button>
    <button class="btn-secondary w-full px-6 py-3 rounded-full font-semibold shadow-lg">
        Sign Up
    </button>
</div>

<!-- Ultra Premium Header -->
<header class="ultra-glass sticky-header top-0 z-50 border-b border-white/10 header-profile">
    <div class="container mx-auto py-4 px-4 flex justify-between items-center header-a-pro">
        <a href="#" class="text-2xl font-bold flex items-center group">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-jXeBRuA3MHFzdzWLPiwsY7t7uYmioN.png" alt="The Live Models" class="h-8 sm:h-10 md:h-12 mr-2 md:mr-3 group-hover:scale-110 transition duration-500">
        </a>
        <div class="hidden md:flex items-center space-x-4 lg:space-x-8">
            <a href="#" class="text-white/80 hover:text-white transition duration-300">Home</a>
            <a href="#" class="text-white/80 hover:text-white transition duration-300">Models</a>
            <a href="#" class="text-white/80 hover:text-white transition duration-300">Services</a>
            <a href="#" class="text-white/80 hover:text-white transition duration-300">Gallery</a>
            <a href="#" class="text-white/80 hover:text-white transition duration-300">Contact</a>
        </div>
        <div class="flex items-center space-x-2 sm:space-x-4">
            <div class="hidden lg:flex items-center space-x-3 text-sm text-white/80">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="font-medium">50K+ Online</span>
            </div>
            <button class="btn-primary px-4 sm:px-6 py-2 rounded-full font-semibold shadow-lg text-sm sm:text-base">
                Sign In
            </button>
            <button class="md:hidden" id="openMobileNav">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
        </div>
    </div>
</header>