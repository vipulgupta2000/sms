function insert_data($tbl)
{
$sql=dbsql($tbl);
	$result1=mysql_query($sql);
$fname="";	$fval="";	$i=0;
	while($row = mysql_fetch_array($result1))
	{
		if(!$row['dbindex']=='primary')
		{
		$fname=$fname.$row['name'].",";
		if($row['type']=='date')
		$fval=$fval."".setmydate($_POST[$row['name'].$i]).",";
		else
		{$fval=$fval."'".$_POST[$row['name']]."',";
		//echo "fval is".$row['name'];
		}
		}
	}
$fname=chop($fname,",");
$fval=chop($fval,",");
$sqli="INSERT INTO ".$tbl." ( ".$fname." ) VALUES (".$fval.")";
if(!mysql_query($sqli))
		{
		die.mysql_error();
	}
}

