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