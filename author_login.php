<?php
$page_title='Author Login';
include ('includes/header.html');

?>

<h1>Login</h1>
<form action="author_login_action.php" method="POST"name="loginForm" id="loginForm">
<p>
    Email Address:<input type="text" name="email" id="email" class="required">
</p><p>
    Password:<input type="password" name="pass" id="pass" class="required">
</p><p>
<input type= "submit" value="Login">
</p>
</form>

<?php include ('includes/footer.html');?>