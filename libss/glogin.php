<?php
session_start();
require_once '../includes/helper.php';
require_once 'google/vendor/autoload.php';

$clientID = '830777051554-cnqud6q0ed47tubtdvncqgshbno4bct7.apps.googleusercontent.com';
$clientSecret = 'eLbrIbzRH9BTK1';
//$redirectUri = 'http://localhost/thelivemodal/demo/libss/glogin.php';
$redirectUri = 'https://thelivemodels.com/libss/glogin.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  printR($token);die;
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  
  // now you can use this profile info to create account in your website and make user logged in.
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}