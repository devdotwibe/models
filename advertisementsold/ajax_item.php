<?php
if($all_data){
	foreach($all_data as $set_data){
		$message  = limit_text($set_data['description'],15);
?>
<div class="col-md-12 ">
  <div class="card adv-list"><!--creator-->
        <a href="<?=SITEURL?>advertisements/view.php?id=<?php echo $set_data['id']; ?>">
            <div class="adv-img"><img src="<?php echo SITEURL.'uploads/banners/'.$set_data['image']; ?>" alt="" /></div>
            <div class="adv-text">
                <h3 class="adv-title"><?php echo $set_data['name']; ?></h3>
                <h4 class="adv-age"><?php echo $set_data['age']; ?> Years</h4>
                <div class="adv-details">
                    <div class="d-flex justify-content-between mt-2 mb-2">
                        <span class="adv-category"><?=$set_data['category']?></span>
<?php
if($set_data['is_paid']==1){
?>
<span class="adv-featured">Featured</span>
<?php
}
?>
<span class="adv-featured">Featured</span>
                    </div>
                    <p class="limit-hight "><?=$message?></p>
                </div>
            </div>
        </a>
    </div>
</div>      
<?php
	}
}
else{
?>
<div class="col-md-12 text-center">
    <h3>There is no data.</h3>
</div>
<?php    
}
?>
