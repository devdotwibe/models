<?php
/**************************************************************************************
* Follow and Unfollow Application similar to Twitter using Ajax, Jquery and PHP
* This script has been released with the aim that it will be useful.
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
***************************************************************************************/
session_start();
ob_start();

//Include the database connection file
include "config.php";

//Check to see if the submit button has been clicked to process data
if(isset($_POST["submitted"]) && $_POST["submitted"] == "yes")
{
	//Variables Assignment
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$user_email = $_POST['email'];
	$user_password = $_POST['passwd'];
	$encrypted_md5_password = $user_password;
	

	$check_for_duplicates = mysqli_query($connection, "select * from `follow_and_unfollow_users_table` where `email` = '".$user_email."'");
	
	//Validate against empty fields
	if($firstname == "" || $lastname == "" || $user_email == "" || $user_password == "")
	{
		$error = '<br><div class="info">Sorry, all fields are required to create a new account. Thanks.</div><br>';
	}
	elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $user_email))
	{
		$error = '<br><div class="info">Sorry, Your email address is invalid, please enter a valid email address to proceed. Thanks.</div><br>';
	}
	else if(mysqli_num_rows($check_for_duplicates) > 0) //Email address is unique within this system and must not be more than one
	{
		$error = '<br><div class="info">Sorry, your email address already exist in our database and duplicate email addresses are not allowed for security reasons.<br>Please enter a different email address to proceed or login with your existing account. Thanks.</div><br>';
	}
	else
	{
		if(mysqli_query($connection, "insert into `follow_and_unfollow_users_table` values('', '".$firstname."', '".$lastname."', '".$user_email."', '".$encrypted_md5_password."', '".date('d-m-Y')."')"))
		{
			$_SESSION["VALID_USER_ID"] = $user_email;
			$_SESSION["USER_FULLNAME"] = strip_tags($firstname.'&nbsp;'.$lastname);
			header("location: index.php?page_owner=".base64_encode($user_email));
		}
		else
		{
			$error = '<br><div class="info">Sorry, your account could not be created at the moment. Please try again or contact the site admin to report this error if the problem persist. Thanks.</div><br>';
		}
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>vasPLUS Programming Blog - Follow and Unfollow Application similar to Twitter using Ajax, Jquery and PHP</title>




<!-- Required header file -->
<link href="css/style.css" rel="stylesheet" type="text/css">





</head>
<body>
<center>
<br>
<div style="font-family:Verdana, Geneva, sans-serif; font-size:24px;">Follow and Unfollow Application similar to Twitter using Ajax, Jquery and PHP</div><br clear="all" /><br clear="all" /><br clear="all" />





<!-- Code Begins -->
<center>
<div class="vpb_main_wrapper">

<br clear="all">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<h2 align="left" style="margin-top:0px;">Users Registration</h2><br />

<div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; margin-bottom:10px;">Please complete the form provided below to demonstrate this system.</div><br />

<div style="width:115px; padding-top:10px;float:left;" align="left">Your Firstname:</div>
<div style="width:300px;float:left;" align="left"><input type="text" name="firstname" id="firstname" value="<?php echo strip_tags($_POST["firstname"]); ?>" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Your Lastname:</div>
<div style="width:300px;float:left;" align="left"><input type="text" name="lastname" id="lastname" value="<?php echo strip_tags($_POST["lastname"]); ?>" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Email Address:</div>
<div style="width:300px;float:left;" align="left"><input type="text" name="email" id="email" value="<?php echo strip_tags($_POST["email"]); ?>" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Desired Password:</div>
<div style="width:300px;float:left;" align="left"><input type="password" name="passwd" id="passwd" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left">
<input type="hidden" name="submitted" id="submitted" value="yes">
<input type="submit" name="submit" id="" value="Submit" style="margin-right:50px;" class="vpb_general_button">
<a href="login.php" style="text-decoration:none;" class="vpb_general_button">Back to Login</a>

</div>

</form>
<br clear="all"><br clear="all">
<div style="width:450px;float:left;" align="left"><?php echo $error; ?></div><br clear="all">

</div>
</center>
<!-- Code Ends -->














</center>
</body>
</html>