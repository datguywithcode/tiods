<?php
ob_start();
include("../lib/config.php");
mysql_query("delete from promo where n_id='".$_GET['id']."'");
header("location:official-announcement.php?msg=Ticket Deleted Successfully!");
?>