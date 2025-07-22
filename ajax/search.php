<?php session_start();
include('../includes/config.php');
include('../includes/helper.php');



if (isset($_POST['search']) && !empty($_POST['search'])) {
    
    $search = $_POST['search'];

    $userDetails = search_user('model_user', ['name' => $search], false);

    if (!empty($userDetails)) {

        foreach ($userDetails as $user) {

            echo "<div>{$user['name']}</div>";
        }
    } else {

        echo "<div>No results found.</div>";
    }
}
