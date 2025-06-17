<?php 
  session_start(); 
  include('../includes/config.php');
?>
<?php 
    session_start(); 
    $usern = $_SESSION["log_user"];
    
    if( !$usern ){
        echo '<script>window.location.href="../login.php"</script>';
    }
?>
<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Booking | Your Agency Name</title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="../assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="../assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="../assets/wp-content/themes/theagency3/library/images/win8-tile-icon.png">
<link rel="pingback" href="../xmlrpc.php">

    <style type="text/css">
img.wp-smiley,
img.emoji {
  display: inline !important;
  border: none !important;
  box-shadow: none !important;
  height: 1em !important;
  width: 1em !important;
  margin: 0 .07em !important;
  vertical-align: -0.1em !important;
  background: none !important;
  padding: 0 !important;
}
</style>
  <link rel='stylesheet' id='wp-block-library-css'  href='../assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='../assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='../assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='visual-form-builder-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/visual-form-builder.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='vfb-jqueryui-css-css'  href='../assets/wp-content/plugins/visual-form-builder/public/assets/css/smoothness/jquery-ui-1.10.3.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='../assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='https://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='../assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='../assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='../assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='../assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='../assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="../assets/wp-json/index.html" /><link rel="alternate" type="application/json" href="../assets/wp-json/wp/v2/pages/311.json" /><link rel='shortlink' href='../index2e31.html?p=311' />
<link rel="alternate" type="application/json+oembed" href="../assets/wp-json/oembed/1.0/embed53cd.json?url=http%3A%2F%2Ftheagency.escortthemes.com%2Fbooking%2F" />
<link rel="alternate" type="text/xml+oembed" href="../assets/wp-json/oembed/1.0/embed3ed2?url=http%3A%2F%2Ftheagency.escortthemes.com%2Fbooking%2F&amp;format=xml" />

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- <style>
body, .visual-form-builder label, label.vfb-desc { color:#999999; font-family:georgia, serif; font-weight:Normal; font-size:17px; }
h1,h2,h3,h4,h5,h6, #footer h4 { color:#ffffff; font-family:"Georgia", Helvetica, serif; font-weight:normal; font-size:36px; }
a {color:#BDB392}.navbar.navbar-default.navbar-inverse.navbar-right, .dropdown-menu {background:#222222}.td-vam-inner.border-top-bottom, .td-vam-inner.border-bottom {border-color:#ffffff}.navbar-inverse .navbar-nav > li > a, .dropdown-menu > li > a {color:#999999}.navbar-inverse .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover {color:#ffffff}a:hover, .btn.btn-facebook:hover {color:#ffffff}#content, #footer, #sub-floor, .protable-outer, ul.profile span:first-child, ul.profile span + span {background:#181818}.google-mixed { color:#ffffff; font-family:Georgia, serif; font-weight:Normal; font-size:38px; }
.google-mixed-2 { color:#999999; font-family:Georgia, serif; font-weight:Normal; font-size:20px; }
</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-image: url("../assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
</style> -->
<style type="text/css">
  .attachment-testimonial_photo.wp-post-image{
    margin-bottom: 0px; 
  }
  .modal-content{
    background-color: #131313 !important;
  }
  input.vfb-text, input.vfb-text[type="text"], input.vfb-text[type="tel"], input.vfb-text[type="email"], input.vfb-text[type="url"], textarea.vfb-textarea, select.vfb-select{
    background-color: rgb(39 39 39) !important;
  }
  ul li{
    list-style-type: none;
  }
</style>

  </head>

<body class="page-template-default page page-id-311 custom-background">
<?php include('../includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
         
           <?php //include('../model-panel/sidebar.php'); ?>

          <div id="main" class="col-md-12 col-xs-12 col-sm-12 clearfix" role="main">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" >Add New Image/Video</button>

            <button type="button" class="btn btn-info btn-lg" id="btn222" >Change Banner image</button>
            <div id="div1">
              
            
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="act-images.php" enctype= "multipart/form-data">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    
                      <ul class="vfb-section vfb-section-1">

                        <input type="hidden" name="m_uni_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">

                        <li class="vfb-item vfb-item-select vfb-right-half" id="item-vfb-44">
                          <label for="vfb-44" class="vfb-desc">File Type <span class="vfb-required-asterisk">*</span></label>
                          <select name="file_type" id="vfb-44" class="vfb-select  vfb-medium " required="required">
                              <option value="" selected='selected'></option>
                              <option value="Image">Image</option>
                              <option value="Video">Video</option>
                          </select>
                        </li>
                        <li class="vfb-item vfb-item-email   vfb-right-half" id="item-vfb-22">
                          <label for="vfb-22" class="vfb-desc">File  <span class="vfb-required-asterisk">*</span></label>
                          <input type="file" name="filess" id="vfb-22" value="" class="vfb-text  vfb-medium  required  email " />
                        </li>
                        <li class="vfb-item vfb-item-text  " id="item-vfb-24">
                          <label for="vfb-24" class="vfb-desc">About Image  </label>
                          <input type="text" name="img_text" id="vfb-24" value="" class="vfb-text  vfb-medium " />
                        </li>
                        <li class="vfb-item vfb-item-select vfb-right-half" id="coin-proce">
                          <label for="vfb-44" class="vfb-desc">File Type (Price) <span class="vfb-required-asterisk">*</span></label>
                          <select name="file_type_price" id="my_id" class="vfb-select  vfb-medium " required="required">
                              <option value="" selected='selected'></option>
                              <option value="Free">Free</option>
                              <option value="Paid">Paid</option>
                          </select>
                        </li>
                        <li class="vfb-item vfb-item-text  " id="coin_field">
                          <label for="vfb-24" class="vfb-desc" id="">Coins  </label>
                          <input type="text" name="coins" id="vfb-24" value="" class="vfb-text  vfb-medium   " />
                        </li>
                        <li class="vfb-item vfb-item-text  " id="coin_field">
                          <label for="vfb-24" class="vfb-desc" id="">Select post Category:  </label>
                          <select name="category">
			                <option value="Trending">Trending</option>
			                <option value="HOT & BOLD">HOT & BOLD</option>
			                <option value="CUTE & CASUAL">CUTE & CASUAL</option>
			                <option value="AROUND THE WORLD">AROUND THE WORLD</option>
			                <option value="AROUND My TOWN">Trending</option>
			              </select>
                        </li>
                         
			              
                      </ul>
                    
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="upload_image" value="Add File">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                  </div>
                  </form>
                </div>

              </div>
            </div>
            <table>
            	<tr>
            		<td><b>Image</b></td>
            		<td><b>Title</b></td>
            		<td><b>Type</b></td>
            		<td><b>Coins</b></td>
            		<td><b>Delete</b></td>
            	</tr>
            <?php
              $un_id = $_SESSION["log_user_unique_id"];
                            
              $sql = "SELECT * FROM model_images WHERE unique_model_id = '".$un_id."'";
                $result = mysqli_query($con, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
              
            ?>
            <form action="act-img-delete.php" method="post" > 
	            <tr>
	            	<input type="hidden" name="id" value="<?php echo $row['id']; ?>" required> 
	            	<input type="hidden" name="unique_model_id" value="<?php echo $row['unique_model_id']; ?>" required>
	        		<td>
	        			<?php if($row['file_type'] == 'Image'){ ?>
		        			<a href="../<?php echo $row['file']; ?>">
		        			<img width="100" height="100" src="../<?php echo $row['file']; ?>" class="attachment-testimonial_photo size-testimonial_photo wp-post-image" alt="" loading="lazy" srcset="../<?php echo $row['file']; ?>" sizes="(max-width: 100px) 100vw, 100px" />
		        			</a>
	        			<?php }else{ ?>
	        				<video width="100" height="100" controls>
							  <source src="../<?php echo $row['file']; ?>" type="video/mp4">
							</video>
	        			<?php } ?>
	        		</td>
	        		<td>
	        			<p class="testimonial-text" ><?php echo $row['image_text']; ?></p>
	        		</td>
	        		<td>
	        			<p class="testimonial-text" ><?php echo $row['img_type_price']; ?></p>
	        		</td>
	        		<td>
	        			<p class="testimonial-text" ><?php echo $row['coins']; ?></p>
	        		</td>
	        		<td>
	        			<input type="submit" name="delete_img" value="Delete" class="btn btn-danger">
	        		</td>
	        	</tr>
        	</form>
          <?php
          }
            } else {
              echo '<tr><td scope="row">Currenly you dont have any Image/Video.</td></tr>';
            }
          ?>
          </table>
          
           </div>  
          <div id="div2">
            <form method="post" action="act-banner-dp.php" enctype= "multipart/form-data">
              <?php $log_user_id = $_SESSION["log_user_unique_id"]; ?>
              <input type="hidden" name="u_id" value="<?php echo $log_user_id; ?>">
              <table>
                <!-- <tr>
                  <td><label>Profile picture</label></td>
                  <td><input type="file" name="profile_pic"></td>
                </tr> -->
                <tr>
                  <td><label>Banner Image</label></td>
                  <td><input type="file" name="banner_pic"></td>
                </tr>
                <tr>
                  <td><input type="submit" name="submit_pic" value="Add Images" class="btn btn-success"></td>
                </tr>
              </table>
            </form>
          </div>  
          </div>

        </div> <!-- end #content -->

      </div> <!-- end .container -->

      <?php include('../includes/footer.php'); ?>
      <script>
        $(document).ready(function(){
          $("#coin_field").hide();
          $("#my_id").change(function(){
            if(this.value == 'Paid'){
              $("#coin_field").show();
            }else{
              $("#coin_field").hide();
            }
          });
          $("#div2").hide();
          $("#btn222").click(function(){
            $("#div1").hide();
            $("#div2").show();
          });
        });
      </script>
  </body>


</html> 
