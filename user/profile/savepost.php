<?php

session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    if(isset($_POST['action']) && $_POST['action'] =='post_submit' )
    {
        $user_id      = $_POST['user_id'] ?? null;
        $post_title   = trim($_POST['post_title'] ?? '');
        $post_content = trim($_POST['post_content'] ?? '');

        $post_mime_type = trim($_POST['file_type'] ?? '');
        $post_type = trim($_POST['post_type'] ?? '');

        $token = !empty($_POST['token']) ? $_POST['token'] : null;

        if ($post_type === 'paid' && empty($token)) {
            echo "Token is required for paid posts.";
            exit;
        }

        $allowed_mime_types = ['Image', 'Video'];
        if (!in_array($post_mime_type, $allowed_mime_types)) {
            echo "Invalid file type. Only 'image' or 'video' allowed.";
            exit;
        }

        $image_path   = null;

        $upload_folder_relative = '../../uploads/post_image/';
        $upload_folder_for_db   = 'uploads/post_image/';

        if (!is_dir($upload_folder_relative)) {
            mkdir($upload_folder_relative, 0755, true);
        }

        if (isset($_FILES["post_image"]) && $_FILES["post_image"]["error"] === 0) {

                $file_size = $_FILES["post_image"]["size"];
                $file_tmp  = $_FILES["post_image"]["tmp_name"];
                $filename  = uniqid() . '_' . basename($_FILES["post_image"]["name"]);
                $target_file = $upload_folder_relative . $filename;

                $file_mime_type = mime_content_type($file_tmp);

                if ($post_mime_type === 'Image') {
                    if (strpos($file_mime_type, 'image/') !== 0) {
                        echo "Uploaded file must be an image.";
                        exit;
                    }

                    if ($file_size > 5 * 1024 * 1024) {
                        echo "Image size must not exceed 5MB.";
                        exit;
                    }
                }

                if ($post_mime_type === 'Video') {
                    if (strpos($file_mime_type, 'video/') !== 0) {
                        echo "Uploaded file must be a video.";
                        exit;
                    }

                    if ($file_size > 20 * 1024 * 1024) {
                        echo "Video size must not exceed 20MB.";
                        exit;
                    }
                }

                if (move_uploaded_file($file_tmp, $target_file)) {
                    $image_path = $upload_folder_for_db . $filename;
                } else {
                    echo "Image/Video upload failed.";
                    exit;
                }
            }

        $stmt = $con->prepare("INSERT INTO live_posts (post_author, post_title, post_content, post_image,post_mime_type,post_type,token,post_date, post_date_gmt) VALUES (?, ?, ?, ? ,? , ?, ?, NOW(), NOW())");
        $stmt->bind_param("issssss", $user_id, $post_title, $post_content, $image_path,$post_mime_type,$post_type,$token);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Database error: " . $stmt->error;
        }
    }


    if(isset($_POST['action']) && $_POST['action'] =='story_submit' )
    {
        $user_id      = $_POST['user_id'] ?? null;

        $story_description   = trim($_POST['story_description'] ?? '');
     
        $image_path   = null;

        $upload_folder_relative = '../../uploads/story_image/';
        $upload_folder_for_db   = 'uploads/story_image/';

        if (!is_dir($upload_folder_relative)) {
            mkdir($upload_folder_relative, 0755, true);
        }

        if (isset($_FILES["story_image"]) && $_FILES["story_image"]["error"] === 0) {

                $file_size = $_FILES["story_image"]["size"];
                $file_tmp  = $_FILES["story_image"]["tmp_name"];
                $filename  = uniqid() . '_' . basename($_FILES["story_image"]["name"]);
                $target_file = $upload_folder_relative . $filename;


                if (move_uploaded_file($file_tmp, $target_file)) {
                    $image_path = $upload_folder_for_db . $filename;
                } else {
                    echo "Image/Video upload failed.";
                    exit;
                }
        }

        $stmt = $con->prepare("INSERT INTO model_user_story (user_id,files,message,created_date) VALUES (?, ?, ?, NOW())");

        $stmt->bind_param("iss", $user_id, $image_path, $story_description);

        if ($stmt->execute()) {

            echo json_encode([
                "status" => "success",
                "message" => "Story submitted successfully"
            ]);

        } else {

            echo "Database error: " . $stmt->error;
        }
    }

} else {
    echo "Invalid request.";
}
