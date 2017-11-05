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
   unset($_SESSION['email']);
   unset($_SESSION['country']);
   unset($_SESSION['password']);
   unset($_SESSION['city']);
   unset($_SESSION['phone']);
   unset($_SESSION['nomid']);
   unset($_SESSION['position']);
   unset($_SESSION['binary_pos']);
   unset($_SESSION['dob']);
   unset($_SESSION['bdate']);
   
   ?>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script>
   function getXMLHTTP() { //fuction to return the xml http object
   
       var xmlhttp=false;  
   
       try{
   
         xmlhttp=new XMLHttpRequest();
   
       }
   
       catch(e)  {   
   
         try{      
   
           xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
   
         }
   
         catch(e){
   
           try{
   
           xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
   
           }
   
           catch(e1){
   
             xmlhttp=false;
   
           }
   
         }
   
       }
   
         
   
       return xmlhttp;
   
       }
   
   function getCity(countryId) {
   	
   	var strURL="findCountry.php?platform="+countryId;
   
       var req = getXMLHTTP();
   
       
   
       if (req) {
   
         req.onreadystatechange = function() {
   	  
   	  
   
           if (req.readyState == 4) {
   
             // only if "OK"
    
             if (req.status == 200) { 
   		  
   			document.getElementById('city').innerHTML=req.responseText;
   			var urldata = "countryId=" + countryId;
   			$.ajax({
                       type: "POST",
                       async: "false",
                       url: "contry_code.php",
                       data: urldata,
                       success: function (html) {
                         //document.getElementById('contry_code').innerHTML=html; 
   					  $("#contry_code").attr("value",html);
                           
                       }
                   });
   			
   		 } else {
   
               alert("Problem while using XMLHTTP:\n" + req.statusText);
   
             }
   
           }       
   
         }     
   
         req.open("GET", strURL, true);
   
         req.send(null);
   
       }   
   
     }
     
     ////////////////////////////User email checking///////////////
     
     function emailcheck(id)
     {
   	  
   	  var urldata = "email_id=" + id;
   	  $.ajax({
   		  type:'post',
   		  url:'ajax/ajax_email.php',
   		  data:urldata,
   		  success:function(html)
   		  {
   			  if (html == "yes")
                               {
   
                                   $('#email_ajax').html("This email is being used by another user.");
                                   $('#email_id').focus();
                                   $("#email_ajax").addClass("ajaxdiv");
                               }
                               else if (html == "no")
                               {
   
                                   $("#email_ajax").removeClass("ajaxdiv");
                                   $('#email_ajax').html('');
                               }
   		  }
   		  
   		  
   		  
   	  });
     }
    
    
    /////////////////////////////password confriamtion////////////////
    
    function checkpass(val)
       {
           if ($("#user_pass").val() != $("#confirm_password").val())
           {
   			$('#confpass').html("Your password confirmation is wrong");
   			window.setTimeout(function() { document.getElementById("user_pass").focus(); },0);
   			return false;
           }
   		else
   		{
   			$('#confpass').html("");
   			
               
   		}
           
       }

	   
////////////////////////////date of birth///////////////////////
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
                  <form action="post-action.php" name="contactform" id="registrationForm" method="post"  onsubmit="return validates1()">
                     <input type="hidden" name="action" value="MerchantRegistration">
                     <div class="panel panel-default p2">
                        <div class="panel-heading2 text-center">Registration Form</div>
                        <div class="panel-body text-left">
                           <div class="col-sm-6 mar-t-b">
                              <input type="text" name="firstname" class="form-control" placeholder="Please enter your first name" id="first_name">
                              <span  class="first_name" style="color:red;"></span> 
                           </div>
                           <div class="col-sm-6 mar-t-b">
                              <input type="text" class="form-control" placeholder="Please enter your last name" name="lastname" id="last_name" size="20" maxlength="100" value="">
                              <span  class="last_name" style="color:red;"></span> 
                           </div>
						   
						   
						   <div class="col-sm-6 mar-t-b">
                              <input type="text" name="bdate" autocomplete="off" id="bdate" class="form-control" placeholder="Please enter date of birth 1989-08-27 (yyy-mm-dd)">
								<span class="bdate" style="color:red;"></span> 
                           </div>
                           
						   <div class="col-sm-6 mar-t-b">
                              <select class="form-control" name="gender" required id="gender">
                                 <option value="">Select a Gender</option>
                                 <option value="Male">Male</option>
								 <option value="Female">Female</option>
                              </select>
                              <span  style="color:red;"></span> 
                           </div>
						   
						   
						   
						   
                           <div class="col-sm-6 mar-t-b">
                              <select class="form-control" name="country" id="country"  onchange="getCity(this.value)">
                                 <option value="">Select a Country</option>
                                 <?php $sql=mysql_query("select * from country");
                                    while($fetcCountry=mysql_fetch_assoc($sql))
                                    {
                                    ?>
                                 <option value="<?php echo $fetcCountry['countryid']; ?>"><?php echo $fetcCountry['country'] ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div class="col-sm-6 mar-t-b">
                              <select class="form-control" name="city" id="city">
                                 <option value="">--Select a City--</option>
                              </select>
                           </div>
                           <div class="col-sm-1 mar-t-b">
                              <input type="tel" class="form-control" placeholder=""  name="contry_code" id="contry_code" required>
                           </div>
                           <div class="col-sm-5 mar-t-b">
                              <input type="tel" class="form-control" placeholder="Please enter your phone number"  name="phone" id="phoner" required>
                              <span  class="phoner" style="color:red;"></span>
                              </td>
                           </div>
                           <div class="col-sm-6 mar-t-b">
                              <input type="email" class="form-control" placeholder="Please enter a valid email address" required  name="email" id="email_id" onblur=emailcheck(this.value);>
                              <div style="color:#FF0000" id="email_ajax"></div>
                              <span  class="email" style="color:red;"></span> 
                           </div>
                           <div class="col-sm-6 mar-t-b">
                              <input type="password" name="password" required  id="user_pass" maxlength="12" title="Password" class="form-control" placeholder="Enter Password">
                           </div>
                           <div class="col-sm-6 mar-t-b">
                              <input type="password" name="confirm_password" class="form-control"   required title="Confirm Password"  maxlength="12" onBlur="return checkpass(this.value);" id="confirm_password"  placeholder="Confirm Password">
                              <input type="hidden" name="binary_pos" value="<?php echo $_GET['pos']; ?>">
                              <input type="hidden" name="sponsorid" value="<?php echo $_GET['sponsor_id']; ?>">
                              <input type="hidden" name="nom" value="<?php echo $_GET['pl_id']; ?>">
                              <span id="confpass" style="color:red;"></span> 
                           </div>
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

