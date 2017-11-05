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
  
    $condition = " where user_id ='".$_SESSION['user_id']."'";
    $args_user = $mxDb->get_information('*', 'admin', $condition);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 

if(isset($_POST['Add']))
{
   if( isset($_POST['amount']) && isset($_POST['no_voucher']) ){
    
            if( !empty($_POST['amount']) && is_numeric($_POST['amount']) && !empty($_POST['no_voucher']) ){
    
                global $mxDb;
                
                
                $receive_by = '';
                
                
                if(!empty($_POST['user_id'])){
                    
                    // get user information
                    $condition = "where user_id='".$_POST['user_id']."'";
                    $args_user = $mxDb->get_information('user_registration', '*', $condition, true, 'assoc');
                    
                    if(isset($args_user['user_id'])){
                        
                        $receive_by = $args_user['user_id'];
                        
                        
                    }
                    
                }
    
                // create pin table object
                $new_pin = new Pins();
                
                for( $i=0; $i<$_POST['no_voucher']; $i++){
                    
                    
                    $pin_no = $new_pin->get_new_pin('pins');
                    
                    $insert_pin = array(
                    
                            'pin_no' => $pin_no,
                            'amount' => $_POST['amount'],
                            'status' => 0,
                            'crt_date' => date('Y-m-d'),
                            'created_by_user' => 'admin',
                            'receiver_id' => $receive_by,
                            'sender_id' => $_SESSION['user_id'],
                            'used_by'=>''
                    );
                    
                    // insert record into pins
                    $mxDb->insert_record('pins', $insert_pin);
                    
                }
                    
                header("Location:create-epin-reports.php?msg=Successfully create e-vouchers");
            }
            else{
                header("Location:create-epin-reports.php?msg=Please fill all fields");
            }
        }
        else{
            header("Location:create-epin-reports.php?msg=Require fields does not match");
        }
}



?><!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>

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
                <div class="col-lg-7 center-block" style="float:none;">
                    <section class="panel">
                        <header class="panel-heading">
                            Create E Pin<span style="float:right;color:red;"><?php echo @$_GET['msg'];?></span>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">
                         
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">Enter Amount</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="amount" class="form-control" placeholder="Enter the amount" required value="" >
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">No Of Pins</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="no_voucher" class="form-control" id="inputPassword1" placeholder="Enter the quantity" required>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">Select User</label>
                                    <div class="col-lg-8">
                                     <?php
                            // get parent menu
                            $args_users = $mxDb->get_information('final_e_wallet','user_id', 'order by id asc', false, 'assoc'); 
                            
                            if( $args_users ):
                         ?>
                      
                          <select name="user_id" class="form-control">
                          <option value="0">-Select User (If Applicable)-</option>
                            <?php foreach( $args_users as $users ): ?>
                                <option value="<?php echo $users['user_id']; ?>"> <?php $mxDb->get_field_information('user_registration', 'concat_ws(" ", first_name, last_name)', " where user_id='".$users['user_id']."'", 'assoc', true); ?>  (<?php echo $users['user_id']; ?>)</option>
                            <?php endforeach; ?>                                
                          </select>
                          <?php
                            endif;
                          ?>                    
                                         
                                    </div>
                                </div>
                                       
                                <div class="form-group">
                                    <div class="col-lg-offset-4 col-lg-8">
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