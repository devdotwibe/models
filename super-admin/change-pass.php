<?php 
    session_start(); 
     $usern = $_SESSION["log_user"];
    if( !$usern ){
        echo '<script>window.location.href="login.php"</script>';
    }

include("includes/config.php"); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->

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
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Change Password</h4>
                </div>
                <div>
                    
                    
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded" style="display:none;">
                      <i class="ti-clipboard btn-icon-prepend"></i>Report
                    </button>
                    
                    
                </div>
              </div>
            </div>
          </div>
            <?php 
            if( !empty( $_POST["updatepassbutt"] ) ){
                
                $un=strtolower( $_POST["un"] );
                
                $oldpass=$_POST["oldpass"];
                $pass=$_POST["pass"];
                $conpass=$_POST["conpass"];
                
                $uid=$_SESSION["log_id"];
                
                if( $_SESSION["log_pass"]==$oldpass ){
                    
                    if( $pass==$conpass ){
                        $qur=mysqli_query($con,"UPDATE sc_admin SET user_password='$pass' WHERE user_id='$uid' ");
                        
                        //echo '<script> alert("' .$qur .'"); </script>';
                        
                        if( $qur ){ 
                            echo '<div class="alert alert-success"><strong>Success!</strong> Password Update successful </div>'; 
                            $_SESSION["log_pass"]=$pass;
                        }
                        else{
                            echo mysqli_error($con); 
                            echo '<div class="alert alert-danger"><strong>Error!</strong> Password Not Updated.</div>'; 
                            
                        }
                    }
                    else{
                       echo '<div class="alert alert-danger"><strong>Error!</strong> Password Not Matched.</div>'; 
                    }
                    
                }
                else{
                    echo '<div class="alert alert-danger"><strong>Error!</strong> Wrong Password.</div>';
                }
                
                
                
            }
            ?>
            <form action="" method="post" autocomplete="off">
            
            <table class="table" style="width:100%;">
                <tr>
                    <td>Currunt Password</td>
                    <td> <input type="password" name="oldpass" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td> <input type="password" name="pass" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td> <input type="password" name="conpass" class="form-control" required /> </td>
                </tr>
            </table>
            
            <input type="hidden" name="un" value="<?php echo $_SESSION["log_user"]; ?>" />
            <input type="submit" name="updatepassbutt" value="Update" class="btn btn-primary" />
            
            </form>
          <h5 style="display:none;">Change Password, <?php echo $usern = $_SESSION['log_pass'] ." - " .$_SESSION['log_id'] ; ?></h5>
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
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

