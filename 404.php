<?php 
session_start();
include('includes/config.php');
include('includes/helper.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>404 - Page Not Found | Live Models</title>
<meta name="description" content="Oops! The page you're looking for seems to have wandered off. Let's get you back to finding your perfect connection.">

<?php include('includes/head.php'); ?>


<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

    .premium-text {
        background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
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

    /* 404 Specific Animations */
    .error-number {
        font-size: 8rem;
        font-weight: 900;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: error-glow 3s ease-in-out infinite alternate;
        text-shadow: 0 0 50px rgba(139, 92, 246, 0.5);
        line-height: 0.8;
    }

    /*  Removed error-pulse animation to stop text movement */
    @keyframes error-glow {
        0% { 
            text-shadow: 0 0 50px rgba(139, 92, 246, 0.5);
        }
        100% { 
            text-shadow: 0 0 80px rgba(139, 92, 246, 0.8), 0 0 120px rgba(236, 72, 153, 0.6);
        }
    }

    /*  Removed floating animation to stop text movement */
    .static-content {
        /* No animations applied */
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

    /* Broken Heart Animation */
    .broken-heart {
        animation: heartbreak 3s ease-in-out infinite;
        filter: drop-shadow(0 0 20px rgba(236, 72, 153, 0.6));
    }

    @keyframes heartbreak {
        0%, 100% { 
            transform: scale(1) rotate(0deg);
            filter: drop-shadow(0 0 20px rgba(236, 72, 153, 0.6));
        }
        25% { 
            transform: scale(1.1) rotate(-2deg);
            filter: drop-shadow(0 0 30px rgba(236, 72, 153, 0.8));
        }
        50% { 
            transform: scale(1.2) rotate(0deg);
            filter: drop-shadow(0 0 40px rgba(236, 72, 153, 1));
        }
        75% { 
            transform: scale(1.1) rotate(2deg);
            filter: drop-shadow(0 0 30px rgba(236, 72, 153, 0.8));
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

    /* Text Glow */
    .text-glow {
        text-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
        animation: text-pulse 3s ease-in-out infinite;
    }

    @keyframes text-pulse {
        0%, 100% { text-shadow: 0 0 20px rgba(139, 92, 246, 0.5); }
        50% { text-shadow: 0 0 30px rgba(139, 92, 246, 0.8); }
    }

    /* Background Animation */
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

    /*  Enhanced mobile responsiveness */
    @media (max-width: 768px) {
        .error-number {
            font-size: 6rem;
        }
        
        .ultra-glass {
            padding: 2rem !important;
            margin: 1rem;
        }
        
        .btn-primary, .btn-secondary {
            width: 100%;
            margin-bottom: 1rem;
        }
        
        .grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1rem;
        }
    }

    @media (max-width: 640px) {
        .error-number {
            font-size: 4rem;
        }
        
        h1 {
            font-size: 2.5rem !important;
        }
        
        .text-2xl {
            font-size: 1.5rem !important;
        }
        
        .ultra-glass {
            padding: 1.5rem !important;
        }
    }

    @media (max-width: 480px) {
        .error-number {
            font-size: 3rem;
        }
        
        h1 {
            font-size: 2rem !important;
        }
        
        .grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
</head>
<body class="min-h-screen bg-animated text-white socialwall-page">
<!-- Premium Particle System -->
<div class="particles" id="particles"></div>


    <?php if (isset($_SESSION["log_user_id"])) { ?>

        <?php include('includes/side-bar.php'); ?>

        <?php include('includes/profile_header_index.php'); ?>

    <?php } else { ?>

        <?php include('includes/header.php'); ?>

    <?php } ?>

<main class="flex items-center justify-center min-h-screen py-20">
    <div class="container mx-auto max-w-6xl px-6">
        <div class="text-center">
            <!--  Removed moving animations from 404 number -->
            <div class="error-number mb-8">404</div>
            
            <!-- Broken Heart Icon -->
            <div class="flex justify-center mb-12">
                <svg class="broken-heart w-24 h-24 text-pink-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    <!-- Crack in the heart -->
                    <path d="M12 3v18.35" stroke="currentColor" stroke-width="0.5" fill="none" opacity="0.7"/>
                    <path d="M8 7l8 8" stroke="currentColor" stroke-width="0.3" fill="none" opacity="0.5"/>
                </svg>
            </div>

            <!--  Removed floating animation from main content -->
            <div class="ultra-glass p-12 rounded-3xl shadow-2xl max-w-4xl mx-auto static-content">
                <h1 class="text-5xl md:text-6xl font-bold heading-font gradient-text mb-6 text-glow">
                    Connection Lost
                </h1>
                
                <p class="text-2xl md:text-3xl premium-text mb-8 leading-relaxed">
                    Oops! This page seems to have wandered off to find its perfect match
                </p>
                
                <p class="text-xl text-white/70 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Don't worry, even the best connections sometimes take a wrong turn. Let's get you back to discovering amazing members and creators.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-12">
                    <button class="btn-primary px-12 py-4 text-white rounded-xl font-bold text-lg shadow-2xl hover-lift" onclick="window.location.href='/'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        Take Me Home
                    </button>
                    <button class="btn-secondary px-12 py-4 text-white rounded-xl font-bold text-lg hover-lift" onclick="discoverModels()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        Discover Members
                    </button>
                </div>
            </div>

            <!--  Philosophy section kept as requested -->
            <div class="mt-16 ultra-glass p-8 rounded-2xl max-w-2xl mx-auto static-content">
                <p class="text-lg italic premium-text mb-3">
                    "Even the best connections sometimes take unexpected detours. The journey back is part of the adventure."
                </p>
                <p class="text-sm text-white/60">- Live Models Philosophy</p>
            </div>
        </div>
    </div>
</main>


<?php include('includes/footer.php'); ?>

<script>
// Create premium particle system
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 50;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 12 + 's';
        particle.style.animationDuration = (12 + Math.random() * 8) + 's';
        particlesContainer.appendChild(particle);
    }
}

// Navigation functions
function discoverModels() {
    window.location.href = '/models';
}

// Initialize particles when page loads
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
});

// Add some interactive effects
document.addEventListener('mousemove', function(e) {
    const particles = document.querySelectorAll('.particle');
    const mouseX = e.clientX / window.innerWidth;
    const mouseY = e.clientY / window.innerHeight;
    
    particles.forEach((particle, index) => {
        if (index % 5 === 0) { // Only affect every 5th particle for performance
            const speed = 0.5;
            const x = (mouseX - 0.5) * speed;
            const y = (mouseY - 0.5) * speed;
            particle.style.transform += ` translate(${x}px, ${y}px)`;
        }
    });
});
</script>
</body>
</html>