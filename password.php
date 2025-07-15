<?php

include('includes/config.php');
include('includes/helper.php');

$sql = "SELECT id, password FROM model_user";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $plain_password = $row['password'];

        if (password_get_info($plain_password)['algo'] !== 0) {
            continue;
        }
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        $update = "UPDATE model_user SET password = '$hashed_password' WHERE id = $id";
        mysqli_query($con, $update);
    }
    echo "Password update completed.";
} else {
    echo "No users found.";
}
?>
