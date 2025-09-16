<?php
include('../../includes/config.php');

// // Check if column already exists
// $check = mysqli_query($con, "SHOW COLUMNS FROM model_user LIKE 'onboard'");

// if (mysqli_num_rows($check) == 0) {
//     // Add the column if not exists
//     $sql = "ALTER TABLE model_user ADD COLUMN onboard TINYINT(1) NOT NULL DEFAULT 0 AFTER id";

//     if (mysqli_query($con, $sql)) {
//         echo "✅ Column 'onboard' added successfully.";
//     } else {
//         echo "❌ Error adding column: " . mysqli_error($con);
//     }
// } else {
//     echo "ℹ️ Column 'onboard' already exists.";
// }
?>
