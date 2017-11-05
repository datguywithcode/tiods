<?php
include("lib/config.php");
if(isset($value1) && !empty($value1))
{
$value = $_GET['action'];	
}
else
{
$value = $_POST['action'];
}
switch($value)
{
case "MerchantRegistration":			
_MerchantRegistration();
break;

case "loginuser":
_LoginUserCode();
break;
}

/*User Login Code Starts here*/
function _LoginUserCode(){

	  global $obj_rep,$obj_func;
	  $username = mysql_real_escape_string($_POST['username']);
      $password = mysql_real_escape_string($_POST['password']);

     if($username!='' && $password!='' )
	 {
		if(strlen($username) && strlen($password))
        {
		
		$contion=" ((user_status='0' && admin_status='0') && ((email = '$username' || username='$username' || user_id='$username') && password = '$password'))";
		$sql=$obj_rep->query("*","user_registration",$contion);
		
		$result=$obj_rep->get_all_row($sql);
		
		if($obj_rep->num_row($sql)>0)
		{
						
						$_SESSION['userpanel_user_id']=$result['user_id'];
						$_SESSION['SD_User_Name']=$result['username'];
						$fullName=$obj_func->userName($result['user_id']);
						
						/* store the visitor info in table code start here*/
						$guest_ip   = $_SERVER['REMOTE_ADDR'];
						
						$arrVisito= array(
									"user_id"=>$result['user_id'],
									"fullname"=>$fullName,
									"ipadd"=>$guest_ip,
									"times"=>'CURRENT_TIMESTAMP'
						
						);
						$obj_rep->insert_tbl($arrVisito,"visitor");

						/* store the visitor info in table code ends here*/						
						    header("location:userpanel/index.php"); 

					

		}	
		else
		{
						header("location:login.php?msg=wrong");		
		}	





	 		} 
	}
}
/*User Login Code Ends here*/


/*Userid Generate Code Starts Here */
function userid()
{
$table_name='user_registration';
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
/*Userid Generate Code Ends Here */



/*Userid Generate Code Starts Here */
function username()
{
$table_name='user_registration';
$encypt1=uniqid(rand(1000000000,9999999999), true);
$usid1=str_replace(".", "", $encypt1);
$pre_username = $f.$l.substr($usid1, 0, 6);
$checkid=mysql_query("select username from $table_name where username='$pre_username'");
if(mysql_num_rows($checkid)>0)
{
username();
}
else
return $pre_username;
}
/*Userid Generate Code Ends Here */


/*Merchant Registration Code Starts Here */
function _MerchantRegistration(){
	global $obj_rep,$obj_func;
	//echo "<pre>"; print_r($_POST); die;
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$country=$_POST['country'];
	$city=$_POST['city'];
	$tel_code=$_POST['tel_code'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$dob=$_POST['bdate'];
	$dob=explode("/",$dob);
	$dob=$dob[2]."-".$dob[1]."-".$dob[0];
	$gender=$_POST['gender'];
	$sponsorid=$_POST['sponsorid'];
	$binary_pos=$_POST['binary_pos'];
	$nom_id = $_POST['nom'];
	
	$f=ucfirst(substr($firstname,0,1));
	$l=ucfirst(substr($lastname,0,1));
	
	$resos=mysql_query("select * from user_registration where email='$email'");
		  $resos1=mysql_num_rows($resos);
		  if($resos1!= '0')
		  {
			header("location:userpanel/register.php?msg=mail");
		  }
		  else
		  {
			 
						$user_id=userid();
						$username=$f.$l.username();
					 	$date=date('Y-m-d');
						$insert_array = array('user_id'=>$user_id,'ref_id'=>$sponsorid,'nom_id'=>$nom_id,'dob'=>$dob,'sex'=>$gender,'password'=>$password,'first_name'=>$firstname,'last_name'=>$lastname,'email'=>$email,'username'=>$username,'admin_status'=>"0",'user_status'=>"0",'registration_date'=>$date,'designation'=>"Merchant",'user_rank_name'=>'Merchant','t_code'=>'0000', 'country'=>$country, 'city'=>$city,'std_code'=>$tel_code, 'telephone'=>$phone,'binary_pos'=>$binary_pos);
						
						if($obj_rep->insert_tbl($insert_array,'user_registration'))
						{
						
							$l=1;
							
						while($nom_id!='cmp'){
					    if($nom_id!='cmp'){
						mysql_query("insert into level_income_binary set down_id='$user_id', income_id='$nom_id', leg='$binary_pos', status=0, level='$l'") ;
						}
						$selectnompos=mysql_query("select binary_pos,nom_id from user_registration where user_id='$nom_id' ");
						
						$fetchnompos=mysql_fetch_array($selectnompos);
						$pos=$fetchnompos['binary_pos'];
						$nom_id=$fetchnompos['nom_id'];
						$l++;
						}
						}
						
						$sqlMax=mysql_fetch_assoc(mysql_query("select max(id) as id from user_registration")) or die(mysql_error());
						$sqlUser=mysql_fetch_assoc(mysql_query("select username from user_registration where id='".$sqlMax['id']."'"));
						
				mysql_query("insert into final_e_wallet set user_id='".$user_id."', amount='0',status='0'") or die(mysql_error());
				mysql_query("insert into voucher_e_wallet set user_id='".$user_id."', amount='0',status='0'") or die(mysql_error());
				$repli="http://198.154.241.136/~sandeep/tiods/".$sqlUser['username'];
                $email=$email;
				$strSubject = "Registration Confirmation From Tiods";
				$from = 'sandeep@maxtratechnologies.com';
	     		$strSid = md5 ( uniqid ( time () ) );
		    	$strHeader = "";
				$strHeader .= "From:<" . $from . ">\nReply-To: " . $from . "";								
				$strHeader .= "MIME-Version: 1.0\n";
		        $strHeader .= "Content-Type: multipart/mixed; boundary=\"" . $strSid . "\"\n\n";
		        $strHeader .= "This is a multi-part message in MIME format.\n";
				$strHeader .= "--" . $strSid . "\n";
				$strHeader .= "Content-type: text/html; charset=utf-8\n";
			    $strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
			    $strHeader .= " \n\n";
			    $strHeader .= "  <br>";

		        $msg = '<html>

				<body>
				<img src="http://198.154.241.136/~sandeep/tiods/images/logo.png" width="300" height="80" /><br/>
				<fieldset style="border-color:#09F;background-color:#ebebeb;width:700px;"><table width="700" border="0" cellspacing="5" cellpadding="1">
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="2">Dear '.$sqlUser['username'].'</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td width="316" colspan="3" align="justify">Thank you for joining us at http://198.154.241.136/~sandeep/tiods/. We welcome you on board and
				    
				    are excited to have your business. We always ready to enrich each of your investment 
				    
				    capital with higher values just like how we valued you..!</td>
				  <td width="19">&nbsp;</td>

				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>Your login and transaction Credential</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>Your  Sponsor Id : '.$sponsorid.' </td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>Username  : '.$sqlUser['username'].'</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>Password  : '.$_POST['password'].' </td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>Transaction Password : "0000" </td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>Replicated Link : '.$repli.' </td>
				  <td>&nbsp;</td>
				 
				  
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td  colspan="3" align="justify"><strong>Risk statement:</strong> Any specific investment or investment service contained or referred to in this web site

				may not be suitable for all visitors to this site. An investment in derivatives may mean investors may lose 

				an amount even greater than their original investment. Anyone wishing to invest in any of the products 

				mentioned should seek their own financial or professional advice. Trading of securities, options and 

				futures may not be suitable for everyone and involves the risk of losing part or all of your money. 

				Trading in the financial markets has large potential rewards, but also large potential risk. You must be 

				aware of the risks and be willing to accept them in order to invest in the markets. Don`t trade with 

				money you can`t afford to lose.</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				</table></fieldset>


				</body>

				</html>';

				//mail ($email, $strSubject, $msg, $strHeader );
			}
			
			header("location:userpanel/binary-tree.php");


}
/*Merchant Registration Code Ends Here */

?>