<?php
$tbl=$_POST['page'];
$val=$_POST['param'];
//$tbl=$_GET['page'];
//$val=$_GET['param'];
$qual=" empname='".$val."'";
$field_show=array('empid');$field_edit=array();
//echo $_GET['page'];
require_once("auth.php");
//require_once("lib/insert.php");
include('lib/display.php');
include('lib/addrow.php');
include('lib/update.php');
include('lib/utils.php');
include('rowaccess.php');
include('lib/sms_utils.php');
/*$query="SELECT empname FROM $tbl WHERE empname='$val'";
$result=mysql_query($query);
$i=0;
echo "<select name=\"pro$i\"><option>Select Project</option>";

while($row=mysql_fetch_array($result))
{
echo $row[0];
echo "<option value=\"{$row[0]}\">{$row[0]}</option>";
}

echo "</select>";*/
echo display_data($tbl,$qual,1,$field_show);
//echo input($tbl,$qual,$field_edit,$field_show);
?>

