<?php
	//Start session
	session_start();

	if(isset($_SESSION['SESS_uname']))
	{
	   $con = mysql_connect("localhost","smsuser","5uRrS4xKt7XrNuJv");
	    if(!$con)
	    {
	    die('Could not connect: ' . mysql_error());
    	}
    mysql_select_db("sms",$con);
    }else
    {
    header("location:accessdenied.php");
	exit();
	}




?>