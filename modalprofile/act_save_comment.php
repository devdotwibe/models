<?php  session_start(); ?>
<?php 
include('../includes/config.php');
include('../includes/helper.php');
$error = '';
//printR($_SESSION);
$id = $_GET['model_id'];
$comment = $_GET['comment'];
$getCommentList = array();
$output = array('status'=>'error','message'=>'There is some problem.');
if(isset($_SESSION['log_user_id'])){
	if($id&&$comment){
		$getImage= get_data('model_images',array('id'=>$id),true);
		if($getImage){
			$user_id = $_SESSION['log_user_id'];
			$arr = array('comment');
			//$post_data = array_from_post($arr);
			$post_data = array_from_get($arr);
			$post_data['user_id'] = $user_id;
			$post_data['model_id'] = $id;
			$post_data['created_date'] = date('Y-m-d H:i:s');
			
			DB::insert('model_images_comment', $post_data);
			$created_id = DB::insertId();
			$output['message'] = '';
			$output['status'] = 'ok';
		}
		else{
			$output['message'] = 'There is no post.';
		}
	}
	else{
		$output['message'] = 'There is some problem.';
	}
}

echo json_encode($output);
?>