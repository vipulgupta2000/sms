	
<?php

//require('fpdf/fpdf.php');
require_once("auth.php");
//include("lib/insert.php");
//$v=$_POST['vip'];
//echo "EmpID<input name=\"empid\" type=\"text\" value=\"\">";
//echo "<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"report\" value=\"report\">";
//echo "EmpID<input name=\"empid\" type=\"text\" value=\"\">";
//echo "<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"report\" value=\"report\">";
//isset($_POST['month']) && isset($_POST['empid']))
$empid=isset($_POST['empid'])?$_POST['empid']:'1011';
//Get Master table details
$sql_master="select * from master where empid=$empid";//--
//echo $sql_master;
$resultm=mysql_query($sql_master) or die(mysql_error());
$memp=array();$mfields=array();
$sql_fields="select name,alias from field where tblid=(select tblid from config where name='master')";
$resultf=mysql_query($sql_fields) or die(mysql_error());
while($rowm=mysql_fetch_array($resultm))
{
$resultf=mysql_query($sql_fields) or die(mysql_error());
while($rowf=mysql_fetch_array($resultf))
{
$mfields[$rowf['name']]=$rowm[$rowf['name']];
}
//$memp[$empid]=$mfields;
$memp[$rowm['empid']]=$mfields;
}
//$memp['1011']=array('vipul'=>'great');
//$memp['1011']=array_add('neha');
//var_dump($memp);
//echo $empid;
//echo $memp[$empid]['name'];
$name=$memp[$empid]['name'];
$emp=$memp[$empid]['emptype'];
$doj='22/4/2014';//getmydate($memp[$empid]['doj']);
$pf=$memp[$empid]['pf_accno'];
$pan=$memp[$empid]['pan'];
$mbasic=$memp[$empid]['basic'];
$mhra=$memp[$empid]['hra'];
$mspecial_allowance=$memp[$empid]['special_allowance'];
$mconv=$memp[$empid]['conveyance'];
$mchild=$memp[$empid]['child_education'];
//if(isset($_POST['report'])) 
{
$sql="select * from payroll where year='2014' and month='4' and empid='$empid'";
//echo $sql;
$result=mysql_query($sql) or die(mysql_error());
while($row=mysql_fetch_array($result))
{
$basic=round($row['basic']);
$hra=$row['hra'];
$special_allowance=$row['special_allowance'];
$mgross=$row['monthly_gross'];
$ded=$row['monthly_deduction'];
$netsal=$row['net_salary'];
$conv=$row['conveyance'];
$child=$row['child_education'];
$mon=$row['month'];
$itax=$row['incometax_month'];
$pfded=$row['pf'];
$esi=$row['esi'];
$lwf=$row['lwf'];
$ptax=isset($row['ptax'])?$row['ptax']:0;
$aded=isset($row['arrear_deduction'])?$row['arrear_deduction']:0;
$plib=$row['performance_linked_incentives'];
$lap=$row['laptop_allowance'];
$oca=$row['on_call_allowance'];
$nsa=$row['night_shift'];
$arr_inc=$row['arrear_income'];
$yproj=$row['projected_income'];
$med=$row['medical_reimbursement'];
$taxable_inc=$row['taxable_income'];
$ntax=$row['projected_incometax'];
$hra_ex=$row['hra_exemption'];
$conv_ex=$row['conv_exemption'];
$ann_80c=$row['annual80c_savings'];
$ann_80d=$row['annual80d_savings'];

include('slipformat.php');
/*if($fh = fopen("slipformat.php","r")){
      while (!feof($fh)){
         $F1[] = fgets($fh,9999);
      }
      fclose($fh);
    } 
  
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
for($i=1;$i<=40;$i++)
 $pdf->Cell(0,10,$F1[$i],0,1);
//$pdf->Cell(40,10,"ello");
$pdf->Output();*/
}
}
 

?>
