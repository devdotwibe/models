<ul class="nav nav-tabs new-tabs">
<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('services-requested')))?'active':''
?>"><a href="<?=SITEURL.'services-requested.php'?>">Requested</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('dating_booking','group-show','international-tours-booking','movie-assignments-booking')))?'active':''
?>"><a href="<?=SITEURL.'dating_booking'?>">Booking</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('sd')))?'active':''
?>"><a href="javacscript:;">Complete</a></li>

</ul>