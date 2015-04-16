 <?php
function getPagelink($iteration)
	{
	echo "<ul class=\"pagination\"><li><a href=\"#\">&laquo;</a></li>";
	for($i=1;$i<=$iteration;$i++)
	{ echo "<li><a href=home.php?page=".$_GET['page']."&num=".$i;
	echo ">".$i."</a></li>";
	}$x=$i-1;echo "<li><a href=\"home.php?page=".$_GET['page']."&num=".$x."\">&raquo;</a></li></ul>";
	}

function getPagesql($sql,$rec_limit)
	{

		$start=0;

		$result_page=mysql_query($sql);
		$total=mysql_num_rows($result_page);

		if(isset($_GET['num']))
		{$start=(($_GET['num'])-1)*$rec_limit;

		}
		if(ceil($total/$rec_limit)>1)
		getPagelink(ceil($total/$rec_limit));
		$sql=$sql." limit ".$start.", ".$rec_limit;
		return $sql;
	}

function getmydate($time)
{
$tdate = date_create();
date_timestamp_set($tdate,$time);
return date_format($tdate, 'd-m-Y');
}

function setmydate($time)
{
$ts1 = date_create($time);
return date_format($ts1,'U');
}

function firstOfMonth($m)
{
return date("Y/n/j", mktime(0,0,0,$m,'01',date("Y")));
}

function lastOfMonth($m)
{
$m=$m+1;
return date("w:D:Y/n/j", mktime(0,0,0,$m,0,date("Y")));
}

function openpayroll($month)
{
$year=2014;
$mdays=cal_days_in_month(CAL_GREGORIAN, $month, $year);
echo $mdays;
$sql_pay="select * from payroll where month=$month and year=$year";
//echo $sql_pay;
$result_pay=mysql_query($sql_pay) or die(mysql_error());
$payr = array();$b='';$a='';
while($row_pay=mysql_fetch_array($result_pay))
{
$payr[$row_pay['empid']]=$row_pay['days'];
//echo $row_pay['empid'],$row_pay['days'];
}
var_dump($payr);	
//print_r($result_pay);


$cnt=$_POST['icnt'];
$i=0;
while($i<$cnt)
{if(isset($_POST['days'.$i]))
{
$sql_master="select * from master where empid='$_POST[empid.$i]'";
$result=mysql_query($sql_master) or die(mysql_error());
while($row=mysql_fetch_array($result))
{
$b='';
if($row['doj']>setmydate(firstOfMonth($month)))
echo "first day".setmydate(firstOfMonth($month))." of this month";	
echo "all peace";
$a=$_POST['days'.$i]/$mdays;
$b=$b." basic=".$row['basic']*$a;
$b=$b.", hra=".$row['hra']*$a;
$b=$b.", special_allowance=".$row['special_allowance']*$a;
$b=$b.", conveyance=".$row['conveyance']*$a;
$b=$b.", child_education=".$row['child_education']*$a;
$b=$b.", performance_linked_incentives=".$row['performance_linked_incentives']*$a;
$b="insert into payroll values ".$b." where empid='$row[empid]' and month=$month and year=$year";
echo $b;
$b='';

}
}
$i++;
}

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