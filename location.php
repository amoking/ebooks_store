<! DOCTYPE HTML>
<html lang= "en">
<head>
<meta charset= "UTF-8">
<title>Header Location</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['id']))
{
	$id = $_SESSION['id'];
	echo "Welcome user ID #$id";
}
else
{
		require ('connect_db.php');
	require('login_tools.php');
	require('login.php');
	load();
}

?>
</body>
</html>