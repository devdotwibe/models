<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploaded_file'])) {
	
	$target_dir_profile = "../uploads/banners/"; 

			$totalFiles_v = count($_FILES['uploaded_file']['name']);
			$additional_vd = '';
	
				for ($i = 0; $i < $totalFiles_v; $i++) {

					$ext = pathinfo($_FILES["uploaded_file"]["name"][$i], PATHINFO_EXTENSION);

					$new_filename = uniqid("video_", true) . "." . $ext;

					$target_file1 = $target_dir_profile . $new_filename;
					$target_profile = $new_filename; 


					if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"][$i], $target_file1)) {
						
						$additional_vd .= $target_profile.'|';
					}

				}
				if(!empty($additional_vd)){ 
					//$joe_id = DB::update('banners', array('video' => rtrim($additional_vd, "|")), "id=%s", $id);
					echo rtrim($additional_vd, "|");
				}else echo "Error";    
} else {
    echo "No files were uploaded.";
}
?>