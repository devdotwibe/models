<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
		echo "<script>window.location='".SITEURL."/login.php';</script>";
		die;
	}
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."/login.php';</script>";
	die;
}
$pro_path = $userDetails['profile_pic'];


if($_SESSION["log_user_unique_id"] == $_GET['m_id']){
  echo '<script>alert("Oops!! You cant book your own services. Please use another model to book service.")</script>';
  echo '<script>window.history.back();</script>';
}
$m_id = $_GET['m_id'];
$model_data = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id =  %s ", $m_id);
if(!$model_data){
	echo '<script>window.history.back();</script>';
	die;
}
$pro_path1 = $model_data['profile_pic'];
$profile_name = $model_data['name'];


$model_extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id =  %s ", $model_data['unique_id']);
if(!$model_extra_details){
	echo '<script>alert("Model has no service to booking.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}

if($model_extra_details['group_show']!='Yes'){
	echo '<script>alert("Model has no service to booking.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}
$bookingSlot = DB::query("SELECT * FROM model_user_group_show WHERE user_id =  %s and date(dates)>='".date('Y-m-d')."'", $model_data['id']);
?>
<html lang="en-US" class="no-js">
<!doctype html>
<html lang="en-US" class="no-js">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Booking | Your Agency Name</title>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
    <link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
    <link href='http://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'?>"></script>
    <script src="<?='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'?>"></script>
    <script src="<?='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'?>"></script>
    <meta name="msapplication-TileColor" content="#f01d4f">
    <meta name="msapplication-TileImage" content="assets/wp-content/themes/theagency3/library/images/win8-tile-icon.png">
    <link rel="pingback" href="../xmlrpc.php">
   
    <link rel='stylesheet' id='wp-block-library-css'  href='<?='../assets/wp-includes/css/dist/block-library/style.min.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='spiffycal-styles-css'  href='<?='../assets/wp-content/plugins/spiffy-calendar/styles/default.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='dashicons-css'  href='<?='../assets/wp-includes/css/dashicons.min.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='visual-form-builder-css-css'  href='<?='../assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='vfb-jqueryui-css-css'  href='<?='../assets/wp-content/plugins/visual-form-builder/public/assets/css/smoothness/jquery-ui-1.10.3.min.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/css/style.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='<?='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='options_typography_Rokkitt-css'  href='<?='http://fonts.googleapis.com/css?family=Rokkitt'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='rich-reviews-css'  href='<?='../assets/wp-content/plugins/rich-reviews/css/rich-reviews.css'?>' type='text/css' media='all' />
    <link rel='stylesheet' id='bones-stylesheet-css'  href='<?='../assets/wp-content/themes/theagency3/library/css/style.css'?>' type='text/css' media='all' />
    <script type='text/javascript' src='<?='../assets/wp-includes/js/jquery/jquery.js'?>' id='jquery-core-js'></script>
    <script type='text/javascript' src='<?='../assets/wp-content/plugins/rich-reviews/js/rich-reviews.js'?>' id='rich-reviews-js'></script>
    <script type='text/javascript' src='<?='../assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js'?>' id='bones-modernizr-js'></script>
    
    <link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
<style>
@media only screen and (max-width: 768px) {
	.visual-form-builder li.vfb-left-half, .visual-form-builder li.vfb-right-half{
		width:100% !important;
	}
}
.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"]{
  margin-left: 0;
}
.fab, .far{
  font-weight: 900;
}
</style>    

  </head>
  <body class="page-template-default page page-id-311 custom-background">
    <?php include('../includes/header.php'); ?>
    <div class="container-fluid">
      <div id="content" class="clearfix row">
        <div id="main" class="col-md-12 clearfix" role="main">
          <article id="post-311" class="clearfix post-311 page type-page status-publish hentry" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            <header class="page-head article-header">
              <div class="headline-outer">
                <h1 itemprop="headline" class="page-title entry-title">
                  <div class="prefancy fancy"><span>Group Show Booking</span></div>
                </h1>
              </div>
            </header>
            <!-- end article header -->
            <section class="page-content entry-content clearfix" itemprop="articleBody">
              <div class="artivle-body-bg">
              <div class="text-center"><p>Group shows enables you to watch live shows in groups of people . You will be notified of the next live show via notifications and email. Do you want to jointhe Group show?</p></div>
                <p class="text-center">Once you have submit request your coins will be deducted from your account.</p>
                <div class="container-fluid" >
                 <div class="row" style="margin-left:0px;margin-right:0px;"> 
                  <div class="col-sm-4"></div>
                   <div class="col-sm-4  ">

                    <div style="display: flex;align-items: center;justify-content: center;">
                      <div style="text-align: center;min-width:40%">
                        <img style="height:50px; width:50px; border-radius: 50%; margin-top: 40px;"
                         src="https://thelivemodels.com/<?php echo $pro_path; ?>" > 
                        <p style="text-align: center;color: white;"><?php echo $_SESSION["log_user"]; ?></p>
                      </div>
                   <div style=""><img style="height: 20px;" src="https://thelivemodels.com/assets/images/two-way-arrow.gif" ></div>
                  <div style="text-align: center;min-width:40%">  <img style="height:50px; width:50px;border-radius: 50%; margin-top: 40px;" src="https://thelivemodels.com/<?php echo $pro_path1; ?>" >
                  <p style="text-align: center;color: white;"><?php echo $profile_name; ?></p> </div>
                   </div>
                 </div>
                 <div class="col-sm-4"></div>
                </div>
              </div>

                <div id="vfb-form-1" class="visual-form-builder-container">
                  <form id="booking-1" class="visual-form-builder vfb-form-1" action="act-group-show.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="form_id" value="1" />
                    <fieldset class="vfb-fieldset vfb-fieldset-1 your-contact-details" id="item-vfb-1">
                      <div class="vfb-legend">
                        <h4>Your Contact Details</h4>
                      </div>
                      <ul class="vfb-section vfb-section-1">
                        <input type="hidden" name="user_unique_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
                        <li class="vfb-item vfb-item-email vfb-left-half" id="item-vfb-7">
                          <label for="vfb-7" class="vfb-desc">Total members in group? <span class="vfb-required-asterisk">*</span></label>
                          <input type="number" name="total_mem" id="vfb-7" value="1" min="1" class="vfb-text vfb-medium required email"  required/>
                        </li>
                      </ul>
                      &nbsp;
                    <!-- </fieldset> -->
                    <!-- <fieldset class="vfb-fieldset vfb-fieldset-2 appointment" id="item-vfb-9"> -->
                      <div class="vfb-legend">
                        <h4>When do you want to see me. </h4>
                      </div>
                      <ul class="vfb-section vfb-section-2">

<?php
if($bookingSlot){
  foreach($bookingSlot as $set_booking){
?>
<li class="vfb-item vfb-item-text vfb-left-half" >  
<div class="radio">
<label style="margin-bottom: 0"><input type="radio" name="bookingslot" value='<?=json_encode($set_booking)?>'
onclick="selectBooking('selected')"  required>
<?=h_dateFormat($set_booking['dates'],'d-m-Y').' '.$set_booking['times'] .' / <i class="far fa-coins" ></i> '.$set_booking['amount'].' per member';

?></label>
</div>  
</li>
<?php
  }
}
?>
<li class="vfb-item vfb-item-text vfb-left-half" >  
<div class="radio">
<label style="margin-bottom: 0"><input type="radio" name="bookingslot" value="new" onclick="selectBooking('new')" required> Own time</label>
</div>  
</li>

                        <input type="hidden" name="model_id" value="<?php echo $_GET['m_id']; ?>" readonly>
                        <input type="hidden" name="model_name" value="<?php echo $_GET['model']; ?>" readonly>
                        
                        <li class="vfb-item vfb-item-text vfb-left-half own-time-fields" id="item-vfb-11">
                          <label for="vfb-11" class="vfb-desc">Duration (for how long?) <span class="vfb-required-asterisk">*</span></label>
                          <select name="duration" id="vfb-11" class="vfb-select vfb-medium required">
                            <option value="15 Min">15 Min</option>
                            <option value="30 Min">30 Min</option>
                            <option value="45 Min">45 Min</option>
                            <option value="60 Min">60 Min</option>
                            <option value="120 Min">120 Min</option>
                            <option value="120 Min +">120 Min +</option>
                          </select>
                          <!-- <input type="text" name="duration" id="vfb-11" value="" class="vfb-text vfb-medium required" /> -->
                        </li>
                        <li class="vfb-item vfb-item-date vfb-left-half own-time-fields" id="item-vfb-12">
                          <label for="vfb-12" class="vfb-desc">Date <span class="vfb-required-asterisk">*</span></label>
                          <input type="date" name="meeting_date" id="vfb-12" class="vfb-text vfb-date-picker vfb-medium required" />
                        </li>
                        <li class="vfb-item vfb-item-time vfb-right-half own-time-fields" id="item-vfb-13">
                          <label class="vfb-desc">Time <span class="vfb-required-asterisk">*</span></label>
                          <span class="vfb-time">
                            <select name="meeting_time_hour" id="vfb-13-hour" class="vfb-select required">
                              <option value="01">01</option>
                              <option value="02">02</option>
                              <option value="03">03</option>
                              <option value="04">04</option>
                              <option value="05">05</option>
                              <option value="06">06</option>
                              <option value="07">07</option>
                              <option value="08">08</option>
                              <option value="09">09</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                            <label for="vfb-13-hour">HH</label>
                          </span>
                          <span class="vfb-time">
                            <select name="meeting_time_min" id="vfb-13-min" class="vfb-select required">
                              <option value="00">00</option>
                              <option value="05">05</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                              <option value="30">30</option>
                              <option value="35">35</option>
                              <option value="40">40</option>
                              <option value="45">45</option>
                              <option value="50">50</option>
                              <option value="55">55</option>
                            </select>
                            <label for="vfb-13-min">MM</label>
                          </span>
                          <span class="vfb-time">
                            <select name="ampm" id="vfb-13-ampm" class="vfb-select required">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                            </select>
                            <label for="vfb-13-ampm">AM/PM</label>
                          </span>
                          <div class="clear"></div>
                        </li>
                      </ul>
                      &nbsp;
                    
                      <ul>
                        <li class="vfb-item vfb-item-textarea" id="item-vfb-16">
                          <label for="vfb-16" class="vfb-desc">Special Instructions, or notes (optional) </label>
                          <div><textarea name="instructions" id="vfb-16" class="vfb-textarea vfb-medium"></textarea></div>
                        </li>
                      </ul>
                      &nbsp;
                    </fieldset>
                    <input type="submit" name="submit" id="vfb-4" value="Let's Meet" class="vfb-submit " />
                    <!-- </li></ul> -->
                    <!-- </fieldset> -->
                  </form>
                </div>
                <!-- .visual-form-builder-container -->
              </div>
            </section>
            <footer>
            </footer>
          </article>
        </div>
      </div>
    </div>
    <?php include('../includes/footer.php'); ?>
<script>
function selectBooking(type){
  if(type=='new'){
    $('.own-time-fields').show();
    $('.own-time-fields .required').attr('required',true);
  }
  else{
    $('.own-time-fields').hide();
    $('.own-time-fields .required').attr('required',false);

  }
}
selectBooking('');
</script>    
  </body>
</html>