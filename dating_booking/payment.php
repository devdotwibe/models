<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
include('../includes/razorpay_key.php');

if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		header("Location: ../login.php");
	}
}
$id = $_GET['id'];
if(!$id){
	if(!$userDetails){
		header("Location: ".SITEURL."dating_booking");
	}
}

$booking_data = DB::queryFirstRow("SELECT * FROM booking_dating_assignments WHERE `status`='accept' and user_unique_id = %s and id = %s ", $_SESSION['log_user_unique_id'], $id);
//echo DB::lastQuery();
//printR($booking_data);die;
if(!$booking_data){
	header("Location: ".SITEURL."dating_booking");
}
if($_POST){
	$razorpay_payment_id = $_POST['razorpay_payment_id'];
	
	$result = rzp_curl_handle($razorpay_payment_id, ($booking_data['amount']*100));
	if (isset($result['error']) === false) {
		$date = date('Y-m-d H:i:s');
		$post_data = array(
				'token'			 => $result['id'],
				'payment_data'	  => json_encode($result),
			
				'paid_date'		=> $date,
				'is_paid'		=> 1,
				
		);
		DB::update('booking_dating_assignments', $post_data, "id=%s", $id);
		/*echo '<script>alert("Your Payment .")</script>';*/
		echo '<script>window.location="'.SITEURL.'dating_booking/"</script>';
		die;
	}
	else{
		echo '<script>alert("There is some problem.")</script>';
		echo '<script>window.location="'.SITEURL.'dating_booking/payment.php?id='.$id.'"</script>';
		die;
	}
				
	die;
}
?>
<!doctype html>
<html lang="en-US" class="no-js">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
<?php include('../includes/head.php');?>
</head>
  <body class="page-template-default page page-id-311 custom-background">
    <?php include('../includes/header.php'); ?>
    <div class="container-fluid">
      <div id="content" class="clearfix row">
        <div id="main" class="col-md-12 clearfix" role="main">
          <article id="post-311" class="clearfix post-311 page type-page status-publish hentry" >
            <header class="page-head article-header">
              <div class="headline-outer">
                <h1 itemprop="headline" class="page-title entry-title">
                  <div class="prefancy fancy">
                    <span>Payment</span>
                  </div>
                </h1>
              </div>
            </header>
            <!-- end article header -->
            <section class="page-content entry-content clearfix" itemprop="articleBody">
              <div class="artivle-body-bg">
              

                <div class="container-fluid" >
                 <div class="row" style="margin-left:0px;margin-right:0px;"> 
                  
<div class="col-sm-12  d-flex justify-content-center">
<div class="card " style="width:40%">
	<div class="card-body">
<form method="post" ><!--form-inline-->
	  <div class="form-group">
	    <label for="email">Pay Amount:</label>
	    <input type="text" class="form-control" id="amount" value="<?php echo $booking_data['amount']; ?>" readonly >
	  </div>
	 	<script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?=rzp_key?>"
        data-amount="<?php echo ($booking_data['amount']*100); ?>"
        data-buttontext="Pay with Razorpay"
        data-name="Themodel"
        data-description="Payment with RazorPay"
        data-image="<?=SITEURL.'uploads/live-model-logo.png'?>"
        data-prefill.name="<?=$userDetails['username']?>"
        data-prefill.email="<?=$userDetails['email']?>"
        data-theme.color="#F37254"
    ></script>
	</form>
	</div>
</div>
                    
                 </div><!--col-md-12-->
                 
                </div>
              </div>

                
              </div>
            </section>
          </article>
        </div>
      </div>
    </div>
    <?php include('../includes/footer.php'); ?>
  </body>
</html>