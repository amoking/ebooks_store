<?php
session_start();
	$page_title='Goodbye';
	include('includes/header.html');
	//setcookie(session_name(), '', 100);
	session_unset();
	session_destroy();
	$_SESSION= array();
        ?>
	<h1>Goodbye!</h1>
		<p>You are logged out</p>
<input type="button" class="closePop" value="Close and go Home"/>
<?php
		include('includes/footer.html');

