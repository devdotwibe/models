<?php  
	session_start();
 	include('includes/config.php');
 	if($_GET['model_id'] == $_GET['user_id']){
 		echo '<script>alert("You cant get all access your own profile.");</script>';
 		echo '<script>window.history.back();</script>';
 	}
 	if($_GET['model_id'] && $_GET['user_id'] && $_GET['action'] == 'all_access'){
 	
    $sql_ap = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET['model_id']."'";
    $res_ap = mysqli_query($con, $sql_ap);
    if (mysqli_num_rows($res_ap) > 0) {
      $row_ap = mysqli_fetch_assoc($res_ap);
      echo $row_ap['all_30day_access_price'];
    }

    $log_user_id = $_SESSION["log_user_unique_id"];
    $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$log_user_id."'";
    $result = mysqli_query($con,$sql);

      if (mysqli_num_rows($result) > 0) {

        $row1 = mysqli_fetch_assoc($result);
         
        echo $wallet_coins = $row1['wallet_coins'];
    }       

    if($wallet_coins >= $row_ap['all_30day_access_price']){
    	$total_remain = $wallet_coins - $row_ap['all_30day_access_price'];

    	$sql_up = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$total_remain."' WHERE `model_user_wallet`.`user_unique_id` = '".$_GET['user_id']."'";

    	$sql = "INSERT INTO `user_all_access`(`model_id`, `user_id`, `start_date`, `end_date`, `status`) VALUES ('".$_GET['model_id']."','".$_GET['user_id']."','".date("Y-m-d")."','".date('Y-m-d', strtotime("+30 days"))."','1')";
 	
	 		if(mysqli_query($con, $sql) && mysqli_query($con, $sql_up)){
	 			echo '<script>alert("You have successfully subscribe 30 days all access. It will reflect at your profile within 2-3 hour.");</script>';
	 			echo '<script>window.history.back();</script>';	
	 		}
    }else{
    	echo '<script>alert("Oops !! You have unsufficient coin to get all access. Please recharge your wallet. ");</script>';
	 		echo '<script>window.location.href="wallet.php";</script>';
    }   



 	
 	} else{
 		echo '<script>alert("Something went wrong. please try again later.");</script>';
 		echo '<script>window.history.back();</script>';
 	}
?>