<?php

use Google\Service\ContainerAnalysis\PgpSignedAttestation;

session_start();
include('../includes/config.php');
include('../includes/helper.php');

$m_link = SITEURL . 'advertisements/';
$category_list = adv_category_list();
$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
$serviceArr = array('Providing services', 'Looking for services');

?>

<!doctype html>
<html lang="en-US" class="no-js">

<head>
    <title>Model Advertisements - Premium Talent Directory | Live Models</title>
	
	<meta name="description" content="Browse premium model advertisements with enhanced grid and expanded views. Find verified models, influencers, and creators for your projects.">
    <meta name="keywords" content="model advertisements, premium models, talent directory, verified models, influencers, creators">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/stylesheet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php include('../includes/head.php'); ?>
</head>

<body class="advt-page">

    <?php include('include/adv_header.php'); ?>

    <?php /*?><div class="container">
        <div class="login-signup" style="padding-top:10px;">
            <form method="get" id="search-form" class="mb-2" onSubmit="submit_search(1);return false;">
                <input type="hidden" id="selpagesize" value="20" />
                <input type="hidden" name="pages" id="i-page" value="1" />
                <input type="hidden" name="total_item" id="i-total-page" value="0" />
                <input type="hidden" name="sort_column" id="hdnSortColumn" value="" />
                <input type="hidden" name="sort_type" id="hdnSortOrder" value="" />
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <select name="category" class="form-control" onchange="submitSelect()">
                            <option value="">Category</option>
                            <option value="all">All</option>
                            <?php
                            foreach ($category_list as $val) {
                            ?>
                                <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
<div class="col-md-3 mb-2">
<select name="service" class="form-control" onchange="submitSelect()" >
<option value="">I Am</option>
<option value="">All</option>
<?php
foreach ($serviceArr as $val) {
?>
<option value="<?= $val ?>"><?= $val ?></option>
<?php
}
?>
</select>
</div>

<div class="col-md-3 mb-2">
<select name="country" id="i-hs-country" onChange="select_hs_country('')" class="form-control" >
<option value="" data-id="">Country</option>
<option value="" >All</option>
<?php
if ($f_country_list) {
foreach ($f_country_list as $val) {
?>
<option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
<?php
}
}

?>
</select>
</div>

<div class="col-md-3 mb-2">
    <select name="state" id="i-hs-state" onChange="select_hs_state('')" class="form-control"></select>
</div>
<div class="col-md-3 mb-2">
<select name="city" id="i-hs-city" onchange="submitSelect()" class="form-control"></select>
</div>





                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <div class="row" id="result-data">
            </div>
            <div class="row" style="margin-top:10px">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <ul class="pagination pull-right" style="margin:0" id="list-paginations"></ul>
                </div>
            </div>



        </div>
    </div>
	<?php */ ?>
	
	
	<!-- Main Content -->
    <main class="main">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="heading-font">Premium Model Advertisements</h1>
                <p>Discover verified models, influencers, creators, and talent with enhanced grid and expanded views</p>
            </div>

            <!-- Search Section -->
            <div class="search-section">
                <div class="search-form">
                    <div class="form-grid">
					
					<form method="get" id="search-form" class="mb-2" onSubmit="submit_search(1);return false;">
						<input type="hidden" id="selpagesize" value="6" />
						<input type="hidden" name="pages" id="i-page" value="1" />
						<input type="hidden" name="total_item" id="i-total-page" value="0" />
						<input type="hidden" name="sort_column" id="hdnSortColumn" value="" />
						<input type="hidden" name="sort_type" id="hdnSortOrder" value="" />
						
						<?php 
						
						$string_category = DB::query('select category from banners GROUP BY category order by category asc');
						
						?>
					
						<select name="category" id="categoryFilter" class="form-control" onchange="submitSelect()">
                            <option value="">All Categories</option>
                            <?php
                            foreach ($string_category as $val) {
                            ?>
                                <option value="<?= $val['category'] ?>"><?= $val['category'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <input type="text" class="form-control" placeholder="Search models..." id="searchInput">

						<?php 
						
						$adv_country_list = DB::query('select ct.id,ct.name from countries ct join banners tb on ct.id=tb.country GROUP BY tb.country');
						
						?>
						
						<select name="country" id="i-hs-country" onChange="select_hs_country('')" class="form-control" >
							<option value="" data-id="">Country</option>
							<option value="" >All</option>
							<?php
							if ($adv_country_list) {
							foreach ($adv_country_list as $val) {
							?>
							<option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
							<?php
							}
							}

							?>
						</select>

						
						<button type="submit" class="btn-primary" <?php /* onclick="performSearch()" */ ?> > 🔍 Search</button>
					</form>
						
                    </div>
                </div>
            </div>

            <!-- View Controls -->
            <div class="view-controls">
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('grid')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm0 11h7v7h-7v-7z"/>
                        </svg>
                        Grid View
                    </button>
                    <button class="view-btn" onclick="switchView('expanded')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/>
                        </svg>
                        Expanded View
                    </button>
                </div>

               <?php /*?> <div class="content-filter">
                    <button class="filter-btn active" onclick="filterContent('all')">All Content</button>
                    <button class="filter-btn" onclick="filterContent('general')">General Only</button>
                    <button class="filter-btn" onclick="filterContent('adult')">Adult Content</button>
                    <button class="filter-btn" onclick="filterContent('premium')">Premium Only</button>
                </div> <?php */ ?>
            </div>

            <!-- Grid View -->
            <div class="ads-grid" id="gridView"></div>
			
			<!-- Expanded View -->
            <div class="ads-expanded featured-sec" id="expandedView"></div>
			
			

            <!-- Pagination -->
            <div class="pagination">
			
				
            <div class="row" style="margin-top:10px">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <ul class="pagination pull-right" style="margin:0" id="list-paginations"></ul>
                </div>
            </div>

                <?php /*?><button class="btn-secondary" disabled>← Previous</button>

                <div class="page-numbers">
                    <a href="#" class="page-number active">1</a>
                    <a href="#" class="page-number">2</a>
                    <a href="#" class="page-number">3</a>
                    <span>...</span>
                    <a href="#" class="page-number">10</a>
                </div>

                <button class="btn-secondary">Next →</button> <?php */ ?>
            </div>
        </div>
    </main>
	
	
	
	<?php include('include/adv_footer.php'); ?>
	
	

    <link href="<?= SITEURL ?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
    <script type="text/javascript" src="<?= SITEURL ?>assets/plugins/ajax-pagination/simplePagination.js"></script>

    <script>
        var currentPage = 1;
        $('#gridView').html('<div class="text-center p-3"><h5 class="m-0">Loading..</h5></div>');

        function submit_search(pageNum) { 
            perPage = $("#selpagesize").val();
            var data = $('#search-form').serialize() + '&page=' + pageNum + '&data_list=' + perPage;
            $.ajax({
                type: 'GET',
                url: "<?php echo $m_link . 'ajax.php' ?>",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#gridView').html(response.html);
					$('#expandedView').html(response.html);
					
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
                onPageClick: function(pageNum, e) {
                    submit_search(pageNum);
                    currentPage = pageNum;
                }
            });
        }

        submit_search(1);
        $('#search-form').submit(function(e) {
            e.preventDefault();
        });

        function submitSelect() {
            setTimeout(function() {
                submit_search(1);
            }, 500);
        }
    </script>


<script>
		function select_hs_country(state) {
			$("#i-hs-city").html('<option value="">City</option>');
			$("#i-hs-state").html('<option value="">State</option>');
			var country = $('#i-hs-country').val();
			//	var country = $('#i-hs-country :selected').attr('data-id');
			$.ajax({
				url: '<?= SITEURL . 'ajax/state.php' ?>',
				type: 'get',
				data: {
					country: country,
					selected: state
				},
				dataType: 'json',
				success: function(res) {
					$("#i-hs-state").html('<option value="">State</option><option value="">All</option>' + res.list);
                    submitSelect();
				}
			})
		}

		function select_hs_state(city) {
			$("#i-hs-city").html('<option value="">Select</option>');
			var state = $('#i-hs-state').val();
			$.ajax({
				url: '<?= SITEURL . 'ajax/city.php' ?>',
				type: 'get',
				data: {
					selected: city,
					state: state
				},
				dataType: 'json',
				success: function(res) {
					$("#i-hs-city").html('<option value="">City</option><option value="">All</option>' + res.list);
                    submitSelect();
				}
			})
		}

		select_hs_country('');
	</script>
</body>


</html>