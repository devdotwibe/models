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
  <style type="text/css">
    .brand-logo{
      display: flex;
    align-items: baseline;
    }
    .f_test{
      color: #dc4a38;
    font-size: 28px;
    top: 10px;
    padding-top: 53px;
    vertical-align: -webkit-baseline-middle;
        text-decoration: underline;
}

    
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="../assets/images/logo.png" alt="logo" style="height: 50px;width: 50px;"><font class="f_test">Model Agency Admin</font>
              </div>
              <h4>Welcome back!</h4>
              <h6 class="font-weight-light">Happy to see you again!</h6>
              <form class="pt-3" method ="post" action="">
                <div class="form-group">
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Email" name="email" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="password" name="password">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me connected
                    </label>
                  </div>
                  <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="my-3">
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">LOGIN</a> -->
                  <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" value="Login">
                </div>
                <!-- <div class="mb-2 d-flex">
                  <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                    <i class="ti-facebook mr-2"></i>Facebook
                  </button>
                  <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                    <i class="ti-google mr-2"></i>Google
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register-2.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">copyright &copy; 2020 All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  
    <?php
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

              $sql = "SELECT user_id FROM sc_admin WHERE user_email = '".$email."' and user_password = '".$password."'";
              $result = mysqli_query($con,$sql);
              // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              // $active = $row['user_name'];
              
              $count = mysqli_num_rows($result);
              
              if($count == 1) {
                  
                  $row=mysqli_fetch_array( $result );
                  
                  $id=$row["user_id"];
                  
                  //echo '<script> alert("' .$id .'"); </script>';

                 $_SESSION["log_id"] = $id;
                 $_SESSION["log_pass"] = $password;
                 $_SESSION["log_user"] = "Admin";
                 echo "<script> window.location.href = 'index.php'; </script>";
              }else {
                echo "<script>alert('Incorrect login details test 2.');</script>";
              }
        }
    ?>
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
</body>

</html>
