<?php 
  session_start(); 
  include('../includes/config.php');
  include('../includes/helper.php');
$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
	$id= 0;
	//create post data
	if($_GET['id']){
		$id= $_GET['id'];
		$form_data = DB::queryFirstRow("select tb.*,mu.age,mu.user_bio,mu.user_current_status from banners tb join model_user mu on mu.id=tb.user_id		
		 where tb.id='".$id."' ");
		if($form_data){
		}
		else{
			header("Location: ".SITEURL."advertisements");
		}
	}
	else{
		header("Location: ".SITEURL."advertisements");
	}
	
					$rowes1 = '';
					$userDetails = get_data('model_user', array('id' => $form_data['user_id']), true);
					$sql1 = "SELECT * FROM model_extra_details WHERE unique_model_id = '" . $userDetails['unique_id'] . "'";
					$result1 = mysqli_query($con, $sql1);
					if (mysqli_num_rows($result1) > 0) {
						$rowes1 = mysqli_fetch_assoc($result1);
					}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $form_data['name']; ?> - Premium Fashion Model | Live Models</title>
    <meta name="description" content="View details about Aria Moonlight, elite fashion model and influencer specializing in luxury brands and high-end campaigns.">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/stylesheet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<?php include('../includes/head.php'); ?>
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <style type="text/css">
  	
body .owl-carousel.owl-loading {
    opacity: 1;
    display: block;
    text-align: center;
}
.framebox{
    width: 95%;
    margin: auto;
    padding-top: 10px;
}
.owl-prev,.owl-next{
font-size: 30px;
/*background: rgb(166, 166, 255);*/
color: white;
border: 0;
margin: 7px;
}

.owl-prev:hover,.owl-next:hover,.owl-prev:focus,.owl-next:focus{
    outline: none;
}
.owl-item {
    border-radius: 4px;

}
a.item {
    /*display: flex;*/
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #f00;
    cursor: pointer;
    text-align: center;
    /*padding: 78px 30px;*/
}
.sml_tst{
  font-size: 14px;
  color: #ffffff;
}
.owl-carousel.owl-drag .owl-item{
  text-align: center;
}
.item:hover{
    text-decoration-line: none;
}
.owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled {
    display: block;
    margin-top: 10px;
}
body .owl-carousel .owl-dots, 
body .owl-carousel .owl-nav {
    display: block;
    margin-top: 10px;
    text-align: center;
}
body .owl-carousel .owl-dots.disabled, 
body .owl-carousel .owl-nav.disabled {
    display: block;
}
.owl-dot{
    display: none;
}


  </style>
  <style>
  .owl-carousel img {
    width: 100%;
    height: auto;
    display: block;
  }
</style>
  <script>
  jQuery(document).ready(function($) {
    $('.owl-carousel').owlCarousel({
      items: 1,         // Show only 1 item
      loop: true,       // Infinite loop
      margin: 10,
      nav: true,        // Show next/prev arrows
      dots: true,       // Show pagination dots
      autoplay: true,
	  autoplayTimeout: 5000,        // Time in ms before next slide (3 seconds)
    smartSpeed: 500,
    });
  });
</script>
	

</head>
<body class="advpage-3">
    
	<?php include('include/adv_header.php'); ?>

    <?php /*?><div class="container">
        <!-- <h2 class="page_heading">All Models</h2> -->
    <div class="login-signup">
      <div class="row">
      <div class="col-md-12 adv-list">
  <div class="card adv-cp mt-2">
<div class="adv-image">

<?php
if(!empty($form_data['video'])){
?>
<video class="video-ci" controls  >
<source src="<?php echo SITEURL.'uploads/banners/'.$form_data['video']; ?>" type="video/mp4">
</video>
<?php
}
else{
?>
<img src="<?php echo SITEURL.'uploads/banners/'.$form_data['image']; ?>" alt="" />
<?php
}
?>


</div>
<div class="" style="padding:10px">
<h2 class="adv-title"><?php echo $form_data['name']; ?></h2>
<div ><?=$form_data['description']?></div>
<hr style="margin-bottom:10px;margin-top:10px;">

<div class="adv-meta">
<div class="adv-meta-title">Age</div>
<div class="adv-meta-value"><?=$form_data['age']?> Years</div>
</div>

<div class="adv-meta">
<div class="adv-meta-title">Service</div>
<div class="adv-meta-value"><?=$form_data['category']?></div>
</div>

<div class="adv-meta">
<div class="adv-meta-title">Location</div>
<div class="adv-meta-value">
<?=print_value('cities',array('id'=>$form_data['city']),'name')?>, 
<?=print_value('states',array('id'=>$form_data['state']),'name')?>, 
<?=print_value('countries',array('id'=>$form_data['country']),'name')?></div>
</div>

</div>

<div class="card-footer">
<div class="d-flex justify-content-between row">
	<div class="col-xs-6"><button class="btn btn-white btn-block" onclick="window.location='<?=SITEURL.'chat/view.php?id='.$form_data['user_id']?>'">Contact</button></div>
	<div class="col-xs-6"><button class="btn btn-green btn-block" onclick="window.location='<?=SITEURL.'chat/view.php?id='.$form_data['user_id']?>'" >Call</button></div>
</div>
</div>

    </div>
</div>
	</div>      
      
        
      </div>
      
  
        
          
      </div> <?php */ ?>
	  
	  
<!-- Main Content -->
    <main class="main">
        <div class="container">
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <a href="<?= SITEURL ?>">Home</a>
                <span class="separator">/</span>
                <a href="<?= SITEURL ?>/advertisements/">Advertisements</a>
                <span class="separator">/</span>
                <span><?php echo $form_data['name']; ?></span>
            </div>

            <!-- Ad Detail Section -->
            <div class="ad-detail">
                <!-- Image Gallery -->
                <div class="ad-gallery">

                    <div class="main-image">
                        <div class="badge badge-premium">👑 Premium</div>
						
						<?php /*
						if(!empty($form_data['video'])){
						?>
						<video class="video-ci" controls  >
						<source src="<?php echo SITEURL.'uploads/banners/'.$form_data['video']; ?>" type="video/mp4">
						</video>
						<?php
						}
						else{
						?>
						<img id="mainImage" src="<?php echo SITEURL.'uploads/banners/'.$form_data['image']; ?>" alt="<?php echo $form_data['name']; ?>" />
						<?php
						} */ ?>
						
						
						<div class="owl-carousel" >
						
						<?php if(!empty($form_data['video'])){ 
						$video = explode('|',$form_data['video']);
						$video_count = count($video);
						foreach($video as $add_vd){
						?>
						<div>
						<video class="video-ci" controls  >
						<source src="<?php echo SITEURL.'uploads/banners/'.$add_vd; ?>" type="video/mp4">
						</video>
						</div>
						<?php } }else $video_count = 0; ?>
						<?php if(!empty($form_data['image'])){ ?>
						<div>
							<img src="<?php echo SITEURL.'uploads/banners/'.$form_data['image']; ?>" >
					
						  </div>
						  
						<?php } $add_cnt = 0; if(!empty($form_data['additionalimages'])){ 
							$additionalimages = explode('|',$form_data['additionalimages']);
							foreach($additionalimages as $add_img){
								if(!empty($add_img)){
						?>
						
						<div>
							<img src="<?php echo SITEURL.'uploads/banners/'.$add_img; ?>" >
					
						  </div>
						
						
								<?php $add_cnt++; } } } ?>
						
						
						</div>
						
						


                    <?php /*?><div class="thumbnail-grid">
						<?php
						if(!empty($form_data['video'])){
						?>
						<div class="thumbnail active" onclick="changeImage(0)">
                            <img src="/placeholder.svg?height=100&width=100" alt="Aria Moonlight Thumbnail 1">
                        </div>
						<div class="thumbnail" onclick="changeImage(1)">
                            <img src="<?php echo SITEURL.'uploads/banners/'.$form_data['image']; ?>" alt="<?php echo $form_data['name']; ?>">
                        </div>
						<?php $j = 2;
						}
						else{
						?>
                        <div class="thumbnail active" onclick="changeImage(0)">
                            <img src="<?php echo SITEURL.'uploads/banners/'.$form_data['image']; ?>" alt="<?php echo $form_data['name']; ?>">
                        </div>
						<?php $j = 1; } ?>
						
                        <?php if(!empty($form_data['additionalimages'])){ 
							$additionalimages = explode('|',$form_data['additionalimages']);
							foreach($additionalimages as $add_img){
						?>
						
						<div class="thumbnail" onclick="changeImage(<?php echo $j; ?>)">
                            <img src="<?php echo SITEURL.'uploads/banners/'.$add_img; ?>" alt="<?php echo $add_img; ?>">
                        </div>
						
							<?php $j++; } } ?>
                    </div> <?php */ ?>
                </div>
				</div>

                <!-- Ad Content -->
                <div class="ad-content">
                    <div class="ad-header">
                        <h1 class="ad-title premium-text"><?php echo $form_data['name']; ?></h1>
						<?php if($form_data['subtitle']){ ?>
                        <p class="ad-subtitle"><?php echo $form_data['subtitle']; ?></p>
						<?php } ?>

                        <div class="ad-stats">
                            <div class="stat">
                                <span class="stat-value">2.4K</span>
                                <span class="stat-label">Views</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">189</span>
                                <span class="stat-label">Likes</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">4.9</span>
                                <span class="stat-label">Rating</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">50+</span>
                                <span class="stat-label">Projects</span>
                            </div>
                        </div>
                    </div>

					<?php if(!empty($form_data['user_bio'])){ ?>
                    <div class="ad-description">
                        <?=$form_data['user_bio']?>
                    </div>
					<?php } ?>

                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">📸</div>
                            <div class="feature-text">Fashion Photography</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">👗</div>
                            <div class="feature-text">Runway Shows</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">🎭</div>
                            <div class="feature-text">Brand Ambassador</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">🎬</div>
                            <div class="feature-text">Commercial Shoots</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">📱</div>
                            <div class="feature-text">Social Media Content</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">🌎</div>
                            <div class="feature-text">International Availability</div>
                        </div>
                    </div>

                    <div class="ad-actions">
                        <a href="<?= SITEURL ?>single-profile.php?m_unique_id=<?php echo $userDetails['unique_id']; ?>" class="btn-primary action-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            View Full Profile
                        </a>
                        <button class="btn-secondary action-btn" onclick="window.location='<?= SITEURL ?>user/chat/user_chat.php?id=<?= $form_data['user_id'] ?>'" >
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Contact Advertiser
                        </button>
                        <button class="btn-secondary action-btn" onclick="saveAd()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Save Ad
                        </button>
						
						
						
							<div class="video-count">
							<img src="<?php echo SITEURL.'uploads/banners/icon_video_prev.svg'; ?>" >
							<span>
							<?php if(!empty($form_data['video'])){ echo $video_count; } else echo '0'; ?>
							</span>
							</div>
						
							<div class="image-count">
							<img src="<?php echo SITEURL.'uploads/banners/icon_image_prev.svg'; ?>" >
							<span>
							<?php if(!empty($form_data['image'])){ $img_cnt = 1; }else $img_cnt = 0; 
							echo $img_cnt = $img_cnt+$add_cnt;
							?>
							</span>
							</div>
							
							
						
						
                    </div>
					
					
					
					
                </div>
            </div>
			

            <!-- Additional Info Section -->
            <div class="additional-info ultra-glass">
                <div class="info-tabs">
				<?php if(!empty($form_data['description'])){ ?>
                    <button class="tab-btn active" onclick="openTab('details')">Ad Details</button>
				<?php } ?>
                    <button class="tab-btn <?php if(empty($form_data['description'])){ echo 'active'; } ?>" onclick="openTab('specifications')">Specifications</button>
                    <button class="tab-btn" onclick="openTab('availability')">Availability</button>
					<?php if(!empty($form_data['terms_conditions'])){ ?>
                    <button class="tab-btn" onclick="openTab('terms')">Terms & Conditions</button>
					<?php } ?>
                </div>

				<?php if(!empty($form_data['description'])){ ?>
                <!-- Details Tab -->
                <div id="details" class="tab-content active">
                    <h3>Advertisement Details</h3>
                    <?php echo $form_data['description']; ?>
                </div>
				<?php } ?>

                <!-- Specifications Tab -->
                <div id="specifications" class="tab-content <?php if(empty($form_data['description'])){ echo 'active'; } ?>">
                    <h3>Model Specifications</h3>
					
                    <table class="specs-table">
					<?php if ($userDetails['gender'] == 'Female') { ?>
						<?php if(!empty($rowes1) && !empty($rowes1['bust_size'])){ ?>
						<tr>
                            <th>Bust Size</th>
                            <td><?php echo $rowes1['bust_size']; ?></td>
                        </tr>
						<?php } ?>
						<?php if(!empty($rowes1) && !empty($rowes1['cup_size'])){ ?>
						<tr>
                            <th>Cup Size</th>
                            <td><?php echo $rowes1['cup_size']; ?></td>
                        </tr>
						<?php } ?>
						
					<?php } ?>
					
						<?php if(!empty($rowes1)){
							
							if(!empty($rowes1['waist_size'])){ ?>
						<tr>
                            <th>Waist Size</th>
                            <td><?php echo $rowes1['waist_size']; ?></td>
                        </tr>
						<?php }
						
						if(!empty($rowes1['ethnicity'])){ ?>
						<tr>
                            <th>Ethnicity</th>
                            <td><?php echo $rowes1['ethnicity']; ?></td>
                        </tr>
						<?php }
						
						if(!empty($rowes1['height'])){ ?>
						<tr>
                            <th>Height</th>
                            <td><?php echo $rowes1['height']; ?></td>
                        </tr>
						<?php }
						if(!empty($rowes1['weight'])){ ?>
						<tr>
                            <th>Weight (enter weight in pounds)</th>
                            <td><?php echo $rowes1['weight']; ?></td>
                        </tr>
						<?php }
						if(!empty($rowes1['eye_color'])){ ?>
						<tr>
                            <th>Eye Color</th>
                            <td><?php echo $rowes1['eye_color']; ?></td>
                        </tr>
						<?php }
						if(!empty($rowes1['hair_color'])){ ?>
						<tr>
                            <th>Hair Color</th>
                            <td><?php echo $rowes1['hair_color']; ?></td>
                        </tr>
						<?php } ?>
						
						
						<?php } ?>
                        
                        
                    </table>

                    <p>Note: This information is provided for professional casting purposes only. All bookings are subject to agency approval and contract terms.</p>
                </div>

                <!-- Availability Tab -->
                <div id="availability" class="tab-content">
                    <h3>Availability Information</h3>

					<?php if(!empty($form_data['user_current_status'])){ ?>
                    <div class="current-sts">
                        <h4>Current Status</h4>
                        <div class="sts-content">
                         
							<?php echo $form_data['user_current_status']; ?>

                        </div>

                    </div>
					<?php } ?>

                    <div class="upcomming-div">

                        <h4>Upcoming Availability</h4>
                        <ul class="limited-list">
                            <li>
                                <span>June 2024:</span> Limited availability (Fashion Week preparations)
                            </li>
                            <li>
                                <span>July 2024:</span> Available for bookings
                            </li>
                            <li>
                                <span >August 2024:</span> Available for bookings
                            </li>
                            <li>
                                <span>September 2024:</span> Limited availability (Fashion Week commitments)
                            </li>
                            <li>
                                <span>October 2024 and beyond:</span> Contact for availability
                            </li>
                        </ul>
                    </div>

                    <p>For the most current availability information and to discuss specific dates, please use the contact button to reach out directly. Priority is given to premium clients and long-term partnerships.</p>
                </div>
				
				<?php if(!empty($form_data['terms_conditions'])){ ?>
                <!-- Terms Tab -->
                <div id="terms" class="tab-content">
                    <h3>Terms & Conditions</h3>

                    <div class="adv-box">
                        <?php echo $form_data['terms_conditions']; ?>

                    </div>
                </div>
				<?php } ?>
				
            </div>
			
			<?php 
			
			$similar_adv_query = "select tb.*,mu.age from banners tb join model_user mu on mu.id=tb.user_id where tb.id!=".$id." AND tb.category='".$form_data['category']."' ORDER BY RAND() LIMIT 3";
			
			if(DB::numRows($similar_adv_query) < 3){
				$similar_adv = DB::query("select tb.*,mu.age from banners tb join model_user mu on mu.id=tb.user_id where tb.id!=".$id." ORDER BY RAND() LIMIT 3");
			}else{
				$similar_adv = DB::query($similar_adv_query);
			}
			
			if(!empty($similar_adv)){
			?>

            <!-- Similar Ads Section -->
            <div class="similar-ads">
                <h2 class="section-title gradient-text">Similar Advertisements</h2>

                <div class="ads-grid">
                    
					
				<?php
                    foreach ($similar_adv as $set_data) {
						$message  = limit_text($set_data['description'],15);
                ?>	
					
					<!-- Similar Ad 1 -->
					<div class="ad-card" onclick="viewProfile(<?php echo $set_data['id']; ?>)">

                        <div class="card-image">
                            <div class="badge badge-featured">🌟 Featured</div>
                            <img src="<?php echo SITEURL.'uploads/banners/'.$set_data['image']; ?>" alt="<?php echo $set_data['name']; ?>">
                        </div>

                        <div class="card-content">
                            <h3 class="card-title"><?php echo $set_data['name']; ?></h3>
                            <p class="card-description"><?=$message?></p>

                            <div class="v-box">
                                <span>👁️ 3.8K views</span>
                                <span>⭐ 4.8</span>
                            </div>

                            <button class="btn-primary">
                                View Details
                            </button>


                        </div>
                    </div>

                    
					<?php } ?>





                </div>
            </div>
			
			<?php } ?>
			
        </div>
    </main>	  
	  
	  
   <?php include('include/adv_footer.php'); ?>
   
   <script>
        // Image Gallery Functionality
        const images = [
            {
                src: "/placeholder.svg?height=500&width=400",
                style: "background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);"
            },
            {
                src: "/placeholder.svg?height=500&width=400",
                style: "background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #f5576c);"
            },
            {
                src: "/placeholder.svg?height=500&width=400",
                style: "background: linear-gradient(45deg, #10b981, #34d399, #6ee7b7, #9ca3af);"
            },
            {
                src: "/placeholder.svg?height=500&width=400",
                style: "background: linear-gradient(45deg, #8b5cf6, #a78bfa, #c4b5fd, #ddd6fe);"
            }
        ];

        function changeImage(index) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = images[index].src;
            mainImage.style = images[index].style;

            // Update active thumbnail
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }

        // Tab Functionality
        function openTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tab => {
                tab.classList.remove('active');
            });

            // Show the selected tab
            document.getElementById(tabName).classList.add('active');

            // Update active tab button
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(button => {
                if (button.textContent.toLowerCase().includes(tabName)) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        }

        // Action Button Functions
        function contactAdvertiser() {
            alert('Opening contact form for Aria Moonlight advertisement');
        }

        function saveAd() {
            alert('Advertisement saved to your favorites');
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
   
  </body>


</html> 
