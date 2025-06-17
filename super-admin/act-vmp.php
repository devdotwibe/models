<?php
	session_start();
  include('includes/config.php');

	if(isset($_POST['acceptprofile'])){
		 $m_id = $_POST['m_id'];
		 $email = $_POST['email'];
     $unique_id = $_POST['unique_id'];

	 	 $sql = "UPDATE casting SET status = 'Published' WHERE id = '".$m_id."' AND email = '".$email."'";
     $sql1 = "UPDATE model_user SET as_a_model = 'Yes' WHERE unique_id = '".$unique_id."'";

		if(mysqli_query($con,$sql) && mysqli_query($con,$sql1)){

			echo "<script>alert('Profile Accepted and Published Successfully');</script>";

          $sqls = "SELECT * FROM casting WHERE id = '".$m_id."' AND email = '".$email."'";
          $resultd = mysqli_query($con, $sqls);
            if (mysqli_num_rows($resultd) > 0) {
              $rowesdw = mysqli_fetch_assoc($resultd);
          	$name = $rowesdw['username'];
          }else{
          	echo 'Unable to fetch';
          }


         $email_to = $email;
         $subject = "Profile Published In Model Project";

         $header = "From: Model Project <prashant.systos@gmail.com>\r\n";
         $header .= "MIME-version:1.0\r\n";
         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = '
         <html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
<title>Mobile Responsive Email</title>

<style type="text/css">
.ReadMsgBody {width: 100%;}
.ExternalClass {width: 100%;}
.mobile {display: none;overflow: hidden;visibility:hidden;}
strong{font-weight: bold;}

  @media only screen and (max-width: 479px){ 
    
       td[class="desktop"], table[class="desktop"] {
           display: none !important;
       }
      
     td[class="mobile_only"], table[class="mobile_only"], img[class="mobile_only"], div[class="mobile_only"], tr[class="mobile_only"] {
      display: block !important;
      width: auto !important;
        overflow: visible !important;
      height: auto !important;
      max-height: inherit !important;
      font-size: 15px !important;
      line-height: 21px !important;
      visibility: visible !important;
       }     
     
     img[class="mobile_header"] { 
      width: 320px !important;
      height: 243px !important;
      display: block !important;      
        overflow: visible !important;
      visibility: visible !important;}
     
     td[class="full_width"], table[class="full_width"] {
            width: 320px !important;
       }
      
     td[class="medium_width"], table[class="medium_width"] {
            width: 272px !important;
       }
       
     td[class="intro_text"], table[class="intro_text"] {
        font-size: 14px !important;
      line-height: 20px !important;
       }
    
  }
</style>

</head>

<body bgcolor="#0a0a0a" style="background-color:#0a0a0a; margin:0; padding:0;-webkit-font-smoothing: antialiased;width:100% !important;-webkit-text-size-adjust:none;" topmargin="0"><div style="font-size: 1px; color: #0a0a0a; display: none;">Short description appears as email content preview.</div>
<table width="100%" bgcolor="#0a0a0a" style="background-color:#0a0a0a;" border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td>
      
      <table class="full_width" align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="padding-top: 12px;">
        <tr>  
           <td><img alt="Logo" src="https://thelivemodels.com/assets/wp-content/themes/theagency3/library/css/titletopdeco.png" width="200" height="75" border="0" hspace="0" vspace="0" style="display:block; vertical-align:top;"></td>
           <td class="desktop" align="right" valign="bottom" style="color:#fff; font-family: Helvetica, sans-serif; font-size: 11px; line-height:13px; padding-top:24px;">Insert Subject line <div class="full_width"><a href="#" target="_blank" style="color:#006699;">Call to action</a> | <a href="#" target="_blank" style="color:#006699;">Read online</a></div></td>
        </tr>
      </table>  
      <div class="mobile_only" style="width:0;max-height:0;overflow:hidden;float:left;display:none;">
        <table class="mobile_only" align="center" width="320" height="0" border="0" cellpadding="0" cellspacing="0" style="overflow:hidden;display:none;visibility:hidden;width:0;max-height:0;">
           <tr class="mobile_only" style="overflow:hidden;visibility:hidden;width:0;max-height:0;">
             <td class="mobile_only" valign="top" style="color:#fff; font-family: Helvetica, sans-serif;font-size:1px;line-height:1px;overflow:hidden;height:0px;visibility:hidden;width:0;max-height:0;padding-left: 12px; padding-right: 12px; padding-bottom: 0px;padding-top: 0px;"><div class="mobile_only" style="overflow:hidden;height:0px;font-size:1px;line-height:1px;visibility:hidden;width:0;max-height:0;"><br />Insert subject line<br /><a href="#" target="_blank" style="color:#006699;">Call to action</a> | <a href="#" target="_blank" style="color:#006699;">Read online</a></div></td>
          </tr>
        </table>     
  </div>

    </td>  
   </tr>
</table> 
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>  
       <td height="12" bgcolor="#0a0a0a" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
    </tr>
</table>
<table width="100%" bgcolor="#0a0a0a" style="background-color:#0a0a0a;" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td>&nbsp;</td>

    <td class="full_width" width="650" align="center" style="border-left:1px solid #d8d8d8; border-right:1px solid #d8d8d8; border-bottom:1px solid #d8d8d8; border-top:1px solid #d8d8d8;background-color: #ffffff; padding-bottom: 30px;">
      <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="desktop"><a target="_blank" href="#"><img width="650" vspace="0" hspace="0" border="0" height="300" style="display:block; vertical-align:top;" src="https://thelivemodels.com/assets/wp-content/uploads/2014/07/slide-4.jpg" alt="Headline here"></a></td>
          <td class="mobile_only" style="width:0; overflow:hidden; display:none;visibility:hidden;"><a target="_blank" href="#"><img width="320" vspace="0" hspace="0" border="0" height="243" style="width:0; overflow:hidden; display:none;visibility:hidden;" class="mobile_header" src="http://placehold.it/640x486.jpg" alt="Headline Here"></a></td>
        </tr>
     </table>
     <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
     </table>
     
     <p></p>
 
      <table class="medium_width" align="center" width="380" border="0" cellpadding="0" cellspacing="0">
        <tr>              
         <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:18px; line-height:20px; padding-bottom:18px;text-align:left;">Hello '.$name.',
          </td>         
        </tr>
        <tr>
          <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:14px; line-height:20px; padding-bottom:18px;text-align:left;">Your Profile has been Successfully Accepted and Published.
          </td> 
        </tr>
        <tr>
          <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:14px; line-height:20px; padding-bottom:18px;text-align:left;">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </td>
        </tr>
        <tr>
          <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:14px; line-height:20px; padding-bottom:18px;text-align:left;">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </td>
        </tr>
        <tr>
          <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:14px; line-height:20px; padding-bottom:18px;text-align:left;">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </td>
        </tr>
      </table>     
      <table class="medium_width" align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>      
          <td class="desktop" width="67" style="padding-top:12px;">&nbsp;</td> 
          <td align="right" valign="top" style="border-top:1px solid #d9d9d9; padding-top:12px;">
              <table width="200" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                    <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:13px; line-height:15px;">Social Media Links</td>
                    <td valign="top" style="color:#006699; font-family: Helvetica, sans-serif;text-align:left; font-size:12px; line-height:16px;">
                        <table width="66" align="right" border="0" cellpadding="0" cellspacing="0">
                           <tr>
                              <td width="24"><a href="#" alias="Facebook" target="_blank"><img alt="Facebook" src="http://placehold.it/32x32.jpg" width="16" height="16" border="0" hspace="0" vspace="0" style="display:block; vertical-align:top;"></a></td>
                              <td width="24"><a href="#" alias="Twitter" target="_blank"><img alt="Twitter" src="http://placehold.it/32x32.jpg" width="16" height="16" border="0" hspace="0" vspace="0" style="display:block; vertical-align:top;"></a></td>
                              <td width="16"><a href="#" alias="Google Plus" target="_blank"><img alt="Google Plus" src="http://placehold.it/32x32.jpg" width="16" height="16" border="0" hspace="0" vspace="0" style="display:block; vertical-align:top;"></a></td>
                           </tr>
                        </table>
                   </td>
                 </tr>
              </table>
          </td>
          <td class="desktop" width="67" style="padding-top:12px;">&nbsp;</td>             
        </tr>
      </table>
      
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
  
<table class="full_width" bgcolor="#0a0a0a" align="center" width="650" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="desktop" width="22">&nbsp;</td>
    <td align="center" style="color:#a1a1a1; font-family: Helvetica, sans-serif;text-align:left; font-size:11px; line-height:13px; text-align:left; padding-top:20px; padding-bottom:40px;">Legal, Copyright, Unsubscribe, Privacy Information.</td>
    <td class="desktop" width="22">&nbsp;</td>
  </tr>
</table>

</body>
</html>';

         if (mail($email_to, $subject, $message, $header)) {
               echo  '<script>alert("Details Successfully Sent to Respective Mail id.")</script>';
                echo '<script>window.location="verify-model-profile.php"</script>';
         }else{
              echo  '<script>alert("Error in Details Sent to Respective Mail id.")</script>';
                echo '<script>window.location="verify-model-profile.php"</script>';
         }
		}else{
			echo "<script>alert('Oops!! Error In Profile Accepted and Published');
                 window.location='verify-model-profile.php'

        </script>";
		}
	}

?>