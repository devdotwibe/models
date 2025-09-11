<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
if(isset($_SESSION["log_user_id"])){
$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
	if($userDetails){}
	else{
		echo '<script>window.location.href="login.php"</script>';
		die;
	}
}else{
	echo '<script>window.location.href="login.php"</script>';
	die;
}

if (isset($_POST['booking_submit'])) {

   $name = $_POST['name'];
   $model_unique_id = $_POST['model_unique_id'];
   $user_unique_id = $_POST['user_unique_id'];
   $model_name = $_POST['model_name'];
   $meeting_date = $_POST['meeting_date'];
   
   if(isset($_POST['meeting_date_to'])) $meeting_date_to = $_POST['meeting_date_to'];
   if(isset($_POST['destination'])) $destination = $_POST['destination'];
   if(isset($_POST['no_of_hrs_meet'])) $no_of_hrs_meet = $_POST['no_of_hrs_meet'];
   
   //$booking_type = $_POST['booking_type'];
   $booking_for = $_POST['booking_for'];
   $country = $_POST['country'];
   $instructions = $_POST['instructions'];
   if(isset($_POST['meeting_hrs'])){
   $meeting_hrs = $_POST['meeting_hrs'];
   $meeting_min = $_POST['meeting_min'];
   $meeting_g = $_POST['meeting_g'];
   $meeting_time = $meeting_hrs.':'.$meeting_min.' '.$meeting_g;
   }else $meeting_time = '';
   $model_ID = $_POST['model_ID'];
   $model_unique_id = $_POST['model_unique_id'];
   
   $tokens = $_POST['tokens'];
   
    if ($userDetails['balance'] >= $tokens) {

 	//$que = "INSERT INTO `model_booking` (`model_unique_id`, `name`, `phone`, `email`, `age`, `model_name`,`duration`,`meeting_date`,`meeting_time`,`address`,`city`,`state`,`zip_code`,`country`,`instructions`) VALUES ('".$name."', '".$phone."', '".$email."', '".$age."', '".$model_name."', '".$duration."', '".$meeting_date."','".$meeting_time."','".$address."','".$city."','".$state."','".$zip_code."','".$country."','".$instructions."')";

	$arr = array('model_unique_id','user_unique_id','name','model_name','tokens','meeting_date','country','instructions','booking_for','service_name','main_service');  //,'booking_type'
	$post_data = array_from_post($arr);
	
	$post_data['phone'] = '';
	$post_data['email'] = '';
	$post_data['age'] = '';
	$post_data['duration'] = '';
	if(isset($_POST['meeting_hrs'])) $post_data['meeting_time'] = $meeting_time;
	if(isset($_POST['meeting_date_to'])) $post_data['meeting_date_to'] = $meeting_date_to;
	
	if(isset($_POST['destination'])) $post_data['destination'] = $destination;
	if(isset($_POST['no_of_hrs_meet'])) $post_data['no_of_hrs_meet'] = $no_of_hrs_meet;
	$post_data['address'] = '';
	$post_data['city'] = '';
	$post_data['state'] = '';
	$post_data['zip_code'] = '';
	$post_data['created_date'] = date('Y-m-d H:i:s');
	
	DB::insert('model_booking', $post_data); 
	$created_id = DB::insertId();

    if($created_id){
		
		//Save to notification list
		$notif_data = array();
		$user_id = $_SESSION['log_user_id'];
		$notif_data['sender_id'] = $user_id;
		$notif_data['receiver_id'] = $model_ID;
		$notif_data['notification_type'] = 'requests';
		$notif_data['booking_id'] = $created_id;
		$notif_data['notification_date'] = date('Y-m-d H:i:s');
		$notif_data['notification_status'] = 'Pending';

		DB::insert('all_notifications', $notif_data);
		$created_id_notif = DB::insertId();
		
		// Update user balance
						DB::query(
							"UPDATE model_user SET balance = ROUND(balance - %d) WHERE id = %s",
							$tokens,
							$userDetails['id']
						);
		
 
      /*echo '<script>alert("Booking Successfully");
	  window.location="single-profile.php?m_unique_id='.$model_unique_id.'"</script>'; */
      
      	 $email_to = 'shibuster@gmail.com';
         $subject = "Booking Details From The Live Model";

         $header = "From: Model Project <no-reply@model.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;height: 500px;">
            <img src="https://thelivemodels.com/assets/wp-content/themes/theagency3/images/default-bg.jpg" style="width: 100%;height: 100%;">
          </div>
          <div style="padding: 20px;">
          <h2>Dear '.$name.', </h2>
          <p>Please check your details:
            <table style="width:100%">
			  <tr>
			    <td><b>Model Name</b></td>
			    <td>'.$model_name.'</td>
			  </tr>
				 <tr>
				  <td><b>Meeting Date</b></td>
				  <td>'.$meeting_date.'</td>
				</tr>
				 <tr>
				  <td><b>Meeting Time</b></td>
				  <td>'.$meeting_time.'</td>
				</tr>
				 <tr>
				  <td><b>Country</b></td>
				  <td>'.$country.'</td>
				</tr>
				 <tr>
				  <td><b>Instructions</b></td>
				  <td>'.$instructions.'</td>
				</tr>
			</table>
          </div>
          </body>
         </html>';

         /*if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="login.php"</script>';
         }*/

		echo json_encode(['status' => 'success']);
		
		}
		else{
		  //echo '<script>alert("You have Not Booked")</script>';
		  //echo '<script>window.location="booking.php"</script>';
		  echo json_encode(['status' => 'You have Not Booked']);
		}
    }else{
			//echo '<script>alert("You dont have sufficiant tokens for booking.")</script>';
		   // echo '<script>window.location="booking.php"</script>';	
			echo json_encode(['status' => 'You dont have sufficiant tokens for booking.']);
		}
				
 
}


	if (isset($_POST['action']) && $_POST['action'] =='accept_request') {

			$accept_id = $_POST['accept_id'];

			$status =  $_POST['status'];

			  DB::update('model_booking', [
				'status' => $status,
				'changed_date' => date('Y-m-d'),
			], 'id = %i', $accept_id);

		if($status == 'Decline'){
			
			$get_model_booking = DB::queryFirstRow("SELECT tokens,user_unique_id FROM model_booking WHERE id =  %s ", $accept_id);
			
			if(!empty($get_model_booking) && !empty($get_model_booking['tokens']) && !empty($get_model_booking['user_unique_id'])){
				
				// Update user balance
						DB::query(
							"UPDATE model_user SET balance = ROUND(balance + %d) WHERE unique_id = %s",
							$get_model_booking['tokens'],
							$get_model_booking['user_unique_id']
						);
				
			}
			
		}

		echo json_encode(['status'=>'success','message'=>'Successfully Updated','action'=>$status]);

	}


	if (isset($_POST['action']) && $_POST['action'] =='get_book_details') {

			$accept_id = $_POST['accept_id'];

			$bookig_detail = DB::queryFirstRow("SELECT * FROM model_booking WHERE id = %i", $accept_id);


			if (!empty($bookig_detail)) {

				$country_name = getCountry($bookig_detail['country']);

				$bookig_detail['country_name'] = $country_name;
				
				echo json_encode(['status' => 'success', 'data' => $bookig_detail]);

			} else {

				echo json_encode(['status' => 'error', 'message' => 'Booking not found']);
			}

	}

	if (isset($_POST['action']) && $_POST['action'] =='complete_request') {

			$request_id = $_POST['request_id'];

			$status = $_POST['status'];

				  DB::update('model_booking', [
					'complete_request' => $status,
					'changed_date' => date('Y-m-d'),
				], 'id = %i', $request_id);
			
		echo json_encode(['status'=>'success','message'=>'Complete Request Sended Successfully']);

	}

	if (isset($_POST['action']) && $_POST['action'] =='complete_accept') {

			$complete_id = $_POST['complete_id'];

			$status = $_POST['status'];

				  DB::update('model_booking', [
					'complete_request' => $status,
					'status' => 'Completed',
					'changed_date' => date('Y-m-d'),
				], 'id = %i', $complete_id);
				
		//Adding token to model			
			$get_model_booking = DB::queryFirstRow("SELECT tokens,model_unique_id FROM model_booking WHERE id =  %s ", $complete_id);
			
			if(!empty($get_model_booking) && !empty($get_model_booking['tokens']) && !empty($get_model_booking['model_unique_id'])){
				
				// Update user balance
						DB::query(
							"UPDATE model_user SET balance = ROUND(balance + %d) WHERE unique_id = %s",
							$get_model_booking['tokens'],
							$get_model_booking['model_unique_id']
						);
				
			}

		echo json_encode(['status'=>'success','message'=>'Complete Accepted Successfully']);

	}
	
	//Review
	if (isset($_POST['action']) && $_POST['action'] =='send_reviews') {

			$service_id = $_POST['service_id'];

			$star_rating = $_POST['star_rating'];
			
			$clientName = $_POST['clientName'];

			$reviewText = $_POST['reviewText'];
			
			$workAgain = $_POST['workAgain'];
			
			$reciever_id = $_POST['reciever_id'];

			$post_data = array();
			$post_data['service_id'] = $service_id;
			$post_data['sender'] = $userDetails['unique_id'];
			$post_data['receiver'] = $reciever_id;
			$post_data['rating'] = $star_rating;
			$post_data['review'] = $reviewText;
			$post_data['work_again'] = $workAgain;
			$post_data['send_date'] = date('Y-m-d H:i:s');
			
			DB::insert('service_review', $post_data); 
			$created_id = DB::insertId();
				  

		echo json_encode(['status'=>'success','message'=>'Review submitted successfully!']);

	}

?>