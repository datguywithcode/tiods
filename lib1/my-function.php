<?php
include(ABSPATH.'config.php');
/*for fetching the complete url code starts here*/
function curPageURL() {
 @$pageURL = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 @$pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  @$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  @$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return @$pageURL;
}
/*for fetching the complete url code Ends here*/

/*for fetching the page name only code starts here*/
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
/*for fetching the page name only code Ends here*/

/*For fetching the data from table single record only*/

class db
{
    public $host;
    public $user;
    public $pass;
    public $data;
    public $con;
    public $table;
    function db()
    {
        $this->host="localhost";
        $this->user="root";
        $this->pass="";
        $this->data="lfi";   
    }   
    public function connect()
    {
        $this->con=mysql_connect($this->host,$this->user,$this->pass);
        if(!$this->con)
        {
            echo mysql_error();
        }
        $sel=mysql_select_db($this->data, $this->con);
        if(!$sel)
        {
            echo mysql_error();
        }
    }
	

	
	
	
	public function count_total_rows($table, $fields, $conditions)
    {
        $sql=mysql_query("select $fields from $table where $conditions");
        return $result=mysql_num_rows($sql);
    }
	
	
	
	public function Fetch_allrecord($table, $fields, $conditions)
    {
        $sql=mysql_query("select $fields from $table where $conditions");
        if(!$sql)
        {
            echo mysql_error();
        }
		else
		
		{
			$result = array();
    while ($record = mysql_fetch_array($sql)) {
         $result[] = $record;
    }
			return $result;
		}
    }
	
	
	public function Fetch_singlerecord($table, $fields, $conditions)
    {
        $sql=mysql_query("select $fields from $table where $conditions");
        if(!$sql)
        {
            echo mysql_error();
        }
		else
		
		{
			$result = array();
    $record = mysql_fetch_array($sql);
         $result[] = $record;
    
			return $result;
		}
    }
	
	
	
	
	
}
?>

