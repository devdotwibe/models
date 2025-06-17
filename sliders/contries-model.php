<?php  session_start(); ?>
<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
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
</head>
<body>
<div class="owl-slider"  style="margin-bottom: 40px;">
<div id="carousel1" class="owl-carousel">
  <?php
    $count = 1;
      $sql_ctry = "SELECT DISTINCT country FROM model_user ORDER BY id DESC ";
      $result_ctry = mysqli_query($con, $sql_ctry);
      if (mysqli_num_rows($result_ctry) > 0) {
        while($row_ctry = mysqli_fetch_assoc($result_ctry)) {

        $sqls = "SELECT * FROM model_user WHERE country = '".$row_ctry['country']."' ";
        $resultd = mysqli_query($con, $sqls);
          if (mysqli_num_rows($resultd) > 0) {
            while($rowesdw = mysqli_fetch_assoc($resultd)) {


              $sql = "SELECT * FROM model_images WHERE file_type = 'Image' AND img_type_price = 'Free' AND unique_model_id = '".$rowesdw['unique_id']."' Order by id DESC LIMIT 1";
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
      <div class="main_dv" data-toggle="modal" data-target="#myModal123<?php echo $count; ?>">
        <img class="main_b_image" src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowes['file']; ?>">
      </div>
      <p class="img_desc"><?php echo $rowes['image_text']; ?></p>
    </div>

  <?php

    }

    $count++;
    }
      } else {
        echo "0 results";
      }
  ?>
  <?php }
      }?>
</div>
</div>
<?php
      $count1 = 1;   
      $sqls1 = "SELECT DISTINCT country,profile_pic,username,id,unique_id FROM model_user ";
        $resultd = mysqli_query($con, $sqls1);
          if (mysqli_num_rows($resultd) > 0) {
            while($rowesdw1 = mysqli_fetch_assoc($resultd)) {


              $sql1 = "SELECT * FROM model_images WHERE file_type = 'Image' AND img_type_price = 'Free' AND unique_model_id = '".$rowesdw1['unique_id']."' Order by id DESC LIMIT 1";
              $result1 = mysqli_query($con, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                $rowes1 = mysqli_fetch_assoc($result1);
              
    ?>
  
<div class="modal fade" id="myModal123<?php echo $count1; ?>" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6"><img src="<?php echo $rowes1['file']; ?>" style="height: 500px;border-radius: 20px 0 0 20px;" alt=""></div>
          <div class="col-md-6">
            <button type="button" class="close" data-dismiss="modal" style="padding-right: 15px;padding-top: 15px;">&times;</button>
            <div class="usern model-prof">
              <a title="" href="single-profile.php?m_unique_id=<?php echo $rowesdw1['unique_id'];?>" >
                <figure class="user_profile">
                  <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw1['profile_pic']; ?>">
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


    $count1++;
    }
      } else {
        echo "0 results";
      }
  ?>
</body>
<script type="text/javascript">
  jQuery("#carousel1").owlCarousel({
  autoplay: true,
  lazyLoad: true,
  loop: false,
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