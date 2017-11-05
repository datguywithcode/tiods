<?php 
ob_start();
include("header.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include("title.php");?>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

    <link href="css/epoch.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    
    <link href='css/verticalbargraph.css' rel='stylesheet' type='text/css'/>

    <!-- SugarRush CSS -->
    <!-- <link href="css/sugarrush.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	



<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script src="js/includes.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.10.4.custom.min.css"/>
</script>
  <script type="text/javascript">
       $(document).ready(function(){
        $("#bdate").datepicker({
            changeMonth:true,
        changeYear:true,
		autoclose: true,
		yearRange: '1950:2013'
        });
  });

</script>
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
   
   /*function getCity(countryId) {
   	
   	var strURL="../findCountry.php?platform="+countryId;
   
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
                       url: "../contry_code.php",
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
   
     }*/
     
     ////////////////////////////User email checking///////////////
     
     function emailcheck(id)
     {
   	  
   	  var urldata = "email_id=" + id;
   	  $.ajax({
   		  type:'post',
   		  url:'../ajax/ajax_email.php',
   		  data:urldata,
   		  success:function(html)
   		  {
			 
   			  if (html == 3)
                               {
								   $('#email_ajax').html("This email is being used by another user.");
                                   $('#email_id').focus();
                                   $("#email_ajax").addClass("ajaxdiv");
                               }
                               else if (html == 4)
                               {
   
                                   $("#email_ajax").removeClass("ajaxdiv");
                                   $('#email_ajax').html('');
                               }
   		  }
   		  
   		  
   		  
   	  });
     }
    
   
function validates1(){
    x=document.register
    input=x.password.value
    if (input.length<8){
		$("#pas").html("The Password cannot contain less than 8 characters");
		 $("#user_pass").focus();
        return false
    }

   x1=document.register
    input1=x1.confirm_password.value
	 if (input1.length<8){
		 $("#confpass").html("The Confirm Password cannot contain less than 8 characters");
		 $("#confirm_password").focus();
        return false
    }
	
	
	if (input!= input1)
           {
   			$('#confpass').html("Your password confirmation is wrong");
   			$("#user_pass").focus();
   			return false;
           }
		   
	

	x2=document.register
    input2=x2.bdate.value	
	
	var temp = new Array();
	var temp = input2.split('/');
	var day = temp[0];
    var month = temp[1];
    var year = temp[2];
    var age = 18;
    var mydate = new Date();
    mydate.setFullYear(year, month-1, day);
	var currdate = new Date();
    var setDate = new Date();         
	setDate.setFullYear(mydate.getFullYear() + age, month-1, day);
	
	if ((currdate - setDate) < 0){
			$('#datesss').html("Age Should be above 18");
			return false;

        }
		
}	   
</script>	
	
	
	
	
  </head>

  <body class="">
    <div class="animsition">  
    <?php include("sidebar.php");?>


      <main id="playground">

            
        <!-- - - - - - - - - - - - - -->
        <!-- start of TOP NAVIGATION -->
        <!-- - - - - - - - - - - - - -->
       <?php include("top.php");?>

        <!-- - - - - - - - - - - - - -->
        <!-- end of TOP NAVIGATION   -->
        <!-- - - - - - - - - - - - - -->


        <!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>TIODS MEMBER REGISTRATION</h1>
            
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
          
              <li class="active">REGISTRATION</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->
        

         <form action="../post-action.php" name="register" id="registrationForm" method="post" onsubmit="return validates1();">

        <div class="container-fluid">
          <div class="row">
      
           <div class="col-md-6 margin-bottom-30">
              <section class="panel">
                <div class="panel-body">

                 <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" name="firstname" tabindex="1" class="form-control" placeholder="Please enter your first name" id="first_name" required>
					<input type="hidden" name="action" value="MerchantRegistration">
					
						<input type="hidden" name="binary_pos" value="<?php echo $_GET['pos']; ?>">
						<input type="hidden" name="sponsorid" value="<?php echo $_GET['sponsor_id']; ?>">
						<input type="hidden" name="nom" value="<?php echo $_GET['pl_id']; ?>">
					
					
					
                              <span  class="first_name" style="color:red;"></span> 
                  </div> <!-- / form-group -->

                  <div class="form-group">
				  <label>Gender:</label>
                    <select class="form-control" name="gender" tabindex="3"  id="gender" required>
                                 <option value="">Select a Gender</option>
                                 <option value="Male">Male</option>
								 <option value="Female">Female</option>
                              </select>
                  </div>  <!-- / form-group -->
				  
				  
				  <div class="form-group">
				  <label>Country:</label>
                    <select class="form-control" tabindex="5" name="country" id="country"  onchange="getCity(this.value)">
                                 <option value="">Select a Country</option>
                                 <?php $sql=mysql_query("select * from country");
                                    while($fetcCountry=mysql_fetch_assoc($sql))
                                    {
                                    ?>
                                 <option value="<?php echo $fetcCountry['countryid']; ?>"><?php echo $fetcCountry['country'] ?></option>
                                 <?php } ?>
                              </select>
                  </div>  <!-- / form-group -->
				  
				  
				   <div class="form-group">
                    <label for="simplecolor">Code:</label>
					<!--<input type="tel_code" class="form-control" readonly=""  name="contry_code" style="width:15%;" id="contry_code" required>-->
					<input type="text" placeholder="+ Code" maxlength="4" class="form-control" tabindex="7"  name="tel_code" style="width:15%;" required>
					
					<div style="width: 82%;float: right;margin: -58px 0px 0px 0px;">
					<label for="simplecolor">Mobile:</label>
                    <input type="text" class="form-control" maxlength="10"  tabindex="8" placeholder="Please enter your phone number"  name="phone" id="phoner" required>
					</div>
                              <span  class="phoner" style="color:red;"></span>
                  </div>  <!-- / form-group -->
				  
				  
				  <div class="form-group">
                    <label for="simplecolor">Password:</label>
                    <input type="password" name="password"  tabindex="10" id="user_pass" maxlength="12" title="Password" class="form-control" placeholder="Enter Password" required>
					<span id="pas" style="color:red;"></span>
                  </div>  <!-- / form-group -->

                </div> <!-- / panel-body -->

              </section> <!-- / panel -->

            </div> <!-- / col-md-6 -->
			
			<div class="col-md-6 margin-bottom-30">
              <section class="panel">
			  
                <div class="panel-body">

                 <div class="form-group">
                    <label for="simplecolor">Last Name:</label>
                    <input type="text" class="form-control" tabindex="2" placeholder="Please enter your last name" name="lastname" id="last_name" size="20" maxlength="100" value="">
                              <span  class="last_name" style="color:red;"></span> 
                  </div> <!-- / form-group -->

                  <div class="form-group">
                    <label for="simplecolor">Date Of Birth:</label>
                   <input type="text" name="bdate" autocomplete="off" tabindex="4" id="bdate" class="form-control" placeholder="Please enter date of birth Above 18" required>
				    <span  id="datesss" style="color:red;"></span>
                  </div>  <!-- / form-group -->
				  
				  
				  <div class="form-group">
                    <label for="simplecolor">City/State:</label>
                    <!--<select class="form-control" tabindex="6" name="city" id="city">
                                 <option value="">--Select a City--</option>
                              </select>-->
							  
							  <input type="text" class="form-control" tabindex="6" placeholder="Please enter city name" name="city">
                  </div>  <!-- / form-group -->
				  
				  <div class="form-group">
                    <label for="simplecolor">Email:</label>
                    <input type="email" class="form-control" tabindex="9" placeholder="Please enter a valid email address" name="email" id="email_id" onblur=emailcheck(this.value); required>
                              <div style="color:#FF0000" id="email_ajax"></div>
                              <span  class="email" style="color:red;"></span>
                  </div>  <!-- / form-group -->
				  
				  
				  <div class="form-group">
                    <label for="simplecolor">Confirm Password:</label>
                    <input type="password" name="confirm_password" tabindex="11" class="form-control"    title="Confirm Password"  maxlength="12" onBlur="return checkpass(this.value);" id="confirm_password"  placeholder="Confirm Password" required>
					<span id="confpass" style="color:red;"></span> 
                  </div>  <!-- / form-group -->
				  
				  
				 

                </div> <!-- / panel-body -->

              </section> <!-- / panel -->

            </div> <!-- / col-md-6 -->
			
			
			<div class="col-md-12 margin-bottom-30" align="center">
			<input name="continue" class="btn btn-primary btn-lg" tabindex="12" type="submit" value="Register">
			</div>

          </div> <!-- / row -->

        </div> <!-- / container-fluid -->
		</form>

 <?php include("footer.php");?>


    </main> <!-- /playground -->


    <!-- - - - - - - - - - - - - -->
    <!-- start of NOTIFICATIONS  -->
    <!-- - - - - - - - - - - - - -->
    <?php include("rightside-panel.php");?>
    <!-- - - - - - - - - - - - - -->
    <!-- start of NOTIFICATIONS  -->
    <!-- - - - - - - - - - - - - -->

    <div class="scroll-top">
      <i class="ti-angle-up"></i>
    </div>
  </div> <!-- /animsition -->
  
  <script src="js/jquery.animsition.min.js"></script>
<script src="js/sugarrush.js"></script>
 	</body>
</html>