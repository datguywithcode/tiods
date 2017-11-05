<?php 
include("header.php");


///////////////////Discount checking on user type///////////////    
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
	
	
if(isset($_GET['pid']) && !empty($_GET['pid']) && isset($_GET['invoiceno']) && !empty($_GET['invoiceno']))
{
$productId=$_GET['pid'];
$invoice=$_GET['invoiceno'];
}

////////////////////////Select product from product category////////

$fetechProduct=mysql_fetch_assoc(mysql_query("select * from product_category where p_cat_id='".$productId."' and status='0'"));
$prodAmount=$fetechProduct['cost_price'];
    
   
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	
	$userAmount=$_POST['e_wallet']+$_POST['v_wallet'];
    if($userAmount==$_POST['grandToal'])
    {
        $_SESSION['EWALLET']=$_POST['e_wallet'];
        $_SESSION['VWALLET']=$_POST['v_wallet'];

///////////////////Payment Mode checking Purchase product///////////////        
        if(((isset($_POST['e_wallet'])) && (!empty($_POST['e_wallet']))) && empty($_POST['v_wallet']))
        {
            $amountType="E-Wallet";
        }
        else if(((isset($_POST['v_wallet'])) && (!empty($_POST['v_wallet']))) && empty($_POST['e_wallet']))
        {
                $amountType="Voucher-Wallet";
        }
        
        else if((isset($_POST['e_wallet']) && !empty($_POST['e_wallet'])) && (isset($_POST['v_wallet']) && !empty($_POST['v_wallet'])))
        {
                $amountType="(E-Wallet)+(Voucher-Wallet)";
        }
        
        $_SESSION['PAYMODE']=$amountType;
        
    }
    else
    {
        $msg="Amount is equal to Grand Total amount";
		
    header("location:purchase_wallet.php?msg=".$msg."&&type=".$_SESSION['MEMSHIP']."&&pid=".$productId);    
    }

}


if(isset($_POST['confirmation']) && $_POST['confirmation']=='Submit')
{

	
	$userPass=mysql_query("select * from user_registration where password='".$_POST['user_pass']."' and user_id='$userId'");
    
    $flag=false;
    
        if (mysql_num_rows($userPass)>0) {
            
            // check user transaction password
            $tranction=mysql_query("select * from user_registration where t_code='".$_POST['t_code']."' and user_id='$userId'");
            
            if (mysql_num_rows($tranction)=='0') {
                
                $msg="User Transaction Not Match";
				header("location:purchase_wallet.php?msg=".$msg."&&type=".$_SESSION['MEMSHIP']."&&pid=".$productId); 
                
            }
            
            else {
                
				if(getEwalletAmount($userId)>=$_SESSION['EWALLET'])
                 {
                    
					$dedctEwalletAmount=getEwalletAmount($userId)-$_SESSION['EWALLET'];
                    $flag=true;
                    
                    
                if(getVwalletAmount($userId)>=$_SESSION['VWALLET'])
                 {
                    $dedctEvoucherAmount=getVwalletAmount($userId)-$_SESSION['VWALLET']; 
                    $flag=true;
                
                
                }
                 else
                 {
                    $msg="Insufficiant E-Voucher Amount";
                    header("location:purchase_wallet.php?msg=".$msg."&&type=".$_SESSION['MEMSHIP']."&&pid=".$productId); 
                 }
                    
                }
                 else
                 {
                    $msg="Insufficiant E-wallet Amount";
                    header("location:purchase_wallet.php?msg=".$msg."&&type=".$_SESSION['MEMSHIP']."&&pid=".$productId);  
                 }
                
                
                 if($flag==true)
                 {
				   $invoicem = $_SESSION['invoice_no'];
					 
					
					
///////////////////Update E-Wallet Amount///////////////    
                    $sql_update = "update final_e_wallet set amount=$dedctEwalletAmount where user_id='$userId'";
                    mysql_query($sql_update);    

                    
///////////////////Update Voucher-Wallet Amount///////////////                        
                    $sql_updates = "update voucher_e_wallet set amount=$dedctEvoucherAmount where user_id='$userId'";
                    mysql_query($sql_updates);                    
                
                 $totalDebti=$_SESSION['EWALLET']+$_SESSION['VWALLET'];


///////////////////Inser Record in credti debit table///////////////                    
                 $inserWallet = array(
                        'user_id' => $userId,
                        'credit_amt' => '0',
                        'debit_amt' => $totalDebti,
                        'receiver_id' => 'admin',
                        'sender_id' => 0,
                        'receive_date' => date("Y-m-d"),
                        'TranDescription' => 'Purchase Products',
                        'final_bal' => $dedctEwalletAmount,
                        'invoice_no' => $_SESSION['invoice_no'],
                        'Remark' => 'Purchase Products'
                    );
                    $mxDb->insert_record('credit_debit', $inserWallet);
					


$i=1;
$down_id=$userId;
$sqlbv=mysql_fetch_assoc(mysql_query("select total_bv from amount_detail where invoice_no='".$_SESSION['invoice_no']."'")) or die(mysql_error());




while($userId!='cmp')
{
	$spObj=mysql_fetch_object(mysql_query("select  * from user_registration where user_id='".$userId."'")) or die(mysql_error());
  $nomId=$spObj->nom_id;
  $binary_pos=$spObj->binary_pos;
  $userId=$nomId;
  $remar="Update Product Volume Of Invoice No ".$_SESSION['invoice_no'];
  if($nomId!=0 and $binary_pos!='')
  {
  
  $manage_bv="insert into manage_bv_history set down_id='$down_id',
										income_id='$nomId',
										bv='$sqlbv[total_bv]',
										leg='$binary_pos',
										level='$i',
										remark='$remar',
										invoice='$_SESSION[invoice_no]'
										"; 
										
									mysql_query($manage_bv) or die(mysql_error());
  
  
  $i++;
 }
}
$individual_bv="insert into manage_bv_history set down_id='$down_id',
										income_id='$down_id',
										bv='$sqlbv[total_bv]',
										leg='$f[binary_pos]',
										level='0',
										remark='$remar',
										invoice='$_SESSION[invoice_no]'
										"; 
										
									mysql_query($individual_bv) or die(mysql_error());					
					
	///////////////////Update purchase_detail status///////////////
	
    mysql_query("update purchase_detail set status=1,discount='".$_SESSION['DISCOUNT']."',pay_mode='".$_SESSION['PAYMODE']."',net_price=$totalDebti where invoice_no='".$_SESSION['invoice_no']."'");
	mysql_query("update amount_detail set status=1,discount='".$_SESSION['DISCOUNT']."',payment_mode='".$_SESSION['PAYMODE']."',net_amount=$totalDebti where invoice_no='".$_SESSION['invoice_no']."'");

	mysql_query("update user_registration set user_type='".$_SESSION['MEMSHIP']."' where user_id='".$f['user_id']."'");

	
        $remark   = $qty . " products purchased by user";
	$add_date = date("Y-m-d");
    
    $sqlStrock = array(
            'user_id' => $f['user_id'],
            'product_id' => $_SESSION['PRODID'],
            'add_by' => 'user',
            'add_date' => $add_date
        );
$mxDb->insert_record('stock_to_sell_history', $sqlStrock);


                
                
                 unset($_SESSION['PRODID']);
                 unset($_SESSION['PROD_AMOUNT']);
                 unset($_SESSION['invoice_no']);
                 unset($_SESSION['DISCOUNT']);
                 unset($_SESSION['EWALLET']);
                 unset($_SESSION['VWALLET']);
				 unset($_SESSION['PAYMODE']);
				 
				 }
				 
				 ?>
				 
				 <script language="javascript">
location.href='invoice-detail.php?invoice_no=<?php echo $invoicem;
?>';
</script>
<?php
            }
            
            
        }
        else
        {
			 $msg="User Password Not Match";
			 header("location:purchase_wallet.php?msg=".$msg."&&type=".$_SESSION['MEMSHIP']."&&pid=".$productId); 
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
			
			<form method="post" name="product" class="form-horizontal" action="">
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
								 
								 <?php 
				if($f['user_type']=='0'){ ?>
								 <tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td colspan="1" style="border-top:none;">Discount</td>
                                    <td style="border-top:none;" colspan="2"><?php echo $_SESSION['DISCOUNT'];?>%</td>
                                 </tr>
				<?php } ?>
								 
								 <tr style="border-top:none;">
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td style="border-top:none;">&nbsp;</td>
                                    <td colspan="1" style="border-top:none;">Grand Total (<?php echo CURRENCY; ?>)</td>
                                    <td style="border-top:none;" colspan="2">
									
									<?php 
									if($f['user_type']=='0'){ 
									echo Currency.$fetechProduct['cost_price']*($_SESSION['DISCOUNT']/100); 
									}
									else
									{
									echo Currency.$fetechProduct['cost_price'];	
									}
									?>
									
									</td>
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
                                 <h4 class="panel-title">Transaction Details</h4>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </header>
                        <div class="panel-body">
                           <div class="col-md-6" style="float:none; margin-left:auto; margin-right:auto;">
                             
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-5">Enter Password Login:</label>
                                    <div class="col-sm-7">
                                       <input type="password" placeholder="Enter Password Login.." name="user_pass" id="user_pass" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5">Enter Transaction Password :</label>
                                    <div class="col-sm-7">
                                       <input type="password" placeholder="Enter Transaction Password.." name="t_code"  id="t_code" class="form-control" />
                                    </div>
                                 </div>
								 
								 <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <input type="submit" name="confirmation" value="Submit" class="btn btn-primary"></div>
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
               <!--<a href="bh_export_binary_income.php?userid=<?=$userId;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a> -->
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