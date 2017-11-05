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
    
    
    
    
    //////////////////////////////Increament counter function////////////////
    function addOrdinalNumberSuffix($num)
    {
        if (!in_array(($num % 100), array(
            11,
            12,
            13
        ))) {
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:
                    return $num . 'st';
                case 2:
                    return $num . 'nd';
                case 3:
                    return $num . 'rd';
            }
        }
        return $num . 'th';
    }
    
    
    
    /////////////////////////remaining date time with second//////////////////
    
    function remainingDatetime($date)
    {
        //$futDate=date('Y-m-d',strtotime("+1 month"));
        $now         = new DateTime();
        //$future_date = new DateTime('2015-11-01 12:00:00');
        $future_date = new DateTime($date . " 12:00:00");
        $interval    = $future_date->diff($now);
        return $interval->format("%d Days, %h Hours, %i Min, %s Sec.");
    }
    
    
    /////////////////////////get Current date //////////////////
    function nextMonth($dates)
    {
        $dates = '2015-11-01';
        return date('F d,Y', strtotime($dates));
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
    
    
    
    ///////////////////////Generate Transaction no. for credti debit table///////////////////    
    function generate_transaction_number()
    {
        $invice_number = uniqid(rand(100000, 999999), true);
        $replace_value = str_replace(".", "", $invice_number);
        $substr_value  = substr($replace_value, 0, 6);
        $query         = mysql_query("select transaction_no from credit_debit where transaction_no='$substr_value'");
        if (mysql_num_rows($query) > 0) {
            
            $this->generate_transaction_number();
        } else {
            return $substr_value;
        }
    }
    
    
    
    ///////////////////////Generate Transaction no. for credti debit voucher table///////////////////    
    function generate_transaction_number_voucher()
    {
        $invice_numbers = uniqid(rand(100000, 999999), true);
        $replace_values = str_replace(".", "", $invice_numbers);
        $substr_values  = substr($replace_values, 0, 6);
        $querys         = mysql_query("select transaction_no from credit_debit_voucher where transaction_no='$substr_values'");
        if (mysql_num_rows($querys) > 0) {
            
            $this->generate_transaction_number_voucher();
        } else {
            return $substr_values;
        }
    }
    
    
    
    ///////////////////////////Generating Invoice No.////////////////////
    function memType($mem_id)
    {
        
        if ($mem_id == '1') {
            return "Client";
        } else if ($mem_id == '2') {
            return "Marketer";
        } else if ($mem_id == '3') {
            return "Networker";
        } else {
            return "Prospect";
        }
        
    }
    
    
    
    //////////////////////////////GET Matching Point////////////////
    /*function matchingPoint($user_id, $pos)
    {
    
    $total = mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$user_id' and leg='$pos'"));
    if ($total > 0) {
    return $total;
    } else {
    return "0";
    }
    }*/
    
    
    /////////////////////////////////Total Left and Total right Points///////////////////////    
    function totalPoints($user_id, $pos)
    {
        if (!empty($user_id) && !empty($pos)) {
            $sqlPoint   = mysql_query("select sum(manage_bv_history.mpv) as mpv from manage_bv_history where manage_bv_history.income_id='" . $user_id . "' and manage_bv_history.down_id!='".$user_id."' and manage_bv_history.leg='" . $pos . "'");
            $fetchPoint = mysql_fetch_assoc($sqlPoint);
            if (mysql_num_rows($sqlPoint) > 0 && !empty($fetchPoint['mpv'])) {
                return $fetchPoint['mpv'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    /////////////////////////////////Total count personal points///////////////////////    
    function personalPoint($user_id, $memType)
    {
        if ($memType = '1') {
            $sumss = "sum(manage_bv_history.dpv) as dpv";
            $pv    = "dpv";
        } else if ($memType = '2') {
            $sumss = "sum(manage_bv_history.tbpv) as tbpv";
            $pv    = "tbpv";
        } else if ($memType = '3') {
            $sumss = "sum(manage_bv_history.mpv) as mpv";
            $pv    = "mpv";
        } else {
            $sumss = "";
            $pv    = "";
        }
        
        if (!empty($user_id)) {
            $sqlPoint   = mysql_query("select " . $sumss . " from manage_bv_history where manage_bv_history.income_id='" . $user_id . "' and level='0'");
            $fetchPoint = mysql_fetch_assoc($sqlPoint);
            if (mysql_num_rows($sqlPoint) > 0 && !empty($fetchPoint[$pv])) {
                return $fetchPoint[$pv];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    /////////////////////////////////Total team with nom id Points///////////////////////    
    function teamPoint($user_id, $nomId, $invoice)
    {
        if (!empty($user_id) && !empty($nomId)) {
            $sqlteam   = mysql_query("select sum(manage_bv_history.tbpv) as tbpv  from manage_bv_history where manage_bv_history.down_id='" . $user_id . "' and income_id='" . $nomId . "' and invoice='" . $invoice . "'");
            $fetchteam = mysql_fetch_assoc($sqlteam);
            if (mysql_num_rows($sqlteam) > 0 && !empty($fetchteam['tbpv'])) {
                return $fetchteam['tbpv'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    ///////////////////Count Total number of Nom User id/////////////////////////    
    function countNomTotal($user_id)
    {
        $nomArray     = array();
        $selectNomIds = "select ref_id from user_registration where user_id='" . $user_id . "' ORDER BY id ASC";
        $resNomIds    = mysql_query($selectNomIds);
        $rowNomIds    = mysql_fetch_assoc($resNomIds);
        if ($rowNomIds['ref_id'] != '') {
            $nom_bmc2 = $rowNomIds['ref_id'];
        }
        $nomArray[] = $nom_bmc2;
        while ($nom_bmc2 != "cmp") {
            $selectNomId = "select ref_id from user_registration where user_id='" . $nom_bmc2 . "' ORDER BY id ASC";
            $resNomId    = mysql_query($selectNomId);
            $rowNomId    = mysql_fetch_assoc($resNomId);
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
    
    
    ////////////////////////////////////Direct Commission/////////////////////////
    
    function directCommision($user_id, $invoiceNo, $totalPoint)
    {
        
        
        $row      = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $user_id . "'"));
        $refId    = $row['ref_id'];
        $username = $row['username'];
        
        
        $selectComission = mysql_fetch_array(mysql_query("SELECT * FROM set_comission"));
        
        
        $Remark = "Get Direct Commission From Member $user_id";
        
        $commission = ($totalPoint * ($selectComission['direct_comission'] / 100)) * $selectComission['pntamount'];
        
        $sqlType   = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $refId . "'"));
        $usernames = $sqlType['username'];
        
        /** Insert commission in level_income */
        if (!empty($sqlType['user_id'])) {
            $sqlLevel = "INSERT INTO direct_income SET income_id='" . $sqlType['user_id'] . "',
                                                                        invoice_no='" . $invoiceNo . "',
                                                                        remark='" . $Remark . "', 
                                                                        purchaser_uname='" . $username . "', 
                                                                        purchaser_id='" . $user_id . "',
                                                                        commission = '" . $commission . "', 
                                                                        status='0'
                                                                        ";
            
            mysql_query($sqlLevel);
            
            
            /*$sqlRef  = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $sqlType['user_id'] . "'"));
            $Remark2 = "Get Direct Mega Commission From Member $sqlType[user_id]";
            
            
            $sqlReftype = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $sqlRef['ref_id'] . "'"));
            
            
            
            //////////////////insert into direct mega commisioon///////////////////
            if ($sqlRef['ref_id'] != 'cmp') {
            $sqlLevel = "INSERT INTO direct_income_mega SET income_id='" . $sqlRef['ref_id'] . "',
            invoice_no='" . $invoiceNo . "',
            remark='" . $Remark2 . "', 
            purchaser_uname='" . $usernames . "', 
            purchaser_id='" . $sqlType['user_id'] . "',
            commission = '" . $commission . "', 
            status='0'
            ";
            
            mysql_query($sqlLevel);
            
            }*/
            
        }
        
        $sqlDirectcheck = mysql_query("select * from direct_income where income_id='" . $sqlType['user_id'] . "' || income_id='" . $user_id . "' and status='0'");
        if (mysql_num_rows($sqlDirectcheck) > 0 && $sqlType['mem_type'] > 0) {
            $fetchDirect  = mysql_fetch_assoc($sqlDirectcheck);
            /** Update commission in level_income */
            $updateDirect = "update direct_income SET status='1' where income_id='" . $fetchDirect['income_id'] . "'";
            mysql_query($updateDirect);
            
            /** update amount in final ewallet */
            mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $fetchDirect['income_id'] . "'");
            
            /** get amount from final ewallet */
            $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $fetchDirect['income_id'] . "'"));
            
            
            /** Insert amount in credit_debit */
            $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $fetchDirect['income_id'] . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $fetchDirect['income_id'] . "',
                                                        sender_id='" . $user_id . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Direct Commission',
                                                        Remark='" . $Remark . "'
                                                        ";
            mysql_query($insert_cr_dr);
            
            
            /** update amount in final ewallet */
            mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $fetchDirect['income_id'] . "'");
            
            /** get amount from final ewallet */
            $args_amounts = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $fetchDirect['income_id'] . "'"));
            
            
            /** Insert amount in credit_debit */
            $doulecredit = "INSERT INTO credit_debit SET user_id='" . $fetchDirect['income_id'] . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amounts['amount'] . "',
                                                        receiver_id='" . $fetchDirect['income_id'] . "',
                                                        sender_id='" . $user_id . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Double Commission',
                                                        Remark='Get Double Commission'
                                                        ";
            mysql_query($doulecredit);
            
            
            
        }
        
        
        //////////////////////////////////////////////credit amount for mega commsion/////////////////////////////
        
        /*$sqlmegaDirect = mysql_query("select * from direct_income_mega where income_id='" . $sqlRef['ref_id'] . "' and status='0'");
        if (mysql_num_rows($sqlmegaDirect) > 0 && $sqlReftype['mem_type'] > 0) {
        $fetchDirectmega = mysql_fetch_assoc($sqlmegaDirect);
        
        $updateDirect    = "update direct_income_mega SET status='1' where income_id='" . $fetchDirectmega['income_id'] . "'";
        mysql_query($updateDirect);
        
        
        mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $fetchDirectmega['income_id'] . "'");
        
        
        
        $args_amountmega = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $fetchDirectmega['income_id'] . "'"));
        
        
        
        $insert_cr_drmega = "INSERT INTO credit_debit SET user_id='" . $fetchDirectmega['income_id'] . "' , 
        transaction_no='" . $this->generate_transaction_number() . "',
        credit_amt='" . $commission . "',
        final_bal='" . $args_amountmega['amount'] . "',
        receiver_id='" . $fetchDirectmega['income_id'] . "',
        sender_id='" . $user_id . "',
        receive_date='" . date("Y-m-d") . "',
        TranDescription = 'Direct Mega Commission',
        Remark='" . $Remark2 . "'
        ";
        mysql_query($insert_cr_drmega);
        }*/
        
        
        
    }
    
    
    
    /////////////////////////////////////update direct commmsion///////////////////////////
    function updateDirectComm($user_id)
    {
        global $obj_rep;
        $sqlDirectcheck = mysql_query("select * from direct_income where income_id='" . $user_id . "' and status='0'");
        
        if (mysql_num_rows($sqlDirectcheck) > 0) {
            while ($fetdirect = mysql_fetch_assoc($sqlDirectcheck)) {
                /** update amount in final ewallet */
                mysql_query("update final_e_wallet set amount=(amount+$fetdirect[commission]) where user_id='" . $user_id . "'");
                /** get amount from final ewallet */
                $direamount  = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                $driecremark = "Get Direct Commission From Member $fetdirect[purchaser_id]";
                
                /** Insert amount in credit_debit */
                $driectcredti = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $fetdirect[commission] . "',
                                                        final_bal='" . $direamount['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='$fetdirect[purchaser_id]',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Direct Commission',
                                                        Remark='" . $driecremark . "'
                                                        ";
                
                mysql_query($driectcredti);
                
                
                
                
                
                
                
                mysql_query("update final_e_wallet set amount=(amount+$fetdirect[commission]) where user_id='" . $user_id . "'");
                /** get amount from final ewallet */
                $direamounts = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                /** Insert amount in credit_debit */
                $doublec     = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $fetdirect[commission] . "',
                                                        final_bal='" . $direamounts['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='$fetdirect[purchaser_id]',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Direct Double Commission',
                                                        Remark='Direct Double Commission'
                                                        ";
                
                mysql_query($doublec);
                
                
                
                
                
                
                
                
                
                $fieddirect = array(
                    'status' => 1
                );
                
                $contioDirct = " income_id='" . $user_id . "' and status='0'";
                $obj_rep->update_tbl($fieddirect, 'direct_income', $contioDirct);
                
            }
            
        }
        
        
        ////////////////////////getting direct Mega commission//////////////////////////
        
        /*$sqlDirectcheckmega = mysql_query("select * from direct_income_mega where income_id='" . $user_id . "' and status='0'");
        
        if (mysql_num_rows($sqlDirectcheckmega) > 0) {
        while ($fetdirectmega = mysql_fetch_assoc($sqlDirectcheckmega)) {
        
        mysql_query("update final_e_wallet set amount=(amount+$fetdirectmega[commission]) where user_id='" . $user_id . "'");
        
        
        
        $direamountmega  = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
        $driecremarkmega = "Get Direct Mega Commission From Member $fetdirectmega[purchaser_id]";
        
        
        $driectcredtimega = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
        transaction_no='" . $this->generate_transaction_number() . "',
        credit_amt='" . $fetdirectmega[commission] . "',
        final_bal='" . $direamountmega['amount'] . "',
        receiver_id='" . $user_id . "',
        sender_id='',
        receive_date='" . date("Y-m-d") . "',
        TranDescription = 'Direct Mega Commission',
        Remark='" . $driecremarkmega . "'
        ";
        
        mysql_query($driectcredtimega);
        
        $fieddirectmega = array(
        'status' => 1
        );
        
        $contioDirctmega = " income_id='" . $user_id . "' and status='0'";
        $obj_rep->update_tbl($fieddirectmega, 'direct_income_mega', $contioDirctmega);
        
        }
        
        }*/
        
        //////////////////////////////////////////end here Getting direct Mega commission///////////////////////
        
        
    }
    
    
    /////////////////////////////////Total Sum of Direct Commision///////////////////////    
    function sumDirectcomission($user_id)
    {
        if (!empty($user_id)) {
            $dicomi  = mysql_query("select sum(commission) as commission from direct_income where income_id='" . $user_id . "'");
            $fetcomi = mysql_fetch_assoc($dicomi);
            if (mysql_num_rows($dicomi) > 0 && !empty($fetcomi['commission'])) {
                return $fetcomi['commission'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    
    /////////////////////////////////Total Sum of Direct Mega Commision///////////////////////    
    function sumDirectMegacomission($user_id)
    {
        if (!empty($user_id)) {
            $dicomi  = mysql_query("select sum(commission) as commission from direct_income_mega where income_id='" . $user_id . "'");
            $fetcomi = mysql_fetch_assoc($dicomi);
            if (mysql_num_rows($dicomi) > 0 && !empty($fetcomi['commission'])) {
                return $fetcomi['commission'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    
    /////////////////////////////////Total Sum of Team Building Commision///////////////////////    
    function sumTeambuildingComm($user_id)
    {
        if (!empty($user_id)) {
            $dicomi  = mysql_query("select sum(commission) as commission from level_income where income_id='" . $user_id . "'");
            $fetcomi = mysql_fetch_assoc($dicomi);
            if (mysql_num_rows($dicomi) > 0 && !empty($fetcomi['commission'])) {
                return $fetcomi['commission'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    /////////////////////////////////Total Sum of Team Building Mega Commision///////////////////////    
    function sumTeambuildingMegaComm($user_id)
    {
        if (!empty($user_id)) {
            $dicomi  = mysql_query("select sum(commission) as commission from level_income_mega where income_id='" . $user_id . "'");
            $fetcomi = mysql_fetch_assoc($dicomi);
            if (mysql_num_rows($dicomi) > 0 && !empty($fetcomi['commission'])) {
                return $fetcomi['commission'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    /////////////////////////////////Total Sum of Matching Commision///////////////////////    
    function sumMatchingcomission($user_id)
    {
        if (!empty($user_id)) {
            $sqlmathc   = mysql_query("select sum(commission) as commission from matching_income where user_id='" . $user_id . "'");
            $fetmatchih = mysql_fetch_assoc($sqlmathc);
            if (mysql_num_rows($sqlmathc) > 0 && !empty($fetmatchih['commission'])) {
                return $fetmatchih['commission'];
            } else {
                return "0";
            }
            
        }
        
    }
    
    
    
    /////////////////////////////////Total Sum of Direct MOney box Commision///////////////////////    
    function totalMoneybox()
    {
        
        $money    = mysql_query("select sum(dpv) as dpv from money_box where status='0'");
        $totmoney = mysql_fetch_assoc($money);
        if (mysql_num_rows($money) > 0 && !empty($totmoney['dpv'])) {
            $toal = ($totmoney['dpv'] * (1 / 100)) * 1;
            return $toal;
        } else {
            return "0";
        }
    }
    
    
    
    /////////////////////////////////Total Sum of Direct MOney box Commision///////////////////////    
    function totalMoneyTbcbox()
    {
        
        $tbcmoney    = mysql_query("select sum(tbpv) as tbpv from money_box where m_status='0'");
        $tottbcmoney = mysql_fetch_assoc($tbcmoney);
        if (mysql_num_rows($tbcmoney) > 0 && !empty($tottbcmoney['tbpv'])) {
            $tbctoal = ($tottbcmoney['tbpv'] * (2 / 100)) * 1;
            return $tbctoal;
        } else {
            return "0";
        }
    }
    
    
    
    
    ////////////////////////////////////TBC Commission/////////////////////////
    
    function unilevelCommission($user_id, $invoiceNo)
    {
        
        $row             = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $user_id . "'"));
        $usernm          = $row['username'];
        $selectComission = mysql_fetch_array(mysql_query("SELECT * FROM set_comission"));
        $totaLevel       = $selectComission['level'];
        $pointAmount     = $selectComission['pntamount'];
        $levelVal        = $selectComission['level_comission'];
        $leveAmount      = explode(',', $levelVal);
        $countNomTotal   = $this->countNomTotal($user_id);
        $i               = 0;
        foreach ($countNomTotal as $nomId) {
            $j = $i + 1;
            
            $Remark = " Get Level-$j Commission From Member $user_id";
            $bonus  = "1";
            
            if ($i <= $totaLevel) {
                
                
                $totalPoint = $this->teamPoint($user_id, $nomId, $invoiceNo);
                $commission = ($totalPoint * ($leveAmount[$i] / 100)) * $pointAmount;
                
                $sqlType = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $nomId . "'"));
                
                if ($nomId != 'cmp') {
                    $sqlLevel = "INSERT INTO level_income SET income_id='" . $nomId . "',
                                                                        invoice_no='" . $invoiceNo . "',
                                                                        level='" . $j . "', 
                                                                        remark='" . $Remark . "', 
                                                                        purchaser_uname='" . $usernm . "', 
                                                                        purchaser_id='" . $user_id . "',
                                                                        commission = '" . $commission . "', 
                                                                        status='0'
                                                                        ";
                    
                    mysql_query($sqlLevel);
                }
                
                
                
                ///////////////////////////Mega TBC Commission/////////////////////
                /*$sqlRef     = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $nomId . "'"));
                $RemarkMega = " Get Mega Commission From Member $nomId";
                $sqlRef     = $sqlRef['ref_id'];
                
                $sqluser = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $sqlRef . "'"));
                $usernms = $sqluser['username'];
                
                
                if ($sqlRef != 'cmp' && $nomId != 'cmp') {
                
                $sqlLevelmega = "INSERT INTO level_income_mega SET income_id='" . $sqlRef . "',
                invoice_no='" . $invoiceNo . "',
                level='" . $j . "', 
                remark='" . $RemarkMega . "', 
                purchaser_uname='" . $usernms . "', 
                purchaser_id='" . $nomId . "',
                commission = '" . $commission . "', 
                status='0'
                ";
                
                mysql_query($sqlLevelmega);
                
                }*/
                
                
                /////////////////////////////////////////////////////////////////////////////end here/////////////////    
                
                if ($sqlType['mem_type'] > 1) {
                    
                    
                    /** Update commission in level_income */
                    $updateLevel = "update level_income SET status='1' where income_id='" . $nomId . "' and invoice_no='" . $invoiceNo . "'";
                    mysql_query($updateLevel);
                    
                    /** update amount in final ewallet */
                    mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $nomId . "'");
                    /** get amount from final ewallet */
                    $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $nomId . "'"));
                    
                    
                    /** Insert amount in credit_debit */
                    $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $nomId . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $nomId . "',
                                                        sender_id='" . $user_id . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'TB commission from Level $j',
                                                        Remark='" . $Remark . "'
                                                        ";
                    
                    mysql_query($insert_cr_dr);
                    
                    
                    
                    
                    
                    
                    
                    /** update amount in final ewallet */
                    mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $nomId . "'");
                    /** get amount from final ewallet */
                    $args_amountss = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $nomId . "'"));
                    
                    
                    /** Insert amount in credit_debit */
                    $dou = "INSERT INTO credit_debit SET user_id='" . $nomId . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amountss['amount'] . "',
                                                        receiver_id='" . $nomId . "',
                                                        sender_id='" . $user_id . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'TB Double commission from Level $j',
                                                        Remark='TB Double commission from Level $j'
                                                        ";
                    
                    mysql_query($dou);
                    
                    
                    
                    
                    
                }
                
                
                ///////////////////Credit amount to Mega Commsion of every sponser/////////////////
                
                /*if ($sqluser['mem_type'] > 1) {
                
                $updateLevelmega = "update level_income_mega SET status='1' where income_id='" . $sqlRef . "' and status='0'";
                mysql_query($updateLevelmega);
                
                
                mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $sqlRef . "'");
                
                
                
                $args_amountmegacom = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $sqlRef . "'"));
                
                
                
                $credit_mega = "INSERT INTO credit_debit SET user_id='" . $sqlRef . "' , 
                transaction_no='" . $this->generate_transaction_number() . "',
                credit_amt='" . $commission . "',
                final_bal='" . $args_amountmegacom['amount'] . "',
                receiver_id='" . $sqlRef . "',
                sender_id='" . $nomId . "',
                receive_date='" . date("Y-m-d") . "',
                TranDescription = '" . $RemarkMega . "',
                Remark='" . $RemarkMega . "'
                ";
                
                mysql_query($credit_mega);
                
                ///////////////////////////////end hrere/////////////////////
                
                }*/
                
                
            }
            
            $i++;
            
        }
        
        $this->updateUnilevel($user_id);
        
        
    }
    
    
    ////////////////////////////////////Updating TBC Commission/////////////////////////    
    function updateUnilevel($user_id)
    {
        
        $sqlLevlcheck = mysql_query("select * from level_income where income_id='" . $user_id . "' and status='0'");
        
        if (mysql_num_rows($sqlLevlcheck) > 0) {
            while ($fetchLevel = mysql_fetch_assoc($sqlLevlcheck)) {
                $commission = $fetchLevel['commission'];
                
                /** Update commission in level_income */
                $updateLevel = "update level_income SET  status='1' where invoice_no='" . $fetchLevel['invoice_no'] . "' and status='0' and income_id='" . $user_id . "'";
                mysql_query($updateLevel);
                
                /** update amount in final ewallet */
                mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $user_id . "'");
                
                /** get amount from final ewallet */
                $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                $Remark      = " Get Level-$fetchLevel[level] Commission From Member $fetchLevel[purchaser_id]";
                
                /** Insert amount in credit_debit */
                $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='" . $fetchLevel['purchaser_id'] . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'TB commission from Level $fetchLevel[level]',
                                                        Remark='" . $Remark . "'
                                                        ";
                
                mysql_query($insert_cr_dr);
                
                
                
                /** update amount in final ewallet */
                mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $user_id . "'");
                
                /** get amount from final ewallet */
                $args_amountdd = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                /** Insert amount in credit_debit */
                $tbcredit      = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amountdd['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='" . $fetchLevel['purchaser_id'] . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'TB Double commission',
                                                        Remark='TB Double commission'
                                                        ";
                
                mysql_query($tbcredit);
                
                
                
            }
            
            
            
            
        }
        
        
        
        ///////////////////////////////////////////mega tb commision////////////////////////////
        
        /*if (mysql_num_rows($sqlLevlchecks) > 0 && $refId!='cmp') {
        while ($fetchLevels = mysql_fetch_assoc($sqlLevlchecks)) {
        
        
        $updateLevels = "update level_income_mega SET status='1' where invoice_no='" . $fetchLevels['invoice_no'] . "' and status='0'";
        mysql_query($updateLevels);
        
        
        mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $refId . "'");
        
        
        
        $args_amounts = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $refId . "'"));
        $Remarks      = " Get Mega Commission From Member $user_id]";
        
        
        $credmega = "INSERT INTO credit_debit SET user_id='" . $refId . "' , 
        transaction_no='" . $this->generate_transaction_number() . "',
        credit_amt='" . $commission . "',
        final_bal='" . $args_amounts['amount'] . "',
        receiver_id='" . $refId . "',
        sender_id='" . $user_id . "',
        receive_date='" . date("Y-m-d") . "',
        TranDescription = 'TB Mega commission from Level $user_id',
        Remark='" . $Remarks . "'
        ";
        
        mysql_query($credmega);
        
        }
        
        
        }*/
        
        /////////////////////////////////////////ENd Here ////////////
        
    }
    
    
    
    ///////////////////////////Start Here Matching Commission///////////////////////
    
    function matchingCommission($user_id, $userStatus)
    {
        
        global $obj_rep;
        
        $sqlcarry  = mysql_fetch_assoc(mysql_query("select * from matching_income where user_id='" . $user_id . "' order by id desc limit 1"));
        $carryLeft = $sqlcarry['carry_fwd_left'];
        $carryReft = $sqlcarry['carry_fwd_right'];
        
        $querys1 = mysql_fetch_array(mysql_query("select sum(mpv) as totalleftamount from manage_bv_history where status='0' and income_id='" . $user_id . "' and leg='left'"));
        
        $currentleftTotal = mysql_fetch_array(mysql_query("select sum(mpv) as totalleft from manage_bv_history where income_id='" . $user_id . "' and leg='left'"));
        
        ////////////////////////////////////////////////////total left with carry forward//////////////    
        $leftTotal = $querys1['totalleftamount'] + $carryLeft;
        
        $querys12 = mysql_fetch_array(mysql_query("select sum(mpv) as totalrightamount from manage_bv_history where status='0' and income_id='" . $user_id . "' and leg='right'"));
        
        $currentrightTotal = mysql_fetch_array(mysql_query("select sum(mpv) as totalright from manage_bv_history where income_id='" . $user_id . "' and leg='right'"));
        
        
        
        ////////////////////////////////////////////////////total right with carry forward//////////////        
        $rightTotal = $querys12['totalrightamount'] + $carryReft;
        $totalPair  = min($leftTotal, $rightTotal);
        
        if ($totalPair >= 1000) {
            $totalPair         = 1000;
            $leftCarryForward  = 0;
            $rightCarryForward = 0;
        } else {
            $totalPair;
            
            if ($leftTotal < $rightTotal) {
                $leftCarryForward = 0;
                
                $rightCarryForward = $rightTotal - $leftTotal;
                
            }
            
            if ($rightTotal < $leftTotal) {
                $rightCarryForward = 0;
                $leftCarryForward  = $leftTotal - $rightTotal;
            }
            
            if ($leftTotal == $rightTotal) {
                $leftCarryForward  = 0;
                $rightCarryForward = 0;
            }
            
        }
        $commission = ($totalPair * (10 / 100)) * 1;
        $sts        = ($userStatus == 3 ? 1 : 0);
        
        ////////////////////////////////insert record in table///////////////////
        if ($totalPair >= 100) {
            
            
            $sqlComission = array(
                'user_id' => $user_id,
                'carry_fwd_left' => $leftCarryForward,
                'carry_fwd_right' => $rightCarryForward,
                'match_left' => $totalPair,
                'match_right' => $totalPair,
                'income_pair' => $totalPair,
                'all_pair' => $totalPair,
                'lpair' => $currentleftTotal[totalleft],
                'rpair' => $currentrightTotal[totalright],
                'commission' => $commission,
                'final_amount' => $commission,
                'b_date' => date("Y-m-d"),
                'status' => $sts,
                'remark' => 'Get Matching Commission pair wise'
            );
            
            
            
            $lastId    = $obj_rep->insert_tbl($sqlComission, 'matching_income');
            $fieldvalu = array(
                'status' => 1
            );
            
            $condLevel6 = " income_id='" . $user_id . "' and status='0'";
            $obj_rep->update_tbl($fieldvalu, 'manage_bv_history', $condLevel6);
            
            $sqlmathicng = mysql_query("select * from matching_income where user_id = '" . $user_id . "' and id='" . $lastId . "' and status='1'");
            
            
            if (mysql_num_rows($sqlmathicng) > 0) {
                
                $fetDatas = mysql_fetch_assoc($sqlmathicng);
                /** update amount in final ewallet */
                mysql_query("update final_e_wallet set amount=(amount+$fetDatas[commission]) where user_id='" . $user_id . "'");
                
                /** get amount from final ewallet */
                $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                $Remark      = " Get Matching Commission";
                
                /** Insert amount in credit_debit */
                $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $fetDatas[commission] . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Matching commission',
                                                        Remark='" . $Remark . "'
                                                        ";
                
                mysql_query($insert_cr_dr);
                
                
                
                mysql_query("update final_e_wallet set amount=(amount+$fetDatas[commission]) where user_id='" . $user_id . "'");
                
                /** get amount from final ewallet */
                $args_amountddds = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                
                
                /** Insert amount in credit_debit */
                $matcdouble = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $fetDatas[commission] . "',
                                                        final_bal='" . $args_amountddds['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Double Matching commission',
                                                        Remark='Get Double Matching commission'
                                                        ";
                
                mysql_query($matcdouble);
                
                
                
                
            }
            
            
            /////////////////////////for voucher wallet information//////////////////////
            
            $voucherCom = $commission * (10 / 100);
            /** update amount in final ewallet */
            mysql_query("update voucher_e_wallet set amount=(amount+$voucherCom) where user_id='" . $user_id . "'");
            
            
            /** get amount from final ewallet */
            $amoutnget = mysql_fetch_assoc(mysql_query("select amount from voucher_e_wallet where user_id='" . $user_id . "'"));
            $Remarks   = " Get Voucher Bonus";
            
            /** Insert amount in credit_debit */
            if (!empty($voucherCom) && $voucherCom > 0) {
                
                
                $invouhertable = "INSERT INTO credit_debit_voucher SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number_voucher() . "',
                                                        credit_amt='" . $voucherCom . "',
                                                        final_bal='" . $amoutnget['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Voucher Bonus',
                                                        Remark='" . $Remarks . "'
                                                        ";
                
                mysql_query($invouhertable);
            }
            
            ////////////////////mega matching Commission///////////////////////
            
            /*$sqlref = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $user_id . "'"));
            $refId  = $sqlref['ref_id'];
            
            $sqlref = mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='" . $refId . "'"));
            $refType  = $sqlref['mem_type'];
            
            
            $stsref        = ($refType == 3 ? 1 : 0);
            
            if ($refId != 'cmp') {
            $sqlComissionmega = array(
            'user_id' => $refId,
            'carry_fwd_left' => $leftCarryForward,
            'carry_fwd_right' => $rightCarryForward,
            'match_left' => $totalPair,
            'match_right' => $totalPair,
            'income_pair' => $totalPair,
            'all_pair' => $totalPair,
            'lpair' => $currentleftTotal[totalleft],
            'rpair' => $currentrightTotal[totalright],
            'commission' => $commission,
            'final_amount' => $commission,
            'b_date' => date("Y-m-d"),
            'status' => $stsref,
            'remark' => 'Get Mega Matching Commission'
            );
            
            $lastIds    = $obj_rep->insert_tbl($sqlComissionmega, 'matching_income_mega');
            $fieldvalus = array(
            'status' => 1
            );
            
            $condLevel6s = " income_id='" . $refId . "' and status='0'";
            $obj_rep->update_tbl($fieldvalus, 'manage_bv_history', $condLevel6s);
            
            $sqlmathicngs = mysql_query("select * from matching_income_mega where user_id = '" . $refId . "' and id='" . $lastIds . "' and status='1'");
            
            if (mysql_num_rows($sqlmathicngs) > 0) {
            
            $fetDatass = mysql_fetch_assoc($sqlmathicngs);
            /** update amount in final ewallet */
            
            //mysql_query("update final_e_wallet set amount=(amount+$fetDatass[commission]) where user_id='" . $refId . "'");
            
            
            /** get amount from final ewallet */
            /* $args_amountmega = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $refId . "'"));
            $Remarkmega     = " Get Mega Matching Commission";
            
            /** Insert amount in credit_debit */
            /*$mega = "INSERT INTO credit_debit SET user_id='" . $refId . "' , 
            transaction_no='" . $this->generate_transaction_number() . "',
            credit_amt='" . $fetDatass[commission] . "',
            final_bal='" . $args_amountmega['amount'] . "',
            receiver_id='" . $refId . "',
            sender_id='$user_id',
            receive_date='" . date("Y-m-d") . "',
            TranDescription = '".$Remarkmega."',
            Remark='" . $Remarkmega . "'
            ";
            
            mysql_query($mega);
            
            }
            
            }*/
            
            ////////////////////////////////////////////////End Here Mega Commission////////////////////////
            
        }
        
    }
    
    function updateMatchingComm($user_id)
    {
        global $obj_rep;
        $sqlmathicng = mysql_query("select * from matching_income where user_id = '" . $user_id . "' and status='0'");
        
        
        if (mysql_num_rows($sqlmathicng) > 0) {
            
            while ($fetDatas = mysql_fetch_assoc($sqlmathicng)) {
                /** update amount in final ewallet */
                mysql_query("update final_e_wallet set amount=(amount+$fetDatas[commission]) where user_id='" . $user_id . "'");
                
                
                /** get amount from final ewallet */
                $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                $Remark      = " Get Matching Commission";
                
                /** Insert amount in credit_debit */
                $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $fetDatas[commission] . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Matching commission',
                                                        Remark='" . $Remark . "'
                                                        ";
                
                mysql_query($insert_cr_dr);
                
                
                
                
                
                
                
                
                mysql_query("update final_e_wallet set amount=(amount+$fetDatas[commission]) where user_id='" . $user_id . "'");
                
                
                /** get amount from final ewallet */
                $args_amountddsc = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
                
                /** Insert amount in credit_debit */
                $dublematchi = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $fetDatas[commission] . "',
                                                        final_bal='" . $args_amountddsc['amount'] . "',
                                                        receiver_id='" . $user_id . "',
                                                        sender_id='',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Get Double Matching commission',
                                                        Remark='Get Double Matching commission'
                                                        ";
                
                mysql_query($dublematchi);
                
                
                
                
                
                
                
                $fieldvalu = array(
                    'status' => 1
                );
                
                $condLevel6 = " user_id='" . $user_id . "' and status='0'";
                $obj_rep->update_tbl($fieldvalu, 'matching_income', $condLevel6);
                
            }
            
        }
        
        
        
        
        ////////////////////////////////////Update Commsion mega//////////////////////
        
        /*$sqlmathicngm = mysql_query("select * from matching_income_mega where user_id = '" . $user_id . "' and status='0'");
        
        
        if (mysql_num_rows($sqlmathicngm) > 0) {
        
        while ($fetDatasm = mysql_fetch_assoc($sqlmathicngm)) {
        
        mysql_query("update final_e_wallet set amount=(amount+$fetDatasm[commission]) where user_id='" . $user_id . "'");
        
        
        
        $args_amountm = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $user_id . "'"));
        $Remarkm      = "Get Mega Matching Commission";
        
        
        $cremega = "INSERT INTO credit_debit SET user_id='" . $user_id . "' , 
        transaction_no='" . $this->generate_transaction_number() . "',
        credit_amt='" . $fetDatasm[commission] . "',
        final_bal='" . $args_amountm['amount'] . "',
        receiver_id='" . $user_id . "',
        sender_id='',
        receive_date='" . date("Y-m-d") . "',
        TranDescription = '".$Remarkm ."',
        Remark='" . $Remarkm . "'
        ";
        
        mysql_query($cremega);
        
        $fieldvalum = array(
        'status' => 1
        );
        
        $condLevel6m = " user_id='" . $user_id . "' and status='0'";
        $obj_rep->update_tbl($fieldvalum, 'matching_income_mega', $condLevel6m);
        
        }
        
        }*/
        
    }
    
    
    
    
    ////////////////////////////////////////Direct Money box start here/////////////////
    
    
    function directMoneyBox($user_id, $userStatus)
    {
        global $obj_rep;
        
        $startDate = date("Y-m-d", strtotime("-1 month"));
        $current   = date("Y-m-d");
        
        ////////////////////checking commision higher //////////////////
        $sqlDirectcheck = mysql_query("SELECT SUM(commission) AS commission, direct_income.income_id,user_registration.ts FROM direct_income inner join user_registration on user_registration.user_id=direct_income.income_id WHERE CAST(direct_income.ts AS DATE) BETWEEN '" . $startDate . "' AND '" . $current . "' AND STATUS='1' and paid_status='0' GROUP BY direct_income.income_id ORDER BY commission DESC, ts LIMIT 1");
        $fetchDirects   = mysql_fetch_assoc($sqlDirectcheck);
        
        
        /////////////////////commision calculation//////////////////////
        
        $commisions = mysql_fetch_assoc(mysql_query("select sum(dpv) as dpv from money_box where date between '" . $startDate . "' and '" . $current . "' and status='0'"));
        $commission = ($commisions['dpv'] * (1 / 100)) * 1;
        
        $check = mysql_fetch_assoc(mysql_query("select * from direct_income where income_id='" . $user_id . "' group by commission limit 1"));
        
        
        
        if ($check['income_id'] == $fetchDirects['income_id'] && !empty($fetchDirects['income_id'])) {
            $sqlLevel = "INSERT INTO money_box_income SET income_id='" . $fetchDirects['income_id'] . "',
                                                                        remark='Getting Best Client Moneybox', 
                                                                        commission = '" . $commission . "', 
                                                                        status='0'
                                                                        ";
            mysql_query($sqlLevel);
            
            
            
            $sqlqeyr = mysql_query("select * from money_box_income where income_id='" . $fetchDirects['income_id'] . "'");
            
            $fetchDirect  = mysql_fetch_assoc($sqlqeyr);
            /** Update commission in level_income */
            $updateDirect = "update direct_income SET status='1' where income_id='" . $fetchDirect['income_id'] . "'";
            mysql_query($updateDirect);
            
            /** update amount in final ewallet */
            mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $fetchDirect['income_id'] . "'");
            
            
            /** get amount from final ewallet */
            $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $fetchDirect['income_id'] . "'"));
            
            
            /** Insert amount in credit_debit */
            $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $fetchDirect['income_id'] . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $fetchDirect['income_id'] . "',
                                                        sender_id='" . $user_id . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Getting Best Client Moneybox',
                                                        Remark='Getting Best Client Moneybox'
                                                        ";
            mysql_query($insert_cr_dr);
            
            
            mysql_query("update direct_income set paid_status='1' where cast(ts as date) between '" . $startDate . "' and '" . $current . "' and status='1'");
            $updat = mysql_query("update money_box_income set status='1' where income_id='" . $fetchDirect['income_id'] . "' and status=0");
            mysql_query("update money_box set status='1' where date between '" . $startDate . "' and '" . $current . "' and status='0'");
            
        } /////num check ///////////
        
    }
    
    
    
    ////////////////////////////////////////Marketer Money box start here/////////////////
    
    
    function marketerMoneyBox($user_id, $userStatus)
    {
        global $obj_rep;
        
        $startDate = date("Y-m-d", strtotime("-1 month"));
        $current   = date("Y-m-d");
        
        ////////////////////checking commision higher //////////////////
        $sqlDirectcheck = mysql_query("SELECT SUM(commission) AS commission, level_income.income_id,user_registration.ts FROM level_income inner join user_registration on user_registration.user_id=level_income.income_id WHERE CAST(level_income.ts AS DATE) BETWEEN '" . $startDate . "' AND '" . $current . "' AND STATUS='1' and paid_status='0' GROUP BY level_income.income_id ORDER BY commission DESC, ts LIMIT 1");
        $fetchDirects   = mysql_fetch_assoc($sqlDirectcheck);
        
        
        /////////////////////commision calculation//////////////////////
        
        $commisions = mysql_fetch_assoc(mysql_query("select sum(tbpv) as tbpv from money_box where date between '" . $startDate . "' and '" . $current . "' and m_status='0'"));
        $commission = ($commisions['tbpv'] * (2 / 100)) * 1;
        
        $check = mysql_fetch_assoc(mysql_query("select * from level_income where income_id='" . $user_id . "' group by commission limit 1"));
        
        
        
        if ($check['income_id'] == $fetchDirects['income_id'] && !empty($fetchDirects['income_id'])) {
            $sqlLevel = "INSERT INTO marketer_money_box_income SET income_id='" . $fetchDirects['income_id'] . "',
                                                                        remark='Getting Best Marketer Moneybox', 
                                                                        commission = '" . $commission . "', 
                                                                        status='0'
                                                                        ";
            mysql_query($sqlLevel);
            
            
            
            $sqlqeyr = mysql_query("select * from marketer_money_box_income where income_id='" . $fetchDirects['income_id'] . "'");
            
            $fetchDirect  = mysql_fetch_assoc($sqlqeyr);
            /** Update commission in level_income */
            $updateDirect = "update level_income SET status='1' where income_id='" . $fetchDirect['income_id'] . "'";
            mysql_query($updateDirect);
            
            /** update amount in final ewallet */
            mysql_query("update final_e_wallet set amount=(amount+$commission) where user_id='" . $fetchDirect['income_id'] . "'");
            
            
            /** get amount from final ewallet */
            $args_amount = mysql_fetch_assoc(mysql_query("select amount from final_e_wallet where user_id='" . $fetchDirect['income_id'] . "'"));
            
            
            /** Insert amount in credit_debit */
            $insert_cr_dr = "INSERT INTO credit_debit SET user_id='" . $fetchDirect['income_id'] . "' , 
                                                        transaction_no='" . $this->generate_transaction_number() . "',
                                                        credit_amt='" . $commission . "',
                                                        final_bal='" . $args_amount['amount'] . "',
                                                        receiver_id='" . $fetchDirect['income_id'] . "',
                                                        sender_id='" . $user_id . "',
                                                        receive_date='" . date("Y-m-d") . "',
                                                        TranDescription = 'Getting Best Marketer Moneybox',
                                                        Remark='Getting Best Marketer Moneybox'
                                                        ";
            mysql_query($insert_cr_dr);
            
            
            mysql_query("update level_income set paid_status='1' where cast(ts as date) between '" . $startDate . "' and '" . $current . "' and status='1'");
            $updat = mysql_query("update marketer_money_box_income set status='1' where income_id='" . $fetchDirect['income_id'] . "' and status=0");
            mysql_query("update money_box set m_status='1' where date between '" . $startDate . "' and '" . $current . "' and m_status='0'");
            
        } /////num check ///////////
        
    }
    /////////////////////////////////////////////////////end here Marketer moneybox commission//////////////////////////
    
}

?> 