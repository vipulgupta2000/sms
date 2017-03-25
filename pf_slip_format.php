<?php
echo "&nbsp";
//echo "<input class=\"btn btn-warning\" id=\"btn\" type=\"button\" name=\"print_sal\" value=\"Print\" onclick=\"goToURL()\">";

$a='';
$a=$a."<page>"."<table border=\"1\" id=\"pf_table\">\n";

$a=$a."<tbody>\n"; 
$a=$a."<tr>\n"; 
$a=$a."<td colspan=\"14\" rowspan=\"1\"><img src=\"images/logo.png\" alt=\"Logo\" width=\"125\" height=\"45\" /></td>\n"; 
$a=$a."</tr>\n"; 
$a=$a."<tr>\n"; 
$a=$a."<td colspan=\"14\" ><strong>Input Zero Technologies Pvt. Ltd.</strong></td>\n"; 

$a=$a."</tr>\n"; 
$a=$a."<tr>\n"; 
$a=$a."<td  colspan=\"14\" align=\"center\"><strong>Employee Yearly Employee Provident Fund (PF)</strong></td>\n"; 
$a=$a."</tr>\n"; 
$y = $_POST['year'];
$a=$a."<tr>\n"; 
$a=$a."<td id=>$y</td>\n";
$a=$a."<td><strong>JAN</strong></td>\n"; 
$a=$a."<td><strong>FEB</strong></td>\n"; 
$a=$a."<td><strong>MAR</strong></td>\n";  
$a=$a."<td><strong>APR</strong></td>\n"; 
$a=$a."<td><strong>MAY</strong></td>\n"; 
$a=$a."<td><strong>JUNE</strong></td>\n"; 
$a=$a."<td><strong>JULY</strong></td>\n"; 
$a=$a."<td><strong>AUG</strong></td>\n"; 
$a=$a."<td><strong>SEP</strong></td>\n"; 
$a=$a."<td><strong>OCT</strong></td>\n"; 
$a=$a."<td><strong>NOV</strong></td>\n"; 
$a=$a."<td><strong>DEC</strong></td>\n"; 
$a=$a."<td><strong>TOTAL</strong></td>\n"; 
$a=$a."</tr>\n"; 

$a=$a."<tr>\n"; 
$a=$a."<td><strong>PF Deduction</strong></td>\n"; 
$a=$a."<td>$emp_pfded[0]</td>\n"; 
$a=$a."<td>$emp_pfded[1]</td>\n"; 
$a=$a."<td>$emp_pfded[2]</td>\n"; 
$a=$a."<td>$emp_pfded[3]</td>\n"; 
$a=$a."<td>$emp_pfded[4]</td>\n"; 
$a=$a."<td>$emp_pfded[5]</td>\n"; 
$a=$a."<td>$emp_pfded[6]</td>\n"; 
$a=$a."<td>$emp_pfded[7]</td>\n"; 
$a=$a."<td>$emp_pfded[8]</td>\n"; 
$a=$a."<td>$emp_pfded[9]</td>\n"; 
$a=$a."<td>$emp_pfded[10]</td>\n"; 
$a=$a."<td>$emp_pfded[11]</td>\n"; 
$a=$a."<td><strong>".($emp_pfded[0]+$emp_pfded[1]+$emp_pfded[2]+$emp_pfded[3]+$emp_pfded[4]+$emp_pfded[5]+$emp_pfded[6]+$emp_pfded[7]+$emp_pfded[8]+$emp_pfded[9]+$emp_pfded[10]+$emp_pfded[11])."</strong></td>\n"; 
$a=$a."</tr>\n";


$a=$a."<tr>\n"; 
$a=$a."<td><strong>PF Emp.</strong></td>\n"; 
$a=$a."<td>$emp_pfded[0]</td>\n"; 
$a=$a."<td>$emp_pfded[1]</td>\n"; 
$a=$a."<td>$emp_pfded[2]</td>\n"; 
$a=$a."<td>$emp_pfded[3]</td>\n"; 
$a=$a."<td>$emp_pfded[4]</td>\n"; 
$a=$a."<td>$emp_pfded[5]</td>\n"; 
$a=$a."<td>$emp_pfded[6]</td>\n"; 
$a=$a."<td>$emp_pfded[7]</td>\n"; 
$a=$a."<td>$emp_pfded[8]</td>\n"; 
$a=$a."<td>$emp_pfded[9]</td>\n"; 
$a=$a."<td>$emp_pfded[10]</td>\n"; 
$a=$a."<td>$emp_pfded[11]</td>\n"; 
$a=$a."<td><strong>".($emp_pfded[0]+$emp_pfded[1]+$emp_pfded[2]+$emp_pfded[3]+$emp_pfded[4]+$emp_pfded[5]+$emp_pfded[6]+$emp_pfded[7]+$emp_pfded[8]+$emp_pfded[9]+$emp_pfded[10]+$emp_pfded[11])."</strong></td>\n"; 
$a=$a."</tr>\n"; 

$a=$a."<tr>\n"; 
$a=$a."<td><strong>TOTAL</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[0]+$emp_pfded[0]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[1]+$emp_pfded[1]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[2]+$emp_pfded[2]) ."</td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[3]+$emp_pfded[3]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[4]+$emp_pfded[4]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[5]+$emp_pfded[5]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[6]+$emp_pfded[6]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[7]+$emp_pfded[7]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[8]+$emp_pfded[8]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[9]+$emp_pfded[9]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[10]+$emp_pfded[10]) ."</strong></td>\n"; 
$a=$a."<td><strong>". ($emp_pfded[11]+$emp_pfded[11]) ."</strong></td>\n"; 
$a=$a."<td><strong>".($emp_pfded[0]+$emp_pfded[1]+$emp_pfded[2]+$emp_pfded[3]+$emp_pfded[4]+$emp_pfded[5]+$emp_pfded[6]+$emp_pfded[7]+$emp_pfded[8]+$emp_pfded[9]+$emp_pfded[10]+$emp_pfded[11]+$emp_pfded[0]+$emp_pfded[1]+$emp_pfded[2]+$emp_pfded[3]+$emp_pfded[4]+$emp_pfded[5]+$emp_pfded[6]+$emp_pfded[7]+$emp_pfded[8]+$emp_pfded[9]+$emp_pfded[10]+$emp_pfded[11])."</strong></td>\n";  
$a=$a."</tr>\n"; 

$a=$a."</tbody>\n"; 
$a=$a."</table>\n"."</page>";
echo $a;


?>