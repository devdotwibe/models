<?php

include('includes/config.php');
if (isset($_POST['submit'])) {

   $user_name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $fullname = $_POST['fullname'];
   $uni_id = $_POST['uni_id'];
   
   $dob=$_POST['dob'];
   $start_work=$_POST['start-work'];
   $city=$_POST['city'];
   $state=$_POST['state'];
   $country=$_POST['country'];
   $short_bio=$_POST['short-bio'];
   $bust_size=$_POST['bust-size'];
   $cup_size=$_POST['cup-size'];
   $waist_size=$_POST['waist-size'];
   $ethnicity=$_POST['ethnicity'];
   $height=$_POST['height'];
   $weight=$_POST['weight'];
   $eye_color=$_POST['eye-color'];
   $hair_color=$_POST['hair-color'];
   $travel=$_POST['travel'];
   $available=$_POST['available'];
   $languages = $_POST['languages'];
    
 $target_dir_photo = "uploads/casting/image/";
 $target_dir_video = "uploads/casting/video/";
 $target_dir_document = "uploads/casting/document/";


  $target_file1 = $target_dir_photo . basename($_FILES["photo-1"]["name"]);
  $target_file2 = $target_dir_photo . basename($_FILES["photo-2"]["name"]);
  $target_file3 = $target_dir_photo . basename($_FILES["photo-3"]["name"]);
  $target_file4 = $target_dir_video . basename($_FILES["video"]["name"]);
  $target_file5 = $target_dir_document . basename($_FILES["id-proof"]["name"]);
  
  if (move_uploaded_file($_FILES["photo-1"]["tmp_name"], $target_file1) && move_uploaded_file($_FILES["photo-2"]["tmp_name"], $target_file2) && move_uploaded_file($_FILES["photo-3"]["tmp_name"], $target_file3) && move_uploaded_file($_FILES["video"]["tmp_name"], $target_file4) && move_uploaded_file($_FILES["id-proof"]["tmp_name"], $target_file5)) {



    echo "<script>alert('Status: Photo Successfully Uploaded')</script>";

       $que = "INSERT INTO `casting` (`unique_id`, `username`, `email`, `phone`, `fullname`, `dob`, `start_work`, `city`, `state`,`country`,`short_bio`,`bust_size`,`cup_size`,`waist_size`,`ethnicity`,`height`,`weight`,`eye_color`,`hair_color`,`travel`,`available`,`languages`,`photo_1`,`photo_2`,`photo_3`,`short_video`,`id_proof`) VALUES ('".$uni_id."', '".$user_name."', '".$email."', '".$phone."', '".$fullname."', '".$dob."', '".$start_work."', '".$city."', '".$state."','".$country."','".$short_bio."','".$bust_size."','".$cup_size."','".$waist_size."','".$ethnicity."','".$height."','".$weight."','".$eye_color."','".$hair_color."','".$travel."','".$available."','".$languages."','".$target_file1."','".$target_file2."','".$target_file3."','".$target_file4."','".$target_file5."');";
  
      if(mysqli_query($con,$que)){
        echo  '<script>alert("Added Casting")</script>';
        $last_id = mysqli_insert_id($con);

        $email_to = $email;
         $subject = "!! Casting Request Sent to the Admin !! <b>The Live Model</b>" ;

         $header = "From: The live Model <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
          <body style="width:80%;margin:auto;border:3px solid #000;">
          <div style="width: 100%;height: 500px;">
            <img src="https://thelivemodels.com/assets/wp-content/themes/theagency3/images/default-bg.jpg" style="width: 100%;height: 100%;">
          </div>
          <div style="padding: 20px;">
            <h2>Dear '.$user_name.', </h2>
            <p>Hope you are doing well.</p>
            <p>We are at <b>The live Model</b> thanking you for the applying for as a casting with us and our administrative team has been check your profile. Once your casting request has been approved by our admin team then we will inform you ont these mail.
            <p>If your profile has accepted the. you were able to upload their free/paid images and videos. and also change and set the extra detials.</p>
             
          </div>
          </body>
         </html>';

         if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="casting.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="casting.php"</script>';
         }

       // echo  '<script>window.location="casting.php"</script>';
      }
      else{
       echo  '<script>alert("Error in Casting")</script>';
         echo  '<script>window.location="casting.php"</script>';
      }
  
    } else {
        echo  "<script>alert('Sorry, there was an error uploading your Photo.')</script>";
    }
 
}
?>