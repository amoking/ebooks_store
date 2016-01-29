<?php
if ($_SERVER['REQUEST_METHOD']=='POST')#Checks if the submit button has been clicked.
{
	require ('connect_db.php');#Connects to the database
	require('login_tools.php');#Requires the funcion to validate the login credentials
	$email= mysqli_real_escape_string($dbc, trim($_POST['email']));
        $email= htmlentities($email);
        $pass= mysqli_real_escape_string($dbc, trim($_POST['pass']));
        $pass= htmlentities($pass);
        list ($check,$data)= validate($dbc,$email, $pass);
	/*The list function creates an array element (check) to store the result of both 
		the database connection and the data provided without. Either True or False 
			i.e no errors*/
	if($check)#If there are no errors in$check
	{
		#Starts a session and stores the data in the session
		
                $_SESSION['customer_id']=$data['customer_id'];
		$_SESSION['first_name']=$data['first_name'];
		$_SESSION['last_name']=$data['last_name'];
		$page_title='Home';
include('includes/header.html');
	echo "<p>You are logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
        echo "<a href=\"javascript:history.go(-1)\">Your Cart</a>";
?>
<input type="button" class="closePop" value="Close and go Home"/>

<?php
		}
		else #Any errors are placed in the $data variable.
		{$errors=$data;}
		
}
mysqli_close($dbc);#closes the database connection.
include('includes/footer.html');

?>

