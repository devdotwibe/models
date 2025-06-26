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
	$arr = array('name','country','state','city','gender','user_bio','services','relationship','travel_preference'); //,'user_current_status'
	$post_data = array_from_post($arr);
	
	$post_data['dob'] = h_dateFormat($_POST['dob'],'Y-m-d');
	$post_data['age'] = h_get_age($dob);
	
	$unique_id = $_POST['unique_id'];
	
	$post_data['hobbies'] = json_encode($_POST['hobbies']);
	
	$lang_array = array();
	$modal_lang = $_POST['modal_lang'];
	$proficiency = $_POST['proficiency'];
	
	if(!empty($modal_lang)){
		$i = 0;
		foreach($modal_lang as $lng){
			$lang_array[$i]['lan'] = $lng;
			$lang_array[$i]['prof'] = $proficiency[$i];
			$i++;
		}
	}
	$post_data['languages'] = json_encode($lang_array);
	
	//Social icons 
	$platform = $_POST['platform'];
	$URL = $_POST['URL'];
	$status = $_POST['status'];
	$public = $_POST['public'];
	$socialid = $_POST['socialid'];
	if(!empty($platform)){
		$cnt = 0; $string_paltform = '';
		foreach($platform as $sc){
			if(!empty($socialid[$cnt])){
				$sql = "UPDATE model_social_link SET platform = '".$sc."', URL = '".$URL[$cnt]."', status='".$status[$cnt]."', public='".$public[$cnt]."'  WHERE unique_model_id = '".$userDetails['unique_id']."' AND id='".$socialid[$cnt]."'";
				mysqli_query($con, $sql);
			}else{
				$sc_data = array();
					$sc_data['unique_model_id'] = $unique_id;
					$sc_data['platform'] = $sc;
					$sc_data['URL'] = $URL[$cnt];
					$sc_data['status'] = $status[$cnt];
					$sc_data['public'] = $public[$cnt];
					
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
	}
	

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
		echo '<script>alert("'.$error.'");</script>';
	}
	
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
            echo '<script>alert("Profile Picture Not Updated.\nPlease try again later.");
             window.location="edit-profile.php"</script>';
          }  

      }else{
          echo '<script>alert("Error in Image uploading");
             window.location="edit-profile.php"
            </script>';
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
		
	  //Gallery 1
	  /*if (isset($_FILES["gallery_photo_1"]) && !empty($_FILES["gallery_photo_1"]['name'])) {
		  $target_file2 = $target_dir_profile . basename($_FILES["gallery_photo_1"]["name"]);
		  $target_profile = "uploads/profile_pic/" . basename($_FILES["gallery_photo_1"]["name"]);

		  if (move_uploaded_file($_FILES["gallery_photo_1"]["tmp_name"], $target_file2)){ 
			$sql = "UPDATE model_user SET gallery_photo_1 = '".$target_profile."' WHERE id = '".$use_id."'";
			if(mysqli_query($con, $sql)){
				
			}
		  }
	  }
	  //Gallery 2
	  if (isset($_FILES["gallery_photo_2"]) && !empty($_FILES["gallery_photo_2"]['name'])) {
		  $target_file3 = $target_dir_profile . basename($_FILES["gallery_photo_2"]["name"]);
		  $target_profile = "uploads/profile_pic/" . basename($_FILES["gallery_photo_2"]["name"]);

		  if (move_uploaded_file($_FILES["gallery_photo_2"]["tmp_name"], $target_file3)){
			$sql = "UPDATE model_user SET gallery_photo_2 = '".$target_profile."' WHERE id = '".$use_id."'";
			if(mysqli_query($con, $sql)){
				
			}
		  }
	  }*/
	//End
	
	
	echo '<script>alert("Your Profile Successfully Updated");
	window.location="edit-profile.php"
	</script>';
	die;
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