<?php

////////////////////Get total Team PV////////////////
function teamPv($user_id)
{	
$sqltpv=mysql_query("select sum(bv) as bv from manage_bv_history where income_id='$user_id' and down_id!='$user_id'");

$total_pv=mysql_fetch_assoc($sqltpv);

if(!empty($total_pv['bv']) && mysql_num_rows($sqltpv)>0)
{
return $total_pv['bv']." PV";	
}
else
{
return "0 PV";
}
}

////////////////////Get total PV left////////////////
function leftPv($user_id)
{
$sqlLeft=mysql_query("select sum(bv) as bv from manage_bv_history where income_id='$user_id' and leg='left' and down_id!='$user_id'");
$total_pv_left=mysql_fetch_assoc($sqlLeft);	

if(!empty($total_pv_left['bv']) && mysql_num_rows($sqlLeft)>0)
{
return $total_pv_left['bv']." PV";	
}
else
{
return "0 PV";
}

}

////////////////////Get total PV Right////////////////
function rightPV($user_id)
{
$sqlRight=mysql_query("select sum(bv) as bv from manage_bv_history where income_id='$user_id' and leg='right' and down_id!='$user_id'");
$total_pv_right=mysql_fetch_assoc($sqlRight);
if(!empty($total_pv_right['bv']) && mysql_num_rows($sqlRight)>0)
{
return $total_pv_right['bv']." PV";	
}
else
{
return "0 PV";
}	
	
}


////////////////////Get User Full Name////////////////
function userName($user_id)
{
	$sqlquery=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$user_id."'"));
	$fullName=ucfirst($sqlquery['first_name'])." ".$sqlquery['middle_name']." ".ucfirst($sqlquery['last_name']);
	return $fullName;
}


////////////////////Get E-Wallet Amount////////////////
function getEwalletAmount($user_id)
{
$sqlwal=mysql_query("select amount from final_e_wallet where user_id='".$user_id."'");
$sqlWallet=mysql_fetch_assoc($sqlwal);	

if(!empty($sqlWallet['amount']) && mysql_num_rows($sqlwal)>0)
{
return $sqlWallet['amount'];	
}
else
{
return "0";
}	
}


////////////////////Get Voucher Wallet Amount////////////////
function getVwalletAmount($user_id)
{
$sqlvwal=mysql_query("select amount from voucher_e_wallet where user_id='".$user_id."'");
$sqlvWallet=mysql_fetch_assoc($sqlvwal);	

if(!empty($sqlvWallet['amount']) && mysql_num_rows($sqlvwal)>0)
{
return $sqlvWallet['amount'];	
}
else
{
return "0";
}	
}





//////////////////////////////GET Country Name////////////////
function getCountry($countId)
{
$sqlcountry=mysql_query("select country.country from country where country.countryid='$countId'");
$fetcoutrny=mysql_fetch_assoc($sqlcountry);	

if(!empty($fetcoutrny['country']) && mysql_num_rows($sqlcountry)>0)
{
return $fetcoutrny['country'];	
}
else
{
return "0";
}	
}


//////////////////////////////GET Country Name////////////////
function matchingPoint($user_id,$pos)
{
	
$total=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$user_id' and leg='$pos'"));
if($total>0)
{
return $total;	
}
else
{
return "0";
}	
}




?>