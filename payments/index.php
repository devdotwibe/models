<?php
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
	}else if(isset($_POST['submit900'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit1000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit1500'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit2500'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit3000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit4000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit5000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit10000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit15000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit20000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit25000'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f0'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f5'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f9'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f14'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f19'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f29'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f39'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f49'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f99'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f149'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f199'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	}else if(isset($_POST['submit_f249'])){
		$amount = $_POST['amount'];
		$coins = $_POST['coins'];
	} 
?>
	<div>
		<h3 class="head_pay">Payment Confirmation Page</h3>
	</div>
<form action="payment-process.php" method="POST">
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
	 	<script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_4M7P3ViBucYNrF"
        data-amount="<?php echo $total_amt; ?>"
        data-buttontext="Pay with Razorpay"
        data-name="The Live Model"
        data-description="Test Txn with RazorPay"
        data-image="https://thelivemodels.com/uploads/live-model-logo.png"
        data-prefill.name="<?php echo $_SESSION["log_user"]; ?>"
        data-prefill.email="<?php echo $_SESSION["log_user_email"]; ?>"
        data-theme.color="#F37254"
    ></script>
	  <!-- <button type="submit" class="btn btn-success buy_now btn-block" data-amount="<?php //echo $amount; ?>" data-id="<?php //echo $coins; ?>">Pay Now</button> -->
	  <input type="hidden" value="Hidden Element" name="hidden">
	  <?php
	  	session_start();
	  	$_SESSION["pay_amount"] = $amount;
	  	$_SESSION["pay_coins"] = $coins;
	  ?>
	</form>
</div> 
<!--container.//-->


</body>
</html>