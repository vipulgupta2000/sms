<div id="middle_right_top">
<h2>Approve</h2>
</div>

<?php
include('runpayroll.php');
  $tbl='master';
//$tbl='appraisal_master';
$field_edit=array('');
$field_show=array('');
$qual=NULL;
if(isset($_POST['modify']) ||  isset($_POST['update']))
{
echo input($tbl,$qual,$field_edit,$field_show);
}else
{
echo display($tbl,$qual,1,$field_show);
addrow($tbl);
}
echo "<form name=\"myform\" action=\"#\" method=\"POST\">";
echo "<center><br><input name=\"submit\" type=\"submit\" value=\"Submit\"></br></center>";
echo "</form> ";
$host="localhost";
$username="root";
$password="";
$db_name="sms";
$tbl_name="master";
mysql_connect("$host", "$username", "$password") or die("cannot connect");

mysql_select_db ("$db_name") or die ("cannot select DB");


$sql="select *  from master";
if(isset($_POST['submit']))
{
list($a,$b,$c,$d,$e,$salary)=payroll($row['empid']);
$result=mysql_query($sql);

while($row = mysql_fetch_array($result))

{
$sql="INSERT INTO master(empid, name, pan, pf_accno, emptype, doj, sex, tax_slab_exemption, basic, hra, special_allowance, conveyance, child_education, other, medical_reimbursement, performance_linked_incentives, monthly_gross)
VALUES('$row[empid]','$row[name]','$row[pan]','$row[pf_accno]','$row[emptype]','$row[doj]','$row[sex]','$row[tax_slab_exemption]','$e','$a','$b','$c','$d','$row[other]','$row[medical_reimbursement]','$row[performance_linked_incentives]','$salary')";
mysql_query($sql) or die (mysql_error());

}}
?>