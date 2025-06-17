<?php 
  session_start(); 
  include('includes/config.php');
  include('includes/helper.php');
?>

<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>    <meta charset="UTF-8">    <meta name="viewport" content="width=device-width, initial-scale=1.0">        <!-- SEO Meta Tags -->    <title>All Live Models - Premium Dating & Connection Platform | TheLiveModels.com</title>    <meta name="description" content="Discover and connect with thousands of verified live models worldwide. Premium dating platform with advanced filters, real-time chat, and authentic connections.">    <meta name="keywords" content="live models, verified models, premium dating, online dating, model connections, chat with models">    <meta name="robots" content="index, follow">    <meta name="author" content="TheLiveModels.com">        <!-- Open Graph Meta Tags -->    <meta property="og:title" content="All Live Models - Premium Dating & Connection Platform">    <meta property="og:description" content="Discover and connect with thousands of verified live models worldwide. Premium dating platform with advanced filters and authentic connections.">    <meta property="og:type" content="website">    <meta property="og:url" content="https://thelivemodels.com/all-models">    <meta property="og:site_name" content="TheLiveModels.com">    <meta property="og:image" content="https://thelivemodels.com/images/og-image.jpg">        <!-- Twitter Card Meta Tags -->    <meta name="twitter:card" content="summary_large_image">    <meta name="twitter:title" content="All Live Models - Premium Dating & Connection Platform">    <meta name="twitter:description" content="Discover and connect with thousands of verified live models worldwide.">    <meta name="twitter:image" content="https://thelivemodels.com/images/twitter-image.jpg">        <!-- Canonical URL -->    <link rel="canonical" href="https://thelivemodels.com/all-models">        <!-- Favicon -->    <link rel="icon" type="image/x-icon" href="/favicon.ico">    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">    <link rel="stylesheet" href="./assets/css/stylesheet.css" />        <!-- External Resources -->    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">        <!-- Structured Data -->    <script type="application/ld+json">    {        "@context": "https://schema.org",        "@type": "WebPage",        "name": "All Live Models",        "description": "Browse and connect with verified live models from around the world",        "url": "https://thelivemodels.com/all-models",        "mainEntity": {            "@type": "ItemList",            "name": "Live Models Directory",            "description": "Comprehensive directory of verified live models"        }    }    </script></head>

<body class="premimum-model1">
    <?php include('includes/header.php'); ?>
	<!-- Main Content -->    <main class="main-content">        <div class="container">            <div class="profile-grid" id="profileGrid">						<?php $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes'  Order by id DESC ";              $resultd = mysqli_query($con, $sqls);                if (mysqli_num_rows($resultd) > 0) { 								while($rowesdw = mysqli_fetch_assoc($resultd)) {                     $unique_id = $rowesdw['unique_id'];					 					 if(!empty($rowesdw['profile_pic'])){						 $profile_pic = SITEURL.$rowesdw['profile_pic'];					 }else{						 $profile_pic = SITEURL.'assets/images/model-gal-no-img.jpg';					 }					 					 if(!empty($rowesdw['username'])){						 $modalname = $rowesdw['username'];					 }else{						 $modalname = $rowesdw['name'];					 }					 				?>			                <!-- Profile Card 1 -->                <div class="profile-card">                    <div class="profile-image-container">                        <img src="<?php echo $profile_pic; ?>" alt="<?php echo $modalname,', '.$rowesdw['age']; ?>" class="profile-image">                        <div class="profile-badges">                            <span class="profile-badge badge-live">Live</span>                            <span class="profile-badge badge-verified">Verified</span>                        </div>                    </div>                    <div class="profile-info">                        <h3 class="profile-name"><?php echo $modalname.', '.$rowesdw['age']; ?></h3>						<?php if(!empty($rowesdw['city']) || !empty($rowesdw['country'])){ ?>                        <p class="profile-location">                            <i class="fas fa-map-marker-alt"></i>                            <?php echo $rowesdw['city']; ?><?php if(!empty($rowesdw['city']) && !empty($rowesdw['country'])) { ?>,<?php } ?> <?php echo $rowesdw['country']; ?>                        </p>						<?php } if(!empty($rowesdw['user_bio'])){ 						$user_bio  = limit_text(strip_tags($rowesdw['user_bio']),15).'...';						?>                        <p class="profile-bio"><?php echo $user_bio; ?></p>						<?php } ?>                    </div>                    <div class="profile-actions">                        <button class="action-btn connect" title="Connect">                            <i class="fas fa-user-plus"></i>                        </button>                        <button class="action-btn like" title="Like">                            <i class="fas fa-heart"></i>                        </button>                        <button class="action-btn pass" title="Pass">                            <i class="fas fa-times"></i>                        </button>                    </div>                </div>				<?php } ?>				<?php } else{					echo '<p class="not-found-model">No models found.</p>';				} ?>                            </div>            <!-- Load More -->            <div class="load-more">                <button class="load-more-btn" id="loadMoreBtn">                    <i class="fas fa-plus-circle"></i>                    Load More Profiles                </button>                <div class="loading-spinner hidden" id="loadingSpinner"></div>            </div>        </div>    </main>
    <?php /*?><div class="container">
        <!-- <h2 class="page_heading">All Models</h2> -->
    <div class="login-signup">
      <div class="row">
        <div class="col-md-12 nav-tab-holder">
        <ul class="nav nav-tabs row" role="tablist">
          <li role="presentation" class="active col-sm-4"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Male </a></li>
          <li role="presentation" class="col-sm-4"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Female  </a></li>
          <li role="presentation" class="col-sm-4"><a href="#couple" aria-controls="couple" role="tab" data-toggle="tab">Couple  </a></li>
        </ul>
      </div>
      </div>
      
  <div class="tab-content">
    <div  role="tabpanel" class=" my_form tab-pane active" id="home">
      <?php
          $country = $_GET['country'];

          $count = 1;
            $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' AND gender = 'Male'  Order by id DESC ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw = mysqli_fetch_assoc($resultd)) {
                     $unique_id = $rowesdw['unique_id'];




                      $sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result = mysqli_query($con, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while($rowe = mysqli_fetch_assoc($result)) {
                           $image_c = $rowe["count(*)"];
                        }
                      }
                      $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result1 = mysqli_query($con, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                        while($rowe1 = mysqli_fetch_assoc($result1)) {
                           $vdo_c = $rowe["count(*)"];
                        }
                      }                           


          ?>
          <div class="col-md-3">
            <div id="creator-list">
              <div class="creator">
                    <a href="single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>">
                        <figure><img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="" /></figure>
                        <h5 class="model_name"><?php echo $rowesdw['username']; ?></h5>
                        <div class="cr_posts">
                            <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                              <small><?php if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                                <small><?php if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
                        </div>
                        <div class="cr_rating"></div>
                    </a>
                </div>
                <span></span>
            </div>
          </div>
          <?php
              $count++;
              }
                } else {
                  echo "0 results";
                }
          ?>
    </div>

    <div  role="tabpanel" class="tab-pane" id="profile">
       <?php
          $country = $_GET['country'];

          $count = 1;
            $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' AND gender = 'Female'  Order by id DESC ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw = mysqli_fetch_assoc($resultd)) {
                     $unique_id = $rowesdw['unique_id'];




                      $sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result = mysqli_query($con, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while($rowe = mysqli_fetch_assoc($result)) {
                           $image_c = $rowe["count(*)"];
                        }
                      }
                      $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result1 = mysqli_query($con, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                        while($rowe1 = mysqli_fetch_assoc($result1)) {
                           $vdo_c = $rowe["count(*)"];
                        }
                      }                           


          ?>
           <div class="col-md-3">
            <div id="creator-list">
              <div class="creator">
                    <a href="single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>">
                        <figure><img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="" /></figure>
                        <h5 class="model_name"><?php echo $rowesdw['username']; ?></h5>
                        <div class="cr_posts">
                            <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                              <small><?php if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                                <small><?php if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
                        </div>
                        <div class="cr_rating"></div>
                    </a>
                </div>
                <span></span>
            </div>
          </div>
          <?php
              $count++;
              }
                } else {
                  echo "0 results";
                }
          ?>
    </div>

     <div  role="tabpanel" class="tab-pane" id="couple">
      <?php
          $country = $_GET['country'];

          $count = 1;
            $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' AND gender = 'Couple'  Order by id DESC ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw = mysqli_fetch_assoc($resultd)) {
                     $unique_id = $rowesdw['unique_id'];




                      $sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result = mysqli_query($con, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while($rowe = mysqli_fetch_assoc($result)) {
                           $image_c = $rowe["count(*)"];
                        }
                      }
                      $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
                      $result1 = mysqli_query($con, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                        while($rowe1 = mysqli_fetch_assoc($result1)) {
                           $vdo_c = $rowe["count(*)"];
                        }
                      }                           


          ?>
           <div class="col-md-3">
            <div id="creator-list">
              <div class="creator">
                    <a href="single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>">
                        <figure><img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" alt="" /></figure>
                        <h5 class="model_name"><?php echo $rowesdw['username']; ?></h5>
                        <div class="cr_posts">
                            <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                              <small><?php if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                                <small><?php if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
                        </div>
                        <div class="cr_rating"></div>
                    </a>
                </div>
                <span></span>
            </div>
          </div>
          <?php
              $count++;
              }
                } else {
                  echo "0 results";
                }
          ?>
    </div>

  </div>
        
          
      </div>
    </div><?php */ ?>

<!--       <div class="container-fluid">

        <div id="content" class="clearfix row">
        
       <section>
    <div class="container">
        <div class="allcreators">
          <?php
          // $country = $_GET['country'];

          // $count = 1;
          //   $sqls = "SELECT * FROM casting WHERE status = 'Published' Order by id ";
          //     $resultd = mysqli_query($con, $sqls);
          //       if (mysqli_num_rows($resultd) > 0) {
          //         while($rowesdw = mysqli_fetch_assoc($resultd)) {
          //            $unique_id = $rowesdw['unique_id'];

          //             $sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
          //             $result = mysqli_query($con, $sql);
          //             if (mysqli_num_rows($result) > 0) {
          //               while($rowe = mysqli_fetch_assoc($result)) {
          //                  $image_c = $rowe["count(*)"];
          //               }
          //             }
          //             $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";
          //             $result1 = mysqli_query($con, $sql1);
          //             if (mysqli_num_rows($result1) > 0) {
          //               while($rowe1 = mysqli_fetch_assoc($result1)) {
          //                  $vdo_c = $rowe["count(*)"];
          //               }
          //             }                           


          ?>
            <div id="creator-list">
                <div class="creator">
                    <a href="single-model.php?model=<?php// echo $rowesdw['username']; ?>&m_id=<?php// echo $rowesdw['id']; ?>&m_unique_id=<?php// echo $rowesdw['unique_id'];?>">
                        <figure><img src="<?php// echo $rowesdw['photo_1']; ?>" alt="" /></figure>
                        <h5 class="model_name"><?php// echo $rowesdw['username']; ?></h5>
                        <div class="cr_posts">
                            <span><i class="fa fa-picture-o" aria-hidden="true"></i>
                              <small><?php// if(!$image_c){ echo '0'; }else{ echo $image_c; } ?></small></span><span><i class="fa fa-video-camera" aria-hidden="true"></i>
                                <small><?php// if(!$vdo_c){ echo '0'; }else{ echo $vdo_c; } ?></small></span>
                        </div>
                        <div class="cr_rating"></div>
                    </a>
                </div>
             
              
                <span></span>
            </div>
             <?php
            // $count++;
            // }
            //   } else {
            //     echo "0 results";
            //   }
          ?>
        </div>
    </div>
</section>


                  
        </div>
      </div> --> 

   <?php include('includes/footer.php'); ?>
  </body>


</html> 
