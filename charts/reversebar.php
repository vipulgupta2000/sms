<?php
 require_once('../auth.php');
include('../lib/phpgraphlib.php');
$graph = new PHPGraphLib(650, 800);
$query1  = 'SELECT employee,sum(total) as "amount" FROM invoice where employee in ( select emp_name from purchase_order) group by employee';
$result1 = mysql_query($query1) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result1))
{
$count=$row['amount']*1;
$name=$row['employee'];
$data[$name]=$count;
  }
$graph->addData($data);
$graph->setBarColor('255,255,204');
$graph->setDatavalues(true);
$graph->setTitle('Money Made at XYZ Corp');
$graph->setTextColor('gray');
$graph->createGraph();
