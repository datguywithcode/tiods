<?php

mysql_connect('localhost','manish_brother','john@2014');
mysql_select_db('manish_john');

class mysql_func
{
	function query($slt, $table, $where=false)
	{
		//echo "select ".$slt." from ".$table." where ".$where;
		return mysql_query("select ".$slt." from ".$table." where ".$where);
	}
	function query_execute($sql)
	{
		return mysql_query($sql);
	}
	function execute_query($slt, $table, $where=false, $order_by)
	{
		//echo "select ".$slt." from ".$table." where ".$where." order by ".$order_by;
		return mysql_query("select ".$slt." from ".$table." where ".$where." order by ".$order_by );
	}
	function execute_join_query($select, $table1,$table2,$on, $where=false, $order_by)
	{
		$sql="select ".$select." from ".$table1." inner join ".$table2." on ".$on." where ".$where." order by ".$order_by;
	
		return mysql_query($sql);
	}
	function result($res, $p1, $p2)
	{
		return mysql_result($res, $p1, $p2);
	}
	function num_row($res)
	{
		return mysql_num_rows($res);
	}
	function get_row($res)
	{
		$row=mysql_fetch_array($res);
		return $row[0];
	}
	function get_all_row($res)
	{
		$row=mysql_fetch_assoc($res);
		return $row;
	}
	function insert_tbl($insert_arr,$tbl)
	{
	 $sql="INSERT INTO $tbl set ";
	 
	 foreach($insert_arr as $key=>$val)
	  $sql.=$key."='".addslashes($val)."',";
	  
	 $sql=substr($sql,0,strlen($sql)-1);
	 
	 $rs=$this->query_execute($sql);
	 if($rs)
	  return true;
	 else
	  return false;
	}

	function update_tbl($update,$tbl,$where,$addslashes=false)
	{
	 $sql="update $tbl set ";
	 
	 foreach($update as $key=>$val)
	 {
	  if($addslashes)
	   $val = addslashes($val); 
	  $sql.=$key."='".$val."',";
	 }
	  
	 $sql=substr($sql,0,strlen($sql)-1);
	 
	 $sql.=" where $where ";
	 
	 $rs=$this->query($sql);
	 if($rs)
	  return true;
	 else
	  return false;
	}
}

class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$idx;
					$levv=level_count($idx,$tid);
					$lel[]=$levv;
					
					//print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid' ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2,$tid);
		}
	}
}

class showDwonMemFV
{
	function shoDwnMemFV($dwnid,$tid,$plan_name)
	{
		function showMemXFV($dwnid,$tid,$plan_name)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' and plan_name='$plan_name' ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$idx;
					$levv=level_count($idx,$tid);
					$lel[]=$levv;
					
					//print $data_dwn;
					showMemXFV($idx,$tid,$plan_name);
			}
			return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid'  ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemXFV($user2,$tid,$plan_name);
		}
	}
}

class showDwonMemFV_new
{
	function shoDwnMemFV_new($dwnid,$tid,$user_plan)
	{
		$quer="select user_id from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			$this->showMemXFV_new($user2,$tid,$user_plan);
		}
	}
	function showMemXFV_new($dwnid,$tid,$user_plan)
	{
			global $data_dwn,$lel;
			$quer3="select user_id,user_plan from registration where nom_id='$dwnid' ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					
					if($arr2['user_plan']==$user_plan)
					{
						$data_dwn[]=$idx;
					}
					$levv=level_count($idx,$tid);
					$lel[]=$levv;

					$this->showMemXFV_new($idx,$tid,$user_plan);
			}
			return $data_dwn;
	}
}

class showDwonMemFV_new1
{
   public $data_dwn=array();
	function count_total_DwnMemFV_new($dwnid,$tid,$user_plan)
	{
		global $data_dwn;
		$count1=$this->shoDwnMemFV_new_level1($dwnid,$tid,$user_plan);
		$this->shoDwnMemFV_new1($dwnid,$tid,$user_plan);
		$r=count($data_dwn);
		$vip_count=$count1+$r;
		if($vip_count>=5 || $vip_count<30)
		{
			return 'Associate';
		}
		if($vip_count>=30 || $vip_count<155)
		{
			return 'Junior Associate';
		}
		if($vip_count>=155 || $vip_count<625)
		{
			return 'Senior Associate';
		}
		if($vip_count>=625 || $vip_count<3125)
		{
			return 'VIP 1 star';
		}
		if($vip_count>=3125 || $vip_count<15625)
		{
			return 'VIP 2 star';
		}
		if($vip_count>=15625 || $vip_count<78125)
		{
			return 'VIP 3 star';
		}
		if($vip_count>=78125 || $vip_count<390625)
		{
			return 'VIP 4 star';
		}
		if($vip_count>=390625)
		{
			return 'VIP super star';
		}
	}
	function shoDwnMemFV_new_level1($dwnid,$tid,$user_plan)
	{
		$s="select * from registration where nom_id='$dwnid' and user_plan='$user_plan'";
		$simple=mysql_query($s);
		$count=mysql_num_rows($simple);
		return $count;
	}
	function shoDwnMemFV_new1($dwnid,$tid,$user_plan)
	{
		global $data_dwn;
		$quer="select user_id from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			$this->showMemXFV_new1($user2,$tid,$user_plan);
		}
	}
	function showMemXFV_new1($dwnid,$tid,$user_plan)
	{
			global $data_dwn,$lel;
			$quer3="select user_id,user_plan from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];

					if($arr2['user_plan']==$user_plan)
					{
						$data_dwn[]=$idx;
					}
					$levv=level_count($idx,$tid);
					$lel[]=$levv;

					$this->showMemXFV_new1($idx,$tid,$user_plan);
			}
			return $data_dwn;
	}
	
	function shoDwnMem_ref($dwnid,$tid)
	{
		global $data_dwn,$geneartion;
		$quer="select user_id from registration where ref_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			$this->showMemX_ref($user2,$tid,$user_plan);
		}
	}
	function showMemX_ref($dwnid,$tid)
	{
			global $data_dwn,$lel,$geneartion;
			$quer3="select user_id,user_plan from registration where ref_id='$dwnid'";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];

					if($arr2['user_plan']==$user_plan)
					{
						$data_dwn[]=$idx;
					}
					$levv=level_count($idx,$tid);
					$lel[]=$levv;

					$this->showMemX_ref($idx,$tid,$user_plan);
			}
		return $data_dwn;
	}
}

class Commission
{
	function _upgrade_sponser_position($user_id)
	{
		$sql="select * from registration where ref_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count)
		{
			if($count>=100 && $row['user_plan']=='Representative')
			{
				# upgrade to Executive
				$upgrade="update registration set user_plan='Executive' where user_id='$user_id'";
				mysql_query($upgrade);
			}
			if($count>=250 && $row['user_plan']=='Executive')
			{
				# upgrade to Manager
				$upgrade="update registration set user_plan='Manager' where user_id='$user_id'";
				mysql_query($upgrade);
			}
		}
	}
	function personal_purchasing($user_id)
	{
		/*$sql_pv="select sum(invoice_bv) as amount from purchase_history where income_id='$user_id' and purcheser_id='$user_id' ";*/
		$sql_pv="select sum(bv) as amount from final_bv where user_id='$user_id' ";
		$res_pv=mysql_query($sql_pv);
		$row_pv=mysql_fetch_assoc($res_pv);
		return $row_pv['amount'];
	}
	function team_purchasing($user_id)
	{
		/*$sql_pv="select sum(invoice_bv) as amount from purchase_history where income_id='$user_id' ";*/
		$sql_pv="select sum(tbv) as amount from final_bv where user_id='$user_id' ";
		$res_pv=mysql_query($sql_pv);
		$row_pv=mysql_fetch_assoc($res_pv);
		return $row_pv['amount'];
	}
	function monthly_purchasing($user_id,$from_date,$to_date)
	{
		$sql_pv="select sum(invoice_bv) as amount from purchase_history where income_id='$user_id'  and (`date` between '$from_date' and '$to_date')";
		$res_pv=mysql_query($sql_pv);
		$row_pv=mysql_fetch_assoc($res_pv);
		return $row_pv['amount'];
	}
	function monthly_autoship($user_id,$from_date,$to_date)
	{
		$sql_pv="select sum(invoice_amt) as amount from purchase_history where income_id='$user_id' and purcheser_id='$user_id' and (`date` between '$from_date' and '$to_date')";
		$res_pv=mysql_query($sql_pv);
		$row_pv=mysql_fetch_assoc($res_pv);
		return $row_pv['amount'];
	}
	function _upgrade_user_rank($user_id)
	{
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		//echo $count;exit;
		if($count) // start if 001
		{
			$row=mysql_fetch_assoc($res);
			//echo $row['user_rank'];exit;
			if($row['user_rank']) // start if 002
			{
				$team_purchasing=$this->team_purchasing($user_id);
				// check condition of the user rank and update the user rank  from top to bottom
				if($row['user_rank']==7)
				{
					
				}
				else if($row['user_rank']==6 && $this->team_purchasing($user_id)>150000)
				{
					// update user rank 
					$target=150000;
					$target50=$target/2;
					// check 50% should not come from one line
					$flag=$this->commulative_from_one_leg($user_id);
					// end to check
					$from_date=date('Y-m-01');
					$to_date=date('Y-m-t');
					// && $this->monthly_autoship($user_id,$from_date,$to_date)>150
					if($flag)
					{ 
					mysql_query("update registration set user_rank=7, user_plan='PLATINUM' where user_id='$user_id'");
					mysql_query("insert into user_rank_achieve set rank_id=7,user_id='$user_id'");
					$this->rank_bonus($user_id,7);
					}
				}
				else if($row['user_rank']==5 && $this->team_purchasing($user_id)>100000)
				{
					// update user rank 
					$target=100000;
					$target50=$target/2;
					// check 50% should not come from one line
					$flag=$this->commulative_from_one_leg($user_id);
					// end to check
					$from_date=date('Y-m-01');
					$to_date=date('Y-m-t');
					// && $this->monthly_autoship($user_id,$from_date,$to_date)>100
					if($flag)
					{ 
					mysql_query("update registration set user_rank=6, user_plan='ELITE PRESIDENT' where user_id='$user_id'");
					mysql_query("insert into user_rank_achieve set rank_id=6,user_id='$user_id'");
					$this->rank_bonus($user_id,6);
					}
				}
				else if($row['user_rank']==4 && $this->team_purchasing($user_id)>50000)
				{
					// update user rank
					$target=50000;
					$target50=$target/2;
					// check 50% should not come from one line
					$flag=$this->commulative_from_one_leg($user_id);
					// end to check
					$from_date=date('Y-m-01');
					$to_date=date('Y-m-t');
					// && $this->monthly_autoship($user_id,$from_date,$to_date)>50
					if($flag)
					{ 
					mysql_query("update registration set user_rank=5, user_plan='PRESIDENT' where user_id='$user_id'");
					mysql_query("insert into user_rank_achieve set rank_id=5,user_id='$user_id'");
					$this->rank_bonus($user_id,5);
					}
				}
				else if($row['user_rank']==3 && $this->team_purchasing($user_id)>25000)
				{
					// update user rank 
					$target=25000;
					$target50=$target/2;
					// check 50% should not come from one line
					$flag=$this->commulative_from_one_leg($user_id);
					// end to check
					$from_date=date('Y-m-01');
					$to_date=date('Y-m-t');
					// && $this->monthly_autoship($user_id,$from_date,$to_date)>30
					if($flag)
					{
					mysql_query("update registration set user_rank=4, user_plan='ELITE DIRECTOR' where user_id='$user_id'");
					mysql_query("insert into user_rank_achieve set rank_id=4,user_id='$user_id'");
					$this->rank_bonus($user_id,4);
					}
				}
				else if(($row['user_rank']==1 || $row['user_rank']==2) && $this->team_purchasing($user_id)>6000)
				{
					// update user rank 
					$target=6000;
					$target50=$target/2;
					// check 50% should not come from one line
					$flag=$this->commulative_from_one_leg($user_id);
					// end to check
					$from_date=date('Y-m-01');
					$to_date=date('Y-m-t');
					// && $this->monthly_autoship($user_id,$from_date,$to_date)>25
					if($flag)
					{
						mysql_query("update registration set user_rank=3, user_plan='DIRECTOR' where user_id='$user_id'");
						mysql_query("insert into user_rank_achieve set rank_id=3,user_id='$user_id'");
						$this->rank_bonus($user_id,3);
					}
				}
			} // end if 002
			else // start else 003
			{
				// condition to check the within 30 days from the registration
				$from_date=$row['reg_date'];
				$to_date=date('Y-m-d', strtotime($row['reg_date']. ' + 30 day'));
				$curdate=date('Y-m-d');
				$endtime=strtotime($to_date);
				$curtime=strtotime($curdate);
				//echo $curtime."<=".$endtime;exit;
				if($curtime<=$endtime) // start if 004
				{
					$sql_pv="select sum(invoice_amt) as amount from purchase_history where income_id='$user_id' and `date` between '$from_date' and '$to_date'";
					$res_pv=mysql_query($sql_pv);
					$row_pv=mysql_fetch_assoc($res_pv);
					if($row_pv['amount']>=300) // start if 005
					{
						// upgrade to Excel Express Manager
						$target=300;
						$target50=$target/2;
						// check 50% should not come from one line
						$flag=$this->commulative_from_one_leg($user_id);
						// end to check
						$from_date_m=date('Y-m-01');
						$to_date_m=date('Y-m-t');
						mysql_query("update registration set user_rank=1, user_plan='Excel Express Manager' where user_id='$user_id'");
						mysql_query("insert into user_rank_achieve set rank_id=1,user_id='$user_id'");
						if($this->monthly_autoship($user_id,$from_date_m,$to_date_m)>=20)
						{
						
						
						// earn 25% of the pep from the downline
						/*$team_purchasing=$this->team_purchasing($user_id);
						$per=25;
						$earning=$team_purchasing*$per/100;
						$insert_earn="insert into level_income_bonus set income_id='$user_id',commission='$earning',`date`='$curdate1',remark='Quick Start Bonus as Excel Express Manager'";
						mysql_query($insert_earn);*/
						}
							
					} // end if 005
				} // end if 004
				else  // start else 004
				{
						$from_date1=$row['reg_date'];
						$to_date1=date('Y-m-d', strtotime($row['reg_date']. ' + 60 day'));
						$curdate1=date('Y-m-d');
						$endtime1=strtotime($to_date1);
						$curtime1=strtotime($curdate1);
						//echo $curtime1."<=".$endtime1;exit;
						if($curtime1<=$endtime1) // start if 006
						{
							$sql_pv1="select sum(invoice_amt) as amount from purchase_history where income_id='$user_id' and `date` between '$from_date1' and '$to_date1'";
							//echo $sql_pv1;exit;
							$res_pv1=mysql_query($sql_pv1);
							$row_pv1=mysql_fetch_assoc($res_pv1);
							if($row_pv1['amount']>=300) // start if 007
							{
								// upgrade to Excel Manager
								$target=300;
								$target50=$target/2;
								// check 50% should not come from one line
								$flag=$this->commulative_from_one_leg($user_id);
								// end to check
								$from_date_m=date('Y-m-01');
								$to_date_m=date('Y-m-t');
								mysql_query("update registration set user_rank=2, user_plan='Excel Manager' where user_id='$user_id'");
								mysql_query("insert into user_rank_achieve set rank_id=2,user_id='$user_id'");
								if($this->monthly_autoship($user_id,$from_date_m,$to_date_m)>=20)
								{
									
								// earn 20% of pep from downline
								/*$team_purchasing=$this->team_purchasing($user_id);
								$per=20;
								$earning=$team_purchasing*$per/100;
								$insert_earn="insert into level_income_bonus set income_id='$user_id',commission='$earning',`date`='$curdate1',remark='Quick Start Bonus as Excel Manager'";
								mysql_query($insert_earn);*/
								}
							} // end if 007
						} // end if 006
				} // end else 004
			} // end else 003
		} // end if 001
	}	// end function 
	function commulative_from_one_leg($user_id)
	{
		$sql_ref="select user_id from registration where ref_id='$user_id'";
		$res_ref=mysql_query($sql_ref);
		$count_ref=mysql_num_rows($res_ref);
		$start=$count_ref;
		$flag=1;
		$team_purchasing=$this->team_purchasing($user_id);
		$target50=$team_purchasing/2;
		while($row_ref=mysql_fetch_assoc($res_ref))
		{
			$team_purchasingu=$this->team_purchasing($row_ref['user_id']);
			if($target50<=$team_purchasingu)
			{
				$flag=0;
			}
			if(!$flag)
			{
				$count_ref--;
			}
		}
		if($start>$count_ref)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function quick_start_bonus($user_id,$pep,$invoice_no,$invoice_amt)
	{
	
	}
	function bonus_distribution($user_id,$pep,$invoice_no,$invoice_amt)
	{
		$generation=7;
		$arr_com=array('','10','5','5','5','3');
		$arr_com1=array('','10','5','5','4','3','1','1');
		$arr_com2=array('','10','5','5','4','3','2','1');
		$curdate=date('Y-m-d');
		$sql1="select user_id,nom_id,ref_id,user_type,user_rank from registration where user_id='$user_id'";
		$res1=mysql_query($sql1);
		$row1=mysql_fetch_assoc($res1);
		$nom_id1=$row1['nom_id'];
		$ref_id1=$row1['ref_id'];
		$cnt=1;
		$l=$nom_id1;
		$r=$ref_id1;
		$user_rank=$row1['user_rank'];
		$from_date_m=date('Y-m-01');
		$to_date_m=date('Y-m-t');
		//echo "UserRank".$user_rank."<br>MP:".$this->monthly_autoship($ref_id1,$from_date_m,$to_date_m)."<br>Income Id:".$ref_id1;exit;
		/*if($user_rank==0)
		{
			// get 25% bonus to sponser
			$quick_bonus=$pep*35/100;
			$from_date_m=date('Y-m-01');
			$to_date_m=date('Y-m-t');
			if($this->monthly_autoship($ref_id1,$from_date_m,$to_date_m)>=20)
			{
				$level_com="INSERT INTO `level_income_bonus` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$ref_id1', '$cnt', '$quick_bonus', curdate(), '', '0','0', '$invoice_amt', '35', '$pep', '', '','$cdid','Quick Start Bonus','Get Quick Start Bonus from user $user_id of invoice $invoice_no','$user_level');";
			//echo $level_com; exit;
				mysql_query($level_com);
			}		
		}*/
		/*if($user_rank==1 || $user_rank==2)
		{*/
			// check user upgrade rank once or not
			$sql_check_history="select * from purchase_history where income_id='$user_id' and purcheser_id='$user_id' group by invoice_no";
			$res_check_history=mysql_query($sql_check_history);
			$count_check_history=mysql_num_rows($res_check_history);
			//echo $count_check_history;exit;
			/*if($count_check_history)
			{*/
				// get personal purchasing
				$personal_purchasing=$this->personal_purchasing($user_id);
				/*if($personal_purchasing>=300)
				{*/
					$from_date_m=date('Y-m-01');
					$to_date_m=date('Y-m-t');
					//echo $ref_id1."====".$this->monthly_autoship($ref_id1,$from_date_m,$to_date_m).">=20";exit;
					/*if($this->monthly_autoship($ref_id1,$from_date_m,$to_date_m)>=20)
					{*/
					
						// check from level_income_bonus
						$sql_level="select sum(commission) as amount from  `level_income_bonus` where purcheser_id='$user_id' and income_id='$ref_id1'";
						$res_level=mysql_query($sql_level);
						$row_level=mysql_fetch_assoc($res_level);
						/*if($row_level['amount']<105)
						{
							echo "Yes"; 
						}
						else
						{
							echo "No";
						}
						exit;*/
						if($row_level['amount']<105)
						{
							// check upline rank
							$sql_up_rank="select * from registration where user_id='$ref_id1'";
							$res_up_rank=mysql_query($sql_up_rank);
							$row_up_rank=mysql_fetch_assoc($res_up_rank);
							
							if($row_up_rank['user_rank']==1)
							{
								$quick_bonus=$pep*35/100;
							}
							if($row_up_rank['user_rank']==2)
							{
								$quick_bonus=$pep*25/100;
							}
							//$quick_bonus=$pep*25/100;
							
							$level_com="INSERT INTO `level_income_bonus` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$ref_id1', '$cnt', '$quick_bonus', curdate(), '', '0','0', '$invoice_amt', '35', '$pep', '', '','$cdid','Quick Start Bonus','Get Quick Start Bonus from user $user_id of invoice $invoice_no','$user_level');";
							//echo $level_com;exit;
							mysql_query($level_com);
						}
						/*else
						{
						$quick_bonus1=$pep*10/100;
						$level_com1="INSERT INTO `level_income_bonus` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$ref_id1', '$cnt', '$quick_bonus1', curdate(), '', '0','0', '$invoice_amt', '10', '$pep', '', '','$cdid','Quick Start Bonus','Get Quick Start Bonus from user $user_id of invoice $invoice_no','$user_level');";
						//echo $level_com;exit;
						//mysql_query($level_com1);
						}*/
					/*}*/
				/*}*/
				/*else
				{
					$from_date_m=date('Y-m-01');
					$to_date_m=date('Y-m-t');
					if($this->monthly_autoship($ref_id1,$from_date_m,$to_date_m)>=20)
					{
						$quick_bonus1=$pep*35/100;
						$level_com1="INSERT INTO `level_income_bonus` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$ref_id1', '$cnt', '$quick_bonus1', curdate(), '', '0','0', '$invoice_amt', '35', '$pep', '', '','$cdid','Quick Start Bonus','Get Quick Start Bonus from user $user_id of invoice $invoice_no','$user_level');";
						//echo $level_com;exit;
						mysql_query($level_com1);
					}
				}*/
			/*}*/  
		/*}*/	
		
	if($user_rank>0)
	{
		while($r!='cmp')
		{
			//echo "select user_id, $nom_id_col ,$ref_id_col,user_type from registration where user_id='$l'"; echo "<br>";
			if($r!='')
			{
				$sltnom=mysql_query("select * from registration where user_id='$r'");
				$fetchnom=mysql_fetch_array($sltnom);
				
				$r=$fetchnom['ref_id'];
				$com_id=$fetchnom['user_id'];
				$mem_status=$fetchnom['mem_status'];
				if($mem_status==0 && $fetchnom['user_rank']>0)
				{
					if($fetchnom['user_rank']>0 && $fetchnom['user_rank']<5)
					{
						$buyer_per=$arr_com[$cnt];
					}
					else if($fetchnom['user_rank']>4 && $fetchnom['user_rank']<7)
					{
						$buyer_per=$arr_com1[$cnt];
					}
					else if($fetchnom['user_rank']>6 && $fetchnom['user_rank']<8)
					{
						$buyer_per=$arr_com2[$cnt];
					}
					if($fetchnom['user_rank']==1 || $fetchnom['user_rank']==2)
					{
						$monthly_autoship=20;
						$level=3;
					}
					if($fetchnom['user_rank']==3)
					{
						$monthly_autoship=25;
						$level=4;
					}
					if($fetchnom['user_rank']==4)
					{
						$monthly_autoship=30;
						$level=5;
					}
					if($fetchnom['user_rank']==5)
					{
						$monthly_autoship=50;
						$level=6;
					}
					if($fetchnom['user_rank']==6)
					{
						$monthly_autoship=100;
						$level=7;
					}
					if($fetchnom['user_rank']==7)
					{
						$monthly_autoship=150;
						$level=7;
					}
					$buyer_cashback=$pep*$buyer_per/100;
					$from_date_m=date('Y-m-01');
					$to_date_m=date('Y-m-t');
					/*if($this->monthly_autoship($user_id,$from_date_m,$to_date_m)>=$monthly_autoship)
					{*/
						if($cnt<=$level)
						{
							$level_com="INSERT INTO `level_income` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`,`generation`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$com_id', '$cnt','$level', '$buyer_cashback', curdate(), '', '0','0', '$invoice_amt', '$buyer_per', '$pep', '', '','$cdid','Leadership Bonus','Get Leadership Bonus from level $cnt','$user_level');";
							//echo $level_com."==".$level."<=".$cnt;
							//echo "<br>";
							mysql_query($level_com);
						}
					/*}*/
				}
			}
			if($cnt==$generation){break;}
			$cnt++;
		}
	  }
	 // exit;
	}
	function bonus_develope_distribution($user_id,$pep,$invoice_no,$invoice_amt)
	{
		
		$arr_com=array('','4','3','3','2','1');
		$curdate=date('Y-m-d');
		$sql1="select user_id,nom_id,ref_id,user_type,user_rank from registration where user_id='$user_id'";
		$res1=mysql_query($sql1);
		$row1=mysql_fetch_assoc($res1);
		$nom_id1=$row1['nom_id'];
		$ref_id1=$row1['ref_id'];
		$cnt=1;
		$l=$nom_id1;
		$r=$ref_id1;
		$user_rank=$row1['user_rank'];
		if($user_rank==1 || $user_rank==2)
		{
		$generation=1;
		}
		if($user_rank==3)
		{
		$generation=2;
		}
		if($user_rank==4)
		{
		$generation=3;
		}
		if($user_rank==5)
		{
		$generation=4;
		}
		if($user_rank==6)
		{
		$generation=5;
		}
		if($user_rank==7)
		{
		$generation=5;
		}
		while($r!='cmp')
		{
			//echo "select user_id, $nom_id_col ,$ref_id_col,user_type from registration where user_id='$l'"; echo "<br>";
			if($r!='')
			{
				$sltnom=mysql_query("select * from registration where user_id='$r'");
				$fetchnom=mysql_fetch_array($sltnom);
				$r=$fetchnom['ref_id'];
				$com_id=$fetchnom['user_id'];
				$mem_status=$fetchnom['mem_status'];
				if($mem_status==0)
				{
					$buyer_per=$arr_com[$cnt];
					$buyer_cashback=$pep*$buyer_per/100;
					if($fetchnom['user_rank']==1)
					{
						$monthly_autoship=20;
					}
					if($fetchnom['user_rank']==2)
					{
						$monthly_autoship=20;
					}
					if($fetchnom['user_rank']==3)
					{
						$monthly_autoship=25;
					}
					if($fetchnom['user_rank']==4)
					{
						$monthly_autoship=30;
					}
					if($fetchnom['user_rank']==5)
					{
						$monthly_autoship=50;
					}
					if($fetchnom['user_rank']==6)
					{
						$monthly_autoship=100;
					}
					if($fetchnom['user_rank']==7)
					{
						$monthly_autoship=150;
					}
					
					if($user_rank==$fetchnom['user_rank'])
					{
						$from_date_m=date('Y-m-01');
						$to_date_m=date('Y-m-t');
						/*if($this->monthly_autoship($user_id,$from_date_m,$to_date_m)>=$monthly_autoship)
						{*/
							$level_com="INSERT INTO `level_income_admin` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`,`generation`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$com_id', '$cnt','$level', '$buyer_cashback', curdate(), '', '0','0', '$invoice_amt', '$buyer_per', '$pep', '', '','$cdid','Developement Bonus','Get Developement Bonus from level $cnt','$user_level');";
							//echo $level_com;
							mysql_query($level_com);
						/*}*/
					}
				}
			}
			if($cnt==$generation){break;}
			$cnt++;
		}	
	}
	function rank_bonus($user_id,$user_rank)
	{
		
		if($user_rank==3)
		{
			$rb=60;
		}
		else if($user_rank==4)
		{
			$rb=250;
		}
		else if($user_rank==5)
		{
			$rb=500;
		}
		else if($user_rank==6)
		{
			$rb=1000;
		}
		else if($user_rank==7)
		{
			$rb=1500;
		}
		else
		{
			$rb=0;
		}
		if($rb)
		{
			$level_com="INSERT INTO `level_income_rank` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`,`generation`, `commission`, `date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$user_id', '$cnt','$level', '$rb', curdate(), '0','0', '$pep', '$eachuplines_per', '', '', '','$cdid','Rank Bonus','Get Rank Bonus from rank  $user_rank','$user_rank');";
			//echo $level_com; exit;
			mysql_query($level_com);
		}
	}
	function car_bonus($user_id)
	{
		
		$from_date=date('Y-m-01');
		$to_date=date('Y-m-t');
		$monthly_purchasing=$this->monthly_purchasing($user_id,$from_date,$to_date);
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		$rank=$row['user_rank'];
		if($rank==7 && $monthly_purchasing>=20000)
		{
			$car_bonus=600;
		}
		else if($rank==6 && $monthly_purchasing>=16000)
		{
			$car_bonus=480;
		}
		else if($rank==5 && $monthly_purchasing>=8000)
		{
			$car_bonus=240;
		}
		else if($rank==4 && $monthly_purchasing>=6000)
		{
			$car_bonus=180;
		}
		else if($rank==3 && $monthly_purchasing>=6000)
		{
			$car_bonus=120;
		}
		else if(($rank==2 || $rank==1) && $monthly_purchasing>=6000)
		{
			$car_bonus=60;
		}
		else
		{
			$car_bonus=0;
		}
		if($car_bonus)
		{
			if($this->commulative_from_one_leg($user_id))
			{
			$level_com="INSERT INTO `level_income_car` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$user_id', '$cnt', '$car_bonus', curdate(), '', '0','0', '$pep', '$eachuplines_per', '', '', '','$cdid','Car Bonus','Get Car Bonus from level $cnt','$user_level');";
			//echo $level_com;
			//exit;
			//echo "<br>";
			mysql_query($level_com);
			}
		}
	}
	function pool_bonus($user_id)
	{
		$from_date=date('01-m-d');
		$to_date=date('t-m-d');
		$team_purchasing=$this->monthly_purchasing($user_id,$from_date,$to_date);
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		$rank=$row['user_rank'];
		if($team_purchasing>=40000)
		{
			$car_bonus=1965;
		}
		else if($team_purchasing>=30000)
		{
			$car_bonus=1465;
		}
		else if($team_purchasing>=25000)
		{
			$car_bonus=1165;
		}
		else if($team_purchasing>=15000)
		{
			$car_bonus=885;
		}
		else if($team_purchasing>=12000)
		{
			$car_bonus=465;
		}
		else if($team_purchasing>=8000)
		{
			$car_bonus=305;
		}
		else if($team_purchasing>=5000)
		{
			$car_bonus=175;
		}
		else if($team_purchasing>=3000)
		{
			$car_bonus=100;
		}
		else if($team_purchasing>=1000)
		{
			$car_bonus=30;
		}
		else
		{
			$car_bonus=0;
		}
		if($car_bonus)
		{
			if($this->commulative_from_one_leg($user_id))
			{
			$level_com="INSERT INTO `level_income_p` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`,`generation`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$user_id', '$cnt','$level', '$car_bonus', curdate(), '', '0','0', '$pep', '$eachuplines_per', '', '', '','$cdid','Pool Bonus','Get Pool Bonus from level $cnt','$user_level');";
			//echo $level_com;
			mysql_query($level_com);
			}
		}
	}
	function performance_bonus($user_id)
	{
		$from_date=date('01-m-d');
		$to_date=date('t-m-d');
		$team_purchasing=$this->monthly_purchasing($user_id,$from_date,$to_date);
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		$rank=$row['user_rank'];
		if($team_purchasing>=40000)
		{
			$car_bonus=1965;
		}
		else if($team_purchasing>=30000)
		{
			$car_bonus=1465;
		}
		else if($team_purchasing>=25000)
		{
			$car_bonus=1165;
		}
		else if($team_purchasing>=20000)
		{
			$car_bonus=885;
		}
		else if($team_purchasing>=15000)
		{
			$car_bonus=645;
		}
		else if($team_purchasing>=12000)
		{
			$car_bonus=465;
		}
		else if($team_purchasing>=8000)
		{
			$car_bonus=305;
		}
		else if($team_purchasing>=5000)
		{
			$car_bonus=175;
		}
		else if($team_purchasing>=3000)
		{
			$car_bonus=100;
		}
		else if($team_purchasing>=1000)
		{
			$car_bonus=30;
		}
		else
		{
			$car_bonus=0;
		}
		if($car_bonus)
		{
			if($this->commulative_from_one_leg($user_id))
			{
			$level_com="INSERT INTO `level_income_pool` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`,`generation`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$user_id', '$cnt','$level', '$car_bonus', curdate(), '', '0','0', '$pep', '$eachuplines_per', '', '', '','$cdid','Performance  Bonus','Get Performance  Bonus ','$user_level');";
			//echo $level_com;
			mysql_query($level_com);
			}
		}
	}
	function commission_distribute($ref,$nom,$user_id,$plan_name,$user_level)
	{
		//echo $ref.','.$nom.','.$user_id.','.$plan_name;
		$generation=6;
		$curdate=date('Y-m-d');
		$bonus1=50; // one time bonus if meber bring 5 person in 30 days     
		#level complete bonus
		$arr_lc_com=array(0,0,8.75,68.75,562.50,4687.50,39068.50);
		$arr_com=array(0,0.35,0.35,0.55,0.90,1.50,2.50);
		# commission according to nom_id standard income
		$sql1="select user_id,nom_id,ref_id,user_type from registration where user_id='$user_id'";
		$res1=mysql_query($sql1);
		$row1=mysql_fetch_assoc($res1);
		$nom_id1=$row1['nom_id'];
		$ref_id1=$row1['ref_id'];
		$cnt=1;
		$l=$nom_id1;
		$r=$ref_id1;
		
		while($l!='cmp')
		{
			//echo "select user_id, $nom_id_col ,$ref_id_col,user_type from registration where user_id='$l'"; echo "<br>";
			if($l!='')
			{
			//echo "select * from registration where user_id='$l'";
				$sltnom=mysql_query("select * from registration where user_id='$l'");
				$fetchnom=mysql_fetch_array($sltnom);
				
				$l=$fetchnom['nom_id'];
				$com_id=$fetchnom['user_id'];
				$mem_status=$fetchnom['mem_status'];
				if($mem_status==0)
				{
					$five_direct=$this->five_direct_condition($com_id);
					$level_complete=$this->level_complete($com_id,$cnt);
					$level=$cnt-1;
					if($five_direct && $fetchnom['bonus']==0)
					{
						//$bonus1;
						/*$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$bonus1) where user_id='$com_id'");
						$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$com_id','$bonus1','0','$com_id','$user_id','$curdate','','Quick Start Bonus of ($50) when you enroll your first five (5) personal families or friends Member within thirty (30) days of your Start Date.','','Quick Start Bonus of ($50) when you enroll your first five (5) personal families or friends Member within thirty (30) days of your Start Date.','','$five_direct','1')");
						$cdid=mysql_insert_id();*/
						$level_com="INSERT INTO `level_income_bonus` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$com_id', '$cnt', '$bonus1', curdate(), '', '0','0', '$plan_name', '$eachuplines_per', '', '', '','$cdid','30 days bonus','Get Bonus To bring Five People Within 30 days','$user_level');";
						//echo $level_com;
						mysql_query($level_com);
						$update="update registration set bonus='$bonus1',bonus_date=curdate() where user_id='$com_id'";
						mysql_query($update);
					}
					if($level_complete)
					{
						//$buyer_cashback=$arr_lc_com[$cnt];
						$buyer_cashback=$arr_com[$cnt];
						$cashbackstatus11=1;
						$this->check_level_count_paid($com_id,$cnt,$level,$user_id,$user_level);
					}
					
					else
					{
						$buyer_cashback=$arr_com[$cnt];
					}
					//echo $plan_status.'=='.$plan.'=='.$five_direct.'=='.$buyer_cashback."<br>";exit;
					if($buyer_cashback>0 && $cnt>1 && $com_id!=1234568)
					{
						/*if($cashbackstatus11==1)
						{
							$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$buyer_cashback) where user_id='$com_id'");
							$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$com_id','$buyer_cashback','0','$com_id','$user_id','$curdate','','$Remark','','$Remark','','$cashbackstatus11','1')");
							$cdid=mysql_insert_id();
						}*/
						
						$total_c=$total_c+$buyer_cashback;
						$level_com="INSERT INTO `level_income` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`,`generation`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', '$com_id', '$cnt','$level', '$buyer_cashback', curdate(), '', '0','0', '$plan_name', '$eachuplines_per', '', '', '','$cdid','Level Complete Bonus','Get Membership Bonus from level $level','$user_level');";
						//echo $level_com;
						mysql_query($level_com);
					}
				} // end of status
			
			$arr_com_id[]=$com_id;	
			}
			//echo $com_id;
			
			# condition for upgrade plan 

			if($cnt==$generation){break;}
			$cnt++;
		}
		#end commission according to nom_id
		
		
		#end additional commission according to ref_id
		
		# start to check user level commission unpaid and make user to upgrade
	}
	
	function commission_ref($ref,$user_id,$plan_name,$transaction_no)
	{
		//echo $ref.','.$nom.','.$user_id.','.$plan_name;
		$remark="Direct Commission On Refferal Of Level ";
		$generation=3;
		$curdate=date('Y-m-d');
		$bonus_arr=array('','50','20','10'); // one time bonus if meber bring 5 person in 30 days     
		#level complete bonus
			
		# commission according to nom_id standard income
		$sql1="select user_id, nom_id,ref_id,user_type from registration where user_id='$user_id'";
		$res1=mysql_query($sql1);
		$row1=mysql_fetch_assoc($res1);
		$nom_id1=$row1['nom_id'];
		$ref_id1=$row1['ref_id'];
		$cnt=1;
		$l=$nom_id1;
		$r=$ref_id1;
		while($r!='cmp')
		{
			$sltnom=mysql_query("select * from registration where user_id='$r'");
			$fetchnom=mysql_fetch_array($sltnom);
			$r=$fetchnom['ref_id'];
			$com_id=$fetchnom['user_id'];
			$mem_status=$fetchnom['mem_status'];
		
			$bonus1=$bonus_arr[$cnt];
			$Remark=$remark.$cnt;
			/*$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$bonus1) where user_id='$com_id'");
			$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$com_id','$bonus1','0','$com_id','$user_id','$curdate','','Get Bonus To bring Five People Within 30 days','','Get Bonus To bring Five People Within 30 days','','$five_direct','1')");
			$cdid=mysql_insert_id();*/
			$level_com="INSERT INTO `level_income_admin` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$transaction_no', '$user_id', '$com_id', '$cnt', '$bonus1', '$curdate', '', '$cashbackstatus11','$cashbackstatus11', '$plan_name', '$eachuplines_per', '', '', '','$cdid','Direct Sponser from $user_id','$Remark','$user_level');";
			//echo $level_com;exit;
			mysql_query($level_com);
			if($cnt==$generation){break;}
			$cnt++;
		}
	}
	
	function commission_ref_guru($ref,$nom,$user_id,$plan_name,$user_level)
	{
		//echo $ref.','.$nom.','.$user_id.','.$plan_name;
		$generation=6;
		$curdate=date('Y-m-d');
		$bonus1=3; // one time bonus if meber bring 5 person in 30 days     
		#level complete bonus
			
		# commission according to nom_id standard income
		$sql1="select user_id, nom_id,ref_id,user_type from registration where user_id='$user_id'";
		$res1=mysql_query($sql1);
		$row1=mysql_fetch_assoc($res1);
		$nom_id1=$row1['nom_id'];
		$ref_id1=$row1['ref_id'];
		$cnt=1;
		$l=$nom_id1;
		$r=$ref_id1;
		
		/*$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$bonus1) where user_id='$ref_id1'");
		$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$ref_id1','$bonus1','0','$ref_id1','$user_id','$curdate','','Get Bonus To bring Five People Within 30 days','','Get Bonus To bring Five People Within 30 days','','$five_direct','1')");
		$cdid=mysql_insert_id();*/
		$level_com="INSERT INTO `level_income_admin` (`l_id`, `invoice_no`, `purcheser_id`, `income_id`, `level`, `commission`, `date`, `payout_date`, `status`,`paid_status`, `invoice_amt`, `com_percent`, `invoice_bv`, `commission_bv`, `closing`,`credit_debit_id`,`section`,`remark`,`user_level`) VALUES (NULL, '$invoice_no', '$user_id', 'guru', '$cnt', '$bonus1', '$curdate', '', '$cashbackstatus11','$cashbackstatus11', '$plan_name', '$eachuplines_per', '', '', '','$cdid','Direct Sponser','Get Direct Sponser Benifit(Affiliate Refferal)','$user_level');";
					//echo $level_com;
		mysql_query($level_com);
	}
	
	function five_direct_condition($user_id)
	{
		
		$sql1="select * from registration where user_id='$user_id' ";
		$res1=mysql_query($sql1);
		$count1=mysql_num_rows($res1);
		$row1=mysql_fetch_assoc($res1);
		$reg_date=$row1['reg_date'];
		$days=30;
		$reg_30date=date('Y-m-d',strtotime("+".$days." days", strtotime($reg_date)));
		$sql1="select id from registration where nom_id='$user_id' and reg_date<='$reg_30date'";
		$res1=mysql_query($sql1);
		$count1=mysql_num_rows($res1);
		if($count1>=5)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	
	function level_complete($com_id,$cnt)
	{
		$target=pow(5,$cnt);
		$curdate=date('Y-m-d H:i:s');
		$sql="select distinct income_id from level_income where income_id='$com_id' and level='$cnt' and section='Level Complete Bonus' ";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>=$target)
		{
			return true	;
		}
		else
		{
			return false;
		}
	}
	
	function check_level_count_paid($com_id,$cnt,$level,$user_id,$user_level)
	{
		
		$curdate=date('Y-m-d H:i:s');
		$sql1="select * from level_income where income_id='$com_id' and level='$cnt' and status=0 and paid_status=0";
		$res1=mysql_query($sql1);
		while($row=mysql_fetch_assoc($res1))
		{
			$buyer_cashback=$row['commission'];
			$user_id=$row['purcheser_id'];
			$Remark=$row['remark'];
			$l_id=$row['l_id'];
			/*$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$buyer_cashback) where user_id='$com_id'");
			$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$com_id','$buyer_cashback','0','$com_id','$user_id','$curdate','','$Remark','','$Remark','','1','1')");*/
			//$cdid=mysql_insert_id();
			$update_paid="update level_income set status=1 where l_id='$l_id'";
			mysql_query($update_paid);
			$commission=$commission+$buyer_cashback;
		}
	mysql_query("insert into level_income_total set invoice_no='$invoice_no',purcheser_id='$user_id',income_id='$com_id',level='$cnt',generation='$level ',commission='$commission',date='$curdate',status=1,paid_status=1,section='Level Complete Commission',remark='Get Level Complete Commission On Complete of Level $generation',user_level='$user_level'");				
	}
	
	function _update_group_volume($user_id,$tot,$product_volume,$invoice_no)
	{
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		$ref=$row_user['ref_id'];
		$user_plan=$row_user['user_plan'];
		$arr_desig=array("Representative"=>100,"Executive"=>100,"Manager"=>100);
		$tot_amt=$tot*$arr_desig[$row_user['user_plan']]/100;
	
		mysql_query("update final_bv set personal_purch=(personal_purch+'$tot'),ppurch_befr_affiliation=(ppurch_befr_affiliation+'$tot'),bv=(bv+'$product_volume'),monthly_tpv=(monthly_tpv+'$tot'),monthly_ppv=(monthly_ppv+'$tot'),tbv=(tbv+'$product_volume'),rank_pv=(rank_pv+$tot) where user_id='$user_id'");
		mysql_query("insert into purchase_history set invoice_no='$invoice_no',purcheser_id='$user_id', income_id='$user_id',level=0,commission='',date=curdate(),invoice_amt='$tot',com_percent='',invoice_bv='$product_volume',closing='',status=0"); 
		//Entry for level 
		$l=1;
		while($ref!='cmp')
		{
			$selectnompos=mysql_query("select * from registration where user_id='$ref'");
			$fetchnompos=mysql_fetch_array($selectnompos);
			$ref=$fetchnompos['ref_id'];
			$com_id=$fetchnompos['user_id'];
			if($com_id!='cmp' && $com_id!='')
			{
				$tot_amt1=$tot*$arr_desig[$fetchnompos['user_plan']]/100;
				mysql_query("insert into purchase_history set invoice_no='$invoice_no',purcheser_id='$user_id', income_id='$com_id',level=$l,commission='',date=curdate(),invoice_amt='$tot',com_percent='',invoice_bv='$product_volume',closing='',status=0"); 
				mysql_query("update final_bv set team_purch=(team_purch+'$tot'),tpurch_befr_affiliation=(tpurch_befr_affiliation+'$tot'),bv=(bv+'$product_volume'),tbv=(tbv+'$product_volume'),bv=(bv+'$product_volume'),tbv=(tbv+'$product_volume'),monthly_tpv=(monthly_tpv+'$tot'),monthly_ppv=(monthly_ppv+'$tot'),tbv=(tbv+'$product_volume'),rank_pv=(rank_pv+$tot) where user_id='$com_id'");
				$this->_upgrade_user_rank($com_id);
			}
			if($l==7){break;}
			$l++;
		}
	}
	function _update_group_volume_mb($user_id,$tot,$product_volume,$invoice_no)
	{
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		$ref=$row_user['ref_id'];
		$user_plan=$row_user['user_plan'];
		$arr_desig=array("Representative"=>100,"Executive"=>100,"Manager"=>100);
		$tot_amt=$tot*$arr_desig[$row_user['user_plan']]/100;

		mysql_query("insert into purchase_history_mb set invoice_no='$invoice_no',purcheser_id='$user_id', income_id='$ref',level=0,commission='',date=curdate(),invoice_amt='$tot',com_percent='',invoice_bv='$product_volume',closing='',status=0"); 
		//Entry for level 
	}
	function merchant_bonus_distribution($user_id,$total_volume1,$invoice_no,$tot)
	{
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		$ref=$row_user['ref_id'];
		$commission=$total_volume1*10/100;
		mysql_query("insert into level_income_total set invoice_no='$invoice_no',purcheser_id='$user_id', income_id='$ref',level=0,commission='$commission',date=curdate(),invoice_amt='$tot',com_percent='10',invoice_bv='$total_volume1',closing='',status=0,remark='Get Merchant Bonus'"); 
		//Entry for level 
	}
}

class SpillOver
{
	function get_five_person($user_id)
	{
		$sql="select * from registration where nom_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>=5)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_twenty_reserve($user_id)
	{
		$sql="select * from reserve_member where receiver_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>=20)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function set_twenty_reserve($ref,$user_id)
	{
		$curdate=date('Y-m-d H:i:s');
		$insert="insert into reserve_member set user_id='$ref',receiver_id='$ref',member_id='$user_id',add_date='$curdate'";
		mysql_query($insert);
	}
}

class Closing
{
	function _set_closing($from_date,$to_date,$table,$closing_no)
	{
		$curdate=date('Y-m-d');
		# set closing according to from and to date of a specific table.
		$sql="select * from $table where status in (0,1,2) and paid_status in (0,1,2) and `date` between '$from_date' and '$to_date'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count)
		{
			while($row=mysql_fetch_assoc($res))
			{
				$l_id=$row['l_id'];
				$income_id=$row['income_id'];
				$purcheser_id=$row['purcheser_id'];
				$commission=$row['commission'];
				$remark=$row['remark'];
				// check income member status
				$sql_user="select * from registration where user_id='$income_id' and mem_status=0";
				$res_user=mysql_query($sql_user);
				$count_user=mysql_num_rows($res_user);
				if($count_user || $income_id=='guru')
				{
					//start insert amount into user final ewallet
					$insert_wallet="update final_e_wallet set amount=amount+$commission where user_id='$income_id'";
					mysql_query($insert_wallet);
					//end insert amount into user final ewallet
					//start insert amount into user credit debit history
					$insert_crdr="insert into credit_debit set user_id='$income_id',receiver_id='$income_id',sender_id='$purcheser_id',credit_amt='$commission',debit_amt='0',receive_date='$curdate',TranDescription	='$remark',Remark='$remark'";
					//mysql_query($insert_crdr);
					//end insert amount into user credit debit history
					
					//start update commission to paid
					$update_com_paid="update $table set status=2 , paid_status=2 , closing='$closing_no',payout_date='$curdate' where l_id='$l_id'";
					mysql_query($update_com_paid);
					//start update commission to paid
					
				}// end of user status 
			}// end of commission while loop
		}// end of commission counting if
	// end of the _set_closing function 
	}
}