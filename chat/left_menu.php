<div id="sidepanel">
    <div id="profile">
      <div class="wrap">
        <img id="profile-img" src="<?=$mDefaultImage?>" class="online" alt="" />
        <p><?=$userDetails['username']?></p>
        
      </div>
    </div>

<ul class="nav nav-pills nav-justified">
  <li class="active"><a data-toggle="pill" href="#chat-home-tab">Main</a></li>
  <li><a data-toggle="pill" href="#chat-other-tab">Other</a></li>
</ul>

    <div id="contacts">
<div class="tab-content">
  <div id="chat-home-tab" class="tab-pane fade in active">
      <ul id="chat-main-list"></ul>
      
  </div>
  <div id="chat-other-tab" class="tab-pane fade">
      <ul id="chat-other-list"></ul>
  </div>
  
</div>
    
</div>
    
  </div>
<script>
function get_list(type,section){
	$.ajax({
		type: 'GET',
		url : "<?php echo SITEURL.'chat/ajax_user.php'?>",
		data:{type:type},
		dataType:'json',
		success: function(response){
			$('#'+section).html(response.html);
		}
	});
}

get_list('main','chat-main-list');
get_list('other','chat-other-list');
</script>
