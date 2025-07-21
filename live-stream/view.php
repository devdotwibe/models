<?php session_start(); 

include('../includes/config.php');
include('../includes/helper.php');
$error = '';
if (isset($_SESSION['log_user_unique_id'])) {
  $getUserData = get_data('model_social_link', array('unique_model_id' => $_SESSION['log_user_unique_id']), true);

 $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

  if ($getUserData) {
    if (empty($getUserData['i_username'])) {
      $error = 'empty';
    } else if (empty($getUserData['s_username'])) {
      $error = 'empty';
    }
  } else {
    $error = 'empty';
  }
} else {
  $error = 'login';
}
$showMessgeBtn = 0;
if (isset($_SESSION['log_user_unique_id']) && $_GET['unique_model_id']) {
  $showMessgeBtn = h_checkMessageShowBtn($_GET['unique_model_id'], $_SESSION['log_user_unique_id']);
}
$session_id = $_GET['unique_model_id'];



?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Elite Streaming Platform</title>
<meta name="description" content="Connect with amazing models for chat, watch and meet experiences. The premier social dating platform for authentic connections.">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
<?php  include('includes/head.php'); ?>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/view.css?v=<?=time()?>' type='text/css' media='all' />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php
if ($_GET["unique_model_id"] == $_SESSION['log_user_unique_id']) {
  $user_page = 'model';
}
else{
  $user_page = 'user';
}

?>
<script>
var userpage = '<?=$user_page?>';
</script>

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

        <div class="main-content">

            <div class="streaming-area" id="streamingArea" role="main" aria-label="Streaming video area">
        
                <div class="heart-rain" id="heartRain" aria-hidden="true"></div>

                <input type="hidden" name="user_id" id="user_id_chat" value="<?php echo $userDetails['id'] ?>">

                <input type="hidden" name="model_id" id="model_id_chat" value="<?php echo $_GET['unique_model_id'] ?>">
                                
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
            <select name="chat_coin" id="chat_coin" style="width: 100%; padding: 10px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: white; margin-bottom: 12px; font-size: 11px; font-family: inherit;" aria-label="Select private session duration">

                <option value="15" >15 minutes - 1,000 tokens</option>
                <option value="30" >30 minutes - 1,800 tokens</option>
                <option value="60" >60 minutes - 3,000 tokens</option>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

            let user_id = $('#user_id_chat').val();
            let model_id =  $('#model_id_chat').val();
            var coin = $('#chat_coin').val();
            var tlm_data = {
                action: 'tlm_private_chat_action',
                key: model_id,
                user: user_id,
                coin : coin,
            }

            if (model_id && model_id != '') {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: tlm_data,
                    beforeSend: function () {
                    },
                    complete: function () {
                    },
                    success: function (response) {
                        if(response=='success'){
                            tlm_private_chat_check();
                        }
                        else{
                            alert(response);
                        }

                    }
                });
            }

            closeModal('privateModal');
            showNotification('Private session request sent! 🔒');
                        
            // setTimeout(() => {
            //     addMessage('I\'d love to go private with you! 😘', 'received', 'Sarah_Premium', 'premium');
            // }, 2000);
        }


        function tlm_private_chat_check() {

            let user_id = $('#user_id_chat').val();
            let model_id =  $('#model_id_chat').val();

            var coin = $('#chat_coin').val();

            var tlm_data = {
                action: 'tlm_private_chat_url_action',
                key: model_id,
                user: user_id,
                coin      : coin,
            }
            if (model_id && model_id != '') {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: tlm_data,
                    beforeSend: function () {
                    },
                    complete: function () {
                    },
                    success: function (response) {
                        if (response.trim() == '"success"') {
                            setTimeout(function () {
                                // window.location.href = "https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id="+model_id+"&pra=private"; 
                            //  $('#tlm_user_private_vidchat').trigger('click');
                            }, 15000);
                        }
                        setTimeout(function () {
                            tlm_private_chat_check();
                        }, 3000);
                        // var total_coin = $('.tlm_show_coins_private_chat').html();
                        // $('.tlm_show_coins_private_chat').html(parseInt(total_coin)-parseInt(coin));
                        // // $('#tlm_close_private_chat_box').trigger('click');
                        // tlm_private_chat_check();
                    }
                });
            }
        }

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
                      
                                $('#tlm_start_private_popup11 .modal-body').html(response.html);
                                $('.private-request').html(response.counts);
                                if(userpage=='user'){
                                    gotoprivate(response.id);
                                }
                            }
                            else {

                                $('.private-request').html('');
                            }
                            setTimeout(function () {
                                tlm_check_url();
                            }, 3000);

                        }
                    });
                }
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