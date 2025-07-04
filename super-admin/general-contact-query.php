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
                            Name
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Phone
                          </th>
                          <th>
                            Subject
                          </th>
                          <th>
                            Message
                          </th>
                          <th>
                            Create Date
                          </th>
                          <th>
                            Responds
                          </th>

                        </tr>
                      </thead>
                      <tbody>


                        <?php
                          $sqls = "SELECT * FROM contac_us WHERE user_unique_id = '' Order by id DESC";
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
                            <?php echo $rowesdw['name']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['email']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['phone']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['subject']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['message']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['created_at']; ?>
                          </td>
                          <td>
                            <span style="cursor:pointer;"  class="btn btn-success" data-toggle="modal" data-target="#exampleModalmail<?php echo $rowesdw['id']; ?>">Reply</span>
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

