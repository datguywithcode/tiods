<?php
include("../lib/config.php");
// manage secure login of user account
if(!isset($_SESSION['token_id'])){
  header("Location:login.php");
}
else if(isset($_SESSION['token_id'])){
  if($_SESSION['token_id'] != md5($_SESSION['user_id'])){
    header("Location:login.php");
  }
  
  else{
  
    $condition = "user_id ='".$_SESSION['user_id']."'";
    $args_user = $mxDb->get_information('*', 'admin', $condition);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 

if(isset($_POST['Add']))
{
$poid=$_POST['id'];
if(isset($_POST['response']) ){
if(!empty($_POST['response']) && !empty($_POST['id'])){
global $mxDb;
$date=date('Y-m-d');
$update_array = array('response'=>$_POST['response'], 'status'=>'1', 'c_t_date'=>$date);
$condition = " id='".$_POST['id']."'";
if($mxDb->update_record('tickets', $update_array,$condition)){
header("Location:open-tickets-response.php?id=$poid&msg=Responded Successfully!&res=1");
}
else
{
header("Location:open-tickets-response.php?id=$poid&msg=Responded failed!&res=0");
}
}
else
header("Location:open-tickets-response.php?id=$poid&msg=Please fill description information!&res=0");
}
else
header("Location:open-tickets-response.php?id=$poid&msg=Please fill description information!&res=0"); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckeditor.js"></script>
    <!--easy pie chart-->
    <link href="css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="css/jquery-jvectormap-1.1.1.css">

    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!--jquery-ui-->
    <link href="css/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />

    <!--iCheck-->
    <link href="css/all.css" rel="stylesheet">

    <link href="css/owl.carousel.css" rel="stylesheet">


    <!--common style-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
     <?php include("sidebar.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
    <?php include("top-menu.php");?>

            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Dashboard
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                 <?php include("top-menu1.php");?>
           
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Open Ticket Response<span style="float:right;color:red;"><?php echo @$_GET['msg'];?></span>
                        </header>
                       
                       
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">
                         
<?php $id=$_GET['id'];$data=mysql_fetch_array(mysql_query("select * from tickets where id='$id'"));?>
<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Ticket Number</label>
                                    <div class="col-lg-10">
                                         <?php echo $data['ticket_no']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">User Name</label>
                                    <div class="col-lg-10">
                                        <?php echo $data['user_name']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">User Id</label>
                                    <div class="col-lg-10">
                                         <?php echo $data['user_id']; ?>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Category Type</label>
                                    <div class="col-lg-10">
                                         <?php echo $data['tasktype']; ?>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Subject</label>
                                    <div class="col-lg-10">
                                         <?php echo $data['subject']; ?>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Posted Date</label>
                                    <div class="col-lg-10">
                                         <?php echo $data['t_date']; ?>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                         <?php echo $data['description']; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Response</label>
                                    <div class="col-lg-10">
                                        <textarea name="response" id="editor2" class="form-control"></textarea>
                                       
                                    </div>
                                </div>
                               <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                       
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" class="btn btn-primary" name="Add" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
           
            </div>
            
            

            </div>
            <!--body wrapper end-->
 <script type="text/javascript">
                         // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor2',
                         {
                              filebrowserBrowseUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/ckfinder.html',
                              filebrowserImageBrowseUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/ckfinder.html?type=Images',
                              filebrowserFlashBrowseUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/ckfinder.html?type=Flash',
                              filebrowserUploadUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                              filebrowserImageUploadUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                              filebrowserFlashUploadUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                              filebrowserWindowWidth : '1000',
                              filebrowserWindowHeight : '700'
                         });
                         </script>
                         

            <!--footer section start-->
           <?php include("footer.php");?>
            <!--footer section end-->


        </div>
        <!-- body content end-->
        
    </section>



<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>

<!--jquery-ui-->
<script src="js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="js/jquery-migrate.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="js/slidebars.min.js"></script>

<!--switchery-->
<script src="js/switchery.min.js"></script>
<script src="js/switchery-init.js"></script>

<!--flot chart -->
<script src="js/jquery.flot.js"></script>
<script src="js/flot-spline.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.tooltip.min.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.selection.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.crosshair.js"></script>


<!--earning chart init-->
<script src="js/earning-chart-init.js"></script>


<!--Sparkline Chart-->
<script src="js/jquery.sparkline.js"></script>
<script src="js/sparkline-init.js"></script>

<!--easy pie chart-->
<script src="js/jquery.easy-pie-chart.js"></script>
<script src="js/easy-pie-chart.js"></script>


<!--vectormap-->
<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/dashboard-vmap-init.js"></script>

<!--Icheck-->
<script src="js/icheck.min.js"></script>
<script src="js/todo-init.js"></script>

<!--jquery countTo-->
<script src="js/jquery.countTo.js"  type="text/javascript"></script>

<!--owl carousel-->
<script src="js/owl.carousel.js"></script>

<!--Data Table-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.tableTools.min.js"></script>
<script src="js/bootstrap-dataTable.js"></script>
<script src="js/dataTables.colVis.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/dataTables.scroller.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<!--data table init-->
<script src="js/data-table-init.js"></script>

<!--common scripts for all pages-->

<script src="js/scripts.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        //countTo

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
    });

    $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });

</script>

</body>
</html>