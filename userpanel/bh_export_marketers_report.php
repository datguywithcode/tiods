<?php 
include("../lib/config.php");
/*   CSV Export*/
function escape_csv_value($value) 
{
	$value = str_replace('"', '""', $value); // First off escape all " and make them ""
	if(preg_match('/,/', $value) or preg_match("/\n/", $value) or preg_match('/"/', $value))
	{ // Check if I have any commas or new lines
		return '"'.$value.'"'; // If I have new lines or commas escape them
	} 
	else 
	{
		return $value; // If no new lines or commas just return the value
	}
}

function redirectURL($url) 
{
	$url=$_SERVER['HTTP_REFERER'];
    echo '<script> window.location.href="'.$url.'"</script>"';
}

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=exportPurchaseReport.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userid'])
{
	$userid = $_REQUEST['userid'];
}
		
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;



$sqlpur="select *,sum(manage_bv_history.tbpv) as tbpv ,level_income_binary.level as user_level ,level_income_binary.down_id as user_id,manage_bv_history.id as id  from level_income_binary inner  join manage_bv_history on manage_bv_history.down_id=level_income_binary.down_id where level_income_binary.income_id='".$userid."' and manage_bv_history.income_id='".$userid."' group by level_income_binary.down_id order by manage_bv_history.id desc";
						
						$sql_query=mysql_query($sqlpur);
					
					

if(mysql_num_rows($sql_query)>0)
{

		$i=1;
		while($fetDatas = mysql_fetch_array($sql_query)){
			$fetData=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$fetDatas['user_id']."'"));
		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($obj_func->userName($fetData['user_id'])).",";
		$content .= escape_csv_value($fetData['username']).",";
		$content .= escape_csv_value($obj_func->getCountry($fetData['country'])).",";
		$content .= escape_csv_value($fetData['registration_date']).",";
		$content .= escape_csv_value($fetData['std_code']."-".$fetData['telephone']).",";
		$content .= escape_csv_value($fetData['email']).",";
		$content .= escape_csv_value($fetDatas['user_level']).",";
		$content .= escape_csv_value($fetDatas['tbpv']).",";
		$content .= escape_csv_value($obj_func->memType($fetData['mem_type'])).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sl No.,My Clients, Username, Country, Date,Mobile Number ,Email address, Level,Accumelative Direct Purchasing Points,Current Membership Plan"."\n";
echo $title;
echo $content;

?>