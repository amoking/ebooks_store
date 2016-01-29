
<?php
$page_title='Login';
include ('includes/header.html');
?>

<h1>Login</h1>
<form action="login_action.php" method="POST" id="loginForm">
<p>
    Email Address:<input type="text" name="email" id="email" class="required">
</p><p>
    Password:<input type="password" name="pass" id="pass" class="required">
</p><p>
<input type= "submit" value="Login">
</p>
</form>

