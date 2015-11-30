<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	require ('connect_db.php');
	require('author_login_tools.php');
	list ($check,$data)= validate($dbc,$_POST['email'], $_POST['pass']);
	if($check)
	{
		session_start();
		$_SESSION['author_id']=$data['author_id'];
		$_SESSION['first_name']=$data['first_name'];
		$_SESSION['last_name']=$data['last_name'];
		$page_title='Author Login';
		include('includes/header.html');
		echo "<h1>AUTHOR HOME<h1>
		<p>You are logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
		echo '<p><a href= "author_page.php">Admin Area</a> |
		<a href= "goodbye.php">Logout</a> </p>';
	}
	else {$errors=$data;}
	
}
mysqli_close($dbc);
include('includes/footer.html');
?>