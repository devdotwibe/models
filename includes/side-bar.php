<?php 
if (isset($_SESSION['log_user_id'])) {

	// $log_user_id = $_SESSION['log_user_id'];
	// $get_modal_user = DB::query('select * from model_user where id='.$log_user_id);
	// if(!empty($get_modal_user[0]['username'])){
	// 	$modalname = ucfirst($get_modal_user[0]['username']);
	// }else{
	// 	$modalname = ucfirst($get_modal_user[0]['name']);
	// }
	// $as_a_model = $get_modal_user[0]['as_a_model'];
	// $unique_id = $get_modal_user[0]['unique_id'];


}else{ 
	$log_user_id = 0; 
	$get_modal_user = array(); 
	$as_a_model = '';
	$unique_id = '';

  $modalname="";
}

?>
