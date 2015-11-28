
<?php
$page_title='Register';
include('includes/header.html');
if ($_SERVER['REQUEST_METHOD']=='POST')#Checks if the Submit Button has been clicked
{
	require('connect_db.php');
	$errors= array();#Initialises an empty array to store errors
	if(empty($_POST['fname']))
	{$errors[]='Enter your first name.';}
        else
        {$fn=mysqli_real_escape_string($dbc, trim($_POST['fname']));
        $fn= htmlentities($fn);
        }
        if (empty($_POST['lname']))
        {$errors[]= 'Enter your last name.'; }
        else{$ln= mysqli_real_escape_string($dbc, trim($_POST['lname']));
        $ln= htmlentities($ln);        
        }
        if (empty($_POST['email']))
        {$errors[]= 'Enter your email address.';}
        else{$e= mysqli_real_escape_string($dbc, trim($_POST['email']));
        $e= htmlentities($e);
        }
        if(!empty($_POST['pass1']))
        {
                if ($_POST['pass1']!= $_POST['pass2'])
                {$errors[]= 'Passwords do not match.';}
        else{$p= mysqli_real_escape_string($dbc, trim($_POST['pass1']));
        $p= htmlentities($p);
        }
        }
        else {$errors[]= 'Enter your password.';}
if (empty($errors))
{
	
	$q ="SELECT * FROM customers WHERE email='$e'";#Retrieves all data associated to the
	#email address entered.
	$r= mysqli_query($dbc, $q);
	if (mysqli_num_rows($r)!=0)#If Email address already exists
	{$errors[]= 'Email address already registered. <a href="login.php">Login</a>';}
}
if (empty($errors))
{
        $p=SHA1($p);#Uses SHA1 to encrypt the password entered.
        $reg_date= getdate();
		$q=$dbc->prepare("INSERT INTO customers
		(first_name, last_name, email, password,reg_date)
		VALUES (?,?,?,?,?)");#Prepared statement to insert the data into the database
			
			$q->bind_param("ssssi",$fn, $ln, $e, $p, $reg_date);#Binds the data provided to the 
			#prepared statement.
			$r= $q->execute();#Actions the statement.
		if ($r)#If Successful 
		{
			echo '<h1>Registered!</h1>
			<p>You are now registered.</p>
			<p><a href= "login.php">Login</a></>';
		}
		mysqli_close($dbc);#Closes the database connection.
		include ('includes/footer.html');
		exit();
}
else 
	{#If the errors() array is not empty
		echo '<h1>Error!</h1>
		<p id="err_msg">The following error(s) occurred:<br>';
		foreach ($errors as $msg)#Loop to retrieve the errors
		{
			echo"- $msg<br>";
		}
		echo 'Please try again.</p>';
		mysqli_close($dbc);
	}
		
	
}

?>
<h1>Register</h1>
<form action= "register.php" method= "POST">
<p>
First Name: <input type= "text" name= "fname"
value ="<?php if (isset($fn))#Sticky form to display entered data.
{echo $fn;}
else {echo "";}?>" required/>
Last Name: <input type= "text" name= "lname"
value ="<?php if (isset($ln))
{echo $ln;}
else {echo "";}?>" required/>
</p> <p>
Email address:<input type= "text" name= "email"
value ="<?php if (isset($e))
{echo $e;}
else {echo "";}?>" required/>
</p> <p>
Password: <input type= "password" name= "pass1"
value ="<?php if (isset($p))
{echo $p;}
else {echo "";}?>" required/>
</p> <p>
Password: <input type= "password" name= "pass2"
value ="<?php if (isset($p))
{echo $p;}
else {echo "";}?>" required>
</p> <p>
<input type ="submit"  value= "Register"></p>
</form>
<?php include ('includes/footer.html');?>

