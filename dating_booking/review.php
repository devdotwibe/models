<?php
session_start();
include('../includes/config.php');
include('../includes/helper.php');

if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		header("Location: ../login.php");
	}
}
$id = $_GET['id'];
if(!$id){
	if(!$userDetails){
		header("Location: ".SITEURL."dating_booking");
	}
}

$booking_data = DB::queryFirstRow("SELECT * FROM booking_dating_assignments WHERE `status`='accept' and id = %s and 
( user_unique_id = %s or model_unique_id = %s ) ",$id,$_SESSION['log_user_unique_id'], $_SESSION['log_user_unique_id']);
//echo DB::lastQuery();
//printR($booking_data);die;
if(!$booking_data){
	header("Location: ".SITEURL."dating_booking");
}
if($booking_data['model_unique_id']==$userDetails['unique_id']){
	$user_to = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id = %s",$booking_data['user_unique_id']);
}
else{
	$user_to = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id = %s",$booking_data['model_unique_id']);
}
if(!$user_to){
	echo '<script>alert("There is no user.")</script>';
	header("Location: ".SITEURL."dating_booking");
}
$review = DB::queryFirstRow("SELECT * FROM booking_dating_assignments_review WHERE booking_id = %s and sender_id = %s ",$id,$userDetails['id']);
if($review){
	echo '<script>alert("Your already given.")</script>';
	if($booking_data['model_unique_id']==$userDetails['unique_id']){
		echo '<script>window.location="'.SITEURL.'services-requested.php"</script>';
	}
	else{
		echo '<script>window.location="'.SITEURL.'dating_booking/"</script>';
	}
	die;
}
if($_POST){
	$arr = array('rate','comment');
	$post_data = array_from_post($arr);
	$post_data['booking_id'] = $id;
	$post_data['sender_id'] = $userDetails['id'];
	$post_data['user_id'] = $user_to['id'];
	$post_data['created_date'] = date('Y-m-d H:i:s');
	
	DB::insert('booking_dating_assignments_review', $post_data);
	$created_id = DB::insertId();

	echo '<script>alert("Your Review has successfully submitted.")</script>';
	if($booking_data['model_unique_id']==$userDetails['unique_id']){
		echo '<script>window.location="'.SITEURL.'services-requested.php"</script>';
	}
	else{
		echo '<script>window.location="'.SITEURL.'dating_booking/"</script>';
	}
				
	die;
}
?>
<!doctype html>
<html lang="en-US" class="no-js">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
<?php include('../includes/head.php');?>
</head>
  <body class="page-template-default page page-id-311 custom-background">
    <?php include('../includes/header.php'); ?>
    <div class="container-fluid">
      <div id="content" class="clearfix row">
        <div id="main" class="col-md-12 clearfix" role="main">
          <article id="post-311" class="clearfix post-311 page type-page status-publish hentry" >
            <header class="page-head article-header">
              <div class="headline-outer">
                <h1 itemprop="headline" class="page-title entry-title">
                  <div class="prefancy fancy">
                    <span>Review</span>
                  </div>
                </h1>
              </div>
            </header>
            <!-- end article header -->
            <section class="page-content entry-content clearfix" itemprop="articleBody">
              <div class="artivle-body-bg">
              

                <div class="container-fluid" >
                 <div class="row" style="margin-left:0px;margin-right:0px;"> 
                  
<div class="col-sm-12  d-flex justify-content-center">
<div class="card " style="width:40%">
	<div class="card-body">
<form method="post" ><!--form-inline-->
	  <div class="form-group">
	    <label for="email">Rate:</label>
<div>
<?php
for($i=1;$i<=5;$i++){
?>
<label class="radio-inline"><input type="radio" name="rate" value="<?=$i?>"  <?=$i==5?'checked':''?>><?=$i?></label>
<?php
}
?>
</div>
	  </div>
      
      <div class="form-group">
	    <label for="email">Comment:</label>
<div>
<textarea name="comment" class="form-control" required></textarea>
</div>
	  </div>
      
      <button type="submit" class="btn btn-info" >Submit</button>
	 	
	</form>
	</div>
</div>
                    
                 </div><!--col-md-12-->
                 
                </div>
              </div>

                
              </div>
            </section>
          </article>
        </div>
      </div>
    </div>
    <?php include('../includes/footer.php'); ?>
  </body>
</html>