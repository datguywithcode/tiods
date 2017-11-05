<?php include("header.php");
//////////product details////////////////

if(isset($_GET['invoice_no']) && !empty($_GET['invoice_no']))
{
	$invoice=$_GET['invoice_no'];
}
else
{
	$invoice="";
}

if(isset($_GET['p_id']) && !empty($_GET['p_id']))
{
	$pId=$_GET['p_id'];
}
else
{
	$pId="";
}

if(isset($_GET['type']))
{
	$type=$_GET['type'];
}
else
{
	$type="";
}



if ($type == '1') {
	
	$mem="Client";
	
} else if ($type == '2') {
	$mem="Marketer";

} else if ($type == '3') {
	$mem="Networker";

} else {
$mem="";
}


		$amouconti=" invoice_no='".$invoice."'";
		$amountSql=$obj_rep->query("*","purchase_detail",$amouconti);
		$data=$obj_rep->get_all_row($amountSql);
		
		
		$contion=" p_cat_id='".$pId."' and status='0'";
		$sql=$obj_rep->query("*","product_category",$contion);
		$getProddes=$obj_rep->get_all_row($sql);

		$arr_status=array('Partial Payment','Paid');
		
		if($getProddes['image']=='')
						{
						$image="../product_logos/nv.jpg";
						}
						else
						{
						$image="../product_logos/".$getProddes['image'];
						}
		


?>
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

    <!-- SugarRush CSS -->
    <!-- <link href="css/sugarrush.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
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

                <div class="panel invoice">
                    <div class="panel-body" id="pirnts">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="invoice-logo">
                                    <img src="images/logo.png" width="250" alt=""/>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <h1>invoice</h1>
                            </div>
                            <div class="col-xs-4">
                                <div class="total-purchase">
                                    Paid Amount
                                </div>
                                <div class="amount"><?php echo Currency.$data['net_price'];?>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <br/>
                        <br/>
                        <div class="row">
                            <!--<div class="col-xs-4">

                                <address>
                                    <strong>OFFICE ADDRESS</strong>
                                    <br>Tiods
                                    <br>
                                    Road 1, House 2, Sector 3
                                    <br>
                                    ABC, Dreamland 1230
                                    <br/>
                                    P: +32 (123) 654-678
                                </address>
                            </div> -->
                            <div class="col-xs-8">
                                <strong>
                                    TO
                                </strong>
                                <br/><?php echo $result['first_name']." ".$result['last_name'];?>
                                <br/><?php echo $result['address'];?>
                                <br/><?php echo $result['city'];?>, <?php echo $obj_func->getCountry($result['country']);?>
                                <br/>Tel: <?php echo $result['std_code']."-".$result['telephone'];?>
                            </div>
                            <div class="col-xs-4 inv-info">
                                <strong>INVOICE INFO :</strong>
                                <br/> <span> Invoice Number :</span>	<?php echo $data['invoice_no'];?>
                                <br/><span> Invoice Date :</span>	<?php echo $data['date'];?>
								<br/> <span>AWB : </span><?php echo $data['ship_traking'];?>
								 <br/> <span>Current Membership : </span><?php echo $mem;?>
                                <br/> <span> Invoice Status : </span><?php echo $arr_status[$data['status']];?>
								<?php 
								if(($type=='1' || $type=='2') && $data['status']=='0')
								{ ?>
								<br /><br /> <a href="summary_upgrade.php?p_id=<?php echo $pId; ?>&&type=<?php echo $type; ?>&&upgrade=<?php echo $type; ?>&&invoice_no=<?php echo $data['invoice_no']; ?>" class="btn btn-success btn-lg">Upgrade Membership</a>
								<?php } ?>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <br/>

                        <table class="table table-striped table-hover">
						<?php

									
										if(mysql_num_rows($amountSql)>0)
										{
											?>
						
						
                            <thead>
                            <tr>
                                <th>PRODUCT NAME</th>
                                <th>IMAGES</th>
								<th>Product Points</th>
								<th>TOTAL COST</th>
                            </tr>
                            </thead>
                            <tbody>
							
							<tr>
							
                                <td><?php echo $getProddes['product_name'];?></td>
                                <td class="hidden-xs"><img src="<?php echo $image ; ?>" width="40" height="40"></td>
								
                                <td class=""><?php echo $data['product_volume'];?></td>
								<td class=""><?php echo Currency." ".$data['price'];?></td>
                            </tr>
                           
                            </tbody>
                        </table>
                        <br/>
                        <br/>

                        <div class="row">
                            <div class="col-xs-8">
                                <h4>PAYMENT METHOD</h4>
                                <ul class="list-unstyled">
                                    <li>
                                        <b><?php echo $data['pay_mode'];?></b>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="col-xs-4">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td><?php echo Currency.$data['price'];?></td>
                                    </tr>
									
									<tr>
                                        <td>Paid Amount</td>
                                        <td><?php echo Currency.$data['net_price'];?></td>
                                    </tr>
                                   
									<tr>
                                        <td>Pending Amount</td>
                                        <td><?php $amount=$data['price']-$data['net_price']; echo Currency.$amount;?></td>
                                    </tr>
									
                                    <tr>
                                        <td>
                                            <strong>GRAND TOTAL</strong>
                                        </td>
                                        <td><strong><?php echo Currency.$data['net_price'];?></strong></td>
                                    </tr>
                                    </tbody>
										<?php } ?>
                                </table>
                            </div>
                        </div>

                        <br/>
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <a class="btn btn-danger" onclick="return printDiv('pirnts');"><i class="fa fa-print"></i> Print</a>
                                    <!--<a href="#" class="btn btn-success">Generate PDF</a>-->
                                </div>
                                <div class="pull-right">
                                    <!-- <a href="#" class="btn btn-success">Submit Payment</a>-->
                                </div>
                            </div>

                        </div>

                    </div>
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