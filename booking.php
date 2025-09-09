<?php session_start(); 

include('includes/config.php');
include('includes/helper.php');

if(!isset($_GET['service']) || !isset($_GET['m_id']) || !isset($_GET['type'])){
	echo '<script>window.history.back();</script>';
	die;
}else{
	//$country_list = DB::query('select id,name,sortname from countries order by name asc');
}
if($_SESSION["log_user"]){
	$userDetails = get_data('model_user',array('id'=>$_SESSION['log_user_id']),true);
	if(!$userDetails){
		echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
		echo "<script>window.location='".SITEURL."/login.php';</script>";
		die;
	}
	
	if($_SESSION['log_user_unique_id'] == $_GET['m_id']){ ?>
		<script>alert("Oops!! You can't book your service. Please choose another model...")</script>
		<?php echo "<script>window.history.back();</script>";
		die;
	}
	
}
else{
	echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
	echo "<script>window.location='".SITEURL."/login.php';</script>";
	die;
}
$m_id = $_GET["m_id"];
$model_data = DB::queryFirstRow("SELECT * FROM model_user WHERE unique_id =  %s ", $m_id);
if(!$model_data){
	echo '<script>window.history.back();</script>';
	die;
}else{
$model_name = $model_data['name'];
$model_ID = $model_data['id'];
}

$extra_details = DB::queryFirstRow("SELECT * FROM model_extra_details WHERE unique_model_id = %s ", $m_id);

$country_list = DB::query('select id,name,sortname from countries order by name asc');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking for <?=$_GET['service']?> - Live Models</title>
    <meta name="description" content="Book your exclusive international tour experience with verified models">
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/profile.css?v=<?=time()?>' type='text/css' media='all' />
	<?php  include('includes/head.php'); ?>

	<link rel='stylesheet' href='<?=SITEURL?>assets/css/all.min.css?v=<?=time()?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?=SITEURL?>assets/css/themes.css?v=<?=time()?>' type='text/css' media='all' />
   
</head>
<body class="min-h-screen text-white booking-form text-white socialwall-page enhanced5">
	
	
	<?php if (isset($_SESSION["log_user_id"])) { ?>
 
    <?php  include('includes/side-bar.php'); ?>

    <?php  include('includes/profile_header_index.php'); ?>  
 
  <?php } else{ ?>
  
	<?php include('includes/header.php'); ?>
	
  <?php } ?>
	
	<main>
        <!-- Premium Booking Header -->
        <section class="py-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/30 via-purple-900/20 to-pink-900/30"></div>
            <div class="container mx-auto relative z-10">
                <div class="text-center mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-4 text-glow">Booking for <?=$_GET['service']?></h1>
                    <p class="text-xl text-white/70 max-w-2xl mx-auto">Complete your booking details to secure your exclusive experience</p>
                </div>
            </div>
        </section>

        <!-- Premium Status Section -->
        <section class="py-8 relative">
            <div class="container mx-auto">
                <div class="ultra-glass p-8 rounded-3xl mb-8">
                    <div class="text-center mb-6">
                        <p class="text-white/70 text-lg mb-6">Once you have submit request your coins will be deducted from your account.</p>
                    </div>
                    
                    <div class="flex justify-center items-center space-x-12">
                        <!-- User Avatar -->
                        <div class="text-center floating">
						<?php if(!empty($userDetails['profile_pic']) && file_exists($userDetails['profile_pic'])){ ?>
							<div class="model-avatar w-20 h-20 rounded-full overflow-hidden mb-4 mx-auto shadow-2xl border-3 border-green-500">
                                <img src="<?php echo SITEURL.$userDetails['profile_pic']; ?>" alt="<?php echo $userDetails['name']; ?>" class="w-full h-full object-cover">
                            </div>
						<?php }else{ ?>
							<div class="model-avatar w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-2xl mb-4 mx-auto shadow-2xl">
                                <?php echo substr(strtoupper($userDetails['name']), 0, 1); ?>
                            </div>
						<?php } ?>
                            <div class="premium-text font-bold text-lg mb-2"><?php echo $userDetails['name']; ?></div>
                            <?php /*?><div class="flex items-center justify-center mb-2">
                                <span class="status-online w-3 h-3 rounded-full mr-2"></span>
                                <span class="text-sm text-white/60">Online</span>
                            </div>
							<?php 
							$user_city = $userDetails['city'];
							$u_cities = DB::queryFirstRow("SELECT name FROM cities WHERE id =  %s ", $user_city);
							if(!empty($u_cities)){
								$user_city = $u_cities['name'];
							}
							$model_city = $model_data['city'];
							$m_cities = DB::queryFirstRow("SELECT name FROM cities WHERE id =  %s ", $model_city); 
							if(!empty($m_cities)){
								$model_city = $m_cities['name'];
							}
							?>
                            <div class="text-xs text-white/50 max-w-32">
								<?php 
								if(!empty($user_city)) echo 'THE USER IS IN CITY '.$user_city; 
								if(!empty($user_city) && !empty($model_city)) echo ' AND ';
								if(!empty($model_city)) echo 'THE MODEL IS IN CITY '.$model_city;
								?>
							</div><?php */?>
						</div>

                        <!-- Connection Arrow -->
                        <div class="flex items-center">
                            <div class="w-16 h-0.5 bg-gradient-to-r from-purple-500 to-pink-500 relative">
                                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-4 border-l-pink-500 border-t-2 border-t-transparent border-b-2 border-b-transparent"></div>
                            </div>
                        </div>

                        <!-- Model Avatar -->
                        <div class="text-center floating">
						<?php if(!empty($model_data['profile_pic']) && file_exists($model_data['profile_pic'])){ ?>
							<div class="model-avatar w-20 h-20 rounded-full overflow-hidden mb-4 mx-auto shadow-2xl border-3 border-green-500">
                                <img src="<?php echo SITEURL.$model_data['profile_pic']; ?>" alt="<?php echo $model_data['name']; ?>" class="w-full h-full object-cover">
                            </div>
						<?php }else{ ?>
							<div class="model-avatar w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-2xl mb-4 mx-auto shadow-2xl">
                                <?php echo substr(strtoupper($model_data['name']), 0, 1); ?>
                            </div>
						<?php } ?>
                            <div class="premium-text font-bold text-lg mb-2"><?php echo $model_data['name']; ?></div>
                            <?php /*?><div class="flex items-center justify-center mb-2">
                                <span class="status-online w-3 h-3 rounded-full mr-2"></span>
                                <span class="text-sm text-white/60">Available</span>
                            </div><?php */ ?>
							<?php if (!empty($extra_details) && !empty($extra_details) && $extra_details['status'] == 'Published') { ?>
                            <div class="verified-badge text-white px-3 py-1 rounded-full text-xs font-semibold">
                                ✓ Verified Model
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Premium Booking Form -->
        <section class="py-12 relative">
            <div class="container mx-auto">
			
				<form method="post" class="max-w-6xl mx-auto space-y-8" action="act_model_booking.php" enctype="multipart/form-data" >
				
				<?php if(isset($_GET['service'])){ ?>
				
					<div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
						 
							<div class="flex items-center mb-8">
								<h2 class="text-3xl font-bold premium-text heading-font"><?php echo $_GET['service']; ?></h2>
								
							</div>


                            <?php if($_GET['type'] == 'collaboration'){ ?>
							
                                <div>
                                    <div class="block text-white/80 font-semibold mb-3 text-lg">Per Hour Rate: <?php if (!empty($extra_details)) echo $extra_details['in_per_hour']; ?></div>
                                    <div class="block text-white/80 font-semibold mb-3 text-lg">Per Day Rate: <?php if (!empty($extra_details)) echo $extra_details['extended_rate']; ?></div>
                                    <div class="block text-white/80 font-semibold mb-3 text-lg">Weekend Rate: <?php if (!empty($extra_details)) echo $extra_details['in_overnight']; ?></div>
                                
                                </div>
					
								
						    <?php } ?>
							
							
							<?php if($_GET['service'] == 'Meetup'){ ?>
							
							<div>
								<label class="block text-white/80 font-semibold mb-3 text-lg">Tokens <?php //echo $_GET['token']; ?></label>
								
							</div> 
							
							<div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Local Meetup Rate: <?php if (!empty($extra_details)) echo $extra_details['in_per_hour']; ?>/hr</div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Extended Social Rate: <?php if (!empty($extra_details)) echo $extra_details['extended_rate']; ?>/hr</div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Extended Evening Rate: <?php if (!empty($extra_details)) echo $extra_details['in_overnight']; ?>/8hrs</div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Full-day Social Rate: <?php if (!empty($extra_details)) echo $extra_details['fullday_social']; ?>/day</div>
							</div>
							<?php $social_availability = json_decode($extra_details['social_availability']);
							if(!empty($social_availability)){
							  $availability_time_slot = json_decode($extra_details['availability_time_slot']);
							  ?>
							<div>
								<label class="block text-white/80 font-semibold mb-3 text-lg">Available Days</label>
								<ul class="avail-list">
								<?php foreach($social_availability as $avail){ 

									echo '<li>'.$avail;
									if(!empty($availability_time_slot) && !empty($availability_time_slot->$avail) && !empty($availability_time_slot->$avail[0])){
										echo ' - '.$availability_time_slot->$avail[0].' : '.$availability_time_slot->$avail[1];
									}
									echo '</li>';

								} ?>
								</ul>
							</div>
								
							<?php }  } ?>
							
							<?php if($_GET['service'] == 'Travel'){ ?>
							
							<div>
								<label class="block text-white/80 font-semibold mb-3 text-lg">Tokens <?php //echo $_GET['token']; ?></label>
								
							</div> 
							
							<div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Daily Rate: <?php if (!empty($extra_details)) echo $extra_details['collab_hour']; ?>/day</div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Weekly Rate: <?php if (!empty($extra_details)) echo $extra_details['collab_day']; ?>/week</div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Monthly Rate: <?php if (!empty($extra_details)) echo $extra_details['collab_week']; ?>/mon</div>
								<div class="block text-white/80 font-semibold mb-3 text-lg">Preferred Travel Destinations: <?php if (!empty($extra_details)) echo $extra_details['travel_destination']; ?></div>
							</div>
							<?php $travel_months = json_decode($extra_details['travel_months']); 
							if(!empty($travel_months)){
							?>
							<div>
								<label class="block text-white/80 font-semibold mb-3 text-lg">Available Months for Travel</label>
								<ul class="avail-list">
								<?php foreach($travel_months as $avail){ 

									echo '<li>'.$avail.'</li>';

								} ?>
								</ul>
							</div>
							
							<?php } ?>
								
							<?php } ?>
							
					</div>
					
				<?php } ?>
					
					
					<!-- Contact Details Section -->
                    <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
					 
						<div class="flex items-center mb-8">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>

                            <?php if(isset($_GET['type']) && $_GET['type'] =='collaboration' ){ ?> 

                                <h2 class="text-3xl font-bold premium-text heading-font">Collaboration Details</h2>

                            <?php } else  {  ?>


                                <h2 class="text-3xl font-bold premium-text heading-font">Your Contact Details</h2>

                            <?php } ?> 

                        </div>
						
						<?php 
						if(isset($_GET['service']) && !empty($_GET['service'])){

							$service = $_GET['service']; 
						}else{
							$service = '';
						} ?>
                        
                        <div class="grid md:grid-cols-3 gap-6">
                            <?php /*?><div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Booking Type</label>
                                <select name="booking_type" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">Select...</option>
                                    
									<option value="Group Chat" class="bg-gray-900" <?php if($service == 'Group Chat'){ echo 'selected'; } ?> >Group Chat</option>
									<option value="Private Chat" class="bg-gray-900" <?php if($service == 'Private Chat'){ echo 'selected'; } ?> >Private Chat</option>
									<option value="Local Meetup" class="bg-gray-900" <?php if($service == 'Local Meetup'){ echo 'selected'; } ?> >Local Meetup</option>
									<option value="Extended Social" class="bg-gray-900" <?php if($service == 'Extended Social'){ echo 'selected'; } ?> >Extended Social</option>
									<option value="Overnight Social" class="bg-gray-900" <?php if($service == 'Overnight Social'){ echo 'selected'; } ?> >Overnight Social</option>
									
									
                                </select>
                            </div> <?php */ ?>


                        <?php if(isset($_GET['type']) && $_GET['type'] =='collaboration' ){
                            
                                $collab_categorys = json_decode($extra_details['collab_category']); 

                                $category_labels = [
                                    'life_style_entertainment'=>'Lifestyle & Entertainment  Includes vlogs, fashion, product features, travel stories, etc.',
                                    'creative_editorial'=>'Creative & Editorial Projects Conceptual shoots, art-based themes, expressive photography, etc.',
                                    'fashion'=>'Swimwear / Lingerie / Fitness Modeling Includes stylized or bold fashion looks for commercial or brand use',
                                    'adult_oriented'=>'Adult-Oriented or 18+ Content (Confidential)  May include provocative or mature themes created for verified age-restricted audiences or private platforms.'
                                                                   
                                ];
                         
                            ?>

                            <div>

                                 <label class="block text-white/80 font-semibold mb-3 text-lg">Collaboration Type</label>

                                <select name="booking_for" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>

                                    <option value="" class="bg-gray-900">Select...</option>

                                    <?php if(!empty($collab_categorys)) { ?>

                                        <?php foreach($collab_categorys as $item) { ?>

                                            <option value="<?= $item ?>" class="bg-gray-900"> <?php echo $category_labels[$item] ?></option>

                                         <?php } ?>

                                    <?php } ?>
                          
                                    
                                </select>

                            </div>

                        <?php } else { ?>

                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Booking For</label>
                                <select name="booking_for" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">Select...</option>
                                    <option value="Myself" class="bg-gray-900">👤 Myself</option>
                                    <option value="Business Partner" class="bg-gray-900">🤝 Business Partner</option>
                                    <option value="Special Client" class="bg-gray-900">⭐ Special Client</option>
                                    <option value="Group Booking" class="bg-gray-900">👥 Group Booking</option>
                                </select>
                            </div>

                        <?php } ?>


                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Country</label>

                                <select name="country" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>

                                    <option value="" class="bg-gray-900">Select...</option>

                                    <!-- <option value="us" class="bg-gray-900">🇺🇸 United States</option>
                                    <option value="uk" class="bg-gray-900">🇬🇧 United Kingdom</option>
                                    <option value="ca" class="bg-gray-900">🇨🇦 Canada</option>
                                    <option value="au" class="bg-gray-900">🇦🇺 Australia</option>
                                    <option value="de" class="bg-gray-900">🇩🇪 Germany</option>
                                    <option value="fr" class="bg-gray-900">🇫🇷 France</option>
                                    <option value="jp" class="bg-gray-900">🇯🇵 Japan</option>
                                    <option value="ae" class="bg-gray-900">🇦🇪 UAE</option>
                                    <option value="ch" class="bg-gray-900">🇨🇭 Switzerland</option>
                                    <option value="sg" class="bg-gray-900">🇸🇬 Singapore</option> -->

                                    <?php  foreach ($country_list as $val) { ?>

                                          <option value="<?= $val['id'] ?>" class="bg-gray-900"><?= $val['name'] ?></option>

                                    <?php } ?>


                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions Section -->

                    <?php if(isset($_GET['type']) && $_GET['type'] =='collaboration' ){ ?> 

                        <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
                            <div class="flex items-center mb-8">
                                <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <h2 class="text-3xl font-bold premium-text heading-font">Description</h2>
                            </div>
                            
                            <div>

                                <label class="block text-white/80 font-semibold mb-3 text-lg">Briefly describe your idea</label>
                                <textarea name="instructions"
                                    class="w-full px-6 py-4 ultra-glass text-white placeholder-white/50 rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 h-40 resize-none shadow-lg transition duration-300" 
                                    placeholder="Please provide any special requirements, preferences, dietary restrictions, accessibility needs, or other important information for your international tour experience. Include details about locations, activities, duration, or any specific requests you may have..."
                                ></textarea>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
                            <div class="flex items-center mb-8">
                                <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <h2 class="text-3xl font-bold premium-text heading-font">Instructions</h2>
                            </div>
                            
                            <div>

                                <label class="block text-white/80 font-semibold mb-3 text-lg">Special Instructions, or notes (optional)</label>
                                <textarea name="instructions"
                                    class="w-full px-6 py-4 ultra-glass text-white placeholder-white/50 rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 h-40 resize-none shadow-lg transition duration-300" 
                                    placeholder="Please provide any special requirements, preferences, dietary restrictions, accessibility needs, or other important information for your international tour experience. Include details about locations, activities, duration, or any specific requests you may have..."
                                ></textarea>
                            </div>
                        </div>

                    <?php } ?>


                    <!-- Schedule Section -->
                    <div class="ultra-glass p-10 rounded-3xl shadow-2xl hover-lift">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
							<?php if($_GET['service'] == 'Travel'){ ?>

							<h2 class="text-3xl font-bold premium-text heading-font">Select travel date</h2>

                            <h3 class="text-3xl font-bold premium-text heading-font" style="margin-left: auto;">token <span id="token_no"></span> </h3>

							<?php } else{ ?>



                            <h2 class="text-3xl font-bold premium-text heading-font"  ><?php if($_GET['service'] == 'Collaboration') { ?>  When do you want to collaborate  <?php } else { ?> When do you want to see me? <?php } ?> </h2>
							
                            <h3 class="text-3xl font-bold premium-text heading-font" style="margin-left: auto;">token <span id="token_no"></span> </h3>
                            
                            <?php } ?>



                        </div>


                        <?php if($_GET['service'] == 'Travel' || $_GET['service'] == 'Collaboration' ){ 
                            
                            
                                $collab_hours_per = $extra_details['collab_hour'];

                                $collab_days_per = $extra_details['collab_day'];

                                $collab_weekend_rate = $extra_details['collab_week'];
                            
                            ?>

						<div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                            <div class="md:col-span-2">
                                <label class="block text-white/80 font-semibold mb-3 text-lg">From</label>
                                <input name="meeting_date" <?php if($_GET['service'] == 'Collaboration') { ?> onchange="CalculateCollaborate()" <?php } else { ?>  onchange="CalculateDate()"  <?php } ?>

                                    id="meeting_date_from"
                                    type="date" 
                                    class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                    required
                                    min="<?php echo date('Y-m-d'); ?>"
                                >

                            </div>

							<div class="md:col-span-2">
                                <label class="block text-white/80 font-semibold mb-3 text-lg">To</label>
                                <input name="meeting_date_to" <?php if($_GET['service'] == 'Collaboration') { ?> onchange="CalculateCollaborate()" <?php } else { ?>  onchange="CalculateDate()"  <?php } ?>
                                    id="meeting_date_to"
                                    type="date" 
                                    class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                    required
                                    min=""
                                >


                                <span id="end_date_error"  style="display: none; color:red;"> </span>

                            </div>
							

                            <?php if($_GET['service'] == 'Collaboration' ){ ?>

                                <div style="display:none" id="collab_hour">

                                    <label class="block text-white/80 font-semibold mb-3 text-lg">Hour</label>

                                    <select name="meeting_hrs" id="meeting_hrs" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                        <option value="" class="bg-gray-900">HH</option>
                                        <option value="01" class="bg-gray-900">01</option>
                                        <option value="02" class="bg-gray-900">02</option>
                                        <option value="03" class="bg-gray-900">03</option>
                                        <option value="04" class="bg-gray-900">04</option>
                                        <option value="05" class="bg-gray-900">05</option>
                                        <option value="06" class="bg-gray-900">06</option>
                                        <option value="07" class="bg-gray-900">07</option>
                                        <option value="08" class="bg-gray-900">08</option>
                                        <option value="09" class="bg-gray-900">09</option>
                                        <option value="10" class="bg-gray-900">10</option>
                                        <option value="11" class="bg-gray-900">11</option>
                                        <option value="12" class="bg-gray-900">12</option>
                                    </select>

                                </div>

                            <?php } ?>


                              <?php if($_GET['service'] == 'Travel' ){ ?>

                                    
                                <div>
                                    <label class="block text-white/80 font-semibold mb-3 text-lg">Travel location</label>
                                    <input name="destination"
                                        type="text" 
                                        class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                        required
                                    >
                                </div>

                            <?php } else { ?>

                                <div>
                                    <label class="block text-white/80 font-semibold mb-3 text-lg">Collaboration location</label>
                                    <input name="destination"
                                        type="text" 
                                        class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                        required
                                    >

                                </div>

                            <?php } ?>
							
						</div>

						<?php } else{ ?>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Date</label>
                                <input name="meeting_date"
                                    type="date" 
                                    class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                    required
                                    min="<?php echo date('Y-m-d'); ?>"
                                >
                            </div>
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Hour</label>
                                <select name="meeting_hrs" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">HH</option>
                                    <option value="01" class="bg-gray-900">01</option>
                                    <option value="02" class="bg-gray-900">02</option>
                                    <option value="03" class="bg-gray-900">03</option>
                                    <option value="04" class="bg-gray-900">04</option>
                                    <option value="05" class="bg-gray-900">05</option>
                                    <option value="06" class="bg-gray-900">06</option>
                                    <option value="07" class="bg-gray-900">07</option>
                                    <option value="08" class="bg-gray-900">08</option>
                                    <option value="09" class="bg-gray-900">09</option>
                                    <option value="10" class="bg-gray-900">10</option>
                                    <option value="11" class="bg-gray-900">11</option>
                                    <option value="12" class="bg-gray-900">12</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Minute</label>
                                <select name="meeting_min" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">MM</option>
                                    <option value="00" class="bg-gray-900">00</option>
                                    <option value="15" class="bg-gray-900">15</option>
                                    <option value="30" class="bg-gray-900">30</option>
                                    <option value="45" class="bg-gray-900">45</option>
                                </select>
                            </div>
							
							
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex space-x-6">
                                <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                    <input type="radio"  name="meeting_g" value="AM" class="form-radio text-indigo-600 w-5 h-5" required>
                                    <span class="font-medium text-lg">AM</span>
                                </label>
                                <label class="flex items-center space-x-3 text-white cursor-pointer hover-lift">
                                    <input type="radio" name="meeting_g" value="PM" class="form-radio text-indigo-600 w-5 h-5" required>
                                    <span class="font-medium text-lg">PM</span>
                                </label>
                            </div>
                        </div>
						
						
							<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
							<div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">Destination</label>
								<input name="destination"
                                    type="text" 
                                    class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" 
                                    required
                                >

							</div>
							<div>
                                <label class="block text-white/80 font-semibold mb-3 text-lg">No of hours need to meet</label>
                                <select name="no_of_hrs_meet"  onchange="CalculateToken(this)" class="w-full px-6 py-4 ultra-glass text-white rounded-xl border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg transition duration-300" required>
                                    <option value="" class="bg-gray-900">Hours</option>
                                    <?php for($i = 1;$i <=24; $i++){ ?>
									<option value="<?php echo $i; ?>" class="bg-gray-900"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
							</div>
							
						
						<?php } ?>
						
                    </div>

                    

                    <!-- Submit Section -->
                    <div class="text-center">
					
						<input type="hidden" name="model_unique_id" value="<?php echo $m_id; ?>">
						<input type="hidden" name="user_unique_id" value="<?php echo $_SESSION['log_user_unique_id']; ?>">
						<input type="hidden" name="model_name" value="<?php echo $model_name; ?>">
						<input type="hidden" name="model_ID" value="<?php echo $model_ID; ?>">						
						<input type="hidden" name="name" value="<?php echo $userDetails['name']; ?>">
						<input type="hidden" name="service_name" value="<?php echo $_GET['service']; ?>">
						<input type="hidden" name="main_service" value="<?php echo $_GET['type']; ?>">
                        <input type="hidden" name="tokens" id="tokens_used" value="<?php echo $_GET['token']; ?>" >

                        
                    <?php if($_GET['service'] == 'Collaboration' ) { ?>

                        <button name="booking_submit" type="submit" class="btn-primary px-16 py-5 text-white font-bold rounded-2xl text-xl shadow-2xl relative overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M5 12l5 5l10-10"></path></svg>
                             Confirm Booking
                        </button>

                    <?php } else { ?>


                        <button name="booking_submit" type="submit" class="btn-primary px-16 py-5 text-white font-bold rounded-2xl text-xl shadow-2xl relative overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 inline"><path d="M5 12l5 5l10-10"></path></svg>
                            Let's Meet - Confirm Booking
                        </button>

                    <?php } ?>



                        <p class="text-white/60 mt-4 text-lg">Your booking will be processed securely and you'll receive confirmation within 24 hours</p>
                    </div>
                </form>
            </div>
        </section>
    </main>
	
   <?php include('includes/footer.php'); ?>



   <script>

 
const collab_hours_per = <?php echo (int)$collab_hours_per; ?>;
const collab_days_per = <?php echo (int)$collab_days_per; ?>;
const collab_weekend_rate = <?php echo (int)$collab_weekend_rate; ?>;

$(document).ready(function () {

    // Date change handler
    $("#meeting_date_from, #meeting_date_to").on("change", CalculateCollaborate);

    // Hour change handler (only applies if same-day)
    $("#meeting_hrs").on("change", function () {
        let fromDate = $("#meeting_date_from").val();
        let toDate   = $("#meeting_date_to").val();

        if (!fromDate || !toDate) return;

        let start = new Date(fromDate);
        let end   = new Date(toDate);

        if (start.toDateString() === end.toDateString()) {
            let hrs = parseInt($(this).val()) || 0;
            let totalTokens = hrs * collab_hours_per;
            $("#tokens_used").val(totalTokens);
            $("#token_no").text(totalTokens);
        }
    });

});

function CalculateCollaborate() {
    let fromDate = $("#meeting_date_from").val();
    let toDate   = $("#meeting_date_to").val();
    let $error   = $("#end_date_error");
    let $tokens  = $("#tokens_used");
    let $hourDiv = $("#collab_hour");

    $error.hide().text("");
    $tokens.val("");
    $("#token_no").text("");

    if (!fromDate || !toDate) return;

    let start = new Date(fromDate);
    let end   = new Date(toDate);

    // ❌ Case: end < start
    if (end < start) {
        $error.text("❌ End date must be greater than start date.").show();
        $hourDiv.hide();
        return;
    }

    // ✅ Case: same day → show hour selector
    if (start.toDateString() === end.toDateString()) {
        $hourDiv.show();

        // Recalculate tokens immediately if an hour is already selected
        let hrs = parseInt($("#meeting_hrs").val()) || 0;
        if (hrs > 0) {
            let totalTokens = hrs * collab_hours_per;
            $tokens.val(totalTokens);
            $("#token_no").text(totalTokens);
        }
        return;
    }

    // ✅ Case: multi-day → calculate by days & weekends
    $hourDiv.hide();

    let totalTokens = 0;
    let loopDate = new Date(start);

    while (loopDate <= end) {
        let day = loopDate.getDay(); // 0=Sunday, 6=Saturday
        if (day === 0 || day === 6) {
            totalTokens += collab_weekend_rate;
        } else {
            totalTokens += collab_days_per;
        }
        loopDate.setDate(loopDate.getDate() + 1);
    }

    $tokens.val(totalTokens);
    $("#token_no").text(totalTokens);
}


</script>



    <script>
		
		$('#meeting_date_from').change(function(){
			$('#meeting_date_to').val('');
		});

        function CalculateDate() {

                let fromDate = $('#meeting_date_from').val();
                let toDate   = $('#meeting_date_to').val();

                $('#end_date_error').hide().text('');
				
				if(fromDate){
					let date = new Date(fromDate);
					date.setDate(date.getDate() + 1);  // Add 1 day

					// Format to YYYY-MM-DD
					let minDate = date.toISOString().split('T')[0];

					$('#meeting_date_to').attr('min', minDate);
				}

                if (!fromDate || !toDate) {
                    $('#token_no').text('');
					$('#tokens_used').val('<?php echo $_GET['token']; ?>');
                    return;
                }

                let start = new Date(fromDate);
                let end   = new Date(toDate);

                if (end < start) {

                    // alert("End date must be after start date");

                    $('#end_date_error').show().text('From date must be after To date');

                    $('#token_no').text(''); 
					$('#tokens_used').val('<?php echo $_GET['token']; ?>');

                    return;
                }

                let diffTime = end - start;
                let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                let dailyRate   = parseFloat("<?php echo !empty($extra_details) ? $extra_details['daily_rate'] : 0; ?>");
                let weeklyRate  = parseFloat("<?php echo !empty($extra_details) ? $extra_details['weekly_rate'] : 0; ?>");
                let monthlyRate = parseFloat("<?php echo !empty($extra_details) ? $extra_details['monthly_rate'] : 0; ?>");

                let total = 0;

                if (days < 7) {
                    total = days * dailyRate;
                } 
                else if (days < 30) {
                    let weeks = Math.floor(days / 7);
                    let remainingDays = days % 7;
                    total = (weeks * weeklyRate) + (remainingDays * dailyRate);
                } 
                else {
                    let months = Math.floor(days / 30);
                    let remainingAfterMonths = days % 30;

                    let weeks = Math.floor(remainingAfterMonths / 7);
                    let remainingDays = remainingAfterMonths % 7;

                    total = (months * monthlyRate) + (weeks * weeklyRate) + (remainingDays * dailyRate);
                }

                $('#token_no').text(total);
				$('#tokens_used').val(total);

                $('#token_cost').val(total);
            }    
            
           //Meet up token calculation
			function CalculateToken(selectElement){
				var selectedValue = selectElement.value;
				if(selectedValue != ''){
					
					let localMeetupRate   = parseFloat("<?php echo !empty($extra_details) ? $extra_details['in_per_hour'] : 0; ?>");
					let extendedSocialRate  = parseFloat("<?php echo !empty($extra_details) ? $extra_details['extended_rate'] : 0; ?>");
					let extendedEveningRate = parseFloat("<?php echo !empty($extra_details) ? $extra_details['in_overnight'] : 0; ?>");
					let fulldaySocialRate = parseFloat("<?php echo !empty($extra_details) ? $extra_details['fullday_social'] : 0; ?>");
					
					let total = 0;
					
					if(selectedValue == 1){
						total = localMeetupRate;
					}else if(selectedValue > 1 && selectedValue < 8){
						total = localMeetupRate + (selectedValue - 1) * extendedSocialRate;
					}else if(selectedValue == 8){
						total = extendedEveningRate;
					}else if(selectedValue > 8 && selectedValue < 24){
						total = extendedEveningRate + (selectedValue - 8) * extendedSocialRate;
					}else if(selectedValue == 24){
						total = fulldaySocialRate;
					}
					
					$('#token_no').text(total);
					$('#tokens_used').val(total);

					$('#token_cost').val(total);
				
				}
			} 
        // // Initialize premium features
        // document.addEventListener('DOMContentLoaded', function() {
        //     initializePremiumFeatures();
        //     setMinDate();
        // });

        // function initializePremiumFeatures() {
        //     // Premium Particle System
        //     function createPremiumParticle() {
        //         const particle = document.createElement('div');
        //         particle.className = 'particle';
        //         particle.style.left = Math.random() * 100 + '%';
        //         particle.style.animationDelay = Math.random() * 12 + 's';
        //         particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
        //         particle.style.opacity = Math.random() * 0.8 + 0.2;
                
        //         const colors = [
        //             'rgba(139, 92, 246, 0.8)',
        //             'rgba(236, 72, 153, 0.6)',
        //             'rgba(6, 182, 212, 0.7)'
        //         ];
        //         const randomColor = colors[Math.floor(Math.random() * colors.length)];
        //         particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;
                
        //         document.getElementById('particles').appendChild(particle);
                
        //         setTimeout(() => {
        //             if (particle.parentNode) {
        //                 particle.remove();
        //             }
        //         }, 12000);
        //     }

        //     setInterval(createPremiumParticle, 150);

        //     // Animated Counter
        //     function animatePremiumCounter(element, target) {
        //         let current = 0;
        //         const increment = target / 200;
        //         const timer = setInterval(() => {
        //             current += increment;
        //             if (current >= target) {
        //                 current = target;
        //                 clearInterval(timer);
        //             }
        //             element.textContent = Math.floor(current).toLocaleString();
        //         }, 10);
        //     }

        //     document.querySelectorAll('.stats-counter').forEach(counter => {
        //         const target = parseInt(counter.getAttribute('data-target'));
        //         animatePremiumCounter(counter, target);
        //     });

        //     // Scroll reveal
        //     const observer = new IntersectionObserver((entries) => {
        //         entries.forEach(entry => {
        //             if (entry.isIntersecting) {
        //                 entry.target.classList.add('revealed');
        //             }
        //         });
        //     }, { threshold: 0.1 });

        //     document.querySelectorAll('.scroll-reveal').forEach(el => {
        //         observer.observe(el);
        //     });
        // }

        function setMinDate() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const dateInput = document.querySelector('input[type="date"]');
            if (dateInput) {
                dateInput.min = tomorrow.toISOString().split('T')[0];
            }
        }

        function handleBookingSubmit(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(event.target);
            const selectedModel = formData.get('selectedModel');
            
            if (!selectedModel) {
                alert('⚠️ Please select a model for your international tour experience.');
                return;
            }
            
            // Show success message
            alert(`🎉 Booking Confirmed!\n\nYour international tour booking has been submitted successfully.\n\nSelected Model: ${selectedModel}\nBooking Type: ${formData.get('booking-type') || 'Not specified'}\n\nYou will receive a confirmation email within 24 hours with all the details.\n\nThank you for choosing Live Models for your premium experience!`);
            
            // Simulate redirect
            setTimeout(() => {
                alert('🔄 Redirecting to payment gateway...');
            }, 2000);
        }

        function goBack() {
            alert('🔙 Returning to model selection...');
        }
    </script>
</body>
</html>