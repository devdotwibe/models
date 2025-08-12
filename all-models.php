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
    
    <link rel='stylesheet' href='<?= SITEURL ?>assets/css/profile.css?v=<?= time() ?>' type='text/css' media='all' />
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



<body class="premimum-model1 enhanced5">

    <?php include('includes/header.php'); ?>

<!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="logo">Live Models</h1>
                
                <div class="header-actions">
                    <button class="header-btn active" title="Grid View" id="gridViewBtn">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="header-btn" title="Menu" id="menuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="header-btn" title="Advanced Filters" id="filterBtn">
                        <i class="fas fa-filter"></i>
                    </button>
                    
                    <div class="sort-dropdown">
                        <button class="sort-btn" id="sortBtn">
						<?php if(isset($_GET['sort']) && $_GET['sort'] == 'newest'){
							echo '<span>Newest First</span>';
						}else{ ?>
                            <span>Sort by</span>
						<?php } ?>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="sort-options" id="sortOptions">
                            <div class="sort-option" data-sort="newest"><a href="<?=SITEURL?>/all-models.php?sort=newest">Newest First</a></div>
                            <div class="sort-option" data-sort="online">Online Now</div>
                            <div class="sort-option" data-sort="popular">Most Popular</div>
                            <div class="sort-option" data-sort="distance">Distance</div>
                            <div class="sort-option" data-sort="price">Price: Low to High</div>
                        </div>
                    </div>
                    
                    <button class="premium-btn" type="button" onclick="ShowPremium()">
                        <i class="fas fa-crown"></i>
                        Go Premium
                    </button>
                </div>
            </div>
        </div>
    </header>

	<!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="profile-grid" id="profileGrid">
			
			<?php 

            
            $userDetails = [];

            $boosted_user_ids =[];

            $condtion = "";

            if(isset($_SESSION["log_user_id"])){
                
                $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

                $result = CheckPremiumAccess($userDetails['id']);

                echo $result;

                die();

                $boosted_user_ids = BoostedModelIdsByUser($userDetails,$con);

                $privacy_setting =  getModelPrivacySettings($userDetails['unique_id']);

            }
            else
            {
                 $boosted_user_ids = BoostedModelIds($con);
            }

            $followed_user_ids = [];

            $user_have_preminum =false;


            if(!empty($userDetails) && count($userDetails) > 0)
            {
                $privacy_setting =  getModelPrivacySettings($userDetails['unique_id']);

                $followed_model_unique_ids = [];

                $query = "SELECT unique_id FROM model_user WHERE as_a_model = 'Yes'";

                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $followed_model_unique_ids[] = $row['unique_id'];
                    }
                }

                $filteredFollowedIds = filterFollowedModelIdsByPrivacy($con,$followed_model_unique_ids,$userDetails,$privacy_setting);

                $followed_user_ids = array_merge($followed_user_ids, $filteredFollowedIds);
            }

       
			$limit = 8; 
			if(isset($_GET['offset'])){
			$offset = $_GET['offset'];
			}else $offset = 0;
			
			if(isset($_GET['sort'])){
			$sort_filter = $_GET['sort'];
			}else $sort_filter = 0;
			
			$where = '';

            if (!empty($followed_user_ids)) {

                $escaped_ids = array_map(function ($id) use ($con) {
                    return "'" . mysqli_real_escape_string($con, $id) . "'";
                }, $followed_user_ids);

                $ids_string = implode(",", $escaped_ids);

                $where .= " AND mu.id IN ($ids_string)";
            }

            if (isset($_GET['filter']) && $_GET['filter'] == 'new') {

                $where .= " AND register_date >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";
            }

			if (isset($_POST['filter_submit'])){  

				if(isset($_POST['f_gender']) && $_POST['f_gender'] != 'any'){

					// $where .= ' AND mu.gender = "'.$_POST['f_gender'].'"';

                    $where .= " AND mu.gender = '" . mysqli_real_escape_string($con, $_POST['f_gender']) . "'";

				}
				if(isset($_POST['f_age'])){
					if($_POST['f_age'] == 65) $where .= ' AND age >= '.$_POST['f_age'];
					else $where .= ' AND mu.age = '.$_POST['f_age'];
				}
				if(isset($_POST['f_location']) && !empty($_POST['f_location'])){
					$city_array = '';
					$get_citylist = DB::query('select id,name from cities where name LIKE "%'.$_POST['f_location'].'%" order by name asc');
					if(!empty($get_citylist)){
						foreach($get_citylist as $ct){
							$city_array .= $ct['id'].',';
						} 
						$where .= ' AND mu.city IN ('.rtrim($city_array,',').')';
						
					}
				}
			
                if($user_have_preminum)
                {
                    if (isset($_POST['f_body_type']) && $_POST['f_body_type'] != 'any') {
                        $where .= ' AND md.body_type = "' . $_POST['f_body_type'] . '"';
                    }

                    if (isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] != 'any') {
                        $where .= ' AND md.ethnicity = "' . $_POST['f_ethnicity'] . '"';
                    }

                    if (isset($_POST['f_hair_color']) && $_POST['f_hair_color'] != 'any') {
                        $where .= ' AND md.hair_color = "' . $_POST['f_hair_color'] . '"';
                    }

                    if (isset($_POST['f_eye_color']) && $_POST['f_eye_color'] != 'any') {
                        $where .= ' AND md.eye_color = "' . $_POST['f_eye_color'] . '"';
                    }

                    if (isset($_POST['f_language']) && $_POST['f_language'] != 'any') {
                        $where .= ' AND mu.english_ability = "' . $_POST['f_language'] . '"';
                    }

                    if (isset($_POST['children_preference']) && $_POST['children_preference'] != 'any') {
                        $where .= ' AND pu.children_preference = "' . $_POST['children_preference'] . '"';
                    }

                    if (isset($_POST['education_level']) && $_POST['education_level'] != 'any') {
                        $where .= ' AND pu.education_level = "' . $_POST['education_level'] . '"';
                    }

                    if(isset($_POST['f_height']) && !empty(($_POST['f_height']))){ 
                        $where .= ' AND md.height_in_cm >= '.$_POST['f_height'].' AND md.height_in_cm <= '.($_POST['f_height']+1);
                    }
                    if(isset($_POST['f_weight']) && !empty(($_POST['f_weight']))){ 
                        $where .= ' AND md.weight_in_kg >= '.$_POST['f_weight'].' AND md.weight_in_kg <= '.($_POST['f_weight']+1);
                    }   
                }


                if(!empty($userDetails) && count($userDetails) > 0 && $user_have_preminum)
                {
                    $privacy_setting =  getModelPrivacySettings($userDetails['unique_id']);

                    if($privacy_setting['verified_photos'] && isset($_POST['verified_photos']) && !empty($_POST['verified_photos'] && $_POST['verified_photos']=='Yes') )
                    {   
                        $where .= " AND md.status = 'Published'";
                    }

                    $getActiveUsers = getActiveUsers($userDetails['id'],$con);

                    $excludeIds = "'" . implode("','", $getActiveUsers['user_ids']) . "'";

                    if($privacy_setting['exclude_message_already'] && isset($_POST['exclude_message_already']) && !empty($_POST['exclude_message_already']))
                    {   
                        $where .= " AND mu.unique_id NOT IN ($excludeIds)";
                    }

                    $user_liked_rows = DB::query(
                        "SELECT model_id FROM user_model_likes WHERE user_id = %s", 
                        $_SESSION['log_user_id']
                    );

                    $RowLikedModelIds = [];

                    foreach ($user_liked_rows as $item) {
                        $RowLikedModelIds[] = $item['model_id'];
                    }

                    if (!empty($RowLikedModelIds)) {
                        $LikedIds = "'" . implode("','", $RowLikedModelIds) . "'";
                        
                        if ($privacy_setting['show_liked']) {   
                            $where .= " AND mu.id IN ($LikedIds)";
                        }
                    }

                }

			$sqls = "SELECT mu.* FROM model_extra_details md join model_user mu on mu.unique_id = md.unique_model_id JOIN model_privacy_settings pu ON pu.unique_model_id = mu.unique_id  WHERE mu.as_a_model = 'Yes' ".$where."  Order by mu.id DESC LIMIT $limit OFFSET $offset";
                
                // echo $sqls;

                // die();

			}else if(isset($_GET['sort']) && $_GET['sort'] == 'newest'){
				
			$sqls_count = "SELECT COUNT(*) AS total FROM model_user WHERE as_a_model = 'Yes' "; 
            $result_count = mysqli_query($con, $sqls_count);
			$row_cnt = mysqli_fetch_assoc($result_count);

            $order ="";

            if (!empty($boosted_user_ids)) {
                
                $boostedUniqueIdsQuoted = "'" . implode("','", $boosted_user_ids) . "'";

                $order = " ORDER BY FIELD(mu.unique_id, $boostedUniqueIdsQuoted) DESC, RAND() ";
            } else {
                
                $order = " ORDER BY mu.register_date DESC ";
            }

			$sqls = "SELECT * FROM model_user mu WHERE as_a_model = 'Yes' ".$where."   " . $order . " LIMIT $limit OFFSET $offset";
				
			}else{

            
            $onlineUserIds = [];

                if (isset($_GET['filter'])) {

                if ($_GET['filter'] == 'new') {

                    $where .= " AND mu.register_date >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";
                    $order = " ORDER BY mu.register_date DESC ";

                } elseif ($_GET['filter'] == 'available') {

                    $idsQuery = "SELECT id FROM model_user mu WHERE as_a_model = 'Yes' $where";

                    $result = mysqli_query($con, $idsQuery);

                    while ($row = mysqli_fetch_assoc($result)) {
                        if (isUserOnline($row['id']) === 'Online') {
                            $onlineUserIds[] = $row['id'];
                        }
                    }

                    $idList = implode(',', $onlineUserIds);

                    if (!empty($boosted_user_ids)) {
                    
                        $boostedUniqueIdsQuoted = "'" . implode("','", $boosted_user_ids) . "'";

                        $order = " ORDER BY FIELD(mu.unique_id, $boostedUniqueIdsQuoted) DESC, RAND() ";
                    } else {
                        
                       $order = " ORDER BY RAND() ";
                    }

                } else {


                    if (!empty($boosted_user_ids)) {
                    
                        $boostedUniqueIdsQuoted = "'" . implode("','", $boosted_user_ids) . "'";

                        $order = " ORDER BY FIELD(mu.unique_id, $boostedUniqueIdsQuoted) DESC, RAND() ";
                    } else {
                        
                       $order = " ORDER BY RAND() ";
                    }
                      
                }
                } else {


                    if (!empty($boosted_user_ids)) {
                    
                        $boostedUniqueIdsQuoted = "'" . implode("','", $boosted_user_ids) . "'";

                        $order = " ORDER BY FIELD(mu.unique_id, $boostedUniqueIdsQuoted) DESC, RAND() ";
                    } else {

                        $order = " ORDER BY mu.id DESC ";
                    }

                }

                if (empty($onlineUserIds)) {

                      
                    // $sqls_count = "SELECT COUNT(*) AS total FROM model_user WHERE as_a_model = 'Yes' ".$where; 

                    $sqls_count = "SELECT COUNT(*) AS total FROM model_user mu  WHERE mu.as_a_model = 'Yes' " . $where;
                                                            
                    $result_count = mysqli_query($con, $sqls_count);

                    $row_cnt = mysqli_fetch_assoc($result_count);
                
                    $sqls = "SELECT * FROM model_user mu WHERE as_a_model = 'Yes' " . $where . " " . $order . " LIMIT $limit OFFSET $offset";

                    
                }
                else
                {
                        $idList = implode(',', $onlineUserIds);
                        
                        if (!empty($boosted_user_ids)) {
                        
                            $boostedUniqueIdsQuoted = "'" . implode("','", $boosted_user_ids) . "'";

                            $order = " ORDER BY FIELD(mu.unique_id, $boostedUniqueIdsQuoted) DESC, RAND() ";
                        } else {
                            $order = " ORDER BY RAND() ";
                        }

                        $sqls_count = "SELECT COUNT(*) AS total FROM model_user mu WHERE mu.id IN ($idList)";
                        $result_count = mysqli_query($con, $sqls_count);
                        
                        $row_cnt = mysqli_fetch_assoc($result_count);
                        
                        $sqls = "SELECT * FROM model_user mu WHERE mu.id IN ($idList) $order LIMIT $limit OFFSET $offset";

                }


			}

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

					 $extra_details = DB::queryFirstRow("SELECT status FROM model_extra_details WHERE unique_model_id = %s ", $unique_id);
				?>
			
                <!-- Profile Card 1 -->
                <div class="profile-card">
                    <div class="profile-image-container">
					<a href="<?php echo SITEURL; ?>single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>">
                        <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="<?php echo $modalname.', '.$rowesdw['age']; ?>" class="profile-image">
                        <div class="profile-badges">
                            <span class="profile-badge badge-live">Live</span>
							<?php if(!empty($extra_details) && !empty($extra_details) && $extra_details['status'] == 'Published'){ ?>
                            <span class="profile-badge badge-verified">Verified</span>
							<?php } ?>
                        </div>
					</a>
                    </div>
                    <div class="profile-info">
                        <h3 class="profile-name">
						<a href="<?php echo SITEURL; ?>single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>">
						<?php echo ucfirst($modalname); if(!empty($rowesdw['age'])){ echo ', '.$rowesdw['age']; } ?>
						</a></h3>
						<?php if(!empty($rowesdw['city']) || !empty($rowesdw['country'])){ 
						$modelcity = $rowesdw['city'];
						$cities = DB::queryFirstRow("SELECT name FROM cities WHERE id =  %s ", $rowesdw['city']);
							if(!empty($cities)){
								$modelcity = $cities['name'];
							}
						$modelcountry = $rowesdw['country'];
						$countries = DB::queryFirstRow("SELECT name FROM countries WHERE id =  %s ", $rowesdw['country']);
							if(!empty($countries)){
								$modelcountry = $countries['name'];
							}
						?>
                        <p class="profile-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo $modelcity; ?><?php if(!empty($modelcity) && !empty($modelcountry)) { ?>,<?php } ?> <?php echo $modelcountry; ?>
                        </p>
						<?php } if(!empty($rowesdw['user_bio'])){ 
						$user_bio  = limit_text(strip_tags($rowesdw['user_bio']),15).'...';
						?>
                        <p class="profile-bio"><?php echo $user_bio; ?></p>
						<?php } ?>
                    </div>
                    <div class="profile-actions">
					<?php if (isset($_SESSION['log_user_id'])) { ?>
                        <button class="action-btn connect" title="Connect" modelid="<?php echo $rowesdw['id']; ?>" >
                            <i class="fas fa-user-plus"></i>
                        </button>
					<?php } else{ ?>
						<!-- Button to open modal -->
						<button type="button" class="action-btn connect" onclick="ActionBtn(this,'connect')" data-bs-toggle="modal" data-bs-target="#exampleModal">
						  <i class="fas fa-user-plus"></i>
						</button>
					<?php } ?>

                    <?php if (isset($_SESSION['log_user_id'])) { 
                        
                     
                            $user_liked_row = DB::queryFirstRow(
                                                "SELECT id FROM user_model_likes WHERE user_id = %s AND model_id = %s LIMIT 1", 
                                                $_SESSION['log_user_id'], 
                                                $rowesdw['id']
                                            );

                            $user_liked = false;

                            if (!empty($user_liked_row)) {
                                $user_liked = true;
                            }
                        ?>

                        <button class="action-btn like" title="Like" <?php if($user_liked) { ?> style="transform: scale(1); color: var(--secondary);" <?php } ?> onclick="ActionBtn(this,'like')" modelid="<?php echo $rowesdw['id']; ?>" >
                            <i class="fas fa-heart"></i>
                        </button>

                    <?php } else{ ?>

                        <button class="action-btn like" title="Like" <?php if($user_liked) { ?> style="transform: scale(1); color: var(--secondary);" <?php } ?> onclick="ActionBtn(this,'like')" modelid="<?php echo $rowesdw['id']; ?>" >
                            <i class="fas fa-heart"></i>
                        </button>

                    <?php } ?>



                        <button class="action-btn pass" title="Pass" onclick="ActionBtn(this,'pass')" modelid="<?php echo $rowesdw['id']; ?>" >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

				<?php } ?>

				<?php } else{
					echo '<p class="not-found-model">No models found.</p>';
				} ?>

                
            </div>

			<?php 
			if (!isset($_POST['filter_submit'])){ 
			if($row_cnt['total'] > 8){ ?>
            <!-- Load More -->
            <div class="load-more">
                <button class="load-more-btn" id="loadMoreBtn">
                    <i class="fas fa-plus-circle"></i>
                    Load More Profiles
                </button>
                <div class="loading-spinner hidden" id="loadingSpinner"></div>
            </div>
			
			<?php } } ?>
			
        </div>
    </main>

<!-- Filter Modal -->
    <div class="filter-modal-overlay" id="filterModalOverlay"></div>
    <div class="filter-modal" id="filterModal">
        <div class="filter-modal-header">
            <h2 class="filter-modal-title">Advanced Filters</h2>
            <button class="filter-modal-close" id="filterModalClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="filter-modal-body">
		
		<form method="post" action="" enctype="multipart/form-data" >
            <!-- Basic Filters -->
            <div class="filter-section">
                <h3 class="filter-section-title">
                    <i class="fas fa-sliders-h"></i>
                    Basic Filters
                </h3>
                
                <div class="filter-group">
                    <label class="filter-label">Gender</label>
                    <select class="filter-select" id="genderFilter" name="f_gender">
                        <option value="Male" <?php if(!isset($_POST['f_gender']) || (isset($_POST['f_gender']) && $_POST['f_gender'] == 'Male')) { echo 'selected'; } ?> >Male</option>
                        <option value="Female" <?php if((isset($_POST['f_gender']) && $_POST['f_gender'] == 'Female')){ echo 'selected'; } ?> >Female</option>
                        <option value="Transgender" <?php if((isset($_POST['f_gender']) && $_POST['f_gender'] == 'Transgender')){ echo 'selected'; } ?> >Transgender</option>
                        <option value="any" <?php if((isset($_POST['f_gender']) && $_POST['f_gender'] == 'any')){ echo 'selected'; } ?> >Any</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Age Range</label>
                    <div class="range-container">
                        <span class="range-value" id="ageMinValue">18</span>
                        <input type="range" class="range-slider" min="18" max="65" value="18" id="ageRange" name="f_age" value="<?php if(isset($_POST['f_age'])) echo $_POST['f_age']; ?>" >
                        <span class="range-value" id="ageMaxValue">65+</span>
                    </div>
                </div>

                <?php /*?><div class="filter-group">
                    <label class="filter-label">Online Status</label>
                    <select class="filter-select" id="onlineStatusFilter">
                        <option value="now" selected>Online Now</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="anytime">Anytime</option>
                    </select>
                </div> 

                <div class="filter-group">
                    <div class="toggle-container">
                        <span class="filter-label">Verified Photos Only</span>
                        <div class="toggle-switch active" id="verifiedToggle"></div>
                    </div>
                    <div class="toggle-container">
                        <span class="filter-label">Exclude Messaged</span>
                        <div class="toggle-switch" id="excludeMessagedToggle"></div>
                    </div>
                </div><?php */ ?>

                <div class="filter-group">
                    <label class="filter-label">Search by City / Place</label>
                    <input type="text" class="filter-input" placeholder="e.g., New York" id="locationFilter" name="f_location" value="<?php if(isset($_POST['f_location'])) echo $_POST['f_location']; ?>" >
                </div>

                <?php /*?><div class="filter-group">
                    <label class="filter-label">Distance</label>
                    <div class="range-container">
                        <span class="range-value">1km</span>
                        <input type="range" class="range-slider" min="1" max="200" value="50" id="distanceRange">
                        <span class="range-value" id="distanceValue">200km</span>
                    </div>
                </div> 

                <div class="filter-group">
                    <label class="filter-label">Member Type</label>
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-type="all">All Members</button>
                        <button class="filter-btn" data-type="new">New</button>
                        <button class="filter-btn" data-type="hot">Hot</button>
                    </div>
                </div><?php */ ?>
            </div>

            <!-- Premium Filters -->
            <div class="filter-section" <?php if(!$user_have_preminum) {?>style="opacity:0.2; pointer-events: none; user-select: none;" <?php }?> >
                <h3 class="filter-section-title">
                    <i class="fas fa-crown"></i>
                    Premium Filters
                    <span class="premium-badge">Premium</span>
                </h3>

                <?php  if($privacy_setting['verified_photos'] || $privacy_setting['exclude_message_already']) { ?>

                    <div class="filter-group">

                        <?php  if($privacy_setting['verified_photos']) { ?>
                            <div class="toggle-container">
                                <span class="filter-label">Verified Photos Only</span>
                                <div class="toggle-switch" id="verifiedToggle"></div>

                                <input type="hidden" value="" name="verified_photos" id="verified_photos">
                            </div>

                        <?php }?>

                        <?php  if($privacy_setting['exclude_message_already']) {?>

                            <div class="toggle-container">
                                <span class="filter-label">Exclude Messaged</span>
                                <div class="toggle-switch" id="excludeMessagedToggle"></div>

                                <input type="hidden" value="" name="exclude_message_already" id="exclude_message_already">

                            </div>

                        <?php }?>
                    </div>

                <?php } ?>

                <div class="filter-group f-g1">
                    <label class="filter-label">Height</label>
                    <div class="range-container">
                        <span class="range-value">120cm</span>
                        <input type="range" class="range-slider" min="120" max="200" value="160" id="heightRange" name="f_height" value="<?php if(isset($_POST['f_height'])) echo $_POST['f_height']; ?>" >
                        <span class="range-value" id="heightValue">200cm</span>
                    </div>

                    <div class="text-center mt-1 measurement">
                        120 - 200 cm
                    </div>
                    
                </div>

                <div class="filter-group f-g2">
                    <label class="filter-label">Weight</label>
                    <div class="range-container">
                        <span class="range-value">30kg</span>
                        <input type="range" class="range-slider" min="30" max="150" value="60" id="weightRange" name="f_weight" value="<?php if(isset($_POST['f_weight'])) echo $_POST['f_weight']; ?>" >
                        <span class="range-value" id="weightValue">150kg</span>
                    </div>
                    <div class="text-center mt-1 measurement">
                        30 - 60 kg
                    </div>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Body Type</label>
                    <select class="filter-select" id="bodyTypeFilter" name="f_body_type">
                        <option value="any" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'any'){ echo 'selected'; } ?> >Any</option>
                        <option value="Petite" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'Petite'){ echo 'selected'; } ?> >Petite</option>
                        <option value="Slim" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'Slim'){ echo 'selected'; } ?> >Slim</option>
                        <option value="Athletic" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'Athletic'){ echo 'selected'; } ?> >Athletic</option>
                        <option value="Average" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'Average'){ echo 'selected'; } ?> >Average</option>
                        <option value="Curvy" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'Curvy'){ echo 'selected'; } ?> >Curvy</option>
						<option value="Full Figured" <?php if(isset($_POST['f_body_type']) && $_POST['f_body_type'] == 'Full Figured'){ echo 'selected'; } ?> >Full Figured</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Ethnicity</label>
                    <select class="filter-select" id="ethnicityFilter" name="f_ethnicity">
                        <option value="any" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'any'){ echo 'selected'; } ?> >Any</option>
                        <option value="asian" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'asian'){ echo 'selected'; } ?> >Asian</option>
                        <option value="black" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'black'){ echo 'selected'; } ?> >Black</option>
                        <option value="hispanic" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'hispanic'){ echo 'selected'; } ?> >Hispanic</option>
                        <option value="white" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'white'){ echo 'selected'; } ?> >White</option>
                        <option value="mixed" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'mixed'){ echo 'selected'; } ?> >Mixed</option>
                        <option value="other" <?php if(isset($_POST['f_ethnicity']) && $_POST['f_ethnicity'] == 'other'){ echo 'selected'; } ?> >Other</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Hair Color</label>
                    <select class="filter-select" id="hairColorFilter" name="f_hair_color">
                        <option value="any" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'any'){ echo 'selected'; } ?> >Any</option>
                        <option value="Blonde" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Blonde'){ echo 'selected'; } ?> >Blonde</option>
                        <option value="Brunette" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Brunette'){ echo 'selected'; } ?> >Brunette</option>
                        <option value="Black" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Black'){ echo 'selected'; } ?> >Black</option>
                        <option value="Red" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Red'){ echo 'selected'; } ?> >Red</option>
                        <option value="Auburn" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Auburn'){ echo 'selected'; } ?> >Auburn</option>
						<option value="Gray" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Gray'){ echo 'selected'; } ?> >Gray</option>
						<option value="Other" <?php if(isset($_POST['f_hair_color']) && $_POST['f_hair_color'] == 'Other'){ echo 'selected'; } ?> >Other</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Eye Color</label>
                    <select class="filter-select" id="eyeColorFilter" name="f_eye_color" >
                        <option value="any" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'any'){ echo 'selected'; } ?> >Any</option>
                        <option value="Brown" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'Brown'){ echo 'selected'; } ?> >Brown</option>
                        <option value="Blue" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'Blue'){ echo 'selected'; } ?> >Blue</option>
                        <option value="Green" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'Green'){ echo 'selected'; } ?> >Green</option>
                        <option value="Hazel" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'Hazel'){ echo 'selected'; } ?> >Hazel</option>
                        <option value="Gray" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'Gray'){ echo 'selected'; } ?> >Gray</option>
						<option value="Other" <?php if(isset($_POST['f_eye_color']) && $_POST['f_eye_color'] == 'Other'){ echo 'selected'; } ?> >Other</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">No Children</label>
                    <select class="filter-select" name="children_preference" id="noChildrenFilter">
                        <option value="any">Any</option>
                        <option value="no-children" <?php if (isset($_POST['children_preference'])  && $_POST['children_preference'] =='no-children') { ?> selected <?php } ?> >No Children</option>
                        <option value="wants-children" <?php if (isset($_POST['children_preference'])  && $_POST['children_preference'] =='wants-children') { ?> selected <?php } ?> >Wants Children</option>
                        <option value="has-children" <?php if (isset($_POST['children_preference'])  && $_POST['children_preference'] =='has-children') { ?> selected <?php } ?> >Has Children</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Education</label>
                    <select class="filter-select" id="educationFilter" name="education_level">
                        <option value="any">Any</option>
                        <option value="high-school" <?php if ( isset($_POST['education_level'])  && $_POST['education_level'] =='high-school') { ?> selected <?php } ?> >High School</option>
                        <option value="college" <?php if (isset($_POST['education_level'])  && $_POST['education_level'] =='college') { ?> selected <?php } ?> > College</option>
                        <option value="university" <?php if (isset($_POST['education_level'])  && $_POST['education_level'] =='university') { ?> selected <?php } ?> >University</option>
                        <option value="graduate"  <?php if (isset($_POST['education_level'])  && $_POST['education_level'] =='graduate') { ?> selected <?php } ?>>Graduate Degree</option>
                        <option value="masters" <?php if (isset($_POST['education_level'])  && $_POST['education_level'] =='masters') { ?> selected <?php } ?>>Masters</option>
                        <option value="phd" <?php if (isset($_POST['education_level'])  && $_POST['education_level'] =='phd') { ?> selected <?php } ?> >PhD</option>

                    </select>
                </div>

                <?php /*?><div class="filter-group">
                    <label class="filter-label">No Children</label>
                    <select class="filter-select" id="noChildrenFilter">
                        <option value="any">Any</option>
                        <option value="no">No Children</option>
                        <option value="yes">Has Children</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Wants Children</label>
                    <select class="filter-select" id="wantsChildrenFilter">
                        <option value="any">Any</option>
                        <option value="yes">Wants Children</option>
                        <option value="no">Doesn't Want Children</option>
                        <option value="maybe">Maybe</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Education</label>
                    <select class="filter-select" id="educationFilter">
                        <option value="any">Any</option>
                        <option value="high-school">High School</option>
                        <option value="college">College</option>
                        <option value="university">University</option>
                        <option value="masters">Masters</option>
                        <option value="phd">PhD</option>
                    </select>
                </div><?php */ ?>

                <div class="filter-group">
                    <label class="filter-label">English Language Ability</label>
                    <select class="filter-select" id="languageFilter" name="f_language">
                        <option value="any" <?php if(isset($_POST['f_language']) && $_POST['f_language'] == 'any'){ echo 'selected'; } ?> >Any</option>
                        <option value="Native" <?php if(isset($_POST['f_language']) && $_POST['f_language'] == 'Native'){ echo 'selected'; } ?> >Native</option>
                        <option value="Fluent" <?php if(isset($_POST['f_language']) && $_POST['f_language'] == 'Fluent'){ echo 'selected'; } ?> >Fluent</option>
                        <option value="Conversational" <?php if(isset($_POST['f_language']) && $_POST['f_language'] == 'Conversational'){ echo 'selected'; } ?> >Conversational</option>
                        <option value="Basic" <?php if(isset($_POST['f_language']) && $_POST['f_language'] == 'Basic'){ echo 'selected'; } ?> >Basic</option>
                    </select>
                </div>

                <?php /* ?><div class="filter-group">
                    <label class="filter-label">Respect Their Age Range</label>
                    <select class="filter-select" id="respectAgeFilter">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div><?php */ ?>
            </div>

            <!-- Filter Actions -->
            <div class="filter-modal-actions">
                <button class="modal-btn secondary" id="clearAllBtn">
                    Clear All
                </button>
                <button class="modal-btn primary" id="applyFiltersBtn" type="submit" name="filter_submit" value="apply">
                    Apply Filters
                </button>
            </div>
			
		</form>
			
        </div>
    </div>

<?php include('includes/footer.php'); ?>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<?php 

    $getSettings = mysqli_query($con, "SELECT discount_price_show, updated_at FROM admin_settings ORDER BY id DESC LIMIT 1");

    $settings = mysqli_fetch_assoc($getSettings);

    $discountPriceShow=true;

    $updatedAt = $settings['updated_at']; 

        if ($updatedAt) {
            $timeDiff = time() - strtotime($updatedAt);
            if ($timeDiff > 86400 && $settings['status']=='No') {

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

        <?php if($discountPriceShow) { ?>

            <div class="countdown-timer">
                ⏰ LIMITED TIME: <span id="countdown">23:59:45</span> REMAINING!
            </div>
            
        <?php }?>

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


<!-- Modal structure -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Follow Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        Please login <a href="<?php echo SITEURL.'login.php'; ?>">here</a>.
       </div>
      

    </div>
  </div>
</div>


  <div class="modal-overlay" id="success_modal" >
    <div class="modal" style="display:block; height:auto;">
      <div class="modal-header">
        <h2 class="modal-title">Success</h2>
        <button class="close-modal" id="closeTipModal" type="button" onclick="CloseModal()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body" id="modal_success_message">


        <button class="btn btn-primary" type="button" onclick="CloseModal()">Close</button>
      </div>
    </div>
  </div>

<?php if (!isset($_POST['filter_submit'])){ ?>
<script>


let offset = 0;
const limit = 8;

jQuery('#loadMoreBtn').on('click', function($) { 
   
offset = offset+limit;	
	 
	jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'load_more_model.php'?>",
				data:{offset:offset,total:"<?php echo $row_cnt['total']; ?>",sort:"<?php echo $sort_filter; ?>"},
				dataType:'json',
				success: function(response){ console.log(response.html);
					jQuery('#profileGrid').append(response.html);
					

					if (response.loadmore == 'no') {
						jQuery('#loadMoreBtn').hide(); // Hide button if no more data
					}
				}
			});
	
	
});
</script>
<?php } ?>

<script>


        const premiumAmounts = <?php echo json_encode($premium_amounts); ?>;

        function upgradeAccount(plan_type, plan_status) {

   
            let key = '';
            if (plan_status === 'basic') {
                key = 'basic_with_discount';
                if (plan_type === 'annual') {
                    key = 'basic_with_discount_yearly';
                }
            } else if (plan_status === 'diamond') {
                key = 'diamond_with_discount';
                if (plan_type === 'annual') {
                    key = 'diamond_with_discount_yearly';
                }
            }

            const amount = premiumAmounts[key];

            const form = document.createElement('form');
            form.method = 'POST'; 
            form.action = 'payments/preminum.php'; 

            const inputPlanType = document.createElement('input');
            inputPlanType.type = 'hidden';
            inputPlanType.name = 'plan_type';
            inputPlanType.value = plan_type;
            form.appendChild(inputPlanType);

            const inputPlanStatus = document.createElement('input');
            inputPlanStatus.type = 'hidden';
            inputPlanStatus.name = 'plan_status';
            inputPlanStatus.value = plan_status;
            form.appendChild(inputPlanStatus);

            const inputAmount = document.createElement('input');
            inputAmount.type = 'hidden';
            inputAmount.name = 'amount';
            inputAmount.value = amount;
            form.appendChild(inputAmount);

            document.body.appendChild(form);
            form.submit();
        }




$(document).ready(function() {
    
  $('.toggle-option').on('click', function() {
  
    $('.toggle-option').removeClass('active');
    $(this).addClass('active');

    const billingType = $(this).data('billing');

    $('.pricing-card').each(function() {
      const $card = $(this);

      const $originalPriceEl = $card.find('.original-price');
      const $priceEl = $card.find('.price');
      const $pricePeriodEl = $card.find('.price-period');
      const $savingsTextEl = $card.find('.savings-text');
      const $bonusTokensSpan = $card.find('.bonus-tokens span');
      const $btn = $card.find('button.cta-button');

      $originalPriceEl.text(`$${$originalPriceEl.data(`${billingType}-orig`)}`);
      $priceEl.text(`$${$priceEl.data(billingType)}`);

      $pricePeriodEl.text($pricePeriodEl.data(`${billingType}-period`));

      $savingsTextEl.text($savingsTextEl.data(`${billingType}-save`));

      const tokens = $bonusTokensSpan.data(`${billingType}-tokens`);
      $bonusTokensSpan.text(`+ ${tokens} TLM tokens`);

      if ($btn.length) {
        const planType = $card.hasClass('elite') ? 'diamond' : 'basic';
        $btn.attr('onclick', `upgradeAccount('${billingType}', '${planType}')`);
      }
    });
  });

  $('.toggle-option.active').click();
});


// $(document).on('click', function(e) {
//     const $btn = $(e.target).closest('.action-btn');
//     if ($btn.length) {
//         const action = $btn.hasClass('connect') ? 'connect' :
//                        $btn.hasClass('like') ? 'like' : 'pass';
//         const modelid = $btn.attr('modelid'); 
        
//         if (modelid && modelid.trim() !== '') {
//             handleProfileAction($btn, action, modelid);
//         }
//     }
// });

    const updatedAt = new Date("<?php echo $updatedAt; ?>").getTime();

    const countdownTarget = updatedAt + (24 * 60 * 60 * 1000);

    function updateCountdown() {
        const now = new Date().getTime();
        const timeLeft = countdownTarget - now;

        if (timeLeft <= 0) {
            document.getElementById('countdown').textContent = "00:00:00";
            return;
        }

        const hours = Math.floor(timeLeft / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.getElementById('countdown').textContent =
            `${hours.toString().padStart(2, '0')}:` +
            `${minutes.toString().padStart(2, '0')}:` +
            `${seconds.toString().padStart(2, '0')}`;
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();


function ShowPremium()
{
    $('#premium-modal').addClass('show');
}

function closePremiumModal()
{
    $('#premium-modal').removeClass('show');
}

function ActionBtn(element,action)
{

     $(element).css('transform', 'scale(1.2)');
        setTimeout(() => {
            $(element).css('transform', 'scale(1)');
        }, 200);

        const modelid = $(element).attr('modelid');

     const $card = $(element).closest('.profile-card');
    const profileName = $(element).find('.profile-name').text().split(',')[0];

    switch (action) {
        case 'connect':
            
			jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'/ajax/model_followrequest.php'?>",
				data:{modelid:modelid,notification_type:'follow'},
				dataType:'json',
				success: function(response){ 
					showNotification(`Connection request sent to ${profileName}!`, 'success');
				}
			});
			
            break;
        case 'like':
            $(element).css('color', 'var(--secondary)');
            //ajax for increase like count
			jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'/ajax/model_like.php'?>",
				data:{modelid:modelid},
				dataType:'json',
				success: function(response){ 


                        console.log(response);
                    if(response.status =="success")
                    {
                        $('#message_pag').remove();

                        $('#modal_success_message').prepend(`<p id="message_pag" class="success-text">${response.message}</p>`);

                        $('#success_modal').addClass('active');

                        setTimeout(() => {
                            
                             $('#success_modal').removeClass('active');

                        }, 3000);
					    // showNotification(`You liked ${profileName}!`, 'success');
                    }
				}
			});
			
            break;
        case 'pass':
            $card.css('opacity', '0.5');
            setTimeout(() => {
                $card.css('display', 'none');
            }, 300);
            showNotification(`${profileName} has been hidden`, 'info');
            break;
    }
}
// Handle Profile Actions
function handleProfileAction($button, action, modelid) {
    // Add visual feedback
    // $button.css('transform', 'scale(1.2)');
    //     setTimeout(() => {
    //         $button.css('transform', 'scale(1)');
    //     }, 200);

    const $card = $button.closest('.profile-card');
    const profileName = $card.find('.profile-name').text().split(',')[0];

    switch (action) {
        case 'connect':
            
			//ajax for follow request
			jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'/ajax/model_followrequest.php'?>",
				data:{modelid:modelid,notification_type:'follow'},
				dataType:'json',
				success: function(response){ 
					showNotification(`Connection request sent to ${profileName}!`, 'success');
				}
			});
			
            break;
        case 'like':
            $button.css('color', 'var(--secondary)');
            //ajax for increase like count
			jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'/ajax/model_like.php'?>",
				data:{modelid:modelid},
				dataType:'json',
				success: function(response){ 
					showNotification(`You liked ${profileName}!`, 'success');
				}
			});
			
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

<script>
        // DOM Elements
        const sortBtn = document.getElementById('sortBtn');
        const sortOptions = document.getElementById('sortOptions');
        const filterBtn = document.getElementById('filterBtn');
        const filterModal = document.getElementById('filterModal');
        const filterModalOverlay = document.getElementById('filterModalOverlay');
        const filterModalClose = document.getElementById('filterModalClose');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const loadingSpinner = document.getElementById('loadingSpinner');

        // Range sliders
        const ageRange = document.getElementById('ageRange');
        const distanceRange = document.getElementById('distanceRange');
        const heightRange = document.getElementById('heightRange');
        const weightRange = document.getElementById('weightRange');

        // Toggle switches
        const verifiedToggle = document.getElementById('verifiedToggle');
        const excludeMessagedToggle = document.getElementById('excludeMessagedToggle');

        // Filter buttons
        const memberTypeButtons = document.querySelectorAll('[data-type]');
        const clearAllBtn = document.getElementById('clearAllBtn');
        const applyFiltersBtn = document.getElementById('applyFiltersBtn');

        // Sort Dropdown Functionality
        sortBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            sortOptions.classList.toggle('active');
        });

        // Close sort dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!sortBtn.contains(e.target) && !sortOptions.contains(e.target)) {
                sortBtn.classList.remove('active');
                sortOptions.classList.remove('active');
            }
        });

        // Sort option selection
        document.querySelectorAll('.sort-option').forEach(option => {
            option.addEventListener('click', function() {
                const sortType = this.dataset.sort;
                const sortText = this.textContent;
                
                sortBtn.querySelector('span').textContent = sortText;
                sortBtn.classList.remove('active');
                sortOptions.classList.remove('active');
                
                // Apply sorting logic
                applySorting(sortType);
                console.log('Sorting by:', sortType);
            });
        });

        // Filter Modal Functionality
        function openFilterModal() { 
            filterModal.classList.add('active');
            filterModalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeFilterModal() {
            filterModal.classList.remove('active');
            filterModalOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        filterBtn.addEventListener('click', openFilterModal);
        filterModalClose.addEventListener('click', closeFilterModal);
        filterModalOverlay.addEventListener('click', closeFilterModal);

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFilterModal();
                sortBtn.classList.remove('active');
                sortOptions.classList.remove('active');
            }
        });

        // Range Slider Updates
        if (ageRange) {
            ageRange.addEventListener('input', function() {
                const value = parseInt(this.value);
                document.getElementById('ageMinValue').textContent = '18';
                document.getElementById('ageMaxValue').textContent = value >= 65 ? '65+' : value.toString();
            });
        }

        if (distanceRange) {
            distanceRange.addEventListener('input', function() {
                const value = parseInt(this.value);
                document.getElementById('distanceValue').textContent = value >= 200 ? '200km+' : value + 'km';
            });
        }

        if (heightRange) {
            heightRange.addEventListener('input', function() {
                const value = parseInt(this.value);
                document.getElementById('heightValue').textContent = value + 'cm';
            });
        }

        if (weightRange) {
            weightRange.addEventListener('input', function() {
                const value = parseInt(this.value);
                document.getElementById('weightValue').textContent = value + 'kg';
            });
        }

        // Toggle Switch Functionality
        function setupToggle(toggle,name) {

            console.log(name,'namenamename');
            if (toggle) {
                toggle.addEventListener('click', function() {
                    this.classList.toggle('active');

                    console.log(name,'active');

                   if (this.classList.contains('active')) {
                        $(`#${name}`).val('Yes');
                    } else {
                        $(`#${name}`).val('No');
                    }
                });
            }
        }

        setupToggle(verifiedToggle,'verified_photos');
        setupToggle(excludeMessagedToggle,'exclude_message_already');

        // Member Type Filter Buttons
        memberTypeButtons.forEach(button => {
            button.addEventListener('click', function() {
                memberTypeButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Clear All Filters
        clearAllBtn.addEventListener('click', function() {
            // Reset all form elements
            document.querySelectorAll('.filter-select').forEach(select => {
                select.selectedIndex = 0;
            });
            
            document.querySelectorAll('.filter-input').forEach(input => {
                input.value = '';
            });
            
            document.querySelectorAll('.range-slider').forEach(slider => {
                slider.value = slider.min;
                // Trigger input event to update display
                slider.dispatchEvent(new Event('input'));
            });
            
            document.querySelectorAll('.toggle-switch').forEach(toggle => {
                toggle.classList.remove('active');
            });
            
            // Reset verified toggle to active (default state)
            if (verifiedToggle) {
                verifiedToggle.classList.add('active');
            }
            
            // Reset member type buttons
            memberTypeButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelector('[data-type="all"]').classList.add('active');
            
            console.log('All filters cleared');
        });

        // Apply Filters
        /*applyFiltersBtn.addEventListener('click', function() {
            const filters = collectFilterData();
            applyFilters(filters);
            closeFilterModal();
            console.log('Filters applied:', filters);
        }); */

        // Collect Filter Data
        function collectFilterData() {
            return {
                gender: document.getElementById('genderFilter')?.value || 'women',
                ageRange: document.getElementById('ageRange')?.value || 18,
                onlineStatus: document.getElementById('onlineStatusFilter')?.value || 'now',
                verified: verifiedToggle?.classList.contains('active') || false,
                excludeMessaged: excludeMessagedToggle?.classList.contains('active') || false,
                location: document.getElementById('locationFilter')?.value || '',
                distance: document.getElementById('distanceRange')?.value || 50,
                memberType: document.querySelector('.filter-btn.active[data-type]')?.dataset.type || 'all',
                // Premium filters
                height: document.getElementById('heightRange')?.value || 160,
                weight: document.getElementById('weightRange')?.value || 60,
                bodyType: document.getElementById('bodyTypeFilter')?.value || 'any',
                ethnicity: document.getElementById('ethnicityFilter')?.value || 'any',
                hairColor: document.getElementById('hairColorFilter')?.value || 'any',
                eyeColor: document.getElementById('eyeColorFilter')?.value || 'any',
                noChildren: document.getElementById('noChildrenFilter')?.value || 'any',
                wantsChildren: document.getElementById('wantsChildrenFilter')?.value || 'any',
                education: document.getElementById('educationFilter')?.value || 'any',
                language: document.getElementById('languageFilter')?.value || 'any',
                respectAge: document.getElementById('respectAgeFilter')?.value || 'no'
            };
        }

        // Apply Filters Function
        function applyFilters(filters) {
            // Show loading state
            showLoadingState();
            
            // Simulate API call
            setTimeout(() => {
                hideLoadingState();
                updateProfileGrid(filters);
                updateResultsCount();
            }, 1000);
        }

        // Apply Sorting Function
        function applySorting(sortType) { 
            showLoadingState();
            
            setTimeout(() => {
                hideLoadingState();
                sortProfileGrid(sortType);
            }, 500);
        }

        // Load More Functionality
        loadMoreBtn.addEventListener('click', function() {
            this.style.display = 'none';
            loadingSpinner.classList.remove('hidden');
            
            // Simulate loading more profiles
            setTimeout(() => {
                loadingSpinner.classList.add('hidden');
                this.style.display = 'block';
                addMoreProfiles();
            }, 2000);
        });

        // Profile Action Buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.action-btn')) {
                const btn = e.target.closest('.action-btn');
                const action = btn.classList.contains('connect') ? 'connect' : 
                              btn.classList.contains('like') ? 'like' : 'pass';
                
                handleProfileAction(btn, action);
            }
        });

        // Handle Profile Actions
        function handleProfileAction(button, action) {
            // Add visual feedback
            button.style.transform = 'scale(1.2)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 200);
            
            const card = button.closest('.profile-card');
            const profileName = card.querySelector('.profile-name').textContent.split(',')[0];
            
            switch(action) {
                case 'connect':
                    showNotification(`Connection request sent to ${profileName}!`, 'success');
                    break;
                case 'like':
                    button.style.color = 'var(--secondary)';
                    showNotification(`You liked ${profileName}!`, 'success');
                    break;
                case 'pass':
                    card.style.opacity = '0.5';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                    showNotification(`${profileName} has been hidden`, 'info');
                    break;
            }
            
            console.log(`${action} action for ${profileName}`);
        }

        // Utility Functions
        function showLoadingState() {
            const profileCards = document.querySelectorAll('.profile-card');
            profileCards.forEach(card => {
                card.style.opacity = '0.6';
                card.style.pointerEvents = 'none';
            });
        }

        function hideLoadingState() {
            const profileCards = document.querySelectorAll('.profile-card');
            profileCards.forEach(card => {
                card.style.opacity = '1';
                card.style.pointerEvents = 'auto';
            });
        }

        function updateProfileGrid(filters) {
            // This would normally update the grid based on filters
            console.log('Updating profile grid with filters:', filters);
        }

        function sortProfileGrid(sortType) {
            // This would normally sort the profiles
            console.log('Sorting profiles by:', sortType);
        }

        function updateResultsCount() {
            // This would update the results count display
            console.log('Results count updated');
        }

        function addMoreProfiles() {
            // This would add more profile cards to the grid
            console.log('More profiles loaded');
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

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Live Models page initialized');
            
            // Set initial range values
            if (ageRange) ageRange.dispatchEvent(new Event('input'));
            if (distanceRange) distanceRange.dispatchEvent(new Event('input'));
            if (heightRange) heightRange.dispatchEvent(new Event('input'));
            if (weightRange) weightRange.dispatchEvent(new Event('input'));
        });

        // Smooth scrolling for anchor links
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

        // Performance optimization - Intersection Observer for lazy loading
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                }
            });
        });

        // Observe all images with data-src attribute
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    </script>

       
  </body>





</html> 

