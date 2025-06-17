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
?>
<span class="badge badge-success">Accept</span>
<?php
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
<span class="currency"><i class="far fa-coins"></i></span><?=$set_data['amount']?>
            </div>
            
        </div>
    </div>
    <div class="nk-odr-col nk-odr-col-action">
        <div class="nk-odr-action ">
            <a class="wd-view-account" href="javsacript:;" data-toggle="modal" data-target="#myModal_details-<?php echo $set_data['id']; ?>" ><span class="data-more"><i class="fa fa-chevron-right"></i></span></a>
        </div>
    </div>
</div>

<div id="myModal_details-<?php echo $set_data['id']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="color: #222222">Details</h4>
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
    	<div><strong>Booking Type:</strong></div>   	
        <div><?php echo $set_data['booking_type']; ?></div>
	</div>

	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Booking For:</strong></div>   	
        <div><?php echo $set_data['book_for']; ?></div>
	</div>

	<div class="col-md-6 d-flex justify-content-between ">
    	<div><strong>Country:</strong></div>   	
        <div><?php echo print_value('countries',array('id'=>$set_data['country']),'name'); ?></div>
	</div>

	<div class="col-md-12 ">
    	<div><strong>Instructions:</strong></div>   	
        <div><?php echo $set_data['instructions']; ?></div>
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
<?php
	}
}
else{
?>
<div class="p-4 text-center" ><h4>There is no Booking yet.</h4></div>
<?php	
}
?>
