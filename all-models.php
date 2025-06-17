<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');

?>



<!doctype html>

<html lang="en-US" class="no-js">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>All Live Models - Premium Dating & Connection Platform | TheLiveModels.com</title>
    <meta name="description" content="Discover and connect with thousands of verified live models worldwide. Premium dating platform with advanced filters, real-time chat, and authentic connections.">
    <meta name="keywords" content="live models, verified models, premium dating, online dating, model connections, chat with models">
    <meta name="robots" content="index, follow">
    <meta name="author" content="TheLiveModels.com">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="All Live Models - Premium Dating & Connection Platform">
    <meta property="og:description" content="Discover and connect with thousands of verified live models worldwide. Premium dating platform with advanced filters and authentic connections.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://thelivemodels.com/all-models">
    <meta property="og:site_name" content="TheLiveModels.com">
    <meta property="og:image" content="https://thelivemodels.com/images/og-image.jpg">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="All Live Models - Premium Dating & Connection Platform">
    <meta name="twitter:description" content="Discover and connect with thousands of verified live models worldwide.">
    <meta name="twitter:image" content="https://thelivemodels.com/images/twitter-image.jpg">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://thelivemodels.com/all-models">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/stylesheet.css" />
	<?php include('includes/head.php'); ?>
    
    <!-- External Resources -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "All Live Models",
        "description": "Browse and connect with verified live models from around the world",
        "url": "https://thelivemodels.com/all-models",
        "mainEntity": {
            "@type": "ItemList",
            "name": "Live Models Directory",
            "description": "Comprehensive directory of verified live models"
        }
    }
    </script>
</head>



<body class="premimum-model1">

    <?php include('includes/header.php'); ?>


	<!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="profile-grid" id="profileGrid">
			
			<?php 
			$limit = 8; 
			if(isset($_GET['offset'])){
			$offset = $_GET['offset'];
			}else $offset = 0;
			
			$sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes'  Order by id DESC LIMIT $limit OFFSET $offset";

              $resultd = mysqli_query($con, $sqls);

                if (mysqli_num_rows($resultd) > 0) { 
				
				while($rowesdw = mysqli_fetch_assoc($resultd)) {

                     $unique_id = $rowesdw['unique_id'];
					 
					 if(!empty($rowesdw['profile_pic'])){
						 $profile_pic = SITEURL.$rowesdw['profile_pic'];
					 }else{
						 $profile_pic = SITEURL.'assets/images/model-gal-no-img.jpg';
					 }
					 
					 if(!empty($rowesdw['username'])){
						 $modalname = $rowesdw['username'];
					 }else{
						 $modalname = $rowesdw['name'];
					 }
					 
				?>
			
                <!-- Profile Card 1 -->
                <div class="profile-card">
                    <div class="profile-image-container">
                        <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="<?php echo $modalname,', '.$rowesdw['age']; ?>" class="profile-image">
                        <div class="profile-badges">
                            <span class="profile-badge badge-live">Live</span>
                            <span class="profile-badge badge-verified">Verified</span>
                        </div>
                    </div>
                    <div class="profile-info">
                        <h3 class="profile-name"><?php echo $modalname; if(!empty($rowesdw['age'])){ echo ', '.$rowesdw['age']; } ?></h3>
						<?php if(!empty($rowesdw['city']) || !empty($rowesdw['country'])){ ?>
                        <p class="profile-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo $rowesdw['city']; ?><?php if(!empty($rowesdw['city']) && !empty($rowesdw['country'])) { ?>,<?php } ?> <?php echo $rowesdw['country']; ?>
                        </p>
						<?php } if(!empty($rowesdw['user_bio'])){ 
						$user_bio  = limit_text(strip_tags($rowesdw['user_bio']),15).'...';
						?>
                        <p class="profile-bio"><?php echo $user_bio; ?></p>
						<?php } ?>
                    </div>
                    <div class="profile-actions">
                        <button class="action-btn connect" title="Connect">
                            <i class="fas fa-user-plus"></i>
                        </button>
                        <button class="action-btn like" title="Like">
                            <i class="fas fa-heart"></i>
                        </button>
                        <button class="action-btn pass" title="Pass">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

				<?php } ?>

				<?php } else{
					echo '<p class="not-found-model">No models found.</p>';
				} ?>

				<div id="modelContainer"></div>
                
            </div>

            <!-- Load More -->
            <div class="load-more">
                <button class="load-more-btn" id="loadMoreBtn">
                    <i class="fas fa-plus-circle"></i>
                    Load More Profiles
                </button>
                <div class="loading-spinner hidden" id="loadingSpinner"></div>
            </div>
        </div>
    </main>



<?php include('includes/footer.php'); ?>



<script>


let offset = 0;
const limit = 8;

jQuery('#loadMoreBtn').on('click', function($) { alert(1);
   
	
	$.ajax({
                type: 'GET',
                url: "<?php echo SITEURL; ?>load_more_model.php",
                data: offset,
				dataType: 'json',
                success: function(response) {
                    $('#modelContainer').append(response);
					offset += limit;

					if ($.trim(data) === '') {
						$('#loadMoreBtn').hide(); // Hide button if no more data
					}
                }
            }); 
	 
	
	
	
});
</script>


<script>

$(document).on('click', function(e) {
    const $btn = $(e.target).closest('.action-btn');
    if ($btn.length) {
        const action = $btn.hasClass('connect') ? 'connect' :
                       $btn.hasClass('like') ? 'like' : 'pass';
        handleProfileAction($btn, action);
    }
});

// Handle Profile Actions
function handleProfileAction($button, action) {
    // Add visual feedback
    $button.css('transform', 'scale(1.2)');
    setTimeout(() => {
        $button.css('transform', 'scale(1)');
    }, 200);

    const $card = $button.closest('.profile-card');
    const profileName = $card.find('.profile-name').text().split(',')[0];

    switch (action) {
        case 'connect':
            showNotification(`Connection request sent to ${profileName}!`, 'success');
            break;
        case 'like':
            $button.css('color', 'var(--secondary)');
            showNotification(`You liked ${profileName}!`, 'success');
            break;
        case 'pass':
            $card.css('opacity', '0.5');
            setTimeout(() => {
                $card.css('display', 'none');
            }, 300);
            showNotification(`${profileName} has been hidden`, 'info');
            break;
    }

    console.log(`${action} action for ${profileName}`);
}
function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--primary)'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: var(--radius);
                box-shadow: var(--shadow-lg);
                z-index: 10000;
                font-weight: 600;
                transform: translateX(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Hide notification
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
</script>

       
  </body>





</html> 

