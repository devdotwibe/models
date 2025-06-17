<?php
if($all_data){
	foreach($all_data as $set_data){
?>
<div class="nk-odr-item ">
    <div class="nk-odr-col">
        <div class="nk-odr-info">
            <div class="nk-odr-badge">
                <span class="nk-odr-icon bg-warning-dim text-warning icon ni ni-arrow-up-right"><i class="far fa-arrows-alt-h"></i></span>
            </div>
            <div class="nk-odr-data">
                <div class="nk-odr-label">
                    <strong class="ellipsis">Withdraw request #<?=$set_data['id']?></strong>
                </div>
                <div class="nk-odr-meta">
                <span class="date"><b>ID</b>: #<?=$set_data['id']?></span>
                <span class="date"><?=h_dateFormat($set_data['created_date'],'d M, Y')?></span>
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
    <div class="nk-plan-term">
        <div class="nk-plan-start nk-plan-order">
            <span class="nk-plan-label text-soft font-weight-bold">Transaction Fee:</span>
            <span class="nk-plan-value date"> <b>$<?=$set_data['transaction_fee']?></b></span>
        </div>    
    </div>
    <div class="nk-odr-col nk-odr-col-amount">
        <div class="nk-odr-amount">
            <div class="number-md text-s text-success">
<span class="currency"><i class="far fa-coins"></i></span> <?=$set_data['coins']?>
<br>
<span class="currency"><i class="fas fa-dollar-sign"></i></span><?=round($set_data['amount']-$set_data['transaction_fee'],2)?>
            </div>
            
        </div>
    </div>
    
</div>


<?php
	}
}
else{
?>
<div class="p-4 text-center" ><h4>There is no withdrawal yet.</h4></div>
<?php	
}
?>
