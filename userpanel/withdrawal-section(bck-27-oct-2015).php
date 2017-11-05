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
            <h1>My Withdrawal Request</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
            </br>
            <div class="col-md-4" style="float:left;">

             <a href="withdraw-request.php"><input type="submit" name="update" value="New Withdrawal Request " class="btn btn-primary"></a>   

          </div>
          </div>

          
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">My Withdrawal Request</h4>
                </header>
                <div class="panel-body">

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>S.no</th>
                        <th>Date of Request</th>
                        <th>Beneficiary Name</th>
                        <th>Beneficiary Country</th>
                        <th>Beneficiary Mobile no </th>
                        <th>Requested amount </th>
                        <th>Date of Response </th>
                        <th>MTCN</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                     
                     <?php
                      $i=1;
                      $data=mysql_query("select * from withdraw_request where user_id='$userId' order by id desc");
                      while($data1=mysql_fetch_array($data))
                      {
                     ?>

                      <tr>
                        <th scope="row"><?php echo $i;?></th>
                        <td><?php echo $data1['posted_date'];?></td>
                         <td><?php echo $data1['first_name'];?></td>
                                <td><?php echo $data1['country'];?></td>
                          <td><?php echo $data1['mobile_no'];?></td>
                        <td><?php echo $data1['request_amount'];?></td>
                          <td><?php echo $data1['admin_response_date'];?></td>
                           <!-- <td><?php echo 0;?></td> -->
                         <td><?php if($data1['mtcn']==0){ echo "Pending"; } else { echo $data1['mtcn'];}?></td> 
                      </tr>

                      <?php $i++;} ?>
                     
                    </tbody>
                  </table>


                </div>
              </section>
            

            </div> <!-- /col-md-6 -->

  

          </div>

      
        </div> <!-- / container-fluid -->

         <div class="col-md-12 text-center">

 <a href="bh_export_withdral_section.php?userid=<?=$userId;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a>   


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