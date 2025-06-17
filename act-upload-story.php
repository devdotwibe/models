<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
if ($userDetails) {
} else {
    echo '<script>window.location.href="login.php"</script>';
    die;
}
if ($_FILES['image_1']['name']) {
    $image = $_FILES["image_1"]["name"];
    $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if (in_array($ext, $allowed)) {
        $temp = explode(".", $_FILES["image_1"]["name"]);
        $newfilename = 'model-'.$userDetails['id'].'-'.round(microtime(true)) . '.' . end($temp);

        $target_dir = "uploads/story/";
        $target_file = $target_dir . $newfilename;


        if (move_uploaded_file($_FILES["image_1"]["tmp_name"], $target_file)) {
            $date =date('Y-m-d H:i:s');
            //echo '<script>alert("File Successfully Uploaded.")</script>';
            $post_data = array(
                'user_id'  => $userDetails['id'],
                'files'       => $newfilename,
                'message'       => $_POST['message'],
                'created_date'       => $date,
                
              );
          //printR($post_data);die;
              DB::insert('model_user_story', $post_data);
              $bookingID = DB::insertId();
          
            echo '<script>alert("Story successfully uploaded.");</script>';
            echo '<script>window.history.back();</script>';
            die;
        }
        else{
            echo '<script>alert("There is some problem.");script>';
            echo '<script>window.history.back();</script>';
            die;
        }
    }
    else{
        echo '<script>alert("PLease upload image only.");</script>';
        echo '<script>window.history.back();</script>';
        die;
    }
}
