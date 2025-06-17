<?php
session_start();
include('../includes/config.php');
if (isset($_POST["submitButton"])) {
    // echo "ok";
     $log_user_id = $_SESSION["log_user_unique_id"];
    
    $currency = $_POST["currency"];
    $one_hours_inr = $_POST["one_hours_price"];
    $two_hours_inr = $_POST["two_hours_price"];
    $thre_hours_inr = $_POST["three_hours_price"];
    $four_hours_inr = $_POST["four_hours_price"];
    $one_day_inr = $_POST["one_day_price"];
    $two_day_inr = $_POST["two_day_price"];
    $special_event_inr = $_POST["special_event_price"];

    $que = "INSERT INTO `model_rate`(`m_unique_id`, `price_in`, `one_hours_price`, `two_hours_price`, `three_hours_price`, `four_hours_price`, `one_day_price`, `two_day_price`, `special_event_price`) VALUES ('".$log_user_id."','".$currency."','".$one_hours_inr."','".$two_hours_inr."','".$thre_hours_inr."','".$four_hours_inr."','".$one_day_inr."','".$two_day_inr."','".$special_event_inr."')";
 

    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Your Rate Successfully Added.")
      window.location="model-rates.php"</script>';
      
         
    }else {
            echo '<script>alert("Oops! Fund some Error in Rates Addition.")
              window.location="model-rates.php"
              </script>';
          }
      
    }
?>