
<?php
$page_title='Register';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD']=='POST')#Checks if the Submit Button has been clicked
{
    
        require('connect_db.php');
	$fname=trim($_POST['fname']);
        $fn=mysqli_real_escape_string($dbc,$fname );
        $fn= htmlentities($fn);
        $lname=trim($_POST['lname']);
        $ln=mysqli_real_escape_string($dbc,$lname );
        $ln= htmlentities($ln);
        $email=trim($_POST['email']);
        $e=mysqli_real_escape_string($dbc,$email );
        $e= htmlentities($e);
        
        $pass1=trim($_POST['pass1']);
        $p=mysqli_real_escape_string($dbc,$pass1 );
        $p= htmlentities($p);
        
         $pass1=trim($_POST['pass1']);
        $p=mysqli_real_escape_string($dbc,$pass1 );
        $p= htmlentities($p);
        
    
	$q ="SELECT * FROM customers WHERE email='$e'";#Retrieves all data associated to the
	#email address entered.
	$r= mysqli_query($dbc, $q);
	if (mysqli_num_rows($r)!=0)#If Email address already exists
	{echo 'Email address already registered. <a href="login.php">Login</a>';}
        else{
        $p=SHA1($p);#Uses SHA1 to encrypt the password entered.
        $reg_date = date("Y-m-d");
		$q=$dbc->prepare("INSERT INTO customers
		(first_name, last_name, email, password,reg_date)
		VALUES (?,?,?,?,?)");#Prepared statement to insert the data into the database
			
			$q->bind_param("sssss",$fn, $ln, $e, $p, $reg_date);#Binds the data provided to the 
			#prepared statement.
			$r= $q->execute();#Actions the statement.
		if ($r)#If Successful 
		{
			echo '<h1>Registered!</h1>
			<p>You are now registered.</p>
			<p><a href= "login.php">Login</a></>';
		}
                else{
                    echo 'Error during registration';
                }
}

		mysqli_close($dbc);#Closes the database connection.
		include ('includes/footer.html');
		exit();
}

		
	

?>

<h1>Register</h1>
<form action= "register.php" method= "POST" name="register" id="register_form">
<p>
    First Name: <input type= "text" name= "fname" id="fname" class="required"
       value ="<?php if (isset($ln))
{echo $ln;}
else {echo "";}?>" ></p>
    Last Name: <input type= "text" name= "lname" id="lname" class="required"
value ="<?php if (isset($ln))
{echo $ln;}
else {echo "";}?>" >
</p> <p>
    Email address:<input type= "text" name= "email" id="email" class="required"
value ="<?php if (isset($e))
{echo $e;}
else {echo "";}?>" >
</p> <p>
    Password: <input type= "password" name= "pass1" id="pass1" class="required"
value ="<?php if (isset($p))
{echo $p;}
else {echo "";}?>" >
</p> <p>
    Password: <input type= "password" name= "pass2" id="pass2" class="required"
value ="<?php if (isset($p))
{echo $p;}
else {echo "";}?>" >
</p> <p>
<input type ="submit"  value= "Register"></p>
</form>
<?php include ('includes/footer.html');?>

