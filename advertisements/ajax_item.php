<?php
if($all_data){
	foreach($all_data as $set_data){
		$message  = limit_text($set_data['description'],15);
?>


                <div class="ad-card fade-in" data-category="<?=$set_data['category']?>" data-type="featured" data-id="<?= $set_data['user_id'] ?>">
                    <div class="ad-image">
                        <div class="ad-badge badge-featured">🌟 Featured</div>
                        <img src="<?php echo SITEURL.'uploads/banners/'.$set_data['image']; ?>" alt="Social Media Influencer">
                    </div>
                    <div class="ad-content">
                        <h3 class="ad-title"><?php echo $set_data['name']; ?></h3>
                        <p class="ad-description"><?=$message?></p>
                        <div class="ad-stats">
                            <div class="stat-item">
                                <span>👁️</span>
                                <span>3,890 views</span>
                            </div>
                            <div class="stat-item">
                                <span>❤️</span>
                                <span>267 likes</span>
                            </div>
                            <div class="stat-item">
                                <span>⭐</span>
                                <span>4.8 rating</span>
                            </div>
                        </div>
                        <button class="btn-primary" onclick="viewProfile(<?php echo $set_data['id']; ?>)">
                            View Details
                        </button>
                    </div>
                </div>



<?php /*?><div class="col-md-12 ">
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
</div>  <?php */ ?>    
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
