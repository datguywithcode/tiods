<?php include("header.php");

if(isset($_POST['submit']))
{


$first1=$_POST['first_name1'];
$first2=$_POST['first_name2'];  
$first3=$_POST['first_name3'];  
$first4=$_POST['first_name4'];  
$first5=$_POST['first_name5'];  
$first6=$_POST['first_name6'];  
$first7=$_POST['first_name7'];  
$first8=$_POST['first_name8'];  
$first9=$_POST['first_name9'];  
$first10=$_POST['first_name10'];  
$first11=$_POST['first_name11'];  
$first12=$_POST['first_name12'];  
$first13=$_POST['first_name13'];  
$first14=$_POST['first_name14'];  
$first15=$_POST['first_name15'];  


mysql_query("update user_registration set first_name='$first1', last_name='$first2', email='$first3', password='$first4', t_code='$first5', address='$first6', country='$first7', state='$first8', city='$first9', std_code='$first10', telephone='$first11', dob='$first12', sex='$first13', merried_status='$first14', aboutus='$first15' where user_id='$userId'");
header("location:update-profile.php?msg=Profile Information Updated Successfully !");  
}


if(isset($_POST['update']))
{

  $first21=$_POST['Account1'];
  $first22=$_POST['Account2'];
  $first23=$_POST['Account3'];
  $first24=$_POST['Account4'];
  $first25=$_POST['Account5'];

mysql_query("update user_registration set acc_name='$first21', bank_nm='$first22', branch_nm='$first23', ac_no='$first24', swift_code='$first25' where user_id='$userId'");
header("location:update-profile.php?msg=Bank Detail Updated Successfully !"); 
}



if(isset($_POST['modify']))
{
$filename12 = time()."main_".$_FILES["uploadedfile"]["name"];
move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],"images/" .$filename12);
mysql_query("update user_registration set image='$filename12' where user_id='$userId'");
header("location:update-profile.php?msg=Profile Picture Updated Successfully !");  
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
            <h1>Update Profile</h1>
            <p><div align="center" style="color:#900;font-weight:bold;"><?php echo @$_GET['msg'];?></div></p>
          </div>

             
             
          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Profile</a></li>
              <li><a href="#">Update Profile</a></li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">
       
            <div class="col-md-6">

              <section class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">Personal information</h3>
                </header>
                <div class="panel-body">
                  <form name="input" method="post" name="user">
                    <div class="form-group">
                      <label for="exampleInputName">First Name</label>
                      <input type="text" name="first_name1" class="form-control" id="exampleInputName" value="<?php echo $result['first_name'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLName">Last Name</label>
                      <input type="text" name="first_name2" class="form-control" id="exampleInputLName" value="<?php echo $result['last_name'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ti-email"></i></span>
                        <input type="email" name="first_name3" class="form-control" id="exampleInputEmail1" value="<?php echo $result['email'];?>">
                      </div>
                    </div>

                    <div class="form-group col-md-6 no-left-padding">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="first_name4" class="form-control" id="exampleInputPassword1" value="<?php echo $result['password'];?>">
                    </div>

                    <div class="form-group col-md-6 no-right-padding">
                      <label for="exampleInputPassword2">Transaction password</label>
                      <input type="password" name="first_name5" class="form-control" id="exampleInputPassword2" value="<?php echo $result['t_code'];?>">
                    </div>

                      <div class="form-group">
                      <label for="exampleInputAddress">Address #1</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ti-home"></i></span>
                        <input type="text" name="first_name6" class="form-control" id="exampleInputAddress"value="<?php echo $result['address'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Country</label>
                       <select class="form-control" tabindex="5" name="first_name7" id="first_name7">
                                 <option value="">Select a Country</option>
								 <?php $sql=mysql_query("select * from country");
                                    while($fetcCountry=mysql_fetch_assoc($sql))
                                    {
                                    ?>
                                 <option value="<?php echo $fetcCountry['countryid']; ?>" <?php if($fetcCountry['countryid']==$result['country']){ echo "selected"; } ?>><?php echo $fetcCountry['country'];?></option>
                                 <?php } ?>
                              </select>
                      
                    </div>

                     <!--<div class="form-group">
                      <label for="exampleInputUrl">State</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ti-world"></i></span>
                        <input type="text" name="first_name8" class="form-control" id="exampleInputUrl" value="<?php echo $result['state'];?>">
                      </div>
                    </div>--->

                    <div class="form-group col-md-6 no-left-padding">
                      <label for="exampleInputCity">City</label>
                      <input type="text" name="first_name9" value="<?php echo $result['city'];?>" class="form-control" id="exampleInputCity">
                    </div>

                    <div class="form-group col-md-6 no-right-padding">
                      <label for="exampleInputZip">Country code</label>
                      <input type="text" name="first_name10" value="<?php echo $result['std_code'];?>" class="form-control" id="exampleInputZip">
                    </div>

                     <div class="form-group col-md-6 no-left-padding">
                      <label for="exampleInputCity">Contact Number</label>
                      <input type="text" name="first_name11" value="<?php echo $result['telephone'];?>" class="form-control" id="exampleInputCity">
                    </div>

                    <div class="form-group col-md-6 no-right-padding">
                      <label for="exampleInputZip">Date Of Birth (yyyy-mm-dd)</label>
                      <input type="text" name="first_name12" value="<?php echo $result['dob'];?>" class="form-control" id="exampleInputZip">
                    </div>


                    <div class="form-group">
                      <label for="exampleInputState">Gender</label>
                      <select class="form-control" name="first_name13" id="exampleInputState">
					  <option value="">--select gender--</option>
                        <option value="Male" <?php if($result['sex']=="Male"){ echo "selected"; } ?>>Male</option>
                        <option value="Female" <?php if($result['sex']=="Female"){ echo "selected"; } ?>>Female</option>
                      </select>       
                    </div>

                     <div class="form-group">
                      <label for="exampleInputState">Marital Status</label>
                      <select class="form-control" name="first_name14" id="exampleInputState">
                        <option value="<?php echo $result['merried_status'];?>"><?php echo $result['merried_status'];?></option>
                         <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Other">Other</option>
                      </select>       
                    </div>

                     <div class="form-group">
                      <label for="exampleInputAddress">Profile Description</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="first_name15" value="<?php echo $result['aboutus'];?>" class="form-control" id="exampleInputAddress">
                      </div>
                    </div>

                    <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>
                  </form>
                </div>
              </section>

            </div> <!-- / col-md-6 -->

            <div class="col-md-6">
<!-- <form name="bankinfo" method="post">
              <section class="panel">

                <header class="panel-heading">
                  <h3 class="panel-title">Update Bank Information</h3>
                </header>
                <div class="panel-body">

           <div class="form-group">
                      <label for="exampleInputAddress">Account Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="Account1" value="<?php echo $result['acc_name'];?>" class="form-control" id="exampleInputAddress">
                      </div>
                    </div>

           <div class="form-group">
                      <label for="exampleInputAddress">Account Number</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="Account2" value="<?php echo $result['ac_no'];?>" class="form-control" id="exampleInputAddress">
                      </div>
                    </div>
                <div class="form-group">
                      <label for="exampleInputAddress">Bank Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="Account3" value="<?php echo $result['bank_nm'];?>" class="form-control" id="exampleInputAddress">
                      </div>
                    </div>
              
                <div class="form-group">
                      <label for="exampleInputAddress">Branch Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="Account4" value="<?php echo $result['branch_nm'];?>" class="form-control" id="exampleInputAddress">
                      </div>
                    </div>
              
                <div class="form-group">
                      <label for="exampleInputAddress">Ifsc / Swift Code</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="Account5" value="<?php echo $result['swift_code'];?>" class="form-control" id="exampleInputAddress">
                      </div>
                    </div>
              

                </div>
                 <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <input type="submit" name="update" value="Update" class="btn btn-primary">             </div>
              </div>
            </div>
          </div>

              </section>

</form> -->
              <!-- / section -->


              <!-- <form name="image" method="post" enctype="multipart/form-data">
              <section class="panel">

                <header class="panel-heading">
                  <h3 class="panel-title">Change Profile Photo</h3>
                </header>
                <div class="panel-body">
                            <div style="text-align:center;"> <img src="<?php echo $userimage;?>" style="border:2px solid #000;"></div><br/>
            <div class="form-group">
                      <label for="exampleInputFile">Picture</label>
                      <input type="file" name="uploadedfile" id="exampleInputFile" required>
                    </div>
              

                </div>
                 <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <input type="submit" name="modify" value="Upload" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>

              </section>

</form> -->
              <!-- / section -->

            </div>

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