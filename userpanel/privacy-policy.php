<?php include("header.php");?><!DOCTYPE html>
<html lang="en">
  <head>
       <?php include("title.php");?>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- Style CSS -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->

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
        <div id="print">
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>Privacy Policy</h1>
          
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Policy</a></li>
              <li><a href="#">Privacy Policy</a></li>
              
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">
       
           

            <div class="col-md-12 margin-bottom-30">
              <section class="panel">
               

               
                <div class="panel-body">

                  <div class="form-group">
                  
                      <p><?php
  $sql=mysql_fetch_array(mysql_query("select * from contactdetail where id='15'"));
  echo $sql['description'];?> </p>
                     
                     
                  </div> <!-- / form-group -->

                </div> <!-- / panel-body -->

              </section> <!-- / panel -->

            </div> <!-- / col-md-9 -->

          </div> <!-- / row -->

        </div> <!-- / container-fluid -->

        </div>


        <script>function coderHakan(){var sayfa = window.open('','','width=800,height=800');sayfa.document.open("text/html");sayfa.document.write(document.getElementById('print').innerHTML);sayfa.document.close();sayfa.print();
}
</script>

         <div class="col-md-12 text-center">

 <a href="javascript:void();" onclick="coderHakan()"><input type="submit" name="update" value="Print" class="btn btn-primary"></a>   


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

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  </body>
</html>