<! DOCTYPE HTML>
<html lang= "en">
<head>
<meta charset= "UTF-8">
<title>Header Location</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['author_id']))
{
	$id = $_SESSION['author_id'];
	echo "Welcome user ID #$id";
}
else
{
		require ('connect_db.php');
	require('author_login_tools.php');
	require('author_login.php');
	load();
}

?>
</body>
</html>