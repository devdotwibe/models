<?php

session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id      = $_POST['user_id'] ?? null;
    $post_title   = trim($_POST['post_title'] ?? '');
    $post_content = trim($_POST['post_content'] ?? '');
    $image_path   = null;

    $upload_folder_relative = '../../uploads/post_image/';
    $upload_folder_for_db   = 'uploads/post_image/';

    if (!is_dir($upload_folder_relative)) {
        mkdir($upload_folder_relative, 0755, true);
    }

    if (isset($_FILES["post_image"]) && $_FILES["post_image"]["error"] === 0) {
        $filename     = uniqid() . '_' . basename($_FILES["post_image"]["name"]);
        $target_file  = $upload_folder_relative . $filename;

        if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
            $image_path = $upload_folder_for_db . $filename; // this is stored in DB
        } else {
            echo "Image upload failed.";
            exit;
        }
    }

    $stmt = $con->prepare("INSERT INTO live_posts (post_author, post_title, post_content, post_image, post_date, post_date_gmt) VALUES (?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("isss", $user_id, $post_title, $post_content, $image_path);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Database error: " . $stmt->error;
    }

} else {
    echo "Invalid request.";
}
