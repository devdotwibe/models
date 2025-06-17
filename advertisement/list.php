<?php 
session_start(); 
include('../includes/config.php');
?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Notification | The Live Model</title>
<?php  include('../includes/head.php'); ?>

	</head>

<body class="page-template-default page page-id-319 custom-background advt-page">
   <?php include('../includes/header.php'); ?>
   
   <!-- Main Content -->
    <main class="main">

      <div class="container">

        <div id="content" class="clearfix row">
        
          <div class="col-md-12 clearfix" >
            
<div class="card mb-3 panel" id="app">
<div class="card-header">
<form method="get" id="search-form" class="form-inline" onSubmit="submit_search(1);return false;">
<input type="hidden" id="selpagesize" value="20" />
<input type="hidden" name="pages" id="i-page" value="1" />
<input type="hidden" name="total_item" id="i-total-page" value="0" />
<input type="hidden" name="sort_column" id="hdnSortColumn" value="" />
<input type="hidden" name="sort_type" id="hdnSortOrder" value="" />
<a href="<?=SITEURL.'advertisement/create.php'?>" class="btn btn-info ml-1">Add New</a>
</form>
</div>
        <div class="table-responsive">
    <table class=" table table-hover">
    <thead class="thead-light">
    <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody id="result-data"><tr><td colspan="5">Loading..</td></tr></tbody>
        </table>
        
    </div>
<div class="row">
<div class="col-md-12">
<ul class="pagination pull-right" id="list-paginations"></ul>
</div>
</div>
</div>    
          </div>
      
        </div>

      </div> 
	  
	  </main>

 <?php include('../includes/footer.php'); ?>

<link href="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
<script type="text/javascript" src="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.js"></script>

<script>
var currentPage = 1;
$('#result-data').html('<tr><td colspan="18">Loading..</td></tr>');
function submit_search(pageNum){
	perPage =  $("#selpagesize").val();
    var data = $('#search-form').serialize()+'&page='+pageNum+'&data_list='+perPage;
	$.ajax({
		type: 'GET',
		url : "<?php echo SITEURL.'advertisement/ajax.php'?>",
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
