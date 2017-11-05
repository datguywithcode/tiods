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

    <!-- SugarRush CSS -->
    <!-- <link href="css/sugarrush.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Purchase History</a></li>
              <li><a href="#">Total Purchase History Report</a></li>
             
            </ol>

          </div>
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
                  <th> Invoice No </th>
                  <th> Invoice Date </th>
				  <th> PV</th>
				  <th> Net Amount (<?php echo CURRENCY; ?>) </th>
                  <th> Payment Mode </th>
                  <th> Status </th>
                  <th> View Detail </th>
					</tr>
                    </thead>
                    <tbody>
					<?php 
						$sqlpur=" SELECT *, sum(price*quantity) as oto,PUR.status FROM purchase_detail PUR inner join product_category PRO where  PRO.p_cat_id=PUR.p_id  and user_id='$userid' group by invoice_no order by PUR.pd_id desc";
						$sql_query=mysql_query($sqlpur);
					
					$i=1;
						while($fetData = mysql_fetch_array($sql_query)){
					$arr_status=array('Pending','Paid','Shipped','Cancaeled');
					?>
					
                     <tr>
					 <td><?php echo $i; ?></td>
					 <td><?php echo $fetData['invoice_no']; ?></td>
					 <td><?php echo $fetData['date']; ?></td>
					 <td><?php echo $fetData['product_volume']; ?></td>
					 <td><?php echo $fetData['net_price']; ?></td>
					 <td><?php echo $fetData['pay_mode']; ?></td>
					 <td><?php echo $arr_status[$fetData['status']];?></td>
					 <td>
					 
					 <a href="<?php if($fetData['status']=='0'){ ?>purchase_wallet.php?pid=<?php echo $fetData['p_id']; ?>&&invoice_no=<?php echo $fetData[invoice_no]; } else {?>invoice-detail.php?invoice_no=<?php echo $fetData[invoice_no]; }?>">View Detail</a>
					</td>
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

 <a href="bh_export_purchase_report.php?userid=<?=$userid;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


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