<?php
require_once("functions.inc");
$con = dbConnect();

if(isset($_POST['id']))
{

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


}	

if(isset($_POST['edit']))
{
	$id = $_POST['edit'];
	
	$query = "
	SELECT * FROM sachin_p1_employee
	WHERE id='$id'";
	
	
	$result = mysql_fetch_assoc(mysql_query($query,$con));
	
	$first_name=$result['first_name'];
	$last_name=$result['last_name'];
	$age=$result['age'];
	$desig=$result['desig_code'];
	$blood= $result['blood_code'];
	$addrs=$result['address'];
	$allowance =$result['allowance'];
	$status = $result['status'];

	
	$desig_query= "SELECT * FROM sachin_p1_designation";
	$result_desig = mysql_query($desig_query);
	
	$blood_query= "SELECT * FROM sachin_p1_blood";
	$result_blood = mysql_query($blood_query);
	
	?>
	<table border="0">
				
			
					<tr>
					<td>
					<p class="toptext">
						First Name
					</p></td>
					<td>
					<input type="text" maxlength="40" id="first_name" value="<?php echo $first_name;?>" id="first_name" name= "FirstName"/>
					</td>
				</tr>
			
				
				<tr>
					<td>
					<p class="toptext">
						Last Name
					</p></td>
					<td>
					<input type="text" maxlength="40" value="<?php echo $last_name;?>" id="last_name" name= "LastName"/>
					</td>
				</tr>
				
		    	<tr>
					<td>
					<p class="toptext">
						Age
					</p></td>
					<td>
					<input type="text" id="age" class="num" value="<?php echo $age;?>" maxlength="3" size="20" name="Age"/>
					</td>
				</tr>
				
				<tr>
					<td>
						<p  class="toptext">
							Designation
						</p>
					</td>
					<td>
						<select id="designation" name="designation">
							<option value="">-Select-</option>
							<?php
							while ($row= mysql_fetch_assoc($result_desig))
							{
								$desig_code = $row['desig_code'];
								$desig_name = $row['desig_name'];
								if($desig==$desig_code)
								echo "<option selected='selected' value='$desig_code'>$desig_name</option>";
								else
								echo "<option value='$desig_code'>$desig_name</option>";
							
								
							}
							
							?>
							
							
						</select>
					</td>
				</tr>
				
				<tr>
					<td>
					<p class="toptext">
						Allowance
					</p></td>
					<td>
					<input type="text" id="allowance" class="num" value="<?php echo $allowance;?>" maxlength="10" size="20" name="Allowance"/>
					</td>
				</tr>
				
				<tr>
					<td>
						<p  class="toptext">
							Blood Group
						</p>
					</td>
					<td>
						<select id="bgroup" name="bgroup">
							<option value="">-Select-</option>
							<?php
							while ($row= mysql_fetch_assoc($result_blood))
							{
								$blood_code = $row['blood_code'];
								$blood_name = $row['blood_name'];
								if($blood==$blood_code)
								echo "<option selected='selected' value='$blood_code'>$blood_name</option>";
								else
								echo "<option value='$blood_code'>$blood_name</option>";
							
								
							}
							
							?>
						</select>
					</td>
				</tr>
				
				
				<tr>
					<td>
						<p  class="toptext">
						Address
						</p>
					</td>
				
				
				
				<td>
					<textarea id="address" name="address" rows="5" cols="25"><?php echo $addrs;?></textarea>
					
				</td>
				
				
				
				<tr>
					<td>
						<p  class="toptext">
							Status
						</p>
					</td>
							
					<td>
						<select id="status" name="status">
						<option value="">-Select-</option>
							<?php
							
							if($status=="Active")
								echo'<option selected="selected" value="1">Active</option>
								<option value="2">Inactive</option>';
							else 
								echo'<option value="1">Active</option>
							<option selected="selected" value="2">Inactive</option>';
								
							
								
							
							
							?>
							
							
						</select>
					</td>
				<input type="hidden" name="id"  id="id" value="<?php echo $id;?>" />
				</tr>
				
				<tr>
					
					<td colspan="2" style="text-align: center">
						
						<input type="submit" onclick="save()" value="Save" name="submit"/>
						<a href="view.php">
							<button type="button">Back</button>
						</a>
						
						
				
					</a>
					</td>
					
					
				</tr>
				
				
			
			
			
			</table>
			
	

<?php
}

if(isset($_POST{'id2'}))
{

	$id = $_POST['id2'];
	$first_name=(htmlspecialchars($_POST['first_name']));
	$last_name=(htmlspecialchars($_POST['last_name']));
	$age=$_POST['age'];
	$design=($_POST['designation']);
	$bgroup=addslashes($_POST['bgroup']);
	$allowance = $_POST['allowance'];
	$addrs=((nl2br(htmlspecialchars($_POST['address']))));
	$status = $_POST['status'];
	
	$query = "
	UPDATE sachin_p1_employee SET
	first_name='$first_name',
	last_name='$last_name',
	age = '$age',
	address = '$addrs',
	desig_code = '$design',
	blood_code = '$bgroup',
	allowance = '$allowance',
	status = '$status'
	
	WHERE id='$id'
	

	
	";
	
	mysql_query($query,$con) or die(mysql_error());
	
	?>
	
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

?>
			
		</table>
		
	<br/>
	
	
	<a href="register.php">
		<button type="button">Add Employees</button>
	</a>
	
	
	
	
	
<?php
	
}



mysql_close($con);	
?>