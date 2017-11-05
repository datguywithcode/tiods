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
            <h1>Voucher Wallet Transaction History</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Voucher</a></li>
              <li><a href="#">Voucher Wallet Transaction History</a></li>
             
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Voucher Wallet Transaction History</h4>
                </header>
                <div class="panel-body">

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>Sl No.</th>
                        <th>Transaction No</th>
                        <th>Credit</th>
                        <th>Debit</th>
						<th>Total</th>
                        <th>Remark</th>
                        <th>Date</th>
                        <th>Status</th>

                        
                      </tr>
                    </thead>
                    <tbody>
                     
                     <?php
                      $i=1;
                      $data=mysql_query("select * from credit_debit_voucher where user_id='$userId' order by id desc");
                      while($data1=mysql_fetch_array($data))
                      {
						  $sts=array("Free","Locked");
                     ?>

                      <tr>
                        <th scope="row"><?php echo $i;?></th>
                        <td><?php echo $data1['transaction_no'];?></td>
                       <td><?php echo Currency.$data1['credit_amt'];?></td>
                       <td><?php echo Currency.$data1['debit_amt'];?></td>
						<td><?php echo Currency.$data1['final_bal']; ?></td>
                        <td><?php echo $data1['TranDescription'];?></td>
                          <td><?php echo $data1['receive_date'];?></td>
                          <td><?php echo $sts[$data1['status']];?></td>
                      </tr>

                      <?php $i++;} ?>
                     
                    </tbody>
                  </table>


                </div>
              </section>
            

            </div> <!-- /col-md-6 -->

  

          </div>

      
        </div> <!-- / container-fluid -->


          <!--<div class="col-md-12 text-center">

 <a href="bh_export_ewallet_transaction.php?userid=<?php //echo $userid;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


          </div>---->



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