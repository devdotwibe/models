<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploaded_file'])) {
	
			$totalFiles_v = count($_FILES['uploaded_file']['name']);
			$additional_vd = '';
			$target_dir_profile = "../uploads/banners/";
				for ($i = 0; $i < $totalFiles_v; $i++) {
					$target_file1 = $target_dir_profile . basename($_FILES["uploaded_file"]["name"][$i]);
					$target_profile = basename($_FILES["uploaded_file"]["name"][$i]);
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