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
                            Image
                          </th>
                          <th>
                            Username
                          </th>
                          <th>
                            Country
                          </th>
                          <th>
                            Age
                          </th>
                          <th>
                            View Profile
                          </th>
                          <!-- <th>
                            Data limite
                          </th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM casting Order by id DESC";
                            $resultd = mysqli_query($con, $sqls);
                              if (mysqli_num_rows($resultd) > 0) {
                                while ($rowesdw = mysqli_fetch_assoc($resultd)){
                        ?>
                        <tr>
                          <td class="py-1">
                            <a href="../<?php echo $rowesdw['photo_1']; ?>">
                              <img src="../<?php echo $rowesdw['photo_1']; ?>" alt="image"/>
                            </a>
                          </td>
                          <td>
                            <?php echo $rowesdw['username']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['country']; ?>
                          </td>
                          <td>
                            <?php  
                              $dob = $rowesdw['dob'];
                              $diff = (date('Y') - date('Y',strtotime($dob)));
                              echo $diff.' Year';
                            ?>
                          </td>
                          <td>
                            <a class="btn btn-primary" href="single-profile.php/<?php echo urlencode($rowesdw['username']); ?>">View Full Profile</a>
                            <!-- <input type="submit"  name="accept-request" value=""> -->
                          </td>
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
