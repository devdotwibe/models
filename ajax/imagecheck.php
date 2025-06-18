<?php 

    $get_image = isset($_GET['image']) ? $_GET['image'] : '';

    $image_exist = false;

    $local_image_path = __DIR__ . '/' . ltrim($get_image, '/');

    if (!empty($get_image) && file_exists($local_image_path)) {

        $image_exist = true;

    } 

    return $image_exist;
?>
