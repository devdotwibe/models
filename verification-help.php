<?php  session_start();
include('includes/config.php');
include('includes/helper.php');

$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
?>
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8">

<link rel="preconnect" href="https://www.googletagmanager.com">
<link rel="preconnect" href="https://www.google-analytics.com">
    <!-- Google Analytics (replace with your tracking ID) -->
    
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GD6CJ961PF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-GD6CJ961PF', {
    page_title: document.title,
    page_path: window.location.pathname,
    page_location: window.location.href
  });
</script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Primary SEO Meta Tags -->
    <title>Verification Help - Get Verified Fast | The Live Models - Secure Identity Verification</title>
    <meta name="description" content="Get verified on The Live Models in under 24 hours. Secure identity verification process with 24/7 support. Join thousands of verified models and members safely.">
    <meta name="keywords" content="verification help, identity verification, get verified, live models verification, secure verification, model verification, online verification, 24/7 support, verified community, safe verification">
    <meta name="author" content="The Live Models">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">
    
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://thelivemodels.com/verification-help">
    
    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Verification Help - Get Verified Fast | The Live Models">
    <meta property="og:description" content="Get verified on The Live Models in under 24 hours. Secure identity verification process with 24/7 support. Join thousands of verified models and members safely.">
    <meta property="og:url" content="https://thelivemodels.com/verification-help">
    <meta property="og:site_name" content="The Live Models">
    <meta property="og:image" content="https://thelivemodels.com/images/verification-help-og.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="The Live Models Verification Help - Secure Identity Verification Process">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Verification Help - Get Verified Fast | The Live Models">
    <meta name="twitter:description" content="Get verified on The Live Models in under 24 hours. Secure identity verification process with 24/7 support.">
    <meta name="twitter:image" content="https://thelivemodels.com/images/verification-help-twitter.jpg">
    <meta name="twitter:image:alt" content="The Live Models Verification Help Process">
    <meta name="twitter:site" content="@thelivemodels">
    <meta name="twitter:creator" content="@thelivemodels">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#667eea">
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="application-name" content="The Live Models">
    <meta name="apple-mobile-web-app-title" content="The Live Models">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Geo Meta Tags -->
    <meta name="geo.region" content="US">
    <meta name="geo.placename" content="United States">
    
    
    <!-- Language and Content Meta Tags -->
    <meta name="language" content="English">
    <meta name="content-language" content="en-US">
    <meta name="distribution" content="global">
    
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdn.tailwindcss.com">
    
    <!-- Structured Data - JSON-LD Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Verification Help - The Live Models",
        "description": "Get verified on The Live Models in under 24 hours. Secure identity verification process with 24/7 support. Join thousands of verified models and members safely.",
        "url": "https://thelivemodels.com/verification-help",
        "mainEntity": {
            "@type": "HowTo",
            "name": "How to Get Verified on The Live Models",
            "description": "Complete guide to getting verified on The Live Models platform with step-by-step instructions",
            "totalTime": "PT24H",
            "supply": [
                {
                    "@type": "HowToSupply",
                    "name": "Government-issued photo ID"
                },
                {
                    "@type": "HowToSupply", 
                    "name": "Smartphone or camera for selfie"
                }
            ],
            "step": [
                {
                    "@type": "HowToStep",
                    "name": "Upload ID",
                    "text": "Upload a clear photo of your government-issued ID. Passport, driver's license, or national ID accepted.",
                    "image": "https://thelivemodels.com/images/step-1-upload-id.jpg"
                },
                {
                    "@type": "HowToStep",
                    "name": "Take Selfie",
                    "text": "Hold your ID next to your face. Good lighting, no sunglasses, clear visibility required.",
                    "image": "https://thelivemodels.com/images/step-2-selfie.jpg"
                },
                {
                    "@type": "HowToStep",
                    "name": "AI Review",
                    "text": "Our secure AI system reviews your documents instantly for initial verification.",
                    "image": "https://thelivemodels.com/images/step-3-ai-review.jpg"
                },
                {
                    "@type": "HowToStep",
                    "name": "Get Verified",
                    "text": "Receive your verified badge and unlock premium features within 24 hours.",
                    "image": "https://thelivemodels.com/images/step-4-verified.jpg"
                }
            ]
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
                    "name": "Verification Help",
                    "item": "https://thelivemodels.com/verification-help"
                }
            ]
        },
        "publisher": {
            "@type": "Organization",
            "name": "The Live Models",
            "url": "https://thelivemodels.com",
            "logo": {
                "@type": "ImageObject",
                "url": "https://thelivemodels.com/images/logo.png"
            }
        },
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://thelivemodels.com/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>

    <!-- FAQ Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Why do I need to get verified on The Live Models?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Verification ensures a safe, authentic community. Verified users get premium features, higher trust ratings, priority support, and can connect with other verified members for enhanced security and better experiences."
                }
            },
            {
                "@type": "Question",
                "name": "What documents are accepted for verification?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We accept government-issued photo IDs: passports, driver's licenses, national ID cards, and state-issued IDs. Documents must be current, not expired, and all text must be clearly readable."
                }
            },
            {
                "@type": "Question",
                "name": "How long does verification take on The Live Models?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Most verifications complete within 2-24 hours. Our AI system provides instant initial review, followed by human verification. You'll receive email notifications throughout the process."
                }
            },
            {
                "@type": "Question",
                "name": "Is my personal information secure during verification?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Absolutely. We use industry-standard encryption and comply with applicable privacy laws (including GDPR and CCPA where applicable). Your documents are stored securely, used only for verification, and are not shared with third parties except as required by law. We retain verification data only for as long as necessary to fulfill verification and compliance obligations."
                }
            },
            {
                "@type": "Question",
                "name": "What if my verification is rejected?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "You'll receive detailed feedback explaining the issue. Common problems include blurry photos, expired documents, or mismatched information. You can resubmit immediately with corrected documents."
                }
            }
        ]
    }
    </script>

    <!-- Organization Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "The Live Models",
        "url": "https://thelivemodels.com",
        "logo": "https://thelivemodels.com/images/logo.png",
        "description": "The premier platform for authentic connections with secure verification process and 24/7 support.",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+1-800-LIVE-MODELS",
            "contactType": "customer service",
            "availableLanguage": "English",
            "areaServed": "US"
        },
        "sameAs": [
            "https://twitter.com/thelivemodels",
            "https://facebook.com/thelivemodels",
            "https://instagram.com/thelivemodels"
        ]
    }
    </script>

    <!-- External Resources -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php include('includes/head.php'); ?>
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

        .premium-text {
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(80px) scale(0.95);
            transition: all 1.2s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .hover-lift {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.2);
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
            animation: text-pulse 3s ease-in-out infinite;
        }

        @keyframes text-pulse {
            0%, 100% { text-shadow: 0 0 20px rgba(139, 92, 246, 0.5); }
            50% { text-shadow: 0 0 30px rgba(139, 92, 246, 0.8); }
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        .floating:nth-child(2n) {
            animation-delay: -2s;
            animation-duration: 8s;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .step-card {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            cursor: pointer;
        }

        .step-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(139, 92, 246, 0.3);
            border-color: rgba(139, 92, 246, 0.4);
        }

        .step-number {
            background: var(--primary-gradient);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 15px 40px rgba(139, 92, 246, 0.6);
            }
        }

        .faq-item {
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            cursor: pointer;
            overflow: hidden;
        }

        .faq-item:hover {
            background: rgba(139, 92, 246, 0.08);
            border-color: rgba(139, 92, 246, 0.3);
            transform: translateX(8px);
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .faq-item.active .faq-content {
            max-height: 200px;
        }

        .faq-item.active .faq-arrow {
            transform: rotate(180deg);
        }

        .faq-arrow {
            transition: transform 0.3s ease;
        }

        .verification-badge {
            background: linear-gradient(45deg, #10b981, #34d399);
            animation: badge-glow 3s infinite;
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.8);
        }

        @keyframes badge-glow {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 0 25px rgba(16, 185, 129, 0.8);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 0 35px rgba(16, 185, 129, 1);
            }
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

        .bg-animated {
            background: linear-gradient(-45deg, #1a1a2e, #16213e, #0f0f23, #1a1a2e);
            background-size: 400% 400%;
            animation: gradient-flow 15s ease infinite;
        }

        @keyframes gradient-flow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="min-h-screen bg-animated text-white advt-page socialwall-page">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded">Skip to main content</a>
    
    	<!-- Premium Particle System -->
  <div class="particles" id="particles"></div>
    <!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>

    <main id="main-content" role="main">
        <!-- Hero section with enhanced SEO content -->
        <section class="py-24 md:py-32 relative overflow-hidden" aria-labelledby="hero-heading">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/30 via-purple-900/20 to-pink-900/30" aria-hidden="true"></div>
            <div class="container mx-auto relative z-10">
                <div class="text-center mb-20 scroll-reveal">
                    <div class="inline-flex items-center px-6 py-3 ultra-glass rounded-full text-indigo-300 font-medium text-sm border border-indigo-500/30 floating mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 text-green-400" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                        Verification Help Center
                    </div>
                    
                    <h1 id="hero-heading" class="text-5xl md:text-6xl xl:text-7xl font-bold heading-font leading-tight mb-8">
                        <span class="gradient-text text-glow">Get Verified Fast</span><br>
                        <span class="premium-text">on The Live Models</span>
                    </h1>
                    
                    <p class="text-xl md:text-2xl text-white/80 leading-relaxed max-w-3xl mx-auto mb-8">
                        Complete your identity verification in under 24 hours. Join thousands of verified models and members with our secure, AI-powered verification process and 24/7 expert support.
                    </p>

                    <div class="verification-badge text-white px-6 py-3 rounded-full text-lg font-bold inline-flex items-center gap-3 floating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        100% Verified Community
                    </div>
                </div>
            </div>
        </section>

        <!-- Verification steps with enhanced SEO structure -->
        <section class="py-20 relative scroll-reveal" aria-labelledby="verification-steps-heading">
            <div class="container mx-auto">
                <div class="text-center mb-16">
                    <h2 id="verification-steps-heading" class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-6 text-glow">4-Step Verification Process</h2>
                    <p class="text-xl text-white/70 max-w-2xl mx-auto">Simple, secure identity verification that takes less than 5 minutes to complete</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    <article class="ultra-glass p-8 rounded-2xl step-card hover-lift" onclick="toggleStep(1)">
                        <div class="step-number mx-auto mb-6" aria-label="Step 1">1</div>
                        <h3 class="text-xl font-bold premium-text mb-4 text-center">Upload Government ID</h3>
                        <p class="text-white/70 text-center leading-relaxed">
                            Upload a clear, high-quality photo of your government-issued ID. We accept passports, driver's licenses, and national ID cards from all countries.
                        </p>
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center text-sm text-indigo-400 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                2 minutes
                            </div>
                        </div>
                    </article>

                    <article class="ultra-glass p-8 rounded-2xl step-card hover-lift" onclick="toggleStep(2)">
                        <div class="step-number mx-auto mb-6" aria-label="Step 2">2</div>
                        <h3 class="text-xl font-bold premium-text mb-4 text-center">Take Verification Selfie</h3>
                        <p class="text-white/70 text-center leading-relaxed">
                            Take a clear selfie holding your ID next to your face. Ensure good lighting, remove sunglasses, and make sure both your face and ID are clearly visible.
                        </p>
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center text-sm text-indigo-400 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                1 minute
                            </div>
                        </div>
                    </article>

                    <article class="ultra-glass p-8 rounded-2xl step-card hover-lift" onclick="toggleStep(3)">
                        <div class="step-number mx-auto mb-6" aria-label="Step 3">3</div>
                        <h3 class="text-xl font-bold premium-text mb-4 text-center">AI Security Review</h3>
                        <p class="text-white/70 text-center leading-relaxed">
                            Our advanced AI security system instantly analyzes your documents for authenticity and matches your selfie to your ID using facial recognition technology.
                        </p>
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center text-sm text-indigo-400 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                Instant
                            </div>
                        </div>
                    </article>

                    <article class="ultra-glass p-8 rounded-2xl step-card hover-lift" onclick="toggleStep(4)">
                        <div class="step-number mx-auto mb-6" aria-label="Step 4">4</div>
                        <h3 class="text-xl font-bold premium-text mb-4 text-center">Get Verified Badge</h3>
                        <p class="text-white/70 text-center leading-relaxed">
                            Receive your official verified badge and unlock premium features, priority support, and enhanced security within 24 hours of submission.
                        </p>
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center text-sm text-green-400 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                Complete
                            </div>
                        </div>
                    </article>
                </div>
				
				<?php 
				if(isset($_SESSION["log_user_id"]) && !empty($userDetails)){
					$redirect_link = SITEURL.'edit-profile';
				}else{
					$redirect_link = SITEURL;
				}
				?>

                <div class="mt-16 text-center">
                    <button class="btn-primary px-12 py-4 text-white rounded-xl font-bold text-lg shadow-2xl" onclick="startVerification('<?php echo $redirect_link; ?>')" aria-label="Start the verification process now">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        Join now
                    </button>
                </div>
            </div>
        </section>

        <!-- FAQ section with enhanced SEO structure -->
        <section class="py-20 relative scroll-reveal" aria-labelledby="faq-heading">
            <div class="container mx-auto">
                <div class="text-center mb-16">
                    <h2 id="faq-heading" class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-6 text-glow">Verification FAQ</h2>
                    <p class="text-xl text-white/70 max-w-2xl mx-auto">Get instant answers to the most common verification questions</p>
                </div>
                
                <div class="max-w-4xl mx-auto space-y-4">
                    <article class="ultra-glass faq-item rounded-2xl border border-white/10 p-6" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold premium-text">Why do I need to get verified on The Live Models?</h3>
                            <svg class="faq-arrow w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="faq-content mt-4">
                            <p class="text-white/70 leading-relaxed">
                                Verification ensures a safe, authentic community on The Live Models. Verified users get premium features, higher trust ratings, priority customer support, enhanced security features, and can connect with other verified members for better experiences and increased earnings potential.
                            </p>
                        </div>
                    </article>

                    <article class="ultra-glass faq-item rounded-2xl border border-white/10 p-6" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold premium-text">What documents are accepted for verification?</h3>
                            <svg class="faq-arrow w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="faq-content mt-4">
                            <p class="text-white/70 leading-relaxed">
                                We accept government-issued photo IDs including passports, driver's licenses, national ID cards, and state-issued identification cards from all countries. Documents must be current (not expired), authentic, and all text must be clearly readable with no blurring or obstruction.
                            </p>
                        </div>
                    </article>

                    <article class="ultra-glass faq-item rounded-2xl border border-white/10 p-6" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold premium-text">How long does verification take on The Live Models?</h3>
                            <svg class="faq-arrow w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="faq-content mt-4">
                            <p class="text-white/70 leading-relaxed">
                                Most verifications complete within 2-24 hours. Our AI system provides instant initial review and fraud detection, followed by human verification for final approval. You'll receive email notifications and in-app updates throughout the entire verification process.
                            </p>
                        </div>
                    </article>

                    <article class="ultra-glass faq-item rounded-2xl border border-white/10 p-6" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold premium-text">Is my personal information secure during verification?</h3>
                            <svg class="faq-arrow w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="faq-content mt-4">
                            <p class="text-white/70 leading-relaxed">
                                Absolutely. We use military-grade 256-bit encryption and comply with international privacy standards including GDPR and CCPA. Your documents are securely stored, used only for verification purposes, and never shared with third parties. All data is automatically deleted after verification completion.
                            </p>
                        </div>
                    </article>

                    <article class="ultra-glass faq-item rounded-2xl border border-white/10 p-6" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold premium-text">What if my verification is rejected?</h3>
                            <svg class="faq-arrow w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="faq-content mt-4">
                            <p class="text-white/70 leading-relaxed">
                                You'll receive detailed feedback explaining the specific issue and how to fix it. Common problems include blurry photos, expired documents, mismatched information, or poor lighting. You can resubmit immediately with corrected documents at no additional cost.
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Support section with enhanced SEO -->
        <section class="py-20 gradient-bg relative overflow-hidden" aria-labelledby="support-heading">
            <div class="absolute inset-0 bg-black/40" aria-hidden="true"></div>
            <div class="container mx-auto relative z-10">
                <div class="text-center text-white">
                    <h2 id="support-heading" class="text-4xl md:text-6xl font-bold heading-font mb-8 text-glow">Need Verification Help?</h2>
                    <p class="text-xl mb-12 opacity-90 max-w-3xl mx-auto">Our expert verification support team is available 24/7 to assist with any questions or issues during the verification process</p>
                    
                    <div class="flex justify-center items-center mb-12">
                        <button class="px-16 py-6 bg-white text-indigo-600 font-bold rounded-xl hover:bg-gray-100 transition duration-300 shadow-2xl text-xl hover-lift" onclick="contactSupport()" aria-label="Contact our 24/7 support team">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            Contact Verification Support
                        </button>
                    </div>
                    
                    <div class="ultra-glass p-8 rounded-2xl max-w-2xl mx-auto border border-white/20 floating">
                        <div class="flex items-center justify-center space-x-3 text-lg">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse" aria-hidden="true"></div>
                            <span class="font-medium">24/7 Expert Verification Support Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializePremiumFeatures();
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

            // Premium Scroll Reveal
            const premiumObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -100px 0px' });

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                premiumObserver.observe(el);
            });
        }

        function toggleFAQ(element) {
            const isActive = element.classList.contains('active');
            
            // Close all FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                element.classList.add('active');
            }
        }

        function toggleStep(stepNumber) {
            // Enhanced step interaction for better UX
            const stepDetails = {
                1: "Step 1: Upload a clear, well-lit photo of your government-issued ID. Ensure all text is readable and the document is not expired.",
                2: "Step 2: Take a selfie holding your ID next to your face. Make sure both your face and ID are clearly visible with good lighting.",
                3: "Step 3: Our AI system will instantly verify your documents and match your selfie to your ID using advanced facial recognition.",
                4: "Step 4: Once approved, you'll receive your verified badge and unlock all premium features within 24 hours."
            };
            alert(`📋 ${stepDetails[stepNumber]}`);
        }

        function startVerification(redirect) {
            // Track verification start for analytics
            /*if (typeof gtag !== 'undefined') {
                gtag('event', 'verification_started', {
                    'event_category': 'verification',
                    'event_label': 'help_page'
                });
            }
            alert('🚀 Starting Verification - Redirecting to secure verification portal...'); */
             window.location.href = redirect;
        }

        function handleSignIn() {
            alert('🔐 Premium Sign In - Redirecting to secure login portal...');
            // window.location.href = 'https://thelivemodels.com/login';
        }

        function contactSupport() {
            // Track support contact for analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'support_contact', {
                    'event_category': 'support',
                    'event_label': 'verification_help'
                });
            }
            //alert('📧 Premium Support - Opening support ticket system...');
            // window.location.href = 'https://thelivemodels.com/support';
			window.location.href = '<?= SITEURL ?>contact-support';
        }
    </script>




</body>
</html>