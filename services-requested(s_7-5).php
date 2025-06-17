<?php 
  session_start(); 
  include('includes/config.php');
  // include('functions.php');
?>
<?php 
    session_start(); 
    $usern = $_SESSION["log_user"];
    
    if( !$usern ){
        echo '<script>window.location.href="login.php"</script>';
    }
?>
<!doctype html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Purchase </title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="apple-touch-icon" href="assets/wp-content/themes/theagency3/library/images/apple-icon-touch.png">
<link rel="icon" href="assets/wp-content/themes/theagency3/favicon5e1f.png?v=2">
<link href='https://fonts.googleapis.com/css?family=EB+Garamond|Great+Vibes|Petit+Formal+Script' rel='stylesheet' type='text/css'>

  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

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
  <link rel='stylesheet' id='wp-block-library-css'  href='assets/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='spiffycal-styles-css'  href='assets/wp-content/plugins/spiffy-calendar/styles/default.css' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='assets/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-popup-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-flexslider-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/flexslider/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpgt-gallery-owlcarousel-theme-style-css'  href='assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/assets/owl.theme.default.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Rokkitt-css'  href='http://fonts.googleapis.com/css?family=Rokkitt' type='text/css' media='all' />
<link rel='stylesheet' id='rich-reviews-css'  href='assets/wp-content/plugins/rich-reviews/css/rich-reviews.css' type='text/css' media='all' />
<link rel='stylesheet' id='bones-stylesheet-css'  href='assets/wp-content/themes/theagency3/library/css/style.css' type='text/css' media='all' />

<script type='text/javascript' src='assets/wp-includes/js/jquery/jquery.js' id='jquery-core-js'></script>

<script type='text/javascript' src='assets/wp-content/plugins/rich-reviews/js/rich-reviews.js' id='rich-reviews-js'></script>
<script type='text/javascript' src='assets/wp-content/themes/theagency3/library/js/libs/modernizr.custom.min.js' id='bones-modernizr-js'></script>
<link rel="https://api.w.org/" href="assets/wp-json/index.html" />
<!-- <style>
body, .visual-form-builder label, label.vfb-desc { color:#999999; font-family:georgia, serif; font-weight:Normal; font-size:17px; }
h1,h2,h3,h4,h5,h6, #footer h4 { color:#ffffff; font-family:"Georgia", Helvetica, serif; font-weight:normal; font-size:36px; }
a {color:#BDB392}.navbar.navbar-default.navbar-inverse.navbar-right, .dropdown-menu {background:#222222}.td-vam-inner.border-top-bottom, .td-vam-inner.border-bottom {border-color:#ffffff}.navbar-inverse .navbar-nav > li > a, .dropdown-menu > li > a {color:#999999}.navbar-inverse .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover {color:#ffffff}a:hover, .btn.btn-facebook:hover {color:#ffffff}#content, #footer, #sub-floor, .protable-outer, ul.profile span:first-child, ul.profile span + span {background:#181818}.google-mixed { color:#ffffff; font-family:Georgia, serif; font-weight:Normal; font-size:38px; }
.google-mixed-2 { color:#999999; font-family:Georgia, serif; font-weight:Normal; font-size:20px; }
</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-image: url("assets/wp-content/themes/theagency3/images/default-bg.jpg"); background-position: center top; background-size: auto; background-repeat: no-repeat; background-attachment: fixed; }
</style> -->
  </head>

<body class="archive post-type-archive post-type-archive-testimonials custom-background">
    <?php include('includes/header.php'); ?>

      <div class="container-fluid">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">

          <?php $log_user_id = $_SESSION["log_user_unique_id"]; ?>
          <h3>Group Show's </h3>
          <?php
            $sql_gs = "SELECT * FROM booking_group_show WHERE model_unique_id = '".$log_user_id."'";
            $result_gs = mysqli_query($con,$sql_gs);

            if (mysqli_num_rows($result_gs) > 0) {

              while ($row_gs = mysqli_fetch_assoc($result_gs)) {

                $que_nam = "SELECT * FROM model_user WHERE unique_id = '".$row_gs['user_unique_id']."'";
                $result_nam = mysqli_query($con, $que_nam);
                
                if (mysqli_num_rows($result_nam) > 0) {
                  $row_nam = mysqli_fetch_assoc($result_nam);
                    $name = $row_nam['name'];
                  
                }else{
                    $name = 'No name'; 
                }

                if($row_gs['status'] == 'Not Accepted'){
 
                  ?>
                    <table>
                      <tr>
                        <input type="hidden" name="id" value="<?php echo $row_gs['id']; ?>">
                        <td style="vertical-align: middle;"><?php echo '<b>'.$name.'</b> has requested group show at '.$row_gs['meeting_date'].''; ?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $row_gs['id']; ?>">View Details</button></td>
                        <td>
                          <a class="btn btn-success" href="service-processing.php?service-name=group_show&service_id=<?php echo $row_gs['id']; ?>&action=accept">Accept</a></td>
                        <td>
                          <a class="btn btn-danger" href="service-processing.php?service-name=group_show&service_id=<?php echo $row_gs['id']; ?>&action=reject">Reject</a>
                        </td>
                      </tr>

                      <div id="myModal<?php echo $row_gs['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" style="color: #222222">Group show Details</h4>
                            </div>
                            <div class="modal-body">
                              <div style="padding: 20px;">
                                <p>Date : <b><?php echo $row_gs['meeting_date']; ?></b></p>
                                <p>Time <b><?php echo $row_gs['meeting_time_hour'].':'.$row_gs['meeting_time_hour'].' '.$row_gs['ampm']; ?></b></p>
                                <p>Duration: <b><?php echo $row_gs['duration']; ?></b></p>
                                <p>Instruction: <b><?php echo $row_gs['instruction']; ?></b></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </table>
                  <?
                }elseif($row_gs['status'] == 'Accepted'){
                  ?>
                  You have accepted group show request with <?php echo $name; ?>.
                  <?php
                }elseif($row_gs['status'] == 'Reject
                  .'){
                  ?>
                  You have Rejected group show request <?php echo $name; ?>.
                  <?php
                }
              }
               
            }else{
              echo 'You dont have any request for group show'; 
            }
          ?>
          <hr>
          <h3>International Tours </h3>
          <?php
            $sql_it = "SELECT * FROM booking_international_call WHERE model_unique_id = '".$log_user_id."'";
            $result_it = mysqli_query($con,$sql_it);

            if (mysqli_num_rows($result_it) > 0) {

              while ($row_it = mysqli_fetch_assoc($result_it)) {

                $que_nam1 = "SELECT * FROM model_user WHERE unique_id = '".$row_it['user_unique_id']."'";
                $result_nam1 = mysqli_query($con, $que_nam1);
                
                if (mysqli_num_rows($result_nam1) > 0) {
                  $row_nam1 = mysqli_fetch_assoc($result_nam1);
                    $name1 = $row_nam1['name'];
                  
                }else{
                    $name1 = 'No name'; 
                }

                if($row_it['status'] == 'Not Accepted'){

                  ?>
                    <table>
                      <tr>
                        <td style="vertical-align: middle;"><?php echo '<b>'.$name1.'</b> has requested International Tour at '.$row_it['meeting_date'].''; ?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModalit<?php echo $row_gs['id']; ?>">View Details</button></td>
                        <td>
                          <a class="btn btn-success" href="service-processing.php?service-name=internation_tour&service_id=<?php echo $row_it['id']; ?>&action=accept">Accept</a></td>
                        <td>
                          <a class="btn btn-danger" href="service-processing.php?service-name=internation_tour&service_id=<?php echo $row_it['id']; ?>&action=reject">Reject</a>
                        </td>
                      </tr>

                      <div id="myModalit<?php echo $row_gs['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" style="color: #222222">International Tour Details</h4>
                            </div>
                            <div class="modal-body">
                              <div style="padding: 20px;">
                                <p>Date : <b><?php echo $row_it['meeting_date']; ?></b></p>
                                <p>Time <b><?php echo $row_it['meeting_time_hour'].':'.$row_it['meeting_time_min'].' '.$row_it['ampm']; ?></b></p>
                                <p>Duration: <b><?php echo $row_it['duration']; ?></b></p>
                                <p>DO YOU WANT TO MEET THE MODEL?: <b><?php echo $row_it['meet_the_model']; ?></b></p>
                                <p> ARE YOU WILLING TO SPONSOR HER TRIP?: <b><?php echo $row_it['sponser_trip']; ?></b></p>
                                <?php if($row_it['sponser_trip'] == 'Yes'){ ?>
                                  <p>WILL YOU BOOK MY TRAVEL?: <b><?php echo $row_it['book_travel']; ?></b></p>
                                  <p>WILL YOU BOOK MY STAY?: <b><?php echo $row_it['book_stay']; ?></b></p>
                                <?php }else{ ?>
                                <p>Notify when the model visits my country: <b><?php echo $row_it['notify_visit']; ?></p>
                                <?php } ?>
                                <p>Instruction: <b><?php echo $row_it['instruction']; ?></b></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </table>
                  <?
                }elseif($row_it['status'] == 'Accepted'){
                  ?>
                  You have accepted International Tour request with <?php echo $name1; ?>.
                  <?php
                }elseif($row_it['status'] == 'Reject'){
                  ?>
                  You have Rejected International Tour request with <?php echo $name1; ?>.
                  <?php
                }
              }
               
            }else{
              echo 'You dont have any request for group show'; 
            }
          ?>
          <hr>
          <h3>Dating Assignments </h3>
          <?php
            $sql_da = "SELECT * FROM booking_dating_assignments WHERE model_unique_id = '".$log_user_id."'";
            $result_da = mysqli_query($con,$sql_da);

            if (mysqli_num_rows($result_da) > 0) {

              while ($row_da = mysqli_fetch_assoc($result_da)) {

                $que_nam2 = "SELECT * FROM model_user WHERE unique_id = '".$row_da['user_unique_id']."'";
                $result_nam2 = mysqli_query($con, $que_nam2);
                
                if (mysqli_num_rows($result_nam2) > 0) {
                  $row_nam2 = mysqli_fetch_assoc($result_nam2);
                    $name2 = $row_nam2['name'];
                  
                }else{
                    $name2 = 'No name'; 
                }

                if($row_da['status'] == 'Not Accepted'){
                  ?>
                    <table>
                      <tr>
                        <td style="vertical-align: middle;"><?php echo '<b>'.$name2.'</b> has requested group show at '.$row_da['meeting_date'].''; ?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal_da<?php echo $row_gs['id']; ?>"_ma<?php echo $row_gs['id']; ?>>View Details</button></td>
                        <td>
                          <a class="btn btn-success" href="service-processing.php?service-name=dating_assignments&service_id=<?php echo $row_da['id']; ?>&action=accept">Accept</a></td>
                        <td>
                          <a class="btn btn-danger" href="service-processing.php?service-name=dating_assignments&service_id=<?php echo $row_da['id']; ?>&action=reject">Reject</a>
                        </td>
                      </tr>

                      <div id="myModal_da<?php echo $row_gs['id']; ?>"_ma<?php echo $row_gs['id']; ?> class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" style="color: #222222">Dating Assignment Details</h4>
                            </div>
                            <div class="modal-body">
                              <div style="padding: 20px;">
                                <p>Date : <b><?php echo $row_da['meeting_date']; ?></b></p>
                                <p>Time <b><?php echo $row_da['meeting_time_hour'].':'.$row_da['meeting_time_hour'].' '.$row_da['ampm']; ?></b></p>
                                <p>Duration: <b><?php echo $row_da['duration']; ?></b></p>
                                <p>Instruction: <b><?php echo $row_da['instruction']; ?></b></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </table>
                  <?
                }elseif($row_da['status'] == 'Accepted'){
                  ?>
                  You have accepted Dating Assignment requested with <?php echo $name2; ?>.
                  <?php
                }elseif($row_da['status'] == 'Reject'){
                  ?>
                  You have Rejected Dating Assignment requested with <?php echo $name2; ?>.
                  <?php
                }
              }
               
            }else{
              echo 'You dont have any request for Dating Assignment'; 
            }
          ?>
          <hr>
          <h3>Movie/Modeling Assignments </h3>
          <?php
            $sql_ma = "SELECT * FROM booking_movie_assignments WHERE model_unique_id = '".$log_user_id."'";
            $result_ma = mysqli_query($con,$sql_ma);

            if (mysqli_num_rows($result_ma) > 0) {

              while ($row_ma = mysqli_fetch_assoc($result_ma)) {
                $que_nam3 = "SELECT * FROM model_user WHERE unique_id = '".$row_ma['unique_user_id']."'";
                $result_nam3 = mysqli_query($con, $que_nam3);
                
                if (mysqli_num_rows($result_nam3) > 0) {
                  $row_nam3 = mysqli_fetch_assoc($result_nam3);
                    $name3 = $row_nam3['name'];
                  
                }else{
                    $name3 = 'No name'; 
                }

                if($row_ma['status'] == 'Not Accepted'){
                  ?>
                    <table>
                      <tr>
                        <td style="vertical-align: middle;"><?php echo '<b>'.$name3.'</b> has requested group show at '.$row_ma['meeting_date'].''; ?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal_ma<?php echo $row_gs['id']; ?>">View Details</button></td>
                        <td>
                          <a class="btn btn-success" href="service-processing.php?service-name=movie_assignments&service_id=<?php echo $row_ma['id']; ?>&action=accept">Accept</a></td>
                        <td>
                          <a class="btn btn-danger" href="service-processing.php?service-name=movie_assignments&service_id=<?php echo $row_ma['id']; ?>&action=reject">Reject</a>
                        </td>
                      </tr>

                      <div id="myModal_ma<?php echo $row_gs['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" style="color: #222222">Movie/Modelling Details</h4>
                            </div>
                            <div class="modal-body">
                              <div style="padding: 20px;">
                                <p>Date : <b><?php echo $row_ma['meeting_date']; ?></b></p>
                                <p>Time <b><?php echo $row_ma['meeting_time_hour'].':'.$row_ma['meeting_time_hour'].' '.$row_ma['ampm']; ?></b></p>
                                <p>Duration: <b><?php echo $row_ma['duration']; ?></b></p>
                                <p>Instruction: <b><?php echo $row_ma['instruction']; ?></b></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </table>
                  <?
                }elseif($row_ma['status'] == 'Accepted'){
                  ?>
                  You have accepted Movie/Modeling assignment request with <?php echo $name3; ?>.
                  <?php
                }elseif($row_ma['status'] == 'Reject'){
                  ?>
                  You have Rejected Movie/Modeling assignment request with <?php echo $name3; ?>.
                  <?php
                }
              }
               
            }else{
              echo 'You dont have any request for Movie/Modeling assignment'; 
            }
          ?>

          <hr>
          <h3>All access (30 Day's) </h3>
          <?php
            $sql_aa = "SELECT * FROM user_all_access WHERE model_id = '".$log_user_id."'";
            $result_aa = mysqli_query($con,$sql_aa);

            if (mysqli_num_rows($result_aa) > 0) {

              while ($row_aa = mysqli_fetch_assoc($result_aa)) {

                $que_nam4 = "SELECT * FROM model_user WHERE unique_id = '".$row_aa['user_id']."'";
                $result_nam4 = mysqli_query($con, $que_nam4);
                
                if (mysqli_num_rows($result_nam4) > 0) {
                  $row_nam4 = mysqli_fetch_assoc($result_nam4);
                    $name4 = $row_nam4['name'];
                  
                }else{
                    $name4 = 'No name'; 
                }

                  ?>
                    <table>
                      <tr>
                        <td style="vertical-align: middle;"><b><?php echo $name4; ?></b> has Subscribe your 30days all access</td>

                        <td>Duration : <?php echo $row_aa['start_date'].'-'.$row_aa['end_date']; ?></td>
                        <td>
                          Status : <?php if($row_aa['status'] == '1'){ echo 'Active'; }else{ echo 'Inactive'; } ?></td>
                      </tr>

                    </table>
                  <?
               
              }
               
            }else{
              echo 'You dont have any 30 days all access.'; 
            }
          ?>          
          </div> <!-- end #main -->

                  
        </div>
      </div> 

   <?php include('includes/footer.php'); ?>
  </body>


</html> 
