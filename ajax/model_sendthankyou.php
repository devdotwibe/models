<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
$output = array();
$notif_id = $_GET['notif_id'];
$type = $_GET['type'];
$username = $_GET['username'];
$sender_email = $_GET['sender_email'];
if(isset($_SESSION['log_user_id']) && isset($notif_id) && !empty($notif_id)) {
$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
$post_data = array();
$post_data['send_thanks_date'] = date('Y-m-d H:i:s');
$post_data['notification_status'] = 'Completed';

DB::update('all_notifications', $post_data, "notification_id=%s", $notif_id);

//Email Settings
//$email_to = $sender_email;
$email_to = 'shibuster@gmail.com';
         $subject = "Live Model - Send Thankyou from ".ucfirst($userDetails['username']);

         $header = "From: Model Project <no-reply@model.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;height: 500px;">
            <img src="'.SITEURL.'assets/wp-content/themes/theagency3/images/default-bg.jpg" style="width: 100%;height: 100%;">
          </div>
          <div style="padding: 20px;">
          <h2>Dear '.ucfirst($username).', </h2>
          <p>'.ucfirst($userDetails['username']).' sent Thanks of your '.$type.'</p>
          </div>
          </body>
         </html>';
		 
		 //mail($email_to, $subject, $message, $header);


$output['status']= 'success';	
}else{
	if(!isset($_SESSION['log_user_id'])){
		$output['status']= 'You are not logged.';
	}else{
		$output['status']= 'Invalid modal ID';
	}

}
echo json_encode($output);
?>
