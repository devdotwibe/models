<?php session_start(); 

include('../includes/config.php');
include('../includes/helper.php');
$error = '';
if (isset($_SESSION['log_user_id'])) {
  $getUserData = get_data('model_social_link', array('id' => $_SESSION['log_user_id']), true);

 $userDetails = get_data('model_user',array('unique_id'=>$_SESSION["log_user_unique_id"]),true);

} else {

  	echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
		die;
}
$showMessgeBtn = 0;
if (isset($_SESSION['log_user_id']) && $_GET['unique_model_id']) {
  $showMessgeBtn = h_checkMessageShowBtn($_GET['unique_model_id'], $_SESSION['log_user_unique_id']);
}
$session_id = $_GET['unique_model_id'];



?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TLM Model Dashboard - Elite Streaming</title>
<meta name="description" content="Connect with amazing models for chat, watch and meet experiences. The premier social dating platform for authentic connections.">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
<?php  include('includes/head.php'); ?>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/stream.css?v=<?=time()?>' type='text/css' media='all' />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>

<body>
    <div class="dashboard-container">
        <!-- Left Sidebar - Stream Preview -->
        <div class="stream-sidebar" id="streamSidebar">
            <div class="stream-header">
                <div class="model-info">

                <input type="hidden" name="user_id" id="user_id_chat" value="<?php echo $userDetails['id'] . $error ?>">

                <input type="hidden" name="model_id" id="model_id_chat" value="<?php echo $_GET['unique_model_id'] ?>">

                    <div class="model-avatar">S</div>
                    <div class="model-details">
                        <h3>Sarah Elite</h3>
                        <div class="model-status">
                            <div class="live-dot public" id="statusDot"></div>
                            <span id="statusText">Public Show</span>
                        </div>
                    </div>
                </div>

                <div class="stream-stats">
                    <div class="stat-card">
                        <div class="stat-number">5.2K</div>
                        <div class="stat-label">Viewers</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">1.8K</div>
                        <div class="stat-label">Online</div>
                    </div>
                </div>

                <div class="stream-controls">
                    <button class="control-btn primary" onclick="openSettings()">Settings</button>
                    <button class="control-btn secondary">End Stream</button>
                </div>
            </div>

            <div class="stream-preview" id="streamPreview">
                <video class="preview-video" autoplay muted loop>
                    <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4"
                        type="video/mp4">
                    <source src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4" type="video/mp4">
                </video>
                <div class="preview-placeholder" style="display: none;">
                    📹<br>
                    Stream Preview<br>
                    <small>Your live stream appears here</small>
                </div>
                <button class="fullscreen-btn" onclick="toggleFullscreen()" title="Fullscreen">
                    ⛶
                </button>
                <!-- Fullscreen Overlay -->
                <div class="fullscreen-overlay" id="fullscreenOverlay" style="display: none;">
                    <div class="overlay-header">
                        <div class="overlay-title">📊 Stream Overview</div>
                        <button class="overlay-toggle" onclick="toggleFullscreenOverlay()">✕</button>
                    </div>

                    <div class="overlay-section">
                        <div class="overlay-earnings" id="overlayEarnings">4,950 TLM</div>
                    </div>

                    <div class="overlay-section">
                        <div class="overlay-stats">
                            <div class="overlay-stat">
                                <div class="overlay-stat-number" id="overlayViewers">5.2K</div>
                                <div class="overlay-stat-label">Viewers</div>
                            </div>
                            <div class="overlay-stat">
                                <div class="overlay-stat-number" id="overlayRequests">3</div>
                                <div class="overlay-stat-label">Requests</div>
                            </div>
                        </div>
                    </div>

                    <div class="overlay-section">
                        <div class="overlay-section-title">Recent Activity</div>
                        <div class="overlay-recent" id="overlayRecent">
                            <div class="overlay-message tip">
                                <div class="overlay-message-time">2:48 PM</div>
                                <div class="overlay-message-user">Alex_VIP</div>
                                <div class="overlay-message-content">💰 Tipped 2000 TLM</div>
                            </div>
                            <div class="overlay-message new-msg">
                                <div class="overlay-message-time">2:47 PM</div>
                                <div class="overlay-message-user">Emma_Gold</div>
                                <div class="overlay-message-content">Thanks for the show! 💕</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fullscreen Toggle Button (shown when overlay is hidden) -->
                <button class="overlay-toggle-btn" id="overlayToggleBtn" onclick="toggleFullscreenOverlay()"
                    style="display: none;">
                    📊
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-title">💬 Private Messages</div>
                <div class="header-actions">
                    <div class="notification-badge">5 New</div>
                    <div class="earnings-display" onclick="toggleEarningsDisplay()">
                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview%20%281%29-pqXUYJxopemMAuESpbpe5FBDNMVu0u.png"
                            alt="TLM Token" class="tlm-logo">
                        <span id="earningsAmount">4,950 TLM</span>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="messages-area">
                <!-- Conversations List -->
                <div class="conversations-list">
                    <div class="conversations-header">
                        <div class="conversations-title">Private Chats</div>
                        <div class="conversations-count">5</div>
                    </div>

                    <!-- Show Requests -->
                    <div class="show-requests" id="showRequests" style="display:none;">
                        <div class="requests-header">
                            <div class="requests-title">🎭 Show Requests</div>
                            <div class="requests-count" id="requestsCount">3</div>
                        </div>
                        <div id="requestsList">

                        </div>
                    </div>

                    <div class="conversations-scroll">
                        <!-- Active Conversation -->
                        <div class="conversation-item active unread" onclick="selectConversation('alex')">
                            <div class="user-avatar vip">
                                👨
                                <div class="online-indicator public" id="alexIndicator"></div>
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-header">
                                    <div class="user-name">Alex_VIP</div>
                                    <div class="user-badge badge-vip">VIP</div>
                                </div>
                                <div class="message-preview">Hey beautiful! Want to go private? 😘</div>
                                <div class="conversation-meta">
                                    <div class="message-time">2m ago</div>
                                    <div class="unread-count">3</div>
                                </div>
                            </div>
                        </div>
                        <!-- Other Conversations -->
                        <div class="conversation-item unread" onclick="selectConversation('emma')">
                            <div class="user-avatar vip">
                                👸
                                <div class="online-indicator group" id="emmaIndicator"></div>
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-header">
                                    <div class="user-name">Emma_Gold</div>
                                    <div class="user-badge badge-vip">VIP</div>
                                </div>
                                <div class="message-preview">Thanks for the amazing show! 💕</div>
                                <div class="conversation-meta">
                                    <div class="message-time">5m ago</div>
                                    <div class="unread-count">2</div>
                                </div>
                            </div>
                        </div>
                        <div class="conversation-item unread" onclick="selectConversation('david')">
                            <div class="user-avatar premium">
                                🤵
                                <div class="online-indicator private" id="davidIndicator"></div>
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-header">
                                    <div class="user-name">David_Premium</div>
                                    <div class="user-badge badge-premium">Premium</div>
                                </div>
                                <div class="message-preview">You're incredible tonight! 🔥</div>
                                <div class="conversation-meta">
                                    <div class="message-time">8m ago</div>
                                    <div class="unread-count">1</div>
                                </div>
                            </div>
                        </div>
                        <div class="conversation-item" onclick="selectConversation('lisa')">
                            <div class="user-avatar premium">
                                👩‍🦰
                                <div class="online-indicator public" id="lisaIndicator"></div>
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-header">
                                    <div class="user-name">Lisa_Premium</div>
                                    <div class="user-badge badge-premium">Premium</div>
                                </div>
                                <div class="message-preview">Love your energy! ✨</div>
                                <div class="conversation-meta">
                                    <div class="message-time">12m ago</div>
                                </div>
                            </div>
                        </div>
                        <div class="conversation-item" onclick="selectConversation('mike')">
                            <div class="user-avatar regular">
                                👤
                                <div class="online-indicator public" id="mikeIndicator"></div>
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-header">
                                    <div class="user-name">Mike_User</div>
                                </div>
                                <div class="message-preview">Hi there! 👋</div>
                                <div class="conversation-meta">
                                    <div class="message-time">15m ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="chat-area">
                    <div class="chat-header">
                        <div class="chat-user-info">
                            <div class="user-avatar vip">
                                👨
                                <div class="online-indicator public"></div>
                            </div>
                            <div class="chat-user-details">
                                <h4>Alex_VIP</h4>
                                <div class="chat-user-status">
                                    <div class="live-dot public"></div>
                                    <span>Online • VIP Member • Tipped 2,500 TLM today</span>
                                </div>
                            </div>
                        </div>

                        <div class="user-actions">
                            <button class="action-btn favorite active" onclick="toggleFavorite()">
                                ⭐ Favorite
                            </button>
                            <button class="action-btn tip-request" onclick="requestTip()">
                                💰 Request Tip
                            </button>
                            <button class="action-btn ban" onclick="banUser()">
                                ⛔ Ban
                            </button>
                        </div>
                    </div>

                    <div class="chat-messages" id="chatMessages">
                        <!-- Messages will be populated here -->
                        <div class="message received">
                            Hey beautiful! 😍
                            <div class="message-time">2:45 PM</div>
                        </div>

                        <div class="tip-message">
                            💰 Alex_VIP tipped 500 TLM! "You're amazing!"
                        </div>

                        <div class="message received">
                            Want to go private? I have some special requests 😘
                            <div class="message-time">2:46 PM</div>
                        </div>

                        <div class="message sent">
                            Thank you so much for the tip! 💕 I'd love to chat privately with you!
                            <div class="message-time">2:47 PM</div>
                        </div>

                        <div class="message received">
                            Perfect! How much for 30 minutes private?
                            <div class="message-time">2:47 PM</div>
                        </div>

                        <div class="message sent">
                            30 minutes private is 2000 TLM. We can have so much fun! 🔥
                            <div class="message-time">2:48 PM</div>
                        </div>

                        <div class="tip-message">
                            💰 Alex_VIP tipped 2000 TLM! "Let's go private now!"
                        </div>
                    </div>

                    <div class="chat-input">
                        <!-- Custom Templates -->
                        <div class="custom-templates">
                            <div class="template-header">
                                <div class="template-title">My Templates</div>
                                <button class="add-template-btn" onclick="openTemplateModal()">+ Add</button>
                            </div>
                            <div id="customTemplatesList">
                                <!-- Custom templates will be added here -->
                            </div>
                        </div>

                        <div class="quick-actions">
                            <div class="quick-action" onclick="insertQuickMessage('Thank you! 💕')">Thank you! 💕</div>
                            <div class="quick-action" onclick="insertQuickMessage('You\'re so sweet! 😘')">You're so
                                sweet! 😘</div>
                            <div class="quick-action" onclick="insertQuickMessage('Let\'s go private! 🔥')">Let's go
                                private! 🔥</div>
                            <div class="quick-action" onclick="insertQuickMessage('Love you! ❤️')">Love you! ❤️</div>
                        </div>

                        <div class="input-row">
                            <textarea class="message-input" id="messageInput" placeholder="Type your message..."
                                onkeypress="handleKeyPress(event)" rows="1"></textarea>
                            <button class="send-btn" onclick="sendMessage()">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="settings-modal" id="settingsModal">
        <div class="settings-content">
            <div class="settings-header">
                <div class="settings-title">⚙️ Stream Settings</div>
                <button class="close-btn" onclick="closeSettings()">✕</button>
            </div>

            <div class="settings-section">
                <h4>Stream Status</h4>
                <div class="setting-item">
                    <div class="setting-label">Current Show Type</div>
                    <div class="setting-control">
                        <select class="setting-input" onchange="updateShowType(this.value)" id="showTypeSelect">
                            <option value="public">Public Show</option>
                            <option value="group">Group Show</option>
                            <option value="private">Private Show</option>
                        </select>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Stream Quality</div>
                    <div class="setting-control">
                        <select class="setting-input" onchange="updateSetting('stream-quality', this.value)">
                            <option value="1080p">1080p HD</option>
                            <option value="720p" selected>720p HD</option>
                            <option value="480p">480p SD</option>
                        </select>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Bitrate (kbps)</div>
                    <div class="setting-control">
                        <input type="number" class="setting-input" value="2500" min="1000" max="6000"
                            onchange="updateSetting('bitrate', this.value)">
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h4>Show Settings</h4>
                <div class="setting-item">
                    <div class="setting-label">Auto-accept private shows</div>
                    <div class="setting-control">
                        <div class="toggle-switch" onclick="toggleSetting(this)" data-setting="auto-private"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Show viewer count</div>
                    <div class="setting-control">
                        <div class="toggle-switch active" onclick="toggleSetting(this)" data-setting="show-viewers">
                        </div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Enable tip sounds</div>
                    <div class="setting-control">
                        <div class="toggle-switch active" onclick="toggleSetting(this)" data-setting="tip-sounds"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Minimum tip amount</div>
                    <div class="setting-control">
                        <input type="number" class="setting-input" value="10" min="1" max="1000"
                            onchange="updateSetting('min-tip', this.value)"> TLM
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h4>Privacy Settings</h4>
                <div class="setting-item">
                    <div class="setting-label">Block anonymous users</div>
                    <div class="setting-control">
                        <div class="toggle-switch" onclick="toggleSetting(this)" data-setting="block-anon"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Require tokens to PM</div>
                    <div class="setting-control">
                        <div class="toggle-switch active" onclick="toggleSetting(this)" data-setting="require-tokens">
                        </div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Private show rate (TLM/min)</div>
                    <div class="setting-control">
                        <input type="number" class="setting-input" value="60" min="10" max="500"
                            onchange="updateSetting('private-rate', this.value)">
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h4>Notification Settings</h4>
                <div class="setting-item">
                    <div class="setting-label">New message notifications</div>
                    <div class="setting-control">
                        <div class="toggle-switch active" onclick="toggleSetting(this)"
                            data-setting="msg-notifications"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Tip notifications</div>
                    <div class="setting-control">
                        <div class="toggle-switch active" onclick="toggleSetting(this)"
                            data-setting="tip-notifications"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-label">Show request notifications</div>
                    <div class="setting-control">
                        <div class="toggle-switch active" onclick="toggleSetting(this)"
                            data-setting="show-notifications"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Modal -->
    <div class="template-modal" id="templateModal">
        <div class="template-modal-content">
            <h3>Add Custom Template</h3>
            <input type="text" class="template-input" id="templateInput" placeholder="Enter your message template..."
                maxlength="100">
            <div class="template-actions">
                <button class="template-action-btn save" onclick="saveTemplate()">Save</button>
                <button class="template-action-btn cancel" onclick="closeTemplateModal()">Cancel</button>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        let currentConversation = 'alex';
        let customTemplates = [];
        let showRequests = [
            { user: 'Alex_VIP', type: 'Private Show - 30min', id: 'alex_private' },
            { user: 'Emma_Gold', type: 'Group Show', id: 'emma_group' },
            { user: 'David_Premium', type: 'Private Show - 15min', id: 'david_private' }
        ];
        let showTokens = true; // Toggle between tokens and dollars
        let totalTokens = 4950;
        let tokenRate = 0.05; // $0.05 per token
        let currentShowType = 'public'; // public, group, private

        let conversations = {
            alex: {
                name: 'Alex_VIP',
                type: 'vip',
                avatar: '👨',
                online: true,
                favorite: true,
                tokensToday: 2500,
                showType: 'public',
                messages: [
                    { type: 'received', content: 'Hey beautiful! 😍', time: '2:45 PM' },
                    { type: 'tip', content: '💰 Alex_VIP tipped 500 TLM! "You\'re amazing!"' },
                    { type: 'received', content: 'Want to go private? I have some special requests 😘', time: '2:46 PM' },
                    { type: 'sent', content: 'Thank you so much for the tip! 💕 I\'d love to chat privately with you!', time: '2:47 PM' },
                    { type: 'received', content: 'Perfect! How much for 30 minutes private?', time: '2:47 PM' },
                    { type: 'sent', content: '30 minutes private is 2000 TLM. We can have so much fun! 🔥', time: '2:48 PM' },
                    { type: 'tip', content: '💰 Alex_VIP tipped 2000 TLM! "Let\'s go private now!"' }
                ]
            },
            emma: {
                name: 'Emma_Gold',
                type: 'vip',
                avatar: '👸',
                online: true,
                favorite: false,
                tokensToday: 1250,
                showType: 'group',
                messages: [
                    { type: 'received', content: 'Thanks for the amazing show! 💕', time: '2:40 PM' },
                    { type: 'tip', content: '💰 Emma_Gold tipped 250 TLM!' },
                    { type: 'received', content: 'You always make my day better! 🥰', time: '2:41 PM' }
                ]
            },
            david: {
                name: 'David_Premium',
                type: 'premium',
                avatar: '🤵',
                online: true,
                favorite: false,
                tokensToday: 800,
                showType: 'private',
                messages: [
                    { type: 'received', content: 'You\'re incredible tonight! 🔥', time: '2:35 PM' },
                    { type: 'sent', content: 'Thank you so much! You\'re so sweet! 😘', time: '2:36 PM' }
                ]
            },
            lisa: {
                name: 'Lisa_Premium',
                type: 'premium',
                avatar: '👩‍🦰',
                online: true,
                favorite: true,
                tokensToday: 600,
                showType: 'public',
                messages: [
                    { type: 'received', content: 'Love your energy! ✨', time: '2:30 PM' },
                    { type: 'sent', content: 'Aww thank you! You always brighten my day! 💕', time: '2:31 PM' }
                ]
            },
            mike: {
                name: 'Mike_User',
                type: 'regular',
                avatar: '👤',
                online: true,
                favorite: false,
                tokensToday: 100,
                showType: 'public',
                messages: [
                    { type: 'received', content: 'Hi there! 👋', time: '2:25 PM' },
                    { type: 'sent', content: 'Hello! Welcome to my room! 😊', time: '2:26 PM' }
                ]
            }
        };

        // Settings storage
        let settings = {
            'stream-quality': '720p',
            'bitrate': 2500,
            'auto-private': false,
            'show-viewers': true,
            'tip-sounds': true,
            'min-tip': 10,
            'block-anon': false,
            'require-tokens': true,
            'private-rate': 60,
            'msg-notifications': true,
            'tip-notifications': true,
            'show-notifications': true
        };

        // Update show type and status colors
        function updateShowType(type) {
            currentShowType = type;
            const statusDot = document.getElementById('statusDot');
            const statusText = document.getElementById('statusText');

            // Update main status
            statusDot.className = `live-dot ${type}`;

            switch (type) {
                case 'public':
                    statusText.textContent = 'Public Show';
                    break;
                case 'group':
                    statusText.textContent = 'Group Show';
                    break;
                case 'private':
                    statusText.textContent = 'Private Show';
                    break;
            }

            showNotification(`Show type changed to ${type}`);
        }

        // Earnings toggle functionality
        function toggleEarningsDisplay() {
            showTokens = !showTokens;
            const earningsElement = document.getElementById('earningsAmount');

            if (showTokens) {
                earningsElement.textContent = `${totalTokens.toLocaleString()} TLM`;
            } else {
                const dollarAmount = (totalTokens * tokenRate).toFixed(2);
                earningsElement.textContent = `$${dollarAmount}`;
            }
        }

        // Improved mobile fullscreen handling
        function toggleFullscreen() {
            const streamSidebar = document.getElementById('streamSidebar');
            const streamPreview = document.getElementById('streamPreview');
            const fullscreenBtn = streamPreview.querySelector('.fullscreen-btn');

            if (streamSidebar.classList.contains('fullscreen')) {
                streamSidebar.classList.remove('fullscreen');
                fullscreenBtn.innerHTML = '⛶';
                fullscreenBtn.title = 'Fullscreen';

                // Hide overlay
                document.getElementById('fullscreenOverlay').style.display = 'none';
                document.getElementById('overlayToggleBtn').style.display = 'none';

                // Exit browser fullscreen on mobile
                if (document.exitFullscreen) {
                    document.exitFullscreen().catch(() => { });
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            } else {
                streamSidebar.classList.add('fullscreen');
                fullscreenBtn.innerHTML = '⛷';
                fullscreenBtn.title = 'Exit Fullscreen';

                // Show overlay
                updateFullscreenOverlay();

                // Request browser fullscreen on mobile for better experience
                if (streamSidebar.requestFullscreen) {
                    streamSidebar.requestFullscreen().catch(() => { });
                } else if (streamSidebar.webkitRequestFullscreen) {
                    streamSidebar.webkitRequestFullscreen();
                } else if (streamSidebar.msRequestFullscreen) {
                    streamSidebar.msRequestFullscreen();
                }
            }
        }

        // Settings functionality
        function openSettings() {
            document.getElementById('settingsModal').style.display = 'flex';
        }

        function closeSettings() {
            document.getElementById('settingsModal').style.display = 'none';
        }

        function toggleSetting(element) {
            element.classList.toggle('active');
            const settingKey = element.getAttribute('data-setting');
            if (settingKey) {
                settings[settingKey] = element.classList.contains('active');
                showNotification(`Setting updated: ${settingKey}`);
            }
        }

        function updateSetting(key, value) {
            settings[key] = value;
            showNotification(`${key} updated to ${value}`);
        }

        // Show requests functionality
        function acceptRequest(userId, type) {
            const conversation = conversations[userId];
            const userName = conversation ? conversation.name : userId;
            showNotification(`✅ ${type} request from ${userName} accepted!`);
            removeRequest(userId + '_' + type);

            // Update show type if accepting a request
            if (type === 'private') {
                updateShowType('private');
                document.getElementById('showTypeSelect').value = 'private';
            } else if (type === 'group') {
                updateShowType('group');
                document.getElementById('showTypeSelect').value = 'group';
            }
        }

        function declineRequest(userId, type) {
            const conversation = conversations[userId];
            const userName = conversation ? conversation.name : userId;
            showNotification(`❌ ${type} request from ${userName} declined.`);
            removeRequest(userId + '_' + type);
        }

        function removeRequest(requestId) {
            showRequests = showRequests.filter(req => req.id !== requestId);
            updateRequestsDisplay();
        }

        // function updateRequestsDisplay() {
        //     const requestsCount = document.getElementById('requestsCount');
        //     const requestsList = document.getElementById('requestsList');

        //     requestsCount.textContent = showRequests.length;

        //     if (showRequests.length === 0) {
        //         document.getElementById('showRequests').style.display = 'none';
        //     } else {
        //         requestsList.innerHTML = '';
        //         showRequests.forEach(request => {
        //             const requestDiv = document.createElement('div');
        //             requestDiv.className = 'request-item';
        //             requestDiv.innerHTML = `
        //                 <div>
        //                     <div class="request-user">${request.user}</div>
        //                     <div class="request-type">${request.type}</div>
        //                 </div>
        //                 <div class="request-actions">
        //                     <button class="request-btn accept" onclick="acceptRequest('${request.id.split('_')[0]}', '${request.id.split('_')[1]}')">✓</button>
        //                     <button class="request-btn decline" onclick="declineRequest('${request.id.split('_')[0]}', '${request.id.split('_')[1]}')">✗</button>
        //                 </div>
        //             `;
        //             requestsList.appendChild(requestDiv);
        //         });
        //     }
        // }

        // Template functionality
        function openTemplateModal() {
            document.getElementById('templateModal').style.display = 'flex';
            document.getElementById('templateInput').focus();
        }

        function closeTemplateModal() {
            document.getElementById('templateModal').style.display = 'none';
            document.getElementById('templateInput').value = '';
        }

        function saveTemplate() {
            const input = document.getElementById('templateInput');
            const template = input.value.trim();

            if (template && template.length > 0) {
                customTemplates.push(template);
                updateCustomTemplates();
                closeTemplateModal();
                showNotification('✅ Template saved!');
            }
        }

        function updateCustomTemplates() {
            const container = document.getElementById('customTemplatesList');
            container.innerHTML = '';

            customTemplates.forEach((template, index) => {
                const templateDiv = document.createElement('div');
                templateDiv.className = 'custom-template-item';
                templateDiv.innerHTML = `
                    <div class="template-text" onclick="insertQuickMessage('${template.replace(/'/g, "\\'")}')">${template}</div>
                    <button class="delete-template" onclick="deleteTemplate(${index})">✕</button>
                `;
                container.appendChild(templateDiv);
            });
        }

        function deleteTemplate(index) {
            customTemplates.splice(index, 1);
            updateCustomTemplates();
            showNotification('🗑️ Template deleted');
        }

        function selectConversation(userId) {
            currentConversation = userId;

            // Update active conversation in list
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            event.currentTarget.classList.remove('unread');

            // Update unread count
            const unreadBadge = event.currentTarget.querySelector('.unread-count');
            if (unreadBadge) {
                unreadBadge.remove();
            }

            // Load conversation
            loadConversation(userId);
        }

        function loadConversation(userId) {
            const conversation = conversations[userId];
            if (!conversation) return;

            // Update chat header
            const chatHeader = document.querySelector('.chat-header');
            const userInfo = chatHeader.querySelector('.chat-user-info');
            const userActions = chatHeader.querySelector('.user-actions');

            // Update status indicator based on show type
            const statusClass = conversation.showType || 'public';

            userInfo.innerHTML = `
                <div class="user-avatar ${conversation.type}">
                    ${conversation.avatar}
                    ${conversation.online ? `<div class="online-indicator ${statusClass}"></div>` : ''}
                </div>
                <div class="chat-user-details">
                    <h4>${conversation.name}</h4>
                    <div class="chat-user-status">
                        ${conversation.online ? `<div class="live-dot ${statusClass}"></div>` : ''}
                        <span>${conversation.online ? 'Online' : 'Offline'} • ${conversation.type.toUpperCase()} Member • Tipped ${conversation.tokensToday} TLM today</span>
                    </div>
                </div>
            `;

            // Update favorite button
            const favoriteBtn = userActions.querySelector('.favorite');
            if (conversation.favorite) {
                favoriteBtn.classList.add('active');
                favoriteBtn.innerHTML = '⭐ Favorite';
            } else {
                favoriteBtn.classList.remove('active');
                favoriteBtn.innerHTML = '☆ Add Favorite';
            }

            // Load messages
            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = '';

            conversation.messages.forEach(message => {
                const messageDiv = document.createElement('div');

                if (message.type === 'tip') {
                    messageDiv.className = 'tip-message';
                    messageDiv.textContent = message.content;
                } else {
                    messageDiv.className = `message ${message.type}`;
                    messageDiv.innerHTML = `
                        ${message.content}
                        <div class="message-time">${message.time}</div>
                    `;
                }

                messagesContainer.appendChild(messageDiv);
            });

            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function toggleFavorite() {
            const conversation = conversations[currentConversation];
            conversation.favorite = !conversation.favorite;

            const favoriteBtn = document.querySelector('.action-btn.favorite');
            if (conversation.favorite) {
                favoriteBtn.classList.add('active');
                favoriteBtn.innerHTML = '⭐ Favorite';
                showNotification(`${conversation.name} added to favorites!`);
            } else {
                favoriteBtn.classList.remove('active');
                favoriteBtn.innerHTML = '☆ Add Favorite';
                showNotification(`${conversation.name} removed from favorites.`);
            }
        }

        function requestTip() {
            const conversation = conversations[currentConversation];
            showNotification(`Tip request sent to ${conversation.name}!`);

            // Add message to conversation
            const newMessage = {
                type: 'sent',
                content: 'Hey sweetie! Would you like to send me a tip? 💕',
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            };

            conversation.messages.push(newMessage);
            loadConversation(currentConversation);
        }

        function banUser() {
            const conversation = conversations[currentConversation];
            if (confirm(`Are you sure you want to ban ${conversation.name}? This will remove them from your room permanently.`)) {
                showNotification(`${conversation.name} has been banned from your room.`);
                // In a real app, this would remove the user completely
            }
        }

        function insertQuickMessage(message) {
            const input = document.getElementById('messageInput');
            input.value = message;
            input.focus();
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

            if (message) {
                const conversation = conversations[currentConversation];
                const newMessage = {
                    type: 'sent',
                    content: message,
                    time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                };

                conversation.messages.push(newMessage);
                input.value = '';
                loadConversation(currentConversation);

                // Simulate user response after a delay
                setTimeout(() => {
                    const responses = [
                        'Thank you beautiful! 💕',
                        'You\'re so sweet! 😘',
                        'Love chatting with you! ❤️',
                        'You always make me smile! 😊',
                        'Can\'t wait for our private time! 🔥'
                    ];

                    const response = responses[Math.floor(Math.random() * responses.length)];
                    const responseMessage = {
                        type: 'received',
                        content: response,
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                    };

                    conversation.messages.push(responseMessage);
                    loadConversation(currentConversation);
                }, 1000 + Math.random() * 2000);
            }
        }

        function showNotification(message) {
            // Create a simple notification
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 600;
                z-index: 1000;
                animation: slideIn 0.3s ease-out;
                max-width: 300px;
                word-wrap: break-word;
            `;

            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out forwards';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Add CSS for notification animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Auto-resize textarea
        document.getElementById('messageInput').addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 80) + 'px';
        });

        // Close modals when clicking outside
        document.getElementById('settingsModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeSettings();
            }
        });

        document.getElementById('templateModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeTemplateModal();
            }
        });

        // Handle escape key to close modals
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeSettings();
                closeTemplateModal();
            }
        });

        // Add these new functions after the existing conversation functions

        function moveConversationToFront(userId) {
            const conversationElement = document.querySelector(`[onclick="selectConversation('${userId}')"]`);
            const conversationsContainer = document.querySelector('.conversations-scroll');

            if (conversationElement && conversationsContainer) {
                // Add new message highlighting
                conversationElement.classList.add('new-message');

                // Move to front
                conversationsContainer.insertBefore(conversationElement, conversationsContainer.firstChild);

                // Scroll to show the new conversation on mobile
                if (window.innerWidth <= 768) {
                    conversationsContainer.scrollLeft = 0;
                }

                // Remove highlighting after 5 seconds
                setTimeout(() => {
                    conversationElement.classList.remove('new-message');
                }, 5000);

                // Show notification
                const conversation = conversations[userId];
                showNotification(`💬 New message from ${conversation.name}!`);
            }
        }

        function simulateNewMessage(userId, message) {
            const conversation = conversations[userId];
            if (!conversation) return;

            // Add new message to conversation
            const newMessage = {
                type: 'received',
                content: message,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            };

            conversation.messages.push(newMessage);

            // Add to recent activity
            addToRecentActivity('message', conversation.name, message, true);

            // Update conversation preview
            const conversationElement = document.querySelector(`[onclick="selectConversation('${userId}')"]`);
            if (conversationElement) {
                const messagePreview = conversationElement.querySelector('.message-preview');
                const messageTime = conversationElement.querySelector('.message-time');
                const unreadCount = conversationElement.querySelector('.unread-count');

                if (messagePreview) messagePreview.textContent = message;
                if (messageTime) messageTime.textContent = 'now';

                // Add or update unread count
                if (unreadCount) {
                    const currentCount = parseInt(unreadCount.textContent) || 0;
                    unreadCount.textContent = currentCount + 1;
                } else {
                    const unreadBadge = document.createElement('div');
                    unreadBadge.className = 'unread-count';
                    unreadBadge.textContent = '1';
                    conversationElement.querySelector('.conversation-meta').appendChild(unreadBadge);
                }

                // Add unread class
                conversationElement.classList.add('unread');
            }

            // Move to front and highlight
            moveConversationToFront(userId);

            // If this conversation is currently active, update the chat
            if (currentConversation === userId) {
                loadConversation(userId);
            }
        }

        // Update the tip simulation to add to recent activity
        setInterval(() => {
            if (Math.random() < 0.3) { // 30% chance every 30 seconds
                const tipAmount = Math.floor(Math.random() * 500) + 50;
                const users = ['Alex_VIP', 'Emma_Gold', 'David_Premium', 'Lisa_Premium'];
                const randomUser = users[Math.floor(Math.random() * users.length)];

                totalTokens += tipAmount;

                // Add to recent activity
                addToRecentActivity('tip', randomUser, `💰 Tipped ${tipAmount} TLM`);

                // Update earnings display
                const earningsElement = document.getElementById('earningsAmount');
                if (showTokens) {
                    earningsElement.textContent = `${totalTokens.toLocaleString()} TLM`;
                } else {
                    const dollarAmount = (totalTokens * tokenRate).toFixed(2);
                    earningsElement.textContent = `$${dollarAmount}`;
                }

                // Update overlay if visible
                updateOverlayData();

                showNotification(`💰 New tip received: ${tipAmount} TLM!`);
            }
        }, 30000);

        let overlayVisible = true;
        let recentActivity = [];

        function toggleFullscreenOverlay() {
            const overlay = document.getElementById('fullscreenOverlay');
            const toggleBtn = document.getElementById('overlayToggleBtn');

            overlayVisible = !overlayVisible;

            if (overlayVisible) {
                overlay.classList.remove('hidden');
                toggleBtn.style.display = 'none';
            } else {
                overlay.classList.add('hidden');
                toggleBtn.style.display = 'block';
            }
        }

        function updateFullscreenOverlay() {
            const overlay = document.getElementById('fullscreenOverlay');
            const isFullscreen = document.getElementById('streamSidebar').classList.contains('fullscreen');

            if (isFullscreen) {
                overlay.style.display = 'block';
                updateOverlayData();
            } else {
                overlay.style.display = 'none';
            }
        }

        function updateOverlayData() {
            // Update earnings
            const overlayEarnings = document.getElementById('overlayEarnings');
            if (showTokens) {
                overlayEarnings.textContent = `${totalTokens.toLocaleString()} TLM`;
            } else {
                overlayEarnings.textContent = `$${(totalTokens * tokenRate).toFixed(2)}`;
            }

            // Update stats
            document.getElementById('overlayViewers').textContent = '5.2K';
            document.getElementById('overlayRequests').textContent = showRequests.length;

            // Update recent activity
            updateRecentActivity();
        }

        function addToRecentActivity(type, user, content, isNew = false) {
            const activity = {
                type: type, // 'tip', 'message', 'request'
                user: user,
                content: content,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                isNew: isNew
            };

            recentActivity.unshift(activity);

            // Keep only last 10 activities
            if (recentActivity.length > 10) {
                recentActivity = recentActivity.slice(0, 10);
            }

            updateRecentActivity();

            // Show fullscreen notification if in fullscreen
            if (document.getElementById('streamSidebar').classList.contains('fullscreen')) {
                showFullscreenNotification(type, user, content);
            }
        }

        function updateRecentActivity() {
            const container = document.getElementById('overlayRecent');
            container.innerHTML = '';

            recentActivity.slice(0, 6).forEach(activity => {
                const activityDiv = document.createElement('div');
                let className = 'overlay-message';

                if (activity.type === 'tip') {
                    className += ' tip';
                } else if (activity.isNew) {
                    className += ' new-msg';
                }

                activityDiv.className = className;
                activityDiv.innerHTML = `
            <div class="overlay-message-time">${activity.time}</div>
            <div class="overlay-message-user">${activity.user}</div>
            <div class="overlay-message-content">${activity.content}</div>
        `;

                container.appendChild(activityDiv);
            });
        }

        function showFullscreenNotification(type, user, content) {
            const notification = document.createElement('div');
            let className = 'fullscreen-notification';
            let message = '';

            if (type === 'tip') {
                className += ' tip';
                message = `💰 ${user}: ${content}`;
            } else if (type === 'message') {
                className += ' message';
                message = `💬 ${user}: ${content}`;
            } else if (type === 'request') {
                className += ' message';
                message = `🎭 ${user}: ${content}`;
            }

            notification.className = className;
            notification.textContent = message;

            const streamPreview = document.getElementById('streamPreview');
            streamPreview.appendChild(notification);

            // Remove notification after 4 seconds
            setTimeout(() => {
                notification.style.animation = 'fullscreenNotificationSlide 0.5s ease-out reverse';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 500);
            }, 4000);
        }

        // Update the existing toggleFullscreen function to show/hide overlay
        function toggleFullscreen() {
            const streamSidebar = document.getElementById('streamSidebar');
            const streamPreview = document.getElementById('streamPreview');
            const fullscreenBtn = streamPreview.querySelector('.fullscreen-btn');

            if (streamSidebar.classList.contains('fullscreen')) {
                streamSidebar.classList.remove('fullscreen');
                fullscreenBtn.innerHTML = '⛶';
                fullscreenBtn.title = 'Fullscreen';

                // Hide overlay
                document.getElementById('fullscreenOverlay').style.display = 'none';
                document.getElementById('overlayToggleBtn').style.display = 'none';

                // Exit browser fullscreen on mobile
                if (document.exitFullscreen) {
                    document.exitFullscreen().catch(() => { });
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            } else {
                streamSidebar.classList.add('fullscreen');
                fullscreenBtn.innerHTML = '⛷';
                fullscreenBtn.title = 'Exit Fullscreen';

                // Show overlay
                updateFullscreenOverlay();

                // Request browser fullscreen on mobile for better experience
                if (streamSidebar.requestFullscreen) {
                    streamSidebar.requestFullscreen().catch(() => { });
                } else if (streamSidebar.webkitRequestFullscreen) {
                    streamSidebar.webkitRequestFullscreen();
                } else if (streamSidebar.msRequestFullscreen) {
                    streamSidebar.msRequestFullscreen();
                }
            }
        }

        // Update the existing simulateNewMessage function to add to recent activity
        function simulateNewMessage(userId, message) {
            const conversation = conversations[userId];
            if (!conversation) return;

            // Add new message to conversation
            const newMessage = {
                type: 'received',
                content: message,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            };

            conversation.messages.push(newMessage);

            // Add to recent activity
            addToRecentActivity('message', conversation.name, message, true);

            // Update conversation preview
            const conversationElement = document.querySelector(`[onclick="selectConversation('${userId}')"]`);
            if (conversationElement) {
                const messagePreview = conversationElement.querySelector('.message-preview');
                const messageTime = conversationElement.querySelector('.message-time');
                const unreadCount = conversationElement.querySelector('.unread-count');

                if (messagePreview) messagePreview.textContent = message;
                if (messageTime) messageTime.textContent = 'now';

                // Add or update unread count
                if (unreadCount) {
                    const currentCount = parseInt(unreadCount.textContent) || 0;
                    unreadCount.textContent = currentCount + 1;
                } else {
                    const unreadBadge = document.createElement('div');
                    unreadBadge.className = 'unread-count';
                    unreadBadge.textContent = '1';
                    conversationElement.querySelector('.conversation-meta').appendChild(unreadBadge);
                }

                // Add unread class
                conversationElement.classList.add('unread');
            }

            // Move to front and highlight
            moveConversationToFront(userId);

            // If this conversation is currently active, update the chat
            if (currentConversation === userId) {
                loadConversation(userId);
            }
        }

        // Update the tip simulation to add to recent activity
        setInterval(() => {
            if (Math.random() < 0.3) { // 30% chance every 30 seconds
                const tipAmount = Math.floor(Math.random() * 500) + 50;
                const users = ['Alex_VIP', 'Emma_Gold', 'David_Premium', 'Lisa_Premium'];
                const randomUser = users[Math.floor(Math.random() * users.length)];

                totalTokens += tipAmount;

                // Add to recent activity
                addToRecentActivity('tip', randomUser, `💰 Tipped ${tipAmount} TLM`);

                // Update earnings display
                const earningsElement = document.getElementById('earningsAmount');
                if (showTokens) {
                    earningsElement.textContent = `${totalTokens.toLocaleString()} TLM`;
                } else {
                    const dollarAmount = (totalTokens * tokenRate).toFixed(2);
                    earningsElement.textContent = `$${dollarAmount}`;
                }

                // Update overlay if visible
                updateOverlayData();

                showNotification(`💰 New tip received: ${tipAmount} TLM!`);
            }
        }, 30000);

        // Update the DOMContentLoaded event listener
        document.addEventListener('DOMContentLoaded', function () {
            loadConversation('alex');

            // Handle video error fallback
            const video = document.querySelector('.preview-video');
            const placeholder = document.querySelector('.preview-placeholder');

            video.addEventListener('error', function () {
                video.style.display = 'none';
                placeholder.style.display = 'block';
            });

            video.addEventListener('loadeddata', function () {
                placeholder.style.display = 'none';
                video.style.display = 'block';
            });

            // Set initial show type
            document.getElementById('showTypeSelect').value = currentShowType;
            updateRequestsDisplay();
            updateCustomTemplates();

            // Start demo after 10 seconds
            setTimeout(() => {
                showNotification('💡 Demo: New messages will appear and move to front automatically');
            }, 10000);
        });

        // Simulate periodic tip notifications
        setInterval(() => {
            if (Math.random() < 0.3) { // 30% chance every 30 seconds
                const tipAmount = Math.floor(Math.random() * 500) + 50;
                totalTokens += tipAmount;

                // Update earnings display
                const earningsElement = document.getElementById('earningsAmount');
                if (showTokens) {
                    earningsElement.textContent = `${totalTokens.toLocaleString()} TLM`;
                } else {
                    const dollarAmount = (totalTokens * tokenRate).toFixed(2);
                    earningsElement.textContent = `$${dollarAmount}`;
                }

                showNotification(`💰 New tip received: ${tipAmount} TLM!`);
            }
        }, 30000);
    </script>

    <script>

        $(function() {
        
            tlm_check_url();

        });

        function tlm_check_url() {

            let user_id = $('#user_id_chat').val();
            let model_id =  $('#model_id_chat').val();

            var coin = $('#chat_coin').val();

                var tlm_data = {
                    action: 'tlm_check_url_action',
                    key: model_id,
                    user: user_id,
                    coin      : coin,
                }
                if (model_id && model_id != '') {
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        data: tlm_data,
                        dataType: 'json',
                        beforeSend: function () {
                        },
                        complete: function () {
                        },
                        success: function (response) {
                  
                            if (response.status == 'ok') {
                      
                                $('#requestsCount').text(response.counts);

                                if(response.counts > 0)
                                {
                                    $('#showRequests').show();
                                }
                                else
                                {
                                    $('#showRequests').hide();
                                }

                                response.html.forEach(function (item) {
                                    if ($('#request-' + item.id).length === 0) {
                                        var html = `
                                            <div class="request-item" id="request-${item.id}">
                                                <div>
                                                    <div class="request-user">${item.username}</div>
                                                    <div class="request-type">Private Show - 30min</div>
                                                </div>
                                                <div class="request-actions">
                                                    <button class="request-btn accept"
                                                        onclick="set_confirm_private_chat(${item.id}, 'accept');">✓</button>
                                                    <button class="request-btn decline"
                                                        onclick="set_confirm_private_chat(${item.id}, 'decline');">✗</button>
                                                </div>
                                            </div>
                                        `;
                                        $('#requestsList').append(html);
                                    }
                                });

                                // if(userpage=='user'){
                                //     gotoprivate(response.id);
                                // }
                            }
                        
                            setTimeout(function () {
                                tlm_check_url();
                            }, 3000);

                        }
                    });
                }
        }


        function set_confirm_private_chat(id,type) {

            $.ajax({
                url: 'ajax_act_private_chat.php',
                type: 'GET',
                data: {
                id: id,
                type:type
                },
                dataType: 'json',
                success: function(response) {
                if(response.status=='ok'){
                    if(type=='accept'){
                    window.location='<?=SITEURL.'live-stream/stream.php?user=streamer&pra=private&unique_model_id='.$_SESSION['log_user_unique_id'].'&private_id='?>'+id;
                    }
                }
                else{
                    alert(response.message);
                }
                }
            });

        }

    </script>


</body>

</html>