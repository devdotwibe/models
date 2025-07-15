<?php
include('includes/config.php');

$sql = "SELECT id, password FROM model_user";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $plain_password = $row['password'];
        
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
        $escaped_password = mysqli_real_escape_string($con, $hashed_password);

        $update = "UPDATE model_user SET password = '$escaped_password' WHERE id = $id";
        if (!mysqli_query($con, $update)) {
            echo "Failed to update ID $id: " . mysqli_error($con) . "<br>";
        }
    }
    echo "Password update completed.";
} else {
    echo "No users found.";
}
?>
