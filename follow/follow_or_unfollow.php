<?php
/**************************************************************************************
* Follow and Unfollow Application similar to Twitter using Ajax, Jquery and PHP
* This script has been released with the aim that it will be useful.
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
***************************************************************************************/


include "config.php"; //Include the database connection settings file

if(isset($_POST["page_owner"]) && isset($_POST["follower"]) && !empty($_POST["page_owner"]) && !empty($_POST["follower"]))
{
	$page_owner = trim(strip_tags($_POST["page_owner"]));
	$follower = trim(strip_tags($_POST["follower"]));

	$check_if_following_or_not = mysqli_query("select * from `follow_and_unfollow_activity` where `page_owners_emails` = '".mysqli_real_escape_string($page_owner)."' and `followers_emails` = '".mysqli_real_escape_string($follower)."'");
	
	
	if(mysqli_num_rows($check_if_following_or_not) > 0)
	{
		@mysqli_query("delete from `follow_and_unfollow_activity`  where `page_owners_emails` = '".mysqli_real_escape_string($page_owner)."' and `followers_emails` = '".mysqli_real_escape_string($follower)."'");
	}	
	else
	{
		@mysqli_query("insert into `follow_and_unfollow_activity` values('', '".mysqli_real_escape_string($page_owner)."', '".mysqli_real_escape_string($follower)."', '".mysqli_real_escape_string(date('d-m-Y'))."')");
	}			
}
?>