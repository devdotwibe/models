<?php  session_start(); ?>
<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <style>    
    .gallery img { 
      width: 200px; 
      height: 300px; 
      transition: 1s ease; 
      
      vertical-align: top;
	  border: 2px solid #968e75;
    } 
    .mn-dv-img{
      width: 200px; 
      height: 300px; 
      position: relative;
      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      vertical-align: top;
	  border: 2px solid #968e75;
    }
    .main-uper-div-img{
    	position: absolute;
    	top: -1px;
    	left: -2px;
    	background: #a7986b;
    	width: 200px; 
    	height: 300px;
    	
    }
    .mn-dv-vdo{
      width: 200px; 
      height: 300px; 
      position: relative;
      float: left;
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      vertical-align: top;
	  border: 2px solid #968e75;
    }
    .main-uper-div-vdo{
    	position: absolute;
    	top: -1px;
    	left: -2px;
    	background: #a7986b;
    	width: 200px; 
    	height: 300px;
    	
    }
    .gallery .free-video { 
        width: 200px; 
        height: 300px; 
        transition: 1s ease; 
        /*margin-left: 10px;
        margin-right: 10px;*/
        margin-top: 10px;
      margin-bottom: 20px;
        border: 2px solid #968e75;
    }
    .gallery .paid-video { 
        width: 200px; 
        height: 300px; 
        transition: 1s ease; 
        /*margin-left: 10px;
        margin-right: 10px;*/
        /*margin-top: 10px;*/
      	margin-bottom: 20px;
        border: 2px solid #968e75;
    }
      
    .gallery img:hover { 
        filter: drop-shadow(4px 4px 6px gray); 
        transform: scale(1.0); 
    } 
    .free-image{
    	margin-top: 10px;
     	margin-bottom: 20px;
    }
    @media only screen and (max-width: 600px) {
	  .gallery {
	    text-align: center !important;
	  }
	}
	.icn-vdo{
		font-size:26px;
		color: black;
		margin-left: 15px;
		margin-top: 15px;
	}
	.icn-img{
		font-size:26px;
		color: black;
		margin-left: 15px;
		margin-top: 15px;
	}
  </style>
<body>
<div class="gallery">
	<?php
  $log_user_id = $_SESSION["log_user_unique_id"];
    $sq = "SELECT * FROM model_images WHERE unique_model_id = '".$var."' ";
      $resu = mysqli_query($con, $sq);
        if (mysqli_num_rows($resu) > 0) {
        	while( $rowe = mysqli_fetch_assoc($resu)){
            $unique_image_id = $rowe['unique_image_id'];

            $sql = "SELECT * FROM user_purchased_image WHERE file_unique_id = '".$unique_image_id."' AND user_unique_id = '".$log_user_id."'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
              $stat = "Purchased";
            }
	?> 

	<?php if($rowe['img_type_price'] == "Paid" && $rowe['file_type'] == "Image"){ ?>
    
    <?php if($stat == "Purchased"){ ?>
    	<img alt="picture" class="bot_plus" src= "<?php echo $rowe["file"]; ?>">  
    <?php }else{ ?>
      <div class="mn-dv-img">
        <form method="post" action="file-process.php">
          <input type="hidden" name="file_id" value="<?php echo $rowe['unique_image_id']; ?>">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
          <input type="hidden" name="coins" value="<?php echo $rowe["coins"]; ?>">

          <input type="hidden" name="file_type" value="<?php echo $rowe['file_type']; ?>">
          <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
          <input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>">
          <input type="hidden" name="model" value="<?php echo $_GET['model']; ?>">

          <img alt="picture" src= "<?php echo $rowe["file"]; ?>">
          <div class="main-uper-div-img">
            <i class="fa fa-image icn-img" ></i>
            <button class="btn btn-success" style="color: #010101;font-size: 16px;margin-left: 30%;margin-right: 30%;margin-top: 100px;margin-bottom: 100px;" type="submit" name="submit">
              <i class="fas fa-coins" style="font-size:15px;color:#010101" aria-hidden="true"></i>&nbsp;<?php echo $rowe["coins"]; ?>
            </button>
          </div>
        </form>
      </div>
    <?php } ?> 
    
	<?php }else if($rowe['img_type_price'] == "Free" && $rowe['file_type'] == "Image"){ ?>

		<img alt="picture" class="free-image bot_plus" src= "<?php echo $rowe["file"]; ?>" >

	<?php	}else if($rowe['img_type_price'] == "Paid" && $rowe['file_type'] == "Video"){ ?>	
      
      <?php if($stat == "Purchased"){ ?>
        <video class="paid-video" controls> <source src="../<?php echo $rowe["file"]; ?>" type="video/mp4"> </video>
      <?php }else{ ?>
  		<div class="mn-dv-vdo">
        <form method="post" action="file-process.php">
          <input type="hidden" name="file_id" value="<?php echo $rowe['unique_image_id']; ?>">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">

          <input type="hidden" name="file_type" value="<?php echo $rowe['file_type']; ?>">
          <input type="hidden" name="m_unique_id" value="<?php echo $_GET['m_unique_id']; ?>">
          <input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>">
          <input type="hidden" name="model" value="<?php echo $_GET['model']; ?>">

      			<video class="paid-video" controls> <source src="../<?php echo $rowe["file"]; ?>" type="video/mp4"> </video>
      			<div class="main-uper-div-vdo">
      				<i class="fa fa-video icn-vdo" ></i>
      				<button class="btn btn-success" type="submit" name="submit" style="color: #010101;font-size: 16px;margin-left: 30%;margin-right: 30%;margin-top: 100px;margin-bottom: 100px;">
      					<i class="fas fa-coins" style="font-size:15px;color:#010101" aria-hidden="true"></i>&nbsp;<?php echo $rowe["coins"]; ?>
      				</button>
      			</div>
        </form>
      </div>
      <?php } ?>

	<?php }else if($rowe['img_type_price'] == "Free" && $rowe['file_type'] == "Video"){ ?> 

		<video class="free-video" controls> <source src="../<?php echo $rowe["file"]; ?>" type="video/mp4"> </video>	

	<?php			
			}
		  unset($stat);
    }
      } else {
        echo "Currently they have 0 Images.";
      }
  ?>
 </div>
    
</body>
</html>
