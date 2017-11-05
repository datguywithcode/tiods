<?php
ob_start();
include("../lib/config.php");
mysql_query("delete from tickets where id='".$_GET['id']."'");
header("location:open-ticket-manage.php?msg=Ticket Deleted Successfully!");
?>