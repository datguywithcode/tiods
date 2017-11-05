<?php 
include("lib/config.php");

$country=$_POST['countryId'];
$query=mysql_fetch_assoc(mysql_query("SELECT * FROM country WHERE countryid='".$country."'"));
echo "+ ".$query['std_code'];
?>
 

   

                

               
                 

                    

              



				