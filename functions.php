<?php
	// u910541639_thelivemodel
	$servername = "localhost";
	$username = "u842608707_thelivemodel";
	$password = "Model@2020";
	$db = "u842608707_thelivemodel";

	// Create connection
	$con = mysqli_connect($servername, $username, $password, $db);
	// Check connection
	if (!$con) {
	  die("Connection failed: " . mysqli_connect_error());
	}


?>