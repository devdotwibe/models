<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
$ChatLink  = SITEURL . 'live-chat/';

if ($_SESSION["log_user"]) {
  $userDetails = get_data('model_user', array('id' => $_SESSION['log_user_id']), true);
  if (!$userDetails) {
    echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
    echo "<script>window.location='" . SITEURL . "/login.php';</script>";
    die;
  }
} else {
  echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
  echo "<script>window.location='" . SITEURL . "/login.php';</script>";
  die;
}
if ($_GET['private_id']!='') {
    DB::update('tlm_private_live_chat_url', ['is_used' => 1,], "id=%s",$_GET['private_id']);
}
header('Location: '.SITEURL.'single-profile.php?m_unique_id='.$userDetails['unique_id']);
