<?php
// delete_file.php

// Read the raw POST data (the body of the request)
$data = json_decode(file_get_contents("php://input"), true);

// Get the file name from the request
$fileName = $data['fileName'];

// Define the path to your upload directory
// $uploadDir = "uploads/profile_pic/";  // Adjust the path as needed

// Build the full file path
$filePath = $fileName;

// Check if the file exists and delete it
if (file_exists($filePath)) {
    if (unlink($filePath)) {
        // Return a success response
        echo json_encode(['status' => 'success']);
    } else {
        // Return a failure response
        echo json_encode(['status' => 'error', 'message' => 'Unable to delete the file']);
    }
} else {
    // Return a failure response if the file doesn't exist
    echo json_encode(['status' => 'error', 'message' => 'File not found']);
}
?>