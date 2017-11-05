<?php 
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
	</head>

  <body class="">
    <div class="animsition">  
    
    <?php include("sidebar.php"); ?>

	<main id="playground">

         <?php include("top.php");?>
		<!-- PAGE TITLE -->
        <section id="page-title" class="row">
		
          <div class="col-md-5">
            <h1>My Networkers</h1>
          </div>
		  
		  <div class="col-md-3">
            <h1><a href="binary-tree.php"><span class="btn btn-primary btn-lg"><b>GENEALOGY</b></span></a></h1>
          </div>

        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">


            <div class="col-md-12">
			
			 <div class="panel-body">
			  	<p>
			
			Enjoy following through and doing business with your networkers all the way heading to reach your goal, and achieve your financial freedom.
			</p>
			  </div>

              <div class="col-md-6">
			  
			  <section class="panel panel-primary">
			   <header class="panel-heading">
                  <h4 class="panel-title">My Left Networkers</h4>
                </header>
				<center><b>Left Side Accumelative Points =<?PHP echo $obj_func->totalPoints($userId,'left'); ?></b></center>
                <div class="panel-body">

                  <table class="table datatable">
				  <thead>
				 
					    <tr>
						<th> Sl No.</th>
						<th>Networkers Name</th>
						<th> Username</th>
						<!--<th> Country</th>
						<th> Mobile Number</th>
						<th> Email address</th>-->
						<th>Level</th>
						<th>Accumelative Matching Points</th>
						<!--<th> Current Membership Plan</th>-->
					</tr>
                    </thead>
                    <tbody>
					<?php 
					$sqlpur="select *,sum(manage_bv_history.mpv) as mpv,level_income_binary.down_id as user_id,level_income_binary.level as user_level, manage_bv_history.id as id from level_income_binary 
inner join manage_bv_history on manage_bv_history.down_id=level_income_binary.down_id
where level_income_binary.income_id='".$userId."' and manage_bv_history.income_id='".$userId."' and manage_bv_history.leg='left' and manage_bv_history.mpv!=0 group by level_income_binary.down_id order by manage_bv_history.id desc";
						
						$sql_query=mysql_query($sqlpur);
						if(mysql_num_rows($sql_query)>0)
						{
						$i=1;
						while($fetDatas = mysql_fetch_array($sql_query)){
							$fetData=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$fetDatas['user_id']."'"));
							
					
					?>
					
                     <tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $obj_func->userName($fetData['user_id']); ?></td>
					  <td><?php echo $fetData['username']; ?></td>
					 <!--<td><?php //if(!empty($fetData['country'])){ echo $obj_func->getCountry($fetData['country']); } ?></td>
					 <td><?php //echo $fetData['std_code']."-".$fetData['telephone']; ?></td>
					 <td><?php //echo $fetData['email']; ?></td>-->
					 <td><?php echo $fetDatas['user_level']; ?></td>
					 <td><?php echo $fetDatas['mpv']; ?></td>
						<!--<td><?php //if(!empty($fetData['mem_type'])) {echo $obj_func->memType($fetData['mem_type']); } ?></td>-->
					 </tr>
						<?php $i++; } } ?>
                    </tbody>
                  </table>
				</div>
              </section>
			  </div><!-- /col-md-6 -->
			  
			  <div class="col-md-6">
			  
			  <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">My Right Networkers</h4>
                </header>
				<center><b>Right Side Accumelative Points = <?PHP echo $obj_func->totalPoints($userId,'right'); ?></b></center>
                <div class="panel-body">

                  <table class="table datatable">
				  <thead>
					    <tr>
						<th> Sl No.</th>
						<th>Networkers Name</th>
						<th> Username</th>
						<!--<th> Country</th>
						<th> Mobile Number</th>
						<th> Email address</th>-->
						<th>Level</th>
						<th>Accumelative Matching Points</th>
						<!--<th> Current Membership Plan</th>-->
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur="select *,sum(manage_bv_history.mpv) as mpv,level_income_binary.down_id as user_id, manage_bv_history.id as id,level_income_binary.level as user_level from level_income_binary 
inner join manage_bv_history on manage_bv_history.down_id=level_income_binary.down_id
where level_income_binary.income_id='".$userId."' and manage_bv_history.income_id='".$userId."' and manage_bv_history.mpv!=0 and manage_bv_history.leg='right' group by level_income_binary.down_id order by manage_bv_history.id desc";

						
						$sql_query=mysql_query($sqlpur);
						if(mysql_num_rows($sql_query)>0)
						{
						$i=1;
						while($fetDatas = mysql_fetch_array($sql_query)){
							$fetData=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$fetDatas['user_id']."'")); ?>
					
                     <tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $obj_func->userName($fetData['user_id']); ?></td>
					  <td><?php echo $fetData['username']; ?></td>
					 <!--<td><?php //if(!empty($fetData['country'])){ echo $obj_func->getCountry($fetData['country']); } ?></td>
					 <td><?php //echo $fetData['std_code']."-".$fetData['telephone']; ?></td>
					 <td><?php //echo $fetData['email']; ?></td>-->
					 <td><?php echo $fetDatas['user_level']; ?></td>
					 <td><?php echo $fetDatas['mpv']; ?></td>
						<!--<td><?php //if(!empty($fetData['mem_type'])) {echo $obj_func->memType($fetData['mem_type']); } ?></td>-->
					 </tr>
						<?php $i++; } } ?>
					</tbody>
                  </table>
				</div>
              </section>
			  </div><!-- /col-md-6 -->
			  
			  </div> <!-- /col-md-6 -->
		</div>
	</div> <!-- / container-fluid -->

         <!--<div class="col-md-12 text-center">

 <a href="bh_export_marketers_report.php?userid=<?php echo $userId;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


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