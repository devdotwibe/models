<?php
    session_start();
	include('includes/config.php');
	include('includes/helper.php');
    $usern = $_SESSION["log_user"];

    if( !$usern ){
        echo '<script>window.location.href="login.php"</script>';
    }
	if (isset($_SESSION['log_user_id'])) {
		$log_user_id = $_SESSION['log_user_id'];
		$get_modal_user = DB::query('select as_a_model from model_user where id='.$log_user_id);
		$as_a_model = $get_modal_user[0]['as_a_model'];
	}else{
		$as_a_model = '';
	}
	/*if($as_a_model != 'Yes'){
		//header("Location: login.php");
		echo '<script>window.location.href="login.php"</script>';
	} */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>My Purchases - Photos & Videos | Live Models</title>
    <meta name="description" content="Your premium content collection with advanced viewing and management features">
    <?php  include('includes/head.php'); ?>

</head>
<body class="min-h-screen text-white advt-page my-purpose socialwall-page">

	<!-- Advanced Scroll Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>

    <!-- Advanced Particle System -->
    <div class="particles-advanced" id="particlesAdvanced"></div>

	<?php  include('includes/side-bar.php'); ?>

	<?php  include('includes/profile_header_index.php'); ?>



    <!-- Advanced Content Viewer Modal -->
    <div class="modal-advanced" id="contentModal">
        <div class="modal-content-advanced">
            <button class="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-300 focus-visible:focus" onclick="closeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div id="modalContent">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>

	<?php
	$photo_count = 0; $video_count = 0;
	$log_user_id = $_SESSION["log_user_unique_id"];
	$sqls = "SELECT * FROM user_purchased_image WHERE user_unique_id = '".$log_user_id."' ORDER BY id DESC";
	$resultd = mysqli_query($con, $sqls);
		if (mysqli_num_rows($resultd) > 0) {
			while($rowesdw = mysqli_fetch_assoc($resultd)) {
				if($rowesdw['file_type'] == 'Image'){
					$photo_count++;
				}else if($rowesdw['file_type'] == 'Video'){
					$video_count++;
				}
			}
		}
	?>

    <main>
        <!-- Premium Page Header -->
        <section class="py-8 sm:py-16 relative overflow-hidden pp-sec">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/20 via-purple-900/15 to-pink-900/20"></div>
            <div class="container-advanced mx-auto relative z-10">
                <div class="text-center mb-8 sm:mb-12">
                    <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold heading-font gradient-text-premium mb-4 sm:mb-6">My Premium Collection</h1>
                    <p class="text-lg sm:text-2xl text-white/70 max-w-3xl mx-auto px-4">Your exclusive library of premium content from verified models worldwide</p>
                </div>

                <!-- Advanced Stats Dashboard -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 max-w-5xl mx-auto">
                    <div class="anim-div glass-ultra p-4 sm:p-6 rounded-2xl text-center animate-bounce-in">
                        <div class="counter-advanced mb-2" data-target="47"><?php echo $photo_count+$video_count; ?></div>
                        <div class="text-white/70 font-medium text-sm sm:text-base">Total Purchases</div>
                        <?php /*?><div class="w-full bg-white/10 rounded-full h-2 mt-3">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full" style="width: 78%"></div>
                        </div><?php */ ?>
                    </div>
                    <div class="anim-div glass-ultra p-4 sm:p-6 rounded-2xl text-center animate-bounce-in">
                        <div class="counter-advanced mb-2" data-target="28"><?php echo $photo_count; ?></div>
                        <div class="text-white/70 font-medium text-sm sm:text-base">Photos</div>
                        <?php /*?><div class="w-full bg-white/10 rounded-full h-2 mt-3">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: 65%"></div>
                        </div><?php */ ?>
                    </div>
                    <div class="anim-div glass-ultra p-4 sm:p-6 rounded-2xl text-center animate-bounce-in">
                        <div class="counter-advanced mb-2" data-target="19"><?php echo $video_count; ?></div>
                        <div class="text-white/70 font-medium text-sm sm:text-base">Videos</div>
                        <?php /*?><div class="w-full bg-white/10 rounded-full h-2 mt-3">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: 45%"></div>
                        </div><?php */ ?>
                    </div>
                    <div class="anim-div glass-ultra p-4 sm:p-6 rounded-2xl text-center animate-bounce-in">
                        <div class="text-xl sm:text-2xl font-bold gradient-text-premium mb-2">$1,247</div>
                        <div class="text-white/70 font-medium text-sm sm:text-base">Total Investment</div>
                        <?php /*?><div class="w-full bg-white/10 rounded-full h-2 mt-3">
                            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 h-2 rounded-full" style="width: 85%"></div>
                        </div><?php */ ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Advanced Filters & Search -->
        <?php /* ?><section class="py-4 sm:py-8 relative">
            <div class="container-advanced mx-auto">
                <div class="glass-ultra p-4 sm:p-8 rounded-3xl mb-6 sm:mb-8">
                    <div class="flex flex-col gap-4 sm:gap-6">
                        <!-- Advanced Filter Tabs -->
                        <div class="filter-advanced">
                            <div class="filter-tab-advanced active" onclick="filterPurchases('all', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"></path></svg>
                                All Content
                            </div>
                            <div class="filter-tab-advanced" onclick="filterPurchases('photos', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path></svg>
                                Photos
                            </div>
                            <div class="filter-tab-advanced" onclick="filterPurchases('videos', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                Videos
                            </div>
                            <div class="filter-tab-advanced" onclick="filterPurchases('premium', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                Premium
                            </div>
                            <div class="filter-tab-advanced" onclick="filterPurchases('recent', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                Recent
                            </div>
                            <div class="filter-tab-advanced" onclick="filterPurchases('favorites', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                Favorites
                            </div>
                        </div>

                        <!-- Advanced Search & Controls -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative flex-1">
                                <input
                                    type="text"
                                    placeholder="Search by model name, content type, or date..."
                                    class="w-full px-4 sm:px-6 py-3 glass-ultra text-white placeholder-white/50 rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-lg transition-all duration-300 text-sm sm:text-base focus-visible:focus"
                                    id="searchInput"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                            </div>
                            <select class="px-4 py-3 glass-ultra text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-lg transition-all duration-300 text-sm sm:text-base focus-visible:focus" id="sortSelect">
                                <option value="newest" class="bg-gray-900">Newest First</option>
                                <option value="oldest" class="bg-gray-900">Oldest First</option>
                                <option value="price-high" class="bg-gray-900">Price: High to Low</option>
                                <option value="price-low" class="bg-gray-900">Price: Low to High</option>
                                <option value="rating" class="bg-gray-900">Highest Rated</option>
                                <option value="popular" class="bg-gray-900">Most Popular</option>
                            </select>
                            <button class="btn-secondary-premium px-4 py-3 rounded-xl flex items-center gap-2" onclick="toggleViewMode()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                <span class="hidden sm:inline">Grid</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section> <?php */ ?>

        <!-- Advanced Purchases Grid -->
        <section class="py-4 sm:py-8 relative">
            <div class="container-advanced mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8" id="purchasesGrid">



			<?php
			  $count = 1;
			  $sqls = "SELECT * FROM user_purchased_image WHERE user_unique_id = '".$log_user_id."' ORDER BY id DESC";
				$resultd = mysqli_query($con, $sqls);
				  if (mysqli_num_rows($resultd) > 0) {
					while($rowesdw = mysqli_fetch_assoc($resultd)) {
					   $file_id = $rowesdw['file_unique_id'];
					   $file_type = $rowesdw['file_type'];
					   $model_unique_id = $rowesdw['model_unique_id'];
						$file_downloads = $rowesdw['file_downloads'];

					  $sql = "SELECT * FROM model_images WHERE id = '".$file_id."'";
					  $result = mysqli_query($con, $sql);
					  if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
						 $url = $row['file'];
						 $url_ext = $row['file'];

             $post_id = $row['id'];

             $url = 'assets/images/model-gal-no-img.jpg';

						 if (checkImageExists($url_ext)) {

							  $url = $url_ext;
              
						 }
             	  $url = $url_ext;

						  $image_text = $row['image_text'];
						}
					  }

					$sql1 = "SELECT * FROM model_user WHERE unique_id = '".$model_unique_id."'";
					  $result1 = mysqli_query($con, $sql1);
					  if (mysqli_num_rows($result1) > 0) {
						$row1 = mysqli_fetch_assoc($result1);
						if(!empty($row1['profile_pic'])) $prof_img = SITEURL.$row1['profile_pic'];
			 			else $prof_img = SITEURL.'assets/images/model-gal-no-img.jpg';
			  ?>

				<?php if($file_type == 'Image'){ ?>

                    <!-- Premium Purchase Card 1 - Photo -->
                    <div class="card-premium animate-fade-in-up" data-post-id="<?php echo $post_id ?>" data-type="photo" data-model="aria" data-price="25" data-date="2024-12-15" style="animation-delay: 0.1s">
                        <div class="image-premium relative">
                            <img src="<?php echo SITEURL.$url; ?>" alt="<?php echo $image_text; ?>" class="w-full h-48 sm:h-64 object-cover">
                            <div class="absolute top-3 sm:top-4 left-3 sm:left-4 badge-premium">
                                📸 4K Photo
                            </div>
                            <div class="absolute top-3 sm:top-4 right-3 sm:right-4 glass-ultra px-2 sm:px-3 py-1 rounded-full text-xs font-semibold text-white">
                                Ultra HD
                            </div>
                            <button class="absolute bottom-3 right-3 w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-300" onclick="toggleFavorite(this)" aria-label="Add to favorites">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="p-4 sm:p-6 relative z-10">
                            <div class="flex items-center mb-4">
                                <img src="<?php echo $prof_img ?>" alt="<?php echo ucfirst($row1['username']); ?> Profile" class="w-10 sm:w-12 h-10 sm:h-12 rounded-full mr-3 sm:mr-4 border-2 border-purple-500">
                                <div class="flex-1">
                                    <h4 class="text-base sm:text-lg font-bold gradient-text-premium"><?php echo ucfirst($row1['username']); ?>.</h4>
                                    <div class="flex items-center gap-2">
                                        <span class="status-premium status-online-premium w-2 h-2 rounded-full"></span>
                                        <span class="text-xs sm:text-sm text-white/60">Verified Model</span>
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <span class="text-xs text-white/60">4.9</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 sm:space-y-3 mb-4">
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Purchase Date:</span>
                                    <span class="text-white font-medium"><?php echo date('M d, Y',strtotime($rowesdw['purchase_date'])); ?></span>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Price:</span>
                                    <span class="text-green-400 font-bold">$25.00</span>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Resolution:</span>
                                    <span class="text-white font-medium">4K Ultra HD</span>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Downloads:</span>
									<?php if(!empty($file_downloads)){ ?>
                                    <span class="text-white font-medium"><?php echo $file_downloads; ?></span>
									<?php } else{ ?>
									<span class="text-white font-medium">0</span>
									<?php } ?>
                                </div>
                            </div>
                            <div class="flex gap-2 sm:gap-3">
                                <button class="flex-1 btn-premium py-2 sm:py-3 text-xs sm:text-sm" onclick="viewContent('photo', 'aria-1')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    View
                                </button>
								<?php if (file_exists($url_ext)) { ?>
                                <a href="<?= SITEURL . 'ajax/download.php?file=' . $url_ext.'&id='.$rowesdw['id']; ?>" class="btn-secondary-premium px-3 sm:px-4 py-2 sm:py-3 rounded-xl" aria-label="Download content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </a>
								<?php }else{ ?>
								<button class="btn-secondary-premium px-3 sm:px-4 py-2 sm:py-3 rounded-xl" onclick="downloadContent()" aria-label="Download content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </button>
								<?php } ?>
                                <button class="btn-secondary-premium px-3 sm:px-4 py-2 sm:py-3 rounded-xl" onclick="shareContent('aria-1')" aria-label="Share content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                                </button>
                            </div>
                        </div>
                    </div>

				<?php }else if($file_type == 'Video'){ ?>

				<?php /*<video class="paid-video" controls>
				<source src="../<?php echo $url; ?>" type="video/mp4">
				</video>*/ ?>

                    <!-- Premium Purchase Card 2 - Video -->
                    <div class="card-premium animate-fade-in-up" data-type="video" data-model="phoenix" data-price="45" data-date="2024-12-14" style="animation-delay: 0.2s">
                        <div class="image-premium relative">
                            <img src="<?php echo SITEURL.$url; ?>" alt="Exclusive Video by Phoenix" class="w-full h-48 sm:h-64 object-cover">
                            <div class="video-overlay-advanced" onclick="viewContent('video', 'phoenix-1')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            </div>
                            <div class="absolute top-3 sm:top-4 left-3 sm:left-4 badge-verified">
                                🎥 4K Video
                            </div>
                            <div class="absolute top-3 sm:top-4 right-3 sm:right-4 glass-ultra px-2 sm:px-3 py-1 rounded-full text-xs font-semibold text-white">
                                5:32 min
                            </div>
                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 glass-ultra px-2 sm:px-3 py-1 rounded-full text-xs font-semibold text-white">
                                4K • 60fps
                            </div>
                            <button class="absolute bottom-3 right-3 w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-300" onclick="toggleFavorite(this)" aria-label="Add to favorites">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="p-4 sm:p-6 relative z-10">
                            <div class="flex items-center mb-4">
                                <img src="<?php echo $prof_img ?>" alt="<?php echo ucfirst($row1['username']); ?> Profile" class="w-10 sm:w-12 h-10 sm:h-12 rounded-full mr-3 sm:mr-4 border-2 border-purple-500">
                                <div class="flex-1">
                                    <h4 class="text-base sm:text-lg font-bold gradient-text-premium"><?php echo ucfirst($row1['username']); ?>.</h4>
                                    <div class="flex items-center gap-2">
                                        <span class="status-premium status-online-premium w-2 h-2 rounded-full"></span>
                                        <span class="text-xs sm:text-sm text-white/60">Premium Model</span>
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <span class="text-xs text-white/60">4.8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 sm:space-y-3 mb-4">
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Purchase Date:</span>
                                    <span class="text-white font-medium"><?php echo date('M d, Y',strtotime($rowesdw['purchase_date'])); ?></span>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Price:</span>
                                    <span class="text-green-400 font-bold">$45.00</span>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Duration:</span>
                                    <span class="text-white font-medium">5:32 minutes</span>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm">
                                    <span class="text-white/70">Quality:</span>
                                    <span class="text-white font-medium">4K 60fps</span>
                                </div>
                            </div>
                            <div class="flex gap-2 sm:gap-3">
                                <button class="flex-1 btn-premium py-2 sm:py-3 text-xs sm:text-sm" onclick="viewContent('video', 'phoenix-1')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                    Play
                                </button>
                                <?php if (file_exists($url_ext)) {?>
                                <a href="<?= SITEURL . 'ajax/download.php?file=' . $url_ext.'&id='.$rowesdw['id']; ?>" class="btn-secondary-premium px-3 sm:px-4 py-2 sm:py-3 rounded-xl" aria-label="Download content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </a>
								<?php }else{ ?>
								<button class="btn-secondary-premium px-3 sm:px-4 py-2 sm:py-3 rounded-xl" onclick="downloadContent()" aria-label="Download content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </button>
								<?php } ?>
                                <button class="btn-secondary-premium px-3 sm:px-4 py-2 sm:py-3 rounded-xl" onclick="shareContent('phoenix-1')" aria-label="Share content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                                </button>
                            </div>
                        </div>
                    </div>

				<?php } ?>

			<?php
			  }
				$count++;
				}
				  } else {
					//echo "0 results";
				  }
			  ?>



				</div>

			</div>

		</section>


    </main>

	  <?php include('includes/footer.php'); ?>

	</body>

</html>


<script>
function downloadContent(){
	alert('File is not exist');
}
</script>


	<?php /*?>

  <div class="container">
    <div class="row">
      <h2 class="page_heading">My Purchase</h2>

      <h4>Images and Video's</h4>
      <?php
      $count = 1;
       $log_user_id = $_SESSION["log_user_unique_id"];
       $sqls = "SELECT * FROM user_purchased_image WHERE user_unique_id = '".$log_user_id."' ORDER BY id DESC";
        $resultd = mysqli_query($con, $sqls);
          if (mysqli_num_rows($resultd) > 0) {
            while($rowesdw = mysqli_fetch_assoc($resultd)) {
               $file_id = $rowesdw['file_unique_id'];
               $file_type = $rowesdw['file_type'];
               $model_unique_id = $rowesdw['model_unique_id'];


              $sql = "SELECT * FROM model_images WHERE id = '".$file_id."'";
              $result = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $url = $row['file'];
                  $image_text = $row['image_text'];
                }
              }

            $sql1 = "SELECT * FROM model_user WHERE unique_id = '".$model_unique_id."'";
              $result1 = mysqli_query($con, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
      ?>
      <div class="col-md-3">
        <?php if($file_type == 'Image'){ ?>
          <div class="creator-list" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
            <img class="bot_plus" src="../<?php echo $url; ?>" alt="photo" />
          </div>

          <span><?php echo $image_text; ?></span>
        <?php }else{ ?>
          <div class="creator-list" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
            <video class="paid-video" controls> <source src="../<?php echo $url; ?>" type="video/mp4"> </video>
          </div>

          <span><?php echo $image_text; ?></span>
        <?php } ?>
      </div>

      <div class="modal fade" id="myModal<?php echo $count; ?>" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">

                  <?php if($file_type == 'Image'){ ?>
                  <img class="full_img" src="../<?php echo $url; ?>" alt="photo">
                  <?php }else{ ?>
                    <video class="full_img" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
                      <source src="../<?php echo $url; ?>" type="video/mp4">
                    </video>
                  <?php } ?>
                </div>
                <div class="col-md-6">
                  <button type="button" class="close" data-dismiss="modal" style="padding-right: 15px;padding-top: 15px;">×</button>
                  <div class="usern model-prof">
                    <a title="" href="single-profile.php?model=<?php echo $row1['username']; ?>&m_id=<?php echo $row1['id']; ?>&m_unique_id=<?php echo $row1['unique_id'];?>" >
                      <figure class="user_profile">
                        <img alt="image" class="profil_img" src="<?php echo $row1['photo_2'] ?>">
                      </figure>
                      <span>
                        <p class="username"><?php echo $row1['username']; ?></p>
                      </span>
                    </a>
                  </div>
                  <p><?php echo $image_text; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      }
        $count++;
        }
          } else {
            //echo "0 results";
          }
      ?>
      <!-- <h4>Subscription</h4>

      <h4>Video/Audio calls</h4> -->
    </div>
  </div>


    <?php
          $count = 1;
            $sqls = "SELECT * FROM casting WHERE status = 'Published' Order by id ASC LIMIT 6 ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw1 = mysqli_fetch_assoc($resultd)) {

                    $sql1 = "SELECT * FROM model_images WHERE unique_model_id = '".$rowesdw1['unique_id']."' Order by id DESC LIMIT 1 ";
                    $result1 = mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                      $rowes1 = mysqli_fetch_assoc($result1);
          ?>
<div class="modal fade" id="myModal<?php echo $count; ?>" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">

            <?php if($rowes1['file_type'] == 'Image'){ ?>
            <img src="<?php echo $rowes1['file']; ?>" style="height: 500px;border-radius: 20px 0 0 20px;" alt="image">
            <?php }else{ ?>
              <video style="height: 500px;border-radius: 20px 0 0 20px;" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>"poster= "https://media.geeksforgeeks.org/wp-content/cdn-uploads/20190710102234/download3.png">
                <source src="<?php echo $rowes1['file']; ?>" type="video/mp4">
              </video>
            <?php } ?>
          </div>
          <div class="col-md-6">
            <button type="button" class="close" data-dismiss="modal" style="padding-right: 15px;padding-top: 15px;">×</button>
            <div class="usern model-prof">
              <a title="" href="single-profile.php?model=<?php echo $rowesdw1['username']; ?>&m_id=<?php echo $rowesdw1['id']; ?>&m_unique_id=<?php echo $rowesdw1['unique_id'];?>" >
                <figure class="user_profile">
                  <img alt="images"> src="<?php echo $rowesdw1['photo_2'] ?>">
                </figure>
                <span>
                  <a title="" href="#" style="background: unset;"><?php echo $rowesdw1['username']; ?></a>
                </span>
              </a>
            </div>
            <p><?php echo $rowes1['image_text'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php
                    }
    $count++;
    }
      } else {
        echo "Currently you bucket is empty.";
      }
	  */
  ?>
