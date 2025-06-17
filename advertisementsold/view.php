<?php 
  session_start(); 
  include('../includes/config.php');
  include('../includes/helper.php');
$f_country_list = DB::query('select id,name,sortname from countries order by name asc');
	$id= 0;
	//create post data
	if($_GET['id']){
		$id= $_GET['id'];
		$form_data = DB::queryFirstRow("select tb.*,mu.age from banners tb
join model_user mu on mu.id=tb.user_id		
		 where tb.id='".$id."' ");
		if($form_data){
		}
		else{
			header("Location: ".SITEURL."advertisements");
		}
	}
	else{
		header("Location: ".SITEURL."advertisements");
	}
?>

<!doctype html>
<html lang="en-US" class="no-js">
<head>
<title>Advertisements | All Models</title>

<?php 
  include('../includes/head.php');
?>
<style type="text/css">
.login-signup {
  padding: 0 0 25px;
}
.adv-title{
	color:#000;
}
.adv-image {
    display: flex;
    justify-content: center;
    align-items: center;
}
.adv-image img{
	width:auto;
	height:450px;
}
@media (max-width: 768px){
.adv-image img{
	width:100%;
	height:auto;
}

}
.video-ci{
	width:100%;
	height:auto;
}

.creator{
	text-align:initial;
}

.adv-meta{
	display:flex;
	justify-content: space-between;
	margin-bottom:10px;
	font-size: 14px;
}
.adv-meta-title{
	color:#221b1b;
	font-weight:bold;
}
.card-footer{
	background-color: #d83b1b;
}
</style>
  </head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
    <?php include('../includes/header.php'); ?>

    <div class="container">
        <!-- <h2 class="page_heading">All Models</h2> -->
    <div class="login-signup">
      <div class="row">
      <div class="col-md-12 adv-list">
  <div class="card adv-cp mt-2">
<div class="adv-image">

<?php
if(!empty($form_data['video'])){
?>
<video class="video-ci" controls  >
<source src="<?php echo SITEURL.'uploads/banners/'.$form_data['video']; ?>" type="video/mp4">
</video>
<?php
}
else{
?>
<img src="<?php echo SITEURL.'uploads/banners/'.$form_data['image']; ?>" alt="" />
<?php
}
?>


</div>
<div class="" style="padding:10px">
<h2 class="adv-title"><?php echo $form_data['name']; ?></h2>
<div ><?=$form_data['description']?></div>
<hr style="margin-bottom:10px;margin-top:10px;">

<div class="adv-meta">
<div class="adv-meta-title">Age</div>
<div class="adv-meta-value"><?=$form_data['age']?> Years</div>
</div>

<div class="adv-meta">
<div class="adv-meta-title">Service</div>
<div class="adv-meta-value"><?=$form_data['category']?></div>
</div>

<div class="adv-meta">
<div class="adv-meta-title">Location</div>
<div class="adv-meta-value">
<?=print_value('cities',array('id'=>$form_data['city']),'name')?>, 
<?=print_value('states',array('id'=>$form_data['state']),'name')?>, 
<?=print_value('countries',array('id'=>$form_data['country']),'name')?></div>
</div>

</div>

<div class="card-footer">
<div class="d-flex justify-content-between row">
	<div class="col-xs-6"><button class="btn btn-white btn-block" onclick="window.location='<?=SITEURL.'chat/view.php?id='.$form_data['user_id']?>'">Contact</button></div>
	<div class="col-xs-6"><button class="btn btn-green btn-block" onclick="window.location='<?=SITEURL.'chat/view.php?id='.$form_data['user_id']?>'" >Call</button></div>
</div>
</div>

    </div>
</div>
	</div>      
      
        
      </div>
      
  
        
          
      </div>
   <?php include('../includes/footer.php'); ?>
  </body>


</html> 
