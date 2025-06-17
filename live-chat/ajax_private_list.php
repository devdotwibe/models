<?php
if($checPrivate){
	foreach($checPrivate as $set_data){

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
            </div>
        </div>
    </div>
    <div class="nk-odr-col nk-odr-col-action">
        <div class="nk-odr-action ">
        <a class="btn btn-xs btn-success" href="javascript:;" onclick="set_confirm_private_chat(<?=$set_data['id']?>,'accept');">
Accept</a>
<a class="btn btn-xs btn-danger" href="javascript:;'" onclick="set_confirm_private_chat(<?=$set_data['id']?>,'reject');">
 Reject</a>
            

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
