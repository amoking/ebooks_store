<?php
session_start();
if(!isset($_SESSION['author_id']))
{
	require('author_login_tools.php');
	require('author_login.php');
	load('author_login.php');
	load();
}
	$page_title='Adding A book';
	include('includes/header.html');
	require('connect_db.php');

?>
<form action="added_book.php" method="POST">
 Title<input type= "text" name= "book_title" required/>
 Price<input type="text" name="book_price" required/>
Summary<textarea name="summary" cols="40" rows="5" required></textarea>
<input type= "submit" value="POST"/>
<?php
echo '<p><a href= "author_page.php">Admin Area</a> |
<a href= "goodbye.php">Logout</a> </p>';
include ('includes/footer.html');
?>