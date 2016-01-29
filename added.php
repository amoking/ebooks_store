<?php
session_start();
if(!isset($_SESSION['customer_id']))#checks if customer is logged in
{
	require('login_tools.php');
	require('login.php');
	load('login.php');
	load();
}
	$page_title='Cart Addition';#Sets the page title.
	include('includes/header.html');
	if(isset($_GET['id']))$id=$_GET['id'];#Gets id of the item added to the cart.
	require('connect_db.php');
	$q="SELECT * FROM books WHERE book_id=$id";
	$r=mysqli_query($dbc,$q);
if (mysqli_num_rows($r)==1)
{
	$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
	if(isset($_SESSION['cart'][$id]))
	{
		$_SESSION['cart'][$id]['quantity']++;
		echo '<p>Another '.$row["title"].
		' has been added to your cart</p>';
	}
	else
	{
		$_SESSION['cart'][$id]=
		array('quantity'=>1,'price'=>$row['price']);
		echo '<p>A '.$row["title"].
		' has been added to your cart</p>';
	}
	mysqli_close($dbc);
	echo '<p><a href= "cart.php">View Cart</a> |
            </p>';
}
include ('includes/footer.html');
?>