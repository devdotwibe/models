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

    .heading-font {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        letter-spacing: -0.02em;
    }

    /* Ultra Premium Glass Morphism */
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

    /* Enhanced Header */
    .header {
        background: rgba(10, 10, 26, 0.95);
        backdrop-filter: blur(30px);
        border-bottom: 1px solid rgba(139, 92, 246, 0.3);
        position: sticky;
        top: 0;
        z-index: 50;
        padding: 18px 24px;
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1400px;
        margin: 0 auto;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: white;
        transition: all 0.4s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .logo img {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        border: 2px solid rgba(139, 92, 246, 0.3);
        transition: all 0.4s ease;
    }

    .logo:hover img {
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.6);
        border-color: rgba(139, 92, 246, 0.5);
    }

    .logo-text {
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

    .header-icon {
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

    .header-icon:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.25), rgba(236, 72, 153, 0.25));
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.5);
    }

    .notification-badge {
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

    .user-avatar {
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

    .user-avatar:hover {
        border-color: #8b5cf6;
        transform: scale(1.08);
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.6);
    }

    .online-indicator {
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
    .premium-badge {
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
    .page-title {
        text-align: center;
        padding: 40px 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), rgba(236, 72, 153, 0.08));
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        position: relative;
        overflow: hidden;
    }

    .page-title::before {
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

    .page-title h1 {
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
    .dropdown {
        position: relative;
        padding: 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
    }

    .dropdown-button {
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

    .dropdown-button:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.25), rgba(236, 72, 153, 0.25));
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(139, 92, 246, 0.4);
        border-color: rgba(139, 92, 246, 0.6);
    }

    .dropdown-content {
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

    .dropdown-content.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
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

    .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
        transform: translateX(6px);
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-item .premium-lock {
        color: #ffd700;
        font-size: 14px;
        opacity: 0.8;
    }

    /* Enhanced Upgrade Banner */
    .upgrade-banner {
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

    .upgrade-banner::before {
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

    .upgrade-banner:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 107, 53, 0.7);
    }

    /* Enhanced Search */
    .search-container {
        padding: 24px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
    }

    .search-bar {
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

    .search-bar:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-1px);
    }

    .search-bar::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Enhanced Filters */
    .secondary-filters-row {
        padding: 24px;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(236, 72, 153, 0.05));
        justify-content: center;
    }

    .secondary-filter-btn {
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

    .secondary-filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .secondary-filter-btn:hover::before {
        left: 100%;
    }

    .secondary-filter-btn.active {
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        color: white;
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.5);
        transform: translateY(-3px);
    }

    .secondary-filter-btn:hover {
        background: rgba(139, 92, 246, 0.15);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }

    /* REMOVED Status Filters Row - No longer needed */

    .sort-dropdown {
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

    .sort-select {
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

    .sort-select:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: #8b5cf6;
    }

    /* Enhanced Model Cards */
    .models-grid {
        padding: 24px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 80px;
    }

    @media (min-width: 768px) {
        .models-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .models-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 1280px) {
        .models-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .model-card {
        background: rgba(10, 10, 26, 0.9);
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid rgba(139, 92, 246, 0.2);
        cursor: pointer;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }

    .model-card::before {
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

    .model-card::after {
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

    .model-card:hover::before {
        left: 100%;
    }

    .model-card:hover::after {
        opacity: 1;
    }

    .model-card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 
            0 35px 70px rgba(139, 92, 246, 0.5),
            0 0 0 2px rgba(139, 92, 246, 0.4);
        border-color: rgba(139, 92, 246, 0.6);
    }

    .model-image {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .model-card:hover .model-image {
        transform: scale(1.1);
        filter: brightness(1.15) contrast(1.15) saturate(1.3);
    }

    .status-indicator {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .status-online {
        background: #10b981;
        animation: pulse-status 2s infinite;
        box-shadow: 0 0 25px rgba(16, 185, 129, 0.9);
    }

    @keyframes pulse-status {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.15); }
    }

    .verified-badge {
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

    .model-info {
        padding: 20px;
    }

    .model-name {
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* FIXED UNIFORM UPGRADE BUTTON - ALL YELLOW AND ONE LINE */
    .upgrade-btn {
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

    .upgrade-btn:hover {
        background: linear-gradient(135deg, #ffed4e, #ffd700) !important;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }

    .action-btn {
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

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }

    .action-btn.heart {
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.3);
    }

    .action-btn.heart:hover {
        background: rgba(239, 68, 68, 0.1);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }

    /* Premium Overlay for Interaction Blocking */
    .premium-overlay {
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

    .model-card.show-overlay .premium-overlay {
        opacity: 1;
    }

    .premium-text {
        color: #ffd700;
        font-size: 16px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 16px;
        text-shadow: 0 2px 15px rgba(255, 215, 0, 0.6);
    }

    .premium-btn {
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

    .premium-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
    }

    /* SMALLER Bottom Navigation */
    .bottom-nav {
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

    .nav-item {
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

    .nav-item.active {
        color: #8b5cf6;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
    }

    .nav-item:hover {
        color: #8b5cf6;
        transform: translateY(-3px);
    }

    .nav-icon {
        font-size: 20px;
        margin-bottom: 4px;
    }

    /* NEW ENHANCED Premium Modal with PSYCHOLOGICAL PRESSURE */
    .popup-overlay {
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

    .popup-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .popup-container {
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

    .close-btn {
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

    .close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    .top-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .top-icon {
        font-size: 24px;
        animation: float 3s ease-in-out infinite;
    }

    .top-icon:nth-child(1) { animation-delay: 0s; }
    .top-icon:nth-child(2) { animation-delay: 0.5s; }
    .top-icon:nth-child(3) { animation-delay: 1s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .tlm-logo {
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

    .title {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .subtitle {
        color: #b8c5d6;
        font-size: 15px;
        line-height: 1.4;
    }

    .promo-banner {
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

    .promo-banner::before {
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
    .first-time-alert {
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

    .countdown-timer {
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

    .fire-emoji {
        animation: bounce 1s infinite;
        display: inline-block;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .billing-toggle {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .toggle-container {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 30px;
        padding: 3px;
        display: flex;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .toggle-option {
        padding: 8px 16px;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #b8c5d6;
        font-weight: 600;
        font-size: 13px;
        position: relative;
    }

    .toggle-option.active {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }

    .savings-badge {
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

    .pricing-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .pricing-card {
        background: rgba(255, 255, 255, 0.06);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 20px 15px;
        text-align: center;
        position: relative;
        transition: all 0.4s ease;
        backdrop-filter: blur(5px);
    }

    .pricing-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255, 215, 0, 0.6);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .pricing-card.elite {
        border-color: #9b59b6;
        background: rgba(155, 89, 182, 0.12);
    }

    .pricing-card.elite:hover {
        border-color: #9b59b6;
    }

    .hot-deal {
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

    .member-badge {
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

    .premium-member-badge {
        background: linear-gradient(45deg, #00d2ff, #3a7bd5);
        box-shadow: 0 4px 15px rgba(0, 210, 255, 0.4);
    }

    .elite-member-badge {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        box-shadow: 0 4px 15px rgba(155, 89, 182, 0.4);
    }

    .badge {
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

    .premium-badge {
        background: linear-gradient(45deg, #00d2ff, #3a7bd5);
        color: white;
        box-shadow: 0 2px 10px rgba(0, 210, 255, 0.3);
    }

    .elite-badge {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        color: white;
        box-shadow: 0 2px 10px rgba(155, 89, 182, 0.3);
    }

    .plan-name {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .price-container {
        margin-bottom: 15px;
    }

    .original-price {
        color: #888;
        font-size: 14px;
        text-decoration: line-through;
        margin-bottom: 2px;
    }

    .price {
        color: #ffd700;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 3px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .elite .price {
        color: #9b59b6;
        text-shadow: 0 0 20px rgba(155, 89, 182, 0.3);
    }

    .price-period {
        color: #b8c5d6;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .savings-text {
        color: #00ff88;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 8px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .savings-text.show {
        opacity: 1;
    }

    .bonus-tokens {
        color: #00d2ff;
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .token-icon {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }

    .cta-button {
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

    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .cta-button:hover::before {
        left: 100%;
    }

    .cta-primary {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        box-shadow: 0 4px 20px rgba(255, 215, 0, 0.3);
    }

    .cta-elite {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        color: white;
        box-shadow: 0 4px 20px rgba(155, 89, 182, 0.3);
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }

    .features-section {
        margin-bottom: 20px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .feature-column h4 {
        color: #fff;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: center;
        font-weight: 700;
    }

    .elite-title {
        background: linear-gradient(45deg, #9b59b6, #e74c3c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .feature-list {
        list-style: none;
    }

    .feature-list li {
        color: #b8c5d6;
        margin-bottom: 6px;
        font-size: 12px;
        line-height: 1.3;
        display: flex;
        align-items: flex-start;
    }

    .feature-list li::before {
        content: "✓";
        color: #ffd700;
        font-weight: bold;
        margin-right: 6px;
        margin-top: 1px;
        font-size: 11px;
    }

    .elite-features li::before {
        content: "💎";
        margin-right: 5px;
        font-size: 10px;
    }

    /* ENHANCED TOKEN PACKAGES SECTION */
    .token-packages-section {
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

    .token-packages-section::before {
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

    .token-packages-title {
        color: #ffd700;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .token-packages-subtitle {
        color: #b8c5d6;
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .token-packages-btn {
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

    .token-packages-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 215, 0, 0.7);
    }

    .token-expires {
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
        .header {
            padding: 16px 20px;
        }
        
        .logo-text {
            font-size: 20px;
        }
        
        .header-icon, .user-avatar {
            width: 48px;
            height: 48px;
        }
        
        .models-grid {
            padding: 20px;
            gap: 20px;
            margin-bottom: 70px;
        }
        
        .model-image {
            height: 220px;
        }

        .popup-container {
            padding: 20px 15px;
            margin: 5px;
            max-width: 95vw;
        }

        .pricing-grid,
        .features-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .title {
            font-size: 22px;
        }

        .price {
            font-size: 24px;
        }

        .promo-banner {
            font-size: 12px;
            padding: 12px;
        }

        .countdown-timer {
            font-size: 14px;
            padding: 10px;
        }

        .toggle-option {
            padding: 6px 12px;
            font-size: 12px;
        }

        .pricing-card {
            padding: 15px 12px;
        }

        .feature-list li {
            font-size: 11px;
        }

        .top-icons {
            gap: 10px;
        }

        .top-icon {
            font-size: 20px;
        }

        .upgrade-banner {
            font-size: 16px;
            padding: 20px;
        }

        .page-title h1 {
            font-size: 20px;
        }

        .secondary-filters-row {
            padding: 20px;
            gap: 10px;
        }

        .secondary-filter-btn {
            padding: 12px 20px;
            font-size: 12px;
        }

        .nav-item {
            font-size: 10px;
            padding: 6px 10px;
        }

        .nav-icon {
            font-size: 18px;
            margin-bottom: 3px;
        }

        .bottom-nav {
            padding: 10px 0;
            height: 60px;
        }

        .token-packages-section {
            padding: 15px;
            margin: 15px 0;
        }

        .token-packages-title {
            font-size: 16px;
        }

        .token-packages-btn {
            padding: 12px 20px;
            font-size: 13px;
        }

        .sort-dropdown {
            padding: 20px;
        }
    }

    @media (max-width: 640px) {
        .models-grid {
            grid-template-columns: 1fr;
            padding: 16px;
            gap: 16px;
            margin-bottom: 65px;
        }

        .model-card:hover {
            transform: translateY(-10px) scale(1.02);
        }

        .header-content {
            gap: 12px;
        }

        .logo img {
            width: 40px;
            height: 40px;
        }

        .logo-text {
            font-size: 18px;
        }

        .header-icon, .user-avatar {
            width: 44px;
            height: 44px;
        }

        .popup-container {
            padding: 15px 10px;
        }

        .tlm-logo {
            width: 40px;
            height: 40px;
        }

        .title {
            font-size: 20px;
        }

        .subtitle {
            font-size: 14px;
        }

        .price {
            font-size: 22px;
        }

        .upgrade-btn {
            font-size: 12px;
            padding: 10px 14px;
        }

        .bottom-nav {
            height: 55px;
            padding: 8px 0;
        }

        .nav-item {
            font-size: 9px;
            padding: 4px 8px;
        }

        .nav-icon {
            font-size: 16px;
            margin-bottom: 2px;
        }

        .sort-dropdown {
            padding: 16px;
            flex-direction: column;
            gap: 10px;
        }

        .sort-select {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .popup-container {
            padding: 15px 10px;
        }

        .tlm-logo {
            width: 40px;
            height: 40px;
        }

        .title {
            font-size: 20px;
        }

        .subtitle {
            font-size: 14px;
        }

        .price {
            font-size: 22px;
        }

        .models-grid {
            margin-bottom: 60px;
        }

        .bottom-nav {
            height: 50px;
            padding: 6px 0;
        }

        .secondary-filters-row {
            padding: 16px;
            gap: 8px;
        }

        .secondary-filter-btn {
            padding: 10px 16px;
            font-size: 11px;
        }

        .sort-dropdown {
            padding: 16px;
        }
    }

    /* Loading Animation */
    .loading {
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
<body class="advt-page min-h-screen bg-animated text-white socialwall-page">
<!-- Premium Particle System -->
<div class="particles" id="particles"></div>

<!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>

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

        <div class="countdown-timer">
            ⏰ LIMITED TIME: <span id="countdown">23:59:45</span> REMAINING!
        </div>

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
                    <div class="original-price" data-monthly-orig="49" data-annual-orig="588">$49</div>
                    <div class="price" data-monthly="39" data-annual="449">$39</div>
                    <div class="price-period" data-monthly-period="per month" data-annual-period="per year">per month</div>
                    <div class="savings-text" data-monthly-save="" data-annual-save="Save $139/year!">Save $10/month!</div>
                    <div class="bonus-tokens">
                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/TLM-Tokens-KRvoJD0tEUEu7oeJkcKoGXiUSdzQUo.png" alt="TLM Token" class="token-icon">
                        <span data-monthly-tokens="500" data-annual-tokens="1,000">+ 500 TLM tokens</span>
                    </div>
                </div>
                <button class="cta-button cta-primary" onclick="upgradeAccount('monthly')">Grab This Deal!</button>
            </div>

            <div class="pricing-card elite">
                <div class="hot-deal">💎 ELITE!</div>
                <div class="member-badge elite-member-badge">VIP</div>
                <div class="badge elite-badge">DIAMOND ELITE</div>
                <div class="plan-name">Diamond Elite</div>
                <div class="price-container">
                    <div class="original-price" data-monthly-orig="199" data-annual-orig="2388">$199</div>
                    <div class="price" data-monthly="149" data-annual="1999">$149</div>
                    <div class="price-period" data-monthly-period="per month" data-annual-period="per year">per month</div>
                    <div class="savings-text" data-monthly-save="" data-annual-save="Save $389/year!">Save $50/month!</div>
                    <div class="bonus-tokens">
                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/TLM-Tokens-KRvoJD0tEUEu7oeJkcKoGXiUSdzQUo.png" alt="TLM Token" class="token-icon">
                        <span data-monthly-tokens="2,000" data-annual-tokens="5,000">+ 2,000 TLM tokens</span>
                    </div>
                </div>
                <button class="cta-button cta-elite" onclick="upgradeAccount('annual')">Claim Diamond Status!</button>
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
        <span id="current-section">❤️ Liked You (12)</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="6,9 12,15 18,9"></polyline>
        </svg>
    </button>
    <div class="dropdown-content" id="dropdown-menu">
        <div class="dropdown-item" onclick="selectSection('❤️ Liked You (12)')">
            <span>❤️ Liked You (12)</span>
            <span class="premium-lock">🔒 Premium</span>
        </div>
        <div class="dropdown-item" onclick="selectSection('👀 Viewed Your Profile (8)')">
            <span>👀 Viewed Your Profile (8)</span>
            <span class="premium-lock">🔒 Premium</span>
        </div>
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
        </div>
        <div class="dropdown-item" onclick="selectSection('🎯 My Matches (15)')">
            <span>🎯 My Matches (15)</span>
            <span class="premium-lock">🔒 Premium</span>
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
    <!-- Model Card 1 -->
    <div class="model-card" data-premium="false" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Aria M.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">24</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">32 • F • Chiang Rai • 1141km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">Just Now • 👑 Premium</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 2 -->
    <div class="model-card" data-premium="true" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Phoenix R.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">26</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">28 • F • Pattaya • 102km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">16 Seconds Ago</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 3 -->
    <div class="model-card" data-premium="false" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Nova S.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">23</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">22 • F • Pattaya • 102km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">1 Minute Ago</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 4 -->
    <div class="model-card" data-premium="true" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1488161628813-04466f872be2?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Zara C.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">25</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">22 • F • Myanaung • 748km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">1 Minute Ago</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 5 -->
    <div class="model-card" data-premium="false" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Luna K.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">22</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">22 • F • Rawai • 704km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">1 Minute Ago</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 6 -->
    <div class="model-card" data-premium="false" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Maya T.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">24</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">24 • F • 19km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">1 Minute Ago • 👑 Premium</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 7 -->
    <div class="model-card" data-premium="true" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Bella R.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">27</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">27 • F • Patong • 696km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">2 Minutes Ago</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>

    <!-- Model Card 8 -->
    <div class="model-card" data-premium="false" onclick="showPremiumModal()">
        <div style="position: relative;">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=500&fit=crop&crop=faces" alt="Model" class="model-image">
            <div class="status-indicator status-online"></div>
            <div class="verified-badge">✓ Verified</div>
        </div>
        <div class="model-info">
            <div class="model-name">
                <span>Sophia L.</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">23</span>
            </div>
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">23 • F • Patong • 696km</div>
            <div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">3 Minutes Ago</div>
            <button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>
            <div class="action-buttons">
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">✕</button>
                <button class="action-btn heart" onclick="event.stopPropagation(); showPremiumModal();">♡</button>
                <button class="action-btn" onclick="event.stopPropagation(); showPremiumModal();">👤</button>
            </div>
        </div>
    </div>
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