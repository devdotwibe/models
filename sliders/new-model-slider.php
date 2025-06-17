<?php  session_start(); ?>
<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js" ></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <style type="text/css">
  	
body .owl-carousel.owl-loading {
    opacity: 1;
    display: block;
    text-align: center;
}
.framebox{
    width: 95%;
    margin: auto;
    padding-top: 10px;
}
.owl-prev,.owl-next{
font-size: 30px;
/*background: rgb(166, 166, 255);*/
color: white;
border: 0;
margin: 7px;
}

.owl-prev:hover,.owl-next:hover,.owl-prev:focus,.owl-next:focus{
    outline: none;
}
.owl-item {
    border-radius: 4px;

}
a.item {
    /*display: flex;*/
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #f00;
    cursor: pointer;
    text-align: center;
    /*padding: 78px 30px;*/
}
.sml_tst{
  font-size: 14px;
  color: #ffffff;
}
.owl-carousel.owl-drag .owl-item{
  text-align: center;
}
.item:hover{
    text-decoration-line: none;
}
.owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled {
    display: block;
    margin-top: 10px;
}
body .owl-carousel .owl-dots, 
body .owl-carousel .owl-nav {
    display: block;
    margin-top: 10px;
    text-align: center;
}
body .owl-carousel .owl-dots.disabled, 
body .owl-carousel .owl-nav.disabled {
    display: block;
}
.owl-dot{
    display: none;
}


  </style>
  <script type="text/javascript">
  	jQuery(document).ready(function($) {
    var $owl = $('.owl-carousel');
      $owl.children().each( function( index ) {
        jQuery(this).attr( 'data-position', index ); 
      });
      
      $owl.owlCarousel({
        // center: true,
        nav:true,
        loop: true,
        items: 5,
        margin:10,
        navText: ["<i class='fa arrow-circle-left'><</i>","<i class='fa arrow-right'>></i>"],
        responsive:{
          0:{
              items:2
          },
          600:{
              items:3
          },
          1000:{
              items:9
          }
       }
      });
    $(document).on('click', '.item', function() {
      $owl.trigger('to.owl.carousel', $(this).data( 'position' ) ); 
    });
          });
  </script>
</head>
<body>
  <!-- <div class="framebox"> -->
       <div class="owl-carousel"  style="margin-bottom: 40px;">
        <img src="https://models.staging3.dotwibe.com/assets/images/model-gal-no-img.jpg" alt="gif" style="border-radius: 50%;width: 120px;height: 120px;border: 4px solid #d83b1b;">
       	<?php
          $count = 1;
          $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' AND EXISTS 
  (SELECT *
   FROM model_images
   WHERE model_user.unique_id = model_images.unique_model_id) Order by id DESC ";
          $resultd = mysqli_query($con, $sqls);
            if (mysqli_num_rows($resultd) > 0) {
              while($rowesdw = mysqli_fetch_assoc($resultd)) {

          ?>
          <a class="item item<?php echo $count; ?>" href="single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>" >
            <img src="<?= SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic']; ?>" style="border-radius: 50%;width: 120px;height: 120px;border: 4px solid #d83b1b;">
    
            <small class="sml_tst"><?php echo $rowesdw['username']; ?></small>
          </a>
          <?php
            $count++;
            }
              } else {
                echo "0 results";
              }
          ?>
      <!-- <a class="item item2" >2</a>
      <a class="item item3" >3</a>
      <a class="item item4" >4</a>
      <a class="item item5" >5</a> -->
  </div>
  <!-- </div> -->
  
  
   
  
  
  
</body>
</html>