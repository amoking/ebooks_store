<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="math.css" title="Default" >
		<title>Results</title>
	</head>
	<body>
		<div  id="wrapper">
			<div id = "container">
				<div id="input">
					<?php
						$servername ="mysql.ccacolchester.com";// specifies the server to be used
						$username="amosg6360";//variable for the user name
						$password="01276360";// password
						$dbname="amosg6360";// database name
						$con=mysql_connect($servername,$username,$password,$dbname) or die("Failed to connect to MySQL: " . mysql_error());
						$db=mysql_select_db($dbname) or die("Failed to connect to MySQL: " . mysql_error());//connection to mysql server

							if(!empty($email))   //checking the 'email' name which is from register.php, is it empty or have some text
							{
							  $query = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());//selects all information regarding the current user
							  $row =mysql_fetch_array( $query );// variable for the results of the query
							  $firstname=$row['firstname'];
							  if(!$row = mysql_fetch_array($query) )// if the details do not exist
							  {
								check_user();// call this function
							  }
							  else// if they do then tell user they are already registered
							  {
							 echo "SORRY...YOU ARE ALREADY REGISTERED USER...<br>";
								echo "<a href =login.php>Log In Here</a><br>";
							  }
							}
						function check_user(){// checking the user details
							  global $firstname,$row,$query1;
							  //$_SESSION["firstname"]= $firstname;
							  $email = htmlentities($_POST['email']);
							  $pass= htmlentities($_POST['pass']);
							  $_SESSION["pass"]=$pass;
							  $_SESSION["email"]= $email;
							   $query = mysql_query("SELECT `email` `password` FROM users WHERE email = '$email'") or die(mysql_error());
							   $result=mysql_fetch_array($query);
							  if(!$row = $result )// if details do not exist when the user tries to log on
							  {
								echo "Please register to Log in...<br>";
								echo "<a href =register.php>Register Here</a><br>";
							  }
							  else// log the user in
							  {
								echo "Thank you for logging in";
								echo "<a href=maths_loggedin.php>Start Playing</a><br>";
							  }
							}
						if(isset($_POST['submit']))// checks if the submit button has been pressed
							{
							  check_user();
							}
					?>
									
				</div> 
			</div>
		</div>
	</body>
</html>
      