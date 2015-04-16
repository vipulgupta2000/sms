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

?>