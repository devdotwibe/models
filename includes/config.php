<?php
// u910541639_thelivemodel
$servername = "localhost";

$username = "models_user";
$password = "mRin7oxaGJdn";
$db = "models_data";

define("SITEURL", 'https://models.staging3.dotwibe.com/');

//testing 
//define("SITEURL", 'http://localhost/thelivemodal/demo/');
/*$username = "root";
$password = "";
$db = "thelivemodal";*/

// Create connection
$con = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Turn off error reporting
error_reporting(0);

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

$datenow=date("Y-m-d");
$timenow=date("h:i A");

require_once 'db.class.php';
DB::$user = $username;
DB::$password = $password;
DB::$dbName = $db
?>