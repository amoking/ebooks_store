<?php
$page_title='Login';
include ('includes/header.html');
if (isset($errors) && !empty ($errors))
{
	echo '<p id="err_msg">Oops! There was a problem<br>';
	foreach ($errors as $msg)#Checks for errors in the log in attempt
	{
		echo "- $msg<br>";
	}
	echo 'Please try again or 
	<a href= "register.php">Register</a></p>';
}

?>
<h1>Login</h1>
<form action="login_action.php" method="POST" >
<p>
Email Address:<input type="text" name="email" required>
</p><p>
Password:<input type="password" name="pass" required>
</p><p>
<input type= "submit" value="Login">
</p>
</form>
<?php
echo '<p><a href="shop.php">Shop</a>|
		<a href="index.php">Home</a></p>';
		include('includes/footer.html');
 ?>