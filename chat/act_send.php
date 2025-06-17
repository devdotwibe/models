<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array('status'=>'error','message'=>'There is some problem');
if(isset($_SESSION['log_user_id'])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){
		//$post =  array_from_post(array('user_id','message'));
		$post =  array_from_get(array('user_id','message'));
		if($post['user_id']&&$post['message']){
			$date = date('Y-m-d H:i:s');
			$post_data = $post;
			$post_data['created_date'] = $date;
			$post_data['sender_id'] = $userDetails['id'];
			DB::insert('model_user_message', $post_data);
			$joe_id = DB::insertId();
		
			
			$type ="replies";
			if($userDetails['gender']=='Male'){
				$defaultImage =SITEURL."/assets/images/profile.png";
			}
			if(!empty($userDetails['profile_pic'])){
				$defaultImage = SITEURL.$userDetails['profile_pic'];
			}

			$output['status']= 'ok';
			$output['message']= '<li class="replies">
<img src="'.$defaultImage.'" alt="" />
<div>
<p>'.$post['message'].'</p>
</div>
</li>';
			
		}
	}
	
}
echo json_encode($output);


?>
