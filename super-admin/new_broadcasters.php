<?php
  session_start();
  include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include('includes/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include('includes/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Models</h4>
                  <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            unique model id
                          </th>
                          <th>
                            Username
                          </th>
                          <th>
                            Live Cam
                          </th>
                          <th>
                            Group Show
                          </th>
                          <th>
                            Work Escort
                          </th>
                          <th>
                            International Tours
                          </th>
                          <th>
                            Video Pictures
                          </th>
                          <?php /*<th>
                            Modeling Porn Assignment
                          </th> */ ?>
						  <th>
                            Professional Modeling & <br/>Entertainment
                          </th>
                          <th>
                            Figure & stats
                          </th>
                          <th>
                            Govt Document
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT model_user.unique_id ,model_user.username,model_user.email, model_extra_details.id,model_extra_details.unique_model_id, model_extra_details.live_cam , model_extra_details.group_show, model_extra_details.work_escort,model_extra_details.International_tours,model_extra_details.video_pictures,model_extra_details.modeling,model_extra_details.modeling_porn_assignment,model_extra_details.status,model_extra_details.govt_id_proof,model_extra_details.bust_size,model_extra_details.cup_size,model_extra_details.waist_size,model_extra_details.ethnicity,model_extra_details.height,model_extra_details.weight,model_extra_details.eye_color,model_extra_details.hair_color,model_extra_details.in_per_hour,model_extra_details.in_overnight,model_extra_details.out_per_hour,model_extra_details.out_overnight,model_extra_details.body_type,model_extra_details.dress_size FROM model_user INNER JOIN model_extra_details ON model_user.unique_id = model_extra_details.unique_model_id ORDER BY model_extra_details.id DESC";

                            $resultd = mysqli_query($con, $sqls);
                              if (mysqli_num_rows($resultd) > 0) {
                                while ($rowesdw = mysqli_fetch_assoc($resultd)){
                        ?>
                        <tr>
                          <form action="broadcast-accept.php" method="post">
                          <td class="py-1">
                            <?php echo $rowesdw['unique_model_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['username']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['live_cam']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['group_show']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['work_escort']; ?>
                            <?php if($rowesdw['work_escort'] == 'Yes'){ ?>
                              <ul>
                                <li>Local Meetup Rate = <b><?php echo $rowesdw['in_per_hour']; ?></b></li>
                                <li>Extended Social Rate = <b><?php echo $rowesdw['extended_rate']; ?></b></li>
                                <li>Overnight Social Rate = <b><?php echo $rowesdw['in_overnight']; ?></b></li>
                                <li>Preferred Meeting Location = <b><?php echo $rowesdw['d_a_address']; ?></b></li>
                              </ul>
                            <?php } ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['International_tours']; ?>
                          </td>
                          <td>
                            <?php  echo $dob = $rowesdw['video_pictures'];
                            ?>
                          </td>
                          <td>
                            <?php //echo $rowesdw['modeling_porn_assignment']; ?>
							<?php echo $rowesdw['modeling']; ?>
                          </td>
                          <td>
						  <?php  $hght = '';
						  if($rowesdw['height_type'] == 'ft' || empty($rowesdw['height_type'])){
							  $exp_hght = explode('.',$rowesdw['height']);
							  $hght = $exp_hght[0]."'".$exp_hght[1].'"';
						  }else{
							 $hght = $rowesdw['height'].' cm';
						  }
						  if($rowesdw['weight_type'] == 'lbs' || empty($rowesdw['weight_type'])){
							$wght = 'pounds';
						  }else{
							 $wght = 'cm'; 
						  }
						  ?>
                            <ul>
                              <li>Bust size = <b><?php echo $rowesdw['bust_size']; ?></b></li>
                              <li>Cup size = <b><?php echo $rowesdw['cup_size']; ?></b></li>
                              <li>Waist size = <b><?php echo $rowesdw['waist_size']; ?></b></li>
                              <li>Ethnicity = <b><?php echo $rowesdw['ethnicity']; ?></b></li>
                              <li>Height = <b><?php echo $hght; ?></b></li>
                              <li>Weight (<?php echo $wght; ?>) = <b><?php echo $rowesdw['weight']; ?><?php echo ' '.$rowesdw['weight_type']; ?></b></li>
                              <li>eye color = <b><?php echo $rowesdw['eye_color']; ?></b></li>
                              <li>Hair color = <b><?php echo $rowesdw['hair_color']; ?></b></li>
							  <li>Body Type = <b><?php echo $rowesdw['body_type']; ?></b></li>
							  <li>Dress Size = <b><?php echo $rowesdw['dress_size']; ?></b></li>
                            </ul>
                          </td>
                          <td>
                            <a class="btn btn-primary" href="https://models.staging3.dotwibe.com/<?php echo $rowesdw['govt_id_proof']; ?>">View Document</a>
                          </td>
                          <input type="hidden" name="uni_id" value="<?php echo $rowesdw['unique_model_id']; ?>">
                          <input type="hidden" name="email" value="<?php echo $rowesdw['email']; ?>">
                          <td>
                            <?php if($rowesdw['status'] == 'Pending'){ ?>
                            <input class="btn btn-success" type="submit" name="acceptprofile" value="Accept Broadcaster" >
                            <?php }else{ ?>
                            <input class="btn btn-success" type="submit" name="acceptprofile" value="Accept Broadcaster" disabled="disabled">
                            <?php } ?>

                            <!-- <a class="btn btn-primary" href="single-profile.php?model=<?php //echo $rowesdw['username']; ?>&m_id=<?php //echo $rowesdw['id']; ?>">Accept Broadcaster</a> -->
                            <!-- <input type="submit"  name="accept-request" value=""> -->
                          </td>
                        </form>
                        </tr>
                        <?php
                          }
                          } else {
                            echo "0 results";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
           
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include('includes/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
