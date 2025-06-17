<?php  session_start(); ?>
<?php include('includes/config.php'); ?>
  <style type="text/css">
    .owl-nav button {
  position: absolute;
  top: 50%;
  background-color: #000;
  color: #fff;
  margin: 0;
  transition: all 0.3s ease-in-out;
}
.owl-nav button.owl-prev {
  left: 0;
}
.owl-nav button.owl-next {
  right: 0;
}


.owl-dots button.owl-dot.active {
  background-color: #000;
}
.owl-dots button.owl-dot:focus {
  outline: none;
}
.owl-nav button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    /*background: rgba(255, 255, 255, 0.38) !important;*/
}
.owl-nav button:focus {
    outline: none;
}

</style>
<div class="owl-slider"  style="margin-bottom: 40px;">
	<div id="carousel" class="owl-carousel">
         <?php
          $count = 1;
            $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' Order by id DESC LIMIT 10 ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw = mysqli_fetch_assoc($resultd)) {
                    //echo $rowesdw['unique_id'];


                    $sql = "SELECT * FROM model_images WHERE file_type = 'Image' AND img_type_price = 'Free' AND unique_model_id = '".$rowesdw['unique_id']."' Order by id DESC LIMIT 1 ";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      $rowes = mysqli_fetch_assoc($result);   
                    
        ?>
          	
          <div class="item">
            <div class="usern">
              <a href="single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id'];?>" style="padding-left: 10px;">
                <figure class="user_profile">
                  <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>">
                </figure>
                <span class="usernme">
                  <?php echo $rowesdw['username']; ?>
                </span>
              </a>      
            </div>
            <?php if($rowes['file_type'] == 'Image'){ ?>
            <div class="main_dv" data-toggle="modal" data-target="#myModal<?php echo $count; ?>">
              <img class="main_b_image" src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowes['file']; ?>">
            </div>
            <?php }else{ ?>
              <video class="vid_tg" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>" poster="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepnglogos.com%2Fpics%2Fplay-button&psig=AOvVaw1-hkjwv4JrjlgfrWxeGIS7&ust=1604999564593000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCMCj6NSP9ewCFQAAAAAdAAAAABAD">
                <source src="<?php echo $rowes['file']; ?>/#t=2" type="video/mp4">
              </video>
            <?php } ?>
            
            <p class="img_desc"><?php echo $rowes['image_text']; ?></p>
          </div>

  <?php
                    } 
    $count++;
    }
      } else {
        echo "No model's here.";
      }
  ?>
  

</div>
</div>
  <?php
          $count = 1;
            $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' Order by id DESC LIMIT 10 ";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  while($rowesdw1 = mysqli_fetch_assoc($resultd)) {
                    
                    $sql1 = "SELECT * FROM model_images WHERE file_type = 'Image' AND img_type_price = 'Free' AND unique_model_id = '".$rowesdw1['unique_id']."' Order by id DESC LIMIT 1 ";
                    $result1 = mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                      $rowes1 = mysqli_fetch_assoc($result1);
          ?>
<div class="modal fade" id="myModal<?php echo $count; ?>" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            
            <?php if($rowes1['file_type'] == 'Image'){ ?>
            <img src="<?php echo $rowes1['file']; ?>" style="height: 500px;border-radius: 20px 0 0 20px;" alt="">
            <?php }else{ ?>
              <video style="height: 500px;border-radius: 20px 0 0 20px;" controls data-toggle="modal" data-target="#myModal<?php echo $count; ?>"poster= "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepnglogos.com%2Fpics%2Fplay-button&psig=AOvVaw1-hkjwv4JrjlgfrWxeGIS7&ust=1604999564593000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCMCj6NSP9ewCFQAAAAAdAAAAABAD">
                <source src="<?php echo $rowes1['file']; ?>" type="video/mp4">
              </video>
            <?php } ?>
          </div>
          <div class="col-md-6">
            <button type="button" class="close" data-dismiss="modal" style="padding-right: 15px;padding-top: 15px;">&times;</button>
            <div class="usern model-prof">
              <a title="" href="single-profile.php?m_unique_id=<?php echo $rowesdw1['unique_id'];?>" >
                <figure class="user_profile">
                  <img src="<?php echo $rowesdw1['profile_pic'] ?>">
                </figure>
                <span>
                  <p class="username"><?php echo $rowesdw1['username']; ?></p>
                </span>
              </a>      
            </div>
            <p><?php echo $rowes1['image_text'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php
                    } 
    $count++;
    }
      } else {
        echo "0 results";
      }
  ?>

</body>
<script type="text/javascript">
  jQuery("#carousel").owlCarousel({
  autoplay: true,
  lazyLoad: true,
  loop: true,
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  // nav: true,
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 2
    },
    900: {
      items: 3
    },

    1024: {
      items: 4
    },

    1366: {
      items: 4
    }
  }
});
</script>
</html>


 