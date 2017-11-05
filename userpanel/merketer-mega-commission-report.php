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
	</head>

  <body class="">
    <div class="animsition">  
    
    <?php include("sidebar.php");?>

	<main id="playground">

         <?php include("top.php");?>
		<!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>TB Mega Commission</h1>
          </div>

        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">TB Mega Commission</h4>
                </header>
				<center><b>Till Date Mega Direct Commission = <?PHP echo Currency.$obj_func->sumTeambuildingMegaComm($userId); ?></b></center>
                <div class="panel-body">

                  <table class="table datatable">
				  <thead>
					    <tr>
						<th> Sl No.</th>
						<th>Date</th>
						<th>Time</th>
						<th>User Name</th>
						<th>User Id</th>
						<th>Amount (<?php echo CURRENCY; ?>)</th>
						<th>Status</th>
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur="select *,cast(ts as date) as date, cast(ts as time) as time from level_income_mega where income_id='".$userId."'";
						
						
						
						$sql_query=mysql_query($sqlpur);
						if(mysql_num_rows($sql_query)>0)
						{
						$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
							$sqlReg=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$fetData['purchaser_id']."'"));
							
							$prod=mysql_fetch_assoc(mysql_query("select * from purchase_detail where user_id='".$fetData['purchaser_id']."' and invoice_no='".$fetData['invoice_no']."'"));
							
							$sts=array("Locked","Free");
							
					?>
					<tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $fetData['date']; ?></td>
					  <td><?php echo $fetData['time']; ?></td>
					 <td><?php echo $obj_func->userName($sqlReg['user_id']);  ?></td>
					 <td><?php echo $sqlReg['username'];  ?></td>
					 <td><?php echo Currency.$fetData['commission'];  ?></td>
					 <td><?php echo $sts[$fetData['status']]; ?></td>
					 </tr>
						<?php $i++; } } ?>
						
					</tbody>
                  </table>
				</div>
              </section>
			</div> <!-- /col-md-6 -->
		</div>
	</div> <!-- / container-fluid -->

         <!--<div class="col-md-12 text-center">

 <a href="bh_export_marketers_report.php?userid=<?php //echo $userId;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


          </div>-->

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