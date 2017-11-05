<?php


include("lib/config.php");


$_SESSION['username']=$_POST['username'];


//check we have username post var


if(isset($_POST["username"]))


{


    //check if its an ajax request, exit if not


    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {


        die();


    }   





        //try connect to db


       //trim and lowercase username


    $username =  strtolower(trim($_POST["username"])); 


    


    //sanitize username


    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);


    


    //check username in db


    $results = mysql_query("SELECT * FROM user_registration WHERE username='$username'");


 


    //return total count


    $username_exist = mysql_num_rows($results); //total records


    


    //if value is more than 0, username is not available


    if($username_exist) {


        echo "<font color='#FF0000'><strong>"."  Username Already Exists !"."</strong></font>";


    }else{


        echo "<font color='#009999'><strong>"."  Congrats User Name Available !"."</strong></font>";


    }


    


    //close db connection


   


}

















?>