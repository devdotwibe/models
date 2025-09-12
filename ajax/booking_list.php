<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');


    if(isset($_SESSION['log_user_id'])){

        if (isset($_GET['action']) && $_GET['action'] === 'fetch_booking_list') {


            $user_unique_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
            $perPage = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $perPage;

                $model_bookings = DB::query(
                    "SELECT * 
                    FROM model_booking 
                    WHERE model_unique_id = %s 
                    ORDER BY id DESC 
                    LIMIT %i OFFSET %i", 
                    $user_unique_id, $perPage, $offset
                );

                $totalRows = DB::queryFirstField(
                    "SELECT COUNT(*) 
                    FROM model_booking 
                    WHERE model_unique_id = %s", 
                    $user_unique_id
                );

                foreach($model_bookings as $key => $booking) {

                    // $user_info = DB::queryFirstRow("SELECT username, profile_pic FROM model_user WHERE user_unique_id = %s", $booking['user_unique_id']);

                    // $model_bookings[$key]['username'] = $user_info ? $user_info['username'] : 'Unknown';

                    // $model_bookings[$key]['profile_pic'] = $user_info ? $user_info['profile_pic'] : '';

                  $bookeduser = DB::queryFirstRow("SELECT name FROM model_user WHERE unique_id =  %s ", $booking['user_unique_id']);

                    $defaultImage =SITEURL."/assets/images/girl.png";

                    if($bookeduser['gender']=='Male'){

                        $defaultImage =SITEURL."/assets/images/profile.jpg";
                    }

                    if(!empty($bookeduser['profile_pic']))
                    {
                        if (checkImageExists($bookeduser['profile_pic'])) {
                    
                            $defaultImage = SITEURL . $bookeduser['profile_pic'];
                        }
                    }

                  if (!empty($booking['meeting_date'])) {

                        $timestamp = strtotime($booking['meeting_date']);

                        $model_bookings[$key]['meeting_date'] = date('M j, Y', $timestamp);

                    } else {

                        $model_bookings[$key]['meeting_date'] = '';
                
                    }

                    $model_bookings[$key]['user_profile_pic'] = $defaultImage;

                    $model_bookings[$key]['booked_name'] = $bookeduser['name'];
                
                }

                $totalPages = ceil($totalRows / $perPage);

                $response = [
                    'status' => 'success',
                    'data' => $model_bookings,
                    'total' => $totalRows,
                    'total_page' => $totalPages,
                    'page' => $page
                ];

           echo json_encode($response);
            exit;
        }
       
          echo json_encode([]);
          exit;
    }
?>
