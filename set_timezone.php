<?php

session_start();

if (isset($_POST['tz']) && isset($_SESSION["log_user_id"]) ) {

    $timezone = $_POST['tz'];

    if (in_array($timezone, timezone_identifiers_list())) {

        $_SESSION['user_timezone'.$_SESSION["log_user_id"]] = $timezone;

        echo "Timezone set to: " . $timezone;

    } else {

        echo "Invalid timezone";
    }
}
