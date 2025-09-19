<?php 
session_start(); 
//echo dirname(__FILE__);
include('../includes/config.php');
include('../../includes/helper.php');
include('../includes/auth.php');

$m_link= ADMINURL.'withdrawal/';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  
 <?php include('../includes/head.php'); ?>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include('../includes/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include('../includes/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="card mb-3 panel" id="app">
<div class="card-header">
<h5>All Withdrawal Request</h5>
<form method="get" id="search-form" class="form-inline" onSubmit="submit_search(1);return false;">
<input type="hidden" id="selpagesize" value="20" />
<input type="hidden" name="pages" id="i-page" value="1" />
<input type="hidden" name="total_item" id="i-total-page" value="0" />
<input type="hidden" name="sort_column" id="hdnSortColumn" value="" />
<input type="hidden" name="sort_type" id="hdnSortOrder" value="" />

</form>
</div>
        <div class="table-responsive">
    <table class=" table table-hover">
    <thead class="thead-light">
    <tr>
                <th>ID</th>
                <th>User</th>
                <th>Details</th>
                <th>Coins</th>
                <th>Transaction Fee</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id="result-data"><tr><td colspan="5">Loading..</td></tr></tbody>
        </table>
        
    </div>
<div class="row">
<div class="col-md-12">
<ul class="pagination float-right" id="list-paginations"></ul>
</div>
</div>
</div>
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include('../includes/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

<?php include('../includes/script.php'); ?>
<link href="<?=SITEURL?>super-admin/assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
<script type="text/javascript" src="<?=SITEURL?>super-admin/assets/plugins/ajax-pagination/simplePagination.js"></script>

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

<script>
function set_confirm(id,type){
	$.confirm({
		title: 'Confirm!',
		content: 'Are you want?',
		buttons: {
			confirm: function () {
		$('#app').block({ 
			message: '<h5 style="margin:0">Please wait...</h5>', 
			css: { 
				border: 'none', 
				padding: '15px', 
				backgroundColor: '#000', 
				'-webkit-border-radius': '10px', 
				'-moz-border-radius': '10px', 
				opacity: .5, 
				color: '#fff' 
			}						
		}); 				  
			$.ajax({
				type: 'GET',
				url : "<?php echo $m_link.'action.php'?>",
				data:{id:id,type:type},
				dataType:'json',
				success: function(response){
					$('#app').unblock(); 
					if(response.status=='ok'){
						submit_search(currentPage);
					}
					else{
						alert(response.message);
					//	toastr.error(response.message,'Error', {timeOut: 5000});
					}
				}
			});
			},
			cancel: function () {
			},
		}
	});
} 
</script>
</body>

</html>

