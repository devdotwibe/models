<?php  session_start(); ?>
<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" type="text/css" href="http://newmodels.systostechnology.com/assets/wp-content/themes/theagency3/library/css/style.css">
	<style type="text/css">
		/* Click the image one by one to see the different layout */

/* Owl Carousel */

.owl-prev {
  background: url('https://res.cloudinary.com/milairagny/image/upload/v1487938188/left-arrow_rlxamy.png') left center no-repeat;
  height: 54px;
  position: absolute;
  top: 50%;
  width: 27px;
  z-index: 1000;
  left: 2%;
  cursor: pointer;
  color: transparent;
  margin-top: -27px;
}

.owl-next {
  background: url('https://res.cloudinary.com/milairagny/image/upload/v1487938220/right-arrow_zwe9sf.png') right center no-repeat;
  height: 54px;
  position: absolute;
  top: 50%;
  width: 27px;
  z-index: 1000;
  right: 2%;
  cursor: pointer;
  color: transparent;
  margin-top: -27px;
}

.owl-prev:hover,
.owl-next:hover {
  opacity: 0.5;
}


/* Owl Carousel */


/* Popup Text */

.white-popup-block {
  background: #FFF;
  padding: 20px 30px;
  text-align: left;
  max-width: 650px;
  margin: 40px auto;
  position: relative;
}

.popuptext {
  display: table;
}
.popuptext p {
  margin-bottom: 10px;
}
.popuptext span {
  font-weight: bold;
  float: right;
}
/* Popup Text */

/* Icon CSS */
.item {
  position: relative;
  border-radius: 30px;

}
.item i {
  display: none;
  font-size: 4rem;
  color: #FFF;
  opacity: 1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);

}
.item a {
  display: block;
  width: 100%;
  border-radius: 30px;
}
.item a:hover:before {
  /*content: "";
  background: rgba(0, 0, 0, 0.5);
  position: absolute;
  height: 100%;
  width: 100%;
  z-index: 1;*/
  transform: scale(1.1);
}
.item a:hover i {
  display: block;
  z-index: 2;
}
.fix_dv{
	height: 350px;
  border-radius: 30px;
  border:2px solid #e3451e;
  overflow: hidden;
}
.fix_dv .big_img{
  height: 350px;
  width: auto;
  /*border-radius: 30px;*/
  transition: 1s ease;
}
.fix_dv .big_img:hover{
  transform: scale(1.1);: 
}
</style>
</head>
<body>
  <div class="framebox">
<div class="owl-carousel" id="carousel1">
  <?php
    $count = 1;
    $sqls = "SELECT * FROM casting WHERE status = 'Published' Order by id ASC LIMIT 6 ";
    $resultd = mysqli_query($con, $sqls);
        if (mysqli_num_rows($resultd) > 0) {
          while($rowesdw = mysqli_fetch_assoc($resultd)) {


      $sql = "SELECT * FROM model_images WHERE unique_model_id = '".$rowesdw['unique_id']."' Order by id ASC LIMIT 1 ";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
        $rowes = mysqli_fetch_assoc($result);
               
  ?>

  <div class="item">
    <div class="usern">
        <figure class="user_profile">
          <a title="" href="single-model.php?model=<?php echo $rowesdw['username']; ?>&m_id=<?php echo $rowesdw['id']; ?>&m_unique_id=<?php echo $rowesdw['unique_id'];?>" >
            <img src="../<?php echo $rowesdw['photo_2'] ?>">
          </a>
        </figure>
        <span>
          <a title="" href="#" style="background: unset;"><?php echo $rowesdw['username']; ?></a>
        </span>
      <br clear="all">
    </div>
    <div class="fix_dv">
      <img class="big_img" src="../<?php echo $rowes['file'] ?>">
      <i class="fa fa-play" aria-hidden="true"></i>
    </div>
  </div>

  <?php
                    } else {
                      echo "0 results";
                    }
    $count++;
    }
      } else {
        echo "0 results";
      }
  ?>
</div>
</div>
<script type="text/javascript">
  jQuery("#carousel1").owlCarousel({
  autoplay: true,
  lazyLoad: true,
  loop: true,
  margin: 40,
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
</body>
</html>