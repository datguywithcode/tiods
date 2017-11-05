<?php
class Representative extends Mysql_Func 
{
	function __construct()
	{
	
		$this->Connect(HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	}
	
	function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'registration';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select user_id from $table_name where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	function spill($sponserid)
	{
		global $nom_id1,$lev;
		foreach($sponserid as $key => $val)
		{
			$query1="select * from registration where nom_id='$val' order by id";
			$result1=mysql_query($query1);
			$num_ro1[]=mysql_num_rows($result1);
			while($row=mysql_fetch_array($result1))
			{
				$rclid1[]=$row['user_id'];
			}
		}
		foreach($num_ro1 as $key11 => $valu)
		{
			if($valu<5)
			{
			$key1=$key11;
			break;
			}
		}
			
		   switch ($valu)
		   {
		   case '0':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
		  // print "a";
			   break;
		   case '1':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
				case '2':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
				case '3':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
			 
			  case '4':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
			   
			   case '5':
		   
		if(!empty($nom_id1))
		{
		 break;
		}
			spill($rclid1);
		//$lev++;
		}
		return $nom_id1;
	}
	function spill_id1($sponserid,$posi)
	{
		global $nom_id;
		$query1="select * from registration where nom_id='$sponserid' and binary_pos='$posi'";
		$result1=mysql_query($query1);
		$row=mysql_fetch_array($result1);
		$rclid1=$row['user_id'];
		//print $rclid1;
		if($rclid1!="")
		{
		$this->spill_id1($rclid1,$posi);
		}
		else
		{
		$nom_id=$sponserid;
		
		}
		//print $spill_id;
		 
		return $nom_id;
	}
	function showuserid($user_name)
	{
		$sql="select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$result=mysql_query($sql);
			if(mysql_num_rows($result)>0)
			{
				$row=mysql_fetch_assoc($result);
				return $row['user_id'];
			}
	}
	function checkuser($user_name)
	{
	 //echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$checkid=mysql_query("select user_id from registration where user_name='$user_name' or user_id='$user_name'");
			if(mysql_num_rows($checkid)>0)
			{
				return false;
			}
			else
				return true;
	}
	function checkuser_with_id($user_name,$user_id)
	{
	 //echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$checkid=mysql_query("select user_id from registration where user_name='$user_name' and user_id='$user_id'");
			if(mysql_num_rows($checkid)>0)
			{
				return false;
			}
			else
				return true;
	}
	function _user_registration()
	{
		//echo "<pre>"; print_r($_POST); exit;	
		// check sponsor 
		
		$table_name=TABLE_PREFIX.'registration';
		$curdate=date('Y-m-d H:i:s');
		$user_id=$this->userid();
		//$ref_id=$this->showuserid($_POST['sp_name']);
		if(!isset($_POST['sp_name']) || $_POST['sp_name']=='')
		{
			// find the placement id of the 1234567
			// check the default reg sponsor
			$res_ds=$this->query("user_id","registration","show_reg_page=1");
			$row_ds=$this->get_all_row($res_ds);
			if($row_ds['user_id']!='')
			{
				$ref_id123=$row_ds['user_id'];
			}
			else
			{
				$ref_id123=1234567;
			}
		}
		else
		{
			$ref_id123=$this->showuserid($_POST['sp_name']);
		}
			$res_p=$this->query("placement_id,placement_id_status","registration","user_id='$ref_id123'");
			$row_p=$this->get_all_row($res_p);
			if($row_p['placement_id']!='' && $row_p['placement_id_status'])
			{
				$ref_id_temp=$row_p['placement_id'];
				$ref_id=$ref_id123;
			}
			else
			{
				$ref_id=$ref_id123;
			}
		$posi=$_POST['position'];
		// check sponsor and user
		if(!$this->checkuser($ref_id) && $this->checkuser($_POST['user_name']))
		{
			$inser_array=
			array(
				"user_id"=>$user_id,
				"ref_id"=>$ref_id,
				"nom_id"=>$nom_id,
				"user_name"=>$_POST['user_name'],
				"user_pass"=>$_POST['user_pass'],
				"binary_pos"=>$posi,
				"first_name"=>$_POST['first_name'],
				"last_name"=>$_POST['last_name'],
				"email"=>$_POST['email'],
				"address1"=>$_POST['adress1'],
				"address2"=>$_POST['adress2'],
				"city"=>$_POST['city'],
				"country"=>$_POST['country'],
				"phoner"=>$_POST['phone'],
				"zip"=>$_POST['zip'],
				"power_leg"=>'left',
				"power_status"=>1,
				"reg_date"=>$curdate,
				"mem_status"=>0);
		$this->insert_tbl($inser_array,$table_name);	
		/*$nom_id=$this->spill_id1($ref_id,$posi);
		$nom=$nom_id;
		$pos=$posi;
		$l=1;
		while($nom!='cmp')
		{
			if($nom!='cmp')
			{
			mysql_query("insert into level_income set invoice_no='$newID',purcheser_id='$user_id',income_id='$nom',level='$l',commission='',date=curdate(),invoice_amt='$plan_name',com_percent='',invoice_bv='$bv',closing='',status=0, position='$pos'"); 
			
			}
			$selectnompos=mysql_query("select binary_pos, nom_id from registration where user_id='$nom' ");
			$fetchnompos=mysql_fetch_array($selectnompos);
			$pos=$fetchnompos['binary_pos'];
			$nom=$fetchnompos['nom_id'];
			$l++;
		}
		mysql_query("update registration set nom_id='$nom_id' where user_id='$user_id'");*/
		$_SESSION['SD_User_Name']=$_POST['user_name'];
		$_SESSION['SD_User_ID']=$user_id;
		$_SESSION['SD_User_Type']='';	
		header("Location:userpanel/index.php");
		}
		else
		{
			header("Location:register.php?msg=Wrong Username or Wrong Sponser Detail");
		}
	}
	
	function _newsletter()
	{
		//echo "<pre>"; print_r($_POST);
		$insert_arr=array("email"=>$_POST['EMAIL']);
		$table_name=TABLE_PREFIX.'newsletter';
		$this->insert_tbl($inser_array,$table_name);
		header("Location:".$_POST['return_page']);
	}
	function _password_request()
	{
		//echo "<pre>"; print_r($_POST);
		// check username 
		$result=$this->query("*",TABLE_PREFIX.'admin',"userid='$_POST[username]'");
		$count_user=$this->num_row($result);
		$flag=0;
		if($count_user)
		{
			$curdate=date('Y-m-d H:i:s');
			$table_name=TABLE_PREFIX.'password_request';
			$inser_array=
			array(
				"username"=>$_POST['username'],
				"request_date"=>$curdate,"reset_password"=>0);
			$this->insert_tbl($inser_array,$table_name);
			$msg="Request Sent To Admin Successfully.";
			$flag=1;
		}
		else
		{
			$msg="Request Cannot Sent. Please Check Your Username";
			$flag=0;
		}
		if($_POST['return_page'])
		{
			$page_name=$_POST['return_page'];
		}
		else
		{
			$page_name='index.php';
		}
		header("Location:".$page_name."?msg=".$msg."&password=true&change=".$flag);
	}
		
	function _edit_user_detail()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name=TABLE_PREFIX.'registration';
		$flag==false;
		foreach($_POST as $key=>$val)
		{
			if($key=='bonus')
			{
				$flag=true;
			}
			if($key=='submit' || $key=='user_id')
			{
			}
			else
			{
				// check for country and user_name
				if($key=='country' && $val=='')
				{
				}
				else if($key=='user_name' && !$this->checkuser($val) && !$this->checkuser_with_id($user_name,$user_id) )
				{
				
				}
				else if($key=='user_name' && !$this->checkuser($val))
				{
				
				}
				else
				{
					$update_arr[$key]=$val;
				}
			}
		}
		$user_id=$_POST['user_id'];
		//print_r($update_arr); exit;
		$where=" user_id='$user_id'";
		$this->update_tbl($update_arr,$table_name,$where);
		
		if($flag && $_POST['bonus'])
		{
			$bonus_date=date('Y-m-d');
			$Date=$bonus_date;
			$expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));
			$this->query_execute("update registration set bonus=1,bonus_date='$bonus_date' where user_id='$user_id'");
			$this->query_execute("update subscription set status=1 where user_id='$user_id'");
$this->query_execute("insert into subscription set order_no='Admin',user_id='$user_id',subs_fee='160',payment_mode='From Admin',subs_date='$bonus_date',end_date='$expire_date'");

			$sql_check="select * from subscription where user_id='$user_id'";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check==1)
			{
				// get user sponsor and position
				$sql_user="select * from registration where user_id='$user_id'";
				$res_user=mysql_query($sql_user);
				$row_user=mysql_fetch_assoc($res_user);
				$ref_id=$row_user['ref_id'];
				// get sponsor power leg
				$sql_ref_leg="select power_leg from registration where user_id='$ref_id'";
				$res_ref_leg=mysql_query($sql_ref_leg);
				$row_ref_leg=mysql_fetch_assoc($res_ref_leg);
				$posi=$row_ref_leg['power_leg'];
				
				if($ref_id!='cmp')
				{
					$nom_id=$this->spill_id1($ref_id,$posi);
					
					$nom=$nom_id;
					$pos=$posi;
					//echo $nom.'='.$ref_id.'='.$posi;exit;
					$l=1;
					while($nom!='cmp')
					{
						if($nom!='cmp')
						{
							mysql_query("insert into level_income set invoice_no='$newID',purcheser_id='$user_id',income_id='$nom',level='$l',commission='',date=curdate(),invoice_amt='$amount',com_percent='',invoice_bv='$bv',closing='',status=0, position='$pos'"); 
						}
						$selectnompos=mysql_query("select binary_pos, nom_id from registration where user_id='$nom' ");
						$fetchnompos=mysql_fetch_array($selectnompos);
						$pos=$fetchnompos['binary_pos'];
						$nom=$fetchnompos['nom_id'];
						$l++;
					}
					mysql_query("update registration set nom_id='$nom_id',binary_pos='$posi',power_status='1',power_leg='left' where user_id='$user_id'");
				}
				// get product volume in the member package
			}
		}
		header("Location:admin_main.php?page_number=2&update=1&userid=".$user_id);
	}
	/*function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'registration';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select user_id from $table_name where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	
	function checkuser($user_name)
	{
	 //echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$checkid=mysql_query("select user_id from registration where user_name='$user_name' or user_id='$user_name'");
			if(mysql_num_rows($checkid)>0)
			{
				return false;
			}
			else
				return true;
	}*/
	
	function _new_registration()
	{
		//echo "<pre>"; print_r($_POST);exit;
		// get sponsor id
		$sp_name=$_POST['sp_name'];
		$res_sp=$this->query("*","registration","user_name='$sp_name' or user_id='$sp_name'");
		$count_sp=$this->num_row($res_sp);
		if($count_sp)
		{
			$row_sp=$this->get_all_row($res_sp);
			$ref_id=$row_sp['user_id'];
			$update_arr['ref_id']=$ref_id;
			if($row_sp['placement_id']!='' && $row_sp['placement_id_status'])
			{
				$update_arr['ref_id_temp']=$row_sp['placement_id'];
			}
			
		}
		else if($sp_name=='cmp')
		{
			$ref_id=$sp_name;
			$update_arr['ref_id']=$sp_name;
			$update_arr['nom_id']=$sp_name;
		}
		else
		{
			header("Location:admin_main.php?page_number=154&msg=wrong sponsor&update=1&userid=".$user_id);exit;
		}
		$curdate=date('Y-m-d H:i:s');
		$user_id=$this->userid();
		$update_arr['user_id']=$user_id;
		$update_arr['reg_date']=$curdate;
		$update_arr['power_status']=1;
		//$update_arr['power_leg']='left';
		if((!$this->checkuser($ref_id) && $this->checkuser($_POST['user_name'])) || $ref_id=='cmp')
		{
			$table_name=TABLE_PREFIX.'registration';
			foreach($_POST as $key=>$val)
			{
				if($key=='submit' || $key=='user_id' || $key=='sp_name')
				{
				}
				else
				{
					// check for country and user_name
					/*if($key=='country' && $val=='')
					{
					}
					else if($key=='user_name' && !$this->checkuser($val) && !$this->checkuser_with_id($user_name,$user_id) )
					{
					}
					else if($key=='user_name' && !$this->checkuser($val))
					{
					}
					else
					{*/
						$update_arr[$key]=$val;
					/*}*/
				}
			}
			//$user_id=$_POST['user_id'];
			//print_r($update_arr); exit;
			//$where=" user_id='$user_id'";
			//$this->update_tbl($update_arr,$table_name,$where);
			//echo "<pre>"; print_r($update_arr); exit;
			$this->insert_tbl($update_arr,$table_name);
			$insert_array=array(
						"user_id"=>$user_id,
						"amount"=>'0'
						);
			// add final_e_wallet
			$this->insert_tbl($insert_array,"final_e_wallet");	
			// add final_tp
			$this->insert_tbl($insert_array,"final_tp");	
			// add final_tfs
			$this->insert_tbl($insert_array,"final_tfs");
			header("Location:admin_main.php?page_number=1&update=1&userid=".$user_id);
		}
		else
		{
			header("Location:admin_main.php?page_number=154&msg=Wrong Sponsor or User&update=1&userid=".$user_id);
		}
	}
	function _jump_member()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'registration';
		unset($_POST['search']);
		$bonus_date=date('Y-m-d');
		$Date=$bonus_date;
$expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));
		$res_u=$this->query("user_id","registration","user_name='$_POST[user_name]' or user_id='$_POST[user_name]'");
		$row_u=$this->get_all_row($res_u);
		if($_POST['type']=='affliate')
		{
			//$update_arr['bonus']=1;
			//echo "update registration set bonus=1 where user_id='$row_u[user_id]'";exit;
			$this->query_execute("update registration set bonus=1,bonus_date='$bonus_date' where user_id='$row_u[user_id]'");
			$this->query_execute("update subscription set status=1 where user_id='$row_u[user_id]'");
$this->query_execute("insert into subscription set order_no='Admin',user_id='$row_u[user_id]',subs_fee='160',payment_mode='From Admin',subs_date='$bonus_date',end_date='$expire_date'");
			
			$user_id=$row_u['user_id'];
			
			$sql_check="select * from subscription where user_id='$user_id'";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check==1)
			{
				// get user sponsor and position
				$sql_user="select * from registration where user_id='$user_id'";
				$res_user=mysql_query($sql_user);
				$row_user=mysql_fetch_assoc($res_user);
				$ref_id=$row_user['ref_id'];
				// get sponsor power leg
				$sql_ref_leg="select power_leg from registration where user_id='$ref_id'";
				$res_ref_leg=mysql_query($sql_ref_leg);
				$row_ref_leg=mysql_fetch_assoc($res_ref_leg);
				$posi=$row_ref_leg['power_leg'];
				
				$nom_id=$this->spill_id1($ref_id,$posi);
				if($ref_id!='cmp')
				{
					$nom=$nom_id;
					$pos=$posi;
					//echo $nom.'='.$ref_id.'='.$posi;exit;
					$l=1;
					while($nom!='cmp')
					{
						if($nom!='cmp')
						{
							mysql_query("insert into level_income set invoice_no='$newID',purcheser_id='$user_id',income_id='$nom',level='$l',commission='',date=curdate(),invoice_amt='$amount',com_percent='',invoice_bv='$bv',closing='',status=0, position='$pos'"); 
						}
						$selectnompos=mysql_query("select binary_pos, nom_id from registration where user_id='$nom' ");
						$fetchnompos=mysql_fetch_array($selectnompos);
						$pos=$fetchnompos['binary_pos'];
						$nom=$fetchnompos['nom_id'];
						$l++;
					}
					mysql_query("update registration set nom_id='$nom_id',binary_pos='$posi',power_status='1',power_leg='left' where user_id='$user_id'");
				}
				// get product volume in the member package
			}
		}
		else if($_POST['type']=='reseller')
		{
			//$update_arr['reseller']=1;
			//echo "update registration set reseller=1 where user_id='$row_u[user_id]'";exit;
			$this->query_execute("update registration set reseller=1,reseller_date='$bonus_date' where user_id='$row_u[user_id]'");
			$res_subs_count=$this->query("id","subscription_member","user_id='$row_u[user_id]' and status=0");
				$count_subs_count=$this->num_row($res_subs_count);
				if($count_subs_count)
				{}
				else
				{
				$this->query_execute("update subscription_member set status=1 where user_id='$subs_user_id'");
				$subs_date=date('Y-m-d H:i:s');
				$date = strtotime($subs_date);
				$date = strtotime("+30 day", $date);
				$end_date=date('Y-m-d H:i:s', $date);
				$this->query_execute("insert into subscription_member set status=0,user_id='$subs_user_id',subs_date='$subs_date',end_date='$end_date',cat_duration=cat_duration+1");
				}
		}
		//  get user user_id
		
		/*$where="user_id='$row_u[user_id]'";
		
		echo "<pre>"; print_r($update_arr); exit;
		$this->update_tbl($update_arr,$table_name,$where);*/
		header("Location:admin_main.php?page_number=1&update=1&userid=".$user_id);
	}
	
	function _Set_Placement()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'registration';
		unset($_POST['search']);
		$sql_u=mysql_num_rows(mysql_query("select id from registration where user_id='$_POST[placement_id]'"));
		if($sql_u)
		{
			$this->query_execute("update registration set placement_id=$_POST[placement_id] where user_id='$_POST[user_id]'");
			header("Location:admin_main.php?page_number=158&update=1&userid=".$user_id);
		}
		else
		{
			header("Location:admin_main.php?page_number=158&update=1&userid=".$user_id);
		}
	}
	function _Change_Sponsor()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'registration';
		unset($_POST['search']);
		$sql_u=mysql_num_rows(mysql_query("select id from registration where user_id='$_POST[ref_id]'"));
		if($sql_u)
		{
			$this->query_execute("update registration set ref_id=$_POST[ref_id] where user_id='$_POST[user_id]'");
			header("Location:admin_main.php?page_number=159&update=1&userid=".$user_id);
		}
		else
		{
			header("Location:admin_main.php?page_number=159&update=1&userid=".$user_id);
		}
	}
	
	
	function _AddCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'category_shop';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='c_id' && $val!='')
			{
				$flag=true;
				$where=" c_id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//echo "<pre>"; print_r($update_arr);exit;
			$this->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=9&update=1");
	}
	
	
	function _AddPinNo()
	{	
	
	 
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'pins';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{	
	
			$pack_id = $update_arr['amount'];
		    $query1=mysql_query("SELECT * FROM member_package WHERE id='".$update_arr['amount']."'");
			$data1=mysql_fetch_array($query1);
			$update_arr['amount']=$data1['total_amt'] ;
			$n=$update_arr['pin_no']; 
			$chars = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3","4", "5", "6", "7", "8", "9");
			for($i=0;$i<$n;$i++)
			{
				$rand_id="";
				for($j=1; $j<=10; $j++)
				{
					$num = mt_rand(0,35);
					$rand_id .= $chars[$num];
				}

								
			$update_arr['pin_no']=$rand_id; 
			$update_arr['crt_date']=date("Y-m-d :h:i:s"); 
			$update_arr['created_by_user']='admin'; 
			$update_arr['receiver_id']='admin'; 
			$update_arr['package_id'] = $pack_id;
			//echo "<pre>"; print_r($update_arr);exit;
			$this->insert_tbl($update_arr,$table_name);
			} 
		}
		header("Location:admin_main.php?page_number=190");
	}
	
	function AddMonthlyCharge()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_monthly_charge';
		$table_history=TABLE_PREFIX.'tbl_monthly_charge_history';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		$update_arr['add_date']=date("Y-m-d:H:i:s");
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
			$this->insert_tbl($update_arr,$table_history);
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;
		  $this->insert_tbl($update_arr,$table_name);
		  $this->insert_tbl($update_arr,$table_history);
			
		}
		header("Location:admin_main.php?page_number=209");
	}
	
	function AddSponsorPercent()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_direct_sponsor';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;
		  $this->insert_tbl($update_arr,$table_name);
			
		}
		header("Location:admin_main.php?page_number=210");
	}
	
	
	function AddPv()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_usd_manage';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;
		  $this->insert_tbl($update_arr,$table_name);
			
		}
		header("Location:admin_main.php?page_number=211");
	}
	
	
	
	
	function AddRank()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_rank_management';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		$update_arr['add_date']=date("Y-m-d");		
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;
		  $this->insert_tbl($update_arr,$table_name);
			
		}
		header("Location:admin_main.php?page_number=212");
	}
	
	
	function AddCommission()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_coomission';
		$table_history=TABLE_PREFIX.'tbl_coomission_history';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		if($flag)
		{
			$update_arr['add_date']=date("Y-m-d H:i:s");
			$this->update_tbl($update_arr,$table_name,$where);
			$this->insert_tbl($update_arr,$table_history);	
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;		  
		  $update_arr['add_date']=date("Y-m-d H:i:s");
		  $this->insert_tbl($update_arr,$table_name);	
		  $this->insert_tbl($update_arr,$table_history);
		}
		header("Location:admin_main.php?page_number=197");
	}
	
	
	
	
	function AddCharges()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_maintenance_charge';
		$table_history=TABLE_PREFIX.'tbl_maintenancecharge_history';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		if($flag)
		{
			$update_arr['add_date']=date("Y-m-d H:i:s");
			$this->update_tbl($update_arr,$table_name,$where);
			$this->insert_tbl($update_arr,$table_history);	
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;		  
		  $update_arr['add_date']=date("Y-m-d H:i:s");
		  $this->insert_tbl($update_arr,$table_name);	
		  $this->insert_tbl($update_arr,$table_history);
		}
		header("Location:admin_main.php?page_number=219");
	}
	
	
	
	
	function AddChargestds()
	{	
		//echo "<pre>"; print_r($_POST); die;
		$table_name=TABLE_PREFIX.'tbl_maintenance_charge';
		$table_history=TABLE_PREFIX.'tbl_maintenancecharge_history';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		
		if($flag)
		{
			$update_arr['add_date']=date("Y-m-d H:i:s");
			$this->update_tbl($update_arr,$table_name,$where);
			$this->insert_tbl($update_arr,$table_history);	
		}
		else
		{	
		  //echo "<pre>"; print_r($update_arr);exit;		  
		  $update_arr['add_date']=date("Y-m-d H:i:s");
		  $this->insert_tbl($update_arr,$table_name);	
		  $this->insert_tbl($update_arr,$table_history);
		}
		header("Location:admin_main.php?page_number=227");
	}
	
	
	
	
	function _AddCmsCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_category';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=27&update=1");
	}
	
	
	function _AddCountry()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'country';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=184&update=1");
	}
	
	
	
	function _AddCmsBackOfficeCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_category_backoffice';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
				$product_id=$val;
			}
			else if($key=='old_icon')
			{
				$update_arr['icon']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="cmsbackoffice/";
			$pdf=$this->file_image($path,$file_path.'cmsbackoffice/');
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_ar=array("icon"=>$pdf);
				$where=" id='$product_id'";
				$msg="Icon uploaded";
				$this->update_tbl($update_ar,$table_name,$where);
			}
		}
		else if(isset($_POST['old_icon']) && $_POST['old_icon'])
		{
			$old_icon=$_POST['old_icon'];
		}

		header("Location:admin_main.php?page_number=165&update=1");
	}
	function _AddCmsBackOfficeSubCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_subcategory_backoffice';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=168&update=1");
	}
	function _AddSubCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'subcategory';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='sub_id')
			{
				$flag=true;
				$where=" sub_id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$this->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=11&update=1");
	}
	
	function get_product_price($p_id,$c_id)
{
	
	if($c_id!='')
	{
	$q=mysql_query("select * from product_price where product_id='$p_id' and country_id='$c_id'") or die(mysql_error());
	$r=mysql_fetch_assoc($q);
	$price=$r['product_price'];
	}
	else
	{
		$c=mysql_fetch_assoc(mysql_query("select * from country where country_name='Other'"));
		
	$q=mysql_query("select * from product_price where product_id='$p_id' and country_id='".$c['id']."'") or die(mysql_error());
	$r=mysql_fetch_assoc($q);
	$price=$r['product_price'];
}
return $price;

}
	
	
	
	function _AddProduct()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'product_category';
		$flag=false;
		$pid=$_POST['p_cat_id'];
		$quantity=$_POST['p_qty'];
		$add_date=date("Y-m-d");
		$remark=$qauntity." products added by admin";
		
		
		//echo "<pre>"; print_r($_POST); die;
		
		mysql_query("insert into stock_to_sell_history set product_id='$pid',quantity='$quantity',add_by='admin',remark='$remark', add_date='$add_date'") or die(mysql_error());	
		
		
		foreach($_POST as $key=>$val)
		{
			if($key=='p_cat_id')
			{
				$flag=true;
				
				$where="p_cat_id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else if($key=='old_product_pdf')
			{
				$update_arr['product_pdf']=mysql_real_escape_string($val);
			}
			
			else
			{
				if($key=='pro_desc')
				{
					$update_arr[$key]=mysql_real_escape_string($val);
					$update_arr[$key]=addslashes($val);
				}
				else
				{
					$update_arr[$key]=mysql_real_escape_string($val);
				//$update_arr[$key]=mysql_real_escape_string($val);
				}
			}
		}
		
		$update_arr['update_date']=date('Y-m-d');
		if($flag)
		{
			
			
	if($_FILES['image']['name']!='')
	{
		if(file_exists("../product_logos/".$update_arr['image']))
		{
			unlink("../product_logos/".$update_arr['image']);
		}

	}
		$this->update_tbl($update_arr,$table_name,$where);
			
			$msg="Record Updated Successfully";
			
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			$checkCode=mysql_query("select * from product_category where code='".$update_arr['code']."'");
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
			$msg="product Add Successfully";
			
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['image']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="";
			$image=$this->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				if($flag)
				{
					
				$update_arr=array("image"=>$image);
				$where=" p_cat_id='$pid'";
				$this->update_tbl($update_arr,$table_name,$where);
					
				}
				else
				{
				$update_arr=array("image"=>$image);
				$where=" p_cat_id='$product_id'";
				$this->update_tbl($update_arr,$table_name,$where);
				}
				
			}
		}
		
		if($flag)
		{
		header("Location:product_list.php?&&msg=".$msg);
		}
		else
		{
			header("Location:add_product.php?&&msg=".$msg);
		}
	}
	
	
	function _AddMoreProductImage()
	{
		
		$product_id=$_POST['p_id']; 
		 $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $query="INSERT into images set p_id='".$product_id."', p_image='".$file_name."',status='1'";
        $desired_dir="../product_logos/thumb";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"../product_logos/thumb/".$file_name);
            }else{									//rename the file if another one exist
                $new_dir="../product_logos/thumb/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
            mysql_query($query) or die(mysql_error());			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		$msg= "Success";
		
	}
	header("Location:addMoreProduct.php?product_id=".$product_id."&&msg=".$msg);
	}
	
	function _Update_Logo()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'logo';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_logo')
			{
				$update_arr['logo']=mysql_real_escape_string($val);
			}
			else if($key=='old_favicon')
			{
				$update_arr['favicon']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			//$this->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['logo']['name']!='')
		{
			$file_path="../images/logo/"; 
			$path="";
			$file='logo';
			
			$image=$this->file_image_logo($path,$file_path,$file);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("logo"=>$image);
				$where=" id='$product_id'";
				$msg="logo uploaded";
				$this->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_logo']) && $_POST['old_logo']!='')
		{
			
		}
		if($_FILES['favicon']['name']!='')
		{
			$file_path="../images/favicon/"; 
			$path="favicon";
			$file='favicon';
			$pdf=$this->file_image_logo($path,$file_path,$file);;
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_arr=array("favicon"=>$pdf);
				$where=" id='$product_id'";
				$msg="favicon uploaded";
				$this->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_favicon']) && $_POST['old_favicon'])
		{
			$favicon=$_POST['old_favicon'];
		}
		header("Location:admin_main.php?page_number=156&update=1&msg=".$msg);
	}
	function _Add_Marketing()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'materials';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='m_id' && $val!='')
			{
				$flag=true;
				$where="m_id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['p_cat_id'];
		}
		else
		{
			$update_arr['m_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['image']['name']!='')
		{
			$file_path="../materials/"; 
			$path="";
			$image=$this->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("material"=>$image);
				$where=" m_id='$product_id'";
				$msg="image uploaded";
				$this->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		header("Location:admin_main.php?page_number=26&update=1&msg=".$msg);
	}
	
	
	function _Sales_Ads()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'sales_ads';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			//$this->update_tbl($update_arr,$table_name,$where);
			//$product_id=$_POST['p_cat_id'];
		}
		else
		{
			//$update_arr['m_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
		//	$this->insert_tbl($update_arr,$table_name);
			//$id=$this->get_pid();
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['image']['name']!='')
		{
			$file_path="sales_ads/"; 
			$path="";
			$image=$this->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				//$where=" id='$id'";
				$msg="image uploaded";
				if($flag)
		{
		
				$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
							$this->insert_tbl($update_arr,$table_name);

		}
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		header("Location:admin_main.php?page_number=189&update=1&msg=".$msg);
	}
	
	function _Add_Faq()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'faq';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=26&update=1&msg=".$msg);
	}
	function _Add_Cms()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=29&update=1&msg=".$msg);
	}
	function _Add_Cms_BackOffice()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_backoffice';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=167&update=1&msg=".$msg);
	}
	function _Add_Cms_Seven()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_seven';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				if($key=='content')
				{
					$update_arr[$key]=stripslashes($val);
				}
				else
				{
					$update_arr[$key]=mysql_real_escape_string($val);
				}
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=153&update=1&msg=".$msg);
	}
	function _Add_Cms_Home_Top()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_home_top';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=31&update=1&msg=".$msg);
	}
	function _Add_Cms_Home_Footer()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_home_footer';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=32update=1&msg=".$msg);
	}
	function _Add_Cms_Home()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_home';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=30&update=1&msg=".$msg);
	}
	function _Add_Cms_Latest_Work()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_latest_work';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../client_image/"; 
			$path="";
			$image=$this->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" id='$product_id'";
				$msg="image uploaded";
				$this->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=33&update=1&msg=".$msg);
	}
	function _Add_Cms_Client_Say()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_client_say';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../client_image/"; 
			$path="";
			$image=$this->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" id='$product_id'";
				$msg="image uploaded";
				$this->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=34&update=1&msg=".$msg);
	}
	function _Add_Cms_Recent_Post()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_recent_post';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
			$product_id=$this->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../client_image/"; 
			$path="";
			$image=$this->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" id='$product_id'";
				$msg="image uploaded";
				$this->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=35&update=1&msg=".$msg);
	}
	function _Add_Fund()
	{
		//echo "<pre>"; print_r($_POST); exit;
		// get user id from user_name field and check for valid user
		$arr_history=array("final_e_wallet"=>"credit_debit","final_tp"=>"final_tp_history","final_tfs"=>"final_tfs_history");
		$user_name=$_POST['user_name'];
		$wallet_type='final_e_wallet';
		$table_history='credit_debit';
		$remark="Fund Transfer By Admin ";
		
		if($_POST['admin_type']=='super_admin')
				{
					 $country_search= "";
					
				}
				else
				{
					 $country_search= "and (country='".$_POST['country_id']."' or country='".$_POST['country_name']."')";
				}
		$res_user=$this->query("*","registration"," (user_name='$user_name' or user_id='$user_name') $country_search");
		$count_user=$this->num_row($res_user);
		//echo $count_user;exit;
		if($count_user)
		{
			$row_user=$this->get_all_row($res_user);
			$user_id=$row_user['user_id'];
			$table_name=TABLE_PREFIX.$wallet_type;
			$amount=$_POST['amount'];
			$query=" update $table_name set amount=amount+$amount where user_id='$user_id'";
			$this->query_execute($query);
			$curdate=date('Y-m-d');
			$final_bal=$this->get_field_name($table_name,"amount","user_id='$user_id'");
			$insert_arr=array(
			"user_id"=>$user_id,
			"credit_amt"=>$amount,
			"debit_amt"=>'0',
			"receiver_id"=>$user_id,
			"sender_id"=>'Admin',
			"receive_date"=>$curdate,
			"TranDescription"=>$remark,
			"Remark"=>$remark,
			"final_bal"=>$final_bal
			);
			$this->insert_tbl($insert_arr,$table_history);
			$update=1;
			$error=0;
			$msg="Fund Added To User Wallet";
		}
		else
		{
			$update=0;
			$error=1;
			$msg="Wrong User";
		}
		
		
		header("Location:admin_main.php?page_number=57&update=".$update."&error=".$error."&msg=".$msg);
	}
	function _Deduct_Fund()
	{
		//echo "<pre>"; print_r($_POST); exit;
		// get user id from user_name field
		$arr_history=array("final_e_wallet"=>"credit_debit","final_tp"=>"final_tp_history","final_tfs"=>"final_tfs_history");
		$user_name=$_POST['user_name'];
		$wallet_type='final_e_wallet';
		$table_history='credit_debit';
		$remark="Fund Deducted By Admin ";
		
		 if($_POST['admin_type']=='super_admin')
				{
					 $country_search= "";
					
				}
				else
				{
					 $country_search= "and (country='".$_POST['country_id']."' or country='".$_POST['country_name']."')";
				}
		
		$res_user=$this->query("*","registration"," (user_name='$user_name' or user_id='$user_name') $country_search");
		$row_user=$this->get_all_row($res_user);
		$count_user=$this->num_row($res_user);
		if($count_user)
		{
			$user_id=$row_user['user_id'];
			$table_name=TABLE_PREFIX.$wallet_type;
			$amount=$_POST['amount'];
			// check user wallet before deduct
			$res_amount=$this->query("*",$table_name," user_id='$user_id'");
			$row_amount=$this->get_all_row($res_amount);
			$count_amount=$this->num_row($res_amount);
			if($row_amount['amount']>=$_POST['amount'])
			{
				$query=" update $table_name set amount=amount-$amount where user_id='$user_id'";
				$this->query_execute($query);
				$curdate=date('Y-m-d');
				$final_bal=$this->get_field_name($table_name,"amount","user_id='$user_id'");
				$insert_arr=array(
				"user_id"=>$user_id,
				"credit_amt"=>'0',
				"debit_amt"=>$amount,
				"receiver_id"=>'Admin',
				"sender_id"=>$user_id,
				"receive_date"=>$curdate,
				"TranDescription"=>$remark,
				"Remark"=>$remark,
				"final_bal"=>$final_bal
				);
				$this->insert_tbl($insert_arr,$table_history);
				$update=1;
				$error=0;
				$msg="Fund Deducted From User Wallet";
			}
			else
			{
				$update=0;
				$error=1;
				$msg="User Dont Have Enough Amount In Wallet";
			}
		}
		else
		{
			$update=0;
			$error=1;
			$msg="Wrong User";
		}
		header("Location:admin_main.php?page_number=58&update=".$update."&error=".$error."&msg=".$msg);
	}
	function _Close_Ticket()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$curdate=date('Y-m-d');
		$table_name=TABLE_PREFIX."tickets";
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr=array("status"=>1,"response"=>$_POST['response'],"c_t_date"=>$curdate);
			$where=" id='$val'";
			$this->update_tbl($update_arr,$table_name,$where);
		}
		$update=1;
		$error=0;
		$msg="Resonse To Support Tickets.";
		header("Location:admin_main.php?page_number=224&update=".$update."error=".$error."&msg=".$msg);
	}
	
	function _Close_Withdraw_Bank()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$curdate=date('Y-m-d');
		 $table_name=TABLE_PREFIX."withdraw_fund";
		
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr=array("status"=>1,"response"=>$_POST['response'],"varify_date"=>$curdate);
			$where=" id='$val'";
			
			$this->update_tbl($update_arr,$table_name,$where);
		}
		$update=1;
		$error=0;
		$msg="Bank Transfer Confirm.";
		header("Location:admin_main.php?page_number=43&update=".$update."error=".$error."&msg=".$msg);
	}
	
	function BV_Price()
{
	$bvQry=mysql_query("select * from bv_price") or die(mysql_error());
		$rowBv=mysql_fetch_assoc($bvQry);
		$bv=$rowBv['bv'];
		$price=$rowBv['price'];
		$finalbv=$price/$bv;
		return $finalbv;
}
	
	
	function _Repurchase_Binary_Income()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$curdate=date('Y-m-d');
		 $table_name=TABLE_PREFIX."repurchase_binary_income";
		
		
		foreach($_POST['id'] as $key=>$val)
		{
			
			$q=mysql_fetch_assoc(mysql_query("select * from $table_name where id='$val' and status=0"));
			$cycle=$q['income_pair'];
			
			
			$commission=$cycle*$_POST['response'];
			
			
			//calculate commission on product volume
			$finalbv=$this->BV_Price();
			$commission_bv=$commission;
			$commission=$commission*$finalbv;
			//calculate tds and miscellaneous amount
			//$row= mysql_fetch_assoc(mysql_query("select * from repurchase_binary_income where id='$val'") or die(mysql_error()));
			
			
		$uid=$q['user_id'];
		$comRemark=$q['com_percent'];
		$invoice_no=$q['invoice_no'];
		$final_amount=$q['final_amount'];
			
			$tds_percent=$q['tds_percent'];
			$miscellaneous_percent=$q['miscellaneous_percent'];
			$tds_amount=($commission*$tds_percent)/100;
			$miscellaneous_amount=($commission*$miscellaneous_percent)/100;
			$final_amount=$commission-($tds_amount+$miscellaneous_amount);
		/////////end/////////////
			
			$update_arr=array("status"=>1,"commission_bv"=>$commission_bv,"commission"=>$commission,
			"tds_amount"=>$tds_amount,
			"miscellaneous_amount"=>$miscellaneous_amount,
			"final_amount"=>$final_amount);
			$where=" id='$val'";
			
			$this->update_tbl($update_arr,$table_name,$where);
			
			
			
			mysql_query("update final_e_wallet set amount=amount+$final_amount where user_id='$user_id'");
				$inserarr=array(
					"user_id"=>$uid,
					"credit_amt"=>$final_amount,
					"debit_amt"=>'0',
					"receiver_id"=>$uid,
					"sender_id"=>$uid,
					"receive_date"=>$to_date,
					"TranDescription"=>"Get $comRemark % as Repurchase Bonus ",
					"Remark"=>"Get $comRemark % as as Repurchase Bonus",
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"credit_debit");
			
			
		}
		$update=1;
		$error=0;
		$msg="Update Repurchase Binary Income";
		header("Location:admin_main.php?page_number=185&update=".$update."error=".$error."&msg=".$msg);
	}
	
	
	
	function _Add_Announcement()
	{
		$table_name=TABLE_PREFIX.'promo';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="n_id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['n_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=45&update=1&msg=".$msg);
	}
	
	function adminuserid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'admin_master';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select userid from $table_name where userid='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	
	
	// Add new user
	 function _AddUser(){
	
		// check category field has value or not
		if(isset($_POST['fname']) && isset($_POST['email'])  && isset($_POST['username']) && isset($_POST['password']) ){
				
			if( !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) ){
					
				//global $mxDb;
	
				$user_id = $this->adminuserid();
	
				//Update Contact Us
				$insert = array(
						'fname'=>$_POST['fname'],
						'uid'=>$user_id,
						'userid'=>$_POST['username'],
						'country'=>$_POST['country'],
						'password'=>$_POST['password'],
						'email'=>$_POST['email'],
						'user_type'=>'sub_admin',
						'add_date'=>date('Y-m-d'),
						'ts'=>date('Y-m-d H:i:s')
				);
	
				if($this->insert_tbl($insert,'admin_master')){
						
					// insert privileage
					$privileage = $_POST['privileage'];
						
					foreach( $privileage as $privil){
	
						$insert_array = array(
								'privilege_page'=>$privil,
								'date'=>date('Y-m-d'),
								'add_date_time'=>date('Y-m-d H:i:s'),
								'admin_id'=>$user_id
						);
	
						$this->insert_tbl($insert_array, 'admin_privileges');
	
					}
						
					header("Location:admin_main.php?page_number=188&msg=Add user successfully!&res=1");
				}
				else{
					header("Location:admin_main.php?page_number=188&msg=Failed record insertion!&res=1");
				}
			}
			else
				header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
		}
		else
			header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
	
	}
	



	// Update User report
	function _UpdateUser(){
	
		// check category field has value or not
		if(isset($_POST['fname']) && isset($_POST['email'])  && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['id']) ){
			
			//exit;
				
			if( !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['id']) ){
					
					
				//global $mxDb;
	
				$user_id = $_POST['id'];
	
	
	            $res=mysql_fetch_array(mysql_query("select * from admin_master where uid='$user_id'"));
				$res1=$res['password'];
				
				//echo $res1;print_r("<br/>");
				//echo $_POST['password'];
				
	            if($res1==$_POST['password'])
				{
					$update = array(
						'fname'=>$_POST['fname'],
						'userid'=>$_POST['username'],
						'country'=>$_POST['country'],
						'email'=>$_POST['email']
				);
				}
				else
				{
	
				//Update Contact Us
				$update = array(
						'fname'=>$_POST['fname'],
						'userid'=>$_POST['username'],
						'country'=>$_POST['country'],
						'password'=>$_POST['password'],
						'email'=>$_POST['email']
				);
				}
	
				$where = " uid=".$user_id;
	
				if($this->update_tbl($update,'admin_master', $where )){
						
					// delete old privileage
					//$mxDb->delete_record('admin_privileges', "admin_id='".$user_id."'");
					mysql_query("delete from admin_privileges where admin_id='$user_id'") or die(mysql_error());	
					// insert privileage
					$privileage = $_POST['privileage'];
						
					foreach( $privileage as $privil){
	
						$insert_array = array(
								'privilege_page'=>$privil,
								'date'=>date('Y-m-d'),
								'add_date_time'=>date('Y-m-d H:i:s'),
								'admin_id'=>$user_id
						);
	
						$this->insert_tbl($insert_array,'admin_privileges' );
	
					}
						
					header("Location:admin_main.php?page_number=188&msg=Update User successfully!&res=1");
				}
				else{
					header("Location:admin_main.php?page_number=188&msg=Failed record updation!&res=1");
				}
			}
			else
				header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
		}
		else
			header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
	
	}
	
	
	
	
	
	
	
	
	
	function _Add_Member_Remark()
	{
		$table_name=TABLE_PREFIX.'static_page';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['n_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=46&update=1&msg=".$msg);
	}
	
	function _AddPackage()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name=TABLE_PREFIX.'member_package';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$update=1;
			$error=0;
			$msg="Package Updated Successfully.";
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->insert_tbl($update_arr,$table_name);
			$update=1;
			$error=0;
			$msg="Package Created Successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=36&update=1&msg=".$msg);
	}
	
	
	function _AddPackagedetails()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name=TABLE_PREFIX.'tbl_packege';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$update=1;
			$error=0;
			$msg="Package Updated Successfully.";
		}
		else
		{
			$update_arr['package_date']=date('Y-m-d h:i:s');
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->insert_tbl($update_arr,$table_name);
			$update=1;
			$error=0;
			$msg="Package Created Successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=194&update=1&msg=".$msg);
	}
	
	function _AddNoticedetails()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name=TABLE_PREFIX.'static_page';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->update_tbl($update_arr,$table_name,$where);
			$update=1;
			$error=0;
			$msg="Updated Successfully.";
		}
		else
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->insert_tbl($update_arr,$table_name);
			$update=1;
			$error=0;
			$msg="Created Successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=29&update=1&msg=".$msg);
	}
	
	
	
	function _ADD_Social_Page()
	{
		$table_name=TABLE_PREFIX.'social_media_page';
		$flag=false;
		unset($update);
		//echo "<pre>"; print_r($_POST);
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!=0)
			{
				$flag=true;
				echo $val;
			}
			else
			{
				$update['page_name'][]=$key;
				$update['link'][]=mysql_real_escape_string($val);
			}
		}
		//print_r($update);exit;
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			foreach($update['page_name'] as $keys=>$value)
			{
				if($value=='id')
				{}
				else
				{
				$update_arr['page_name']=$value;
				$update_arr['link']=$update['link'][$keys];	
				$where="page_name='$value'";
				$this->update_tbl($update_arr,$table_name,$where);
				}
			}
			$update=1;
			$error=0;
			$msg="Updated Successfully.";
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			foreach($update['page_name'] as $keys=>$value)
			{
				if($value=='id')
				{}
				else
				{
				$update_arr['page_name']=$value;
				$update_arr['link']=$update['link'][$keys];	
				//$where="page_name='$value'";
				//print_r($update_arr);exit;
				$this->insert_tbl($update_arr,$table_name);
				}
			}
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$update=1;
			$error=0;
			$msg="Inserted Successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=38&update=1&msg=".$msg);	
	}
	function _product_validity($pid)
	{
		$res=$this->query("p_cat_id","product_category","p_cat_id in ($pid)");
		$count=$this->num_row($res);
		//echo "_product_validity:".$count."<br>";
		if($count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function _product_avalidity($pid,$user_id,$table_name)
	{
		$res=$this->query("id",$table_name,"product_id='$pid' and user_id='$user_id' and status=0");
		$count=$this->num_row($res);
		//echo "_product_avalidity:".$count."<br>";
		if($count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function _product_thirty($user_id,$table_name,$temp_count)
	{
		//echo $pid.'=='.$user_id;
		$res=$this->query("id",$table_name,"user_id='$user_id' and status=0");
		$count=$this->num_row($res);
		//echo "_product_thirty:".$count."<br>"; exit;
		if($count<$temp_count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function _Add_Stock_To_Sell()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'stock_to_sell';
		$table_name1=TABLE_PREFIX.'stock_to_sell_mp';
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr['user_id']=$val;
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($this->_product_validity($pid) && !$this->_product_avalidity($pid,$val,"stock_to_sell_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			
			$update['user_id']=$val;
			//$product_code_arr=explode(",",$product_code);
			//echo "<pre>"; print_r($pid_arr);exit;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($this->_product_thirty($val,"stock_to_sell_mp",30))
				{
					$this->insert_tbl($update,$table_name1);
				}
			}
			// start to check user already mapped or not
			/*$res_check=$this->query("id",$table_name,"user_id='$val'");
			$count_chekc=$this->num_row($res_check);
			//echo $count_chekc;exit;
			if($count_chekc)
			{
				// find all products mapped and update 
				$where="user_id='$val'";
				$res_map=$this->query("product_id",$table_name1,"user_id='$val'");
				$product_map=array();
				while($row_map=$this->num_row($res_map))
				{
					$product_map[]=$row_map['product_id'];
				}
				$product_string=implode(",",$product_map);
				$update_arr['product_id']=$product_string;
				$this->update_tbl($update,$table_name,$where);
			}
			else
			{
				$this->insert_tbl($update_arr,$table_name);
			}*/
		}
		header("Location:admin_main.php?page_number=15&update=1&msg=".$msg);	
	}
	function _Add_Weekly_Adds()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'weekly_adds';
		$table_name1=TABLE_PREFIX.'weekly_adds_mp';
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr['user_id']=$val;
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($this->_product_validity($pid) && !$this->_product_avalidity($pid,$val,"weekly_adds_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			
			$update['user_id']=$val;
			//$product_code_arr=explode(",",$product_code);
			//echo "<pre>"; print_r($pid_arr);exit;
			$sn=1;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_count']=$sn;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($this->_product_thirty($val,"weekly_adds_mp",5))
				{
					$this->insert_tbl($update,$table_name1);
				}
				$sn++;	
			}
			// start to check user already mapped or not
			/*$res_check=$this->query("id",$table_name,"user_id='$val'");
			$count_chekc=$this->num_row($res_check);
			//echo $count_chekc;exit;
			if($count_chekc)
			{
				// find all products mapped and update 
				$where="user_id='$val'";
				$res_map=$this->query("product_id",$table_name1,"user_id='$val'");
				$product_map=array();
				while($row_map=$this->num_row($res_map))
				{
					$product_map[]=$row_map['product_id'];
				}
				$product_string=implode(",",$product_map);
				$update_arr['product_id']=$product_string;
				$this->update_tbl($update,$table_name,$where);
			}
			else
			{*/
				//echo " update weekly_adds set status=1 where user_id='$val'";exit;
				mysql_query(" update weekly_adds set status=1 where user_id='$val'");
				$this->insert_tbl($update_arr,$table_name);
			/*}*/
		}
		header("Location:admin_main.php?page_number=17&update=1&msg=".$msg);	
	}
	function _Set_Power_Leg()
	{
		$power_leg=$_POST['power_leg'];
		$power_status=$_POST['power_status'];
		$user_id=$_POST['user_id'];
		$table_name=TABLE_PREFIX.'registration';
		//echo "<pre>"; print_r($_POST);exit;
		// check the old password is valid or not
		$res=$this->query("*",$table_name," user_id='$user_id'");
		$count=$this->num_row($res);
		if($count)
		{
				$curdate=date('Y-m-d');
				$update_arr=array("power_leg"=>$power_leg,"power_status"=>$power_status);
				$where=" user_id='$user_id'";
				$this->update_tbl($update_arr,$table_name,$where);
				$msg="Set Power Leg and Status Successfully.";
		}
		else
		{
			$msg="Wrong User.";
		}
		header("Location:admin_main.php?page_number=150&update=1&msg=".$msg);	
	}
	
	function _Payment_Bank()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name="bank_detail";
		unset($_POST['type']);
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$where="id='$val'";
				$flag=true;
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		//echo "<pre>"; echo $where;print_r($update_arr); exit;
			if($flag)
			{
				$this->update_tbl($update_arr,$table_name,$where);
			}
			else
			{
				$this->insert_tbl($update_arr,$table_name);
			}
		header("Location:admin_main.php?page_number=163");
	}
	
	function _change_password()
	{
		$old_pass=$_POST['old_password'];
		$new_pass=$_POST['new_password'];
		$c_pass=$_POST['confirm_password'];
		$userid=USERNAME;
		$table_name=TABLE_PREFIX.'admin';
		// check the old password is valid or not
		$res=$this->query("*",$table_name," userid='$userid' and password='$old_pass'");
		$count=$this->num_row($res);
		if($count)
		{
			if($new_pass==$c_pass)
			{
				$curdate=date('Y-m-d');
				$update_arr=array("password"=>$new_pass,"modify_by"=>USERNAME,"modify_date"=>$curdate);
				$where=" id='$id'";
				$this->update_tbl($update_arr,$table_name,$where);
				$msg="Password Change Successfully.";
			}
			else
			{
				$msg="Password and Confirm Password Should Be Same.";
			}
		}
		else
		{
			$msg="Wrong Old Password.";
		}
	}
}
?>