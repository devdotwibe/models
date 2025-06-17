<?php
  session_start();
  include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RoyalUI Admin</title>
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include('includes/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include('includes/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php
            $sqls = "SELECT * FROM casting WHERE id = '".$_GET['m_id']."' AND username = '".$_GET['model']."'";
              $resultd = mysqli_query($con, $sqls);
                if (mysqli_num_rows($resultd) > 0) {
                  $rowesdw = mysqli_fetch_assoc($resultd);
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Username: &nbsp;<?php echo $rowesdw['username']; ?></h4>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Report
                    </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="padding: unset;">
                  <img src="../<?php echo $rowesdw['photo_1']; ?>" style="height:350px;width: 100%;">
                </div>
              </div>

            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="padding: unset;">
                  <img src="../<?php echo $rowesdw['photo_2']; ?>" style="height:350px;width: 100%;">
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="padding: unset;">
                  <img src="../<?php echo $rowesdw['photo_3']; ?>" style="height:350px;width: 100%;">
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="padding: unset;">
                  <video style="height: 350px;width: 100%;" controls>
                    <source src="../<?php echo $rowesdw['short_video']; ?>" type="video/mp4">
                  </video>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">General and Contact Details:</p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                     
                        <tr>
                          <th>Username</th>
                          <td><?php echo $rowesdw['username']; ?></td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td><?php echo $rowesdw['email']; ?></td>
                        </tr>
                        <tr>
                          <th>Phone</th>
                          <td><?php echo $rowesdw['phone']; ?></td>
                        </tr>
                        <tr>
                          <th>Secondary Phone</th>
                          <td><?php echo $rowesdw['second_phone']; ?></td>
                        </tr>
                        <tr>
                          <th>Age</th>
                          <td>
                            <?php 
                              $dob = $rowesdw['dob'];
                              $diff = (date('Y') - date('Y',strtotime($dob)));
                              echo $diff.' Year'; ?>
                            </td>
                        </tr>
                        <tr>
                          <th>Start working date:</th>
                          <td><?php echo $rowesdw['start_work']; ?></td>
                        </tr>
                        <tr>
                          <th>city | state | country</th>
                          <td><?php echo $rowesdw['city'].' | '.$rowesdw['state'].' | '.$rowesdw['country']; ?></td>
                        </tr>
                        <tr>
                          <th>Short Bio</th>
                          <td><?php echo $rowesdw['short_bio']; ?></td>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Figure details:</h4>
									<table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>Bust Size</th>
                          <td><?php echo $rowesdw['bust_size']; ?></td>
                        </tr>
                        <tr>
                          <th>Cup size</th>
                          <td><?php echo $rowesdw['cup_size']; ?></td>
                        </tr>
                        <tr>
                          <th>Waist Size</th>
                          <td><?php echo $rowesdw['waist_size']; ?></td>
                        </tr>
                        <tr>
                          <th>Ethnicity</th>
                          <td><?php echo $rowesdw['ethnicity']; ?></td>
                        </tr>
                        <tr>
                          <th>Height</th>
                          <td><?php echo $rowesdw['height']; ?></td>
                        </tr>
                        <tr>
                          <th>Weight</th>
                          <td><?php echo $rowesdw['weight']; ?></td>
                        </tr>
                        <tr>
                          <th>Eye Color</th>
                          <td><?php echo $rowesdw['eye_color']; ?></td>
                        </tr>
                        <tr>
                          <th>Hair Color</th>
                          <td><?php echo $rowesdw['hair_color']; ?></td>
                        </tr>
                      </tbody>
                    </table>
								</div>
							</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <p class="card-title">Other details:</p>
                  <div class="row">
                    <div class="col-md-12 col-xl-12">
                      <div class="ml-xl-4">
                        
                        <p style="font-size: 16px;">It's willing to travel: <b><?php echo $rowesdw['travel']; ?></b></p>
                        <p style="font-size: 16px;">What are these available for: <b><?php echo $rowesdw['available']; ?></b></p>
                        <p style="font-size: 16px;">List all languages you are capable of speaking: <b><?php echo $rowesdw['languages']; ?></b></p> 
                        Valid Govt. I'd Proof: <a href="../<?php echo $rowesdw['id_proof']; ?>">View Document</a>
                      </div>  
                    </div>
                  </div>
                  <br><br>
                  <form method="post" action="act-vmp.php">
                    <input type="hidden" name="m_id" value="<?php echo $rowesdw['id']; ?>">
                    <input type="hidden" name="email" value="<?php echo $rowesdw['email']; ?>">
                    <input type="hidden" name="unique_id" value="<?php echo $rowesdw['unique_id']; ?>">
                    <?php if($rowesdw['status'] != 'Published'){ ?>
                    <input class="btn btn-success" type="submit" name="acceptprofile" value="Accept & Publish Profile">
                    <?php }else{ ?>
                    <input class="btn btn-success" type="submit" name="acceptprofile" value="Accept & Publish Profile" disabled="disabled">
                    <?php } ?>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <?php
            } else {
              echo "Unable to find details";
            }
        ?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
  <script src="vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

