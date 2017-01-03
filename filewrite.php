<?php
$path="letters/";
$myfile = fopen($path."newfile.html", "w") or die("Unable to open file!");
$txt = "John Doe\n";
$sql="Select content from templates where tname='dec2016sal'";
$result=mysql_query($sql);
$a='';
while($row=mysql_fetch_array($result))
{        $a=$row['content'];
}

fwrite($myfile, $a);
$txt = "Jane Doe\n";
//fwrite($myfile, $txt);
fclose($myfile);

echo "<a href='letters/newfile.html'>His Offer Letter</a>";
?>