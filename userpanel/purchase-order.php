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
            <h1>Purchase History</h1>
          </div>

         <!-- <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Purchase History</a></li>
              <li><a href="#">Total Purchase History Report</a></li>
             
            </ol>

          </div>--->
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Purchase History</h4>
                </header>
                <div class="panel-body">

                  <table class="table datatable">
				  
                    <thead>
					
                      <tr>
						<th> Sl No.</th>
						<th> Invoice No.</th>
						<th> Invoice Date </th>
						<th> Points </th>
						<th> product </th>
						<th> Price </th>
						<th> Paid </th>
						<!--<th> Unpaid</th>-->
						<th> AWB</th>
						<th> Status </th>
						<th> Detail </th>
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur=" SELECT *,PUR.status,PUR.net_price,PUR.price FROM purchase_detail PUR inner join product_category PRO where  PRO.p_cat_id=PUR.p_id  and user_id='$userId' group by invoice_no order by PUR.pd_id desc";
						$sql_query=mysql_query($sqlpur);
						$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
					$arr_status=array('Partial Payment','Paid');
					?>
					
                     <tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $fetData['invoice_no']; ?></td>
					  <td><?php echo $fetData['date']; ?></td>
					  <td><?php echo $fetData['product_volume']; ?></td>
					 <td><?php echo $fetData['product_name']; ?></td>
					 <td><?php echo Currency.$fetData['price']; ?></td>
					 <td><?php echo Currency.$fetData['net_price']; ?></td>
					 <!--<td><?php //$unamt= $fetData['price']-$fetData['net_price']; echo Currency.$unamt; ?></td>-->
					 <td><?php echo $fetData['ship_traking']; ?></td>
					 <td><?php echo $arr_status[$fetData['status']]; ?></td>
					 <td><a href="invoice-detail.php?p_id=<?php echo $fetData['p_id']; ?>&&type=<?php echo $result['mem_type']; ?>&&invoice_no=<?php echo $fetData['invoice_no'];?>"><span class="label label-primary">Detail</span></a></td>
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

 <a href="bh_export_purchase_report.php?userid=<?php echo $userId;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


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