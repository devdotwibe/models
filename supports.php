<?php 
session_start();
include('includes/config.php');
include('includes/helper.php');
$usern = $_SESSION["log_user"];
$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);

if ($userDetails) {
} else {
  echo '<script>window.location.href="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - The Live Models</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
	<?php include('includes/head.php'); ?>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);
            --premium-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 50%, #fff2a1 100%);
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
            margin: 0;
            padding: 0;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        /* Premium Gradients */
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
        .glass-effect {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
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
                transform: translateY(10vh) translateX(-20px) scale(1) rotate(315deg);
            }
            100% {
                opacity: 0;
                transform: translateY(-10vh) translateX(0px) scale(0) rotate(360deg);
            }
        }

        /* Ultra Premium Buttons */
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
            padding: 12px 24px;
            border-radius: 12px;
            color: white;
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
            padding: 12px 24px;
            border-radius: 12px;
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(255, 255, 255, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Premium Text Effects */
        .premium-text {
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
            animation: text-pulse 3s ease-in-out infinite;
        }

        @keyframes text-pulse {
            0%, 100% { text-shadow: 0 0 20px rgba(139, 92, 246, 0.5); }
            50% { text-shadow: 0 0 30px rgba(139, 92, 246, 0.8); }
        }

        /* Layout Styles */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .support-layout {
            display: flex;
            gap: 30px;
            min-height: 100vh;
            padding: 30px 0;
        }

        .profile-sidebar {
            width: 320px;
            flex-shrink: 0;
        }

        .support-content {
            flex: 1;
            min-width: 0;
        }

        .profile-card {
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .profile-avatar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: avatar-shine 3s infinite;
        }

        @keyframes avatar-shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
            100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            margin-bottom: 8px;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #667eea;
            transform: translateX(5px);
        }

        .menu-item.active {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            border-left: 3px solid #667eea;
        }

        .menu-item i {
            width: 20px;
            margin-right: 15px;
            font-size: 16px;
        }

        .support-header {
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            text-align: center;
        }

        .support-tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tab-button {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .tab-button.active {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tickets-section {
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .tickets-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .tickets-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .tickets-table th,
        .tickets-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tickets-table th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 600;
            color: #667eea;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-open {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .status-closed {
            background: rgba(107, 114, 128, 0.2);
            color: #6b7280;
        }

        .faq-section {
            border-radius: 24px;
            padding: 30px;
        }

        .faq-search {
            width: 100%;
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.06);
            color: white;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .faq-search::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .faq-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .faq-category {
            border-radius: 16px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .faq-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.2);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .faq-category.active {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }

        .faq-item {
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-question {
            padding: 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .faq-question:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.02);
            color: rgba(255, 255, 255, 0.8);
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
            padding: 20px;
        }

        .faq-item.active .faq-question {
            background: rgba(102, 126, 234, 0.1);
            border-color: rgba(102, 126, 234, 0.3);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            border-radius: 24px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            color: #667eea;
            transform: scale(1.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #667eea;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.06);
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .support-layout {
                flex-direction: column;
                gap: 20px;
            }
            
            .profile-sidebar {
                width: 100%;
            }
            
            .profile-card {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            
            .support-layout {
                padding: 20px 0;
            }
            
            .support-header,
            .tickets-section,
            .faq-section {
                padding: 20px;
            }
            
            .support-tabs {
                flex-direction: column;
                gap: 10px;
            }
            
            .tab-button {
                width: 100%;
                text-align: center;
            }
            
            .tickets-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .tickets-table {
                font-size: 14px;
            }
            
            .tickets-table th,
            .tickets-table td {
                padding: 10px 8px;
            }
            
            .faq-categories {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                padding: 20px;
                margin: 20px;
            }
        }

        @media (max-width: 480px) {
            .profile-stats {
                flex-direction: column;
                gap: 15px;
            }
            
            .tickets-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .faq-question {
                padding: 15px;
            }
            
            .faq-answer {
                padding: 0 15px;
            }
            
            .faq-item.active .faq-answer {
                padding: 15px;
            }
        }

        .priority-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-low {
            background: rgba(52, 211, 153, 0.2);
            color: #34d399;
        }

        .status-medium {
            background: rgba(251, 146, 60, 0.2);
            color: #fb923c;
        }

        .status-high {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .status-critical {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
        }

        .category-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            color: #a3a3a3;
            background: rgba(163, 163, 163, 0.1);
        }
    </style>
</head>
<body id="app" class="advt-page min-h-screen bg-animated text-white socialwall-page">

	<!-- Premium Particle System -->
  <div class="particles" id="particles"></div>
    <!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>

    <div class="container">
        <div class="support-layout">
            

            <!-- Support Content -->
            <div class="support-content">
                <!-- Support Header -->
                <div class="support-header ultra-glass">
                    <h1 class="heading-font text-4xl gradient-text text-glow mb-4">Support Center</h1>
                    <p class="text-xl text-white/80">Get help with your account, find answers to common questions, or contact our support team.</p>
                </div>

                <!-- Support Tabs -->
                <div class="support-tabs">
                    <button class="tab-button active" onclick="switchTab('tickets')">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Support Tickets
                    </button>
                    <button class="tab-button" onclick="switchTab('faq')">
                        <i class="fas fa-question-circle mr-2"></i>
                        FAQ
                    </button>
                    <!-- Removed Contact Us tab since it's merged into ticket creation -->
                </div>

                <!-- Support Tickets Tab -->
                <div id="tickets-tab" class="tab-content active">
                    <div class="tickets-section ultra-glass">
                        <div class="tickets-header">
                            <h2 class="heading-font text-2xl premium-text">Your Support Tickets</h2>
                            <!-- Enhanced button text and description -->
                            <button class="btn-primary" onclick="openNewTicketModal()">
                                <i class="fas fa-headset mr-2"></i>
                                Contact Support
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="tickets-table">
                                <thead>
                                    <tr>
                                        <th>Ticket #</th>
                                        <th>Subject</th>
                                        <th>Category</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tickets-tbody">
                                    <tr>
                                        <td colspan="8" class="text-center text-white/60 py-8">
                                            <i class="fas fa-inbox text-4xl mb-4 block"></i>
                                            No support tickets found. Create your first ticket to get started.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <button class="btn-secondary" disabled>
                                <i class="fas fa-chevron-left mr-2"></i>
                                Prev
                            </button>
                            <button class="btn-secondary" disabled>
                                Next
                                <i class="fas fa-chevron-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- FAQ Tab -->
                <div id="faq-tab" class="tab-content">
                    <div class="faq-section ultra-glass">
                        <h2 class="heading-font text-2xl premium-text mb-6">Frequently Asked Questions</h2>
                        
                        <input type="text" class="faq-search" placeholder="Search FAQs..." id="faq-search" oninput="searchFAQs()">
                        
                        <div class="faq-categories">
                            <div class="faq-category glass-effect active" onclick="filterFAQs('all')">
                                <h3 class="font-semibold text-lg gradient-text mb-2">All Categories</h3>
                                <p class="text-white/60">Browse all questions</p>
                            </div>
                            <div class="faq-category glass-effect" onclick="filterFAQs('platform')">
                                <h3 class="font-semibold text-lg gradient-text mb-2">Platform Features</h3>
                                <p class="text-white/60">Chat, Watch, Meet, Travel</p>
                            </div>
                            <div class="faq-category glass-effect" onclick="filterFAQs('account')">
                                <h3 class="font-semibold text-lg gradient-text mb-2">Account & Verification</h3>
                                <p class="text-white/60">Registration, ID verification</p>
                            </div>
                            <div class="faq-category glass-effect" onclick="filterFAQs('payments')">
                                <h3 class="font-semibold text-lg gradient-text mb-2">Tokens & Payments</h3>
                                <p class="text-white/60">Purchasing, earning, withdrawals</p>
                            </div>
                            <div class="faq-category glass-effect" onclick="filterFAQs('safety')">
                                <h3 class="font-semibold text-lg gradient-text mb-2">Safety & Privacy</h3>
                                <p class="text-white/60">Security, blocking, reporting</p>
                            </div>
                            <div class="faq-category glass-effect" onclick="filterFAQs('creator')">
                                <h3 class="font-semibold text-lg gradient-text mb-2">Creator Features</h3>
                                <p class="text-white/60">Content, streaming, earnings</p>
                            </div>
                        </div>
                        
                        <div id="faq-list">
                            <!-- Platform Features FAQs -->
                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What is The Live Models (TLM)?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    The Live Models is a global dating and social networking platform where adults can connect with people worldwide through four core features: Chat (send messages and connect instantly), Watch (enjoy live streams, videos, and exclusive content), Meet (request or accept invitations for lawful social meet-ups), and Travel (connect with others to plan safe, lawful travel experiences).
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Is TLM an escort or adult website?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    No. TLM is not an escort agency or adult services provider. It is a UGC (user-generated content) social platform. Creators and users decide how they interact. All offline activities are voluntary and personal, not arranged by TLM.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do Meet Requests work?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    A user sends a Meet Request through the platform. The recipient can accept, decline, or ignore. TLM does not arrange or guarantee meetings; all arrangements are personal.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do Travel Requests work?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Users can connect for travel planning, companionship during lawful travel, or social exploration. We strongly recommend only meeting in safe, public places. TLM does not act as a travel agent or broker.
                                </div>
                            </div>

                            <!-- Account & Verification FAQs -->
                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Who can join TLM?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    TLM is strictly for adults (18+). Users must comply with our Terms of Service and Community Guidelines.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do I verify my account?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    All users must verify their email address by entering the one-time code (OTP) sent to them. Creators must submit a valid government-issued ID to access paid features (posting paid content, live streaming, Meet/Travel requests).
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Why is creator verification required?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Verification protects our community by ensuring that only real, legal adults can monetize their content. It prevents fraud, impersonation, and underage access.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What happens if verification fails?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    If your documents don't meet the requirements or cannot be verified, we will notify you via email. You may re-submit corrected documents. Accounts with repeated failed attempts may be restricted.
                                </div>
                            </div>

                            <!-- Payments FAQs -->
                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What are Tokens?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Tokens are in-app digital credits used for unlocking paid creator content, sending gifts during live streams, boosting your profile visibility, and making Meet/Travel requests.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Are Tokens refundable?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    No. All Token purchases are final and non-refundable, unless required by applicable law.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How can creators earn?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Creators earn Tokens when users purchase their content, watch their streams, or send Meet/Travel requests. Tokens can be converted to withdrawals once minimum payout thresholds are met.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Are Creator earnings taxable?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Yes. Creators are independent users, not employees of TLM. They are responsible for declaring and paying taxes in their home country.
                                </div>
                            </div>

                            <!-- Safety FAQs -->
                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How does TLM protect my privacy?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    We apply strong encryption and follow strict data-protection policies. Only the details you choose to share are public.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do I block or report a user?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Each profile has Block and Report buttons. Reports are reviewed by our safety team to ensure quick action against rule violations.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What safety tips should I follow when meeting?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Always meet in public places, inform a trusted friend or family member, never share sensitive financial or identity details, and use caution when engaging in Meet/Travel requests.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What should I do if I suspect a scam?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Immediately block the user and use the Report function. Do not share financial or sensitive information outside the platform.
                                </div>
                            </div>

                            <!-- Creator Features FAQs -->
                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do I become a Creator?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    To become a Creator, apply through the "Become a Broadcaster/Creator" section in your profile. You'll need to submit a valid government-issued ID for verification before posting paid content or live streaming.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What kind of content can Creators upload?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Creators may upload photos, videos, and livestreams. Content must comply with our Community Guidelines—prohibited material includes underage content, illegal activity, violence, or solicitation of sexual services.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Can I live stream as a user?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Only verified creators can host live streams. Regular users can watch, chat, or send tokens during streams.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do Creators withdraw earnings?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Earnings appear in the Wallet. Once the minimum payout threshold is met, Creators can request a withdrawal through supported payout methods.
                                </div>
                            </div>

                            <!-- Additional FAQs -->
                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Is the platform free to use?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Yes. Creating an account and using basic features is free. Certain premium features, creator content, and meet/travel requests may require Tokens.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What content is prohibited?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Prohibited content includes underage content (strict 18+ only), violence, hate speech, illegal activities, promotion of sexual services or prostitution, and spam, scams, or fraudulent content. Violations may result in account suspension or permanent bans.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">I forgot my password. What should I do?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Click Forgot Password on the login page and follow the reset instructions sent to your email.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Why can't I watch a livestream?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Possible causes include poor internet connection, outdated browser or app version, or regional restrictions on certain content.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What are Boosts and Premium Features?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Boosts and Premium Features allow users/creators to increase profile visibility, highlight posts or images in search results, and access advanced filters for finding matches.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Can other users see my personal details?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    No. Your email, ID, and payment information are never shared. Other users only see your public profile information.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Does TLM arrange meetings or travel?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    No. TLM is a neutral intermediary. All offline interactions are voluntary between users.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Are creators employees of TLM?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    No. Creators are independent users who choose to share content or accept requests. TLM does not employ or contract creators.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How does TLM protect against fraud?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    We use AI-driven fraud detection, ID verification, and account monitoring to prevent scams and fake accounts.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Can I log in on multiple devices?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Yes, but suspicious logins may trigger re-verification for security.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do I purchase Tokens?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Tokens can be purchased through approved payment methods listed on the platform.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Can I post free content as a Creator?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Yes. Creators can post free and paid content, giving them flexibility to engage with followers and grow their community.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="safety">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How are disputes between users handled?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    TLM is a neutral platform. While we investigate reports, we cannot enforce private agreements between users. We may suspend or remove accounts that violate our policies.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">What happens if my account is banned?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    You will be notified by email with the reason. Permanent bans cannot be appealed in cases of serious violations such as fraud, underage content, or illegal activity.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Where is TLM based?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    TLM is a New Zealand–registered company with a global user base.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="account">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How often is re-verification required?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    We may require re-verification in case of device or location changes that appear risky, expired or invalid identification, or reported safety or compliance concerns.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="payments">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Can I request a refund if I'm unhappy with a Creator's content?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Generally, Token purchases and content unlocks are non-refundable. Exceptions may apply if fraud or platform errors are confirmed.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="creator">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">Can Creators promote their content?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    Yes. Creators can purchase advertising boosts to highlight their content in search results or feed recommendations.
                                </div>
                            </div>

                            <div class="faq-item glass-effect" data-category="platform">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <span class="font-semibold">How do I contact support?</span>
                                    <i class="fas fa-chevron-down transition-transform"></i>
                                </div>
                                <div class="faq-answer">
                                    You can reach our support team by creating a support ticket from your account or using the contact form in this support center.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Tab -->
                <div id="contact-tab" class="tab-content">
                    <div class="faq-section ultra-glass">
                        <h2 class="heading-font text-2xl premium-text mb-6">Contact Support</h2>
                        <p class="text-white/80 mb-8">Can't find what you're looking for? Send us a message and we'll get back to you as soon as possible.</p>
                        
                        <form class="space-y-6">
                            <div class="form-group">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-input" placeholder="Brief description of your issue">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-input">
                                    <option>Account Issues</option>
                                    <option>Payment Problems</option>
                                    <option>Technical Support</option>
                                    <option>Safety Concerns</option>
                                    <option>Creator Support</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Message</label>
                                <textarea class="form-textarea" placeholder="Please describe your issue in detail..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Ticket Modal -->
    <!-- Enhanced New Ticket Modal with professional features -->
    <div id="new-ticket-modal" class="modal">
        <div class="modal-content ultra-glass" style="max-width: 600px; max-height: 90vh; overflow-y: auto;">
            <button class="modal-close" onclick="closeNewTicketModal()">
                <i class="fas fa-times"></i>
            </button>
            <div class="mb-6">
                <h2 class="heading-font text-2xl gradient-text mb-2">Create Support Ticket</h2>
                <p class="text-white/70 text-sm">Please provide detailed information about your issue to help us assist you better.</p>
            </div>
            
            <form id="new-ticket-form" onsubmit="createTicket(event)">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-heading mr-2"></i>
                        Subject *
                    </label>
                    <input type="text" class="form-input" id="ticket-title" placeholder="Brief description of your issue" required maxlength="100">
                    <small class="text-white/50 text-xs">Maximum 100 characters</small>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-folder mr-2"></i>
                        Category *
                    </label>
                    <select class="form-input" id="ticket-category" required>
                        <option value="">Select a category</option>
                        <option value="account">Account Issues</option>
                        <option value="billing">Billing & Payments</option>
                        <option value="technical">Technical Support</option>
                        <option value="content">Content Issues</option>
                        <option value="safety">Safety & Security</option>
                        <option value="creator">Creator Support</option>
                        <option value="feature">Feature Request</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Priority Level
                    </label>
                    <select class="form-input" id="ticket-priority">
                        <option value="low">Low - General inquiry</option>
                        <option value="medium" selected>Medium - Standard issue</option>
                        <option value="high">High - Urgent matter</option>
                        <option value="critical">Critical - Service disruption</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left mr-2"></i>
                        Description *
                    </label>
                    <textarea class="form-textarea" id="ticket-description" placeholder="Please describe your issue in detail. Include steps to reproduce the problem, error messages, and any relevant information..." required minlength="20" rows="5"></textarea>
                    <small class="text-white/50 text-xs">Minimum 20 characters. Be as detailed as possible.</small>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-paperclip mr-2"></i>
                        Attachments
                    </label>
                    <div class="file-upload-area" onclick="document.getElementById('ticket-files').click()" style="border: 2px dashed rgba(255,255,255,0.3); border-radius: 8px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                        <i class="fas fa-cloud-upload-alt text-2xl text-white/60 mb-2"></i>
                        <p class="text-white/70 mb-1">Click to upload files or drag and drop</p>
                        <small class="text-white/50">Supported: Images, Documents, Videos (Max 10MB each, up to 5 files)</small>
                        <input type="file" id="ticket-files" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt,.mp4,.mov,.avi" style="display: none;" onchange="handleFileSelection(this)">
                    </div>
                    <div id="selected-files" class="mt-3"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Email
                    </label>
                    <input type="email" class="form-input" id="ticket-email" placeholder="your.email@example.com" value="user@example.com">
                    <small class="text-white/50 text-xs">We'll send updates to this email address</small>
                </div>

                <div class="form-group">
                    <div style="background: rgba(255,255,255,0.1); border-radius: 8px; padding: 15px; border-left: 4px solid #3b82f6;">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-400 mr-3 mt-1"></i>
                            <div>
                                <h4 class="text-white font-medium mb-1">Before submitting:</h4>
                                <ul class="text-white/70 text-sm space-y-1">
                                    <li>• Check our FAQ section for common solutions</li>
                                    <li>• Ensure you've provided all relevant details</li>
                                    <li>• Include screenshots or videos if applicable</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" class="btn-secondary flex-1" onclick="closeNewTicketModal()">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary flex-1">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Submit Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Added Ticket Details Modal -->
    <div id="ticket-details-modal" class="modal">
        <div class="modal-content ultra-glass" style="max-width: 700px; max-height: 90vh; overflow-y: auto;">
            <button class="modal-close" onclick="closeTicketDetailsModal()">
                <i class="fas fa-times"></i>
            </button>
            <div id="ticket-details-content">
                <!-- Ticket details will be populated here -->
            </div>
        </div>
    </div>

    <script>
        // Initialize premium features
        document.addEventListener('DOMContentLoaded', function() {
            initializePremiumFeatures();
            setupFileUpload();
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
                
                const particlesContainer = document.getElementById('particles');
                if (particlesContainer) {
                    particlesContainer.appendChild(particle);
                    
                    // Remove particle after animation
                    setTimeout(() => {
                        if (particle.parentNode) {
                            particle.parentNode.removeChild(particle);
                        }
                    }, 20000);
                }
            }

            // Create particles continuously
            setInterval(createPremiumParticle, 800);
            
            // Create initial particles
            for (let i = 0; i < 15; i++) {
                setTimeout(createPremiumParticle, i * 200);
            }
        }

        // Tab switching functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }

        // FAQ functionality
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            const isActive = faqItem.classList.contains('active');
            
            // Close all other FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
                const icon = item.querySelector('.fa-chevron-down');
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current FAQ
            if (!isActive) {
                faqItem.classList.add('active');
                const icon = element.querySelector('.fa-chevron-down');
                if (icon) {
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        }

        function searchFAQs() {
            const searchTerm = document.getElementById('faq-search').value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    
                    // Highlight search terms
                    if (searchTerm) {
                        const questionSpan = item.querySelector('.faq-question span');
                        const originalText = questionSpan.textContent;
                        const highlightedText = originalText.replace(
                            new RegExp(searchTerm, 'gi'),
                            match => `<mark style="background: rgba(102, 126, 234, 0.3); color: #667eea;">${match}</mark>`
                        );
                        questionSpan.innerHTML = highlightedText;
                    }
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function filterFAQs(category) {
            const faqItems = document.querySelectorAll('.faq-item');
            const categories = document.querySelectorAll('.faq-category');
            
            // Update active category
            categories.forEach(cat => cat.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter FAQ items
            faqItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Clear search
            document.getElementById('faq-search').value = '';
        }

        function setupFileUpload() {
            const fileUploadArea = document.querySelector('.file-upload-area');
            const fileInput = document.getElementById('ticket-files');
            
            // Drag and drop functionality
            fileUploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#3b82f6';
                this.style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
            });
            
            fileUploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(255,255,255,0.3)';
                this.style.backgroundColor = 'transparent';
            });
            
            fileUploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(255,255,255,0.3)';
                this.style.backgroundColor = 'transparent';
                
                const files = e.dataTransfer.files;
                handleFiles(files);
            });
        }

        function handleFileSelection(input) {
            handleFiles(input.files);
        }

        function handleFiles(files) {
            const selectedFilesDiv = document.getElementById('selected-files');
            const maxFiles = 5;
            const maxSize = 10 * 1024 * 1024; // 10MB
            
            if (files.length > maxFiles) {
                alert(`You can only upload up to ${maxFiles} files at once.`);
                return;
            }
            
            selectedFilesDiv.innerHTML = '';
            
            Array.from(files).forEach((file, index) => {
                if (file.size > maxSize) {
                    alert(`File "${file.name}" is too large. Maximum size is 10MB.`);
                    return;
                }
                
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between bg-white/10 rounded-lg p-3 mb-2';
                fileItem.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-file text-blue-400 mr-3"></i>
                        <div>
                            <p class="text-white text-sm font-medium">${file.name}</p>
                            <p class="text-white/60 text-xs">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                    <button type="button" class="text-red-400 hover:text-red-300" onclick="removeFile(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                selectedFilesDiv.appendChild(fileItem);
            });
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function removeFile(index) {
            const fileInput = document.getElementById('ticket-files');
            const dt = new DataTransfer();
            const files = Array.from(fileInput.files);
            
            files.forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });
            
            fileInput.files = dt.files;
            handleFiles(fileInput.files);
        }

        // Modal functionality
        function openNewTicketModal() {
            document.getElementById('new-ticket-modal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeNewTicketModal() {
            document.getElementById('new-ticket-modal').classList.remove('active');
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('new-ticket-form').reset();
            document.getElementById('selected-files').innerHTML = '';
        }

        function closeTicketDetailsModal() {
            document.getElementById('ticket-details-modal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        let ticketCounter = 1001; // Start with professional numbering

        function createTicket(event) {
            event.preventDefault();
            
            const title = document.getElementById('ticket-title').value;
            const description = document.getElementById('ticket-description').value;
            const priority = document.getElementById('ticket-priority').value;
            const category = document.getElementById('ticket-category').value;
            const email = document.getElementById('ticket-email').value;
            const files = document.getElementById('ticket-files').files;
            
            if (!title || !description || !category) {
                alert('Please fill in all required fields.');
                return;
            }
            
            if (description.length < 20) {
                alert('Please provide a more detailed description (minimum 20 characters).');
                return;
            }
            
            // Create new ticket row
            const tbody = document.getElementById('tickets-tbody');
            const currentDate = new Date().toLocaleDateString();
            const currentTime = new Date().toLocaleString();
            
            // Remove "no data" row if it exists
            const noDataRow = tbody.querySelector('tr td[colspan="8"]');
            if (noDataRow) {
                noDataRow.parentElement.remove();
            }
            
            const ticketId = `TKT-${ticketCounter}`;
            const priorityClass = {
                'low': 'status-low',
                'medium': 'status-medium', 
                'high': 'status-high',
                'critical': 'status-critical'
            };
            
            const categoryDisplay = {
                'account': 'Account',
                'billing': 'Billing',
                'technical': 'Technical',
                'content': 'Content',
                'safety': 'Safety',
                'creator': 'Creator',
                'feature': 'Feature',
                'other': 'Other'
            };
            
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><strong>${ticketId}</strong></td>
                <td>${title}</td>
                <td><span class="category-badge">${categoryDisplay[category]}</span></td>
                <td><span class="priority-badge ${priorityClass[priority]}">${priority.charAt(0).toUpperCase() + priority.slice(1)}</span></td>
                <td><span class="status-badge status-open">Open</span></td>
                <td>${currentDate}</td>
                <td>${currentDate}</td>
                <td>
                    <div class="flex gap-2">
                        <button class="btn-secondary" style="padding: 6px 12px; font-size: 12px;" onclick="viewTicketDetails('${ticketId}', '${title}', '${description}', '${category}', '${priority}', '${currentTime}', ${files.length})" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-secondary" style="padding: 6px 12px; font-size: 12px;" onclick="replyToTicket('${ticketId}')" title="Reply">
                            <i class="fas fa-reply"></i>
                        </button>
                    </div>
                </td>
            `;
            
            tbody.appendChild(newRow);
            ticketCounter++;
            
            // Reset form and close modal
            document.getElementById('new-ticket-form').reset();
            document.getElementById('selected-files').innerHTML = '';
            closeNewTicketModal();
            
            // Show success message
            showNotification(`Support ticket ${ticketId} created successfully! You will receive email updates at ${email}`, 'success');
        }

        function viewTicketDetails(ticketId, title, description, category, priority, created, fileCount) {
            const categoryDisplay = {
                'account': 'Account Issues',
                'billing': 'Billing & Payments',
                'technical': 'Technical Support',
                'content': 'Content Issues',
                'safety': 'Safety & Security',
                'creator': 'Creator Support',
                'feature': 'Feature Request',
                'other': 'Other'
            };
            
            const priorityClass = {
                'low': 'status-low',
                'medium': 'status-medium', 
                'high': 'status-high',
                'critical': 'status-critical'
            };
            
            const content = `
                <div class="ticket-details">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="heading-font text-2xl gradient-text">Ticket Details</h2>
                        <span class="status-badge status-open">Open</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white/5 rounded-lg p-4">
                            <label class="text-white/60 text-sm">Ticket ID</label>
                            <p class="text-white font-medium">${ticketId}</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <label class="text-white/60 text-sm">Priority</label>
                            <p><span class="priority-badge ${priorityClass[priority]}">${priority.charAt(0).toUpperCase() + priority.slice(1)}</span></p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <label class="text-white/60 text-sm">Category</label>
                            <p class="text-white">${categoryDisplay[category]}</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <label class="text-white/60 text-sm">Created</label>
                            <p class="text-white">${created}</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="text-white/60 text-sm">Subject</label>
                        <h3 class="text-white text-lg font-medium">${title}</h3>
                    </div>
                    
                    <div class="mb-6">
                        <label class="text-white/60 text-sm">Description</label>
                        <div class="bg-white/5 rounded-lg p-4 mt-2">
                            <p class="text-white whitespace-pre-wrap">${description}</p>
                        </div>
                    </div>
                    
                    ${fileCount > 0 ? `
                    <div class="mb-6">
                        <label class="text-white/60 text-sm">Attachments</label>
                        <div class="bg-white/5 rounded-lg p-4 mt-2">
                            <p class="text-white"><i class="fas fa-paperclip mr-2"></i>${fileCount} file(s) attached</p>
                        </div>
                    </div>
                    ` : ''}
                    
                    <div class="flex gap-3">
                        <button class="btn-primary" onclick="replyToTicket('${ticketId}')">
                            <i class="fas fa-reply mr-2"></i>
                            Reply to Ticket
                        </button>
                        <button class="btn-secondary" onclick="closeTicketDetailsModal()">
                            <i class="fas fa-times mr-2"></i>
                            Close
                        </button>
                    </div>
                </div>
            `;
            
            document.getElementById('ticket-details-content').innerHTML = content;
            document.getElementById('ticket-details-modal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function replyToTicket(ticketId) {
            closeTicketDetailsModal();
            alert(`Reply functionality for ticket ${ticketId} would open here. This would allow you to add updates, upload additional files, and communicate with support staff.`);
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg z-50 transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('new-ticket-modal');
            if (event.target === modal) {
                closeNewTicketModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeNewTicketModal();
            }
        });
    </script>
</body>
</html>

