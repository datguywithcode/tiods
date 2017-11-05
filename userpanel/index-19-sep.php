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
                            <div class="col-md-3">
                                <div class="panel panel-success-alt noborder">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin white">Your Total Earnings</h5>
                                            <h1 class="mt5 white">$ <?php if($total_earning['total1']=='' || $total_earning['total1']==0) { echo '0.00'; } else  { echo number_format($total_earning['total1'],2); } ?></h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin white">Yesterday Earnings</h5>
                                                <h4 class="nomargin white">$ <?php if($yesterday_earning['total2']=='' || $yesterday_earning['total2']==0) { echo '0.00'; } 
                                                else  { echo number_format($yesterday_earning['total2'],2); } ?>

                                                </h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin white">This Week Earnings</h5>
                                                <h4 class="nomargin white">$ 
<?php if($week_earning['total3']=='' || $week_earning['total3']==0) { echo '0.00'; } 
                                                else  { echo number_format($week_earning['total3'],2); } ?>
                                                </h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							
							
							<div class="col-md-3">
                                <div class="panel panel-dark noborder">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin white">Your Total Team (PV)</h5>
                                            <h1 class="mt5 white"><?php echo teamPv($userid); ?></h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin white">Your Left Team (PV)</h5>
                                                <h4 class="nomargin white"><?php echo leftPv($userid);
												?>

                                                </h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin white">Your Right Team (PV) </h5>
                                                <h4 class="nomargin white"><?php echo rightPV($userid);
												?>
                                                </h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
							
							<div class="col-md-3">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin white">Total Sponsor Income</h5>
                                            <h1 class="mt5 white">$ 
<?php if($sponsor_earning['total4']=='' || $sponsor_earning['total4']==0) { echo '0.00'; } 
                                                else  { echo number_format($sponsor_earning['total4'],2); } ?>
                                           </h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin white">Total Binary Income</h5>
                                                <h4 class="nomargin white">$ 

<?php if($binary_earning['total5']=='' || $binary_earning['total5']==0) { echo '0.00'; } 
                                                else  { echo number_format($binary_earning['total5'],2); } ?>
                                                </h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin white">Total Matching Income</h5>
                                                <h4 class="nomargin white">$ <?php if($matching_earning['total6']=='' || $matching_earning['total6']==0) { echo '0.00'; } 
                                                else  { echo number_format($matching_earning['total6'],2); } ?></h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            <div class="col-md-3">
                                <div class="panel panel-dark noborder">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                            <a title="" data-placement="left" data-toggle="tooltip" class="panel-close tooltips" href="#" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin white">Total Downline Member</h5>
                                            <h1 class="mt5 white"><?php echo $total_downline;?></h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin white">Total Left Member</h5>
                                                <h4 class="nomargin white"><?php echo $total_left_downline;?></h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin white">Total Right Member</h5>
                                                <h4 class="nomargin white"><?php echo $total_right_downline;?></h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                        </div>
                        
                        
                        
       
            <!--<div class="col-md-6">
             <div class="alert alert-warning fade in">
                  <button data-dismiss="alert" class="close close-sm" type="button">
                      <i class="ti-close"></i>
                  </button>
                  <strong>Dear <?php //echo $f['username'];?>,</strong>
                  <p><?php //$welcome=mysql_fetch_array(mysql_query("select * from contactdetail where id='17'"));
                           //echo $welcome['description'];
                  ?></p>
              </div>-->
			  

              <div class="row">
                <div class="col-md-6 no-left-padding">
                  <section class="card hovercard">
                    <div class="cardheader"></div>
                    <div class="avatar">
                        <img alt="" src="<?php echo $userimage;?>">
                    </div>

                    <div class="info">
                        <div class="title">
                            <a href="#"><?php echo $f['first_name']." ".$f['last_name'];?></a>
                        </div>
                        <div class="desc">@<?php echo $f['username'];?></div>
                        <div class="desc"><?php echo $f['country'];?></div>
                        <div class="desc"><?php echo $f['state'];?>, <?php echo $f['city'];?></div>
                    </div>
                    <!--<div class="bottom">
                        <a class="btn btn-primary btn-twitter btn-sm" href="#"><i class="ti-twitter"></i></a>
                        <a class="btn btn-danger btn-sm" rel="publisher" href="#"><i class="ti-google"></i></a>
                        <a class="btn btn-primary btn-sm" rel="publisher" href="#"><i class="ti-facebook"></i></a>
                         </div>-->
                  </section>
                </div>
                <div class="col-md-6 no-right-padding">
                  <section class="panel widget-carousel panel-primary">
                    <header class="panel-heading">
                      <h4 class="panel-title">Official Announcement</h4>
                    </header>
                    <div class="panel-body">

                      <div class="carousel slide" data-ride="carousel" id="quote-carousel-2">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#quote-carousel-2" data-slide-to="0" class="active"></li>
                          <li data-target="#quote-carousel-2" data-slide-to="1" class=""></li>
                          <li data-target="#quote-carousel-2" data-slide-to="2"  class=""></li>
                        </ol>
                      </div>         

                    </div>
                  </section>
                </div>
              </div>

              <section class="panel">
                <header class="panel-heading">
                    <h4 class="panel-title">Recent Purchasing</h4>
                </header>
                  <table class="table table-hover table-condensed">
                    <tbody>

                    <?php 
					      $recentpur=mysql_query("select * from purchase_detail where user_id='$userid' order by pd_id desc limit 1");
                          $getrecentpur=mysql_fetch_assoc($recentpur);
						?>
                      <tr>
                        <td><?php echo $getrecentpur['invoice_no'];?></td>
                        <td><?php echo $getrecentpur['product_name'];?></td>
                        <td><?php echo $getrecentpur['net_price'];?></td>
                      </tr>
                    </tbody>
                  </table>
				   <div class="panel-footer text-right">
                    <a href="purchase-order.php" class="btn btn-primary">View All</a>
                  </div>
              </section>
            </div> <!-- / col-md-6 -->

            <div class="col-md-6">

              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 no-left-padding">
                  <a href="#" class="text-widget color-1">
                    <header>My Direct Member
                    <br/><?php $total_direct_member=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid' and level='1'")); echo $total_direct_member;?></header>
                   
                  </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 no-right-padding">
                  <a href="#" class="text-widget color-2">
                    <header>Ewallet Ballance <br/>
                    $ <?php $ewallet_Amount=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$userid'")); echo number_format($ewallet_Amount['amount'],2);?></header>
           
                  </a>
                </div>
              </div>
              
              <section class="panel">
                <header class="panel-heading">
                  <h4 class="panel-title">This Month Income Sumary</h4>
                </header>
                <div class="panel-body">
                  
                  	
                    <div class="bargraph">
                    <ul class="bars">

                    <?php 
                    if($sponsor_earning['total4']=='' || $sponsor_earning['total4']==0)
                    {
                      $sponsor_earning=0;
                    }
                    else
                    {
                      $sponsor_earning=$sponsor_earning['total4'];
                    }
                    if($binary_earning['total5']=='' || $binary_earning['total5']==0)
                    {
                      $binary_earning=0;
                    }
                    else
                    {
                      $binary_earning=$binary_earning['total5'];
                    }
                    if($matching_earning['total6']=='' || $matching_earning['total6']==0)
                    {
                      $matching_earning=0;
                    }
                    else
                    {
                      $matching_earning=$matching_earning['total6'];
                    }

                    if($total_earning['total1']=='' || $total_earning['total1']==0)
                    {
                      $total_earning=0;
                    }
                    else
                    {
                      $total_earning=$total_earning['total1'];
                    }


                     ?>
                        <li class="bar1 bluebar" style="height: <?php echo ceil($sponsor_earning/10);?>px;"></li>
                        <li class="bar2 bluebar" style="height: <?php echo ceil($binary_earning/10);?>px;"></li>
                        <li class="bar3 bluebar" style="height: <?php echo ceil($matching_earning/10);?>px;"></li>
                       <li class="bar4 bluebar" style="height: <?php echo ceil($total_earning/10);?>px;"></li>
                       
             
                      
                    </ul>
                
                	<ul class="y-axis"><li></li><li></li><li>Price</li><li></li><li></li></ul>
                	<p>1)Sponsor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2)Binary &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3)Matching&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4)Total Earning</p>
                    
                </div>
                    
                  
                </div>
              </section>

              <section class="panel panel-danger">
                <header class="panel-heading">
                  <h3 class="panel-title">Last 10 Sponsor Member</h3>
                </header>


                  <table class="table table-hover table-condensed">
                    <tbody>

                    <?php 
                          $dir=1;
                          $direct=mysql_query("select * from user_registration where ref_id='$userid' order by id desc limit 10");
                          while($direct_member=mysql_fetch_array($direct)) 
                          { 
                           ?>
                      <tr>
                        <th scope="row"><?php echo $dir;?></th>
                        <td><?php echo $direct_member['username'];?></td>
                        <td><?php echo $direct_member['first_name']." ".$direct_member['last_name'];?></td>
                        <td><?php echo $direct_member['registration_date'];?></td>
                      </tr>
                     <?php $dir++; } ?>
                    </tbody>
                  </table>


                <div class="panel-footer text-right">
                  <a href="direct-sponsor-member-report.php" class="btn btn-primary">View All</a>
                </div>
              </section>

             

            </div> <!-- / col-md-6 -->

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