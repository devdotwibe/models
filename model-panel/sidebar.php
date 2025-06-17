<style>
	.sidebar-ul li {
    padding: 10px;
}
</style>
<div id="sidebar" class="pull-left col-xs-12 col-md-3 col-sm-12" style="border-right: 2px solid #d83b1b;">
  <ul class="sidebar-ul">
    <li><a href="dashboard.php">Dashboard</a></li>

    <?php

     $sqls = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."'";
          $resultd = mysqli_query($con, $sqls);
            if (mysqli_num_rows($resultd) > 0) {
              $rowesdw = mysqli_fetch_assoc($resultd);
              $video_pictures = $rowesdw['video_pictures'];
          }
    ?>
    <?php if($video_pictures == 'Yes'){
      echo '<li><a href="images.php">Add/View Images</a></li>';
    } ?>
    
    <li><a href="extra-details.php">Edit details</a></li>
    <!-- <li><a href="insta-snap.php">schedule call on insta or snap</a></li> -->
    <!-- <li><a href="model-rates.php">Rates</a></li> -->
    
    <li><a href="social-media.php">Instagram & Snapchat link</a></li>
    <li><a href="amount-withdrawal.php">Amount Withdrawal</a></li>
    <li><a href="../logout.php">Logout</a></li>
  </ul>
</div>