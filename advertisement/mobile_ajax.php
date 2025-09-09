<?php
if ($all_data) {
    foreach ($all_data as $index => $set_data) {
        if (empty($set_data['adv_status'])) {
            $status = '<span class="badge bg-primary text-white">Active</span>';
        } else {
            $status = '<span class="badge bg-primary text-white">' . $set_data['adv_status'] . '</span>';
        }
        $Campaign = DB::queryFirstRow("SELECT * FROM banners_campaign WHERE banner_id = %s ", $set_data['id'], true);

?>


        <div class="max-w-3xl mx-auto mt-10 rounded-xl bg-[#131a2a] p-6 shadow-lg" id="adv_row_mob_<?= $set_data['id'] ?>">

            <div class="grid grid-cols-12 gap-4 mb-4 mob1">


                <!-- <div class="mob-tit"> -->

                    <div class="col-span-2">

                        <b class="block">ID</b>

                        <span>#<?= $index + 1  ?></span>

                    </div>


                    <div class="col-span-5">

                        <b class="block">TITLE</b>

                        <div class="flex items-center mt-2 space-x-3">

                            <?php
                            if (!empty($set_data['image'])) {
                                $adv_image = SITEURL . 'uploads/banners/' . $set_data['image'];
                            } else if (!empty($set_data['additionalimages'])) {
                                $additionalimages = explode('|', $set_data['additionalimages']);
                                //if(file_exists('uploads/banners/'.$additionalimages[0]))
                                $adv_image = SITEURL . 'uploads/banners/' . $additionalimages[0];
                            } else $adv_image = SITEURL . 'assets/images/model-gal-no-img.jpg';
                            ?>


                            <img src="<?php echo $adv_image; ?>" alt="Ad Preview" class="w-10 h-10 rounded-lg object-cover">

                            <div class="leading-tight">

                                <b class="block text-base"><?= $set_data['name'] ?></b>

                                <small class="text-gray-400 text-sm"><?= $set_data['subtitle'] ?></small>

                            </div>

                        </div>

                    </div>

                <!-- </div> -->


                <div class="col-span-3">

                    <b class="block">CATEGORY</b>

                    <span class="inline-block bg-purple-600 text-white text-sm px-3 py-1 rounded-full mt-2">
                        <?= $set_data['category'] ?>
                    </span>

                </div>


                <div class="col-span-2">

                    <b class="block">DATE</b>

                    <span><?= h_dateFormat($set_data['created_at'], 'd M, Y') ?></span>

                </div>

            </div>


            <div class="grid grid-cols-12 gap-4 items-center mob1 mob2">


                <div class="col-span-3">

                    <b class="block">STATUS</b>

                    <span class="inline-block bg-yellow-400 text-black font-semibold text-sm px-3 py-1 rounded-md mt-2 status-<?php if (empty($set_data['adv_status'])) {
                                                                                                                                    echo 'Active';
                                                                                                                                } else {
                                                                                                                                    echo $set_data['adv_status'];
                                                                                                                                }  ?> ">
                        <?= $status ?>
                    </span>
                </div>


                <div class="col-span-9 flex items-center space-x-2">
                    <b class="mr-2">OPTIONS</b>

                    <button class="btn-success px-4 py-2 rounded-lg text-white text-sm font-semibold" onclick="window.location='<?= SITEURL . 'advertisement/edit.php?id=' . $set_data['id'] ?>'">Edit</button>
                    <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white text-sm font-semibold" onclick="window.location='<?= SITEURL . 'advertisements/view.php?id=' . $set_data['id'] ?>'">View</button>
                    <button class="btn-warning px-4 py-2 rounded-lg text-white text-sm font-semibold" onclick="window.location='<?= SITEURL . 'boost-advertisement/index.php?id=' . $set_data['id'] ?>'">Promote</button>

                    <button class="btn-danger px-3 py-2 rounded-lg text-white text-sm del_<?= $set_data['id'] ?>" onclick="deleteAd(<?php echo $set_data['id']; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </button>
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