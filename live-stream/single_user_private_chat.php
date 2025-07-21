<?php session_start();
include('../includes/config.php');
include('../includes/helper.php');
$ChatLink  = SITEURL . 'live-chat/';
$output = array('status' => 'error', 'message' => 'there is some problem');

        if ($_SESSION["log_user"]) {
            $userDetails = get_data('model_user', array('id' => $_SESSION['log_user_id']), true);
            if (!$userDetails) {
                $output['message'] = 'Please login first!!';
                echo json_encode($output);
                die;
            }
        } else {
            $output['message'] = 'Please login first!!';
            echo json_encode($output);
            die;
        }

        if($_GET['private_id']){

            $id = $_GET['private_id'];

            $string = "SELECT tb.*, ms.username, ms.profile_pic, ms.id AS userid 
               FROM tlm_private_live_chat_url tb 
               JOIN model_user ms ON ms.id = tb.user_id 
               WHERE is_used = 0 AND tb.status = 1 AND tb.id = " . intval($id);

            $checPrivate = DB::queryFirstRow($string);

            if (!$checPrivate) {
                $output['message'] = 'Invalid or expired chat link.';

                echo json_encode($output);
                exit;
            }

            $user_id = $checPrivate['user_id'];

            $model_id = $checPrivate['model_id'];

            $filename = 'total_user' . $model_id . $user_id . '.txt';

            if (!file_exists($filename)) {

                $output['message'] = 'file_not_fount';

                echo json_encode($output);
                die;
            }

            $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $text = [];

            foreach ($lines as $line_num => $line) {
                $text[] = trim($line);
            }

            $output = array(
                'status' => 'ok',
                'message' => 'User list loaded successfully',
                'lines' => $text
            );

        }

        echo json_encode($output);

die();
