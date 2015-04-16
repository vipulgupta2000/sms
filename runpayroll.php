<div id="middle_right_top">
<h2>Run Payroll</h2>
</div>

<?php

$tbl=$_GET['page'];
$tbl='payroll';
$field_edit=array('');
$field_show=array('name','empid');
$qual=NULL;
if(isset($_POST['modify']) ||  isset($_POST['update']))
{
echo input($tbl,$qual,$field_edit,$field_show);
}else
{
echo display($tbl,$qual,1,$field_show);
//addrow($tbl);
}

echo "<form name=\"myform\" action=\"#\" method=\"POST\">";
echo "<center><br><br>No.Of Working Days :<input type=\"text\" name=\"day\"></br></br></center>";
echo"<center>Month<select id=\"month2\" name=\"month\"></center>";
  echo"<option value=\"January\">January</option>";
  echo"<option value=\"Feburary\">Feburary</option>";
  echo"<option value=\"March\">March</option>";
  echo"<option value=\"April\">April</option>";
  echo"<option value=\"May\">May</option>";
  echo"<option value=\"June\">June</option>";
  echo"<option value=\"July\">July</option>";
  echo"<option value=\"August\">August</option>";
  echo"<option value=\"September\">september</option>";
  echo"<option value=\"October\">October</option>";
  echo"<option value=\"November\">November</option>";
  echo"<option value=\"December\">December</option>";
echo"</select>";
echo "<center><br><input name=\"submit\" type=\"submit\" value=\"Submit\"></br></center>";
echo "</form> ";
if(isset($_POST['submit']))
{
$monthname=$_POST['month'];
echo $monthname;
$noofdays;
switch($monthname)
{
case "January":
$noofdays=31;
break;
case "Feburary":
$noofdays=28;
break;
case "March":
$noofdays=31;
break;

case "April":
$noofdays=30;
break;
case "May":
$noofdays=31;
break;
case "June":
$noofdays=30;
break;
case "July":
$noofdays=31;
break;
case "August":
$noofdays=31;
break;
case "September":
$noofdays=30;
break;
case "October":
$noofdays=31;
break;
case "November":
$noofdays=30;
break;
case "December":
$noofdays=31;
break;
default:
echo "enter month name";
}
echo $noofdays;
}

function payroll($empid)
{
$host="localhost";
$username="root";
$password="";
$db_name="sms";
$tbl_name="master";


mysql_connect("$host", "$username", "$password") or die("cannot connect");

mysql_select_db ("$db_name") or die ("cannot select DB");


$sql="select *  from master where empid='$empid'";

$result=mysql_query($sql);

while($row = mysql_fetch_array($result))
{
$a=($row['hra']*($noofdays/$_POST['day']));
$b=($row['special_allowance']*($noofdays/$_POST['day']));
$c=($row['conveyance']*($noofdays/$_POST['day']));
$d=($row['child_education']*($noofdays/$_POST['day']));
$e=($row['basic']*($noofdays/$_POST['day']));
$salary=$a+$b+$c+$d+$e;

$sql="INSERT INTO master(empid, name, pan, pf_accno, emptype, doj, sex, tax_slab_exemption, basic, hra, special_allowance, conveyance, child_education, other, medical_reimbursement, performance_linked_incentives, monthly_gross)
VALUES('$row[empid]','$row[name]','$row[pan]','$row[pf_accno]','$row[emptype]','$row[doj]','$row[sex]','$row[tax_slab_exemption]','$e','$a','$b','$c','$d','$row[other]','$row[medical_reimbursement]','$row[performance_linked_incentives]','$salary')";
mysql_query($sql) or die (mysql_error());


return $salary;
}
}

payroll($row['empid']);
?>
