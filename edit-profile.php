<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$usern = $_SESSION["log_user"];
$userDetails = get_data('model_user', array('id' => $_SESSION["log_user_id"]), true);
$country_list = DB::query('select id,name,sortname from countries order by name asc');

if ($userDetails) {
} else {
  echo '<script>window.location.href="login.php"</script>';
}


$dob = date('d-m-Y');
if (!empty($userDetails["dob"]) && $userDetails["dob"] != '0000-00-00') {
  $dob = h_dateFormat($userDetails["dob"], 'd-m-Y');
}
$activeTab = 'basic';

$lang_list = modal_language_list();

$extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $_SESSION['log_user_unique_id']); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile - The Live Models</title>

  <?php include('includes/head.php'); ?>

  <link rel="stylesheet" href="<?= SITEURL ?>assets/css/dropzone.min.css" />

  <link rel='stylesheet' href='<?= SITEURL ?>assets/css/profile.css?v=<?= time() ?>' type='text/css' media='all' />
  <style>
    .dropzone {
      border: none !important;
      background-color: transparent !important;
    }

    .dropzone .dz-preview .dz-remove {
      color: #000;
    }
  </style>
</head>

<body class="enhanced5 edit-profilepage advt-page  socialwall-page">

  <?php include('includes/side-bar.php'); ?>
  <?php include('includes/profile_header_index.php'); ?>



  <!-- Buy Tokens Modal -->
  <div id="buy-tokens-modal" class="buy-tokens-modal hidden">
    <div class="buy-tokens-content">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold gradient-text">Buy TLM Tokens</h2>
        <button onclick="closeBuyTokensModal()" class="text-white/60 hover:text-white">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div class="mb-6">
        <div class="bg-white/5 rounded-lg p-4 mb-4">
          <div class="flex justify-between items-center">
            <span>Current Balance:</span>
            <div class="flex items-center">
              <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token">
              <span class="font-bold text-xl">2,500</span>
            </div>
          </div>
        </div>

        <div class="space-y-4">
          <div>
            <label class="form-label">Select Token Package</label>
            <div class="grid grid-cols-1 gap-3">
              <div class="radio-option">
                <input type="radio" id="package-100" name="token-package" value="100" onchange="updateTokenPackage(100, 10)">
                <label for="package-100">
                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-2">
                    100 TLM Tokens - $10.00
                  </div>
                </label>
              </div>
              <div class="radio-option">
                <input type="radio" id="package-500" name="token-package" value="500" onchange="updateTokenPackage(500, 45)" checked>
                <label for="package-500">
                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-2">
                    500 TLM Tokens - $45.00 (10% bonus)
                  </div>
                </label>
              </div>
              <div class="radio-option">
                <input type="radio" id="package-1000" name="token-package" value="1000" onchange="updateTokenPackage(1000, 80)">
                <label for="package-1000">
                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-2">
                    1,000 TLM Tokens - $80.00 (20% bonus)
                  </div>
                </label>
              </div>
              <div class="radio-option">
                <input type="radio" id="package-2500" name="token-package" value="2500" onchange="updateTokenPackage(2500, 175)">
                <label for="package-2500">
                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-2">
                    2,500 TLM Tokens - $175.00 (30% bonus)
                  </div>
                </label>
              </div>
            </div>
          </div>

          <div>
            <label class="form-label">Payment Method</label>
            <select class="form-select">
              <option value="">Select payment method</option>
              <option value="card">Credit/Debit Card</option>
              <option value="paypal">PayPal</option>
              <option value="crypto">Cryptocurrency</option>
            </select>
          </div>

          <div class="bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
            <div class="flex justify-between items-center">
              <span class="font-medium">Total:</span>
              <div class="flex items-center">
                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-2">
                <span id="selected-tokens" class="font-bold text-lg">500</span>
                <span class="text-sm text-white/60 ml-2">for</span>
                <span id="selected-price" class="font-bold text-lg ml-1">$45.00</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex space-x-4">
        <button class="btn-secondary flex-1" onclick="closeBuyTokensModal()">Cancel</button>
        <button class="btn-primary flex-1" onclick="processPurchase()">Purchase Tokens</button>
      </div>
    </div>
  </div>

  <!-- Withdraw Modal -->
  <div id="withdraw-modal" class="withdraw-modal hidden">
    <div class="withdraw-content">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold gradient-text">Withdraw TLM Tokens</h2>
        <button onclick="closeWithdrawModal()" class="text-white/60 hover:text-white">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div class="mb-6">
        <div class="bg-white/5 rounded-lg p-4 mb-4">
          <div class="flex justify-between items-center">
            <span>Available Balance:</span>
            <div class="flex items-center">
              <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token">
              <span class="font-bold text-xl"><?= number_format($userDetails['balance'],2) ?></span>
            </div>
          </div>
        </div>

        <div class="space-y-4">
          <div>
            <label class="form-label">Withdraw Amount (TLM Tokens)</label>
            <input type="number" id="withdraw-amount" class="form-input" placeholder="Enter amount" name="coins" value="100" data-max="<?= $userDetails['balance'] ?>" data-min="100" oninput="updateWithdrawUSD(this)">
            <p class="help-text">Minimum withdrawal: 100 TLM tokens</p>
			
			<span id="amount_error" class="text-danger" style="display: none;"> </span>
			
          </div>

          <div>
            <label class="form-label">USD Equivalent</label>
            <input type="text" id="withdraw-usd" class="form-input" readonly placeholder="$0.00" value="$<?php echo number_format((100*0.1), 2, '.', ''); ?>" >
          </div>

          <?php /*?><div>
            <label class="form-label">Withdrawal Method</label>
            <select class="form-select">
              <option value="">Select method</option>
              <option value="bank">Bank Transfer</option>
              <option value="paypal">PayPal</option>
              <option value="crypto">Cryptocurrency</option>
            </select>
          </div><?php */ ?>
        </div>
      </div>
	  
	  <?php $check_request = get_data('users_withdrow_request', array('user_id' => $userDetails["id"], 'status' => '0'), true); ?>
	  <?php if ($check_request) { echo '<div class="rejectmsg" style="color:red;">You already sent request. Please wait for pending request</div>'; } ?>
      <div class="flex space-x-4">
        <button class="btn-secondary flex-1" onclick="closeWithdrawModal()">Cancel</button>
        <button class="btn-withdraw flex-1" id="withdraw_btn" <?php if ($check_request) { ?> onclick="rejectWithdraw()" disabled <?php } else { ?>  onclick="processWithdrawal()"  <?php } ?> >Withdraw</button>
		
      </div>
    </div>
  </div>


  <main class="max-w-6xl mx-auto px-4 py-8">

    <div class="wallet-card mb-8 ">
      <div class="flex justify-between items-start mb-4 edit-first-header">
        <div>
          <h2 class="text-2xl font-bold mb-2">Creator Wallet</h2>
          <p class="text-white/80">Manage your earnings and withdrawals</p>
        </div>
        <button class="btn-withdraw" onclick="openWithdrawModal()">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Withdraw
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 edit-pro-pop">
        <div>
          <div class="flex items-center text-3xl font-bold mb-1">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token-large mr-2">
            <?php echo $userDetails['balance']; ?>
          </div>
          <div class="text-white/80">Available Tokens</div>
        </div>

        <?php

        $user_id = $userDetails['id'];

        $totalAmount = getUserTotalTransactionAmount($con, $user_id);
        ?>

        <div>
          <div class="flex items-center text-3xl font-bold mb-1">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token-large mr-2">

            <?php echo $totalAmount; ?>

          </div>
          <div class="text-white/80">Total Earned</div>
        </div>


        <div>
          <div class="text-3xl font-bold mb-1">4.9★</div>
          <div class="text-white/80">Rating</div>
        </div>
      </div>


    </div>

    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold gradient-text heading-font mb-4">Creator Dashboard</h1>
      <p class="text-white/70 text-lg">Manage your profile, services, and earnings</p>
    </div>

    <!-- Enhanced Tab Navigation -->
    <div class="flex justify-center mb-8">
      <div class="tab-navigation">
        <button class="tab-button active" onclick="switchTab('basic')" id="basic-tab">
          Basic Profile
        </button>

         <?php 

            $is_user_have_extra = isUserHaveExtraDetail($userDetails['unique_id'],$con);

            if($userDetails['as_a_model'] =='Yes' || $is_user_have_extra  ) {  ?>

          <button class="tab-button" onclick="switchTab('creator')" id="creator-tab">
            Creator Settings
          </button>

        <?php } else { ?>

            <button class="tab-button" onclick="CreateSetting()" id="creator-tab">
              Creator Settings
            </button>

          <?php } ?>

        <?php if($userDetails['as_a_model'] =='Yes') {  ?>

          <button class="tab-button" onclick="switchTab('services')" id="services-tab">
            Creator Services
            <span class="ml-2 text-xs bg-green-500 text-white px-2 py-1 rounded-full">✓ Active</span>
          </button>

        <?php }?>

        <button class="tab-button" onclick="switchTab('premium')" id="premium-tab">
          Premium & Privacy
          <span class="ml-2 text-xs bg-purple-500 text-white px-2 py-1 rounded-full">NEW</span>
        </button>
      </div>
    </div>

    <!-- Basic Profile Tab -->
    <div id="basic-content" class="tab-content active">

      <form method="post" id="basicProfileForm" action="act-edit-profile.php" enctype="multipart/form-data">

        <!-- Profile Completion -->
        <div class="profile-completion">
          <div class="completion-header">
            <div>
              <h3 class="text-lg font-bold text-blue-400 mb-2">Profile Completion</h3>
              <p class="text-sm text-white/70">Complete your profile to attract more clients</p>
            </div>
            <div class="completion-percentage">78%</div>
          </div>
          <div class="completion-bar">
            <div class="completion-fill"></div>
          </div>
          <p class="text-xs text-white/60">Add more social links and interests to reach 100%</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Profile Picture - Enhanced -->
          <div class="form-section lg:col-span-2 edit-profile-imageDiv">
            <h3 class="text-xl font-bold gradient-text mb-6">Profile Picture & Gallery</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 edit-profile-outer">
              <!-- Main Profile Picture -->
              <div class="text-center edit-profile-box1">
                <div class="profile-picture-container">
                  <?php if (!empty($userDetails['profile_pic'])) {
                    $prof_img = SITEURL . $userDetails['profile_pic'];
                  } else {
                    $prof_img = SITEURL . 'assets/images/model-gal-no-img.jpg';
                  } ?>
                  <img src="<?php echo $prof_img; ?>" id="preview_prof_img" alt="Profile" class="w-32 h-32 rounded-full border-4 border-purple-500">
                  <div class="profile-picture-overlay">
                    <label for="pic_img">
                      <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2-2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      </svg>
                    </label>
                  </div>

                  <div class="edit-close">
                    <a href="#">×</a>
                    <a href="#">
                      <!-- ✎  -->
                      <!-- <i class="far fa-edit"></i> -->

                    <img src="<?php echo SITEURL.'/assets/images/edt.svg'; ?>" alt="">

                    </a>


                  </div>

                  <button type="button" class="change-photo-btn">
                    <input type="file" name="pic_img" style="display:none" id="pic_img" class="vfb-text vfb-medium" accept=".jpg,.jpeg,.png" />
                    <label for="pic_img">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                      </svg>
                    </label>
                  </button>
                </div>
                <p class="text-white/80 text-sm mt-2 font-medium">Main Profile</p>
                <p class="text-white/60 text-xs">Hover to upload</p>
                <input type="hidden" name="use_id" value="<?php echo $_SESSION["log_user_id"]; ?>">
                <input type="hidden" name="unique_id" value="<?php echo $userDetails['unique_id']; ?>">
              </div>

              <!-- Additional Photos -->
              <div class="text-center p-3 edit-profile-box2 border-2 border-dashed border-white/30 
              rounded-lg flex items-center justify-start cursor-pointer hover:border-purple-500 
              transition-colors">
                <div class="gallery1 ">

                  <ul class="visualizacao sortable dropzone-previews">

                    <?php $modal_img_list = DB::query('select * from model_images where unique_model_id="' . $userDetails['unique_id'] . '" AND file_type = "Image" AND category = "Profile" Order by id DESC');
                    if (!empty($modal_img_list)) {
                      $i = 1;
                      foreach ($modal_img_list as $imgs) {
                        if (!empty($imgs['file'])) {
                    ?>
                          <li id="galblock<?php echo $i; ?>" class="w-auto h-auto">
                            <div>
                              <div class="dz-preview dz-file-preview">
                                <img src="<?php echo SITEURL . 'uploads/profile_pic/' . $imgs['file']; ?>" data-dz-thumbnail />
                                <input type='hidden' name='hiddenmedia[]' class='hiddenmedia' value="<?php echo $imgs['file']; ?>" id="<?php echo $i; ?>">
                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                <!-- <div class="dz-success-mark"><span>✔</span></div> -->
                                <!-- <div class="dz-error-mark"><span>✘</span></div> -->
                                <div class="dz-error-mark"><a data-id="<?php echo $i; ?>" img_name="<?php echo $imgs['file']; ?>" class="removeinserted">×</a></div>
                                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                              </div>
                            </div>
                          </li>
                    <?php }
                        $i++;
                      }
                    }

                    ?>

                    <div id="temporary-preview-container" style="display: none;"></div>

                    <div id="modalimage_gallery" class="text-center dropzone"></div>

                  </ul>

                  <div class="preview" style="display:none;">
                    <li>
                      <div>


                        <div class="dz-preview dz-file-preview">
                          <img data-dz-thumbnail />
                          <div class="dz-details">
                            <!-- your existing details -->
                          </div>
                          <button type="button" class="custom-delete-btn" onclick="handleCustomDelete(this)">×</button>
                        </div>
                      </div>
                    </li>
                  </div>
                </div>
                <!-- Custom Preview Container -->
                <div id="image-preview-container">
                  <!-- Previews will be moved here -->
                </div>
                <?php /*<input type="file" name="gallery_photo_1" id="gallery_photo_1" class="gallery_photo"  accept=".jpg,.jpeg,.png" /> */ ?>
                <!-- <p class="text-white/80 text-sm mt-2 font-medium">Gallery Photo</p> -->
              </div>

              <?php /*?><div class="text-center">
            <div class="gallery2 w-32 h-32 mx-auto border-2 border-dashed border-white/30 rounded-lg flex items-center justify-center cursor-pointer hover:border-purple-500 transition-colors">
              <?php if(!empty($userDetails['gallery_photo_2'])){ ?>
			  <img src="<?php echo SITEURL.$userDetails['gallery_photo_2']; ?>" id="" alt="Profile" class="w-32 h-32 square-full border-4 border-purple-500">
			  <?php }else{ ?>
			  <div class="text-center">
                <svg class="w-8 h-8 mx-auto text-white/50 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <p class="text-xs text-white/60">Add Photo</p>
              </div>
			  <?php } ?>
            </div>
			<input type="file" name="gallery_photo_2" id="gallery_photo_2" class="gallery_photo"  accept=".jpg,.jpeg,.png" />
            <p class="text-white/80 text-sm mt-2 font-medium">Gallery Photo 2</p>
          </div><?php */ ?>
            </div>
            <p class="text-white/60 text-sm mt-4 text-center">Upload high-quality photos to showcase your personality and style</p>
          </div>

          <!-- Personal Information - Enhanced -->
          <div class="form-section">
            <h3 class="text-xl font-bold gradient-text mb-6">Personal Information</h3>
            <div class="space-y-4">
              <div>
                <label class="form-label">Display Name *</label>
                <input type="text" class="form-input uname" name="name" id="uname" placeholder="Enter your display name" value="<?php echo $userDetails['name']; ?>" required>
                <p class="help-text">This is how others will see you on the platform</p>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="form-label">Date of Birth *</label>
                  <input type="date" id="dob-input" class="form-input dob" name="dob" value="<?= $userDetails['dob'] ?>" onchange="calculateAge()" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                </div>
                <div>
                  <label class="form-label">Age *</label>
                  <input type="number" id="age-display" class="form-input age" name="age" value="<?php echo $userDetails['age']; ?>" readonly required>
                  <p class="help-text">Auto-calculated</p>
                </div>
              </div>
              <div>
                <label class="form-label">Gender *</label>
                <div class="radio-group">
                  <div class="radio-option">
                    <input type="radio" name="gender" id="m" value="Male" <?php if ($userDetails['gender'] == 'Male' || $userDetails['gender'] == 'male' || empty($userDetails['gender'])) echo 'checked';  ?>>
                    <label for="m">Male</label>
                  </div>
                  <div class="radio-option">
                    <input type="radio" name="gender" id="f" value="Female" <?php if ($userDetails['gender'] == 'Female' || $userDetails['gender'] == 'female') echo 'checked';  ?>>
                    <label for="f">Female</label>
                  </div>
                  <div class="radio-option">
                    <input type="radio" name="gender" id="t" value="Transgender" <?php if ($userDetails['gender'] == 'Transgender' || $userDetails['gender'] == 'other') echo 'checked';  ?>>
                    <label for="t">Transgender</label>
                  </div>
                </div>
              </div>
              <div>
                <label class="form-label">Relationship Status</label>
                <select class="form-select relationship" name="relationship">
                  <option value="">Select status</option>
                  <option value="Single" <?php if ($userDetails['relationship'] == 'Single' || empty($userDetails['relationship'])) echo 'selected';  ?>>Single</option>
                  <option value="Dating" <?php if ($userDetails['relationship'] == 'Dating') echo 'selected';  ?>>Dating</option>
                  <option value="In a Relationship" <?php if ($userDetails['relationship'] == 'In a Relationship') echo 'selected';  ?>>In a Relationship</option>
                  <option value="Married" <?php if ($userDetails['relationship'] == 'Married') echo 'selected';  ?>>Married</option>
                  <option value="It's Complicated" <?php if ($userDetails['relationship'] == "It's Complicated") echo 'selected';  ?>>It's Complicated</option>
                  <option value="Prefer not to say" <?php if ($userDetails['relationship'] == 'Prefer not to say') echo 'selected';  ?>>Prefer not to say</option>
                </select>
              </div>
              <div>
                <label class="form-label">Bio</label>
                <textarea name="user_bio" class="form-input user_bio" rows="4" placeholder="Tell us about yourself, your interests, and what makes you unique..."><?php echo $userDetails['user_bio']; ?></textarea>
                <p class="help-text">A compelling bio increases your profile views by 60%</p>
              </div>
              <div>
                <label class="form-label">Services</label>
                <select name="services" class="form-control select2">
                  <option value="" class="bg-gray-900">Select Your Services</option>
                  <option value="Chat Only" <?php if ($userDetails['services'] == 'Chat Only') echo 'selected'; ?> class="bg-gray-900">💬 Chat Only</option>
                  <option value="Chat & Watch" <?php if ($userDetails['services'] == 'Chat & Watch') echo 'selected'; ?> class="bg-gray-900">💬📹 Chat & Watch</option>
                  <option value="Chat, Watch & Meet" <?php if ($userDetails['services'] == 'Chat, Watch & Meet') echo 'selected'; ?> class="bg-gray-900">💬📹🤝 Chat, Watch & Meet</option>
                  <option value="Premium Experience" <?php if ($userDetails['services'] == 'Premium Experience') echo 'selected'; ?> class="bg-gray-900">👑 Premium Experience</option>
                </select>

              </div>
            </div>
          </div>

          <!-- Location - Enhanced -->
          <div class="form-section">
            <h3 class="text-xl font-bold gradient-text mb-6">Location & Availability</h3>
            <div class="space-y-4">
              <div>
                <label class="form-label">Country *</label>
                <select name="country" id="i-hs-country" onChange="select_hs_country('')" class="form-control"  required>
                  <option value="">Select your country</option>
                  <?php
                  foreach ($country_list as $val) {
                  ?>
                    <option value="<?= $val['id'] ?>" <?= $userDetails['country'] == $val['id'] ? 'selected' : '' ?>><?= $val['name'] ?></option>
                  <?php
                  }
                  ?>
                </select>

              </div>
              <div>
                <label class="form-label">State/Province *</label> 
                <select name="state" id="i-hs-state" onChange="select_hs_state('')" class="form-select"  required></select>
              </div>
              <div>
                <label class="form-label">City *</label>
                <select name="city" id="i-hs-city" class="form-select"  required></select>
              </div>
              <div>
                <label class="form-label">Willing to Travel</label>
                <div class="radio-group">
                  <div class="radio-option">
                    <input type="radio" id="travel-local" name="travel_preference" value="Local only" <?php if ($userDetails['travel_preference'] == 'Local only' || empty($userDetails['travel_preference'])) echo 'checked';  ?>>
                    <label for="travel-local">Local only</label>
                  </div>
                  <div class="radio-option">
                    <input type="radio" id="travel-domestic" name="travel_preference" value="Domestic travel" <?php if ($userDetails['travel_preference'] == 'Domestic travel') echo 'checked';  ?>>
                    <label for="travel-domestic">Domestic travel</label>
                  </div>
                  <div class="radio-option">
                    <input type="radio" id="travel-international" name="travel_preference" value="International travel" <?php if ($userDetails['travel_preference'] == 'International travel') echo 'checked';  ?>>
                    <label for="travel-international">International travel</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		  
		  <!-- Physical Attributes -->
		<div class="interests-section lg:col-span-2">
            <h3 class="text-xl font-bold text-purple-400 mb-4">👤 Physical Attributes</h3>
            <div class="private-section mb-6"> 
              <p class="text-white/70 text-sm mb-4">🔒 Private Matching Information</p>
              <p class="text-white/70 text-sm mb-4">This information is kept private and used only for matching preferences. It will not be displayed publicly.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div>
                <label class="form-label">Height</label>
                <div class="unit-toggle unit-toggleh" id="unit-toggleh">
                  <div class="unit-option <?php if (!empty($extra_details) && $extra_details['height_type'] == 'ft') {
                                            echo 'active';
                                          } else if (empty($extra_details['height_type'])) {
                                            echo 'active';
                                          } ?> ft-option" onclick="toggleHeightUnit('ft',this)">ft/in</div>
                  <div class="unit-option <?php if (!empty($extra_details) && $extra_details['height_type'] == 'cm') {
                                            echo 'active';
                                          } ?> cm-option" onclick="toggleHeightUnit('cm',this)">cm</div>
                </div>
                <div id="height-ft" class="grid grid-cols-2 gap-2 <?php if ($extra_details['height_type'] == 'cm') echo 'hidden'; ?>">
                  <?php
                  $feet = '';
                  $inches = '';
                  if ($extra_details['height_type'] == 'ft' || empty($extra_details['height_type'])) {
                    $exp_hght = explode('.', $extra_details['height']);
                    $feet = $exp_hght[0];
                    $inches = $exp_hght[1];
                  } ?>
                  <select class="form-select" name="feet">
                    <option value="">Feet</option>
                    <option value="4" <?php if ($feet == 4) {
                                        echo 'selected';
                                      } ?>>4'</option>
                    <option value="5" <?php if ($feet == 5) {
                                        echo 'selected';
                                      } else if (empty($feet)) {
                                        echo 'selected';
                                      } ?>>5'</option>
                    <option value="6" <?php if ($feet == 6) {
                                        echo 'selected';
                                      } ?>>6'</option>
                  </select>
                  <select class="form-select" name="inches">
                    <option value="">Inches</option>
                    <option value="0" <?php if ($inches == 0) {
                                        echo 'selected';
                                      } ?>>0"</option>
                    <option value="1" <?php if ($inches == 1) {
                                        echo 'selected';
                                      } ?>>1"</option>
                    <option value="2" <?php if ($inches == 2) {
                                        echo 'selected';
                                      } ?>>2"</option>
                    <option value="3" <?php if ($inches == 3) {
                                        echo 'selected';
                                      } ?>>3"</option>
                    <option value="4" <?php if ($inches == 4) {
                                        echo 'selected';
                                      } ?>>4"</option>
                    <option value="5" <?php if ($inches == 5) {
                                        echo 'selected';
                                      } ?>>5"</option>
                    <option value="6" <?php if ($inches == 6) {
                                        echo 'selected';
                                      } else if (empty($inches)) {
                                        echo 'selected';
                                      } ?>>6"</option>
                    <option value="7" <?php if ($inches == 7) {
                                        echo 'selected';
                                      } ?>>7"</option>
                    <option value="8" <?php if ($inches == 8) {
                                        echo 'selected';
                                      } ?>>8"</option>
                    <option value="9" <?php if ($inches == 9) {
                                        echo 'selected';
                                      } ?>>9"</option>
                    <option value="10" <?php if ($inches == 10) {
                                          echo 'selected';
                                        } ?>>10"</option>
                    <option value="11" <?php if ($inches == 11) {
                                          echo 'selected';
                                        } ?>>11"</option>
                  </select>
                </div>
                <div id="height-cm" class="<?php if ($extra_details['height_type'] == 'ft' || empty($extra_details['height_type'])) echo 'hidden'; ?>">
                  <input type="number" name="height_cm" class="form-input" placeholder="Height in cm" min="140" max="200" value="<?php if ($extra_details['height_type'] == 'cm') {
                                                                                                                                    echo $extra_details['height'];
                                                                                                                                  } ?>">
                </div>
                <input type="hidden" name="height_type" id="height_type" value="<?php if (empty($extra_details['height_type'])) {
                                                                                  echo 'ft';
                                                                                } else {
                                                                                  echo $extra_details['height_type'];
                                                                                } ?>">
              </div>
              <div>
                <label class="form-label">Weight</label>
                <div class="unit-toggle unit-togglew" id="unit-togglew">
                  <div class="unit-option <?php if (!empty($extra_details) && $extra_details['weight_type'] == 'lbs') {
                                            echo 'active';
                                          } else if (empty($extra_details['weight_type'])) {
                                            echo 'active';
                                          } ?> lbs-option" onclick="toggleWeightUnit('lbs')">lbs</div>
                  <div class="unit-option <?php if (!empty($extra_details) && $extra_details['weight_type'] == 'kg') {
                                            echo 'active';
                                          } ?> kg-option" onclick="toggleWeightUnit('kg')">kg</div>
                </div>
                <input type="number" id="weight-input" name="weight" class="form-input" placeholder="Weight" min="80" max="300" value="<?php echo $extra_details['weight']; ?>">
                <p class="help-text">Optional - helps with matching</p>
                <input type="hidden" name="weight_type" id="weight_type" value="<?php if (empty($extra_details['weight_type'])) {
                                                                                  echo 'lbs';
                                                                                } else {
                                                                                  echo $extra_details['weight_type'];
                                                                                } ?>">
              </div>
              <div>
                <label class="form-label">Hair Color</label>
                <select class="form-select" name="hair_color">
                  <option value="">Select hair color</option>
                  <option value="Blonde" <?php if ($extra_details['hair_color'] == 'Blonde') {
                                            echo 'selected';
                                          } ?>>Blonde</option>
                  <option value="Brunette" <?php if ($extra_details['hair_color'] == 'Brunette') {
                                              echo 'selected';
                                            } ?>>Brunette</option>
                  <option value="Black" <?php if ($extra_details['hair_color'] == 'Black') {
                                          echo 'selected';
                                        } ?>>Black</option>
                  <option value="Red" <?php if ($extra_details['hair_color'] == 'Red') {
                                        echo 'selected';
                                      } ?>>Red</option>
                  <option value="Auburn" <?php if ($extra_details['hair_color'] == 'Auburn') {
                                            echo 'selected';
                                          } ?>>Auburn</option>
                  <option value="Gray" <?php if ($extra_details['hair_color'] == 'Gray') {
                                          echo 'selected';
                                        } ?>>Gray</option>
                  <option value="Other" <?php if ($extra_details['hair_color'] == 'Other') {
                                          echo 'selected';
                                        } ?>>Other</option>
                </select>
              </div>
              <div>
                <label class="form-label">Eye Color</label>
                <select class="form-select" name="eye_color">
                  <option value="">Select eye color</option>
                  <option value="Brown" <?php if ($extra_details['eye_color'] == 'Brown') {
                                          echo 'selected';
                                        } ?>>Brown</option>
                  <option value="Blue" <?php if ($extra_details['eye_color'] == 'Blue') {
                                          echo 'selected';
                                        } ?>>Blue</option>
                  <option value="Green" <?php if ($extra_details['eye_color'] == 'Green') {
                                          echo 'selected';
                                        } ?>>Green</option>
                  <option value="Hazel" <?php if ($extra_details['eye_color'] == 'Hazel') {
                                          echo 'selected';
                                        } ?>>Hazel</option>
                  <option value="Gray" <?php if ($extra_details['eye_color'] == 'Gray') {
                                          echo 'selected';
                                        } ?>>Gray</option>
                  <option value="Amber" <?php if ($extra_details['eye_color'] == 'Amber') {
                                          echo 'selected';
                                        } ?>>Amber</option>
                </select>
              </div>
              <div>
                <label class="form-label">Ethnicity</label>
                <input type="text" class="form-input" name="ethnicity" placeholder="Enter your ethnicity" value="<?php echo $extra_details['ethnicity']; ?>">
              </div>
              <div>
                <label class="form-label">Body Type</label>
                <select class="form-select" name="body_type">
                  <option value="">Select body type</option>
                  <option value="Petite" <?php if ($extra_details['body_type'] == 'Petite') {
                                            echo 'selected';
                                          } ?>>Petite</option>
                  <option value="Slim" <?php if ($extra_details['body_type'] == 'Slim') {
                                          echo 'selected';
                                        } ?>>Slim</option>
                  <option value="Athletic" <?php if ($extra_details['body_type'] == 'Athletic') {
                                              echo 'selected';
                                            } ?>>Athletic</option>
                  <option value="Average" <?php if ($extra_details['body_type'] == 'Average') {
                                            echo 'selected';
                                          } ?>>Average</option>
                  <option value="Curvy" <?php if ($extra_details['body_type'] == 'Curvy') {
                                          echo 'selected';
                                        } ?>>Curvy</option>
                  <option value="Full Figured" <?php if ($extra_details['body_type'] == 'Full Figured') {
                                                  echo 'selected';
                                                } ?>>Full Figured</option>
                </select>
              </div>
              <div>
                <label class="form-label">Dress Size</label>
                <select class="form-select" name="dress_size">
                  <option value="">Select dress size</option>
                  <option value="XS (0-2)" <?php if ($extra_details['dress_size'] == 'XS (0-2)') {
                                              echo 'selected';
                                            } ?>>XS (0-2)</option>
                  <option value="S (4-6)" <?php if ($extra_details['dress_size'] == 'S (4-6)') {
                                            echo 'selected';
                                          } ?>>S (4-6)</option>
                  <option value="M (8-10)" <?php if ($extra_details['dress_size'] == 'M (8-10)') {
                                              echo 'selected';
                                            } ?>>M (8-10)</option>
                  <option value="L (12-14)" <?php if ($extra_details['dress_size'] == 'L (12-14)') {
                                              echo 'selected';
                                            } ?>>L (12-14)</option>
                  <option value="XL (16-18)" <?php if ($extra_details['dress_size'] == 'XL (16-18)') {
                                                echo 'selected';
                                              } ?>>XL (16-18)</option>
                  <option value="XXL (20+)" <?php if ($extra_details['dress_size'] == 'XXL (20+)') {
                                              echo 'selected';
                                            } ?>>XXL (20+)</option>
                </select>
              </div>
            </div>

            <!-- Private measurements section -->
            <div class="mt-6 p-4 bg-black/20 rounded-lg">
              <h4 class="font-bold mb-4 text-yellow-400">🔐 Confidential Measurements</h4>
              <p class="text-sm text-white/60 mb-4">These measurements are encrypted and only used for professional matching. They are never displayed publicly.</p>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label class="form-label text-sm">Bust (inches)</label>
                  <input type="number" class="form-input" name="bust_size" placeholder="e.g., 34" min="28" max="50" value="<?php echo $extra_details['bust_size']; ?>">
                </div>
                <div>
                  <label class="form-label text-sm">Waist (inches)</label>
                  <input type="number" class="form-input" name="waist_size" placeholder="e.g., 26" min="20" max="40" value="<?php echo $extra_details['waist_size']; ?>">
                </div>
                <div>
                  <label class="form-label text-sm">Cup Size</label>
                  <select class="form-select" name="cup_size">
                    <option value="">Select</option>
                    <option value="AA" <?php if ($extra_details['cup_size'] == 'AA') {
                                          echo 'selected';
                                        } ?>>AA</option>
                    <option value="A" <?php if ($extra_details['cup_size'] == 'A') {
                                        echo 'selected';
                                      } ?>>A</option>
                    <option value="B" <?php if ($extra_details['cup_size'] == 'B') {
                                        echo 'selected';
                                      } ?>>B</option>
                    <option value="C" <?php if ($extra_details['cup_size'] == 'C') {
                                        echo 'selected';
                                      } ?>>C</option>
                    <option value="D" <?php if ($extra_details['cup_size'] == 'D') {
                                        echo 'selected';
                                      } ?>>D</option>
                    <option value="DD" <?php if ($extra_details['cup_size'] == 'DD') {
                                          echo 'selected';
                                        } ?>>DD</option>
                    <option value="DDD" <?php if ($extra_details['cup_size'] == 'DDD') {
                                          echo 'selected';
                                        } ?>>DDD</option>
                    <option value="F" <?php if ($extra_details['cup_size'] == 'F') {
                                        echo 'selected';
                                      } ?>>F</option>
                    <option value="G" <?php if ($extra_details['cup_size'] == 'G') {
                                        echo 'selected';
                                      } ?>>G</option>
                  </select>
                </div>
              </div>
            </div>
        </div>
		  
		  
		  
          <?php $hobbies = $userDetails['hobbies'];
          $hobbies = json_decode($hobbies);  ?>
          <!-- Interests & Hobbies -->
          <div class="interests-section lg:col-span-2">
            <h3 class="text-xl font-bold text-purple-400 mb-4">Interests & Hobbies</h3>
            <p class="text-white/70 text-sm mb-4">Select your interests to help clients find you based on shared hobbies</p>
            <div class="flex flex-wrap gap-2">
              <span class="interest-tag <?php if ((!empty($hobbies) && in_array('Travel', $hobbies)) || empty($hobbies)) echo 'selected';  ?>" onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Travel" <?php if ((!empty($hobbies) && in_array('Travel', $hobbies)) || empty($hobbies)) echo 'checked';  ?>>Travel
              </span>
              <span class="interest-tag <?php if ((!empty($hobbies) && in_array('Dancing', $hobbies)) || empty($hobbies)) echo 'selected';  ?>" onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Dancing" <?php if ((!empty($hobbies) && in_array('Dancing', $hobbies)) || empty($hobbies)) echo 'checked';  ?>>Dancing
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Photography', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Photography" <?php if (!empty($hobbies) && in_array('Photography', $hobbies)) echo 'checked';  ?>>Photography
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Yoga', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Yoga" <?php if (!empty($hobbies) && in_array('Yoga', $hobbies)) echo 'checked';  ?>>Yoga
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Cooking', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Cooking" <?php if (!empty($hobbies) && in_array('Cooking', $hobbies)) echo 'checked';  ?>>Cooking
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Music', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Music" <?php if (!empty($hobbies) && in_array('Music', $hobbies)) echo 'checked';  ?>>Music
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Art', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Art" <?php if (!empty($hobbies) && in_array('Art', $hobbies)) echo 'checked';  ?>>Art
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Fitness', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Fitness" <?php if (!empty($hobbies) && in_array('Fitness', $hobbies)) echo 'checked';  ?>>Fitness
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Reading', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Reading" <?php if (!empty($hobbies) && in_array('Reading', $hobbies)) echo 'checked';  ?>>Reading
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Movies', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Movies" <?php if (!empty($hobbies) && in_array('Movies', $hobbies)) echo 'checked';  ?>>Movies
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Gaming', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Gaming" <?php if (!empty($hobbies) && in_array('Gaming', $hobbies)) echo 'checked';  ?>>Gaming
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Fashion', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Fashion" <?php if (!empty($hobbies) && in_array('Fashion', $hobbies)) echo 'checked';  ?>>Fashion
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Wine Tasting', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Wine Tasting" <?php if (!empty($hobbies) && in_array('Wine Tasting', $hobbies)) echo 'checked';  ?>>Wine Tasting
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Hiking', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Hiking" <?php if (!empty($hobbies) && in_array('Hiking', $hobbies)) echo 'checked';  ?>>Hiking
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Beach', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Beach" <?php if (!empty($hobbies) && in_array('Beach', $hobbies)) echo 'checked';  ?>>Beach
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Nightlife', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Nightlife" <?php if (!empty($hobbies) && in_array('Nightlife', $hobbies)) echo 'checked';  ?>>Nightlife
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Sports', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Sports" <?php if (!empty($hobbies) && in_array('Sports', $hobbies)) echo 'checked';  ?>>Sports
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Adventure', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Adventure" <?php if (!empty($hobbies) && in_array('Adventure', $hobbies)) echo 'checked';  ?>>Adventure
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Meditation', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Meditation" <?php if (!empty($hobbies) && in_array('Meditation', $hobbies)) echo 'checked';  ?>>Meditation
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Theater', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Theater" <?php if (!empty($hobbies) && in_array('Theater', $hobbies)) echo 'checked';  ?>>Theater
              </span>
              <span class="interest-tag <?php if (!empty($hobbies) && in_array('Shopping', $hobbies)) echo 'selected';  ?> " onclick="toggleInterest(this)">
                <input type="checkbox" name="hobbies[]" class="hobbies_interest" value="Shopping" <?php if (!empty($hobbies) && in_array('Shopping', $hobbies)) echo 'checked';  ?>>Shopping
              </span>
            </div>

            <div id="hobbies-container" class=" edit-pro-hob">

              <?php $additional_hobbies = $userDetails['additional_hobbies'];
              if (!empty($additional_hobbies)) {
                $additional_hobbies = json_decode($additional_hobbies);
                foreach ($additional_hobbies as $hbb) { ?>
                  <div class="hobbies-item">
                    <input type="text" name="additional_hobbies[]" class="add-hobbies-input social-url-input" value="<?php echo $hbb; ?>">
                    <button class="btn-remove-hb btn-remove-social" onclick="removeHobbies(this)">×</button>
                  </div>
              <?php
                }
              }
              ?>


            </div>
            <button type="button" class="btn-secondary mt-3 add-intrst" onclick="addHobbies()">+ Add Interests & Hobbies</button>

          </div>
          <?php $languages = $userDetails['languages'];  ?>
          <!-- Languages -->
          <div class="languages-section lg:col-span-2">
            <h3 class="text-xl font-bold text-green-400 mb-4">Languages</h3>
            <p class="text-white/70 text-sm mb-4">Add languages you speak to connect with international clients</p>
            <div id="languages-container">
              <?php if (empty($languages)) {
                $lang_count = 1; ?>
                <div class="language-item">
                  <select class="language-select" name="modal_lang[]">
                    <option value="">Select language</option>
                    <?php foreach ($lang_list as $val) { ?>
                      <option value="<?= $val ?>" <?= 'English' == $val ? 'selected' : '' ?>><?= $val ?></option>
                    <?php } ?>

                  </select>
                  <select class="proficiency-select" name="proficiency[]">
                    <option value="">Proficiency</option>
                    <option value="Native" selected>Native</option>
                    <option value="Fluent">Fluent</option>
                    <option value="Conversational">Conversational</option>
                    <option value="Basic">Basic</option>
                  </select>
                  <button class="btn-remove-social" onclick="removeLanguage(this)">×</button>
                </div>
                <?php } else {
                $languages = json_decode($languages);
                foreach ($languages as $lang) {
                ?>
                  <div class="language-item">
                    <select class="language-select" name="modal_lang[]">
                      <option value="">Select language</option>
                      <?php foreach ($lang_list as $val) { ?>
                        <option value="<?= $val ?>" <?= $lang->lan == $val ? 'selected' : '' ?>><?= $val ?></option>
                      <?php } ?>

                    </select>
                    <select class="proficiency-select" name="proficiency[]">
                      <option value="">Proficiency</option>
                      <option value="Native" <?= $lang->prof == 'Native' ? 'selected' : '' ?>>Native</option>
                      <option value="Fluent" <?= $lang->prof == 'Fluent' ? 'selected' : '' ?>>Fluent</option>
                      <option value="Conversational" <?= $lang->prof == 'Conversational' ? 'selected' : '' ?>>Conversational</option>
                      <option value="Basic" <?= $lang->prof == 'Basic' ? 'selected' : '' ?>>Basic</option>
                    </select>
                    <button class="btn-remove-social" onclick="removeLanguage(this)">×</button>
                  </div>

              <?php }
                $lang_count = count($languages);
              } ?>
            </div>
            <button type="button" class="btn-secondary mt-3" onclick="addLanguage()">+ Add Language</button>
            <?php /*<input type="text" name="lang_count" class="lang_count" id="lang_count" value="<?php echo $lang_count; ?>"> */ ?>
          </div>

          <?php
          $social_list = DB::query('select * from model_social_link where unique_model_id="' . $userDetails['unique_id'] . '"  Order by id ASC');
          ?>

          <!-- Social Links - Enhanced -->
          <div class="form-section lg:col-span-2" <?php if ($userDetails['as_a_model'] != 'Yes') echo 'style="display:none;"'; ?> >
            <h3 class="text-xl font-bold gradient-text mb-6">Social Links & Platforms</h3>
            <p class="text-white/70 text-sm mb-4">Connect your social media accounts and specify if they're free to view or paid content</p>
            <div id="social-links-container">

              <?php if (empty($social_list)) { ?>

                <!-- Instagram -->
                <div class="social-link-item  instagram">
                  <div class="social-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                  </div>
                  <div class="social-content">
                    <input type="text" name="platform[]" class="social-platform-input" value="Instagram" readonly>
                    <input type="url" name="URL[]" class="social-url-input" placeholder="https://instagram.com/username" value="">
                    <input type="hidden" name="socialid[]" value="">
                  </div>
                  <div class="social-controls">
                    <div class="access-toggle">
                      <div class="access-option free active" onclick="toggleAccess(this, 'free','insta')">Free</div>
                      <div class="access-option paid" onclick="toggleAccess(this, 'paid','insta')">Paid</div>
                      <input type="hidden" name="status[]" class="insta" value="free">
                      <input type="text" class="paid_token social-platform-input hidden" value="" name="paid_token[]" placeholder="Enter token amount">
                    </div>
                    <label class="toggle-switch">
                      <input type="checkbox" name="public[]" value="yes" checked>
                      <span class="toggle-slider"></span>
                    </label>
                    <span class="text-xs text-white/60">Public</span>
                  </div>
                </div>

                <!-- Twitter -->
                <div class="social-link-item twitter">
                  <div class="social-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                    </svg>
                  </div>
                  <div class="social-content">
                    <input type="text" name="platform[]" class="social-platform-input" value="Twitter" readonly>
                    <input type="url" name="URL[]" class="social-url-input" placeholder="https://twitter.com/username" value="">
                    <input type="hidden" name="socialid[]" value="">
                  </div>
                  <div class="social-controls">
                    <div class="access-toggle">
                      <div class="access-option free active" onclick="toggleAccess(this, 'free','tw')">Free</div>
                      <div class="access-option paid" onclick="toggleAccess(this, 'paid','tw')">Paid</div>
                      <input type="hidden" name="status[]" class="tw" value="free">
                      <input type="text" class="paid_token social-platform-input hidden" value="" name="paid_token[]" placeholder="Enter token amount">
                    </div>
                    <label class="toggle-switch">
                      <input type="checkbox" name="public[]" value="yes" checked>
                      <span class="toggle-slider"></span>
                    </label>
                    <span class="text-xs text-white/60">Public</span>
                  </div>
                </div>

                <!-- TikTok -->
                <div class="social-link-item tiktok">
                  <div class="social-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-.88-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
                    </svg>
                  </div>
                  <div class="social-content">
                    <input type="text" name="platform[]" class="social-platform-input" value="TikTok" readonly>
                    <input type="url" name="URL[]" class="social-url-input" placeholder="https://tiktok.com/@username" value="">
                    <input type="hidden" name="socialid[]" value="">
                  </div>
                  <div class="social-controls">
                    <div class="access-toggle">
                      <div class="access-option free active" onclick="toggleAccess(this, 'free','tiktk')">Free</div>
                      <div class="access-option paid" onclick="toggleAccess(this, 'paid','tiktk')">Paid</div>
                      <input type="hidden" name="status[]" class="tiktk" value="free">
                      <input type="text" class="paid_token social-platform-input hidden" value="" name="paid_token[]" placeholder="Enter token amount">
                    </div>
                    <label class="toggle-switch">
                      <input type="checkbox" name="public[]" value="yes" checked>
                      <span class="toggle-slider"></span>
                    </label>
                    <span class="text-xs text-white/60">Public</span>
                  </div>
                </div>

                <!-- OnlyFans -->
                <div class="social-link-item fans">
                  <div class="social-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                  </div>
                  <div class="social-content">
                    <input type="text" name="platform[]" class="social-platform-input" value="OnlyFans" readonly>
                    <input type="url" name="URL[]" class="social-url-input" placeholder="https://onlyfans.com/username" value="">
                    <input type="hidden" name="socialid[]" value="">
                  </div>
                  <div class="social-controls">
                    <div class="access-toggle">
                      <div class="access-option free" onclick="toggleAccess(this, 'free','onf')">Free</div>
                      <div class="access-option paid active" onclick="toggleAccess(this, 'paid','onf')">Paid</div>
                      <input type="hidden" name="status[]" class="onf" value="paid">
                      <input type="text" class="paid_token social-platform-input hidden" value="" name="paid_token[]" placeholder="Enter token amount">
                    </div>
                    <label class="toggle-switch">
                      <input type="checkbox" name="public[]" value="yes">
                      <span class="toggle-slider"></span>
                    </label>
                    <span class="text-xs text-white/60">Public</span>
                  </div>
                </div>

                <!-- Snapchat -->
                <div class="social-link-item snapchat">
                  <div class="social-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.748-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-12C24.007 5.367 18.641.001 12.017.001z" />
                    </svg>
                  </div>
                  <div class="social-content">
                    <input type="text" name="platform[]" class="social-platform-input" value="Snapchat" readonly>
                    <input type="text" name="URL[]" class="social-url-input" placeholder="https://www.snapchat.com/username" value="">
                    <input type="hidden" name="socialid[]" value="">
                  </div>
                  <div class="social-controls">
                    <div class="access-toggle">
                      <div class="access-option free active" onclick="toggleAccess(this, 'free','snap')">Free</div>
                      <div class="access-option paid" onclick="toggleAccess(this, 'paid','snap')">Paid</div>
                      <input type="hidden" name="status[]" class="snap" value="free">
                      <input type="text" class="paid_token social-platform-input hidden" value="" name="paid_token[]" placeholder="Enter token amount">
                    </div>
                    <label class="toggle-switch">
                      <input type="checkbox" name="public[]" value="yes">
                      <span class="toggle-slider"></span>
                    </label>
                    <span class="text-xs text-white/60">Public</span>
                  </div>
                </div>

                <?php } else {
                $cnt = 1;
                foreach ($social_list as $sc) {
                  if ($sc['platform'] == 'Instagram') {
                ?>
                    <!-- Instagram -->
                    <div class="social-link-item  instagram">
                      <div class="social-icon">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                      </div>
                      <div class="social-content">
                        <input type="text" name="platform[]" class="social-platform-input" value="Instagram" readonly>
                        <input type="url" name="URL[]" class="social-url-input" placeholder="https://instagram.com/username" value="<?php echo $sc['URL']; ?>">
                        <input type="hidden" name="socialid[]" value="<?php echo $sc['id']; ?>">
                      </div>
                      <div class="social-controls">
                        <div class="access-toggle">
                          <div class="access-option free <?php if ($sc['status'] == 'free' || empty($sc['status'])) echo 'active'; ?> " onclick="toggleAccess(this, 'free','insta')">Free</div>
                          <div class="access-option paid <?php if ($sc['status'] == 'paid') echo 'active'; ?> " onclick="toggleAccess(this, 'paid','insta')">Paid</div>
                          <input type="hidden" name="status[]" class="insta" value="<?php echo $sc['status']; ?>">
                          <input type="text" class="paid_token social-platform-input <?php if ($sc['status'] != 'paid') echo 'hidden'; ?>" value="<?php echo $sc['tokens']; ?>" value="" name="paid_token[]" placeholder="Enter token amount">
                        </div>
                        <label class="toggle-switch">
                          <input type="checkbox" name="public[]" value="yes" <?php if ($sc['public'] == 'yes') echo 'checked';  ?>>
                          <span class="toggle-slider"></span>
                        </label>
                        <span class="text-xs text-white/60">Public</span>
                      </div>
                    </div>
                  <?php } else if ($sc['platform'] == 'Twitter') { ?>
                    <!-- Twitter -->
                    <div class="social-link-item twitter">
                      <div class="social-icon">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                      </div>
                      <div class="social-content">
                        <input type="text" name="platform[]" class="social-platform-input" value="Twitter" readonly>
                        <input type="url" name="URL[]" class="social-url-input" placeholder="https://twitter.com/username" value="<?php echo $sc['URL']; ?>">
                        <input type="hidden" name="socialid[]" value="<?php echo $sc['id']; ?>">
                      </div>
                      <div class="social-controls">
                        <div class="access-toggle">
                          <div class="access-option free  <?php if ($sc['status'] == 'free' || empty($sc['status'])) echo 'active'; ?> " onclick="toggleAccess(this, 'free','tw')">Free</div>
                          <div class="access-option paid <?php if ($sc['status'] == 'paid') echo 'active'; ?> " onclick="toggleAccess(this, 'paid','tw')">Paid</div>
                          <input type="hidden" name="status[]" class="tw" value="<?php echo $sc['status']; ?>">
                          <input type="text" class="paid_token social-platform-input <?php if ($sc['status'] != 'paid') echo 'hidden'; ?>" value="<?php echo $sc['tokens']; ?>" value="" name="paid_token[]" placeholder="Enter token amount">
                        </div>
                        <label class="toggle-switch">
                          <input type="checkbox" name="public[]" value="yes" <?php if ($sc['public'] == 'yes') echo 'checked';  ?>>
                          <span class="toggle-slider"></span>
                        </label>
                        <span class="text-xs text-white/60">Public</span>
                      </div>
                    </div>

                  <?php } else if ($sc['platform'] == 'TikTok') { ?>

                    <!-- TikTok -->
                    <div class="social-link-item tiktok">
                      <div class="social-icon">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-.88-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
                        </svg>
                      </div>
                      <div class="social-content">
                        <input type="text" name="platform[]" class="social-platform-input" value="TikTok" readonly>
                        <input type="url" name="URL[]" class="social-url-input" placeholder="https://tiktok.com/@username" value="<?php echo $sc['URL']; ?>">
                        <input type="hidden" name="socialid[]" value="<?php echo $sc['id']; ?>">
                      </div>
                      <div class="social-controls">
                        <div class="access-toggle">
                          <div class="access-option free  <?php if ($sc['status'] == 'free' || empty($sc['status'])) echo 'active'; ?> " onclick="toggleAccess(this, 'free','tiktk')">Free</div>
                          <div class="access-option paid <?php if ($sc['status'] == 'paid') echo 'active'; ?> " onclick="toggleAccess(this, 'paid','tiktk')">Paid</div>
                          <input type="hidden" name="status[]" class="tiktk" value="<?php echo $sc['status']; ?>">
                          <input type="text" class="paid_token social-platform-input <?php if ($sc['status'] != 'paid') echo 'hidden'; ?>" value="<?php echo $sc['tokens']; ?>" value="" name="paid_token[]" placeholder="Enter token amount">
                        </div>
                        <label class="toggle-switch">
                          <input type="checkbox" name="public[]" value="yes" <?php if ($sc['public'] == 'yes') echo 'checked';  ?>>
                          <span class="toggle-slider"></span>
                        </label>
                        <span class="text-xs text-white/60">Public</span>
                      </div>
                    </div>

                  <?php } else if ($sc['platform'] == 'OnlyFans') { ?>

                    <!-- OnlyFans -->
                    <div class="social-link-item fans">
                      <div class="social-icon">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                      </div>
                      <div class="social-content">
                        <input type="text" name="platform[]" class="social-platform-input" value="OnlyFans" readonly>
                        <input type="url" name="URL[]" class="social-url-input" placeholder="https://onlyfans.com/username" value="<?php echo $sc['URL']; ?>">
                        <input type="hidden" name="socialid[]" value="<?php echo $sc['id']; ?>">
                      </div>
                      <div class="social-controls">
                        <div class="access-toggle">
                          <div class="access-option free <?php if ($sc['status'] == 'free') echo 'active'; ?> " onclick="toggleAccess(this, 'free','onf')">Free</div>
                          <div class="access-option paid  <?php if ($sc['status'] == 'paid' || empty($sc['status'])) echo 'active'; ?> " onclick="toggleAccess(this, 'paid','onf')">Paid</div>
                          <input type="hidden" name="status[]" class="onf" value="<?php echo $sc['status']; ?>">
                          <input type="text" class="paid_token social-platform-input <?php if ($sc['status'] != 'paid') echo 'hidden'; ?>" value="<?php echo $sc['tokens']; ?>" value="" name="paid_token[]" placeholder="Enter token amount">
                        </div>
                        <label class="toggle-switch">
                          <input type="checkbox" name="public[]" value="yes" <?php if ($sc['public'] == 'yes') echo 'checked';  ?>>
                          <span class="toggle-slider"></span>
                        </label>
                        <span class="text-xs text-white/60">Public</span>
                      </div>
                    </div>

                  <?php } else if ($sc['platform'] == 'Snapchat') { ?>

                    <!-- Snapchat -->
                    <div class="social-link-item snapchat">
                      <div class="social-icon">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.748-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-12C24.007 5.367 18.641.001 12.017.001z" />
                        </svg>
                      </div>
                      <div class="social-content">
                        <input type="text" name="platform[]" class="social-platform-input" value="Snapchat" readonly>
                        <input type="text" name="URL[]" class="social-url-input" placeholder="https://www.snapchat.com/username" value="<?php echo $sc['URL']; ?>">
                        <input type="hidden" name="socialid[]" value="<?php echo $sc['id']; ?>">
                      </div>
                      <div class="social-controls">
                        <div class="access-toggle">
                          <div class="access-option free  <?php if ($sc['status'] == 'free' || empty($sc['status'])) echo 'active'; ?> " onclick="toggleAccess(this, 'free','snap')">Free</div>
                          <div class="access-option paid <?php if ($sc['status'] == 'paid') echo 'active'; ?> " onclick="toggleAccess(this, 'paid','snap')">Paid</div>
                          <input type="hidden" name="status[]" class="snap" value="<?php echo $sc['status']; ?>">
                          <input type="text" class="paid_token social-platform-input <?php if ($sc['status'] != 'paid') echo 'hidden'; ?>" value="<?php echo $sc['tokens']; ?>" value="" name="paid_token[]" placeholder="Enter token amount">
                        </div>
                        <label class="toggle-switch">
                          <input type="checkbox" name="public[]" value="yes" <?php if ($sc['public'] == 'yes') echo 'checked';  ?>>
                          <span class="toggle-slider"></span>
                        </label>
                        <span class="text-xs text-white/60">Public</span>
                      </div>
                    </div>

                  <?php } else { ?>

                    <!-- Others -->
                    <div class="social-link-item snapchat">
                      <div class="social-icon" style="background: #6b7280;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                      </div>
                      <div class="social-content">
                        <input type="text" name="platform[]" class="social-platform-input" placeholder="Platform name (e.g., YouTube, LinkedIn)" value="<?php echo $sc['platform']; ?>">
                        <input type="url" name="URL[]" class="social-url-input" placeholder="Profile URL" value="<?php echo $sc['URL']; ?>">
                        <input type="hidden" name="socialid[]" value="<?php echo $sc['id']; ?>">
                      </div>
                      <div class="social-controls">
                        <div class="access-toggle">
                          <div class="access-option free  <?php if ($sc['status'] == 'free' || empty($sc['status'])) echo 'active'; ?> " onclick="toggleAccess(this, 'free','sc<?php echo $cnt; ?>')">Free</div>
                          <div class="access-option paid <?php if ($sc['status'] == 'paid') echo 'active'; ?> " onclick="toggleAccess(this, 'paid','sc<?php echo $cnt; ?>')">Paid</div>
                          <input type="hidden" name="status[]" class="sc<?php echo $cnt; ?>" value="<?php echo $sc['status']; ?>">
                          <input type="text" class="paid_token social-platform-input <?php if ($sc['status'] != 'paid') echo 'hidden'; ?>" value="<?php echo $sc['tokens']; ?>" name="paid_token[]" placeholder="Enter token amount">
                        </div>
                        <label class="toggle-switch">
                          <input type="checkbox" name="public[]" value="yes" <?php if ($sc['public'] == 'yes') echo 'checked';  ?>>
                          <span class="toggle-slider"></span>
                        </label>
                        <span class="text-xs text-white/60">Public</span>
                        <button class="btn-remove-social" onclick="removeSocialLink(this)">×</button>
                      </div>
                    </div>

                  <?php } ?>
              <?php $cnt++;
                }
              } ?>

            </div>

            <div class="btn-add-social" onclick="addSocialLink()">
              <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Add More Social Links
            </div>
          </div>
        </div>

        <div class="flex justify-end mt-8">
          <input type="hidden" name="username" value="<?php echo $userDetails['username']; ?>" required />
          <input type="hidden" value="<?php echo $userDetails['email']; ?>" name="email" required />
          <button type="button" class="btn-primary" name="submit_name" onclick="updateProfileCompletionNew(this)" value="Save Changes">Save Changes</button>
        </div>
      </form>
    </div>

    <!-- Creator Settings Tab -->
    <div id="creator-content" class="tab-content"  <?php if($userDetails['as_a_model'] !='Yes' && !$is_user_have_extra ) {  ?> style="display: none;" <?php }?> >
      <form method="post" id="creatorSettingsForm" action="act-edit-profile.php" enctype="multipart/form-data">
        <div class="text-center mb-8">
          <h2 class="text-2xl font-bold gradient-text mb-4">Creator Settings</h2>
          <p class="text-white/70">Customize your creator profile and service offerings</p>
        </div>

        <!-- Progress Bar -->
        <div class="step-indicator">
          <div class="step active" onclick="scrollToSection('chat-services')">Chat Services</div>
          <div class="step" onclick="scrollToSection('meet-services')">Meet Services</div>
          <div class="step" onclick="scrollToSection('content-creation')">Content Creation</div>
          <div class="step" onclick="scrollToSection('professional-work')">Professional Work</div>
          <div class="step" onclick="scrollToSection('30_days_access')">30 Days Access</div>
          
          <?php /*?><div class="step" onclick="scrollToSection('physical-attributes')">Physical Attributes</div><?php */ ?>
          <div class="step" onclick="scrollToSection('govt-id-proof')">Govt Id Proof</div>
        </div>
        <div class="progress-bar">
          <div class="progress-fill"></div>
        </div>

        <!-- Chat Services Category -->
        <div id="chat-services" class="collapsible-section">

          <div class="collapsible-header" onclick="toggleCollapsible(this)">
            <h2 class="text-xl font-bold">💬 Chat & Communication Services</h2>
            <svg class="w-6 h-6 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <div class="collapsible-content">
            <div class="token-info flex items-center mb-6">
              <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token">
              <span>TLM tokens are our platform's currency. Users purchase tokens and spend them to access your services. You earn 70% of all token revenue.</span>
            </div>

            
            <?php //$serv_chats = DB::queryFirstRow('select * from model_service_chat where model_unique_id="'.$userDetails['unique_id'].'"'); 
            ?>

            <!-- Live Streaming -->
            <div class="mb-6">
              <div class="question-text">Would you like to offer live streaming sessions?</div>
              <p class="help-text">Connect with viewers through live video streaming and interactive chat</p>
              <div class="radio-group mt-3">
                <div class="radio-option">
                  <input type="radio" id="stream-yes" name="live_cam" value="Yes" <?php if (!empty($extra_details['live_cam']) && $extra_details['live_cam'] == 'Yes') {
                                                                                    echo 'checked';
                                                                                  } ?> onchange="toggleConditionalSection('streaming-options', true)">
                  <label for="stream-yes">Yes, I'm interested</label>
                </div>
                <div class="radio-option">
                  <input type="radio" id="stream-no" name="live_cam" value="No" <?php if ((!empty($extra_details['live_cam']) && $extra_details['live_cam'] == 'No') || empty($extra_details['live_cam'])) {
                                                                                  echo 'checked';
                                                                                } ?> onchange="toggleConditionalSection('streaming-options', false)">
                  <label for="stream-no">Not right now</label>
                </div>
              </div>
            </div>

            <div id="streaming-options" class="conditional-section <?php if (!empty($extra_details['live_cam']) && $extra_details['live_cam'] == 'Yes') {
                                                                      echo 'show';
                                                                    } ?> ">
              <?php /*?><div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <div class="flex justify-between items-center mb-2">
                <label class="form-label mb-0">Instagram Profile URL</label>
                <div class="flex items-center">
                  <span class="text-sm mr-2">Use for video calls</span>
                  <label class="toggle-switch">
                    <input type="checkbox" checked>
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
              <input type="url" class="form-input" name="insta_p_url" value="<?php if(!empty($extra_details)) echo $extra_details['insta_p_url']; ?>"  placeholder="https://instagram.com/username">
              <p class="help-text">We'll use this to set up video calls through Instagram</p>
            </div>
            <div>
              <div class="flex justify-between items-center mb-2">
                <label class="form-label mb-0">Snapchat Username</label>
                <div class="flex items-center">
                  <span class="text-sm mr-2">Use for video calls</span>
                  <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
              <input type="text" class="form-input" name="snap_p_url" value="<?php if(!empty($extra_details)) echo $serv_chats['snap_p_url']; ?>" placeholder="Your Snapchat username">
              <p class="help-text">We'll use this to set up video calls through Snapchat</p>
            </div>
          </div><?php */ ?>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 <?php /*mt-4 */ ?>">
                <div>
                  <label class="form-label">TLM Tokens per Minute (Private Chat)</label>
                  <input type="number" class="form-input" name="private_chat_token" value="<?php if (!empty($extra_details)) echo $extra_details['private_chat_token']; ?>" placeholder="e.g., 50" min="1">
                  <p class="help-text">Set your rate for private video chats</p>
                </div>
                <div>
                  <label class="form-label">TLM Tokens per Minute (Group Chat)</label>
                  <input type="number" class="form-input" name="group_chat_tocken" value="<?php if (!empty($extra_details)) echo $extra_details['group_chat_tocken']; ?>" placeholder="e.g., 20" min="1">
                  <p class="help-text">Set your rate for group video sessions</p>
                </div>
              </div>
            </div>

            <!-- Group Shows -->
            <div class="mt-8 mb-6">
              <div class="question-text">Would you like to host group video sessions?</div>
              <p class="help-text">Host interactive group sessions where multiple viewers can join and chat together</p>
              <div class="radio-group mt-3">
                <div class="radio-option">
                  <input type="radio" id="group-yes" name="group_show" value="Yes" <?php if (!empty($extra_details['group_show']) && $extra_details['group_show'] == 'Yes') {
                                                                                      echo 'checked';
                                                                                    } ?> onchange="toggleConditionalSection('group-options', true)">
                  <label for="group-yes">Yes, sounds fun!</label>
                </div>
                <div class="radio-option">
                  <input type="radio" id="group-no" name="group_show" value="No" <?php if ((!empty($extra_details['group_show']) && $extra_details['group_show'] == 'No') || empty($extra_details['group_show'])) {
                                                                                    echo 'checked';
                                                                                  } ?> onchange="toggleConditionalSection('group-options', false)">
                  <label for="group-no">Not interested</label>
                </div>
              </div>
            </div>

            <div id="group-options" class="conditional-section <?php if (!empty($extra_details['group_show']) && $extra_details['group_show'] == 'Yes') {
                                                                  echo 'show';
                                                                } ?> ">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="form-label">Minimum Group Size</label>
                  <input type="number" class="form-input" name="gs_min_member" value="<?php echo $extra_details['gs_min_member']; ?>" placeholder="e.g., 3" min="2" max="20">
                  <p class="help-text">Minimum number of participants to start a session</p>
                </div>
                <div>
                  <label class="form-label">TLM Tokens per Person per Minute</label>
                  <input type="number" class="form-input" name="gs_token_price" value="<?php echo $extra_details['gs_token_price']; ?>" placeholder="e.g., 15" min="1">
                  <p class="help-text">Rate per participant in group sessions</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php //$serv_meets = DB::queryFirstRow('select * from model_service_meet where model_unique_id="'.$userDetails['unique_id'].'"'); 
        ?>

        <!-- Meet Services Category -->
        <div id="meet-services" class="collapsible-section">
          <div class="collapsible-header" onclick="toggleCollapsible(this)">
            <h2 class="text-xl font-bold">👥 Meet & Social Services</h2>
            <svg class="w-6 h-6 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <div class="collapsible-content">
            <!-- Social Companionship -->
            <div class="mb-6">
              <div class="question-text">Would you like to offer social companionship services?</div>
              <p class="help-text">Provide friendly companionship for social events, dinners, or casual meetups</p>
              <div class="radio-group mt-3">
                <div class="radio-option">
                  <input type="radio" id="companion-yes" name="work_escort" value="Yes" <?php if (!empty($extra_details['work_escort']) && $extra_details['work_escort'] == 'Yes') {
                                                                                          echo 'checked';
                                                                                        } ?> onchange="toggleConditionalSection('companion-options', true)">
                  <label for="companion-yes">Yes, I'd love to meet people</label>
                </div>
                <div class="radio-option">
                  <input type="radio" id="companion-no" name="work_escort" value="No" <?php if ((!empty($extra_details['work_escort']) && $extra_details['work_escort'] == 'No') || empty($extra_details['work_escort'])) {
                                                                                        echo 'checked';
                                                                                      } ?> onchange="toggleConditionalSection('companion-options', false)">
                  <label for="companion-no">Not interested</label>
                </div>
              </div>
            </div>

            <div id="companion-options" class="conditional-section <?php if (!empty($extra_details['work_escort']) && $extra_details['work_escort'] == 'Yes') {
                                                                      echo 'show';
                                                                    } ?>  ">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="form-label">Local Meetup Rate (TLM tokens per hour)</label>
                  <input type="number" class="form-input" name="in_per_hour" value="<?php if (!empty($extra_details)) echo $extra_details['in_per_hour']; ?>" placeholder="e.g., 1000" min="1">
                  <p class="help-text">Rate for local social meetups and events</p>
                </div>
                <div>
                  <label class="form-label">Extended Social Rate (TLM tokens per hour)</label>
                  <input type="number" class="form-input" name="extended_rate" value="<?php if (!empty($extra_details)) echo $extra_details['extended_rate']; ?>" placeholder="e.g., 1500" min="1">
                  <p class="help-text">Rate for longer social engagements</p>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                  <label class="form-label">Overnight Social Rate (TLM tokens)</label>
                  <input type="number" class="form-input" name="in_overnight" value="<?php if (!empty($extra_details)) echo $extra_details['in_overnight']; ?>" placeholder="e.g., 8000" min="1">
                  <p class="help-text">Rate for overnight social companionship</p>
                </div>
                <div>
                  <label class="form-label">Preferred Meeting Location</label>
                  <input type="text" class="form-input" name="d_a_address" value="<?php if (!empty($extra_details)) echo $extra_details['d_a_address']; ?>" placeholder="e.g., Coffee shops, restaurants, events">
                  <p class="help-text">Where you prefer to meet for social activities</p>
                </div>
              </div>

              <?php $social_availability = json_decode($extra_details['social_availability']); ?>

              <div class="mt-4">
                <label class="form-label">Available Days</label>
                <p class="help-text">Select the days you're available for social meetups</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3 edit-allldays">
                  <div class="checkbox-option">
                    <input type="checkbox" id="mon" name="social_availability[]" value="Monday" <?php if (!empty($social_availability) && in_array('Monday', $social_availability)) echo 'checked'; ?>>
                    <label for="mon">Monday</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="tue" name="social_availability[]" value="Tuesday" <?php if (!empty($social_availability) && in_array('Tuesday', $social_availability)) echo 'checked'; ?>>
                    <label for="tue">Tuesday</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="wed" name="social_availability[]" value="Wednesday" <?php if (!empty($social_availability) && in_array('Wednesday', $social_availability)) echo 'checked'; ?>>
                    <label for="wed">Wednesday</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="thu" name="social_availability[]" value="Thursday" <?php if (!empty($social_availability) && in_array('Thursday', $social_availability)) echo 'checked'; ?>>
                    <label for="thu">Thursday</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="fri" name="social_availability[]" value="Friday" <?php if (!empty($social_availability) && in_array('Friday', $social_availability)) echo 'checked'; ?>>
                    <label for="fri">Friday</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="sat" name="social_availability[]" value="Saturday" <?php if (!empty($social_availability) && in_array('Saturday', $social_availability)) echo 'checked'; ?>>
                    <label for="sat">Saturday</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="sun" name="social_availability[]" value="Sunday" <?php if (!empty($social_availability) && in_array('Sunday', $social_availability)) echo 'checked'; ?>>
                    <label for="sun">Sunday</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Travel Companionship -->
            <div class="mt-8 mb-6">
              <div class="question-text">Would you like to offer travel companionship?</div>
              <p class="help-text">Accompany clients on trips, vacations, or business travel as a social companion</p>
              <div class="radio-group mt-3">
                <div class="radio-option">
                  <input type="radio" id="travel-yes" name="International_tours" value="Yes" <?php if (!empty($extra_details['International_tours']) && $extra_details['International_tours'] == 'Yes') {
                                                                                                echo 'checked';
                                                                                              } ?> onchange="toggleConditionalSection('travel-options', true)">
                  <label for="travel-yes">Yes, I love to travel!</label>
                </div>
                <div class="radio-option">
                  <input type="radio" id="travel-no" name="International_tours" value="No" <?php if ((!empty($extra_details['International_tours']) && $extra_details['International_tours'] == 'No') || empty($extra_details['International_tours'])) {
                                                                                              echo 'checked';
                                                                                            } ?> onchange="toggleConditionalSection('travel-options', false)">
                  <label for="travel-no">Not interested</label>
                </div>
              </div>
            </div>

            <div id="travel-options" class="conditional-section <?php if (!empty($extra_details['International_tours']) && $extra_details['International_tours'] == 'Yes') {
                                                                  echo 'show';
                                                                } ?> ">
              <?php $travel_months = json_decode($extra_details['travel_months']); ?>
              <div>
                <label class="form-label">Available Months for Travel</label>
                <p class="help-text">Select months when you're available for travel companionship</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
                  <div class="checkbox-option">
                    <input type="checkbox" id="jan" name="travel_months[]" value="January" <?php if (!empty($travel_months) && in_array('January', $travel_months)) echo 'checked'; ?>>
                    <label for="jan">January</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="feb" name="travel_months[]" value="February" <?php if (!empty($travel_months) && in_array('February', $travel_months)) echo 'checked'; ?>>
                    <label for="feb">February</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="mar" name="travel_months[]" value="March" <?php if (!empty($travel_months) && in_array('March', $travel_months)) echo 'checked'; ?>>
                    <label for="mar">March</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="apr" name="travel_months[]" value="April" <?php if (!empty($travel_months) && in_array('April', $travel_months)) echo 'checked'; ?>>
                    <label for="apr">April</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="may" name="travel_months[]" value="May" <?php if (!empty($travel_months) && in_array('May', $travel_months)) echo 'checked'; ?>>
                    <label for="may">May</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="jun" name="travel_months[]" value="June" <?php if (!empty($travel_months) && in_array('June', $travel_months)) echo 'checked'; ?>>
                    <label for="jun">June</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="jul" name="travel_months[]" value="July" <?php if (!empty($travel_months) && in_array('July', $travel_months)) echo 'checked'; ?>>
                    <label for="jul">July</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="aug" name="travel_months[]" value="August" <?php if (!empty($travel_months) && in_array('August', $travel_months)) echo 'checked'; ?>>
                    <label for="aug">August</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="sep" name="travel_months[]" value="September" <?php if (!empty($travel_months) && in_array('September', $travel_months)) echo 'checked'; ?>>
                    <label for="sep">September</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="oct" name="travel_months[]" value="October" <?php if (!empty($travel_months) && in_array('October', $travel_months)) echo 'checked'; ?>>
                    <label for="oct">October</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="nov" name="travel_months[]" value="November" <?php if (!empty($travel_months) && in_array('November', $travel_months)) echo 'checked'; ?>>
                    <label for="nov">November</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="dec" name="travel_months[]" value="December" <?php if (!empty($travel_months) && in_array('December', $travel_months)) echo 'checked'; ?>>
                    <label for="dec">December</label>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                  <label class="form-label">Daily Rate (TLM tokens)</label>
                  <input type="number" class="form-input" name="daily_rate" value="<?php if (!empty($extra_details)) echo $extra_details['daily_rate']; ?>" placeholder="e.g., 5000" min="1">
                  <p class="help-text">Rate per day for travel companionship</p>
                </div>
                <div>
                  <label class="form-label">Weekly Rate (TLM tokens)</label>
                  <input type="number" class="form-input" name="weekly_rate" value="<?php if (!empty($extra_details)) echo $extra_details['weekly_rate']; ?>" placeholder="e.g., 30000" min="1">
                  <p class="help-text">Rate per week for extended travel</p>
                </div>
                <div>
                  <label class="form-label">Monthly Rate (TLM tokens)</label>
                  <input type="number" class="form-input" name="monthly_rate" value="<?php if (!empty($extra_details)) echo $extra_details['monthly_rate']; ?>" placeholder="e.g., 100000" min="1">
                  <p class="help-text">Rate per month for long-term travel</p>
                </div>
              </div>

              <div class="mt-4">
                <label class="form-label">Preferred Travel Destinations</label>
                <input type="text" class="form-input" name="travel_destination" value="<?php if (!empty($extra_details)) echo $extra_details['travel_destination']; ?>" placeholder="e.g., Europe, Asia, Caribbean, Domestic US">
                <p class="help-text">List countries or regions you'd like to visit</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Content Creation -->
        <div id="content-creation" class="collapsible-section">
          <div class="collapsible-header" onclick="toggleCollapsible(this)">
            <h2 class="text-xl font-bold">📸 Content Creation</h2>
            <svg class="w-6 h-6 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <div class="collapsible-content">
            <div class="mb-6">
              <div class="question-text">Would you like to sell photos and videos?</div>
              <p class="help-text">Create and sell custom content for your audience</p>
              <div class="radio-group mt-3">
                <div class="radio-option">
                  <input type="radio" id="content-yes" name="video_pictures" value="Yes" <?php if (!empty($extra_details['video_pictures']) && $extra_details['video_pictures'] == 'Yes') {
                                                                                            echo 'checked';
                                                                                          } ?> onchange="toggleConditionalSection('content-options', true)">
                  <label for="content-yes">Yes, I'm creative!</label>
                </div>
                <div class="radio-option">
                  <input type="radio" id="content-no" name="video_pictures" value="No" <?php if ((!empty($extra_details['video_pictures']) && $extra_details['video_pictures'] == 'No') || empty($extra_details['video_pictures'])) {
                                                                                          echo 'checked';
                                                                                        } ?> onchange="toggleConditionalSection('content-options', false)">
                  <label for="content-no">Not interested</label>
                </div>
              </div>
            </div>

            <?php /*?><div id="content-options" class="conditional-section">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="form-label">Photo Set Price (TLM tokens)</label>
              <input type="number" class="form-input" placeholder="e.g., 500" min="1">
              <p class="help-text">Price for a set of 5-10 photos</p>
            </div>
            <div>
              <label class="form-label">Custom Video Price (TLM tokens/minute)</label>
              <input type="number" class="form-input" placeholder="e.g., 200" min="1">
              <p class="help-text">Price per minute for custom videos</p>
            </div>
          </div>
        </div><?php */ ?>
          </div>
        </div>
		
		<?php 
		
		//Code for checking number of followers
		$followers_array = DB::query('select unique_model_id from model_follow where unique_user_id="' . $userDetails['unique_id'] . '"  AND status = "Follow" ');

		?>

        <!-- Professional Work -->
        <div id="professional-work" class="collapsible-section">
          <div class="collapsible-header" onclick="toggleCollapsible(this)">
            <h2 class="text-xl font-bold">🎬 Professional Modeling & Entertainment</h2>
            <svg class="w-6 h-6 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <div class="collapsible-content <?php if(empty($followers_array) || count($followers_array) < 1000){ echo 'access_restricted'; } ?>">
            <div class="private-section mb-6">
              <div class="private-badge">🔒 Private & Confidential</div>
              <p class="text-sm">This information is kept strictly confidential and used only for professional matching with appropriate opportunities.</p>
            </div>

            <div class="mb-6">
              <div class="question-text">Are you interested in professional modeling opportunities?</div>
              <div class="radio-group mt-3">
                <div class="radio-option">
                  <input type="radio" id="modeling-yes" name="modeling" value="Yes" <?php if (!empty($extra_details['modeling']) && $extra_details['modeling'] == 'Yes') { echo 'checked'; } ?> 
				  <?php if(!empty($followers_array) && count($followers_array) >= 1000){ ?> onchange="toggleConditionalSection('modeling-options', true)" <?php } ?> >
                  <label for="modeling-yes">Yes</label>
                </div>
                <div class="radio-option">
                  <input type="radio" id="modeling-no" name="modeling" value="No" <?php if ((!empty($extra_details['modeling']) && $extra_details['modeling'] == 'No') || empty($extra_details['modeling'])) { echo 'checked'; } ?>
				  <?php if(!empty($followers_array) && count($followers_array) >= 1000){ ?> onchange="toggleConditionalSection('modeling-options', false)" <?php } ?> >  
                  <label for="modeling-no">No</label>
                </div>
              </div>
            </div>

         
            <div id="modeling-options" class="conditional-section <?php if (!empty($extra_details['modeling']) && $extra_details['modeling'] == 'Yes') {
                                                                    echo 'show';
                                                                  } ?> ">
              <div class="adult-section mb-6">
                <div class="adult-badge">🔞 Adult Content</div>
                <div class="mb-4">
                  <div class="question-text">Are you comfortable with adult content creation?</div>
                  <p class="help-text">This includes lingerie, swimwear, artistic nude, and adult-oriented content</p>
                  <div class="radio-group mt-3">
                    <div class="radio-option">
                      <input type="radio" id="adult-yes" name="adult_content" value="Yes" <?php if (!empty($extra_details['adult_content']) && $extra_details['adult_content'] == 'Yes') { echo 'checked'; } ?> 
					  <?php if(!empty($followers_array) && count($followers_array) >= 1000){ ?> onchange="toggleConditionalSection('adult-services', true)" <?php } ?> >
                      <label for="adult-yes">Yes, I'm comfortable</label>
                    </div>
                    <div class="radio-option">
                      <input type="radio" id="adult-no" name="adult_content" value="No" <?php if ((!empty($extra_details['adult_content']) && $extra_details['adult_content'] == 'No') || empty($extra_details['adult_content'])) { echo 'checked'; } ?> 
					  <?php if(!empty($followers_array) && count($followers_array) >= 1000){ ?> onchange="toggleConditionalSection('adult-services', false)" <?php } ?> > 
                      <label for="adult-no">No, only non-adult content</label>
                    </div>
                  </div>
                </div>

                <div id="adult-services" class="conditional-section  <?php if (!empty($extra_details['adult_content']) && $extra_details['adult_content'] == 'Yes' && $extra_details['status'] == 'Published') {
                                                                        echo 'show';
                                                                      } ?> ">
                  <div class="confidential-section">
                    <div class="confidential-badge">🔐 STRICTLY CONFIDENTIAL - APPROVED MODELS ONLY</div>
                    <p class="text-sm text-white/80 mb-4">The following services are only visible to verified and approved models. This information is encrypted and never shared publicly.</p>
                    <?php $escort_services = json_decode($extra_details['escort_services']); ?>
                    <div class="mb-6">
                      <label class="form-label">Escort & Companionship Services</label>
                      <p class="help-text">Select the professional companionship services you're comfortable providing</p>
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div class="checkbox-option">
                          <input type="checkbox" id="dinner-companion" name="escort_services[]" value="Dinner Companion" <?php if (!empty($escort_services) && in_array('Dinner Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="dinner-companion">Dinner Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="social-events" name="escort_services[]" value="Social Events Companion" <?php if (!empty($escort_services) && in_array('Social Events Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="social-events">Social Events Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="business-companion" name="escort_services[]" value="Business Events Companion" <?php if (!empty($escort_services) && in_array('Business Events Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="business-companion">Business Events Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="travel-escort" name="escort-services[]" value="Travel Companion" <?php if (!empty($escort_services) && in_array('Travel Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="travel-escort">Travel Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="overnight-companion" name="escort_services[]" value="Overnight Companionship" <?php if (!empty($escort_services) && in_array('Overnight Companionship', $escort_services)) echo 'checked'; ?>>
                          <label for="overnight-companion">Overnight Companionship</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="weekend-companion" name="escort_services[]" value="Weekend Companion" <?php if (!empty($escort_services) && in_array('Weekend Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="weekend-companion">Weekend Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="party-companion" name="escort-services[]" value="Party & Club Companion" <?php if (!empty($escort_services) && in_array('Party & Club Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="party-companion">Party & Club Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="cultural-companion" name="escort_services[]" value="Cultural Events Companion" <?php if (!empty($escort_services) && in_array('Cultural Events Companion', $escort_services)) echo 'checked'; ?>>
                          <label for="cultural-companion">Cultural Events Companion</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="arm-candy" name="escort_services[]" value="Arm Candy / Plus One" <?php if (!empty($escort_services) && in_array('Arm Candy / Plus One', $escort_services)) echo 'checked'; ?>>
                          <label for="arm-candy">Arm Candy / Plus One</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="massage-companion" name="escort_services[]" value="Massage Services" <?php if (!empty($escort_services) && in_array('Massage Services', $escort_services)) echo 'checked'; ?>>
                          <label for="massage-companion">Massage Services</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="gfe" name="escort_services[]" value="Girlfriend Experience (GFE)" <?php if (!empty($escort_services) && in_array('Girlfriend Experience (GFE)', $escort_services)) echo 'checked'; ?>>
                          <label for="gfe">Girlfriend Experience (GFE)</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="pse" name="escort_services[]" value="Pornstar Experience (PSE)" <?php if (!empty($escort_services) && in_array('Pornstar Experience (PSE)', $escort_services)) echo 'checked'; ?>>
                          <label for="pse">Pornstar Experience (PSE)</label>
                        </div>
                      </div>
                    </div>
                    <?php $intimate_services = json_decode($extra_details['intimate_services']); ?>
                    <div class="mb-6">
                      <label class="form-label">Intimate Services</label>
                      <p class="help-text">Select intimate services you're comfortable providing (18+ only)</p>
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div class="checkbox-option">
                          <input type="checkbox" id="intimate-companionship" name="intimate_services[]" value="Intimate Companionship" <?php if (!empty($intimate_services) && in_array('Intimate Companionship', $intimate_services)) echo 'checked'; ?>>
                          <label for="intimate-companionship">Intimate Companionship</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="sensual-massage" name="intimate_services[]" value="Sensual Massage" <?php if (!empty($intimate_services) && in_array('Sensual Massage', $intimate_services)) echo 'checked'; ?>>
                          <label for="sensual-massage">Sensual Massage</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="body-to-body" name="intimate_services[]" value="Body to Body Massage" <?php if (!empty($intimate_services) && in_array('Body to Body Massage', $intimate_services)) echo 'checked'; ?>>
                          <label for="body-to-body">Body to Body Massage</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="tantric-massage" name="intimate_services[]" value="Tantric Massage" <?php if (!empty($intimate_services) && in_array('Tantric Massage', $intimate_services)) echo 'checked'; ?>>
                          <label for="tantric-massage">Tantric Massage</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="fetish-friendly" name="intimate_services[]" value="Fetish Friendly" <?php if (!empty($intimate_services) && in_array('Fetish Friendly', $intimate_services)) echo 'checked'; ?>>
                          <label for="fetish-friendly">Fetish Friendly</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="role-play" name="intimate_services[]" value="Role Play" <?php if (!empty($intimate_services) && in_array('Role Play', $intimate_services)) echo 'checked'; ?>>
                          <label for="role-play">Role Play</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="domination" name="intimate_services[]" value="Domination Services" <?php if (!empty($intimate_services) && in_array('Domination Services', $intimate_services)) echo 'checked'; ?>>
                          <label for="domination">Domination Services</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="submission" name="intimate_services[]" value="Submission Services" <?php if (!empty($intimate_services) && in_array('Submission Services', $intimate_services)) echo 'checked'; ?>>
                          <label for="submission">Submission Services</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="couples-services" name="intimate_services[]" value="Couples Services" <?php if (!empty($intimate_services) && in_array('Couples Services', $intimate_services)) echo 'checked'; ?>>
                          <label for="couples-services">Couples Services</label>
                        </div>
                        <div class="checkbox-option">
                          <input type="checkbox" id="threesome" name="intimate_services[]" value="Threesome Services" <?php if (!empty($intimate_services) && in_array('Threesome Services', $intimate_services)) echo 'checked'; ?>>
                          <label for="threesome">Threesome Services</label>
                        </div>
                      </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <div>
                        <label class="form-label">Hourly Rate (TLM tokens)</label>
                        <input type="number" class="form-input" name="hourly_rate" value="<?php if (!empty($extra_details)) echo $extra_details['hourly_rate']; ?>" placeholder="e.g., 5000" min="1">
                        <p class="help-text">Rate per hour for escort services</p>
                      </div>
                      <div>
                        <label class="form-label">Overnight Rate (TLM tokens)</label>
                        <input type="number" class="form-input" name="overnight_rate" value="<?php if (!empty($extra_details)) echo $extra_details['overnight_rate']; ?>" placeholder="e.g., 25000" min="1">
                        <p class="help-text">Rate for overnight services</p>
                      </div>
                      <div>
                        <label class="form-label">Weekend Rate (TLM tokens)</label>
                        <input type="number" class="form-input" name="weekend_rate" value="<?php if (!empty($extra_details)) echo $extra_details['weekend_rate']; ?>" placeholder="e.g., 50000" min="1">
                        <p class="help-text">Rate for weekend packages</p>
                      </div>
                    </div>
                  </div>
                  <?php $adult_content_types = json_decode($extra_details['adult_content_types']); ?>
                  <div class="mb-4">
                    <label class="form-label">Adult Content Types</label>
                    <p class="help-text">Select the types of adult content you're comfortable creating</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                      <div class="checkbox-option">
                        <input type="checkbox" id="lingerie-modeling" name="adult_content_types[]" value="Lingerie Modeling" <?php if (!empty($adult_content_types) && in_array('Lingerie Modeling', $adult_content_types)) echo 'checked'; ?>>
                        <label for="lingerie-modeling">Lingerie Modeling</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="swimwear-modeling" name="adult_content_types[]" value="Swimwear Modeling" <?php if (!empty($adult_content_types) && in_array('Swimwear Modeling', $adult_content_types)) echo 'checked'; ?>>
                        <label for="swimwear-modeling">Swimwear Modeling</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="artistic-nude" name="adult_content_types[]" value="Artistic Nude Photography" <?php if (!empty($adult_content_types) && in_array('Artistic Nude Photography', $adult_content_types)) echo 'checked'; ?>>
                        <label for="artistic-nude">Artistic Nude Photography</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="boudoir" name="adult_content_types[]" value="Boudoir Photography" <?php if (!empty($adult_content_types) && in_array('Boudoir Photography', $adult_content_types)) echo 'checked'; ?>>
                        <label for="boudoir">Boudoir Photography</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="adult-videos" name="adult_content_types[]" value="Adult Video Content" <?php if (!empty($adult_content_types) && in_array('Adult Video Content', $adult_content_types)) echo 'checked'; ?>>
                        <label for="adult-videos">Adult Video Content</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="cam-shows" name="adult_content_types[]" value="Live Cam Shows" <?php if (!empty($adult_content_types) && in_array('Live Cam Shows', $adult_content_types)) echo 'checked'; ?>>
                        <label for="cam-shows">Live Cam Shows</label>
                      </div>
                    </div>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label class="form-label">Adult Content Rate (TLM tokens per session)</label>
                      <input type="number" class="form-input" name="adult_content_rate" value="<?php if (!empty($extra_details)) echo $extra_details['adult_content_rate']; ?>" placeholder="e.g., 2000" min="1">
                      <p class="help-text">Rate for adult content creation sessions</p>
                    </div>
                    <div>
                      <label class="form-label">Live Show Rate (TLM tokens per minute)</label>
                      <input type="number" class="form-input" name="live_show_rate" value="<?php if (!empty($extra_details)) echo $extra_details['live_show_rate']; ?>" placeholder="e.g., 100" min="1">
                      <p class="help-text">Rate for live adult shows</p>
                    </div>
                  </div>
                </div>
              </div>
              <?php $work_availability = json_decode($extra_details['work_availability']); ?>
              <div class="mb-4">
                <label class="form-label">Availability for Professional Work</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                  <div class="checkbox-option">
                    <input type="checkbox" id="local-work" name="work_availability[]" value="Local assignments in my city" <?php if (!empty($work_availability) && in_array('Local assignments in my city', $work_availability)) echo 'checked'; ?>>
                    <label for="local-work">Local assignments in my city</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="travel-work" name="work_availability[]" value="Willing to travel for assignments" <?php if (!empty($work_availability) && in_array('Willing to travel for assignments', $work_availability)) echo 'checked'; ?>>
                    <label for="travel-work">Willing to travel for assignments</label>
                  </div>
                </div>
              </div>
              <?php $content_types = json_decode($extra_details['content_types']); ?>
              <div class="mb-4">
                <label class="form-label">Professional Content Types</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div class="checkbox-option">
                    <input type="checkbox" id="fashion" name="content_types[]" value="Fashion & Lifestyle" <?php if (!empty($content_types) && in_array('Fashion & Lifestyle', $content_types)) echo 'checked'; ?>>
                    <label for="fashion">Fashion & Lifestyle</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="commercial" name="content_types[]" value="Commercial Photography" <?php if (!empty($content_types) && in_array('Commercial Photography', $content_types)) echo 'checked'; ?>>
                    <label for="commercial">Commercial Photography</label>
                  </div>
                  <div class="checkbox-option">
                    <input type="checkbox" id="artistic" name="content_types[]" value="Artistic & Creative" <?php if (!empty($content_types) && in_array('Artistic & Creative', $content_types)) echo 'checked'; ?>>
                    <label for="artistic">Artistic & Creative</label>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="form-label">Expected Rate per Professional Session (TLM tokens)</label>
                  <input type="number" class="form-input" name="professional_rate" value="<?php if (!empty($extra_details)) echo $extra_details['professional_rate']; ?>" placeholder="e.g., 5000" min="1">
                  <p class="help-text">Your expected rate for professional modeling sessions</p>
                </div>
                <div>
                  <label class="form-label">Additional Professional Services</label>
                  <textarea class="form-input" rows="3" name="professional_service" placeholder="Describe any additional professional services you offer..."><?php if (!empty($extra_details)) echo $extra_details['professional_service']; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div id="30_days_access" class="collapsible-section">

            <div class="collapsible-header" onclick="toggleCollapsible(this)">

              <h2 class="text-xl font-bold"> 30 Days Access</h2>

              <svg class="w-6 h-6 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>

            <div class="collapsible-content">
              
              <div class="mb-6">
                <div class="question-text">Do you want to provide 30 days exclusive access to all content?</div>
                <div class="radio-group mt-3">
                  <div class="radio-option">
                    <input type="radio" id="access-yes" onchange="AccessChange(this)" checked="" name="all_30day_access" value="Yes">
                    <label for="access-yes">Yes</label>
                  </div>
                  <div class="radio-option">
                    <input type="radio" id="access-no" onchange="AccessChange(this)" name="all_30day_access" value="No">
                    <label for="access-no">No</label>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 all_access_coin">
                <div>

                  <label class="form-label">All 30 Days access coins?</label>

                  <input type="number" class="form-input" name="all_30day_access_price" value="100" placeholder="e.g., 5000" min="1">
                
                </div>
              </div>

            </div>
        </div>

        <!-- Govt ID Proof Attributes -->
        <div id="govt-id-proof" class="collapsible-section">
          <div class="collapsible-header" onclick="toggleCollapsible(this)">
            <h2 class="text-xl font-bold">👤 Govt Id Proof</h2>
            <svg class="w-6 h-6 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <div class="collapsible-content">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
              <div>
                <label class="form-label">Choose Document Type</label>
                <select name="choose_document" id="vfb-43" class="vfb-select  vfb-medium form-select  required ">
                  <option value="" selected='selected'>Choose Document</option>
                  <option value="Passport" <?php if (isset($extra_details['choose_document']) && $extra_details['choose_document'] == 'Passport') {
                                              echo 'selected';
                                            } ?>>Passport</option>
                  <option value="Driving License" <?php if (isset($extra_details['choose_document']) && $extra_details['choose_document'] == 'Driving License') {
                                                    echo 'selected';
                                                  } ?>>Driving License</option>
                  <option value="National ID" <?php if (isset($extra_details['choose_document']) && $extra_details['choose_document'] == 'National ID') {
                                                echo 'selected';
                                              } ?>>National ID</option>
                  <option value="Pan Card" <?php if (isset($extra_details['choose_document']) && $extra_details['choose_document'] == 'Pan Card') {
                                              echo 'selected';
                                            } ?>>Pan Card</option>
                  <option value="Aadhar" <?php if (isset($extra_details['choose_document']) && $extra_details['choose_document'] == 'Aadhar') {
                                            echo 'selected';
                                          } ?>>Aadhar</option>
                </select>
              </div>
              <div>
                <label class="form-label">Upload ID Card</label>
                <input type="file" name="govt_id_proof" class="govt_id_proof" value="">

                <?php
                if (isset($extra_details['govt_id_proof'])) {
                  echo '<div class="idproof-section">';
                  $extension = strtolower(pathinfo($extra_details['govt_id_proof'], PATHINFO_EXTENSION));
                  $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                  if (in_array($extension, $allowed_extensions)) {
                    echo '<img src="' . SITEURL . $extra_details['govt_id_proof'] . '" class="id_proof_img">';
                  } else {
                    echo '<a href="' . SITEURL . $extra_details['govt_id_proof'] . '" target="_blank"><img src="' . SITEURL . '/uploads/govt-proof.svg" class="id_proof_img"></a>';
                  }
                  echo '</div>';
                }

                ?>

              </div>
            </div>


          </div>

        </div>



        <div class="flex justify-center mt-8">
          <input type="hidden" name="use_id" value="<?php echo $_SESSION["log_user_id"]; ?>">
          <input type="hidden" name="model_unique_id" value="<?php echo $userDetails['unique_id']; ?>">
          <button class="btn-primary text-lg px-8 py-2" type="button" name="service_submit" onclick="saveCreatorSettings(this)">Save Creator Settings</button>
        </div>
      </form>
    </div>

    <!-- Services Tab -->
    <div id="services-content" class="tab-content">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="stat-card">
          <div class="stat-value gradient-text"><?php echo $totalAmount; ?></div>
          <div class="stat-label">Total Earnings</div>
        </div>

        <?php

        $count_active_user = getActiveUsers($userDetails['id'], $con);
        ?>
        <div class="stat-card">
          <div class="stat-value gradient-text"> <?php echo $count_active_user['count'] ?></div>
          <div class="stat-label">Active Clients</div>
        </div>
        <div class="stat-card">
          <div class="stat-value gradient-text">4.9</div>
          <div class="stat-label">Rating (out of 5)</div>
        </div>
      </div>

      <div class="form-section">

        <div class="flex justify-between items-center mb-6">

          <h3 class="text-xl font-bold gradient-text">Earnings Overview</h3>

          <select class="form-select w-auto" name="earnings_period" id="earnings_period" onchange="updateEarningsChart()">

            <option value="week">This Week</option>
            <option value="month" selected>This Month</option>
            <option value="year">This Year</option>

          </select>


        </div>

        <div class="chart-container mb-6">
          <div class="chart-bar" id="monday_data"></div>
          <div class="chart-label" id="monday_label">Mon</div>

          <div class="chart-bar" id="tuesday_data"></div>
          <div class="chart-label" id="tuesday_label">Tue</div>

          <div class="chart-bar" id="wednesday_data"></div>
          <div class="chart-label" id="wednesday_label">Wed</div>

          <div class="chart-bar" id="thursday_data"></div>
          <div class="chart-label" id="thursday_label">Thu</div>

          <div class="chart-bar" id="friday_data"></div>
          <div class="chart-label" id="friday_label">Fri</div>

          <div class="chart-bar" id="saturday_data"></div>
          <div class="chart-label" id="saturday_label">Sat</div>

          <div class="chart-bar" id="sunday_data"></div>
          <div class="chart-label" id="sunday_label">Sun</div>
        </div>



        <?php

        $totalAmount_month = getUserMonthlyTransactionAmount($con, $user_id);

        $percentageThisMonth = 0;

        if ($totalAmount > 0) {
          $percentageThisMonth = ($totalAmount_month / $totalAmount) * 100;
        }

        $percentageThisMonth = number_format($percentageThisMonth, 2);

        ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="glass-effect p-4 rounded-lg">
            <div class="flex justify-between items-center mb-2">
              <h4 class="font-semibold">Top Earning Service</h4>
              <span class="text-green-400">+<?php echo $percentageThisMonth ?>% ↑</span>
            </div>
            <div class="flex items-center">
              <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
              </div>

              <div>
                <div class="font-bold">Private Video Chat</div>
                <div class="text-sm text-white/60">$<?php echo $totalAmount_month ?> this month</div>
              </div>
            </div>
          </div>
          <div class="glass-effect p-4 rounded-lg">
            <div class="flex justify-between items-center mb-2">
              <h4 class="font-semibold">Most Popular Time</h4>
              <span class="text-blue-400">Consistent ↔</span>
            </div>
            <div class="flex items-center">
              <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>

              <?php
              $timeRange = getTopEarningTimeSlot($con, $user_id);
              $topDays = getTopEarningDays($con, $user_id);
              ?>
              <div>
                <div class="font-bold"><strong><?php echo $timeRange ?></strong></div>
                <div class="text-sm text-white/60"> <?php echo implode(" & ", $topDays); ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section service-last-form">
        <h3 class="text-xl font-bold gradient-text mb-6">Active Services</h3>

        <div class="token-info flex items-center mb-6">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token">
          <span>You currently have <b>2,500 TLM tokens</b> available for withdrawal. <a href="#" class="text-purple-400 underline" onclick="openWithdrawModal()">Withdraw to bank account</a></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 service-last-form-boxes">
          <!-- Chat Services -->
          <div class="glass-effect p-6 rounded-xl">
            <div class="flex justify-between items-center mb-4">
              <h4 class="text-lg font-bold">💬 Chat Services</h4>
              <div class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm">Active</div>
            </div>

            <div class="space-y-4">

              <?php if (!empty($extra_details) && !empty($extra_details['private_chat_token'])) { ?>

                <div class="flex justify-between items-center">
                  <div>
                    <div class="font-medium">Private Chat</div>
                    <div class="text-sm text-white/60">1-on-1 video chat</div>
                  </div>


                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    <span class="font-bold mr-2"><?php if (!empty($extra_details)) echo $extra_details['private_chat_token']; ?></span>
                    <span class="text-sm text-white/60">/hour</span>
                  </div>
                </div>

              <?php } ?>


              <?php if (!empty($extra_details) && !empty($extra_details['group_chat_tocken'])) { ?>

                <div class="flex justify-between items-center">
                  <div>
                    <div class="font-medium">Group Chat</div>
                    <div class="text-sm text-white/60">3+ viewers</div>
                  </div>


                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    <span class="font-bold mr-2"><?php if (!empty($extra_details)) echo $extra_details['group_chat_tocken']; ?></span>
                    <span class="text-sm text-white/60">/hour/person</span>
                  </div>

                </div>

              <?php } ?>

              <div class="flex justify-between items-center">
                <div>
                  <div class="font-medium">Text Chat</div>
                  <div class="text-sm text-white/60">Message-based chat</div>
                </div>
                <div class="flex items-center">
                  <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                  <span class="font-bold mr-2">50</span>
                  <span class="text-sm text-white/60">/message</span>
                </div>
              </div>
            </div>

            <div class="mt-6">
              <button class="btn-secondary w-full">Edit Chat Services</button>
            </div>
          </div>

          <!-- Meet Services -->
          <div class="glass-effect p-6 rounded-xl">
            <div class="flex justify-between items-center mb-4">
              <h4 class="text-lg font-bold">👥 Meet Services</h4>
              <div class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm">Active</div>
            </div>

            <div class="space-y-4">

              <?php if (!empty($extra_details) && !empty($extra_details['in_overnight'])) { ?>

                <div class="flex justify-between items-center">
                  <div>
                    <div class="font-medium">Social Meetup</div>
                    <div class="text-sm text-white/60">Local companionship</div>
                  </div>

                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    <span class="font-bold mr-2"><?php if (!empty($extra_details)) echo $extra_details['in_overnight']; ?></span>
                    <span class="text-sm text-white/60">/hour</span>
                  </div>

                </div>
              <?php } ?>

              <?php if (!empty($extra_details) && !empty($extra_details['extended_rate'])) { ?>

                <div class="flex justify-between items-center">
                  <div>
                    <div class="font-medium">Extended Social</div>
                    <div class="text-sm text-white/60">4+ hours</div>
                  </div>
                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    <span class="font-bold mr-2"><?php if (!empty($extra_details)) echo $extra_details['extended_rate']; ?></span>
                    <span class="text-sm text-white/60">flat rate</span>
                  </div>
                </div>
              <?php } ?>

              <?php if (!empty($extra_details) && !empty($extra_details['in_per_hour'])) { ?>

                <div class="flex justify-between items-center">
                  <div>
                    <div class="font-medium">Travel Companion</div>
                    <div class="text-sm text-white/60">Multi-day trips</div>
                  </div>
                  <div class="flex items-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    <span class="font-bold mr-2"><?php if (!empty($extra_details)) echo $extra_details['in_per_hour']; ?></span>
                    <span class="text-sm text-white/60">/day</span>
                  </div>
                </div>

              <?php } ?>


            </div>

            <div class="mt-6">
              <button class="btn-secondary w-full">Edit Meet Services</button>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="text-xl font-bold gradient-text mb-6">Upcoming Bookings</h3>

        <div class="overflow-x-auto">
          <table class="w-full edit-table">
            <thead>
              <tr class="text-left border-b border-white/10">
                <th class="pb-3 font-medium text-white/70">Date & Time</th>
                <th class="pb-3 font-medium text-white/70">Service</th>
                <th class="pb-3 font-medium text-white/70">Client</th>
                <th class="pb-3 font-medium text-white/70">Status</th>
                <th class="pb-3 font-medium text-white/70">Earnings</th>
                <th class="pb-3 font-medium text-white/70">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-white/5">
                <td class="py-4">
                  <div class="font-medium">Jun 5, 2025</div>
                  <div class="text-sm text-white/60">8:00 PM</div>
                </td>
                <td class="py-4">
                  <div class="font-medium">Private Chat</div>
                  <div class="text-sm text-white/60">30 min</div>
                </td>
                <td class="py-4">
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Client" class="w-8 h-8 rounded-full mr-2">
                    <span>Alex M.</span>
                  </div>
                </td>
                <td class="py-4">
                  <div class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm inline-block">Confirmed</div>
                </td>
                <td class="py-4">
                  <div class="flex items-center font-medium">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    375
                  </div>
                  <div class="text-sm text-white/60">Estimated</div>
                </td>
                <td class="py-4">
                  <button class="px-3 py-1 bg-white/10 hover:bg-white/20 rounded-lg text-sm">Details</button>
                </td>
              </tr>
              <tr class="border-b border-white/5">
                <td class="py-4">
                  <div class="font-medium">Jun 7, 2025</div>
                  <div class="text-sm text-white/60">7:30 PM</div>
                </td>
                <td class="py-4">
                  <div class="font-medium">Social Meetup</div>
                  <div class="text-sm text-white/60">Dinner</div>
                </td>
                <td class="py-4">
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/36.jpg" alt="Client" class="w-8 h-8 rounded-full mr-2">
                    <span>Michael T.</span>
                  </div>
                </td>
                <td class="py-4">
                  <div class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-full text-sm inline-block">Pending</div>
                </td>
                <td class="py-4">
                  <div class="flex items-center font-medium">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-removebg-preview-dPT8gwLMmuwlVIxJWaMYzDTERZWhZB.png" alt="TLM Token" class="tlm-token mr-1">
                    3000
                  </div>
                  <div class="text-sm text-white/60">Estimated</div>
                </td>
                <td class="py-4">
                  <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-green-500/20 hover:bg-green-500/30 text-green-400 rounded-lg text-sm">Accept</button>
                    <button class="px-3 py-1 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-lg text-sm">Decline</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Premium & Privacy Tab -->
    <div id="premium-content" class="tab-content">
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold gradient-text mb-4">Premium & Privacy Settings</h2>
        <p class="text-white/70">Control your visibility, search preferences, and premium features</p>
      </div>

      <!-- Privacy Options -->
      <div class="form-section">
        <h3 class="text-xl font-bold gradient-text mb-6">🔒 Privacy Options</h3>

        <?php

        $privacy_setting =  getModelPrivacySettings($userDetails['unique_id']);
		
		$premium_check = CheckPremiumAccess($userDetails['id']);
        ?>
        <div class="space-y-6">
          <!-- Search Control -->
          <div>
            <h4 class="text-lg font-semibold mb-4">Search Control</h4>
            <p class="text-white/70 text-sm mb-4">The following groups of people are able to see your profile in search and send you messages:</p>

            <div class="space-y-4">
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Males looking for Females</label>
                <label class="toggle-switch">
                  <input type="checkbox" value="Y" <?php if ($privacy_setting['male_to_female']) { ?> checked <?php } ?> onchange="updateSettings(this,'male_to_female')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Males looking for Males</label>
                <label class="toggle-switch">
                  <input type="checkbox" value="Y" <?php if ($privacy_setting['male_to_male']) { ?> checked <?php } ?> onchange="updateSettings(this,'male_to_male')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Females looking for Males</label>
                <label class="toggle-switch">
                  <input type="checkbox" value="Y" <?php if ($privacy_setting['female_to_male']) { ?> checked <?php } ?> onchange="updateSettings(this,'female_to_male')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Females looking for Females</label>
                <label class="toggle-switch">
                  <input type="checkbox" value="Y" <?php if ($privacy_setting['female_to_female']) { ?> checked <?php } ?> onchange="updateSettings(this,'female_to_female')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Transgender</label>
                <label class="toggle-switch">
                  <input type="checkbox" value="Y" <?php if ($privacy_setting['transgender']) { ?> checked <?php } ?> onchange="updateSettings(this,'transgender')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>
          </div>

          <!-- Location Privacy -->
         
        </div>
      </div>

      <!-- Premium Features -->
      <div class="form-section">
        <h3 class="text-xl font-bold gradient-text mb-6">👑 Premium Features</h3>

        <div class="space-y-6">

         <div>
            <h4 class="text-lg font-semibold mb-4">Location Privacy</h4>
            <div class="space-y-4 lock-pri">
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">🇹🇭 Thailand Users Only</label>
                  <p class="text-sm text-white/60">Hide your profile from people who aren't in Thailand right now.</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" value="Y" <?php if ($privacy_setting['country_enable']) { ?> checked <?php } ?> onchange="updateSettings(this,'country_enable')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>
          </div>

          <!-- Profile Visibility -->
          <div>
            <h4 class="text-lg font-semibold mb-4">Profile Visibility</h4>
            <div class="space-y-4 profit-vis">
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">👑 Show Me in Search</label>
                  <p class="text-sm text-white/60">Include your profile in the search results.</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" <?php if ($privacy_setting['profile_visibility']) { ?> checked <?php } ?> onchange="updateSettings(this,'profile_visibility')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">🎯 Apply Age Range</label>
                  <p class="text-sm text-white/60">Only show my profile to people who match my age range</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" <?php if ($privacy_setting['apply_age_range']) { ?> checked <?php } ?> onchange="updateSettings(this,'apply_age_range')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

            <div class="mt-4">

              <label class="form-label">Age Range</label>

              <div class="flex items-center space-x-4 age-range">

                <span class="text-sm">18</span>

                <?php 

                  $age_range = $privacy_setting['age_range'] ??18;

                  if($age_range == 65)
                  {
                    $age_range = $age_range.'+';
                  }

                ?>
                <input type="range" min="18" max="65" value="<?php echo $privacy_setting['age_range'] ?? 18  ?>" class="flex-1 accent-purple-500" oninput="updateAgeDisplay(this)" onchange="updateSettings(this,'age_range')">
                <span class="text-sm" id="age_value_display"> <?php echo $age_range ?></span>
              </div>
            </div>
          </div>

          <!-- Message Privacy -->
          <div>
            <h4 class="text-lg font-semibold mb-4">Message Privacy</h4>
            <div class="space-y-4 mmsge-priva">
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">📧 Send Read Receipts</label>
                  <p class="text-sm text-white/60">Choose if others can know you read the message or not</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" <?php if ($privacy_setting['read_receipt']) { ?> checked <?php } ?> onchange="updateSettings(this,'read_receipt')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">👀 Show My Visits</label>
                  <p class="text-sm text-white/60">When you visit someone's profile they will see that you are looking if this is enabled.</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" <?php if ($privacy_setting['show_visit']) { ?> checked <?php } ?> onchange="updateSettings(this,'show_visit')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">⏰ Appear Offline</label>
                  <p class="text-sm text-white/60">When you appear offline your last active time will stop updating.</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" <?php if ($privacy_setting['appear_offline']) { ?> checked <?php } ?> onchange="updateSettings(this,'appear_offline')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <label class="form-label mb-0">📅 Show My Join Date</label>
                  <p class="text-sm text-white/60">Control if other users can see when you joined.</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" <?php if ($privacy_setting['show_join_date']) { ?> checked <?php } ?> onchange="updateSettings(this,'show_join_date')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>
          </div>

          <!-- Message Priority -->
          <div class="bg-purple-500/10 border border-purple-500/30 rounded-lg p-4">
            <div class="flex justify-between items-center mb-4 msg-priority">
              <div>
                <h4 class="text-lg font-semibold text-purple-400">📬 Message Priority</h4>
                <p class="text-sm text-white/70">Your messages will appear at the top of recipients inboxes - ahead of free members messages. This greatly increases your chance of a reply.</p>
              </div>
              <label class="toggle-switch advance-tog-page">
                <input type="checkbox" checked>
                <span class="toggle-slider"></span>
              </label>
            </div>
          </div>

          <!-- Advanced Search Filters -->
          <div class="<?php if($premium_check == false){ echo 'premiumcheck'; } ?>" >
            <h4 class="text-lg font-semibold mb-4">🔍 Advanced Search Filters</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 advans-fit">
              <div>
                <label class="form-label">Height Range</label>
                <div class="flex items-center space-x-4">
                  <span class="text-sm">120cm</span>
                  <input type="range" min="120" max="200" value="<?php echo $privacy_setting['height_range'] ?? 170  ?>" class="flex-1 accent-purple-500" oninput="updateHeightDisplay(this)" onchange="updateSettings(this,'height_range')">
                  <span class="text-sm"><span id="height_value_display"><?php echo $privacy_setting['height_range'] ?? 120  ?></span>cm</span>
                </div>
              </div>
              <div>
                <label class="form-label">Weight Range</label>
                <div class="flex items-center space-x-4">
                  <span class="text-sm">30kg</span>
                  <input type="range" min="30" max="150" value="<?php echo $privacy_setting['weight_range'] ?? 60  ?>" class="flex-1 accent-purple-500" oninput="updateWeightDisplay(this)" onchange="updateSettings(this,'weight_range')">
                  <span class="text-sm"><span id="weight_value_display"><?php echo $privacy_setting['weight_range'] ?? 60  ?></span>kg</span>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
              <div>
                <label class="form-label">Children Preference</label>
                <select class="form-select" name="children_preference" onchange="updateSettings(this,'children_preference')">
                  <option value="">Any</option>
                  <option value="no-children" <?php if ($privacy_setting['children_preference'] =='no-children') { ?> selected <?php } ?> >No Children</option>
                  <option value="wants-children" <?php if ($privacy_setting['children_preference'] =='wants-children') { ?> selected <?php } ?> >Wants Children</option>
                  <option value="has-children" <?php if ($privacy_setting['children_preference'] =='has-children') { ?> selected <?php } ?> >Has Children</option>
                </select>
              </div>
              <div>
                <label class="form-label">Education Level</label>
                <select class="form-select" name="education_level" onchange="updateSettings(this,'education_level')" >
                  <option value="">Any</option>
                  <option value="high-school" <?php if ($privacy_setting['education_level'] =='high-school') { ?> selected <?php } ?> >High School</option>
                  <option value="college" <?php if ($privacy_setting['education_level'] =='college') { ?> selected <?php } ?> > College</option>
                  <option value="university" <?php if ($privacy_setting['education_level'] =='university') { ?> selected <?php } ?> >University</option>
                  <option value="graduate"  <?php if ($privacy_setting['education_level'] =='graduate') { ?> selected <?php } ?>>Graduate Degree</option>
                  <option value="masters" <?php if ($privacy_setting['education_level'] =='masters') { ?> selected <?php } ?>>Masters</option>
                  <option value="phd" <?php if ($privacy_setting['education_level'] =='phd') { ?> selected <?php } ?> >PhD</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Experimental Features -->
          <div>
            <h4 class="text-lg font-semibold mb-4">🧪 Experimental Features</h4>
            <div class="space-y-4">

              <!-- <div class="flex justify-between items-center exprt">
                <div>
                  <label class="form-label mb-0">🤖 Auto Message Likes</label>
                  <p class="text-sm text-white/60">Automatically send a message to people when you like them in browse.</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox">
                  <span class="toggle-slider"></span>
                </label>
              </div> -->

              <div class="mt-4">
                <label class="form-label">Auto Message Template</label>
                <textarea class="form-input" rows="3" onchange="updateSettings(this,'message_template')" name="message_template" placeholder="The following message will be sent when you like someone from browse..."><?php echo $privacy_setting['message_template'] ?></textarea>
                <p class="help-text">If username appears in the message it will be replaced with their username</p>
              </div>
            </div>
          </div>

          <!-- Verified Photos -->
          <div>
            <h4 class="text-lg font-semibold mb-4">✅ Search Preferences</h4>
            <div class="space-y-4">
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Verified Photos Only</label>
                <label class="toggle-switch">
                  <input type="checkbox"  name="verified_photos" <?php if ($privacy_setting['verified_photos']) { ?> checked <?php } ?>  onchange="updateSettings(this,'verified_photos')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Exclude messaged already</label>
                <label class="toggle-switch">
                  <input type="checkbox" name="exclude_message_already"  <?php if ($privacy_setting['exclude_message_already']) { ?> checked <?php } ?>  onchange="updateSettings(this,'exclude_message_already')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="flex justify-between items-center">
                <label class="form-label mb-0">Show only who liked me</label>
                <label class="toggle-switch">
                  <input type="checkbox" name="show_liked"  <?php if ($privacy_setting['show_liked']) { ?> checked <?php } ?>  onchange="updateSettings(this,'show_liked')">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="flex justify-center mt-8">
        <button class="btn-primary text-lg px-8 py-2" onclick="savePremiumSettings()">Save Premium Settings</button>
      </div>
    </div>
  </main>



  <div class="modal-overlay" id="success_modal">
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Success</h2>
        <button class="close-modal" id="closeTipModal" type="button" onclick="CloseModal()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body" id="modal_success_message">


        <button class="btn btn-primary" type="button" onclick="CloseModal()">Close</button>
      </div>
    </div>
  </div>


    <div class="modal-overlay" id="conform_broad_cast" >
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Confirmation</h2>
        <button class="close-modal" id="closeTipModal" type="button" onclick="ConformCloseModal()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
              viewBox="0 0 24 24" fill="none" stroke="currentColor" 
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body" id="">
        <p>Do you want to become a broadcaster?</p>

        <div style="margin-top:15px; display:flex; gap:10px; justify-content:center;">

          <button class="btn-primary px-7 sm:px-3 py-6  text-white" type="button" onclick="confirmBroadcaster()">Yes</button>

          <button class="btn btn-secondary" type="button" onclick="ConformCloseModal()">No</button>

        </div>
      </div>
    </div>
  </div>
  
  <div class="modal-overlay" id="premium_modal">
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Access Restricted!</h2>
        <button class="close-modal" id="closeTipModal" type="button" onclick="ClosePremiumModal()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body">

		<p class="premiumtext">You are not a premium member.</p>

        <button class="btn btn-primary" type="button" onclick="ClosePremiumModal()">Close</button>
      </div>
    </div>
  </div>
  
  <div class="modal-overlay" id="follow_modal">
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Access Restricted!</h2>
        <button class="close-modal" id="closeTipModal" type="button" onclick="ClosefollowModal()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body">

		<p class="premiumtext">Can't access to this tab once the creator reaches 1000 followers.</p>

        <button class="btn btn-primary" type="button" onclick="ClosefollowModal()">Close</button>
      </div>
    </div>
  </div>


  <?php include('includes/footer.php'); ?>
  <script>
    function select_hs_country(state) {
      $("#i-hs-city").html('<option value="">Select</option>');
      $("#i-hs-state").html('<option value="">Select</option>');
      var country = $('#i-hs-country').val();
      //	var country = $('#i-hs-country :selected').attr('data-id');
      $.ajax({
        url: '<?= SITEURL . 'ajax/state.php' ?>',
        type: 'get',
        data: {
          country: country,
          selected: state,
          option: ''
        },
        dataType: 'json',
        success: function(res) {
          $("#i-hs-state").html('<option value="">Select</option>' + res.list);
          select_hs_state('<?= $userDetails['city'] ?>');
        }
      })
    }

    function select_hs_state(city) {
      $("#i-hs-city").html('<option value="">Select</option>');
      var state = $('#i-hs-state').val();
      $.ajax({
        url: '<?= SITEURL . 'ajax/city.php' ?>',
        type: 'get',
        data: {
          selected: city,
          state: state,
          option: ''
        },
        dataType: 'json',
        success: function(res) {
          $("#i-hs-city").html('<option value="">Select</option>' + res.list);
        }
      })
    }

    select_hs_country('<?= $userDetails['state'] ?>');
  </script>

  <script>
    let currentWeightUnit = 'lbs';
    let currentHeightUnit = 'ft';
    let socialLinkCounter = 5;

    const countryToCities = {
      'us': ['San Francisco', 'Los Angeles', 'New York City', 'Miami', 'Chicago', 'Austin', 'Seattle', 'Boston', 'Denver', 'Atlanta'],
      'ca': ['Toronto', 'Vancouver', 'Montreal', 'Calgary', 'Ottawa', 'Edmonton', 'Winnipeg', 'Quebec City'],
      'uk': ['London', 'Manchester', 'Birmingham', 'Liverpool', 'Leeds', 'Sheffield', 'Bristol', 'Newcastle'],
      'au': ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Gold Coast', 'Canberra', 'Darwin'],
      'de': ['Berlin', 'Munich', 'Hamburg', 'Cologne', 'Frankfurt', 'Stuttgart', 'Düsseldorf', 'Dortmund'],
      'fr': ['Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice', 'Nantes', 'Strasbourg', 'Montpellier'],
      'jp': ['Tokyo', 'Osaka', 'Kyoto', 'Yokohama', 'Kobe', 'Nagoya', 'Sapporo', 'Fukuoka'],
      'br': ['São Paulo', 'Rio de Janeiro', 'Brasília', 'Salvador', 'Fortaleza', 'Belo Horizonte', 'Manaus', 'Curitiba'],
      'mx': ['Mexico City', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'León', 'Juárez', 'Zapopan'],
      'it': ['Rome', 'Milan', 'Naples', 'Turin', 'Palermo', 'Genoa', 'Bologna', 'Florence'],
      'es': ['Madrid', 'Barcelona', 'Valencia', 'Seville', 'Zaragoza', 'Málaga', 'Murcia', 'Palma'],
      'nl': ['Amsterdam', 'Rotterdam', 'The Hague', 'Utrecht', 'Eindhoven', 'Tilburg', 'Groningen', 'Almere'],
      'se': ['Stockholm', 'Gothenburg', 'Malmö', 'Uppsala', 'Västerås', 'Örebro', 'Linköping', 'Helsingborg'],
      'no': ['Oslo', 'Bergen', 'Stavanger', 'Trondheim', 'Drammen', 'Fredrikstad', 'Kristiansand', 'Sandnes'],
      'dk': ['Copenhagen', 'Aarhus', 'Odense', 'Aalborg', 'Esbjerg', 'Randers', 'Kolding', 'Horsens']
    };

    function switchTab(tabName) {
      // Hide all tab contents
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
      });

      // Remove active class from all tab buttons
      document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
      });

      // Show selected tab content
      const selectedContent = document.getElementById(tabName + '-content');
      if (selectedContent) {
        selectedContent.classList.add('active');
      }

      // Add active class to selected tab button
      const selectedButton = document.getElementById(tabName + '-tab');
      if (selectedButton) {
        selectedButton.classList.add('active');
      }

      // Update progress bar if on creator tab
      if (tabName === 'creator') {
        updateProgress();
      }
    }

    function toggleCollapsible(element) {
      const content = element.nextElementSibling;
      const icon = element.querySelector('.collapsible-icon');

      if (content && icon) {
        content.classList.toggle('open');
        icon.classList.toggle('open');
      }

      // Update progress when sections are opened/closed
      updateProgress();
    }

    function toggleConditionalSection(id, show = true) {
      const section = document.getElementById(id);
      if (section) {
        if (show) {
          section.classList.add('show');
        } else {
          section.classList.remove('show');
        }
        updateProgress();
      }
    }

    function updateProgress() {
      let completedSections = 0;
      const totalSections = 5;
      const sections = ['chat-services', 'meet-services', 'content-creation', 'professional-work','30_days_access', 'physical-attributes'];
      const steps = document.querySelectorAll('.step');

      sections.forEach((sectionId, index) => {
        const section = document.getElementById(sectionId);
        if (section) {
          // const inputs = section.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked, input[type="text"][value!=""], input[type="number"][value!=""], select[value!=""]');

          const inputs = section.querySelectorAll(
            'input[type="radio"]:checked, input[type="checkbox"]:checked, input[type="text"], input[type="number"], select'
          );
          let hasValues = false;

          inputs.forEach(input => {
            if (input.type === 'radio' && input.checked && input.value !== 'no') hasValues = true; // Consider 'no' as incomplete for some logic
            else if (input.type === 'checkbox' && input.checked) hasValues = true;
            else if ((input.type === 'text' || input.type === 'number') && input.value.trim() !== '') hasValues = true;
            else if (input.tagName === 'SELECT' && input.value !== '') hasValues = true;
          });

          if (hasValues && steps[index]) {
            completedSections++;
            steps[index].classList.add('completed');
            steps[index].classList.remove('active');
          } else if (steps[index]) {
            steps[index].classList.remove('completed');
          }
        }
      });

      const progress = (completedSections / totalSections) * 100;
      const progressFill = document.querySelector('.progress-fill');
      if (progressFill) {
        progressFill.style.width = `${progress}%`;
      }
    }

    function scrollToSection(sectionId) {
      const section = document.getElementById(sectionId);
      if (section) {
        section.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });

        const header = section.querySelector('.collapsible-header');
        const content = section.querySelector('.collapsible-content');
        if (header && content && !content.classList.contains('open')) {
          toggleCollapsible(header);
        }

        document.querySelectorAll('.step').forEach(step => step.classList.remove('active'));
        const stepIndex = ['chat-services', 'meet-services', 'content-creation', 'professional-work','30_days_access', 'physical-attributes'].indexOf(sectionId);
        if (stepIndex !== -1) {
          const currentStep = document.querySelectorAll('.step')[stepIndex];
          if (currentStep) currentStep.classList.add('active');
        }
      }
    }

    function toggleMessages() {
      const dropdown = document.getElementById('messages-dropdown');
      if (dropdown) dropdown.classList.toggle('hidden');
    }

    function goToServices() {
      switchTab('services');
    }

    function toggleWeightUnit(unit, event) {
      currentWeightUnit = unit;
      const weightInput = document.getElementById('weight-input');
      const unitToggle = document.getElementById('unit-togglew');

      if (unitToggle) {
        unitToggle.querySelectorAll('.unit-option').forEach(option => {
          option.classList.remove('active');
        });
        //event.target.classList.add('active');
      }
      jQuery('.' + currentWeightUnit + '-option').addClass('active');
      jQuery('#weight_type').val(currentWeightUnit);

      if (weightInput) {
        const currentValue = parseFloat(weightInput.value) || 0;
        if (unit === 'kg' && currentWeightUnit !== 'kg') {
          weightInput.value = Math.round(currentValue * 0.453592);
          weightInput.placeholder = 'Weight in kg';
        } else if (unit === 'lbs' && currentWeightUnit !== 'lbs') {
          weightInput.value = Math.round(currentValue * 2.20462);
          weightInput.placeholder = 'Weight in lbs';
        }
      }
      currentWeightUnit = unit; // Update after conversion
    }

    function toggleHeightUnit(unit, event) {
      currentHeightUnit = unit;
      const heightFtDiv = document.getElementById('height-ft');
      const heightCmDiv = document.getElementById('height-cm');
      const unitToggle = document.getElementById('unit-toggleh');

      if (unitToggle) {
        unitToggle.querySelectorAll('.unit-option').forEach(option => {
          option.classList.remove('active');
        });
        //event.target.classList.add('active');
      }
      jQuery('.' + currentHeightUnit + '-option').addClass('active');
      jQuery('#height_type').val(currentHeightUnit);
      if (heightFtDiv && heightCmDiv) {
        if (unit === 'cm') {
          heightFtDiv.classList.add('hidden');
          heightCmDiv.classList.remove('hidden');
        } else {
          heightFtDiv.classList.remove('hidden');
          heightCmDiv.classList.add('hidden');
        }
      }
    }

    function calculateAge() {
      const dobInput = document.getElementById('dob-input');
      const ageDisplay = document.getElementById('age-display');

      if (dobInput && dobInput.value && ageDisplay) {
        const dob = new Date(dobInput.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
          age--;
        }
        ageDisplay.value = age;
      }
    }

    function updateCities() {
      const countrySelect = document.getElementById('country-select');
      const citySelect = document.getElementById('city-select');

      if (countrySelect && citySelect) {
        const selectedCountry = countrySelect.value;
        citySelect.innerHTML = '<option value="">Select your city</option>'; // Clear existing options

        if (selectedCountry && countryToCities[selectedCountry]) {
          countryToCities[selectedCountry].forEach(city => {
            const option = document.createElement('option');
            option.value = city.toLowerCase().replace(/\s+/g, '-');
            option.textContent = city;
            citySelect.appendChild(option);
          });
        } else if (selectedCountry === 'other') {
          const option = document.createElement('option');
          option.value = 'other';
          option.textContent = 'Other (specify in bio)';
          citySelect.appendChild(option);
        }
      }
    }

    function toggleInterest(element) {
      if (element) element.classList.toggle('selected');
      updateProfileCompletion();
    }

    function toggleAccess(element, type, cls) {
      const parent = element.parentElement;
      if (parent) {
        parent.querySelectorAll('.access-option').forEach(option => {
          option.classList.remove('active');
        });
        element.classList.add('active');
      }
      jQuery('.' + cls).val(type);

      // Get the nearest .access-toggle container
      const container = element.closest('.access-toggle');
      // Handle the paid_token input visibility and value
      const tokenInput = container.querySelector('.paid_token');
      if (type === 'paid') {
        tokenInput.classList.remove('hidden');
        tokenInput.value = ""; // 👈 Set your desired token value here
      } else {
        tokenInput.classList.add('hidden');
        tokenInput.value = ""; // Clear the value when not needed
      }

    }

    function addSocialLink() {
      socialLinkCounter++;
      const container = document.getElementById('social-links-container');
      if (container) {
        const newSocialLink = document.createElement('div');
        newSocialLink.className = 'social-link-item';
        newSocialLink.innerHTML = `
            <div class="social-icon" style="background: #6b7280;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            </div>
            <div class="social-content">
            <input type="text" name="platform[]" class="social-platform-input" placeholder="Platform name (e.g., YouTube, LinkedIn)">
            <input type="url" name="URL[]"  class="social-url-input" placeholder="Profile URL">
			<input type="hidden" name="socialid[]" value="" >
            </div>
            <div class="social-controls">
            <div class="access-toggle">
                <div class="access-option free active" onclick="toggleAccess(this, 'free','ext` + socialLinkCounter + `')">Free</div>
                <div class="access-option paid" onclick="toggleAccess(this, 'paid','ext` + socialLinkCounter + `')">Paid</div>
				<input type="hidden" name="status[]" class="ext` + socialLinkCounter + `" value="free">
				<input type="text" class="paid_token social-platform-input hidden" value="" name="paid_token[]" placeholder="Enter token amount">
            </div>
            <label class="toggle-switch">
                <input type="checkbox" name="public[]" value="yes">
                <span class="toggle-slider"></span>
            </label>
            <span class="text-xs text-white/60">Public</span>
            <button class="btn-remove-social" onclick="removeSocialLink(this)">×</button>
            </div>
        `;
        const addButton = container.nextElementSibling; // Assuming add button is immediately after container
        /* if (addButton) {
             container.parentNode.insertBefore(newSocialLink, addButton);
         } else {*/
        container.appendChild(newSocialLink); // Fallback if no add button found
        //}
      }
    }

    function removeSocialLink(button) {
      if (button) button.closest('.social-link-item').remove();
      updateProfileCompletion();
    }

    function addLanguage() {
      const container = document.getElementById('languages-container');
      if (container) {

        const newLanguage = document.createElement('div');
        newLanguage.className = 'language-item';
        newLanguage.innerHTML = `
            <select class="language-select" name="modal_lang[]">
            <option value="">Select language</option>
			<?php foreach ($lang_list as $val) { ?>
					<option value="<?= $val ?>"><?= $val ?></option>
			  <?php } ?>
            </select>
            <select class="proficiency-select" name="proficiency[]">
            <option value="">Proficiency</option>
            <option value="Native">Native</option>
            <option value="Fluent">Fluent</option>
            <option value="Conversational">Conversational</option>
            <option value="Basic">Basic</option>
            </select>
            <button class="btn-remove-social" onclick="removeLanguage(this)">×</button>
        `;
        container.appendChild(newLanguage);

      }
    }

    function removeLanguage(button) {
      if (button) button.parentElement.remove();
    }

    function addHobbies() {
      const container = document.getElementById('hobbies-container');
      if (container) {

        const newHobbies = document.createElement('div');
        newHobbies.className = 'hobbies-item';
        newHobbies.innerHTML = `
            <input type="text" name="additional_hobbies[]" class="add-hobbies-input social-url-input" value="">	
			<button class="btn-remove-hb btn-remove-social" onclick="removeHobbies(this)">×</button>
        `;
        container.appendChild(newHobbies);

      }
    }

    function removeHobbies(button) {
      if (button) button.parentElement.remove();
    }

    function updateProfileCompletion(button) {
      let completedFields = 0;
      let totalFields = 0;

      const basicFields = ['#uname', '#dob-input', '#age-display'];
      basicFields.forEach(selector => {
        totalFields++;
        const field = document.querySelector(selector);
        if (field && field.value) completedFields++;
      });

      totalFields++;
      const bio = document.querySelector('textarea[name*="user_bio"]');
      if (bio && bio.value.length > 50) completedFields++;

      totalFields += 2;
      const country = document.getElementById('country-select');
      const city = document.getElementById('city-select');
      if (country && country.value) completedFields++;
      if (city && city.value) completedFields++;

      totalFields++;
      const socialLinks = document.querySelectorAll('#social-links-container .social-url-input');
      let filledSocialLinks = 0;
      socialLinks.forEach(input => {
        if (input.value) filledSocialLinks++;
      });
      if (filledSocialLinks >= 3) completedFields++;

      totalFields++;
      const selectedInterests = document.querySelectorAll('.interest-tag.selected');
      if (selectedInterests.length >= 5) completedFields++;

      totalFields++;
      const languages = document.querySelectorAll('#languages-container .language-select');
      let filledLanguages = 0;
      languages.forEach(select => {
        if (select.value) filledLanguages++;
      });
      if (filledLanguages >= 1) completedFields++; // At least one language

      const percentage = totalFields > 0 ? Math.round((completedFields / totalFields) * 100) : 0;

      const completionPercentageEl = document.querySelector('.completion-percentage');
      const completionFillEl = document.querySelector('.completion-fill');
      const helpTextEl = document.querySelector('.profile-completion p:last-child');

      if (completionPercentageEl) completionPercentageEl.textContent = `${percentage}%`;
      if (completionFillEl) completionFillEl.style.width = `${percentage}%`;

      if (helpTextEl) {
        if (percentage >= 100) {
          helpTextEl.textContent = '🎉 Profile complete! You\'re ready to attract clients';
          helpTextEl.className = 'text-xs text-green-400';
        } else if (percentage >= 80) {
          helpTextEl.textContent = 'Almost there! Add a few more details to complete your profile';
          helpTextEl.className = 'text-xs text-yellow-400';
        } else {
          helpTextEl.textContent = 'Add more social links and interests to reach 100%';
          helpTextEl.className = 'text-xs text-white/60';
        }
      }
    }
	
	function updateProfileCompletionNew(button) {
		
		let completedFields = 0;
      let totalFields = 0;

      const basicFields = ['#uname', '#dob-input', '#age-display'];
      basicFields.forEach(selector => {
        totalFields++;
        const field = document.querySelector(selector);
        if (field && field.value) completedFields++;
      });
	  totalFields += 3;    
      const country = document.getElementById('i-hs-country');
      const state = document.getElementById('i-hs-state');
	  const city = document.getElementById('i-hs-city');
      if (country && country.value) completedFields++;
	  if (state && state.value) completedFields++;
      if (city && city.value) completedFields++;
	  
		if(totalFields == completedFields){
			  const $button = $(button);
			  const originalText = $button.text();

			  $button.text('Saving...');
			  $button.prop('disabled', true);

			  const form = $('#basicProfileForm')[0];

			  const formData = new FormData(form);

			  formData.append('submit_name', 'submit_name');

			  $.ajax({
				url: 'act-edit-profile.php',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(response) {

				  console.log(response);

				  if (response.status === 'success') {
					$('.progress-fill').css('width', '100%');
					$('.step').addClass('completed').removeClass('active');

					setTimeout(() => {
					  $button.text(originalText);
					  $button.prop('disabled', false);

					  $('#modal_success_message').prepend('<p class="success-text">Your settings have been saved successfully!</p>');

					  $('#success_modal').addClass('active');

					}, 1000);
				  }
				},

				error: function(xhr, status, error) {
				  $button.text(originalText);
				  $button.prop('disabled', false);
				}
			  });
		}else{
			showNotification('Please fill required fields', 'error');
		}
	}

    function openBuyTokensModal() {
      const modal = document.getElementById('buy-tokens-modal');
      if (modal) modal.classList.remove('hidden');
    }

    function closeBuyTokensModal() {
      const modal = document.getElementById('buy-tokens-modal');
      if (modal) modal.classList.add('hidden');
    }

    function updateTokenPackage(tokens, price) {
      const selectedTokensEl = document.getElementById('selected-tokens');
      const selectedPriceEl = document.getElementById('selected-price');
      if (selectedTokensEl) selectedTokensEl.textContent = `${tokens}`;
      if (selectedPriceEl) selectedPriceEl.textContent = `$${price}.00`;
    }

    function processPurchase(event) {
      const button = event.target;
      button.textContent = 'Processing...';
      button.disabled = true;

      setTimeout(() => {
        alert('✅ Token purchase successful! Your TLM tokens have been added to your account.');
        closeBuyTokensModal();
        button.textContent = 'Purchase Tokens';
        button.disabled = false;

        const tokenDisplay = document.querySelector('.token-amount');
        const selectedTokensEl = document.getElementById('selected-tokens');
        if (tokenDisplay && selectedTokensEl) {
          const currentTokens = parseInt(tokenDisplay.textContent.replace(/,/g, '')) || 0;
          const selectedTokens = parseInt(selectedTokensEl.textContent) || 0;
          const newTotal = currentTokens + selectedTokens;
          tokenDisplay.textContent = newTotal.toLocaleString();
        }
      }, 2000);
    }

    function openWithdrawModal() {
      const modal = document.getElementById('withdraw-modal');
      if (modal) modal.classList.remove('hidden');
    }

    function closeWithdrawModal() {
      const modal = document.getElementById('withdraw-modal');
      const withdrawAmountInput = document.getElementById('withdraw-amount');
      const withdrawUsdInput = document.getElementById('withdraw-usd');

      if (modal) modal.classList.add('hidden');
      if (withdrawAmountInput) withdrawAmountInput.value = '';
      if (withdrawUsdInput) withdrawUsdInput.value = '';
    }

    function updateWithdrawUSD(el) {
		
		const min = parseInt(el.dataset.min, 10);
        const max = parseInt(el.dataset.max, 10);
        const value = parseInt(el.value, 10);
		
		const errorSpan = document.getElementById("amount_error");

            if (isNaN(value)) {
                errorSpan.style.display = "block";
                errorSpan.textContent = "Please enter a valid number.";
                return;
            }
		
      const amountInput = document.getElementById('withdraw-amount');
      const usdInput = document.getElementById('withdraw-usd');
      if (amountInput && usdInput) {
        const amount = parseFloat(amountInput.value) || 0;
        const usdValue = (amount * 0.1).toFixed(2); // 1 token = $0.10
        usdInput.value = `$${usdValue}`;
      }
	  
	  if (value < min || value > max) {
                errorSpan.style.display = "block";
                errorSpan.textContent = `Amount must be between ${min} and ${max}.`;
            } else {
                errorSpan.style.display = "none";
                errorSpan.textContent = "";
            }
	  
    }
	
	function rejectWithdraw() {
        event.preventDefault();
        showNotification('You already sent request. Please wait for pending request', 'error');
    }

    function processWithdrawal(event) {
      const amountInput = document.getElementById('withdraw-amount');
	  var status = true;
      if (!amountInput){
		  status = false;
		  return;
	  }

      const amount = parseFloat(amountInput.value);
	  
	    const min = parseInt(amountInput.dataset.min, 10);
        const max = parseInt(amountInput.dataset.max, 10);
	  
      if (!amount || amount < min) {
        //alert('Minimum withdrawal amount is 100 TLM tokens');
		showNotification('Minimum withdrawal amount is 100 TLM tokens', 'error');
		status = false;
        return;
      }
      // Assuming current balance is 2500 for this example
      if (amount > max) {
       // alert('Insufficient balance');
	   showNotification('Insufficient balance', 'error');
		status = false;
        return;
      }

	if(status == true){
     // const button = event.target;
	  const button = document.getElementById('withdraw_btn');
      button.textContent = 'Processing...';
      button.disabled = true;
	  
	  $.ajax({
                type: 'POST',
                url: "act-wallet.php",
                data: {

                    coin:amount,
                    action:'submit_withdrawal',
                },
                dataType: 'json',
                success: function(response) {

                     if (response.status === 'success') {
                       
                        

                        setTimeout(function()
                        {
							showNotification(response.message, 'success');
                            //alert('✅ Withdrawal request submitted successfully! You will receive your funds within 2-3 business days.');
							closeWithdrawModal();
							button.textContent = 'Withdraw';
							button.disabled = false;
                            
                        },3000);
                        

                    } else {

                         showNotification(response.message, 'error');
                    }
                }
            });
	}
      /*setTimeout(() => {
        alert('✅ Withdrawal request submitted successfully! You will receive your funds within 2-3 business days.');
        closeWithdrawModal();
        button.textContent = 'Withdraw';
        button.disabled = false;
      }, 2000); */
    }

    function AccessChange(element)
    {
        var value = $(element).val(); 

        if (value === 'Yes') {
            $('.all_access_coin').show();
        } else {
            $('.all_access_coin').hide();
        }
    }

    function CreateSetting()
    {
        $('#conform_broad_cast').addClass('active');
    }

    function confirmBroadcaster()
    {
        switchTab('creator');

        $('#conform_broad_cast').removeClass('active');

        $('#creator-content').show();
    }
     

    function saveCreatorSettings(button) {

      const $button = $(button);
      const originalText = $button.text();

      $button.text('Saving...');
      $button.prop('disabled', true);

      const form = $('#creatorSettingsForm')[0];

      const formData = new FormData(form);

      formData.append('service_submit', 'service_submit');

      $.ajax({
        url: 'act-edit-profile.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {

          console.log(response);

          if (response.status === 'success') {
            $('.progress-fill').css('width', '100%');
            $('.step').addClass('completed').removeClass('active');

            setTimeout(() => {
              $button.text(originalText);
              $button.prop('disabled', false);

              $('#modal_success_message').prepend('<p class="success-text">Your settings have been saved successfully!</p>');

              $('#success_modal').addClass('active');

            }, 1000);
          }
        },

        error: function(xhr, status, error) {
          $button.text(originalText);
          $button.prop('disabled', false);
        }
      });
    }

    function ConformCloseModal() {

      $('#conform_broad_cast').removeClass('active');
    }


    function CloseModal() {
      $('#success_modal').removeClass('active');
      $('#modal_success_message .success-text').remove();
    }
	
	function  ClosePremiumModal() {
      $('#premium_modal').removeClass('active');
    }
	
	function  ClosefollowModal() {
      $('#follow_modal').removeClass('active');
    }

    function savePremiumSettings(event) {

      showNotification('Privacy Settings Updated');
      // const button = event.target;
      // const originalText = button.textContent;
      // button.textContent = 'Saving...';
      // button.disabled = true;

      // setTimeout(() => {
      //   alert('✅ Premium & Privacy settings saved successfully!');
      //   button.textContent = originalText;
      //   button.disabled = false;
      // }, 1500);
    }

    document.addEventListener('DOMContentLoaded', function() {
      calculateAge();
      updateProfileCompletion();

      const firstCollapsibleHeader = document.querySelector('#creator-content .collapsible-header');
      if (firstCollapsibleHeader) {
        toggleCollapsible(firstCollapsibleHeader);
      }

      const chartBars = document.querySelectorAll('.chart-bar');
      chartBars.forEach(bar => {
        const originalHeight = bar.style.height;
        bar.style.height = '0';
        setTimeout(() => {
          bar.style.height = originalHeight;
        }, 300);
      });

      document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('change', updateProgress);
        el.addEventListener('input', updateProgress); // For text inputs
      });

      document.addEventListener('click', function(event) {
        const messagesDropdown = document.getElementById('messages-dropdown');
        const withdrawModal = document.getElementById('withdraw-modal');
        const buyTokensModal = document.getElementById('buy-tokens-modal');

        if (messagesDropdown && !messagesDropdown.contains(event.target) && !event.target.closest('[onclick*="toggleMessages"]')) {
          messagesDropdown.classList.add('hidden');
        }

        if (withdrawModal && withdrawModal.contains(event.target) && !withdrawModal.querySelector('.withdraw-content').contains(event.target)) {
          closeWithdrawModal();
        }

        if (buyTokensModal && buyTokensModal.contains(event.target) && !buyTokensModal.querySelector('.buy-tokens-content').contains(event.target)) {
          closeBuyTokensModal();
        }
      });

      // Initialize first tab
      switchTab('basic');
    });
  </script>

  <script>
    $(function() {

      updateEarningsChart();

    });



    function renderChart(data) {

      const days = [
        'Monday', 'Tuesday', 'Wednesday',
        'Thursday', 'Friday', 'Saturday', 'Sunday'
      ];

      const maxValue = Math.max(...Object.values(data));
      const scaleFactor = maxValue > 0 ? 100 / maxValue : 0;

      days.forEach(day => {
        const value = data[day] || 0;
        const height = value * scaleFactor;

        const bar = document.getElementById(`${day.toLowerCase()}_data`);
        // const label = document.getElementById(`${day.toLowerCase()}_label`);

        if (bar) bar.style.height = `${height}px`;
        // if (label) label.innerText = `${day.slice(0, 3)} (${value})`;
      });
    }

    function updateEarningsChart() {

      var period = $('#earnings_period').val();

      $.ajax({
        url: 'get_earnings_data.php',
        type: 'POST',
        data: {
          period: period,
          action: 'get_earnings_data',
        },
        dataType: 'json',
        success: function(data) {

          renderChart(data.data);

        },
        error: function(xhr, status, error) {
          console.error('AJAX error:', status, error);
        }
      });
    }

    function updateAgeDisplay(rangeInput) {

      const display = document.getElementById('age_value_display');
      const inputvalue = rangeInput.value;

     let inputValue = rangeInput.value;

      if (inputValue == 65) {

        display.textContent = inputValue + '+';

      } else {
        
        display.textContent = inputValue;
      }

      const percent = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min);
      display.style.left = `calc(${percent * 100}% - 10px)`;
    }
	
	function updateHeightDisplay(rangeInput) {

      const display = document.getElementById('height_value_display');
      const inputvalue = rangeInput.value;

     let inputValue = rangeInput.value;
       
        display.textContent = inputValue;

      const percent = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min);
      display.style.left = `calc(${percent * 100}% - 10px)`;
    }
	
	function updateWeightDisplay(rangeInput) {

      const display = document.getElementById('weight_value_display');
      const inputvalue = rangeInput.value;

     let inputValue = rangeInput.value;
       
        display.textContent = inputValue;

      const percent = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min);
      display.style.left = `calc(${percent * 100}% - 10px)`;
    }

    function updateSettings(element, field_name) {
      var value = element.checked ? 'Y' : 'N';

      if (field_name == 'age_range' || field_name == 'message_template' || field_name=='education_level' || field_name=='children_preference' || field_name == 'height_range' || field_name == 'weight_range' ) {
        value = $(element).val();
      }

      $.ajax({
        url: 'get_earnings_data.php',
        type: 'POST',
        data: {
          value: value,
          field_name: field_name,
          action: 'setting_data',
        },
        dataType: 'json',
        success: function(data) {

           if (field_name =='age_range') {

              renderChart(data.data);
           }

          showNotification('Privacy Settings Updated');

        },
        error: function(xhr, status, error) {
          console.error('AJAX error:', status, error);
        }
      });
    }

    function showNotification(message, type = 'info') {
          const notification = document.createElement('div');
          notification.style.cssText = `
              position: fixed;
              top: 20px;
              right: 20px;
              background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--primary)'};
              color: white;
              padding: 1rem 1.5rem;
              border-radius: var(--radius);
              box-shadow: var(--shadow-lg);
              z-index: 10000;
              font-weight: 600;
              transform: translateX(100%);
              transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          `;
          notification.textContent = message;
          
          document.body.appendChild(notification);
          
          // Show notification
          setTimeout(() => {
              notification.style.transform = 'translateX(0)';
          }, 100);
          
          // Hide notification
          setTimeout(() => {
              notification.style.transform = 'translateX(100%)';
              setTimeout(() => {
                  if (notification.parentNode) {
                      notification.parentNode.removeChild(notification);
                  }
              }, 300);
          }, 3000);
      }

    jQuery(document).ready(function($) {
      $('#pic_img').on('change', function() {
        const file = this.files[0];

        if (file) {
          const reader = new FileReader();

          reader.onload = function(e) {
            $('#preview_prof_img').attr('src', e.target.result).show();
          }

          reader.readAsDataURL(file);
        }
      });


      $('#gallery_photo_1').on('change', function() {
        const file = this.files[0];

        if (file) {
          const reader = new FileReader();

          reader.onload = function(e) {
            $('.gallery1').html('<img src="' + e.target.result + '">');
          }

          reader.readAsDataURL(file);
        }
      });

      $('#gallery_photo_2').on('change', function() {
        const file = this.files[0];

        if (file) {
          const reader = new FileReader();

          reader.onload = function(e) {
            $('.gallery2').html('<img src="' + e.target.result + '">');
          }

          reader.readAsDataURL(file);
        }
      });

    });
  </script>

  <link href="<?= SITEURL ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="<?= SITEURL ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script>
    $(document).ready(function() {
      $('.i-date').datepicker({
        dateFormat: 'mm-dd-yy',
        altField: '#input-date_alt',
        altFormat: 'yy-mm-dd'
      }).on('changeDate', function(e) {
        $(this).datepicker('hide');
      });


    });
  </script>


  <script src="<?= SITEURL ?>assets/js/dropzone.min.js"></script>

  <script>
    // Disable Dropzone auto-discovery
    Dropzone.autoDiscover = false;

    // Manual initialization
    //   function AddjustImage()
    // {

    //   var content = $('#temporary-preview-container').html();

    //    $('#modalimage_gallery').before(content);

    //    $('#temporary-preview-container').html("");

    //    $('#temporary-preview-container').hide();

    // }

    function handleCustomDelete(buttonElement) {

      // Get the preview box (dz-preview)
      const preview = buttonElement.closest('.dz-preview');

      if (!preview) return;

      // Remove hidden input if exists
      const hiddenInput = preview.querySelector("input[name='hiddenmedia[]']");
      if (hiddenInput) {
        const fileName = hiddenInput.value;

        hiddenInput.remove();

        // Optional: Delete from server
        fetch('dropzone_delete.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              fileName
            })
          })
          .then(res => res.json())
          .then(data => {
            if (data.status === 'success') {
              console.log('Deleted from server');
            } else {
              console.warn('Could not delete from server');
            }
          })
          .catch(err => console.error('Server delete error:', err));
      }

      // Remove the preview from the DOM
      preview.remove();
    }


    const myDropzone = new Dropzone("#modalimage_gallery", {
      url: "dropzone_upload.php",
      paramName: "file", // The name that will be used in $_FILES["file"]
      maxFilesize: 5, // in MB
      maxFiles: 10,
      acceptedFiles: ".jpg,.png,.jpeg,.JPG,.JPEG,.PNG",
      addRemoveLinks: true,
      parallelUploads: 5,
      previewsContainer: "#temporary-preview-container",
      previewTemplate: jQuery('.preview').html(),
      dictDefaultMessage: '<svg class="w-7 h-7 mx-auto text-white/50 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg><p class="text-xs text-white/60">Add Photo</p>',
      init: function() {
        this.on("success", function(file, response) {
          if (typeof response === 'string') {
            response = JSON.parse(response);
          }

          var hiddenmedia = document.createElement("input");
          hiddenmedia.setAttribute("type", "hidden");
          hiddenmedia.setAttribute("name", "hiddenmedia[]");
          hiddenmedia.setAttribute("class", "hiddenmedia");
          hiddenmedia.setAttribute("value", response.file);

          $('#temporary-preview-container').show();

          function AddjustImage() {

            $('#temporary-preview-container').find('.dz-processing').append(hiddenInput);

            const content = $('#temporary-preview-container').html();

            $('#modalimage_gallery').before(content);
            $('#temporary-preview-container').empty().hide();
          }

          AddjustImage();

          const preview = file.previewElement;

          const deleteBtn = preview.querySelector('.custom-delete-btn');

          if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
              // Remove the preview
              preview.remove();

              // Remove the hidden input
              hiddenmedia.remove();

              // Optional: delete from server if uploaded
              if (response.file) {
                fetch('dropzone_delete.php', {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                      fileName: response.file
                    })
                  })
                  .then(res => res.json())
                  .then(data => {
                    if (data.status === 'success') {
                      console.log('Deleted from server');
                    } else {
                      console.warn('Could not delete from server');
                    }
                  })
                  .catch(err => console.error('Server delete error:', err));
              }
            });
          }

          // preview.appendChild(hiddenmedia);

          file.serverFileName = response.file;
        });
      }
    });


    jQuery('.removeinserted').click(function() {
      var selectedid = jQuery(this).attr('data-id');
      var img_name = jQuery(this).attr('img_name');
      jQuery('#galblock' + selectedid).remove();
      fetch('dropzone_delete.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            fileName: img_name // Send the file name to the server to delete
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            console.log('File deleted from server');

            //Remove from DB 
            $.ajax({
              url: '<?= SITEURL . 'ajax/delete_modal_uploads.php' ?>',
              type: 'get',
              data: {
                upl_name: img_name,
                unique_id: '<?php echo $userDetails['unique_id']; ?>',
              },
              dataType: 'json',
              success: function(res) {

              }
            });


          } else {
            console.error('Failed to delete the file from server');
          }
        })
        .catch(error => {
          console.error('Error deleting file from server:', error);
        });

    });
  </script>
  <script>  
	//Premium checking
	jQuery('.premiumcheck').click(function(e) { 
		e.preventDefault();
		e.stopPropagation();
		$('#premium_modal').addClass('active');
	});
	
	jQuery('.access_restricted').click(function(e) { 
		e.preventDefault();
		e.stopPropagation();
		$('#follow_modal').addClass('active');
	});
  </script>
  
  <style>
  .premiumcheck input[type="range"],.premiumcheck select {
		pointer-events: none;
		opacity: 0.5; /* Optional: make it look disabled */
	}
   .access_restricted input,.access_restricted select,
   .access_restricted input[type="radio"],.access_restricted textarea,.access_restricted input[type="checkbox"] {
		pointer-events: none;
		opacity: 0.5; /* Optional: make it look disabled */
	}
  </style>

</body>

</html>