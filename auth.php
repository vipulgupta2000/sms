<?php
	//Start session
	session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
$ini_array = parse_ini_file("../conf.ini",true);
$host=$ini_array['sms']['host'];
$username=$ini_array['sms']['username'];
$password=sha1($ini_array['sms']['password']);
$db_name=$ini_array['sms']['db_name'];


	/*if(!isset($_GET['page']))
	{echo "incorrect way to access page";exit();
            }
*/
$page_name=isset($_GET['page'])?$_GET['page']:substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	if(isset($_SESSION['SESS_uname']))
	{

	   $con = mysql_connect("$host","$username","$password");
	    if(!$con)
	    {
	    die('Could not connect: ' . mysql_error());
    	}
     mysql_select_db("$db_name",$con);
    $page_array=array('logout.php','text.php','search','emp_sal_slip.php','get_pf_slip.php','get_ytd.php');
    //$curr_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    if(!(in_array($page_name,$page_array)))
    {pageaccess();}

    }else
    {
    header("location:accessdenied.php");
	exit();
	}

function pageaccess()
{
    $sql="select * from access where groupname='$_SESSION[SESS_perm]' and page_name='$_GET[page]'";
	$result=mysql_query($sql)or die ("cannot execute");
	$cnt = mysql_num_rows($result);
	if(!($cnt==1 || ($_SESSION['SESS_perm']=='sys_admin')))
	{
	header("location:accessdenied.php");
	}
}



?>