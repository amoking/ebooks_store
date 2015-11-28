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
	require('connect_db.php');
    $id=$_GET['id'];
	$q= "SELECT * FROM books WHERE book_id=$id";
	$r=mysqli_query($dbc,$q);
	while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC ))
	{
		if($q)
			{				
			echo '<table><tr><td>'.$row['title'].'</td>'.
			'<td>'.$row['price'].
			'<a href="deleted_book.php?id='.$id.'">Delete</a>'.'</td></tr></table>';
			}
		else
			{
				echo '<p>Your inventory is currently empty</p>';
			}
				
    }
	mysqli_close($dbc);
	echo '<p><a href="add_book.php">Add a Book</a> |
		<a href="goodbye.php">Logout</a></p>';
	echo '<p><a href= "author_page.php">Admin Area</a> | </p>';
	include ('includes/footer.html');

?>