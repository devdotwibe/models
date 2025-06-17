<?php
	session_start();
	include('includes/config.php');

	if(isset($_POST['submit'])){
		$file_id = $_POST['file_id'];
		$user_id = $_POST['user_id'];
		$coins = $_POST['coins'];
		$file_type = $_POST['file_type'];

		$m_unique_id = $_POST['m_unique_id'];
		$m_id = $_POST['m_id'];
		$model = $_POST['model'];

		echo '<script>alert("Are you Sure want to buy it.");</script>';


		
    $sql_fwa = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$user_id."'";
    $result_fwa = mysqli_query($con,$sql_fwa);
    if (mysqli_num_rows($result_fwa) > 0) {
        $row_fwa = mysqli_fetch_assoc($result_fwa);
        $wallet_coins = $row_fwa['wallet_coins'];
    }  

    if($wallet_coins > $coins){

    	$remain_coin = $wallet_coins - $coins;
		$sql1 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$remain_coin."' WHERE `model_user_wallet`.`user_unique_id` = '".$user_id."'";
		$sql2 = "INSERT INTO `user_purchased_image`(`user_unique_id`, `model_unique_id`, `file_unique_id`, `file_type`, `file_coins`) VALUES ('".$user_id."','".$m_unique_id."','".$file_id."','".$file_type."','".$coins."')";
		$sql = "SELECT * FROM model_main_wallet WHERE unique_model_id = '".$m_unique_id."'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $file_con = $row['coins'];
            $tot = $file_con + $coins;
            $sql3 = "INSERT INTO `model_main_wallet`(`unique_model_id`, `coins`) VALUES ('".$m_unique_id."','".$tot."')";
        } else {
            $sql3 = "INSERT INTO `model_main_wallet`(`unique_model_id`, `coins`) VALUES ('".$m_unique_id."','".$coins."')";
        }
	
		if(mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3)){
			echo "<script>alert('File added successfully in your account.');</script>";
			echo "<script>window.location='single-profile.php?m_unique_id=".$m_unique_id."';</script>";
		}else{
			echo "<script>alert('Some Error accoured. Please try again later.');</script>";
			echo "<script>window.location='single-profile.php?m_unique_id=".$m_unique_id."';</script>";
		}

    }else{
    		echo "<script>alert('You dont have sufficiant coins in your wallet for buying it.');</script>";
			echo "<script>window.location='single-profile.php?m_unique_id=".$m_unique_id."';</script>";
    }

	}
	
?>