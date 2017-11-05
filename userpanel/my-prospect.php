<?php include("header.php");?>
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
	
	<!--<script>
	function follwUp(values,userId)
	{
		if(values!=='' && values!=false)
		{
			
			
			var urldata = "valuess=" + values+'&&userId='+userId;
   	  $.ajax({
   		  type:'post',
   		  url:'../ajax/regfollow.php',
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
                                  
                               }
   		  }
   		  
   		  
   		  
   	  });
			
			
			
			
			
		}
		
	}
	
	</script>-->
	
	
  </head>

  <body class="">
    <div class="animsition">  
    
    <?php include("sidebar.php");?>

	<main id="playground">

         <?php include("top.php");?>
		<!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>My Prospects</h1>
          </div>

        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">


            <div class="col-md-12">

		

              <section class="panel panel-primary">
			  <div class="panel-body">
			  	<p>
			
			Export this page to Excel sheet to record all notes about your Prospects, as if your prospect results in an enrolment to become Client, Marketer, or Networker. Or any other notes you want to add like their evaluation as (A: Interested, positive & enthusiastic | B: Interested, but do not have time | C: not interested).
			</p>
			  </div>
                <header class="panel-heading">
                  <h4 class="panel-title">My Prospects</h4>
                </header>
				
                <div class="panel-body">

                  <table class="table datatable">
				  <thead>
					    <tr>
						<th> Sl No.</th>
						<th> My Prospects</th>
						<th> Username</th>
						<th> Registration Date </th>
						<th> Country</th>
						<th> Mobile Number</th>
						<th> Email address</th>
						<!--<th> Follow up</th>--->
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur="select * from user_registration where user_registration.mem_type='0' and ref_id='".$userId."'";
						$sql_query=mysql_query($sqlpur);
						$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
					
					?>
					
                     <tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $obj_func->userName($fetData['user_id']); ?></td>
					  <td><?php echo $fetData['username']; ?></td>
					  <td><?php echo $fetData['registration_date']; ?></td>
					 <td><?php echo $obj_func->getCountry($fetData['country']); ?></td>
					 <td><?php echo $fetData['std_code']."-".$fetData['telephone']; ?></td>
					 <td><?php echo $fetData['email']; ?></td>
					 <!--<td><input type="text" id="follow" onblur="return follwUp(this.value);"></td>-->
					 </tr>
						<?php $i++; } ?>
                    </tbody>
                  </table>
				</div>
              </section>
			</div> <!-- /col-md-6 -->
		</div>
	</div> <!-- / container-fluid -->

         <div class="col-md-12 text-center">

 <a href="bh_export_prospect_report.php?userid=<?php echo $userId;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


          </div>

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

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/raphael-min.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/jquery.animsition.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.tables.js"></script>
  </body>
</html>