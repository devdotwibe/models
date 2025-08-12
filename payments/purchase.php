<?php



require_once __DIR__ . '/../vendor/autoload.php';

 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
  $dotenv->load();

$stripeSecret = $_ENV['STRIPE_SECRET_KEY']; 


	session_start();
	include('../includes/config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Razorpay Payment Gateway Integration Example</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<?php 
require_once('stripe-php/init.php');
$stripe = new \Stripe\StripeClient($stripeSecret);
?>
<style>
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
  }
  .card-product .img-wrap img {
    max-height: 100%;
    max-width: 100%;
    object-fit: cover;
  }
  .card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #eee;
  }
  .card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #eee;
  }

  .label-rating { margin-right:10px;
    color: #333;
    display: inline-block;
    vertical-align: middle;
  }

  .card-product .price-old {
    color: #999;
  }
  .head_pay{
  	text-align: center;
  	color: #030000;
  	padding-top: 20px;
  	padding-bottom: 20px;
  }
</style>
<body>
<div class="container">
<?php 
	if(isset($_POST['submit10'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit100'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit500'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit1000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit2500'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	} 
?>
	<div>
		<h3 class="head_pay">Payment Confirmation Page</h3>
	</div>
<form action="payment-process.php" method="POST" name="purchaseform" id="purchaseform">
    <p class="">User Details: </p>
    <hr>
	  <div class="form-group">
	    <label for="email">Username:</label>
	    <input type="username" class="form-control" id="username" value="<?php echo $_SESSION["log_user"]; ?>" >
	  </div>
	  <div class="form-group">
	    <label for="pwd">Email:</label>
	    <input type="email" class="form-control" id="email" value="<?php echo $_SESSION["log_user_email"]; ?>" >
	  </div>
	  <p>Payment Details: </p>
	  <hr>
	  <input type="hidden" class="form-control" id="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>"  >
	  <div class="form-group">
	    <label for="email">Pay Amount:</label>
	    <input type="text" class="form-control" id="amount" value="<?php echo $amount; ?>" readonly >
	  </div>
	  <div class="form-group">
	    <label for="pwd">Coins:</label>
	    <input type="text" class="form-control" id="coins" value="<?php echo $coins; ?>" readonly>
	  </div>
	  <?php $total_amt = $amount*100; ?>
	 	
		<div class="form-group">
											
											<span class="error errormsg cardnumber_req"></span>
											<div class="card-number-div">
											<div id="card-element"></div>
											<div id="card-element-expyear"></div>
											<div id="card-element-cvv"></div>
											
											
											</div>
											<span class="error errormsg cardnumber_error"></span>
											
											<div class='form-group  show_err_msg_div' ></div>
										</div>
		<div class="form-group">
		
		<button type="button" class="btn btnAction paymentsub_btn" id="btn-payment" >
												<span id="button-text">Submit</span>
												<div class="spinner-border" role="status" style="display:none;">
												  <span class="visually-hidden">Loading...</span>
												</div>
											</button>
											<p id="card-error" role="alert"></p>
											
											<input type="hidden" name="payment_status" value="" class="payment_status" >
											<input type="hidden" name="payment_id" value="" class="payment_id" >
		</div>
	  <?php
	  	session_start();
	  	$_SESSION["pay_amount"] = $amount;
	  	$_SESSION["pay_coins"] = $coins;
	  ?>
	</form>
</div> 
<!--container.//-->

<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script>
var stripeKey = 'pk_test_51NpPnnEu2dN0F4bnRBhXoWW2XfitXbcyR1Oj4oUrobYdpYYQV1IMQBY3UJTjAwTqosizH3A0tQ5S28voaHGfCH3H002ACBgegA';  
var stripe = Stripe(stripeKey);

var elements = stripe.elements();
var cardNumberElement = elements.create('cardNumber',{
	showIcon: true,
	disableLink: true,
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});

cardNumberElement.mount('#card-element');
var cardExpiryElement = elements.create('cardExpiry',{
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});
cardExpiryElement.mount('#card-element-expyear');

var cardCvcElement = elements.create('cardCvc',{
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});
cardCvcElement.mount('#card-element-cvv');

 cardNumberElement.on('change', function(event) { 
	  if (event.error) {
		jQuery('.cardnumber_error').html(event.error.message);
	  }else jQuery('.cardnumber_error').html(''); 
	});
	
	//Button submission
	jQuery('.paymentsub_btn').bind('click', async function(e) { 
      e.preventDefault();
      jQuery('.show_err_msg_div').html(''); var stats = true;
	  jQuery(".spinner-border").show();
	  
	  var amount = jQuery('#amount').val();
	  
	  var cardElementContainer = document.querySelector('#card-element');

	 var cardElementEmpty = cardElementContainer.classList.contains('StripeElement--empty'); 
	 
	 if(cardElementEmpty == true){
		 jQuery(".cardnumber_req").html('Required.'); stats = false; jQuery(".spinner-border").hide();
	 }else jQuery(".cardnumber_req").html('');
	 
	 var cardElementInvalid = cardElementContainer.classList.contains('StripeElement--invalid');
	 if(cardElementInvalid == true){
	   jQuery('.cardnumber_error').html('Your card number is invalid.'); stats = false; jQuery(".spinner-border").hide();
	   }else jQuery('.cardnumber_error').html('');
	   
	   
	   var cardElementexpContainer = document.querySelector('#card-element-expyear');
	   var cardElementexpEmpty = cardElementexpContainer.classList.contains('StripeElement--empty'); 
	   if(cardElementexpEmpty == true){
			 jQuery(".cardnumber_req").html('Required.'); stats = false; jQuery(".spinner-border").hide();
		 }else jQuery(".cardnumber_req").html('');
	   var cardElementexpInvalid = cardElementexpContainer.classList.contains('StripeElement--invalid');
	   if(cardElementexpInvalid == true){
	   jQuery('.cardnumber_error').html('Your card expairy is invalid.'); stats = false; jQuery(".spinner-border").hide();
	   }else jQuery('.cardnumber_error').html('');
	   
	   var cardElementcvvContainer = document.querySelector('#card-element-cvv');
	   var cardElementcvvEmpty = cardElementcvvContainer.classList.contains('StripeElement--empty'); 
	   if(cardElementcvvEmpty == true){
			 jQuery(".cardnumber_req").html('CVC Required.'); stats = false; jQuery(".spinner-border").hide();
		 }else jQuery(".cardnumber_req").html('');
	  
	  if(stats){
		 try {
		  // Use fetch instead of jQuery.ajax so you can use await
		  const res = await fetch("<?=SITEURL.'payments/get_clientsecret.php'?>?grand_unit_price="=<?php echo $amount ?>"&coins="<?php echo $coins ?>);
		  const response = await res.json();

		  if (response.status === 'success' && response.message !== '') {
			const { error, paymentIntent } = await stripe.confirmCardPayment(response.message, {
			  payment_method: {
				card: cardNumberElement,
				billing_details: {
				  name: jQuery('#username').val(),
				}
			  }
			});

			jQuery(".spinner-border").hide();

			if (error) {
			  jQuery('.show_err_msg_div').html('<div class="alert-danger alert show_err_msg">Payment failed: ' + error.message + '</div>');
			  jQuery('.payment_status').val('Payment failed: ' + error.message);
			} else if (paymentIntent.status === 'succeeded') {
			  jQuery('.show_err_msg_div').html('<div class="alert-succ alert show_err_msg">Payment succeeded</div>');
			  jQuery('.payment_status').val('Payment succeeded: ' + paymentIntent.id);
			  jQuery('.payment_id').val(paymentIntent.id);
			//   jQuery('#purchaseform').submit();
			}
		  } else {
			alert(response.message);
			showNotification(response.message, 'error');
		  }

    } catch (err) {
			//console.error('Error:', err);
			jQuery(".spinner-border").hide();
			jQuery('.show_err_msg_div').html('<div class="alert-danger alert show_err_msg">Please enter valid card details.</div>');
		  }
	  }
    });
	
	
	// Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
		
</script>
</body>
</html>