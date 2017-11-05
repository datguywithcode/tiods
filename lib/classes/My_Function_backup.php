 <?php
class My_Function
{
    
    //////////////////////////////GET User full  Name////////////////
    
    function userName($user_id)
    {
        global $obj_rep;
        
        $condtion = " user_id='" . $user_id . "'";
        
        $sql = $obj_rep->query("first_name,last_name", "user_registration", $condtion);
        
        $result = $obj_rep->get_all_row($sql);
        return $fullName = $result['first_name'] . " " . $result['last_name'];
    }
    
    
    
    
    
    ////////////////////Get E-Wallet Amount////////////////
    function getEwalletAmount($user_id)
    {
        $sqlwal    = mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'");
        $sqlWallet = mysql_fetch_assoc($sqlwal);
        
        if (!empty($sqlWallet['amount']) && mysql_num_rows($sqlwal) > 0) {
            return $sqlWallet['amount'];
        } else {
            return "0";
        }
    }
    
    
    ////////////////////Get Voucher Wallet Amount////////////////
    function getVwalletAmount($user_id)
    {
        $sqlvwal    = mysql_query("select amount from voucher_e_wallet where user_id='" . $user_id . "'");
        $sqlvWallet = mysql_fetch_assoc($sqlvwal);
        
        if (!empty($sqlvWallet['amount']) && mysql_num_rows($sqlvwal) > 0) {
            return $sqlvWallet['amount'];
        } else {
            return "0";
        }
    }
    
    
    
    
    
    //////////////////////////////GET Country Name////////////////
    function getCountry($countId)
    {
        $sqlcountry = mysql_query("select country.country from country where country.countryid='$countId'");
        $fetcoutrny = mysql_fetch_assoc($sqlcountry);
        
        if (!empty($fetcoutrny['country']) && mysql_num_rows($sqlcountry) > 0) {
            return $fetcoutrny['country'];
        } else {
            return "0";
        }
    }
    
    
    //////////////////////////////GET Matching Point////////////////
    function matchingPoint($user_id, $pos)
    {
        
        $total = mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$user_id' and leg='$pos'"));
        if ($total > 0) {
            return $total;
        } else {
            return "0";
        }
    }
	
	
	///////////////////////////Generating Invoice No.////////////////////
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
	
	
	
	///////////////////////////Generating Invoice No.////////////////////
	function memType($mem_id)
    {
		
		if($mem_id=='1')
		{
			return "Client";
		}
		else if($mem_id=='2')
		{
			return "Marketer";
		}
		else if($mem_id=='3')
		{
			return "Networker";
		}
		else
		{
			return "Prospect";
		}
		
	}
	
	function totalPoints($user_id,$pos)
	{
		if(!empty($user_id) && !empty($pos))
		{
			$sqlPoint=mysql_query("select sum(manage_bv_history.mpv) as mpv from manage_bv_history where manage_bv_history.income_id='".$user_id."' and manage_bv_history.leg='".$pos."'");
			$fetchPoint=mysql_fetch_assoc($sqlPoint);
			if(mysql_num_rows($sqlPoint)>0 && !empty($fetchPoint['mpv']))
			{
					return $fetchPoint['mpv'];
			}
			else
			{
				return "0";
			}
			
		}
		
	}
	
	
	function countNomTotal($user_id) 
	{
    $nomArray = array();
    $selectNomIds = "select ref_id from user_registration where user_id='".$user_id."' ORDER BY id ASC";
    $resNomIds = mysql_query($selectNomIds);
    $rowNomIds = mysql_fetch_assoc($resNomIds);
    if ($rowNomIds['ref_id'] != '') {
        $nom_bmc2 = $rowNomIds['ref_id'];
    }
    $nomArray[] = $nom_bmc2;
    while ($nom_bmc2 != "cmp") {
        $selectNomId = "select ref_id from user_registration where user_id='".$nom_bmc2."' ORDER BY id ASC";
		$resNomId = mysql_query($selectNomId);
        $rowNomId = mysql_fetch_assoc($resNomId);
        if ($rowNomId['ref_id'] != 'cmp' && $rowNomId['ref_id'] != 0) {
            if ($rowNomId['ref_id'] != '') {
                $nom_bmc2 = $rowNomId['ref_id'];
            }
            array_push($nomArray, $nom_bmc2);
        } else {
            break;
        }
    }
    return $nomArray;
}
	
}

?> 