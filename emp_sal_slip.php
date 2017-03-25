<?php
require('fpdf/fpdf.php');
require_once('auth.php');

$month = $_POST['month'];
$year = $_POST['year'];
$sal_start = "01-".$month."-".$year;
$ts1 = date_create($sal_start);
$sal_start = date_format($ts1,'U');

/* Code Added in v3  for giving different empid for admin and user*/
if($_SESSION['SESS_perm']=='admin' || $_SESSION['SESS_perm']=='sys_admin'){
	$empid = $_POST['emp'];
}
else{
	$empid = $_SESSION['SESS_empid'];
}
/* Code Added in v3  for giving different empid for admin and user*/

$monthName = date("F", mktime(0, 0, 0, $month, 10));
$month_y = $monthName." ".$year;

if($_SESSION['SESS_perm']=='admin' || $_SESSION['SESS_perm']=='sys_admin'){
	$sql = "SELECT * FROM master WHERE empid = '$empid' and sdate <= '$sal_start' and edate = (select min(edate) from master where empid = '$empid' and edate >= '$sal_start')";
	}
else{
	$sql = "SELECT * FROM master WHERE empid = '$empid' and sdate <= '$sal_start' and edate = (select min(edate) from master where empid = '$empid' and edate >= '$sal_start')";
}


$query = mysql_query($sql);

while($row = mysql_fetch_array($query))
{
	$emp_mbasic = $row['basic'];
	$emp_mhra = $row['hra'];
	$emp_mspecial_allowance = $row['special_allowance'];
	$emp_mconveyance = $row['conveyance'];
	$emp_mchild_education = $row['child_education'];
	$emp_type = $row['emptype'];
	$d=$row['doj'];
	$emp_doj = date('d-m-Y',$d);
	$emp_pf_accno = $row['pf_accno'];
	$emp_pan = $row['pan'];
	$emp_uan = $row['uan_number'];
}


if($_SESSION['SESS_perm']=='admin' || $_SESSION['SESS_perm']=='sys_admin'){
	$sql_payroll = "select * from payroll where empid='$empid' and month = ".$month." and year = ".$year;
}
else{
	$sql_payroll = "select * from payroll where empid='$empid' and month = ".$month." and year = ".$year;
}

$query_payroll = mysql_query($sql_payroll);
$num = mysql_num_rows($query_payroll);
if ($num <= 0){
 echo "<h3><center>Sorry, Salary slip is not Generated Yet.....!!!</center></h3>";
}
 
else{   

while($row = mysql_fetch_array($query_payroll)){
	$emp_id = $row['empid'];
	$emp_name = $row['name'];
	$emp_mdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$emp_days = $row['days'];
	$emp_days_quater = $row['days_quarter'];
	$emp_basic = $row['basic'];	
	$emp_hra = $row['hra'];
	$emp_special_allowance = $row['special_allowance'];
	$emp_conveyance = $row['conveyance'];
	$emp_child_education = $row['child_education'];
	$emp_oncall = $row['on_call_allowance'];
	$emp_nightshift = $row['night_shift'];
	$emp_medical = $row['medical_reimbursement'];
	$emp_laptop = $row['laptop_allowance'];
	$emp_pli = $row['performance_linked_incentives'];	
	$emp_arrear_income = $row['arrear_income'];
	$emp_mgross = $row['monthly_gross'];
	$emp_netsal = $row['net_salary'];
	$emp_itax = $row['incometax_month'];
	$emp_pfded = $row['pf'];
	$emp_esi = $row['esi'];
	$emp_ptax = $row['professional_tax'];
	$emp_lwf = $row['lwf'];	
	$emp_aded = $row['arrear_deduction'];
	$emp_ded = $row['monthly_deduction'];
	$emp_yproj = $row['projected_income'];
	$emp_taxable_inc = $row['taxable_income'];
	$emp_nett_tax = $row['nett_tax'];
	$emp_proj_tax = $row['projected_incometax'];
	$emp_cess = $row['cess'];
	$emp_hra_ex = $row['hra_exemption'];
	$emp_conv_ex = $row['conv_exemption'];
	$emp_ann_80c = $row['annual80c_savings'];
	$emp_ann_80d = $row['annual80d_savings'];
	$emp_pa = $row['project_allowance'];
	$emp_ann_80g = $row['annual80g_savings'];
	$emp_int_house_loan = $row['int_house_loan'];
}
$pdf=new FPDF();
$pdf->AddPage();

//$pdf->Cell(40,5,'This is FPDF Testing');
$pdf->Cell(10,15,'','LT',0,'L',0);
$pdf->Image('images/logo.png',22,12,30); //display image logo
$pdf->Cell(170,15,'','T',0,'L',0);
$pdf->Cell(10,15,'','RT',0,'L',0);

$pdf->Ln(); //new line
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(100,6,'Input Zero Technologies PVT LTD','',0,'L',0);
$pdf->Cell(70,6,'Salary slip for the month of  '.$month_y,'',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Employee ID',1,0,'L',0);
$pdf->Cell(30,6,$emp_id,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'Month',1,'L',1);
$pdf->Cell(30,6,$monthName,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(170,6,'','',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Name',1,0,'L',0);

/*Code Changed in v3 for creating dynamic name field  and also changed some of width by  $newWidth and $newEmptyWidth */
$cellWidth = $pdf->GetStringWidth($emp_name);

if($cellWidth >= 30.00){
	$newWidth = $cellWidth + 5;
	$newEmptyWidth = 60-$cellWidth -5;
}
else{
	$newWidth = 30;
	$newEmptyWidth = 30;
}
/*Code Changed in v3 for creating dynamic name field  */

$pdf->Cell($newWidth, 6, $emp_name, '1', 0, 'R', 0);
$pdf->Cell($newEmptyWidth,6,'','',0,'L',0);
$pdf->Cell(40,6,'No. of Days',1,'L',1);
$pdf->Cell(30,6,$emp_mdays,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Employee Type',1,0,'L',0);
$pdf->Cell($newWidth,6,$emp_type,'1',0,'R',0);
$pdf->Cell($newEmptyWidth,6,'','',0,'L',0);
$pdf->Cell(40,6,'Actual',1,'L',1);
$pdf->Cell(30,6,$emp_days,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Date of Joining',1,0,'L',0);
$pdf->Cell($newWidth,6,$emp_doj,'1',0,'R',0);
$pdf->Cell($newEmptyWidth,6,'','',0,'L',0);
$pdf->Cell(40,6,'','','L',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'PF Acc No.',1,0,'L',0);
$pdf->Cell($newWidth,6,$emp_pf_accno,'1',0,'R',0);
$pdf->Cell($newEmptyWidth,6,'','',0,'L',0);
$pdf->Cell(40,6,'','','L',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'UAN No.',1,0,'L',0);
$pdf->Cell($newWidth,6,$emp_uan,'1',0,'R',0);
$pdf->Cell($newEmptyWidth,6,'','',0,'L',0);
$pdf->Cell(40,6,'No of Days in Quarter',1,'L',1);
$pdf->Cell(30,6,$emp_days_quater,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Pan No.',1,0,'L',0);
$pdf->Cell($newWidth,6,$emp_pan,'1',0,'R',0);
$pdf->Cell($newEmptyWidth,6,'','',0,'L',0);
$pdf->Cell(40,6,'Actual',1,'L',1);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'','',0,'L',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->SetFont( 'Arial', 'B', 10 );
$pdf->Cell(100,6,'Gross Earning',1,0,'C',0);
$pdf->Cell(70,6,'Deductions',1,0,'C',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->SetFont( 'Arial', 'B', 9);
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Salary Head',1,0,'L',0);
$pdf->Cell(30,6,'Monthly','1',0,'R',0);
$pdf->Cell(30,6,'Earned','1',0,'R',0);
$pdf->Cell(40,6,'Head','1',0,'L',0);
$pdf->Cell(30,6,'Amount','1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->SetFont( 'Arial', '', 9);
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Basic',1,0,'L',0);
$pdf->Cell(30,6,$emp_mbasic,'1',0,'R',0);
$pdf->Cell(30,6,$emp_basic,'1',0,'R',0);
$pdf->Cell(40,6,'Income Tax',1,'L',1);
$pdf->Cell(30,6,$emp_itax,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'HRA',1,0,'L',0);
$pdf->Cell(30,6,$emp_mhra,'1',0,'R',0);
$pdf->Cell(30,6,$emp_hra,'1',0,'R',0);
$pdf->Cell(40,6,'PF',1,'L',1);
$pdf->Cell(30,6,$emp_pfded,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Special Allowance',1,0,'L',0);
$pdf->Cell(30,6,$emp_mspecial_allowance,'1',0,'R',0);
$pdf->Cell(30,6,$emp_special_allowance,'1',0,'R',0);
$pdf->Cell(40,6,'ESI',1,'L',1);
$pdf->Cell(30,6,$emp_esi,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Convenyance',1,0,'L',0);
$pdf->Cell(30,6,$emp_mconveyance,'1',0,'R',0);
$pdf->Cell(30,6,$emp_conveyance,'1',0,'R',0);
$pdf->Cell(40,6,'Professional Tax',1,'R',1);
$pdf->Cell(30,6,$emp_ptax,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Child Education',1,0,'L',0);
$pdf->Cell(30,6,$emp_mchild_education,'1',0,'R',0);
$pdf->Cell(30,6,$emp_child_education,'1',0,'R',0);
$pdf->Cell(40,6,'Labour Welfare Fund',1,'L',1);
$pdf->Cell(30,6,$emp_lwf,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Project Partner Incentive',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'R',0);
$pdf->Cell(30,6,$emp_pa,'1',0,'R',0);
$pdf->Cell(40,6,'Arrears',1,'L',1);
$pdf->Cell(30,6,$emp_aded,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'On Call Allowance',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,$emp_oncall,'1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Night Shift Allowance',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,$emp_nightshift,'1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Medical Reimbursement',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,'0','1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Laptop Allowance',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,$emp_laptop,'1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Bonus',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,$emp_pli,'1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Arrear Income',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,$emp_arrear_income,'1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Others',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,$emp_medical,'1',0,'R',0);
$pdf->Cell(40,6,'','','L',1);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(10,6,'','LR',0,'L',0);

$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Total','L',0,'L',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(30,6,$emp_mgross,'1',0,'R',0);
$pdf->Cell(40,6,'Total',1,'L',1);
$pdf->Cell(30,6,$emp_ded,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->SetFont( 'Arial', 'B', 10);
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(140,6,'Net Earning',1,0,'L',0);
$pdf->Cell(30,6,$emp_netsal,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(170,6,'','',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->SetFont( 'Arial', 'B', 10 );
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(70,6,'Tax Calculation',1,0,'C',0);
$pdf->Cell(30,6,'','L',0,'L',0);
$pdf->Cell(70,6,'Exemptions',1,0,'C',0);
$pdf->SetFont('Arial', '', 10 );
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Yearly Projection',1,0,'L',0);
$pdf->Cell(30,6,$emp_yproj,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'HRA Exemption',1,'L',1);
$pdf->Cell(30,6,$emp_hra_ex,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Taxable Salary',1,0,'L',0);
$pdf->Cell(30,6,$emp_taxable_inc,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'Conveyance',1,'L',1);
$pdf->Cell(30,6,$emp_conv_ex,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Net Tax',1,0,'L',0);
$pdf->Cell(30,6,$emp_nett_tax,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'80C Saving',1,'L',1);
$pdf->Cell(30,6,$emp_ann_80c,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Surcharge@10%',1,0,'L',0);
$pdf->Cell(30,6,'','1',0,'L',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'80D Exemption',1,'L',1);
$pdf->Cell(30,6,$emp_ann_80d,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Cess@3%',1,0,'L',0);
$pdf->Cell(30,6,$emp_cess,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'80G Exemption',1,'L',1);
$pdf->Cell(30,6,$emp_ann_80g,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Total Yearly Tax',1,0,'L',0);
$pdf->Cell(30,6,$emp_proj_tax,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'Interest on House Loan',1,'L',1);
$pdf->Cell(30,6,$emp_int_house_loan,'1',0,'R',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','L',0,'L',0);
$pdf->Cell(40,6,'Tax Per Month',1,0,'L',0);
$pdf->Cell(30,6,$emp_itax,'1',0,'R',0);
$pdf->Cell(30,6,'','',0,'L',0);
$pdf->Cell(40,6,'',0,'L',1);
$pdf->Cell(30,6,'','0',0,'L',0);
$pdf->Cell(10,6,'','R',0,'L',0);

$pdf->Ln();
$pdf->Cell(10,6,'','LB',0,'L',0);
$pdf->Cell(170,6,'','B',0,'L',0);
$pdf->Cell(10,6,'','RB',0,'L',0);

$pdf->Ln();
$pdf->Cell(0,20,'*This is the System Generated Slip. No Signature required',1,0,'C',0);

$pdf->output();
 }
?>
