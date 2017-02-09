<?php
$limit = 50; 
//Admin login check
 

function userChklogin()
{
	if($_SESSION['sess_username']=="")
	{
		header("location: login.php");
		exit();
	}
}

function excecute_$mydb->runQuery($query)
{
	$result = $mydb->runQuery($query);	
	if (!$result)
	{
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
}

//End Admin login check
function allcomboval($tbl,$fechcol,$fechcol1)
{
	$sql=$mydb->runQuery("select $fechcol,$fechcol1 from $tbl"); 
	while($data=mysqli_fetch_array($sql))
	{	
		echo "<option value=$data[$fechcol]>$data[$fechcol1]</option>";
	}
}

function comboval($tbl,$fechcol,$fechcol1,$chkcol,$colval)
{
	$sql=$mydb->runQuery("select $fechcol,$fechcol1 from $tbl where $chkcol='$colval'"); 
	while($data=mysqli_fetch_array($sql))
	{	
		echo "<option value=$data[$fechcol]>$data[$fechcol1]</option>";
	}
}

function edit_comboval($tbl,$fechcol,$fechcol1,$checkval,$chkcol,$colval)
{
	$sql=$mydb->runQuery("select $fechcol,$fechcol1 from $tbl where $chkcol='$colval'"); 
	while($data=mysqli_fetch_array($sql))
	{	
		echo "<option value='$data[$fechcol]' ";
		
		if($data[$fechcol]==$checkval){ 
		echo " Selected ";
		}
		echo " > $data[$fechcol1]</option>";
	}
}

//pagesdata for CMS
function pagedata($checkcol1,$chkval1,$checkcol2,$chkval2,$tbl)
{
$query="Select * from $tbl where $checkcol1='$chkval1' and $checkcol2='$chkval2'";
$sql=$mydb->runQuery($query);
$data=mysqli_fetch_array($sql);
return $data;
}
function getpagedata($checkcol1,$chkval1,$tbl)
{
	$query="Select * from $tbl where $checkcol1='$chkval1'";
	$sql=$mydb->runQuery($query);
	$data=mysqli_fetch_array($sql);
	return $data;
}
function ShowContent($tab1,$nerocol,$neroval)
{
	if($neroval=="")
	{
	
		$result = $mydb->runQuery("select * from $tab1");
		if(!$result)
		die("get row fatal error : ".mysql_error());
	}
	else
	{
		$result = $mydb->runQuery("select * from $tab1 where $nerocol='$neroval'");
		if(!$result)
		die("get row fatal error : ".mysql_error());	
	}	
	return $result;
}
function ShowContentlist($tab1)
{
	$result = $mydb->runQuery("select * from $tab1 ");
	if(!$result)
	die("get row fatal error : ".mysql_error());
	return $result;
}
function ShowContentsOrderlist($tab1,$start,$size, $orderField, $OrderType)
{ 
	$result = $mydb->runQuery("select * from $tab1 order by $orderField $OrderType limit ".$start.",".$size);
	if(!$result)
	die("get row1 fatal error : ".mysql_error());
	return $result;
}

function ShowContentsOrder($tab1,$nerocol,$neroval,$start,$size, $orderField, $OrderType)
{ 
	if($neroval=="")
	{
	$result = $mydb->runQuery("select * from $tab1 order by $orderField $OrderType limit ".$start.",".$size);
	if(!$result)
	die("get row1 fatal error : ".mysql_error());
	}
	else
	{
		$result = $mydb->runQuery("select * from  $tab1 where $nerocol='$neroval' order by $orderField $OrderType limit ".$start.",".$size);
	if(!$result)
	die("get row1 fatal error : ".mysql_error());
	}
	return $result;
}
function ShowContentWhere($chkval,$checkcol,$tbl)
{ 
	$result = $mydb->runQuery("Select * from $tbl where $checkcol='$chkval'");
	if(!$result)
	die("get row1 fatal error : ".mysql_error());
	return $result;
}
function fetchval($colname,$chkval,$checkcol,$tbl)
{
	 $query="Select $colname from $tbl where $checkcol='$chkval'";
	$sql=$mydb->runQuery($query);
	 
	$data=mysqli_fetch_array($sql);
	return $data[0];  
}
function returnRunningPageName($phpself)
{
	$phpself=explode('/',$phpself);
	return $menuFileName=$phpself[count($phpself)-1];
}
//pagesdata for ORDER HISTORY
function ShowOrderHistoryWhere($tab1,$start,$limit, $orderField, $OrderType,$chkcol,$chkval)
{ 
	$result = $mydb->runQuery("select * from $tab1 where $chkcol=$chkval order by $orderField $OrderType limit ".$start.",".$limit);
	if(!$result)
	die("get row1 fatal error : ".mysql_error());
	return $result;
}

function ShowHistory($tab1,$orderField, $OrderType,$chkcol,$chkval)
{
	$result = $mydb->runQuery("select * from $tab1 where $chkcol=$chkval order by $orderField $OrderType ");
	if(!$result)
	die("get row fatal error : ".mysql_error());
	return $result;
}

 

function recordcount($tab,$checkcol,$checkval)
{
	$sql=$mydb->runQuery("select * from $tab where $checkcol=$checkval");
	return mysql_num_rows($sql);
}


function recstatus($value)
{
	if($value==1)
	{
		echo "Deactivate";
	}
	else
	{
		echo "Activate";
	}
}

function published_status($value)
{
	if($value==1)
	{
		echo "Active";
	}
	else
	{
		echo "Inactive";
	}
}

function arcstatus($value)
{
	if($value==1)
	{
		echo "Yes";
	}
	else
	{
		echo "No";
	}
}
function deleterecord($field,$checkvalue,$table,$pageurl)
{
	$mydb->runQuery("delete  from ".$table." where ".$field."=".$checkvalue);
	$_SESSION['ses_message']="Record has been deleted successfully..";
	header("location:".$pageurl);
	exit();
}
function changestatus($updatefield,$updatevalue,$checkfield,$checkvalue,$table,$pageurl)
{
	$mydb->runQuery("update ".$table." set ".$updatefield."=".$updatevalue." where ".$checkfield."=".$checkvalue);
	header("location:".$pageurl);
	exit();
}

function inDBDate ($dt){
$date = explode("/", $dt);
$mm = $date[0];
$dd = $date[1];
$yyyy = $date[2];
return $yyyy."-".$mm."-".$dd; 
}

function outDBDate ($dt){
$date = explode("-", $dt);
$yyyy = $date[0];
$mm = $date[1];
$dd = $date[2];
return $mm."-".$dd."-".$yyyy; 
}

function outDBDateTime($dt){
$date = explode(" ", $dt);
$tdate = $date[0];
$ttime = $date[1];
return outDBDate($tdate)." ".$ttime; 
}
 
 
function showerror()
{
	
	if($_SESSION['ERROR_MESSAGE'])
	{
		echo "<div class=error_message>".$_SESSION['ERROR_MESSAGE']."</div>";  
		$_SESSION['ERROR_MESSAGE']="";
	}
}

function check_radio($lable1,$lable2,$field,$value,$message='')
{
	 $checked1="";
	 $checked0="";
	 if($value==1)
	 {
	 	$checked1="checked=checked";
	 }
	 else if($value=="" || $value==0)
	 {
	 	$checked0="checked=checked";
	 }
	 
	echo "<input name=".$field." id=".$field." type=radio value=1 ";
	echo  $checked1; 
	echo " />";
	echo $lable1 ;
	echo "<input name=".$field." id=".$field." type=radio value=0 ";
	echo  $checked0; 
	echo " />";
	echo $lable2;
	echo "<input name=lable_".$field." id=lable_".$field." type=hidden value=".$message." />";
}
function check_box($lable="", $field,$value)
{
	 //echo $value;
	 echo "<input type=checkbox name=".$field." id=".$field." value=1 ";
	 if($value==1)
	 {
	 	echo " checked ";
	}
	 echo " /> ";
if($lable){
	echo $lable;
}
	// echo "<input name=lable_".$field." id=lable_".$field." type=hidden value=".$message." />";
}

 
 
 
 function showmonth($month){
 $month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
 echo $month_names[$month]; 
 }
 
 
 function urgency($urgency)
 {
 	if($urgency=='1')
	{ echo "<span class='urgency urgency1' >Normal</span>"; }
	else if($urgency=='2')
	{ echo "<span class='urgency urgency2' >Modrate</span>"; }
	else if($urgency=='3')
	{ echo "<span class='urgency urgency3' >Urgent</span>"; } 
 }
 function todostatus($status,$task_id)
 {
 	
	echo "<span class='todostatus' status='$status' task_id='$task_id' id='tsk_status_$task_id'>"; 
	if($status=='0')
	{ 
		echo "Pending";
	}
	else if($status=='1')
	{ 
		echo "Done"; 
	}
	echo "</span>";
	 
 }
 //--------------------calenderfunstion------------------------>

 