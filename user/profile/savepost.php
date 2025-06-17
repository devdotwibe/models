<?php

session_start(); 

include('../../includes/config.php');
include('../../includes/helper.php');

    echo "test";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_POST['user_id'];



    $post_content = trim($_POST['post_content']);

    $image_path = null;

    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === 0) {
        $upload_dir = 'uploads/post_image/';
        $filename = uniqid() . '_' . basename($_FILES['post_image']['name']);
        $target_path = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $target_path)) {
            $image_path = 'uploads/post_image' . $filename;
        }
    }

    $stmt = $con->prepare("INSERT INTO live_posts (post_author, post_content, post_image, post_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $user_id, $post_content, $image_path);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Database error: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
