<?php
//function returns array with field name and alias of the table
function tbldef($tbl)
{
$memp=array();$mfields=array();
$sql_fields="select fieldid,tblid,name,alias,type from field where tblid=(select tblid from config where name='$tbl')";
echo $sql_fields;
$resultf=mysql_query($sql_fields) or die("from here".mysql_error());
while($rowf=mysql_fetch_array($resultf))
{
$mfields[$rowf['alias']]=$rowf['name'];
$mfields[$rowf['name'].'type']=$rowf['type'];
$mfields[$rowf['name'].'fieldid']=$rowf['fieldid'];
$mfields[$rowf['name'].'tblid']=$rowf['tblid'];
}
//$memp[$empid]=$mfields;

//$memp['1011']=array('vipul'=>'great');
//$memp['1011']=array_add('neha');
//var_dump($mfields);
return $mfields;
}

//function returns array with field name and data of the table
function tblarray($tbl,$qual)
{
$sql_master="select * from $tbl where $qual";//--
echo $sql_master;
$resultm=mysql_query($sql_master) or die(mysql_error());
$memp=array();$mfields=array();
$sql_fields="select name,alias from field where tblid=(select tblid from config where name='$tbl')";
echo $sql_fields;
$resultf=mysql_query($sql_fields) or die("from here".mysql_error());
while($rowm=mysql_fetch_array($resultm))
{
$resultf=mysql_query($sql_fields) or die(mysql_error());
while($rowf=mysql_fetch_array($resultf))
{
$mfields[$rowf['name']]=$rowm[$rowf['name']];
}
//$memp[$empid]=$mfields;
$memp[$rowm['id']]=$mfields;
}
//$memp['1011']=array('vipul'=>'great');
//$memp['1011']=array_add('neha');
//var_dump($mfields);
return $memp;
}

function ytd($year)
{
$sql_pay="select empid,sum(monthly_gross) ytdgross,sum(incometax_month) ytdtax,sum(pf) ytdpf,sum(esi) ytdesi from payroll where year=$year group by empid";
echo $sql_pay;
$result_pay=mysql_query($sql_pay) or die(mysql_error());
$payr = array();
while($row_pay=mysql_fetch_array($result_pay))
{
$payr[$row_pay['empid']]=array('ytdgross'=>$row_pay['ytdgross'],'ytdtax'=>$row_pay['ytdtax'],'ytdpf'=>$row_pay['ytdpf']);
//echo $row_pay['empid'],$row_pay['days'];
}
//var_dump($payr);
return $payr;	
}

function validrun($month,$year)
{
$sql="select count(1) from paystate where month='$month' and year='$year'";
if($result=mysql_query($sql))
{
$row=mysql_result($result,0);
}else{die(mysql.error());}
if($row>0)
{echo "There is already a payroll for this month $month and year $year";}
else{
openpayroll($month,$year);
}

}

function openpayroll($month,$year)
{
$mdays=cal_days_in_month(CAL_GREGORIAN, $month, $year);
echo $mdays;
if($month>3)
$off=12-$month+3;
else
$off=3-$month;
$b='';$a='';


$sql_pay="select empid,sum(monthly_gross) ytdgross,sum(incometax_month) ytdtax,sum(pf) ytdpf,sum(esi) ytdesi,$mdays mdays,$month month from payroll where year=$year group by empid";
echo $sql_pay;
$result_pay=mysql_query($sql_pay) or die(mysql_error());
$payr = array();
while($row_pay=mysql_fetch_array($result_pay))
{
$payr[$row_pay['empid']]=array('ytdgross'=>$row_pay['ytdgross'],'ytdtax'=>$row_pay['ytdtax'],'ytdpf'=>$row_pay['ytdpf'],'month'=>$row_pay['month']);
//echo $row_pay['empid'],$row_pay['days'];
}
//var_dump($payr);
//print_r($result_pay);

$sql_exempt="select * from exemption where year=$year";
$result_exempt=mysql_query($sql_exempt) or die(mysql_error());
$exempt= array();
while($row_exempt=mysql_fetch_array($result_exempt))
{
$exempt[$row_exempt['empid']]=array('hra_exempt'=>$row_exempt['hra_exempt'],'conv_exempt'=>$row_exempt['conv_exempt'],'80c'=>$row_exempt['80c'],'80d'=>$row_exempt['80d']);
}

$cnt=$_POST['icnt'];
$i=0;
while($i<$cnt)
{
if(isset($_POST['chb'.$i]))
{
if(isset($_POST['days'.$i]))
{
$empid=$_POST['empid'.$i];
$sql_master="select * from master where empid=$empid";
$result=mysql_query($sql_master) or die(mysql_error());
while($row=mysql_fetch_array($result))
{
$b='';$tot=0;$ded=0;
//if($row['doj']>setmydate(firstOfMonth($month)))
//echo "first day".setmydate(firstOfMonth($month))." of this month";	
//echo "all peace";
$days=$_POST['days'.$i];
$name=$_POST['name'.$i];
$pay_days=$days/$mdays;
$a=$pay_days;
//Salary Components calculation

$fname='basic';$basic=round($row['basic']*$a);$tot=$tot+$row['basic']*$a;$b=$b.$basic;
$fname=$fname.",".'hra';$hra=round($row['hra']*$a);$tot=$tot+$row['hra']*$a;$b=$b.",".$hra;
$fname=$fname.",".'special_allowance';$special_allowance=round($row['special_allowance']*$a);$tot=$tot+$special_allowance*$a;$b=$b.",".$special_allowance;
$fname=$fname.",".'conveyance';$conveyance=round($row['conveyance']*$a);$tot=$tot+$row['conveyance']*$a;$b=$b.",".$conveyance;
$fname=$fname.",".'child_education';$child_education=round($row['child_education']*$a);$tot=$tot+$row['child_education']*$a;$b=$b.",".$child_education;
//PLIB is only given in March or September
if($month==9 || $month==3)
{$fname=$fname.",".'performance_linked_incentives';$plib=round($row['performance_linked_incentives']*$a);$tot=$tot+($plib*$a);
$b=$b.",".$plib;
}
else
{$fname=$fname.",".'performance_linked_incentives';$plib=0;$b=$b.",".$plib;}
$fname=$fname.",".'laptop_allowance';$laptop_allowance=round($_POST['laptop_allowance'.$i]);$tot=$tot+$laptop_allowance;$b=$b.",".$laptop_allowance;
$fname=$fname.",".'medical_reimbursement';$med_reimbursement=round($_POST['med_reimbursement'.$i]);$tot=$tot+$med_reimbursement;$b=$b.",".$med_reimbursement;
$fname=$fname.",".'arrear_income';$arrear_income=round($_POST['arrear_income'.$i]);$tot=$tot+$arrear_income;$b=$b.",".$arrear_income;
$fname=$fname.",".'on_call_allowance';$on_call_allowance=round($_POST['on_call_allowance'.$i]);$tot=$tot+$on_call_allowance;$b=$b.",".$on_call_allowance;
$fname=$fname.",".'night_shift';$night_shift=round($_POST['night_shift'.$i]);$tot=$tot+$night_shift;$b=$b.",".$night_shift;
$tot=round($tot);
$fname=$fname.",".'monthly_gross';$monthly_gross=$tot;$b=$b.",".$tot;
//yearly components
$fname=$fname.",".'projected_income';$projected=projected($empid,$off,$payr,$row['monthly_gross'],$tot);$b=$b.",".$projected;
//Savings declaration
$fname=$fname.",".'hra_exemption';$hra_exempt=isset($exempt[$empid]['hra_exempt'])?round($exempt[$empid]['hra_exempt']):0;$sav=$hra_exempt;$b=$b.",".$hra_exempt;
$fname=$fname.",".'conv_exemption';$conv_exempt=isset($exempt[$empid]['conv_exempt'])?round($exempt[$empid]['conv_exempt']):0;$sav=$sav+$conv_exempt;$b=$b.",".$conv_exempt;
$fname=$fname.",".'annual80c_savings';$eightyc=isset($exempt[$empid]['80c'])?round($exempt[$empid]['80c']):0;$sav=$sav+$eightyc;$b=$b.",".$eightyc;
$fname=$fname.",".'annual80d_savings';$eightyd=isset($exempt[$empid]['80d'])?round($exempt[$empid]['80d']):0;$sav=$sav+$eightyd;$b=$b.",".$eightyd;
//Yearly Tax projected income minus savings
$fname=$fname.",".'taxable_income';$taxable_income=round(tax($projected-$sav));$b=$b.",".$taxable_income;
$fname=$fname.",".'projected_incometax';$tax=round(tax($projected-$sav));$b=$b.",".$tax;
//Monthly deductions pf, esi , pt, lwf,total deduction
$ytdtax=isset($payr[$empid]['ytdtax'])?$payr[$empid]['ytdtax']:0;
$fname=$fname.",".'incometax_month';$tax_month=round(($tax-$ytdtax)/($off+1));$ded=$ded+$tax_month;$b=$b.",".$tax_month;
$fname=$fname.",".'pf';$pf=pf($row['basic']);$ded=$ded+$pf;$b=$b.",".$pf;
$fname=$fname.",".'esi';$esi=esi($tot,$row['monthly_gross']);$ded=$ded+$esi;$b=$b.",".$esi;
$fname=$fname.",".'professional_tax';$ptax=($row['ptax']==1)?ptax($monthly_gross):0;$ded=$ded+$ptax;$b=$b.",".$ptax;
$fname=$fname.",".'lwf';$lwf=($row['lwf']==1)?10:0;$ded=$ded+$lwf;$b=$b.",".$lwf;
$fname=$fname.",".'arrear_deduction';$arrded=isset($_POST['arrear_deduction'])?round($_POST['arrear_deduction']):0;$ded=$ded+$arrded;$b=$b.",".$arrded;
$fname=$fname.",".'monthly_deduction';$ded=round($ded);$b=$b.",".$ded;
//nett salary
$fname=$fname.",".'net_salary';$nsal=$monthly_gross-$ded;$b=$b.",".$nsal;

//tax compoents
/*nett_tax
surcharge
cess
total_tax
medical_premium
*/

//$b="insert into payroll(empid,name,days,month,year,basic,hra,special_allowance,conveyance,child_education,performance_linked_incentives,monthly_gross,projected_income,projected_incometax,pf,esi,monthly_deduction) values('$empid','$name','$days','$month','$year',".$b.")";
//payroll(empid,name,days,month,year,basic,hra,special_allowance,conveyance,child_education,performance_linked_incentives,laptop_allowance,medical_reimbursement,arrear_income,on_call_allowance,night_shift,monthly_gross,projected_income,hra_exemption,conv_exemption,annual80c_savings,annual80d_savings,projected_incometax,incometax_month,pf,esi,professional_tax,lwf,arrear_deduction,monthly_deduction,net_salary)
//sql to actually generate Payroll entry
$b="insert into payroll(empid,name,days,month,year,".$fname.") values('$empid','$name','$days','$month','$year',".$b.")";
//$status="update master set status='run' where empid='$empid'";
$status="insert into paystate(empid,month,year,status) values('$empid','$month','$year','active')";
echo $b;
mysql_query($b) or die(mysql_error());
mysql_query($status) or die(mysql_error());
$b='';

}
}
}
$i++;
}

}


function ptax($mgross)
{
if($mgross <=15000)
	{if($mgross <10000)
	$ptax=0;
	else
	$ptax=150;}
else
$ptax=200;
	
return $ptax;
}
function pf($basic)
{
$pf=round($basic*0.12);
return $pf;
}

function esi($mgross,$month_gross)
{
$esi=0;
if($mgross <= 15000 && $month_gross<15000)
$esi=round($mgross*0.0175);
return $esi;
}

function tax($tot)
{
if($tot>1000000)
$tax=0.3*($tot-1000000)+90000;
elseif($tot>500000)
$tax=0.2*($tot-500000)+30000;
elseif($tot>200000)
$tax=0.1*($tot-220000);
else
$tax=0;

return round($tax*1.03);
}

function projected($empid,$off,$payr,$mgross,$cgross)
{

echo "off is".$off;
$val=isset($payr[$empid]['ytdgross'])?$payr[$empid]['ytdgross']:0;
$val=$val+$cgross+(($off)*$mgross);

return $val;
}

function remhtm($b,$tbl)	
{
//preg_match_all('/<[^>]+>(.*)<\/[^>]+>/U',$b,$out, PREG_PATTERN_ORDER);
preg_match_all('/<th>(.*)<\/th>/U',$b,$out, PREG_PATTERN_ORDER);
$siz=sizeof($out[1]);
//print_r($out);
$hd= "<tr>";
for($i=0;$i<sizeof($out[0]);$i++)
{
	$hd=$hd.$out[0][$i];
}
$hd=$hd."</tr>";
preg_match_all('/<td>(.*)<\/td>/U',$b,$out, PREG_PATTERN_ORDER);
$j=1;

//echo "<ul><li>";
	$tg_top="<div class=\"table-responsive\"><table class=\"table hover table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_top_cl="</table></div>";

echo $tg_top.$hd."<tr>";
for($i=0;$i<sizeof($out[1]);$i++)
{
	{echo $out[0][$i];}
if($j==$siz)
{$j=0;
//echo "</li><li>";
echo "</tr><tr>";
}
	$j++;
}
echo $tg_top_cl."<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"modify\" value=\"modify\">";
}
?>