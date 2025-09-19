<?php
  session_start();
  include('includes/config.php');
  
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <?php include('includes/head.php'); ?>
  
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
                  <h4 class="card-title">All Refund Coins</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            S. no.
                          </th>
                          <th>
                            Unique id
                          </th>
                          <th>
                            Refund Coins
                          </th>
                          <th>
                            Message
                          </th>
                          <th>
                            Refund Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM refund_coins Order by id DESC";
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
                              <?php echo $rowesdw['unique_user_id']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['refund_coins']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['message']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['refund_date']; ?>
                            </td>
                          </tr>
                        </form>
                        <?php
                          $count++;
                          }
                          } else {
                            echo "Currently dont have contact query.";
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
