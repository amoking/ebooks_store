<?php
session_start();
if(!isset($_SESSION['customer_id'] ))#checks if user is logged in
{
	require('login_tools.php');
	require('login.php');
	load('login.php');
	load();
}
$page_title='Checkout';
include('includes/header.html');
if(isset($_GET['total'])#Checks if total from the cart is is set
		&&($_GET['total']>0)#If total is zero
		&&(!empty($_SESSION['cart'])))#If the cart is not empty
		{
			require('connect_db.php');
			$q= "INSERT INTO orders(customer_id,amount,order_date) VALUES ("
			.$_SESSION['customer_id']. ",".$_GET['total'].",NOW())";
			$r=mysqli_query($dbc,$q);
			$order_id=mysqli_insert_id($dbc);
			$q="SELECT * FROM books WHERE book_id IN(";
			foreach($_SESSION['cart'] as $id=>$value )
			{$q .=$id. ',';}
			$q=substr($q,0,-1).')ORDER BY book_id ASC';
			$r=mysqli_query($dbc,$q);
			while ($row= mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$query="INSERT INTO order_contents
				(order_id,book_id,quantity,price)
				VALUES ($order_id,".$row['book_id'].",".
				$_SESSION['cart'][$row['book_id']]['quantity'].",".
				$_SESSION['cart'][$row['book_id']]['price'].")";
				$result=mysqli_query($dbc,$query);
				echo '<table><tr><td>'.$row['title'].'<td>'
				.$_SESSION['cart'][$row['book_id']]['price'].'</td></tr></table>';
			}
			if($result)
				{echo '<p>'.'We\'ll send your book to you shortly</p>';}
			else{echo'<p>Error</p>';}
			mysqli_close($dbc);
				echo '<tr><td colspan="5">
				Total= '.number_format($_GET['total'],2).'</td></tr>';
				echo "<p>Thanks for your order
						Your Order Number  is #". $order_id."</p>";
						$_SESSION['cart']=NULL;
		}
		else#If cart is empty.
		{echo '<p>There are no items in your cart.</p>';}
               
							
		echo '<p><a href="shop.php">Shop</a>|
		<a href="index.php">Home</a> |
		<a href="goodbye.php">Logout</a></p>';
		include('includes/footer.html');

?>