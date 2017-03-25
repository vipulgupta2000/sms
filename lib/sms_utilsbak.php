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
openpayroll($month,$year);
}

function openpayroll($month,$year)
{
$mdays=cal_days_in_month(CAL_GREGORIAN, $month, $year);
//echo $mdays."<br>";
if($month>3)
$off=12-$month+3;
else
$off=3-$month;
$b='';$a='';
$sql_pay="select empid,sum(monthly_gross) ytdgross,sum(incometax_month) ytdtax,sum(pf) ytdpf,sum(esi) ytdesi,$mdays mdays,$month month from payroll where year=$year group by empid";
//echo $sql_pay;
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
$exempt[$row_exempt['empid']]=array('hra_exempt'=>$row_exempt['hra_exempt'],'conv_exempt'=>$row_exempt['conv_exempt'],'80c'=>$row_exempt['80c'],'80d'=>$row_exempt['80d'],'80g'=>$row_exempt['80g'],'int_house_loan'=>$row_exempt['int_house_loan']);
}

$cnt=$_POST['icnt'];
$i=0;
while($i<$cnt)
{
if(isset($_POST['chb'.$i]))
{
	
if(isset($_POST['days'.$i]))
{
$dbdate=setmydate('01'.'-'.$month.'-'.$year);
$mnth=$month+1;
$dbdate1=setmydate('01'.'-'.$mnth.'-'.$year);
$empid=$_POST['empid'.$i];
$sql_master="select * from master where empid=$empid and $dbdate between sdate and edate";
$result=mysql_query($sql_master) or die(mysql_error());
while($row=mysql_fetch_array($result))
{
$b='';$tot=0;$ded=0;
//if($row['doj']>setmydate(firstOfMonth($month)))
//echo "first day".setmydate(firstOfMonth($month))." of this month";	
//echo "all peace";
$days=$_POST['days'.$i];
$name=$_POST['name'.$i];
$sex=$row['sex'];
$pay_days=$days/$mdays;
$a=$pay_days;
//Salary Components calculation

$fname='basic';$basic=round($row['basic']*$a);$tot=$tot+$basic;$b=$b.$basic;
$fname=$fname.",".'hra';$hra=round($row['hra']*$a);$tot=$tot+$hra;$b=$b.",".$hra;
$fname=$fname.",".'special_allowance';$special_allowance=round($row['special_allowance']*$a);$tot=$tot+$special_allowance;$b=$b.",".$special_allowance;
$fname=$fname.",".'conveyance';$conveyance=round($row['conveyance']*$a);$tot=$tot+$conveyance;$b=$b.",".$conveyance;
$fname=$fname.",".'child_education';$child_education=round($row['child_education']*$a);$tot=$tot+$child_education;$b=$b.",".$child_education;
//PLIB is only given in March or September
if($month==9 || $month==3)
{$fname=$fname.",".'performance_linked_incentives';$plib=round($row['performance_linked_incentives']*$a);$tot=$tot+$plib;
$b=$b.",".$plib;
}
else
{$fname=$fname.",".'performance_linked_incentives';$plib=0;$b=$b.",".$plib;}
$fname=$fname.",".'laptop_allowance';$laptop_allowance=round($_POST['laptop_allowance'.$i]);$tot=$tot+$laptop_allowance;$b=$b.",".$laptop_allowance;
$fname=$fname.",".'medical_reimbursement';$med_reimbursement=round($_POST['medical_reimbursement'.$i]);$tot=$tot+$med_reimbursement;$b=$b.",".$med_reimbursement;
$fname=$fname.",".'project_allowance';$project_allowance=round($_POST['project_allowance'.$i]);$tot=$tot+$project_allowance;$b=$b.",".$project_allowance;
$fname=$fname.",".'arrear_income';$arrear_income=round($_POST['arrear_income'.$i]);$tot=$tot+$arrear_income;$b=$b.",".$arrear_income;
$fname=$fname.",".'on_call_allowance';$on_call_allowance=round($_POST['on_call_allowance'.$i]);$tot=$tot+$on_call_allowance;$b=$b.",".$on_call_allowance;
$fname=$fname.",".'night_shift';$night_shift=round($_POST['night_shift'.$i]);$tot=$tot+$night_shift;$b=$b.",".$night_shift;
$tot=round($tot);
$fname=$fname.",".'monthly_gross';$monthly_gross=$tot;$b=$b.",".$tot;
//yearly components
$fname=$fname.",".'projected_income';
$projected=projected($empid,$off,$payr,$row['monthly_gross'],$tot);if($row['edate']<$dbdate1)$projected=$tot;
$b=$b.",".$projected;
//Savings declaration
$fname=$fname.",".'hra_exemption';$hra_exempt=isset($exempt[$empid]['hra_exempt'])?round($exempt[$empid]['hra_exempt']):0;$sav=$hra_exempt;$b=$b.",".$hra_exempt;
$fname=$fname.",".'conv_exemption';$conv_exempt=isset($exempt[$empid]['conv_exempt'])?round($exempt[$empid]['conv_exempt']):0;$sav=$sav+$conv_exempt;$b=$b.",".$conv_exempt;
$fname=$fname.",".'annual80c_savings';$eightyc=isset($exempt[$empid]['80c'])?round($exempt[$empid]['80c']):0;$sav=$sav+$eightyc;$b=$b.",".$eightyc;
$fname=$fname.",".'annual80d_savings';$eightyd=isset($exempt[$empid]['80d'])?round($exempt[$empid]['80d']):0;$sav=$sav+$eightyd;$b=$b.",".$eightyd;
$fname=$fname.",".'annual80g_savings';$eightyg=isset($exempt[$empid]['80g'])?round($exempt[$empid]['80g']):0;$sav=$sav+$eightyg;$b=$b.",".$eightyg;
$fname=$fname.",".'int_house_loan';$int_house=isset($exempt[$empid]['int_house_loan'])?round($exempt[$empid]['int_house_loan']):0;$sav=$sav+$int_house;$b=$b.",".$int_house;
//Yearly Tax projected income minus savings
$fname=$fname.",".'taxable_income';$taxable_income=round($projected-$sav);$b=$b.",".$taxable_income;
$fname=$fname.",".'projected_incometax';$tax=round(tax($projected-$sav));$b=$b.",".$tax;
//Monthly deductions pf, esi , pt, lwf,total deduction
$ytdtax=isset($payr[$empid]['ytdtax'])?$payr[$empid]['ytdtax']:0;
$fname=$fname.",".'incometax_month';$tax_month=round(($tax-$ytdtax)/($off+1));$ded=$ded+$tax_month;$b=$b.",".$tax_month;
$fname=$fname.",".'pf';$pf=pf($row['basic'])*$a;$ded=$ded+$pf;$b=$b.",".$pf;
$fname=$fname.",".'esi';$esi=esi($tot,$row['monthly_gross']);$ded=$ded+$esi;$b=$b.",".$esi;
$fname=$fname.",".'professional_tax';$ptax=($row['ptax']==1)?ptax($monthly_gross):0;$ded=$ded+$ptax;$b=$b.",".$ptax;
$fname=$fname.",".'lwf';$lwf=($row['lwf']==1)?10:0;$ded=$ded+$lwf;$b=$b.",".$lwf;
$fname=$fname.",".'arrear_deduction';$arrded=isset($_POST['arrear_deduction'.$i])?round($_POST['arrear_deduction'.$i]):0;$ded=$ded+$arrded;$b=$b.",".$arrded;
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
$days_quarter = cal_day_quater($month,$year);
//$b="insert into payroll(empid,name,days,month,year,basic,hra,special_allowance,conveyance,child_education,performance_linked_incentives,monthly_gross,projected_income,projected_incometax,pf,esi,monthly_deduction) values('$empid','$name','$days','$month','$year',".$b.")";
//payroll(empid,name,days,month,year,basic,hra,special_allowance,conveyance,child_education,performance_linked_incentives,laptop_allowance,medical_reimbursement,arrear_income,on_call_allowance,night_shift,monthly_gross,projected_income,hra_exemption,conv_exemption,annual80c_savings,annual80d_savings,projected_incometax,incometax_month,pf,esi,professional_tax,lwf,arrear_deduction,monthly_deduction,net_salary)
//sql to actually generate Payroll entry
$sql = mysql_query("update loaded_payroll set status = 'Promoted' where empid='$empid' and month = ".$month." and year = ".$year);
//echo $sql;
$sql_query = mysql_query("select count(id) from payroll where empid='$empid' and month = ".$month." and year = ".$year." and status='Open'");
$sql_count = mysql_result($sql_query,0);
if($sql_count <= 0){
$b="insert into payroll(empid,status,name,days,days_quarter,month,year,sex,".$fname.") values('$empid','Open','$name','$days','$days_quarter','$month','$year','$sex',".$b.")";
//echo $b;
//$status="update master set status='run' where empid='$empid'";
//$status="insert into paystate(empid,month,year,status) values('$empid','$month','$year','active')";
//echo $b;
mysql_query($b) or die(mysql_error());
accounts_insert($empid,$name);
}
else{echo "sorry u cant";}
//mysql_query($status) or die(mysql_error());
$b='';

}
}
}
$i++;
}
}

function ptax($mgross)
{	

/*if($mgross <=15000)
	{if($mgross <10000)
	$ptax=0;
	else
	$ptax=150;}
*/
if($mgross<15000)
$ptax=0;
else
$ptax=200;
	
return $ptax;
}

function cal_day_quater($month,$year)  //Start Section Added by Anshul to Calculate Days in Quater
{
	
if($year%4==0){
//Start Switch case for Calculating Days in Quater for Leap Year
      switch($month)
		{
                 case 1:
				 case 2:
                 case 3:
                     $days_quater =91;
                      break;         
                 case 4://for the second case #31-59
                 case 5:
				 case 6:
                     $days_quater =91;
                      break;                 
                 case 7://for the third case #60-89
                 case 8:
				 case 9:
                      $days_quater =92;
                      break;                 
                 case 10://for the fourth case #90-100
                 case 11:
				 case 12:
                     $days_quater =92;
                      break;      
                 
		}
//End Switch case for Calculating Days in Quater for Leap Year
}
else{
//Start Switch case for Calculating Days in Quater for Non Leap Year
      switch($month)
		{
                 case 1:
				 case 2:
                 case 3:
                    $days_quater =90;
                      break;         
                 case 4://for the second case #31-59
                 case 5:
				 case 6:
                     $days_quater =91;
                      break;                 
                 case 7://for the third case #60-89
                 case 8:
				 case 9:
                    $days_quater =92;
                      break;                 
                 case 10://for the fourth case #90-100
                 case 11:
				 case 12:
                      $days_quater =92;
                      break;      
                 
		}
//End Switch case for Calculating Days in Quater for Non Leap Year
	
}
//End Section Added by Anshul to Calculate Days in Quater
return $days_quater;
}

function accounts_insert($empid,$name){
$query = mysql_query("SELECT max(id) FROM payroll where empid = ".$empid);
$result_id = mysql_result($query,0);
$sql_query = mysql_query("select monthly_gross,pf,incometax_month,lwf,professional_tax,month,year,net_salary,arrear_deduction from payroll where id = ".$result_id);

while($row = mysql_fetch_array($sql_query)){
 $sql_mgross = $row['monthly_gross'];
 $sql_pf = $row['pf'];
 $sql_incometax = $row['incometax_month'];
 $sql_lwf = $row['lwf'];
 $sql_ptax = $row['professional_tax'];
 $sql_nsal = $row['net_salary'];
 $sql_arr_ded = $row['arrear_deduction'];
 $sql_month = $row['month'];
 $sql_year = $row['year'];
}
$curr = date('U');

mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','Payroll','$name','$sql_mgross',0,'$sql_month','$sql_year')");
mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','PF','$name',0,'$sql_pf','$sql_month','$sql_year')");
mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','TDS','$name',0,'$sql_incometax','$sql_month','$sql_year')");
if($sql_lwf != 0){
mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','Labour Welfare Fund','$name',0,'$sql_lwf','$sql_month','$sql_year')");}
if($sql_ptax != 0){
mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','Professional Tax','$name',0,'$sql_ptax','$sql_month','$sql_year')");}
mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','Nett Salary','$name',0,'$sql_nsal','$sql_month','$sql_year')");			
mysql_query("insert into accounts (date,entry_from,name,dr,cr,month,year) values ('$curr','Arrear Deduction','$name',0,'$sql_arr_ded','$sql_month','$sql_year')");
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
$tot_temp = $tot;
$sql_tax = mysql_query("select tax_slab,rate from tax_slab");
while($row = mysql_fetch_array($sql_tax)){
	$tax_slab[] = $row['tax_slab'];
	$rate[] = $row['rate'];
}
$counter = count($tax_slab);
$tax_slab[-1] = 0;
$tax = 0;

for($i=$counter;$i>=0;$i--){	
	if($tot > $tax_slab[$i-1]){	
		$tax = ($tot - $tax_slab[$i-1]) * ($rate[$i-1]/100) + $tax;
		$tot = $tot - ($tot - $tax_slab[$i-1]);		
	}
}
//echo "Tot_tmp:".$tot_temp; 
if($tot_temp < 500000){$tax = $tax - 5000;}
$surcharge_rate = 0.12;
if($tot_temp > 10000000){$tax = $tax + ($tax*$surcharge_rate);}
$tax_s = $tax;
$tax = $tax + ($tax*0.02);
$tax = $tax + ($tax_s*0.01);

if($tax < 0){$tax = 0;}
return round($tax);

}

function projected($empid,$off,$payr,$mgross,$cgross)
{
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
