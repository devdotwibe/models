<?php
session_start();
//error_reporting(1);
require_once '../includes/helper.php';
$config['googleplus']['application_name'] = 'test'; // product name
$config['googleplus']['client_id']        = '830777051554-cnqud6q0ed47tubtdvncqgshbno4bct7.apps.googleusercontent.com'; // client id
$config['googleplus']['client_secret']    = 'eLbrIbzRH9BTK1-J3za_hB6d'; // secret key
$config['googleplus']['api_key']          = 'AIzaSyCyg9QUZF9zRhWkcotSOP2DGBO60I6uK2c'; // api key

//$config['googleplus']['redirect_uri']     = 'http://localhost/thelivemodal/demo/libss/google_login.php'; // redirect uri

$config['googleplus']['redirect_uri']     = 'https://thelivemodels.com/libss/google_login.php'; // redirect uri
$config['googleplus']['scopes']           = array();

require_once 'google-login-api/apiClient.php';
require_once 'google-login-api/contrib/apiOauth2Service.php';
//include('google_api/google.php');

$gClient = new apiClient();
$gClient->setApplicationName($config['googleplus']['application_name']);
$gClient->setClientId($config['googleplus']['client_id']);
$gClient->setClientSecret($config['googleplus']['client_secret']);
$gClient->setRedirectUri($config['googleplus']['redirect_uri']);

$google_oauthV2 = new apiOauth2Service($gClient);

// printR($google_oauthV2);		
// $authUrl = $gClient->createAuthUrl(); 
// echo '<a href="'.$authUrl.'">login</a>';

 
if(isset($_GET['code'])){ 
	$gClient->authenticate(htmlspecialchars($_GET['code'])); 
    $_SESSION['token'] = $gClient->getAccessToken(); 
   	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); 
} 
 
//echo 'ok';
if(isset($_SESSION['token'])){ 
    $gClient->setAccessToken($_SESSION['token']); 
} 
 
if($gClient->getAccessToken()){ 
    // Get user profile data from google 
    $gpUserProfile = $google_oauthV2->userinfo->get(); 
	if($gpUserProfile){
		include('../includes/config.php');
		$checkData = get_data('model_user',array('email'=>strtolower($gpUserProfile['email'])),true);
		if(!$checkData){
			$password = rand(10000,99999);
			$post_data = array(
						'name' => $gpUserProfile['name'],
						'email' => $gpUserProfile['email'],
						'google_id' => $gpUserProfile['id'],

						'username' => h_generate_username($gpUserProfile['given_name']),
						'password' => $password,
						'gender' => 'Male',
						'logged_update' => date('Y-m-d H:i:s'),
			);
			DB::insert('model_user', $post_data);
			$created_id = DB::insertId();

			$unique_id = h_generate_model_id($created_id);

			$post_data['profile_pic'] = '';
			
			$user_type = 'User';
			
			$_SESSION["log_user_id"] = $created_id;
			$_SESSION["log_user"] = $post_data['username'];
			$_SESSION["log_user_unique_id"] = $unique_id;
			$_SESSION["log_user_email"] = $post_data['email'];
			$_SESSION["log_user_pro_pic"] = 'uploads/profile_pic/icons-user.jpg';
			$_SESSION["user_type"] = $user_type;
			$_SESSION["city"] = '';
		}
		else{
			 $user_type = 'User';
	         if($checkData['as_a_model'] == 'Yes'){
				$user_type = 'Model';
			 }
			 $_SESSION["log_user_id"] = $checkData['id'];
			 $_SESSION["log_user"] = $checkData['username'];
			 $_SESSION["log_user_unique_id"] = $checkData['unique_id'];
			 $_SESSION["log_user_email"] = $checkData['email'];
			 $_SESSION["log_user_pro_pic"] = $checkData['profile_pic'];
			 $_SESSION["user_type"] = $user_type;
			 $_SESSION["city"] = $checkData['city'];
		}
		header("Location: ".SITEURL);
	}
	header("Location: ".SITEURL);
}
else{ 
    // Get login url 
    $authUrl = $gClient->createAuthUrl(); 
    // Render google login button 
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'">login</a>'; 
	header("Location: ".$authUrl);
} 
?>
