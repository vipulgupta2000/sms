<?php
	//Start session
	session_start();

	if(!isset($_GET['page']))
	{echo "incorrect way to access page";exit();
	}

	if(isset($_SESSION['SESS_uname']))
	{
	//echo "Welcome ". $_SESSION['SESS_uname']." ";
    //echo "Your Employee ID is=" . $_SESSION['SESS_empid'];
       //$con = mysql_connect("localhost","editor","YqvjywySafVDSDej");
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