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

                    $user_info = DB::queryFirstRow("SELECT username, profile_pic FROM model_user WHERE user_unique_id = %s", $booking['user_unique_id']);

                    $model_bookings[$key]['username'] = $user_info ? $user_info['username'] : 'Unknown';

                    $model_bookings[$key]['profile_pic'] = $user_info ? $user_info['profile_pic'] : '';

                  if (!empty($booking['created_at'])) {

                        $timestamp = strtotime($booking['created_at']);

                        $model_bookings[$key]['created_date'] = date('M j, Y', $timestamp);

                        $model_bookings[$key]['created_time'] = date('g:i A', $timestamp);
                        
                    } else {

                        $model_bookings[$key]['created_date'] = '';
                        $model_bookings[$key]['created_time'] = '';
                    }
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
