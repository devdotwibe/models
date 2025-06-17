<?php
session_start();
include('../includes/config.php');
if (isset($_POST["upload_data"])) {

    //$log_user_id = $_SESSION["log_user_unique_id"];
    $coins = $_POST["coins"];
    $u_name = $_POST["u_name"];
    $u_email = $_POST["u_email"];
    $u_id = $_POST["u_id"];
    $bank_name_branch = $_POST["bank_name_branch"];
    $account_h_name = $_POST["account_h_name"];
    $acc_num = $_POST["acc_num"];
    $ifsc_code = $_POST["ifsc_code"];

    // $que = "INSERT INTO `model_extra_details`(`unique_model_id`, `live_cam`, `group_show`, `gs_min_member`, `gs_token_price`, `International_tours`, `two_hour_rates`, `four_hour_rates`, `nght_rates`, `modeling_porn_assignment`, `shoot_per_hour_price`) VALUES ('".$log_user_id."','".$live_cam."','".$group_show."','".$min_member."','".$t_price_member."','".$inter_tour."','".$to_hour."','".$for_hour."','".$overnight."','".$modeling_porn_assignment."','".$perhourshoot."')";

    $que = "INSERT INTO `withdrow_request`(`coins`, `user_id`, `user_email`, `user_name`, `bank_name_branch`, `account_h_name`, `account_number`, `ifsc_code`) VALUES ('".$coins."','".$u_id."','".$u_name."','".$u_email."','".$bank_name_branch."','".$account_h_name."','".$acc_num."','".$ifsc_code."')";
 
    if(mysqli_query($con,$que)){
 
      echo '<script>alert("Thanks\nYour Request has been successfully sent to admin.\nAdmin will Pay your amount to you bank in next 5-7 working days.")</script>';
      $email_to = "prashant.systos@gmail.com";
         $subject = "Amount Withdrow request From '".$u_name."'";

         $header = "From: The Live Models <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;height: 500px;">
            <img src="https://thelivemodels.com/assets/wp-content/themes/theagency3/images/default-bg.jpg" style="width: 100%;height: 100%;">
          </div>
          <div style="padding: 20px;">
          <h2>Dear Admin, </h2>
          <p>One of model user has sent a amount withdrawal request to you. Please accept and pay tha respective amount for it.
          <p>Please check details here:</p>
            <table style="width:100%">
              <tr>
                <td><b>Coins submitted</b></td>
                <td>'.$coins.'</td>
              </tr>
              <tr>
                <td>User Details</td>
              </tr>
              <tr>
                <td><b>User id</b></td>
                <td>'.$u_id.'</td>
              </tr>
              <tr>
                <td><b>User Name</b></td>
                <td>'.$u_name.'</td>
              </tr>
              <tr>
                <td><b>Email</b></td>
                <td>'.$u_email.'</td>
              </tr>
              <tr>
                <td>Bank Details</td>
              </tr>
              <tr>
                <td><b>Bank name & Branch</b></td>
                <td>'.$bank_name_branch.'</td>
              </tr>
              <tr>
                <td><b>Account Holder name</b></td>
                <td>'.$account_h_name.'</td>
              </tr>
              <tr>
                <td><b>Account Number</b></td>
                <td>'.$acc_num.'</td>
              </tr>
              <tr>
                <td><b>IFSC Code</b></td>
                <td>'.$ifsc_code.'</td>
              </tr>
            </table>
          </div>
          </body>
         </html>';

         if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="amount-withdrawal.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="amount-withdrawal.php"</script>';
         }

      
         
    }else {
      echo '<script>alert("Oops! Fund some Error in Request sending.\nPlease try again after some time.")
              window.location="amount-withdrawal.php"</script>';
          }
      
    }
?>