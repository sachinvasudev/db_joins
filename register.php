<?php
if(file_exists("functions.inc"))
require_once("functions.inc");

else
	{
		echo "<div style='text-align:center;color:red;font-size:24px'>Fatal Error. Contact Webmaster</div>";
		die();
	}
	
	$con = dbConnect();
	
	if (isset($_POST['submit'])) 
			
			{
				if(get_magic_quotes_gpc())
				{
					
					$first_name=(htmlspecialchars($_POST['FirstName']));
					$last_name=(htmlspecialchars($_POST['LastName']));
					$age=$_POST['Age'];
					$design=($_POST['designation']);
					$bgroup=addslashes($_POST['bgroup']);
					$addrs=((nl2br(htmlspecialchars($_POST['address']))));
					$status = $_POST['status'];
				}
			else {
					
					$first_name=addslashes(htmlspecialchars($_POST['FirstName']));
					$last_name=addslashes(htmlspecialchars($_POST['LastName']));
					$age=$_POST['Age'];
					$design=addslashes($_POST['designation']);
					$bgroup=addslashes($_POST['bgroup']);
					$addrs=addslashes((nl2br(htmlspecialchars($_POST['address']))));
					$status = $_POST['status'];
	  			 }
				
				
				
				
				
				
				
				
			
				
				
						$query = "INSERT INTO sachin_p1_employee (first_name,last_name,age,address,desig_code,blood_code,status)
						 VALUES
(						 '$first_name','$last_name','$age','$addrs','$design',$bgroup,'$status')";

				mysql_query($query,$con) or die("Could not run query");
				
				
				header('Location: register.php');
				exit();
						
					
				
				

			}
else 
{
	
	$first_name="";
	$last_name="";
	$age="";
	$occpn="";
	$addrs="";
	$status = "";
	
	$desig_query= "SELECT * FROM sachin_p1_designation";
	$result_desig = mysql_query($desig_query);
	
	$blood_query= "SELECT * FROM sachin_p1_blood";
	$result_blood = mysql_query($blood_query);
	
	
}

?>
<html>
	<head>
		<title> Employee Registration </title>
		<link type="text/css" rel="stylesheet" href="reg.css"/>
	</head>
	<body>
		<form method="post" action="register.php" name="regist" onsubmit="return validate2();"enctype="multipart/form-data">
			<table border="0">
				
			
					<tr>
					<td>
					<p class="toptext">
						First Name
					</p></td>
					<td>
					<input type="text" maxlength="40" id="firstName" value="<?php echo $first_name;?>" id="first_name" name= "FirstName"/>
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
					<input type="text" class="num" value="<?php echo $age;?>" maxlength="3" size="20" name="Age"/>
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
								echo "<option value='$desig_code'>$desig_name</option>";
							
								
							}
							
							?>
							
							
						</select>
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
							<option value="1">Active</option>
							<option value="2">Inactive</option>
						</select>
					</td>

				</tr>
				
				<tr>
					
					<td colspan="2" style="text-align: center">
						<input type="reset" value"Reset" name="reset"/>
						<input type="submit" value="Submit" name="submit"/>
						<a href="index.php">
							<button type="button">Home</button>
						</a>
						
					</td>
					
					
				</tr>
				
				
			
			
			
			</table>
			
			</form>
			
			<?php
			mysql_close($con);
		?>

			
			<script>
				window.onload=document.getElementById("firstName").focus();
			</script>
			</body>

			<script type="text/javascript" src="validate.js"></script>

			</html>
