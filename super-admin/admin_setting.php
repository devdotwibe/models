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
             <?php
           
                    if (isset($_POST['update_discount_price_show'])) {
                        $status = ($_POST['discount_price_show'] === 'Yes') ? 'Yes' : 'No';
                        $updatedAt = date('Y-m-d H:i:s'); 

                        $checkQuery = "SELECT id FROM admin_settings LIMIT 1";
                        $checkResult = mysqli_query($con, $checkQuery);

                        if (mysqli_num_rows($checkResult) > 0) {
                        
                            $updateQuery = "UPDATE admin_settings 
                                            SET discount_price_show='$status', updated_at='$updatedAt' 
                                            ORDER BY id DESC LIMIT 1";
                            mysqli_query($con, $updateQuery);
                        } else {

                            $insertQuery = "INSERT INTO admin_settings (discount_price_show, updated_at) 
                                            VALUES ('$status', '$updatedAt')";
                            mysqli_query($con, $insertQuery);
                        }
                    }



                    $discountPriceShow = "No";

                    $updated_at = null;

                    $getSettings = mysqli_query($con, "SELECT discount_price_show, updated_at FROM admin_settings ORDER BY id DESC LIMIT 1");
                    if ($getSettings && mysqli_num_rows($getSettings) > 0) {
                        $row = mysqli_fetch_assoc($getSettings);
                        $discountPriceShow = $row['discount_price_show'];
                        $updated_at = $row['updated_at'];
                    }

                    if ($updated_at) {

                        $timeDiff = time() - strtotime($updated_at);
                        if ($timeDiff > 86400) { 
                            $discountPriceShow = "No";
                        }
                    }


                ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Discount Price Visibility</h4>
                        <form method="post">
                            <div class="form-group">
                                <label><b>Show Discount Price ?</b></label>
                                <select name="discount_price_show" class="form-control" required>
                                    <option value="Yes" <?php if ($discountPriceShow === "Yes") echo "selected"; ?>>Yes</option>
                                    <option value="No" <?php if ($discountPriceShow === "No") echo "selected"; ?>>No</option>
                                </select>
                            </div>
                            <button type="submit" name="update_discount_price_show" class="btn btn-primary">Save</button>
                        </form>
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

