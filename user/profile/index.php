<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

$activeTab = 'group-show';
$m_link= SITEURL.'user/group-show/';

if(isset($_SESSION["log_user_id"])){

	$usern = $_SESSION["log_user"];

	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
		die;
	}
}
else{
	echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
	die;
}

$mDefaultImage =SITEURL."/assets/images/girl.png";
if($userDetails['gender']=='Male'){
	$mDefaultImage =SITEURL."/assets/images/profile.png";
}
if(!empty($userDetails['profile_pic'])){
	$mDefaultImage = SITEURL.$userDetails['profile_pic'];
}

?>

<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

<title>Bookging | The Live Model</title>

<?php  include('../../includes/head.php'); ?>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />

</head>

<body class="socialwall-page">



 <?php  include('../../includes/side-bar.php'); ?>

 <?php  include('../../includes/profile_header_index.php'); ?>

<?php

    $user_id = $userDetails['unique_id']; 
    $posts = [];

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $followQuery = "SELECT unique_model_id FROM model_follow WHERE unique_user_id = ? AND status = 'Follow'";
    $stmt = $con->prepare($followQuery);

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query failed: " . $stmt->error);
    }

    $followed_model_unique_ids = [];
    while ($row = $result->fetch_assoc()) {
        $followed_model_unique_ids[] = $row['unique_model_id'];
    }

    $followed_user_ids = [];

    $followed_user_ids[] = $userDetails['unique_id'];

    if (!empty($followed_model_unique_ids)) {
        $placeholders = implode(',', array_fill(0, count($followed_model_unique_ids), '?'));
        $types = str_repeat('s', count($followed_model_unique_ids));
        $query = "SELECT id FROM model_user WHERE unique_id IN ($placeholders)";
        $stmt = $con->prepare($query);

        if (!$stmt) {
            die("Prepare failed (fetching numeric ids): " . $con->error);
        }

        $stmt->bind_param($types, ...$followed_model_unique_ids);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $followed_user_ids[] = (int)$row['id']; 
        }
    }


    if (!empty($followed_user_ids)) {

        $placeholders = implode(',', array_fill(0, count($followed_user_ids), '?'));
        $types = str_repeat('i', count($followed_user_ids));


        $sql = "
            SELECT 
                live_posts.*, 
                model_user.name AS author_name, 
                model_user.email AS author_email,
                model_user.country,
                model_user.profile_pic,
                model_user.id AS user_id
            FROM live_posts
            JOIN model_user ON live_posts.post_author = model_user.id
            WHERE post_author IN ($placeholders)
            ORDER BY post_date DESC
        ";

        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Prepare failed (fetching posts): " . $con->error);
        }

        $stmt->bind_param($types, ...$followed_user_ids);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {

            $post_id = $row['ID'];

              // $comment_query = $con->prepare("SELECT * FROM live_comments WHERE comment_post_ID = ?");

              $comment_query = $con->prepare("
                  SELECT 
                      live_comments.*, 
                      model_user.name AS author_name, 
                      model_user.email AS author_email, 
                      model_user.profile_pic AS author_profile_pic 
                  FROM live_comments 
                  LEFT JOIN model_user ON live_comments.user_id = model_user.id 
                  WHERE live_comments.comment_post_ID = ?
              ");

              $comment_query->bind_param("i", $post_id);

              $comment_query->execute();

              $comment_result = $comment_query->get_result();

              $comments = [];
              while ($comment = $comment_result->fetch_assoc()) {
                  $comments[] = $comment;
              }

              $row['comments'] = $comments;

               $post_like = $con->prepare("
                  SELECT 
                      postlike.*, 
                      model_user.name AS author_name,
                      model_user.id AS user_id
                  FROM postlike 
                  LEFT JOIN model_user ON postlike.uid = model_user.id 
                  WHERE postlike.pid = ?
              ");

              $post_like->bind_param("i", $post_id);

              $post_like->execute();

              $like_result = $post_like->get_result();

              $likes = [];

              while ($like = $like_result->fetch_assoc()) {
                  $likes[] = $like;
              }

              $row['like'] = $likes;

              $row['like_count'] = $like_result->num_rows;

              $posts[] = $row;

        }

    }
?>



  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 main-content">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 py-6">

      <div class="sidebar lg:col-span-1">

        <div class="model-card text-center">
          <div class="relative inline-block mb-4">
		  
		  <?php if(!empty($userDetails['profile_pic'])){
				$prof_img = SITEURL.$userDetails['profile_pic'];
			} else{
				$prof_img = SITEURL.'assets/images/model-gal-no-img.jpg';
			} ?>
		  
            <img src="<?php echo $prof_img; ?>" alt="Your profile" class="w-20 h-20 rounded-full mx-auto border-3 border-purple-500">
            <div class="online-dot"></div>
          </div>
          <h3 class="font-bold text-lg gradient-text">
			<?php echo $userDetails['name']; if(!empty($userDetails['age'])){ echo ', '.$userDetails['age']; } ?>
		  </h3>
		  <?php $country_list = DB::query('select name from countries where id="'.$userDetails['country'].'"');
				$state_list = DB::query('select name from states where id="'.$userDetails['state'].'"');
				$city_list = DB::query('select name from cities where id="'.$userDetails['city'].'"');
			if(!empty($country_list) && !empty($country_list[0]['name'])){
			echo '<p class="text-white/60 text-sm mb-2">'.$city_list[0]['name'].', '.$state_list[0]['name'].', '.$country_list[0]['name'].'</p>';
			 } ?>
          <div class="flex justify-center mb-4">
            <span class="verified-badge">✓ Verified</span>
          </div>
          <div class="space-y-2">
            <button class="btn-primary w-full" onclick="navigateTo('edit-profile.php')">Edit Profile</button>
            <a class="btn-secondary w-full" href="<?= SITEURL ?>single-profile.php?m_unique_id=<?php echo $userDetails['unique_id']; ?>">View Profile</a>
          </div>
        </div>

        <!-- Online Users -->
        <div class="model-card">
          <h3 class="font-bold mb-4 gradient-text">Online Now</h3>
          <div class="space-y-3">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/25.jpg" alt="User" class="w-12 h-12 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3">
                <p class="font-medium">Sarah, 26</p>
                <p class="text-xs text-white/60">2 miles away</p>
              </div>
            </div>
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/37.jpg" alt="User" class="w-12 h-12 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3">
                <p class="font-medium">Emma, 23</p>
                <p class="text-xs text-white/60">1 mile away</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="model-card">
          <h3 class="font-bold mb-4 gradient-text">Your Stats</h3>
          <div class="space-y-3">
            <div class="flex justify-between">
              <span class="text-white/70">Profile Views</span>
              <span class="font-bold text-purple-400">1,247</span>
            </div>
            <div class="flex justify-between">
              <span class="text-white/70">Connections</span>
              <span class="font-bold text-purple-400">89</span>
            </div>
            <div class="flex justify-between">
              <span class="text-white/70">Messages</span>
              <span class="font-bold text-purple-400">156</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Feed -->


      <div class="main-feed lg:col-span-3">

        <h2 class="text-2xl md:text-3xl font-bold mb-6 gradient-text heading-font">Your Feed</h2>

        <!-- Post 1 -->

        <?php foreach ($posts as $k => $post) { ?>

            <div class="model-card">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                <div class="relative">

              <?php
                $profile_pic = $post['profile_pic'] ?? '';

                  if (checkImageExists($profile_pic)) {
                        $imageUrl = SITEURL . $profile_pic;
                ?>
                        <img src="<?= $imageUrl ?>" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">
                <?php
                    }
              ?>


                    <div class="online-dot"></div>
                </div>
                <div class="ml-3 md:ml-4">
                    <div class="flex items-center flex-wrap">
                    <h4 class="font-bold text-base md:text-lg"><?php echo $post['author_name']?></h4>
                    <span class="verified-badge ml-2">✓</span>
                    </div>
                    <p class="text-xs md:text-sm text-white/60">2 hours ago • 3 miles away</p>
                </div>
                </div>
                <span class="status-online">Connected</span>
            </div>

                <?php echo $post['post_content']; ?>


            <!-- <p class="mb-4 text-sm md:text-base text-white/90">Just finished an amazing yoga session! Who wants to join me for a hike this weekend? 🧘‍♀️✨</p> -->

            <?php
                $post_image = $post['post_image'] ?? '';

                  if (checkImageExists($post_image)) {
                      $imageUrl = SITEURL . $post_image;
              ?>
                      <img src="<?= $imageUrl ?>" alt="Yoga" class="w-full h-48 md:h-64 object-cover rounded-lg mb-4">
              <?php
                  }
            ?>



            <div class="flex justify-between items-center">

                <div class="flex space-x-4 md:space-x-6">

                  <?php 

                    $liked_comment ="";

                    $like_count = $post['like_count'] ?? 0;

                   if ($like_count > 0 && !empty($post['like'])) {

                         foreach ($post['like']  as $index => $like) { 

                            if($userDetails['id'] == $like['user_id'])
                            {
                                $liked_comment ="liked_comment";
                                break; 
                            }
                        }
                   }
                  
                  ?>

                  <button type="button" onclick="AddLike('<?php echo $k ?>')" id="add_like_<?php echo $k ?>" class="like-btn flex items-center text-white/70 hover:text-pink-400 transition-colors <?php echo $liked_comment ?>" onclick="toggleLike(this)">

                      <svg class="w-5 md:w-6 h-5 md:h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>

                      </svg>

                      <span class="text-sm md:text-base" id="post_like_<?php echo $k ?>"> <?php echo $like_count ?></span>

                  </button>

                  <button onclick="AddComment('comment_<?php echo $k ?>')" class="flex items-center text-white/70 hover:text-blue-400 transition-colors">

                      <svg class="w-5 md:w-6 h-5 md:h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                      </svg>

                      <?php $comment_count = count($post['comments']) ?>

                      <span class="text-sm md:text-base"> <span id="count_comment_<?php echo $k ?>" > <?php echo $comment_count ?> </span> </span>

                  </button>

                </div>

                <button type="button" onclick="AddMessage('<?php echo $k ?>')" class="btn-secondary text-sm md:text-base">Message</button>

            </div>

              <div class="mt-6 pt-4 border-t border-white/10 " id="comment_<?php echo $k ?>" style="display:none;">

                  <?php if($comment_count > 0) { ?>

                    <?php if (!empty($post['comments'])) { ?>

                      <?php foreach ($post['comments']  as $index => $comment) { ?>

                          <div class="flex items-start mb-4">


                          <?php

                              $auther_pic_url ="";

                              $profile_pic = $post['profile_pic'] ?? '';

                              if (checkImageExists($profile_pic)) {

                                $auther_pic_url = SITEURL . $profile_pic;

                              }
                            ?>

                          <?php
                                $profile_pic = $comment['author_profile_pic'] ?? '';

                                if (checkImageExists($profile_pic)) {

                                  $imageUrl = SITEURL . $profile_pic;
                                  
                              ?>
                                    
                                <img src="<?php echo $imageUrl ?>" alt="User" class="w-8 md:w-10 h-8 md:h-10 rounded-full">

                            <?php } ?>

                                  <div class="ml-3 glass-effect rounded-lg p-3 flex-1">

                                    <p class="font-medium text-xs md:text-sm"> <?php echo $comment['comment_author'] ?></p>

                                    <p class="text-xs md:text-sm text-white/80"> <?php echo $comment['comment_content'] ?></p>

                                  </div>
                          </div>

                        <?php } ?>

                      <?php } ?>


                  <?php } else { ?>

                    <div class="flex items-start mb-4 no_comment_<?php echo $k ?>">

                        <p class="text-xs md:text-sm text-white/80  ">No Comments Posted.</p>

                    </div>

                  <?php } ?>


                    <div class="flex items-center comnt_user_<?php echo $k ?>">

                     <?php

                          $auther_pic_url ="";

                          $profile_pic = $post['profile_pic'] ?? '';

                          if (checkImageExists($profile_pic)) {

                            $auther_pic_url = SITEURL . $profile_pic;
                        ?>
                              
                          <img src="<?php echo $auther_pic_url ?>" alt="Your profile" class="w-8 md:w-10 h-8 md:h-10 rounded-full">

                      <?php } ?>


                    <input type="text" name="comment" id="comment_content_<?php echo $k ?>" placeholder="Write a comment..." class="ml-3 glass-effect rounded-full py-2 px-4 flex-1 text-sm bg-transparent border border-white/20 focus:border-purple-500 focus:outline-none">

                    <input type="hidden" name="post_id" id="post_id_<?php echo $k ?>" value="<?php echo $post['ID'] ?>">

                    <input type="hidden" name="user_id" id="user_id_<?php echo $k ?>" value="<?php echo $post['user_id'] ?>">

                    <input type="hidden" name="author_name" id="author_name_<?php echo $k ?>" value="<?php echo $post['author_name'] ?>">

                    <input type="hidden" name="author_email" id="author_email_<?php echo $k ?>" value="<?php echo $post['author_email'] ?>">

                    <input type="hidden" name="image_url" id="image_url<?php echo $k ?>" value="<?php echo $auther_pic_url ?>">
                      
                    
                  </div>

              </div>

            </div>

        <?php }  ?>

       

        <!-- Divider -->
        <div class="text-center my-8">
          <div class="inline-flex items-center px-6 py-3 glass-effect rounded-full">
            <span class="gradient-text font-semibold">Discover New People</span>
          </div>
        </div>

        <!-- Suggested Users -->
        <h2 class="text-2xl md:text-3xl font-bold mb-6 gradient-text heading-font">People You May Like</h2>

        <!-- Suggestion 1 -->
        <div class="model-card">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/71.jpg" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">
                <div class="online-dot"></div>
              </div>
              <div class="ml-3 md:ml-4">
                <div class="flex items-center flex-wrap">
                  <h4 class="font-bold text-base md:text-lg">Maya, 26</h4>
                  <span class="verified-badge ml-2">✓</span>
                </div>
                <p class="text-xs md:text-sm text-white/60">Active now • 3 miles away</p>
              </div>
            </div>
            <button class="btn-primary text-sm md:text-base" onclick="toggleConnect(this)">Connect</button>
          </div>

          <p class="mb-4 text-sm md:text-base text-white/90">Love dancing and traveling! Looking for adventure buddies 💃✈️</p>

          <div class="grid grid-cols-3 gap-2 mb-4">
            <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=200&h=150&fit=crop" alt="Dancing" class="w-full h-20 md:h-24 object-cover rounded-lg">
            <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=200&h=150&fit=crop" alt="Travel" class="w-full h-20 md:h-24 object-cover rounded-lg">
            <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?w=200&h=150&fit=crop" alt="Beach" class="w-full h-20 md:h-24 object-cover rounded-lg">
          </div>

          <div class="flex justify-between text-xs md:text-sm text-white/60">
            <span>🎯 95% match</span>
            <span>📍 3 miles</span>
            <span>⭐ 4.9 rating</span>
          </div>
        </div>

        <!-- Suggestion 2 -->
        <div class="model-card">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop&crop=faces" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">
                <span class="absolute bottom-0 right-0 w-4 h-4 bg-yellow-400 border-2 border-white rounded-full"></span>
              </div>
              <div class="ml-3 md:ml-4">
                <div class="flex items-center flex-wrap">
                  <h4 class="font-bold text-base md:text-lg">Zoe, 24</h4>
                  <span class="premium-badge ml-2">★ Premium</span>
                </div>
                <p class="text-xs md:text-sm text-white/60">Online 1h ago • 5 miles away</p>
              </div>
            </div>
            <button class="btn-primary text-sm md:text-base" onclick="toggleConnect(this)">Connect</button>
          </div>

          <p class="mb-4 text-sm md:text-base text-white/90">Artist and coffee lover ☕🎨 Let's create something beautiful together!</p>

          <img src="https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=600&h=300&fit=crop" alt="Art" class="w-full h-40 md:h-48 object-cover rounded-lg mb-4">

          <div class="flex justify-between text-xs md:text-sm text-white/60">
            <span>🎯 87% match</span>
            <span>📍 5 miles</span>
            <span>⭐ 4.7 rating</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Mobile Navigation -->
  <nav class="mobile-nav md:hidden">
    <div class="flex justify-around">
      <div class="mobile-nav-item active">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
        </svg>
        <span>Feed</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span>Search</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <span>Messages</span>
      </div>
      <div class="mobile-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span>Profile</span>
      </div>
    </div>
  </nav>


  <?php include('../../includes/footer.php'); ?>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


  

</body>


</html> 
