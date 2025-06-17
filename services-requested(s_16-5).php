<?php 
session_start(); 
include('includes/config.php');
// include('functions.php');

include('includes/helper.php');
if(isset($_SESSION["log_user_id"])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="login.php"</script>';
	}
}
else{
	echo '<script>window.location.href="login.php"</script>';
}

$usern = $_SESSION["log_user"];
    
if( !$usern ){
	echo '<script>window.location.href="login.php"</script>';
}

$stringQuery = "SELECT tb.*,mu.username,mu.profile_pic FROM booking_international_tour tb 
join model_user mu on mu.id = tb.user_id
where model_id='".$userDetails['id']."' ";
$sort_by = ' ORDER BY tb.id desc ';
$booking_international_tour = DB::query($stringQuery." ".$sort_by);

$stringQuery = "SELECT tb.*,mu.username,mu.profile_pic FROM booking_movie_assignments tb 
join model_user mu on mu.unique_id = tb.unique_user_id
where model_unique_id='".$userDetails['unique_id']."' ";
$sort_by = ' ORDER BY tb.id desc ';
$booking_movie_assignments = DB::query($stringQuery." ".$sort_by);

?>
<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Purchase </title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="<?='assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png'?>">
<link rel="icon" href="<?='assets/wp-content/themes/theagency3/favicon5e1f.png?v=2'?>">
<link href='<?='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script'?>' rel='stylesheet' type='text/css'>

  <script src='<?='//kit.fontawesome.com/a076d05399.js'?>'></script>

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
  <link rel='stylesheet' id='wp-block-library-css'  href='<?='assets/wp-includes/css/dist/block-library/style.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='<?='assets/wp-content/plugins/spiffy-calendar/styles/default.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='<?='assets/wp-includes/css/dashicons.min.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/css/style.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='<?='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='<?='http://fonts.googleapis.com/css?family=Rokkitt'?>' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='<?='assets/wp-content/plugins/rich-reviews/css/rich-reviews.css'?>' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='<?='assets/wp-content/themes/theagency3/library/css/style.css'?>' type='text/css' media='all' />

<script type='text/javascript' src='<?='assets/wp-includes/js/jquery/jquery.js'?>' id='jquery-core-js'></script>

<!--<script type='text/javascript' src='<?='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js'?>' id='rich-reviews-js'></script>
<script type='text/javascript' src='<?='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js'?>' id='bones-modernizr-js'></script>-->
<link rel='stylesheet' href='<?=SITEURL?>assets/css/custom.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />

  </head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
    <?php include('includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">

<ul class="nav  nav-tabs">
  <li class="active"><a data-toggle="tab" href="#it-tab">International Tours</a></li>
  <li><a data-toggle="tab" href="#da-tab">Dating Assignments</a></li>
  <li><a data-toggle="tab" href="#ma-tab">Movie/Modeling Assignments</a></li>
  <li><a data-toggle="tab" href="#aa-tab">All access (30 Day's)</a></li>
</ul>

<div class="tab-content">
  <div id="it-tab" class="tab-pane fade in active ">
<div>
<?php
if($booking_international_tour){
foreach($booking_international_tour as $row_it){

?>
<table>
<tr>
<td style="vertical-align: middle;"><?php echo '<b>'.$row_it['username'].'</b> has requested International Tour at '.$row_it['meeting_date'].''; ?></td>
<td style="width:90px">
<button class="btn btn-primary" data-toggle="modal" data-target="#myModalit<?php echo $row_it['id']; ?>">View Details</button></td>
<td style="width:130px">
<?php
if($row_it['status']=='accept'){
?>
<span class="badge badge-success">Accepted</span>
<?php
}
else if($row_it['status']=='reject'){
?>
<span class="badge badge-danger">Reject</span>
<?php
}
else {
?>
<a class="btn btn-xs btn-success" href="service-processing.php?service-name=internation_tour&service_id=<?php echo $row_it['id']; ?>&action=accept">Accept</a>
&nbsp;
<a class="btn btn-xs btn-danger" href="service-processing.php?service-name=internation_tour&service_id=<?php echo $row_it['id']; ?>&action=reject">Reject</a>
<?php
}

?>
</td>
</tr>

<div id="myModalit<?php echo $row_it['id']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">

<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title" style="color: #222222">International Tour Details</h4>
</div>
<div class="modal-body">
  <div style="padding: 20px;">
<div class="row">
	<div class="col-md-6 mb-3 d-flex justify-content-between ">
    	<div><strong>Date:</strong></div>   	
        <div><?php echo $row_it['meeting_date']; ?></div>
	</div>

	<div class="col-md-6 mb-3 d-flex justify-content-between ">
    	<div><strong>Time:</strong></div>   	
        <div><?php echo $row_it['meeting_time_hour'].':'.$row_it['meeting_time_hour'].' '.$row_it['ampm']; ?></div>
	</div>

	<div class="col-md-6 mb-3 d-flex justify-content-between ">
    	<div><strong>Booking Type:</strong></div>   	
        <div><?php echo $row_it['booking_type']; ?></div>
	</div>

	<div class="col-md-6 mb-3 d-flex justify-content-between ">
    	<div><strong>Booking For:</strong></div>   	
        <div><?php echo $row_it['book_for']; ?></div>
	</div>

	<div class="col-md-6 mb-3 d-flex justify-content-between ">
    	<div><strong>Country:</strong></div>   	
        <div><?php echo print_value('countries',array('id'=>$row_it['country']),'name'); ?></div>
	</div>

	<div class="col-md-12 ">
    	<div><strong>Instructions:</strong></div>   	
        <div><?php echo $row_it['instructions']; ?></div>
	</div>
</div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
</table>
<?php

	}
}else{
echo '<div style="padding:10px;text-align:center">You dont have any request for group show</div>'; 
}
?>
</div>
  </div>
  <div id="da-tab" class="tab-pane fade ">
<div>          
          <?php
            $sql_da = "SELECT * FROM booking_dating_assignments WHERE model_unique_id = '".$log_user_id."'";
            $result_da = mysqli_query($con,$sql_da);

            if (mysqli_num_rows($result_da) > 0) {

              while ($row_da = mysqli_fetch_assoc($result_da)) {

                $que_nam2 = "SELECT * FROM model_user WHERE unique_id = '".$row_da['user_unique_id']."'";
                $result_nam2 = mysqli_query($con, $que_nam2);
                
                 $bookinUserId = 0;
                if (mysqli_num_rows($result_nam2) > 0) {
                  $row_nam2 = mysqli_fetch_assoc($result_nam2);
                    $name2 = $row_nam2['name'];
                    $bookinUserId = $row_nam2['id'];
                  
                }else{
                    $name2 = 'No name'; 
                }

                  ?>
<table>
<tr>
<td style="vertical-align: middle;"><?php echo '<b>'.$name2.'</b> has requested group show at '.$row_da['meeting_date'].''; ?></td>
<td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal_da<?php echo $row_gs['id']; ?>"_ma<?php echo $row_gs['id']; ?>>View Details</button></td>
<td>
<?php
if($row_da['status']=='pending'){
?>
<a class="btn btn-success" href="javascipt:;" onClick="dating_assignments('<?=$row_da['id']?>','accept')">Accept</a>
<a class="btn btn-danger" href="javascipt:;" onClick="dating_assignments('<?=$row_da['id']?>','accept')">Reject</a>
<?php
}
else {
	if($row_da['status']=='accept'){
		if($row_da['is_paid']==1){
			echo '<span class="badge badge-success">Paid</span>';
		}
		else{
			echo '<span class="badge badge-primary">'.ucfirst($row_da['status']).'</span>';
		}
	}
	else{
		echo '<span class="badge badge-primary">'.ucfirst($row_da['status']).'</span>';
	}
}
if($row_da['status']=='accept'){
	if($row_da['is_paid']==1){
$review = DB::queryFirstRow("SELECT * FROM booking_dating_assignments_review WHERE booking_id = %s and sender_id = %s ",$row_da['id'],$userDetails['id']);
		if(!$review){
?>
&nbsp;&nbsp;
<a class="btn btn-xs btn-success" href="<?=SITEURL.'dating_booking/review.php?id='.$row_da['id']?>">Review</a>
<?php			
		}
	}
}
?>
</td>
</tr>

<?php

$userReview = DB::queryFirstRow("SELECT * FROM booking_dating_assignments_review WHERE booking_id = %s and sender_id = %s ",$row_da['id'],$bookinUserId);

?>

<div id="myModal_da<?php echo $row_gs['id']; ?>"_ma<?php echo $row_gs['id']; ?> class="modal fade" role="dialog">
<div class="modal-dialog">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="color: #222222">Dating Assignment Details</h4>
    </div>
    <div class="modal-body">
      <div style="padding: 20px;">
        <p>Date : <b><?php echo $row_da['meeting_date']; ?></b></p>
        <p>Time <b><?php echo $row_da['meeting_time_hour'].':'.$row_da['meeting_time_hour'].' '.$row_da['ampm']; ?></b></p>
        <p>Duration: <b><?php echo $row_da['duration']; ?></b></p>
        <p>Instruction: <b><?php echo $row_da['instruction']; ?></b></p>

<?php
if($review){
?>
<hr>
<div style="margin-top:10px">
<b>Your Review</b>
<p style="color:#FC0">
<i class="fa <?=$review['rate']>=1?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$review['rate']>=2?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$review['rate']>=3?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$review['rate']>=4?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$review['rate']>=5?'fa-star':'fa-star-o'?>"></i>
</p>
<p><?=$review['comment']?></p>
</div>
<?php
}
if($userReview){
?>
<hr>
<div style="margin-top:10px">
<b>Client Review</b>
<p style="color:#FC0">
<i class="fa <?=$userReview['rate']>=1?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$userReview['rate']>=2?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$userReview['rate']>=3?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$userReview['rate']>=4?'fa-star':'fa-star-o'?>"></i>
<i class="fa <?=$userReview['rate']>=5?'fa-star':'fa-star-o'?>"></i>
</p>
<p><?=$userReview['comment']?></p>
</div>
<?php
}
?>        

      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
</table>
                  <?php
              }
               
            }else{
              echo '<div style="padding:10px;text-align:center">You dont have any request for Dating Assignment</div>'; 
            }
          ?>
</div>
  </div>
  <div id="ma-tab" class="tab-pane fade ">
<div>          
          <?php
if($booking_movie_assignments){
foreach($booking_movie_assignments as $result_ma){
//	printR($booking_movie_assignments);
?>
<table>
<tr>
<td style="vertical-align: middle;"><?php echo '<b>'.$result_ma['username'].'</b> has requested group show at '.$result_ma['meeting_date'].''; ?></td>
<td style="width:100px"><button class="btn btn-primary" data-toggle="modal" data-target="#myModal_ma<?php echo $result_ma['id']; ?>">View Details</button></td>
<td style="width:100px">
<?php
if($result_ma['status']=='accept'){
?>
<span class="badge badge-success">Accepted</span>
<?php
}
else if($result_ma['status']=='reject'){
?>
<span class="badge badge-danger">Reject</span>
<?php
}
else{
?>
<a class="btn btn-xs btn-success" href="service-processing.php?service-name=movie_assignments&service_id=<?php echo $result_ma['id']; ?>&action=accept">Accept</a>
&nbsp;
<a class="btn btn-xs btn-danger" href="service-processing.php?service-name=movie_assignments&service_id=<?php echo $result_ma['id']; ?>&action=reject">Reject</a>
<?php
}

?>

</td>
</tr>

<div id="myModal_ma<?php echo $result_ma['id']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="color: #222222">Movie/Modelling Details</h4>
    </div>
    <div class="modal-body">
      <div style="padding: 20px;">
<div class="row">
	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Date:</strong></div>   	
        <div><?php echo $result_ma['meeting_date']; ?></div>
	</div>

	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Time:</strong></div>   	
        <div><?php echo $result_ma['meeting_time_hour'].':'.$result_ma['meeting_time_hour'].' '.$result_ma['ampm']; ?></div>
	</div>

	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Duration:</strong></div>   	
        <div><?php echo $result_ma['du_movie_modeling']; ?></div>
	</div>

	<div class="col-md-12 ">
    	<div><strong>Instructions:</strong></div>   	
        <div><?php echo $result_ma['instructions']; ?></div>
	</div>
</div>
        


      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
</table>
<?php
	}
}
else{
echo '<div style="padding:10px;text-align:center">You dont have any request for Movie/Modeling assignment</div>'; 
}
?>
</div>
  </div>

<div id="aa-tab" class="tab-pane fade">
<div>
          <?php
            $sql_aa = "SELECT * FROM user_all_access WHERE model_id = '".$log_user_id."'";
            $result_aa = mysqli_query($con,$sql_aa);

            if (mysqli_num_rows($result_aa) > 0) {

              while ($row_aa = mysqli_fetch_assoc($result_aa)) {

                $que_nam4 = "SELECT * FROM model_user WHERE unique_id = '".$row_aa['user_id']."'";
                $result_nam4 = mysqli_query($con, $que_nam4);
                
                if (mysqli_num_rows($result_nam4) > 0) {
                  $row_nam4 = mysqli_fetch_assoc($result_nam4);
                    $name4 = $row_nam4['name'];
                  
                }else{
                    $name4 = 'No name'; 
                }

                  ?>
                    <table>
                      <tr>
                        <td style="vertical-align: middle;"><b><?php echo $name4; ?></b> has Subscribe your 30days all access</td>

                        <td>Duration : <?php echo $row_aa['start_date'].'-'.$row_aa['end_date']; ?></td>
                        <td>
                          Status : <?php if($row_aa['status'] == '1'){ echo 'Active'; }else{ echo 'Inactive'; } ?></td>
                      </tr>

                    </table>
                  <?php
               
              }
               
            }else{
              echo '<div style="padding:10px;text-align:center">You dont have any 30 days all access.</div>'; 
            }
          ?>
</div>
</div>

</div>

          

<?php /*?><div>
          <?php $log_user_id = $_SESSION["log_user_unique_id"]; ?>
          <h3>Group Show's </h3>
          <?php
            $sql_gs = "SELECT * FROM booking_group_show WHERE model_unique_id = '".$log_user_id."'";
            $result_gs = mysqli_query($con,$sql_gs);

            if (mysqli_num_rows($result_gs) > 0) {

              while ($row_gs = mysqli_fetch_assoc($result_gs)) {

                $que_nam = "SELECT * FROM model_user WHERE unique_id = '".$row_gs['user_unique_id']."'";
                $result_nam = mysqli_query($con, $que_nam);
                
                if (mysqli_num_rows($result_nam) > 0) {
                  $row_nam = mysqli_fetch_assoc($result_nam);
                    $name = $row_nam['name'];
                  
                }else{
                    $name = 'No name'; 
                }

                if($row_gs['status'] == 'Not Accepted'){
 
                  ?>
                    <table>
                      <tr>
                        <input type="hidden" name="id" value="<?php echo $row_gs['id']; ?>">
                        <td style="vertical-align: middle;"><?php echo '<b>'.$name.'</b> has requested group show at '.$row_gs['meeting_date'].''; ?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $row_gs['id']; ?>">View Details</button></td>
                        <td>
                          <a class="btn btn-success" href="service-processing.php?service-name=group_show&service_id=<?php echo $row_gs['id']; ?>&action=accept">Accept</a></td>
                        <td>
                          <a class="btn btn-danger" href="service-processing.php?service-name=group_show&service_id=<?php echo $row_gs['id']; ?>&action=reject">Reject</a>
                        </td>
                      </tr>

                      <div id="myModal<?php echo $row_gs['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" style="color: #222222">Group show Details</h4>
                            </div>
                            <div class="modal-body">
                              <div style="padding: 20px;">
                                <p>Date : <b><?php echo $row_gs['meeting_date']; ?></b></p>
                                <p>Time <b><?php echo $row_gs['meeting_time_hour'].':'.$row_gs['meeting_time_hour'].' '.$row_gs['ampm']; ?></b></p>
                                <p>Duration: <b><?php echo $row_gs['duration']; ?></b></p>
                                <p>Instruction: <b><?php echo $row_gs['instruction']; ?></b></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </table>
                  <?
                }elseif($row_gs['status'] == 'Accepted'){
                  ?>
                  You have accepted group show request with <?php echo $name; ?>.
                  <?php
                }elseif($row_gs['status'] == 'Reject
                  .'){
                  ?>
                  You have Rejected group show request <?php echo $name; ?>.
                  <?php
                }
              }
               
            }else{
              echo 'You dont have any request for group show'; 
            }
          ?>
</div><?php */?>          




                    
          </div> <!-- end #main -->

                  
        </div>
      </div> 

   <?php include('includes/footer.php'); ?>
  </body>
<script type="text/javascript" src="<?=SITEURL?>assets/plugins/jquery-confirm/jquery-confirm.min.js"></script>
<link href="<?=SITEURL?>assets/plugins/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
<script src="<?=SITEURL?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'?>"></script>
<link href="<?='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'?>" rel="stylesheet">

<script>
function dating_assignments(id,type){
	$.confirm({
		title: 'Confirm!',
		content: 'Are you sure?',
		buttons: {
			confirm: function () {
		$('#main').block({ 
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
				url : "<?=SITEURL.'dating_booking/ajax_action.php'?>",
				data:{id:id,type:type},
				dataType:'json',
				success: function(response){
					$('#app').unblock(); 
					if(response.status=='ok'){
						location.reload();
					}
					else{
						toastr.error(response.message,'Error', {timeOut: 5000});
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
</html> 
