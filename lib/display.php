<?php
function dbsql($tbl)
{
$sql="select tblid from config where name='$tbl'";
$result=mysql_query($sql);
$myvar=mysql_result($result,0);
$sql1="select * from field where tblid=$myvar";
//$result1=mysql_query($sql1);
return $sql1;
}
function display($tbl,$qual,$md,$arr)
{

	$sql1=dbsql($tbl);
	//adding new below 2 rows
	$tg_nrow="<div class=\"row clearfix\">";
	$tg_ncol="<div class=\"col-md-4 column\">";
	$tg_top="<div class=\"table-responsive\"><table class=\"table table-hover table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_hdr="<th>";
	$tg_hdr_cl="</th>";
	$tg_ro="<tr>";
	$tg_ro_cl="</tr>";
	$tg_td="<td>";
	$tg_td_cl="</td>";
	$tg_top_cl="</table></div>";
	$tg_ip="<input";
	$tg_ip_type=" type=\"";
	$tg_ip_name="\" name=\"";
	$tg_ip_value="\" value=\"";
	$tg_ip_size="\" size=\"";
	$tg_ip_id="\" id=\"";
	$tg_class="\" class=\"ro";
	$tg_ip_cl="\" />";
	$tg_chk="<input type=\"checkbox\" name=\"chb";
	$tg_chk_val="";
	$tg_dat="<a href=\"javascript:NewCal('";
	$tg_dat_cl="','yyyymmdd')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
	$tg_sel="<select name=\"";
	$tg_cl="\" >";
	$tg_sel_cl="</select>";
	$tg_opt="<option value=\"";
	$tg_opt_cl="</option>";
	$tg_hidden="hidden";
	$tg_readonly="\" readonly ";
	$tg_text="<textarea rows=\"4\" cols=\"15\" ";
	$tg_text_cl="</textarea>";
	//adding for image and attachments fields
	//<div>  <img src="https://media.licdn.com/mpr/mpr/shrinknp_200_200/p/3/000/0b7/06d/0df966e.jpg" alt="Vipul Gupta" height="200" width="200"></div>
	$tg_img="<div><img src=\"";
	$tg_img_alt="\" alt=\"";
	$tg_img_ht="\" height=\"";
	$tg_img_wd="\" width=\"";
	$tg_img_cl="\"></div>"; 

	$data_sql="select * from ".$tbl;

	if(isset($qual))
	{
	$qual=" where ".$qual;
	$data_sql=$data_sql.$qual;
	}
	//only get pages if this is main table
	if($_GET['page']==$tbl)
	$data_sql=getPagesql($data_sql,7);
	$result1=mysql_query($sql1);
//mode 0 is columnar and mode 1 for row-wise printing
	$a="";
	$opt=array(1 => "k");
	$mode=1;
	$j=0;

	$mode=$md;

	if($mode==0)
	{
	//Open Table
	$a=$tg_top;
	//Print Header column

		while($row = mysql_fetch_array($result1))
		{
		$a=$a.$tg_ro;
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;

	//Print data columns

		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		if($row['type']=="date")
		{
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		}elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}
		else
		{
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}
		}

		$a=$a.$tg_ro_cl;
		}
	//Close Table
		$a=$a.$tg_top_cl;
	}
	if($mode==1)
	{
//Open Table

		$a= $tg_top;

//Print Header row
		$a=$a.$tg_ro;
		while($row = mysql_fetch_array($result1))
		{
		if((empty($arr) || in_array($row['name'],$arr)) )
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;
		}
		$a=$a.$tg_ro_cl;


//Print Data rows
		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		$a=$a.$tg_ro;
		$result1=mysql_query($sql1);
		while($row = mysql_fetch_array($result1))
		{
		if(empty($arr) || in_array($row['name'],$arr))
		{
		if($row['type']=="date")
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		//$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}elseif($row['dbindex']=="primary" ){
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}else
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}elseif($row['dbindex']=="primary" && !in_array($row['name'],$arr))
		{
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}
		//echo $a;
		//close while loop
		}

		$a=$a.$tg_ro_cl;

		}
//Close Table
		$a=$a.$tg_top_cl;
	}
if($mode==2)
	{
	//Open Table
	$a=$tg_top;
	//Print Header column

		while($row = mysql_fetch_array($result1))
		{
		$a=$a.$tg_ro;
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;

	//Print data columns

		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		if($row['type']=="date")
		{
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		}elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}
		else
		{
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}
		}

		$a=$a.$tg_ro_cl;
		}
	//Close Table
		$a=$a.$tg_top_cl;
	}
	$a=$a."<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"modify\" value=\"modify\">";
	return $a;
}

function display_link($tbl,$qual,$md,$arr,$link)
{

	$sql1=dbsql($tbl);
	$tg_top="<div class=\"table-responsive\"><table class=\"table table-hover\" id=\"".$tbl."\" width=auto >";
		$tg_hdr="<th>";
		$tg_hdr_cl="</th>";
		//$tg_ro="<tr class=\"clickableRow\" href=\"".$link."constant\">";
		$tg_ro="<tr class=\"clickableRow\" href=\"#\" onclick=\"openUser(constant);\">";
		$tg_ro_cl="</tr>";
		$tg_td="<td>";
		$tg_td_cl="</td>";
	$tg_top_cl="</table></div>";

	//$tg_top="<div><ul class=\"nav nav-tabs nav-stacked\" id=\"".$tbl."\" >";
	$tg_hdr="<th>";
	$tg_hdr_cl="</th>";
	$tg_al="<a href=\"#\" onclick=\"openUser(";
	$tg_alo=");\" >";
	$tg_alc="</a>";
	//echo "<a href=\"#\" onclick=\"openUser(".$_SESSION['SESS_empid'].");\" >;
	//$tg_ro="<tr href=\"#\" onclick=\"openUser(".$_SESSION['SESS_empid'].");\">";
	//$tg_ro_cl="</tr>";
	//$tg_td="<li><a href=\"".$link."constant\">";
	//$tg_td_cl="</a></li>";
	//$tg_top_cl="</ul></div>";
	$tg_ip="<input";
	$tg_ip_type=" type=\"";
	$tg_ip_name="\" name=\"";
	$tg_ip_value="\" value=\"";
	$tg_ip_size="\" size=\"";
	$tg_ip_id="\" id=\"";
	$tg_class="\" class=\"ro";
	$tg_ip_cl="\" />";
	$tg_chk="<input type=\"checkbox\" name=\"chb";
	$tg_chk_val="";
	$tg_dat="<a href=\"javascript:NewCal('";
	$tg_dat_cl="','yyyymmdd')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
	$tg_sel="<select name=\"";
	$tg_cl="\" >";
	$tg_sel_cl="</select>";
	$tg_opt="<option value=\"";
	$tg_opt_cl="</option>";
	$tg_hidden="hidden";
	$tg_readonly="\" readonly ";
	$tg_text="<textarea rows=\"4\" cols=\"15\" ";
	$tg_text_cl="</textarea>";

	$data_sql="select * from ".$tbl;

	if(isset($qual))
	{
	$qual=" where ".$qual;
	$data_sql=$data_sql.$qual;
	}
	//only get pages if this is main table
	if($_GET['page']==$tbl)
	$data_sql=getPagesql($data_sql,5);
	//echo $data_sql;
$result1=mysql_query($sql1);
//mode 0 is columnar and mode 1 for row-wise printing
	$a="";
	$opt=array(1 => "k");
	$mode=1;
	$j=0;

	$mode=$md;

	if($mode==0)
	{
	//Open Table
	$a=$tg_top;
	//Print Header column

		while($row = mysql_fetch_array($result1))
		{
		$a=$a.$tg_ro;
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;

	//Print data columns

		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		if($row['type']=="date")
		{
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		}elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}
		else
		{
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}
		}

		$a=$a.$tg_ro_cl;
		}
	//Close Table
		$a=$a.$tg_top_cl;
	}
	if($mode==1)
	{
//Open Table
		$a= $tg_top;

//Print Header row
		$a=$a."<tr>";
		while($row = mysql_fetch_array($result1))
		{
		if((empty($arr) || in_array($row['name'],$arr)) )
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;
		}
		$a=$a."</tr>";

//Print Data rows
		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		$a=$a.$tg_ro;
		$result1=mysql_query($sql1);
		while($row = mysql_fetch_array($result1))
		{
		if(empty($arr) || in_array($row['name'],$arr))
		{
		if($row['type']=="date")
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		//$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}elseif($row['dbindex']=="primary" ){
		$a=str_replace('constant',$datarow[$row['name']],$a);
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}else
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}elseif($row['dbindex']=="primary" && !in_array($row['name'],$arr))
		{
		$a=str_replace('constant',$datarow[$row['name']],$a);
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}
		//echo $a;
		//close while loop
		}

		$a=$a.$tg_ro_cl;
		}
//Close Table
		$a=$a.$tg_top_cl;
	}
	if($mode==2)
	{
//Open Table
		$a= $tg_top;

//Print Header row
		$a=$a."<tr>";
		while($row = mysql_fetch_array($result1))
		{
		if((empty($arr) || in_array($row['name'],$arr)) )
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;
		}
		$a=$a."</tr>";

//Print Data rows
		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		$a=$a.$tg_ro;
		$result1=mysql_query($sql1);
		while($row = mysql_fetch_array($result1))
		{
		if(empty($arr) || in_array($row['name'],$arr))
		{
		if($row['type']=="date")
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		//$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}elseif($row['dbindex']=="primary" ){
		$a=str_replace('constant',$datarow[$row['name']],$a);
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}else
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}elseif($row['dbindex']=="primary" && !in_array($row['name'],$arr))
		{
		$a=str_replace('constant',$datarow[$row['name']],$a);
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}
		//echo $a;
		//close while loop
		}

		$a=$a.$tg_ro_cl;
		}
//Close Table
		$a=$a.$tg_top_cl;
	}
	return $a;
}

function display_array($tbl,$qual,$md,$arr)
{

	$sql1=dbsql($tbl);
	$tg_top="<div class=\"table-responsive\"><table class=\"table hover table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_hdr="<th>";
	$tg_hdr_cl="</th>";
	$tg_ro="<tr>";
	$tg_ro_cl="</tr>";
	$tg_td="<td>";
	$tg_td_cl="</td>";
	$tg_top_cl="</table></div>";
	$tg_ip="<input";
	$tg_ip_type=" type=\"";
	$tg_ip_name="\" name=\"";
	$tg_ip_value="\" value=\"";
	$tg_ip_size="\" size=\"";
	$tg_ip_id="\" id=\"";
	$tg_class="\" class=\"ro";
	$tg_ip_cl="\" />";
	$tg_chk="<input type=\"checkbox\" name=\"chb";
	$tg_chk_val="";
	$tg_dat="<a href=\"javascript:NewCal('";
	$tg_dat_cl="','yyyymmdd')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
	$tg_sel="<select name=\"";
	$tg_cl="\" >";
	$tg_sel_cl="</select>";
	$tg_opt="<option value=\"";
	$tg_opt_cl="</option>";
	$tg_hidden="hidden";
	$tg_readonly="\" readonly ";
	$tg_text="<textarea rows=\"4\" cols=\"15\" ";
	$tg_text_cl="</textarea>";

	$data_sql="select * from ".$tbl;

	if(isset($qual))
	{
	$qual=" where ".$qual;
	$data_sql=$data_sql.$qual;
	}
	//only get pages if this is main table
	if($_GET['page']==$tbl)
	$data_sql=getPagesql($data_sql,7);
	$result1=mysql_query($sql1);
//mode 0 is columnar and mode 1 for row-wise printing
	$a="";
	$opt=array(1 => "k");
	$mode=1;
	$j=0;

	$mode=$md;

	if($mode==0)
	{
	//Open Table
	$a=$tg_top;
	//Print Header column

		while($row = mysql_fetch_array($result1))
		{
		$a=$a.$tg_ro;
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;

	//Print data columns

		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		if($row['type']=="date")
		{
		$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;
		}elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}
		else
		{
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		}
		}

		$a=$a.$tg_ro_cl;
		}
	//Close Table
		$a=$a.$tg_top_cl;
	}
	if($mode==1)
	{
//Open Table

		$a= $tg_top;

//Print Header row
		$a=$a.$tg_ro;
		
		$hdr=array();
		while($row = mysql_fetch_array($result1))
		{
		if((empty($arr) || in_array($row['name'],$arr)) )
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;
		$hdr[$row['name']]=$row['alias'];
		}
		$a=$a.$tg_ro_cl;
//var_dump($hdr);
//echo $hdr['id'];
$record=array();
//Print Data rows
		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		$a=$a.$tg_ro;
		$result1=mysql_query($sql1);
		while($row = mysql_fetch_array($result1))
		{
		if(empty($arr) || in_array($row['name'],$arr))
		{
		if($row['type']=="date")
		{$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;$record[$datarow[$row['name']]]=array($row['name']=>getmydate($datarow[$row['name']]));}	
		//$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}elseif($row['dbindex']=="primary" ){
		$record[$datarow[$row['name']]]=array($row['name']=>$datarow[$row['name']]);
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}else
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;$record[$datarow[$row['name']]]=array($row['name']=>$datarow[$row['name']]);
		}elseif($row['dbindex']=="primary" && !in_array($row['name'],$arr))
		{
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		$record[$datarow[$row['name']]]=array($row['name']=>$datarow[$row['name']]);
		}
		//echo $a;
		//close while loop
		}

		$a=$a.$tg_ro_cl;

		}
//Close Table
		$a=$a.$tg_top_cl;
	}
var_dump($record);
	$a=$a."<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"modify\" value=\"modify\">";
	return $a;
}

function display_data($tbl,$qual,$md,$arr)
{

	$sql1=dbsql($tbl);
	$tg_top="<div class=\"table-responsive\"><table class=\"table hover table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_hdr="<th>";
	$tg_hdr_cl="</th>";
	$tg_ro="<tr>";
	$tg_ro_cl="</tr>";
	$tg_td="<td>";
	$tg_td_cl="</td>";
	$tg_top_cl="</table></div>";
	$tg_ip="<input";
	$tg_ip_type=" type=\"";
	$tg_ip_name="\" name=\"";
	$tg_ip_value="\" value=\"";
	$tg_ip_size="\" size=\"";
	$tg_ip_id="\" id=\"";
	$tg_class="\" class=\"ro";
	$tg_ip_cl="\" />";
	$tg_chk="<input type=\"checkbox\" name=\"chb";
	$tg_chk_val="";
	$tg_dat="<a href=\"javascript:NewCal('";
	$tg_dat_cl="','yyyymmdd')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
	$tg_sel="<select name=\"";
	$tg_cl="\" >";
	$tg_sel_cl="</select>";
	$tg_opt="<option value=\"";
	$tg_opt_cl="</option>";
	$tg_hidden="hidden";
	$tg_readonly="\" readonly ";
	$tg_text="<textarea rows=\"4\" cols=\"15\" ";
	$tg_text_cl="</textarea>";

	$data_sql="select * from ".$tbl;

	if(isset($qual))
	{
	$qual=" where ".$qual;
	$data_sql=$data_sql.$qual;
	}
	//only get pages if this is main table
	//if($_GET['page']==$tbl)
	//$data_sql=getPagesql($data_sql,7);
	$result1=mysql_query($sql1);
//mode 0 is columnar and mode 1 for row-wise printing
	$a="";
	$opt=array(1 => "k");
	$mode=1;
	$j=0;

	$mode=$md;

		if($mode==1)
	{
//Open Table

		$a= $tg_top;

//Print Header row
		$a=$a.$tg_ro;
		
		/*$hdr=array();
		while($row = mysql_fetch_array($result1))
		{
		if((empty($arr) || in_array($row['name'],$arr)) )
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;
		$hdr[$row['name']]=$row['alias'];
		}
		$a=$a.$tg_ro_cl;
		*/
//var_dump($hdr);
//echo $hdr['id'];
$record=array();
//Print Data rows
		$result_data=mysql_query($data_sql);
		while($datarow=mysql_fetch_array($result_data))
		{
		$a=$a.$tg_ro;
		$result1=mysql_query($sql1);
		while($row = mysql_fetch_array($result1))
		{
		if(empty($arr) || in_array($row['name'],$arr))
		{
		if($row['type']=="date")
		{$a=$a.$tg_td.getmydate($datarow[$row['name']]).$tg_td_cl;$record[$datarow[$row['name']]]=array($row['name']=>getmydate($datarow[$row['name']]));}	
		//$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		elseif($row['type']=="password"){
		$a=$a.$tg_td.$tg_td_cl;
		}elseif($row['dbindex']=="primary" ){
		$record[$datarow[$row['name']]]=array($row['name']=>$datarow[$row['name']]);
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		}else
		$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;$record[$datarow[$row['name']]]=array($row['name']=>$datarow[$row['name']]);
		}elseif($row['dbindex']=="primary" && !in_array($row['name'],$arr))
		{
		$a=$a.$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_name.$row['name'].$tg_ip_size.$row['size'].$tg_ip_value;
		$a=$a.$datarow[$row['name']].$tg_ip_cl;
		$record[$datarow[$row['name']]]=array($row['name']=>$datarow[$row['name']]);
		}
		//echo $a;
		//close while loop
		}

		$a=$a.$tg_ro_cl;

		}
//Close Table
		$a=$a.$tg_top_cl;
	}
//var_dump($record);
//$a=json_encode($record);
	//$a=$a."<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"modify\" value=\"modify\">";
	return $a;
}
?>