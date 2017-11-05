 <?php
include("header.php");

$purch  = " user_id='" . $userId . "' order by pd_id asc limit 1";
$slqpro = $obj_rep->query("*", "purchase_detail", $purch);
$upprod = $obj_rep->get_all_row($slqpro);

if (isset($_GET['p_id']) && !empty($_GET['p_id'])) {
    $pId = $_GET['p_id'];
} else {
    $pId = "";
}


if (isset($_GET['type']) && !empty($_GET['type'])) {
    
    $type = $_GET['type'];
    
} else {
    $type = "";
}

//////////product details////////////////

$contion    = " p_cat_id='" . $pId . "' and status='0'";
$sql        = $obj_rep->query("*", "product_category", $contion);
$getProddes = $obj_rep->get_all_row($sql);




$invoicem       = $obj_func->meberins();
//////////shipping Address////////////////
$shipingAddress = $obj_rep->query("*", "shipping_address", " user_id='" . $userId . "'");
$getAddress     = $obj_rep->get_all_row($shipingAddress);

if ($type == '1') {
    //$dicoutn = $getProddes['cost_price'] - $getProddes['client_price'];
    $dicoutn = $getProddes['client_price'];
    $sts     = "0";
} else if ($type == '2') {
    //$dicoutn = $getProddes['cost_price'] - $getProddes['marketer_price'];
    $dicoutn = $getProddes['marketer_price'];
    $sts     = "0";
} else if ($type == '3') {
    $dicoutn = $getProddes['cost_price'] - $getProddes['networker_price'];
    $dicoutn = $getProddes['networker_price'];
    /* if ($dicoutn == '0') {
    $dicoutn = $getProddes['cost_price'];
    }*/
    $sts     = "1";
} else {
    $dicoutn = $getProddes['cost_price'];
    $sts     = "1";
}


///////////////////if click submit button then action will perform///////////////  

if (isset($_POST['submit']) && $_POST['submit'] == 'Checkout') {
    
    ///////////////////Payment Mode checking Purchase product///////////////        
    if (((isset($_POST['e_wallet'])) && (!empty($_POST['e_wallet']))) && empty($_POST['v_wallet'])) {
        $amountType = "E-Wallet";
    } else if (((isset($_POST['v_wallet'])) && (!empty($_POST['v_wallet']))) && empty($_POST['e_wallet'])) {
        $amountType = "Voucher-Wallet";
    }
    
    else if ((isset($_POST['e_wallet']) && !empty($_POST['e_wallet'])) && (isset($_POST['v_wallet']) && !empty($_POST['v_wallet']))) {
        $amountType = "(E-Wallet)+(Voucher-Wallet)";
    }
    
    
    $flag       = false;
    $userAmount = $_POST['e_wallet'] + $_POST['v_wallet'];
    if ($userAmount == $_POST['grandToal']) {
        
        
        // check user transaction password
        
        $tranction = mysql_query("select * from user_registration where t_code='" . $_POST['t_code'] . "' and user_id='$userId'");
        
        if (mysql_num_rows($tranction) == '0') {
            
            $msg2 = "Transaction Password Not Match Please Try Again";
            
        }
        
        else {
            
            
            if ($obj_func->getEwalletAmount($userId) >= $_POST['e_wallet']) {
                
                
                $dedctEwalletAmount = $obj_func->getEwalletAmount($userId) - $_POST['e_wallet'];
                
                
                if ($obj_func->getVwalletAmount($userId) >= $_POST['v_wallet']) {
                    $dedctEvoucherAmount = $obj_func->getVwalletAmount($userId) - $_POST['v_wallet'];
                    $flag                = true;
                    
                    
                } else {
                    $msg3 = "insufficient Voucher Amount";
                    $flag == false;
                    
                }
                
            } else {
                $msg4 = "insufficient E-wallet Amount";
                $flag == false;
                
            }
        }
    } else {
        $msg1 = "Amount is equal to Grand Total amount";
        $flag == false;
        
    }
    
    /////////////////////////////////////if all things is well then insert and update record in table////////////  
    
    if ($result['mem_type'] == '3' || $result['mem_type'] == '0') {
        if ($flag == true) {
            
            $date = date('Y-m-d');
            
            ///////////////////Update E-Wallet Amount///////////////  
            $updateContio = " user_id='" . $userId . "'";
            $arryfield    = array(
                "amount" => $dedctEwalletAmount
            );
            $obj_rep->update_tbl($arryfield, 'final_e_wallet', $updateContio);
            
            
            ///////////////////Update Voucher-Wallet Amount///////////////                        
            $updatevoucher = " user_id='" . $userId . "'";
            $arravouchr    = array(
                "amount" => $dedctEvoucherAmount
            );
            $obj_rep->update_tbl($arravouchr, 'voucher_e_wallet', $updatevoucher);
            
            $totalDebti = $_POST['e_wallet'] + $_POST['v_wallet'];
            
            
            ///////////////////Insert Record in credit debit table///////////////                    
            $inserWallet = array(
                'user_id' => $userId,
                'transaction_no' => $obj_func->generate_transaction_number(),
                'credit_amt' => '0',
                'debit_amt' => $_POST['e_wallet'],
                'receiver_id' => 'admin',
                'receive_date' => $date,
                'TranDescription' => 'Purchase Products',
                'final_bal' => $dedctEwalletAmount,
                'invoice_no' => $invoicem,
                'Remark' => 'Purchase Products'
            );
            $obj_rep->insert_tbl($inserWallet, 'credit_debit');
            
            
            ///////////////////Insert Record in credit debit voucher table///////////////                    
            $inservoucher = array(
                'user_id' => $userId,
                'transaction_no' => $obj_func->generate_transaction_number_voucher(),
                'credit_amt' => '0',
                'debit_amt' => $_POST['v_wallet'],
                'receiver_id' => 'admin',
                'receive_date' => $date,
                'TranDescription' => 'Purchase Products',
                'final_bal' => $dedctEvoucherAmount,
                'invoice_no' => $invoicem,
                'Remark' => 'Purchase Products'
            );
            $obj_rep->insert_tbl($inservoucher, 'credit_debit_voucher');
            
            
            
            ///////////////////Insert Record in purchase detail table ///////////////
            $insert_arr = array(
                'user_id' => $userId,
                'user_name' => $result['username'],
                'product_name' => $getProddes['product_name'],
                'invoice_no' => $invoicem,
                'p_id' => $pId,
                'currency' => CURRENCY,
                'price' => $getProddes['cost_price'],
                'net_price' => $dicoutn,
                'discount' => $dicoutn,
                'date' => $date,
                'status' => $sts,
                'pay_mode' => $amountType,
                'product_volume' => $getProddes['product_volume']
            );
            
            $obj_rep->insert_tbl($insert_arr, 'purchase_detail');
            
            
            
            ///////////////////Insert Record in amount detail table ///////////////
            $sql_amount = array(
                'user_id' => $userId,
                'status' => $sts,
                'invoice_no' => $invoicem,
                'total_amount' => $getProddes['cost_price'],
                'net_amount' => $dicoutn,
                'discount' => $dicoutn,
                'total_bv' => $getProddes['product_volume'],
                'payment_mode' => $amountType,
                'date' => $date
            );
            
            $obj_rep->insert_tbl($sql_amount, 'amount_detail');
            
            
            ///////////////////Update Record in user registration table ///////////////
            
            if (mysql_num_rows($slqpro) == 0) {
                $type = $type;
                
            } else {
                $type = $result['mem_type'];
            }
            
            $updareg = " user_id='" . $userId . "'";
            $arrreg  = array(
                "mem_type" => $type
            );
            $obj_rep->update_tbl($arrreg, 'user_registration', $updareg);
            
            
            /*$remark    = "products purchased by user";
            $sqlStrock = array(
            'user_id' => $result['user_id'],
            'product_id' => $pId,
            'add_by' => $remark,
            'add_date' => $date
            );
            
            $obj_rep->insert_tbl($sqlStrock, 'stock_to_sell_history');*/
            
            ///////////////////Inser Record in manage bv history table ///////////////
            
            $i       = 1;
            $down_id = $userId;
            while ($userId != 'cmp') {
                $spObj = mysql_fetch_object(mysql_query("select  * from user_registration where user_id='" . $userId . "'")) or die(mysql_error());
                $nomId      = $spObj->nom_id;
                $binary_pos = $spObj->binary_pos;
                $userId     = $nomId;
                $remar      = "Update Product Volume Of Invoice No " . $invoicem;
                if ($nomId != 0 and $binary_pos != '') {
                    
                    $manage_bv = array(
                        'down_id' => $down_id,
                        'income_id' => $nomId,
                        'bv' => $getProddes[product_volume],
                        'dpv' => $_POST[dpv],
                        'tbpv' => $_POST[tbpv],
                        'mpv' => $_POST[mpv],
                        'leg' => $binary_pos,
                        'level' => $i,
                        'remark' => $remar,
                        'invoice' => $invoicem,
                        'date' => $date
                        
                    );
                    
                    $obj_rep->insert_tbl($manage_bv, 'manage_bv_history');
                    
                    $i++;
                }
            }
            
            $individual_bv = array(
                'down_id' => $down_id,
                'income_id' => $down_id,
                'bv' => $getProddes[product_volume],
                'dpv' => $_POST[dpv],
                'tbpv' => $_POST[tbpv],
                'mpv' => $_POST[mpv],
                'leg' => $result['binary_pos'],
                'level' => 0,
                'remark' => $remar,
                'invoice' => $invoicem,
                'date' => $date
            );
            
            $obj_rep->insert_tbl($individual_bv, 'manage_bv_history');
            
            
            
            
            
            ////////////////////////////Getting Unilevel commsion/////////////////
            
            if (($_GET['type'] > 1) || (!isset($_GET['type']))) {
                $obj_func->unilevelCommission($result['user_id'], $invoicem);
            }
            
            $obj_func->directCommision($result['user_id'], $invoicem, $_POST[dpv]);
            
            ////////////////////////////End Here Unilevel commsion/////////////////
            
            
            
            
            
            
            
            
            ////////////////////////////Getting Direct commsion/////////////////
            
            if (($_GET['type'] > 0)) {
                $sqlDirectcheck = mysql_query("select * from direct_income where income_id='" . $result['user_id'] . "' and status='0'");
                
                if (mysql_num_rows($sqlDirectcheck) > 0) {
                    while ($fetdirect = mysql_fetch_assoc($sqlDirectcheck)) {
                        /** update amount in final ewallet */
                        mysql_query("update final_e_wallet set amount=(amount+$fetdirect[commission]) where user_id='" . $result['user_id'] . "'");
                        
                        
                        /** get amount from final ewallet */
                        $direamount  = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $result['user_id'] . "'"));
                        $driecremark = "Get Direct Commission From Member $fetdirect[purchaser_id]";
                        
                        /** Insert amount in credit_debit */
                        $driectcredti = "INSERT INTO credit_debit SET user_id='" . $result['user_id'] . "' , 
                                                        transaction_no='" . $obj_func->generate_transaction_number() . "',
                                                        credit_amt='" . $fetdirect[commission] . "',
                                                        final_bal='" . $direamount['amount'] . "',
                                                        receiver_id='" . $result['user_id'] . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Direct Commission',
                                                        Remark='" . $driecremark . "'
                                                        ";
                        
                        mysql_query($driectcredti);
                        
                        $fieddirect = array(
                            'status' => 1
                        );
                        
                        $contioDirct = " income_id='" . $result['user_id'] . "' and status='0'";
                        $obj_rep->update_tbl($fieddirect, 'direct_income', $contioDirct);
                        
                    }
                    
                }
				
				
				
				
				
				
				
				////////////////////////getting direct Mega commission//////////////////////////
				
				$sqlDirectcheckmega = mysql_query("select * from direct_income_mega where income_id='" . $result['user_id'] . "' and status='0'");
                
                if (mysql_num_rows($sqlDirectcheckmega) > 0) {
                    while ($fetdirectmega = mysql_fetch_assoc($sqlDirectcheckmega)) {
                        /** update amount in final ewallet */
                        mysql_query("update final_e_wallet set amount=(amount+$fetdirectmega[commission]) where user_id='" . $result['user_id'] . "'");
                        
                        
                        /** get amount from final ewallet */
                        $direamountmega  = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $result['user_id'] . "'"));
                        $driecremarkmega = "Get Direct Mega Commission From Member $fetdirectmega[purchaser_id]";
                        
                        /** Insert amount in credit_debit */
                        $driectcredtimega = "INSERT INTO credit_debit SET user_id='" . $result['user_id'] . "' , 
                                                        transaction_no='" . $obj_func->generate_transaction_number() . "',
                                                        credit_amt='" . $fetdirectmega[commission] . "',
                                                        final_bal='" . $direamountmega['amount'] . "',
                                                        receiver_id='" . $result['user_id'] . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Direct Mega Commission',
                                                        Remark='" . $driecremarkmega . "'
                                                        ";
                        
                        mysql_query($driectcredtimega);
                        
                        $fieddirectmega = array(
                            'status' => 1
                        );
                        
                        $contioDirctmega = " income_id='" . $result['user_id'] . "' and status='0'";
                        $obj_rep->update_tbl($fieddirectmega, 'direct_income_mega', $contioDirctmega);
                        
                    }
                    
                }
				
				//////////////////////////////////////////end here Getting direct Mega commission///////////////////////
				
				
				
                
                
                
            }
            
            //////////////////////////////////////////end here Getting direct commission///////////////////////
            
            
            
            /////////////////////////////Getting commission matching/////////////////
            if (($_GET['type'] == 3) || (!isset($_GET['type']))) {
                
                $sqlmathicng = mysql_query("select * from matching_income where user_id = '" . $result['user_id'] . "' and status='0'");
                
                
                if (mysql_num_rows($sqlmathicng) > 0) {
                    
                    while ($fetDatas = mysql_fetch_assoc($sqlmathicng)) {
                        /** update amount in final ewallet */
                        mysql_query("update final_e_wallet set amount=(amount+$fetDatas[commission]) where user_id='" . $result['user_id'] . "'");
                        
                        
                        /** get amount from final ewallet */
                        $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $result['user_id'] . "'"));
                        $Remark      = " Get Matching Commission";
                        
                        /** Insert amount in credit_debit */
                        $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $result['user_id'] . "' , 
                                                        transaction_no='" . $obj_func->generate_transaction_number() . "',
                                                        credit_amt='" . $fetDatas[commission] . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $result['user_id'] . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Matching commission',
                                                        Remark='" . $Remark . "'
                                                        ";
                        
                        mysql_query($insert_cr_dr);
                        
                        $fieldvalu = array(
                            'status' => 1
                        );
                        
                        $condLevel6 = " user_id='" . $result['user_id'] . "' and status='0'";
                        $obj_rep->update_tbl($fieldvalu, 'matching_income', $condLevel6);
                        
                    }
                    
                }
                
            }
            
            
			
			//////////////////////////////////////////insert Direct Money box value increased///////////////////////
		
					$individual_bv = array(
					'user_id'=>$result[user_id],
					'dpv' => $_POST[dpv],
					'tbpv' => $_POST[tbpv],
					'mpv' => $_POST[mpv],
					'invoice' => $invoicem,
					'date' => $date
						);
				
					$obj_rep->insert_tbl($individual_bv, 'money_box');
			
			//////////////////////////////////////////end here Money box value///////////////////////
			
			
			
			
			
			
            
            
?>
   
       <script language="javascript">
location.href='invoice-detail.php?p_id=<?php
            echo $pId;
?>&&type=<?php
            echo $type;
?>&&invoice_no=<?php
            echo $invoicem;
?>';
</script>
      
       <?php
            
        }
        
    }
    
    else {
        $msgupgrade = "Please Continue Payment for your first purchase in order to buy second!!!";
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
    
    <!-- product view -->
    <link rel="stylesheet" href="css/multizoom.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript" src="js/multizoom.js">

// Featured Image Zoomer (w/ optional multizoom and adjustable power)- By Dynamic Drive DHTML code library (www.dynamicdrive.com)
// Multi-Zoom code (c)2012 John Davenport Scheuer
// as first seen in http://www.dynamicdrive.com/forums/
// username: jscheuer1 - This Notice Must Remain for Legal Use
// Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more

</script>

<script type="text/javascript">

jQuery(document).ready(function($){

	$('#image1').addimagezoom({ // single image zoom
		zoomrange: [3, 10],
		magnifiersize: [300,300],
		magnifierpos: 'right',
		cursorshade: true,
		largeimage: 'hayden.jpg' //<-- No comma after last option!
	})


	$('#image2').addimagezoom() // single image zoom with default options
	
	$('#multizoom1').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description', // description selector (optional - but required if descriptions are used) - new
		speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
		descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
		imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
		magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
		zoomrange: [3, 10],
		magnifiersize: [250,250],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true //<-- No comma after last option!
	});
	
	$('#multizoom2').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description2', // description selector (optional - but required if descriptions are used) - new
		disablewheel: true // even without variable zoom, mousewheel will not shift image position while mouse is over image (optional) - new
				//^-- No comma after last option!	
	});
	
})


function chooseMember(id)
{
	window.location.href = 'summary.php?type='+id+'&&p_id='+<?php echo $pId; ?>;
	
}

function voucherAmount(vals,disount)
{
	var dicoutAmount=parseInt(disount);
	var voucherAmount=parseInt(vals);
	
	
	if(vals!='')
	{
	
	if(dicoutAmount>=voucherAmount)
	{
		var finalAmount=dicoutAmount-voucherAmount;	
	//alert(finalAmount);
	
	$("#e_wallet").val(finalAmount);
	}
	else
	{
	alert("Amount is Greater to provide Input");
		$("#v_wallet").val('');	
		$("#e_wallet").val('');	
		$("#v_wallet").focus();	
	
	}
	
	}
	
}
</script>
    <!-- end here -->
    
  </head>

  <body class="">
    <div class="animsition">  
    
    <?php include("sidebar.php");?>


      <main id="playground">

            
      
         <?php include("top.php");?>
   


        <!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>Summary / Payment</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Product</a></li>
              <li><a href="#">Summary / Payment</a></li>
             
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
		<form method="post" action="" name="register" id="registrationForm" onsubmit="return validates1();">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Summary</h4>
                </header>
                <div class="panel-body">
                
                	<div class="col-md-12 table-responsive">
                    
                    	<table class="table table-striped table-hover table-bordered">
                          <tr>
                            <td width="25%" align="center"><strong>Product</strong><br /><img src="../product_logos/<?php echo $getProddes['image']; ?>" width="100" /></td>
                            <td width="75%"><strong><?php echo $getProddes['product_name']; ?></strong></td>
                          </tr>
                          <tr>
                            <td width="25%"><strong>Price :</strong></td>
                            <td width="75%"><strong><?php echo Currency." ".$getProddes['cost_price']; ?></strong></td>
                          </tr>
						  
						  <?php 
						  
							
							
							if(mysql_num_rows($slqpro)==0)
						  {
						  ?>
                          <tr>
                            <td width="25%"><strong>Membership Plan :</strong></td>
                            <td width="75%">
							<select class="form-control" onchange="return chooseMember(this.value);" required>
							<option value="">--select--</option>
							<option value="1" <?php if($type=='1'){echo "selected";} ?>>Client</option>
							<option value="2" <?php if($type=='2'){echo "selected";} ?>>Marketer</option>
							<option value="3" <?php if($type=='3'){echo "selected";} ?>>Networker</option>
							</select></td>
                          </tr>
						  <?php } ?>
                          
						  <tr>
                            <td width="25%"><strong>Product Points :</strong></td>
                            <td width="75%"><?php echo $getProddes['product_volume']; ?></td>
                          </tr>
						  
						  <?php 
						   if(mysql_num_rows($slqpro)==0)
						  {
						  if(($type=='1') || ($type=='3') || ($type=='2'))
						  {
								$points=$getProddes['product_volume'];
						  }
						  
						  else
						  {
							   $points=0;  
						  }
						  }
						  else
						  {
							$points=$getProddes['product_volume'];  
						  }
						  
						  ?>
                          <tr>
                            <td width="25%"><strong>Direct Purchasing point :</strong></td>
                            <td width="75%"><?php echo $points; ?></td>
							<input type="hidden" name="dpv" value="<?php echo $points; ?>">
                          </tr>
						 
						  
						  
						  <?php 
						   if(mysql_num_rows($slqpro)==0)
						  {
						  if(($type=='2') || ($type=='3'))
						  {
							 $points= $getProddes['product_volume'];  
						  }
						  else
						  {
							 $points=0;  
						  }
						  }
						  else
						  {
							 $points= $getProddes['product_volume'];   
						  }
						?>
						  <tr>
                            <td width="25%"><strong>TB Purchasing Points :</strong></td>
                            <td width="75%"><?php echo $points; ?></td>
							<input type="hidden" name="tbpv" value="<?php echo $points; ?>">
                          </tr>
						  
						  
						  
						  
						  
						  <?php 
						   if(mysql_num_rows($slqpro)==0)
						  {
						  if($type=='3')
						  {
							$points= $getProddes['product_volume'];  
						  }
						  else
						  {
							 $points=0;  
						  }
						  }
						   else
						  {
							 $points= $getProddes['product_volume'];  
						  }
						?>
                          <tr>
                            <td width="25%"><strong>Matching Purchasing Points :</strong></td>
                            <td width="75%"><?php echo $points; ?></td>
							<input type="hidden" name="mpv" value="<?php echo $points; ?>">
                          </tr>
						 
						  
						  <tr>
                            <td width="25%"><strong>First Name :</strong></td>
                            <td width="75%"><?php echo $getAddress['first_name']; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Last Name :</strong></td>
                            <td><?php echo $getAddress['last_name']; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Country :</strong></td>
                            <td><?php echo $obj_func->getCountry($getAddress['country']); ?></td>
                          </tr>
                          <tr>
                            <td><strong>City/State :</strong></td>
                            <td><?php echo $getAddress['city']; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Mobile :</strong></td>
                            <td><?php echo $getAddress['mobile']; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Email:</strong></td>
                            <td><?php echo $getAddress['email']; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Full Address :</strong></td>
                            <td><?php echo $getAddress['address2']; ?></td>
                          </tr>
                          <tr>
                            <td><h3><strong>REQUESTED PAYMENT :</strong></h3></td>
                            <td><h3><strong><?php echo Currency.$dicoutn; ?></strong></h3></td>
                          </tr>
                        </table>

                    </div>


                </div>

           	</section>
            

            </div> <!-- /col-md-12 -->
            
            
            
            
            
            
            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Payment</h4>
                </header>
                <div class="panel-body">
				
				
                
                	<div class="col-md-12">
                    
                    	
                        
                        <div class="col-md-6">

                            <div class="form-group">
                              <label for="exampleInputAddress">Voucher Wallet (<?php echo "Available Amount ".Currency.$obj_func->getVwalletAmount($userId); ?>)</label>
                              <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" name="v_wallet" onblur="return voucherAmount(this.value,'<?php echo $dicoutn; ?>');" value="<?php if(isset($_POST['v_wallet']) && !empty($_POST['v_wallet'])){ echo $_POST['v_wallet']; } ?>" placeholder="Please Enter Voucher Wallet Amount.." class="form-control" id="v_wallet" required>
								<span style="color:red"><?php if(isset($msg3) && isset($_POST['v_wallet']) && !empty($_POST['v_wallet'])) { echo $msg3; } else if(isset($msg1) && isset($_POST['v_wallet']) && !empty($_POST['v_wallet'])) { echo $msg1; } ?></span>
                              </div>
                            </div>
                            
						</div>
						
						<div class="col-md-6">
                    
                            <div class="form-group">
                                <label for="exampleInputAddress">E-Wallet (<?php echo "Available Amount ".Currency.$obj_func->getEwalletAmount($userId); ?>)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="e_wallet" readonly  value="<?php if(isset($_POST['e_wallet'])){ echo $_POST['e_wallet']; } ?>" placeholder="Please Enter E-Wallet Amount.."  class="form-control" id="e_wallet">
									<span style="color:red"><?php if(isset($msg4) && isset($_POST['e_wallet']) && !empty($_POST['e_wallet'])) { echo $msg4; } else if(isset($msg1) && isset($_POST['e_wallet']) && !empty($_POST['e_wallet'])) { echo $msg1; }  ?></span>
									<input type="hidden" name="grandToal" value="<?php echo $dicoutn; ?>">
                            	</div>
                             </div>
                    	
                        </div>
                    
                    	<div class="col-md-12 margin-bottom-10">
                        
                        	<input type="password" name="t_code" class="form-control" value="<?php if(isset($_POST['t_code']) && !empty($_POST['t_code'])){ echo $_POST['t_code'];} ?>" placeholder="Please Enter Transaction Password.." required/>
                        <span style="color:red"><?php if(isset($msg2)) { echo $msg2; } ?></span>
                        </div>
						
                        
                        <div class="col-md-12 margin-bottom-10">
                        
                        	<input type="submit" class="btn btn-primary" name="submit" value="Checkout" />
							<?php if(isset($msgupgrade)) { ?>
							<br>
							<b><?php if(isset($msgupgrade)) { echo $msgupgrade; } ?></b><a href="summary_upgrade.php?p_id=<?php echo $upprod['p_id']; ?>&&type=<?php echo $result['mem_type']; ?>&&upgrade=<?php echo $result['mem_type']; ?>&&invoice_no=<?php echo $upprod['invoice_no']; ?>">
							<span style="background:red; padding:3px 5px; border-radius:5px; color:#fff;">Click here<span></a>
							<?php } ?>
                        
                        </div>

                    </div>


                </div>

           	</section>
            

            </div> <!-- /col-md-12 -->

  

          </div>
		  </form>

      
        </div> <!-- / container-fluid -->
		
        
         <div class="col-md-12 text-center">

 <!--<a href="bh_export_binary_income.php?userid=<?=$userid;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a> -->


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
  <script src="js/jquery.dataTables.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.tables.js"></script>
  
  
  </body>
</html>