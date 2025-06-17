<?php
if($all_data){
	foreach($all_data as $set_data){

$userReview = DB::queryFirstRow("SELECT * FROM booking_dating_assignments_review WHERE booking_id = %s and sender_id = %s ",$set_data['id'],$set_data['userid']);
?>
<div class="nk-odr-item ">
    <div class="nk-odr-col">
        <div class="nk-odr-info">
            <div class="nk-odr-badge">
                <span class="nk-odr-icon bg-warning-dim text-warning icon ni ni-arrow-up-right">
                <img src="<?=SITEURL.$set_data['profile_pic']?>" class="u-img" /></span>
            </div>
            <div class="nk-odr-data">
                <div class="nk-odr-label">
                    <strong class="ellipsis"><?=$set_data['username']?></strong>
                </div>
                <div class="nk-odr-meta">
                    <span class="date">Booking: <?=h_dateFormat($set_data['meeting_date'],'d M, Y')?></span>
<span class="dot-join">
<?php
if($set_data['status']=='accept'){
	if($set_data['is_paid']==1){
?>
<span class="badge badge-primary">Paid</span>
<?php
	}
	else{
?>
<span class="badge badge-success">Accept</span>
<?php
	}
}
else if($set_data['status']=='reject'){
?>
<span class="badge badge-danger">Reject</span>
<?php
}
else {
?>
<span class="badge badge-info">Pending</span>
<?php
}
?>
                </span>                    
                </div>
            </div>
        </div>
    </div>
    <!--<div class="nk-plan-term">
        <div class="nk-plan-start nk-plan-order">
            <span class="nk-plan-label text-soft font-weight-bold">Payment Type</span>
            <span class="nk-plan-value date">Card</span>
        </div>
        
    </div>-->
    <div class="nk-odr-col nk-odr-col-amount">
        <div class="nk-odr-amount">
            <div class="number-md text-s text-success">
<span class="currency">$</span><?=$set_data['amount']?>
            </div>
            
        </div>
    </div>
    <div class="nk-odr-col nk-odr-col-action">
        <div class="nk-odr-action ">
<?php
//printR($set_data);
if($set_data['status']=='accept'){
	if($set_data['is_paid']==0){
?>
    <a class="btn btn-xs btn-info" href="<?=SITEURL.'dating_booking/payment.php?id='.$set_data['id']?>" >Pay Now</a>&nbsp;&nbsp;
<?php
	}
}
if($set_data['status']=='accept'){
	if($set_data['is_paid']==1){
$review = DB::queryFirstRow("SELECT * FROM booking_dating_assignments_review WHERE booking_id = %s and sender_id = %s ",$set_data['id'],$userDetails['id']);
		if(!$review){
?>
&nbsp;&nbsp;
<a class="btn btn-xs btn-success" href="<?=SITEURL.'dating_booking/review.php?id='.$set_data['id']?>">Review</a>&nbsp;&nbsp;
<?php			
		}
	}
}
?>
            <a class="wd-view-account" href="javsacript:;" data-toggle="modal" data-target="#myModal_details-<?php echo $set_data['id']; ?>" ><span class="data-more"><i class="fa fa-chevron-right"></i></span></a>
        </div>
    </div>
</div>

<div id="myModal_details-<?php echo $set_data['id']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="color: #222222">Dating Assignment Details</h4>
    </div>
    <div class="modal-body">
      <div style="padding: 20px;">
<div class="row">
	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Date:</strong></div>   	
        <div><?php echo $set_data['meeting_date']; ?></div>
	</div>

	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Time:</strong></div>   	
        <div><?php echo $set_data['meeting_time_hour'].':'.$set_data['meeting_time_hour'].' '.$set_data['ampm']; ?></div>
	</div>

	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Duration:</strong></div>   	
        <div><?php echo $set_data['duration']; ?></div>
	</div>

	<div class="col-md-12 ">
    	<div><strong>Instructions:</strong></div>   	
        <div><?php echo $set_data['instruction']; ?></div>
	</div>
</div>      

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
<?php
	}
}
else{
?>
<div class="p-4 text-center" ><h4>There is no Booking yet.</h4></div>
<?php	
}
?>
