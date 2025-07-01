<?php session_start(); 

include('includes/config.php');
include('includes/helper.php');

if(!isset($_GET['service']) || !isset($_GET['m_id'])){

	//header("Location: login.php");
	echo '<script>window.history.back();</script>';
	die;

}else{
	
	//$country_list = DB::query('select id,name,sortname from countries order by name asc');
	
}
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
		echo "<script>window.location='".SITEURL."/login.php';</script>";
		die;
	}
	
	if($_SESSION['log_user_unique_id'] == $_GET['m_id']){ ?>
		<script>alert("Oops!! You can't book your service. Please choose another model...")</script>
		<?php echo "<script>window.history.back();</script>";
		die;
	}
	
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."/login.php';</script>";
	die;
}
$m_id = $_GET["m_id"];
$model_data = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id =  %s ", $m_id);
if(!$model_data){
	echo '<script>window.history.back();</script>';
	die;
}else{
$model_name = $model_data['name'];
$model_ID = $model_data['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking for <?=$_GET['service']?> - Live Models</title>
    <meta name="description" content="Book your exclusive international tour experience with verified models">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
	<?php  include('includes/head.php'); ?>

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
   
</head>
<body class="min-h-screen text-white booking-form text-white socialwall-page">
	
	
	<?php if (isset($_SESSION["log_user_id"])) { ?>
 
    <?php  include('includes/side-bar.php'); ?>

    <?php  include('includes/profile_header_index.php'); ?>  
 
  <?php } else{ ?>
  
	<?php include('includes/header.php'); ?>
	
  <?php } ?>
	
	<main>
        <!-- Premium Booking Header -->
        <section class="py-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/30 via-purple-900/20 to-pink-900/30"></div>
            <div class="container mx-auto relative z-10">
                <div class="text-center mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-4 text-glow">Booking for <?=$_GET['service']?></h1>
                    <p class="text-xl text-white/70 max-w-2xl mx-auto">Complete your booking details to secure your exclusive experience</p>
                </div>
            </div>
        </section>

        <!-- Premium Status Section -->
        <section class="py-8 relative">
            <div class="container mx-auto">
                <div class="ultra-glass p-8 rounded-3xl mb-8">
                    <div class="text-center mb-6">
                        <p class="text-white/70 text-lg mb-6">Once you have submit request your coins will be deducted from your account.</p>
                    </div>
                    
                    <div class="flex justify-center items-center space-x-12">
                        <!-- User Avatar -->
                        <div class="text-center floating">
                            <div class="model-avatar w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-2xl mb-4 mx-auto shadow-2xl">
                                T
                            </div>
                            <div class="premium-text font-bold text-lg mb-2">Test14</div>
                            <div class="flex items-center justify-center mb-2">
                                <span class="status-online w-3 h-3 rounded-full mr-2"></span>
                                <span class="text-sm text-white/60">Online</span>
                            </div>
                            <div class="text-xs text-white/50 max-w-32">THE USER IS IN CITY Test14 AND THE MODEL IS IN CITY Lahore</div>
                        </div>

                        <!-- Connection Arrow -->
                        <div class="flex items-center">
                            <div class="w-16 h-0.5 bg-gradient-to-r from-purple-500 to-pink-500 relative">
                                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-4 border-l-pink-500 border-t-2 border-t-transparent border-b-2 border-b-transparent"></div>
                            </div>
                        </div>

                        <!-- Model Avatar -->
                        <div class="text-center floating">
                            <div class="model-avatar w-20 h-20 rounded-full overflow-hidden mb-4 mx-auto shadow-2xl border-3 border-green-500">
                                <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=150&h=150&fit=crop&crop=faces" alt="UltraGalaxy" class="w-full h-full object-cover">
                            </div>
                            <div class="premium-text font-bold text-lg mb-2">UltraGalaxy</div>
                            <div class="flex items-center justify-center mb-2">
                                <span class="status-online w-3 h-3 rounded-full mr-2"></span>
                                <span class="text-sm text-white/60">Available</span>
                            </div>
                            <div class="verified-badge text-white px-3 py-1 rounded-full text-xs font-semibold">
                                ✓ Verified Model
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Premium Booking Form -->
        <section class="py-12 relative">
            <div class="container mx-auto">
                <?php /*<form  onsubmit="handleBookingSubmit(event)"> */ ?>
				<form method="post" class="max-w-6xl mx-auto space-y-8" action="act_model_booking.php" enctype="multipart/form-data" >
                    <!-- Contact Details Section -->
                    <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
					 
						<div class="flex items-center mb-8">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                            <h2 class="text-3xl font-bold premium-text heading-font">Your Contact Details</h2>
                        </div>
                        
                        <div class="grid md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Booking Type</label>
                                <select name="booking_type" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">Select...</option>
                                    <option value="premium-experience" class="bg-gray-900">👑 Premium Experience</option>
                                    <option value="international-tour" class="bg-gray-900">✈️ International Tour</option>
                                    <option value="exclusive-meeting" class="bg-gray-900">💎 Exclusive Meeting</option>
                                    <option value="vip-package" class="bg-gray-900">🌟 VIP Package</option>
                                    <option value="luxury-companion" class="bg-gray-900">🥂 Luxury Companion</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Booking For</label>
                                <select name="booking_for" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">Select...</option>
                                    <option value="myself" class="bg-gray-900">👤 Myself</option>
                                    <option value="business-partner" class="bg-gray-900">🤝 Business Partner</option>
                                    <option value="special-client" class="bg-gray-900">⭐ Special Client</option>
                                    <option value="group-booking" class="bg-gray-900">👥 Group Booking</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Country</label>
                                <select name="country" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">Select...</option>
                                    <option value="us" class="bg-gray-900">🇺🇸 United States</option>
                                    <option value="uk" class="bg-gray-900">🇬🇧 United Kingdom</option>
                                    <option value="ca" class="bg-gray-900">🇨🇦 Canada</option>
                                    <option value="au" class="bg-gray-900">🇦🇺 Australia</option>
                                    <option value="de" class="bg-gray-900">🇩🇪 Germany</option>
                                    <option value="fr" class="bg-gray-900">🇫🇷 France</option>
                                    <option value="jp" class="bg-gray-900">🇯🇵 Japan</option>
                                    <option value="ae" class="bg-gray-900">🇦🇪 UAE</option>
                                    <option value="ch" class="bg-gray-900">🇨🇭 Switzerland</option>
                                    <option value="sg" class="bg-gray-900">🇸🇬 Singapore</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions Section -->
                    <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            </div>
                            <h2 class="text-3xl font-bold premium-text heading-font">Instructions</h2>
                        </div>
                        
                        <div>
                            <label class="block text-white/80 font-semibold mb-3 text-lg">Special Instructions, or notes (optional)</label>
                            <textarea name="instructions"
                                class="w-full px-6 py-4 ultra-glass text-white placeholder-white/50 rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 h-40 resize-none shadow-lg transition duration-300" 
                                placeholder="Please provide any special requirements, preferences, dietary restrictions, accessibility needs, or other important information for your international tour experience. Include details about locations, activities, duration, or any specific requests you may have..."
                            ></textarea>
                        </div>
                    </div>

                    <!-- Schedule Section -->
                    <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
                            <h2 class="text-3xl font-bold premium-text heading-font">When do you want to see me?</h2>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Date</label>
                                <input name="meeting_date"
                                    type="date" 
                                    class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                    required
                                    min=""
                                >
                            </div>
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Hour</label>
                                <select name="meeting_hrs" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">HH</option>
                                    <option value="01" class="bg-gray-900">01</option>
                                    <option value="02" class="bg-gray-900">02</option>
                                    <option value="03" class="bg-gray-900">03</option>
                                    <option value="04" class="bg-gray-900">04</option>
                                    <option value="05" class="bg-gray-900">05</option>
                                    <option value="06" class="bg-gray-900">06</option>
                                    <option value="07" class="bg-gray-900">07</option>
                                    <option value="08" class="bg-gray-900">08</option>
                                    <option value="09" class="bg-gray-900">09</option>
                                    <option value="10" class="bg-gray-900">10</option>
                                    <option value="11" class="bg-gray-900">11</option>
                                    <option value="12" class="bg-gray-900">12</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Minute</label>
                                <select name="meeting_min" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">MM</option>
                                    <option value="00" class="bg-gray-900">00</option>
                                    <option value="15" class="bg-gray-900">15</option>
                                    <option value="30" class="bg-gray-900">30</option>
                                    <option value="45" class="bg-gray-900">45</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex space-x-6">
                                <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                    <input type="radio"  name="meeting_g" value="AM" class="form-radio text-indigo-600 w-5 h-5" required>
                                    <span class="font-medium text-lg">AM</span>
                                </label>
                                <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                    <input type="radio" name="meeting_g" value="PM" class="form-radio text-indigo-600 w-5 h-5" required>
                                    <span class="font-medium text-lg">PM</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Submit Section -->
                    <div class="text-center">
					
						<input type="hidden" name="model_unique_id" value="<?php echo $m_id; ?>">
						<input type="hidden" name="user_unique_id" value="<?php echo $_SESSION['log_user_unique_id']; ?>">
						<input type="hidden" name="model_name" value="<?php echo $model_name; ?>">
						<input type="hidden" name="model_ID" value="<?php echo $model_ID; ?>">						
						<input type="hidden" name="name" value="<?php echo $userDetails['name']; ?>">
					
                        <button name="booking_submit" type="submit" class="btn-primary px-16 py-5 text-white font-bold rounded-2xl text-xl shadow-2xl relative overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M5 12l5 5l10-10"></path></svg>
                            Let's Meet - Confirm Booking
                        </button>
                        <p class="text-white/60 mt-4 text-lg">Your booking will be processed securely and you'll receive confirmation within 24 hours</p>
                    </div>
                </form>
            </div>
        </section>
    </main>
	
   <?php include('includes/footer.php'); ?>

    <script>
        // Initialize premium features
        document.addEventListener('DOMContentLoaded', function() {
            initializePremiumFeatures();
            setMinDate();
        });

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

            // Animated Counter
            function animatePremiumCounter(element, target) {
                let current = 0;
                const increment = target / 200;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.floor(current).toLocaleString();
                }, 10);
            }

            document.querySelectorAll('.stats-counter').forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                animatePremiumCounter(counter, target);
            });

            // Scroll reveal
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });
        }

        function setMinDate() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const dateInput = document.querySelector('input[type="date"]');
            if (dateInput) {
                dateInput.min = tomorrow.toISOString().split('T')[0];
            }
        }

        function handleBookingSubmit(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(event.target);
            const selectedModel = formData.get('selectedModel');
            
            if (!selectedModel) {
                alert('⚠️ Please select a model for your international tour experience.');
                return;
            }
            
            // Show success message
            alert(`🎉 Booking Confirmed!\n\nYour international tour booking has been submitted successfully.\n\nSelected Model: ${selectedModel}\nBooking Type: ${formData.get('booking-type') || 'Not specified'}\n\nYou will receive a confirmation email within 24 hours with all the details.\n\nThank you for choosing Live Models for your premium experience!`);
            
            // Simulate redirect
            setTimeout(() => {
                alert('🔄 Redirecting to payment gateway...');
            }, 2000);
        }

        function goBack() {
            alert('🔙 Returning to model selection...');
        }
    </script>
</body>
</html>