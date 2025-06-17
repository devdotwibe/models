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
    <title>Advertisements | All Models</title>

    <?php
    include('../includes/head.php');
    ?>
    <style type="text/css">
        .login-signup {
            padding: 0 0 25px;
        }

        .adv-list {
            margin-bottom: 10px;
        }

        .adv-list img {
            width: 100%;
            height: 200px;
        }

        .adv-list a {
            display: flex;
            flex-wrap: wrap;
        }

        .adv-list .adv-img {
            width: 20%;
        }

        .adv-list .adv-text {
            width: 80%;
            padding-left: 10px;
        }

        .adv-list .adv-text .adv-title,
        .adv-list .adv-text .adv-age,
        .adv-list .adv-text .adv-details {
            color: #000;
        }

        .adv-list .adv-text .adv-age {
            color: #5a5858;
        }

        .adv-list .adv-text .adv-category {
            color: #ffffff;
            padding: 3px 15px;
            background-color: #67e387;
            border-radius: 10px;
            font-size: 13px;
        }

        .adv-list .adv-text .adv-featured {
            color: #ffffff;
            padding: 3px 15px;
            background-color: #ff6912;
            border-radius: 10px;
            font-size: 13px;
        }

        @media screen and (max-width: 768px) {
            .adv-list .adv-img {
                width: 35%;
                display: flex;
                justify-content: center;
                align-items: start;
            }

            .adv-list img {
                height: 110px;
                object-fit: cover;
            }

            .adv-list .adv-text {
                width: 65%;
            }

            .adv-list .adv-text .adv-title {
                font-size: 17px !important;
                margin-bottom: 0;
            }

            .adv-list .adv-text .adv-age {
                font-size: 11px !important;
                margin: 0;
            }

            .adv-list .adv-text .adv-category,
            .adv-list .adv-text .adv-featured {
                font-size: 10px;
            }

            .limit-hight {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                line-height: 17px;
                max-height: 36px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
    <?php include('../includes/header.php'); ?>

    <div class="container">
        <!-- <h2 class="page_heading">All Models</h2> -->
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
    <?php include('../includes/footer.php'); ?>

    <link href="<?= SITEURL ?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
    <script type="text/javascript" src="<?= SITEURL ?>assets/plugins/ajax-pagination/simplePagination.js"></script>

    <script>
        var currentPage = 1;
        $('#result-data').html('<div class="text-center p-3"><h5 class="m-0">Loading..</h5></div>');

        function submit_search(pageNum) {
            perPage = $("#selpagesize").val();
            var data = $('#search-form').serialize() + '&page=' + pageNum + '&data_list=' + perPage;
            $.ajax({
                type: 'GET',
                url: "<?php echo $m_link . 'ajax.php' ?>",
                data: data,
                dataType: 'json',
                success: function(response) {
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