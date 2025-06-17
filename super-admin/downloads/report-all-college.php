<?php  

	if (isset($_POST['all_search'])) {

		$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
		mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
		$sql = "SELECT * FROM sc_university_register ORDER BY id DESC";  
		$setRec = mysqli_query($conn, $sql);  
		$columnHeader = '';  
		$columnHeader = "Id" . "\t" . "University name" . "\t" . "Degrees" . "\t" . "Courses" . "\t" . "Years" . "\t" . "Semesters" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Address" . "\t" . "Login Id" . "\t" . "Password" . "\t" . "Image Path" . "\t" . "Registration Date" . "\t" ;  
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

	}else if (isset($_POST['date_search'])) {

		 $from = $_POST['from'];
		 $to = $_POST['to'];

		$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
		mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
		 $sql = "SELECT * FROM sc_university_register WHERE register_date BETWEEN '".$from."' AND '".$to."'";  
	
		$setRec = mysqli_query($conn, $sql);  
		$columnHeader = '';  
		$columnHeader = "Id" . "\t" . "University name" . "\t" . "Degrees" . "\t" . "Courses" . "\t" . "Years" . "\t" . "Semesters" . "\t" . "Email" . "\t" . "Phone" . "\t" . "Address" . "\t" . "Login Id" . "\t" . "Password" . "\t" . "Image Path" . "\t" . "Registration Date" . "\t" ;  
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