<?php
   
       
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
        
    {
         $errors= array();
	$q ="SELECT * FROM customers WHERE email='$e'";#Retrieves all data associated to the
	#email address entered.
	$r= mysqli_query($dbc, $q);
	if (mysqli_num_rows($r)!=0)#If Email address already exists
	{$errors[]= 'Email address already registered. <a href="login.php">Login</a>';}
        else{
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
                else
                    	{#If the errors() array is not empty
		echo '<h1>Error!</h1>
		<p id="err_msg">The following error(s) occurred:<br>';
		foreach ($errors as $msg)#Loop to retrieve the errors
		{
			echo"- $msg<br>";
		}
		echo 'Please try again.</p>';
		//mysqli_close($dbc);
                }

        }
                mysqli_close($dbc);#Closes the database connection.
		//include ('includes/footer.html');
		//exit();


    }	
	

?>

