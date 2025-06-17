<?php  
session_start();
include('includes/config.php');
include('includes/helper.php');
if(isset($_SESSION["log_user_id"])){
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){
		if($_GET['model_id'] == $_GET['user_id']){
			echo '<script>alert("You cant get all access your own profile.");</script>';
			echo '<script>window.history.back();</script>';
		}

	if($_GET['model_id'] && $_GET['user_id'] && $_GET['action'] == 'all_access'){
		$modelDetails = get_data('model_user',array('unique_id'=>$_GET['model_id']),true);
		$sql_ap = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_GET['model_id']."'";
		$model_data = DB::queryFirstRow($sql_ap);
		if($modelDetails&&$model_data){
			if($model_data['all_30day_access_price']>0){
				if($userDetails['balance'] >= $model_data['all_30day_access_price']){
					$coins = $model_data['all_30day_access_price'];
					$sql = "INSERT INTO `user_all_access`(`model_id`, `user_id`, `start_date`, `end_date`, `status`) VALUES ('".$_GET['model_id']."','".$_GET['user_id']."','".date("Y-m-d")."','".date('Y-m-d', strtotime("+30 days"))."','1')";

					DB::query($sql);
					DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $coins, $modelDetails['id']);
			
					DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $coins, $userDetails['id']);

echo '<script>alert("You have successfully subscribe 30 days all access. It will reflect at your profile within 2-3 hour.");</script>';
echo '<script>window.history.back();</script>';	
				}
				else{
					echo '<script>alert("Oops !! You have unsufficient coin to get all access. Please recharge your wallet. ");</script>';
					echo '<script>window.location.href="wallet.php";</script>';
				}   
			}
			else{
				echo '<script>alert("Sorry!! Model has no coin to get all access.");</script>';
				echo '<script>window.history.back();</script>';
			}   
		}
		else{
			echo '<script>alert("There is no model.");</script>';
			echo '<script>window.history.back();</script>';
		}
		
	}
	else{
		echo '<script>alert("Something went wrong. please try again later.");</script>';
		echo '<script>window.history.back();</script>';
	}
}
	else{
		echo "<script>alert('Please login');</script>";
		echo "<script>window.location='login.php'</script>";
	}
}
else{
	echo "<script>alert('Please login');</script>";
	echo "<script>window.location='login.php'</script>";
}
?>