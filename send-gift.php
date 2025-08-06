<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$output = array();
if (isset($_SESSION["log_user_id"])) {
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {
		
		$gift_amt = $_GET['gift_amt'];
		$gift_label = $_GET['gift_label'];
		$giftmsg = $_GET['giftmsg'];
		$m_unique_id = $_GET['m_unique_id'];
		$model_id = $_GET['model_id'];
		//get model
			$modelDetails = get_data('model_user', array('id' => $model_id), true);
			if ($modelDetails) {
				if(empty($gift_amt)){
					$output['status'] = 'error';
					$output['message'] = 'Please choose any gift option.';
				}else{
					$actual_gift_amt = intval(str_replace('$', '', $gift_amt));
					$actual_gift_token = $actual_gift_amt * 100;
					if ($userDetails['balance'] >= $actual_gift_token) {
							$date = date('Y-m-d H:i:s');
							
						//Save to notification list
						$notif_data = array();
						$user_id = $_SESSION['log_user_id'];
						$notif_data['sender_id'] = $user_id;
						$notif_data['receiver_id'] = $model_id;
						$notif_data['notification_type'] = 'gift';
						//$notif_data['booking_id'] = '';
						$notif_data['message'] = $giftmsg;
						$notif_data['notification_date'] = date('Y-m-d H:i:s');
						$notif_data['notification_status'] = 'Pending';

						DB::insert('all_notifications', $notif_data);
						$created_id_notif = DB::insertId();	
						
						DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $actual_gift_token, $modelDetails['id']);
							DB::insert('model_user_transaction_history', array(
								'user_id' => $modelDetails['id'],
								'other_id' => $created_id_notif,
								'amount' => $actual_gift_token,
								'type' => 'user-gift',
								'created_at' => $date,
							));
							DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $actual_gift_token, $userDetails['id']);

							DB::insert('model_user_transaction_history', array(
								'user_id' => $userDetails['id'],
								'other_id' => $created_id_notif,
								'amount' => $actual_gift_token,
								'type' => 'gift',
								'created_at' => $date,
							));
							
		 //$email_to = $modelDetails['email'];
		 $email_to = 'shibuster@gmail.com';
         $subject = "Live Model - Gift send from ".ucfirst($userDetails['username']);

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
          <h2>Dear '.ucfirst($modelDetails['username']).', </h2>
          <p>'.ucfirst($userDetails['username']).' sent you a gift of $'.$actual_gift_amt.' with the message: "'.$giftmsg.'"</p>
          </div>
          </body>
         </html>';
		 
		// mail($email_to, $subject, $message, $header);

         
		 
						$output['status'] = 'success';	
						$output['message'] = 'Gift send successfully';
					}else {
						$output['status'] = 'error';
						$output['message'] = 'You dont have sufficiant coins in your wallet for buying it.';
					}
					
				}
			}else{
				$output['status'] = 'error';
				$output['message'] = 'There is no model!!';
			}
	} else {
		$output['status'] = 'error';
		$output['message'] = 'Please login';
	}
}else {
	$output['status'] = 'error';
	$output['message'] = 'Please login';
}

echo json_encode($output);
?>