<?php  session_start(); ?>
<style>
.comment-scroll{
	overflow-y: scroll;
	height: 450px;
	padding: 10px 0;
}
.comment-area {
	padding: 0 20px 10px;
}
.comment-area .card + .card{
	margin-top:10px;
}

.comment-area .dots{

    height: 4px;
  width: 4px;
  margin-bottom: 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}

.comment-area .user-img{
    margin-top: 4px;
}
.comment-area .comment-username{
	font-size:16px;
	color:#3c3c3c;
}
.comment-area .comment-text{
	font-size:14px;
}
</style>
<div class="comment-area">
<div class="row ">
    <div class="col-md-12">

        <div class="headings d-flex justify-content-between align-items-center mb-3">
            <h5>Comments(<?=$getCommentList?count($getCommentList):'0'?>)</h5>
        </div>

<div class="comment-scroll">
<?php
if($getCommentList){
foreach($getCommentList as $set_comment){
?>
<div class="card p-3">

<div class="d-flex justify-content-between align-items-start ">

<div class="user d-flex flex-row align-items-start ">
<img src="<?=!empty($set_comment['profile_pic'])?SITEURL.$set_comment['profile_pic']:SITEURL.'assets/images/girl.png'?>"
 width="30" class="user-img rounded-circle mr-2">
<div>
<span>
<small class="comment-username"><?=$set_comment['username']?></small></span>
<div class="comment-text"><?=$set_comment['comment']?></div>
</div>

</div>

<small><?=h_dateFormat($set_comment['created_date'],'d M, Y H:i')?></small>

</div>

</div>
<?php
}
}
?>
</div>
<div class="comment-form">
<form class="form-inline d-flex" role="form" id="comment-forms">
<input type="hidden" name="model_id" value="<?=$getImage['id']?>" />
    <div class="form-group" style="width:90%">
        <input class="form-control" name="comment" style="width:100%" type="text" placeholder="Your comments" />
    </div>
    <div class="form-group">
        <button class="btn btn-default">Send</button>
    </div>
</form>
<div class="message"></div>
</div>        
    </div>
    
</div>
</div>
<script type="text/javascript">
$("#comment-forms" ).validate({
    submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-notch fa-spin"></i> Sending..';
		$('#comment-forms .submitBtn').prop('disabled', true).html(loadingText);
		$('.message').html('');
		$.ajax({ 
			type: 'GET',
			url: '<?=SITEURL.'modalprofile/act_save_comment.php'?>', 
			data: $("#comment-forms").serialize(),
			dataType: 'json',
			success: function(response) { 
				$("#comment-forms  .submitBtn").html('Send').prop('disabled', false);
				if(response.status=='ok'){
					ajaxPostModal(<?=$getImage['id']?>);
				}
				else{
            		$('.message').html('<div class="alert alert-danger">'+response.message+'</div>');
				} 
	        }
		});
		return false;
	}
});
</script>
