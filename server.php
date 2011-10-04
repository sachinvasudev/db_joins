<?php
require_once("functions.inc");

if(isset($_POST['id']))
{
$con = dbConnect();

$id = $_POST['id'];


$query = "SELECT status from sachin_p1_employee
where id='$id'";
$result = mysql_query($query,$con) or die(mysql_error());
$status = mysql_result($result,0,0);
if($status=="Active")
	$newStatus=2;
else
	$newStatus=1;

$query="UPDATE sachin_p1_employee
set status='$newStatus'
where id='$id'";

mysql_query($query,$con);


$query = "SELECT status from sachin_p1_employee
where id='$id'";
$result = mysql_query($query,$con) or die(mysql_error());
$status = mysql_result($result,0,0);


header('Content-type: text/xml');
echo '<?xml version="1.0" ?>
	 <status>'.$status.'</status>
	 

';

mysql_close($con);	
}	

?>