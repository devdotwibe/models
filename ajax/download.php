<?php 
	include('includes/config.php');
	include('includes/helper.php');
	
$get_file = isset($_GET['file']) ? $_GET['file'] : '';
$get_id = isset($_GET['id']) ? $_GET['id'] : '';

if(!empty($get_file) && !empty($get_id)){
	
	if (file_exists($get_file)) {
		
		$sql = "UPDATE user_purchased_image SET purchase_date = purchase_date + 1  WHERE id = ".$get_id;
		mysqli_query($con, $sql);
		
		// Send headers
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . basename($get_file) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($get_file));
		flush();
		readfile($get_file);
		exit;
	} else {
		http_response_code(404);
		echo "File not found.";
	}
	
	
}

?>