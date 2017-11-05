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
  
    $condition = " user_id ='".$_SESSION['user_id']."'";
    $sql = $obj_rep->query('*', 'admin',$condition);
	
	$args_user=$obj_rep->get_all_row($sql);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 

?>
<!DOCTYPE html>
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
        <div class="body-content" >

            <!-- header section start-->
           <?php include("top-menu.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3>
                    Dashboard
                </h3>
               <?php include("top-menu1.php");?>
            <!-- page head end-->
<?php $totuser=mysql_num_rows(mysql_query("select * from user_registration"));?>
            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
				
				<div class="col-lg-1 col-sm-6">
                        <!--<section class="panel d-green">
                            <div class="value gray">
                                <h1 class="timer" data-from="0" data-to="<?php //echo $totuser12['sales1'];?>"
                                    data-speed="1000">
                                    USD
                                </h1>
                                <p>Total Package</p>
                                <p>Sale</p>
                            </div>
                            
                            <div class="symbol">
                                <i class="fa fa-cogs"></i>
                            </div>
                            
                            <div class="drafts2">
                                <p><?php //if($totuser11['sales']=='' || $totuser11['sales']==0) { echo "0"; } else { echo $totuser11['sales'];} ?> USD today sale</p>
                            </div>
                        </section>--->
                    </div>	
				
				 <div class="col-lg-2 col-sm-6">
                        <section class="panel black">
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="<?php echo $totuser;?>"
                                    data-speed="1000">
                                    <!--320-->
                                </h1>
                                <p>Total Registered</p>
                                <p>User</p>
                            </div>
                            
                            <div class="symbol">
                                <i class="fa fa-pencil"></i>
                            </div>
                            
                            <div class="drafts">
                                <p><?php echo $query5;?> User Register Today</p>
                            </div>
                        </section>
                    </div>
                    <?php $totuser12=mysql_fetch_array(mysql_query("select sum(amount) as sales1 from lifejacket_subscription"));?>
                    <?php $totuser11=mysql_fetch_array(mysql_query("select sum(amount) as sales from lifejacket_subscription where date='".date('Y-m-d')."'"));?>
                   
                    <div class="col-lg-2 col-sm-6">
                        <section class="panel d-red">
<?php $totamt1=mysql_fetch_array(mysql_query("select sum(total_amount) as sales1 from amount_detail"));?>
<?php $totamt2=mysql_fetch_array(mysql_query("select sum(total_amount) as sales2 from amount_detail where payment_date='".date('Y-m-d')."'"));?>
                                           
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="<?php if($totamt1['sales1']=='' || $totamt1['sales1']==0) { echo "0"; } else { echo $totamt1['sales1'];} ?>"
                                    data-speed="1000">USD
                                </h1>
                                <p>Total Product</p>
                                <p>Sale</p>
                            </div>
                            <div class="symbol">
                                <i class="fa fa-bar-chart"></i>
                            </div>
                            
                            <div class="drafts2">
                                <p><?php if($totamt2['sales2']=='' || $totamt2['sales2']==0) { echo "0"; } else { echo $totamt2['sales2'];} ?> USD today sale</p>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <section class="panel d-blue">
<?php
// Code for display total sponsor income //
$sponsor_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total4 from credit_debit where ttype='Sponsor Income'"));
$sponsor_earning1=mysql_fetch_array(mysql_query("select sum(credit_amt) as total4 from credit_debit where ttype='Sponsor Income' and receive_date='".date('Y-m-d')."'"));

// Code for display total Binary income //
$binary_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total5 from credit_debit where ttype='Binary Income'"));
$binary_earning1=mysql_fetch_array(mysql_query("select sum(credit_amt) as total5 from credit_debit where ttype='Binary Income' and receive_date='".date('Y-m-d')."'"));

// Code for display total Matching income //
$matching_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total6 from credit_debit where ttype='Matching Income'"));
$matching_earning1=mysql_fetch_array(mysql_query("select sum(credit_amt) as total6 from credit_debit where ttype='Matching Income' and receive_date='".date('Y-m-d')."'"));

?>
                            <div class="value gray">
                                <h1 class="timer" data-from="0" data-to="<?php if($sponsor_earning['total4']=='' || $sponsor_earning['total4']==0) { echo "0"; } else { echo $sponsor_earning['total4'];} ?>"
                                    data-speed="1000">
                                    <!--320-->
                                </h1>
                                <p>Sponsor Income</p>
                                <p>Distributed</p>
                            </div>
                            <div class="symbol">
                                <i class="fa fa-weixin"></i>
                            </div>
                            
                            <div class="drafts2">
                                <p><?php if($sponsor_earning1['total4']=='' || $sponsor_earning1['total4']==0) { echo "0"; } else { echo $sponsor_earning1['total4'];} ?> distribute today</p>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <section class="panel orange">
                            
                            <div class="value gray">
                                <h1 class="timer" data-from="0" data-to="<?php if($binary_earning['total5']=='' || $binary_earning['total5']==0) { echo "0"; } else { echo $binary_earning['total5'];} ?>"
                                    data-speed="3000">
                                    <!--320-->
                                </h1>
                                <p>Binary Income</p>
                                <p>Distributed</p>
                            </div>
                            <div class="symbol">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            
                            <div class="drafts2">
                                <p><?php if($binary_earning1['total5']=='' || $binary_earning1['total5']==0) { echo "0"; } else { echo $binary_earning1['total5'];} ?> distribute today</p>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <section class="panel black">
                           
                            <div class="value gray">
                                <h1 class="timer" data-from="0" data-to="<?php if($matching_earning['total6']=='' || $matching_earning['total6']==0) { echo "0"; } else { echo $matching_earning['total6'];} ?>"
                                    data-speed="1500">
                                    <!--320-->
                                </h1>
                                 <p>Matching Income</p>
                                <p>Distributed</p>
                            </div>
                            <div class="symbol">
                                <i class="fa fa-usd"></i>
                            </div>
                            
                            <div class="drafts">
                                <p><?php if($matching_earning1['total6']=='' || $matching_earning1['total6']==0) { echo "0"; } else { echo $matching_earning1['total6'];} ?> distribute today</p>
                            </div>
                        </section>
                    </div>
                </div>
                <!--state overview end-->
				
				
				<div class="row">
				
					<div class="col-md-12">
				
						<div class="col-md-4 click" onclick="location.href='../matching-commission.php';">
						
							<div class="green-n" style="background:#32434d;">
							
								<h1>Run Matching</h1>
								
							</div>
						
						</div>
						
						<div class="col-md-4 click" onclick="location.href='../money-box-commision.php';">
						
							<div class="green-n" style="background:#d65c4f;">
							
								<h1>Run Best Client Moneybox</h1>
								
							</div>
						
						</div>
						
						<div class="col-md-4 click" onclick="location.href='../marketer-box-commision.php';">
						
							<div class="green-n" style="background:#3ca2bb;">
							
								<h1>Run Best Marketer Moneybox</h1>
								
							</div>
						
						</div>
					
					</div>
				
				</div>

                <!--<div class="row">
                    <div class="col-md-8">
                        <section class="panel">
                            <header class="panel-heading">
                                Earning Graph
                                <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">

                                <div class="earning-chart-space" id="dashboard-earning-chart"></div>

                                <div class="row earning-chart-info">
                                    <div class="col-sm-3 col-xs-6">
                                        <h4>$ 12,37</h4>
                                        <small class="text-muted"> Daily Sales Report</small>
                                    </div>
                                    <div class="col-sm-3 col-xs-6">
                                        <h4>$ 86,69</h4>
                                        <small class="text-muted">Weekly Sales Report</small>
                                    </div>
                                    <div class="col-sm-3 col-xs-6">
                                        <h4>$ 25,9770</h4>
                                        <small class="text-muted">Monthly Sales Report</small>
                                    </div>
                                    <div class="col-sm-3 col-xs-6">
                                        <h4>$ 948,160,50</h4>
                                        <small class="text-muted">Yearly Sales Report</small>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="panel">

                            <div class="slick-carousal">
                                <div class="overlay-c-bg"></div>
                                <div id="news-feed" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <h3 class="text-success">News</h3>
                                        <span class="date">12 March 2015</span>
                                        <h1>If today were the last day of your life, would you want to do what your are about to do today</h1>
                                        <div class="text-center">
                                            <a href="javascript:;" class="view-all">View All</a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h3 class="text-success">News</h3>
                                        <span class="date">11 February 2015</span>
                                        <h1>SlickLab build with Boostrap latest version 3+. Its very easy to customize. Hope you enjoy it..</h1>
                                        <div class="text-center">
                                            <a href="javascript:;" class="view-all">View All</a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h3 class="text-success">News</h3>
                                        <span class="date">10 January 2015</span>
                                        <h1>It has huge usable widgets, amazing design, clean code quality, super responsive and quick customar support.</h1>
                                        <div class="text-center">
                                            <a href="javascript:;" class="view-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </section>

                        <section class="panel">
                            <div class="panel-body">
                                <!--monthly page view start-->
                                <!--<ul class="monthly-page-view">
                                    <li class="pull-left page-view-label">
                                        <span class="page-view-value timer" data-from="0" data-to="93205"
                                              data-speed="4000">
                                            <!--93,205-->
                                        <!--</span>
                                        <span>Monthly Page views</span>
                                    </li>
                                    <li class="pull-right">
                                        <div id="page-view-graph" class="chart"></div>
                                    </li>
                                </ul>
                                <!--monthly page view end-->
                            <!--</div>
                        </section>
                    </div>
                </div>-->

                <!--<div class="row">
                    <div class="col-md-8">
                        <section class="panel" id="block-panel">
                            <header class="panel-heading head-border">
                                mobile visit
                                <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <ul class="mobile-visit">
                                    <li class="page-view-label">
                                        <span class="page-view-value"> 5,2105</span>
                                        <span>Unique visitors</span>
                                    </li>
                                    <li>
                                        <div class="easy-pie-chart">
                                            <div class="iphone-visitor" data-percent="45"><span>45</span>%</div>
                                        </div>
                                        <div class="visit-title">
                                            <i class="fa fa-apple green-color"></i>
                                            <span>iPhone</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="easy-pie-chart">
                                            <div class="android-visitor" data-percent="80"><span>80</span>%</div>
                                        </div>
                                        <div class="visit-title">
                                            <i class="fa fa-android purple-color"></i>
                                            <span>Android</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                       <section class="panel">
                            <div class="panel-body">
                                <!--monthly page view start-->
                                <!--<ul class="monthly-page-view">
                                    <li class="pull-left page-view-label">
                                        <span class="page-view-value timer" data-from="0" data-to="93205"
                                              data-speed="4000">
                                            <!--93,205-->
                                        <!--</span>
                                        <span>Monthly Page views</span>
                                    </li>
                                    <li class="pull-right">
                                        <div id="page-view-graph" class="chart"></div>
                                    </li>

                                </ul>
                                <!--monthly page view end-->
                           <!-- </div>
                        </section>
                         <section class="panel">
                            <div class="panel-body">
                                <!--monthly page view start-->
                               <!-- <ul class="monthly-page-view">
                                    <li class="pull-left page-view-label">
                                        <span class="page-view-value timer" data-from="0" data-to="93205"
                                              data-speed="4000">
                                            <!--93,205-->
                                        <!--</span>
                                        <span>Monthly Page views</span>
                                    </li>
                                    <li class="pull-right">
                                        <div id="page-view-graph" class="chart"></div>
                                    </li>
                                    
                                </ul>
                                <!--monthly page view end-->
                            <!--</div>
                        </section>
                    </div>
                </div>-->

               

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