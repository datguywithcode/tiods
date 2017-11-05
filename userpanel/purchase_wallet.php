<?php include("header.php");

if(isset($_POST['purchase_invoice']) && $_POST['purchase_invoice']=='Submit')
{
$productId=$_GET['pid'];
$date = date('Y-m-d');

function meberins()
{
    
    $encypt1    = uniqid(rand(1000000000, 9999999999), true);
    $usid1      = str_replace(".", "", $encypt1);
    $pre_userid = substr($usid1, 0, 10);
    $checkid    = mysql_query("select invoice_no from amount_detail where invoice_no='$pre_userid'");
    if (mysql_num_rows($checkid) > 0) {
        meberins();
    } else
        return $pre_userid;
}

$invoicem  = meberins();
$_SESSION['invoice_no'] = $invoicem;
		
$selQry = mysql_query("select * from shipping_address where user_id='" . $$userId . "'") or die(mysql_error());
	
	if (mysql_num_rows($selQry) > 0) {
        
        $updQry = array(
            'phoner' => $_POST['s_phoner'],
            'email' => $_POST['s_email'],
            'address1' => $_POST['s_address1'],
            'city' => $_POST['s_city'],
            'zip' => $_POST['s_zip'],
            'state' => $_POST['s_state'],
            'country' => $_POST['s_country']
        );
        
        $condition = " user_id='" . $userId . "'";
        $mxDb->update_record('shipping_address', $updQry, $condition);
        
    } else {
        
        
        $sql_shiping = array(
            'user_id' => $userId,
            'user_name' => $f['username'],
            'first_name' => $f['first_name'],
            'last_name' => $f['last_name'],
            'phoner' => $_POST['s_phoner'],
            'email' => $_POST['s_email'],
            'address1' => $_POST['s_address1'],
            'city' => $_POST['s_city'],
            'zip' => $_POST['s_zip'],
            'country' => $_POST['s_country']
            
        );
       $mxDb->insert_record('shipping_address', $sql_shiping);
		
		
        
    }
	
	$condition = " where p_cat_id = '" . $productId . "'";
    $args_user = $mxDb->get_information('product_category', '*', $condition, true,'assoc');
	
	
	
	$insert_arr = array(
            'user_id' => $userId,
			'user_name' => $f['username'],
            'product_name' => $args_user['product_name'],
            'invoice_no' => $invoicem,
            'p_id' => $productId,
            'currency' => CURRENCY,
            'net_price' => $args_user['cost_price'],
			'price' => $args_user['cost_price'],
            'date' => $date,
            'status' => '0',
            'product_volume' => $args_user['product_volume']
		);
        $mxDb->insert_record('purchase_detail', $insert_arr);
		
		$sql_amount = array(
        'user_id' => $userId,
        'status' => '0',
        'invoice_no' => $invoicem,
        'net_amount' => $args_user['cost_price'],
        'total_amount' => $args_user['cost_price'],
        'total_bv' => $args_user['product_volume'],
        'date' => $date
    );
    
    $mxDb->insert_record('amount_detail', $sql_amount);

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
	function membership(id)
	{
		//window.location.href = 'purchase_wallet.php?type='+id+'&&pid='+<?php echo $_GET['pid']; ?>+'&&invoice_no='+<?php echo $_GET['invoice_no']; ?>+'&&purid='+<?php echo $_GET['purid']?>; 
		
		window.location.href = 'purchase_wallet.php?type='+id+'&&pid='+<?php echo $_GET['pid']; ?>;
		
	}
	
	
	
	/*function ewalPerValue()
	{

	var inp1=document.getElementById("e_wallet").value;
	if(inp1>100)
	{
	alert('Percentage Should be below 100%');
	window.setTimeout(function() { document.getElementById("e_wallet").focus(); },0);
	}


	}


	function voucPerValue()
	{

	var inp1=document.getElementById("v_wallet").value;
	var inp2=inp1.length;
	if(inp1>100)
	{
	alert('Percentage Should be below 100%');
	window.setTimeout(function() { document.getElementById("v_wallet").focus(); },0);
	}

	}*/
	
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
            <h1>Product Payment</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Product Payment</a></li>
              <li><a href="#">Product Payment</a></li>
             
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">
		  
		  <form method="post" name="contactform" action="purchase_invoice_confirmation.php?pid=<?php echo $_GET['pid']; ?>&&invoiceno=<?php echo $_SESSION['invoice_no']; ?>&&type=<?php echo $_GET['type']; ?>">
		  <?php 
				if($f['user_type']=='0'){ ?>
		  <div class="col-md-12">
			  <section class="panel panel-primary">
			    <header class="panel-heading">
                  <h4 class="panel-title">Type of Membership</h4>
                </header>
				
				<div class="panel-body">
				<div class="form-group">
                      <label for="exampleInputState">Type of membership</label>
                      <select class="form-control" required onchange="membership(this.value)" name="member_ship" required id="exampleInputState">
					  <option value="">--Member Ship--</option>
                        <option value="1" <?php if(isset($_GET['type']) && $_GET['type']=='1'){echo "selected";}?>>Customer (Pays 50% of product value)</option>
					   <option value="2" <?php if(isset($_GET['type']) && $_GET['type']=='2'){echo "selected";} ?>>T.B.C Qualefied Member (Pays 75% of product value)</option>
                        <option value="3" <?php if(isset($_GET['type']) && $_GET['type']=='3'){echo "selected";} ?>>Matching Qualified Member (Pays 100% of product value)</option>
                      </select>       
                    </div>
				
				</div>
				</div>
			<?php } ?>
		  
		  
		  
		<div class="col-md-12">
                     <section class="panel panel-primary">
                        <header class="panel-heading">
                           <h4 class="panel-title">Orders</h4>
                        </header>
                        <div class="panel-body">
                           <table class="table">
						   <?php
						   
						   if(isset($_GET['pid']) && !empty($_GET['pid']))
						   {
							   $productId=$_GET['pid'];
						   }
						   
						   $fetechProduct=mysql_fetch_assoc(mysql_query("select * from product_category where p_cat_id='".$productId."' and status='0'"));
						   
								if($_GET['type']=='1')
								{
								$discount="50";
								}
								else if($_GET['type']=='2')
								{
								$discount="75";
								}
								else if($_GET['type']=='3')
								{
								$discount="100";
								}
						   
						   ?>
						   
						   
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
                                <tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
									<?php if(isset($_GET['type']) && !empty($_GET['type'])){ ?>
                                    <td colspan="1" style="border-top:none;">Discount</td>
                                    <td style="border-top:none;" colspan="2"><?php echo $discount; ?>%</td>
									<?php } ?>
									
                                 </tr>
                                 <tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td colspan="1" style="border-top:none;">Grand Total (<?php echo CURRENCY; ?>)</td>
                                    <td style="border-top:none;" colspan="2">
									<?php 
									if(isset($_GET['type']) && !empty($_GET['type']))
									{
									$grandTotal=$fetechProduct['cost_price']*($discount/100);	
									}
									else
									{
									$grandTotal=$fetechProduct['cost_price'];	
									}
									
									
									
									echo Currency." ".$grandTotal; ?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </section>
                  </div>
		  
		  
		    <div class="col-md-12">
			  <section class="panel panel-primary">
			  <span style="color:red;"><?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?></span>
                <header class="panel-heading">
                  <h4 class="panel-title">Product Payment</h4>
                </header>
				<div class="panel-body">
					<div class="form-group">
                      <label for="exampleInputAddress">E-Wallet Amount (<?php echo "Available Amount ".Currency.getEwalletAmount($userId); ?>)</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="e_wallet" onblur="return ewalPerValue();"  class="form-control" id="e_wallet">
                      </div>
                    </div>

           <div class="form-group">
                      <label for="exampleInputAddress">Voucher-Wallet Amount (<?php echo "Available Amount ".Currency.getVwalletAmount($userId); ?>)</label>
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" name="v_wallet" onblur="return voucPerValue();" class="form-control" id="v_wallet">
						
						<input type="hidden" name="grandToal" value="<?php echo $grandTotal; ?>">
						</div>
                    </div>
					<div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary"></div>
              </div>
            </div>
          </div>
		  
                
				</div>
				</section>
            </div> <!-- /col-md-6 -->
			</form>
		</div>
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
  <script src="js/jquery.dataTables.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.tables.js"></script>
  </body>
</html>