<?php  session_start(); ?>
<?php include('../includes/config.php'); ?>
<?php
    if( isset($_POST['action']) && !empty($_POST['action']) ) {
        if( $_POST['action'] == 'tlm_msg_send_action' ) {
            if( isset($_POST['model_id']) ) {
                $date = date("d-m-Y");
                $time = date("H:i");
                if(file_exists($_POST['model_id'].'.txt')){
                }else{
                    $myfile = fopen($_POST['model_id'].'.txt', "w"); 
                }
                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                $message = htmlentities(strip_tags($_POST['msg']));
                if(($message) != "\n"){
                    if(preg_match($reg_exUrl, $message, $url)) {
                        $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
                    }
                    $name = isset($_SESSION['log_user'])?$_SESSION['log_user']:'unknown';
                fwrite(fopen($_POST['model_id'].'.txt', 'a'), "<li class='str_chat_li'><div class='str_chat_message'><div class='str_chat_mess_left'><div class='str_chat_avtar'><img src='../uploads/profile_pic/icons-user.jpg' class='img-fluid'></div></div><div class='str_chat_mess_right'><div class='str_chat_list_con'><div class='str_live_chat_author'><strong>$name</strong><span class='tlm_msg_date_time'>$time | $date</span></div><div class='str_content'><p>$message</p></div></div></div></div></li>\n");    	
                }
                echo json_encode('success');
            }
        }
        if( $_POST['action'] == 'tlm_privatemsg_send_action' ) {
            if( isset($_POST['model_id']) ) {
                $date = date("d-m-Y");
                $time = date("H:i");
                if(file_exists($_POST['model_id'].'prav'.'.txt')){
                }else{
                    $myfile = fopen($_POST['model_id'].'prav'.'.txt', "w"); 
                }
                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                $message = htmlentities(strip_tags($_POST['msg']));
                if(($message) != "\n"){
                    if(preg_match($reg_exUrl, $message, $url)) {
                        $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
                    }
                    $name = isset($_SESSION['log_user'])?$_SESSION['log_user']:'unknown';
                fwrite(fopen($_POST['model_id'].'prav'.'.txt', 'a'), "<li class='str_chat_li'><div class='str_chat_message'><div class='str_chat_mess_left'><div class='str_chat_avtar'><img src='../uploads/profile_pic/icons-user.jpg' class='img-fluid'></div></div><div class='str_chat_mess_right'><div class='str_chat_list_con'><div class='str_live_chat_author'><strong>$name</strong><span class='tlm_msg_date_time'>$time | $date</span></div><div class='str_content'><p>$message</p></div></div></div></div></li>\n");    	
                }
                echo json_encode('success');
            }
        }
        if( $_POST['action'] == 'tlm_msg_get_action' && isset($_POST['key']) ) {
            if( file_exists($_POST['key'].'.txt') ) {
                $lines = file($_POST['key'].'.txt');
             }
             $count =  count($lines);
             if( $count > 0 ){
                $log = array();
                $text=[];
                 // var_dump($_POST['line_number']);
                 // if( isset($POST['line_number']) && $_POST['line_number'] == '' ) {
                 // 	$number =sanitize_text_field($_POST['line_number']);
                 // 	var_dump($number);
                 // }else{

                 // 	$number = 0;
                // }
                    // $log['state'] = $state + count($lines) - $state;
                if( $_POST['line_number'] != '' && isset($_POST['line_number']) ) {
                    $line_get_num = $_POST['line_number'];
                }else{
                    $line_get_num = -1;
                }
                if(isset($lines) && !empty($lines) && is_array($lines) ) {
                    foreach ($lines as $line_num => $line){
                        if($line_num > $line_get_num){
                            $text[] = str_replace("\n", "", $line);
                            $num = $line_num;
                        }else{
                            $num = $line_get_num;
                        }
                    }
                }else{
                    $num = $line_get_num;
                } 
            }
            $log['line'] = $num;
            $log['text'] = $text;
            $log['key'] = $key;
            echo json_encode($log);
        }
        if( $_POST['action'] == 'tlm_privatemsg_get_action' && isset($_POST['key']) ) {
            if( file_exists($_POST['key'].'prav'.'.txt') ) {
                $lines = file($_POST['key'].'prav'.'.txt');
             }
             $count =  count($lines);
             if( $count > 0 ){
                $log = array();
                $text=[];
                 // var_dump($_POST['line_number']);
                 // if( isset($POST['line_number']) && $_POST['line_number'] == '' ) {
                 // 	$number =sanitize_text_field($_POST['line_number']);
                 // 	var_dump($number);
                 // }else{

                 // 	$number = 0;
                // }
                    // $log['state'] = $state + count($lines) - $state;
                if( $_POST['line_number'] != '' && isset($_POST['line_number']) ) {
                    $line_get_num = $_POST['line_number'];
                }else{
                    $line_get_num = -1;
                }
                if(isset($lines) && !empty($lines) && is_array($lines) ) {
                    foreach ($lines as $line_num => $line){
                        if($line_num > $line_get_num){
                            $text[] = str_replace("\n", "", $line);
                            $num = $line_num;
                        }else{
                            $num = $line_get_num;
                        }
                    }
                }else{
                    $num = $line_get_num;
                } 
            }
            $log['line'] = $num;
            $log['text'] = $text;
            $log['key'] = $key;
            echo json_encode($log);
        }
        if( isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'tlm_get_total_user' && isset($_POST['user']) ) {
            $html = '';
            foreach( $_POST['user'] as $key => $value ) {
                $que = mysqli_query($con ,"SELECT * FROM model_user WHERE id = '".$value."'");
                while($row = mysqli_fetch_array($que)){   
                    $user_name = preg_replace('/\s+/', ' ', $row['name']);
                    $html .= ' '.$user_name."\n";
                }
            }
            // print_r($html);
            if(file_exists('total_user'.$_POST['model_id'].$_POST['user_id'].'.txt')){
            }else{
                $myfile = fopen('total_user'.$_POST['model_id'].$_POST['user_id'].'.txt', "w"); 
            }
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
            $message = htmlentities(strip_tags($_POST['msg']));
            if( isset($_POST['tlm_user_name']) && $_POST['tlm_user_name'] == 'streamer' ){
                if(preg_match($reg_exUrl, $message, $url)) {
                    $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
                }
                // $name = isset($_SESSION['log_user'])?$_SESSION['log_user']:'unknown';
            fwrite(fopen('total_user'.$_POST['model_id'].$_POST['user_id'].'.txt', 'w'), $html);    	
            }
            if( file_exists('total_user'.$_POST['model_id'].$_POST['user_id'].'.txt') ) {
                $lines = file('total_user'.$_POST['model_id'].$_POST['user_id'].'.txt');
             }
             $count =  count($lines);
             if( $count > 0 ){
                $log = array();
                $text=[];
                 // var_dump($_POST['line_number']);
                 // if( isset($POST['line_number']) && $_POST['line_number'] == '' ) {
                 // 	$number =sanitize_text_field($_POST['line_number']);
                 // 	var_dump($number);
                 // }else{

                 // 	$number = 0;
                // }
                    // $log['state'] = $state + count($lines) - $state;
                if( $_POST['line_number'] != '' && isset($_POST['line_number']) ) {
                    $line_get_num = $_POST['line_number'];
                }else{
                    $line_get_num = -1;
                }
                if(isset($lines) && !empty($lines) && is_array($lines) ) {
                    foreach ($lines as $line_num => $line){
                        if($line_num > $line_get_num){
                            $text[] = str_replace("\n", "", $line);
                            $num = $line_num;
                        }else{
                            $num = $line_get_num;
                        }
                    }
                }else{
                    $num = $line_get_num;
                } 
            }else{
                $num = 0;
                // $log['text'] = 'No User Active';
            }
            $log['line'] = $num;
            $log['text'] = $text;
            $log['key'] = $key;
            echo json_encode($log);
        }
        if( isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'tlm_send_tip_action' && isset($_POST['user']) ) {
            $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
            $result = mysqli_query($con,$sql);
            $wallet_coins = 0;
            if (mysqli_num_rows($result) > 0) {
                $row1 = mysqli_fetch_assoc($result);
                $wallet_coins = $row1['wallet_coins'];
            }
            if( $wallet_coins > 0 ) {
                $Total_coins =  $wallet_coins - $_POST["coin"];
                $query2 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$Total_coins."' WHERE `model_user_wallet`.`user_unique_id` = '".$_SESSION["log_user_unique_id"]."'";
                if ( mysqli_query($con,$query2) ) {
                    echo json_encode('success');
                }else{
                    echo json_encode('faile');
                }
            }
        }
        if( isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'tlm_send_notification_action' && isset($_POST['user']) ) {
            // print_r($_POST);
            if( isset($_POST['key']) && $_POST['user'] ) {
                $meta[] = array(
                    'user_id' => $_POST['user'],
                    'status' => 'pending'
                );
                $sql = "UPDATE tlm_live_model_notifications SET meta='".serialize($meta)."' WHERE user_model_id='".$_POST['key']."'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully1";
                } else {
                    echo "Error updating record: " . $con->error;
                    $sql = "INSERT INTO tlm_live_model_notifications (user_model_id, userid, meta) VALUES ('".$_POST['key']."', ' ', '".serialize($meta)."')";
                    if ($con->query($sql) === TRUE) {
                        echo "Success";
                    } else {
                        echo "false";
                    }
                }
            }
        }
        if( isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'tlm_private_chat_action' && isset($_POST['user']) ) {
            $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$_SESSION["log_user_unique_id"]."'";
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0) {
                $row1 = mysqli_fetch_assoc($result);
                $wallet_coins = $row1['wallet_coins'];
            }
            if( $wallet_coins > 0 ) {
                $Total_coins =  $wallet_coins - $_POST["coin"];
                $query2 = "UPDATE `model_user_wallet` SET `wallet_coins` = '".$Total_coins."' WHERE `model_user_wallet`.`user_unique_id` = '".$_SESSION["log_user_unique_id"]."'";
                if ( mysqli_query($con,$query2) ) {
                    $sql = "SELECT * FROM tlm_private_live_chat_url WHERE model_id='".$_POST['key']."'";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $sql = "UPDATE tlm_private_live_chat_url SET video_url='https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id=".$_POST["key"]."&pra=private' WHERE id=".$row['id'];
                            if ($con->query($sql) === TRUE) {
                                echo json_encode('success');
                            } else {
                            }
                        }
                    }else{
                        $sql = "INSERT INTO tlm_private_live_chat_url (model_id, video_url, meta)VALUES ('".$_POST["key"]."', 'https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id=".$_POST["key"]."&pra=private', '')";
                        if ($con->query($sql) === TRUE) {
                           echo json_encode('success');
                        } else {
                        echo "Error: " . $sql . "<br>" . $con->error;
                        }
                    }
                }else{
                    echo json_encode('faile');
                }
            }else{
                echo json_encode('faile');
            }
        }
        if( isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'tlm_private_chat_url_action' && isset($_POST['user']) ) {
            $sql = "SELECT * FROM tlm_private_live_chat_url WHERE model_id='".$_POST["key"]."'";
            $result = $con->query($sql);
            // print_r($result);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if( isset($row['video_url']) && $row['video_url'] == 'true' ) {
                        $bool = 'success';
                    }
                }
            }
            echo json_encode($bool);
        }
        if( isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'tlm_check_url_action' && isset($_POST['user']) ) {
            $sql = "SELECT * FROM tlm_private_live_chat_url WHERE model_id='".$_POST["key"]."'";
            $result = $con->query($sql);
            // print_r($result);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if( isset($row['video_url']) && $row['video_url'] != '' ) {
                        $bool = 'success';
                    }
                }
            }
            echo json_encode($bool);
        }
    }
    die();