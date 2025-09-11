<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();

if(isset($_SESSION['log_user_id'])) {
	
$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){
	
	$user_have_preminum = false;
	    $result = CheckPremiumAccess($userDetails['id']);

        if ($result && $result['active']) {

            $user_have_preminum = true;
        }
		
	
	$type = $_GET['type'];
	$get_ids = array(); $get_uids = array();
	if($type == 'likedyou'){
		$liked_you_array = DB::query("select user_id from user_model_likes where model_id=" . $userDetails['id'] . "  AND user_model_likes.like='Yes' ");
		$get_ids = array();
		if(!empty($liked_you_array)){
			foreach($liked_you_array as $lk_you){
				$get_ids[] = $lk_you['user_id'];
			}
		}
	}else if($type == 'viewedyou'){
		$viewed_you_array = DB::query("select viewer_user_id from model_user_profile_views where profile_user_id=" . $userDetails['id']);
		$get_ids = array();
		if(!empty($viewed_you_array)){
			foreach($viewed_you_array as $vw_you){
				$get_ids[] = $vw_you['viewer_user_id'];
			}
		}
	}else if($type == 'likedme'){
		$liked_you_array = DB::query("select model_id from user_model_likes where user_id=" . $userDetails['id'] . "  AND user_model_likes.like='Yes' ");
		$get_ids = array();
		if(!empty($liked_you_array)){
			foreach($liked_you_array as $lk_you){
				$get_ids[] = $lk_you['model_id'];
			}
		}
	}else if($type == 'viewedme'){
		$viewed_you_array = DB::query("select profile_user_id from model_user_profile_views where viewer_user_id=" . $userDetails['id']);
		$get_ids = array();
		if(!empty($viewed_you_array)){
			foreach($viewed_you_array as $vw_you){
				$get_ids[] = $vw_you['profile_user_id'];
			}
		}
	}else if($type == 'meet'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Meetup'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'travel'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Travel'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'collaboration'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Collaboration'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'group_chat'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Group Chat'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'private_chat'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Private Chat'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'local_meetup'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Local Meetup'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'extended_social'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Extended Social'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}else if($type == 'overnight_social'){
		$group_chat_array = DB::query("select DISTINCT model_unique_id from model_booking where user_unique_id='" . $userDetails['unique_id'] . "' AND service_name='Overnight Social'");
		$get_uids = array();
		if(!empty($group_chat_array)){
			foreach($group_chat_array as $vw_you){
				$get_uids[] = "'".$vw_you['model_unique_id']."'";
			}
		}
	}
	
	$return_html = '';
	if(!empty($get_ids) || !empty($get_uids)){
		if(!empty($get_ids)) {
			$idList = implode(',', $get_ids);
			$sqls = "SELECT * FROM model_user mu WHERE mu.id IN ($idList)";
		}else {
			$idList = implode(',', $get_uids);
			$sqls = "SELECT * FROM model_user mu WHERE mu.unique_id IN ($idList)";
		}
		
		$resultd = mysqli_query($con, $sqls); 
		if (mysqli_num_rows($resultd) > 0) {
			
			while ($rowesdw = mysqli_fetch_assoc($resultd)) {
			    $unique_id = $rowesdw['unique_id'];

                if (!empty($rowesdw['profile_pic'])) {
                            $profile_pic = SITEURL . $rowesdw['profile_pic'];
                } else {
                            $profile_pic = SITEURL . 'assets/images/model-gal-no-img.jpg';
                }

                        if (!empty($rowesdw['username'])) {
                            $modalname = $rowesdw['username'];
                        } else {
                            $modalname = $rowesdw['name'];
                        }
						
						$prof_img = SITEURL . 'assets/images/model-gal-no-img.jpg';

                            if (!empty($rowesdw['profile_pic'])) {
                                if (checkImageExists($rowesdw['profile_pic'])) {

                                    $prof_img = SITEURL . $rowesdw['profile_pic'];
                                }
                            }

                $is_user_preminum = CheckPremiumAccess($rowesdw['id']);

                $is_user_new = IsNewUser($rowesdw['id']);

                $extra_details = DB::queryFirstRow("SELECT status FROM model_extra_details WHERE unique_model_id = %s ", $unique_id);

				$return_html .= '<div class="model-card" data-premium="false" onclick="';
				if (!$user_have_preminum) { $return_html .= 'showPremiumModal()'; } 
				$return_html .= '">
        <div style="position: relative;">
            <img src="'.$prof_img .'" alt="Model" class="model-image">';
			if (isUserOnline($rowesdw['id']) === 'Online') {
            $return_html .= '<div class="status-indicator status-online"></div>';
			}
            $return_html .= '<div class="verified-badge">';
			
				//$return_html .= '<span class="profile-badge badge-live">Live</span>';

                                       if($is_user_new) { 

                                             $return_html .= '<span class="profile-badge badge-new">New</span>';

                                        } 

                                       if($is_user_preminum) { 

                                             $return_html .= '<span class="profile-badge badge-premium">Premium</span>';

                                        } 
										if ($is_user_preminum) { 

                                            if ($preminum_plan == 'basic') { 

                                                $return_html .= '<span class="profile-badge badge-premium">
                                                    <div class="badge-user premium-basic-user">⭐</div>
                                                    <p>Premium</p>
                                                </span>';

                                             } else { 

                                               $return_html .= ' <span class="profile-badge badge-premium">
                                                    <div class="badge-user diamond-elite-user"><span>💎</span></div>
                                                    <p>Premium</p>
                                                </span>';

                                             } 

                                         }

                                         if (!empty($extra_details) && !empty($extra_details) && $extra_details['status'] == 'Published') { 
                                            $return_html .= '<span class="profile-badge badge-verified">Verified</span>';
                                       } 
									   if (!empty($rowesdw) &&  $rowesdw['as_a_model'] == 'Yes') { 

                                            $return_html .= '<span class="profile-badge creator-badge">
                                                <div class="badge-user creator">✨</div>
                                                <p>Creator</p>
                                            </span>';

                                        }
			
			$return_html .= '</div>
        </div>
        
		
		<div class="model-info">
            <div class="model-name">
                <span>'.ucfirst($modalname).'</span>
                <span style="font-size: 16px; color: rgba(255,255,255,0.8);">';
				 if (!empty($rowesdw['age'])) { $return_html .=  $rowesdw['age']; } 
				 $return_html .= '</span>
            </div>';
			if (!empty($rowesdw['city']) || !empty($rowesdw['country'])) { 
            $return_html .= '<div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 6px;">';
			
			 $modelcity = $rowesdw['city'];
                                    $cities = DB::queryFirstRow("SELECT name FROM cities WHERE id =  %s ", $rowesdw['city']);
                                    if (!empty($cities)) {
                                        $modelcity = $cities['name'];
                                    }
                                    $modelcountry = $rowesdw['country'];
                                    $countries = DB::queryFirstRow("SELECT name FROM countries WHERE id =  %s ", $rowesdw['country']);
                                    if (!empty($countries)) {
                                        $modelcountry = $countries['name'];
                                    } 
			$return_html .=  $modelcity; 
			if (!empty($modelcity) && !empty($modelcountry)) { $return_html .= ' • '; } $return_html .=  $modelcountry;
									
			$return_html .= '</div>';
			 } 
            /*$return_html .= '<div style="font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px;">';
			
			if ($user_have_preminum) { $return_html .= ' 👑 Premium'; } 
			$return_html .= '</div>';*/
			if (!$user_have_preminum) { 
            $return_html .= '<button class="upgrade-btn" onclick="event.stopPropagation(); showPremiumModal();">👑 Upgrade to Premium</button>';
			 } 
            
			$return_html .= '
			<div class="action-buttons">
                <button class="action-btn" onclick="';
				if (!$user_have_preminum) { $return_html .= 'event.stopPropagation(); showPremiumModal();'; } 
				else{ $return_html .= 'ActionBtn(this,"pass")'; }
				$return_html .= '" modelid="'.$rowesdw['id'].'" >✕</button>
                <button class="action-btn heart" onclick="';
				if (!$user_have_preminum) { $return_html .= 'event.stopPropagation(); showPremiumModal();'; } 
				else{ $return_html .= 'ActionBtn(this,"like")'; }
				$return_html .= '" modelid="'.$rowesdw['id'].'" >♡</button>
                <button class="action-btn" onclick="';
				if (!$user_have_preminum) { $return_html .= 'event.stopPropagation(); showPremiumModal();'; } 
				else{ $return_html .= 'ActionBtn(this,"connect")'; }
				$return_html .= '" modelid="'.$rowesdw['id'].'" >👤</button>
            </div>
			
			
        </div>
		
		
		
    </div>';




						
				
			}
			echo json_encode([
                'status' => 'success',
                'message' =>  $return_html,
				'sql' =>$sqls
            ]);
            exit;
			
			
		}else{
		
		echo json_encode([
					'status' => 'error',
					'message' =>  'No users found',
				]);
				exit;
		}
	}else{
		echo json_encode([
                'status' => 'error',
                'message' =>  'Not users found',
            ]);
            exit;
	}
}else{
	echo json_encode([
                'status' => 'error',
                'message' =>  'Not a valid user',
            ]);
            exit;
}
}else{
echo json_encode([
                'status' => 'error',
                'message' =>  'No user logged',
            ]);
            exit;	
}