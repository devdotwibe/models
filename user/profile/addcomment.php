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

        $time = date("h:i A");

        $date = date("Y-m-d");

        if (empty($post_id) || empty($user_id)) {

           echo "Required fields are missing.";
            exit;
        }

        $check_stmt = $con->prepare("SELECT id FROM postlike WHERE uid = ? AND pid = ?");
        $check_stmt->bind_param("ii", $user_id, $post_id);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {

            echo "User already liked this post";
            exit;
        }

        $stmt = $con->prepare("
            INSERT INTO postlike 
            (uid, pid, status, date, time) 
            VALUES (?, ?, ?,?,?)
        ");

        if (!$stmt) {
            echo "Prepare failed: " . $con->error;
            exit;
        }


        $stmt->bind_param("iis", $user_id, $post_id, $status,$date,$time);

        if ($stmt->execute()) {

             echo "Liked post successfully.";
             
        } else {

            echo "Database error: " . $stmt->error;
        }

    } 
    else {
        echo "Invalid request.";
    }
