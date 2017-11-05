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
            <h1>Payment Continue</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">E-Shop</a></li>
              <li><a href="#">Payment Continue</a></li>
             
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Payment Continue</h4>
                </header>
                <div class="panel-body">

                  <table class="table datatable">
				  
                    <thead>
					
                      <tr>
                   <th> Sl No.</th>
                  <th> Product </th>
                  <th> Invoice Date </th>
				  <th> Price</th>
				  <th> Status </th>
                  <th> AWB </th>
                  <th> Detais </th>
					</tr>
                    </thead>
                    <tbody>
                     <tr>
					 <td>1</td>
					 <td>Apple iPad Air 2</td>
					 <td>23-09-2015</td>
					 <td>$56.99</td>
					 <td><button class="btn btn-success">Paid</button></td>
					 <td>123</td>
					 <td>
					 <a href="#" class="btn btn-primary">Continue Payment</a>
					</td>
					 </tr>
                     <tr>
					 <td>2</td>
					 <td>Microsoft XBOX ONE</td>
					 <td>21-09-2015</td>
					 <td>$459.59</td>
					 <td><button class="btn btn-success">Paid</button></td>
					 <td>123</td>
					 <td>
					 <a href="#" class="btn btn-primary">Continue Payment</a>
					</td>
					 </tr>
                     <tr>
					 <td>3</td>
					 <td>Seiko Men's Diver Automatic SKX007K2</td>
					 <td>18-09-2015</td>
					 <td>$162.98</td>
					 <td><button class="btn btn-danger">Unpaid</button></td>
					 <td>123</td>
					 <td>
					 <a href="#" class="btn btn-primary">Continue Payment</a>
					</td>
					 </tr>
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