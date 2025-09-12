<?php

session_start(); 
include('../../includes/config.php');
include('../../includes/helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['action']) && $_POST['action'] =='post_submit' )
    {
        $user_id      = $_POST['user_id'] ?? null;
        $post_title   = trim($_POST['post_title'] ?? '');
        $post_content = trim($_POST['post_content'] ?? '');

        $post_mime_type = trim($_POST['file_type'] ?? '');
        $post_type = trim($_POST['post_type'] ?? '');

        $token = !empty($_POST['token']) ? $_POST['token'] : null;

        if ($post_type === 'paid' && empty($token)) {
            echo "Token is required for paid posts.";
            exit;
        }

        $allowed_mime_types = ['Image', 'Video'];
        if (!in_array($post_mime_type, $allowed_mime_types)) {
            echo "Invalid file type. Only 'image' or 'video' allowed.";
            exit;
        }

        $image_path   = null;

        $upload_folder_relative = '../../uploads/post_image/';
        $upload_folder_for_db   = 'uploads/post_image/';

        if (!is_dir($upload_folder_relative)) {
            mkdir($upload_folder_relative, 0755, true);
        }

        if (isset($_FILES["post_image"]) && $_FILES["post_image"]["error"] === 0) {

                $file_size = $_FILES["post_image"]["size"];
                $file_tmp  = $_FILES["post_image"]["tmp_name"];
                $filename  = uniqid() . '_' . basename($_FILES["post_image"]["name"]);
                $target_file = $upload_folder_relative . $filename;

                $file_mime_type = mime_content_type($file_tmp);

                if ($post_mime_type === 'Image') {
                    if (strpos($file_mime_type, 'image/') !== 0) {
                        echo "Uploaded file must be an image.";
                        exit;
                    }

                    if ($file_size > 5 * 1024 * 1024) {
                        echo "Image size must not exceed 5MB.";
                        exit;
                    }
                }

                if ($post_mime_type === 'Video') {
                    if (strpos($file_mime_type, 'video/') !== 0) {
                        echo "Uploaded file must be a video.";
                        exit;
                    }

                    if ($file_size > 20 * 1024 * 1024) {
                        echo "Video size must not exceed 20MB.";
                        exit;
                    }
                }

                if (move_uploaded_file($file_tmp, $target_file)) {
                    $image_path = $upload_folder_for_db . $filename;
                } else {
                    echo "Image/Video upload failed.";
                    exit;
                }
            }

        $stmt = $con->prepare("INSERT INTO live_posts (post_author, post_title, post_content, post_image,post_mime_type,post_type,token,post_date, post_date_gmt) VALUES (?, ?, ?, ? ,? , ?, ?, NOW(), NOW())");
        $stmt->bind_param("issssss", $user_id, $post_title, $post_content, $image_path,$post_mime_type,$post_type,$token);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Database error: " . $stmt->error;
        }
    }


    if(isset($_POST['action']) && $_POST['action'] =='story_submit' )
    {
        $user_id      = $_POST['user_id'] ?? null;

        $story_description   = trim($_POST['story_description'] ?? '');
     
        $image_path   = null;

        $upload_folder_relative = '../../uploads/story_image/';
        $upload_folder_for_db   = 'uploads/story_image/';

        if (!is_dir($upload_folder_relative)) {
            mkdir($upload_folder_relative, 0755, true);
        }

        if (isset($_FILES["story_image"]) && $_FILES["story_image"]["error"] === 0) {

                $file_size = $_FILES["story_image"]["size"];
                $file_tmp  = $_FILES["story_image"]["tmp_name"];
                $filename  = uniqid() . '_' . basename($_FILES["story_image"]["name"]);
                $target_file = $upload_folder_relative . $filename;


                if (move_uploaded_file($file_tmp, $target_file)) {
                    $image_path = $upload_folder_for_db . $filename;
                } else {
                    echo "Image/Video upload failed.";
                    exit;
                }
        }

        $stmt = $con->prepare("INSERT INTO model_user_story (user_id,files,message,created_date) VALUES (?, ?, ?, NOW())");

        $stmt->bind_param("iss", $user_id, $image_path, $story_description);

        if ($stmt->execute()) {

            echo json_encode([
                "status" => "success",
                "message" => "Story submitted successfully"
            ]);

        } else {

            echo "Database error: " . $stmt->error;
        }
    }


    if(isset($_POST['action']) && $_POST['action'] =='pay_access' )
    {
        $user_id      = $_POST['user_id'] ?? null;

        $model_id      = $_POST['model_id'] ?? null;

     
        if($_POST['model_id'] == $_POST['user_id']){

			echo '<script>alert("You cant get all access your own profile.");</script>';
			echo '<script>window.history.back();</script>';
		}

                if($_POST['model_id'] && $_POST['user_id']){

                    $modelDetails = get_data('model_user',array('unique_id'=>$_POST['model_id']),true);

                    $userDetails = get_data('model_user',array('id'=>$_POST['user_id']),true);

                    $sql_ap = "SELECT * FROM model_extra_details WHERE unique_model_id = '".$_POST['model_id']."'";

                    $model_data = DB::queryFirstRow($sql_ap);

                    if($modelDetails&&$model_data){

                        if($model_data['all_30day_access_price']>0){

                            if($userDetails['balance'] >= $model_data['all_30day_access_price']){

                                $coins = $model_data['all_30day_access_price'];
                                $sql = "INSERT INTO `user_all_access`(`model_id`, `user_id`, `start_date`, `end_date`, `status`) VALUES ('".$_POST['model_id']."','".$userDetails['unique_id']."','".date("Y-m-d")."','".date('Y-m-d', strtotime("+30 days"))."','1')";

                                $date = date('Y-m-d H:i:s');

                                DB::query($sql);

                                DB::query("UPDATE model_user SET balance=round(%d+balance) WHERE id=%s", $coins, $modelDetails['id']);
                        
                                DB::query("UPDATE model_user SET balance=round(balance-%d) WHERE id=%s", $coins, $userDetails['id']);


                                	DB::insert('model_user_transaction_history', array(
                                        'user_id' => $userDetails['id'],
                                        'other_id' => $model_data['id'],
                                        'amount' => $coins,
                                        'type' => 'all_access_model',
                                        'created_at' => $date,
                                    ));

                                    // echo '<script>alert("You have successfully subscribe 30 days all access. It will reflect at your profile within 2-3 hour.");</script>';
                                    // echo '<script>window.history.back();</script>';	

                                    echo json_encode([
                                        "status" => "success",
                                        "message" => "You have successfully subscribe 30 days all access. It will reflect at your profile within 2-3 hour."
                                    ]);
                            }

                            else{
                                // echo '<script>alert("Oops !! You have unsufficient coin to get all access. Please recharge your wallet. ");</script>';
                                // echo '<script>window.location.href="wallet.php";</script>';

                                echo json_encode([
                                    "status" => "error",
                                    "message" => "Oops !! You have unsufficient coin to get all access. Please recharge your wallet. ",
                                    "userDetails"=>$userDetails['balance'],
                                     "model_data"=>$model_data['all_30day_access_price'],
                                ]);
                            }   
                        }
                        else{

                            // echo '<script>alert("Sorry!! Model has no coin to get all access.");</script>';
                            // echo '<script>window.history.back();</script>';

                            echo json_encode([
                                "status" => "error",
                                "message" => "Sorry!! Model has no coin to get all access. "
                            ]);
                        }   
                    }
                    else{
                        // echo '<script>alert("There is no model.");</script>';
                        // echo '<script>window.history.back();</script>';

                        echo json_encode([
                            "status" => "error",
                            "message" => "There is no model. "
                        ]);
                    }
                    
                }
                else{
                    // echo '<script>alert("Something went wrong. please try again later.");</script>';
                    // echo '<script>window.history.back();</script>';

                    echo json_encode([
                        "status" => "error",
                        "message" => "Something went wrong. please try again later. "
                    ]);
                }

    }

    if (isset($_POST['action']) && $_POST['action'] == 'blocked_user') {

            $user_id = $_POST['user_id'] ?? null;

            $blocked_user_id = $_POST['blocked_user_id'] ?? null;

            if ($user_id && $blocked_user_id) {
        
                // DB::insertIgnore("block_users", [
                //     "user_id" => $user_id,
                //     "blocked_user_id" => $blocked_user_id
                // ]);

                $date = date('Y-m-d H:i:s');

                    $exists = DB::queryFirstField(
                        "SELECT COUNT(*) FROM block_users WHERE user_id = %i AND blocked_user_id = %i",
                        $user_id,
                        $blocked_user_id
                    );

                    if ($exists > 0) {

                        echo json_encode([
                            "status"  => "error",
                            "message" => "You already blocked this user"
                        ]);

                    } else {
                        DB::insert('block_users', array(
                            'user_id'        => $user_id,
                            'blocked_user_id'=> $blocked_user_id,
                            'created_at'     => $date,
                            'updated_at'     => $date
                        ));

                        echo json_encode([
                            "status" => "success",
                            "blocked_users" => 'successfully updated'
                        ]);

            
                    }

            } else {
                echo json_encode([
                    "status"  => "error",
                    "message" => "Both user_id and blocked_user_id are required"
                ]);
            }
        }


    if (isset($_POST['action']) && $_POST['action'] == 'report_user') {

            $user_id = $_POST['user_id'] ?? null;

            $reported_user_id = $_POST['reported_user_id'] ?? null;

            $description = $_POST['description'] ?? null;

            $image_path   = null;

            $upload_folder_relative = '../../uploads/attachment/';
            $upload_folder_for_db   = 'uploads/attachment/';

            if (!is_dir($upload_folder_relative)) {
                mkdir($upload_folder_relative, 0755, true);
            }

            if (isset($_FILES["attachment"]) && $_FILES["attachment"]["error"] === 0) {

                    $file_size = $_FILES["attachment"]["size"];
                    $file_tmp  = $_FILES["attachment"]["tmp_name"];
                    $filename  = uniqid() . '_' . basename($_FILES["attachment"]["name"]);
                    $target_file = $upload_folder_relative . $filename;


                    if (move_uploaded_file($file_tmp, $target_file)) {
                        $image_path = $upload_folder_for_db . $filename;
                    } 
            }

            if ($user_id && $reported_user_id) {
        
                $date = date('Y-m-d H:i:s');

                    $exists = DB::queryFirstField(
                        "SELECT COUNT(*) FROM user_reports WHERE user_id = %i AND reported_user_id = %i",
                        $user_id,
                        $reported_user_id
                    );

                    if ($exists > 0) {

                        echo json_encode([
                            "status"  => "error",
                            "message" => "You already Reported this user"
                        ]);

                    } else {
                        DB::insert('user_reports', array(
                            'user_id'        => $user_id,
                            'reported_user_id'=> $blocked_user_id,
                            'description'=>$image_path,
                            'attachment'=>$attachment,
                            'created_at'     => $date,
                            'updated_at'     => $date
                        ));

                        echo json_encode([
                            "status" => "success",
                            "reported_users" => 'successfully updated'
                        ]);

            
                    }

            } else {
                echo json_encode([
                    "status"  => "error",
                    "message" => "Both user_id and reported_user_id are required"
                ]);
            }
        }

    }

    if (isset($_GET['action']) && $_GET['action'] == 'get_stories') {

        $user_id = $_GET['user_id'] ?? null;

        if ($user_id) {
    
           $stores = DB::query(
                "SELECT * FROM model_user_story WHERE user_id = %i ORDER BY created_date DESC",
                $user_id
            );

            foreach($stores as &$item)
            {
                $item['image_url'] = SITEURL . $item['files'];
            }

            unset($item);

            echo json_encode([
                "status" => "success",
                "data"   => $stores
            ]);
        } else {
            echo json_encode([
                "status"  => "error",
                "message" => "User ID is required"
            ]);
        }
    }


 




