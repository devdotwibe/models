<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');
if (isset($_SESSION['log_user_id'])) {
	$log_user_id = $_SESSION['log_user_id'];
	$get_modal_user = DB::query('select as_a_model from model_user where id='.$log_user_id); 
	$as_a_model = $get_modal_user[0]['as_a_model'];
}else{ 
	$as_a_model = '';
}
// if($as_a_model != 'Yes'){
// 	header("Location: login.php");
// }


    $category_list = adv_category_list();
?>
	
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Advertisement Management - The Live Models</title>
<meta name="description" content="Manage your advertisements and promotions on The Live Models platform. Create, edit, and promote your content to reach more audiences.">
<script src="https://cdn.tailwindcss.com"></script>

<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />

<?php  include('../includes/head.php'); ?>


<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --premium-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        --glass-bg: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.1);
        --neon-purple: #8b5cf6;
        --neon-pink: #ec4899;
        --neon-blue: #06b6d4;
    }

   

    
</style>
</head>


<body class="min-h-screen text-white profile-advts advt-page  socialwall-page enhanced5">
   
   <?php  include('../includes/side-bar.php'); ?>
	<?php  include('../includes/profile_header_index.php'); 

    ?>  
	
<main class="py-12">
    <div class="container mx-auto">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-bold heading-font gradient-text mb-6">Advertisement Management</h1>
            <p class="text-xl text-white/70 max-w-2xl mx-auto">Create, manage, and promote your advertisements to reach more audiences and grow your fanbase</p>
        </div>

        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
            <div class="flex space-x-4">
                <button class="btn-primary px-8 py-3 rounded-xl font-semibold shadow-lg" onclick="window.location='<?=SITEURL.'advertisement/create.php'?>'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add New
                </button>
                <button class="btn-secondary px-6 py-3 rounded-xl font-semibold" onclick="bulkActions()">
                    Bulk Actions
                </button>
            </div>
            
            <div class="flex space-x-4">

                <select onchange="FilterAdver()" id="category_id" class="ultra-glass px-4 py-3 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 border border-white/10">

                    <option value="">All Categories</option>

                    <?php foreach($category_list as $item) {  ?>

                        <option value="<?= $item ?>"><?= $item ?> </option>

                    <?php } ?>
                    
                </select>

                <select  onchange="FilterAdver()" id="status_filter" class="ultra-glass px-4 py-3 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 border border-white/10">
                    <option value="">All Status</option>
                    <option value="">Active</option>
                    <option value="pending">Pending</option>
                    <option value="paused">Paused</option>
                    <option value="expired">Expired</option>
                </select>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="ultra-glass p-6 rounded-2xl hover-lift">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M3 3v18h18"></path>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"></path>
                        </svg>
                    </div>
                    <span class="text-green-400 text-sm font-semibold">+12%</span>
                </div>
                <h3 class="text-2xl font-bold premium-text mb-2">24</h3>
                <p class="text-white/60">Total Ads</p>
            </div>
            
            <div class="ultra-glass p-6 rounded-2xl hover-lift">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </div>
                    <span class="text-blue-400 text-sm font-semibold">Live</span>
                </div>
                <h3 class="text-2xl font-bold premium-text mb-2">18</h3>
                <p class="text-white/60">Active Ads</p>
            </div>
            
            <div class="ultra-glass p-6 rounded-2xl hover-lift">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                    <span class="text-purple-400 text-sm font-semibold">+25%</span>
                </div>
                <h3 class="text-2xl font-bold premium-text mb-2">1.2K</h3>
                <p class="text-white/60">Total Views</p>
            </div>
            
            <div class="ultra-glass p-6 rounded-2xl hover-lift">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <span class="text-green-400 text-sm font-semibold">+18%</span>
                </div>
                <h3 class="text-2xl font-bold premium-text mb-2">$2.4K</h3>
                <p class="text-white/60">Revenue</p>
            </div>
        </div>

        <!-- Advertisements Table -->
        <div class="premium-table advertisement-table">
            <!-- Table Header -->
            <div class="px-8 py-6 border-b border-white/10">
                <div class="grid grid-cols-12 gap-4 items-center text-sm font-semibold text-white/80 uppercase tracking-wider">

                    <div class="col-span-1" id="bulk_delete_check" style="display:none;">

                        <input type="checkbox" id="bulk_all_check" onchange="SelectBulkAll(this)" name="bulk_all_check" class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">

                    </div>

                    <div class="col-span-1">ID</div>
                    <div class="col-span-3">Title</div>
                    <div class="col-span-2">Category</div>
                    <div class="col-span-2">Date</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-2">Options

                    <button id="bulk_delete_button" style="display: none;" class="btn-danger px-3 py-2 rounded-lg text-white text-sm del" onclick="BulkDeleteAll()">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </button>

                    </div>

                </div>
            </div>
			
			<?php 
			
			$total_adv = DB::queryFirstrow("SELECT COUNT(*) AS total FROM banners where user_id=".$_SESSION['log_user_id']);
			
			?>
            
			<div id="list_advertisements"><h3>Loading...</h3></div>	
            
        </div>
		
		<!-- Pagination -->
        <div class="flex justify-center items-center space-x-4 mt-8 adv-pagination">
			<div id="pagination-container"></div>
		</div>
		
    </div>
</main>	
	

    <div class="modal-overlay" id="conform_adver">
        <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Confirm Bulk Delete ?</h2>
            <button class="close-modal" id="closeRemoveProfilePicModal" type="button" onclick="ConformCloseModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete your advertisements ?</p>

            <div style="margin-top:15px; display:flex; gap:10px; justify-content:center;">
            <button class="btn-primary px-7 sm:px-3 py-6 text-white" type="button" onclick="ConformDelete()">Yes, Conform</button>

            <button class="btn btn-secondary" type="button" onclick="ConformCloseModal()">Cancel</button>
            </div>
        </div>
        </div>
    </div>


 <?php include('../includes/footer.php'); ?>

<link href="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
<script type="text/javascript" src="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.js"></script>

<script>


    function ConformCloseModal()
    {

        $('#conform_adver').removeClass('active');
    }

 function FilterAdver()
 {

    var value =  $('#category_id').val();

    var status = $('#status_filter').val();

    // var pageno = $('#pagination-container .active .current').text();

      loadData(1, value,status);
 }

    function BulkDeleteAll()
    {
        $('#conform_adver').addClass('active');
    }

    function ConformDelete()
    {
        let formData = new FormData();

        $('[name="adv_id[]"]').each(function () {

            var bulk = $(this).is(":checked");

            if(bulk)
            {
                formData.append("adv_id[]", $(this).val());
            }
            
        });

        formData.append("action",'bulk_delete');

          $.ajax({

                url: "<?php echo SITEURL.'advertisement/ajax.php'?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                let res = JSON.parse(response);

                    if (res.status === 'success') {


                        showNotification('Advertisement delted successfully', 'success');

                    } else {

                        showNotification('Something Error Occur');
                    }

                },

                error: function(xhr, status, error) {

                }
          });
    }


        function showNotification(message, type = 'info') {

            const notification = document.createElement('div');
            notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--primary)'};
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: var(--radius);
                    box-shadow: var(--shadow-lg);
                    z-index: 10000;
                    font-weight: 600;
                    transform: translateX(100%);
                    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                `;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Show notification
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Hide notification
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
                }, 300);
            }, 3000);
        }


    function SelectBulkAll(el) {

        var ischecked = $(el).is(":checked");

        if (ischecked) {
            $('[name="adv_id[]"]').each(function () {
                $(this).prop("checked", true);
            });

            $('#bulk_delete_button').show();

        } else {

            $('[name="adv_id[]"]').each(function () {
                $(this).prop("checked", false);
            });

            $('#bulk_delete_button').hide();
        }


        $('[name="adv_id[]"]').each(function () {

            var bulk = $(this).is(":checked");

            if(bulk)
            {
                $('#bulk_delete_button').show();
            }
            
        });
    }

    function DeleteCheck()
    {
         $('#bulk_delete_button').hide();

          $('[name="adv_id[]"]').each(function () {

            var bulk = $(this).is(":checked");

            if(bulk)
            {
                $('#bulk_delete_button').show();
            }
            
        });
    }



$(document).ready(function () {

    loadData(1);
});


    let itemsPerPage = 10;

    function loadData(page = 1, category = '',status='') {

        $.ajax({
            url: "<?php echo SITEURL.'advertisement/ajax.php'?>",
            type: "GET",

            data: { 
                    page: page,
                    limit: itemsPerPage,
                    category : category,
                    status : status,
                    action:'table_list',
                },
            dataType: "json",
            success: function (response) {
                // Display results
                
                $("#list_advertisements").html(response.html);

                // Init pagination only once
                if ($("#pagination-container").data("pagination-initialized") !== true) {
                    $("#pagination-container").pagination({
                        items: '<?php echo $total_adv['total']; ?>',
                        itemsOnPage: itemsPerPage,
                        cssStyle: "light-theme",
                        onPageClick: function (pageNumber) {
                            loadData(pageNumber);
                        }
                    });
                    $("#pagination-container").data("pagination-initialized", true);
                }
            }
        });
    }

</script>

<script>
function deleteAd(id) {
        if (confirm('Are you sure you want to delete this advertisement?')) {
			
			jQuery.ajax({
				type: 'GET',
				url : "<?=SITEURL.'advertisement/advertisements_remove.php'?>",
				data:{id:id},
				dataType:'json',
				success: function(response){
					if(response.msg == 'success'){
					alert(`🗑️ Advertisement #${id} deleted successfully.`);
					jQuery('#adv_row_'+id).remove();
					}else alert(response.msg);
				}
			});
			
            
        }
    }

    function bulkActions() {

        $('#bulk_delete_check').show();

        $('.adv_checkbox').show();
    }

</script>


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
