<?php 


require_once __DIR__ . '/../vendor/autoload.php';

 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
  $dotenv->load();

$stripeSecret = $_ENV['STRIPE_SECRET_KEY']; 

session_start();

include('../includes/config.php');
include('../includes/helper.php');
$output = array();
if (isset($_SESSION["log_user_id"])) {
	$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
	if ($userDetails) {
		$grand_unit_price = $_GET['grand_unit_price'];

		$coins = $_GET['coins'];

		if(!empty($grand_unit_price) && !empty($coins)){
		require_once('stripe-php/init.php');
		$stripe = new \Stripe\StripeClient($stripeSecret);
			try {
				$paymentIntent = $stripe->paymentIntents->create([
					'amount' => $grand_unit_price * 100, 
					'currency' => 'usd', 
				   'automatic_payment_methods' => ['enabled' => true],
				]);
				//echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
				$output['status'] = 'success';	
				$output['message'] = $paymentIntent->client_secret;

			} catch (\Stripe\Exception\ApiErrorException $e) {
				$error = [
					'error' => $e->getMessage(),
					'param' => $e->getParam(),
					'code' => $e->getError()->code,
				];
				//echo json_encode($error);
				$output['status'] = 'error';
				$output['message'] = $e->getMessage();
			}
		} else {
			$output['status'] = 'error';
			$output['message'] = 'Amount is required';
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