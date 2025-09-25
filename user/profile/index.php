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
		echo '<script>window.location.href="'.SITEURL.'login"</script>';
		die;
	}
}
else{
	echo '<script>window.location.href="'.SITEURL.'login"</script>';
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


<title>The Live Models - Social Fee | The Live Models </title>
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

<?php  include('../../includes/head.php'); ?>

   <style>
        #sidebarMenu {
            z-index: 9999 !important;
        }

        .badge-showcase {
            max-width: 1200px;
            margin: 0 auto;
        }



        .badge-user {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .badge-user:hover {
            transform: scale(1.15) translateY(-2px);
        }

        .badge-demo {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin: 3rem 0;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .badge-demo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s;
        }

        .badge-demo:hover::before {
            left: 100%;
        }

        .badge-demo:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.04));
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .badge-demo span {
            font-size: 1.2rem;
            font-weight: 600;
            min-width: 220px;
            letter-spacing: 0.02em;
        }

        /* Ultra-premium Free Verified Badge with layered shield effects */
        .verified-user {
            background: linear-gradient(135deg, #10b981, #059669, #047857, #065f46);
            border-radius: 50%;
            border: 4px solid #34d399;
            position: relative;
            box-shadow:
                0 0 50px rgba(16, 185, 129, 0.9),
                0 0 100px rgba(16, 185, 129, 0.5),
                inset 0 4px 0 rgba(255, 255, 255, 0.6),
                inset 0 -4px 0 rgba(0, 0, 0, 0.4);
        }

        .verified-user::before {
            content: '';
            position: absolute;
            inset: -8px;
            background: conic-gradient(from 0deg, #10b981, #34d399, #6ee7b7, #a7f3d0, #6ee7b7, #34d399, #10b981);
            border-radius: 50%;
            z-index: -1;
            animation: verifiedPrisma 3s ease-in-out infinite;
        }

        .verified-user::after {
            content: '';
            position: absolute;
            inset: -20px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.5) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -2;
            animation: verifiedAura 4s linear infinite;
        }

        /* Luxury Basic Premium with golden star burst effects */
        .premium-basic-user {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706, #b45309);
            border-radius: 50%;
            border: 4px solid #fcd34d;
            position: relative;
            box-shadow:
                0 0 50px rgba(251, 191, 36, 0.9),
                0 0 100px rgba(251, 191, 36, 0.5),
                inset 0 4px 0 rgba(255, 255, 255, 0.6),
                inset 0 -4px 0 rgba(0, 0, 0, 0.4);
        }

        .premium-basic-user::before {
            content: '';
            position: absolute;
            inset: -8px;
            background: conic-gradient(from 0deg, #fbbf24, #fcd34d, #fef3c7, #fffbeb, #fef3c7, #fcd34d, #fbbf24);
            border-radius: 50%;
            z-index: -1;
            animation: premiumPrisma 3s ease-in-out infinite;
        }

        .premium-basic-user::after {
            content: '';
            position: absolute;
            inset: -20px;
            background: radial-gradient(circle, rgba(251, 191, 36, 0.5) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -2;
            animation: premiumAura 4s linear infinite;
        }

        /* Ultra-luxury Diamond Elite with crystal faceting and prismatic effects */
        .diamond-elite-user {
            background: linear-gradient(135deg, #06b6d4, #0891b2, #0e7490, #155e75);
            width: 68px;
            height: 68px;
            position: relative;
            clip-path: polygon(50% 0%, 93.3% 25%, 93.3% 75%, 50% 100%, 6.7% 75%, 6.7% 25%);
            border: none;
            box-shadow:
                0 0 60px rgba(6, 182, 212, 1),
                0 0 120px rgba(6, 182, 212, 0.6),
                0 0 180px rgba(6, 182, 212, 0.3),
                inset 0 8px 0 rgba(255, 255, 255, 0.7),
                inset 0 -8px 0 rgba(0, 0, 0, 0.5);
        }

        .diamond-elite-user::before {
            content: '';
            position: absolute;
            inset: -12px;
            background: conic-gradient(from 0deg,
                    #06b6d4, #22d3ee, #67e8f9, #a5f3fc, #cffafe,
                    #a5f3fc, #67e8f9, #22d3ee, #06b6d4);
            clip-path: polygon(50% 0%, 93.3% 25%, 93.3% 75%, 50% 100%, 6.7% 75%, 6.7% 25%);
            z-index: -1;
            animation: diamondPrisma 2.5s ease-in-out infinite;
        }

        .diamond-elite-user::after {
            content: '';
            position: absolute;
            inset: -30px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.8) 0%, rgba(34, 211, 238, 0.4) 40%, transparent 70%);
            border-radius: 50%;
            z-index: -2;
            animation: diamondAura 3s linear infinite;
        }

        .diamond-elite-user span {
            transform: none;
            font-size: 32px;
            text-shadow:
                0 0 30px rgba(255, 255, 255, 1),
                0 0 60px rgba(103, 232, 249, 0.8),
                0 0 90px rgba(167, 243, 252, 0.6);
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 1));
            animation: diamondSparkle 2s ease-in-out infinite;
        }

        /* Premium Creator with artistic particle burst effects */
        .creator {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed, #6d28d9, #5b21b6);
            border-radius: 50%;
            border: 4px solid #a78bfa;
            position: relative;
            box-shadow:
                0 0 50px rgba(139, 92, 246, 0.9),
                0 0 100px rgba(139, 92, 246, 0.5),
                inset 0 4px 0 rgba(255, 255, 255, 0.6),
                inset 0 -4px 0 rgba(0, 0, 0, 0.4);
        }

        .creator::before {
            content: '';
            position: absolute;
            inset: -8px;
            background: conic-gradient(from 0deg, #8b5cf6, #a78bfa, #c4b5fd, #e9d5ff, #c4b5fd, #a78bfa, #8b5cf6);
            border-radius: 50%;
            z-index: -1;
            animation: creatorPrisma 3s ease-in-out infinite;
        }

        .creator::after {
            content: '';
            position: absolute;
            inset: -20px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.5) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -2;
            animation: creatorAura 4s linear infinite;
        }

        .badge-container {
            display: flex;
            gap: 3rem;
            flex-wrap: wrap;
            margin: 4rem 0;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .tier-section {
            margin: 5rem 0;
            text-align: center;
        }

        .tier-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            background: linear-gradient(135deg, #f9fafb, #e5e7eb, #d1d5db);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.01em;
        }

        /* Updated animations to match diamond's prismatic sophistication */
        @keyframes verifiedPrisma {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 0.9;
                filter: hue-rotate(0deg);
            }

            33% {
                transform: scale(1.08) rotate(120deg);
                opacity: 1;
                filter: hue-rotate(30deg);
            }

            66% {
                transform: scale(1.05) rotate(240deg);
                opacity: 0.95;
                filter: hue-rotate(60deg);
            }
        }

        @keyframes verifiedAura {
            from {
                transform: rotate(0deg);
                opacity: 0.4;
            }

            to {
                transform: rotate(360deg);
                opacity: 0.7;
            }
        }

        @keyframes premiumPrisma {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 0.9;
                filter: hue-rotate(0deg);
            }

            33% {
                transform: scale(1.08) rotate(120deg);
                opacity: 1;
                filter: hue-rotate(20deg);
            }

            66% {
                transform: scale(1.05) rotate(240deg);
                opacity: 0.95;
                filter: hue-rotate(40deg);
            }
        }

        @keyframes premiumAura {
            from {
                transform: rotate(0deg);
                opacity: 0.4;
            }

            to {
                transform: rotate(360deg);
                opacity: 0.7;
            }
        }

        @keyframes diamondPrisma {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 0.9;
                filter: hue-rotate(0deg) brightness(1.1);
            }

            25% {
                transform: scale(1.12) rotate(90deg);
                opacity: 1;
                filter: hue-rotate(90deg) brightness(1.3);
            }

            50% {
                transform: scale(1.08) rotate(180deg);
                opacity: 0.95;
                filter: hue-rotate(180deg) brightness(1.2);
            }

            75% {
                transform: scale(1.15) rotate(270deg);
                opacity: 1;
                filter: hue-rotate(270deg) brightness(1.4);
            }
        }

        @keyframes diamondAura {
            from {
                transform: rotate(0deg) scale(1);
                opacity: 0.6;
            }

            50% {
                transform: rotate(180deg) scale(1.1);
                opacity: 0.9;
            }

            to {
                transform: rotate(360deg) scale(1);
                opacity: 0.6;
            }
        }

        @keyframes diamondSparkle {

            0%,
            100% {
                transform: scale(1);
                filter: drop-shadow(0 0 15px rgba(255, 255, 255, 1)) brightness(1);
            }

            50% {
                transform: scale(1.1);
                filter: drop-shadow(0 0 25px rgba(255, 255, 255, 1.2)) brightness(1.3);
            }
        }

        @keyframes creatorPrisma {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 0.9;
                filter: hue-rotate(0deg);
            }

            33% {
                transform: scale(1.08) rotate(120deg);
                opacity: 1;
                filter: hue-rotate(45deg);
            }

            66% {
                transform: scale(1.05) rotate(240deg);
                opacity: 0.95;
                filter: hue-rotate(90deg);
            }
        }

        @keyframes creatorAura {
            from {
                transform: rotate(0deg);
                opacity: 0.4;
            }

            to {
                transform: rotate(360deg);
                opacity: 0.7;
            }
        }

             /* Luxury animations */
        @keyframes luxuryFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-8px) rotate(1deg); }
            66% { transform: translateY(-4px) rotate(-1deg); }
        }

        @keyframes premiumGlow {
            0%, 100% { 
                box-shadow: 0 0 30px rgba(155, 89, 182, 0.3),
                            0 0 60px rgba(155, 89, 182, 0.1),
                            inset 0 1px 0 rgba(255, 255, 255, 0.2);
            }
            50% { 
                box-shadow: 0 0 40px rgba(155, 89, 182, 0.5),
                            0 0 80px rgba(155, 89, 182, 0.2),
                            inset 0 1px 0 rgba(255, 255, 255, 0.3);
            }
        }

        @keyframes slideInLuxury {
            0% { 
                opacity: 0; 
                transform: translateX(100px) scale(0.9); 
                filter: blur(10px);
            }
            100% { 
                opacity: 1; 
                transform: translateX(0) scale(1); 
                filter: blur(0);
            }
        }

        @keyframes progressFill {
            0% { stroke-dasharray: 0 283; }
            100% { stroke-dasharray: 254 283; }
        }

        @keyframes globeRotate {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }

        @keyframes particleFloat {
            0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.7; }
            25% { transform: translateY(-20px) translateX(10px); opacity: 1; }
            50% { transform: translateY(-10px) translateX(-5px); opacity: 0.8; }
            75% { transform: translateY(-15px) translateX(8px); opacity: 0.9; }
        }

        .luxury-float { animation: luxuryFloat 4s ease-in-out infinite; }
        .premium-glow { animation: premiumGlow 3s ease-in-out infinite; }
        .slide-in-luxury { animation: slideInLuxury 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .progress-fill { animation: progressFill 2s ease-out forwards; }
        .globe-rotate { animation: globeRotate 20s linear infinite; }
        .particle-float { animation: particleFloat 6s ease-in-out infinite; }

        /* Glass morphism effects */
        .glass-luxury {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .glass-button {
            background: linear-gradient(135deg, rgba(155, 89, 182, 0.8), rgba(255, 111, 97, 0.8));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .glass-button:hover {
            background: linear-gradient(135deg, rgba(155, 89, 182, 1), rgba(255, 111, 97, 1));
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(155, 89, 182, 0.4);
        }

        /* Gradient backgrounds for each slide */
        .gradient-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .gradient-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .gradient-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

        /* Typography */
        .font-heading { font-family: 'Space Grotesk', sans-serif; }
        .font-body { font-family: 'DM Sans', sans-serif; }

        /* Particle system */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
        }

        .particle:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { top: 60%; left: 20%; animation-delay: 1s; }
        .particle:nth-child(3) { top: 40%; left: 80%; animation-delay: 2s; }
        .particle:nth-child(4) { top: 80%; left: 70%; animation-delay: 3s; }
        .particle:nth-child(5) { top: 30%; left: 90%; animation-delay: 4s; }


    </style>

</head>

<body class="socialwall-page">



 <?php  include('../../includes/side-bar.php'); ?>

 <?php  include('../../includes/profile_header_index.php'); ?>

<?php

    $user_id = $userDetails['unique_id']; 

    $user_mode_id = $userDetails['id']; 

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

    $followed_user_ids[] = $userDetails['id'];

      $current_user_query = "SELECT gender FROM model_user WHERE unique_id = ?";
      $current_stmt = $con->prepare($current_user_query);
      $current_stmt->bind_param("s", $userDetails['unique_id']);
      $current_stmt->execute();
      $current_result = $current_stmt->get_result();
      $current_user = $current_result->fetch_assoc();
      $current_user_gender = $current_user['gender'];

      // $privacy_query = "SELECT * FROM model_privacy_settings WHERE unique_model_id = ?";
      // $privacy_stmt = $con->prepare($privacy_query);
      // $privacy_stmt->bind_param("s", $userDetails['unique_id']);
      // $privacy_stmt->execute();
      // $privacy_result = $privacy_stmt->get_result();
      // $privacy = $privacy_result->fetch_assoc();

     $privacy_setting =  getModelPrivacySettings($userDetails['unique_id']);

     $filteredFollowedIds = filterFollowedModelIdsByPrivacy($con,$followed_model_unique_ids,$userDetails,$privacy_setting);

     $followed_user_ids = array_merge($followed_user_ids, $filteredFollowedIds);
    // if (!empty($followed_model_unique_ids)) {

    //     $placeholders = implode(',', array_fill(0, count($followed_model_unique_ids), '?'));
    //     $types = str_repeat('s', count($followed_model_unique_ids));
    //     $query = "SELECT id FROM model_user WHERE unique_id IN ($placeholders)";
    //     $stmt = $con->prepare($query);

    //     if (!$stmt) {
    //         die("Prepare failed (fetching numeric ids): " . $con->error);
    //     }

    //     $stmt->bind_param($types, ...$followed_model_unique_ids);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     while ($row = $result->fetch_assoc()) {
    //         $followed_user_ids[] = (int)$row['id']; 
    //     }
    // }
    // else

  
  
    if (!empty($followed_user_ids) && count($followed_user_ids) == 1 ) {

            $sql = "
              SELECT DISTINCT model_user.id AS user_id, model_user.gender
              FROM live_posts 
              JOIN model_user ON live_posts.post_author = model_user.id 
              ORDER BY live_posts.id DESC
          ";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $target_gender = $row['gender'];
                $allow = true;

                if ($allow) {
                    $followed_user_ids[] = (int)$row['user_id'];
                }
            }
    }

   
    if (!empty($followed_user_ids) && count($followed_user_ids) > 0 ) {

   
        // $boost_follower_unique_ids = BoostedModelIdsByUser($userDetails,$con);

        // $filter_follower_ids = [];
        
        // if (!empty($boost_follower_unique_ids)) {

        //     $in_clause = implode(',', array_fill(0, count($boost_follower_unique_ids), '?'));
        //     $types_follower = str_repeat('s', count($boost_follower_unique_ids));

        //     $followQuery = "SELECT id FROM model_user WHERE unique_id IN ($in_clause)";
        //     $stmt = $con->prepare($followQuery);

        //     if (!$stmt) {
        //         die("Prepare failed: " . $con->error);
        //     }

        //     $boost_follower_unique_ids = array_map('strval', $boost_follower_unique_ids);

        //     $stmt->bind_param($types_follower, ...$boost_follower_unique_ids);
        //     $stmt->execute();
        //     $result = $stmt->get_result();

        //     while ($row = $result->fetch_assoc()) {
        //         $filter_follower_ids[] = $row['id'];
        //     }

        //     $stmt->close();
        // }

        // $priority_ids = array_values(array_intersect($followed_user_ids, $filter_follower_ids));

        // $priority_ids = array_values($followed_user_ids);
        
        $placeholders = implode(',', array_fill(0, count($followed_user_ids), '?'));
        $types = str_repeat('i', count($followed_user_ids));


        $where = "";

        $blocked_users = BlockedUsers($_SESSION["log_user_id"]);

        if (!empty($blocked_users)) {
        
            $blocked_ids = implode(',', array_map('intval', $blocked_users));

            $where .= " AND model_user.id NOT IN ($blocked_ids) ";
            
        }   

        $itemsPerPage = 5;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $itemsPerPage;

        $count_sql = "SELECT COUNT(*) as total 
                      FROM live_posts 
                      JOIN model_user ON live_posts.post_author = model_user.id
                      WHERE post_author IN ($placeholders) $where ";
        $count_stmt = $con->prepare($count_sql);
        $count_stmt->bind_param($types, ...$followed_user_ids);
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $total_posts = $count_result->fetch_assoc()['total'];

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
            $where
        ";

        if (!empty($priority_ids)) {

            $priority_order = implode(',', $priority_ids);

            $sql .= " ORDER BY FIELD(post_author, $priority_order) DESC, post_date DESC";
        } else {

            $sql .= " ORDER BY post_date DESC";
        }

        $sql .= " LIMIT ? OFFSET ?";


        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Prepare failed (fetching posts): " . $con->error);
        }


        // $stmt->bind_param($types, ...$followed_user_ids);

        $bind_values = array_merge($followed_user_ids, [$itemsPerPage, $offset]);
        
        $types .= "ii";

        $stmt->bind_param($types, ...$bind_values);

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

    $followers_count = 0;

    if(!empty($followed_model_unique_ids) && count($followed_model_unique_ids) > 0)
    {
        $followers_count = count($followed_model_unique_ids);
    }

      $profileUserId = $user_mode_id;

      $sql = "SELECT COUNT(*) as total_views FROM model_user_profile_views WHERE profile_user_id = ?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("i", $profileUserId);
      $stmt->execute();
      $stmt->bind_result($total_views);
      $stmt->fetch();
      $stmt->close();

        $profile_id = $_SESSION["log_user_id"];

        $onboard_update = BoardUpdate($profile_id);

?>



  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 main-content user-home">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 py-6">

      <div class="sidebar lg:col-span-1 user-home-leftbar">

        <div class="model-card text-center">
          <div class="relative inline-block mb-4">
            
            <?php

                $prof_img = SITEURL.'assets/images/model-gal-no-img.jpg';

                  if(!empty($userDetails['profile_pic']))
                  {
                      if (checkImageExists($userDetails['profile_pic'])) {
                    
                          $prof_img = SITEURL . $userDetails['profile_pic'];
                      }
                  }
            ?>
		  
            <img src="<?php echo $prof_img; ?>" alt="Your profile" class="w-20 h-20 rounded-full mx-auto border-3 border-purple-500">
            <div class="online-dot"></div>
          </div>
          <h3 class="font-bold text-lg gradient-text">
			<?php echo $userDetails['name']; if(!empty($userDetails['age'])) { echo ', '.$userDetails['age']; } ?>
		  </h3>
		  <?php $country_list = DB::query('select name from countries where id="'.$userDetails['country'].'"');
				$state_list = DB::query('select name from states where id="'.$userDetails['state'].'"');
				$city_list = DB::query('select name from cities where id="'.$userDetails['city'].'"');
			if(!empty($country_list) && !empty($country_list[0]['name'])){
				$full_addr_list = '';
				if(!empty($city_list) && !empty($city_list[0]['name'])) $full_addr_list .= $city_list[0]['name'].', ';
				if(!empty($state_list) && !empty($state_list[0]['name'])) $full_addr_list .= $state_list[0]['name'].', ';
				$full_addr_list .= $country_list[0]['name'];
			echo '<p class="text-white/60 text-sm mb-2">'.$full_addr_list.'</p>';
			 } 
			 $extra_details = DB::queryFirstRow("SELECT status FROM model_extra_details WHERE unique_model_id = %s ", $userDetails['unique_id']);
			 ?>
		<?php if(!empty($extra_details) && !empty($extra_details) && $extra_details['status'] == 'Published'){ ?>
          <div class="flex justify-center mb-4">
            <span class="verified-badge">✓ Verified</span>
          </div>
		<?php } ?>
          <div class="space-y-2 user-profile-side-btns">
            <button class="btn-primary w-full" onclick="navigateTo('edit-profile')">Edit Profile</button>
            <a class="btn-secondary w-full" href="<?= SITEURL ?><?php echo urlencode($userDetails['username']); ?>">View Profile</a>
          </div>
        </div>

        <!-- Online Users -->

           <?php 

                $offset = 0;
                $limit = 5; 

                $onlineUserIds = [];

                $order = " ORDER BY id DESC ";

                $where = "";

                $idsQuery = "SELECT id FROM model_user";

                $result = mysqli_query($con, $idsQuery);

                while ($row = mysqli_fetch_assoc($result)) {
                    if (isUserOnline($row['id']) === 'Online') {

                        if($_SESSION['log_user_id'] != $row['id']){

                          $onlineUserIds[] = $row['id'];

                        }
                    }
                }

                $idList = implode(',', $onlineUserIds);

                if (empty($idList)) {
                    $idList = 0;
                }

                $where = "";

                $blocked_users = BlockedUsers($_SESSION["log_user_id"]);

                if (!empty($blocked_users)) {
                
                    $blocked_ids = implode(',', array_map('intval', $blocked_users));

                    $where .= " AND id NOT IN ($blocked_ids) ";
                    
                }   

                $sqls = "SELECT * FROM model_user WHERE id IN ($idList) $where $order LIMIT 5";

                $resulusers = mysqli_query($con, $sqls);

                $resultd = [];

                if ($resulusers && mysqli_num_rows($resulusers) > 0) {
                    while ($row = mysqli_fetch_assoc($resulusers)) {
                        $resultd[] = $row;
                    }
                }

              if(!empty($resultd) && count($resultd) ) { 

            ?>

            <div class="model-card">
              <h3 class="font-bold mb-4 gradient-text">Online Now</h3>
              <div class="space-y-3">
                
              <?php 

                foreach($resultd as $user) { 

                  $defaultImage =SITEURL."/assets/images/girl.png";

                  if($user['gender']=='Male'){

                      $defaultImage =SITEURL."/assets/images/profile.jpg";
                  }

                  if(!empty($user['profile_pic']))
                  {
                      if (checkImageExists($user['profile_pic'])) {
                    
                          $defaultImage = SITEURL . $user['profile_pic'];
                      }
                  }

                  ?>

                <div class="flex items-center repeat-users" onclick="window.location.href='<?= SITEURL ?><?php echo urlencode($user['username']); ?>'">

                      <div class="relative">

                        <img src="<?php echo $defaultImage ?>" alt="User" class="w-12 h-12 rounded-full">

                        <div class="online-dot"></div>

                      </div>

                      <div class="ml-3">

                        <p class="font-medium"><?php echo $user['name']?></p>

                        <p class="text-xs text-white/60"> <?php echo GetCityName($user['city']) ?></p>

                      </div>

                  </div>

                  <?php } ?>

                  <button type="button" class="btn-primary w-full" onclick="window.location.href='<?= SITEURL ?>all-members?filter=available'" > View all</button>
                  
              </div>

            </div>

          <?php } ?>

        <!-- Quick Stats -->
        <div class="model-card" id="profie_status_section">

          <h3 class="font-bold mb-4 gradient-text">Your Status</h3>
          <div class="space-y-3">
            <div class="flex justify-between">
              <span class="text-white/70">Profile Views</span>
              <span class="font-bold text-purple-400"><?php echo $total_views ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-white/70">Connections</span>
              <span class="font-bold text-purple-400"><?php echo $followers_count?> </span>
            </div>

          <?php

            $user_id = $userDetails['id'];

              $string = "
                  SELECT DISTINCT 
                      CASE 
                          WHEN sender_id = $user_id THEN user_id 
                          ELSE sender_id 
                      END AS chat_user_id
                  FROM model_user_message
                  WHERE sender_id = $user_id OR user_id = $user_id
              ";

              $chat_users = DB::query($string);
              $message_count = count($chat_users);
            ?>

            <div class="flex justify-between">
              <span class="text-white/70">Messages</span>
              <span class="font-bold text-purple-400"> <?php echo $message_count ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Feed -->


      <div class="main-feed lg:col-span-3 user-home-right">

        <!-- <h2 class="text-2xl md:text-3xl font-bold mb-6 gradient-text heading-font">Your Feed</h2> -->

        <!-- Post 1 -->
     
        <?php foreach ($posts as $k => $post) { 
       
          ?>

            <div class="model-card">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">

              <?php

                  $post_upload_id = $post['ID'];

                  $psot_user_status =  getPostUploadTime($post_upload_id);

                
                $post_user_id = $post['user_id'];

                  $modelDetails = get_data('model_user',array('id'=>$post_user_id),true);

                  $isconnected =  isUserFollow($modelDetails['unique_id'],$userDetails['unique_id']); 

                  $result = CheckPremiumAccess($modelDetails['id']);

                  $preminum_plan = "";

                  $is_user_preminum = false;

                  if ($result && $result['active']) {

                      $is_user_preminum = true;

                      $preminum_plan = $result['plan_status'];
                  }

                $profile_pic = $post['profile_pic'] ?? '';

              ?>

               <div class="relative" onclick="window.location.href='<?= SITEURL . $modelDetails['username'] ?>'">

              <?php if (checkImageExists($profile_pic)) {

                        $imageUrl = SITEURL . $profile_pic;
                ?>
                        <img src="<?= $imageUrl ?>" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">

                <?php } ?>

                    <div class="online-dot"></div>
                </div>


                <div class="ml-3 md:ml-4">
                    <div class="flex items-center flex-wrap">
                    <h4 class="font-bold text-base md:text-lg"><?php echo $post['author_name']?></h4>

                        <!-- <span class="verified-badge ml-2">✓</span> -->

                         <?php if ($is_user_preminum) { ?>

                            <?php if ($preminum_plan == 'basic') { ?>

                                <span class="profile-badge badge-premium user-index">
                                    <div class="badge-user premium-basic-user">⭐</div>
                                    <p>Premium</p>
                                </span>

                            <?php } else { ?>

                                <span class="profile-badge badge-premium user-index">
                                    <div class="badge-user diamond-elite-user"><span>💎</span></div>
                                    <p>Premium</p>
                                </span>

                            <?php } ?>

                        <?php } ?>

                        <?php if (!empty($modelDetails) && $modelDetails['status'] == 'Published') { ?>

                            <span class="profile-badge badge-verified user-index">
                                <div class="badge-user verified-user">🛡</div>
                                <p>Verified</p>
                            </span>

                        <?php } ?>

                        <?php if (!empty($modelDetails) &&  $modelDetails['as_a_model'] == 'Yes') { ?>

                            <span class="profile-badge creator-badge user-index">
                                <div class="badge-user creator">✨</div>
                                <p>Creator</p>
                            </span>

                        <?php } ?>


                    </div>
                    <p class="text-xs md:text-sm text-white/60"><?php echo $psot_user_status ?> •</p>
                </div>
                </div>

             
                <?php if($isconnected) { ?>

                  <span class="status-online">Connected</span>

                <?php } ?>

            </div>

             <h2>  <?php echo $post['post_title']; ?></h2>

              <p>  <?php echo $post['post_content']; ?></p>


            <!-- <p class="mb-4 text-sm md:text-base text-white/90">Just finished an amazing yoga session! Who wants to join me for a hike this weekend? 🧘‍♀️✨</p> -->

            <?php
                $post_image = $post['post_image'] ?? '';

                  if (checkImageExists($post_image)) {

                      $imageUrl = SITEURL . $post_image;

                  $blur_class="";

                  if($user_mode_id != $post['user_id'] && $post['post_type'] =='paid')
                  {
                      $imageUrl ="";

                      $blur_class="style='filter: blur(10px);'";
                  }
              ?>
                  <?php if($post['post_mime_type'] == 'Image'){ ?>

                  
                      <img src="<?= $imageUrl ?>" alt="Yoga" class="w-full h-48 md:h-64 object-cover rounded-lg mb-4 " <?php echo $blur_class ?>>

                  <?php } elseif($post['post_mime_type'] == 'Video') { ?>

                        <div class="video-outer" <?php echo $blur_class ?> >

                            <video class="video-ci" controls  >

                                <source src="<?php echo $imageUrl ?>" type="video/mp4" class="w-full h-48 md:h-64 object-cover rounded-lg mb-4">

                              </video>

                        </div>

                  <?php } ?>
                      
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

                     <?php  if($userDetails['id'] != $post['user_id']) { ?>

                      
                     <?php

                          $auther_pic_url ="";

                          $profile_pic = $post['profile_pic'] ?? '';

                          if (checkImageExists($profile_pic)) {

                            $auther_pic_url = SITEURL . $profile_pic;
                        ?>
                              
                          <img src="<?php echo $auther_pic_url ?>" alt="Your profile" class="w-8 md:w-10 h-8 md:h-10 rounded-full">

                      <?php } ?>

                      <input type="text" name="comment" id="comment_content_<?php echo $k ?>" placeholder="Write a comment..." class="ml-3 glass-effect rounded-full py-2 px-4 flex-1 text-sm bg-transparent border border-white/20 focus:border-purple-500 focus:outline-none">

                      <button type="button" onclick="AddMessage('<?php echo $k ?>')" class="btn-secondary text-sm md:text-base whitespace-nowrap">Message</button>

                    <?php } ?>

                    <input type="hidden" name="post_id" id="post_id_<?php echo $k ?>" value="<?php echo $post['ID'] ?>">

                    <input type="hidden" name="user_id" id="user_id_<?php echo $k ?>" value="<?php echo $post['user_id'] ?>">

                    <input type="hidden" name="author_name" id="author_name_<?php echo $k ?>" value="<?php echo $post['author_name'] ?>">

                    <input type="hidden" name="author_email" id="author_email_<?php echo $k ?>" value="<?php echo $post['author_email'] ?>">

                    <input type="hidden" name="image_url" id="image_url<?php echo $k ?>" value="<?php echo $auther_pic_url ?>">
                      
                  </div>
                   
              </div>

            </div>

        <?php }  ?>

        <div class="flex justify-center items-center space-x-4 mt-8 adv-pagination">

            <div id="pagination-container"></div>

        </div>

       

        <!-- Divider -->
        <!-- <div class="text-center my-8">
          <div class="inline-flex items-center px-6 py-3 glass-effect rounded-full">
            <span class="gradient-text font-semibold">Discover New People</span>
          </div>
        </div> -->

        <!-- Suggested Users -->

      <?php   if($followers_count > 0 )  { ?>
      

        <h2 class="text-2xl md:text-3xl font-bold mb-6 gradient-text heading-font">People You May Like</h2>

        <?php 
        
          $users_with_post = [];

          $sql = "
              SELECT DISTINCT model_user.id AS user_id 
              FROM live_posts 
              JOIN model_user ON live_posts.post_author = model_user.id
          ";

          $result = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
              $users_with_post[] = (int)$row['user_id'];
          }
        
          if (!empty($users_with_post)) {

               $suggested_user_ids = array_diff($users_with_post, $followed_user_ids);

            if (!empty($suggested_user_ids)) {

              $ids_string = implode(',', $suggested_user_ids);

               $post_query = mysqli_query($con, "
                  SELECT live_posts.*, model_user.name, model_user.gender, model_user.profile_pic ,model_user.unique_id 
                  FROM live_posts 
                  JOIN model_user ON live_posts.post_author = model_user.id 
                  WHERE model_user.id IN ($ids_string)
                  ORDER BY RAND()
                  LIMIT 2
              ");

              $posts = mysqli_fetch_all($post_query, MYSQLI_ASSOC);


              // print_r($posts);

              // die();
            }
          }
        
        ?>

       <?php
       
       if(!empty($posts) && count($posts) > 0) {
       
          foreach ($posts as $post) { 

            
                  $defaultImage =SITEURL."/assets/images/girl.png";

                  if($post['gender']=='Male'){
                      $defaultImage =SITEURL."/assets/images/profile.jpg";
                  }

                  if(!empty($post['profile_pic']))
                  {
                      if (checkImageExists($post['profile_pic'])) {
                    
                          $defaultImage = SITEURL . $post['profile_pic'];
                      }
                  }


                  $modelDetails = get_data('model_user',array('id'=>$post['user_id']),true);

                  $result = CheckPremiumAccess($modelDetails['id']);

                  $preminum_plan = "";

                  $is_user_preminum = false;

                  if ($result && $result['active']) {

                      $is_user_preminum = true;

                      $preminum_plan = $result['plan_status'];
                  }
            ?>

          <div class="model-card">

            <div class="flex items-center justify-between mb-4">

              <div class="flex items-center">
                <div class="relative">

                  <img src="<?php echo $defaultImage ?>" alt="User" class="w-12 md:w-14 h-12 md:h-14 rounded-full">

                  <div class="online-dot"></div>
                </div>
                <div class="ml-3 md:ml-4">

                  <div class="flex items-center flex-wrap">

                    <h4 class="font-bold text-base md:text-lg"> <?php echo $post['name'] ?> </h4>

                    <!-- <span class="verified-badge ml-2">✓</span> -->


                       <?php if ($is_user_preminum) { ?>

                            <?php if ($preminum_plan == 'basic') { ?>

                                <span class="profile-badge badge-premium user-index">
                                    <div class="badge-user premium-basic-user">⭐</div>
                                    <p>Premium</p>
                                </span>

                            <?php } else { ?>

                                <span class="profile-badge badge-premium user-index">
                                    <div class="badge-user diamond-elite-user"><span>💎</span></div>
                                    <p>Premium</p>
                                </span>

                            <?php } ?>

                        <?php } ?>

                        <?php if (!empty($modelDetails) && $modelDetails['status'] == 'Published') { ?>

                            <span class="profile-badge badge-verified user-index">
                                <div class="badge-user verified-user">🛡</div>
                                <p>Verified</p>
                            </span>

                        <?php } ?>

                        <?php if (!empty($modelDetails) &&  $modelDetails['as_a_model'] == 'Yes') { ?>

                            <span class="profile-badge creator-badge user-index">
                                <div class="badge-user creator">✨</div>
                                <p>Creator</p>
                            </span>

                        <?php } ?>


                  </div>

                  <p class="text-xs md:text-sm text-white/60">Active now •</p>

                </div>

              </div>

              <?php
              
                    $user_requested_row = DB::queryFirstRow(
                        "SELECT notification_id 
                        FROM all_notifications 
                        WHERE sender_id = %s 
                        AND receiver_id = %s 
                        AND notification_type = 'follow' 
                        LIMIT 1",
                        $_SESSION['log_user_id'],
                        $modelDetails['id']
                    );

                    $user_requested = !empty($user_requested_row);

                    $rating = GetRating($modelDetails['unique_id']);
              ?>

              <button class="btn-primary text-sm md:text-base"  onclick="FollowModel('<?= $modelDetails['id'] ?>', '<?= $modelDetails['username'] ?>','follow_similar-<?= $_SESSION['log_user_id'] ?>')" > <span id="follow_similar-<?= $_SESSION['log_user_id'] ?>"></span> <?php if($user_requested) { ?>Follow Requested <?php } else { ?>Connect <?php }?></span></button>

            </div>

            <p class="mb-4 text-sm md:text-base text-white/90"> <?php echo $post['post_content'] ?></p>

            <?php 
                  $post_image = $post['post_image'] ?? '';

                $imageUrl = "";
                if (checkImageExists($post_image)) {

                    $imageUrl = SITEURL . $post_image;
                }
              
                if($post['post_mime_type'] == 'Image' && !empty($imageUrl)) { ?>
              
                <img src="<?php echo $imageUrl?>" alt="Art" class="w-full h-40 md:h-48 object-cover rounded-lg mb-4">

            <?php } ?>


            <div class="flex justify-between text-xs md:text-sm text-white/60">
              <!-- <span>🎯 95% match</span>
              <span>📍 3 miles</span> -->
              <span>⭐ <?= rtrim(rtrim(number_format($rating, 1), '0'), '.') ?> rating </span>
            </div>
          </div>

        <?php }  } }?>

     

      </div>
    </div>
  </main>

<?php if(!$onboard_update)  { ?>

   <div id="onboardingModal" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop with blur -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        
        <!-- Floating particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="particle particle-float"></div>
            <div class="particle particle-float"></div>
            <div class="particle particle-float"></div>
            <div class="particle particle-float"></div>
            <div class="particle particle-float"></div>
        </div>

        <!-- Modal Container -->
        <div class="relative w-full max-w-lg mx-auto">
            <!-- Slide 1: Welcome -->
            <div id="slide1" class="slide glass-luxury rounded-3xl p-8 text-center gradient-1 slide-in-luxury">
                <div class="mb-8">
                    <!-- Globe Animation -->
                    <div class="relative mx-auto w-24 h-24 mb-6">
                        <div class="globe-rotate text-6xl">🌍</div>
                        <div class="absolute inset-0 rounded-full border-2 border-white/30 luxury-float"></div>
                        <div class="absolute inset-2 rounded-full border border-white/20 luxury-float" style="animation-delay: 0.5s;"></div>
                    </div>
                    
                    <h1 class="font-heading text-4xl font-bold text-white mb-4 onboarding-title">
                        ✨ Welcome 
                    </h1>
                    <p class="font-body text-xl text-white/90 mb-8 onboarding-subtitle">
                        "Your passport to connect worldwide."
                    </p>
                </div>
                
                <button onclick="nextSlide()" class="glass-button px-8 py-4 rounded-2xl text-white font-semibold text-lg premium-glow">
                    Let's Go
                </button>
            </div>

            <!-- Slide 2: Chat & Watch -->
            <div id="slide2" class="slide glass-luxury rounded-3xl p-8 gradient-2 hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Chat Section -->
                    <div class="text-center luxury-float">
                        <div class="text-5xl mb-4">💬</div>
                        <h3 class="font-heading text-2xl font-bold text-white mb-2">Real Conversations</h3>
                        <p class="font-body text-white/90">Chat, share, and vibe with people who match your energy.</p>
                    </div>
                    
                    <!-- Watch Section -->
                    <div class="text-center luxury-float" style="animation-delay: 0.3s;">
                        <div class="text-5xl mb-4">🎥</div>
                        <h3 class="font-heading text-2xl font-bold text-white mb-2">Live Moments</h3>
                        <p class="font-body text-white/90">Watch streams & shorts from creators worldwide.</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <button onclick="prevSlide()" class="text-white/70 hover:text-white transition-colors">
                        ← Back
                    </button>
                    <button onclick="nextSlide()" class="glass-button px-6 py-3 rounded-xl text-white font-semibold">
                        Continue
                    </button>
                </div>
            </div>

            <!-- Slide 3: Meet & Travel -->
            <div id="slide3" class="slide glass-luxury rounded-3xl p-8 gradient-3 hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Meet Section -->
                    <div class="text-center luxury-float">
                        <div class="text-5xl mb-4">🤝</div>
                        <h3 class="font-heading text-2xl font-bold text-white mb-2">Meet Safely</h3>
                        <p class="font-body text-white/90">Plan meetups, hangouts, and events with ease.</p>
                    </div>
                    
                    <!-- Travel Section -->
                    <div class="text-center luxury-float" style="animation-delay: 0.3s;">
                        <div class="text-5xl mb-4">✈️</div>
                        <h3 class="font-heading text-2xl font-bold text-white mb-2">Travel Smarter</h3>
                        <p class="font-body text-white/90">Discover locals & travelers before you even arrive.</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <button onclick="prevSlide()" class="text-white/70 hover:text-white transition-colors">
                        ← Back
                    </button>
                    <button onclick="nextSlide()" class="glass-button px-6 py-3 rounded-xl text-white font-semibold">
                        Continue
                    </button>
                </div>
            </div>

            <!-- Slide 4: Boost Discovery -->
            <div id="slide4" class="slide glass-luxury rounded-3xl p-8 text-center gradient-4 hidden">
                <div class="mb-8">
                    <!-- Progress Ring -->
                    <div class="relative mx-auto w-32 h-32 mb-6">
                        <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" stroke="rgba(255,255,255,0.2)" stroke-width="8" fill="none"/>
                            <circle cx="50" cy="50" r="45" stroke="white" stroke-width="8" fill="none" 
                                    stroke-linecap="round" class="progress-fill" 
                                    style="stroke-dasharray: 0 283; stroke-dashoffset: 0;"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">90%</span>
                        </div>
                    </div>
                    
                    <h1 class="font-heading text-3xl font-bold text-white mb-4">
                        ⭐ Stand Out More
                    </h1>
                    <p class="font-body text-lg text-white/90 mb-8">
                        "Profiles over 90% complete get recommended more often."
                    </p>
                </div>
                
                <div class="space-y-4">
                    <button onclick="window.location.href='<?= SITEURL . 'edit-profile' ?>'" class="w-full glass-button px-8 py-4 rounded-2xl text-white font-semibold text-lg premium-glow">
                        Complete My Profile
                    </button>
                    <button onclick="closeOnboarding()" class="text-white/70 hover:text-white transition-colors text-sm">
                        Skip for now → Dashboard
                    </button>
                </div>
            </div>

            <!-- Progress Indicators -->
            <div class="flex justify-center mt-6 space-x-2">
                <div id="dot1" class="w-3 h-3 rounded-full bg-white transition-all duration-300"></div>
                <div id="dot2" class="w-3 h-3 rounded-full bg-white/30 transition-all duration-300"></div>
                <div id="dot3" class="w-3 h-3 rounded-full bg-white/30 transition-all duration-300"></div>
                <div id="dot4" class="w-3 h-3 rounded-full bg-white/30 transition-all duration-300"></div>
            </div>
        </div>
    </div>

<?php } ?>

  <!-- Mobile Navigation -->
  <nav class="mobile-nav md:hidden footer-mobile-menus">
    <div class="flex justify-around">

      <div class="mobile-nav-item active" onclick="window.location.href='<?= SITEURL ?>user/profile'" >
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
        </svg>
        <span>Feed</span>
      </div>
      
      <div class="mobile-nav-item" onclick="window.location.href='<?= SITEURL ?>all-members'" >
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span>Search</span>
      </div>
      <div class="mobile-nav-item"  onclick="window.location.href='<?= SITEURL ?>chat-app'" >
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <span>Messages</span>
      </div>


      <div class="mobile-nav-item" onclick="window.location.href='<?= SITEURL ?><?php echo urlencode($userDetails['username'])?>'" >
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span>Profile</span>
      </div>


    </div>
  </nav>


  <?php include('../../includes/footer.php'); ?>

   <link href="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
   <script type="text/javascript" src="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.js"></script>

  <script>

      let currentSlide = 1;
        const totalSlides = 4;

        function showSlide(slideNumber) {
            // Hide all slides
            for (let i = 1; i <= totalSlides; i++) {
                document.getElementById(`slide${i}`).classList.add('hidden');
                document.getElementById(`dot${i}`).classList.remove('bg-white');
                document.getElementById(`dot${i}`).classList.add('bg-white/30');
            }
            
            // Show current slide with animation
            const currentSlideEl = document.getElementById(`slide${slideNumber}`);
            currentSlideEl.classList.remove('hidden');
            currentSlideEl.classList.add('slide-in-luxury');
            
            // Update progress indicator
            document.getElementById(`dot${slideNumber}`).classList.add('bg-white');
            document.getElementById(`dot${slideNumber}`).classList.remove('bg-white/30');
            
            // Trigger specific animations for slide 4
            if (slideNumber === 4) {
                setTimeout(() => {
                    const progressCircle = document.querySelector('.progress-fill');
                    progressCircle.style.strokeDasharray = '254 283';
                }, 500);
            }
        }

        function nextSlide() {
            if (currentSlide < totalSlides) {
                currentSlide++;
                showSlide(currentSlide);
            }
        }

        function prevSlide() {
            if (currentSlide > 1) {
                currentSlide--;
                showSlide(currentSlide);
            }
        }

        function completeProfile() {
            
            closeOnboarding();
        }

        function skipOnboarding() {
            // Add your dashboard redirect logic here
            alert('Redirecting to dashboard...');
            closeOnboarding();
        }

        function closeOnboarding() {
            document.getElementById('onboardingModal').style.display = 'none';
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight' || e.key === ' ') {
                e.preventDefault();
                nextSlide();
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                prevSlide();
            } else if (e.key === 'Escape') {
                closeOnboarding();
            }
        });

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    nextSlide();
                } else {
                    // Swipe right - previous slide
                    prevSlide();
                }
            }
        }

    showSlide(1);



    $(document).ready(function () {
        var itemsPerPage = <?php echo $itemsPerPage; ?>;
        var totalPosts   = <?php echo $total_posts; ?>;
        var currentPage  = <?php echo $page; ?>;

        if ($("#pagination-container").data("pagination-initialized") !== true) {
            $("#pagination-container").pagination({
                items: totalPosts,
                itemsOnPage: itemsPerPage,
                currentPage: currentPage,
                cssStyle: "light-theme",
                onPageClick: function (pageNumber) {
                    window.location.href = "?page=" + pageNumber;
                }
            });
            $("#pagination-container").data("pagination-initialized", true);
        }
    });

        function FollowModel(model_id,profileName,status)
        {

            $.ajax({
                url: "<?= SITEURL . '/ajax/model_followrequest.php' ?>",
                type: 'GET',
                data:{
                    modelid: model_id,
                    notification_type: 'follow',
                },
                success: function (response) {
        
                    $(`#${status}`).text('Follow Requested');

                    showNotification(`Connection request sent to ${profileName}!`, 'success');
               
                },
                error: function (xhr) {
                  
                }
            });

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
