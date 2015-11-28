<! DOCTYPE HTML>
<html lang= "en">
<head>
<meta charset= "UTF-8">
<title><?php echo $page_title;?></title>
<link rel="stylesheet" href= "includes/style.css">
</head>
<body>
<?php
$page_title ='PHP Include';
include('includes/header.html');
echo '<form action="include.php" method="POST">
<p>Name: <input type="text" name="name"></p>
<p>Email: <input type= "text" name="email"></p>
<p><input type= "submit"></p></form>';
include('includes/footer.html');
?>
</body>
</html>