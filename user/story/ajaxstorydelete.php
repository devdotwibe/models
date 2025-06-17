<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

$output = array();
$output['status']= 'error';

$output['messsage'] = 'There is no story';
$model_id = $_GET['id'];
if($model_id){
    $story_list =  get_data('model_user_story',array('id'=>$model_id),true);
    if(isset($_SESSION['log_user_id'])){
        $userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
        if($userDetails){
            if($story_list['user_id']==$userDetails['id']){
                DB::delete('model_user_story', 'id=%s', $story_list['id']);
                DB::delete('model_user_story_view', 'story_id=%s', $story_list['id']);
                $filename = '../../uploads/story/'.$story_list['files'];
                if (file_exists($filename)) {
                    unlink($filename);
                }
                $output['status']= 'ok';
                $output['messsage'] = 'success';
            }
        }
    }
}
echo json_encode($output);
?>
