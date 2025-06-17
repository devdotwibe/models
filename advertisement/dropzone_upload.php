<?php  echo 'test'; exit;
$name = $_FILES['img']['name'];
$tmp_file = $_FILES['img']['tmp_name'];
$target_dir_profile = "../uploads/banners/";
$filesCount = count($_FILES[$img]['name']);
for($i = 0; $i < $filesCount; $i++) { 
   move_uploaded_file($tmp_file[$i], $target_dir_profile.$name[$i]);
   $upload_image[] = $name[$i];
}
$response_data=array('images'=>$upload_image);
echo json_encode($response_data);  

?>