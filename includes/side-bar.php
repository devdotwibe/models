<?php 
if (isset($_SESSION['log_user_id'])) {

	$log_user_id = $_SESSION['log_user_id'];

  $get_modal_user = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);

	// if(!empty($get_modal_user['username'])){
	// 	$modalname = ucfirst($get_modal_user['username']);
	// }else{
	// 	$modalname = ucfirst($get_modal_user['name']);
	// }
	// $as_a_model = $get_modal_user['as_a_model'];
	// $unique_id = $get_modal_user['unique_id'];


}else{ 
	$log_user_id = 0; 
	$get_modal_user = array(); 
	$as_a_model = '';
	$unique_id = '';

  $modalname="";
}

?>
