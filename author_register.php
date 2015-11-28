
<?php
$page_title='Author Register';
include('includes/header.html');
if ($_SERVER['REQUEST_METHOD']=='POST')#Checks if form has been submitted
{
	require('connect_db.php');
	$errors= array();
	if(empty($_POST['fname']))
	{$errors[]='Enter your first name.';}
        else
        {$fn=mysqli_real_escape_string($dbc, trim($_POST['fname']));
        $fn=  htmlentities($fn);
        }
        if (empty($_POST['lname']))
        {$errors[]= 'Enter your last name.'; }
        else{$ln= mysqli_real_escape_string($dbc, trim($_POST['lname']) );
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
	
	$q ="SELECT * FROM authors WHERE email='$e'";#Checks if user is alredy registered.
	$r= mysqli_query($dbc, $q);
	if (mysqli_num_rows($r)!=0)
	{$errors[]= 'Email address already registered. <a href="author_login.php">Login</a>';}
}
if (empty($errors))
{
        $p=SHA1($p);
		#Preparing a statement to insert data into the database.
		$q=$dbc->prepare("INSERT INTO authors
		(first_name, last_name, email, password)
		VALUES (?,?,?,?)");
		$q->bind_param("ssss",$fn, $ln, $e, $p);
	    $r= $q->execute();
	if ($r)#If successful
	{
		echo '<h1>Registered!</h1>
		<p>You are now registered.</p>
		<p><a href= "author_login.php">Login</a></>';
        echo '<p><a href="add_book.php">Add a Book</a> |
	<a href="goodbye.php">Logout</a></p>';
echo '<p><a href= "author_page.php">Admin Area</a> </p>';
	}
	mysqli_close($dbc);
	include ('includes/footer.html');
	exit();
}
else #If query fails
{
	echo '<h1>Error!</h1>
	<p id="err_msg">The following error(s) occurred:<br>';
	foreach ($errors as $msg)
	{
		echo"- $msg<br>";
	}
	echo 'Please try again.</p>';
	mysqli_close($dbc);
}
		
	
}

?>
<h1>Register</h1>
<form action= "author_register.php" method= "POST">
<p>
First Name: <input type= "text" name= "fname"
value ="<?php if (isset($fn))
{echo $fn;}
else {echo "";}?>" required/>
Last Name: <input type= "text" name= "lname"
value ="<?php if (isset($ln))
{echo $ln;}
else {echo "";}?>"required />
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
else {echo "";}?>" required/>
</p> <p>
<input type ="submit"  value= "Register"></p>
</form>
<?php include ('includes/footer.html');?>

