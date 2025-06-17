<?php  

if (isset($_POST['all_search1'])) {

	$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
	mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
	$sql = "SELECT * FROM sc_school_register ORDER BY id DESC";  
	$setRec = mysqli_query($conn, $sql);  
	$columnHeader = '';  
	$columnHeader = "Id" . "\t" . "School name" . "\t" . "School Type" . "\t" . "Grades" . "\t" . "Course" . "\t" . "Subjects" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Address" . "\t" . "Login Id" . "\t" . "Password" . "\t" . "Image Path" . "\t" . "Registration Date" . "\t" ;  
	$setData = '';  
	while ($rec = mysqli_fetch_row($setRec)) {  
	    $rowData = '';  
	    foreach ($rec as $value) {  
	        $value = '"' . $value . '"' . "\t";  
	        $rowData .= $value;  
	    }  
	    $setData .= trim($rowData) . "\n";  
	}  
	header("Content-type: application/octet-stream");  
	header("Content-Disposition: attachment; filename=User_Detail.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");  
	echo ucwords($columnHeader) . "\n" . $setData . "\n";

	// echo '<script>window.location="school-university.php"</script>';

}elseif (isset($_POST['date_search1'])) {

	$from = $_POST['from1'];
	$to = $_POST['to1'];

	$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
	mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
	 $sql = "SELECT * FROM sc_school_register WHERE register_date BETWEEN '".$from."' AND '".$to."'";  


	$setRec = mysqli_query($conn, $sql);  
	$columnHeader = '';  
	$columnHeader = "Id" . "\t" . "School name" . "\t" . "School Type" . "\t" . "Grades" . "\t" . "Course" . "\t" . "Subjects" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Address" . "\t" . "Login Id" . "\t" . "Password" . "\t" . "Image Path" . "\t" . "Registration Date" . "\t" ;  
	$setData = '';  
	while ($rec = mysqli_fetch_row($setRec)) {  
	    $rowData = '';  
	    foreach ($rec as $value) {  
	        $value = '"' . $value . '"' . "\t";  
	        $rowData .= $value;  
	    }  
	    $setData .= trim($rowData) . "\n";  
	}  
	header("Content-type: application/octet-stream");  
	header("Content-Disposition: attachment; filename=User_Detail.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");  
	echo ucwords($columnHeader) . "\n" . $setData . "\n";

	// echo '<script>window.location="school-university.php"</script>';
}
  

?> 