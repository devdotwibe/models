<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Elite Streaming Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
            color: #fff;
            height: 100vh;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            position: fixed;
            width: 100%;
        }
        .app-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: relative;
            width: 100%;
        }
        /* Enhanced Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background: rgba(15, 15, 35, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 200;
            height: 50px;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }
        .header.hidden {
            transform: translateY(-100%);
        }
        .logo-section {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .logo-section:active {
            transform: scale(0.95);
        }
        .logo {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
        }
        .brand-name {
            font-size: 14px;
            font-weight: 600;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .tabs {
            display: flex;
            gap: 8px;
            background: rgba(255, 255, 255, 0.05);
            padding: 4px;
            border-radius: 8px;
        }
        .tab {
            display: flex;
            align-items: center;
            gap: 4px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
            min-width: 44px;
            justify-content: center;
        }
        .tab:hover {
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.05);
        }
        .tab:active {
            transform: scale(0.95);
        }
        .tab.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        .tab-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: currentColor;
        }
        .user-section {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .token-balance {
            display: flex;
            align-items: center;
            gap: 4px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #000;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 44px;
            justify-content: center;
        }
        .token-balance:hover {
            transform: scale(1.05);
        }
        .token-balance:active {
            transform: scale(0.95);
        }
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            min-height: 0;
            overflow: hidden;
        }
        /* Clean Streaming Area */
        .streaming-area {
            flex: 1;
            background: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            min-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .streaming-area.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 300;
            background: #000;
        }
        /* Video Element */
        .stream-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: #000;
        }
        /* Loading Animation */
        .loading-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 24px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            max-width: 280px;
            animation: loadingPulse 2s ease-in-out infinite;
            z-index: 5;
        }
        .loading-container.hidden {
            display: none;
        }
        @keyframes loadingPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        .loading-text {
            font-size: 16px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 16px;
        }
        .loading-dots {
            display: flex;
            gap: 6px;
            justify-content: center;
        }
        .dot {
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            animation: loading 1.4s infinite;
        }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes loading {
            0%, 60%, 100% { opacity: 0.3; transform: scale(1); }
            30% { opacity: 1; transform: scale(1.2); }
        }
        /* Minimal Stats - Top left corner only (viewer count only) */
        .stream-stats {
            position: absolute;
            top: 8px;
            left: 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 10;
        }
        .stat-card {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            opacity: 0.8;
        }
        .stat-card:hover {
            opacity: 1;
        }
        .live-indicator {
            width: 4px;
            height: 4px;
            background: #ef4444;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }
        /* Stream Fullscreen Button - Bottom left */
        .stream-fullscreen-btn {
            position: absolute;
            bottom: 8px;
            left: 8px;
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 6px 8px;
            border-radius: 6px;
            font-size: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            opacity: 0.8;
            z-index: 10;
        }
        .stream-fullscreen-btn:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.1);
        }
        .stream-fullscreen-btn:active {
            transform: scale(0.95);
        }
        /* Session Buttons - Bottom center */
        .session-buttons {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }
        .session-btn {
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 6px 10px;
            border-radius: 16px;
            font-size: 9px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            min-width: 70px;
            text-align: center;
            opacity: 0.9;
        }
        .session-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
            opacity: 1;
        }
        .session-btn:active {
            transform: scale(0.95);
        }
        .session-btn.private {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            border: 1px solid #8b5cf6;
        }
        .session-btn.group {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: 1px solid #10b981;
        }
        /* Enhanced Chat Area */
        .chat-area {
            height: 280px;
            background: rgba(15, 15, 35, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        .chat-area.fullscreen-chat {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 240px;
            z-index: 400;
            background: rgba(0, 0, 0, 0.95);
            border-radius: 16px 16px 0 0;
        }
        /* Chat Controls */
        .chat-controls {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background: rgba(10, 10, 25, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            gap: 8px;
            flex-wrap: wrap;
            flex-shrink: 0;
        }
        .chat-tab {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.05);
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            min-width: 44px;
            min-height: 32px;
            justify-content: center;
        }
        .chat-tab:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .chat-tab:active {
            transform: scale(0.95);
        }
        .chat-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .chat-tab-icon {
            font-size: 12px;
        }
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            font-size: 8px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: badgePulse 2s infinite;
        }
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .online-count {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 4px;
            background: rgba(16, 185, 129, 0.2);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 600;
            color: #10b981;
        }
        /* Chat Messages */
        .chat-messages {
            flex: 1;
            padding: 8px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-height: 0;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }
        .chat-messages::-webkit-scrollbar {
            width: 3px;
        }
        .chat-messages::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 2px;
        }
        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }
        .message {
            max-width: 85%;
            padding: 6px 10px;
            border-radius: 12px;
            font-size: 11px;
            line-height: 1.3;
            word-wrap: break-word;
            animation: messageSlide 0.3s ease-out;
            position: relative;
        }
        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .message.sent {
            align-self: flex-end;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 4px;
        }
        .message.received {
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom-left-radius: 4px;
        }
        .message-info {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .user-badge {
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: 600;
        }
        .badge-vip { background: #ffd700; color: #000; }
        .badge-premium { background: #8b5cf6; color: white; }
        .badge-mod { background: #10b981; color: white; }
        /* Tip and Gift Alerts */
        .tip-alert {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #000;
            text-align: center;
            padding: 8px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 10px;
            margin: 4px 0;
            border: 2px solid #ffd700;
            animation: tipPulse 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }
        .tip-alert.mega-tip {
            background: linear-gradient(135deg, #ff6b6b 0%, #ffd700 50%, #ff6b6b 100%);
            animation: megaTipPulse 1s ease-out;
            font-size: 11px;
            padding: 10px;
        }
        @keyframes tipPulse {
            0% { transform: scale(0.9); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes megaTipPulse {
            0% { transform: scale(0.8); opacity: 0; }
            25% { transform: scale(1.1); }
            50% { transform: scale(0.95); }
            75% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }
        .gift-alert {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            color: white;
            text-align: center;
            padding: 6px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 10px;
            margin: 4px 0;
            animation: giftPulse 0.4s ease-out;
        }
        @keyframes giftPulse {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        /* Private Chat Subscription Message */
        .subscription-message {
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            padding: 16px;
            margin: 8px;
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
        }
        .subscription-title {
            font-size: 14px;
            font-weight: 600;
            color: #8b5cf6;
            margin-bottom: 8px;
        }
        .subscription-text {
            font-size: 11px;
            margin-bottom: 12px;
            line-height: 1.4;
        }
        .subscription-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .subscription-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 16px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 80px;
        }
        .subscription-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }
        .subscription-btn:active {
            transform: scale(0.95);
        }
        /* Chat Input */
        .chat-input {
            padding: 8px;
            background: rgba(10, 10, 25, 0.9);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }
        .input-row {
            display: flex;
            gap: 6px;
            align-items: flex-end;
        }
        .message-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 8px 12px;
            color: white;
            font-size: 12px;
            resize: none;
            min-height: 36px;
            max-height: 80px;
            font-family: inherit;
            transition: all 0.3s ease;
            line-height: 1.3;
        }
        .message-input:focus {
            outline: none;
            border-color: #667eea;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
        }
        .message-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .input-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 16px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            flex-shrink: 0;
            transition: all 0.3s ease;
            min-width: 36px;
            min-height: 36px;
        }
        .input-btn:hover {
            transform: translateY(-1px);
        }
        .input-btn:active {
            transform: scale(0.95);
        }
        .quick-tip-btn, .gift-btn {
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 9px;
            font-weight: 700;
            flex-shrink: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quick-tip-btn {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #000;
        }
        .gift-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            color: white;
            font-size: 14px;
        }
        .quick-tip-btn:hover, .gift-btn:hover {
            transform: scale(1.1);
        }
        .quick-tip-btn:active, .gift-btn:active {
            transform: scale(0.9);
        }
        /* Users Overlay */
        .users-overlay {
            position: absolute;
            top: 50px;
            left: 8px;
            right: 8px;
            background: rgba(10, 10, 25, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 12px;
            max-height: 180px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            animation: overlaySlide 0.3s ease-out;
        }
        @keyframes overlaySlide {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .users-overlay.show {
            display: block;
        }
        .users-overlay::-webkit-scrollbar {
            width: 3px;
        }
        .users-overlay::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 2px;
        }
        .users-overlay::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }
        .users-header {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 6px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .users-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
        }
        .user-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 2px;
            min-height: 36px;
        }
        .user-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        .user-item:active {
            transform: scale(0.98);
        }
        .user-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            position: relative;
            flex-shrink: 0;
        }
        .user-avatar.vip { background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #000; }
        .user-avatar.premium { background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%); }
        .user-avatar.regular { background: #4a5568; }
        .user-avatar.mod { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .online-dot {
            position: absolute;
            bottom: -1px;
            right: -1px;
            width: 6px;
            height: 6px;
            background: #10b981;
            border: 1px solid #0a0a1a;
            border-radius: 50%;
        }
        .user-info {
            flex: 1;
            min-width: 0;
        }
        .user-name {
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-status-text {
            font-size: 8px;
            color: rgba(255, 255, 255, 0.6);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        /* Modals */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 16px;
            backdrop-filter: blur(5px);
        }
        .modal.show {
            display: flex;
            animation: modalFade 0.3s ease-out;
        }
        @keyframes modalFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-content {
            background: rgba(10, 10, 25, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 20px;
            width: 100%;
            max-width: 380px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlide 0.3s ease-out;
        }
        @keyframes modalSlide {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-content::-webkit-scrollbar {
            width: 3px;
        }
        .modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 2px;
        }
        .modal-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }
        .modal-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* Grids */
        .tip-grid, .gift-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
            gap: 10px;
            margin: 16px 0;
        }
        .tip-item, .gift-item {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .tip-item:hover, .gift-item:hover {
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        .tip-item:active, .gift-item:active {
            transform: scale(0.95);
        }
        .tip-item.selected {
            border-color: #ffd700;
            background: rgba(255, 215, 0, 0.2);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
        }
        .gift-item.selected {
            border-color: #8b5cf6;
            background: rgba(139, 92, 246, 0.2);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.3);
        }
        .tip-amount {
            font-size: 16px;
            font-weight: 700;
            color: #ffd700;
            margin-bottom: 2px;
        }
        .tip-tokens {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }
        .tip-popular {
            position: absolute;
            top: -1px;
            right: -1px;
            background: #ef4444;
            color: white;
            font-size: 7px;
            font-weight: 700;
            padding: 1px 4px;
            border-radius: 0 10px 0 6px;
        }
        .gift-emoji {
            font-size: 24px;
            margin-bottom: 4px;
            display: block;
        }
        .gift-name {
            font-size: 9px;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .gift-price {
            font-size: 10px;
            font-weight: 700;
            color: #8b5cf6;
        }
        /* Buttons */
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            font-size: 12px;
            transition: all 0.3s ease;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-primary:active {
            transform: scale(0.98);
        }
        .btn-primary:disabled {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .btn-tip {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #000;
        }
        .btn-tip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }
        .btn-tip:active {
            transform: scale(0.98);
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        .btn-secondary:active {
            transform: scale(0.98);
        }
        /* Notification */
        .notification {
            position: fixed;
            top: 60px;
            left: 16px;
            right: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 16px;
            border-radius: 10px;
            transform: translateY(-100px);
            transition: transform 0.3s ease;
            z-index: 1001;
            font-weight: 600;
            text-align: center;
            font-size: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        .notification.show {
            transform: translateY(0);
        }
        .notification.tip-notification {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #000;
        }
        /* Floating Effects */
        .tip-effect {
            position: absolute;
            pointer-events: none;
            font-size: 18px;
            font-weight: 700;
            color: #ffd700;
            animation: tipFloat 3s ease-out forwards;
            z-index: 50;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        @keyframes tipFloat {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-60px) scale(1.1);
            }
        }
        .heart-rain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 40;
        }
        .heart {
            position: absolute;
            font-size: 16px;
            animation: heartFall 4s linear forwards;
            opacity: 0.6;
        }
        @keyframes heartFall {
            0% {
                transform: translateY(-50px) rotate(0deg);
                opacity: 0.8;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        /* Mobile Responsive Design */
        @media (max-width: 480px) {
            body {
                height: 100vh;
                height: 100dvh;
            }
            .app-container {
                height: 100vh;
                height: 100dvh;
            }
            .header {
                padding: 6px 8px;
                height: 44px;
            }
            .brand-name {
                font-size: 12px;
            }
            .tab {
                font-size: 9px;
                padding: 4px 6px;
            }
            .token-balance {
                font-size: 9px;
                padding: 4px 8px;
            }
            .session-buttons {
                bottom: 6px;
                gap: 4px;
            }
            .session-btn {
                padding: 4px 8px;
                font-size: 8px;
                min-width: 60px;
            }
            .chat-area {
                height: 240px;
            }
            .chat-controls {
                padding: 6px 8px;
            }
            .chat-tab {
                font-size: 9px;
                padding: 4px 8px;
                min-height: 28px;
            }
            .online-count {
                font-size: 8px;
                padding: 3px 6px;
            }
            .message {
                font-size: 10px;
                padding: 4px 8px;
            }
            .message-info {
                font-size: 8px;
            }
            .user-badge {
                font-size: 6px;
                padding: 1px 3px;
            }
            .tip-alert, .gift-alert {
                font-size: 9px;
                padding: 6px;
            }
            .chat-input {
                padding: 6px;
            }
            .message-input {
                font-size: 11px;
                padding: 6px 10px;
                min-height: 32px;
            }
            .input-btn {
                font-size: 9px;
                padding: 6px 10px;
                min-width: 32px;
                min-height: 32px;
            }
            .quick-tip-btn, .gift-btn {
                width: 32px;
                height: 32px;
                font-size: 8px;
            }
            .gift-btn {
                font-size: 12px;
            }
            .tip-grid, .gift-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }
            .tip-item, .gift-item {
                padding: 8px;
                min-height: 60px;
            }
            .tip-amount {
                font-size: 14px;
            }
            .gift-emoji {
                font-size: 20px;
            }
            .modal-content {
                padding: 16px;
                margin: 8px;
            }
            .modal-title {
                font-size: 16px;
            }
            .stat-card {
                padding: 3px 6px;
                font-size: 9px;
            }
            .stream-fullscreen-btn {
                font-size: 9px;
                padding: 4px 6px;
            }
            .users-overlay {
                max-height: 160px;
                padding: 8px;
            }
            .user-item {
                min-height: 32px;
                padding: 4px;
            }
            .user-avatar {
                width: 20px;
                height: 20px;
                font-size: 10px;
            }
            .user-name {
                font-size: 9px;
            }
            .user-status-text {
                font-size: 7px;
            }
            .loading-container {
                max-width: 240px;
                padding: 16px;
            }
            .loading-text {
                font-size: 14px;
            }
            .subscription-message {
                margin: 4px;
                padding: 12px;
            }
            .subscription-title {
                font-size: 12px;
            }
            .subscription-text {
                font-size: 10px;
            }
            .subscription-btn {
                font-size: 9px;
                padding: 6px 12px;
                min-width: 70px;
            }
        }
        @media (min-width: 768px) {
            .main-content {
                flex-direction: row;
            }
            .streaming-area {
                flex: 1;
            }
            .chat-area {
                width: 380px;
                height: auto;
            }
            .chat-area.fullscreen-chat {
                width: 420px;
                height: 300px;
                right: 20px;
                left: auto;
                bottom: 20px;
                border-radius: 16px;
            }
            .header {
                height: 56px;
                padding: 10px 20px;
            }
            .logo {
                width: 28px;
                height: 28px;
                font-size: 14px;
            }
            .brand-name {
                font-size: 16px;
            }
            .tab {
                font-size: 12px;
                padding: 6px 10px;
            }
            .tip-grid, .gift-grid {
                grid-template-columns: repeat(4, 1fr);
            }
            .loading-container {
                max-width: 320px;
            }
            .loading-text {
                font-size: 18px;
            }
            .session-buttons {
                bottom: 12px;
            }
            .session-btn {
                padding: 8px 12px;
                font-size: 10px;
                min-width: 80px;
            }
        }
        @media (min-width: 1024px) {
            .chat-area {
                width: 400px;
            }
            .modal-content {
                max-width: 450px;
            }
            .tip-grid, .gift-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }
        /* Focus styles for keyboard navigation */
        .tab:focus,
        .session-btn:focus,
        .chat-tab:focus,
        .user-item:focus,
        .tip-item:focus,
        .gift-item:focus,
        .btn:focus,
        .input-btn:focus,
        .quick-tip-btn:focus,
        .gift-btn:focus,
        .token-balance:focus,
        .stream-fullscreen-btn:focus,
        .subscription-btn:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }
        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        @media (prefers-contrast: high) {
            .header {
                border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            }
            .message {
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .tip-item, .gift-item {
                border: 2px solid rgba(255, 255, 255, 0.3);
            }
        }
        /* Prevent zoom on input focus on iOS */
        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            select,
            textarea,
            input[type="text"],
            input[type="password"],
            input[type="datetime"],
            input[type="datetime-local"],
            input[type="date"],
            input[type="month"],
            input[type="time"],
            input[type="week"],
            input[type="number"],
            input[type="email"],
            input[type="url"],
            input[type="search"],
            input[type="tel"],
            input[type="color"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <div class="header" id="header">
            <div class="logo-section" onclick="showNotification('Welcome to Elite Streaming Platform! 🎉')">
                <div class="logo">E</div>
                <div class="brand-name">Elite</div>
            </div>
                        
            <div class="tabs">
                <div class="tab active" onclick="switchTab('public')" tabindex="0" role="button" aria-label="Switch to public chat">
                    <div class="tab-dot"></div>
                    <span>Public</span>
                </div>
                <div class="tab" onclick="switchTab('private')" tabindex="0" role="button" aria-label="Switch to private chat">
                    <div class="tab-dot"></div>
                    <span>Private</span>
                </div>
            </div>
                        
            <div class="user-section">
                <div class="token-balance" onclick="openModal('tokensModal')" tabindex="0" role="button" aria-label="View token balance and buy more tokens">
                    🪙 <span id="tokenBalance">2,500</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Clean Streaming Area -->
            <div class="streaming-area" id="streamingArea" role="main" aria-label="Streaming video area">
                <!-- Effects Container -->
                <div class="heart-rain" id="heartRain" aria-hidden="true"></div>
                                
                <!-- Stock Video Element -->
                <video 
                    class="stream-video"
                    id="streamVideo"
                    autoplay 
                    muted 
                    loop 
                    playsinline
                    poster="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='600' viewBox='0 0 800 600'%3E%3Crect width='800' height='600' fill='%23000'/%3E%3C/svg%3E"
                >
                    <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">
                    <source src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                                
                <!-- Loading Animation -->
                <div class="loading-container" id="loadingContainer" role="status" aria-label="Connecting to stream">
                    <div class="loading-text">Connecting to Elite Stream...</div>
                    <div class="loading-dots" aria-hidden="true">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>

                <!-- Minimal Stats - Top left (viewer count only) -->
                <div class="stream-stats" role="complementary" aria-label="Stream statistics">
                    <div class="stat-card">
                        <div class="live-indicator" aria-hidden="true"></div>
                        <span id="viewerCount">5.2K</span>
                    </div>
                </div>

                <!-- Stream Fullscreen Button - Bottom left -->
                <button class="stream-fullscreen-btn" onclick="toggleStreamFullscreen()" aria-label="Toggle stream fullscreen">
                    ⛶ Full
                </button>

                <!-- Session Buttons - Bottom center -->
                <div class="session-buttons" role="toolbar" aria-label="Session options">
                    <button class="session-btn private" onclick="openModal('privateModal')" aria-label="Request private session">
                        🔒 Private Show
                    </button>
                    <button class="session-btn group" onclick="openModal('groupModal')" aria-label="Join or create group session">
                        👥 Group Show
                    </button>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="chat-area" id="chatArea" role="complementary" aria-label="Chat area">
                <!-- Chat Controls -->
                <div class="chat-controls" role="tablist" aria-label="Chat view controls">
                    <div class="chat-tab active" onclick="switchChatView('all')" tabindex="0" role="tab" aria-selected="true" aria-label="View all messages">
                        <span class="chat-tab-icon">💬</span>
                        <span>All</span>
                    </div>
                    <div class="chat-tab" onclick="switchChatView('private')" tabindex="0" role="tab" aria-selected="false" aria-label="View private messages">
                        <span class="chat-tab-icon">📩</span>
                        <span>Private</span>
                        <div class="notification-badge" aria-label="3 new private messages">3</div>
                    </div>
                    <div class="chat-tab" onclick="toggleUsersOverlay()" tabindex="0" role="button" aria-label="View online users">
                        <span class="chat-tab-icon">👥</span>
                        <span>Users</span>
                    </div>
                                        
                    <div class="online-count" aria-label="Online users count">
                        <div class="live-indicator" aria-hidden="true"></div>
                        <span id="onlineCount">1.8K</span>
                    </div>
                </div>

                <div class="chat-messages" id="chatMessages" role="log" aria-label="Chat messages" aria-live="polite">
                    <!-- Messages populated by JS -->
                </div>

                <!-- Users Overlay -->
                <div class="users-overlay" id="usersOverlay" role="dialog" aria-label="Online users list">
                    <div class="users-header">
                        <span>👥 Online Users</span>
                        <span class="users-count" id="usersCount">1.8K</span>
                    </div>
                    <div id="usersList" role="list">
                        <!-- Users populated by JS -->
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="chat-input" role="form" aria-label="Send message">
                    <div class="input-row">
                        <button class="quick-tip-btn" onclick="openModal('tipModal')" title="Send Tip" aria-label="Send tip tokens">
                            💰
                        </button>
                        <button class="gift-btn" onclick="openModal('giftModal')" title="Send Gift" aria-label="Send virtual gift">
                            🎁
                        </button>
                        <textarea 
                            class="message-input"
                            id="messageInput"
                            placeholder="Type message..."
                            onkeypress="handleKeyPress(event)"
                            aria-label="Type your message"
                            rows="1"
                        ></textarea>
                        <button class="input-btn" onclick="sendMessage()" aria-label="Send message">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tip Modal -->
    <div class="modal" id="tipModal" role="dialog" aria-labelledby="tipModalTitle" aria-modal="true">
        <div class="modal-content">
            <div class="modal-title" id="tipModalTitle">💰 Tip Tokens</div>
            <p style="color: rgba(255,255,255,0.8); margin-bottom: 12px; font-size: 11px; text-align: center;">
                Show your appreciation with tokens!
            </p>
            <div class="tip-grid" role="radiogroup" aria-label="Select tip amount">
                <div class="tip-item" onclick="selectTip(this, 10)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 10 tokens">
                    <div class="tip-amount">10</div>
                    <div class="tip-tokens">tokens</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 25)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 25 tokens - Popular choice">
                    <div class="tip-amount">25</div>
                    <div class="tip-tokens">tokens</div>
                    <div class="tip-popular">Popular</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 50)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 50 tokens">
                    <div class="tip-amount">50</div>
                    <div class="tip-tokens">tokens</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 100)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 100 tokens">
                    <div class="tip-amount">100</div>
                    <div class="tip-tokens">tokens</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 250)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 250 tokens">
                    <div class="tip-amount">250</div>
                    <div class="tip-tokens">tokens</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 500)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 500 tokens">
                    <div class="tip-amount">500</div>
                    <div class="tip-tokens">tokens</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 1000)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 1000 tokens">
                    <div class="tip-amount">1000</div>
                    <div class="tip-tokens">tokens</div>
                </div>
                <div class="tip-item" onclick="selectTip(this, 2500)" tabindex="0" role="radio" aria-checked="false" aria-label="Tip 2500 tokens">
                    <div class="tip-amount">2500</div>
                    <div class="tip-tokens">tokens</div>
                </div>
            </div>
            <textarea 
                id="tipMessage"
                placeholder="Add a message (optional)..."
                style="width: 100%; padding: 10px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: white; margin-bottom: 12px; font-size: 11px; resize: none; height: 60px; font-family: inherit;"
                aria-label="Optional message with your tip"
            ></textarea>
            <button class="btn btn-tip" onclick="sendTip()" id="sendTipBtn" disabled>Send Tip</button>
            <button class="btn btn-secondary" onclick="closeModal('tipModal')">Cancel</button>
        </div>
    </div>

    <!-- Tokens Purchase Modal -->
    <div class="modal" id="tokensModal" role="dialog" aria-labelledby="tokensModalTitle" aria-modal="true">
        <div class="modal-content">
            <div class="modal-title" id="tokensModalTitle">🪙 Buy Tokens</div>
            <p style="color: rgba(255,255,255,0.8); margin-bottom: 12px; font-size: 11px; text-align: center;">
                Current Balance: <span style="color: #ffd700; font-weight: 700;" id="currentBalance">2,500</span> tokens
            </p>
            <div class="tip-grid" role="radiogroup" aria-label="Select token package">
                <div class="tip-item" onclick="selectTokenPackage(this, 100, 5)" tabindex="0" role="radio" aria-checked="false" aria-label="Buy 100 tokens for $5">
                    <div class="tip-amount">100</div>
                    <div class="tip-tokens">$5</div>
                </div>
                <div class="tip-item" onclick="selectTokenPackage(this, 250, 10)" tabindex="0" role="radio" aria-checked="false" aria-label="Buy 250 tokens for $10 with 10% bonus">
                    <div class="tip-amount">250</div>
                    <div class="tip-tokens">$10</div>
                    <div class="tip-popular">+10% Bonus</div>
                </div>
                <div class="tip-item" onclick="selectTokenPackage(this, 500, 20)" tabindex="0" role="radio" aria-checked="false" aria-label="Buy 500 tokens for $20">
                    <div class="tip-amount">500</div>
                    <div class="tip-tokens">$20</div>
                </div>
                <div class="tip-item" onclick="selectTokenPackage(this, 1000, 35)" tabindex="0" role="radio" aria-checked="false" aria-label="Buy 1000 tokens for $35 - Best value">
                    <div class="tip-amount">1000</div>
                    <div class="tip-tokens">$35</div>
                    <div class="tip-popular">Best Value</div>
                </div>
                <div class="tip-item" onclick="selectTokenPackage(this, 2500, 75)" tabindex="0" role="radio" aria-checked="false" aria-label="Buy 2500 tokens for $75">
                    <div class="tip-amount">2500</div>
                    <div class="tip-tokens">$75</div>
                </div>
                <div class="tip-item" onclick="selectTokenPackage(this, 5000, 140)" tabindex="0" role="radio" aria-checked="false" aria-label="Buy 5000 tokens for $140 - VIP package">
                    <div class="tip-amount">5000</div>
                    <div class="tip-tokens">$140</div>
                    <div class="tip-popular">VIP</div>
                </div>
            </div>
            <button class="btn btn-tip" onclick="buyTokens()" id="buyTokensBtn" disabled>Buy Tokens</button>
            <button class="btn btn-secondary" onclick="closeModal('tokensModal')">Cancel</button>
        </div>
    </div>

    <!-- Gift Modal -->
    <div class="modal" id="giftModal" role="dialog" aria-labelledby="giftModalTitle" aria-modal="true">
        <div class="modal-content">
            <div class="modal-title" id="giftModalTitle">🎁 Send Gift</div>
            <div class="gift-grid" role="radiogroup" aria-label="Select gift to send">
                <div class="gift-item" onclick="selectGift(this, 'rose', 50)" tabindex="0" role="radio" aria-checked="false" aria-label="Send rose for 50 tokens">
                    <div class="gift-emoji">🌹</div>
                    <div class="gift-name">Rose</div>
                    <div class="gift-price">50 tokens</div>
                </div>
                <div class="gift-item" onclick="selectGift(this, 'heart', 100)" tabindex="0" role="radio" aria-checked="false" aria-label="Send heart for 100 tokens">
                    <div class="gift-emoji">💖</div>
                    <div class="gift-name">Heart</div>
                    <div class="gift-price">100 tokens</div>
                </div>
                <div class="gift-item" onclick="selectGift(this, 'diamond', 500)" tabindex="0" role="radio" aria-checked="false" aria-label="Send diamond for 500 tokens">
                    <div class="gift-emoji">💎</div>
                    <div class="gift-name">Diamond</div>
                    <div class="gift-price">500 tokens</div>
                </div>
                <div class="gift-item" onclick="selectGift(this, 'crown', 1000)" tabindex="0" role="radio" aria-checked="false" aria-label="Send crown for 1000 tokens">
                    <div class="gift-emoji">👑</div>
                    <div class="gift-name">Crown</div>
                    <div class="gift-price">1000 tokens</div>
                </div>
                <div class="gift-item" onclick="selectGift(this, 'car', 2500)" tabindex="0" role="radio" aria-checked="false" aria-label="Send luxury car for 2500 tokens">
                    <div class="gift-emoji">🚗</div>
                    <div class="gift-name">Luxury Car</div>
                    <div class="gift-price">2500 tokens</div>
                </div>
                <div class="gift-item" onclick="selectGift(this, 'yacht', 5000)" tabindex="0" role="radio" aria-checked="false" aria-label="Send yacht for 5000 tokens">
                    <div class="gift-emoji">🛥️</div>
                    <div class="gift-name">Yacht</div>
                    <div class="gift-price">5000 tokens</div>
                </div>
            </div>
            <button class="btn btn-primary" onclick="sendGift()" id="sendGiftBtn" disabled>Send Gift</button>
            <button class="btn btn-secondary" onclick="closeModal('giftModal')">Cancel</button>
        </div>
    </div>

    <!-- Private Modal -->
    <div class="modal" id="privateModal" role="dialog" aria-labelledby="privateModalTitle" aria-modal="true">
        <div class="modal-content">
            <div class="modal-title" id="privateModalTitle">🔒 Private Session</div>
            <p style="color: rgba(255,255,255,0.8); margin: 10px 0; font-size: 11px;">
                Request a private session with exclusive features.
            </p>
            <select style="width: 100%; padding: 10px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: white; margin-bottom: 12px; font-size: 11px; font-family: inherit;" aria-label="Select private session duration">
                <option>15 minutes - 1,000 tokens</option>
                <option>30 minutes - 1,800 tokens</option>
                <option>60 minutes - 3,000 tokens</option>
            </select>
            <button class="btn btn-primary" onclick="sendPrivateRequest()">Send Request</button>
            <button class="btn btn-secondary" onclick="closeModal('privateModal')">Cancel</button>
        </div>
    </div>

    <!-- Group Modal -->
    <div class="modal" id="groupModal" role="dialog" aria-labelledby="groupModalTitle" aria-modal="true">
        <div class="modal-content">
            <div class="modal-title" id="groupModalTitle">👥 Group Session</div>
            <p style="color: rgba(255,255,255,0.8); margin: 10px 0; font-size: 11px;">
                Join or create a group session with other users.
            </p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 12px 0;" role="radiogroup" aria-label="Select group session type">
                <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px; text-align: center; cursor: pointer; font-size: 10px; border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;" onclick="selectGroupType('join')" tabindex="0" role="radio" aria-checked="false" aria-label="Join existing group for 500 tokens">
                    <div style="margin-bottom: 6px;">Join Group</div>
                    <div style="color: #10b981; font-weight: 600;">500 tokens</div>
                </div>
                <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px; text-align: center; cursor: pointer; font-size: 10px; border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;" onclick="selectGroupType('create')" tabindex="0" role="radio" aria-checked="false" aria-label="Create new group for 800 tokens">
                    <div style="margin-bottom: 6px;">Create Group</div>
                    <div style="color: #10b981; font-weight: 600;">800 tokens</div>
                </div>
            </div>
            <button class="btn btn-primary" onclick="sendGroupRequest()">Send Request</button>
            <button class="btn btn-secondary" onclick="closeModal('groupModal')">Cancel</button>
        </div>
    </div>

    <!-- Premium Subscription Modal -->
    <div class="modal" id="premiumModal" role="dialog" aria-labelledby="premiumModalTitle" aria-modal="true">
        <div class="modal-content">
            <div class="modal-title" id="premiumModalTitle">⭐ Premium Membership</div>
            <p style="color: rgba(255,255,255,0.8); margin-bottom: 16px; font-size: 11px; text-align: center;">
                Unlock exclusive features and private messaging!
            </p>
            <div class="tip-grid" role="radiogroup" aria-label="Select premium package">
                <div class="tip-item" onclick="selectPremiumPackage(this, 'monthly', 19.99)" tabindex="0" role="radio" aria-checked="false" aria-label="Monthly premium for $19.99">
                    <div class="tip-amount">Monthly</div>
                    <div class="tip-tokens">$19.99</div>
                </div>
                <div class="tip-item" onclick="selectPremiumPackage(this, 'yearly', 199.99)" tabindex="0" role="radio" aria-checked="false" aria-label="Yearly premium for $199.99 - Best value">
                    <div class="tip-amount">Yearly</div>
                    <div class="tip-tokens">$199.99</div>
                    <div class="tip-popular">Best Value</div>
                </div>
            </div>
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 12px; margin: 12px 0; font-size: 10px;">
                <div style="font-weight: 600; margin-bottom: 6px; color: #8b5cf6;">Premium Benefits:</div>
                <div style="color: rgba(255,255,255,0.8);">
                    • Private messaging with models<br>
                    • Priority chat support<br>
                    • Exclusive content access<br>
                    • No ads<br>
                    • Special premium badge
                </div>
            </div>
            <button class="btn btn-primary" onclick="buyPremium()" id="buyPremiumBtn" disabled>Subscribe to Premium</button>
            <button class="btn btn-secondary" onclick="closeModal('premiumModal')">Cancel</button>
        </div>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification" role="alert" aria-live="assertive"></div>

    <script>
        let selectedGift = null;
        let selectedTip = null;
        let selectedTokenPackage = null;
        let selectedPremiumPackage = null;
        let selectedGroupType = null;
        let currentChatView = 'all';
        let usersOverlayVisible = false;
        let isFullscreen = false;
        let isStreamFullscreen = false;
        let tokenBalance = 2500;
        let totalTips = 1247;
        let messageCount = 0;
        let isPremiumUser = false;

        const users = [
            { name: 'Alex_VIP', type: 'vip', avatar: '👨', status: 'Tipping 💰' },
            { name: 'Sarah_Premium', type: 'premium', avatar: '👩', status: 'Chatting 💬' },
            { name: 'Mike_Mod', type: 'mod', avatar: '👨‍💼', status: 'Moderating 🛡️' },
            { name: 'Emma_Gold', type: 'vip', avatar: '👸', status: 'Sending gifts 🎁' },
            { name: 'John_User', type: 'regular', avatar: '👤', status: 'Watching 👀' },
            { name: 'Lisa_Premium', type: 'premium', avatar: '👩‍🦰', status: 'Dancing 💃' },
            { name: 'David_VIP', type: 'vip', avatar: '🤵', status: 'Enjoying show 😍' }
        ];

        const privateMessages = [
            { from: 'Sarah_Premium', message: 'Hey! Want to go private? 😘', time: '2m', type: 'premium' },
            { from: 'Emma_Gold', message: 'Thanks for the amazing tip! 💕', time: '5m', type: 'vip' },
            { from: 'Alex_VIP', message: 'You\'re incredible! 🥰', time: '8m', type: 'vip' },
            { from: 'Lisa_Premium', message: 'Love your energy tonight! ✨', time: '12m', type: 'premium' }
        ];

        const publicMessages = [
            { from: 'Sarah_Premium', message: 'Welcome to Elite Stream! 🎉', type: 'premium' },
            { from: 'Alex_VIP', message: 'Amazing show tonight! 🔥', type: 'vip' },
            { from: 'Mike_Mod', message: 'Remember to follow the chat rules everyone! 📋', type: 'mod' },
            { from: 'Emma_Gold', message: 'This music is perfect! 🎵', type: 'vip' }
        ];

        // Initialize app when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            populateUsers();
            addInitialMessages();
            updateTokenDisplay();
            setupKeyboardNavigation();
            setupTouchGestures();
                        
            // Auto-resize textarea
            const messageInput = document.getElementById('messageInput');
            messageInput.addEventListener('input', autoResizeTextarea);

            // Video element event listeners
            const video = document.getElementById('streamVideo');
            const loadingContainer = document.getElementById('loadingContainer');

            video.addEventListener('canplay', () => {
                loadingContainer.classList.add('hidden');
            });

            video.addEventListener('waiting', () => {
                loadingContainer.classList.remove('hidden');
            });

            video.addEventListener('playing', () => {
                loadingContainer.classList.add('hidden');
            });

            video.addEventListener('pause', () => {
                loadingContainer.classList.remove('hidden');
            });

            video.addEventListener('ended', () => {
                loadingContainer.classList.remove('hidden');
            });
        });

        function setupKeyboardNavigation() {
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal.show').forEach(modal => {
                        closeModal(modal.id);
                    });
                    if (usersOverlayVisible) {
                        toggleUsersOverlay();
                    }
                }
                                
                if (e.key === 'Enter' && e.target.classList.contains('tip-item')) {
                    e.target.click();
                }
                if (e.key === 'Enter' && e.target.classList.contains('gift-item')) {
                    e.target.click();
                }
                if (e.key === 'Enter' && e.target.classList.contains('tab')) {
                    e.target.click();
                }
                if (e.key === 'Enter' && e.target.classList.contains('chat-tab')) {
                    e.target.click();
                }
            });
        }

        function setupTouchGestures() {
            let touchStartY = 0;
            let touchEndY = 0;
                        
            document.addEventListener('touchstart', function(e) {
                touchStartY = e.changedTouches[0].screenY;
            });
                        
            document.addEventListener('touchend', function(e) {
                touchEndY = e.changedTouches[0].screenY;
                handleSwipeGesture();
            });
                        
            function handleSwipeGesture() {
                const swipeThreshold = 50;
                const diff = touchStartY - touchEndY;
                                
                if (diff > swipeThreshold && (isFullscreen || isStreamFullscreen)) {
                    const header = document.getElementById('header');
                    if (!header.classList.contains('hidden')) {
                        header.classList.add('hidden');
                        showNotification('Header hidden. Swipe down to show.');
                    }
                }
                                
                if (diff < -swipeThreshold && (isFullscreen || isStreamFullscreen)) {
                    const header = document.getElementById('header');
                    if (header.classList.contains('hidden')) {
                        header.classList.remove('hidden');
                        showNotification('Header shown.');
                    }
                }
            }
        }

        function autoResizeTextarea() {
            const textarea = document.getElementById('messageInput');
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 80) + 'px';
        }

        function updateTokenDisplay() {
            document.getElementById('tokenBalance').textContent = tokenBalance.toLocaleString();
            document.getElementById('currentBalance').textContent = tokenBalance.toLocaleString();
        }

        function populateUsers() {
            const usersList = document.getElementById('usersList');
            usersList.innerHTML = '';
                        
            users.forEach((user, index) => {
                const userDiv = document.createElement('div');
                userDiv.className = 'user-item';
                userDiv.onclick = () => startPrivateChat(user.name);
                userDiv.setAttribute('role', 'listitem');
                userDiv.setAttribute('tabindex', '0');
                userDiv.setAttribute('aria-label', `${user.name}, ${user.type} user, ${user.status}`);
                                
                userDiv.innerHTML = `
                    <div class="user-avatar ${user.type}">
                        ${user.avatar}
                        <div class="online-dot"></div>
                    </div>
                    <div class="user-info">
                        <div class="user-name">${user.name}</div>
                        <div class="user-status-text">${user.status}</div>
                    </div>
                `;
                                
                userDiv.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        startPrivateChat(user.name);
                    }
                });
                                
                usersList.appendChild(userDiv);
            });
        }

        function addInitialMessages() {
            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = '';
                        
            if (currentChatView === 'all') {
                publicMessages.forEach(msg => {
                    addMessage(msg.message, 'received', msg.from, msg.type);
                });
                                
                setTimeout(() => {
                    addMessage('Hey everyone! Great to be here!', 'sent');
                }, 500);
                                
                setTimeout(() => {
                    addTipAlert('Emma_Gold tipped 250 tokens! 💰', false);
                }, 1000);
                                
                setTimeout(() => {
                    addGiftAlert('Mike_Mod sent a Diamond! 💎');
                }, 1500);
                            
            } else if (currentChatView === 'private') {
                showPrivateMessages();
            }
        }

        function showPrivateMessages() {
            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = '';

            if (!isPremiumUser) {
                // Show subscription message for non-premium users
                const subscriptionDiv = document.createElement('div');
                subscriptionDiv.className = 'subscription-message';
                subscriptionDiv.innerHTML = `
                    <div class="subscription-title">🔒 Premium Feature</div>
                    <div class="subscription-text">
                        Subscribe to message and become a premium member to unlock private messaging with models and exclusive features!
                    </div>
                    <div class="subscription-buttons">
                        <button class="subscription-btn" onclick="openModal('premiumModal')">
                            Subscribe Premium
                        </button>
                        <button class="subscription-btn" onclick="openModal('tokensModal')">
                            Buy Tokens
                        </button>
                    </div>
                `;
                messagesContainer.appendChild(subscriptionDiv);
            } else {
                // Show private messages for premium users
                privateMessages.forEach(msg => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received';
                    messageDiv.innerHTML = `
                        <div class="message-info">
                            <span>${msg.from}</span>
                            <span class="user-badge badge-${msg.type}">${msg.type.toUpperCase()}</span>
                            <span style="margin-left: auto;">${msg.time}</span>
                        </div>
                        <div>${msg.message}</div>
                    `;
                    messagesContainer.appendChild(messageDiv);
                });
            }
                        
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function toggleStreamFullscreen() {
            const streamingArea = document.getElementById('streamingArea');
            const chatArea = document.getElementById('chatArea');
                        
            isStreamFullscreen = !isStreamFullscreen;
                        
            if (isStreamFullscreen) {
                streamingArea.classList.add('fullscreen');
                chatArea.style.display = 'none';
                showNotification('Stream fullscreen activated!', 'tip');
            } else {
                streamingArea.classList.remove('fullscreen');
                chatArea.style.display = 'flex';
                showNotification('Exited stream fullscreen.');
            }
        }

        function switchChatView(view) {
            currentChatView = view;
                        
            document.querySelectorAll('.chat-tab').forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            });
            event.target.closest('.chat-tab').classList.add('active');
            event.target.closest('.chat-tab').setAttribute('aria-selected', 'true');
                        
            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = '';
                        
            if (view === 'all') {
                addInitialMessages();
            } else if (view === 'private') {
                showPrivateMessages();
            }
                        
            showNotification(`Switched to ${view === 'all' ? 'All Chat' : 'Private Messages'}`);
        }

        function toggleUsersOverlay() {
            const overlay = document.getElementById('usersOverlay');
            usersOverlayVisible = !usersOverlayVisible;
                        
            if (usersOverlayVisible) {
                overlay.classList.add('show');
                const firstUser = overlay.querySelector('.user-item');
                if (firstUser) firstUser.focus();
            } else {
                overlay.classList.remove('show');
            }
        }

        function startPrivateChat(username) {
            showNotification(`Starting private chat with ${username}...`);
            toggleUsersOverlay();
                        
            setTimeout(() => {
                switchChatView('private');
            }, 500);
        }

        function switchTab(tab) {
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });
            event.target.closest('.tab').classList.add('active');
            event.target.closest('.tab').setAttribute('aria-selected', 'true');
            showNotification(`Switched to ${tab} chat`);
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            
            if (currentChatView === 'private' && !isPremiumUser) {
                showNotification('Subscribe to Premium to send private messages!');
                setTimeout(() => {
                    openModal('premiumModal');
                }, 1000);
                return;
            }
            
            if (message) {
                addMessage(message, 'sent');
                input.value = '';
                input.style.height = 'auto';
                messageCount++;
                                
                setTimeout(() => {
                    if (currentChatView === 'all') {
                        const responses = [
                            'Thanks for chatting! 💕',
                            'Love your energy! ✨',
                            'You\'re so sweet! 😍',
                            'Great to have you here! 🎉'
                        ];
                        const response = responses[Math.floor(Math.random() * responses.length)];
                        addMessage(response, 'received', 'Sarah_Premium', 'premium');
                    }
                }, 1000 + Math.random() * 2000);
            }
        }

        function addMessage(content, type, username = '', userType = '') {
            const messagesContainer = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            messageDiv.setAttribute('role', 'listitem');
                        
            if (type === 'received' && username) {
                const badgeClass = userType ? `badge-${userType}` : '';
                const badgeText = userType.toUpperCase();
                                
                messageDiv.innerHTML = `
                    <div class="message-info">
                        <span>${username}</span>
                        ${userType ? `<span class="user-badge ${badgeClass}">${badgeText}</span>` : ''}
                    </div>
                    <div>${content}</div>
                `;
            } else {
                messageDiv.textContent = content;
            }
                        
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        
            if (type === 'received') {
                messageDiv.setAttribute('aria-label', `New message from ${username}: ${content}`);
            }
        }

        function addTipAlert(content, isMega = false) {
            const messagesContainer = document.getElementById('chatMessages');
            const alertDiv = document.createElement('div');
            alertDiv.className = isMega ? 'tip-alert mega-tip' : 'tip-alert';
            alertDiv.textContent = content;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.setAttribute('aria-live', 'assertive');
            messagesContainer.appendChild(alertDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        
            createTipEffect(content);
                        
            if (isMega) {
                createHeartRain();
            }
        }

        function addGiftAlert(content) {
            const messagesContainer = document.getElementById('chatMessages');
            const alertDiv = document.createElement('div');
            alertDiv.className = 'gift-alert';
            alertDiv.textContent = content;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.setAttribute('aria-live', 'polite');
            messagesContainer.appendChild(alertDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function createTipEffect(text) {
            const streamingArea = document.getElementById('streamingArea');
            const effect = document.createElement('div');
            effect.className = 'tip-effect';
            effect.textContent = text;
            effect.style.left = Math.random() * 60 + 20 + '%';
            effect.style.top = Math.random() * 40 + 30 + '%';
            effect.setAttribute('aria-hidden', 'true');
            streamingArea.appendChild(effect);
                        
            setTimeout(() => {
                effect.remove();
            }, 3000);
        }

        function createHeartRain() {
            const heartRain = document.getElementById('heartRain');
            const hearts = ['💖', '💕', '💗', '💝', '❤️', '💜', '💙', '💚'];
                        
            for (let i = 0; i < 12; i++) {
                setTimeout(() => {
                    const heart = document.createElement('div');
                    heart.className = 'heart';
                    heart.textContent = hearts[Math.floor(Math.random() * hearts.length)];
                    heart.style.left = Math.random() * 100 + '%';
                    heart.style.animationDelay = Math.random() * 2 + 's';
                    heart.setAttribute('aria-hidden', 'true');
                    heartRain.appendChild(heart);
                                        
                    setTimeout(() => {
                        heart.remove();
                    }, 4000);
                }, i * 100);
            }
        }

        function selectTip(element, amount) {
            document.querySelectorAll('.tip-item').forEach(item => {
                item.classList.remove('selected');
                item.setAttribute('aria-checked', 'false');
            });
                        
            element.classList.add('selected');
            element.setAttribute('aria-checked', 'true');
            selectedTip = amount;
            updateTipButton();
                        
            showNotification(`Selected ${amount} tokens`);
        }

        function selectTokenPackage(element, tokens, price) {
            document.querySelectorAll('.tip-item').forEach(item => {
                item.classList.remove('selected');
                item.setAttribute('aria-checked', 'false');
            });
                        
            element.classList.add('selected');
            element.setAttribute('aria-checked', 'true');
            selectedTokenPackage = { tokens, price };
            updateTokensButton();
                        
            showNotification(`Selected ${tokens} tokens for $${price}`);
        }

        function selectPremiumPackage(element, type, price) {
            document.querySelectorAll('.tip-item').forEach(item => {
                item.classList.remove('selected');
                item.setAttribute('aria-checked', 'false');
            });
                        
            element.classList.add('selected');
            element.setAttribute('aria-checked', 'true');
            selectedPremiumPackage = { type, price };
            updatePremiumButton();
                        
            showNotification(`Selected ${type} premium for $${price}`);
        }

        function selectGift(element, giftType, price) {
            document.querySelectorAll('.gift-item').forEach(item => {
                item.classList.remove('selected');
                item.setAttribute('aria-checked', 'false');
            });
                        
            element.classList.add('selected');
            element.setAttribute('aria-checked', 'true');
            selectedGift = {
                type: giftType,
                price: price,
                name: element.querySelector('.gift-name').textContent
            };
            updateGiftButton();
                        
            showNotification(`Selected ${selectedGift.name} for ${price} tokens`);
        }

        function selectGroupType(type) {
            selectedGroupType = type;
                        
            document.querySelectorAll('[onclick*="selectGroupType"]').forEach(item => {
                item.style.borderColor = 'rgba(255,255,255,0.1)';
                item.setAttribute('aria-checked', 'false');
            });
                        
            event.target.style.borderColor = '#10b981';
            event.target.setAttribute('aria-checked', 'true');
                        
            showNotification(`Selected: ${type} group`);
        }

        function updateTipButton() {
            const btn = document.getElementById('sendTipBtn');
            const canAfford = selectedTip && tokenBalance >= selectedTip;
                        
            btn.disabled = !canAfford;
                        
            if (selectedTip) {
                if (canAfford) {
                    btn.textContent = `Send ${selectedTip} Tokens`;
                } else {
                    btn.textContent = `Need ${selectedTip - tokenBalance} More Tokens`;
                }
            } else {
                btn.textContent = 'Select Amount First';
            }
        }

        function updateTokensButton() {
            const btn = document.getElementById('buyTokensBtn');
            btn.disabled = !selectedTokenPackage;
                        
            if (selectedTokenPackage) {
                btn.textContent = `Buy ${selectedTokenPackage.tokens} Tokens - $${selectedTokenPackage.price}`;
            } else {
                btn.textContent = 'Select Package First';
            }
        }

        function updatePremiumButton() {
            const btn = document.getElementById('buyPremiumBtn');
            btn.disabled = !selectedPremiumPackage;
                        
            if (selectedPremiumPackage) {
                btn.textContent = `Subscribe ${selectedPremiumPackage.type} - $${selectedPremiumPackage.price}`;
            } else {
                btn.textContent = 'Select Package First';
            }
        }

        function updateGiftButton() {
            const btn = document.getElementById('sendGiftBtn');
            const canAfford = selectedGift && tokenBalance >= selectedGift.price;
                        
            btn.disabled = !canAfford;
                        
            if (selectedGift) {
                if (canAfford) {
                    btn.textContent = `Send ${selectedGift.name} (${selectedGift.price} tokens)`;
                } else {
                    btn.textContent = `Need ${selectedGift.price - tokenBalance} More Tokens`;
                }
            } else {
                btn.textContent = 'Select Gift First';
            }
        }

        function sendTip() {
            if (selectedTip && tokenBalance >= selectedTip) {
                const message = document.getElementById('tipMessage').value.trim();
                tokenBalance -= selectedTip;
                totalTips += selectedTip;
                updateTokenDisplay();
                                
                const isMega = selectedTip >= 1000;
                const tipText = message ?
                    `You tipped ${selectedTip} tokens! 💰 "${message}"` :
                    `You tipped ${selectedTip} tokens! 💰`;
                                
                addTipAlert(tipText, isMega);
                closeModal('tipModal');
                showNotification(`Tip sent! ${selectedTip} tokens`, 'tip');
                                
                setTimeout(() => {
                    const responses = [
                        'Thank you so much! You\'re amazing! 😍💕',
                        'Wow! Such a generous tip! 🥰',
                        'You\'re the best! Thank you! 💖',
                        'Amazing! You made my day! ✨',
                        'So sweet of you! Love you! 💕'
                    ];
                    const response = responses[Math.floor(Math.random() * responses.length)];
                    addMessage(response, 'received', 'Sarah_Premium', 'premium');
                }, 2000);
            } else {
                showNotification('Not enough tokens! Buy more tokens to continue.');
                setTimeout(() => {
                    closeModal('tipModal');
                    openModal('tokensModal');
                }, 1000);
            }
        }

        function buyTokens() {
            if (selectedTokenPackage) {
                tokenBalance += selectedTokenPackage.tokens;
                updateTokenDisplay();
                closeModal('tokensModal');
                showNotification(`Successfully purchased ${selectedTokenPackage.tokens} tokens!`, 'tip');
                                
                setTimeout(() => {
                    addMessage('Welcome back! Thanks for your support! 💕', 'received', 'Sarah_Premium', 'premium');
                }, 1500);
            }
        }

        function buyPremium() {
            if (selectedPremiumPackage) {
                isPremiumUser = true;
                closeModal('premiumModal');
                showNotification(`Premium ${selectedPremiumPackage.type} subscription activated!`, 'tip');
                                
                // Update private chat view if currently viewing
                if (currentChatView === 'private') {
                    showPrivateMessages();
                }
                                
                setTimeout(() => {
                    addMessage('Welcome to Premium! You now have access to private messaging! 💎', 'received', 'Sarah_Premium', 'premium');
                }, 1500);
            }
        }

        function sendGift() {
            if (selectedGift && tokenBalance >= selectedGift.price) {
                tokenBalance -= selectedGift.price;
                updateTokenDisplay();
                addGiftAlert(`You sent a ${selectedGift.name}! 🎁 (${selectedGift.price} tokens)`);
                closeModal('giftModal');
                showNotification(`Gift sent! ${selectedGift.name}`, 'tip');
                                
                setTimeout(() => {
                    addMessage(`Thank you for the beautiful ${selectedGift.name}! 😍💕`, 'received', 'Sarah_Premium', 'premium');
                }, 2000);
            } else {
                showNotification('Not enough tokens! Buy more tokens to send gifts.');
                setTimeout(() => {
                    closeModal('giftModal');
                    openModal('tokensModal');
                }, 1000);
            }
        }

        function sendPrivateRequest() {
            closeModal('privateModal');
            showNotification('Private session request sent! 🔒');
                        
            setTimeout(() => {
                addMessage('I\'d love to go private with you! 😘', 'received', 'Sarah_Premium', 'premium');
            }, 2000);
        }

        function sendGroupRequest() {
            closeModal('groupModal');
            showNotification(`Group session request sent! ${selectedGroupType || 'join'} 👥`);
                        
            setTimeout(() => {
                addMessage('Group session sounds fun! Let\'s do it! 🎉', 'received', 'Sarah_Premium', 'premium');
            }, 2000);
        }

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('show');
                        
            const firstFocusable = modal.querySelector('button, [tabindex="0"], input, textarea, select');
            if (firstFocusable) {
                setTimeout(() => firstFocusable.focus(), 100);
            }
                        
            modal.addEventListener('keydown', trapFocus);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('show');
            modal.removeEventListener('keydown', trapFocus);
                        
            if (modalId === 'tipModal') {
                selectedTip = null;
                document.getElementById('tipMessage').value = '';
                document.querySelectorAll('.tip-item').forEach(item => {
                    item.classList.remove('selected');
                    item.setAttribute('aria-checked', 'false');
                });
                updateTipButton();
            } else if (modalId === 'tokensModal') {
                selectedTokenPackage = null;
                document.querySelectorAll('.tip-item').forEach(item => {
                    item.classList.remove('selected');
                    item.setAttribute('aria-checked', 'false');
                });
                updateTokensButton();
            } else if (modalId === 'premiumModal') {
                selectedPremiumPackage = null;
                document.querySelectorAll('.tip-item').forEach(item => {
                    item.classList.remove('selected');
                    item.setAttribute('aria-checked', 'false');
                });
                updatePremiumButton();
            } else if (modalId === 'giftModal') {
                selectedGift = null;
                document.querySelectorAll('.gift-item').forEach(item => {
                    item.classList.remove('selected');
                    item.setAttribute('aria-checked', 'false');
                });
                updateGiftButton();
            }
        }

        function trapFocus(e) {
            if (e.key === 'Tab') {
                const modal = e.currentTarget;
                const focusableElements = modal.querySelectorAll(
                    'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
                );
                const firstFocusable = focusableElements[0];
                const lastFocusable = focusableElements[focusableElements.length - 1];

                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        e.preventDefault();
                    }
                }
            }
        }

        function showNotification(message, type = 'default') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = 'notification';
                        
            if (type === 'tip') {
                notification.classList.add('tip-notification');
            }
                        
            notification.classList.add('show');
                        
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Close overlays when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.users-overlay') && !e.target.closest('.chat-tab')) {
                if (usersOverlayVisible) {
                    toggleUsersOverlay();
                }
            }
        });

        // Close modals when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Initialize button states
        updateTipButton();
        updateTokensButton();
        updatePremiumButton();
        updateGiftButton();

        // Simulate live activity
        setInterval(() => {
            if (Math.random() < 0.3 && currentChatView === 'all') {
                const randomUser = users[Math.floor(Math.random() * users.length)];
                const messages = [
                    'Looking amazing tonight! ✨',
                    'Love this song! 🎵',
                    'You\'re incredible! 😍',
                    'Best stream ever! 🔥',
                    'So talented! 👏'
                ];
                const message = messages[Math.floor(Math.random() * messages.length)];
                addMessage(message, 'received', randomUser.name, randomUser.type);
            }
        }, 15000);

        // Simulate random tips
        setInterval(() => {
            if (Math.random() < 0.2) {
                const randomUser = users[Math.floor(Math.random() * users.length)];
                const tipAmounts = [25, 50, 100, 250];
                const amount = tipAmounts[Math.floor(Math.random() * tipAmounts.length)];
                totalTips += amount;
                updateTokenDisplay();
                addTipAlert(`${randomUser.name} tipped ${amount} tokens! 💰`, amount >= 250);
            }
        }, 25000);
    </script>
</body>
</html>