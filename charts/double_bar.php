<?php
 require_once('../auth.php');
 include('../lib/phpgraphlib.php');
$query  = 'SELECT emp_name,sum(amount) as "amount" FROM purchase_order group by emp_name';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result))
{
$count=$row['amount']*1;
$name=$row['emp_name'];
$data[$name]=$count;
  }
$query1  = 'SELECT employee,sum(total) as "amount" FROM invoice group by employee';
$result1 = mysql_query($query1) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result1))
{
$count=$row['amount']*1;
$name=$row['employee'];
$data1[$name]=$count;
  }

$graph = new PHPGraphLib(600, 350);
$graph->addData($data,$data1);
$graph->setBarColor('blue', 'green');
$graph->setTitle('Company Production');
$graph->setupYAxis(12, 'blue');
$graph->setupXAxis(20);
$graph->setGrid(false);
$graph->setLegend(true);
$graph->setTitleLocation('left');
$graph->setTitleColor('blue');
$graph->setLegendOutlineColor('white');
$graph->setLegendTitle('Week-37', 'Week-38');
$graph->setXValuesHorizontal(true);
$graph->createGraph();

?>
