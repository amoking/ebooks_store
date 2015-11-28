<?php
session_start();
if(!isset($_SESSION['author_id']))
{
	require('author_login_tools.php');
	require('author_login.php');
	load('author_login.php');
	load();
}
	$page_title='Title Edited';
	include('includes/header.html');
	if(isset($_SESSION['id']))$id=$_SESSION['id'];
	require('connect_db.php');
	if(isset($_POST['new_price']))$new_price=$_POST['new_price'];
	{
		$new_price=(float)$new_price;
		if(empty($new_price))
		{
			echo'Enter a new price.';
			echo'<p><a href="price_editor.php">BACK</a></p>';
			exit(); 
		}
		else
		{
			$price_2= mysqli_real_escape_string($dbc, trim($new_price));
			$price_2= strip_tags($price_2);
			$price_2= htmlentities($price_2);
		}
	}
		$q="UPDATE books SET price='$price_2' WHERE book_id=".$_SESSION['id']."";
		$r=mysqli_query($dbc,$q);
		if($r)
		{
			echo $_SESSION['old_price']." has been updated to ";
			echo "<tr><td>$new_price</td>";
		}
		else
		{
			echo'<p>No Data returned</p>';
		}
			echo '<p><a href="add_book.php">Add a Book</a> |
			<a href="goodbye.php">Logout</a></p>';
			echo '<p><a href= "author_page.php">Admin Area</a> </p>';
	

		
	
	
	
