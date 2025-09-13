
<?php
$servername = "localhost";
$username = "u842608707_live_user_25";
$password = "E5@W>e9qiex";
$db = "u842608707_live_models_25";
define("SITEURL", 'https://thelivemodels.com/');
define("ADMINURL", 'https://thelivemodels.com/super-admin/');

// Create connection
$con = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Turn off error reporting
error_reporting( 1 );

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

require_once 'db.class.php';
DB::$user = $username;
DB::$password = $password;
DB::$dbName = $db

?>