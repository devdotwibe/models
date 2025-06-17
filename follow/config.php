
<?php
$servername = "localhost";
$username = "newmodels";
$password = "root123";
$db = "newmodels";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
?>