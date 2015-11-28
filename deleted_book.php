<?php
session_start();
if(!isset($_SESSION['author_id']))
{
	require('author_login_tools.php');
	require('author_login.php');
	load('author_login.php');
	load();
}
$page_title='Delete Book';
include('includes/header.html');
$id=$_GET['id'];
	require('connect_db.php');
	 $q= "DELETE FROM books WHERE  book_id= $id ";
	$r=mysqli_query($dbc,$q);
	
	if($r)
	{
		echo'<p>Book Deleted</p>';
	}
	else
	{
		echo '<p>Error</p>';
	}

	
	
	mysqli_close($dbc);


echo '<p><a href="add_book.php">Add a Book</a> |
	<a href="goodbye.php">Logout</a></p>';
echo '<p><a href= "author_page.php">Admin Area</a> </p>';
	
	include ('includes/footer.html');

?>