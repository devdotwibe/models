<?php 

$get_image = isset($_GET['image']) ? $_GET['image'] : '';
$test = isset($_GET['test']) ? true : false;

$default_image_url = 'https://models.staging3.dotwibe.com/assets/images/model-gal-no-img.jpg';

// Build local file path for checking existence
$local_image_path = __DIR__ . '/' . ltrim($get_image, '/');

if (!empty($get_image) && file_exists($local_image_path)) {

    $redirect_url = 'https://models.staging3.dotwibe.com/' . ltrim($get_image, '/');
    header("Location: $redirect_url");
    exit;

} else {
    header("Location: $default_image_url");
    exit;
}
?>
