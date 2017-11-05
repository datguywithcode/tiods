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
header("Content-Disposition: attachment; filename=exportDownlineMember.csv");
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



$select = mysql_query("select * from level_income_binary where income_id='$userid'");

if(mysql_num_rows($select)>0)
{

	while($row=mysql_fetch_assoc($select))
	{
		$data11=mysql_fetch_array(mysql_query("select * from user_registration where user_id='".$row['down_id']."'"));

		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($row['down_id']).",";
		$content .= escape_csv_value($data11['username']).",";
		$content .= escape_csv_value($data11['first_name']." ".$data11['last_name']).",";
		$content .= escape_csv_value($row['level']).",";
		$content .= escape_csv_value($row['leg']).",";
		$content .= escape_csv_value($data11['registration_date']).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No., User Id, Username, Full Name, Level, Leg, Register Date"."\n";
echo $title;
echo $content;

//header('Location: downline-member-report.php');

?>