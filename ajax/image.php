<?php 




$get_image = isset($_GET['image'])?$_GET['image']:'';
$test= isset($_GET['test'])?true:false;

$default_img = "";

$local_image_path = $get_image;


$default_image_url = 'https://models.staging3.dotwibe.com/assets/images/model-gal-no-img.jpg';


if (!empty($get_image) && file_exists($local_image_path)) {

    $imagetobewatermark = $local_image_path;

    $get_image = $local_image_path;

} else {

    $imagetobewatermark = $default_image_url;

   $get_image = $default_image_url;
  
  	header("Location: $default_image_url");
    exit;
}

if($get_image){


$imagetobewatermark= '../'.$get_image;
$fontsize =20;
//$imagetobewatermark="bikini-885382_1280.jpg";
$TEXT = 'The Models';

$dir= dirname(realpath(__FILE__));
$sep=DIRECTORY_SEPARATOR;   
$font_file =$dir.$sep.'monofont.ttf';
$custom_text = $TEXT;

if($test==false){
	header('Content-type: image/jpeg');
}
$image = imagecreatefromjpeg($imagetobewatermark);

$widthS = imagesx($image);
$heightS = imagesy($image);

$textcolor = imagecolorallocate($image, 128, 128, 128);
//$textcolor = imagecolorallocate($image, 20, 20, 20);
//imagefill($textcolor,0,0,0x7fff0000);
//$textcolor = imagecolorallocate($image, 205, 205, 205);

$sizeT = imagettfbbox($fontsize, 0, $font_file, $TEXT);
$widthT = max([$sizeT[2], $sizeT[4]]) - min([$sizeT[0], $sizeT[6]]);
$heightT = max([$sizeT[5], $sizeT[7]]) - min([$sizeT[1], $sizeT[3]]);

// (C3) CENTER POSITION
$posX = CEIL(($widthS - $widthT) / 2);
$posY = CEIL(($heightS - $heightT) / 2);
if($test){
	echo "$widthS - $widthT";
	echo "<br>$heightS - $heightT";
	echo "<br>$posX - $posY";
}

//if ($posX < 0 || $posY < 0) { exit("Text is too long"); } // OPTIONAL ERROR HANDLE
//imagettftext($image, 20, 0, $posX, $posY, $textcolor, $font_file, $custom_text);// for center

imagettftext($image, 20, 0, $posX, $posY+130, $textcolor, $font_file, $custom_text);// for center
//imagettftext($image, 20, 0, $widthS-120, $heightS-10, $textcolor, $font_file, $custom_text);
imagejpeg($image);
imagedestroy($image); //
}
?>

