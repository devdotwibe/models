<?php
session_start();
include('includes/config.php');
include('includes/helper.php');
$userDetails = get_data('model_user',array('id'=>$_SESSION["log_user_id"]),true);
if($userDetails){}
else{
	echo '<script>window.location.href="login.php"</script>';
	die;
}

if ($_POST['submit_name']){ 
	$arr = array('name','country','state','city','gender','age','user_bio','services','relationship','travel_preference'); //,'user_current_status'
	$post_data = array_from_post($arr);
	
	$post_data['dob'] = h_dateFormat($_POST['dob'],'Y-m-d');
	//$post_data['age'] = h_get_age($dob);
	
	$unique_id = $_POST['unique_id'];

	$post_data['hobbies'] = json_encode($_POST['hobbies']);
	
	if(isset($_POST['additional_hobbies']) && !empty($_POST['additional_hobbies'])){
		$post_data['additional_hobbies'] = json_encode($_POST['additional_hobbies']);
	}else{
		$post_data['additional_hobbies'] = '';
	}

	
	
	$lang_array = array();
	$modal_lang = $_POST['modal_lang'];
	$proficiency = $_POST['proficiency'];
	$english_ability = '';
	if(!empty($modal_lang)){
		$i = 0; 
		foreach($modal_lang as $lng){
			if($lng == 'English'){ $english_ability = $proficiency[$i]; }
			$lang_array[$i]['lan'] = $lng;
			$lang_array[$i]['prof'] = $proficiency[$i];
			$i++;
		}
	}
	$post_data['english_ability'] = $english_ability;
	$post_data['languages'] = json_encode($lang_array); 

	
	//Social icons 
	/*$platform = $_POST['platform'];
	$URL = $_POST['URL'];
	$status = $_POST['status'];
	$public = $_POST['public'];
	$socialid = $_POST['socialid'];
	$paid_token = $_POST['paid_token'];
	if(!empty($platform)){
		$cnt = 0; $string_paltform = '';
		foreach($platform as $sc){
			if(!empty($socialid[$cnt])){
				if(!empty($paid_token[$cnt])) $paid_tk = $paid_token[$cnt];
				else $paid_tk = 0;
				$sql = "UPDATE model_social_link SET platform = '".$sc."', URL = '".$URL[$cnt]."', status='".$status[$cnt]."', public='".$public[$cnt]."',tokens=".$paid_tk."  WHERE unique_model_id = '".$userDetails['unique_id']."' AND id='".$socialid[$cnt]."'";
				mysqli_query($con, $sql);
				
			}else{
				$sc_data = array();
					$sc_data['unique_model_id'] = $unique_id;
					$sc_data['platform'] = $sc;
					$sc_data['URL'] = $URL[$cnt];
					$sc_data['status'] = $status[$cnt];
					$sc_data['public'] = $public[$cnt];
					$sc_data['tokens'] = $paid_token[$cnt];
					DB::insert('model_social_link', $sc_data); 
					$created_id = DB::insertId();
			}
			
			$cnt++;
			$string_paltform .= "'".$sc."',";
		}
		// Trim last comma
		$string_paltform = rtrim($string_paltform, ',');
		if(!empty($string_paltform)){
			$sql_delete = "DELETE FROM `model_social_link` WHERE unique_model_id = '".$userDetails['unique_id']."' AND platform NOT IN (".$string_paltform.")";
			mysqli_query($con,$sql_delete);
		}
	} */
	

	$error = '';
	$form_data = DB::queryFirstRow("select id from model_user where id!='".$userDetails['id']."' and lower(username)='".strtolower($_POST['username'])."' ");
	if($form_data){
		$error = 'Username already exist.';
	}
	else{
		$post_data['username'] = $_POST['username'];
	}
	$form_data = DB::queryFirstRow("select id from model_user where id!='".$userDetails['id']."' and lower(email)='".strtolower($_POST['email'])."' ");
	if($form_data){
		$error .= ' Email already exist.';
	}
	else{
		$post_data['email'] = $_POST['email'];
	}
	//$post_data = array_from_get($arr);
	//$post_data['user_id'] = $user_id;
	//$post_data['created_at'] = date('Y-m-d H:i:s');
	
	DB::update('model_user', $post_data, "id=%s", $userDetails['id']);
	if($error){
		//echo '<script>alert("'.$error.'");</script>';
		echo json_encode(['status' => 'Error in saving']);
	}
	
	//Physical attributes save
		$arr_proof = array();
		$arr_proof = array('height_type','weight_type','weight','hair_color','eye_color','ethnicity','body_type','dress_size','bust_size','waist_size','cup_size');
		$post_data_extra = array_from_post($arr_proof);
		$post_data_extra['unique_model_id'] = $unique_id;
		if($_POST['height_type'] == 'ft'){
			$post_data_extra['height'] = $_POST['feet'].'.'.$_POST['inches'];
			$post_data_extra['height_in_cm'] = ($_POST['feet'] * 30.48) + ($_POST['inches'] * 2.54);
		}else{
			$post_data_extra['height'] = $_POST['height_cm'];
			$post_data_extra['height_in_cm'] = $_POST['height_cm'];
		}
		if($_POST['weight_type'] == 'lbs'){
			if(!empty($_POST['weight'])) $post_data_extra['weight_in_kg'] = $_POST['weight'] * 0.45359237;
			else $post_data_extra['weight_in_kg'] = 0;
		}else{
			$post_data_extra['weight_in_kg'] = $_POST['weight'];
		}
		$model_extra_list = DB::query('select id from model_extra_details where unique_model_id="'.$unique_id.'"');
		if(empty($model_extra_list)){
			
			DB::insert('model_extra_details', $post_data_extra); 
			$created_id_extra = DB::insertId();
			
		}else{
			
			DB::update('model_extra_details', $post_data_extra, "unique_model_id=%s", $unique_id);
			
		}
		
	echo json_encode(['status' => 'success']); exit;
	//Profile upload
		$use_id = $_SESSION["log_user_id"];

      $target_dir_profile = "uploads/profile_pic/"; 
	  if (isset($_FILES["pic_img"]) && !empty($_FILES["pic_img"]['name'])) {
      $target_file1 = $target_dir_profile . basename($_FILES["pic_img"]["name"]);
      $target_profile = "uploads/profile_pic/" . basename($_FILES["pic_img"]["name"]);

      if (move_uploaded_file($_FILES["pic_img"]["tmp_name"], $target_file1)){

         // echo '<script>alert("Your Profile Picture Successfully Uploaded");</script>';

          $sql = "UPDATE model_user SET profile_pic = '".$target_profile."' WHERE id = '".$use_id."'";
        
          if(mysqli_query($con, $sql)){
           // echo '<script>alert("Your Profile Picture Successfully Updated");
            // window.location="edit-profile.php"</script>';
          }else{
           /* echo '<script>alert("Profile Picture Not Updated.\nPlease try again later.");
             window.location="edit-profile.php"</script>'; */
			 echo json_encode(['status' => 'Profile Picture Not Updated.\nPlease try again later.']);
          }  

      }else{
          /*echo '<script>alert("Error in Image uploading");
             window.location="edit-profile.php"
            </script>'; */
			echo json_encode(['status' => 'Error in Image uploading']);
      }
	  }
	  
	  //Image gallery upload
		if(isset($_POST['hiddenmedia'])){
			foreach($_POST['hiddenmedia'] as $hid_img){

				$modal_img_list = DB::query('select file from model_images where file="'.$hid_img.'" AND unique_model_id="'.$unique_id.'" AND file_type = "Image" AND category = "Profile" Order by id DESC');
				if(empty($modal_img_list)){
					$post_data = array();
					$post_data['unique_model_id'] = $unique_id;
					$post_data['unique_image_id'] = 'img-'.rand(10,1000);
					$post_data['file_type'] = 'Image';
					$post_data['file'] = $hid_img;
					$post_data['image_text'] = basename($hid_img);
					$post_data['img_type_price'] = 'Free';
					$post_data['coins'] = 0;
					$post_data['category'] = 'Profile';
					$post_data['date'] = date('Y-m-d H:i:s');
					DB::insert('model_images', $post_data); 
					$created_id = DB::insertId();
				}
			
			}
		}
		
		
	
	/*echo '<script>alert("Your Profile Successfully Updated");
	window.location="edit-profile.php"
	</script>'; */
	echo json_encode(['status' => 'success']);

	//die;
    }else if(isset($_POST['service_submit'])){
		$model_unique_id = $_POST['model_unique_id']; 
		
		$arr_proof = array();
		$arr_proof = array('live_cam','private_chat_token','group_chat_tocken','group_show','gs_min_member','gs_token_price','work_escort','in_per_hour','extended_rate','in_overnight','d_a_address','International_tours','daily_rate','weekly_rate','monthly_rate','travel_destination','video_pictures','modeling','all_30day_access','all_30day_access_price','adult_content','hourly_rate','overnight_rate','weekend_rate','adult_content_rate','live_show_rate','professional_rate','professional_service','choose_document');
		$post_data_extra = array_from_post($arr_proof);
		$post_data_extra['unique_model_id'] = $model_unique_id;
		
		if(!empty($_POST['social_availability'])){
			$post_data_extra['social_availability'] = json_encode($_POST['social_availability']);
		}
		if(!empty($_POST['travel_months'])){
			$post_data_extra['travel_months'] = json_encode($_POST['travel_months']);
		}
		if(!empty($_POST['escort_services'])){
			$post_data_extra['escort_services'] = json_encode($_POST['escort_services']);
		}
		if(!empty($_POST['intimate_services'])){
			$post_data_extra['intimate_services'] = json_encode($_POST['intimate_services']);
		}
		if(!empty($_POST['adult_content_types'])){
			$post_data_extra['adult_content_types'] = json_encode($_POST['adult_content_types']);
		} 
		if(!empty($_POST['work_availability'])){
			$post_data_extra['work_availability'] = json_encode($_POST['work_availability']);
		}
		if(!empty($_POST['content_types'])){
			$post_data_extra['content_types'] = json_encode($_POST['content_types']);
		} 
		if(!empty($_POST['adult_content_types'])){
			$post_data_extra['adult_content_types'] = json_encode($_POST['adult_content_types']);
		}
		$model_extra_list = DB::query('select id from model_extra_details where unique_model_id="'.$model_unique_id.'"');
		
		//Proof file
		$target_dir_doc = "uploads/casting/document/";
		  if (isset($_FILES["govt_id_proof"]) && !empty($_FILES["govt_id_proof"]['name'])) {
		  $target_file_doc = $target_dir_doc . basename($_FILES["govt_id_proof"]["name"]);
			  if (move_uploaded_file($_FILES["govt_id_proof"]["tmp_name"], $target_file_doc)){
				$post_data_extra['govt_id_proof'] = "uploads/casting/document/" . basename($_FILES["govt_id_proof"]["name"]);
			  }
		  }
		if(empty($model_extra_list)){
			
			DB::insert('model_extra_details', $post_data_extra); 
			$created_id = DB::insertId();
			
		}else{
			
			DB::update('model_extra_details', $post_data_extra, "unique_model_id=%s", $model_unique_id);
			
		}
		
		echo json_encode(['status' => 'success']);
	
	}/*else if(isset($_POST['submit_pass'])){

      $user_id = $_POST['use_id'];
      $name = $_POST['name'];
      $country = $_POST['country'];
      $current_pass = $_POST['current_pass'];
      $new_password = $_POST['new_password'];
      $confirm_pass = $_POST['confirm_pass'];


        $select = "SELECT * FROM model_user WHERE id = '".$user_id."'";
        $result = mysqli_query($con, $select);
        if(mysqli_num_rows($result) > 0){
          $row1 = mysqli_fetch_array($result);
             $password = $row1['password']; 
        }

        if($password == $current_pass){
              
        if($confirm_pass == $new_password){

          $sql = "UPDATE model_user SET password = '".$new_password."' WHERE id = '".$user_id."'";
        
          if(mysqli_query($con, $sql)){
            echo '<script>alert("Your Password Successfully Updated");
             window.location="edit-profile.php"
            </script>';
          }else{
            echo '<script>alert("Your Password Not Updated");
             window.location="edit-profile.php"
            </script>';
          }  
        
        }else{

            echo '<script>alert("Password and confirm password Doesnt match");
              window.location="edit-profile.php"
            </script>'; 
        }
            
        }else{
            echo '<script>alert("This Password is not in our Records");
                window.location="edit-profile.php"
              </script>';
        }
    }*/
 
?>