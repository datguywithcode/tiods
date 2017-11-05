<?php
ob_start();
include("header.php"); 
/*function to show user on which level code ends here*/
function level_countdd($crid,$tpid)
{
global $a;
$query1="select * from user_registration where user_id='$crid'";
$result1=mysql_query($query1);
$row=mysql_fetch_array($result1);
$rclid1=$row['nom_id'];
$a=1;
if($rclid1!=$tpid)
{
level_countdd($rclid1,$tpid);
$a++;
}
else
{
$a=1;
}
return $a;
}
/*function to show user on which level code ends here*/


/* Sponsor Commission Code Starts Here*/
function commission_of_referal($ref,$useridss,$amount,$invoice_no,$packages)
{
	$date=date('Y-m-d');
	$userpack=mysql_fetch_array(mysql_query("select * from lifejacket_subscription where user_id='$ref' order by id desc limit 1"));
    $comm=mysql_fetch_array(mysql_query("select * from status_maintenance where id='".$userpack['package']."'"));
	$sponsor_benifit_bonus=$comm['sponsor_commission'];
	$compercent=$sponsor_benifit_bonus;
    $withdrawal_commission=$amount*$compercent/100;
	$rwallet=$withdrawal_commission;
	if($withdrawal_commission!='' && $withdrawal_commission!=0)
	{
	mysql_query("update final_e_wallet set amount=(amount+$rwallet) where user_id='".$ref."'");
	$urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	mysql_query("insert into credit_debit values(NULL,'$invoice_no','$ref','$rwallet','0','0','$ref','$useridss','$date','Sponsor Income','Earn Sponsor Income from $useridss for $packages Package','Commission of USD $rwallet For Package ".$packages." ','Sponsor Income','$invoice_no','Sponsor Income','0','Withdrawal Wallet',CURRENT_TIMESTAMP,'$urls')");	
	}
}
/* Sponsor Commission Code Ends Here*/


if(($_POST['package_id']!='') && ($_POST['password']!=''))
{
	$password=$_POST['password'];
	$cure=mysql_fetch_array(mysql_query("select * from user_registration where user_id='".$userid."'"));
    $comm=mysql_fetch_array(mysql_query("select * from status_maintenance where id='".$_POST['package_id']."'"));
    $package_name=$comm['name'];
    $amount=$comm['amount'];
	$ewa='final_e_wallet';
	$walls="Withdrawal Wallet";
    $rand = rand(0000000001,9000000000);
    $start=date('Y-m-d');
    $end = date('Y-m-d', strtotime('+12 months'));
    $t_code1=mysql_num_rows(mysql_query("select * from user_registration where user_id='$userid' and t_code='$password'"));

       $ref=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$userid'"));

	if($t_code1>0)
	{

		$ewalletdetail=mysql_fetch_array(mysql_query("select * from $ewa where user_id='$userid'"));
		$user_ewalletamt=$ewalletdetail['amount'];
		$urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        if($user_ewalletamt>=$amount)
        {
	    $lfid="LJ".$userid.$rand;
	   	$yes=mysql_query("update $ewa set amount=(amount-$amount) where user_id='$userid'");
		if($yes)
        {

		mysql_query("INSERT INTO `lifejacket_subscription` (`id`, `user_id`, `package`, `amount`, `pay_type`, `pin_no`, `transaction_no`, `date`, `expire_date`, `remark`, `ts`, `status`, `invoice_no`,`lifejacket_id`,`username`,`sponsor`) VALUES (NULL, '$userid', '".$_POST['package_id']."', '$amount', '$walls', '$password', '$rand', '$start', '$end', 'Package Upgrade', CURRENT_TIMESTAMP, 'Active', '$rand','$lfid','".$userid."','".$ref['ref_id']."')");
		mysql_query("insert into credit_debit (`transaction_no`,`user_id`,`credit_amt`,`debit_amt`,`admin_charge`,`receiver_id`,`sender_id`,`receive_date`,`ttype`,`TranDescription`,`Cause`,`Remark`,`invoice_no`,`product_name`,`status`,`ewallet_used_by`,`current_url`) values('$rand','$userid','0','$amount','0','$userid','$userid','$start','Package Upgrade','Package Upgrade by $userid','Package Upgrade by $userid ','Package Upgrade $userid','$rand','Package Upgrade by $userid','0','$walls','$urls')");
					
		
	/*Inserting Record of BV in manage bv table for all upliners code starts here*/
	$upliners=mysql_query("select * from level_income_binary where down_id='$userid'");
	while($upline=mysql_fetch_array($upliners))
	{
		$income_id=$upline['income_id'];
		$position=$upline['leg'];
		$user_level=level_countdd($userid,$income_id); 
		mysql_query("insert into manage_bv_history values(NULL,'$income_id','$userid','$user_level','$amount','$position','Package Purchase Amount','$start',CURRENT_TIMESTAMP,'0')");
	}
   /*Inserting Record of BV in manage bv table for all upliners code ends here*/
  
    commission_of_referal($ref['ref_id'],$userid,$amount,$rand,$package);
	}
?>
<script type="text/javascript">
window.location.href='package-upgrade.php?msg=Thank You! You have successfully upgrade package ';
</script>
<?php
exit;
}
else
{
?>
<script type="text/javascript">

						   window.location.href='package-upgrade.php?msg=In Sufficient Fund In your Wallet ';

						   </script>

                        <?php

						

					}

			}

		

			else

			{

				?>

                 <script type="text/javascript">

						   window.location.href='package-upgrade.php?msg=Wrong Credentail Details';

						   </script>

                

                <?php

				

			}



}

else

{

	?>

      <script type="text/javascript">

						   window.location.href='package-upgrade.php?msg=Validation Error Occurs';

						   </script>

    <?php

	

	

}

?>

