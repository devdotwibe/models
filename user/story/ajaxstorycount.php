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
            if($story_list['user_id']!=$userDetails['id']){
                if(get_count('model_user_story_view',array('user_id'=> $userDetails['id'],'story_id'=> $story_list['id'],))==0){
                    $post_data =array(
                        'user_id'=> $userDetails['id'],
                        'story_id'=> $story_list['id'],
                        'ip_address'=> h_my_ip_address(),
                        'created_date'=> date('Y-m-d H:i:s'),
                    );
                    DB::insert('model_user_story_view', $post_data);
                    $output['status']= 'ok';
                    $output['messsage'] = 'success';
                }
                else{
                    $output['messsage'] = 'already view';
                }
            }
            else{
                $output['messsage'] = 'this is own story';
            }
        }
    }
}
echo json_encode($output);
?>
