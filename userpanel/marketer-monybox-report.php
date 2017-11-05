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
            <h1>BEST Marketer
MONEYBOX</h1>
          </div>

        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">BEST Marketer
MONEYBOX</h4>
                </header>
				<center><b>Till Date BEST Marketer
MONEYBOX = <?PHP echo Currency.$obj_func->totalMoneyTbcbox(); ?></b></center>

<!--<center><b>Competition ends on 	<?PHP //echo $obj_func->nextMonth('2015-11-01'); ?></b></center>-->
                <div class="panel-body">

                  <table class="table datatable1">
				  <thead>
					    <tr>
						<th> Rank</th>
						<th>TB Commission This Month (<?php echo CURRENCY; ?>)</th>
						<th>User Name</th>
						<th>User Id</th>
						<th>Date of Registration</th>
						<th>Membership</th>
					</tr>
                    </thead>
                    <tbody>
					<?php 
					
					$sqlpur="SELECT sum(level_income.commission) AS commission,level_income.income_id,user_registration.ts FROM level_income inner join user_registration on user_registration.user_id=level_income.income_id WHERE level_income.status='1' and level_income.paid_status='0' GROUP BY level_income.income_id ORDER BY commission DESC,user_registration.ts ASC LIMIT 10";
						$sql_query=mysql_query($sqlpur);
						
						if(mysql_num_rows($sql_query)>0)
						{
						$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
							
							$sqlReg=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$fetData['income_id']."'"));
							
							
							
							
							$prod=mysql_fetch_assoc(mysql_query("select * from purchase_detail where user_id='".$fetData['income_id']."'"));
							
							$sts=array("Locked","Free");
							if($sqlReg['mem_type']>1)
							{
								
							
							
					?>
					<tr>
					 <td><?php echo $obj_func->addOrdinalNumberSuffix($i); ?></td>
					 <td><?php echo Currency.$fetData['commission']; ?></td>
					 <td><?php echo $obj_func->userName($sqlReg['user_id']);  ?></td>
					 <td><?php echo $sqlReg['username'];  ?></td>
					 <td><?php echo $prod['ts'];  ?></td>
					 <td><?php echo $obj_func->memType($sqlReg['mem_type']); ?></td>
					 </tr>
						<?php $i++; } } } else { ?>
						<tr>
						<td colspan="6" align="center"><span style="color:red">No Record Found</span></td>
						
						</tr>
						
						
						<?php } ?>
						
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