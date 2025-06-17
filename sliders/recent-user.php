<?php

if( $_GET["type"]=="livecam" ){ 
	//echo 'livecam'; 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.live_cam='Yes' ";
	//$bod="Live Cams";
}
elseif( $_GET["type"]=="groupshow" ){ 
	//echo 'groupshow'; 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.group_show='Yes' ";
	//$bod="Group Shows";
}
elseif( $_GET["type"]=="dating" ){ 
	//echo 'dateing'; 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.work_escort='Yes' ";
	//$bod="Dating Assignments";
}
elseif( $_GET["type"]=="invite" ){ 
	//echo 'invite'; 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.international_tours='Yes' ";
	//$bod="Accept Invitation Tours";
}
elseif( $_GET["type"]=="content" ){ 
	//echo 'content'; 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.video_pictures='Yes' ";
	//$bod="With Pictures And Videos";
}
elseif( $_GET["type"]=="modeling" ){ 
	//echo 'modeling'; 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.modeling_porn_assignment='Yes' ";
	//$bod="Modeling & Video Assignments";
}
elseif( $_GET["type"]=="30days" ){ 
	$query="select tb.* from model_user tb join model_extra_details jmed on jmed.unique_model_id=tb.unique_id where jmed.all_30day_access='Yes' ";
	//$bod="30 Days Account Acccess";
}

$recent_logged = DB::query($query." order by date(tb.logged_update) desc limit 20");
//printR($recent_logged);die;
if($recent_logged){
?>

<style type="text/css">
.heading_txt {
	font-weight: bolder;
	padding-top: 10px;
	margin-bottom: 20px;
	border-bottom: 1px solid lightgrey;
	padding-bottom: 20px;
}

body .owl-carousel.owl-loading {
    opacity: 1;
    display: block;
    text-align: center;
}
.owl-prev,.owl-next{
	font-size: 30px;
	/*background: rgb(166, 166, 255);*/
	color: white;
	border: 0;
	margin: 7px;
}

.owl-prev:hover,.owl-next:hover,.owl-prev:focus,.owl-next:focus{
    outline: none;
}
.owl-item {
    border-radius: 4px;

}
a.item {
    /*display: flex;*/
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #f00;
    cursor: pointer;
    text-align: center;
    /*padding: 78px 30px;*/
}
.sml_tst{
  font-size: 14px;
  color: #ffffff;
}
.owl-carousel.owl-drag .owl-item{
  text-align: center;
}
.item:hover{
    text-decoration-line: none;
}
.owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled {
    display: block;
    margin-top: 10px;
}
body .owl-carousel .owl-dots, 
body .owl-carousel .owl-nav {
    display: block;
    margin-top: 10px;
    text-align: center;
}
body .owl-carousel .owl-dots.disabled, 
body .owl-carousel .owl-nav.disabled {
    display: block;
}
.owl-dot{
    display: none;
}


  </style>
<script type="text/javascript">
jQuery(document).ready(function($) {
var $owl = $('.owl-carousel');
  $owl.children().each( function( index ) {
	jQuery(this).attr( 'data-position', index ); 
  });
  
  $owl.owlCarousel({
	// center: true,
	nav:true,
	loop: true,
	items: 5,
	margin:10,
	navText: ["<i class='fa arrow-circle-left'><</i>","<i class='fa arrow-right'>></i>"],
	responsive:{
	  0:{
		  items:3
	  },
	  600:{
		  items:3
	  },
	  1000:{
		  items:9
	  }
   }
  });
$(document).on('click', '.item', function() {
  $owl.trigger('to.owl.carousel', $(this).data( 'position' ) ); 
});
	  });
</script>
<div>
<h2 class="heading_txt">Recently Active</h2>

<div class="owl-carousel"  style="margin-bottom: 40px;">
<img src="https://thelivemodels.com/assets/images/imgpsh_fullsize_anim.gif" alt="gif" style="border-radius: 50%;width: 120px;height: 120px;border: 4px solid #d83b1b;">
<?php
	$count= 0;
foreach($recent_logged as $set_recent_logged){

?>
<a class="item item<?php echo $count; ?>" href="single-profile.php?m_unique_id=<?php echo $set_recent_logged['unique_id']; ?>" >
<img src="<?= SITEURL . 'ajax/noimage.php?image=' . $set_recent_logged['profile_pic']; ?>" style="border-radius: 50%;width: 120px;height: 120px;border: 4px solid #d83b1b;">

<small class="sml_tst"><?php echo $set_recent_logged['username']; ?></small>
</a>
<?php
	$count++;
}
?>
<!-- <a class="item item2" >2</a>
<a class="item item3" >3</a>
<a class="item item4" >4</a>
<a class="item item5" >5</a> -->
</div>
</div>

<?php
}
?>