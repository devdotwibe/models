<?php
if ($all_data) {
    foreach ($all_data as $set_data) {
        if ($set_data['status'] == 0) {
            $status = '<span class="badge bg-primary text-white">Pending</span>';
        } else {
            $status = '<span class="badge bg-primary text-white">' . $set_data['status'] . '</span>';
        }
        $Campaign = DB::queryFirstRow("SELECT * FROM banners_campaign WHERE banner_id = %s ",$set_data['id'],true);

?>
        <tr>
            <td><?= $set_data['id'] ?></td>
            <td><?= $set_data['name'] ?></td>
            <td><?= $set_data['category'] ?></td>
            <td><?= h_dateFormat($set_data['created_at'], 'd M, Y') ?></td>
            <td><?= $status ?></td>
            <td>
<a href="<?= SITEURL . 'advertisement/edit.php?id=' . $set_data['id'] ?>" class="btn btn-xs btn-blue text-white">Edit</a>
<a href="<?= SITEURL . 'advertisement/campaign.php?id=' . $set_data['id'] ?>" class="ml-3 btn btn-xs btn-blue text-white">Promote</a>
<?php
if($Campaign){
    if ($set_data['is_paid'] == 0) {
?>
    &nbsp;&nbsp;<a href="javascript:;" class="btn btn-xs btn-blue text-white">Pay Now</a>
<?php
    }
}
?>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="4">There is no data</td>
    </tr>
<?php
}

?>