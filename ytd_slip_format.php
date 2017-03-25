<?php

//$mgross_sum_result=0;$nsal_sum_result=0;$pf_sum_result=0;$hra_sum_result=0;$incometax_sum_result=0;
/*$mgross_sql = mysql_query("SELECT SUM(monthly_gross) FROM payroll where empid=".$_POST['emp']." and year = ".$_POST['year']);
$mgross_sum_result = mysql_result($mgross_sql,0);

$nsal_sql = mysql_query("SELECT SUM(net_salary) FROM payroll where empid=".$_POST['emp']." and year = ".$_POST['year']);
$nsal_sum_result = mysql_result($nsal_sql,0);

$pf_sql = mysql_query("SELECT SUM(pf) FROM payroll where empid=".$_POST['emp']." and year = ".$_POST['year']);
$pf_sum_result = mysql_result($pf_sql,0);

$hra_sql = mysql_query("SELECT SUM(hra) FROM payroll where empid=".$_POST['emp']." and year = ".$_POST['year']);
$hra_sum_result = mysql_result($hra_sql,0);

$incometax_sql = mysql_query("SELECT SUM(incometax_month) FROM payroll where empid=".$_POST['emp']." and year = ".$_POST['year']);
$incometax_sum_result = mysql_result($incometax_sql,0);*/

//echo "&nbsp";
//echo "<input class=\"btn btn-warning\" id=\"btn\" type=\"button\" name=\"print_sal\" value=\"Print\" onclick=\"goToURL()\">";



$a='';
$a=$a."<page>"."<table border=\"1\" id=\"pf_table\">\n";

$a=$a."<tbody>\n"; 
$a=$a."<tr>\n"; 
$a=$a."<td colspan=\"14\" rowspan=\"1\"><img src=\"images/logo.png\" alt=\"Logo\" width=\"125\" height=\"45\" /></td>\n"; 
$a=$a."</tr>\n"; 
$a=$a."<tr>\n"; 
$a=$a."<td colspan=\"14\" ><strong>Input Zero Technologies Pvt. Ltd.</strong></td>\n"; 

$a=$a."</tr>\n"; 
$a=$a."<tr>\n"; 
$a=$a."<td  colspan=\"14\" align=\"center\"><strong>Employee Yearly Employee Provident Fund (PF)</strong></td>\n"; 
$a=$a."</tr>\n"; 

$a=$a."<tr>\n"; 
$a=$a."<td></td>\n"; 
$a=$a."<td><strong>JAN</strong></td>\n"; 
$a=$a."<td><strong>FEB</strong></td>\n"; 
$a=$a."<td><strong>MAR</strong></td>\n"; 
$a=$a."<td><strong>APR</strong></td>\n"; 
$a=$a."<td><strong>MAY</strong></td>\n"; 
$a=$a."<td><strong>JUNE</strong></td>\n"; 
$a=$a."<td><strong>JULY</strong></td>\n"; 
$a=$a."<td><strong>AUG</strong></td>\n"; 
$a=$a."<td><strong>SEP</strong></td>\n"; 
$a=$a."<td><strong>OCT</strong></td>\n"; 
$a=$a."<td><strong>NOV</strong></td>\n"; 
$a=$a."<td><strong>DEC</strong></td>\n"; 
$a=$a."<td><strong>Total</strong></td>\n"; 
$a=$a."</tr>\n"; 

$a=$a."<tr>\n"; 
$a=$a."<td><strong>M. GROSS</strong></td>\n"; 
$a=$a."<td>$emp_mgross[0]</td>\n"; 
$a=$a."<td>$emp_mgross[1]</td>\n"; 
$a=$a."<td>$emp_mgross[2]</td>\n"; 
$a=$a."<td>$emp_mgross[3]</td>\n"; 
$a=$a."<td>$emp_mgross[4]</td>\n"; 
$a=$a."<td>$emp_mgross[5]</td>\n"; 
$a=$a."<td>$emp_mgross[6]</td>\n"; 
$a=$a."<td>$emp_mgross[7]</td>\n"; 
$a=$a."<td>$emp_mgross[8]</td>\n"; 
$a=$a."<td>$emp_mgross[9]</td>\n"; 
$a=$a."<td>$emp_mgross[10]</td>\n"; 
$a=$a."<td>$emp_mgross[11]</td>\n"; 
$a=$a."<td><strong>".($emp_mgross[0]+$emp_mgross[1]+$emp_mgross[2]+$emp_mgross[3]+$emp_mgross[4]+$emp_mgross[5]+$emp_mgross[6]+$emp_mgross[7]+$emp_mgross[8]+$emp_mgross[9]+$emp_mgross[10]+$emp_mgross[11])."</strong></td>\n"; 
$a=$a."</tr>\n";


$a=$a."<tr>\n"; 
$a=$a."<td><strong>NET PAY</strong></td>\n"; 
$a=$a."<td>$emp_netsal[0]</td>\n"; 
$a=$a."<td>$emp_netsal[1]</td>\n"; 
$a=$a."<td>$emp_netsal[2]</td>\n"; 
$a=$a."<td>$emp_netsal[3]</td>\n"; 
$a=$a."<td>$emp_netsal[4]</td>\n"; 
$a=$a."<td>$emp_netsal[5]</td>\n"; 
$a=$a."<td>$emp_netsal[6]</td>\n"; 
$a=$a."<td>$emp_netsal[7]</td>\n"; 
$a=$a."<td>$emp_netsal[8]</td>\n"; 
$a=$a."<td>$emp_netsal[9]</td>\n"; 
$a=$a."<td>$emp_netsal[10]</td>\n"; 
$a=$a."<td>$emp_netsal[11]</td>\n"; 
$a=$a."<td><strong>".($emp_netsal[0]+$emp_netsal[1]+$emp_netsal[2]+$emp_netsal[3]+$emp_netsal[4]+$emp_netsal[5]+$emp_netsal[6]+$emp_netsal[7]+$emp_netsal[8]+$emp_netsal[9]+$emp_netsal[10]+$emp_netsal[11])."</strong></td>\n"; 
$a=$a."</tr>\n";

$a=$a."<tr>\n"; 
$a=$a."<td><strong>PF Ded.</strong></td>\n"; 
$a=$a."<td>$emp_pfded[0]</td>\n"; 
$a=$a."<td>$emp_pfded[1]</td>\n"; 
$a=$a."<td>$emp_pfded[2]</td>\n"; 
$a=$a."<td>$emp_pfded[3]</td>\n"; 
$a=$a."<td>$emp_pfded[4]</td>\n"; 
$a=$a."<td>$emp_pfded[5]</td>\n"; 
$a=$a."<td>$emp_pfded[6]</td>\n"; 
$a=$a."<td>$emp_pfded[7]</td>\n"; 
$a=$a."<td>$emp_pfded[8]</td>\n"; 
$a=$a."<td>$emp_pfded[9]</td>\n"; 
$a=$a."<td>$emp_pfded[10]</td>\n"; 
$a=$a."<td>$emp_pfded[11]</td>\n"; 
$a=$a."<td><strong>".($emp_pfded[0]+$emp_pfded[1]+$emp_pfded[2]+$emp_pfded[3]+$emp_pfded[4]+$emp_pfded[5]+$emp_pfded[6]+$emp_pfded[7]+$emp_pfded[8]+$emp_pfded[9]+$emp_pfded[10]+$emp_pfded[11])."</strong></td>\n"; 
$a=$a."</tr>\n";

$a=$a."<tr>\n"; 
$a=$a."<td><strong>HRA</strong></td>\n"; 
$a=$a."<td>$emp_hra[0]</td>\n"; 
$a=$a."<td>$emp_hra[1]</td>\n"; 
$a=$a."<td>$emp_hra[2]</td>\n"; 
$a=$a."<td>$emp_hra[3]</td>\n"; 
$a=$a."<td>$emp_hra[4]</td>\n"; 
$a=$a."<td>$emp_hra[5]</td>\n"; 
$a=$a."<td>$emp_hra[6]</td>\n"; 
$a=$a."<td>$emp_hra[7]</td>\n"; 
$a=$a."<td>$emp_hra[8]</td>\n"; 
$a=$a."<td>$emp_hra[9]</td>\n"; 
$a=$a."<td>$emp_hra[10]</td>\n"; 
$a=$a."<td>$emp_hra[11]</td>\n"; 
$a=$a."<td><strong>".($emp_hra[0]+$emp_hra[1]+$emp_hra[2]+$emp_hra[3]+$emp_hra[4]+$emp_hra[5]+$emp_hra[6]+$emp_hra[7]+$emp_hra[8]+$emp_hra[9]+$emp_hra[10]+$emp_hra[11])."</strong></td>\n"; 
$a=$a."</tr>\n";

$a=$a."<tr>\n"; 
$a=$a."<td><strong>TAX</strong></td>\n"; 
$a=$a."<td>$emp_itax[0]</td>\n"; 
$a=$a."<td>$emp_itax[1]</td>\n"; 
$a=$a."<td>$emp_itax[2]</td>\n"; 
$a=$a."<td>$emp_itax[3]</td>\n"; 
$a=$a."<td>$emp_itax[4]</td>\n"; 
$a=$a."<td>$emp_itax[5]</td>\n"; 
$a=$a."<td>$emp_itax[6]</td>\n"; 
$a=$a."<td>$emp_itax[7]</td>\n"; 
$a=$a."<td>$emp_itax[8]</td>\n"; 
$a=$a."<td>$emp_itax[9]</td>\n"; 
$a=$a."<td>$emp_itax[10]</td>\n"; 
$a=$a."<td>$emp_itax[11]</td>\n"; 
$a=$a."<td><strong>".($emp_itax[0]+$emp_itax[1]+$emp_itax[2]+$emp_itax[3]+$emp_itax[4]+$emp_itax[5]+$emp_itax[6]+$emp_itax[7]+$emp_itax[8]+$emp_itax[9]+$emp_itax[10]+$emp_itax[11])."</strong></td>\n"; 
$a=$a."</tr>\n";

$jan_tot = 0;
$jan_tot = ($emp_mgross[0]+$emp_netsal[0]+$emp_pfded[0]+$emp_hra[0]+$emp_itax[0]);
$feb_tot = ($emp_mgross[1]+$emp_netsal[1]+$emp_pfded[1]+$emp_hra[1]+$emp_itax[1]);
$mar_tot = ($emp_mgross[2]+$emp_netsal[2]+$emp_pfded[2]+$emp_hra[2]+$emp_itax[2]);
$apr_tot = ($emp_mgross[3]+$emp_netsal[3]+$emp_pfded[3]+$emp_hra[3]+$emp_itax[3]);
$may_tot = ($emp_mgross[4]+$emp_netsal[4]+$emp_pfded[4]+$emp_hra[4]+$emp_itax[4]);
$jun_tot = ($emp_mgross[5]+$emp_netsal[5]+$emp_pfded[5]+$emp_hra[5]+$emp_itax[5]);
$july_tot = ($emp_mgross[6]+$emp_netsal[6]+$emp_pfded[6]+$emp_hra[6]+$emp_itax[6]);
$aug_tot = ($emp_mgross[7]+$emp_netsal[7]+$emp_pfded[7]+$emp_hra[7]+$emp_itax[7]);
$sep_tot = ($emp_mgross[8]+$emp_netsal[8]+$emp_pfded[8]+$emp_hra[8]+$emp_itax[8]);
$oct_tot = ($emp_mgross[9]+$emp_netsal[9]+$emp_pfded[9]+$emp_hra[9]+$emp_itax[9]);
$nov_tot = ($emp_mgross[10]+$emp_netsal[10]+$emp_pfded[10]+$emp_hra[10]+$emp_itax[10]);
$dec_tot = ($emp_mgross[11]+$emp_netsal[11]+$emp_pfded[11]+$emp_hra[11]+$emp_itax[11]);

$grand_tot=0;
$grand_tot = $apr_tot + $may_tot + $jun_tot + $july_tot + $aug_tot + $sep_tot + $oct_tot + $nov_tot + $dec_tot + $jan_tot + $feb_tot + $mar_tot;
 
$a=$a."<tr>\n"; 
$a=$a."<td><strong>Total</strong></td>\n"; 
$a=$a."<td><strong>$jan_tot</strong></td>\n"; 
$a=$a."<td><strong>$feb_tot</strong></td>\n"; 
$a=$a."<td><strong>$mar_tot</strong></td>\n"; 
$a=$a."<td><strong>$apr_tot</strong></td>\n"; 
$a=$a."<td><strong>$may_tot</strong></td>\n"; 
$a=$a."<td><strong>$jun_tot</strong></td>\n"; 
$a=$a."<td><strong>$july_tot</strong></td>\n"; 
$a=$a."<td><strong>$aug_tot</strong></td>\n"; 
$a=$a."<td><strong>$sep_tot</strong></td>\n"; 
$a=$a."<td><strong>$oct_tot</strong></td>\n"; 
$a=$a."<td><strong>$nov_tot</strong></td>\n"; 
$a=$a."<td><strong>$dec_tot</strong></td>\n";
$a=$a."<td><strong>".$grand_tot."</td>\n"; 
$a=$a."</tr>\n";
 

$a=$a."</tbody>\n"; 
$a=$a."</table>\n"."</page>";
echo $a;


?>
