<?php include("header.php");
$id=$userId;
$str_sent="select * from message_sender where sender_id='$id' and status=0 order by id desc";
$res_sent=mysql_query($str_sent);
$count_sent=mysql_num_rows($res_sent);
$str11="select * from message where reciever_id='$id' and status=0 order by id desc";
$res11=mysql_query($str11);
$count11=mysql_num_rows($res11);
$str_draft="select * from message_draft where sender_id='$id' and status=0 order by id desc";
$res_draft=mysql_query($str_draft);
$count_draft=mysql_num_rows($res_draft);
$str_trash="select *,'sender' as type from message_sender where sender_id='$id' and status=1 union all select *,'receiver' as type from message where reciever_id='$id' and status=1 union all select *,'draft' as type from message_draft where reciever_id='$id' and status=1 order by ts desc";
$res_trash=mysql_query($str_trash);
$count_trash=mysql_num_rows($res_trash);
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
            <h1>Sent Mail</h1>
            <p class="lead">You have <span class="label label-warning"><?php echo $count_sent;?></span> messages</p>
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
                        <li><a href="#">Messages</a></li>
              <li class="active">Sent Mail</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid white-bg">

          <div class="row">

            <aside class="col-md-2 fix-on-scroll">

              <div class="margin-bottom-30">
                <a href="compose.php" class="btn btn-danger form-control">Compose</a>
              </div>
              
              <ul class="nav nav-messages margin-bottom-30">
                <li><a href="inbox.php" class="active"> Inbox</a></li>
                <li><a href="sent.php" class="">Sent</a></li>
                
              </ul>

            </aside> <!-- / aside -->


            <div class="col-md-10">

      

              <table class="table messages-table table-hover">
                <tbody>
                <?php
                
 while($x11=mysql_fetch_array($res_sent))
            {
           ?>
                  <tr class="unread starred">
                     <td class="from"><div><a href="view-message.php?sent=sent&id=<?=$x11['id']?>">J<?=$x11['reciever_name']?></a></div></td>
                    <td class="subject hidden-xs"><div>

                 
<?php if($x11['file_name']){?><a href="attachfile/<?=$x11['file_name']?>" target="_blank">   <span class="label label-danger">Attach File</span></a><?php } else {} ?>
                    <a href="view-message.php?sent=sent&id=<?=$x11['id']?>"><?=$x11['subject']?></a></div></td>
                    <td class="summary hidden-xs"><div><a href="view-message.php?sent=sent&id=<?=$x11['id']?>"> <?php echo substr($x11['message'],0,20);?></a></div></td>
                    <td class="date-time text-right"><a href="view-message.php?sent=sent&id=<?=$x11['id']?>"><?php echo $x11['msg_date'];?></a></td>
                  </tr>
                  <?php } ?>

                 

                </tbody>
              </table> <!-- /table -->

            </div> <!-- / col-md-10 -->

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
  <script src="js/sugarrush.inbox.js"></script>
  </body>
</html>