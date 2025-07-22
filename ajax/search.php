<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('includes/config.php');
include('includes/helper.php'); // Make sure this contains get_data()

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];

    $userDetails = get_data('model_user', ['name' => $search, 'username' => $search], false);

    if (!empty($userDetails)) {
        foreach ($userDetails as $user) {
            echo "<div>{$user['name']} ({$user['username']})</div>";
        }
    } else {
        echo "<div>No results found.</div>";
    }
}
?>
