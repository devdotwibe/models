<?php  session_start(); ?>
<?php 
include('../includes/config.php');
include('../includes/helper.php');
$error = '';
//printR($_SESSION);
$id = $_GET['id'];
$showComment = 'There is no model';
$getCommentList = array();
if($id){
  $getImage= get_data('model_images',array('id'=>$id),true);
	if($getImage){
		$showComment = '';

$stringQuery = "SELECT tb.*, u.username, u.profile_pic
 FROM model_images_comment tb 
join model_user u on u.id=tb.user_id 
 where model_id=".$getImage['id']." order by id asc";
		
		$getCommentList = DB::query($stringQuery);
	}

	if(isset($_SESSION['log_user_id'])){}
	else{
	  $error = 'login';
	}
}

if($showComment==''){
	ob_start();
	include 'ajax_comment_content.php';
	$html= ob_get_clean();
}
else{
	$html = '<div class="text-center">'.$showComment.'</div>';
}
echo json_encode(array('html'=>$html));
?>