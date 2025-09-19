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
                  <h4 class="card-title">Purchase Details</h4>
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
                            User Unique id
                          </th>
                          <th>
                            Model Unique id
                          </th>
                          <th>
                            File Unique id
                          </th>
                          <th>
                            File coins
                          </th>
                          <th>
                            File Type
                          </th>
                          <th>
                            Purchase Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM user_purchased_image Order by id DESC";
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
                            <?php echo $rowesdw['model_unique_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['file_unique_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['file_coins']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['file_type']; ?>
                          </td>
                          <td>
                            <?php 
                            $timestamp = strtotime($rowesdw['purchase_date']);
                            echo date('d-m-Y', $timestamp);
                            //echo $rowesdw['purchase_date']; ?>
                          </td>
                          <!-- <td>
                            <span style="cursor:pointer;"  class="btn btn-success" data-toggle="modal" data-target="#exampleModalmail<?php echo $rowesdw['id']; ?>">Reply</span>
                          </td> -->
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
        			                      <form method="post" action="query-reply.php">
        			                        <input type="hidden" name="query_id" value="<?php echo $rowesdw['id']; ?>">
        			                        <input type="hidden" name="email" value="<?php echo $rowesdw['email']; ?>">
        			                       <div class="form-group">
        			                         <label for="subject"><b>Subject:</b></label>
        			                          <input type="text" name="subject" class="form-control" placeholder="Enter subject" id="subject">
        			                       </div>
        			                        <div class="form-group">
        			                         <label for="message"><b>Message:</b></label>
        			                          <textarea type="text" name="message" class="form-control" placeholder="Enter message" id="message"></textarea>
        			                        </div>
        			                  <div class="modal-footer">
        			                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        			                    <button type="submit" name="reply" class="btn btn-primary">Reply</button>
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
