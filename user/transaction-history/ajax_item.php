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


<div class="transaction-item">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold"><?=$message?></div>
                                <div class="text-sm text-gray-400"><?=h_dateFormat($set_data['created_at'],'M d, Y - h:i A')?></div>
                            </div>
                        </div>
                        <div class="text-right">
                            <?php /*<div class="text-green-400 font-semibold">+500 Coins</div> */ ?>
                            <div class="text-sm text-gray-400">₹<?=$set_data['amount']?></div>
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
