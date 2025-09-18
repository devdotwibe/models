<?php

session_start();

include('includes/helper.php');

if (!empty($_SESSION['log_user_id'])) {

    UserLogout($_SESSION['log_user_id']);
}



session_destroy();
$home_url = 'login';
header('Location: ' . $home_url);


?>