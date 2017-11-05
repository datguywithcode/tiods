<?php 
include("lib/config.php");

 $emailss=$_POST['email'];


  $data=mysql_query("select * from user_registration where email='$emailss'");
   $yes=mysql_num_rows($data);
   if($yes>0)
   {

     $no=mysql_fetch_array($data);
     $username=$no['username'];
     $first_name=$no['first_name'];
     $last_name=$no['last_name'];
     $email1=$no['email'];
      $password=$no['password'];
      $t_code=$no['t_code'];

  

  
 
 
  $subject = "Contactus Query From Site";
  
  
 
                $strSubject = "Password From Tiods";
                $from = 'preetimaxtratechnologies@gmail.com';
                $email="$email1"; 
                //$email='kamlesh@maxtratechnologies.net';
              
                // send mail to user after sign up complete
                $strSid = md5 ( uniqid ( time () ) );
                
                $strHeader = "";
                $strHeader .= "From:  <" . $from . ">\nReply-To: " . $from . "";
                
                $strHeader .= "MIME-Version: 1.0\n";
                $strHeader .= "Content-Type: multipart/mixed; boundary=\"" . $strSid . "\"\n\n";
                $strHeader .= "This is a multi-part message in MIME format.\n";
                $strHeader .= "--" . $strSid . "\n";
                $strHeader .= "Content-type: text/html; charset=utf-8\n";
                $strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
                //$strHeader .= "From : $from \r\n";
                //$strHeader .= "http://ntinetwork.net/registration-confirmation.php?passkey=" . $confirm_code . "<br/> <br/>";
                //$strHeader .= "<br>Thank You from NTI NETWORK";
                $strHeader .= "  <br>";
                $msg = '<html>
<body>
<table width="800" border="0" cellspacing="5" cellpadding="1">
  <tr bgcolor="#0099FF">
    <td colspan="4">&nbsp;<img src="http://tiods.com/images/logo.png" width="300" height="80" />&nbsp;</td>
  </tr>
   <tr bgcolor="#CC3300">
    <td colspan="4">&nbsp;</td>
    
  </tr>
  <tr>
    <td colspan="4">Welcome to TIODS</td>
  </tr>
  <tr>
    <td width="316">&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="248">&nbsp;</td>
    <td width="174">&nbsp;</td>
  </tr>
  <tr><td>&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="700px"><p>Username: '.$username.'</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="700px"><p>Fullname: '.$first_name.' '.$last_name.'</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>Email: '.$email1.'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   

   <tr>
   <td width="800px"><p>Password: '.$password.' </p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
   <td width="800px"><p> Transaction Password: '.$t_code.' </p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>Thank you and Best Regards,</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tiods Team.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Website  Link : http://tiods.com/ </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   
  <tr bgcolor="#0099FF">
    <td colspan="4" align="right">&nbsp;<img src="http://tiods.com/images/logo.png" width="300" height="80" />&nbsp;</td>
  </tr>
</table>

</body>
</html>';
                
                
                // Attachment s
                mail ( $email, $strSubject, $msg, $strHeader ); // @ = No Show Error //
  

    // header("location:../index.php?msg=Email Sent  Successfully !");
   
echo "<html><script>alert('The password will be sent at Email Address , Thanks..');</script></html>";          
print"<script language='javascript'>document.location='index.php'</script>";
}
else 
{
  echo "<html><script>alert('This email is invalid .Please put the mail that you have put at the time of registration');</script></html>";
print"<script language='javascript'>document.location='index.php'</script>";   
}

    
/*outsiders contact form Code Ends here */

?>