 <?php
 
 function createpage()
{

//Set Title
echo "<br /><br />";
echo "<textarea id=\"message\" name=\"message\" rows=\"15\" cols=\"80\">enter</textarea>";

if (get_magic_quotes_gpc()) $_POST = array_map('stripslashes', $_POST);

$message = isset($_POST['message']) ? addslashes($_POST['message']) : 'Message';
$title=isset($_POST['title']) ? addslashes($_POST['title']) : 'Title';
$title=cleanup($title);
$message_filter=cleanup($message);
//$message_filter=strtolower($cat[$category])." ".$title.$message_filter;

if(isset($_POST['submit']))
{

$tbl="mypack";
$time=time();

$sql="insert into $tbl (content) values('$message')";
//extractimage($message);
if(!$result=mysql_query($sql))
{ die(mysql_error());
}

}
echo "<input class=\"btn btn-primary\" name=\"submit\" type=\"submit\" value=\"Submit\" />";
}

function cleanup($msg)
{
$msg= strip_tags(html_entity_decode($msg));
//$msg=preg_replace('|[^a-zA-Z0-9_.,\s\t\r]|', '', $msg);
$msg=preg_replace('|[^a-zA-Z0-9_.,]([\s\t\r\n]+)|', '', $msg);
//$msg=preg_replace("|[']|", "", $msg);
$msg=strtolower ( $msg );
return $msg;
}

function getPagelink_1($iteration)
	{$x=1;$j=1;
        if(isset($_GET['num'])){$j=$_GET['num'];}
      
	echo "<ul class=\"pagination\"><li><a onclick=\"openPage(".$x.",'".$_GET['page']."');\" href=\"#\">&laquo;</a></li>";
	for($i=1;$i<=$iteration;$i++)
	{ 
            //  echo "j is $j";
            echo "<li><a ";
            if($i==$j) echo " class=\"active\" ";
            echo "onclick=openPage(".$i.",'".$_GET['page']."'".") href=\"#\"";
	echo ">".$i."</a></li>";
	}$x=$i-1;echo "<li><a onclick=\"openPage(".$x.",".$_GET['page'].");\" href=\"home.php?page=".$_GET['page']."&num=".$x."\">&raquo;</a></li></ul>";
	}
 
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
		getPagelink_1(ceil($total/$rec_limit));
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