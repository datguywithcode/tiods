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
          
              <li class="active">Last Login : <?php echo $f['last_login_date'];?></li>
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
$total_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total1 from credit_debit where user_id='$userid' and ttype!='Fund Transfer'"));

// Code for display last day income //
$yesterday_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total2 from credit_debit where user_id='$userid' and ttype!='Fund Transfer' and receive_date='$last_date'"));

// Code for display this week income //
$week_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total3 from credit_debit where user_id='$userid' and ttype!='Fund Transfer' and receive_date between '$start' and '$end'"));

// Code for display total sponsor income //
$sponsor_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total4 from credit_debit where user_id='$userid' and ttype='Sponsor Income'"));

// Code for display total Binary income //
$binary_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total5 from credit_debit where user_id='$userid' and ttype='Binary Income'"));

// Code for display total Matching income //
$matching_earning=mysql_fetch_array(mysql_query("select sum(credit_amt) as total6 from credit_debit where user_id='$userid' and ttype='Matching Income'"));

// Code for display total downline member //
$total_downline=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid'"));

// Code for display total left downline member //
$total_left_downline=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid' and leg='left'"));

// Code for display total right downline member //
$total_right_downline=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid' and leg='right'"));
          ?>
          
          	<div class="row row-stat">
                            <div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style="background:#10537d !important; min-height:142px !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Direct Prospect</h1>
                                        </div><!-- media-body -->
                                        
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							
							<div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style="background:#10537d !important; min-height:142px !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Direct Customers</h1>
                                        </div><!-- media-body -->
                                        
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style="background:#10537d !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Wallet</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h5 class="nomargin white">Available Balance = <font size="5">223322.50 USD</font></h5>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                       </div>     
                            
                            
					<div class="row row-stat">
                            <div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style="background:#10537d !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Direct Commission</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h4 class="nomargin white">Till Date = 00.00 USD</h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							
							
							<div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style="background:#10537d !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Team Building Commission</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h4 class="nomargin white">Till Date = 00.00 USD</h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style="background:#10537d !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Matching Commission</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h4 class="nomargin white">Till Date = 00.00 USD</h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            
                            
                            
                            
					<div class="row row-stat">
                            <div class="col-md-4">
                                <div class="panel panel-success noborder">
                                    <div class="panel-heading noborder" style="background:#238039 !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Direct Money Box</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h5 class="nomargin white">Time Remaining : 21 Days, 14 Hours, 33 Min, 13 Sec.</h5>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							
							
							<div class="col-md-4">
                                <div class="panel panel-success noborder">
                                    <div class="panel-heading noborder" style="background:#238039 !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Team Building Money Box</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h5 class="nomargin white">Time Remaining : 21 Days, 14 Hours, 33 Min, 13 Sec.</h5>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4">
                                <div class="panel panel-success noborder">
                                    <div class="panel-heading noborder" style="background:#238039 !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Voucher Commission</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="text-right">
                                                <h5 class="nomargin white">Available Balance = 00.00 USD</h5>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="row row-stat">
                            <div class="col-md-4">
                                <div class="panel panel-primary orange noborder">
                                    <div class="panel-heading noborder lla" style="background:#e47e34 !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Account Settings</h1>
                                        </div><!-- media-body -->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							
							
							<div class="col-md-4">
                                <div class="panel panel-primary orange noborder">
                                    <div class="panel-heading noborder lla" style="background:#e47e34 !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Messenger</h1>
                                        </div><!-- media-body -->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							<div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder lla" style="background:#e47e34 !important;">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h1 class="mt5 white mar-0">Official News</h1>
                                        </div><!-- media-body -->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
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