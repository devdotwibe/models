<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploaded_file'])) {

    $target_dir_profile = "../uploads/banners/";

    $totalFiles_v = count($_FILES['uploaded_file']['name']);
    $additional_vd = '';

    for ($i = 0; $i < $totalFiles_v; $i++) {

        $ext = strtolower(pathinfo($_FILES["uploaded_file"]["name"][$i], PATHINFO_EXTENSION));

        $new_filename = uniqid("file_", true);

        $target_file1 = $target_dir_profile . $new_filename . "." . $ext;

        $final_filename = $new_filename . "." . $ext;

        $tmp_name = $_FILES["uploaded_file"]["tmp_name"][$i];

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
      
            $image = null;
            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($tmp_name);
                    break;
                case 'png':
                    $image = imagecreatefrompng($tmp_name);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($tmp_name);
                    break;
            }

            if ($image) {
                $final_filename = $new_filename . ".webp";
                $target_file1 = $target_dir_profile . $final_filename;

                if (imagewebp($image, $target_file1, 80)) {
                    imagedestroy($image);
                } else {
                    echo "Error converting to WebP";
                }
            }
        } else {
           
            if (move_uploaded_file($tmp_name, $target_file1)) {
                $final_filename = $new_filename . "." . $ext;
            } else {
                echo "Error uploading file";
            }
        }

        $additional_vd .= $final_filename . '|';
    }

    if (!empty($additional_vd)) {

        echo rtrim($additional_vd, "|");
    } else {
        echo "Error";
    }
} else {
    echo "No files were uploaded.";
}
?>
