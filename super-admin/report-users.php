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
      <!-- model-togle -->
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Report Users List</h4>
                  <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            S. no.
                          </th>
                          <th>
                            Reported By
                          </th>
                          <th>
                            Reported User
                          </th>
                          <th>
                            Descrition
                          </th>
                          <th>
                            Attachment
                          </th>
                          <th>
                            Reported Data
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                          $sqls = "SELECT * FROM user_reports Order by id DESC";

                          $resultd = mysqli_query($con, $sqls);
                          $count = 1;

                            if (mysqli_num_rows($resultd) > 0) {

                              while ($rowesdw = mysqli_fetch_assoc($resultd)){   

                                $reported_by_id =  $rowesdw['user_id'];

                                $repoted_user_id =  $rowesdw['reported_user_id'];

                                $attachment = $rowesdw['attachment'];

                                $reported_by_detail = get_data('model_user',array('id'=>$reported_by_id),true);

                                $repoted_user_detail = get_data('model_user',array('id'=>$repoted_user_id),true);

                                $repoted_date = $rowesdw['created_at'];

                                $f_report_date = date('d-m-Y', strtotime($repoted_date));

                                $imageUrl = "";

                                // if (checkImageExists($attachment)) {

                                //     $imageUrl = SITEURL . $attachment;
                                // }

                                 $imageUrl = SITEURL . $attachment;

                        ?>

                        <tr>
                          <td>
                            <?php echo $count; ?>
                          </td>
                          <td>
                            <?php echo $reported_by_detail['name']; ?>
                          </td>
                          <td>
                            <?php echo $repoted_user_detail['name']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['description']; ?>
                          </td>
                          <td>
                                <img src="<?php echo $imageUrl ?>" >
                          </td>
                          <td>
                            <?php echo $f_report_date; ?>
                          </td>
    
                        </tr>
                        <?php
                          $count++;
                          }
                          } else {
                            echo "Not Fount Any Reported Users ";
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
