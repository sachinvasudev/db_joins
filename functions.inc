<?php

function dbConnect()
{
		
	$db = mysql_connect("cmm.local","training","train@CMM") or die('Could not connect to db');
	mysql_select_db("training") or die('Could not select databse');
	return $db;


}

function dbConnectI()
{
	$db = mysqli_connect("cmm.local","training","train@CMM") or die('Could not connect to db');
	mysqli_select_db($db,"form2") or die('Could not select databse');
	return $db;
}

function idExists($uname,$conn)
{
	$query = "select count(*) from sachin_employee,sachin_admin
	 where sachin_employee.username='$uname'
	 or sachin_admin.username='$uname'";
	 
	 $result =mysql_query($query,$conn) or die("Could not run query");
	$count = mysql_result($result,0,0);
	if($count>0)
		return true;
	else
		return false;
				
	
}

function login_check($uname,$pass,$type,$conn)
{
	if($type=="employee")
	$query = "SELECT COUNT(*)
			  FROM sachin_employee
			  WHERE username='$uname'
		      AND password ='$pass'";
	else if($type=="admin")
	$query = "SELECT COUNT(*)
			  FROM sachin_admin
			  WHERE username='$uname'
		      AND password ='$pass'";
	
			  
    $result =mysql_query($query,$conn) or die("Could not run query");
	$count = mysql_result($result,0,0);
	if($count==1)
		return true;
	else
		return false;
	
}

function getEmployees($conn)
{
	$query = "SELECT * 
FROM sachin_employee
ORDER BY name 
";

$result = mysql_query($query,$conn) or die("Error running query");
return $result;
}

function addEmployees($empArray,$conn)
{
	
	
}

function getEmployee($uname,$conn)
{
	$query = "SELECT * 
	FROM sachin_employee
	WHERE username='$uname'
	";
	
	$result = mysql_query($query,$conn) or die("Error running query");
	return $result;
	
	
}

function isLoggedIn($type)
{
	if(isset($_SESSION['username']))
	{
		if($type!=$_SESSION['type'])
		redirect("homepage");
		else 
			return true;
	}
else redirect("home");
	
}

function updateHistory($uname,$conn)
{
	date_default_timezone_set("Asia/Calcutta");
	$date = date("YmdHis");
	
	
	$query = "UPDATE sachin_employee
	SET history = '$date'
	WHERE username='$uname'";
	mysql_query($query,$conn) or die(mysql_error());
  
	
}

function redirect($where)
{
	

	if(isset($_SESSION['type']))
		$type = $_SESSION['type'];
	else {
		$type=NULL;
	}
	
	switch($where)
	{
		case "homepage":
			switch($type)
			{
				case "employee":
					header("Location: employee.php");
					die();
					break;
				case "admin":
					header("Location: view.php");
					die();

			}
			
			break;
			
		case "home":
			header("Location: index.php");
			die();
			
		break;
					
	}
}


?>