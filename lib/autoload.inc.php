<?php
function __autoload($file)
{
    include_once("classes/" . $file . ".php");
}
$obj_rep  = new Representative();
print_r($obj_rep);die;
$obj_func = new My_Function();
?>