<?php 
session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');
$table_name = "users_bankdetail";
$m_link= SITEURL.'user/bankdetails/';
if(isset($_SESSION['log_user_id'])){
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="'.SITEURL.'login.php"</script>';
		die;
	}
	$form_data = get_data('users_bankdetail',array('user_id'=>$userDetails["id"]),true);
//	printR($form_data);die;
	if(!$form_data){
		echo '<script>window.location.href="'.SITEURL.'user/bankdetails/create.php"</script>';
		die;
	}

	//create post data
	if($_POST){
		$arr = array('account_name','account_number','country','bank_name','branch_name','swift_code','bank_address');
		$post_data = array_from_post($arr);
		
		DB::update($table_name, $post_data, "id=%s", $form_data['id']);
		$created_id = DB::insertId();
	
		echo '<script>window.location="'.$m_link.'edit.php"</script>';
		die;
	}

	$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
	$category_list = adv_category_list();
}
else{
	header("Location: ".SITEURL."login.php");
}

$activeTab = 'bankdetails';

$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
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
<?php
include('../../user_tab/wallet_menu_tab.php');
?>

        <div id="content" class="clearfix row d-flex justify-content-center">
        
          <div id="main" class="col-md-6 clearfix " >

<div class="nk-pps-title text-center mb-2">
    <h3 class="title mb-2">Bank Detail</h3>
</div>
<div class="card">
			<div class="card-body">
<form method="post"  class="form-horizontal edit-form" role="form"  enctype="multipart/form-data">
<div class="form-body">      

    <div class="row form-group" >
        <div class="col-md-6">
            <label class="control-label" >Account Holder Name <em>*</em></label>
            <div class="">
                <input type="text" name="account_name" value="<?=$form_data['account_name']?>" class="form-control " required>
            </div>
        </div>

        <div class="col-md-6">
            <label class="control-label" >Account Number <em>*</em></label>
            <div class="">
                <input type="text" name="account_number" value="<?=$form_data['account_number']?>" class="form-control " required>
            </div>
        </div>

    </div>

    <div class="row form-group" >
        <div class="col-md-6">
            <label class="control-label" >Bank Location / Country <em>*</em></label>
            <div class="">
                <select name="country" class="form-control select2" required>
                    <option value="">Select</option>
                    <?php
                    foreach($f_country_list as $val){
                        ?>
                        <option value="<?=$val['id']?>" <?=$form_data['country']==$val['id']?'selected':''?>><?=$val['name']?></option>
                        <?php	
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label class="control-label" >Bank Name <em>*</em></label>
            <div class="">
                <input type="text" name="bank_name" value="<?=$form_data['bank_name']?>" class="form-control " required>
            </div>
        </div>

    </div>

    <div class="row form-group" >
        

        <div class="col-md-6">
            <label class="control-label" >Branch Name <em>*</em></label>
            <div class="">
                <input type="text" name="branch_name" value="<?=$form_data['branch_name']?>" class="form-control " required>
            </div>
        </div>
		<div class="col-md-6">
            <label class="control-label" >Swift Code / BIC  </label>
            <div class="">
                <input type="text" name="swift_code" value="<?=$form_data['swift_code']?>" class="form-control " required>
            </div>
        </div>
    </div>

    <div class="row form-group" >
        <div class="col-md-12">
            <label class="control-label" >Bank Address</label>
            <div class="">
                <input type="text" name="bank_address" value="<?=$form_data['bank_address']?>" class="form-control " required>
            </div>
        </div>
		
    </div>
 

</div>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-9">
								<button type="submit" class="btn btn-info submitBtn" >Save</button>
							</div>
						</div>
					</div>
</form>                    
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
		var loadingText = '<i class="fa fa-circle-notch fa-spin"></i> Saving..';
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
