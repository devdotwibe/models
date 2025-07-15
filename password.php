<?php
include('includes/config.php');

$sql = "SELECT id, password FROM model_user";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $plain_password = $row['password'];

        // Skip if already hashed
        if (password_get_info($plain_password)['algo'] !== 0) {
            continue;
        }

        // Hash the password
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        var_dump($hashed_password); exit;

        $escaped_password = mysqli_real_escape_string($con, $hashed_password);

        // Update the hashed password in the database
        $update = "UPDATE model_user SET password = '$escaped_password' WHERE id = $id";
        mysqli_query($con, $update);
    }
    echo "Password update completed. tetst";
} else {
    echo "No users found.";
}
?>
