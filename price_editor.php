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
	if(isset($_GET['id']))$_SESSION['id']=$_GET['id'];
		require('connect_db.php');
		$q= "SELECT * FROM books WHERE book_id=".$_SESSION['id']."";
		$r=mysqli_query($dbc,$q);
		if($r)
		{
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$_SESSION['old_price']=$row['price'];
			echo "<tr><td>". $row['title']."</tr></td>";
			echo "<tr><td>".$_SESSION['old_price']."</td>";
				   
		}
		echo '<p><a href="image_upload.php">Add an Image</a> |
				<a href="add_book.php">Add a Book</a> |
				<a href="goodbye.php">Logout</a></p>';
				echo '<p><a href= "author_page.php">Admin Area</a> </p>';
		?>
		<form action="price_edited.php" method="POST">
			<tr><td>New Price<input type="text" size="30"
                                                name = "new_price"required</td>
			</tr>
			<input type="submit" value="Update "></form>
			
	<?php include('includes/footer.html');?>
	
	
