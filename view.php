<?php
if(file_exists("functions.inc"))
require_once("functions.inc");

else
	{
		echo "<div style='text-align:center;color:red;font-size:24px'>Fatal Error. Contact Webmaster</div>";
		die();
	}

session_start();



$con = dbConnect();





				
?>

<html>
	<head>
		<title> Employee Details </title>
		<link type="text/css" rel="stylesheet" href="reg.css"/>
	</head>
	<body class="page2">
		<div id="content">
		<h1> Employee Details</h1>
		<br/>
	    <form method="post">
	    	<input type="text" name="query" />
	    	<input type="submit" name="search" value="Search" />
	    	
	    </form>

		
		<table border="1" cellpadding="5" class="page2">
			
			<tr >
				
				<th>
					Name
				</th>
				
				<th>
					Age
				</th>
				
				<th>
					Designation
				</th>
				
				<th>
					Salary
				</th>
				
				<th>
					Blood Group
				</th>
				
				<th>
					Address
				</th>
				
				<th>
					Major/Minor
				</th>
				
				<th>
					Status
				</th>
				
				<th>
					Edit
				</th>
			
			</tr>
			
			
<?php

if(isset($_POST['search']))
{
	$searchString = $_POST['query'];
	$query = "
	
select emp.id,concat(emp.first_name,' ',emp.last_name) as name,
emp.address,emp.age,desg.desig_name,
(desg.salary+emp.allowance) as salary,blood.blood_name,
IF(age>22, 'Major', 'Minor') AS class,emp.status

from sachin_p1_employee as emp

left join sachin_p1_designation as desg
on emp.desig_code=desg.desig_code 

LEFT JOIN sachin_p1_blood as blood
on emp.blood_code=blood.blood_code


WHERE ( 
first_name LIKE'$searchString%'
OR last_name LIKE'$searchString%'
OR address LIKE '%$searchString%')
order by class
	
	
";
	
}
else		
$query = "select emp.id,concat(emp.first_name,' ',emp.last_name) as name,
emp.address,emp.age,desg.desig_name,
(desg.salary+emp.allowance) as salary,blood.blood_name,
IF(age>22, 'Major', 'Minor') AS class,emp.status

from sachin_p1_employee as emp

left join sachin_p1_designation as desg
on emp.desig_code=desg.desig_code 

LEFT JOIN sachin_p1_blood as blood
on emp.blood_code=blood.blood_code


order by class

";

$result = mysql_query($query) or die("Error running query");
while($employee =mysql_fetch_assoc($result))
{
		
	
					
		
?>

		<?php
			if($employee['status']=="Active")
				echo '<tr class="active hv">';
			else 
				echo '<tr class="inactive hv">';
			
			
			?>
			
				
				
				
				<td>
					<?php echo $employee['name']?>
				</td>
				
				<td>
					<?php echo $employee['age']?>
				</td>
				
				<td>
					<?php echo $employee['desig_name']?>
				</td>
				
				<td>
					<?php echo $employee['salary']?>
				</td>
				
				<td>
					<?php echo $employee['blood_name']?>
				</td>
				
				<td>
					<?php echo $employee['address']?>
				</td>
				
				<td id="showtime">
					<?php echo $employee['class']?>
				</td>
				
				<td onclick="changeStatus(this)">
					<?php echo $employee['status']?>
					<input type="hidden" value="<?php echo $employee['id']?>" name="id"/>
				</td>
				
				<td>
					<button onclick = "edit(this)" id="<?php echo $employee['id']?>">Edit</button>
				</td>
				
				
			</tr>
			<?php
}
mysql_close($con);
?>
			
		</table>
		
	<br/>
	
	
	<a href="register.php">
		<button type="button">Add Employees</button>
	</a>
	
	</div>
	


	</body>
	<script type="text/javascript" src="view.js"></script>
	

</html>