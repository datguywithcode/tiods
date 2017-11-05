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



$sqlpur="select * from user_registration where user_registration.mem_type='0' and ref_id='".$userId."'";
						$sql_query=mysql_query($sqlpur);
					
					

if(mysql_num_rows($sql_query)>0)
{

		$i=1;
		while($fetData = mysql_fetch_array($sql_query)){
		$arr_status=array('Pending','Paid','Shipped','Cancaeled');
		
		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($obj_func->userName($fetData['user_id'])).",";
		$content .= escape_csv_value($fetData['username']).",";
		$content .= escape_csv_value($fetData['registration_date']).",";
		$content .= escape_csv_value($obj_func->getCountry($fetData['country'])).",";
		$content .= escape_csv_value($fetData['telephone']).",";
		$content .= escape_csv_value($fetData['email']).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No., My Prospects, Username, Registration Date,Country ,Mobile Number, Email address"."\n";
echo $title;
echo $content;

?>