<?php 
ob_start();
include('include/header.php'); 
include("lib/config.php");
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['sponsorid']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['country']);
unset($_SESSION['password']);
unset($_SESSION['state']);
unset($_SESSION['city']);
unset($_SESSION['address']);
unset($_SESSION['phone']);
unset($_SESSION['lamount']);
unset($_SESSION['platform']);
unset($_SESSION['nomid']);
unset($_SESSION['transaction_pwd']);
unset($_SESSION['position']);
unset($_SESSION['ref_username']);
unset($_SESSION['binary_pos']);
unset($_SESSION['Ref_Name']);
unset($_SESSION['passport']);
// unset($_SESSION['dob']);
unset($_SESSION['bdate']);


if(isset($_REQUEST['pl_id']) && $_REQUEST['pl_id']!='')
{
  $pl_id = $_REQUEST['pl_id'];
  $_SESSION['pl_id'] = $pl_id;
}
if(isset($_REQUEST['sponsor_id']) && $_REQUEST['sponsor_id']!='')
{
  $sponsor_id = $_REQUEST['sponsor_id'];
  $_SESSION['Ref_Name'] = $sponsor_id;
}
if(isset($_REQUEST['binary_pos']) && $_REQUEST['binary_pos']!='')
{
  $binary_pos = $_REQUEST['binary_pos'];
}
$quest=mysql_fetch_array(mysql_query("select * from user_registration where user_id='".$_SESSION['Ref_Name']."'"));
$quest1=mysql_fetch_array(mysql_query("select * from user_registration where user_id='".$_SESSION['pl_id']."'"));


?>
<script type="text/javascript"><!--
function checkPasswordMatch() {
var password = $("#txtNewPassword").val();
var confirmPassword = $("#txtConfirmPassword").val();
if (password != confirmPassword)
$("#divCheckPasswordMatch").html("Passwords do not match!");
else
$("#divCheckPasswordMatch").html("Passwords match.");
}

function checkPasswordMatch1() {
var password1 = $("#txtNewPassword1").val();
var confirmPassword1 = $("#txtConfirmPassword1").val();
if (password1 != confirmPassword1)
$("#divCheckPasswordMatch1").html("Ewallet Password do not match!");
else
$("#divCheckPasswordMatch1").html("Passwords match.");
}

function validates1(){
    x=document.register
    input=x.password.value
    if (input.length<6){
        alert("The Password and Ewallet Password cannot contain less than 6 characters and more than 12 characters!")
        return false
    }else {
        return true
    }

   x1=document.register
    input1=x1.transaction_pwd.value
    if (input1.length<6){
        alert("The Password and Ewallet Password cannot contain less than 6 characters and more than 12 characters!")
        return false
    }else {
        return true
    }
  
}
</script>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$("#username").keyup(function (e) {
//removes spaces from username
$(this).val($(this).val().replace(/\s/g, ''));
var username = $(this).val();
if(username.length < 1){$("#checkuser").html('');return;}
if(username.length >= 1){
$("#checkuser").html('<img src="images/preloader.gif" />');
$.post('regis4.php', {'username':username}, function(data) {
$("#checkuser").html(data);
});
}
}); 
});
$(document).ready(function() {
$("#sponsorid").keyup(function (e) {
$(this).val($(this).val().replace(/\s/g, ''));
var sponsorid = $(this).val();
if(sponsorid.length < 1){$("#checksponser").html('');return;}
if(sponsorid.length >= 1){
$("#checksponser").html('<img src="images/preloader.gif" />');
$.post('regis6.php', {'sponsorid':sponsorid}, function(data) {
$("#checksponser").html(data);
});
}
}); 
});

// to check placementid
$(document).ready(function() {
  $("#placementid").blur(function (e) {
  
    //removes spaces from username
    $(this).val($(this).val().replace(/\s/g, ''));
    var refid = $(sponsorid).val();
    //alert(refid);
    var placementid = $(this).val();
    if(placementid.length < 1){$("#checkplace").html('');return;}
    
    if(placementid.length >= 1){
      $("#checkplace").html('<img src="images/preloader.gif" />');
      $.post('regis1.php', {'placementid':placementid,'refid':refid}, function(data) {
        $("#checkplace").html(data);
      });
    }
  }); 
});
</script>
<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        $(function () {
            $(".numeric").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                $(".error").css("display", ret ? "none" : "inline");
                return ret;
            });
            $(".numeric").bind("paste", function (e) {
                return false;
            });
            $(".numeric").bind("drop", function (e) {
                return false;
            });
        });


function checkEmail() 
{
    var email = document.getElementById('email');
    var filter =  /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,3}$/;
    if(email.value!='')
      {
           if (!filter.test(email.value)) 
           {
                document.getElementById('email_ajax').innerHTML='<font color="#FF0000">Please enter valid email id.</font>';
                var d = document.getElementById("email_ajax");
                d.className = d.className + " ajaxdiv ";
                email.focus();
                return false;
          }
         else
          {
              document.getElementById('email_ajax').innerHTML='';
              var d = document.getElementById("email_ajax");
              d.className = "";
              document.getElementById('email_ajax').value='';
              return true;
         }
    } 
}


jQuery(document).ready(function($){ 
   $('#email').blur(function(){
   var email_id = $('#email').val();
   

   if(checkEmail())
   {
     var urldata = "email_id="+email_id;
     $.ajax({
                    type: "POST",
                    async: "false",
                    url: "ajax/ajax_email.php",
                    data: urldata,
                    success: function(html){ 
              // alert(html);
                if(html)
                  { 
                     if(html=="yes")
                     {
                         
                           $('#email_ajax').html("This email is being used by another user.");
                           $('#email').focus();
                           $("#email_ajax").addClass("ajaxdiv");
                     }
                     else if(html=="no")
                     {
                        
                          $("#email_ajax").removeClass("ajaxdiv");
                          $('#email_ajax').html('');
                     }
                     else
                     {
                      return false;
                     }
                   
                  } 
                  else
                  {
                    return false;
                  }
              
              }
           })
   }
  });
});


    </script>
<script type="text/javascript" language="javascript">
  $(document).ready(function(){
 
   $("#ccName").blur(function(){

      if($(this).val()=="")
         {
          $(".ccName").text("Please Enter a valid Passport Number");
         }
      else 
         {

            $(".ccName").text('');
         }    
   })
  $("#ccName").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".ccName").text("");
       }
  }) 
 /////////////////////////////////////////////////////////////
  $("#cardNumber").blur(function(){

      if($(this).val()=="")
         {
          $(".cardNumber").text("You must enter Card Number");
         }
      else 
         {

            $(".cardNumber").text('');
         }    
   })
   $("#cardNumber").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".cardNumber").text("");
       }
  }) 
 
////////////////////////////
/////////////////////////////////////////////////////////////
  $("#bdate").blur(function(){

      if($(this).val()=="")
         {
          $(".bdate").text("You must enter date of birth date");
         }
      else 
         {

            $(".bdate").text('');
         }    
   })
   $("#bdate").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".bdate").text("");
       }
  }) 

/////////////////////////////////////////////////////////////
  $("#securitycode").blur(function(){

      if($(this).val()=="")
         {
          $(".securitycode").text("Security code is invalid.");
         }
      else 
         {

            $(".securitycode").text('');
         }    
   })
   $("#securitycode").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".securitycode").text("");
       }
  }) 
 
////////////////////////////

 /////////////////////////////////////////////////////////////
  $("#CC_ADDRESS").blur(function(){

      if($(this).val()=="")
         {
          $(".CC_ADDRESS").text("Please Enter address");
         }
      else 
         {

            $(".CC_ADDRESS").text('');
         }    
   })
   $("#CC_ADDRESS").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".CC_ADDRESS").text("");
       }
  }) 

   /////////////////////////////////////////////////////////////
  $("#ppcity").blur(function(){

      if($(this).val()=="")
         {
          $(".ppcity").text("You must enter the City for the Card.");
         }
      else 
         {

            $(".ppcity").text('');
         }    
   })
   $("#ppcity").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".ppcity").text("");
       }
  }) 
    /////////////////////////////////////////////////////////////
  $("#shipping_state").blur(function(){

      if($(this).val()=="")
         {
          $(".shipping_state").text("You must enter  state code.");
         }
      else 
         {

            $(".shipping_state").text('');
         }    
   })
   $("#shipping_state").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".shipping_state").text("");
       }
  }) 

 /////////////////////////////////////////////////////////////
  $("#postal_code").blur(function(){

      if($(this).val()=="")
         {
          $(".postal_code").text("You must enter the postal code on the shipping address.");
         }
      else 
         {

            $(".postal_code").text('');
         }    
   })
   $("#postal_code").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".postal_code").text("");
       }
  }) 

   /////////////////////////////////////////////////////////////
  $("#shipping_name").blur(function(){

      if($(this).val()=="")
         {
          $(".shipping_name").text("You must enter the shipping name.");
         }
      else 
         {

            $(".shipping_name").text('');
         }    
   })
   $("#shipping_name").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".shipping_name").text("");
       }
  }) 

   /////////////////////////////////////////////////////////////
  $("#address_line1").blur(function(){

      if($(this).val()=="")
         {
          $(".address_line1").text("You must enter the shipping street address.");
         }
      else 
         {

            $(".address_line1").text('');
         }    
   })
   $("#address_line1").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".address_line1").text("");
       }
  }) 
   /////////////////////////////////////////////////////////////
  $("#shipping_city").blur(function(){

      if($(this).val()=="")
         {
          $(".shipping_city").text("You must enter the City for the shipping address.");
         }
      else 
         {

            $(".shipping_city").text('');
         }    
   })
   $("#shipping_city").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".shipping_city").text("");
       }
  }) 
///////////////////////////////////////////////
$("#zip_code").blur(function(){

      if($(this).val()=="")
         {
          $(".zip_code").text("You must enter the Postal code for the Card.");
         }
      else 
         {

            $(".zip_code").text('');
         }    
   })
   $("#zip_code").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".zip_code").text("");
       }
  }) 
 
 ///////////////////////////////////////////////
$("#first_name").blur(function(){

      if($(this).val()=="")
         {
          $(".first_name").text("You must enter your First name.");
         }
      else 
         {

            $(".first_name").text('');
         }    
   })
   $("#first_name").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".first_name").text("");
       }
  }) 

   ///////////////////////////////////////////////
$("#last_name").blur(function(){

      if($(this).val()=="")
         {
          $(".last_name").text("You must enter your last name.");
         }
      else 
         {

            $(".last_name").text('');
         }    
   })
   $("#last_name").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".last_name").text("");
       }
  }) 
///////////////////////////////////////

$("#email").blur(function(){

      if($(this).val()=="")
         {
          $(".email").text("Please fill your valid email.");
         }
      else 
         {

            $(".email").text('');
         }    
   })
   $("#email").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".email").text("");
       }
  }) 
    ///////////////////////////////////////////////
$("#phoner").blur(function(){

      if($(this).val()=="")
         {
          $(".phoner").text("You must enter your phone number");
         }
      else 
         {

            $(".phoner").text('');
         }    
   })
   $("#phoner").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".phoner").text("");
       }
  }) 

   ///////////////////////////////////////////////
$("#username").blur(function(){

      if($(this).val()=="")
         {
          $(".username").text("You must enter your username");
         }
      else 
         {

            $(".username").text('');
         }    
   })
   $("#username").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".username").text("");
       }
  }) 
////////////////////////////
$("#stateProvince").blur(function(){

      if($(this).val()=="")
         {
          $(".stateProvince").text("You must enter state province code.");
         }
      else 
         {

            $(".stateProvince").text('');
         }    
   })
   $("#stateProvince").keyup(function(){

    if($(this).val().length>=1)
       {
        $(".stateProvince").text("");
       }
  }) 
  ///////////////////////////////
  $("#cont").click(function(){
//ppcity
  if($("#CC_ADDRESS").val()=="")
    {
     
     $(".CC_ADDRESS").text("Please Enter Address");

    }
    ///////////////////
    if($("#stateProvince").val()=="")
    {
     
     $(".stateProvince").text("You must enter state province code.");

    }

    ///////////////////
    if($("#address_line1").val()=="")
    {
     
     $(".address_line1").text("You must enter the shipping street address.");

    }
    ///////////////////
    if($("#phoner").val()=="")
    {
     
     $(".phoner").text("You must enter your phon number");

    }
    ///////////////////
    if($("#username").val()=="")
    {
     
     $(".username").text("You must enter your username");

    }
    /////////////////////////
    if($("#ccName").val()=="")
    {
     
     $(".ccName").text("Please Enter a valid Passport Number");

    }

    /////////////////////
    if($("#last_name").val()=="")
    {
     
     $(".last_name").text("You must enter your last name");

    }

    /////////////////////
    if($("#email").val()=="")
    {
     
     $(".email").text("You must enter your email");

    }

    ///////////////
    if($("#shipping_state").val()=="")
    {
     
     $(".shipping_state").text("Please Enter state code");

    }
    ////////////////////////////////////////////////
 if($("#ppcity").val()=="")
    {
     
     $(".ppcity").text("Please Enter City");

    }

    ////////////////////////////////////////////////
 if($("#postal_code").val()=="")
    {
     
     $(".postal_code").text("You must enter the postal code on the shipping address.");

    }

    ////////////////////////////////////////////////
 if($("#shipping_name").val()=="")
    {
     
     $(".shipping_name").text("You must enter the shipping name.");

    }
    /////////////////////////////////////////
    if($("#shipping_city").val()=="")
    {
     
     $(".shipping_city").text("You must enter the City for the shipping address.");

    }

    //////////////////////////
    if($("#zip_code").val()=="")
    {
     
     $(".zip_code").text("Please Enter Zip code");

    }
    /////////////////////////////////
    //////////////////////////
    if($("#first_name").val()=="")
    {
     
     $(".first_name").text("Please Enter First name");

    }
    ////////////////////////////////////////////////
 if($("#securitycode").val()=="")
    {
     
     $(".securitycode").text("Please Enter Security code");

    }
     ////////////////////////////////////////////////
 if($("#cardNumber").val()=="")
    {
     
     $(".cardNumber").text("Please Enter card number");

    }
    ////////////////////////////////////////////////
 if($("#bdate").val()=="")
    {
     
     $(".bdate").text("Please Enter Your Date of birth");

    }
////////////////////////////////////////////////
 if($("#ppcity").val()=="")
    {
     
     $(".ppcity").text("Please Enter City");

    }

////////////////
  if($("#CC_COUNTRY").val()=="" || $("#CC_COUNTRY").val()==null)
   {
    $(".CC_COUNTRY").text("Please Enter Country");
   } 

  
////////////////
  if($("#CC_TYPE").val()=="" || $("#CC_TYPE").val()==null)
   {
    $(".CC_TYPE").text("You must enter a credit card type");
   } 

  });
  //end of click here
  });
</script>
<script type='text/javascript' language="javascript">
  $(document).ready(function(){
 ////////////////////////////////////
   $("#CC_COUNTRY").change(function(){

        if($(this).val()=="" || $(this).val()==null)
        {
          $(".CC_COUNTRY").text("Please Enter Country");
        }
       else 
        {
          $(".CC_COUNTRY").text("");
        } 

     });
/////////////////////
   $("#CC_COUNTRY").blur(function(){

        if($(this).val()=="" || $(this).val()==null)
        {
          $(".CC_COUNTRY").text("Please Enter Country");
        }
       else 
        {
          $(".CC_COUNTRY").text("");
        } 

     });


///////////////////////////////////////////////////////////////

////////////////////////////////////
   $("#CC_TYPE").change(function(){

        if($(this).val()=="" || $(this).val()==null)
        {
          $(".CC_TYPE").text("You must enter a credit card type");
        }
       else 
        {
          $(".CC_TYPE").text("");
        } 

     });
////////////////////////////////////
 $("#CC_TYPE").blur(function(){

        if($(this).val()=="" || $(this).val()==null)
        {
          $(".CC_TYPE").text("You must enter a credit card type");
        }
       else 
        {
          $(".CC_TYPE").text("");
        } 

     });
/////////////////////////////////
  });
</script>
<div class="entry-content">
  <div class="page_title2">
    <div class="container">
      <div class="title-1">
        <h1>Registration</h1>
      </div>
      <div class="pagenation">
        <div class="moduletable breadcrumbs">
          <ul class="breadcrumbs list-unstyled list-inline">
            <li><a class="pathway" href="index.php">Home</a></li>
            /
            <li class="active"><span>Registration</span></li>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
          <form action="post-action.php" name="register" id="registrationForm" method="post"  onsubmit="return validates1()">
            <input type="hidden" name="action" value="MerchantRegistration">
            <div class="panel panel-default p2">
              <div class="panel-heading2 text-center">Registration Form</div>
              <div class="panel-body text-left">
                <?php @$msg=$_GET['msg'];if($msg!='') { ?>
                <div class="reg-header">
                  <p align="right"> <br/>
                    <span style="color:#F00; float:right; font-weight:bold;">
                    <?php if($msg=='ist') { echo "Register Successfully..! Please Check Your Email."; } else if($msg=='username') {  echo "Username Already Exists";} else if($msg=='sponsor') {  echo "Sponsor Not Exists or Wrong platform choosen by you";}  else if($msg=='email') { echo "Email Already Exists";}  else if($msg=='firstlast') { echo "First and Last Name Combination Already Exists";} else { "Sorry Unable to Register";} ?>
                    </span></p>
                </div>
                <?php } ?>
                <div class="col-sm-6 mar-t-b">
                  <input type="text"  class="form-control"  name="sponsorid" required onMouseOut="checkuser(this.value)"  autocomplete="off" placeholder="Please Enter Sponsor" id="sponsorid" title="Sponsor name" value="<?php if($_SESSION['Ref_Name']!='') { echo $_SESSION['Ref_Name']; } else {} ?>" >
                  <?php if($_SESSION['Ref_Name']!='') { echo $quest['username']." is your sponsor"; } ?>
                  <span id="checksponser"> </div>
                
				 <?php /*?><div class="col-sm-6 mar-t-b">
                  <input type="text" class="form-control" placeholder="Placement / Upline Id" required onMouseOut="checkplace(this.value)" id="placementid" name="placementid" value="<?php if($_SESSION['pl_id']!='') { echo $_SESSION['pl_id']; } else {} ?>">
                  <?php if($_SESSION['pl_id']!='') { echo $quest1['username']." is your upline"; } ?>
                  <span id="checkplace"></span> </div>
               <div class="col-sm-6 mar-t">
                  <select name="platform" id="platform" required class="form-control" >
                    <option value="">Select Package</option>
                    <?php 
              $fquery=mysql_query("select * from status_maintenance");
              while($queryf1=mysql_fetch_array($fquery))
              {
              ?>
                    <option value="<?php echo $queryf1['id'];?>"><?php echo $queryf1['name'];?> ( $ <?php echo $queryf1['amount'];?> )</option>
                    <?php } ?>
                  </select>
                </div><?php */?>
				
                <div class="col-sm-6 mar-t">
                  <select name="binary_pos" id="binary_pos" required class="form-control">
                    <option value="">Select Position</option>
                    <option value="left" <?php if($binary_pos == 'left'){ ?> selected <?php } ?>>Left</option>
                    <option value="right" <?php if($binary_pos == 'right'){ ?> selected <?php } ?>>Right</option>
                  </select>
                </div>
                <div class="col-sm-12 mar-t-b">
                  <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username" onblur="checkuser(this.value)">
                  <span id="checkuser"></span> <span  class="username" style="color:red;"></span> </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="password" name="password" required id="txtNewPassword" maxlength="12" title="Password" class="form-control" placeholder="Enter Password">
                </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="password" name="confirm_password" class="form-control"   required title="Confirm Password"  maxlength="12" id="txtConfirmPassword" onKeyUp="checkPasswordMatch();"  placeholder="Confirm Password">
                  <div class="registrationFormAlert" id="divCheckPasswordMatch" style="font-size:16px"></div>
                </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="password" name="transaction_pwd" required id="txtNewPassword1" maxlength="12"  title="Password" class="form-control" placeholder="Enter Transaction Password">
                </div>
                <div class="col-sm-6 mar-t-b">
                  <input class="form-control" type="password" name="transaction_pwd1" required title="Confirm Password"  maxlength="12" id="txtConfirmPassword1" onKeyUp="checkPasswordMatch1();" placeholder="Confirm Transaction Password">
                  <div class="registrationFormAlert" id="divCheckPasswordMatch1" style="font-size:16px"></div>
                </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="text" name="firstname" class="form-control" placeholder="Please enter your first name" id="first_name">
                  <span  class="first_name" style="color:red;"></span> </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="text" class="form-control" placeholder="Please enter your last name" name="lastname" id="last_name" size="20" maxlength="100" value="">
                  <span  class="last_name" style="color:red;"></span> </div>
				  
				  
				  <div class="col-sm-6 mar-t">
                  <select name="gender" id="gender" required class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
				  
				  
				  
                <div class="col-sm-6 mar-t-b">
                  <input type="email" class="form-control" placeholder="Please enter a valid email address" required  name="email" id="email">
                  <div style="color:#FF0000" id="email_ajax"></div>
                  <span  class="email" style="color:red;"></span> </div>
                <div class="col-sm-6 mar-t-b">
                  <!--  <input type="tel" id="text1" class = "numeric" required name="mobile_no" placeholder="Phone">&nbsp;<span class="error" style="color: Red; display: none">* Type Input digits only</span> -->
                  <input type="tel" class="form-control" placeholder="Please enter your phone number"  name="phone" id="phoner" required>
                  <span  class="phoner" style="color:red;"></span>
                  </td>
                </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="text" class="form-control" placeholder="Please enter a valid passport number" name="passport" >
                  <!-- <input type="text" class="form-control" placeholder="Please enter a valid passport number" name="CC_NAME" id="ccName">
                                                      <span class="ccName" style="color:red;" ></span> -->
                </div>
                <div class="col-sm-6 mar-t-b">
                  <input type="text" name="bdate" autocomplete="off" id="bdate" class="form-control" placeholder="Please enter date of birth 1989-08-27 (yyy-mm-dd)">
                  <span class="bdate" style="color:red;"></span>
				</div>
				
                <div class="col-sm-6 mar-t-b">
                  <select class="form-control" name="country" id="CC_COUNTRY"  onchange="changeAddressDisp()">
                    <option value="">Select a Country</option>
                    <option value="United States">United States</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-bissau">Guinea-bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of">Korea, Republic of</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao">Macao</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russian Federation">Russian Federation</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia">South Georgia</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-leste">Timor-leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                  </select>
                  <!-- <span class="CC_COUNTRY" style="color:red;position:absolute;z-index:9999;margin:-30px 0 0 295px;font-weight:bold;font-family:Arial,Helvetica;font-size:14px;"></span> -->
                  <span class="CC_COUNTRY" style="color:red"></span> 
				</div>

                
				<div class="col-sm-6 mar-t-b">
                  <input type="text" class="form-control" name="state" id="zip_code"placeholder="Enter State Name*">
                  <span class="zip_code" style="color:red"></span>
				</div>

				<div class="col-sm-6 mar-t-b">
                  <input type="text" class="form-control" placeholder="Enter City" name="city" id="ppcity" />
                  <span class="ppcity" style="color:red"></span> 
				</div>
				<div class="col-sm-12 mar-t-b">
                  <textarea class="form-control" rows="30px" cols="30px"placeholder="Enter Address" name="address" type="text" id="CC_ADDRESS" /></textarea>
                  <span class="CC_ADDRESS" style="color:red"></span> </div>
                <div class="col-sm-12 mar-t-b">
                  <input type="radio" required/>
                  <font class="bldf">I Read <a href="#">Terms &amp; Conditions</a></font> </div>
              </div>
              <div class="panel-footer2 text-right">
                <input name="continue" class="btn btn-primary btn-lg" type="submit" value="Continue">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</div>
<!--// Main Content //-->
<?php include('include/footer.php'); ?>
