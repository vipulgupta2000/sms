<?php


function insert()
{
$tbl_name="payroll";
mysql_connect("$host", "$username", "$password") or die("cannot connect");

mysql_select_db ("$db_name") or die ("cannot select DB");

$sql2="select * from payroll where empid='$_POST[empid]' and month='$x' and year='$_POST[year]'";

if(isset($_POST['submit']))
{
while($row = mysql_fetch_array($result))
{


$newytdtax=$row['ytd_taxpaid']+$row['incometax_month'];
$newytdincome=$row['ytd_income']+$row['monthly_gross'];
$newytdhra=$row['ytd_hra_exemption']+$row['hra_exemption'];
$newytdcexm=$row['ytd_conv_exemption']+$row['conv_exemption'];
$newtaxableincome=($row['projected_income']-($newhra*12)-($newcon*12)-$row['annual80c_savings']);





$sql="INSERT INTO payroll(empid,name,days,month,year,days_quarter,basic,hra,special_allowance,conveyance,child_education,laptop_allowance,medical_reimbursement,performance_linked_incentives,arrear_income,on_call_allowance,monthly_gross,projected_income,hra_exemption,conv_exemption,annual80c_savings,annual80d_savings,medicalreimbursement,taxable_income,projected_incometax,pf,incometax_month,professional_tax,arrear_deduction, esi, monthly_deduction,net_salary,sex,min_slab,nett_tax,surcharge,cess,total_tax,medical_premium,ytd_taxpaid,ytd_income,ytd_hra_exemption,ytd_conv_exemption) VALUES
}
