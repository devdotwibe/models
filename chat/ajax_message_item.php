<?php
if($all_message_data){
foreach($all_message_data as $set_user){
	$defaultImage =SITEURL."/assets/images/girl.png";
	$type ="sent";
//	printR($set_user);
	if($set_user['sender_id']==$userDetails['id']){
		$type ="replies";
		if($userDetails['gender']=='Male'){
			$defaultImage =SITEURL."/assets/images/profile.png";
		}
		if(!empty($userDetails['profile_pic'])){
			$defaultImage = SITEURL.$userDetails['profile_pic'];
		}
	}
	else{
		$type ="sent";
		if($user_data['gender']=='Male'){
			$defaultImage =SITEURL."/assets/images/profile.png";
		}
		if(!empty($user_data['profile_pic'])){
			$defaultImage = SITEURL.$user_data['profile_pic'];
		}
	}
?>
<li class="<?=$type?>">
<img src="<?=$defaultImage?>" alt="" />
<div>
<p><?=$set_user['message']?></p>
<!--<div class="datetime">45534</div>-->
</div>
</li>
<?php
	}
}
?>