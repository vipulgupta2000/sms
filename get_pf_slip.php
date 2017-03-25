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

for($i=0;$i<12;$i++){
	$emp_pfded[$i] = 0;
}
$sql_payroll = "select pf,month from payroll where empid='$emp_id' and year = ".$year." order by month";
$query_payroll = mysql_query($sql_payroll);
while($row = mysql_fetch_array($query_payroll)){
$temp = $row['month'];
$emp_pfded[$temp-1] = $row['pf'];
$temp = 0;
}
//$tot=($emp_pfded[0]+$emp_pfded[1]+$emp_pfded[2]+$emp_pfded[3]+$emp_pfded[4]+$emp_pfded[5]+$emp_pfded[6]+$emp_pfded[7]+$emp_pfded[8]+$emp_pfded[9]+$emp_pfded[10]+$emp_pfded[11]);

$pf_sql = mysql_query("SELECT SUM(pf) FROM payroll where empid='$emp_id' and year = ".$year);
$pf_sum_result = mysql_result($pf_sql,0);

$grand_tot=0;
$grand_tot=$pf_sum_result+$pf_sum_result;

$jan_tot = ($emp_pfded[0]+$emp_pfded[0]);
$feb_tot = ($emp_pfded[1]+$emp_pfded[1]);
$mar_tot = ($emp_pfded[2]+$emp_pfded[2]);
$apr_tot = ($emp_pfded[3]+$emp_pfded[3]);
$may_tot = ($emp_pfded[4]+$emp_pfded[4]);
$jun_tot = ($emp_pfded[5]+$emp_pfded[5]);
$july_tot = ($emp_pfded[6]+$emp_pfded[6]);
$aug_tot = ($emp_pfded[7]+$emp_pfded[7]);
$sep_tot = ($emp_pfded[8]+$emp_pfded[8]);
$oct_tot = ($emp_pfded[9]+$emp_pfded[9]);
$nov_tot = ($emp_pfded[10]+$emp_pfded[10]);
$dec_tot = ($emp_pfded[11]+$emp_pfded[11]);



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
//$pdf->Cell(40,5,'This is FPDF Testing');
$pdf->Image('images/logo.png',14,12,30); //display image logo
$pdf->Cell(40,15,'','LTB',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(0,15,'','TBR',0,'L',0);
$pdf->Ln(); //new line
$pdf->Cell(0,7,'Input Zero Technologies PVT LTD',1,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,10,'Employee Yearly Employee Provident Fund (PF)',1,0,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,$year,1,0,'L',0);
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
$pdf->Cell(13,7,'TOTAL',1,0,'L',0);

$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'PF Ded.',1,0,'L',0);
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
$pdf->Cell(13,7,$pf_sum_result,'1',0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'PF Emp.',1,0,'L',0);

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
$pdf->Cell(13,7,$pf_sum_result,'1',0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,7,'TOTAL',1,0,'L',0);
$pdf->SetFont('Arial','B',9);

$pdf->Cell(13,7,$jan_tot,'1',0,'L',0);
$pdf->Cell(13,7,$feb_tot,'1',0,'L',0);
$pdf->Cell(13,7,$mar_tot,'1',0,'L',0);
$pdf->Cell(13,7,$apr_tot,'1',0,'L',0);
$pdf->Cell(13,7,$may_tot,'1',0,'L',0);
$pdf->Cell(13,7,$jun_tot,'1',0,'L',0);
$pdf->Cell(13,7,$july_tot,'1',0,'L',0);
$pdf->Cell(13,7,$aug_tot,'1',0,'L',0);
$pdf->Cell(13,7,$sep_tot,'1',0,'L',0);
$pdf->Cell(13,7,$oct_tot,'1',0,'L',0);
$pdf->Cell(13,7,$nov_tot,'1',0,'L',0);
$pdf->Cell(13,7,$dec_tot,'1',0,'L',0);
$pdf->Cell(13,7,$grand_tot,'1',0,'L',0);

$pdf->Ln();
$pdf->Cell(0,20,'*This is the System Generated Slip. No Signature required',1,0,'C',0);

$pdf->output();
?>
