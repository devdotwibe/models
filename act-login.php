<?php
session_start(); 
include('includes/config.php');

if (isset($_POST['vfb-submit'])) {
    $userid   = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql1 = "SELECT * FROM model_user WHERE username = ? OR email = ? LIMIT 1";
    $stmt = $con->prepare($sql1);
    $stmt->bind_param("ss", $userid, $userid);
    $stmt->execute();
    $result1 = $stmt->get_result();

    if ($result1 && $result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $hashed_password = $row1['password'];

        if (password_verify($password, $hashed_password)) {
           
            $user_id1   = $row1['id'];
            $user_name1 = $row1['username'];
            $unique_id  = $row1['unique_id'];
            $email      = $row1['email'];
            $city       = $row1['city'];
            $user_type  = ($row1['as_a_model'] == 'Yes') ? 'Model' : 'User';
            $model_profile_pic = '';


            $_SESSION["log_user_id"]       = $user_id1;
            $_SESSION["log_user"]          = $user_name1;
            $_SESSION["log_user_unique_id"] = $unique_id;
            $_SESSION["log_user_email"]    = $email;
            $_SESSION["user_type"]         = $user_type;
            $_SESSION["city"]              = $city;

            unset($_SESSION["login_error"]);

            echo "<script>window.location.href = 'user/profile/index.php';</script>";

            exit;
        } else {
         
            $_SESSION["login_error"] = "Incorrect password";
            echo "<script>window.location='login.php';</script>";
            exit;
        }
    } else {

        $_SESSION["login_error"] = "Invalid username or email";
        echo "<script>window.location='login.php';</script>";
        exit;
    }
}
?>
