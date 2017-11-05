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
header("Content-Disposition: attachment; filename=exportWithdrawal.csv");
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



$select = mysql_query("select * from withdraw_request where user_id='$userid' order by id desc");

if(mysql_num_rows($select)>0)
{

	while($row=mysql_fetch_assoc($select))
	{
		
		if($row['status']==0)
		{ 
			$statuss="Pending"; 
		}
		else 
		{
			$statuss="Paid";
		}
		
		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($row['posted_date']).",";
		$content .= escape_csv_value($row['first_name']).",";
		$content .= escape_csv_value($row['country']).",";
		$content .= escape_csv_value($row['mobile_no']).",";
		$content .= escape_csv_value($row['request_amount']).",";
		$content .= escape_csv_value($row['admin_response_date']).",";
		//$content .= escape_csv_value($row['admin_response_date']).",";
		$content .= escape_csv_value($statuss).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No., Date of Request, Beneficiary Name, Beneficiary Country, Beneficiary Mobile no, Requested amount, Date of Response, MTCN"."\n";
echo $title;
echo $content;

?>