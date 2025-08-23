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

    .activity-page .heading-font {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        letter-spacing: -0.02em;
    }

    /* Ultra Premium Glass Morphism */
    .activity-page .ultra-glass {
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

   .activity-page .ultra-glass::before {
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
    .activity-page .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }

    .activity-page .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.8) 0%, transparent 70%);
        border-radius: 50%;
        animation: float-premium 12s infinite linear;
        filter: blur(0.5px);
    }

    .activity-page .particle:nth-child(2n) {
        background: radial-gradient(circle, rgba(236, 72, 153, 0.6) 0%, transparent 70%);
        animation-duration: 15s;
    }

    .activity-page .particle:nth-child(3n) {
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

    /* Enhanced Header */
    .activity-page .header {
        background: rgba(10, 10, 26, 0.95);
        backdrop-filter: blur(30px);
        border-bottom: 1px solid rgba(139, 92, 246, 0.3);
        position: sticky;
        top: 0;
        z-index: 50;
        padding: 18px 24px;
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
    }

    .activity-page .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1400px;
        margin: 0 auto;
    }

    .activity-page .logo {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: white;
        transition: all 0.4s ease;
    }

    .activity-page .logo:hover {
        transform: scale(1.05);
    }

    .activity-page .logo img {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        border: 2px solid rgba(139, 92, 246, 0.3);
        transition: all 0.4s ease;
    }

    .activity-page .logo:hover img {
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.6);
        border-color: rgba(139, 92, 246, 0.5);
    }

    .activity-page .logo-text {
        font-size: 24px;
        font-weight: 900;
        background: linear-gradient(135deg, #ec4899, #8b5cf6, #06b6d4, #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 0 30px rgba(139, 92, 246, 0.5);
        animation: gradient-shift 3s ease-in-out infinite;
    }

    @keyframes gradient-shift {
        0%, 100% { filter: hue-rotate(0deg); }
        50% { filter: hue-rotate(30deg); }
    }

    .activity-page .header-icon {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .activity-page .header-icon:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.25), rgba(236, 72, 153, 0.25));
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.5);
    }

    .activity-page .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse-notification 2s infinite;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.6);
    }

    @keyframes pulse-notification {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }

    .activity-page .user-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: 3px solid rgba(139, 92, 246, 0.5);
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.3);
    }

    .activity-page .user-avatar:hover {
        border-color: #8b5cf6;
        transform: scale(1.08);
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.6);
    }

    .activity-page .online-indicator {
        position: absolute;
        bottom: 3px;
        right: 3px;
        width: 16px;
        height: 16px;
        background: #10b981;
        border: 3px solid rgba(10, 10, 26, 0.95);
        border-radius: 50%;
        animation: pulse-online 2s infinite;
    }

    @keyframes pulse-online {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8); }
        50% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
    }

    /* Premium Badge */
    .activity-page .premium-badge {
        position: absolute;
        top: -4px;
        left: -4px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #1a1a1a;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 10px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: premium-glow 3s infinite;
    }

    @keyframes premium-glow {
        0%, 100% { box-shadow: 0 0 15px rgba(255, 215, 0, 0.6); }
        50% { box-shadow: 0 0 25px rgba(255, 215, 0, 0.9); }
    }

    /* Enhanced Page Title */
    .activity-page .page-title {
        text-align: center;
        padding: 40px 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), rgba(236, 72, 153, 0.08));
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        position: relative;
        overflow: hidden;
    }

    .activity-page .page-title::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .activity-page .page-title h1 {
        font-size: 22px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.95);
        margin: 0;
        line-height: 1.4;
        max-width: 700px;
        margin: 0 auto;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    /* Enhanced Dropdown */
    .activity-page .dropdown {
        position: relative;
        padding: 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
    }

    .activity-page .dropdown-button {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
        border: 2px solid rgba(139, 92, 246, 0.4);
        border-radius: 35px;
        color: white;
        padding: 18px 28px;
        font-size: 17px;
        font-weight: 700;
        width: 100%;
        text-align: left;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        outline: none;
        transition: all 0.4s ease;
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.2);
    }

    .activity-page .dropdown-button:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.25), rgba(236, 72, 153, 0.25));
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(139, 92, 246, 0.4);
        border-color: rgba(139, 92, 246, 0.6);
    }

     .activity-page .dropdown-content {
        position: absolute;
        top: calc(100% + 16px);
        left: 24px;
        right: 24px;
        background: rgba(10, 10, 26, 0.98);
        backdrop-filter: blur(30px);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-20px);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

     .activity-page .dropdown-content.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

     .activity-page .dropdown-item {
        color: white;
        padding: 20px 28px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        font-size: 16px;
        font-weight: 600;
        position: relative;
    }

     .activity-page .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
        transform: translateX(6px);
    }

     .activity-page .dropdown-item:last-child {
        border-bottom: none;
    }

     .activity-page .dropdown-item .premium-lock {
        color: #ffd700;
        font-size: 14px;
        opacity: 0.8;
    }

    /* Enhanced Upgrade Banner */
     .activity-page .upgrade-banner {
        background: linear-gradient(135deg, #ff6b35, #f7931e, #ff6b35);
        color: white;
        padding: 24px;
        text-align: center;
        font-weight: 800;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 25px rgba(255, 107, 53, 0.5);
        animation: upgrade-pulse 4s infinite;
        position: relative;
        overflow: hidden;
    }

     .activity-page .upgrade-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: banner-shimmer 3s infinite;
    }

    @keyframes banner-shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    @keyframes upgrade-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.01); }
    }

     .activity-page .upgrade-banner:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 107, 53, 0.7);
    }

    /* Enhanced Search */
     .activity-page .search-container {
        padding: 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
    }

     .activity-page .search-bar {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 35px;
        padding: 18px 28px;
        color: white;
        font-size: 16px;
        width: 100%;
        outline: none;
        transition: all 0.4s ease;
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.1);
    }

     .activity-page .search-bar:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-1px);
    }

     .activity-page .search-bar::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Enhanced Filters */
     .activity-page .secondary-filters-row {
        padding: 24px;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
        justify-content: center;
    }

     .activity-page .secondary-filter-btn {
        background: transparent;
        border: 2px solid #8b5cf6;
        color: #8b5cf6;
        padding: 14px 28px;
        border-radius: 35px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-transform: uppercase;
        letter-spacing: 1.2px;
        outline: none;
        position: relative;
        overflow: hidden;
    }

     .activity-page .secondary-filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

     .activity-page .secondary-filter-btn:hover::before {
        left: 100%;
    }

     .activity-page .secondary-filter-btn.active {
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        color: white;
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.5);
        transform: translateY(-3px);
    }

     .activity-page .secondary-filter-btn:hover {
        background: rgba(139, 92, 246, 0.15);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }

    /* REMOVED Status Filters Row - No longer needed */

     .activity-page .sort-dropdown {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        font-weight: 600;
        position: relative;
        padding: 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
    }

     .activity-page .sort-select {
        background: rgba(20, 20, 40, 0.9);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 14px 24px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        outline: none;
        appearance: none;
        padding-right: 45px;
        transition: all 0.3s ease;
    }

     .activity-page .sort-select:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: #8b5cf6;
    }

    /* Enhanced Model Cards */
     .activity-page .models-grid {
        padding: 24px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 80px;
    }

    @media (min-width: 768px) {
        .activity-page .models-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
         .activity-page .models-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 1280px) {
         .activity-page .models-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

     .activity-page .model-card {
        background: rgba(10, 10, 26, 0.9);
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid rgba(139, 92, 246, 0.2);
        cursor: pointer;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }

     .activity-page .model-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.15), transparent);
        transition: left 1s ease;
        z-index: 2;
    }

     .activity-page .model-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.8s ease;
        z-index: 1;
    }

     .activity-page .model-card:hover::before {
        left: 100%;
    }

     .activity-page .model-card:hover::after {
        opacity: 1;
    }

     .activity-page .model-card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 
            0 35px 70px rgba(139, 92, 246, 0.5),
            0 0 0 2px rgba(139, 92, 246, 0.4);
        border-color: rgba(139, 92, 246, 0.6);
    }

     .activity-page .model-image {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

     .activity-page .model-card:hover .model-image {
        transform: scale(1.1);
        filter: brightness(1.15) contrast(1.15) saturate(1.3);
    }

     .activity-page .status-indicator {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

     .activity-page .status-online {
        background: #10b981;
        animation: pulse-status 2s infinite;
        box-shadow: 0 0 25px rgba(16, 185, 129, 0.9);
    }

    @keyframes pulse-status {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.15); }
    }

     .activity-page .verified-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        color: white;
        padding: 8px 14px;
        border-radius: 18px;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 5px;
        animation: verified-glow 3s infinite;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }

    @keyframes verified-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.7); }
        50% { box-shadow: 0 0 30px rgba(139, 92, 246, 0.9); }
    }

     .activity-page .model-info {
        padding: 20px;
    }

     .activity-page .model-name {
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* FIXED UNIFORM UPGRADE BUTTON - ALL YELLOW AND ONE LINE */
     .activity-page .upgrade-btn {
        background: linear-gradient(135deg, #ffd700, #ffed4e) !important;
        color: #1a1a1a !important;
        border: none;
        padding: 12px 16px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
        width: 100%;
        margin-bottom: 14px;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 20px rgba(255, 215, 0, 0.4);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        opacity: 1 !important;
    }

     .activity-page .upgrade-btn:hover {
        background: linear-gradient(135deg, #ffed4e, #ffd700) !important;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
    }

    /* Action Buttons */
    .activity-page .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }

     .activity-page .action-btn {
        background: rgba(30, 30, 50, 0.8);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
        font-size: 20px;
        cursor: pointer;
        padding: 12px;
        border-radius: 50%;
        transition: all 0.3s ease;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

     .activity-page .action-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }

     .activity-page .action-btn.heart {
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.3);
    }

     .activity-page .action-btn.heart:hover {
        background: rgba(239, 68, 68, 0.1);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }

    /* Premium Overlay for Interaction Blocking */
     .activity-page .premium-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.85);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.5s ease;
        backdrop-filter: blur(8px);
        z-index: 10;
    }

     .activity-page .model-card.show-overlay .premium-overlay {
        opacity: 1;
    }

    .activity-page .premium-text {
        color: #ffd700;
        font-size: 16px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 16px;
        text-shadow: 0 2px 15px rgba(255, 215, 0, 0.6);
    }

     .activity-page .premium-btn {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #1a1a1a;
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 20px rgba(255, 215, 0, 0.4);
    }

     .activity-page .premium-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
    }

    /* SMALLER Bottom Navigation */
     .activity-page .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(10, 10, 26, 0.95);
        backdrop-filter: blur(30px);
        border-top: 2px solid rgba(139, 92, 246, 0.3);
        padding: 12px 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
        box-shadow: 0 -12px 40px rgba(0, 0, 0, 0.4);
        height: 70px;
    }

     .activity-page .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        position: relative;
        transition: all 0.4s ease;
        padding: 8px 12px;
        border-radius: 16px;
    }

     .activity-page .nav-item.active {
        color: #8b5cf6;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
    }

     .activity-page .nav-item:hover {
        color: #8b5cf6;
        transform: translateY(-3px);
    }

    .activity-page .nav-icon {
        font-size: 20px;
        margin-bottom: 4px;
    }

    /* NEW ENHANCED Premium Modal with PSYCHOLOGICAL PRESSURE */
     .activity-page .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        padding: 10px;
        overflow-y: auto;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
    }

     .activity-page .popup-overlay.show {
        opacity: 1;
        visibility: visible;
    }

     .activity-page .popup-container {
        background: linear-gradient(135deg, #0a0a1f 0%, #1a1a3a 50%, #2d1b69 100%);
        border-radius: 24px;
        padding: 30px;
        max-width: 600px;
        width: 100%;
        position: relative;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        margin: auto;
        max-height: 95vh;
        overflow-y: auto;
    }

     .activity-page .close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        z-index: 10;
    }

     .activity-page .close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

     .activity-page .top-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 15px;
    }

     .activity-page .top-icon {
        font-size: 24px;
        animation: float 3s ease-in-out infinite;
    }

     .activity-page .top-icon:nth-child(1) { animation-delay: 0s; }
     .activity-page .top-icon:nth-child(2) { animation-delay: 0.5s; }
     .activity-page .top-icon:nth-child(3) { animation-delay: 1s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

     .activity-page .header {
        text-align: center;
        margin-bottom: 20px;
    }

     .activity-page .tlm-logo {
        width: 50px;
        height: 50px;
        margin: 0 auto 15px;
        display: block;
        filter: drop-shadow(0 0 15px rgba(255, 215, 0, 0.6));
        animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from { filter: drop-shadow(0 0 15px rgba(255, 215, 0, 0.6)); }
        to { filter: drop-shadow(0 0 25px rgba(255, 215, 0, 0.8)); }
    }

     .activity-page .title {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

     .activity-page .subtitle {
        color: #b8c5d6;
        font-size: 15px;
        line-height: 1.4;
    }

     .activity-page .promo-banner {
        background: linear-gradient(135deg, #ff4757, #ff3742);
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 14px;
        position: relative;
        overflow: hidden;
        border: 2px solid #ff6b7a;
    }

     .activity-page .promo-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shine 2s infinite;
    }

    @keyframes shine {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    /* ENHANCED FIRST TIME USER ALERT */
     .activity-page .first-time-alert {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        text-align: center;
        padding: 18px;
        border-radius: 15px;
        margin-bottom: 20px;
        font-weight: 800;
        font-size: 15px;
        position: relative;
        overflow: hidden;
        border: 2px solid #fbbf24;
        animation: first-time-glow 2s infinite;
    }

    @keyframes first-time-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.6); }
        50% { box-shadow: 0 0 30px rgba(245, 158, 11, 0.9); }
    }

     .activity-page .countdown-timer {
        background: rgba(255, 71, 87, 0.2);
        border: 2px solid #ff4757;
        color: #ff4757;
        text-align: center;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 16px;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.7); }
        50% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(255, 71, 87, 0); }
    }

     .activity-page .fire-emoji {
        animation: bounce 1s infinite;
        display: inline-block;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

     .activity-page .billing-toggle {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

     .activity-page .toggle-container {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 30px;
        padding: 3px;
        display: flex;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

     .activity-page .toggle-option {
        padding: 8px 16px;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #b8c5d6;
        font-weight: 600;
        font-size: 13px;
        position: relative;
    }

     .activity-page .toggle-option.active {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }

     .activity-page .savings-badge {
        background: #00ff88;
        color: #000;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 8px;
        margin-left: 5px;
        font-weight: 700;
        animation: glow-green 2s ease-in-out infinite alternate;
    }

    @keyframes glow-green {
        from { box-shadow: 0 0 5px rgba(0, 255, 136, 0.5); }
        to { box-shadow: 0 0 15px rgba(0, 255, 136, 0.8); }
    }

     .activity-page .pricing-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

     .activity-page .pricing-card {
        background: rgba(255, 255, 255, 0.06);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 20px 15px;
        text-align: center;
        position: relative;
        transition: all 0.4s ease;
        backdrop-filter: blur(5px);
    }

     .activity-page .pricing-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255, 215, 0, 0.6);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

     .activity-page .pricing-card.elite {
        border-color: #9b59b6;
        background: rgba(155, 89, 182, 0.12);
    }

     .activity-page .pricing-card.elite:hover {
        border-color: #9b59b6;
    }

     .activity-page .hot-deal {
        position: absolute;
        top: -8px;
        left: -8px;
        background: linear-gradient(45deg, #ff4757, #ff3742);
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 10px;
        font-weight: 700;
        transform: rotate(-15deg);
        box-shadow: 0 4px 15px rgba(255, 71, 87, 0.4);
        animation: wiggle 2s ease-in-out infinite;
    }

    @keyframes wiggle {
        0%, 100% { transform: rotate(-15deg); }
        25% { transform: rotate(-12deg); }
        75% { transform: rotate(-18deg); }
    }

     .activity-page .member-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: white;
        animation: float 3s ease-in-out infinite;
    }

     .activity-page .premium-member-badge {
        background: linear-gradient(45deg, #00d2ff, #3a7bd5);
        box-shadow: 0 4px 15px rgba(0, 210, 255, 0.4);
    }

     .activity-page .elite-member-badge {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        box-shadow: 0 4px 15px rgba(155, 89, 182, 0.4);
    }

     .activity-page .badge {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 10px;
        display: inline-block;
        box-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
    }

     .activity-page .premium-badge {
        background: linear-gradient(45deg, #00d2ff, #3a7bd5);
        color: white;
        box-shadow: 0 2px 10px rgba(0, 210, 255, 0.3);
    }

     .activity-page .elite-badge {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        color: white;
        box-shadow: 0 2px 10px rgba(155, 89, 182, 0.3);
    }

     .activity-page .plan-name {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 10px;
    }

     .activity-page .price-container {
        margin-bottom: 15px;
    }

     .activity-page .original-price {
        color: #888;
        font-size: 14px;
        text-decoration: line-through;
        margin-bottom: 2px;
    }

     .activity-page .price {
        color: #ffd700;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 3px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

     .activity-page .elite .price {
        color: #9b59b6;
        text-shadow: 0 0 20px rgba(155, 89, 182, 0.3);
    }

     .activity-page .price-period {
        color: #b8c5d6;
        font-size: 12px;
        margin-bottom: 6px;
    }

     .activity-page .savings-text {
        color: #00ff88;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 8px;
        opacity: 0;
        transition: opacity 0.3s;
    }

     .activity-page .savings-text.show {
        opacity: 1;
    }

     .activity-page .bonus-tokens {
        color: #00d2ff;
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

     .activity-page .token-icon {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }

     .activity-page .cta-button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

     .activity-page .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

     .activity-page .cta-button:hover::before {
        left: 100%;
    }

     .activity-page .cta-primary {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        box-shadow: 0 4px 20px rgba(255, 215, 0, 0.3);
    }

     .activity-page .cta-elite {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        color: white;
        box-shadow: 0 4px 20px rgba(155, 89, 182, 0.3);
    }

     .activity-page .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }

     .activity-page .features-section {
        margin-bottom: 20px;
    }

     .activity-page .features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

     .activity-page .feature-column h4 {
        color: #fff;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: center;
        font-weight: 700;
    }

     .activity-page .elite-title {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

     .activity-page .feature-list {
        list-style: none;
    }

     .activity-page .feature-list li {
        color: #b8c5d6;
        margin-bottom: 6px;
        font-size: 12px;
        line-height: 1.3;
        display: flex;
        align-items: flex-start;
    }

     .activity-page .feature-list li::before {
        content: "✓";
        color: #ffd700;
        font-weight: bold;
        margin-right: 6px;
        margin-top: 1px;
        font-size: 11px;
    }

     .activity-page .elite-features li::before {
        content: "💎";
        margin-right: 5px;
        font-size: 10px;
    }

    /* ENHANCED TOKEN PACKAGES SECTION */
     .activity-page .token-packages-section {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
        border: 2px solid rgba(255, 215, 0, 0.3);
        border-radius: 20px;
        padding: 20px;
        margin: 20px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        animation: token-glow 3s infinite;
    }

    @keyframes token-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.4); }
        50% { box-shadow: 0 0 30px rgba(255, 215, 0, 0.7); }
    }

     .activity-page .token-packages-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.2), transparent);
        animation: token-shimmer 3s infinite;
    }

    @keyframes token-shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

     .activity-page .token-packages-title {
        color: #ffd700;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

     .activity-page .token-packages-subtitle {
        color: #b8c5d6;
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.4;
    }

     .activity-page .token-packages-btn {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 900;
        cursor: pointer;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        box-shadow: 0 6px 25px rgba(255, 215, 0, 0.5);
        margin-bottom: 10px;
        width: 100%;
    }

     .activity-page .token-packages-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 215, 0, 0.7);
    }

     .activity-page .token-expires {
        color: #ff6b7a;
        font-size: 12px;
        font-weight: 700;
        animation: token-blink 2s infinite;
    }

    @keyframes token-blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0.6; }
    }

    /* REMOVED bottom-section with error text */

    /* Mobile Responsive */
    @media (max-width: 768px) {
         .activity-page .header {
            padding: 16px 20px;
        }
        
         .activity-page .logo-text {
            font-size: 20px;
        }
        
         .activity-page .header-icon, .user-avatar {
            width: 48px;
            height: 48px;
        }
        
         .activity-page .models-grid {
            padding: 20px;
            gap: 20px;
            margin-bottom: 70px;
        }
        
        .activity-page .model-image {
            height: 220px;
        }

        .activity-page .popup-container {
            padding: 20px 15px;
            margin: 5px;
            max-width: 95vw;
        }

        .activity-page .pricing-grid,
        .activity-page .features-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .activity-page .title {
            font-size: 22px;
        }

        .activity-page .price {
            font-size: 24px;
        }

        .activity-page .promo-banner {
            font-size: 12px;
            padding: 12px;
        }

        .activity-page .countdown-timer {
            font-size: 14px;
            padding: 10px;
        }

        .activity-page .toggle-option {
            padding: 6px 12px;
            font-size: 12px;
        }

        .activity-page .pricing-card {
            padding: 15px 12px;
        }

        .activity-page .feature-list li {
            font-size: 11px;
        }

        .activity-page .top-icons {
            gap: 10px;
        }

        .activity-page .top-icon {
            font-size: 20px;
        }

        .activity-page .upgrade-banner {
            font-size: 16px;
            padding: 20px;
        }

        .activity-page .page-title h1 {
            font-size: 20px;
        }

        .activity-page .secondary-filters-row {
            padding: 20px;
            gap: 10px;
        }

        .activity-page .secondary-filter-btn {
            padding: 12px 20px;
            font-size: 12px;
        }

        .activity-page .nav-item {
            font-size: 10px;
            padding: 6px 10px;
        }

        .activity-page .nav-icon {
            font-size: 18px;
            margin-bottom: 3px;
        }

        .activity-page .bottom-nav {
            padding: 10px 0;
            height: 60px;
        }

        .activity-page .token-packages-section {
            padding: 15px;
            margin: 15px 0;
        }

        .activity-page .token-packages-title {
            font-size: 16px;
        }

        .activity-page .token-packages-btn {
            padding: 12px 20px;
            font-size: 13px;
        }

       .activity-page .sort-dropdown {
            padding: 20px;
        }
    }

    @media (max-width: 640px) {
        .activity-page .models-grid {
            grid-template-columns: 1fr;
            padding: 16px;
            gap: 16px;
            margin-bottom: 65px;
        }

       .activity-page .model-card:hover {
            transform: translateY(-10px) scale(1.02);
        }

        .activity-page .header-content {
            gap: 12px;
        }

        .activity-page .logo img {
            width: 40px;
            height: 40px;
        }

        .activity-page .logo-text {
            font-size: 18px;
        }

       .activity-page .header-icon, .user-avatar {
            width: 44px;
            height: 44px;
        }

        .activity-page .popup-container {
            padding: 15px 10px;
        }

        .activity-page .tlm-logo {
            width: 40px;
            height: 40px;
        }

        .activity-page .title {
            font-size: 20px;
        }

        .activity-page .subtitle {
            font-size: 14px;
        }

        .activity-page .price {
            font-size: 22px;
        }

       .activity-page .upgrade-btn {
            font-size: 12px;
            padding: 10px 14px;
        }

       .activity-page .bottom-nav {
            height: 55px;
            padding: 8px 0;
        }

        .activity-page .nav-item {
            font-size: 9px;
            padding: 4px 8px;
        }

       .activity-page .nav-icon {
            font-size: 16px;
            margin-bottom: 2px;
        }

         .activity-page .sort-dropdown {
            padding: 16px;
            flex-direction: column;
            gap: 10px;
        }

        .activity-page .sort-select {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .activity-page .popup-container {
            padding: 15px 10px;
        }

        .activity-page .tlm-logo {
            width: 40px;
            height: 40px;
        }

        .activity-page .title {
            font-size: 20px;
        }

        .activity-page .subtitle {
            font-size: 14px;
        }

        .activity-page .price {
            font-size: 22px;
        }

       .activity-page .models-grid {
            margin-bottom: 60px;
        }

       .activity-page .bottom-nav {
            height: 50px;
            padding: 6px 0;
        }

       .activity-page .secondary-filters-row {
            padding: 16px;
            gap: 8px;
        }

        .activity-page .secondary-filter-btn {
            padding: 10px 16px;
            font-size: 11px;
        }

        .activity-page .sort-dropdown {
            padding: 16px;
        }
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