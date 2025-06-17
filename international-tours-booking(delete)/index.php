<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');

$activeTab = 'international-tours-booking';
$m_link= SITEURL.'international-tours-booking/';

if(isset($_SESSION["log_user_id"])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="/login.php"</script>';
		die;
	}
}
else{
	echo '<script>window.location.href="/login.php"</script>';
	die;
}

$mDefaultImage =SITEURL."/assets/images/girl.png";
if($userDetails['gender']=='Male'){
	$mDefaultImage =SITEURL."/assets/images/profile.png";
}
if(!empty($userDetails['profile_pic'])){
	$mDefaultImage = SITEURL.$userDetails['profile_pic'];
}

?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Bookging | The Live Model</title>
<?php  include('../includes/head.php'); ?>
<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
<style>
.fa,.fab, .far{
	font-weight:900;
}
.nk-odr-item {
	background-color:#FFF;
}
</style>


  </head>

<body class="page-template-default page page-id-319 custom-background">
   <?php include('../includes/header.php'); ?>

      <div class="container">

        <div id="content" class="clearfix row">
        
          <div class="col-md-12 clearfix" >
<?php
include('../user_tab/booking_tab.php');
?>
       

<form method="get" id="search-form" class="form-inline" onSubmit="submit_search(1);return false;">
<input type="hidden" id="selpagesize" value="20" />
<input type="hidden" name="pages" id="i-page" value="1" />
<input type="hidden" name="total_item" id="i-total-page" value="0" />
<input type="hidden" name="sort_column" id="hdnSortColumn" value="" />
<input type="hidden" name="sort_type" id="hdnSortOrder" value="" />
</form>   
<div class="card card-bordered card-no-box-shadow">
<div class="nk-data data-list" id="result-data"></div>
</div>
<div class="row" style="margin-top:10px" >
	<div class="col-md-6">
<!--		Total: <span class="search-total">0</span>-->
	</div>
	<div class="col-md-6">
		<ul class="pagination pull-right" style="margin:0" id="list-paginations"></ul>
	</div>        
</div>




            
          </div>
      
        </div>

      </div> 

 <?php include('../includes/footer.php'); ?>

<link href="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
<script type="text/javascript" src="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.js"></script>

<script>
var currentPage = 1;
$('#result-data').html('<div class="text-center p-3"><h5 class="m-0">Loading..</h5></div>');
function submit_search(pageNum){
	perPage =  $("#selpagesize").val();
    var data = $('#search-form').serialize()+'&page='+pageNum+'&data_list='+perPage;
	$.ajax({
		type: 'GET',
		url : "<?php echo $m_link.'ajax.php'?>",
		data:data,
		dataType:'json',
		success: function(response){
			$('#result-data').html(response.html);
			$('.search-total').html(response.total);
			$('#i-total-page').val(response.total_page);
			currentPage = response.page;
			rebindpagination();
		}
	});
}
function rebindpagination() {
	$("#list-paginations").pagination('destroy');
	$("#list-paginations").pagination({
		pages: $("#i-total-page").val(),
		displayedPages: 5,
		edges: 0,
		cssStyle: 'light-theme',
		hrefTextPrefix: 'javascript:;',
		currentPage: currentPage,
		onPageClick: function (pageNum, e) {
			submit_search(pageNum);
			currentPage = pageNum;
		}
	});
}

submit_search(1);
$('#search-form').submit(function(e){
	e.preventDefault();
});

</script>
  </body>


</html> 
