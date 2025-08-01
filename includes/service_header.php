<header class="header glass">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-2rqoMgilFSKGHIOncdCmYHiKATfRw2.png" alt="The Live Models" class="logo">
        <h1 class="text-lg md:text-xl font-bold bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text text-transparent font-serif">Services Dashboard</h1>
      </div>
      <div class="flex items-center gap-3">
        <!-- Countdown Widget -->
        <div class="countdown-widget" onclick="showUpcomingDetails()">
          <svg class="countdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <div class="countdown-info">
            <div class="countdown-label">Next Session</div>
            <div class="countdown-time countdown-urgent" id="nextSessionTime">01:23:45</div>
          </div>
          <div class="countdown-badge">3</div>
        </div>

        <div id="liveIndicator" class="op-live live-indicator">
          <div class="live-dot"></div>
          LIVE
        </div>
        <div class="relative">
          <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full border-2 border-indigo-500">
          <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
        </div>
      </div>
    </div>
  </header>