<?php
  session_start();
  include('includes/config.php');

if (isset($_POST['submit_insta_call'])) {

      $u_id = $_POST['u_id'];
      $coins = $_POST['coins'];
      $u_model_id = $_POST['m_unique_id'];
      $i_username = $_POST['i_username'];
      $i_email = $_POST['i_email'];
      $call_on = 'Instagram';

      $sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$u_id."'";
      $result_fwa = mysqli_query($con,$sql_fwa);
      if (mysqli_num_rows($result_fwa) > 0) {
          $row_fwa = mysqli_fetch_assoc($result_fwa);
          $wallet_coins = $row_fwa['wallet_coins'];
      }  

      if($wallet_coins > $coins){

        $sql = "INSERT INTO `insta_snap_call`(`unique_user_id`, `unique_model_id`, `call_on`, `username`, `email`) VALUES ('".$u_id."','".$u_model_id."','".$call_on."','".$i_username."','".$i_email."')";

        $remain_coin = $wallet_coins - $coins;
        $sql1 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$remain_coin."' WHERE `model_user_wallet`.`user_unique_id` = '".$u_id."'";

        $sql2 = "SELECT * FROM model_main_wallet WHERE unique_model_id = '".$u_model_id."'";
        $result = mysqli_query($con, $sql2);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $file_con = $row['coins'];
            $tot = $file_con + $coins;
            $sql3 = "INSERT INTO `model_main_wallet`(`unique_model_id`, `coins`) VALUES ('".$u_model_id."','".$tot."')";
        } else {
            $sql3 = "INSERT INTO `model_main_wallet`(`unique_model_id`, `coins`) VALUES ('".$u_model_id."','".$coins."')";
        }

        if(mysqli_query($con,$sql)&&mysqli_query($con,$sql1)&&mysqli_query($con,$sql3)){
          echo '<script>alert("Your Call has been Successfully send to model.")</script>';
          echo '<script>window.location="single-profile.php?m_unique_id="'.$u_model_id.'""</script>';
        }
        else{
          echo '<script>alert("Oops!! Your Call has not been sent to model/nPlease try again after some time.")</script>';
          echo '<script>window.location="single-profile.php?m_unique_id="'.$u_model_id.'""</script>';
        }

      }else{
        echo "<script>alert('You dont have sufficiant coins in your wallet for buying it.');</script>";
        echo "<script>window.location='single-profile.php?m_unique_id='".$u_model_id."'';</script>";
      }

    }else if(isset($_POST['submit_snap_call'])){

      $u_id = $_POST['u_id'];
      $coins = $_POST['coins'];
      $u_model_id = $_POST['m_unique_id'];
      $s_username = $_POST['s_username'];
      $s_email = $_POST['s_email'];
      $call_on = 'Snapchat';

      $sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$u_id."'";
      $result_fwa = mysqli_query($con,$sql_fwa);
      if (mysqli_num_rows($result_fwa) > 0) {
          $row_fwa = mysqli_fetch_assoc($result_fwa);
          $wallet_coins = $row_fwa['wallet_coins'];
      }  

      if($wallet_coins > $coins){

        $sql = "INSERT INTO `insta_snap_call`(`unique_user_id`, `unique_model_id, `call_on`, `username`, `email`) VALUES ('".$u_id."','".$u_model_id."','".$call_on."','".$s_username."','".$s_email."')";

        $remain_coin = $wallet_coins - $coins;
        $sql1 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$remain_coin."' WHERE `model_user_wallet`.`user_unique_id` = '".$u_id."'";

        $sql2 = "SELECT * FROM model_main_wallet WHERE unique_model_id = '".$u_model_id."'";
        $result = mysqli_query($con, $sql2);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $file_con = $row['coins'];
            $tot = $file_con + $coins;
            $sql3 = "INSERT INTO `model_main_wallet`(`unique_model_id`, `coins`) VALUES ('".$u_model_id."','".$tot."')";
        } else {
            $sql3 = "INSERT INTO `model_main_wallet`(`unique_model_id`, `coins`) VALUES ('".$u_model_id."','".$coins."')";
        }
      
        if(mysqli_query($con, $sql) && mysqli_query($con, $sql1) && mysqli_query($con, $sql3)){
          echo '<script>alert("Your Call has been Successfully send to model.")</script>';
          echo '<script>window.location="single-profile.php?m_unique_id="'.$u_model_id.'""</script>';
        }else{
          echo '<script>alert("Oops!! Your Call has not been sent to model/nPlease try again after some time.")</script>';
          echo '<script>window.location="single-profile.php?m_unique_id="'.$u_model_id.'""</script>';
        }

      }else{
        echo "<script>alert('You dont have sufficiant coins in your wallet for Book a call.');</script>";
        echo "<script>window.location='single-profile.php?m_unique_id=".$u_model_id."';</script>";
      }  
        
    }
 
?>