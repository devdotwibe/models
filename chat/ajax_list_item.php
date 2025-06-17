<?php
if($all_data){
	foreach($all_data as $set_user){
		if($set_user['id']!=$userDetails['id']){
$stringQuery = "SELECT tb.message
FROM model_user_message tb 
 where (sender_id=".$userDetails['id']." and user_id=".$set_user['id'].") 
or (user_id=".$userDetails['id']." and sender_id=".$set_user['id'].") 
 order by id desc";
		
	$lastMssage = DB::queryFirstRow($stringQuery);
	if($lastMssage){
		$message  = limit_text($lastMssage['message'],5);
	}
	else{
		$message  = '';
	}
	$defaultImage =SITEURL."/assets/images/girl.png";
	if($set_user['gender']=='Male'){
		$defaultImage =SITEURL."/assets/images/profile.png";
	}
	if(!empty($set_user['profile_pic'])){
		$defaultImage = SITEURL.$set_user['profile_pic'];
	}
	$unread = get_count('model_user_message',array('user_id'=>$userDetails['id'],'is_read'=>1));
?>
<li class="contact">
  <div class="wrap">
    <!--<span class="contact-status online"></span>-->
    <img src="<?=$defaultImage?>" alt="" />
    <div class="meta">
      <p class="name"><a href="<?=SITEURL.'chat/view.php?id='.$set_user['id']?>"><?=$set_user['username']?></a></p>
      <p class="preview"><?=$message?></p>
    </div>
  </div>
</li>
<?php
		}
	}
}
?>
