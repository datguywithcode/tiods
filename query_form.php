<?php include("lib/config.php");
date_default_timezone_set("Africa/Lagos");
$time = date ("Y-m-d H:i:s");


if(isset($_POST['submits']))
{
	 $username=$_REQUEST['name'];
   $lname=$_REQUEST['lname'];
   
	 $email1=$_REQUEST['email'];
	  $phone=$_REQUEST['phone'];
	 $message=$_REQUEST['message'];
	
	 $insert_new=mysql_query("insert into join_us set username='".$username."',email='".$email1."',phone='".$phone."' ,message='".$message."',time_stamp='".$time."'");
	 
	 
						
//echo md5('admin');
// send mail to user

				$subject = "Contactus Query From Site";
  
  
 
                $strSubject = "Enquiry message From TIODS";
                $from = 'admin@tiods.com';
                $email="ahmad.rabaia@gmail.com"; 
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
<div style="width:800px; margin:0px auto;border:4px solid #b10000">
<table width="800" border="0" cellspacing="5" cellpadding="1">
  
   <tr bgcolor="#CC3300">
    <td colspan="4">&nbsp;</td>
    
  </tr>
  <tr>
    <td colspan="4" align="center"><h1>Welcome to TIODS </h1></td>
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
    <td><p>Dear Admin You have a enquiry</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p>full name: '.$username.' '.$lname.',</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p>Contact no: '.$phone.'</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>Email id :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$email1.'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td colspan="4"><p>Message from user : '.$message.'
</p></td>
    
  </tr>

   
   
   
   <tr>
    <td>Thank you and Best Regards,</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>TIODS Team.</td>
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
  
   
  
</table>
</div>
</body>
</html>';
                
                
                // Attachment s
                mail ( $email, $strSubject, $msg, $strHeader ); // @ = No Show Error //
  

    echo "<html><script>alert('Thanks for visiting tiods.com.We value your feedback. Please send any question/inquiries or comments to tiods.com.');</script></html>";					
print"<script language='javascript'>document.location='index.php'</script>";
   

}
 ?>