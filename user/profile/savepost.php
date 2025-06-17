<?php

session_start();

include('../../includes/config.php');
include('../../includes/helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id      = $_POST['user_id'] ?? null;
    $post_title   = trim($_POST['post_title'] ?? '');
    $post_content = trim($_POST['post_content'] ?? '');
    $image_path   = null;

    $target_dir_post = "uploads/post_image/";
    $filename        = basename($_FILES["post_image"]["name"]);
    $target_file     = $target_dir_post . $filename;

    if (!is_dir($target_dir_post)) {
        mkdir($target_dir_post, 0755, true);
    }

    if (isset($_FILES["post_image"]) && $_FILES["post_image"]["error"] === 0) {
        if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            echo "Image upload failed.";
            exit;
        }
    }

    $stmt = $con->prepare("INSERT INTO live_posts (post_author, post_title, post_content, post_image, post_date, post_date_gmt) VALUES (?, ?, ?, ?, NOW(), NOW())");

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("isss", $user_id, $post_title, $post_content, $image_path);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Database error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();

} else {
    echo "Invalid request.";
}
