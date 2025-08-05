<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$output = array();
if (isset($_SESSION["log_user_id"])) {
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {
		
		$tip_amt = $_GET['tip_amt'];
		$tip_label = $_GET['tip_label'];
		$customtip = $_GET['customtip'];
		$tipmsg = $_GET['tipmsg'];
		$m_unique_id = $_GET['m_unique_id'];
		$model_id = $_GET['model_id'];
		//get model
			$modelDetails = get_data('model_user', array('id' => $model_id), true);
			if ($modelDetails) {
				if(empty($tip_amt) && empty($customtip)){
					$output['status'] = 'error';
					$output['message'] = 'Please enter tip amount';
				}else{
					if(!empty($customtip)){
						$actual_tip_amt = intval($customtip);
					}else{
						$actual_tip_amt = intval(str_replace('$', '', $tip_amt));
					}
					$actual_tip_token = $actual_tip_amt * 100;
					if ($userDetails['balance'] >= $actual_tip_token) {
							$date = date('Y-m-d H:i:s');
							
						//Save to notification list
						$notif_data = array();
						$user_id = $_SESSION['log_user_id'];
						$notif_data['sender_id'] = $user_id;
						$notif_data['receiver_id'] = $model_id;
						$notif_data['notification_type'] = 'tip';
						$notif_data['booking_id'] = '';
						$notif_data['message'] = $tipmsg;
						$notif_data['notification_date'] = date('Y-m-d H:i:s');
						$notif_data['notification_status'] = 'Pending';

						DB::insert('all_notifications', $notif_data);
						$created_id_notif = DB::insertId();	
						
						DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $actual_tip_token, $modelDetails['id']);
							DB::insert('model_user_transaction_history', array(
								'user_id' => $modelDetails['id'],
								'other_id' => $created_id_notif,
								'amount' => $actual_tip_token,
								'type' => 'user-tip',
								'created_at' => $date,
							));
							DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $actual_tip_token, $userDetails['id']);

							DB::insert('model_user_transaction_history', array(
								'user_id' => $userDetails['id'],
								'other_id' => $created_id_notif,
								'amount' => $actual_tip_token,
								'type' => 'tip',
								'created_at' => $date,
							));
							
						$email_to = 'shibuster@gmail.com';
         $subject = "Live Model - Tip send from ".ucfirst($userDetails['username']);

         $header = "From: Model Project <no-reply@model.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;height: 500px;">
            <img src="https://thelivemodels.com/assets/wp-content/themes/theagency3/images/default-bg.jpg" style="width: 100%;height: 100%;">
          </div>
          <div style="padding: 20px;">
          <h2>Dear '.ucfirst($modelDetails['username']).', </h2>
          <p>'.ucfirst($userDetails['username']).' sent you a tip of $'.$actual_tip_amt.' with the message: "'.$tipmsg.'"</p>
          </div>
          </body>
         </html>';
		 
		 //mail($email_to, $subject, $message, $header)

         /*if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }*/
		 
						$output['status'] = 'success';	
						$output['message'] = 'Tip send successfully';
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