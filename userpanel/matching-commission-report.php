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
            <h1>Matching  Commission</h1>
          </div>

        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">
				<section class="panel panel-primary">
				
				
<!---------------------------------------------------General statement-------------------------------->	
                <header class="panel-heading">
                  <h4 class="panel-title">Matching Commission</h4>
                </header>
				<center><b>Till Date Matching Commission = <?PHP echo Currency.$obj_func->sumMatchingcomission($userId); ?></b></center>
                <div class="panel-body">
				<b>General Statement</b>
				</div>
				
				<div class="panel-body">
				<table class="table datatable">
				  <thead>
					    <tr>
						<th> Sl No.</th>
						<th>Date</th>
						<th>Details</th>
						<th>Commission</th>
						<th>Status</th>
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur="select * from matching_income where user_id='".$userId."' order by id desc";
						$sql_query=mysql_query($sqlpur);
						if(mysql_num_rows($sql_query)>0)
						{
						$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
							$sts=array("Locked","Free");
							?>
					<tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $fetData['b_date']; ?></td>
					 <td><?php echo $fetData['remark'];  ?></td>
					   <td><?php echo Currency.$fetData['commission'];  ?></td>
					 <td><?php echo $sts[$fetData['status']]; ?></td>
					 </tr>
						<?php $i++; } } ?>
						
					</tbody>
                  </table>
				</div>
				
				
				
				
				
				
				
<!---------------------------------------------------Detailed statement-------------------------------->				
				
				<div class="panel-body">
				<div class="col-md-7">
					<div class="col-md-10" style="margin-left:-17px;">
						<b>Detailed Matching Points Statement:</b>
					</div>
					<!--<div class="col-md-2">
						<select class="form-control"><option value="1">1</option></select></center>
					</div>-->
				</div>
				
				
				
				</div>
		
				
				
				<div class="panel-body">
				  <table class="table datatable">
				  <thead>
					    <tr>
						<th> Sl No.</th>
						<th>Date</th>
						<th> Left New</th>
						<th> Right New</th>
						<th>Left Unpaid</th>
						<th>Right Unpaid</th>
						<th>PPP</th>
						<th>Left Payable</th>
						<th>Right Payable</th>
						<th>Commission</th>
						<th>Left Carry</th>
						<th>Right Carry</th>
						
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur="select * from matching_income where user_id='".$userId."' order by id desc";
						$sql_query=mysql_query($sqlpur);
						if(mysql_num_rows($sql_query)>0)
						{
						$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
							$sts=array("Locked","Free");
							?>
					<tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $fetData['b_date']; ?></td>
					  <td><?php echo $fetData['nlpair'];  ?></td>
					   <td><?php echo $fetData['nrpair'];  ?></td>
					 <td><?php echo $fetData['lpair'];  ?></td>
					   <td><?php echo $fetData['rpair'];  ?></td>
					   <td><?php echo $fetData['ppp'];  ?></td>
					   <td><?php echo $fetData['match_left'];  ?></td>
					   <td><?php echo $fetData['match_right'];  ?></td>
					   <td><?php echo Currency.$fetData['commission'];  ?></td>
					 <td><?php echo $fetData['carry_fwd_left']; ?></td>
					 <td><?php echo $fetData['carry_fwd_right'];  ?></td>
					 
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