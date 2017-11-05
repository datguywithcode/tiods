<?php include("header.php");
if(isset($_POST['submit'])){
$rand=rand(0,1000000);
$wallet_from=$_POST['wallet_from'];
$sub8=$_POST['subject8'];
$user_ids=$_POST['id'];

if($_POST['password']==$result['t_code'])
{
if($wallet_from=='withdrawal')
{
$res_reg1=mysql_fetch_array(mysql_query("SELECT * FROM final_e_wallet WHERE user_id='$user_ids'"));
$amount1=$res_reg1['amount'];
$amount=$amount1;
$wit_table='final_e_wallet';
$transaction_charge=0;
$subamounts=$sub8+$transaction_charge;
}
$sub1=$_POST['subject1'];
$sub2=$_POST['subject2'];
$sub3=$_POST['subject3'];
$sub4=$_POST['subject4'];
$sub5=$_POST['subject5'];
$sub6=$_POST['subject6'];
$sub7=$_POST['subject7'];
$sub9=$_POST['subject9'];
$send_id=$_POST['id'];
$date=date("Y-m-d");
if($amount>=$subamounts)
{
$urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
$selecting=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$user_ids'"));
$request_amount1=$selecting['amount']; print_r("<br/>");
$request_amounts1=$request_amount1-$subamounts; print_r("<br/>");
mysql_query("update $wit_table set amount='$request_amounts1' where user_id='$user_ids'");
mysql_query("INSERT INTO `credit_debit` (`id`, `transaction_no`, `user_id`, `credit_amt`, `debit_amt`, `admin_charge`, `receiver_id`, `sender_id`, `receive_date`, `ttype`, `TranDescription`, `Cause`, `Remark`, `invoice_no`, `product_name`, `status`, `ewallet_used_by`,`current_url`) VALUES (NULL, '$rand', '$user_ids', '0', '$subamounts', '0', '123456', '$user_ids', '$date', 'Withdrawal Request', 'Withdrawal Request From Admin', '0', 'Withdrawal Request ', '$rand', 'Withdrawal Request', '0', 'Withdrawal Ewallet','$urls')");
mysql_query("insert into withdraw_request values (NULL,'$rand','$send_id','$sub1','$sub2','$sub3','$sub4','$sub5','$sub6','$sub7','$sub8','$sub9','0','$date','','','$wit_table','$subamounts','$transaction_charge')");
$msg="Request Sent Successfully !";
header("location:withdraw-request.php?msg=$msg");
}
else
{
  $msg="Sorry ! Insufficient Balance In Your Ewallet !";
  header("location:withdraw-request.php?msg=$msg");
}
}
else
{
   $msg="Sorry ! Wrong Transaction Password!";
  header("location:withdraw-request.php?msg=$msg");
}

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
            <h1>Withdrawal Request</h1>
            <p><div align="center" style="color:#900;font-weight:bold;"><?php echo @$_GET['msg'];?></div></p>
          </div>

             
             
          <div class="col-md-4">

            <!--<ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Ewallet</a></li>
              <li><a href="#">Ewallet transferWithdrawal Request</a></li>
            </ol>-->

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">
       
            <div class="col-md-6" style="float:none; margin-left:auto; margin-right:auto;">

           <form name="bankinfo" method="post">
              <section class="panel">

                <header class="panel-heading">
                  <h3 class="panel-title">Withdrawal Request Form</h3>
                </header>
                <header class="panel-heading">
                 <br/> <h3 class="panel-title">Ewallet Ballance :  <?php $data=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$userId'"));?><strong><?php echo $data['amount'];?></strong> USD</h3>
                <br/></header>
                <div class="panel-body">
<input name="wallet" id="wallet" type="hidden" tabindex="1" required class="" style="width:4%;" value="final_e_wallet" checked="checked" />
            
           <div class="form-group">
                      <label for="exampleInputAddress">Receiver Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input name="subject1" type="text" tabindex="1" value="<?php echo $f['first_name'];?>"  style="width:100%; border:1px solid #ebebeb; padding:5px;" class="form-control" id="exampleInputAddress" required />
                  
                      </div>
                    </div>

                      <div class="form-group">
                      <label for="exampleInputAddress">Country</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input name="subject2" type="text" tabindex="1" value="<?php echo $f['last_name'];?>"  style="width:100%; border:1px solid #ebebeb; padding:5px;" class="form-control" id="exampleInputAddress" required />
                  
                      </div>
                    </div>

                      <div class="form-group">
                      <label for="exampleInputAddress">Mobile Number</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input name="subject3" type="text" tabindex="1" value="<?php echo $f['acc_name'];?>"  style="width:100%; border:1px solid #ebebeb; padding:5px;" class="form-control" id="exampleInputAddress" required />
                  
                      </div>
                    </div>

  <div class="form-group">
                      <label for="exampleInputAddress">Requested Amount $</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input name="subject4" type="text" tabindex="1" value="<?php echo $f['ac_no'];?>"  style="width:100%; border:1px solid #ebebeb; padding:5px;" class="form-control" id="exampleInputAddress" required />
                  
                      </div>
                    </div>


  <div class="form-group">
                      <label for="exampleInputAddress">Transaction Password</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input name="subject5" type="text" tabindex="1" value="<?php echo $f['bank_nm'];?>"  style="width:100%; border:1px solid #ebebeb; padding:5px;" class="form-control" id="exampleInputAddress" required />
                  
                      </div>
                    </div>


				<p>* Transfer will be done through Western Union.<br />
				** Western Union fees will be deducted from the Requested Amount</p>



          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary">             </div>
              </div>
            </div>
          </div>

              </section>

</form>

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