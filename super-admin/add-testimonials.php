<?php 
  session_start();
  include('includes/config.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
    .field_wrapper{
      text-align: right;
    }
    .add_button img{
      margin-top: -70px;
      margin-right: 10px;
    }
    .remove_button img
    {
        margin-right: 10px;
        position: relative;
        top: -54px;
    }
     .remove_button2 img{
         left: 91%;
         position: relative;
          top: -53px;
    }
    .add_button2 img{
     margin-top: -70px;
    position: relative;
    left: 90%;
    }
    .add_button3 img{
     margin-top: -70px;
    position: relative;
    left: 90%;
    }
    .c_btn{
      text-decoration-line: underline;
      color: #e55243;
      cursor: pointer;
      text-align: right;
      transition: 1s;
    }
    .c_btn:hover{
      /*text-decoration-line: underline*/;
      color: #481914;
      cursor: pointer;
      
    }
  </style>
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
          <div class="row">
            
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Tesimonial</h4>
                  <p><small>Do not use the apostrophe sign (') in any field.</small></p>
                  <form class="form-sample" method="post" action="act-testimonial.php" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Testimonial name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="test_name" required="required" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Testimonial Description</label>
                          <div class="col-sm-9">
                            <textarea name="test_description" class="form-control" required="required"> </textarea>
                            <!-- <input type="text"  name="course_sub_name" /> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Testimonial Image</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" name="test_img" required="required" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="save_test">Add Testimonial</button>
                  </form>
                </div>
                <table class="table">
                <thead>
                  <td>Name</td>
                  <td>Description</td>
                  <td>image</td>
                  <td>Delete</td>
                </thead>
                <tbody>
                  <?php
                    $sql_test = "SELECT * FROM testimonials Order by id DESC ";
                      $result_test = mysqli_query($con, $sql_test);
                        if (mysqli_num_rows($result_test) > 0) {
                          $count = 1;
                          while($row_test = mysqli_fetch_assoc($result_test)) {
                  ?>
                  <form method="post" action="act-testimonial.php">
                    <tr>
                      <td><?php echo $row_test['testmonial_name']; ?></td>
                      <td><?php echo $row_test['testmonial_description']; ?></td>
                      <td>
                        <img src="../<?php echo $row_test['testmonial_image']; ?>" style="height: 50px;width: 50px;"></td>
                      <input type="hidden" name="id" value="<?php echo $row_test['id']; ?>">
                      <td><input type="submit" name="del_test" value="Delete"></td>
                    </tr>
                  </form>
                  <?php
                    $count++;
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
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/file-upload.js"></script>

  <!-- End custom js for this page-->
</body>

</html>
