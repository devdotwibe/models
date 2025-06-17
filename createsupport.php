<?php 
session_start(); 
include('includes/config.php');
?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Notification | The Live Model</title>
<?php  include('includes/head.php'); ?>

	</head>

<body class="page-template-default page page-id-319 custom-background">
   <?php include('includes/header.php'); ?>

      <div class="container">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" >
<div class="panel bg-white">
<div class="panel-body">
<div>
<form action="" class="form-horizontal edit-form" role="form" enctype="multipart/form-data">
<div class="form-body">

<div class="form-group row" >
    <label class="col-md-3 control-label">Title</label>
    <div class="col-md-9">
	    <input type="text" name="name" value="" class="form-control" required/>
    </div>
</div>


<div class="form-group row" >
    <label class="col-md-3 control-label">Description</label>
    <div class="col-md-9">
	    <textarea name="description" class="form-control" required></textarea>
    </div>
</div>


</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-9 offset-md-3">
	        <button type="submit" class="btn btn-info submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">Create</button>
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

<?php include('includes/footer.php'); ?>
<script src="<?=SITEURL?>assets/plugins/jquery.validate.js"></script>   
<script type="text/javascript">
$(".edit-form" ).validate({
    submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-notch fa-spin"></i> Saving..';
		$('.submitBtn').prop('disabled', true).html(loadingText);
		$('.message').html('');
		$.ajax({ 
			type: 'GET',
			url: '<?=SITEURL.'/act_create_support.php'?>', 
			data: $(".edit-form").serialize(),
			dataType: 'json',
			success: function(response) { 
				$(".btn-login").html('Create').prop('disabled', false);
				if(response.status=='ok'){
					window.location = '<?=SITEURL.'supports.php'?>';
				}
				else{
            		$('.message').html('<div class="alert alert-danger">'+response.message+'</div>');
				} 
	        }
		});
		return false;
	}
});
</script>
<style>
label.error{font-size:13px;color:#F00;}
</style>
</body>
</html> 
