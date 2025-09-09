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
    elseif($_GET['id'] != '' && isset($_GET['id']) )
    {
        $adDetails = get_data('banners',array('id'=>$_GET['id'],'user_id'=>$_SESSION['log_user_id']),true);

        if(!$adDetails){

            echo '<script>alert("Advertisement not found. Going to advertisement list....")</script>';
            echo "<script>window.location='".SITEURL."advertisement/list.php';</script>";
            die;
        }
    }
    else
    {
        echo "<script>window.location='".SITEURL."advertisement/list.php';</script>";
        die;
    }
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."login.php';</script>";
	die;
}


    $adver_have_active_boost = AdverBoostActive($_GET['id'],$con );

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

    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --premium-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        --glass-bg: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.1);
        --neon-purple: #8b5cf6;
        --neon-pink: #ec4899;
        --neon-blue: #06b6d4;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: radial-gradient(ellipse at top, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
        color: #fff;
        overflow-x: hidden;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        min-height: 100vh;
    }

    .heading-font {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        letter-spacing: -0.02em;
    }

    /* Premium Gradients */
    .gradient-bg {
        background: var(--primary-gradient);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradient-shift 3s ease-in-out infinite;
    }

    @keyframes gradient-shift {
        0%, 100% { filter: hue-rotate(0deg); }
        50% { filter: hue-rotate(30deg); }
    }

    /* Ultra Advanced Glass Morphism */
    .ultra-glass {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(40px);
        -webkit-backdrop-filter: blur(40px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.08),
            0 0 0 1px rgba(139, 92, 246, 0.1);
        position: relative;
    }

    .ultra-glass::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(236, 72, 153, 0.05) 100%);
        border-radius: inherit;
        z-index: -1;
    }

    /* Premium Floating Particles */
    .ad-enhanced .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }

    .ad-enhanced .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.8) 0%, transparent 70%);
        border-radius: 50%;
        animation: float-premium 12s infinite linear;
        filter: blur(0.5px);
    }

    .ad-enhanced .particle:nth-child(2n) {
        background: radial-gradient(circle, rgba(236, 72, 153, 0.6) 0%, transparent 70%);
        animation-duration: 15s;
    }

    .ad-enhanced .particle:nth-child(3n) {
        background: radial-gradient(circle, rgba(6, 182, 212, 0.7) 0%, transparent 70%);
        animation-duration: 18s;
    }

    @keyframes float-premium {
        0% {
            opacity: 0;
            transform: translateY(100vh) translateX(0px) scale(0) rotate(0deg);
        }
        10% {
            opacity: 1;
            transform: translateY(90vh) translateX(20px) scale(1) rotate(45deg);
        }
        90% {   font-family: 'Inter', sans-serif;
        background: radial-gradient(ellipse at top, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
        color: #fff;
        overflow-x: hidden;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        min-height: 100vh;
            opacity: 1;
            transform: translateY(10vh) translateX(200px) scale(1.2) rotate(315deg);
        }
        100% {
            opacity: 0;
            transform: translateY(-10vh) translateX(300px) scale(0) rotate(360deg);
        }
    }

    /* Premium Buttons */
    .btn-primary {
        background: var(--primary-gradient);
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        border: none;
        cursor: pointer;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.875rem;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.8s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a67d8, #6b46c1);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 
            0 25px 50px rgba(139, 92, 246, 0.5),
            0 0 0 1px rgba(139, 92, 246, 0.4),
            0 0 30px rgba(139, 92, 246, 0.3);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 
            0 20px 40px rgba(255, 255, 255, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #f87171);
        transition: all 0.4s ease;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
    }

    /* Premium Typography */
    .premium-text {
        background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Form Styles */
    .form-input {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(40px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        color: white;
    }

    .form-input:focus {
        box-shadow: 
            0 0 0 3px rgba(139, 92, 246, 0.3),
            0 10px 30px rgba(139, 92, 246, 0.15);
        transform: translateY(-2px) scale(1.01);
        border-color: rgba(139, 92, 246, 0.5);
        outline: none;
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    /* Budget Slider */
    .budget-slider {
        -webkit-appearance: none;
        appearance: none;
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        outline: none;
    }

    .budget-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 24px;
        height: 24px;
        background: var(--primary-gradient);
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.5);
    }

    .budget-slider::-moz-range-thumb {
        width: 24px;
        height: 24px;
        background: var(--primary-gradient);
        border-radius: 50%;
        cursor: pointer;
        border: none;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.5);
    }

    /* Goal Cards */
    .goal-card {
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .goal-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 40px rgba(139, 92, 246, 0.3);
    }

    .goal-card.selected {
        border-color: rgba(139, 92, 246, 0.8);
        background: rgba(139, 92, 246, 0.1);
        box-shadow: 0 0 30px rgba(139, 92, 246, 0.4);
    }

    .goal-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
        transition: left 0.6s ease;
        z-index: 1;
    }

    .goal-card:hover::before {
        left: 100%;
    }

    /* Audience Targeting */
    .audience-chip {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .audience-chip:hover {
        background: rgba(139, 92, 246, 0.2);
        border-color: rgba(139, 92, 246, 0.5);
        transform: scale(1.05);
    }

    .audience-chip.selected {
        background: rgba(139, 92, 246, 0.3);
        border-color: rgba(139, 92, 246, 0.8);
        color: #ffffff;
    }

    /* Quick Setup Cards */
    .quick-setup {
        transition: all 0.4s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .quick-setup:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(139, 92, 246, 0.2);
    }

    .quick-setup.selected {
        border-color: rgba(139, 92, 246, 0.8);
        background: rgba(139, 92, 246, 0.1);
    }

    /* Responsive Design */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    @media (max-width: 768px) {
        .container { 
            padding: 0 1rem; 
        }
    }

    /* Hover Effects */
    .hover-lift {
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(139, 92, 246, 0.2);
    }
</style>

</head>
<body class="ad-enhanced enhanced5 min-h-screen text-white socialwall-page">


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
                    
                    <div class="grid md:grid-cols-3 gap-6" aria-disabled="true">
                        <div class="quick-setup ultra-glass p-6 rounded-2xl border border-white/10" onclick="selectQuickSetup(this, 'views')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>

                                <input type="hidden" name="plan_type" id="plan_type" value="views" >

                                <h3 class="text-xl font-semibold premium-text mb-2">Get More Views</h3>
                                <p class="text-white/70 text-sm mb-4">Increase visibility and profile visits</p>
                                <div class="text-green-400 font-bold">$20-50/day</div>
                                <div class="text-white/50 text-xs">500-1,500 views</div>
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

                        <?php 

                            $target_values = [];

                             $age_values = [];

                             $location = "";

                             $budget = 50;

                             $duration = "";

                             $total_amount="";

                            $expected_views_range = "";

                            $reached_views_range ="";

                            if($adver_have_active_boost)
                            {
                                $target_audience = $adver_have_active_boost['target_audience'];

                                $age_range = $adver_have_active_boost['age_range'];

                                $location = $adver_have_active_boost['location'];

                                $budget =  $adver_have_active_boost['budget'];

                                $duration =  $adver_have_active_boost['duration'];

                                $total_amount = $adver_have_active_boost['total_amount'];

                                $expected_views_range = $adver_have_active_boost['expected_views_range'];

                                $reached_views_range = $adver_have_active_boost['reached_views_range'];

                                if (strpos($target_audience, ',') !== false) {
                                    $target_values = array_map('trim', explode(',', strtolower($target_audience)));
                                } else {
                                    $target_values = [strtolower(trim($target_audience))];
                                }

                                if (strpos($age_range, ',') !== false) {
                                    $age_values = array_map('trim', explode(',', strtolower($age_range)));
                                } else {
                                    $age_values = [strtolower(trim($age_range))];
                                }


                            }
                        ?>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-white font-semibold mb-3">Who do you want to reach?</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="audience-chip p-3 rounded-xl text-center <?php echo in_array('men', $target_values) ? 'selected' : ''; ?>" onclick="toggleTarget(this, 'men')">
                                        <div class="text-2xl mb-1">👨</div>
                                        <div class="text-sm">Men</div>
                                    </div>
                                    <div class="audience-chip p-3 rounded-xl text-center <?php echo in_array('women', $target_values) ? 'selected' : ''; ?>"   onclick="toggleTarget(this, 'women')">
                                        <div class="text-2xl mb-1">👩</div>
                                        <div class="text-sm">Women</div>
                                    </div>
                                    <div class="audience-chip p-3 rounded-xl text-center <?php echo in_array('couples', $target_values) ? 'selected' : ''; ?>"  onclick="toggleTarget(this, 'couples')">
                                        <div class="text-2xl mb-1">💑</div>
                                        <div class="text-sm">Couples</div>
                                    </div>
                                    <div class="audience-chip p-3 rounded-xl text-center <?php echo in_array('all', $target_values) ? 'selected' : ''; ?>" onclick="toggleTarget(this, 'all')" > 
                                        <div class="text-2xl mb-1">🌈</div>
                                        <div class="text-sm">Everyone</div>
                                    </div>

                                     <input type="hidden" name="user_unique_id" id="user_unique_id" value="<?php echo $userDetails['unique_id'] ?>">

                                     <input type="hidden" name="target_audience[]" id="target_audience" value="<?= $target_audience ?>" >

                                     <input type="hidden" name="ad_id" id="ad_id" value="<?php echo $adDetails['id'] ?>">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-white font-semibold mb-3">Age Range</label>

                                <div class="grid grid-cols-3 gap-2">
                                        <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm <?php echo in_array('18-25', $age_values) ? 'selected' : ''; ?>" 
                                            onclick="toggleRange(this, '18-25')">18-25</div>

                                        <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm <?php echo in_array('26-35', $age_values) ? 'selected' : ''; ?>" 
                                            onclick="toggleRange(this, '26-35')">26-35</div>

                                        <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm <?php echo in_array('36-45', $age_values) ? 'selected' : ''; ?>" 
                                            onclick="toggleRange(this, '36-45')">36-45</div>

                                        <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm <?php echo in_array('46-55', $age_values) ? 'selected' : ''; ?>" 
                                            onclick="toggleRange(this, '46-55')">46-55</div>

                                        <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm <?php echo in_array('55+', $age_values) ? 'selected' : ''; ?>" 
                                            onclick="toggleRange(this, '55+')">55+</div>

                                        <div class="audience-chip px-3 py-2 rounded-lg text-center text-sm <?php echo in_array('all-ages', $age_values) ? 'selected' : ''; ?>" 
                                            onclick="toggleRange(this, 'all-ages')">All Ages</div>
                             
                                        <input type="hidden" name="age_range[]" value="<?= $age_range ?>" id="age_range" >


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
                                    <div class="audience-chip p-4 rounded-xl  <?if ($location =='local') {?> selected <?php } ?>" onclick="selectLocation(this, 'local')" >
                                        <div class="flex items-center">
                                            <div class="text-2xl mr-3">🏙️</div>
                                            <div>
                                                <div class="font-semibold">Local Area</div>
                                                <div class="text-sm text-white/70">Your city and nearby areas</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="audience-chip p-4 rounded-xl  <?if ($location =='national') {?> selected <?php } ?> " onclick="selectLocation(this, 'national')">
                                        <div class="flex items-center">
                                            <div class="text-2xl mr-3">🇺🇸</div>
                                            <div>
                                                <div class="font-semibold">National</div>
                                                <div class="text-sm text-white/70">Entire country</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="audience-chip p-4 rounded-xl <?if ($location =='international') {?> selected <?php } ?>" onclick="selectLocation(this, 'international')"  >
                                        <div class="flex items-center">
                                            <div class="text-2xl mr-3">🌍</div>
                                            <div>
                                                <div class="font-semibold">International</div>
                                                <div class="text-sm text-white/70">Worldwide reach</div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="location" id="location" value="<?= $location ?>">

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
                            <input type="range" class="budget-slider w-full" min="10" id="budget" max="200" value="<?=$budget?>" step="10" oninput="updateBudget(this.value)">

                            <div class="flex justify-between text-white/50 text-sm mt-2">
                                <span>$10</span>
                                <span>$200</span>
                            </div>
                            
                            <!-- Quick Budget Options -->
                            <div class="grid grid-cols-3 gap-3 mt-4">
                                <button type="button" class="audience-chip p-3 rounded-lg text-center" onclick="setBudget(30)">
                                    <div class="font-semibold">$30</div>
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

                                <div class="audience-chip p-4 rounded-xl text-center <?if($duration ==1 ) {?> selected <?php }?>" onclick="selectDuration(this, 1)">
                                    <div class="text-2xl font-bold text-indigo-400">1</div>
                                    <div class="text-sm text-white/70">Day</div>
                                    <div class="text-xs text-green-400 mt-1">Quick boost</div>
                                </div>

                                <div class="audience-chip p-4 rounded-xl text-center  <?if($duration ==3 ) {?> selected <?php }?>" onclick="selectDuration(this, 3)">
                                    <div class="text-2xl font-bold text-indigo-400">3</div>
                                    <div class="text-sm text-white/70">Days</div>
                                    <div class="text-xs text-green-400 mt-1">Most popular</div>
                                </div>

                                <div class="audience-chip p-4 rounded-xl text-center  <?if($duration ==7 ) {?> selected <?php }?>" onclick="selectDuration(this, 7)">
                                    <div class="text-2xl font-bold text-indigo-400">7</div>
                                    <div class="text-sm text-white/70">Days</div>
                                    <div class="text-xs text-green-400 mt-1">Extended reach</div>
                                </div>

                                <div class="audience-chip p-4 rounded-xl text-center  <?if($duration ==14 ) {?> selected <?php }?>" onclick="selectDuration(this, 14)">
                                    <div class="text-2xl font-bold text-indigo-400">14</div>
                                    <div class="text-sm text-white/70">Days</div>
                                    <div class="text-xs text-green-400 mt-1">Maximum impact</div>
                                </div>

                            </div>

                            <input type="hidden" name="duration" id="duration" value="<?=$duration?>" >

                            <input type="hidden" name="total_amount" id="total_amount" value="<?= $total_amount ?>">

                            <input type="hidden" name="expected_views_range" id="expected_views_range" value="<?= $expected_views_range ?>" >

                            <input type="hidden" name="reached_views_range" id="reached_views_range" value="<?= $reached_views_range ?>" >

                        </div>
                    </div>
                    
                    <!-- Campaign Summary -->
                    <div class="ultra-glass p-6 rounded-2xl mt-8">
                        <h3 class="text-lg font-semibold premium-text mb-4">Campaign Summary</h3>
                        <div class="grid md:grid-cols-4 gap-4 text-center">
                            <div>
                                <div class="text-2xl font-bold text-green-400" id="totalBudget"><?= $total_amount ?></div>
                                <div class="text-sm text-white/70">Total Investment</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-blue-400" id="estimatedViews"><?= $expected_views_range ?></div>
                                <div class="text-sm text-white/70">Expected Views</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-purple-400" id="estimatedReach"><?= $reached_views_range ?></div>
                                <div class="text-sm text-white/70">People Reached</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-pink-400" id="campaignLength"><?= $duration ?> Day</div>
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
                        
                        <button type="button" class="btn-primary px-8 py-4 rounded-xl font-semibold" <?php if($adver_have_active_boost) { ?> onclick="ConformLaunch('update')" <?php }else { ?>  onclick="ConformLaunch('create')" <?php } ?> >

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

    <div class="modal-overlay" id="details_modal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Get More Views Details</h2>
                <button class="close-modal" type="button" onclick="CloseModal('details_modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="modal-body">

                <div class="views-info">
                    <p><strong>Advertisement Name:</strong>  <?php echo $adDetails['name'] ?></p>
                    <p><strong>Target Audience:</strong> <span id="target_audience_view"></span></p>
                    <p><strong>Location:</strong> <span id="location_view"></span></p>
                    <p><strong>Age Range:</strong> <span id="age_range_view"></span></p>
                    <p><strong>Budget:</strong> <span id="budget_duration_view"></span></p>
                </div>

                <div style="margin-top: 20px;">
                    <p><strong>Campaign Duration:</strong> <span id="campaign_duration_view"></span></p>
                </div>

                <div style="margin-top: 30px;">
                    <p><strong>Campaign Summary</strong></p>
                    <p><strong>Total Investment:</strong> <span id="total_investment_view"></span></p>
                    <p><strong>Expected Views:</strong> <span id="expected_views_view"></span></p>
                    <p><strong>People Reached:</strong> <span id="people_reached_view"></span></p>
                </div>

            </div>
        </div>
    </div>

     <div class="modal-overlay" id="conform_modal">
          <div class="modal">
              <div class="modal-header">
              <h2 class="modal-title" id="lauch_title">Launch Campaign</span></h2>

              <button class="close-modal" type="button" onclick="CloseModal('conform_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
              </div>

              <div class="modal-body">

                <p id="launch_des" >Do you want to conform the </span>Launch Campaign</strong>?</p>

                <div style="margin-top: 20px;">

                    <input type="hidden" name="accept_id" id="accept_id" >
                    <button class="btn-primary px-7 sm:px-3 py-6  text-white" type="button" id="accept_conform_btn" onclick="SubmitLaunch()" >Yes</button>
                    <button class="btn btn-secondary" type="button" onclick="CloseModal('conform_modal')">Cancel</button>
                </div>

              </div>

          </div>
      </div>


    <div class="modal-overlay" id="success_modal">
      <div class="modal">
          <div class="modal-header">
              <h2 class="modal-title">Success</h2>
              <button class="close-modal" id="closeTipModal" type="button" onclick="CloseModal('success_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
          </div>
          <div class="modal-body" id="modal_success_message">
              

              <button class="btn btn-primary" type="button" onclick="CloseModal('success_modal')">Close</button>
          </div>
      </div>
    </div>


    <div class="modal-overlay" id="error_modal">
      <div class="modal">
          <div class="modal-header">
              <h2 class="modal-title">Success</h2>
              <button class="close-modal" id="closeTipModal" type="button" onclick="CloseModal('error_modal')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>
          </div>
          <div class="modal-body" id="modal_error_message">
              

              <button class="btn btn-primary" type="button" onclick="CloseModal('error_modal')">Close</button>
          </div>
      </div>
    </div>


<?php include('../includes/footer.php'); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>`

<script>

     function CloseModal(id)
    {

       $(`#${id}`).removeClass('active');

    }

    function ConformLaunch(status)
    {
        var target_audience = $('#target_audience').val();
        var location = $('#location').val();
        var age_range = $('#age_range').val();
        var budget = $('#budget').val();
        var duration = $('#duration').val();
        var total_amount = $('#total_amount').val();
        var expected_views_range = $('#expected_views_range').val();
        var reached_views_range = $('#reached_views_range').val();
        var plan_type = $('#plan_type').val();

           var requiredFields = {
                "Target Audience": target_audience,
                "Location": location,
                "Age Range": age_range,
                "Budget": budget,
                "Duration": duration,
                "Total Amount": total_amount,
                "Expected Views": expected_views_range,
                "Reached Views": reached_views_range,
                "Plan Type": plan_type
            };

        for (var field in requiredFields) {

            if (!requiredFields[field] || requiredFields[field].trim() === "") {
                showErrorModal(field + " is required!");
                return false;
            }
        }

        if(status =='update')
        {
            $('#lauch_title').text('Update Launch Campaign');

            $('#launch_des').html('Do you want to conform to </span>Update Changes</strong>?');
        }
        else
        {

            $('#lauch_title').text('Launch Campaign');

            $('#launch_des').html('Do you want to conform the </span>Launch Campaign</strong>?');
        }

        $('#conform_modal').addClass('active');

    }

    function showErrorModal(message) {

        $('#modal_error_message').html("<p style='color:red;'>" + message + "</p>" +
            '<button class="btn btn-primary" type="button" onclick="CloseModal(\'error_modal\')">Close</button>');
        $('#error_modal .modal-title').text("Error");
        $('#error_modal').addClass('active');
    }

    function SubmitLaunch() {

        var target_audience = $('#target_audience').val();
        var location = $('#location').val();
        var age_range = $('#age_range').val();
        var budget = $('#budget').val();
        var duration = $('#duration').val();
        var total_amount = $('#total_amount').val();
        var expected_views_range = $('#expected_views_range').val();
        var reached_views_range = $('#reached_views_range').val();
        var plan_type = $('#plan_type').val();
        var user_unique_id = $('#user_unique_id').val();

        var ad_id = $('#ad_id').val();

        $.ajax({
            url: 'launch_ajax.php',
            type: 'POST',
            data: {
                action:'submit_launch',
                user_unique_id: user_unique_id,
                plan_type: plan_type,
                target_audience: target_audience,
                location: location,
                age_range: age_range,
                budget: budget,
                duration: duration,
                total_amount: total_amount,
                expected_views_range: expected_views_range,
                reached_views_range: reached_views_range,
                ad_id: ad_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {

                    $('#conform_modal').removeClass('active');

                    $('#success_modal').addClass('active');

                    $('#modal_success_message').html("");

                    $('#modal_success_message').prepend(`<p class="success-text">${response.message}</p>`);
           
                } else {
                    alert('Something went wrong: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to submit. Please try again.');
            }
        });
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        initializePremiumFeatures();
    });

    let selectedGoal = '';
    let selectedDuration = 1;
    let dailyBudget = 50;
    let selectedLocation = '';

    // function initializePremiumFeatures() {
    //     // Premium Particle System
    //     function createPremiumParticle() {
    //         const particle = document.createElement('div');
    //         particle.className = 'particle';
    //         particle.style.left = Math.random() * 100 + '%';
    //         particle.style.animationDelay = Math.random() * 12 + 's';
    //         particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
    //         particle.style.opacity = Math.random() * 0.8 + 0.2;
            
    //         const colors = [
    //             'rgba(139, 92, 246, 0.8)',
    //             'rgba(236, 72, 153, 0.6)',
    //             'rgba(6, 182, 212, 0.7)'
    //         ];
    //         const randomColor = colors[Math.floor(Math.random() * colors.length)];
    //         particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;
            
    //         document.getElementById('particles').appendChild(particle);
            
    //         setTimeout(() => {
    //             if (particle.parentNode) {
    //                 particle.remove();
    //             }
    //         }, 12000);
    //     }

    //     setInterval(createPremiumParticle, 150);
    // }

    $(function() {
        
        var budget = '<?= $budget ?>';

        setBudget(budget);

    });

    function selectQuickSetup(element, goal) {
        document.querySelectorAll('.quick-setup').forEach(card => {
            card.classList.remove('selected');
        });
        
        element.classList.add('selected');
        selectedGoal = goal;
        
        if (goal === 'views') {
            setBudget(30);
        } else if (goal === 'engagement') {
            setBudget(50);
        } else if (goal === 'premium') {
            setBudget(150);
        }
        
        updateEstimates();
    }

    function toggleTarget(element, value) {

        const $input = $('#target_audience');

        let selectedValues = $input.val() ? $input.val().split(',') : [];

        const $el = $(element);

        if ($el.hasClass('selected')) {
      
            $el.removeClass('selected');
            selectedValues = selectedValues.filter(v => v !== value);
        } else {
         
            $el.addClass('selected');
            if (!selectedValues.includes(value)) {
                selectedValues.push(value);
            }
        }

        $input.val(selectedValues.join(','));
    }

    function toggleRange(element,value)
    {
        const $input = $('#age_range');

        let selectedValues = $input.val() ? $input.val().split(',') : [];

        const $el = $(element);

        if ($el.hasClass('selected')) {
      
            $el.removeClass('selected');
            selectedValues = selectedValues.filter(v => v !== value);
        } else {
         
            $el.addClass('selected');
            if (!selectedValues.includes(value)) {
                selectedValues.push(value);
            }
        }

        $input.val(selectedValues.join(','));
    }


    function toggleChip(element, value) {
        element.classList.toggle('selected');
    }

    function selectLocation(element, location) {
  
        element.parentElement.querySelectorAll('.audience-chip').forEach(chip => {
            chip.classList.remove('selected');
        });
        
        element.classList.add('selected');
        selectedLocation = location;

        $('#location').val(location);
        
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

        $('#duration').val(days);

        var budget = parseInt($('#budgetDisplay').text());

        updateEstimates();

        updateCampaignSummary();

        const totalBudget = days * budget;

        setBudget(totalBudget);

        console.log('updateEstimatesupdateEstimatesupdateEstimates');
    }

    function setBudget(amount) {

        dailyBudget = amount;
        document.querySelector('.budget-slider').value = amount;
        document.getElementById('budgetDisplay').textContent = `$${amount}`;

        $('#budget').val(amount);

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

        $('#expected_views_range').val(views);

        $('#reached_views_range').val(reach);
    }

    function updateCampaignSummary() {
        const totalBudget = dailyBudget * selectedDuration;
        document.getElementById('totalBudget').textContent = '$' + totalBudget;
        document.getElementById('campaignLength').textContent = selectedDuration + (selectedDuration === 1 ? ' Day' : ' Days');

        $('#total_amount').val(totalBudget);
    }

    function previewCampaign() {
      
        var target_audience = $('#target_audience').val();
        var location = $('#location').val();
        var age_range = $('#age_range').val();
        var budget = $('#budget').val();
        var duration = $('#duration').val();
        var total_amount = $('#total_amount').val();
        var expected_views_range = $('#expected_views_range').val();
        var reached_views_range = $('#reached_views_range').val();

        // Set values into the modal
        $('#target_audience_view').text(target_audience);
        $('#location_view').text(location);
        $('#age_range_view').text(age_range);
        $('#budget_duration_view').text(budget);
        $('#campaign_duration_view').text(duration);
        $('#total_investment_view').text(total_amount);
        $('#expected_views_view').text(expected_views_range);
        $('#people_reached_view').text(reached_views_range);
        $('#summary_duration_view').text(duration);

        $('#details_modal').addClass('active');
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

    updateEstimates();
    updateCampaignSummary();
</script>

</body>
</html>