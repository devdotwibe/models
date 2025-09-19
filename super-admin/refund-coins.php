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
                  <h4 class="card-title">Refund Coins</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            S. no.
                          </th>
                          <th>
                            Profile image
                          </th>
                          <th>
                            Unique id
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Country & City
                          </th>
                          <th>
                            Refund Coins
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' Order by id DESC";
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
                            <img src="../<?php echo $rowesdw['profile_pic']; ?>" style="height: 50px;width: 50px;">
                          </td>
                          <td>
                            <?php echo $rowesdw['unique_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['name']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['email']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['country'].' '.$rowesdw['city']; ?>
                          </td>
                          <td>
                            <span style="cursor:pointer;"  class="btn btn-success" data-toggle="modal" data-target="#exampleModalmail<?php echo $rowesdw['id']; ?>">Refund Coins</span>
                          </td>
                          </form>

                          <!-- model- togle -->
        			             <div class="modal fade" id="exampleModalmail<?php echo $rowesdw['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"      aria-hidden="true">
        			              <div class="modal-dialog" role="document">
        			                <div class="modal-content">
        			                  <div class="modal-header">
        			                    <h5 class="modal-title" id="exampleModalLabel">Responds</h5>
        			                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        			                      <span aria-hidden="true">&times;</span>
        			                    </button>
        			                  </div>
        			                    <div class="modal-body">
        			                      <form method="post" action="act-refund-coins.php">
        			                        <input type="hidden" name="unique_id" value="<?php echo $rowesdw['unique_id']; ?>">
                                      <input type="hidden" name="email" value="<?php echo $rowesdw['email']; ?>">
        			                       <div class="form-group">
        			                         <label for="refund"><b>Refund Coins:</b></label>
        			                          <input type="text" name="refund_coin" class="form-control" placeholder="Enter Coins" id="refund">
        			                       </div>
        			                        <div class="form-group">
        			                         <label for="message"><b>Message:</b></label>
        			                          <textarea type="text" name="message" class="form-control" placeholder="Enter message" id="message"></textarea>
        			                        </div>
        			                  <div class="modal-footer">
        			                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        			                    <button type="submit" name="reply" class="btn btn-primary">Refund coins</button>
        			                  </div>
        			                    </form>
        			                  </div>
        			                </div>
        			              </div>
        			            </div>

                        </tr>
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
