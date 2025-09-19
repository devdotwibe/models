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
                  <h4 class="card-title">All Withdrawal Request</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Coins</th>
                          <th>User id</th>
                          <th>User Email</th>
                          <th>User Name</th>
                          <th>Bank Name & Branch</th>
                          <th>Account holder name</th>
                          <th>Account Number</th>
                          <th>IFSC Code</th>
                          <th>Accept</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM withdrow_request Order by id DESC";
                            $resultd = mysqli_query($con, $sqls);
                              if (mysqli_num_rows($resultd) > 0) {
                                while ($rowesdw = mysqli_fetch_assoc($resultd)){
                        ?>
                        <form method="post">
                          <tr>
                            <td class="py-1">
                              <?php echo $rowesdw['coins']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['user_id']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['user_email']; ?>
                            </td>
                            <td>
                              <?php echo  $rowesdw['user_name']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['bank_name_branch']; ?>
                            </td>
                            <td>
                              <?php echo  $rowesdw['account_h_name']; ?>
                            </td>
                            <td>
                              <?php echo  $rowesdw['account_number']; ?>
                            </td>
                            <td>
                              <?php echo $rowesdw['ifsc_code']; ?>
                            </td>
                            <td>
                              <input type="hidden" name="user_id" value="<?php echo $rowesdw['user_id']; ?>">
                              <?php if($rowesdw['status'] == 'Accepted'){ ?>
                              <input type="submit" name="accept" value="Accept" class="btn btn-success" disabled="disabled">
                              <?php }else{ ?>
                              <input type="submit" name="accept" value="Accept" class="btn btn-success">
                              <?php } ?>
                            </td>
                          </tr>
                        </form>
                        <?php
                          }
                          } else {
                            echo "No Record found.";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php
              if(isset($_POST['accept'])){
                $user_id = $_POST['user_id'];

                $que = "UPDATE `withdrow_request` SET `status` = 'Accepted' WHERE `withdrow_request`.`user_id` = '".$user_id."'";

                if(mysqli_query($con,$que)){
                  echo '<script>alert("Request Successfully Accepted.")</script>';
                  echo '<script>window.location="view-withdrow-request.php"</script>';
                }else{
                  echo '<script>alert("Error in Request Acception.")</script>';
                  echo '<script>window.location="view-withdrow-request.php"</script>';
                }

              }
            ?>
           
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
