<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');

$use_id = $_SESSION["log_user_id"];
$target_dir_profile = "../uploads/profile_pic/"; 

$response = ['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.'];

    if (isset($_FILES["pic_img"]) && !empty($_FILES["pic_img"]['name']) && $_POST['action'] == 'upload_profile_pic') {

        $sql_old = "SELECT profile_pic FROM model_user WHERE id = '".$use_id."' LIMIT 1";
        $result_old = mysqli_query($con, $sql_old);
        $old_pic = null;

        if ($result_old && mysqli_num_rows($result_old) > 0) {
            $row_old = mysqli_fetch_assoc($result_old);
            $old_pic = $row_old['profile_pic'];
        }

        // $ext = pathinfo($_FILES["pic_img"]["name"], PATHINFO_EXTENSION);
        // $new_filename = uniqid("profile_", true) . "." . $ext;

        // $target_file1 = $target_dir_profile . $new_filename;
        // $target_profile = "uploads/profile_pic/" . $new_filename; 

        
         $target_profile = uploadImageWebP('pic_img', 'profile_pic');

        if ($target_profile) {

            if (!empty($old_pic) && file_exists("../" . $old_pic)) {
                unlink("../" . $old_pic);
            }

            $sql = "UPDATE model_user SET profile_pic = '".$target_profile."' WHERE id = '".$use_id."'";

            if (mysqli_query($con, $sql)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Profile updated successfully',
                    'path' => $target_profile
                ];
            } else {
                $response = ['status' => 'error', 'message' => 'DB update failed'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'File upload failed'];
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'remove_profile_pic') {
        
        $sql_old = "SELECT profile_pic FROM model_user WHERE id = '".$use_id."' LIMIT 1";
        $result_old = mysqli_query($con, $sql_old);
        $old_pic = null;

        if ($result_old && mysqli_num_rows($result_old) > 0) {
            $row_old = mysqli_fetch_assoc($result_old);
            $old_pic = $row_old['profile_pic'];
        }

        if (!empty($old_pic) && file_exists("../" . $old_pic)) {
            unlink("../" . $old_pic);
        }

        $sql = "UPDATE model_user SET profile_pic = NULL WHERE id = '".$use_id."'";
        if (mysqli_query($con, $sql)) {
            $response = [
                'status' => 'success',
                'message' => 'Profile picture removed successfully',
                'path' => ''
            ];
        } else {
            $response = ['status' => 'error', 'message' => 'DB update failed'];
        }
    }

echo json_encode($response);
