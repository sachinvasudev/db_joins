<?php

if(file_exists("functions.inc"))
require_once("functions.inc");

else
	{
		echo "<div style='text-align:center;color:red;font-size:24px'>Fatal Error. Contact Webmaster</div>";
		die();
	}

$con = dbConnect();

if(isset($_POST['add_desig']))

{
	
	$desig = $_POST['designation'];
	$salary = $_POST['salary'];
	$query = "INSERT INTO sachin_p1_designation (desig_name,salary)
values
('$desig','$salary')";

mysql_query($query,$con) or die("Error running Query");
header("Location:register.php");
	
	
}


if(isset($_POST['add_blood']))

{
	$blood = $_POST['blood_name'];
	$query = "INSERT INTO sachin_p1_blood (blood_name)
values
('$blood')";

mysql_query($query,$con) or die("Error running Query");
header("Location:register.php");
	
}

?>

<html>
	<head>
		<title>
			DB Thingy
		</title>
		<link type="text/css" rel="stylesheet" href="reg.css"/>
	</head>
	
	<body class="page2">
		
		<h1> Add Designation</h1>
		
		<form method="post" action="admin.php" onsubmit= "return validate_desig()">
			
			<table border="0">
				
			
					<tr>
					<td>
					<p class="toptext">
						Designation Name
					</p></td>
					<td>
					<input type="text" maxlength="40"  id="designation" name= "designation"/>
					</td>
				</tr>
				
				
				<tr>
					<td>
					<p class="toptext">
						Basic Salary
					</p></td>
					<td>
					<input type="text" maxlength="40"  id="salary" name= "salary"/>
					</td>
				</tr>
				
				
				<tr>
					
					<td colspan="2" style="text-align: center">
						<input type="reset" value"Reset" name="reset"/>
						<input type="submit" value="Submit" name="add_desig"/>
						
					
					</td>
					
					
				</tr>
				
			 </table>
		</form>
		
		
		
		<br/><br/>
		
		<h1> Add Blood Group</h1>
		
		<form method="post" action="admin.php">
			
			<table border="0">
				
			
					<tr>
					<td>
					<p class="toptext">
						Blood Group Name
					</p></td>
					<td>
					<input type="text" maxlength="40"  id="blood_name" name= "blood_name"/>
					</td>
				</tr>
				
				
				
				
				
				<tr>
					
					<td colspan="2" style="text-align: center">
						<input type="reset" value"Reset" name="reset"/>
						<input type="submit" value="Submit" name="add_blood"/>
					
					</td>
					
					
				</tr>
				
			 </table>
		</form>
		
		
		<br/><br/>
		
	<a href="register.php">
		<button type="button">Add Employees</button>
	</a>
		
		
		
		
		
	</body>
	
	
</html>