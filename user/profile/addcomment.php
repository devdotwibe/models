<?php

session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] =='comment') {


        $comment_author      = $_POST['author_name'] ?? null;

        $comment_author_email      = $_POST['author_email'] ?? null;

        $user_id      = $_POST['user_id'] ?? null;

        $post_id      = $_POST['post_id'] ?? null;

        $comment_content = trim($_POST['comment'] ?? '');

        $author_ip = $_SERVER['REMOTE_ADDR'];
    

        if (empty($post_id) || empty($comment_author) || empty($comment_content)) {
            echo "Required fields are missing.";
            exit;
        }

        $stmt = $con->prepare("
            INSERT INTO live_comments 
            (comment_post_ID, comment_author, comment_author_email, comment_author_IP, comment_content, user_id, comment_date, comment_date_gmt) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");

        if (!$stmt) {
            echo "Prepare failed: " . $con->error;
            exit;
        }

    $stmt->bind_param(
            "issssi", 
            $post_id, 
            $comment_author, 
            $comment_author_email, 
            $author_ip, 
            $comment_content, 
            $user_id
        );

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Database error: " . $stmt->error;
        }

    } 
    elseif($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] =='like') {

        $user_id      = $_POST['user_id'] ?? null;

        $post_id      = $_POST['post_id'] ?? null;

        $status      = 'active';

        if (empty($post_id) || empty($user_id)) {
            echo "Required fields are missing.";
            exit;
        }

        $stmt = $con->prepare("
            INSERT INTO postlike 
            (uid, pid, status, date, time) 
            VALUES (?, ?, ?, NOW(), TIME())
        ");

        if (!$stmt) {
            echo "Prepare failed: " . $con->error;
            exit;
        }

        $stmt->bind_param("iis", $user_id, $post_id, $status);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Database error: " . $stmt->error;
        }

    } 
    else {
        echo "Invalid request.";
    }
