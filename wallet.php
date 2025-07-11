<?php 
session_start(); 
include('includes/config.php');
include('includes/helper.php');

$m_link= SITEURL.'user/transaction-history/';
$table_name = "users_withdrow_request";	
$per_amount = 50;

if(isset($_SESSION["log_user_id"])){
	$usern = $_SESSION["log_user"];
	$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){
		//echo '<pre>'; print_r($userDetails); echo '</pre>';
		if($userDetails['as_a_model'] == 'Yes') $user_type = 'model';
		else $user_type = 'user';
	}
	else{
		echo '<script>window.location.href="login.php"</script>';
	}
	$checkbankdetail = get_data('users_bankdetail',array('user_id'=>$userDetails["id"]),true);

	$check_request = get_data($table_name,array('user_id'=>$userDetails["id"],'status'=>'0'),true);

	$taxdetail = get_data('model_tax_info',array('user_id'=>$userDetails["id"]),true);
	
	//create withdraw data
	if($_POST && isset($_POST['req_withdraw'])){
		$arr = array('coins','withdrawal_method');
		$post_data = array_from_post($arr);
		$post_data['amount'] = round($post_data['coins']/$per_amount,2);
		$post_data['transaction_fee'] = 5;
		
		$post_data['account_name'] = $checkbankdetail['account_name'];
		$post_data['account_number'] = $checkbankdetail['account_number'];
		$post_data['bank_name'] = $checkbankdetail['bank_name'];
		$post_data['branch_name'] = '';
		$post_data['bank_address'] = '';
		$post_data['country'] = '';
		$post_data['swift_code'] = '';
		$post_data['ifsc_code'] = $checkbankdetail['ifsc_code'];
		$post_data['upi_id'] = $checkbankdetail['upi_id'];
		
		//$post_data = array_from_get($arr);
		$post_data['user_id'] = $userDetails['id'];
		$post_data['created_date'] = date('Y-m-d H:i:s');
		
		DB::insert($table_name, $post_data);
		$created_id = DB::insertId();
		$withdraw_msg = 'Withdrawal request submitted.';
		//echo '<script>window.location="'.$m_link.'"</script>';
		header('Location: wallet.php');
		exit();
	}	
	
	//Bank data
	
	if($_POST && isset($_POST['bankdata_sub'])){
	$arr_bnk = array('account_name','bank_name','account_number','ifsc_code','upi_id'); 
	$post_data_bnk = array_from_post($arr_bnk); 
	$get_bankdata = DB::query('select * from users_bankdetail where user_id = '.$userDetails["id"]); 
		if(empty($get_bankdata)){
			$post_data_bnk['user_id'] = $userDetails["id"];
			$post_data_bnk['status'] = 1;
			$post_data_bnk['created_date'] = date('Y-m-d H:i:s');

			DB::insert('users_bankdetail', $post_data_bnk);
			$created_id = DB::insertId();
			echo '<script>alert("Bank details added successfully.");</script>';
		}else{
			DB::update('users_bankdetail', $post_data_bnk, "user_id=%s", $userDetails["id"]);
			echo '<script>alert("Bank details updated successfully.");</script>';
		}
	}

	//Tax info
	if($_POST && isset($_POST['tax_submit'])){
	$arr_tax = array('country','pan_number','aadhaar_number','annual_income'); 
	$post_data_tax = array_from_post($arr_tax); 
		if(empty($taxdetail)){
			$post_data_tax['user_id'] = $userDetails["id"];
			$post_data_tax['created_date'] = date('Y-m-d H:i:s');

			DB::insert('model_tax_info', $post_data_tax);
			$created_id = DB::insertId();
			echo '<script>alert("Tax Information added successfully.");</script>';
		}else{
			DB::update('model_tax_info', $post_data_tax, "user_id=%s", $userDetails["id"]);
			echo '<script>alert("Tax Information updated successfully.");</script>';
		}
	}
	
}
else{
	echo '<script>window.location.href="login.php"</script>';
}
$activeTab = 'wallet';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Digital Wallet - The Live Models</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
	<?php  include('includes/head.php'); ?>
    
</head>
<body id="app" class="advt-page  socialwall-page">

    <div class="premium-wallet">
		
    <?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	
	
	<div class="container mx-auto px-4 py-8 max-w-6xl relative z-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                Premium Digital Wallet
            </h1>
            <p class="text-gray-300 text-lg">Manage your tokens, earnings, and transactions</p>
        </div>

        <!-- User Type Toggle -->
        <div class="user-toggle" style="display:none;">
            <button class="toggle-btn <?php if($user_type == 'user'){ ?> active <?php } ?>" id="userBtn" onclick="switchMode('user')">
                👤 User Mode
            </button>
            <button class="toggle-btn <?php if($user_type == 'model'){ ?> active <?php } ?>" id="modelBtn" onclick="switchMode('model')">
                💎 Model Mode
            </button>
        </div>

        <!-- Balance Card -->
        <div class="balance-card">
            <h2 class="text-xl md:text-2xl font-semibold mb-2">Current Balance</h2>
            <div class="balance-amount" id="balance"><?php echo $userDetails['balance']; ?></div>
            <p class="text-gray-300">Coins in your wallet</p>
            <div class="model-only mt-4">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-green-400">₹15,420</div>
                        <div class="text-sm text-gray-400">Available for Withdrawal</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-blue-400">₹8,750</div>
                        <div class="text-sm text-gray-400">This Month Earnings</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="glass-card p-6">
            <div class="tab-nav">
                <button class="tab-btn <?php if($user_type == 'user'){ ?> active <?php } ?> " onclick="switchTab('buy')" data-tab="buy">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="8" cy="21" r="1"></circle>
                        <circle cx="19" cy="21" r="1"></circle>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57L20.42 9H5.12"></path>
                    </svg>
                    Buy Tokens
                </button>
                
                <button class="tab-btn <?php if($user_type == 'user'){ ?> model-only <?php }else  echo ' active '; ?>" onclick="switchTab('withdraw')" data-tab="withdraw">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Withdraw
                </button>
                
                <button class="tab-btn" onclick="switchTab('history')" data-tab="history">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v5h5"></path>
                        <path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path>
                        <path d="M12 7v5l4 2"></path>
                    </svg>
                    History
                </button>
                
                <button class="tab-btn <?php if($user_type == 'user'){ ?> model-only <?php } ?>" onclick="switchTab('bank')" data-tab="bank">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 21h18"></path>
                        <path d="M5 21V7l8-4v18"></path>
                        <path d="M19 21V11l-6-4"></path>
                    </svg>
                    Bank Details
                </button>
                
                <button class="tab-btn <?php if($user_type == 'user'){ ?> model-only <?php } ?>" onclick="switchTab('tax')" data-tab="tax">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    Tax Info
                </button>
            </div>

            <!-- Buy Tokens Tab -->
            <div id="buy" class="tab-content <?php if($user_type == 'user'){ ?> active <?php } ?>">
                <h3 class="text-2xl font-bold mb-6 text-center bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Purchase Token Packages
                </h3>
                
                <!-- Indian Users -->
                <div class="mb-8">
                    <h4 class="text-xl font-semibold mb-4 flex items-center">
                        <span class="mr-2">🇮🇳</span> Indian Users (INR)
                    </h4>
                    <div class="purchase-grid">
					
					<?php
						$log_user_id = $_SESSION["log_user_unique_id"];
						$sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$log_user_id."'";
						$result = mysqli_query($con,$sql);

						  if (mysqli_num_rows($result) > 0) {

							$row1 = mysqli_fetch_assoc($result);
							 
							$wallet_coins = $row1['wallet_coins'];
						}       
					  ?>
					
                        <div class="purchase-card">
                            <div class="coin-icon">₹</div>
                            <h5 class="text-lg font-bold mb-2">Starter Pack</h5>
                            <div class="text-3xl font-bold mb-2">10 Coins</div>
                            <div class="text-gray-400 mb-4">Perfect for beginners</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">₹10.00</div>
							
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="10">
							<input type="hidden" name="coins" value="10">
                            <button class="btn btn-primary w-full" type="submit" name="submit10" <?php /*onclick="purchase(10, 'INR', 10)" */ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card popular">
                            <div class="coin-icon">₹</div>
                            <h5 class="text-lg font-bold mb-2">Popular Pack</h5>
                            <div class="text-3xl font-bold mb-2">100 Coins</div>
                            <div class="text-gray-400 mb-4">Best value for money</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">₹100.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="100">
							<input type="hidden" name="coins" value="100">
                            <button class="btn btn-primary w-full" type="submit" name="submit100" <?php /*onclick="purchase(100, 'INR', 100)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">₹</div>
                            <h5 class="text-lg font-bold mb-2">Premium Pack</h5>
                            <div class="text-3xl font-bold mb-2">500 Coins</div>
                            <div class="text-gray-400 mb-4">For heavy users</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">₹500.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="500">
							<input type="hidden" name="coins" value="500">
                            <button class="btn btn-primary w-full" type="submit" name="submit500" <?php /*onclick="purchase(500, 'INR', 500)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">₹</div>
                            <h5 class="text-lg font-bold mb-2">Ultimate Pack</h5>
                            <div class="text-3xl font-bold mb-2">1000 Coins</div>
                            <div class="text-gray-400 mb-4">Maximum value</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">₹1,000.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="1000">
							<input type="hidden" name="coins" value="1000">
                            <button class="btn btn-primary w-full" type="submit" name="submit1000" <?php /*onclick="purchase(1000, 'INR', 1000)" */ ?> >
                                Purchase Now
                            </button>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">₹</div>
                            <h5 class="text-lg font-bold mb-2">VIP Pack</h5>
                            <div class="text-3xl font-bold mb-2">2500 Coins</div>
                            <div class="text-gray-400 mb-4">VIP experience</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">₹2,500.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="2500">
							<input type="hidden" name="coins" value="2500">
                            <button class="btn btn-primary w-full" type="submit" name="submit2500" <?php /*onclick="purchase(2500, 'INR', 2500)" */ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">₹</div>
                            <h5 class="text-lg font-bold mb-2">Elite Pack</h5>
                            <div class="text-3xl font-bold mb-2">5000 Coins</div>
                            <div class="text-gray-400 mb-4">Elite status</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">₹5,000.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="5000">
							<input type="hidden" name="coins" value="5000">
                            <button class="btn btn-primary w-full" type="submit" name="submit5000" <?php /*onclick="purchase(5000, 'INR', 5000)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>
                    </div>
                </div>

                <!-- Foreign Users -->
                <div>
                    <h4 class="text-xl font-semibold mb-4 flex items-center">
                        <span class="mr-2">🌍</span> International Users (USD)
                    </h4>
                    <div class="purchase-grid">
                        <div class="purchase-card">
                            <div class="coin-icon">$</div>
                            <h5 class="text-lg font-bold mb-2">Starter Pack</h5>
                            <div class="text-3xl font-bold mb-2">10 Coins</div>
                            <div class="text-gray-400 mb-4">Perfect for beginners</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">$0.12</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="0.12">
							<input type="hidden" name="coins" value="10">
                            <button class="btn btn-primary w-full" type="submit" name="submit_f0" <?php /*onclick="purchase(10, 'USD', 0.12)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card popular">
                            <div class="coin-icon">$</div>
                            <h5 class="text-lg font-bold mb-2">Popular Pack</h5>
                            <div class="text-3xl font-bold mb-2">100 Coins</div>
                            <div class="text-gray-400 mb-4">Best value for money</div>
							<div class="text-2xl font-bold text-green-400 mb-4">$1.20</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="1.20">
							<input type="hidden" name="coins" value="100">
                            <button class="btn btn-primary w-full" type="submit" name="submit_f5" <?php /*onclick="purchase(100, 'USD', 1.20)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">$</div>
                            <h5 class="text-lg font-bold mb-2">Premium Pack</h5>
                            <div class="text-3xl font-bold mb-2">500 Coins</div>
                            <div class="text-gray-400 mb-4">For heavy users</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">$6.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="6.00">
							<input type="hidden" name="coins" value="500">
                            <button class="btn btn-primary w-full" type="submit" name="submit_f9" <?php /*onclick="purchase(500, 'USD', 6.00)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">$</div>
                            <h5 class="text-lg font-bold mb-2">Ultimate Pack</h5>
                            <div class="text-3xl font-bold mb-2">1000 Coins</div>
                            <div class="text-gray-400 mb-4">Maximum value</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">$12.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="12.00">
							<input type="hidden" name="coins" value="1000">
                            <button class="btn btn-primary w-full" type="submit" name="submit_f14" <?php /*onclick="purchase(1000, 'USD', 12.00)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">$</div>
                            <h5 class="text-lg font-bold mb-2">VIP Pack</h5>
                            <div class="text-3xl font-bold mb-2">2500 Coins</div>
                            <div class="text-gray-400 mb-4">VIP experience</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">$30.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="30.00">
							<input type="hidden" name="coins" value="2500">
                            <button class="btn btn-primary w-full" type="submit" name="submit_f19" <?php /*onclick="purchase(2500, 'USD', 30.00)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>

                        <div class="purchase-card">
                            <div class="coin-icon">$</div>
                            <h5 class="text-lg font-bold mb-2">Elite Pack</h5>
                            <div class="text-3xl font-bold mb-2">5000 Coins</div>
                            <div class="text-gray-400 mb-4">Elite status</div>
                            <div class="text-2xl font-bold text-green-400 mb-4">$60.00</div>
							<form method="post" action="payments/index.php">
							<input type="hidden" name="amount" value="60.00">
							<input type="hidden" name="coins" value="5000">
                            <button class="btn btn-primary w-full" type="submit" name="submit_f29" <?php /*onclick="purchase(5000, 'USD', 60.00)"*/ ?> >
                                Purchase Now
                            </button>
							</form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Withdraw Tab -->
            <div id="withdraw" class="tab-content <?php if($user_type == 'model'){ ?> active <?php } ?>">
                <h3 class="text-2xl font-bold mb-6 text-center bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Withdraw Earnings
                </h3>
                
                <div class="max-w-2xl mx-auto">
                    <div class="glass-card p-6 mb-6">
                        <h4 class="text-xl font-semibold mb-4">Available for Withdrawal</h4>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-green-400 mb-2">₹<?=$userDetails['balance']?></div>
                            <p class="text-gray-400">Minimum withdrawal: ₹1,000</p>
                        </div>
                    </div>
					
					<?php if(isset($withdraw_msg)){ ?>
					<div class="withdraw_msg"><?php echo $withdraw_msg; ?></div>
					<?php } ?>
					

					<form action="" method="post" class="space-y-6  edit-form" role="form" enctype="multipart/form-data" <?php /*onsubmit="handleWithdraw(event)" */ ?>  >
                        <div class="form-group">
                            <label class="form-label">Withdrawal Amount</label>
                            <input type="number" class="form-input" placeholder="Enter amount" name="coins"  value="<?=$userDetails['balance']?>" min="1000" max="<?=$userDetails['balance']?>"  required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Withdrawal Method</label>
                            <select class="form-input" name="withdrawal_method" required>
                                <option value="">Select method</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="upi">UPI</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <button type="<?php if($check_request){ echo 'button'; } else{ ?>submit<?php } ?>" name="req_withdraw" class="btn btn-success w-full" <?php if($check_request){ ?> onclick="rejectWithdraw()" <?php } ?> >
                            Request Withdrawal
                        </button>
                    </form>
                </div>
            </div>

            <!-- History Tab -->
            <div id="history" class="tab-content">
                <h3 class="text-2xl font-bold mb-6 text-center bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Transaction History
                </h3>
				
				<?php 
			
				$total_trans = DB::queryFirstrow("SELECT COUNT(*) AS total FROM model_user_transaction_history where user_id=".$userDetails['id']);
				
				?>
				
				<form method="get" id="search-form" class="form-inline" onSubmit="submit_search(1);return false;">
				<input type="hidden" id="selpagesize" value="10" />
				<input type="hidden" name="pages" id="i-page" value="1" />
				<input type="hidden" name="total_item" id="i-total-page" value="0" />
				<input type="hidden" name="sort_column" id="hdnSortColumn" value="" />
				<input type="hidden" name="sort_type" id="hdnSortOrder" value="" />
				</form>
                
                <div id="transactionList"></div>
				
				<?php if($total_trans['total'] > 20){ ?>
				<!-- Pagination -->
            <div class="pagination">
			
				
            <div class="row" style="margin-top:10px">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <ul class="pagination pull-right" style="margin:0" id="list-paginations"></ul>
                </div>
            </div>
			
			</div>
			
				<?php } ?>
				
            </div>

            <!-- Bank Details Tab -->
            <div id="bank" class="tab-content">
                <h3 class="text-2xl font-bold mb-6 text-center bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Bank Account Details
                </h3>
                
                <div class="max-w-2xl mx-auto">
                    <form action="" method="post" class="space-y-6" role="form" enctype="multipart/form-data" <?php /* onsubmit="handleBankDetails(event)" */ ?> >
                        <div class="form-row">
                            <div class="form-group"> 
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" class="form-input" placeholder="Full name" name="account_name" value="<?php if(isset($_POST['account_name'])) { echo $_POST['account_name']; } else echo $checkbankdetail['account_name']?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-input" placeholder="Bank name" name="bank_name" value="<?php if(isset($_POST['bank_name'])) { echo $_POST['bank_name']; } else echo $checkbankdetail['bank_name']?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Account Number</label>
                                <input type="text" class="form-input" placeholder="Account number" name="account_number" value="<?php if(isset($_POST['account_number'])) { echo $_POST['account_number']; } else echo $checkbankdetail['account_number']?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">IFSC Code</label>
                                <input type="text" class="form-input" placeholder="IFSC code" name="ifsc_code" value="<?php if(isset($_POST['ifsc_code'])) { echo $_POST['ifsc_code']; } else echo $checkbankdetail['ifsc_code']?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">UPI ID (Optional)</label>
                            <input type="text" class="form-input" placeholder="your-upi@bank" name="upi_id" value="<?php if(isset($_POST['upi_id'])) { echo $_POST['upi_id']; } else echo $checkbankdetail['upi_id']?>" >
                        </div>
						
						
                        <button type="submit" name="bankdata_sub" class="btn btn-primary w-full">
                            Save Bank Details
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tax Info Tab -->
            <div id="tax" class="tab-content">
                <h3 class="text-2xl font-bold mb-6 text-center bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Tax Information
                </h3>
                
                <div class="max-w-2xl mx-auto">
					<form action="" method="post" class="space-y-6" role="form" enctype="multipart/form-data" <?php /* onsubmit="handleTaxInfo(event)" */ ?> >
                        <div class="form-group">
                            <label class="form-label">Tax Residency Country</label>
							<?php $f_country_list = DB::query('select id,name,sortname from countries order by name asc'); 
							$country = '';
							if(isset($_POST['country'])) {
								$country = $_POST['country'];
							}else if(!empty($taxdetail['country'])){
								$country = $taxdetail['country'];
							}
							
							?>
                            <select class="form-input" name="country" required>
                                <option value="">Select country</option>
								
								<?php foreach($f_country_list as $val){ ?>
								
								<option value="<?=$val['id']?>" <?=$country==$val['id']?'selected':''?>><?=$val['name']?></option>
								
								<?php } ?>
								
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">PAN Number</label>
                                <input type="text" class="form-input" name="pan_number" value="<?php if(isset($_POST['pan_number'])) { echo $_POST['pan_number']; } else echo $taxdetail['pan_number']; ?>" placeholder="ABCDE1234F" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Aadhaar Number</label>
                                <input type="text" class="form-input" name="aadhaar_number" value="<?php if(isset($_POST['aadhaar_number'])) { echo $_POST['aadhaar_number']; } else echo $taxdetail['aadhaar_number']; ?>" placeholder="1234 5678 9012">
                            </div>
                        </div>
						
						<?php 
						$annual_income = '';
						if(isset($_POST['annual_income'])) {
							$annual_income = $_POST['annual_income'];
						}else if(!empty($taxdetail['annual_income'])){
							$annual_income = $taxdetail['annual_income'];
						}
						
						?>

                        <div class="form-group">
                            <label class="form-label">Annual Income Range</label>
                            <select class="form-input" name="annual_income" >
                                <option value="">Select range</option>
                                <option value="0-250000" <?php if($annual_income == '0-250000'){ echo 'selected'; } ?> >₹0 - ₹2,50,000</option>
                                <option value="250000-500000" <?php if($annual_income == '250000-500000'){ echo 'selected'; } ?> >₹2,50,000 - ₹5,00,000</option>
                                <option value="500000-1000000" <?php if($annual_income == '500000-1000000'){ echo 'selected'; } ?> >₹5,00,000 - ₹10,00,000</option>
                                <option value="1000000+" <?php if($annual_income == '1000000+'){ echo 'selected'; } ?> >₹10,00,000+</option>
                            </select>
                        </div>

                        <button type="submit" name="tax_submit" class="btn btn-primary w-full">
                            Save Tax Information
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

<?php include('includes/footer.php'); ?>


<link href="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.css" rel="stylesheet">
<script type="text/javascript" src="<?=SITEURL?>assets/plugins/ajax-pagination/simplePagination.js"></script>

<script>
var currentPage = 1;
$('#transactionList').html('<div class="text-center p-3"><h5 class="m-0">Loading..</h5></div>');
function submit_search(pageNum){
	perPage =  $("#selpagesize").val();
    var data = $('#search-form').serialize()+'&page='+pageNum+'&data_list='+perPage;
	$.ajax({
		type: 'GET',
		url : "<?php echo $m_link.'ajax.php'?>",
		data:data,
		dataType:'json',
		success: function(response){
			$('#transactionList').html(response.html);
			$('.search-total').html(response.total);
			$('#i-total-page').val(response.total_page);
			currentPage = response.page;
			rebindpagination();
		}
	});
}
function rebindpagination() {
	$("#list-paginations").pagination('destroy');
	$("#list-paginations").pagination({
		items: '<?php echo $total_trans['total']; ?>',
		//pages: $("#i-total-page").val(),
		displayedPages: 5,
		edges: 0,
		cssStyle: 'light-theme',
		hrefTextPrefix: 'javascript:;',
		currentPage: currentPage,
		onPageClick: function (pageNum, e) {
			submit_search(pageNum);
			currentPage = pageNum;
		}
	});
}

submit_search(1);
$('#search-form').submit(function(e){
	e.preventDefault();
});

</script>

  </body>


</html> 
	

    <script>
        // Global state
        let currentMode = 'user';
        let currentBalance = 84250;
        let transactions = [];

        // Initialize app
        document.addEventListener('DOMContentLoaded', function() {
            initParticles();
            updateBalance();
            updateMode();
        });

        // Particle system
        function initParticles() {
            const particlesContainer = document.getElementById('particles');
            
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
                
                particlesContainer.appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.remove();
                    }
                }, 8000);
            }

            setInterval(createParticle, 200);
        }

        // Mode switching
        function switchMode(mode) {
            currentMode = mode;
            
            // Update toggle buttons
            document.getElementById('userBtn').classList.toggle('active', mode === 'user');
            document.getElementById('modelBtn').classList.toggle('active', mode === 'model');
            
            // Update body class
            document.body.className = mode === 'model' ? 'model-mode' : '';
            
            // Switch to appropriate tab
            if (mode === 'model') {
                switchTab('withdraw');
            } else {
                switchTab('buy');
            }
            
            updateMode();
        }

        function updateMode() {
            // Update visibility of mode-specific elements
            const userElements = document.querySelectorAll('.user-only');
            const modelElements = document.querySelectorAll('.model-only');
            
            userElements.forEach(el => {
                el.style.display = currentMode === 'user' ? 'block' : 'none';
            });
            
            modelElements.forEach(el => {
                el.style.display = currentMode === 'model' ? 'block' : 'none';
            });
        }

        // Tab switching
        function switchTab(tabName) {
            // Remove active from all tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Add active to selected tab
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            document.getElementById(tabName).classList.add('active');
        }

        // Purchase function
        function purchase(coins, currency, amount) {
            const button = event.target;
            const originalText = button.innerHTML;
            
            // Show loading
            button.innerHTML = '<div class="spinner"></div> Processing...';
            button.classList.add('loading');
            
            setTimeout(() => {
                currentBalance += coins;
                updateBalance();
                
                // Add transaction
                addTransaction('purchase', `Purchased ${coins} coins`, `+${coins}`, `${currency === 'INR' ? '₹' : '$'}${amount}`);
                
                // Show success
                showNotification(`✅ Successfully purchased ${coins} coins!`, 'success');
                
                // Reset button
                button.innerHTML = originalText;
                button.classList.remove('loading');
            }, 2000);
        }

        // Update balance display
        function updateBalance() {
            document.getElementById('balance').textContent = currentBalance.toLocaleString();
        }

        // Add transaction to history
        function addTransaction(type, description, amount, price) {
            const transaction = {
                type,
                description,
                amount,
                price,
                date: new Date().toLocaleString()
            };
            
            transactions.unshift(transaction);
            updateTransactionHistory();
        }

        // Update transaction history display
        function updateTransactionHistory() {
            const container = document.getElementById('transactionList');
            const existingTransactions = container.querySelectorAll('.transaction-item');
            
            // Keep only the first 2 default transactions and add new ones
            if (transactions.length > 0) {
                const newTransaction = transactions[0];
                const transactionElement = document.createElement('div');
                transactionElement.className = 'transaction-item';
                transactionElement.innerHTML = `
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold">${newTransaction.description}</div>
                            <div class="text-sm text-gray-400">${newTransaction.date}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-green-400 font-semibold">${newTransaction.amount}</div>
                        <div class="text-sm text-gray-400">${newTransaction.price}</div>
                    </div>
                `;
                
                container.insertBefore(transactionElement, container.firstChild);
            }
        }

        // Form handlers
		
		function rejectWithdraw() {
            event.preventDefault();
            showNotification('You already sent request. Please wait for pending request', 'error');
        }
		
        function handleWithdraw(event) {
            event.preventDefault();
            showNotification('Withdrawal request submitted successfully!', 'success');
        }

        function handleBankDetails(event) {
            event.preventDefault();
            showNotification('Bank details saved successfully!', 'success');
        }

        function handleTaxInfo(event) {
            event.preventDefault();
            showNotification('Tax information saved successfully!', 'success');
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Performance optimizations
        const debounce = (func, wait) => {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        };

        // Lazy loading for images
        const lazyLoad = () => {
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        };

        // Initialize lazy loading
        document.addEventListener('DOMContentLoaded', lazyLoad);
    </script>
	
	 
