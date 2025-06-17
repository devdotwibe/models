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
                            Unique id
                          </th>
                          <th>
                            Username
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Country
                          </th>
                          <th>
                            Register Date
                          </th>
                          <th>
                            View Profile
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqls = "SELECT * FROM model_user Order by id DESC";
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
                            <?php echo $rowesdw['unique_id']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['username']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['email']; ?>
                          </td>
                          <td>
                            <?php echo $rowesdw['country']; ?>
                          </td>
                          <td>
                            <?php
                              echo $rowesdw['register_date'];  
                            ?>
                          </td>
                          <td>
                          	<a href="https://models.staging3.dotwibe.com/single-profile.php?m_unique_id=<?php echo $rowesdw['unique_id']; ?>">View Profile</a>
                          </td>
                          <td>
                            <!-- <a class="btn btn-primary" href="single-profile.php?model=<?php// echo $rowesdw['username']; ?>&m_id=<?php// echo $rowesdw['id']; ?>">View Full Profile</a> -->
                            <input type="hidden" name="as_a_model" value="<?php echo $rowesdw['as_a_model']; ?>">
                            <input type="hidden" name="unique_id" value="<?php echo $rowesdw['unique_id']; ?>">
                            <input type="submit" name="submit" class="btn btn-danger" value="Delete User">
                            <!-- <input type="submit"  name="accept-request" value=""> -->
                          </td>
                          </form>
                        </tr>
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
            <?php
              if(isset($_POST['submit'])){

                $unique_id = $_POST['unique_id'];
                $as_a_model = $_POST['as_a_model'];

                if($as_a_model == 'Yes'){

                  $sql_delete = "DELETE FROM `model_user` WHERE `model_user`.`unique_id` = '".$unique_id."'";
                  $sql_delete1 = "DELETE FROM `casting` WHERE `casting`.`unique_id` = '".$unique_id."'";               
                  if(mysqli_query($con,$sql_delete) && mysqli_query($con,$sql_delete1)){
                      echo  '<script>alert("User Successfully deleted")</script>';
                      echo  '<script>window.location="all-users.php"</script>';
                  }else{
                      echo '<script>alert("Error In Deletion")</script>';
                      echo '<script>window.location="all-users.php"</script>';
                  }
                
                }else{

                  $sql_delete = "DELETE FROM `model_user` WHERE `model_user`.`unique_id` = '".$unique_id."'";
                  if(mysqli_query($con,$sql_delete)){
                      echo  '<script>alert("User Successfully deleted")</script>';
                      echo  '<script>window.location="all-users.php"</script>';
                  }else{
                      echo '<script>alert("Error In Deletion")</script>';
                      echo '<script>window.location="all-users.php"</script>';
                  }
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
