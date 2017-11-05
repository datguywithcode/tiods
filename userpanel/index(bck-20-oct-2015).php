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
    
    <link href='css/verticalbargraph.css' rel='stylesheet' type='text/css'/>

    <!-- SugarRush CSS -->
    <!-- <link href="css/sugarrush.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
	.nomargin{
		margin-bottom:0;
	}
	hr{
		margin-top:5px;
		margin-bottom:5px;
	}
	.mt5{
		font-size:25px;
	}
	</style>
  </head>

  <body class="">
    <div class="animsition">  
    <?php include("sidebar.php");?>


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
            <h1>Dashboard</h1>
            
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
          
              <li class="active">Last Login : <?php echo $result['last_login_date'];?></li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->
        
        
        <div class="container-fluid">
          <div class="row">
          
          
<?php 
$d = strtotime("today");
$start_week = strtotime("last sunday midnight",$d);
$end_week = strtotime("next saturday",$d);
$start = date("Y-m-d",$start_week); //First Day of Week
$end = date("Y-m-d",$end_week);  // Last day of week
$last_date = date('Y-m-d', strtotime('-1 Day')); // Last day date

// Code for display total income //
$total_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total1 from credit_debit where user_id='$userId' and ttype!='Fund Transfer'"));

// Code for display last day income //
$yesterday_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total2 from credit_debit where user_id='$userId' and ttype!='Fund Transfer' and receive_date='$last_date'"));

// Code for display this week income //
$week_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total3 from credit_debit where user_id='$userId' and ttype!='Fund Transfer' and receive_date between '$start' and '$end'"));

// Code for display total sponsor income //
$sponsor_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total4 from credit_debit where user_id='$userId' and ttype='Sponsor Income'"));

// Code for display total Binary income //
$binary_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total5 from credit_debit where user_id='$userId' and ttype='Binary Income'"));

// Code for display total Matching income //
$matching_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total6 from credit_debit where user_id='$userId' and ttype='Matching Income'"));

// Code for display total downline member //
$total_downline=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userId'"));

// Code for display total left downline member //
$total_left_downline=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userId' and leg='left'"));

// Code for display total right downline member //
$total_right_downline=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userId' and leg='right'"));
          ?>
          
          
                
                
                
          
          	<div class="row row-stat">
                            <div class="col-md-4" onClick="location.href='my-prospect.php';">
                            	
                                                    <div class="panel-heading noborder" style="background:#1a2a42 !important; min-height:95px !important;">
                                                        <div class="panel-btns" style="display: none;">
                                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                        </div><!-- panel-btns -->
                                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                                        <div class="media-body">
                                                            <h1 class="mt5 white mar-0">MY PROSPECTS</h1>
                                                        </div><!-- media-body -->
                                                        
                                                        
                                                    </div><!-- panel-body -->

                            </div><!-- col-md-4 -->
							
							
							<div class="col-md-4" onClick="location.href='product.php';">
                            
                                                    <div class="panel-heading noborder" style="background:#1a2a42 !important; min-height:95px !important;">
                                                        <div class="panel-btns" style="display: none;">
                                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                        </div><!-- panel-btns -->
                                                        <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                                        <div class="media-body">
                                                            <h1 class="mt5 white mar-0">E-Shop</h1>
                                                        </div><!-- media-body -->
                                                        
                                                        
                                                    </div><!-- panel-body -->
                                            
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4" onClick="location.href='ewallet-transaction-history.php';">
                            
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">WALLET</h1>
                                                    </div><!-- media-body -->
                                                    <hr>
                                                    <div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h5 class="nomargin white">Available Balance = <font size="5"><?php echo $obj_func->getEwalletAmount($userId)." ".CURRENCY; ?></font></h5>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- panel-body -->
                                
                                    
                            </div><!-- col-md-4 -->
                            
                       </div>					<div class="row row-stat">                            <div class="col-md-4" onClick="location.href='my-client.php';">                            	                                                    <div class="panel-heading noborder" style="background:#1a2a42 !important; min-height:65px !important;">                                                        <div class="panel-btns" style="display: none;">                                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>                                                        </div><!-- panel-btns -->                                                        <div class="panel-icon"><i class="fa fa-users"></i></div>                                                        <div class="media-body">                                                            <h1 class="mt5 white mar-0">My Clients</h1>                                                        </div><!-- media-body -->                                                                                                                                                                    </div><!-- panel-body -->                            </div><!-- col-md-4 -->																					<div class="col-md-4" onClick="location.href='marketers.php';">                                                                                <div class="panel-heading noborder" style="background:#1a2a42 !important; min-height:65px !important;">                                                        <div class="panel-btns" style="display: none;">                                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>                                                        </div><!-- panel-btns -->                                                        <div class="panel-icon"><i class="fa fa-users"></i></div>                                                        <div class="media-body">                                                            <h1 class="mt5 white mar-0">My Marketers</h1>                                                        </div><!-- media-body -->                                                                                                                                                                    </div><!-- panel-body -->                                                                        </div><!-- col-md-4 -->														<div class="col-md-4" onClick="location.href='net-workers.php';">                                                                                <div class="panel-heading noborder" style="background:#1a2a42 !important; min-height:65px !important;">                                                        <div class="panel-btns" style="display: none;">                                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>                                                        </div><!-- panel-btns -->                                                        <div class="panel-icon"><i class="fa fa-users"></i></div>                                                        <div class="media-body">                                                            <h1 class="mt5 white mar-0">My Networkers</h1>                                                        </div><!-- media-body -->                                                                                                                                                                    </div><!-- panel-body -->                                                                        </div><!-- col-md-4 -->                                                   </div>
                            
                            
					<div class="row row-stat">
                            <div class="col-md-4" onClick="location.href='direct-commission-report.php';">
                                
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">DIRECT <br />COMMISSION</h1>
                                                    </div><!-- media-body -->
                                                    <hr>
                                                    <div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h4 class="nomargin white">Till Date = <?php echo $obj_func->sumDirectcomission($userId)." ".CURRENCY; ?> </h4>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- panel-body -->
                                
                            </div><!-- col-md-4 -->
							
							
							
							<div class="col-md-4" onClick="location.href='team-building-commission.php';">
                            
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">TEAM BUILDING <br />COMMISSION</h1>
                                                    </div><!-- media-body -->
                                                    <hr>
                                                    <div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h4 class="nomargin white">Till Date = <?php echo $obj_func->sumTeambuildingComm($userId)." ".CURRENCY; ?></h4>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- panel-body -->
                                            
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4" onClick="location.href='matching-commission-report.php';">
                                
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">MATCHING <br />COMMISSION</h1>
                                                    </div><!-- media-body -->
                                                    <hr>
                                                    <div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h4 class="nomargin white">Till Date = <?php echo $obj_func->sumMatchingcomission($userId)." ".CURRENCY; ?></h4>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- panel-body -->
                                            
                            </div><!-- col-md-4 -->
                            
                    <div class="row row-stat">
                            <div class="col-md-4" onClick="location.href='direct-monybox-report.php';">
                            
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-users"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">BEST CLIENT <br />MONEYBOX</h1>
													</div><!-- media-body -->
                                                    <hr>
													
													<div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h4 class="nomargin white">Till Date = <?php echo $obj_func->totalMoneybox($userId)." ".CURRENCY ?></h4>
                                                        </div>
                                                    </div>
													
													
													
													
                                                    
                                                    
                                                </div><!-- panel-body -->
                                
                            </div><!-- col-md-4 -->
							<div class="col-md-4" onClick="location.href='marketer-monybox-report.php';">
                            
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-users"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">BEST MARKETER <br />MONEYBOX</h1>
													</div><!-- media-body -->
                                                    <hr>
                                                    <div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h4 class="nomargin white">Till Date = <?php echo $obj_func->totalMoneyTbcbox(); ?></h4>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- panel-body -->
                                
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4" onClick="location.href='voucher-transaction-history.php';">
                            
                                                <div class="panel-heading noborder" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">VOUCHER <br />BONUS WALLET</h1>
														
                                                    </div><!-- media-body -->
                                                    <hr>
                                                    <div class="clearfix mt20">
                                                        <div class="text-right">
                                                            <h5 class="nomargin white">Available Balance = <?php echo $obj_func->getVwalletAmount($userId)." ".CURRENCY; ?></h5>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- panel-body -->

                            </div><!-- col-md-4 -->
                            
                            </div>
                            
                            <div class="row row-stat">
                            <div class="col-md-4" onClick="location.href='update-profile.php';">
                            	
                                                <div class="panel-heading noborder lla" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">ACCOUNT SETTINGS</h1>
                                                    </div><!-- media-body -->
                                                    
                                                </div><!-- panel-body -->
                                            
                            </div>
                            <!-- col-md-4 -->
							
							
							
							<div class="col-md-4" onClick="location.href='inbox.php';">
                            	
                                                <div class="panel-heading noborder lla" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">MESSENGER</h1>
                                                    </div><!-- media-body -->
                                                    
                                                </div><!-- panel-body -->

                            </div>
                            <!-- col-md-4 -->
							
							<div class="col-md-4" onClick="location.href='#';">

                                                <div class="panel-heading noborder lla" style="background:#1a2a42 !important;">
                                                    <div class="panel-btns" style="display: none;">
                                                        <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                                    </div><!-- panel-btns -->
                                                    <div class="panel-icon"><i class="fa fa-users"></i></div>
                                                    <div class="media-body">
                                                        <h1 class="mt5 white mar-0">OFFICIAL NEWS</h1>
                                                    </div><!-- media-body -->
                                                    
                                                </div><!-- panel-body -->

                            </div><!-- col-md-4 -->
                            
                            
                            
                            


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
  <script src="js/d3.min.js"></script>
  <script src="js/epoch.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script>
  jQuery(document).ready(function() {
    // REAL TIME DATA GENERATOR
    /*
     * Real-time data generators for the example graphs in the documentation section.
     */
    (function() {

        /*
         * Class for generating real-time data for the area, line, and bar plots.
         */
        var RealTimeData = function(layers) {
            this.layers = layers;
            this.timestamp = ((new Date()).getTime() / 1000)|0;
        };

        RealTimeData.prototype.rand = function() {
            return parseInt(Math.random() * 100) + 50;
        };

        RealTimeData.prototype.history = function(entries) {
            if (typeof(entries) != 'number' || !entries) {
                entries = 60;
            }

            var history = [];
            for (var k = 0; k < this.layers; k++) {
                history.push({ values: [] });
            }

            for (var i = 0; i < entries; i++) {
                for (var j = 0; j < this.layers; j++) {
                    history[j].values.push({time: this.timestamp, y: this.rand()});
                }
                this.timestamp++;
            }

            return history;
        };

        RealTimeData.prototype.next = function() {
            var entry = [];
            for (var i = 0; i < this.layers; i++) {
                entry.push({ time: this.timestamp, y: this.rand() });
            }
            this.timestamp++;
            return entry;
        }

        window.RealTimeData = RealTimeData;


        /*
         * Gauge Data Generator.
         */
        var GaugeData = function() {};

        GaugeData.prototype.next = function() {
            return Math.random();
        };

        window.GaugeData = GaugeData;



        /*
         * Heatmap Data Generator.
         */

        var HeatmapData = function(layers) {
            this.layers = layers;
            this.timestamp = ((new Date()).getTime() / 1000)|0;
        };
        
        window.normal = function() {
            var U = Math.random(),
                V = Math.random();
            return Math.sqrt(-2*Math.log(U)) * Math.cos(2*Math.PI*V);
        };

        HeatmapData.prototype.rand = function() {
            var histogram = {};

            for (var i = 0; i < 1000; i ++) {
                var r = parseInt(normal() * 12.5 + 50);
                if (!histogram[r]) {
                    histogram[r] = 1;
                }
                else {
                    histogram[r]++;
                }
            }

            return histogram;
        };

        HeatmapData.prototype.history = function(entries) {
            if (typeof(entries) != 'number' || !entries) {
                entries = 60;
            }

            var history = [];
            for (var k = 0; k < this.layers; k++) {
                history.push({ values: [] });
            }

            for (var i = 0; i < entries; i++) {
                for (var j = 0; j < this.layers; j++) {
                    history[j].values.push({time: this.timestamp, histogram: this.rand()});
                }
                this.timestamp++;
            }

            return history;
        };

        HeatmapData.prototype.next = function() {
            var entry = [];
            for (var i = 0; i < this.layers; i++) {
                entry.push({ time: this.timestamp, histogram: this.rand() });
            }
            this.timestamp++;
            return entry;
        }

        window.HeatmapData = HeatmapData;


    })();

    // Real time line epoch

    var data3 = new RealTimeData(3);

    var chart = $('#real-time-bar').epoch({
        type: 'time.bar',
        data: data3.history(),
        axes: [],
        margins: { top: 0, right: 0, bottom: 0, left: 0 }
    });

    setInterval(function() { chart.push(data3.next()); }, 1000);
    chart.push(data3.next());


  });
  </script>
  </body>
</html>