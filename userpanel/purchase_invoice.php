<?php 
include("header.php");
$s=mysql_fetch_assoc(mysql_query("select * from shipping_address where user_id='".$userid."'"));

if(isset($_GET['pid']) && !empty($_GET['pid']))
{
$productId=$_GET['pid'];
$fetechProduct=mysql_fetch_assoc(mysql_query("select * from product_category where p_cat_id='".$productId."' and status='0'"));
}
$_SESSION['PRODID']=$productId;

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
	function set_values()
	{
		if($("#same_as_billing").prop("checked") == true){

			var phoner = $("#phoner").val();
			var email = $("#email").val();
			var address1 = $("#address1").val();
			// var address2 = $("#address2").val();
			var country = $("#country").val();
			var state = $("#state").val();
			var city = $("#city").val();
			var zip = $("#zip").val();

			$("#s_phoner").val(phoner);
			$("#s_email").val(email);
			$("#s_address1").val(address1);
			// $("#s_address2").val(address2);
			$("#s_country").val(country); 
			$("#s_state").val(state); 
			$("#s_city").val(city);
			$("#s_zip").val(zip);

		}

		else if($("#same_as_billing").prop("checked") == false){

			$("#s_phoner").val("");
			$("#s_email").val("");
			$("#s_address1").val("");
			//$("#s_address2").val("");
			$("#s_country").val(""); 
			$("#s_state").val(""); 
			$("#s_city").val("");
			$("#s_zip").val("");

		}

	}
</script>
   </head>
   <body class="">
      <div class="animsition">
         <?php include("sidebar.php");?>
         <main id="playground">
            <?php include("top.php");?>
            <!-- PAGE TITLE -->
            <section id="page-title" class="row">
               <div class="col-md-8">
                  <h1>Product Summary</h1>
                  <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
               </div>
               <div class="col-md-4">
                  <ol class="breadcrumb pull-right no-margin-bottom">
                     <li><a href="#">Product</a></li>
                     <li><a href="#">Product Summary</a></li>
                  </ol>
               </div>
            </section>
            <!-- / PAGE TITLE -->
			
			<form method="post" name="product" class="form-horizontal" action="purchase_wallet.php">
            <div class="container-fluid">
               <div class="row">
			   
			   
                  <div class="col-md-12">
                     <section class="panel panel-primary">
                        <header class="panel-heading">
                           <h4 class="panel-title">Orders</h4>
                        </header>
                        <div class="panel-body">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Product Volume</th>
                                    <th>Total Price (<?php echo CURRENCY; ?>)</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><?php echo $fetechProduct['product_name']; ?></td>
                                    <td><?php 
                  if($fetechProduct['image']!='')
				  {
				  ?>
                    <img src="<?php echo "../product_logos/".$fetechProduct['image']; ?>" width="90" height="90" />
                    <?php
                  }
				  else
				  {
				  ?>
                    <img src="<?php echo "../product_logos/nv.jpg"; ?>" width="90" height="90" />
                    <?php
				  }
				  ?></td>
                                    <td><?php echo $fetechProduct['product_volume']." PV"; ?></td>
                                    <td><?php echo Currency." ".$fetechProduct['cost_price']; ?></td>
                                 </tr>
                                 <tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td colspan="1" style="border-top:none;">Total PV</td>
                                    <td style="border-top:none;" colspan="1"><?php echo $fetechProduct['product_volume']." PV"; ?></td>
                                 </tr>
                                 <!--<tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td colspan="1" style="border-top:none;">Discount</td>
                                    <td style="border-top:none;" colspan="2">0%</td>
                                 </tr>--->
                                 <tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td colspan="1" style="border-top:none;">Grand Total (<?php echo CURRENCY; ?>)</td>
                                    <td style="border-top:none;" colspan="2"><?php echo Currency; ?> <?php echo $fetechProduct['cost_price']; ?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </section>
                  </div>
                  <!-- /col-md-12 -->
                  <div class="col-md-12">
                     <section class="panel panel-primary">
                        <header class="panel-heading">
                           <div class="col-md-6">
                              <div class="checkbox">
                                 <h4 class="panel-title">Billing/Shipping Address</h4>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <h4 class="panel-title">
                                 <div class="checkbox">
                                    <label>
                                    <input class="tiny checkbox-warning labelauty" type="checkbox" style="display: none;" name="same_as_billing"  id="same_as_billing" onClick="set_values()">
                                    Same as Billing Address
                                    </label>
                                 </div>
                              </h4>
                           </div>
                           <div class="clearfix"></div>
                        </header>
                        <div class="panel-body">
                           <div class="col-md-6">
                             
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-5">Bill Mobile No. :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill Mobile No.." name="phoner" id="phoner" value="<?php echo $f['phoner']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Bill Email ID :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill Email ID.." name="email"  id="email" value="<?php echo $f['email']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Bill Country :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill Country.." name="country" id="country" value="<?php echo $f['country']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Bill State :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill State.." name="state" id="state" value="<?php echo $f['state']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3"  class="col-sm-5">Bill City :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill City.." name="city" id="city" value="<?php echo $f['city']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Bill Address :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill Address.." name="address1" id="address1" value="<?php echo $f['address1']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Bill Postal Code :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Bill Postal Code.." name="zip" id="zip" value="<?php echo $f['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                             
                           </div>
                           <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-5">Shipping Mobile No. :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Shipping Mobile No.." name="s_phoner" id="s_phoner"  value="<?php echo $s['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Shipping Email ID :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Shipping Email ID.." name="s_email"  id="s_email" value="<?php echo $s['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Shipping Country :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Shipping Country.." name="s_country" id="s_country" value="<?php echo $s['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Shipping State :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Shipping State.." name="s_state" id="s_state" value="<?php echo $s['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Shipping City :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Shipping City.." name="s_city" id="s_city" value="<?php echo $s['zip']; ?>"class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-5">Shipping Address :</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="Enter Shipping Address.." name="s_address1" id="s_address1" value="<?php echo $s['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Shipping Postal Code :</label>
                                    <div class="col-sm-7">
									<input type="hidden" name="prod_id" value="<?php if(isset($_GET['pid']) && !empty($_GET['pid'])){ echo $_GET['pid'];} ?>">
									   <input type="text" placeholder="Enter Shipping Postal Code.." name="s_zip" id="s_zip" value="<?php echo $s['zip']; ?>" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-7">
                                       <input type="submit" name="purchase_invoice" class="btn btn-primary" value="Submit">
                                    </div>
                                 </div>
                             
                           </div>
                        </div>
                     </section>
                  </div>
                  <!-- /col-md-6 -->
               </div>
            </div>
			</form>
            <!-- / container-fluid -->
            <div class="col-md-12 text-center">
               <!--<a href="bh_export_binary_income.php?userid=<?=$userid;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a> -->
            </div>
            <?php include("footer.php");?>
         </main>
         <!-- /playground -->
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
      </div>
      <!-- /animsition -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="js/raphael-min.js"></script>
      <script src="js/jquery-1.11.2.min.js"></script>
      <script src="js/jquery-ui.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/jquery.animsition.min.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/includes.js"></script>
      <script src="js/sugarrush.js"></script>
      <script src="js/sugarrush.tables.js"></script>
   </body>
</html>