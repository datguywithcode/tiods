<?php include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include("title.php");?>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- SugarRush CSS -->
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
    
      <!-- start of LOGO CONTAINER -->
  
      <!-- end of LOGO CONTAINER -->

      <!-- - - - - - - - - - - - - -->
      <!-- start of SIDEBAR        -->
      <!-- - - - - - - - - - - - - -->
  <?php include("sidebar.php");?>
      <!-- - - - - - - - - - - - - -->
      <!-- end of SIDEBAR          -->
      <!-- - - - - - - - - - - - - -->


      <main id="playground">

            
        <!-- - - - - - - - - - - - - -->
        <!-- start of TOP NAVIGATION -->
        <!-- - - - - - - - - - - - - -->
         <?php include("top.php");?>

        <!-- - - - - - - - - - - - - -->
        <!-- end of TOP NAVIGATION   -->
        <!-- - - - - - - - - - - - - -->


        <!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>Compose</h1>
            <p class="lead">Write a new message</p>
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
            
              <li><a href="#">Messages</a></li>
              <li class="active">Compose</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          
          <div class="row">
           
<form action="message1.php" method="post" name="compose_mail" id="compose_mail" enctype="multipart/form-data">

            <div class="col-md-10">

              <section class="panel">

                <div class="panel-body">

                  <div class="form-group">
                    <label>Sender Username:</label>
                    <input type="text" name="u_name" required class="form-control" id="simplecolor" value="" />
                  </div> <!-- / form-group -->

                  <div class="form-group">
                    <label for="simplecolor">Subject:</label>
                    <input type="text" required class="form-control" name="filed01" id="simplecolor" value="" />
                  </div>  <!-- / form-group -->

                


                  <div class="form-group">
                    <label for="simplecolor">Message:</label>
                    <textarea required class="form-control" name="filed06" id="simplecolor" rows="7" /></textarea>
                  </div> 

                  <div class="form-group">
                    <label for="simplecolor">Attachment (If Any):</label>
                     <input name="attachfile" type="file" class="form-control" id="simplecolor" value="" />
                
                  </div> 


                  <input type="hidden" id="user_id" name="user_id" value="<?php echo $userid;?>" />



              
                  <!-- Attachments -->
          

                  <!-- Action buttons -->
                  <div class="row">
                    <!--<a href="inbox.html" class="btn btn-primary">Save as Draft</a>
                    <a href="inbox.html" class="btn btn-danger">Discard</a>-->
                    <input type="submit" name="submit" value="Send" class="btn btn-primary pull-right">
                  </div> <!-- / row Action buttons -->

                </div> <!-- / panel-body -->

              </section>
              
            </div> </form><!-- / col-md-10 -->
          </div> <!-- / row -->

        </div> <!-- / container-fluid -->

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
  <script src="js/dropzone.js"></script>
  <script src="js/jquery.animsition.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.forms.js"></script>
  <script src="js/sugarrush.uploads.js"></script>
  </body>
</html>