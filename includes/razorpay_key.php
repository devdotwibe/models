<?php
define("rzp_key", 'rzp_test_DLzSJbdVG1aKSb');
define("rzp_secret", 'AeSSxu432skmWAOLk6cJWli3');

function rzp_curl_handle($payment_id, $amount)  {
//		$rozar_data = $this->comman_model->get_by('payment_setting',array('enabled'=>1,'id'=>1),false,true);
	$url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
	$key_id = rzp_key;
	$key_secret = rzp_secret;
	$fields_string = "amount=$amount";
	//cURL Request
	$ch = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	//curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
	$result = curl_exec($ch);
	curl_close($ch);
	$response_array = json_decode($result, true);
	return $response_array;
}   

