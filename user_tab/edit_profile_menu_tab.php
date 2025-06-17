<ul class="nav nav-tabs new-tabs mb-3">
<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('basic')))?'active':''
?>"><a href="<?=SITEURL.'edit-profile.php'?>"> Basic Details</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('about')))?'active':''
?>"><a href="<?=SITEURL.'model-panel/edit-about-details.php'?>">About</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('services')))?'active':''
?>"><a href="<?=SITEURL.'model-panel/edit-extra-details.php'?>">Services</a></li>


</ul>