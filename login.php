<?php 
session_start();
include('includes/config.php');
include('includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
		header("Location: ".SITEURL."single-profile.php?m_unique_id=".$userDetails['unique_id']);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - The Live Models</title>
<meta name="description" content="Sign in to your The Live Models account to connect with amazing models for chat, watch and meet experiences.">

    <?php include('includes/head.php'); ?>

</head>


<body class="login-page min-h-screen bg-animated text-white">

<?php include('includes/login-header.php'); ?>

<main>

    <section class="login-container relative overflow-hidden">
        <!-- Fixed Background Decorations -->
        <div class="bg-decoration bg-decoration-1"></div>
        <div class="bg-decoration bg-decoration-2"></div>
        
        <div class="container mx-auto relative z-10">
            <div class="login-form mx-auto">
                <div class="login-card ultra-glass p-12 rounded-3xl shadow-2xl relative overflow-hidden">
                    <!-- Subtle Static Background Elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-pink-500/8 to-purple-500/8 rounded-full blur-xl"></div>
                    
                    <div class="relative z-10">
                        <!-- Header -->
                        <div class="text-center mb-10">
                            <h1 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-4 text-glow">Welcome Back</h1>
                            <p class="text-white/70 text-lg">Sign in to your premium account</p>
                            <div class="mt-4 text-sm text-white/60">
                                <span class="inline-flex items-center">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                    <span class="stats-counter" data-target="50000">0</span>
                                    <span class="ml-1 font-medium">models online now</span>
                                </span>
                            </div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="space-y-4 mb-8">
                            <button class="w-full social-btn bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-6 rounded-xl transition duration-300 shadow-lg flex items-center justify-center" onclick="loginWithGoogle()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="mr-3">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Continue with Google
                            </button>
                            
                            <button class="w-full social-btn bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition duration-300 shadow-lg flex items-center justify-center" onclick="loginWithFacebook()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="mr-3">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Continue with Facebook
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="relative mb-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/20"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-transparent text-white/60 font-medium">Or sign in with email</span>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm" class="space-y-6" method="post" enctype="multipart/form-data" action="act-login.php">
                            <div>
                                <label for="username" class="block text-sm font-semibold text-white/80 mb-2">Username or Email <span class="text-red-400">*</span></label>
                                <input type="text" id="username" name="username" placeholder="Enter your username or email" class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-semibold text-white/80 mb-2">Password <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-6 py-4 rounded-xl ultra-glass text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300 border border-white/10" required>


                                    <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 hover:text-white transition duration-300" onclick="togglePasswordVisibility()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                    <input type="checkbox" name="remember" class="form-checkbox text-indigo-600 w-5 h-5 rounded">
                                    <span class="font-medium text-sm">Remember me</span>
                                </label>
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium text-sm premium-link" onclick="forgotPassword()">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" name="vfb-submit" value="Submit" class="w-full btn-primary text-white font-bold py-4 rounded-xl transition duration-300 relative overflow-hidden text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                                SIGN IN TO YOUR ACCOUNT
                            </button>

                        </form>
                        
                        <!-- Sign Up Link -->
                        <div class="mt-8 text-center">
                            <p class="text-white/60 text-sm mb-4">
                                Don't have an account? 
                                <a href="index.html#signup" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-semibold premium-link">Create Account</a>
                            </p>
                            <p class="text-white/50 text-xs">
                                By signing in, you agree to our <a href="#" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium premium-link" onclick="openTerms()">Terms</a> and <a href="#" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium premium-link" onclick="openPrivacy()">Privacy Policy</a>
                            </p>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="mt-8 flex flex-wrap gap-4 justify-center">
                            <div class="flex items-center space-x-2 ultra-glass px-4 py-2 rounded-full border border-green-500/30 hover:bg-green-500/10 transition duration-300 hover-lift">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                <span class="text-xs font-semibold text-white/80">SSL Secured</span>
                            </div>
                            <div class="flex items-center space-x-2 ultra-glass px-4 py-2 rounded-full border border-blue-500/30 hover:bg-blue-500/10 transition duration-300 hover-lift">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><circle cx="12" cy="16" r="1"></circle><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <span class="text-xs font-semibold text-white/80">Privacy Protected</span>
                            </div>
                            <div class="flex items-center space-x-2 ultra-glass px-4 py-2 rounded-full border border-purple-500/30 hover:bg-purple-500/10 transition duration-300 hover-lift">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"></path><path d="M21 12c.552 0 1-.448 1-1V5c0-.552-.448-1-1-1H3c-.552 0-1 .448-1 1v6c0 .552.448 1 1 1h9l4 4-4 4H3c-.552 0-1-.448-1-1v-6c0-.552.448-1 1-1h18z"></path></svg>
                                <span class="text-xs font-semibold text-white/80">Verified Platform</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Ultra Premium Footer (Same as Homepage) -->
<footer class="bg-black text-white py-20 border-t border-white/10">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-4 gap-12 mb-16">
            <div>
                <h3 class="text-3xl font-bold gradient-text heading-font mb-6">The Live Models</h3>
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
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="navigateTo('models')">All Models</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="navigateTo('ads')">Advertisements</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Support</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="openSupport()">Contact Support</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="openVerificationHelp()">Verification Help</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Legal</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="openTerms()">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="openPrivacy()">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition duration-300 premium-link" onclick="openVerificationPolicy()">Verification Policy</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-white/40 text-lg">&copy; 2024 The Live Models. All rights reserved. Must be 18+ to use this service.</p>
        </div>
    </div>
</footer>

<script>
    // Ultra Premium JavaScript - OPTIMIZED AND STABLE
    document.addEventListener('DOMContentLoaded', function() {
        initializePremiumFeatures();
    });

    function initializePremiumFeatures() {
        // Premium Particle System - REDUCED FREQUENCY
        function createPremiumParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 15 + 's';
            particle.style.animationDuration = (Math.random() * 8 + 12) + 's';
            particle.style.opacity = Math.random() * 0.6 + 0.2;
            
            // Random particle colors
            const colors = [
                'rgba(139, 92, 246, 0.4)',
                'rgba(236, 72, 153, 0.3)',
                'rgba(6, 182, 212, 0.4)'
            ];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;
            
            document.getElementById('particles').appendChild(particle);
            
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.remove();
                }
            }, 20000);
        }

        // Create particles with SLOWER timing - less distracting
        setInterval(createPremiumParticle, 300);

        // Premium Animated Counters - SMOOTHER
        function animatePremiumCounter(element, target) {
            let current = 0;
            const increment = target / 150;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 15);
        }

        // Initialize all counters
        document.querySelectorAll('.stats-counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            animatePremiumCounter(counter, target);
        });

        // Focus on first input with delay
        setTimeout(() => {
            const usernameInput = document.getElementById('username');
            if (usernameInput) {
                usernameInput.focus();
            }
        }, 800);

        // Enhanced form validation
        setupFormValidation();
    }

    function setupFormValidation() {
        const form = document.getElementById('loginForm');
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', validateInput);
            input.addEventListener('input', clearValidationError);
        });
    }

    function validateInput(e) {
        const input = e.target;
        const value = input.value.trim();
        
        // Remove existing error styling
        input.classList.remove('border-red-500');
        
        if (!value) {
            input.classList.add('border-red-500');
            return false;
        }
        
        if (input.type === 'email' && !isValidEmail(value)) {
            input.classList.add('border-red-500');
            return false;
        }
        
        return true;
    }

    function clearValidationError(e) {
        e.target.classList.remove('border-red-500');
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Premium Password Toggle
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        
        passwordInput.setAttribute('type', type);
        toggleButton.innerHTML = type === 'password' ? 
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' : 
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
    }

    // Premium Login Functions
    function handleLogin(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const username = formData.get('username');
        const password = formData.get('password');
        const remember = formData.get('remember');
        
        // Validate inputs
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        
        let isValid = true;
        
        if (!username.trim()) {
            usernameInput.classList.add('border-red-500');
            isValid = false;
        }
        
        if (!password.trim()) {
            passwordInput.classList.add('border-red-500');
            isValid = false;
        }
        
        if (!isValid) {
            return;
        }
        
        // Show loading state
        const submitBtn = event.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>SIGNING IN...';
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        
        // Simulate login process
        setTimeout(() => {
            alert(`🎉 Welcome back! Successfully signed in as ${username}`);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            submitBtn.classList.remove('loading');
            // Redirect to dashboard or homepage
            // window.location.href = 'index.html';
        }, 1500);
    }

    function loginWithGoogle() {
        alert('🔐 Google Login - Redirecting to Google authentication...');
    }

    function loginWithFacebook() {
        alert('🔐 Facebook Login - Redirecting to Facebook authentication...');
    }

    function forgotPassword() {
        const email = prompt('Enter your email address to reset your password:');
        if (email && isValidEmail(email)) {
            alert(`📧 Password reset link sent to ${email}. Please check your inbox.`);
        } else if (email) {
            alert('Please enter a valid email address.');
        }
    }

    function openSocial(platform) {
        alert(`📱 Social Media - Opening ${platform} page...`);
    }

    function navigateTo(page) {
        alert(`🔗 Navigation - Going to ${page} page...`);
    }

    function openSupport() {
        alert('🎧 Premium Support - Opening 24/7 support chat...');
    }

    function openVerificationHelp() {
        alert('✅ Verification Help - Opening verification guide...');
    }

    function openTerms() {
        alert('📋 Terms of Service - Opening legal documents...');
    }

    function openPrivacy() {
        alert('🔒 Privacy Policy - Opening privacy information...');
    }

    function openVerificationPolicy() {
        alert('🛡️ Verification Policy - Opening verification guidelines...');
    }

    // Handle Enter key for form submission
    document.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && (e.target.id === 'username' || e.target.id === 'password')) {
            e.preventDefault();
            document.getElementById('loginForm').dispatchEvent(new Event('submit'));
        }
    });

    // Prevent form from moving on mobile keyboards
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        window.addEventListener('resize', function() {
            document.querySelector('meta[name=viewport]').setAttribute('content', 
                'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no');
        });
    }
</script>
</body>
</html>