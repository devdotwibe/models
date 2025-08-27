<?php 
session_start(); 
include('../includes/config.php');
include('../includes/helper.php');


    if (isset($_POST['city'], $_POST['state'])) {

        $city  = trim($_POST['city']);
        $state = intval($_POST['state']);

        $check = DB::queryFirstRow(
            "SELECT id FROM cities WHERE state_id=%i AND name=%s",
            $state, $city
        );

        if ($check) {

            echo json_encode(['message'=>'exist']);

            exit;

        } else {
            
             echo json_encode(['message'=>'not exist']);
             exit;
        }
    }
?>
