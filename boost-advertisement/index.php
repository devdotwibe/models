<?php session_start(); 

include('../includes/config.php');
include('../includes/helper.php');

if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);

	if(!$userDetails){
		echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
		echo "<script>window.location='".SITEURL."/login.php';</script>";
		die;
	}
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."/login.php';</script>";
	die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Live Models - Services Dashboard</title>
    <meta name="description" content="Book your exclusive international tour experience with verified models">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
	<?php  include('../includes/head.php'); ?>

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />


</head>
<body class="boost_adver min-h-screen text-white socialwall-page">


<?php 

  include('../includes/side-bar.php');

  include('../includes/profile_header_index.php');

?>
<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

<main class="py-12">
    <div class="container mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-4">Boost Your Advertisement</h1>
            <p class="text-lg text-white/70 max-w-2xl mx-auto">Get more views, engagement, and clients with smart promotion</p>
        </div>

        <!-- Form Container -->
        <div class="max-w-5xl mx-auto">
            <form class="space-y-8" onsubmit="submitPromotion(event)">
                
                <!-- Quick Setup Options -->
                <div class="ultra-glass p-8 rounded-3xl shadow-2xl">
                    <h2 class="text-2xl font-bold premium-text mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 1v6m0 6v6"></path>
                            <path d="m21 12-6-3-6 3-6-3"></path>
                        </svg>
                        Choose Your Goal
                    </h2>
                    
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="quick-setup ultra-glass p-6 rounded-2xl border border-white/10" onclick="selectQuickSetup(this, 'views')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold premium-text mb-2">Get More Views</h3>
                                <p class="text-white/70 text-sm mb-4">Increase visibility and profile visits</p>
                                <div class="text-green-400 font-bold">$20-50/day</div>
                                <div class="text-white/50 text-xs">500-1,500 views</div>
                            </div>
                        </div>
                        
                        <div class="quick-setup ultra-glass p-6 rounded-2xl border border-white/10" onclick="selectQuickSetup(this, 'engagement')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold premium-text mb-2">Boost Engagement</h3>
                                <p class="text-white/70 text-sm mb-4">Get more likes, follows, and messages</p>
                                <div class="text-green-400 font-bold">$30-80/day</div>
                                <div class="text-white/50 text-xs">50-200 interactions</div>
                            </div>
                        </div>
                        
                        <div class="quick-setup ultra-glass p-6 rounded-2xl border border-white/10" onclick="selectQuickSetup(this, 'premium')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold premium-text mb-2">Premium Boost</h3>
                                <p class="text-white/70 text-sm mb-4">Maximum exposure + priority placement</p>
                                <div class="text-yellow-400 font-bold">$100-200/day</div>
                                <div class="text-white/50 text-xs">2,000+ views + featured</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Smart Targeting -->
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Audience -->
                    <div class="ultra-glass p-8 rounded-3xl shadow-2xl">
                        <h2 class="text-xl font-bold premium-text mb-6 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Target Audience
                        </h2>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-white font-semibold mb-3">Who do you want to reach?</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="audience-chip p-3 rounded-xl text-center" onclick="toggleChip(this, 'men')">
                                        <div class="text-2xl mb-1">👨</div>
                                        <div class="text-sm">Men</div>
                                    </div>
                                    <div class="audience-chip p-3 rounded-xl text-center" onclick="toggleChip(this, 'women')">
                                        <div class="text-2xl mb-1">👩</div>
                                        <div class="text-sm">Women</div>
                                    </div>
                                    <div class="audience-chip p-3 rounded-xl text-center" onclick="toggleChip(this, 'couples')">
                                        <div class="text-2xl mb-1">💑</div>
                                        <div class="text-sm">Couples</div>
                                    </div>
                                    <div class="audience-chip p-3 rounded-xl text-center" onclick="toggleChip(this, 'all')">
                                        <div class="text-2xl mb-1">🌈</div>
                                        <div class="text-sm">Everyone</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-white font-semibold mb-3">Age Range</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm" onclick="toggleChip(this, '18-25')">18-25</div>
                                    <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm" onclick="toggleChip(this, '26-35')">26-35</div>
                                    <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm" onclick="toggleChip(this, '36-45')">36-45</div>
                                    <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm" onclick="toggleChip(this, '46-55')">46-55</div>
                                    <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm" onclick="toggleChip(this, '55+')">55+</div>
                                    <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm" onclick="toggleChip(this, 'all-ages')">All Ages</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <div class="ultra-glass p-8 rounded-3xl shadow-2xl">
                        <h2 class="text-xl font-bold premium-text mb-6 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Location
                        </h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-white font-semibold mb-3">Reach</label>
                                <div class="space-y-3">
                                    <div class="audience-chip p-4 rounded-xl" onclick="selectLocation(this, 'local')">
                                        <div class="flex items-center">
                                            <div class="text-2xl mr-3">🏙️</div>
                                            <div>
                                                <div class="font-semibold">Local Area</div>
                                                <div class="text-sm text-white/70">Your city and nearby areas</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="audience-chip p-4 rounded-xl" onclick="selectLocation(this, 'national')">
                                        <div class="flex items-center">
                                            <div class="text-2xl mr-3">🇺🇸</div>
                                            <div>
                                                <div class="font-semibold">National</div>
                                                <div class="text-sm text-white/70">Entire country</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="audience-chip p-4 rounded-xl" onclick="selectLocation(this, 'international')">
                                        <div class="flex items-center">
                                            <div class="text-2xl mr-3">🌍</div>
                                            <div>
                                                <div class="font-semibold">International</div>
                                                <div class="text-sm text-white/70">Worldwide reach</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Budget & Duration -->
                <div class="ultra-glass p-8 rounded-3xl shadow-2xl">
                    <h2 class="text-2xl font-bold premium-text mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-indigo-400">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        Budget & Duration
                    </h2>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Budget -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <label class="text-white font-semibold">Daily Budget</label>
                                <span class="text-3xl font-bold text-green-400" id="budgetDisplay">$50</span>
                            </div>
                            <input type="range" class="budget-slider w-full" min="10" max="200" value="50" step="10" oninput="updateBudget(this.value)">
                            <div class="flex justify-between text-white/50 text-sm mt-2">
                                <span>$10</span>
                                <span>$200</span>
                            </div>
                            
                            <!-- Quick Budget Options -->
                            <div class="grid grid-cols-3 gap-3 mt-4">
                                <button type="button" class="audience-chip p-3 rounded-lg text-center" onclick="setBudget(25)">
                                    <div class="font-semibold">$25</div>
                                    <div class="text-xs text-white/70">Starter</div>
                                </button>
                                <button type="button" class="audience-chip p-3 rounded-lg text-center" onclick="setBudget(50)">
                                    <div class="font-semibold">$50</div>
                                    <div class="text-xs text-white/70">Popular</div>
                                </button>
                                <button type="button" class="audience-chip p-3 rounded-lg text-center" onclick="setBudget(100)">
                                    <div class="font-semibold">$100</div>
                                    <div class="text-xs text-white/70">Premium</div>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Duration -->
                        <div>
                            <label class="block text-white font-semibold mb-4">Campaign Duration</label>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="audience-chip p-4 rounded-xl text-center" onclick="selectDuration(this, 1)">
                                    <div class="text-2xl font-bold text-indigo-400">1</div>
                                    <div class="text-sm text-white/70">Day</div>
                                    <div class="text-xs text-green-400 mt-1">Quick boost</div>
                                </div>
                                <div class="audience-chip p-4 rounded-xl text-center" onclick="selectDuration(this, 3)">
                                    <div class="text-2xl font-bold text-indigo-400">3</div>
                                    <div class="text-sm text-white/70">Days</div>
                                    <div class="text-xs text-green-400 mt-1">Most popular</div>
                                </div>
                                <div class="audience-chip p-4 rounded-xl text-center" onclick="selectDuration(this, 7)">
                                    <div class="text-2xl font-bold text-indigo-400">7</div>
                                    <div class="text-sm text-white/70">Days</div>
                                    <div class="text-xs text-green-400 mt-1">Extended reach</div>
                                </div>
                                <div class="audience-chip p-4 rounded-xl text-center" onclick="selectDuration(this, 14)">
                                    <div class="text-2xl font-bold text-indigo-400">14</div>
                                    <div class="text-sm text-white/70">Days</div>
                                    <div class="text-xs text-green-400 mt-1">Maximum impact</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign Summary -->
                    <div class="ultra-glass p-6 rounded-2xl mt-8">
                        <h3 class="text-lg font-semibold premium-text mb-4">Campaign Summary</h3>
                        <div class="grid md:grid-cols-4 gap-4 text-center">
                            <div>
                                <div class="text-2xl font-bold text-green-400" id="totalBudget">$50</div>
                                <div class="text-sm text-white/70">Total Investment</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-blue-400" id="estimatedViews">500-1,000</div>
                                <div class="text-sm text-white/70">Expected Views</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-purple-400" id="estimatedReach">1,000-2,000</div>
                                <div class="text-sm text-white/70">People Reached</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-pink-400" id="campaignLength">1 Day</div>
                                <div class="text-sm text-white/70">Duration</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-8">
                    <button type="button" class="btn-danger px-8 py-4 rounded-xl font-semibold" onclick="goBack()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                        Cancel
                    </button>
                    
                    <div class="flex space-x-4">
                        <button type="button" class="btn-secondary px-8 py-4 rounded-xl font-semibold" onclick="previewCampaign()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Preview
                        </button>
                        <button type="submit" class="btn-primary px-8 py-4 rounded-xl font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline">
                                <path d="M5 12l5 5l10-10"></path>
                            </svg>
                            Launch Campaign
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    // Premium JavaScript Functionality
    document.addEventListener('DOMContentLoaded', function() {
        initializePremiumFeatures();
    });

    let selectedGoal = '';
    let selectedDuration = 1;
    let dailyBudget = 50;
    let selectedLocation = '';

    function initializePremiumFeatures() {
        // Premium Particle System
        function createPremiumParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 12 + 's';
            particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
            particle.style.opacity = Math.random() * 0.8 + 0.2;
            
            const colors = [
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.6)',
                'rgba(6, 182, 212, 0.7)'
            ];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;
            
            document.getElementById('particles').appendChild(particle);
            
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.remove();
                }
            }, 12000);
        }

        setInterval(createPremiumParticle, 150);
    }

    function selectQuickSetup(element, goal) {
        // Remove previous selection
        document.querySelectorAll('.quick-setup').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Add selection to clicked card
        element.classList.add('selected');
        selectedGoal = goal;
        
        // Auto-set budget based on goal
        if (goal === 'views') {
            setBudget(30);
        } else if (goal === 'engagement') {
            setBudget(50);
        } else if (goal === 'premium') {
            setBudget(150);
        }
        
        updateEstimates();
    }

    function toggleChip(element, value) {
        element.classList.toggle('selected');
    }

    function selectLocation(element, location) {
        // Remove previous selection
        element.parentElement.querySelectorAll('.audience-chip').forEach(chip => {
            chip.classList.remove('selected');
        });
        
        // Add selection to clicked element
        element.classList.add('selected');
        selectedLocation = location;
        
        updateEstimates();
    }

    function selectDuration(element, days) {
        // Remove previous selection
        element.parentElement.querySelectorAll('.audience-chip').forEach(chip => {
            chip.classList.remove('selected');
        });
        
        // Add selection to clicked element
        element.classList.add('selected');
        selectedDuration = parseInt(days);
        
        updateCampaignSummary();
    }

    function setBudget(amount) {
        dailyBudget = amount;
        document.querySelector('.budget-slider').value = amount;
        document.getElementById('budgetDisplay').textContent = `$${amount}`;
        updateEstimates();
        updateCampaignSummary();
    }

    function updateBudget(value) {
        dailyBudget = parseInt(value);
        document.getElementById('budgetDisplay').textContent = `$${value}`;
        updateEstimates();
        updateCampaignSummary();
    }

    function updateEstimates() {
        let multiplier = 1;
        
        // Adjust based on goal
        if (selectedGoal === 'engagement') multiplier = 0.8;
        if (selectedGoal === 'premium') multiplier = 1.5;
        
        // Adjust based on location
        if (selectedLocation === 'local') multiplier *= 0.7;
        if (selectedLocation === 'international') multiplier *= 1.3;
        
        const views = Math.floor(dailyBudget * 10 * multiplier) + '-' + Math.floor(dailyBudget * 20 * multiplier);
        const reach = Math.floor(dailyBudget * 20 * multiplier) + '-' + Math.floor(dailyBudget * 40 * multiplier);
        
        document.getElementById('estimatedViews').textContent = views;
        document.getElementById('estimatedReach').textContent = reach;
    }

    function updateCampaignSummary() {
        const totalBudget = dailyBudget * selectedDuration;
        document.getElementById('totalBudget').textContent = '$' + totalBudget;
        document.getElementById('campaignLength').textContent = selectedDuration + (selectedDuration === 1 ? ' Day' : ' Days');
    }

    function previewCampaign() {
        if (!selectedGoal) {
            alert('⚠️ Please select a campaign goal first.');
            return;
        }
        
        alert('🔍 Campaign Preview:\n\n' +
              `Goal: ${selectedGoal.charAt(0).toUpperCase() + selectedGoal.slice(1)}\n` +
              `Daily Budget: $${dailyBudget}\n` +
              `Duration: ${selectedDuration} day(s)\n` +
              `Total Investment: $${dailyBudget * selectedDuration}\n` +
              `Location: ${selectedLocation || 'Not specified'}\n\n` +
              'Your campaign is ready to launch!');
    }

    function submitPromotion(event) {
        event.preventDefault();
        
        if (!selectedGoal) {
            alert('⚠️ Please select a campaign goal before launching.');
            return;
        }
        
        // Show success message
        alert('🎉 Campaign launched successfully!\n\n' +
              `Your ${selectedGoal} campaign is now live!\n` +
              `Daily budget: $${dailyBudget}\n` +
              `Duration: ${selectedDuration} day(s)\n` +
              `Total investment: $${dailyBudget * selectedDuration}\n\n` +
              'Track your results in the dashboard.');
        
        // Redirect or close modal
        window.history.back();
    }

    function goBack() {
        if (confirm('Cancel campaign setup? Any changes will be lost.')) {
            window.history.back();
        }
    }

    // Initialize estimates on page load
    updateEstimates();
    updateCampaignSummary();
</script>

</body>
</html>