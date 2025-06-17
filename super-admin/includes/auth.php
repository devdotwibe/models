<?php
session_start(); 
//include('config.php');
if(isset($_SESSION["log_id"])){
	$userDetails = get_data('sc_admin',array('user_id'=>$_SESSION["log_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="'.ADMINURL.'/login.php"</script>';
		die;
	}
}
else{
/*	if(! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
		json
	}*/

	echo '<script>window.location.href="'.ADMINURL.'/login.php"</script>';
	die;
}
