<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$usern = $_SESSION["log_user"];
$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
$country_list = DB::query('select id,name,sortname from countries order by name asc');

if ($userDetails) {
} else {
  echo '<script>window.location.href="login.php"</script>';
}


$dob = date('d-m-Y');
if (!empty($userDetails["dob"]) && $userDetails["dob"] != '0000-00-00') {
  $dob = h_dateFormat($userDetails["dob"], 'd-m-Y');
}
$activeTab = 'basic';

$lang_list = modal_language_list();

$extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $_SESSION['log_user_unique_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">

    <title>Chat | The Live Models </title>
    <meta name="description" content="Join The Live Models premium platform to chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide in a trusted community.">
	<link rel="canonical" href="https://thelivemodels.com/" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="Chat, Watch, Meet & Travel | The Live Models">
<meta property="og:description" content="Chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide in a trusted community.">
<meta property="og:url" content="https://thelivemodels.com/">
<meta property="og:image" content="https://thelivemodels.com/assets/images/og-image.jpg">
<meta property="og:site_name" content="The Live Models">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Chat, Watch, Meet & Travel | The Live Models">
<meta name="twitter:description" content="Join The Live Models to chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide.">
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

    <link rel="stylesheet" href="<?= SITEURL ?>assets/css/dropzone.min.css" />

    <link rel="preload" href="<?=SITEURL?>assets/css/profile.css?v=<?=time()?>" as="style" onload="this.onload=null;this.rel='stylesheet'">


     <link rel='stylesheet' href='<?= SITEURL ?>assets/css/chat-app.css?v=<?= time() ?>' onload="this.onload=null;this.rel='stylesheet'" />

</head>
<body class="enhanced5 socialwall-page"> 


  <?php include('includes/side-bar.php'); ?>
  <?php include('includes/profile_header_index.php'); ?>


    <div class="chat-container">
        <!-- Chat Sidebar -->
        <div class="chat-sidebar glass-effect" id="chatSidebar">
            <div class="sidebar-header">
                <div class="user-profile">
                    <div class="user-avatar">S</div>
                    <div class="user-info">
                        <h3>Sophie</h3>
                        <p class="user-status" id="userStatus">Free User</p>
                    </div>
                </div>
                <div class="sidebar-actions">
                    <button class="action-btn" title="New Chat">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="action-btn" title="Settings">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>

            <!-- Added tokens display section -->
            <div class="tokens-display">
                <div class="tokens-info">
                    <div class="token-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <span class="token-count" id="tokenCount">150</span>
                    <span style="font-size: 12px; color: rgba(255, 255, 255, 0.6);">tokens</span>
                </div>
                <button class="add-tokens-btn" onclick="showAddTokensModal()">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>

            <div class="search-container">
                <div style="position: relative;">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search conversations...">
                </div>
            </div>

            <div class="chat-list">
                <div class="chat-item active">
                    <div class="chat-avatar">
                        C
                        <div class="online-indicator"></div>
                    </div>
                    <div class="chat-info">
                        <h4 class="chat-name">CANDICE</h4>
                        <p class="chat-preview">Hey! How are you doing today?</p>
                    </div>
                    <div class="chat-meta">
                        <span class="chat-time">2:30 PM</span>
                        <span class="unread-badge">3</span>
                    </div>
                </div>

                <div class="chat-item">
                    <div class="chat-avatar">K</div>
                    <div class="chat-info">
                        <h4 class="chat-name">KATRINA</h4>
                        <p class="chat-preview">Thanks for the help earlier!</p>
                    </div>
                    <div class="chat-meta">
                        <span class="chat-time">1:45 PM</span>
                    </div>
                </div>

                <div class="chat-item">
                    <div class="chat-avatar">T</div>
                    <div class="chat-info">
                        <h4 class="chat-name">Test114</h4>
                        <p class="chat-preview">hi</p>
                    </div>
                    <div class="chat-meta">
                        <span class="chat-time">12:20 PM</span>
                    </div>
                </div>

                <div class="chat-item">
                    <div class="chat-avatar">
                        T
                        <div class="online-indicator"></div>
                    </div>
                    <div class="chat-info">
                        <h4 class="chat-name">Test115</h4>
                        <p class="chat-preview">Looking forward to our meeting</p>
                    </div>
                    <div class="chat-meta">
                        <span class="chat-time">11:30 AM</span>
                        <span class="unread-badge">1</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Overlay for Mobile -->
        <div class="chat-overlay" id="chatOverlay"></div>

        <!-- Main Chat Area -->
        <div class="chat-main">
            <div class="chat-header glass-effect">
                <div class="chat-header-info">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- Added back button for navigation -->
                    <button class="back-btn" id="backBtn" onclick="goBackToChats()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="chat-header-avatar">C</div>
                    <div class="chat-header-details">
                        <h3>CANDICE</h3>
                        <p class="chat-header-status">Online • Last seen now</p>
                    </div>
                </div>
                <div class="chat-actions">
                    <!-- Added tip button -->
                    <button class="tip-btn" title="Send Tip" onclick="showTipModal()">
                        <i class="fas fa-dollar-sign"></i>
                    </button>
                    <button class="action-btn" title="Voice Call">
                        <i class="fas fa-phone"></i>
                    </button>
                    <button class="action-btn" title="Video Call">
                        <i class="fas fa-video"></i>
                    </button>
                    <button class="action-btn" title="More Options">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>

            <!-- Added template messages for first-time users -->
            <div class="template-messages" id="templateMessages">
                <div class="template-header">Quick start messages:</div>
                <div class="template-buttons">
                    <button class="template-btn" onclick="useTemplate('Hi there! Nice to meet you 😊')">👋 Say Hello</button>
                    <button class="template-btn" onclick="useTemplate('How are you doing today?')">💬 Ask How They Are</button>
                    <button class="template-btn" onclick="useTemplate('What are your hobbies?')">🎯 Ask About Hobbies</button>
                    <button class="template-btn" onclick="useTemplate('Tell me about yourself!')">✨ Get to Know Them</button>
                    <button class="template-btn" onclick="useTemplate('What do you like to do for fun?')">🎉 Ask About Fun</button>
                </div>
            </div>

            <div class="messages-container" id="messagesContainer">
                <div class="message received">
                    <div class="message-avatar">C</div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Hey Sophie! How are you doing today? I hope everything is going well with your projects.
                        </div>
                        <div class="message-time">2:28 PM</div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar">S</div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Hi Candice! I'm doing great, thanks for asking. Just working on some new features for the platform.
                        </div>
                        <div class="message-time">2:29 PM</div>
                    </div>
                </div>

                <div class="message received">
                    <div class="message-avatar">C</div>
                    <div class="message-content">
                        <div class="message-bubble">
                            That sounds exciting! I'd love to hear more about what you're working on. Are you free for a quick call later?
                        </div>
                        <div class="message-time">2:30 PM</div>
                    </div>
                </div>
            </div>

            <!-- Added message restriction UI for free users -->
            <div class="message-restriction" id="messageRestriction" style="display: none;">
                <p class="restriction-text">Free users can send 1 message every 15 minutes</p>
                <div class="timer-display" id="timerDisplay">14:32</div>
                <button class="upgrade-btn" onclick="showUpgradeModal()">Upgrade to Premium</button>
            </div>

            <div class="message-input-container">
                <div class="message-input-wrapper" id="messageInputWrapper">
                    <div class="input-actions">
                        <button class="input-action-btn" title="Attach File">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <button class="input-action-btn" title="Camera">
                            <i class="fas fa-camera"></i>
                        </button>
                        <button class="input-action-btn" title="Emoji">
                            <i class="fas fa-smile"></i>
                        </button>
                    </div>
                    <textarea 
                        class="message-input" 
                        placeholder="Type a message..." 
                        id="messageInput"
                        rows="1"></textarea>
                    <button class="send-btn" id="sendBtn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Added tip modal -->
    <div class="modal-overlay" id="tipModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Send a Tip</h3>
                <p class="modal-subtitle">Show your appreciation to CANDICE</p>
            </div>
            <div class="tip-amounts">
                <div class="tip-amount-btn" onclick="selectTipAmount(5)">
                    <div style="font-weight: 600;">5 Tokens</div>
                    <div style="font-size: 12px; opacity: 0.7;">$0.50</div>
                </div>
                <div class="tip-amount-btn" onclick="selectTipAmount(10)">
                    <div style="font-weight: 600;">10 Tokens</div>
                    <div style="font-size: 12px; opacity: 0.7;">$1.00</div>
                </div>
                <div class="tip-amount-btn" onclick="selectTipAmount(25)">
                    <div style="font-weight: 600;">25 Tokens</div>
                    <div style="font-size: 12px; opacity: 0.7;">$2.50</div>
                </div>
                <div class="tip-amount-btn" onclick="selectTipAmount(50)">
                    <div style="font-weight: 600;">50 Tokens</div>
                    <div style="font-size: 12px; opacity: 0.7;">$5.00</div>
                </div>
                <div class="tip-amount-btn" onclick="selectTipAmount(100)">
                    <div style="font-weight: 600;">100 Tokens</div>
                    <div style="font-size: 12px; opacity: 0.7;">$10.00</div>
                </div>
                <div class="tip-amount-btn" onclick="selectTipAmount(200)">
                    <div style="font-weight: 600;">200 Tokens</div>
                    <div style="font-size: 12px; opacity: 0.7;">$20.00</div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeTipModal()">Cancel</button>
                <button class="modal-btn confirm" onclick="sendTip()">Send Tip</button>
            </div>
        </div>
    </div>

  <?php include('includes/footer.php'); ?>

    <script>
        let userState = {
            isPremium: false,
            tokens: 150,
            lastMessageTime: null,
            messageRestrictionActive: false,
            selectedTipAmount: 5,
            hasUsedTemplates: false
        };

        let restrictionTimer = null;

        function startMessageRestriction() {
            if (userState.isPremium) return;
            
            userState.messageRestrictionActive = true;
            userState.lastMessageTime = Date.now();
            
            const messageInputWrapper = document.getElementById('messageInputWrapper');
            const messageRestriction = document.getElementById('messageRestriction');
            const timerDisplay = document.getElementById('timerDisplay');
            
            messageInputWrapper.classList.add('disabled');
            messageRestriction.style.display = 'block';
            
            let timeLeft = 15 * 60; // 15 minutes in seconds
            
            restrictionTimer = setInterval(() => {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(restrictionTimer);
                    userState.messageRestrictionActive = false;
                    messageInputWrapper.classList.remove('disabled');
                    messageRestriction.style.display = 'none';
                }
            }, 1000);
        }

        function useTemplate(message) {
            const messageInput = document.getElementById('messageInput');
            messageInput.value = message;
            messageInput.focus();
            
            // Hide templates after first use
            if (!userState.hasUsedTemplates) {
                userState.hasUsedTemplates = true;
                setTimeout(() => {
                    document.getElementById('templateMessages').style.display = 'none';
                }, 2000);
            }
        }

        function showTipModal() {
            document.getElementById('tipModal').classList.add('active');
        }

        function closeTipModal() {
            document.getElementById('tipModal').classList.remove('active');
        }

        function selectTipAmount(amount) {
            userState.selectedTipAmount = amount;
            document.querySelectorAll('.tip-amount-btn').forEach(btn => btn.classList.remove('selected'));
            event.target.closest('.tip-amount-btn').classList.add('selected');
        }

        function sendTip() {
            if (userState.tokens >= userState.selectedTipAmount) {
                userState.tokens -= userState.selectedTipAmount;
                document.getElementById('tokenCount').textContent = userState.tokens;
                
                // Add tip message to chat
                const messageElement = document.createElement('div');
                messageElement.className = 'message sent';
                messageElement.innerHTML = `
                    <div class="message-avatar">S</div>
                    <div class="message-content">
                        <div class="message-bubble" style="background: var(--premium-gold); color: #000;">
                            💰 Sent ${userState.selectedTipAmount} tokens as a tip!
                        </div>
                        <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                    </div>
                `;
                document.getElementById('messagesContainer').appendChild(messageElement);
                document.getElementById('messagesContainer').scrollTop = document.getElementById('messagesContainer').scrollHeight;
                
                closeTipModal();
                alert(`Tip of ${userState.selectedTipAmount} tokens sent successfully!`);
            } else {
                alert('Insufficient tokens! Please add more tokens to send a tip.');
            }
        }

        function showAddTokensModal() {
            alert('Add tokens functionality - redirect to payment page');
        }

        function showUpgradeModal() {
            alert('Upgrade to Premium - redirect to subscription page');
        }

        function goBackToChats() {
            // On mobile, show the sidebar
            if (window.innerWidth <= 768) {
                document.getElementById('chatSidebar').classList.remove('hidden');
                document.getElementById('chatOverlay').classList.add('active');
            } else {
                // On desktop, you could implement a different behavior
                // For now, we'll just highlight the chat list
                document.querySelector('.chat-list').style.background = 'rgba(102, 126, 234, 0.1)';
                setTimeout(() => {
                    document.querySelector('.chat-list').style.background = '';
                }, 1000);
            }
        }

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const chatSidebar = document.getElementById('chatSidebar');
        const chatOverlay = document.getElementById('chatOverlay');

        mobileMenuBtn.addEventListener('click', () => {
            chatSidebar.classList.toggle('hidden');
            chatOverlay.classList.toggle('active');
        });

        chatOverlay.addEventListener('click', () => {
            chatSidebar.classList.add('hidden');
            chatOverlay.classList.remove('active');
        });

        // Auto-resize textarea
        const messageInput = document.getElementById('messageInput');
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        const sendBtn = document.getElementById('sendBtn');
        const messagesContainer = document.getElementById('messagesContainer');

        function sendMessage() {
            if (userState.messageRestrictionActive) {
                alert('Please wait for the timer to finish before sending another message.');
                return;
            }

            const message = messageInput.value.trim();
            if (message) {
                const messageElement = document.createElement('div');
                messageElement.className = 'message sent';
                messageElement.innerHTML = `
                    <div class="message-avatar">S</div>
                    <div class="message-content">
                        <div class="message-bubble">${message}</div>
                        <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                    </div>
                `;
                messagesContainer.appendChild(messageElement);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                messageInput.value = '';
                messageInput.style.height = 'auto';

                // Start restriction timer for free users
                if (!userState.isPremium) {
                    startMessageRestriction();
                }
            }
        }

        sendBtn.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Chat item selection
        document.querySelectorAll('.chat-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                
                // Close sidebar on mobile after selection
                if (window.innerWidth <= 768) {
                    chatSidebar.classList.add('hidden');
                    chatOverlay.classList.remove('active');
                }
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.chat-item').forEach(item => {
                const name = item.querySelector('.chat-name').textContent.toLowerCase();
                const preview = item.querySelector('.chat-preview').textContent.toLowerCase();
                if (name.includes(searchTerm) || preview.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            // Show template messages for new users
            if (!userState.hasUsedTemplates) {
                document.getElementById('templateMessages').style.display = 'block';
            }
            
            // Update user status display
            document.getElementById('userStatus').textContent = userState.isPremium ? 'Premium User' : 'Free User';
        });
    </script>
</body>
</html>