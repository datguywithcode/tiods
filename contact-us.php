<?php 
ob_start();
include('include/header.php'); 
if(isset($_POST['submit']))
{

$emailSubject = 'Hi Tiods You have Received a mail';
$sendTo = 'admin@tiods.com';


$name=$_POST['name'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$message=$_POST['message'];

$body = <<<EOD
<br><hr><br>
First Name: $name<br>
Last Name: $lname<br>
Email: $email<br>
Phone: $phone<br>
Message: $message<br>
EOD;

$headers = "From: $SendTo\r\n"; // This line is changed.
//Actually, the mail is sent and received within the 000webhost.com mail server.
$headers .= "Content-type: text/html\r\n";
$headers.= 'From:'.$email."\r\n";
$success = mail($sendTo, $emailSubject, $body, $headers);	
if($success)
{
	header("location:contact-us.php?msg=Mail Sent Successfully");
}
 
	
}

?>
<!-- BEGIN SLIDER -->

<div class="entry-content">
  <div class="page_title2">
    <div class="container">
      <div class="title-1">
        <h1>Contact Us</h1>
      </div>
      <div class="pagenation">
        <div class="moduletable breadcrumbs">
          <ul class="breadcrumbs list-unstyled list-inline">
            <li><a class="pathway" href="index.php">Home</a></li>
            /
            <li class="active"><span>Contact Us</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- END SLIDER -->
  <!--// Main Content //-->
  <div class="main-content">
    <section class="pagesection" style="background-color: #ffffff; padding: 40px 0px 10px 0px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default p2">
            <div class="panel-heading2 text-center">Contact Us</div>
			<div class="panel-heading5 text-center"><b><?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?></b></div>
			
			<form method="post" action="query_form.php">
            <div class="panel-body text-left">
              <div class="col-sm-6 mar-t-b">
                <input type="text" class="form-control" name="name" placeholder="First Name" required data-placement="left" data-original-title="The last tip!">
              </div>
              <div class="col-sm-6 mar-t-b">
                <input type="text" class="form-control" required name="lname" placeholder="Last Name">
              </div>
              <div class="col-sm-6 mar-t">
                <input type="email" class="form-control" name="email" required placeholder="Email Address">
              </div>
              <div class="col-sm-6 mar-t-b">
                <input type="text" class="form-control" name="phone" required placeholder="Contact No.">
              </div>
              <div class="col-sm-12 mar-t-b">
                <textarea class="form-control" required name="message" style="height:120px;" placeholder="Your Message"></textarea>
              </div>
            </div>
            <div class="panel-footer2 text-right"><input type="submit" name="submits" class="btn btn-primary btn-lg" value="submit"></div>
			</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
</div>
<!--// Main Content //-->
<?php include('include/footer.php'); ?>
