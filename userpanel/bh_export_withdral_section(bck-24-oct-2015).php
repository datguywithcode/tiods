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
		
		if($data1['status']==0)
		{ 
			$statuss="Pending"; 
		}
		else 
		{
			$statuss="Paid";
		}
		
		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($row['transaction_number']).",";
		$content .= escape_csv_value($row['request_amount']).",";
		$content .= escape_csv_value($row['transaction_charge']).",";
		$content .= escape_csv_value($row['posted_date']).",";
		$content .= escape_csv_value($row['admin_remark']).",";
		$content .= escape_csv_value($row['admin_response_date']).",";
		$content .= escape_csv_value($statuss).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No., Transaction No., Request Amount, Transaction Charge, Request Date, Admin Response, Response Date, Status"."\n";
echo $title;
echo $content;

?>