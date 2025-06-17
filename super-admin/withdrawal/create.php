<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');
$table_name = "users_withdrow_request";
$m_link= SITEURL.'user/withdrawal/';
$per_amount = 50;
if(isset($_SESSION['log_user_id'])){
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
		die;
	}
	$checkbankdetail = get_data('users_bankdetail',array('user_id'=>$userDetails["id"]),true);
	if(!$checkbankdetail){
		echo '<script>window.location.href="'.SITEURL.'user/bankdetails/create.php"</script>';
		die;
	}

	$check_request = get_data($table_name,array('user_id'=>$userDetails["id"],'status'=>'0'),true);
	if($check_request){
		echo '<script>alert("You already sent request. Please wait for pending request")</script>';
		echo '<script>window.location.href="'.$m_link.'"</script>';
		die;
	}
	//create post data
	if($_POST){
		$arr = array('coins');
		$post_data = array_from_post($arr);
		$post_data['amount'] = round($post_data['coins']/$per_amount,2);
		$post_data['account_name'] = $checkbankdetail['account_name'];
		$post_data['account_number'] = $checkbankdetail['account_number'];
		$post_data['bank_name'] = $checkbankdetail['bank_name'];
		$post_data['branch_name'] = $checkbankdetail['branch_name'];
		$post_data['bank_address'] = $checkbankdetail['bank_address'];
		$post_data['country'] = $checkbankdetail['country'];
		$post_data['swift_code'] = $checkbankdetail['swift_code'];
		//$post_data = array_from_get($arr);
		$post_data['user_id'] = $userDetails['id'];
		$post_data['created_date'] = date('Y-m-d H:i:s');
		
		DB::insert($table_name, $post_data);
		$created_id = DB::insertId();
		echo '<script>window.location="'.$m_link.'"</script>';
	}

	$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
	$category_list = adv_category_list();
}
else{
	header("Location: ".SITEURL."login.php");
}

?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Notification | The Live Model</title>
<?php  include('../../includes/head.php'); ?>
<style>
.thumbnail{
	background:#FFF;
}
</style>
	</head>

<body class="page-template-default page page-id-319 custom-background">
   <?php include('../../includes/header.php'); ?>

      <div class="container">

        <div id="content" class="clearfix row d-flex justify-content-center">
        
          <div id="main" class="col-md-6 clearfix " >

<div class="nk-pps-title text-center">
    <h3 class="title">Withdraw Funds</h3>
    <p class="caption-text">Select from withdraw options below</p>
    <p class="sub-text-sm">Withdraw funds from your account directly.</p>
</div>
<div class="card"></div>
                      
<div class="panel bg-white">
<div class="panel-body">
<div>
<form action="" method="post" class="form-horizontal edit-form" role="form" enctype="multipart/form-data">
<div class="form-body">
<h4 class="text-black">Bank Details</h4>
<div class="row">
<div class="col-md-6">
<div class="d-flex justify-content-between">
	<p>Account Name</p>
	<p><?=$checkbankdetail['account_name']?></p>
</div>

<div class="d-flex justify-content-between">
	<p>Country</p>
	<p><?=print_value('countries',array('id'=>$checkbankdetail['country']),'name')?></p>
</div>

<div class="d-flex justify-content-between">
	<p>Swift Code / BIC</p>
	<p><?=$checkbankdetail['account_number']?></p>
</div>

<div class="d-flex justify-content-between">
	<p>Bank Address</p>
	<p><?=$checkbankdetail['bank_address']?></p>
</div>

</div>
<div class="col-md-6">
<div class="d-flex justify-content-between">
	<p>Account Number</p>
	<p><?=$checkbankdetail['account_number']?></p>
</div>

<div class="d-flex justify-content-between">
	<p>Bank Name</p>
	<p><?=$checkbankdetail['bank_name']?></p>
</div>

<div class="d-flex justify-content-between">
	<p>Branch Name</p>
	<p><?=$checkbankdetail['branch_name']?></p>
</div>
</div>
</div>

<div class="form-group row mt-3" >
    <label class="col-md-12 ">Withdraw Coin</label>
    <div class="col-md-12">
<input type="number" name="coins" value="<?=$userDetails['balance']?>" min="50" max="<?=$userDetails['balance']?>" class="form-control" required>
    </div>
</div>


</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-9 offset-md-3">
	        <button type="submit" class="btn btn-info submitBtn" >Submit</button>
        </div>
    </div>
</div>
</form>
	<div style="clear:both"></div>
                 
			</div>
</div>
</div>
    
          </div>
      
        </div>

      </div> 

<?php include('../../includes/footer.php'); ?>
<script src="<?=SITEURL?>assets/plugins/jquery.validate.js"></script>   
<script type="text/javascript">
$(".edit-form" ).validate({
    submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('.submitBtn').prop('disabled', true).html(loadingText);
		$('.message').html('');
		return true;
	}
});
</script>


<style>
label.error{font-size:13px;color:#F00;}
</style>
</body>
</html> 
