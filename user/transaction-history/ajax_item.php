<?php
if($all_data){
	foreach($all_data as $set_data){
        if(in_array($set_data['type'],array(
            'user-purchase-image','user-booking-group-show',
            'user-booking-movie-assignments',
            'model-reject-internation-tour','model-reject-group-show',
            'model-reject-movie-assignments','model-reject-group-show',
        ))){
            $amountType = 'plus';
        }
        else {
            $amountType = 'minus';
        }
        $message = $set_data['type'];
        $message = str_replace('-', ' ', $message);

        
        if($set_data['type']=='booking-group-show'){
            $message = 'You booked group show';
        }
        else if($set_data['type']=='user-booking-group-show'){
            $message = 'User booked group show';
        }
        else if($set_data['type']=='purchase-image'){
            $message = 'You purchased image';
        }
        else if($set_data['type']=='user-purchase-image'){
            $message = 'User purchased image';
        }
        else if($set_data['type']=='booking-movie-assignments'){
            $message = 'You booked movie assignments';
        }
        else if($set_data['type']=='user-booking-movie-assignments'){
            $message = 'User booked movie assignments';
        }
        else if($set_data['type']=='reject-group-show'){
            $message = 'You rejected group show';
        }
        else if($set_data['type']=='model-reject-group-show'){
            $message = 'Model rejected group show';
        }
       else if($set_data['type']=='reject-internation-tour'){
            $message = 'You rejected internation tour';
        }
        else if($set_data['type']=='model-reject-internation-tour'){
            $message = 'Model rejected internation tour';
        }
        else if($set_data['type']=='reject-movie-assignments'){
            $message = 'You rejected movie assignments';
        }
        else if($set_data['type']=='model-reject-movie-assignments'){
            $message = 'Model rejected movie assignments';
        }
?>
<div class="nk-odr-item ">
    <div class="nk-odr-col">
        <div class="nk-odr-info">
            <div class="nk-odr-badge">
                <span class="nk-odr-icon <?=$amountType=='plus'?'bg-success-dim text-success':'bg-warning-dim text-warning'?> icon ni ni-arrow-up-right">
                <i class="fas <?=$amountType=='plus'?'fa-arrow-up':'fa-arrow-down'?>"></i>
            </div>
            <div class="nk-odr-data">
                <div class="nk-odr-label">
                    <strong class="ellipsis"><?=$message?></strong>
                </div>
                <div class="nk-odr-meta">
                <span class="date">Date: <?=h_dateFormat($set_data['created_at'],'d M, Y')?></span>
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
<span class="currency <?=$amountType=='plus'?'text-success':'text-warning'?>"><i class="far fa-coins"></i></span><?=$set_data['amount']?>
            </div>
            
        </div>
    </div>
    <!-- <div class="nk-odr-col nk-odr-col-action">
        <div class="nk-odr-action ">
            <a class="wd-view-account" href="javsacript:;" data-toggle="modal" data-target="#myModal_details-<?php echo $set_data['id']; ?>" ><span class="data-more"><i class="fa fa-chevron-right"></i></span></a>
        </div>
    </div> -->
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
