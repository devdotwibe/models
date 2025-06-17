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

if($_SESSION["log_user_unique_id"] == $_GET['m_id']){
	echo '<script>alert("Oops!! You cant book your own services. Please use another model to book service.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}
$pro_path = $userDetails['profile_pic'];

$m_id = $_GET["m_id"];
if(!$m_id){
	echo '<script>window.history.back();</script>';
	die;
}

$model_data = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id =  %s ", $m_id);
if(!$model_data){
	echo '<script>window.history.back();</script>';
	die;
}

$model_extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id =  %s ", $model_data['unique_id']);
if(!$model_extra_details){
	echo '<script>alert("Model has no service to booking.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}

if($model_extra_details['International_tours']!='Yes'){
	echo '<script>alert("Model has no service to booking.")</script>';
	echo '<script>window.history.back();</script>';
	die;
}

$country_list = array();
if($model_extra_details['i_t_country']){
	$country_list = DB::query("SELECT * FROM countries WHERE id in(".$model_extra_details['i_t_country'].")");
}
$pro_path1 = $model_data['profile_pic'];
$model_city= $model_data['city'];
$profile_name = $model_data['name'];
//printR($model_extra_details);

?>
<html lang="en-US" class="no-js">
<!doctype html>
<html lang="en-US" class="no-js">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
<?php include('header.php');?>
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
                  <div class="prefancy fancy"><span>Booking for International Tour</span></div>
                </h1>
              </div>
            </header>
            <section class="page-content entry-content clearfix" itemprop="articleBody">
              <div class="artivle-body-bg">
                <center><p>Once you have submit request your coins will be deducted from your account.</p></center>
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
<div style="text-center"><img style="height: 20px;" src="https://thelivemodels.com/assets/images/two-way-arrow.gif" ></div>
<div style="text-align: center;min-width:40%">  <img style="height:50px; width:50px;border-radius: 50%; margin-top: 40px;" src="https://thelivemodels.com/<?php echo $pro_path1; ?>" >
<p style="text-align: center;color: white;"><?php echo $profile_name; ?></p> </div>
</div>
                    
                 </div>
                 <div class="col-sm-4"></div>
                </div>
              </div>

              <center><hr>THE USER IS IN CITY <span style="font-weight: bold;font-size: 20px;    text-transform: capitalize;"><?php echo $_SESSION["city"] ?></span> AND THE MODEL IS IN CITY <span style="font-weight: bold;font-size: 20px;    text-transform: capitalize;"><?php echo $model_city ?></span><hr></center>
                <!-- <center>
                  <div>
                    <img style="height: 50px;border-radius: 50%;float: left;" src="https://thelivemodels.com/<?php echo $pro_path; ?>">
                    <p class="prof_text"><?php echo $_SESSION["log_user"]; ?></p>
                  </div>
                  <img src="https://thelivemodels.com/assets/images/two-way-arrow.gif">
                  <div>
                    <img style="height: 50px;border-radius: 50%;float: left;" src="https://thelivemodels.com/<?php echo $pro_path1; ?>">
                    <p class="prof_text"><?php echo $profile_name; ?></p>
                  </div>
                </center>
 -->                <div id="vfb-form-1" class="visual-form-builder-container">
                  <form class="visual-form-builder vfb-form-1" action="act-international-tour.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="form_id" value="1" />
<input type="hidden" name="model_id" value="<?php echo $_GET['m_id']; ?>" readonly>
                        
                    <fieldset class="vfb-fieldset vfb-fieldset-1 your-contact-details" id="item-vfb-1">
                      <div class="vfb-legend">
                        <h3>Your Contact Details</h3>
                      </div>
<div class="" style="padding:10px 15px ">
<div class="row">
<div class="col-md-3 mb-3">
<label>Booking Type</label>
<select name="booking_type" class="form-control" required>
<option value="">Select</option>
<option value="Day">Day</option>
<option value="Week">Week</option>
<option value="Month">Month</option>
<option value="Annual">Annual</option>
</select>
</div>

<div class="col-md-3 mb-3">
<label>Booking For</label>
<select name="book_for" class="form-control" required>
<option value="">Select</option>
<?php
for($i=1;$i<=12;$i++){
?>
<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
</select>
</div>


<div class="col-md-3 mb-3">
<label>Country</label>
<select name="country" class="form-control" required>
<option value="">Select</option>
<?php
if($country_list){
	foreach($country_list as $set_country){
?>
<option value="<?=$set_country['id']?>"><?=$set_country['name']?></option>
<?php
	}
}
?>
</select>
</div>

</div>
</div>                      
                      &nbsp;
                    </fieldset>
                    <fieldset class="vfb-fieldset vfb-fieldset-3 locations" id="item-vfb-14">
                      <div class="vfb-legend">
                        <h3>Instructions</h3>
                      </div>
                      <ul class="vfb-section vfb-section-3">
                        <li class="vfb-item vfb-item-textarea" id="item-vfb-16">
                          <label for="vfb-16" class="vfb-desc">Special Instructions, or notes (optional) </label>
                          <div><textarea name="instructions" id="vfb-16" class="vfb-textarea vfb-medium"></textarea></div>
                        </li>
                      </ul>
                      &nbsp;
                    </fieldset>
                    <fieldset class="vfb-fieldset vfb-fieldset-2 appointment" id="item-vfb-9">
                      <div class="vfb-legend">
                        <h3>When do you want to see me? </h3>
                      </div>
<div class="" style="padding:10px 15px ">
<div class="row">
<div class="col-md-3 mb-3">
	<label >Date</label>
	<input type="date" name="meeting_date" id="vfb-12" value="" class="form-control" required/>
</div>
<div class="col-md-3 mb-3">
	<label >Time</label>
                          <span class="vfb-time">
                            <select name="meeting_time_hour" id="vfb-13-hour" class="form-control" required>
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
                            <select name="meeting_time_min" id="vfb-13-min" class="form-control" required>
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
                            <select name="ampm" id="vfb-13-ampm" class="form-control" required>
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                            </select>
                            <label for="vfb-13-ampm">AM/PM</label>
                          </span>
                          <div class="clear"></div>
</div>
</div>
</div>                      
                      
                      &nbsp;
                    </fieldset>
                    <input type="submit" name="submit" id="vfb-4" value="Let's Meet" class="vfb-submit " />
                    </li></ul>
                    </fieldset>
                  </form>
                </div>
              </div>
            </section>
            <footer>
            </footer>
          </article>
        </div>
      </div>
    </div>
    <?php include('../includes/footer.php'); ?>
  </body>
</html>