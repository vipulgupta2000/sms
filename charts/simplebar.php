<?php
 require_once('../auth.php');
 include('../lib/phpgraphlib.php');
//$query  = 'SELECT emp_name,sum(amount) as "amount" FROM purchase_order group by emp_name';
$query  = 'SELECT bill_to,sum(charges) as "amount" FROM invoice group by bill_to';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());   ;
while($row = mysql_fetch_array($result))
{
$count=$row['amount']*1;
$name=$row['bill_to'];
$data[$name]=$count;
  }
 $graph = new PHPGraphLib(650, 400);
$graph->addData($data);
$graph->setDatavalues(true);
$graph->setTitle('Widgets Produced');
$graph->setGradient('red', 'maroon');
$graph->createGraph();
?>