<?php
session_start();
if(!isset($_SESSION['author_id']))
{
	require('author_login_tools.php');
		require('author_login.php');
	load('author_login.php');
	load();
}
	$page_title='Admin Area';
	include('includes/header.html');
	require('connect_db.php');
	 $q= "SELECT * FROM books WHERE author_id=".$_SESSION['author_id']."";
	$r=mysqli_query($dbc,$q);
	while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC ))
	{
		if($q)
		{	
		#Display the row.
		echo '<table><tr><td>'.$row['title']."	".'<td>'.
			'<td>'.$row['price']."	".'<a href="price_editor.php?id='.
            $row['book_id'].'">Edit</a>'.
			'<a href="delete_book.php?id='.$row['book_id'].
			'">Delete</a>'.'</td></tr></table>';
		}
		else
			{
				echo '<p>Your inventory is currently empty</p>';
			}
	}
	
	mysqli_close($dbc);
echo '<p><a href="add_book.php">Add a Book</a> 
    |<a href="ordered_books.php">Sales figures</a> |
		<a href="goodbye.php">Logout</a></p>';
		include ('includes/footer.html');

?>