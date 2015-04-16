<?php
 require_once('../auth.php');
include('../lib//phpgraphlib.php');

$query  = 'SELECT emp_name,sum(amount) as "amount" FROM purchase_order group by emp_name';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result))
{
$count=$row['amount']*1;
$name=$row['emp_name'];
$data[$name]=$count;
  }
$query1  = 'SELECT employee,sum(total) as "amount" FROM invoice where employee in ( select emp_name from purchase_order) group by employee';
$result1 = mysql_query($query1) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result1))
{
$count=$row['amount']*1;
$name=$row['employee'];
$data2[$name]=$count;
  }
  $graph = new PHPGraphLib(520,380);
$graph->addData($data, $data2);
$graph->setBarColor('blue', 'green');
$graph->setTitle('Invoice PO Detail');
$graph->setupYAxis(12, 'blue');
$graph->setupXAxis(20);
$graph->setGrid(true);
$graph->setLegend(true);
$graph->setTitleLocation('left');
$graph->setTitleColor('blue');
$graph->setDatavalues(true);
$graph->setLegendOutlineColor('blue');
$graph->setLegendTitle('PO', 'Invoice');
$graph->setXValuesHorizontal(false);
$graph->createGraph();
