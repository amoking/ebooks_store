<?php
session_start();
	$page_title='Goodbye';
	include('includes/header.html');
	//setcookie(session_name(), '', 100);
	session_unset();
	session_destroy();
	$_SESSION= array();
	echo '<h1>Goodbye!</h1>
		<p>You are logged out.</p>';
		echo '<p><a href="shop.php">Shop</a>|
		<a href="index.php">Home</a></p>';
		include('includes/footer.html');

