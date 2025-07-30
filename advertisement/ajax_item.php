<?php
if ($all_data) {
    foreach ($all_data as $set_data) {
        if (empty($set_data['adv_status'])) {
            $status = '<span class="badge bg-primary text-white">Active</span>';
        } else {
            $status = '<span class="badge bg-primary text-white">' . $set_data['adv_status'] . '</span>';
        }
        $Campaign = DB::queryFirstRow("SELECT * FROM banners_campaign WHERE banner_id = %s ",$set_data['id'],true);

?>

            <!-- Table Rows -->
            <div class="table-row px-8 py-6" id="adv_row_<?= $set_data['id'] ?>">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="col-span-1">
                        <input type="checkbox" class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                    </div>
                    <div class="col-span-1 text-white/60 font-mono">#<?= $set_data['id'] ?></div>
                    <div class="col-span-3">
                        <div class="flex items-center space-x-3">
						<?php 
						if(!empty($set_data['image'])){
							$adv_image = SITEURL.'uploads/banners/'.$set_data['image'];
						}else if(!empty($set_data['additionalimages'])){
							$additionalimages = explode('|',$set_data['additionalimages']);
							//if(file_exists('uploads/banners/'.$additionalimages[0]))
							$adv_image = SITEURL.'uploads/banners/'.$additionalimages[0];
						}else $adv_image = SITEURL.'assets/images/model-gal-no-img.jpg';
						?>
                            <img src="<?php echo $adv_image; ?>" alt="Ad Preview" class="w-10 h-10 rounded-lg object-cover">
                            <div>
                                <h4 class="font-semibold text-white"><?= $set_data['name'] ?></h4>
                                <p class="text-sm text-white/60"><?= $set_data['subtitle'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm font-medium"><?= $set_data['category'] ?></span>
                    </div>
                    <div class="col-span-2 text-white/70"><?= h_dateFormat($set_data['created_at'], 'd M, Y') ?></div>
                    <div class="col-span-1">
                        <span class="status-<?php if (empty($set_data['adv_status'])) { echo 'Active'; }else{ echo $set_data['adv_status'];  }  ?> px-3 py-1 rounded-full text-xs"><?= $status ?></span>
                    </div>
                    <div class="col-span-2">
                        <div class="flex space-x-2">
                            <button class="btn-success px-4 py-2 rounded-lg text-white text-sm font-semibold" onclick="window.location='<?= SITEURL . 'advertisement/edit.php?id=' . $set_data['id'] ?>'">Edit</button>
                            <?php /*?><button class="btn-warning px-4 py-2 rounded-lg text-white text-sm font-semibold" onclick="window.location='<?= SITEURL . 'advertisement/campaign.php?id=' . $set_data['id'] ?>'">Promote</button><?php */ ?>
                            <button class="btn-danger px-3 py-2 rounded-lg text-white text-sm del_<?= $set_data['id'] ?>" onclick="deleteAd(<?php echo $set_data['id']; ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
    }
} else {
    ?>
    <div class="table-row px-8 py-6">
        <div class="grid grid-cols-12 gap-4 items-center">
			<div>There is no data</div>
		</div>
	</div>
<?php
}

?>