<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
  $output = array();
  
  
  $limit = 8;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;
$html = '';
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
					 $extra_details = DB::queryFirstRow("SELECT status FROM model_extra_details WHERE unique_model_id = %s ", $unique_id);
				$html .= '<div class="profile-card">
                    <div class="profile-image-container">
					<a href="'.SITEURL.'single-profile.php?m_unique_id='.$rowesdw['unique_id'].'">
                        <img src="'.SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic'].'" alt="'.$modalname.', '.$rowesdw['age'].'" class="profile-image">
                        <div class="profile-badges">
                            <span class="profile-badge badge-live">Live</span>';
							if(!empty($extra_details) && !empty($extra_details) && $extra_details['status'] == 'Published'){
								$html .='<span class="profile-badge badge-verified">Verified</span>';
							}
                       $html .= '</div>
					</a>
                    </div>
                    <div class="profile-info">
                        <h3 class="profile-name"><a href="'.SITEURL.'single-profile.php?m_unique_id='.$rowesdw['unique_id'].'">'.ucfirst($modalname); 
						if(!empty($rowesdw['age'])){ $html .= ', '.$rowesdw['age']; } 
						$html .= '</a></h3>';
						 if(!empty($rowesdw['city']) || !empty($rowesdw['country'])){ 
                        $html .= '<p class="profile-location">
                            <i class="fas fa-map-marker-alt"></i>'. $rowesdw['city'];
							if(!empty($rowesdw['city']) && !empty($rowesdw['country'])) { $html .=',';
							 }  $html .= $rowesdw['country'];
                        $html .= '</p>';
						 } if(!empty($rowesdw['user_bio'])){ 
						$user_bio  = limit_text(strip_tags($rowesdw['user_bio']),15).'...';
                        $html .= '<p class="profile-bio">'.$user_bio.'</p>';
						 } 
                    $html .= '</div>
                    <div class="profile-actions">
                        <button class="action-btn connect" title="Connect" modelid="'.$rowesdw['id'].'" model_uniq_id="'.$rowesdw['unique_id'].'">
                            <i class="fas fa-user-plus"></i>
                        </button>
                        <button class="action-btn like" title="Like" modelid="'.$rowesdw['id'].'" model_uniq_id="'.$rowesdw['unique_id'].'">
                            <i class="fas fa-heart"></i>
                        </button>
                        <button class="action-btn pass" title="Pass" modelid="'.$rowesdw['id'].'" model_uniq_id="'.$rowesdw['unique_id'].'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>';
    }
}
if($total <= $offset) $output['loadmore'] = 'no';
else $output['loadmore'] = 'yes';
$output['html'] = $html;
echo json_encode($output);
?>
