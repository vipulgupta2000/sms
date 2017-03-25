<?php
require('fpdf/fpdf.php');
require_once('auth.php');

$year = $_POST['year'];

/* Code Added in v3  for giving different empid for admin and user*/
if($_SESSION['SESS_perm']=='admin' || $_SESSION['SESS_perm']=='sys_admin'){
	$emp_id = $_POST['emp'];
}
else{
	$emp_id = $_SESSION['SESS_empid'];
}
/* Code Added in v3  for giving different empid for admin and user*/

for($i=0;$i<12;$i++)
{
	$emp_mgross[$i] = 0;
	$emp_netsal[$i] = 0;
	$emp_pfded[$i] = 0;
	$emp_hra[$i] = 0;
	$emp_itax[$i] = 0;
}

$sql_payroll = "select monthly_gross,net_salary,pf,hra,incometax_month,month from payroll where empid='$emp_id' and year = ".$year." order by month";
$query_payroll = mysql_query($sql_payroll);

while($row = mysql_fetch_array($query_payroll))
{
	$temp = $row['month'];
	$emp_mgross[$temp-1] = $row['monthly_gross'];
	$emp_netsal[$temp-1] = $row['net_salary'];
	$emp_pfded[$temp-1] = $row['pf'];
	$emp_hra[$temp-1] = $row['hra'];
	$emp_itax[$temp-1] = $row['incometax_month'];
	$temp = 0;
}

$mgross_sum_result = 0;
$nsal_sum_result = 0;
$pf_sum_result = 0;
$hra_sum_result = 0;
$incometax_sum_result =0;

$mgross_sql = mysql_query("SELECT SUM(monthly_gross) FROM payroll where empid='$emp_id' and year = ".$year);
$mgross_sum_result = mysql_result($mgross_sql,0);


$nsal_sql = mysql_query("SELECT SUM(net_salary) FROM payroll where empid='$emp_id' and year = ".$year);
$nsal_sum_result = mysql_result($nsal_sql,0);

$pf_sql = mysql_query("SELECT SUM(pf) FROM payroll where empid='$emp_id' and year = ".$year);
$pf_sum_result = mysql_result($pf_sql,0);

$hra_sql = mysql_query("SELECT SUM(hra) FROM payroll where empid='$emp_id' and year = ".$year);
$hra_sum_result = mysql_result($hra_sql,0);

$incometax_sql = mysql_query("SELECT SUM(incometax_month) FROM payroll where empid='$emp_id' and year = ".$year);
$incometax_sum_result = mysql_result($incometax_sql,0);


$jan_tot = 0;$feb_tot = 0;$mar_tot = 0;$apr_tot = 0;$may_tot = 0;$jun_tot = 0;$july_tot = 0;$aug_tot = 0;$sep_tot = 0;$oct_tot = 0;$nov_tot = 0;$dec_tot = 0;

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


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
//$pdf->Cell(40,5,'This is FPDF Testing');
$pdf->Image('images/logo.png',14,12,30); //display image logo
$pdf->Cell(192,15,'',1,0,'L',0);
$pdf->Ln(); //new line
$pdf->Cell(192,7,'Input Zero Technologies PVT LTD',1,0,'L',0);
$pdf->Ln();
$pdf->Cell(192,7,'Employee Year Till Date',1,0,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'',1,0,'L',0);
$pdf->Cell(13,7,'JAN',1,0,'L',0);
$pdf->Cell(13,7,'FEB',1,0,'L',0);
$pdf->Cell(13,7,'MAR',1,0,'L',0);
$pdf->Cell(13,7,'APR',1,0,'L',0);
$pdf->Cell(13,7,'MAY',1,0,'L',0);
$pdf->Cell(13,7,'JUNE',1,0,'L',0);
$pdf->Cell(13,7,'JULY',1,0,'L',0);
$pdf->Cell(13,7,'AUG',1,0,'L',0);
$pdf->Cell(13,7,'SEP',1,0,'L',0);
$pdf->Cell(13,7,'OCT',1,0,'L',0);
$pdf->Cell(13,7,'NOV',1,0,'L',0);
$pdf->Cell(13,7,'DEC',1,0,'L',0);

$pdf->Cell(15,7,'TOTAL',1,0,'L',0);
$pdf->Ln();

$pdf->Cell(21,7,'M. GROSS',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(13,7,$emp_mgross[0],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[1],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[2],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[3],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[4],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[5],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[6],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[7],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[8],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[9],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[10],'1',0,'L',0);
$pdf->Cell(13,7,$emp_mgross[11],'1',0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,$mgross_sum_result,'1',0,'L',0);

$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'NET PAY',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(13,7,$emp_netsal[0],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[1],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[2],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[3],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[4],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[5],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[6],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[7],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[8],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[9],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[10],'1',0,'L',0);
$pdf->Cell(13,7,$emp_netsal[11],'1',0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,$nsal_sum_result,'1',0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'PF DED.',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(13,7,$emp_pfded[0],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[1],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[2],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[3],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[4],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[5],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[6],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[7],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[8],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[9],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[10],'1',0,'L',0);
$pdf->Cell(13,7,$emp_pfded[11],'1',0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,$pf_sum_result,'1',0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'HRA',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(13,7,$emp_hra[0],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[1],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[2],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[3],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[4],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[5],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[6],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[7],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[8],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[9],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[10],'1',0,'L',0);
$pdf->Cell(13,7,$emp_hra[11],'1',0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,$hra_sum_result,'1',0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'TAX',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(13,7,$emp_itax[0],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[1],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[2],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[3],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[4],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[5],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[6],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[7],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[8],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[9],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[10],'1',0,'L',0);
$pdf->Cell(13,7,$emp_itax[11],'1',0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,$incometax_sum_result,'1',0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'TOTAL',1,0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(13,7,$jan_tot,1,0,'L',0);
$pdf->Cell(13,7,$feb_tot,1,0,'L',0);
$pdf->Cell(13,7,$mar_tot,1,0,'L',0);
$pdf->Cell(13,7,$apr_tot,1,0,'L',0);
$pdf->Cell(13,7,$may_tot,1,0,'L',0);
$pdf->Cell(13,7,$jun_tot,1,0,'L',0);
$pdf->Cell(13,7,$july_tot,1,0,'L',0);
$pdf->Cell(13,7,$aug_tot,1,0,'L',0);
$pdf->Cell(13,7,$sep_tot,1,0,'L',0);
$pdf->Cell(13,7,$oct_tot,1,0,'L',0);
$pdf->Cell(13,7,$nov_tot,1,0,'L',0);
$pdf->Cell(13,7,$dec_tot,1,0,'L',0);

$pdf->Cell(15,7,$grand_tot,1,0,'L',0);

$pdf->Ln();
$pdf->Cell(192,20,'*This is the System Generated Slip. No Signature required',1,0,'C',0);

$pdf->output();
?>