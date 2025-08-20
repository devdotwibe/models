<?php  session_start();
include('includes/config.php');
include('includes/helper.php');

$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Primary SEO Meta Tags -->
    <title>Contact Support - TheLiveModels.com | 24/7 Customer Service & Help Center</title>
    <meta name="description" content="Get instant support for TheLiveModels.com. Access our comprehensive FAQ, submit support tickets, and connect with our 24/7 customer service team. Expert help for account issues, billing, verification, and technical support.">
    <meta name="keywords" content="thelivemodels support, live models customer service, contact support, help center, FAQ, technical support, account help, billing support, verification help, 24/7 support, customer care, live chat support, ticket system">
    <meta name="author" content="TheLiveModels.com">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="https://thelivemodels.com/contact-support">
    
    <!-- Geographic and Language Targeting -->
    <meta name="geo.region" content="US">
    <meta name="geo.placename" content="United States">
    <meta name="language" content="English">
    <meta name="distribution" content="global">
    <meta name="rating" content="adult">
    <meta name="audience" content="adult">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://thelivemodels.com/contact-support">
    <meta property="og:title" content="Contact Support - TheLiveModels.com | 24/7 Customer Service">
    <meta property="og:description" content="Get instant support for TheLiveModels.com. Access our comprehensive FAQ, submit support tickets, and connect with our 24/7 customer service team.">
    <meta property="og:image" content="https://thelivemodels.com/images/support-og-1200x630.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="TheLiveModels Support Center - 24/7 Customer Service">
    <meta property="og:site_name" content="TheLiveModels.com">
    <meta property="og:locale" content="en_US">
    <meta property="fb:app_id" content="your-facebook-app-id">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@thelivemodels">
    <meta name="twitter:creator" content="@thelivemodels">
    <meta name="twitter:url" content="https://thelivemodels.com/contact-support">
    <meta name="twitter:title" content="Contact Support - TheLiveModels.com | 24/7 Customer Service">
    <meta name="twitter:description" content="Get instant support for TheLiveModels.com. Access our comprehensive FAQ, submit support tickets, and connect with our 24/7 customer service team.">
    <meta name="twitter:image" content="https://thelivemodels.com/images/support-twitter-1200x600.jpg">
    <meta name="twitter:image:alt" content="TheLiveModels Support Center">
    
    <!-- LinkedIn -->
    <meta property="og:image:secure_url" content="https://thelivemodels.com/images/support-linkedin-1200x627.jpg">
    
    <!-- Pinterest -->
    <meta name="pinterest-rich-pin" content="true">
    <meta property="og:see_also" content="https://thelivemodels.com">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#667eea">
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="application-name" content="TheLiveModels Support">
    <meta name="apple-mobile-web-app-title" content="TLM Support">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://thelivemodels.com">
    
    <!-- Enhanced Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "WebPage",
                "@id": "https://thelivemodels.com/contact-support",
                "url": "https://thelivemodels.com/contact-support",
                "name": "Contact Support - TheLiveModels.com | 24/7 Customer Service & Help Center",
                "description": "Get instant support for TheLiveModels.com. Access our comprehensive FAQ, submit support tickets, and connect with our 24/7 customer service team.",
                "inLanguage": "en-US",
                "isPartOf": {
                    "@type": "WebSite",
                    "@id": "https://thelivemodels.com",
                    "name": "TheLiveModels.com",
                    "url": "https://thelivemodels.com",
                    "description": "Premium live model platform for authentic connections",
                    "publisher": {
                        "@type": "Organization",
                        "@id": "https://thelivemodels.com/#organization"
                    }
                },
                "breadcrumb": {
                    "@type": "BreadcrumbList",
                    "itemListElement": [
                        {
                            "@type": "ListItem",
                            "position": 1,
                            "name": "Home",
                            "item": "https://thelivemodels.com"
                        },
                        {
                            "@type": "ListItem",
                            "position": 2,
                            "name": "Support",
                            "item": "https://thelivemodels.com/contact-support"
                        }
                    ]
                }
            },
            {
                "@type": "Organization",
                "@id": "https://thelivemodels.com/#organization",
                "name": "TheLiveModels.com",
                "url": "https://thelivemodels.com",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://thelivemodels.com/images/logo-512x512.png",
                    "width": 512,
                    "height": 512
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+1-800-TLM-HELP",
                    "contactType": "customer service",
                    "availableLanguage": ["English"],
                    "areaServed": "Worldwide",
                    "hoursAvailable": "Mo-Su 00:00-23:59"
                },
                "sameAs": [
                    "https://twitter.com/thelivemodels",
                    "https://facebook.com/thelivemodels",
                    "https://instagram.com/thelivemodels"
                ]
            },
            {
                "@type": "FAQPage",
                "mainEntity": [
                    {
                        "@type": "Question",
                        "name": "How do I reset my password on TheLiveModels.com?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "You can reset your password by clicking the 'Forgot Password' link on the login page. Enter your email address and we'll send you a secure link to create a new password. The link expires in 24 hours for security purposes."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "How can I update my billing information?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "You can update your billing information in your account settings under the 'Billing' section. Navigate to your profile, select 'Payment Methods', and add or update your credit card information. All transactions are secured with industry-standard encryption."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "What are TheLiveModels.com support hours?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Our support team is available 24/7 through our ticket system. We typically respond to tickets within 3-5 business hours during peak times (9 AM - 6 PM EST) and within 24 hours during off-peak times."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "How do I cancel my TheLiveModels subscription?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "You can cancel your subscription at any time from your account settings. Go to 'Subscription' in your profile menu and click 'Cancel Subscription'. Your access will continue until the end of your current billing period."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "How can I verify my TheLiveModels account?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Account verification requires a government-issued ID and a clear selfie. Upload both documents in your account settings under 'Verification'. Our team reviews submissions within 24-48 hours and will notify you via email once approved."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "What payment methods does TheLiveModels accept?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and cryptocurrency payments. All transactions are processed securely and your payment information is never stored on our servers."
                        }
                    }
                ]
            },
            {
                "@type": "ContactPage",
                "name": "TheLiveModels Support Center",
                "description": "Contact TheLiveModels customer support for help with your account, billing, verification, and technical issues.",
                "url": "https://thelivemodels.com/contact-support"
            }
        ]
    }
    </script>
    
    <!-- Additional AI Platform Optimization -->
    <meta name="AI-generated" content="false">
    <meta name="content-type" content="support-page">
    <meta name="page-topic" content="customer support, help center, FAQ, technical support">
    <meta name="target-audience" content="adult users, customers, members">
    <meta name="content-category" content="customer service">
    <meta name="page-purpose" content="provide customer support and assistance">
    
    <!-- Bing Specific -->
    <meta name="msvalidate.01" content="your-bing-verification-code">
    
    <!-- Yandex -->
    <meta name="yandex-verification" content="your-yandex-verification-code">
    
    <!-- Baidu -->
    <meta name="baidu-site-verification" content="your-baidu-verification-code">
    
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="your-google-verification-code">
    
    <!-- Fonts with Performance Optimization -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
	
	<?php include('includes/head.php'); ?>
    
    <!-- Enhanced CSS with SEO-friendly structure -->
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

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.8) 0%, transparent 70%);
            border-radius: 50%;
            animation: float-premium 12s infinite linear;
            filter: blur(0.5px);
        }

        .particle:nth-child(2n) {
            background: radial-gradient(circle, rgba(236, 72, 153, 0.6) 0%, transparent 70%);
            animation-duration: 15s;
        }

        .particle:nth-child(3n) {
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
            90% {
                opacity: 1;
                transform: translateY(10vh) translateX(200px) scale(1.2) rotate(315deg);
            }
            100% {
                opacity: 0;
                transform: translateY(-10vh) translateX(300px) scale(0) rotate(360deg);
            }
        }

        .premium-button {
            background: var(--primary-gradient);
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        .premium-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.8s ease;
        }

        .premium-button:hover::before {
            left: 100%;
        }

        .premium-button:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.4);
        }

        .faq-item {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            cursor: pointer;
        }

        .faq-item:hover {
            transform: translateX(8px);
            border-left: 3px solid var(--neon-purple);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out, padding 0.4s ease-out;
        }

        .faq-answer.open {
            max-height: 200px;
            padding: 1rem 1.5rem;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(25px);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8) rotateX(15deg);
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            max-width: 90vw;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-overlay.show .modal-content {
            transform: translate(-50%, -50%) scale(1) rotateX(0deg);
        }

        .premium-text {
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        @media (max-width: 768px) {
            .container { 
                max-width: 100%;
                padding: 0 1rem; 
            }
        }

        /* SEO-friendly hidden content for search engines */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
</head>
<body class="min-h-screen bg-animated text-white advt-page socialwall-page">
    <!-- SEO-friendly hidden content -->
    <div class="sr-only">
        <h1>TheLiveModels.com Support Center - Customer Service and Help</h1>
        <p>Welcome to TheLiveModels.com support center. Get help with account issues, billing questions, verification process, technical support, and more. Our 24/7 customer service team is here to assist you.</p>
        <nav aria-label="Support navigation">
            <ul>
                <li><a href="#faq">Frequently Asked Questions</a></li>
                <li><a href="#contact">Contact Support</a></li>
                <li><a href="#search">Search Help Articles</a></li>
            </ul>
        </nav>
    </div>

    <!-- Premium Particle System -->
  <div class="particles" id="particles"></div>
    <!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>

    <!-- Main content area -->
    <main role="main">
        <!-- Hero section with search functionality -->
        <section class="py-20 relative" id="search" aria-labelledby="hero-heading">
            <div class="container mx-auto text-center">
                <h2 id="hero-heading" class="text-5xl md:text-6xl font-bold gradient-text heading-font mb-6">How can we help you today?</h2>
                <p class="text-xl md:text-2xl text-white/70 mb-12 max-w-3xl mx-auto">Search our comprehensive knowledge base, browse frequently asked questions, or get in touch with our expert support team for personalized assistance with your TheLiveModels.com account</p>
                
                <div class="relative max-w-2xl mx-auto">
                    <div class="ultra-glass rounded-2xl p-2">
                        <label for="support-search" class="sr-only">Search support articles and help topics</label>
                        <input 
                            id="support-search"
                            type="search" 
                            placeholder="Search for help articles, account issues, billing questions, verification help..."
                            class="w-full px-6 py-4 text-lg bg-transparent text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500"
                            aria-describedby="search-help"
                        >
                        <p id="search-help" class="sr-only">Enter keywords related to your issue to find relevant help articles and solutions</p>
                        <button onclick="performSearch()" class="absolute right-3 top-1/2 transform -translate-y-1/2 premium-button text-white px-6 py-2 rounded-xl" aria-label="Search support articles">
                            Search Help
                        </button>
                    </div>
                </div>
            </div>
        </section>
		
		<?php 
		if(isset($_SESSION["log_user_id"]) && !empty($userDetails)){
			$redirect = "navigateTo('supports.php')";
		}else{
			$redirect = 'showLoginPrompt()';
		}
		?>

        <!-- Quick actions section -->
        <section class="py-16" id="contact" aria-labelledby="quick-actions-heading">
            <div class="container mx-auto">
                <h2 id="quick-actions-heading" class="sr-only">Quick Support Actions</h2>
                <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <article class="ultra-glass rounded-2xl p-8 hover:transform hover:scale-105 transition-all duration-500">
                        <div class="w-16 h-16 premium-button rounded-2xl flex items-center justify-center mb-6 mx-auto" aria-hidden="true">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.003 9.003 0 01-5.916-2.177L3 21l2.823-2.823C4.177 16.085 3 14.116 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold premium-text heading-font mb-4 text-center">Submit Support Ticket</h3>
                        <p class="text-white/70 mb-6 text-center text-lg">Get personalized help from our expert support team with detailed assistance for account issues, billing questions, technical problems, and verification support</p>
                        <div class="text-center">
                            <button onclick="<?php echo $redirect; ?>" class="premium-button text-white px-8 py-3 rounded-xl font-medium" aria-label="Contact customer support team">Contact Support Now →</button>
                        </div>
                    </article>

                    <article class="ultra-glass rounded-2xl p-8 hover:transform hover:scale-105 transition-all duration-500">
                        <div class="w-16 h-16 premium-button rounded-2xl flex items-center justify-center mb-6 mx-auto" aria-hidden="true">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold premium-text heading-font mb-4 text-center">Help Documentation</h3>
                        <p class="text-white/70 mb-6 text-center text-lg">Explore our comprehensive guides, step-by-step tutorials, platform documentation, and detailed help articles covering all aspects of TheLiveModels.com</p>
                        <div class="text-center">
                            <button onclick="<?php echo $redirect; ?>" class="premium-button text-white px-8 py-3 rounded-xl font-medium" aria-label="Browse help documentation">Browse Documentation →</button>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Enhanced FAQ section -->
        <section class="py-16" id="faq" aria-labelledby="faq-heading">
            <div class="container mx-auto">
                <h2 id="faq-heading" class="text-4xl md:text-5xl font-bold gradient-text heading-font text-center mb-16">Frequently Asked Questions</h2>
                <p class="text-xl text-white/70 text-center mb-12 max-w-3xl mx-auto">Welcome to The Live Models Support Center. Below you'll find detailed answers to common questions about our platform, accounts, safety, payments, and more.</p>
                
                <!-- Added comprehensive FAQ categories navigation -->
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    <button onclick="showCategory('about')" class="category-btn premium-button text-white px-6 py-3 rounded-xl font-medium active" data-category="about">About TLM</button>
                    <button onclick="showCategory('accounts')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="accounts">Accounts & Verification</button>
                    <button onclick="showCategory('features')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="features">Platform Features</button>
                    <button onclick="showCategory('payments')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="payments">Tokens & Payments</button>
                    <button onclick="showCategory('safety')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="safety">Safety & Privacy</button>
                    <button onclick="showCategory('legal')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="legal">Legal & Compliance</button>
                    <button onclick="showCategory('technical')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="technical">Technical Support</button>
                    <?php /*<button onclick="showCategory('creator')" class="category-btn bg-white/10 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/20 transition-colors" data-category="creator">Creator Features</button> */ ?>
                </div>
                
                <!-- Replaced basic FAQ with comprehensive categorized content -->
                <div class="max-w-4xl mx-auto space-y-4" role="list">
                    
                    <!-- About The Live Models Category -->
                    <div class="faq-category" data-category="about">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">1. About The Live Models</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q1. What is The Live Models (TLM)?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">The Live Models is a global dating and social networking platform where adults can connect with people worldwide through four core features: <strong>Chat</strong> – Send messages and connect instantly. <strong>Watch</strong> – Enjoy live streams, videos, and exclusive content from creators. <strong>Meet</strong> – Request or accept invitations for lawful, social meet-ups. <strong>Travel</strong> – Connect with others to plan safe, lawful travel experiences.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q2. Is TLM an escort or adult website?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">No. TLM is not an escort agency or adult services provider. It is a UGC (user-generated content) social platform. Creators and users decide how they interact. All offline activities are voluntary and personal, not arranged by TLM.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q3. Where is TLM based?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">TLM is a New Zealand–registered company with a global user base.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q4. Is the platform free to use?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Yes. Creating an account and using basic features is free. Certain premium features, creator content, and meet/travel requests may require Tokens.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Accounts & Verification Category -->
                    <div class="faq-category hidden" data-category="accounts">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">2. Accounts & Verification</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q5. Who can join TLM?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">TLM is strictly for adults (18+). Users must comply with our Terms of Service and Community Guidelines.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q6. How do I verify my account?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80"><strong>All users:</strong> must verify their email address by entering the one-time code (OTP) sent to them. <strong>Creators:</strong> must submit a valid government-issued ID to access paid features (posting paid content, live streaming, Meet/Travel requests).</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q7. Why is creator verification required?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Verification protects our community by ensuring that only real, legal adults can monetize their content. It prevents fraud, impersonation, and underage access.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q8. How often is re-verification required?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">We may require re-verification in case of: Device or location changes that appear risky, expired or invalid identification, or reported safety or compliance concerns.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q9. What happens if verification fails?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">If your documents don't meet the requirements or cannot be verified, we will notify you via email. You may re-submit corrected documents. Accounts with repeated failed attempts may be restricted.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Platform Features Category -->
                    <div class="faq-category hidden" data-category="features">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">3. Platform Features</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q10. What can I do on TLM?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Users can: Create a profile, Chat with global members, Watch livestreams or exclusive content, Send Meet/Travel requests (verified users only), Purchase tokens to unlock premium features.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q11. How do Meet Requests work?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">A user sends a Meet Request through the platform. The recipient can accept, decline, or ignore. TLM does not arrange or guarantee meetings; all arrangements are personal.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q12. How do Travel Requests work?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Users can connect for travel planning, companionship during lawful travel, or social exploration. We strongly recommend only meeting in safe, public places. TLM does not act as a travel agent or broker.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q13. Can I live stream as a user?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Only verified creators can host live streams. Regular users can watch, chat, or send tokens during streams.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Continue with remaining categories... -->
                    <!-- Added remaining FAQ categories with all content from user's request -->
                    
                    <!-- Wallet, Tokens & Payments Category -->
                    <div class="faq-category hidden" data-category="payments">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">4. Wallet, Tokens & Payments</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q14. What are Tokens?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Tokens are in-app digital credits used for: Unlocking paid creator content, Sending gifts during live streams, Boosting your own profile or content visibility, Making Meet/Travel requests.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q15. Are Tokens refundable?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">No. All Token purchases are final and non-refundable, unless required by applicable law.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q16. How do I purchase Tokens?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Tokens can be purchased through approved payment methods listed on the platform.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q17. How can creators earn?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Creators earn Tokens when users purchase their content, watch their streams, or send Meet/Travel requests. Tokens can be converted to withdrawals once minimum payout thresholds are met.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q18. What are Boosts and Premium Features?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Boosts and Premium Features allow users/creators to: Increase profile visibility, Highlight posts or images in search results, Access advanced filters for finding matches.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Safety & Privacy Category -->
                    <div class="faq-category hidden" data-category="safety">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">5. Safety & Privacy</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q19. How does TLM protect my privacy?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">We apply strong encryption and follow strict data-protection policies. Only the details you choose to share are public.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q20. Can other users see my personal details?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">No. Your email, ID, and payment information are never shared. Other users only see your public profile information.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q21. How do I block or report a user?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Each profile has Block and Report buttons. Reports are reviewed by our safety team to ensure quick action against rule violations.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q22. What safety tips should I follow when meeting?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Always meet in public places, Inform a trusted friend or family member, Never share sensitive financial or identity details, Use caution when engaging in Meet/Travel requests.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Legal & Compliance Category -->
                    <div class="faq-category hidden" data-category="legal">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">6. Legal & Compliance</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q23. Does TLM arrange meetings or travel?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">No. TLM is a neutral intermediary. All offline interactions are voluntary between users.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q24. Are creators employees of TLM?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">No. Creators are independent users who choose to share content or accept requests. TLM does not employ or contract creators.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q25. What content is prohibited?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Underage content (strict 18+ only), Violence, hate speech, illegal activities, Promotion of sexual services or prostitution, Spam, scams, or fraudulent content. Violations may result in account suspension or permanent bans.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Technical Support Category -->
                    <div class="faq-category hidden" data-category="technical">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">7. Technical Support</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q26. I forgot my password. What should I do?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Click Forgot Password on the login page and follow the reset instructions sent to your email.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q27. Why can't I watch a livestream?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Possible causes include: Poor internet connection, Outdated browser or app version, Regional restrictions on certain content.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q28. The app/website is not working. What should I do?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Clear your browser cache, ensure you're on the latest version, and restart your device. If the issue continues, contact support.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q29. How do I contact support?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">You can reach our support team by creating a support ticket from your account.</p>
                            </div>
                        </article>
                    </div>

                    <!-- Creator Features Category -->
                    <div class="faq-category hidden" data-category="creator">
                        <h3 class="text-2xl font-bold gradient-text heading-font mb-6">8. Creator Features</h3>
                        
                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q30. How do I become a Creator?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">To become a Creator, apply through the "Become a Broadcaster/Creator" section in your profile. You'll need to submit a valid government-issued ID for verification before posting paid content or live streaming.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q31. What kind of content can Creators upload?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Creators may upload photos, videos, and livestreams. Content must comply with our Community Guidelines—prohibited material includes underage content, illegal activity, violence, or solicitation of sexual services.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q32. Can I post free content as a Creator?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Yes. Creators can post free and paid content, giving them flexibility to engage with followers and grow their community.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q33. How do Creators earn money?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Creators earn Tokens when: Users purchase their paid content, Viewers send gifts during live streams, Users send paid Meet or Travel requests.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q34. How do Creators withdraw earnings?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Earnings appear in the Wallet. Once the minimum payout threshold is met, Creators can request a withdrawal through supported payout methods.</p>
                            </div>
                        </article>

                        <article class="ultra-glass rounded-2xl overflow-hidden mb-4" role="listitem">
                            <button class="faq-item p-6 flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)" aria-expanded="false">
                                <span class="font-semibold text-lg premium-text">Q35. Are Creator earnings taxable?</span>
                                <svg class="w-6 h-6 text-white/70 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer bg-white/5">
                                <p class="text-white/80">Yes. Creators are independent users, not employees of TLM. They are responsible for declaring and paying taxes in their home country.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <!-- Login modal -->
    <div id="loginModal" class="modal-overlay" role="dialog" aria-labelledby="login-title" aria-modal="true">
        <div class="modal-content ultra-glass rounded-3xl p-12 max-w-md mx-4">
            <h3 id="login-title" class="text-2xl font-bold gradient-text heading-font mb-4 text-center">Login Required</h3>
            <p class="text-white/70 mb-8 text-center">Please login to continue and access this feature. Create an account if you're new to TheLiveModels.com.</p>
            <div class="flex space-x-4">
                <button onclick="hideLoginPrompt()" class="flex-1 bg-white/10 text-white py-3 rounded-xl hover:bg-white/20 transition-colors" aria-label="Cancel login">
                    Cancel
                </button>
                <button onclick="redirectLoginPrompt()" class="flex-1 premium-button text-white py-3 rounded-xl" aria-label="Proceed to login">
                    Login Now
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript with SEO tracking -->
    <script>
        // Enhanced JavaScript with premium functionality and SEO tracking
        document.addEventListener('DOMContentLoaded', function() {
            initializePremiumFeatures();
            trackPageView();
        });

        function initializePremiumFeatures() {
            // Create floating particles
            function createPremiumParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 12 + 's';
                particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
                particle.style.opacity = Math.random() * 0.8 + 0.2;
                document.querySelector('.particles').appendChild(particle);

                setTimeout(() => {
                    particle.remove();
                }, 20000);
            }

            // Create particles periodically
            setInterval(createPremiumParticle, 2000);
        }

        function trackPageView() {
            // Track page view for analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'page_view', {
                    page_title: 'Support Center - TheLiveModels.com',
                    page_location: 'https://thelivemodels.com/contact-support'
                });
            }
        }

        function performSearch(query) {
            // Track search events
            if (typeof gtag !== 'undefined') {
                gtag('event', 'search', {
                    search_term: query || document.getElementById('support-search').value
                });
            }
            showLoginPrompt();
        }

        function showCategory(category) { 
            // Hide all categories
            document.querySelectorAll('.faq-category').forEach(cat => {
                cat.classList.add('hidden');
            });
            
            // Show selected category
            //document.querySelector('[data-category="'+category+'"]').classList.remove('hidden');
			document.querySelectorAll('.faq-category').forEach(cat => {
				if (cat.dataset.category === category) {
					cat.classList.remove('hidden');
				}
			});
            
            // Update button states
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('premium-button', 'active');
                btn.classList.add('bg-white/10', 'hover:bg-white/20');
            });
            
            // Activate selected button
            const activeBtn = document.querySelector(`[data-category="${category}"]`);
            activeBtn.classList.remove('bg-white/10', 'hover:bg-white/20');
            activeBtn.classList.add('premium-button', 'active');
            
            // Track category views
            if (typeof gtag !== 'undefined') {
                gtag('event', 'faq_category_view', {
                    category: category
                });
            }
        }

        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const arrow = element.querySelector('svg');
            const isOpen = answer.classList.contains('open');
            
            // Close all other FAQs
            document.querySelectorAll('.faq-answer').forEach(faq => {
                if (faq !== answer) {
                    faq.classList.remove('open');
                    const button = faq.previousElementSibling;
                    button.setAttribute('aria-expanded', 'false');
                    button.querySelector('svg').style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current FAQ
            answer.classList.toggle('open');
            element.setAttribute('aria-expanded', !isOpen);
            arrow.style.transform = answer.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';

            // Track FAQ interactions
            if (typeof gtag !== 'undefined') {
                gtag('event', 'faq_interaction', {
                    faq_question: element.querySelector('span').textContent,
                    action: answer.classList.contains('open') ? 'open' : 'close'
                });
            }
        }

        function showLoginPrompt() {
            document.getElementById('loginModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Track login prompt events
            if (typeof gtag !== 'undefined') {
                gtag('event', 'login_prompt_shown', {
                    source: 'support_page'
                });
            }
        }

        function hideLoginPrompt() {
            document.getElementById('loginModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }
		function redirectLoginPrompt() {
            window.location.href = '<?= SITEURL ?>login.php';
        }

        // Close modal when clicking outside
        document.getElementById('loginModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideLoginPrompt();
            }
        });

        // Keyboard navigation and accessibility
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideLoginPrompt();
            }
        });

        // Enhanced search functionality
        document.getElementById('support-search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });

        // Track user engagement
        let engagementTimer = 0;
        setInterval(() => {
            engagementTimer += 10;
            if (engagementTimer === 30 && typeof gtag !== 'undefined') {
                gtag('event', 'engagement', {
                    engagement_time_msec: 30000
                });
            }
        }, 10000);
    </script>

    <!-- Google Analytics (replace with your tracking ID) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
</body>
</html>
