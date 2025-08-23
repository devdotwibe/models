<?php 
session_start();
include('includes/config.php');
include('includes/helper.php');
$usern = $_SESSION["log_user"];
$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
$user_have_preminum = false;
if ($userDetails) {
	    $result = CheckPremiumAccess($userDetails['id']);

        if ($result && $result['active']) {

            $user_have_preminum = true;
        }
		
} else {
  echo '<script>window.location.href="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Live Models - Premium Dating Platform</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php include('includes/head.php'); ?>
<style>
    * {
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Inter', sans-serif;
        background: radial-gradient(ellipse at top, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
        color: #fff;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

  

    /* REMOVED bottom-section with error text */

    /* Mobile Responsive */
    @media (max-width: 768px) {
       
    }

  

    @media (max-width: 480px) {
       
    }

    /* Loading Animation */
   .activity-page .loading {
        display: inline-block;
        width: 24px;
        height: 24px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #8b5cf6;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
</head>
<body class="advt-page activity-page min-h-screen bg-animated text-white socialwall-page">
<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

<!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>

<?php

    $getSettings = mysqli_query($con, "SELECT discount_price_show, updated_at FROM admin_settings ORDER BY id DESC LIMIT 1");

    $settings = mysqli_fetch_assoc($getSettings);

    $discountPriceShow = true;

    $updatedAt = $settings['updated_at'];

    if ($updatedAt) {
        $timeDiff = time() - strtotime($updatedAt);
        if ($timeDiff > 86400 && $settings['status'] == 'No') {

            $discountPriceShow = false;
        }
    }

    $premium_amounts = [
        'basic_with_discount' => 39,
        'basic_without_discount' => 49,
        'diamond_with_discount' => 149,
        'diamond_without_discount' => 199,
        'basic_with_discount_yearly' => 449,
        'basic_without_discount_yearly' => 588,
        'diamond_with_discount_yearly' => 1999,
        'diamond_without_discount_yearly' => 2388,
    ];

    $basic_monthly_savings = $premium_amounts['basic_without_discount'] - $premium_amounts['basic_with_discount'];
    $basic_annual_savings = $premium_amounts['basic_without_discount_yearly'] - $premium_amounts['basic_with_discount_yearly'];

    $diamond_monthly_savings = $premium_amounts['diamond_without_discount'] - $premium_amounts['diamond_with_discount'];
    $diamond_annual_savings = $premium_amounts['diamond_without_discount_yearly'] - $premium_amounts['diamond_with_discount_yearly'];

    ?>
<!-- NEW ENHANCED Premium Modal with PSYCHOLOGICAL PRESSURE -->
<div class="popup-overlay" id="premium-modal">
        <div class="popup-container">
            <button class="close-btn" onclick="closePremiumModal()">&times;</button>

            <div class="top-icons">
                <div class="top-icon">🚀</div>
                <div class="top-icon">⭐</div>
                <div class="top-icon">💎</div>
            </div>

            <div class="header">
                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/TLM-Tokens-KRvoJD0tEUEu7oeJkcKoGXiUSdzQUo.png" alt="TLM Token" class="tlm-logo">
                <h2 class="title">Unlock Elite Access</h2>
                <p class="subtitle">Join premium members and dominate the streaming experience</p>
            </div>

            <div class="first-time-alert">
                <span class="fire-emoji">🔥</span> FIRST-TIME USER EXCLUSIVE: $39 & $149 Limited Time Deal - Expires in 24 Hours of Joining! <span class="fire-emoji">🔥</span>
            </div>

            <div class="promo-banner">
                <span class="fire-emoji">🔥</span> MASSIVE SAVINGS INSIDE - DON'T MISS OUT! <span class="fire-emoji">🔥</span>
            </div>

            <?php if ($discountPriceShow) { ?>

                <div class="countdown-timer">
                    ⏰ LIMITED TIME: <span id="countdown">23:59:45</span> REMAINING!
                </div>

            <?php } ?>

            <div class="billing-toggle">
                <div class="toggle-container">
                    <div class="toggle-option active" data-billing="monthly">Monthly</div>
                    <div class="toggle-option" data-billing="annual">
                        Annual
                        <span class="savings-badge">SAVE BIG!</span>
                    </div>
                </div>
            </div>


            <div class="pricing-grid">

                <div class="pricing-card">
                    <div class="hot-deal">🔥 HOT!</div>
                    <div class="member-badge premium-member-badge">PRO</div>
                    <div class="badge premium-badge">PREMIUM</div>
                    <div class="plan-name">Basic Premium</div>
                    <div class="price-container">
                        <?php if ($discountPriceShow) { ?>
                            <div class="original-price"
                                data-monthly-orig="<?php echo $premium_amounts['basic_without_discount']; ?>"
                                data-annual-orig="<?php echo $premium_amounts['basic_without_discount_yearly']; ?>">
                                $<?php echo $premium_amounts['basic_without_discount']; ?>
                            </div>
                            <div class="price"
                                data-monthly="<?php echo $premium_amounts['basic_with_discount']; ?>"
                                data-annual="<?php echo $premium_amounts['basic_with_discount_yearly']; ?>">
                                $<?php echo $premium_amounts['basic_with_discount']; ?>
                            </div>
                            <div class="price-period"
                                data-monthly-period="per month"
                                data-annual-period="per year">
                                per month
                            </div>
                            <div class="savings-text show"
                                data-monthly-save="Save $<?php echo $basic_monthly_savings; ?>/month!"
                                data-annual-save="Save $<?php echo $basic_annual_savings; ?>/year!">
                                Save $<?php echo $basic_monthly_savings; ?>/month!
                            </div>
                        <?php } else { ?>

                            <div class="price"
                                data-monthly="<?php echo $premium_amounts['basic_without_discount']; ?>"
                                data-annual="<?php echo $premium_amounts['basic_without_discount_yearly']; ?>">
                                $<?php echo $premium_amounts['basic_without_discount']; ?>
                            </div>
                            <div class="price-period"
                                data-monthly-period="per month"
                                data-annual-period="per year">
                                per month
                            </div>
                        <?php } ?>
                        <div class="bonus-tokens">
                            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/TLM-Tokens-KRvoJD0tEUEu7oeJkcKoGXiUSdzQUo.png" alt="TLM Token" class="token-icon">
                            <span data-monthly-tokens="500" data-annual-tokens="1000">+ 500 TLM tokens</span>
                        </div>
                    </div>
                    <button class="cta-button cta-primary" onclick="upgradeAccount('monthly', 'basic')">Grab This Deal!</button>
                </div>

                <!-- Diamond Elite -->
                <div class="pricing-card elite">
                    <div class="hot-deal">💎 ELITE!</div>
                    <div class="member-badge elite-member-badge">VIP</div>
                    <div class="badge elite-badge">DIAMOND ELITE</div>
                    <div class="plan-name">Diamond Elite</div>
                    <div class="price-container">
                        <?php if ($discountPriceShow) { ?>
                            <div class="original-price"
                                data-monthly-orig="<?php echo $premium_amounts['diamond_without_discount']; ?>"
                                data-annual-orig="<?php echo $premium_amounts['diamond_without_discount_yearly']; ?>">
                                $<?php echo $premium_amounts['diamond_without_discount']; ?>
                            </div>
                            <div class="price"
                                data-monthly="<?php echo $premium_amounts['diamond_with_discount']; ?>"
                                data-annual="<?php echo $premium_amounts['diamond_with_discount_yearly']; ?>">
                                $<?php echo $premium_amounts['diamond_with_discount']; ?>
                            </div>
                            <div class="price-period"
                                data-monthly-period="per month"
                                data-annual-period="per year">
                                per month
                            </div>
                            <div class="savings-text show"
                                data-monthly-save="Save $<?php echo $diamond_monthly_savings; ?>/month!"
                                data-annual-save="Save $<?php echo $diamond_annual_savings; ?>/year!">
                                Save $<?php echo $diamond_monthly_savings; ?>/month!
                            </div>
                        <?php } else { ?>

                            <div class="price"
                                data-monthly="<?php echo $premium_amounts['diamond_without_discount']; ?>"
                                data-annual="<?php echo $premium_amounts['diamond_without_discount_yearly']; ?>">
                                $<?php echo $premium_amounts['diamond_without_discount']; ?>
                            </div>
                            <div class="price-period"
                                data-monthly-period="per month"
                                data-annual-period="per year">
                                per month
                            </div>
                        <?php } ?>
                        <div class="bonus-tokens">
                            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/TLM-Tokens-KRvoJD0tEUEu7oeJkcKoGXiUSdzQUo.png" alt="TLM Token" class="token-icon">
                            <span data-monthly-tokens="2000" data-annual-tokens="5000">+ 2,000 TLM tokens</span>
                        </div>
                    </div>
                    <button class="cta-button cta-elite" onclick="upgradeAccount('monthly', 'diamond')">Claim Diamond Status!</button>
                </div>
            </div>

            <div class="features-section">
                <div class="features-grid">
                    <div class="feature-column">
                        <h4>Basic Premium</h4>
                        <ul class="feature-list">
                            <li>Unlimited chat with models</li>
                            <li>Ad-free streaming experience</li>
                            <li>HD video quality</li>
                            <li>Advanced search & filters</li>
                            <li>Profile visibility boost</li>
                        </ul>
                    </div>

                    <div class="feature-column">
                        <h4 class="elite-title">Diamond Elite Exclusive</h4>
                        <ul class="feature-list elite-features">
                            <li>Everything in Basic Premium</li>
                            <li>Unlimited chat in live streaming</li>
                            <li>Top priority in creator inbox</li>
                            <li>VIP-only exclusive content</li>
                            <li>Diamond Elite status badge</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="token-packages-section">
                <div class="token-packages-title">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/TLM-Tokens-KRvoJD0tEUEu7oeJkcKoGXiUSdzQUo.png" alt="TLM Token" class="token-icon">
                    Explore Token Packages
                </div>
                <div class="token-packages-subtitle">
                    Get extra TLM tokens for premium interactions, gifts, and exclusive content access
                </div>
                <button class="token-packages-btn" onclick="exploreTokens()">
                    🎁 Browse Token Deals
                </button>
                <div class="token-expires">⏰ Special token offers expire soon!</div>
            </div>
        </div>
    </div>

<?php 
//Code for checking likes you
$liked_you_array = DB::query("select user_id from user_model_likes where model_id=" . $userDetails['id'] . "  AND user_model_likes.like='Yes' ");

?>

<!-- Page Title -->
<div class="page-title">
    <h1>Track all your interactions and discover who's interested in you</h1>
</div>

<!-- Enhanced Upgrade Banner for Free Users -->
<div class="upgrade-banner" onclick="showPremiumModal()">
    🚀 LIMITED TIME: Get Premium for just $39/month (was $49) - Only 47 spots left! Tap to unlock →
</div>

<!-- Main Activity Dropdown -->
<div class="dropdown">
    <button class="dropdown-button" onclick="toggleDropdown()">
        <span id="current-section">❤️ Liked You (<?php echo count($liked_you_array); ?>)</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="6,9 12,15 18,9"></polyline>
        </svg>
    </button>
    <div class="dropdown-content" id="dropdown-menu">
        <div class="dropdown-item" onclick="<?php if (!$user_have_preminum) { ?>selectSection('❤️ Liked You (12)')<?php } ?>">
            <span>❤️ Liked You (<?php echo count($liked_you_array); ?>)</span>
			<?php if (!$user_have_preminum) { ?>
            <span class="premium-lock">🔒 Premium</span>
			<?php } ?>
        </div>
        <div class="dropdown-item" onclick="<?php if (!$user_have_preminum) { ?>selectSection('👀 Viewed Your Profile (8)')<?php } ?>">
            <span>👀 Viewed Your Profile (8)</span>
			<?php if (!$user_have_preminum) { ?>
            <span class="premium-lock">🔒 Premium</span>
			<?php } ?>
        </div>
		<div class="dropdown-item" onclick="selectSection('💬 Group Chat (5)')">
            <span>💬 Group Chat (5)</span>
        </div>
		<div class="dropdown-item" onclick="selectSection('💬 Private Chat (5)')">
            <span>💬 Private Chat (5)</span>
        </div>
		<div class="dropdown-item" onclick="selectSection('📺 Local Meetup (3)')">
            <span>📺 Local Meetup (3)</span>
        </div>
		<div class="dropdown-item" onclick="selectSection('📺 Extended Social (3)')">
            <span>📺 Extended Social (3)</span>
        </div>
		<div class="dropdown-item" onclick="selectSection('📺 Overnight Social (3)')">
            <span>📺 Overnight Social (3)</span>
        </div>
		<?php /*?>
        <div class="dropdown-item" onclick="selectSection('💬 Chat Requests (5)')">
            <span>💬 Chat Requests (5)</span>
        </div>
        <div class="dropdown-item" onclick="selectSection('📺 Watch Requests (3)')">
            <span>📺 Watch Requests (3)</span>
        </div>
        <div class="dropdown-item" onclick="selectSection('🧡 Meet Requests (2)')">
            <span>🧡 Meet Requests (2)</span>
            <span class="premium-lock">🔒 Premium</span>
        </div>
        <div class="dropdown-item" onclick="selectSection('✈️ Travel Requests (7)')">
            <span>✈️ Travel Requests (7)</span>
            <span class="premium-lock">🔒 Premium</span>
        </div><?php */ ?>
        <div class="dropdown-item" onclick="<?php if (!$user_have_preminum) { ?>selectSection('🎯 My Matches (15)')<?php } ?>">
            <span>🎯 My Matches (15)</span>
			<?php if (!$user_have_preminum) { ?>
            <span class="premium-lock">🔒 Premium</span>
			<?php } ?>
        </div>
        <div class="dropdown-item" onclick="selectSection('💖 You Liked (23)')">
            <span>💖 You Liked (23)</span>
        </div>
        <div class="dropdown-item" onclick="selectSection('👁️ You Viewed (45)')">
            <span>👁️ You Viewed (45)</span>
        </div>
        <div class="dropdown-item" onclick="selectSection('📩 You Contacted (15)')">
            <span>📩 You Contacted (15)</span>
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="search-container">
    <input type="text" class="search-bar" placeholder="🔍 Search by Name or City">
</div>

<!-- Secondary Filters -->
<div class="secondary-filters-row">
    <button class="secondary-filter-btn active">Recently Active</button>
    <button class="secondary-filter-btn">Hide Messaged</button>
    <button class="secondary-filter-btn">New Members</button>
    <button class="secondary-filter-btn">Near Me</button>
    <button class="secondary-filter-btn">Verified Photos</button>
    <button class="secondary-filter-btn">Premium Only</button>
</div>

<!-- Sort Dropdown Only (Removed Status Filters) -->
<div class="sort-dropdown">
    <label>Sort by:</label>
    <select class="sort-select" id="sort-select">
        <option>Most Recent</option>
        <option>Online Now</option>
        <option>Verified First</option>
        <option>Distance</option>
        <option>Age</option>
        <option>Premium First</option>
        <option>Most Popular</option>
    </select>
</div>

<!-- Models Grid -->
<div class="models-grid">

<?php if(!empty($liked_you_array)){
	$liked_you_ids = array();
	foreach($liked_you_array as $lk_you){
		$liked_you_ids[] = $lk_you['user_id'];
	}
		$idList = implode(',', $liked_you_ids);
		$sqls = "SELECT * FROM model_user mu WHERE mu.id IN ($idList)";
		$resultd = mysqli_query($con, $sqls); 
		if (mysqli_num_rows($resultd) > 0) {
			
			while ($rowesdw = mysqli_fetch_assoc($resultd)) {

                        $unique_id = $rowesdw['unique_id'];

                        if (!empty($rowesdw['profile_pic'])) {
                            $profile_pic = SITEURL . $rowesdw['profile_pic'];
                        } else {
                            $profile_pic = SITEURL . 'assets/images/model-gal-no-img.jpg';
                        }

                        if (!empty($rowesdw['username'])) {
                            $modalname = $rowesdw['username'];
                        } else {
                            $modalname = $rowesdw['name'];
                        }

                        $is_user_preminum = CheckPremiumAccess($rowesdw['id']);

                        $is_user_new = IsNewUser($rowesdw['id']);

                        $extra_details = DB::queryFirstRow("SELECT status FROM model_extra_details WHERE unique_model_id = %s ", $unique_id);
                ?>
		
				<!-- Model Card 1 -->
    <div class="model-card" data-premium="false" onclick="<?php if (!$user_have_preminum) { ?>showPremiumModal()<?php } ?>">
        <div style="position: relative;">
            <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">
			
				<span class="profile-badge badge-live">Live</span>

                                        <?php if($is_user_new) { ?>

                                             <span class="profile-badge badge-new">New</span>

                                        <?php } ?>

                                        <?php if($is_user_preminum) { ?>

                                             <span class="profile-badge badge-premium">Premium</span>

                                        <?php } ?>

                                        <?php if (!empty($extra_details) && !empty($extra_details) && $extra_details['status'] == 'Published') { ?>
                                            <span class="profile-badge badge-verified">Verified</span>
                                        <?php } ?>
			
			</div>
        </div>
        
		
		<div class="model-info">
            <div class="model-name">
                <span><?php echo ucfirst($modalname); ?></span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">
				<?php if (!empty($rowesdw['age'])) {
                                            echo ', ' . $rowesdw['age'];
                                        } ?></span>
            </div>
			<?php if (!empty($rowesdw['city']) || !empty($rowesdw['country'])) { ?>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">
			
			<?php $modelcity = $rowesdw['city'];
                                    $cities = DB::queryFirstRow("SELECT name FROM cities WHERE id =  %s ", $rowesdw['city']);
                                    if (!empty($cities)) {
                                        $modelcity = $cities['name'];
                                    }
                                    $modelcountry = $rowesdw['country'];
                                    $countries = DB::queryFirstRow("SELECT name FROM countries WHERE id =  %s ", $rowesdw['country']);
                                    if (!empty($countries)) {
                                        $modelcountry = $countries['name'];
                                    } 
			echo $modelcity; 
			if (!empty($modelcity) && !empty($modelcountry)) { ?> • <?php } ?> <?php echo $modelcountry; ?>
									
			</div>
			<?php } ?>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">Just Now • <?php if ($user_have_preminum) { ?> 👑 Premium<?php } ?></div>
			<?php if (!$user_have_preminum) { ?>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
			<?php } ?>
            
			
			<div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); <?php if (!$user_have_preminum) { ?>showPremiumModal();<?php } ?>" >✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); <?php if (!$user_have_preminum) { ?>showPremiumModal();<?php } ?>" >♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); <?php if (!$user_have_preminum) { ?>showPremiumModal();<?php } ?>" >👤</button>
            </div>
			
			
        </div>
		
		
		
    </div>
		
		
		
		
		<?php
			}
		}
	
	
}else{
	
	echo 'Not found any liked members.';
	
} ?>


    
</div>

<?php include('includes/footer.php'); ?>
<?php /*?>
<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <a href="#" class="nav-item">
        <div class="nav-icon">🔍</div>
        <span>Search</span>
    </a>
    <a href="#" class="nav-item">
        <div class="nav-icon">⚡</div>
        <span>Boost</span>
    </a>
    <a href="#" class="nav-item active">
        <div class="nav-icon">☰</div>
        <span>Menu</span>
        <div style="position: absolute; top: -6px; right: -6px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; font-weight: 800; display: flex; align-items: center; justify-content: center;">39</div>
    </a>
    <a href="#" class="nav-item">
        <div class="nav-icon">👤</div>
        <span>Profile</span>
    </a>
</nav> <?php */ ?>

<script>
    // User state management
    let isUserPremium = false;

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

    // Countdown Timer
    function updateCountdown() {
        const countdownElement = document.getElementById('countdown');
        const now = new Date().getTime();
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(0, 0, 0, 0);
        const timeLeft = tomorrow.getTime() - now;
        
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        
        countdownElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    
    setInterval(updateCountdown, 1000);
    updateCountdown();

    // Billing toggle functionality
    const toggleOptions = document.querySelectorAll('.toggle-option');
    const prices = document.querySelectorAll('.price');
    const originalPrices = document.querySelectorAll('.original-price');
    const pricePeriods = document.querySelectorAll('.price-period');
    const savingsTexts = document.querySelectorAll('.savings-text');
    const bonusTokensSpans = document.querySelectorAll('.bonus-tokens span');

    toggleOptions.forEach(option => {
        option.addEventListener('click', function() {
            toggleOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            const billingType = this.dataset.billing;
            
            prices.forEach(price => {
                const monthlyPrice = price.dataset.monthly;
                const annualPrice = price.dataset.annual;
                price.textContent = billingType === 'annual' ? `$${annualPrice}` : `$${monthlyPrice}`;
            });

            originalPrices.forEach(origPrice => {
                const monthlyOrig = origPrice.dataset.monthlyOrig;
                const annualOrig = origPrice.dataset.annualOrig;
                origPrice.textContent = billingType === 'annual' ? `$${annualOrig}` : `$${monthlyOrig}`;
            });

            pricePeriods.forEach(period => {
                const monthlyPeriod = period.dataset.monthlyPeriod;
                const annualPeriod = period.dataset.annualPeriod;
                period.textContent = billingType === 'annual' ? annualPeriod : monthlyPeriod;
            });

            savingsTexts.forEach(savings => {
                const monthlySave = savings.dataset.monthlySave;
                const annualSave = savings.dataset.annualSave;
                
                if (billingType === 'annual') {
                    savings.textContent = annualSave;
                    savings.classList.add('show');
                } else {
                    savings.textContent = monthlySave;
                    savings.classList.add('show');
                }
            });
            
            bonusTokensSpans.forEach(tokenSpan => {
                const monthlyTokens = tokenSpan.dataset.monthlyTokens;
                const annualTokens = tokenSpan.dataset.annualTokens;
                
                tokenSpan.textContent = billingType === 'annual' ? 
                    `+ ${annualTokens} TLM tokens` : 
                    `+ ${monthlyTokens} TLM tokens`;
            });
        });
    });

    document.querySelectorAll('.savings-text').forEach(savings => {
        savings.classList.add('show');
    });

    function toggleDropdown() {
        const dropdown = document.getElementById("dropdown-menu");
        dropdown.classList.toggle("show");
    }

    function selectSection(sectionText) {
        const premiumSections = [
            '❤️ Liked You (12)',
            '👀 Viewed Your Profile (8)',
            '🧡 Meet Requests (2)',
            '✈️ Travel Requests (7)',
            '🎯 My Matches (15)'
        ];
        
        if (premiumSections.includes(sectionText) && !isUserPremium) {
            showPremiumModal();
            return;
        }
        
        document.getElementById("current-section").innerText = sectionText;
        document.getElementById("dropdown-menu").classList.remove("show");
    }

    function showPremiumModal() {
        document.getElementById("premium-modal").classList.add("show");
        document.body.style.overflow = 'hidden';
    }

    function closePremiumModal() {
        document.getElementById("premium-modal").classList.remove("show");
        document.body.style.overflow = 'auto';
    }

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 700;
            z-index: 10001;
            animation: slideIn 0.3s ease;
        `;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-button') && !event.target.closest('.dropdown')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
        
        if (event.target === document.getElementById("premium-modal")) {
            closePremiumModal();
        }
    }

    document.querySelectorAll('.secondary-filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.secondary-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    function toggleMenu() {
        console.log('Menu toggled');
    }

    function upgradeAccount(plan) {
        const planDetails = {
            monthly: {
                price: '$39/month',
                savings: 'Save $10/month (20% OFF)',
                total: '$39'
            },
            annual: {
                price: '$149/month',
                savings: 'Save $389/year (61% OFF)',
                total: '$1999/year'
            }
        };

        const selected = planDetails[plan];
        
        const button = event.target;
        const originalText = button.textContent;
        button.innerHTML = '<div class="loading"></div> Processing...';
        button.disabled = true;
        
        setTimeout(() => {
            alert(`🚀 CONGRATULATIONS! You're upgrading to Premium!

✨ Selected Plan: ${selected.price}
💰 ${selected.savings}
💳 Total: ${selected.total}

🎉 Premium Benefits Activated:
• See who liked you instantly
• Unlimited chat messaging
• Advanced filters & search
• Travel requests & matches
• Priority support 24/7
• Completely ad-free experience
• Boost profile visibility 5x
• Access to premium events
• Video chat with models

🔥 You saved this exclusive first-time user offer!`);
            
            isUserPremium = true;
            closePremiumModal();
            
            const premiumBadge = document.createElement('div');
            premiumBadge.className = 'premium-badge';
            premiumBadge.textContent = '👑';
            document.querySelector('.user-avatar').appendChild(premiumBadge);
            
            document.querySelector('.upgrade-banner').style.display = 'none';
            
            document.querySelectorAll('.upgrade-btn').forEach(btn => {
                btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                btn.style.color = 'white';
                btn.textContent = '💬 Start Chat';
            });
            
            showNotification('🎉 Welcome to Premium! You made the right choice!');
            
            button.innerHTML = originalText;
            button.disabled = false;
        }, 2000);
    }

    function exploreTokens() {
        alert(`🎁 Token Packages Available:

💎 Starter Pack: 100 tokens - $9.99
🔥 Popular Pack: 500 tokens - $39.99 (20% bonus!)
⭐ Premium Pack: 1,200 tokens - $79.99 (40% bonus!)
👑 Elite Pack: 3,000 tokens - $149.99 (60% bonus!)

Use tokens for:
• Send premium gifts to models
• Unlock exclusive content
• Priority messaging
• Special interactions

⏰ Limited time bonus tokens expire soon!`);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.model-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });

        const upgradeBanner = document.querySelector('.upgrade-banner');
        if (upgradeBanner) {
            setInterval(() => {
                upgradeBanner.style.background = 'linear-gradient(135deg, #f7931e, #ff6b35, #f7931e)';
                setTimeout(() => {
                    upgradeBanner.style.background = 'linear-gradient(135deg, #ff6b35, #f7931e, #ff6b35)';
                }, 2000);
            }, 4000);
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePremiumModal();
            document.getElementById("dropdown-menu").classList.remove("show");
        }
        if (e.key === 'p' && e.ctrlKey) {
            e.preventDefault();
            showPremiumModal();
        }
    });

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
</script>
</body>
</html>