<?php 
session_start();
include('includes/config.php');
include('includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if($userDetails){
		header("Location: ".SITEURL."single-profile.php/".urlencode($userDetails['username']));

	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | The Live Models </title>
<meta name="description" content="Sign in to your The Live Models account to connect with amazing models for chat, watch and meet experiences.">
<link rel="canonical" href="https://thelivemodels.com/" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="Login | The Live Models">
<meta property="og:description" content="Sign in to your The Live Models account to connect with amazing models for chat, watch and meet experiences..">
<meta property="og:url" content="https://thelivemodels.com/">
<meta property="og:image" content="https://thelivemodels.com/assets/images/og-image.jpg">
<meta property="og:site_name" content="The Live Models">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Login | The Live Models">
<meta name="twitter:description" content="Sign in to your The Live Models account to connect with amazing models for chat, watch and meet experiences.">
<meta name="twitter:image" content="https://thelivemodels.com/assets/images/og-image.jpg">
<meta name="twitter:site" content="@thelivemodels">

<!-- Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://thelivemodels.com/#organization",
      "name": "The Live Models",
      "url": "https://thelivemodels.com/",
      "logo": "https://thelivemodels.com/assets/images/logo.png",
      "sameAs": [
        "https://x.com/thelivemodels",
        "https://www.instagram.com/the_livemodels",
        "https://www.tiktok.com/@thelivemodels"
      ],
      "description": "The Live Models is a verified global social networking and dating platform offering chat, live streaming, social meetups, and travel connections.",
      "foundingDate": "2025",
      "founder": {
        "@type": "Person",
        "name": "Kulwant Singh Jakhar"
      }
    },
    {
      "@type": "WebSite",
      "@id": "https://thelivemodels.com/#website",
      "url": "https://thelivemodels.com/",
      "name": "The Live Models",
      "description": "Chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide in a trusted community.",
      "publisher": {
        "@id": "https://thelivemodels.com/#organization"
      },
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://thelivemodels.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
  ]
}
</script>

    <?php include('includes/head.php'); ?>

    <link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />

</head>


<body class="login-page min-h-screen bg-animated text-white optim-services enhanced5">

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
                                    <span class="stats-counter" data-target="<?php echo getTotalOnlineUsers() ?>"> <?php echo getTotalOnlineUsers() ?> </span>
                                    <span class="ml-1 font-medium">models online now</span>
                                </span>
                            </div>
                        </div>


                        <!-- Login Form -->
                        <form id="loginForm" class="space-y-6" method="post" enctype="multipart/form-data" action="act-login.php">

                            <?php if(isset($_SESSION["login_error"] )) { ?>

                                <h2><span class="text-danger"><?php echo $_SESSION["login_error"]  ?></span></h2>

                            <?php } ?>

                            <?php if(isset($_SESSION["pass_success"] )) { ?>

                                <h2><span class="alert alert-success"><?php echo $_SESSION["pass_success"]  ?></span></h2>

                                
                            <?php unset($_SESSION["pass_success"]); } ?>

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

                                <a href="<?= SITEURL ?>" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-semibold premium-link">Create Account</a>
                            </p>

                            <p class="text-white/50 text-xs">
                                By signing in, you agree to our <a href="<?= SITEURL.'tls-tom.php'?>" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium premium-link">Terms</a> and <a href="<?= SITEURL.'privacy-policy.php'?>" class="text-indigo-400 hover:text-indigo-300 transition duration-300 font-medium premium-link" >Privacy Policy</a>
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


<div class="modal-overlay" id="forgor_modal">
    <div class="modal">
        <div class="modal-header">
        <h2 class="modal-title">forgotPassword </h2>
        <button class="close-modal" id="closeTipModal" type="button" onclick="CloseModal('forgor_modal')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        </div>
        <div class="modal-body" id="modal_success_message">
        <form id="email_form" action="forgotpassword.php" method="POST">
            <div class="form-group" style="margin-bottom: 1rem;">
            <label for="email_input">Email Address</label>
            <input type="email" id="email_input" name="email" class="form-control" placeholder="Enter your email" required>

            <span style="display:none" id="email_error">Please enter valid email address</span>
            </div>
            <button class="btn btn-primary" type="button" onclick="SubmitForgot()" >Submit</button>
            <button class="btn btn-secondary" type="button" onclick="CloseModal('forgor_modal')">Close</button>
        </form>
        </div>
    </div>
    </div>



    <div class="modal-overlay" id="success_modal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Registration Successful</h2>
                <button class="close-modal" type="button" onclick="CloseModal('success_modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modal_success_message">

                <p>Your registration was successful! You can now login to your account.</p>

                <a class="btn btn-primary" onclick="CloseModal('success_modal')" >Ok</a>

            </div>
        </div>
    </div>

      <div class="modal-overlay" id="verify_modal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Email Verification Successful</h2>
                <button class="close-modal" type="button" onclick="CloseModal('verify_modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modal_success_message">

                <p>Your account email verfied successful.</p>

                <a class="btn btn-primary"onclick="CloseModal('verify_modal')" >Ok</a>

            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

<script>


    <?php if($_GET['reg'] == 'success') { ?>
        
        document.addEventListener('DOMContentLoaded', function() {
          
            if (!sessionStorage.getItem('regSuccessShown')) {
                ShowLogin(); 
                sessionStorage.setItem('regSuccessShown', '1');
            }
        });

    <?php } ?>

    <?php if($_GET['email'] == 'verified') { ?>
    
        document.addEventListener('DOMContentLoaded', function() {

            if (!sessionStorage.getItem('emailVerifedShown')) {
                Verifed(); 
                sessionStorage.setItem('emailVerifedShown', '1');
            }
        })

    <?php } ?>

    function forgotPassword()
    {
        $('#forgor_modal').addClass('active');
    }

    function ShowLogin()
    {
        $('#success_modal').addClass('active');
    }

      function Verifed()
    {
        $('#verify_modal').addClass('active');
    }

    

    function SubmitForgot()
    {
        const email = $('#email_input').val();

        if (email && isValidEmail(email)) {

              $('#email_error').hide();

             $('#email_form').submit();

        }
        else
        {
            $('#email_error').show();
        }
    }

    function CloseModal(id)
    {

       $(`#${id}`).removeClass('active');
    }

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

    // function forgotPassword() {

    //     const email = prompt('Enter your email address to reset your password:');
    //     if (email && isValidEmail(email)) {
    //         alert(`📧 Password reset link sent to ${email}. Please check your inbox.`);
    //     } else if (email) {
    //         alert('Please enter a valid email address.');
    //     }
    // }

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