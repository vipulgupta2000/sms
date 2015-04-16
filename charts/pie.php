<?php
 require_once('../auth.php');
include('../lib/phpgraphlib.php');
include('../lib/phpgraphlib_pie.php');
//$data = array("CBS" => 6.3, "NBC" => 4.5,"FOX" => 2.8, "ABC" => 2.7, "CW" => 1.4);
$query  = 'SELECT bill_to,sum(charges) as "amount" FROM invoice group by bill_to';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result))
{
$count=$row['amount']*1;
$name=$row['bill_to'];
$data[$name]=$count;
  }
$graph = new PHPGraphLibPie(400, 200);
$graph->addData($data);
$graph->setTitle('Top Customers Share');
$graph->setDatavalues(true);
$graph->setLabelTextColor('50, 50, 50');
$graph->setLegendTextColor('50, 50, 50');
$graph->createGraph();
