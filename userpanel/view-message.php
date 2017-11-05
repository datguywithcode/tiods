<?php 
include("header.php");
if($_GET['sent'])
{
$table_name="message_sender";
mysql_query("update `message_sender` set `read_sender`='0' where id='$_GET[id]' and sender_id = '$uid'");
}
else if($_GET['inbox'])
{
$table_name="message";
mysql_query("update `message` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
else if($_GET['type']=='receiver')
{
$table_name="message";
mysql_query("update `message` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
else if($_GET['type']=='sender')
{
$table_name="message_sender";
mysql_query("update `message_sender` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
else if($_GET['type']=='draft')
{
$table_name="message_draft";
mysql_query("update `message_draft` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}

$id=$_GET['id'];
$sql_sel=mysql_query("SELECT * FROM $table_name WHERE id=$id");
$res_sel=mysql_fetch_array($sql_sel);
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
            <h1>Inbox</h1>
            <p class="lead">Message from <strong> <?= $res_sel[reciever_name]; ?></strong></p>
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Admin panel</a></li>
              <li><a href="#">Messages</a></li>
              <li class="active">Message</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">
       
            <div class="col-md-3 fix-on-scroll">
            <?php if($res_sel['file_name']){?>
              <section class="panel bordered-panel bordered-warning right-border">
                <header class="panel-heading">
                  Attachments <strong>(1)</strong>
                </header>
                <div class="panel-body">
                  <div class="margin-bottom-15">
                
                   <a href="attachfile/<?= $res_sel[file_name] ?>" target="_blank" class="btn btn-danger btn-md"><?= $res_sel[file_name] ?></a>

                  </div>
                 
                </div> <!-- / panel-body -->
              </section> <!-- / section -->

            <?php } ?>

            </div> <!-- col-md-3 -->

            <div class="col-md-9 margin-bottom-30">
              <section class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">  <?= $res_sel[subject] ?></h3>
                </header>

                <header class="panel-heading mail-sender">
                  
                  <div class="img-container pull-left">
                    <img src="images/demoimage.gif" alt="">
                  </div>

                  <div class="data-container pull-left">
                    <span class="from"><?= $res_sel[reciever_name]; ?></span>
                 
                  </div>

                 

                </header>
                <div class="panel-body">

                  <div class="form-group">
                      
                      <div class="well">
                        <p><?= $res_sel[message] ?>
</p>
                      </div>
                  </div> <!-- / form-group -->

                </div> <!-- / panel-body -->

              </section> <!-- / panel -->

            </div> <!-- / col-md-9 -->

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
  <script src="js/jquery.animsition.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  </body>
</html>