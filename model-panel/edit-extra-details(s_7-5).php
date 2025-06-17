<?php
session_start();
?>
<html lang="en-US" class="no-js">
<?php 
    session_start(); 
    $usern = $_SESSION["log_user"];
    
    if( !$usern ){
        echo '<script>window.location.href="../login.php"</script>';
    }
?>
<?php include('../includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Extra Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel='stylesheet' href='../assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
	<link rel="icon" href="../assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
	<script type='text/javascript' src='../assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style type="text/css">
		.my_form{
			width: 60%;
			margin: 0px auto 0px auto;
			padding: 20px 0 20px 0;
		}
		label
		{
			color: #ffffff;
		}
		 .login-signup {
  padding: 0 0 25px;
}

		.nav-tab-holder {
  padding: 0 0 0 30px;
  float: right;
}

.nav-tab-holder .nav-tabs {
  border: 0;
  float: none;
  display: table;
  table-layout: fixed;
 	width: 70%;
    margin: auto;
}

.nav-tab-holder .nav-tabs > li {
  margin-bottom: -3px;
  text-align: center;
  padding: 0;
  display: table-cell;
  float: none;
  padding: 0;
}

.nav-tab-holder .nav-tabs > li > a {
  background: #d9d9d9;
  color: #6c6c6c;
  margin: 0;
  font-size: 18px;
  font-weight: 300;
}

.nav-tab-holder .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  color: #FFF;
  background-color: #c9381b;
  border: 0;
  border-radius: 0;
}

.mobile-pull {
  float: right;
}

		@media screen and (max-width: 600px) {
		    .my_form{
				width: 80% !important;
				margin: auto;
			}
			.nav-tab-holder .nav-tabs
			{
				width: 100% !important;
			}
		}
	</style>
</head>
<body>
	<?php include('../includes/header.php'); ?>
	<div class="login-signup" style="background-color: #16161e;">
		 <div class="row">
        <div class="col-md-12 nav-tab-holder">
        <ul class="nav nav-tabs row" role="tablist">
          <li role="presentation" class="active col-sm-6"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Service</a></li>
          <li role="presentation" class="col-sm-6"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">About</a></li>
        </ul>
      </div>

      </div>
      <div class="tab-content">
		<div  role="tabpanel" class=" my_form tab-pane active" id="home">
		<form method="post" action="update-extra-details.php">
			<?php
			$International_tours = "";
			$live_cam = "";
			$group_show = "";
			$es_work = "";
			$modeling_porn_assignment = "";

                $sql1 = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                  $rowes1 = mysqli_fetch_assoc($result1);
                  // echo '<pre>';
                  // print_r($rowes1);
                  // echo '</pre>';
                  // $my_va = $rowes1['International_tours'];

                }       
            ?>
            <h3> Live Cam:</h3>
		  <div class="form-group">
		    <label for="exampleInputEmail1"><!-- Live Cam: --></label>
		    <select class="form-control" name="live_cam" id="live_cam">
		    	<option>Select Option</option>
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
		  </div>
		  <!-- <input type="checkbox" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"> -->
		  <?php //if($rowes1['live_cam'] == 'Yes'){ ?>
		  	<?php $live_cam = $rowes1['live_cam']; ?>
		  <div class="row" id="live_cam_details">
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Instagram Profile URL:</label>
			    <input type="text" class="form-control" name="insta_p_url" value="<?php echo $rowes1['insta_p_url']; ?>" placeholder="Instagram Profile URL">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Tokens:</label>
			    <input type="text" class="form-control" name="insta_tokens" value="<?php echo $rowes1['insta_tokens']; ?>" placeholder="Tokens">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Snapchat Profile URL:</label>
			    <input type="text" class="form-control" name="snap_p_url" value="<?php echo $rowes1['snap_p_url']; ?>" placeholder="Snapchat Profile URL">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Tokens:</label>
			    <input type="text" class="form-control" name="snap_tokens" value="<?php echo $rowes1['snap_tokens']; ?>" placeholder="Tokens">
			  </div>
		  </div>
		  <div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
		  <?php //} ?>
		  <h3>Group show:</h3>
		  <div class="form-group">
		    <label for="exampleInputPassword1"><!-- Group show: --></label>
		    <select class="form-control" name="group_show" id="group_show">
		    	<option>Select Option</option>
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
		  </div>
		  <?php //if($rowes1['group_show'] == 'Yes'){ ?>
		  	<?php $group_show = $rowes1['group_show']; ?>
			  <div class="row" id="groupshow_details" >
				  <div class="form-group col-md-6">
				    <label for="exampleInputPassword1">Min members:</label>
				    <input type="text" name="min_member" value="<?php echo $rowes1['gs_min_member']; ?>" class="form-control" placeholder="Min members:">
				  </div>
				  <div class="form-group col-md-6">
				    <label for="exampleInputPassword1">Token Price per member:</label>
				    <input type="text" name="t_price_member" value="<?php echo $rowes1['gs_token_price']; ?>" class="form-control" placeholder="Token Price per member:">
				  </div>
			  </div>
			  <div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
		  <?php //} ?>
		  <h3>Dating assignments:</h3>
		  <div class="form-group">
		    <label for="exampleInputPassword1"><!-- Dating assignments: --></label>
		    <select class="form-control" name="es_work" id="escorts">
		    	<option>Select Option</option>
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
		  </div>
		  <?php //if($rowes1['work_escort'] == 'Yes'){ ?>
		  	<?php $es_work = $rowes1['work_escort']; ?>
		  <div class="row" id="escorts_details" >
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Incall per Hours Rates (In $):</label>
			    <input type="text" name="in_per_hour" value="<?php echo $rowes1['in_per_hour']; ?>" class="form-control" placeholder="Incall per Hours Rates (In $)">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Incall Overnight Rates (In $):</label>
			    <input type="text" name="in_overnight" value="<?php echo $rowes1['in_overnight']; ?>" class="form-control" placeholder="Incall Overnight Rates (In $)">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Outcall per Hours Rates (In $):</label>
			    <input type="text" name="out_per_hour" value="<?php echo $rowes1['out_per_hour']; ?>" class="form-control" placeholder="Outcall per Hours Rates (In $)">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Outcall Overnight Rates (In $):</label>
			    <input type="text" name="out_overnight" value="<?php echo $rowes1['out_overnight']; ?>" class="form-control" placeholder="Outcall Overnight Rates (In $)">
			  </div>
		  </div>
		  <div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
		  <?php //} ?>
		  <h3>Accept International tours:</h3>
		  <div class="form-group">
		    <label for="exampleInputPassword1"><!-- Accept International tours: --></label>
		    <select class="form-control" name="inter_tour" id="internation_tour">
		    	<option>Select Option</option>
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
		  </div>
		  <?php //if($rowes1['International_tours'] == 'Yes'){ ?>
		  	<?php $International_tours = $rowes1['International_tours'];?>
		  <div class="row" id="internation_tour_details">
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">2 Hour Rates (In $):</label>
			    <input type="text" name="to_hour" value="<?php echo $rowes1['two_hour_rates']; ?>" class="form-control" placeholder="Incall per Hours Rates (In $)">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">3 Hour Rates (In $):</label>
			    <input type="text" name="for_hour" value="<?php echo $rowes1['four_hour_rates']; ?>" class="form-control" placeholder="Incall Overnight Rates (In $)">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Overnight Rates (In $):</label>
			    <input type="text" name="overnight" value="<?php echo $rowes1['nght_rates']; ?>" class="form-control" placeholder="Outcall per Hours Rates (In $)">
			  </div>
		  </div>
		  <div style="width: 100%; border-bottom: 2px solid #c9381b;padding: 6px ; margin-bottom: 25px;"></div>
		  <?php //} ?>
		  <h3>Sell Video and Images:</h3>
		  <div class="form-group">
		    <label for="exampleInputPassword1"><!-- Sell Video and Image's: --></label>
		    <select class="form-control" name="video_pictures" id="sell_video_image">
		    	<option>Select Option</option>
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
		  </div>
		  <div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
        <h3>Accept Modeling/ Movie assignment</h3>
		  <div class="form-group">
		    <label for="exampleInputPassword1"><!-- Accept Modeling/ Movie assignment? --></label>
		    <select class="form-control" name="modeling_porn_assignment" id="modeling_porn">
		    	<option>Select Option</option>
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
		  </div>
		  <?php //if($rowes1['modeling_porn_assignment'] == 'Yes'){ ?>
		  	<?php $modeling_porn_assignment = $rowes1['modeling_porn_assignment']; ?>
		  <div class="row" id="modeling_porn_details">
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">Per hour price of shoot? (In $)</label>
			    <input type="text" name="perhourshoot" value="<?php echo $rowes1['shoot_per_hour_price']; ?>" class="form-control" placeholder="Per hour price of shoot? (In $)">
			  </div>
		  </div>
		  <div style="width: 100%;margin-bottom: 25px; border-bottom: 2px solid #c9381b;padding: 6px;"></div>
		  <?php //} ?>
		  <h3>All 30 Days Access:</h3>
		  <div class="form-group">
		    <label for="exampleInputPassword1"><!-- All 30 Days Access --></label>
		    <select class="form-control" name="all_access" id="all_access">
		    	<option>Select Option</option>
		    	<?php if($rowes1['all_access'] == 'Yes'){ ?>
                <option value="Yes" selected="selected">Yes</option>
                <option value="No">No</option>
                <?php }elseif($rowes1['all_access'] == 'No'){ ?>
                  <option value="Yes">Yes</option>
                <option value="No" selected="selected">No</option>
                <?php }else{ ?>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <?php } ?>
		    </select>
		  </div>
		  <?php $all_access = $rowes1['all_access']; ?>
		  <div class="row" id="all_day_access">
			  <div class="form-group col-md-6">
			    <label for="exampleInputPassword1">All 30 Days access coins? </label>
			    <input type="text" name="all_access_price" class="form-control" placeholder="All 30 Days access coins?">
			  </div>
		  </div>
		  <input type="submit" name="submitButton"  class="fancy_button" style="padding: 7px 20px;" value="Submit">
		</form>
	</div>

	  <div role="tabpanel" class="tab-pane" id="profile">
	  	<?php 
	  	$sql1 = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                  $rowes1 = mysqli_fetch_assoc($result1);
                  // echo '<pre>';
                  // print_r($rowes1);
                  // echo '</pre>';
                  // $my_va = $rowes1['International_tours'];

                }       
            ?>

          	<form id="casting-3" class="my_form" action="update-new-broadcaster.php" method="post" enctype="multipart/form-data">
         <div class="vfb-legend">
            <h3>Stats and Figure:</h3>
         </div>
         
         <div class="form-group">
		    <label for="exampleInputEmail1">Bust Size :</label>
		    <select class="form-control" name="bust-size" id="bust-size">
		    	<option value="" selected='selected'>Select Bust Size </option>
		    	<?php if($rowes1['bust_size'] == '30'){ ?>
		    		 <option value="30" selected="selected">30</option>
                  <option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
              <?php }elseif($rowes1['bust_size'] == '34'){ ?>
              	<option value="32">32</option>
                  <option value="34" selected="selected">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
              <?php }elseif($rowes1['bust_size'] == '36'){ ?>
              	<option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36" selected="selected">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
              <?php }elseif($rowes1['bust_size'] == '38'){ ?>
              	<option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38" selected="selected">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
                <?php }elseif($rowes1['bust_size'] == '40'){ ?>
              	<option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40" selected="selected">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
                  <option value="44">44</option>
              <?php }elseif($rowes1['bust_size'] == '42'){ ?>
              	<option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42" selected="selected">42</option>
                  <option value="44">44</option>
              <?php }elseif($rowes1['bust_size'] == '44'){ ?>
              	<option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44" selected="selected">44</option>
                  	<?php }else{ ?>
                <option value="32">32</option>
                  <option value="34">34</option>
                  <option value="36">36</option>
                  <option value="38">38</option>
                  <option value="40">40</option>
                  <option value="42">42</option>
                  <option value="44">44</option>
                <?php } ?>
		    </select>
		  </div>
		   <div class="form-group">
		    <label for="exampleInputEmail1">Cup Size :</label>
		    <select class="form-control" name="cup-size" id="bust-size">
		    	<option value="" selected='selected'>Select Cup Size </option>
		    	<?php if($rowes1['cup_size'] == 'A'){ ?>
                  <option value="A" selected="selected">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                  <?php }elseif($rowes1['cup_size'] == 'B'){ ?>
                  	<option value="A" >A</option>
                  <option value="B" selected="selected">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                   <?php }elseif($rowes1['cup_size'] == 'C'){ ?>
                  	<option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C" selected="selected">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                   <?php }elseif($rowes1['cup_size'] == 'D'){ ?>
                  	<option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D" selected="selected">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                   <?php }elseif($rowes1['cup_size'] == 'DD'){ ?>
                  	<option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD" selected="selected">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                   <?php }elseif($rowes1['cup_size'] == 'E'){ ?>
                  	<option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E" selected="selected">E</option>
                  <option value="F">F</option>
                   <?php }elseif($rowes1['cup_size'] == 'F'){ ?>
                  	<option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F" selected="selected">F</option>
                  <?php }else{ ?>
                	<option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="DD">DD</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                      <?php } ?>
		    </select>
		  </div>
		   <div class="form-group">
		    <label for="exampleInputEmail1">Waist Size :</label>
		    <select class="form-control" name="waist-size" id="bust-size">
		    	<option value="" selected='selected'>Select Waist Size </option>
		    	<?php if($rowes1['waist_size'] == '22'){ ?>
                  <option value="22" selected="selected">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
              <?php }elseif($rowes1['waist_size'] == '23'){ ?>
              	  <option value="22">22</option>
                  <option value="23" selected="selected">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
              <?php }elseif($rowes1['waist_size'] == '24'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24" selected="selected">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
              <?php }elseif($rowes1['waist_size'] == '25'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25" selected="selected">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
              <?php }elseif($rowes1['waist_size'] == '26'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26" selected="selected">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '27'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27" selected="selected">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '28'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28" selected="selected">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '29'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29" selected="selected">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '30'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30" selected="selected">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '31'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31" selected="selected">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '32'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32" selected="selected">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '33'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33" selected="selected">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '34'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34" selected="selected">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '35'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35" selected="selected">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '36'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36" selected="selected">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '37'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37" selected="selected">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '38'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38" selected="selected">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '39'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39" selected="selected">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '40'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40" selected="">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '41'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41" selected="selected">41</option>
                  <option value="42">42</option>
                   <?php }elseif($rowes1['waist_size'] == '42'){ ?>
              	<option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42" selected="selected">42</option>
                  <?php }else{ ?>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                  <?php } ?>

		    </select>
		  </div>
		  <div class="form-group">
			    <label for="exampleInputPassword1">Ethnicity:</label>
			    <input type="text" name="ethnicity" value="<?php echo $rowes1['ethnicity']; ?>" class="form-control" placeholder="">
			  </div>
			   <div class="form-group">
		    <label for="exampleInputEmail1">Height:</label>
		    <select class="form-control" name="height" id="bust-size">
		    	<option value="" selected='selected'>Select Height</option>
		    	<?php if($rowes1['height'] == '4.5'){ ?>
                  <option value="4.5" selected="selected">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '4.6'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6" selected="selected">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '4.7'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7" selected="selected">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['height'] == '4.8'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8" selected="selected">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '4.9'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9" selected="selected">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '4.10'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10" selected="selected">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '4.11'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11" selected="selected">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5" selected="selected">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.1'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1" selected="selected">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.2'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2" selected="selected">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.3'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3" selected="selected">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.4'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4" selected="selected">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.5'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5" selected="selected">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['height'] == '5.6'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6" selected="selected">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.7'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7" selected="selected">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['height'] == '5'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8" selected="selected">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['height'] == '5.9'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9" selected="selected">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['height'] == '5.10'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10" selected="selected">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '5.11'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11" selected="selected">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6" selected="selected">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6.1'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1" selected="selected">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6.2'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2" selected="selected">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6.3'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3" selected="selected">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6.4'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5" >5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4" selected="selected">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6.5'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5" selected="selected">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == '6.6'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6" selected="selected">6.6</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['height'] == 'Other'){ ?>
              	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other" selected="selected">Other</option>
                  <?php }else{ ?>
                  	<option value="4.5">4.5</option>
                  <option value="4.6">4.6</option>
                  <option value="4.7">4.7</option>
                  <option value="4.8">4.8</option>
                  <option value="4.9">4.9</option>
                  <option value="4.10">4.10</option>
                  <option value="4.11">4.11</option>
                  <option value="5">5</option>
                  <option value="5.1">5.1</option>
                  <option value="5.2">5.2</option>
                  <option value="5.3">5.3</option>
                  <option value="5.4">5.4</option>
                  <option value="5.5">5.5</option>
                  <option value="5.6">5.6</option>
                  <option value="5.7">5.7</option>
                  <option value="5.8">5.8</option>
                  <option value="5.9">5.9</option>
                  <option value="5.10">5.10</option>
                  <option value="5.11">5.11</option>
                  <option value="6">6</option>
                  <option value="6.1">6.1</option>
                  <option value="6.2">6.2</option>
                  <option value="6.3">6.3</option>
                  <option value="6.4">6.4</option>
                  <option value="6.5">6.5</option>
                  <option value="6.6">6.6</option>
                  <option value="Other">Other</option>
                  <?php } ?>

		    </select>
		  </div>
		   <div class="form-group">
			    <label for="exampleInputPassword1">Weight (enter weight in pounds) :</label>
			    <input type="text" name="weight" value="<?php echo $rowes1['weight']; ?>" class="form-control" placeholder="">
			  </div>
			  <div class="form-group">
		    <label for="exampleInputEmail1">Eye Color :</label>
		    <select class="form-control" name="eye-color" id="bust-size">
		    	<option value="" selected='selected'>Select Eye Color </option>
		    	<?php if($rowes1['eye_color'] == 'Hazel'){ ?>
                  <option value="Hazel" selected="selected">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['eye_color'] == 'Brown'){ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown" selected="selected">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
                 <?php }elseif($rowes1['eye_color'] == 'Blue'){ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue" selected="selected">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
                   <?php }elseif($rowes1['eye_color'] == 'Green'){ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green" selected="selected">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
                   <?php }elseif($rowes1['eye_color'] == 'Black'){ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black" selected="selected">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
                   <?php }elseif($rowes1['eye_color'] == 'Grey'){ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey" selected="selected">Grey</option>
                  <option value="Other">Other</option>
                   <?php }elseif($rowes1['eye_color'] == 'Other'){ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other" selected="selected">Other</option>
                  <?php }else{ ?>
                  <option value="Hazel">Hazel</option>
                  <option value="Brown">Brown</option>
                  <option value="Blue">Blue</option>
                  <option value="Green">Green</option>
                  <option value="Black">Black</option>
                  <option value="Grey">Grey</option>
                  <option value="Other">Other</option>
                   <?php } ?>

		    </select>
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Hair Color :</label>
		    <select class="form-control" name="hair-color" id="bust-size">
		    	<option value="" selected='selected'>Select Hair Color</option>
		    	<?php if($rowes1['hair_color'] == 'Blonde'){ ?>
                  <option value="Blonde" selected="selected">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown">Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                   <?php }elseif($rowes1['hair_color'] == 'Dirty Blonde'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde" selected="selected">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown">Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['hair_color'] == 'Platinum Blonde'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde" selected="selected">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown">Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
              <?php }elseif($rowes1['hair_color'] == 'Strawberry Blonde'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde" selected="selected">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown">Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                   <?php }elseif($rowes1['hair_color'] == 'Black'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black" selected="selected">Black</option>
                  <option value="Brown">Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['hair_color'] == 'Brown'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown" selected="selected">Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['hair_color'] == 'Brunette'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown" >Brown</option>
                  <option value="Brunette" selected="selected">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['hair_color'] == 'Red'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown" >Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red" selected="selected">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['hair_color'] == 'Salt n Pepper'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown" >Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper" selected="selected">Salt n Pepper</option>
                  <option value="Other">Other</option>
                  <?php }elseif($rowes1['hair_color'] == 'Other'){ ?>
                  <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown" >Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other" selected="selected">Other</option>
                  <?php }else{ ?>
                  	 <option value="Blonde">Blonde</option>
                  <option value="Dirty Blonde">Dirty Blonde</option>
                  <option value="Platinum Blonde">Platinum Blonde</option>
                  <option value="Strawberry Blonde">Strawberry Blonde</option>
                  <option value="Black">Black</option>
                  <option value="Brown" >Brown</option>
                  <option value="Brunette">Brunette</option>
                  <option value="Red">Red</option>
                  <option value="Salt n Pepper">Salt n Pepper</option>
                  <option value="Other">Other</option>
              <?php } ?>
		    </select>
		  </div>

         &nbsp;
<input type="submit" name="submitButton"  class="fancy_button" style="padding: 7px 20px;" value="Submit">           
  </form>

       
        </div>
      </div>
</div>
</div>
	<?php include('../includes/footer.php'); ?>
	<script type="text/javascript">
	
	$( document ).ready(function() {
		$("#escorts_details").hide();
		$("#internation_tour_details").hide();
		$("#live_cam_details").hide();
		$("#groupshow_details").hide();
		$("#modeling_porn_details").hide();
		$("#all_day_access").hide();
		

	   var International_tours = "<?php echo $International_tours;?>";
	   if(International_tours == "No"){
	   	$("#internation_tour_details").hide();
	   }else if(International_tours == "Yes"){
			$("#internation_tour_details").show();
	   }else {
		$("#internation_tour_details").hide();
	   }
	   var live_cam = "<?php echo $live_cam;?>";
	   if(live_cam == "No"){
	   	$("#live_cam_details").hide();
	   }else if(live_cam == "Yes"){
			$("#live_cam_details").show();
	   }else {
		$("#live_cam_details").hide();
	   }
	   var group_show1 = "<?php echo $group_show;?>";
	   if(group_show1 == "No"){
	   	$("#groupshow_details").hide();
	   }else if(group_show1 == "Yes"){
			$("#groupshow_details").show();
	   }else {
		$("#groupshow_details").hide();
	   }
	   var es_work = "<?php echo $es_work;?>";
	   if(es_work == "No"){
	   	$("#escorts_details").hide();
	   }else if(es_work == "Yes"){
			$("#escorts_details").show();
	   }else {
		$("#escorts_details").hide();
	   }
	   var modeling_porn_assignment = "<?php echo $modeling_porn_assignment;?>";
	   if(modeling_porn_assignment == "No"){
	   	$("#modeling_porn_details").hide();
	   }else if(modeling_porn_assignment == "Yes"){
			$("#modeling_porn_details").show();
	   }else {
		$("#modeling_porn_details").hide();
	   }

	   
			$('#live_cam').on('change', function() {
				var live = $("#live_cam").val();
				if (live == "Yes") {
					$("#live_cam_details").show();
				}else if (live == "No"){
					$("#live_cam_details").hide();
				}
	        });
	        $('#group_show').on('change', function() {
				var group_show = $("#group_show").val();
				if (group_show == "Yes") {
					$("#groupshow_details").show();
				}else if (group_show == "No"){
					$("#groupshow_details").hide();
				}
	        });
	        $('#escorts').on('change', function() {
				var escorts = $("#escorts").val();
				if (escorts == "Yes") {
					$("#escorts_details").show();
				}else if (escorts == "No"){
					$("#escorts_details").hide();
				}
	        });
	        $('#internation_tour').on('change', function() {
				var internation_tour = $("#internation_tour").val();
				if (internation_tour == "Yes") {
					$("#internation_tour_details").show();
				}else if (internation_tour == "No"){
					$("#internation_tour_details").hide();
				}
	        });
	        $('#modeling_porn').on('change', function() {
				var modeling_porn = $("#modeling_porn").val();
				if (modeling_porn == "Yes") {
					$("#modeling_porn_details").show();
				}else if (modeling_porn == "No"){
					$("#modeling_porn_details").hide();
				}
	        });
	        $('#all_access').on('change', function() {
				var all_access = $("#all_access").val();
				if (all_access == "Yes") {
					$("#all_day_access").show();
				}else if (all_access == "No"){
					$("#all_day_access").hide();
				}
	        });
	        
	});
		
	</script>
</body>
</html>