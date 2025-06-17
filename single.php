<?php  session_start(); ?>
<?php include('includes/config.php'); ?>
<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Stacia | Your Agency Name</title>
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- <link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png"> -->
    <!-- <link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2"> -->
    <link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>


    <style type="text/css">
      img.wp-smiley,
      img.emoji {
      display: inline !important;
      border: none !important;
      box-shadow: none !important;
      height: 1em !important;
      width: 1em !important;
      margin: 0 .07em !important;
      vertical-align: -0.1em !important;
      background: none !important;
      padding: 0 !important;
      }
    </style>
    <link rel='stylesheet' id='model-details-custom_profile-styles-css'  href='assets/wp-content/themes/theagency3/framework/assets/css/styles-custom_profile.css' type='text/css' media='all' />
    <link rel='stylesheet' id='model-details-pricing-styles-css'  href='assets/wp-content/themes/theagency3/framework/assets/css/styles-pricing.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wp-block-library-css'  href='assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='spiffycal-styles-css'  href='assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
    <link rel='stylesheet' id='dashicons-css'  href='assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
    <link rel='stylesheet' id='options_typography_Rokkitt-css'  href='https://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
    <link rel='stylesheet' id='rich-reviews-css'  href='assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
    <link rel='stylesheet' id='bones-stylesheet-css'  href='assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />
    <script type='text/javascript' src='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
    <script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
 	 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
$(document).ready(function(){
     $(document).bind("contextmenu",function(e){
        return false;
    });
});
</script>

    <style type="text/css">
      .main_img_div{
        height: 350px;
        border-radius: 30px;
        overflow: hidden;
      }
      .img-scd{
        /*height: 350px;*/
        transition: 1s ease;
      }
      .img-scd:hover{
        transform: scale(1.7);
        /*height: 350px;*/
        overflow: hidden;
      }
      .banner_img{
        width: 80%;
        background-repeat: no-repeat;
        height: 450px;
        margin-left: 10%;
        margin-right: 10%;
        /*border-radius: 0px 0px 20px 20px;*/
      }
      .banner_img_dynmic{
        width: 100%;
        background-repeat: no-repeat;
        height: 450px;
        border-radius: 0px 0px 20px 20px;
      }
      .cir_img{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border:2px solid red;
        overflow: hidden;
      }
      .cir_img img{
        width: 120px;
        height: 120px;
        /*border-radius: 50%;
        border:2px solid red;
        overflow: hidden;*/
      }
      .mol_name{
        font-size: 22px;
        font-weight: bold;
        text-transform: capitalize;
        vertical-align: middle;
        padding-top: 20px;
        color: #4c4b4b;
        margin: unset;
      }
      .main_idv{
        height: 350px;
        border-radius: 30px;
        overflow: hidden;

      }
      

      .post_img:hover{
        transform: scale(1.2);
      }
      .my_dvf{
        padding-top: 20px;
        padding-bottom: 20px;
        float: left;
      }
      .menuyg{
        padding-top: 15px;
        padding-bottom: 15px;
      }
      .profil_img{
          width: 40px;
		  height: 40px;
	  }
	</style>
	  <style>    
    .gallery img { 
      width: 100%; 
      height: 100%; 
      transition: 1s ease; 
      
      vertical-align: top;
	  border: 2px solid #968e75;
    } 
    .mn-dv-img{
      width: 100%; 
      height: 100%; 
      position: relative;
      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      vertical-align: top;
	
    }
    .main-uper-div-img{
    	position: absolute;
    	top: 0px;
    	left: 0px;
    	/*background: #6d5a139e;*/
    	width: 100%; 
    	height: 100%;
    	border-radius: 30px;
    	border: 1px solid #ff2424;
    	
    }
    .mn-dv-vdo{
      width: 100%; 
      height: 100%; 
      position: relative;
      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      vertical-align: top;
	 
    }
    .main-uper-div-vdo{
    	position: absolute;
    	top: 0px;
    	left: 0px;
    	background: #968e75;
    	width: 100%; 
    	height: 100%;
    	border-radius: 30px;
    	border: 1px solid #ff2424;

    }
    .gallery .free-video { 
        width: 100%; 
        height: 100%; 
        transition: 1s ease; 
        /*margin-left: 10px;
        margin-right: 10px;*/
        margin-top: 10px;
      margin-bottom: 20px;
        border: 2px solid #968e75;
    }
    .gallery .paid-video { 
        /*width: 200px; */
        /*height: 300px; */
        transition: 1s ease; 
        /*margin-left: 10px;
        margin-right: 10px;*/
        /*margin-top: 10px;*/
      	margin-bottom: 20px;
        border: 2px solid #968e75;
    }
      
    .gallery img:hover { 
        filter: drop-shadow(4px 4px 6px gray); 
        transform: scale(1.0); 
    } 
    .free-image{
    	margin-top: 10px;
     	margin-bottom: 20px;
    }
    @media only screen and (max-width: 600px) {
      h4 {
        font-size: 14px !important;
      }
	  .gallery {
	    text-align: center !important;
	  }
	  .banner_img{
	  	width: 100%;
    	background-repeat: no-repeat;
    	height: auto;
    	margin-left: 0%;
    	margin-right: 0%;
	  }
	  .main_img_wdth{
	  	width: 100% !important;
	  }
	}
	.icn-vdo{
		font-size:26px;
		color: #ff2424;
		margin-left: 15px;
		margin-top: 15px;
	}
	.icn-img{
		font-size:26px;
		color: #ff2424;
		margin-left: 15px;
		margin-top: 15px;
	}
	.mybtn{
		border: 1px solid white;
		border-radius: 10%;
		font-size: 15px;
		color: white;
		background: transparent;
		transition: 1s ease;
		margin-left: 30%;
		margin-right: 30%;
		margin-top: 100px;
		margin-bottom: 100px;
		padding: 5px 20px;
	}
	.mybtn:hover{
		border: 1px solid #e2e2e2;
		border-radius: 10%;
		font-size: 15px;
		color: white;
		background: red;
	}
	.coin_icon{
		font-size: 18px;
	    color: #ff2424;
	    display: inline;
	}

	.full_img{

	}
	.main_img_wdth{
		width: 80%;
		margin: auto;
		background: #e54720;
    	border-radius: 0px 0px 20px 20px;
	}
	.myleft_dv{
		text-align: center;
    	padding: 8px;
	}
	.past_heade{
		font-weight: bold;
		color: #4c4b4b;
	}
	.angle_dwn{
		font-weight: normal;	
	}
	#mol-des{
		margin: 10px 0px;
	}
	
	.table{
		width: 90%;
		margin: auto;
	}
	.tab_head{
		padding:20px;
		/*margin-top: unset;*/
		/*margin-bottom: unset;*/
	}
	.view_div{
		cursor: pointer;
		color: red;
    text-align: right;  
    font-size: 14px;

	}
  </style>

  <style type="text/css">
    .i_main {
      cursor:pointer;
      color:#e54720;
      transition:1s;
    }
    .i_main:hover {
      color:#666;
    }
    .i_main:before {
      font-family:fontawesome;
      content:'\f08a';
      font-style:normal;
      font-size: 16px;
    }
    .i_inverse {
      cursor:pointer;
      color:#aaa;
      transition:1s;
    }
    .i_inverse:hover {
      color:#666;
    }
    .i_inverse:before {
      font-family:fontawesome;
      content:'\f004';
      font-style:normal;
      color: #e54720;
      font-size: 35px;
    }
    #unflow, #flow{
      color: #e54720;
    }
  </style>
  </head>
  <body class="models-template-default single single-models postid-410 custom-background">
    <?php include('includes/header.php'); ?> 
    <?php
      $sqls = "SELECT * FROM casting WHERE id = '".$_GET['m_id']."' AND username = '".$_GET['model']."'";
      $resultd = mysqli_query($con, $sqls);
        if (mysqli_num_rows($resultd) > 0) {
          $rowesdw = mysqli_fetch_assoc($resultd);

          $sql_sl = "SELECT * FROM model_social_link WHERE unique_model_id = '".$_GET['m_unique_id']."' ";
		      $result_sl = mysqli_query($con, $sql_sl);
	        if (mysqli_num_rows($result_sl) > 0) {
	          $row_sl = mysqli_fetch_assoc($result_sl);
	        }

    ?>
    <div class="ban_img_dv">
    	<div class="main_img_wdth">
        <?php
          $sql_bi = "SELECT * FROM model_dp_banner WHERE unique_model_id = '".$_GET['m_unique_id']."'";
          $res_bi = mysqli_query($con, $sql_bi);
            if (mysqli_num_rows($res_bi) > 0) {
              $row_bi = mysqli_fetch_assoc($res_bi);

        ?>
      		<img alt="models" class="banner_img_dynmic" src="<?php echo $row_bi['model_banner_pic']; ?>">
        <?php }else{?>
          <img alt="models" class="banner_img" src="https://thelivemodels.com/design-test/assets/img/sexy-4895142_1920.jpg">
        <?php }?>
      	</div>
    </div>
    <div class="container">
      <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      </div>
      <div class="row menuyg">
        <div class="col-md-2 col-sm-6 col-xs-6 ">
          <div class="cir_img">
            <img alt="models" src="<?php echo $rowesdw['photo_1']; ?>">
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
          <p class="mol_name" id="show"><?php echo $rowesdw['fullname']; ?> <i class="fa fa-angle-down angle_dwn" style="font-size:25px"></i><i class="fa fa-angle-up angle_up" style="font-size:25px"></i> 
            <?php 
              if($_SESSION["log_user"]){ 

                $sql_folo = "SELECT * FROM model_follow WHERE unique_model_id = '".$_GET['m_unique_id']."' AND unique_user_id = '".$_SESSION['log_user_unique_id']."' AND status = 'Follow'";

                $res_folo = mysqli_query($con, $sql_folo);
                  if (mysqli_num_rows($res_folo) > 0) {
            ?>
              <form>
                <input type="hidden" name="model_id" id="model_id" value="<?php echo $_GET['m_unique_id']; ?>">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['log_user_unique_id']; ?>">
                <div id="flow">
                  <i class="i_inverse"></i>&nbsp;Unfollow
                </div>
              </form>
            <?php }else{ ?>
              <form>
                <input type="hidden" name="model_id" id="model_id" value="<?php echo $_GET['m_unique_id']; ?>">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['log_user_unique_id']; ?>">
                <div id="unflow">
                  <i class="i_main"></i>&nbsp;Follow
                </div>
              </form>
            <?php } ?>
            
            </p>
            <?php } ?>
          

          <p id="mol-des">
          	<a href="<?php echo $row_sl['i_plink']; ?>" style="color: black;">
          		<!-- <i class="fa fa-instagram insta" style="font-size: 25px;"></i> -->
          		<img alt="models" src="assets/images/instagram.jpg" style="width: 25px;">
          	</a>&nbsp;|&nbsp;
          	<a href="<?php echo $row_sl['s_plink']; ?>">
          		<!-- <i class="fa fa-snapchat-ghost schat" style="font-size: 25px;"></i> -->
          		<img alt="models" src="assets/images/snapchat.png" style="width: 25px;">
          	</a>
          </p>

          <small>@<?php echo $rowesdw['username']; ?></small>
        </div>
        
        <div class="col-md-8 col-sm-12 col-xs-12">
        	<div class="row">
        		<?php
	        		$sql_img = "SELECT COUNT(file_type) FROM model_images WHERE unique_model_id = '".$_GET['m_unique_id']."' AND file_type = 'Image' Order by id DESC";
		            $result_img = mysqli_query($con, $sql_img);
		            if (mysqli_num_rows($result_img) > 0) {
		            	$row_img = mysqli_fetch_assoc($result_img);
		            	$num1 = $row_img['COUNT(file_type)'];
		            }

		            $sql_vdo = "SELECT COUNT(file_type) FROM model_images WHERE unique_model_id = '".$_GET['m_unique_id']."' AND file_type = 'Video' Order by id DESC";
		            $result_vdo = mysqli_query($con, $sql_vdo);
		            if (mysqli_num_rows($result_vdo) > 0) {
		            	$row_vdo = mysqli_fetch_assoc($result_vdo);
		            	$num2 = $row_vdo['COUNT(file_type)'];
		            }

                $sql_flow = "SELECT COUNT(status) FROM model_follow WHERE unique_model_id = '".$_GET['m_unique_id']."' AND status = 'Follow' Order by id DESC";
                $result_flow = mysqli_query($con, $sql_flow);
                if (mysqli_num_rows($result_flow) > 0) {
                  $row_flow = mysqli_fetch_assoc($result_flow);
                  $num3 = $row_flow['COUNT(status)'];
                }

		         
        		?>
        		<div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
        			<h4 class="past_heade">Total Post</h4>
        			<p><?php echo $num1; ?></p>
        		</div>
        		<div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
        			<h4 class="past_heade">Photo</h4>
        			<p><?php echo $num2; ?></p>
        		</div>
        		<div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
        			<h4 class="past_heade">Videos</h4>
        			<p><?php echo $num1 + $num2; ?></p>
        		</div>
        		<div class="col-md-3 col-sm-3 col-xs-3 myleft_dv">
        			<h4 class="past_heade">Followers</h4>
        			<p><?php echo $num3; ?></p>
        		</div>
        		<p class="view_div" data-toggle="modal" data-target="#myModal_v_all">View all Details</p>
        	</div>
        </div>
        <div class="arrow-down" style="position: absolute;left: 37%;" onclick="this.classList.toggle('active')"></div>
      </div>
      <hr style="margin-top: 0px;">
      <div class="row">
	  	  <?php
	  	  	$count1 = 1;
	  	  	$sqler = "SELECT * FROM casting WHERE unique_id = '".$rowesdw['unique_id']."'";
            $resulter = mysqli_query($con, $sqler);
            if (mysqli_num_rows($resulter) > 0) {
              $rower = mysqli_fetch_assoc($resulter);
             while ($count1 <= 3) {
              	
              
              	?>
              	<div class="col-md-3 my_dvf">
              		<div class="main_idv" data-toggle="modal" data-target="#myModal1<?php echo $count1; ?>">
			              <img alt="models" class="post_img" src="<?php echo $rower['photo_'.$count1.'']; ?>" >  
			            </div>
              	</div>
              	

              	<div id="myModal1<?php echo $count1; ?>" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					    <div class="modal-content" style="border-radius: 20px;">
					      <div class="modal-body">
					      	<button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
					        <div class="row">
					          <div class="col-md-6"><img alt="models" class="full_img" src="<?php echo $rower['photo_'.$count1.'']; ?>"  alt=""></div>
					          <div class="col-md-6">
					            <div class="usern model-prof">
					              <a title="" href="single-model.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>" >
					                <figure class="user_profile">
					                  <img alt="models" class="profil_img" src="<?php echo $rowesdw['photo_2'] ?>">
					                </figure>
					                <span>
					                  <a title="" href="#" style="background: unset;"><?php echo $rowesdw['username']; ?></a>
					                </span>
					              </a>      
					            </div>
					            <hr>
					          </div>
					        </div>
					      </div>
					    </div>
					  </div>
					</div>
				<?php 
	              	$count1++;
	              		}
              	?>
              	<?php
              
             }	
	  	  ?>
          <?php
          $log_user_id = $_SESSION["log_user_unique_id"];
          $count = 1;
            $sql = "SELECT * FROM model_images WHERE unique_model_id = '".$rowesdw['unique_id']."' Order by id DESC";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($rowes = mysqli_fetch_assoc($result)){
              	$unique_image_id = $rowes['unique_image_id'];

              	$sql45 = "SELECT * FROM user_purchased_image WHERE file_unique_id = '".$unique_image_id."' AND user_unique_id = '".$log_user_id."'";
	            $result45 = mysqli_query($con, $sql45);
	            if (mysqli_num_rows($result45) > 0) {
	              $stat = "Purchased";
	            }
          ?>

          <?php if($rowes['img_type_price'] == 'Free'){ ?>


          <div class="col-md-3 my_dvf">
            <?php if($rowes['file_type'] == 'Image'){ ?>
            <div class="main_idv" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
              <img class="post_img" src="<?php echo $rowes['file']; ?>" >  
            </div>
            <?php }else{ ?>
              <video class="vid_tg" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>" poster="assets/images/unnamed.jpg">
                <source src="<?php echo $rowes['file']; ?>" type="video/mp4">
              </video>
            <?php } ?>
            <p class="img_desc"><?php echo $rowes['image_text']; ?></p>
          </div>
      	<!-- Modal -->
		<div id="myModal<?php echo $count; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content" style="border-radius: 20px;">
		      <div class="modal-body">
		      	<button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
		        <div class="row">
		          <div class="col-md-6"><img alt="models" class="full_img" src="<?php echo $rowes['file']; ?>"  alt=""></div>
		          <div class="col-md-6">
		            <div class="usern model-prof">
		              <a title="" href="single-model.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>" >
		                <figure class="user_profile">
		                  <img alt="models" class="profil_img" src="<?php echo $rowesdw['photo_2'] ?>">
		                </figure>
		                <span>
		                  <a title="" href="#" style="background: unset;"><?php echo $rowesdw['username']; ?></a>
		                </span>
		              </a>      
		            </div>
		            <hr>
		            <p><?php echo $rowes['image_text'] ?></p>
		          </div>
		        </div>
		      </div>
		    </div>

		  </div>
		</div>

		<?php }elseif($rowes['img_type_price'] == 'Paid'){ ?>

			<div class="col-md-3 my_dvf">
            
            <?php if($rowes['file_type'] == 'Image'){ ?>

            	<?php if($stat == "Purchased"){ ?>
            		<div class="main_idv" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
		              <img alt="models" class="post_img" src="<?php echo $rowes['file']; ?>" >  
		            </div>
		        <?php }else{ ?>
            	<div class="mn-dv-img">
			        <form method="post" action="file-process.php">
			          <input type="hidden" name="file_id" value="<?php echo $rowes['unique_image_id']; ?>">
			          <input type="hidden" name="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
			          <input type="hidden" name="coins" value="<?php echo $rowes["coins"]; ?>">

			          <input type="hidden" name="file_type" value="<?php echo $rowes['file_type']; ?>">
			          <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
			          <input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>">
			          <input type="hidden" name="model" value="<?php echo $_GET['model']; ?>">

			          <img alt="models" style="filter: blur(10px);" class="post_img" src= "<?php echo $rowes["file"]; ?>">
			          <div class="main-uper-div-img">
			            <i class="fa fa-image icn-img" ></i>
			            <button class="mybtn"  type="submit" name="submit">
			              <i class="fas fa-coins coin_icon" aria-hidden="true"></i>&nbsp;<?php echo $rowes["coins"]; ?>
			            </button>
			          </div>
			        </form>
			      </div>
	            <!-- <div class="paid_img_main_idv" >
	              <img class="paid_post_img" style="filter: blur(8px);-webkit-filter: blur(8px);" src="<?php //echo $rowes['file']; ?>" >  
	            </div> -->
            <?php }?>
        <?php }else{ ?>
        	<?php if($stat == "Purchased"){ ?>
        		<video class="vid_tg" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>" poster="assets/images/unnamed.jpg">
	                <source src="<?php echo $rowes['file']; ?>" type="video/mp4">
	            </video>
        	<?php }else{ ?>
              <div class="mn-dv-vdo">
		        <form method="post" action="file-process.php">
		          <input type="hidden" name="file_id" value="<?php echo $rowes['unique_image_id']; ?>">
		          <input type="hidden" name="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">

		          <input type="hidden" name="file_type" value="<?php echo $rowes['file_type']; ?>">
		          <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
		          <input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>">
		          <input type="hidden" name="model" value="<?php echo $_GET['model']; ?>">

		      			<video class="paid-video vid_tg" controls poster="assets/images/unnamed.jpg"> 
		      				<source src="../<?php echo $rowes["file"]; ?>" type="video/mp4"> 
		      			</video>
		      			<div class="main-uper-div-vdo">
		      				<i class="fa fa-video icn-vdo" ></i>
		      				<button class="mybtn" type="submit" name="submit" >
		      					<i class="fas fa-coins coin_icon" aria-hidden="true"></i>&nbsp;<?php echo $rowes["coins"]; ?>
		      				</button>
		      			</div>
		        </form>
		      </div>
            <?php } ?>
            <?php } ?>
            <p class="img_desc"><?php echo $rowes['image_text']; ?></p>
          	</div>
          	<!-- Modal -->
			<div id="myModal<?php echo $count; ?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <div class="modal-content" style="border-radius: 20px;">
			      <div class="modal-body">
			      	<button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
			        <div class="row">
			          <div class="col-md-6"><img alt="models" class="full_img" src="<?php echo $rowes['file']; ?>" alt=""></div>
			          <div class="col-md-6">
			            <div class="usern model-prof">
			              <a title="" href="single.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>" >
			                <figure class="user_profile">
			                  <img alt="models" class="profil_img" src="<?php echo $rowesdw['photo_2'] ?>">
			                </figure>
			                <span>
			                  <a title="" href="#" style="background: unset;"><?php echo $rowesdw['username']; ?></a>
			                </span>
			              </a>      
			            </div>
			            <hr>
			            <p><?php echo $rowes['image_text'] ?></p>
			          </div>
			        </div>
			      </div>
			    </div>

			  </div>
			</div>
		<?php } ?>
          <?php
              $count++;
              }
            } else {
              echo "0 results";
            }
          ?>
        </div>
    </div>
    <?php
      } else {
        echo "No Record Found";
      }
    ?>

		<div id="myModal_v_all" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content" style="border-radius: 20px;">
		    	
		      <div class="modal-body">
            <button type="button" class="close close_stle" data-dismiss="modal">&times;</button>
		          <p class="tab_head">Profile: </p>
		          <?php
				    		$sql_d = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET['m_unique_id']."'";
		            $result_d = mysqli_query($con, $sql_d);
		            if (mysqli_num_rows($result_d) > 0) {
		              $row_d = mysqli_fetch_assoc($result_d);
		             
				    	?>
		          <table class="table">
		          	<tr>
		          		<td>Avaialble for Live cam?</td>
		          		<td><?php echo $row_d['live_cam']; ?></td>
		          	</tr>
		          	<tr>
		          		<td>Avaialble for Group Show?</td>
		          		<td><?php echo $row_d['group_show']; ?></td>
		          	</tr>
                <?php if($row_d['group_show'] == 'Yes'){ ?>
                <tr>
                  <td>Weight</td>
                  <td><?php echo $row_d['gs_min_member']; ?></td>
                </tr>
                <tr>
                  <td>Eyes</td>
                  <td><?php echo $row_d['gs_token_price']; ?></td>
                </tr>
                <?php }?> 

                <tr>
                  <td>Avaialble as a Escort?</td>
                  <td><?php echo $row_d['work_escort']; ?></td>
                </tr>
                <?php if($row_d['work_escort'] == 'Yes'){ ?>
                <tr>
                  <td>2 Hour</td>
                  <td><?php echo $row_d['ws_2hour']; ?></td>
                </tr>
                <tr>
                  <td>4 Hour</td>
                  <td><?php echo $row_d['ws_4hour']; ?></td>
                </tr>
                <tr>
                  <td>Overnight</td>
                  <td><?php echo $row_d['ws_overnight']; ?></td>
                </tr>
                <?php }?> 

                <tr>
                  <td>Avaialble for International Tours?</td>
                  <td><?php echo $row_d['International_tours']; ?></td>
                </tr>
                <?php if($row_d['International_tours'] == 'Yes'){ ?>
                <tr>
                  <td>2 Hour</td>
                  <td><?php echo $row_d['two_hour_rates']; ?></td>
                </tr>
                <tr>
                  <td>4 Hour</td>
                  <td><?php echo $row_d['four_hour_rates']; ?></td>
                </tr>
                <tr>
                  <td>Overnight</td>
                  <td><?php echo $row_d['nght_rates']; ?></td>
                </tr>
                <?php }?> 

		          	<tr>
		          		<td>Selling Video's & Picture's</td>
		          		<td><?php echo $row_d['video_pictures']; ?></td>
		          	</tr>
                <tr>
                  <td>Avaialble for Modeling Porn Assignment's?</td>
                  <td><?php echo $row_d['modeling_porn_assignment']; ?></td>
                </tr>
                <?php if($row_d['modeling_porn_assignment'] == 'Yes'){ ?>
                <tr>
                  <td>Per Hour price for shoot</td>
                  <td><?php echo $row_d['shoot_per_hour_price']; ?></td>
                </tr>
                
                <?php }?>
		          	<?php }else{ ?>
                <p style="padding-left: 20px;">No Details Found.</p>
              <?php } ?>
		          </table>

		      </div>
		    	
		    </div>
		  </div>
		</div>


    <?php include('includes/footer.php'); ?> 
    <script>
		$(document).ready(function(){
			$(".angle_dwn").show();
			$(".angle_up").hide();
			$("#mol-des").hide();
			$(".angle_dwn").click(function(){
			    $(".angle_up").show();
			    $(".angle_dwn").hide();
			    $("#mol-des").show();
			});
			$(".angle_up").click(function(){
			    $(".angle_dwn").show();
			    $(".angle_up").hide();
			    $("#mol-des").hide();
			});
		});
	</script>

<script>
$(function() {
    $( ".i_inverse" ).click(function() {
      $( ".i_inverse,.s_inverse" ).toggleClass( "press", 1000 );
      var model_id = $('#model_id').val();
      var user_id = $('#user_id').val();

      if(model_id!="" && user_id!=""){
        $.ajax({
          url: "unfollow_model.php",
          type: "POST",
          data: {
            model_id: model_id,
            user_id: user_id        
          },
          cache: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==2000){
              //$("#btn-inverse").removeAttr("disabled");
              //$('#fupForm').find('input:text').val('');
              //$("#success").show();
              //$('#success').html('Model Unfollow successfully !'); 
              location.reload();           
              $("#flow").show();
              $("#unflow").hide();
            }
            else if(dataResult.statusCode==2001){
               alert("Error occured !");
            }
          }
        });
      }
      else{
        alert('Please fill all the field !');
      }
    });
    $( ".i_main" ).click(function() {
      $( ".i_main,.s_main" ).toggleClass( "press", 1000 );

      $("#i_main").css('color','#e54720');
      var model_id = $('#model_id').val();
      var user_id = $('#user_id').val();

      if(model_id!="" && user_id!=""){
        $.ajax({
          url: "follow_model.php",
          type: "POST",
          data: {
            model_id: model_id,
            user_id: user_id        
          },
          cache: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
              //$("#btn").removeAttr("disabled");
              //$('#fupForm').find('input:text').val('');
              //$("#success").show();
              //$('#success').html('Model Follow successfully !');  
              location.reload();
              $("#flow").hide();
              $("#unflow").show();          
            }
            else if(dataResult.statusCode==201){
               alert("Error occured !");
            }
          }
        });
      }
      else{
        alert('Please fill all the field !');
      }
    });
});

</script>  

  </body>
</html>
