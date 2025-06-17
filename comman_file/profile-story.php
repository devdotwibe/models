<link href="<?=SITEURL?>assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="<?=SITEURL?>assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 


<div id="story-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>

<!-- <link href="<?='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css'?>" rel="stylesheet" type="text/css"> -->
<script src="<?='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'?>"></script>  
<script>
var modal_id;
function storyModal(id){
    modal_id=id;
    $('#story-modal .modal-body').html('<div class="text-center">Loading..</div>');
    $('#story-modal').modal();
    callStory(id);
}
function delete_story(id){
      $.ajax({
        type: 'GET',
        url: "<?php echo SITEURL . 'user/story/ajaxstorydelete.php' ?>",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          if(response.status=='ok'){
            callStory(modal_id);
          }
          else{
            alert(response.message);
          }
        }
      });
}
function callStory(id){
  $.ajax({
        type: 'GET',
        url: "<?php echo SITEURL . 'user/story/ajaxstory.php' ?>",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#story-modal .modal-body').html('<button type="button" class="close close_stle" data-dismiss="modal">&times;</button>' + response.html);
        }
      });
}
</script>
<style>
  .img-size{
/*  padding: 0;
    margin: 0; */
    height: 450px;
    width: 700px;
    background-size: cover;
    overflow: hidden;
}
#story-modal .close_stle{
    position: absolute;
    top: 5px;
    right: -5px;
    z-index: 3;
    background-color: #000;
    color: #FFF;
    padding: 3px 7px;
    border-radius: 50%
}
#story-modal .modal-body {
    width: auto;
    height: auto;
}
#story-modal .owl-dots{
  display: none;
}
.story-satus-list{
  position: relative;
}
.message-content{
  position: absolute;
  width: 100%;
  bottom: 0;
  background-color: rgb(6 6 6 / 70%);
  max-height: 125px;
  min-height: 60px;
  padding-top: 5px;
}
.message-text{
  text-align: center;
  margin-bottom: 10px;
}
.message-option{
  display: flex;
  justify-content: center;
  
}
.message-option button{
  background-color: transparent;
  color: #FFF;
  border: none;
}
</style>
