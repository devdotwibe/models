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
                            S. no.
                          </th>
                          <th>
                            User Unique Id
                          </th>
                          <th>
                            Book For
                          </th>
                          <th>
                            Meet The Model  
                          </th>
                          <th>
                            Sponser Trip
                          </th>
                          <th>
                            Notify Visit
                          </th>
                          <th>
                            Book Travel
                          </th>
                          <th>
                            Book Stay
                          </th>
                          <th>
                            Instruction
                          </th>
                          <th>
                            Model Name 
                          </th>
                            <th>
                             Model Id 
                          </th>
                           <th>
                             Duration
                          </th>
                          <th>
                            Meeting Date   
                          </th>
                          <th>
                            Meeting Time 
                          </th>
                          <th>
                              Status
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM booking_international_call ORDER BY id DESC";
                            $resultd = mysqli_query($con, $sqls);
                            $count = 1;
                              if (mysqli_num_rows($resultd) > 0) {
                                while ($rowesdw = mysqli_fetch_assoc($resultd)){
                              
                        ?>
                        <form method="post" >
                        <tr>
                          <td>
                            <?php echo $count; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['user_unique_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['book_for']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['meet_the_model']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['sponser_trip']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['notify_visit']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['book_travel']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['book_stay']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['instruction']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['model_name']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['model_unique_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['duration']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['meeting_date']; ?>
                          </td>
                          <td>
                          <?php echo $rowesdw['meeting_time_hour'].':'.$rowesdw['meeting_time_min'].' '.$rowesdw['ampm']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['status']; ?>
                          </td>
                          
                          </form>
                        </tr>
                        <?php
                          $count++;
                          }
                          } else {
                            echo "Currently dont have Service Data";
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
