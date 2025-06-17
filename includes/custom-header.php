<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="https://thelivemodels.com/uploads/live-model-logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="https://thelivemodels.com/">Home</a></li>
        <li><a href="https://thelivemodels.com/all-models.php">All Models</a></li>
        <?php if($_SESSION["log_user"]){ ?>

          <?php
              $log_user_id = $_SESSION["log_user_unique_id"];
              $sql1 = "SELECT * FROM model_user WHERE unique_id = '".$log_user_id."'";
              $result1 = mysqli_query($con,$sql1);

              if (mysqli_num_rows($result1) > 0) {

                $row1 = mysqli_fetch_assoc($result1);
                 
                 $status = $row1['as_a_model'];
                 if($status == 'Yes'){
          ?>
        <li><a href="https://thelivemodels.com/model-panel/dashboard.php">Model Panel</a></li>
        <?php }else if($status == 'No'){ ?>
        <li ><a href="https://thelivemodels.com/model-panel/casting.php">Casting</a></li>
        <?php }  } ?>
        <li class="dropdown">

          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hello <?php echo $_SESSION["log_user"]; ?> 
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
                    $log_user_id = $_SESSION["log_user_unique_id"];
                    $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$log_user_id."'";
                    $result = mysqli_query($con,$sql);

                      if (mysqli_num_rows($result) > 0) {

                        $row1 = mysqli_fetch_assoc($result);
                         
                        $wallet_coins = $row1['wallet_coins'];
                    }
                         
                ?>
            <li><a href="https://thelivemodels.com/wallet.php">Wallet&nbsp;(<i class="fas fa-coins" style="font-size:15px;color:gold" aria-hidden="true"></i><?php if($wallet_coins){ echo $wallet_coins; }else{ echo '0'; }  ?>)&nbsp;</a></li>
            <li><a href="https://thelivemodels.com/my-purchase.php">My Purchase</a></li>
            <li><a href="https://thelivemodels.com/edit-profile.php">Edit Profile</a></li>
            <li><a href="https://thelivemodels.com/logout.php">Logout</a></li>
            <?php }else{ ?>
            <li><a href="https://thelivemodels.com/login.php">Sign In</a></li>   
            <?php } ?>
          </ul>
        </li>
        <!-- <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
     
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
      </ul>
    </div>
  </div>
</nav>

</body>
</html>
