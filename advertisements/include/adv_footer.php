<link rel="stylesheet" type="text/css" href="<?=SITEURL?>includes/foot-style.css">
 <!-- Ultra Premium Footer -->
<footer class="bg-black text-white py-20 border-t border-white/10">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-4 gap-12 mb-16">
            <div>
                <h3 class="text-3xl font-bold gradient-text heading-font mb-6">Live Models</h3>
                <p class="text-white/60 mb-6 text-lg leading-relaxed">The premier platform for authentic connections. Chat, Watch, and Meet with amazing verified models in a safe, secure environment.</p>
                <div class="flex space-x-4">
                    <!-- Social Media Icons -->
                    <a href="#" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" onclick="openSocial('facebook')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a href="#" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" onclick="openSocial('twitter')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <path d="M4 4l11.5 11.5M4 20l16-16"></path>
                        </svg>
                    </a>
                    <a href="#" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" onclick="openSocial('instagram')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="#" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" onclick="openSocial('tiktok')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Services</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="<?= SITEURL ?>all-models.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*?>onclick="navigateTo('models')" */ ?> >All Models</a></li>
                    <li><a href="<?= SITEURL ?>advertisements/" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="navigateTo('ads')" */ ?> >Advertisements</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Support</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="<?= SITEURL ?>/supports.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /* onclick="openSupport()" */ ?> >Contact Support</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 read-more-btn" onclick="openVerificationHelp()">Verification Help</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Legal</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openTerms()" */ ?> >Terms of Service</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openPrivacy()" */ ?> >Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openVerificationPolicy()" */ ?> >Verification Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-white/40 text-lg">&copy; <?php echo date('Y')?> Live Models. All rights reserved. Must be 18+ to use this service.</p>
        </div>
    </div>
</footer>



    <script>
        // Enhanced JavaScript functionality
        let currentView = 'grid';
        let currentFilter = 'all';

        // Switch between grid and expanded views
        function switchView(view) {
            const gridView = document.getElementById('gridView');
            const expandedView = document.getElementById('expandedView');
            const viewButtons = document.querySelectorAll('.view-btn');

            // Update button states
            viewButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            if (view === 'grid') {
                gridView.style.display = 'grid';
                expandedView.classList.remove('active');
                currentView = 'grid';
            } else {
                gridView.style.display = 'none';
                expandedView.classList.add('active');
                currentView = 'expanded';
            }
        }

        // Filter content by type
        function filterContent(type) {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('[data-category], [data-type]');

            // Update button states
            filterButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Age verification for adult content
            if (type === 'adult') {
                const confirmed = confirm('You must be 18 years or older to view adult content. Do you confirm you are of legal age?');
                if (!confirmed) {
                    // Reset to general content
                    filterContent('general');
                    return;
                }
            }

            // Filter cards
            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const cardType = card.getAttribute('data-type');

                let shouldShow = false;

                switch(type) {
                    case 'all':
                        shouldShow = true;
                        break;
                    case 'general':
                        shouldShow = category === 'general';
                        break;
                    case 'adult':
                        shouldShow = category === 'adult';
                        break;
                    case 'premium':
                        shouldShow = cardType === 'premium';
                        break;
                }

                card.style.display = shouldShow ? 'block' : 'none';
                if (card.classList.contains('ad-expanded')) {
                    card.style.display = shouldShow ? 'flex' : 'none';
                }
            });

            currentFilter = type;
        }

        // Search functionality
        function performSearch() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const locationFilter = document.getElementById('locationFilter');

            const searchTerm = searchInput.value.toLowerCase();
            const category = categoryFilter.value;
            const location = locationFilter.value;

            console.log('Searching for:', {
                term: searchTerm,
                category: category,
                location: location
            });

            // Show loading state
            const gridView = document.getElementById('gridView');
            const expandedView = document.getElementById('expandedView');

            // Add loading animation
            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'loading';
            loadingDiv.innerHTML = '🔍 Searching for models...';

            if (currentView === 'grid') {
                gridView.appendChild(loadingDiv);
            } else {
                expandedView.appendChild(loadingDiv);
            }

            // Simulate search delay
            setTimeout(() => {
                loadingDiv.remove();
                alert(`Search completed for: "${searchTerm || 'all models'}"${category ? ` in ${category}` : ''}${location ? ` from ${location}` : ''}`);
            }, 1500);
        }

        // Model interaction functions
        function viewProfile(modelId) {
            //alert(`Opening profile for model: ${modelId}`);
			window.location.href = '<?=SITEURL?>advertisements/view.php?id='+modelId;
        }

        function contactModel(modelId) {
            alert(`Opening contact form for model: ${modelId}`);
        }

        function viewPortfolio(modelId) {
            alert(`Opening portfolio for model: ${modelId}`);
        }

        function viewSocials(modelId) {
            alert(`Opening social media links for model: ${modelId}`);
        }

        function viewServices(modelId) {
            alert(`Opening services page for model: ${modelId}`);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Set default filter to general content
            filterContent('general');

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add fade-in animation to cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards
            document.querySelectorAll('.ad-card, .ad-expanded').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add search on Enter key
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        });

        // Responsive navigation toggle
        function toggleMobileNav() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('mobile-open');
        }

        // Add mobile navigation styles
        const mobileStyles = `
            @media (max-width: 768px) {
                .nav-links {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: rgba(0, 0, 0, 0.95);
                    backdrop-filter: blur(20px);
                    flex-direction: column;
                    padding: 2rem;
                    transform: translateY(-100%);
                    opacity: 0;
                    visibility: hidden;
                    transition: all 0.3s ease;
                }

                .nav-links.mobile-open {
                    transform: translateY(0);
                    opacity: 1;
                    visibility: visible;
                }
            }
        `;

        // Add mobile styles to head
        const styleSheet = document.createElement('style');
        styleSheet.textContent = mobileStyles;
        document.head.appendChild(styleSheet);
    </script>
	
	<script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'?>"></script>
	
	<script>
/** TO DISABLE SCREEN CAPTURE **/
document.addEventListener('keyup', (e) => {
    if (e.key == 'PrintScreen') {
        navigator.clipboard.writeText('');
        //alert('Screenshots disabled!');
    }
});

/** TO DISABLE PRINTS WHIT CTRL+P **/
document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && e.key == 'p') {
       // alert('This section is not allowed to print or export to PDF');
        e.cancelBubble = true;
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});
</script>
<?php
if(isset($_SESSION['log_user_id'])){
	DB::update('model_user', array('logged_update' => date('Y-m-d H:i:s')), "id=%s", $_SESSION['log_user_id']);
}
?>