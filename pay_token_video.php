<?php 
	session_start();
 	include('includes/config.php');

	$total_token = $_GET['token'];  

	$sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
	$result_fwa = mysqli_query($con,$sql_fwa);
	if (mysqli_num_rows($result_fwa) > 0) {
    $row_fwa = mysqli_fetch_assoc($result_fwa);
    $wallet_coins = $row_fwa['wallet_coins'];
	}

	if($total_token < $wallet_coins){

    $remain_coin = $wallet_coins - $total_token;
    $sql1 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$remain_coin."' WHERE `model_user_wallet`.`user_unique_id` = '".$_SESSION["log_user_unique_id"]."'";

    if(mysqli_query($con,$sql1)){
   
      echo '<script>alert("Your coins will be debited successfully. Live video starting soon. Please click on Ok.")</script>';
      echo '<script>window.location.href="https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id='.$_GET["m_unique_id"].'"</script>';
    }else{
    	echo '<script>alert("Oops !! found some error. Please try again later.")</script>';
      echo '<script>window.history.back()</script>';
    }
        
  }else{
    echo '<script>alert("Oops!! You dont have coins for live video. Please add coins in your wallet")</script>';
    echo '<script>window.location.href="https://thelivemodels.com/wallet.php"</script>';
  } 

?>
