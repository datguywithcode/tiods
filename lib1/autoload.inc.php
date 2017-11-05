<?php

function __autoload($classname) {
    $filename = "classes/". $classname .".php";
    include_once($filename);
}

//create objects of all classes
//this is Mysql class object
$mxMysql = new Mysql();
//this is Db action class object that extends Mysql class
$mxDb = new DB_action();
//this is security issues manage class object
$mxSecurity = new Session_Cookies_Security();

$obj_rep=new Representative();

//this is custom method class object
$custom_Obj = new Custom_Classes();
//this is image creation class object use GD library
$ImageCreate_obj= new Image_creation();
//this is level commission class object
$lvl_com_obj = new Level_Commission();
//this is level get downline record class object
$get_donwlines = new showDwonMem();



?>