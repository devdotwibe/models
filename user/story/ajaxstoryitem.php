<?php
if($story_list){
    $i=0;
?>
<div class="owl-carousel story-owl-carousel owl-theme">
<?php
	foreach($story_list as $set_data){
?>
<div class="story-satus-list story-li-<?=$i?>" data-id="<?=$set_data['id']?>">
<img class="owl-lazy" data-src="<?=SITEURL.'uploads/story/'.$set_data['files']?>" alt="">
<div class="message-content">
<div class="message-text">
    <?=$set_data['message']?>
</div>
<?php
if($viewBtn){
?>
<div class="message-option">
    <button class=""><i class="fa fa-eye"></i> <?=get_count('model_user_story_view',array('story_id'=>$set_data['id']))?></button>
    <button class="text-danger" onclick="delete_story(<?=$set_data['id']?>)"><i class="fa fa-trash"></i></button>
    
</div>
<?php
}
?>
</div>
</div>
<?php
        $i++;
	}
?>
</div >
<script>
var viewTimer = 10;
var setTimeoutID;
$('.story-owl-carousel').owlCarousel({
    items:1,
    lazyLoad:true,
    loop:false,
    autoHeight:true,
    autoplay:true,
    autoplayTimeout:viewTimer*1000,
    margin:10
});  

var owl = $(".story-owl-carousel")
owl.on('changed.owl.carousel', function (e) {
    console.log("current: ",e.item.index) //same
    //console.log("total: ",e.item.count)   //total
//    console.log($('.story-li-'+(e.item.index)).attr('data-id'));
    var id = $('.story-li-'+(e.item.index)).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "<?php echo SITEURL . 'user/story/ajaxstorycount.php' ?>",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
        }
    });
    if(e.item.count==(e.item.index+1)){
        setTimeoutID= setTimeout(function(){
           // console.log('timeout');
           $('#story-modal').modal('hide');
         }, viewTimer*1000);
    }
    else{
        clearTimeout(setTimeoutID);        
    }
    
})
</script>

<?php
 }
else{
?>
<div class="p-4 text-center" ><h4>There is no story.</h4></div>
<?php	
}
?>
