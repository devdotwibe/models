<?php  

if (isset($_POST['all_search1'])) {

	$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
	mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
	$sql = "SELECT sc_short_course.name, sc_user_payment.course_u_id, sc_user_payment.user_name, sc_user_payment.user_unique_id, sc_user_payment.trans_amount, sc_user_payment.trans_date FROM sc_user_payment INNER JOIN sc_short_course ON sc_user_payment.course_u_id=sc_short_course.unique_id";  
	$setRec = mysqli_query($conn, $sql);  

	$columnHeader = '';  
	$columnHeader = "Course Name" . "\t" . "Course id" . "\t" . "User Name" . "\t" . "User id" . "\t" . "Transaction amount" . "\t" . "Transaction Date" . "\t" ;  
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

}elseif (isset($_POST['date_search1'])) {
	
	 $from = $_POST['from1'];
	 $to = $_POST['to1'];

	$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
	mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
	  $sql = "SELECT sc_short_course.name, sc_user_payment.course_u_id, sc_user_payment.user_name, sc_user_payment.user_unique_id, sc_user_payment.trans_amount, sc_user_payment.trans_date FROM sc_user_payment INNER JOIN sc_short_course ON sc_user_payment.course_u_id=sc_short_course.unique_id WHERE sc_user_payment.trans_date BETWEEN '".$from."' AND '".$to."'";  

	$setRec = mysqli_query($conn, $sql);  

	$columnHeader = '';  
	$columnHeader = "Course Name" . "\t" . "Course id" . "\t" . "User Name" . "\t" . "User id" . "\t" . "Transaction amount" . "\t" . "Transaction Date" . "\t" ;  
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

}else if(isset($_POST['course_search1'])){

	// echo '<script>alert("'.$_POST['course'].'");</script>';
	$course_id = $_POST['course'];

	$conn = new mysqli('localhost', 'academia_acadeoo7_WPZYO', 'Z}UU>gT/Fxse_!/TW');  
	mysqli_select_db($conn, 'academia_acadeoo7_WPZYO');  
	 $sql = "SELECT sc_short_course.name, sc_user_payment.course_u_id, sc_user_payment.user_name, sc_user_payment.user_unique_id, sc_user_payment.trans_amount, sc_user_payment.trans_date FROM sc_user_payment INNER JOIN sc_short_course ON sc_user_payment.course_u_id=sc_short_course.unique_id WHERE sc_user_payment.course_u_id = '".$course_id."'";  


	$setRec = mysqli_query($conn, $sql);  

	$columnHeader = '';  
	$columnHeader = "Course Name" . "\t" . "Course id" . "\t" . "User Name" . "\t" . "User id" . "\t" . "Transaction amount" . "\t" . "Transaction Date" . "\t" ;  
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
}
?> 