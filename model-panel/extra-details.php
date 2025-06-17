<?php 
  session_start(); 
  include('../includes/config.php');
?>
<?php 
    $usern = $_SESSION["log_user"];
    
    if( !$usern ){
        echo '<script>window.location.href="../login.php"</script>';
    }
?>
<!doctype html>
<html>
<meta>
<head>
<!-- <meta charset="utf-8"> -->
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
<title>Booking</title>
<!-- <meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320"> -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="../assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="../assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

<!-- <meta name="msapplication-TileColor" content="#f01d4f"> -->
<meta name="msapplication-TileImage" content="../assets/wp-content/themes/theagency3/library/images/win8-tile-icon.png">
<link rel="pingback" href="../xmlrpc.php">

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
  <link rel='stylesheet' id='wp-block-library-css' href='../assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css' href='../assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='../assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='visual-form-builder-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='vfb-jqueryui-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/smoothness/jquery-ui-1.10.3.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='https://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='../assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='../assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='../assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='../assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='../assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>



<style type="text/css">
select{
  padding: 6px 50px;
  margin-top: 20px;
  margin-bottom: 20px;
}
input{
  margin-top: 20px;
  margin-bottom: 20px; 
}
@media only screen and (max-width: 600px) {
  .form_table{
    width: 80% !important;
    margin: auto !important;
  }
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

        $('#group_show').on('change', function() {
          // alert(this.value);
          if (this.value == 'Yes') {
            $("#min_member").show();
            $("#t_price_mem").show();
          }else if (this.value == 'No'){
            $("#min_member").hide();
            $("#t_price_mem").hide();
          }else{
            $("#min_member").hide();
            $("#t_price_mem").hide();
          }
        });

        
        $('#es_work').on('change', function() {
          // alert(this.value);
          if (this.value == 'Yes') {
            $("#in_per_hour").show();
            $("#in_overnight").show();
            $("#out_per_hour").show();
            $("#out_overnight").show();
          }else if (this.value == 'No'){
            $("#in_per_hour").hide();
            $("#in_overnight").hide();
            $("#out_per_hour").hide();
            $("#out_overnight").hide();
          }else{
            $("#in_per_hour").hide();
            $("#in_overnight").hide();
            $("#out_per_hour").hide();
            $("#out_overnight").hide();
          }
        });


        $('#inter_tour').on('change', function() {
          //alert( this.value );
          if (this.value == 'Yes') {
            $("#hours2").show();
            $("#hours4").show();
            $("#overnight").show();
          }else if (this.value == 'No'){
            $("#hours2").hide();
            $("#hours4").hide();
            $("#overnight").hide();
          }else{
            $("#hours2").hide();
            $("#hours4").hide();
            $("#overnight").hide();
          }
        });

        $('#modeling_porn_assignment').on('change', function() {
         // alert( this.value );
          if (this.value == 'Yes') {
            $("#perhourshoot").show();
          }else if (this.value == 'No'){
            $("#perhourshoot").hide();
          }else{
            $("#perhourshoot").hide();
          }
        });
        $('#live_cam').on('change', function() {
         alert( this.value );
        });
        
      </script>
  </head>

<body class="page-template-default page page-id-311 custom-background">
<?php include('../includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
         
         <?php //include('../model-panel/sidebar.php'); ?>
          <!-- <div id="main" class="col-md-8 clearfix" role="main">
Welcome <?php //echo $_SESSION["log_user"]; ?>,
          </div> -->

              <div class="headline-outer col-md-12 col-xs-12 col-sm-12 clearfix">
                <h4 class="page-title entry-title" itemprop="headline">
                  <div class="prefancy fancy"><span>Update Details</span></div>
                </h4>
              </div>
              <span id="state"></span>    
              <?php
                $sql1 = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                  $rowes1 = mysqli_fetch_assoc($result1);
                  // echo '<pre>';
                  // print_r($rowes1);
                  // echo '</pre>';
                
      
              ?>
              <form action="update-extra-details.php" method="post" enctype="multipart/form-data" class="rr_review_form" >
                <input type="hidden" name="model_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">

                <table class="form_table" style="text-align: center;width: 65%;">
                  <tr>
                    <td>
                      Live Cam:    
                    </td>
                    <td>     
                      <select name="live_cam" required="required" id="live_cam">
                        <option>Select</option>
                        <?php if($rowes1['live_cam'] == 'Yes'){ ?>
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                        <?php }elseif($rowes1['live_cam'] == 'No'){ ?>
                          <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php }else{ ?>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Group show: 
                    </td>
                    <td>  
                      <select name="group_show" required="required" id="group_show">
                        <option>Select</option>
                        <?php if($rowes1['group_show'] == 'Yes'){ ?>
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                        <?php }elseif($rowes1['group_show'] == 'No'){ ?>
                        <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php }else{ ?>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <?php if($rowes1['group_show'] == 'Yes'){ ?>
                  <tr id="min_member">
                    <td>
                      Min members: 
                    </td>
                    <td>  
                      <input type="text" name="min_member" value="<?php echo $rowes1['gs_min_member']; ?>">
                    </td>
                  </tr>
                  <tr id="t_price_mem">
                    <td>
                      Token Price per member: 
                    </td>
                    <td>  
                      <input type="text" name="t_price_member" value="<?php echo $rowes1['gs_token_price']; ?>">
                    </td>
                  </tr>
                  <?php } ?>
                  

                  <tr>
                    <td>Work as a Escorts: </td>
                    <td>    
                      <select name="es_work" required="required" id="es_work">
                        <option>Select</option>
                        <?php if($rowes1['work_escort'] == 'Yes'){ ?>
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                        <?php }elseif($rowes1['work_escort'] == 'No'){ ?>
                          <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php }else{ ?>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <?php if($rowes1['work_escort'] == 'Yes'){ ?>
                  	<!-- Incall: -->
                  <tr id="in_per_hour">
                    <td>Incall per Hours Rates (In $)</td>
                    <td>  
                      <input type="text" name="ws_2hour" value="<?php echo $rowes1['in_per_hour']; ?>">
                    </td>
                  </tr>
                  <tr id="in_overnight">
                    <td>Incall Overnight Rates (In $)</td>
                     <td>  
                      <input type="text" name="ws_4hour" value="<?php echo $rowes1['in_overnight']; ?>">
                    </td>
                  </tr>
                  <!-- Outcall: -->
                  <tr id="out_per_hour">
                    <td>Outcall per Hours Rates (In $)</td>
                     <td>  
                      <input type="text" name="ws_4hour" value="<?php echo $rowes1['out_per_hour']; ?>">
                    </td>
                  </tr>
                  <tr id="out_overnight">
                    <td>Outcall Overnight Rates (In $)</td>
                     <td>  
                      <input type="text" name="ws_overnight" value="<?php echo $rowes1['out_overnight']; ?>">
                    </td>
                  </tr>
                  <?php } ?>



                  <tr>
                    <td>Accept International tours: </td>
                    <td>    
                      <select name="inter_tour" required="required" id="inter_tour">
                        <option>Select</option>
                        <?php if($rowes1['International_tours'] == 'Yes'){ ?>
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                        <?php }elseif($rowes1['International_tours'] == 'No'){ ?>
                          <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php }else{ ?>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <?php if($rowes1['International_tours'] == 'Yes'){ ?>
                  <tr id="hours2">
                    <td>2 Hours Rates (In $)</td>
                    <td>  
                      <input type="text" name="to_hour" value="<?php echo $rowes1['two_hour_rates']; ?>">
                    </td>
                  </tr>
                  <tr id="hours4">
                    <td>4 Hours Rates (In $)</td>
                     <td>  
                      <input type="text" name="for_hour" value="<?php echo $rowes1['four_hour_rates']; ?>">
                    </td>
                  </tr>
                  <tr id="overnight">
                    <td>Overnight Rates (In $)</td>
                     <td>  
                      <input type="text" name="overnight" value="<?php echo $rowes1['nght_rates']; ?>">
                    </td>
                  </tr>
                  <?php } ?>

                  <tr>
                    <td>
                      Sell Video and Image's:    
                    </td>
                    <td>     
                      <select name="video_pictures" required="required" id="video_pictures">
                        <option>Select</option>
                        <?php if($rowes1['video_pictures'] == 'Yes'){ ?>
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                        <?php }elseif($rowes1['video_pictures'] == 'No'){ ?>
                          <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php }else{ ?>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>


                  <tr>
                    <td>Accept Modeling/ Porn assignment?</td>
                     <td>   
                      <select name="modeling_porn_assignment" required="required" id="modeling_porn_assignment">
                        <?php if($rowes1['modeling_porn_assignment'] == 'Yes'){ ?>
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                        <?php }elseif($rowes1['modeling_porn_assignment'] == 'No'){ ?>
                          <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php }else{ ?>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <?php if($rowes1['modeling_porn_assignment'] == 'Yes'){ ?>
                  <tr id="perhourshoot">
                    <td>Per hour price of shoot? (In $)</td>
                     <td>   
                      <input type="text" name="perhourshoot" value="<?php echo $rowes1['shoot_per_hour_price']; ?>">
                    </td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td class="rr_form_input"><input id="submitReview" name="submitButton" type="submit" value="Submit"/></td>
                  </tr>
                </table>
              </form>
              <?php } ?>
        </div> <!-- end #content -->

      </div> <!-- end .container -->
      
      <?php include('../includes/footer.php'); ?>
  </body>


</html> 
