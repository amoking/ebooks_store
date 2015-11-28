<?php
session_start();
if(!isset($_SESSION['customer_id']))#Checks if customer is logged in
	{
		require('login_tools.php');
		require('login.php');
		load('login.php');
		load();
	}
$page_title='Cart';
include('includes/header.html');
if($_SERVER['REQUEST_METHOD']=='POST')#Checks if submit button has been clicked
{
	foreach($_POST['qty'] as $book_id=>$item_qty)#Loop to add up the quantity of books ordered
	{
		#Ensure values are integers.
		$id=(int)$book_id;
		$qty=(int)$item_qty;
		#Change quantity or delete if zero.
		if($qty==0)
		{unset ($_SESSION['cart'][$id]);}
		else
		{$_SESSION['cart'][$id]['quantity']=$qty;}
	}
}
$total=0;
if(!empty($_SESSION['cart']))
{
	require('connect_db.php');
	$q= "SELECT * FROM books WHERE book_id IN(";
	foreach($_SESSION['cart'] as $id =>$value)
	{$q  .= $id . ',';}
	$q= substr($q,0,-1). ')ORDER BY book_id ASC';
	$r=mysqli_query($dbc,$q);
	echo '<form action="cart.php" method="POST"><table>
	<tr><th colspan="5">Items in your Cart</th></tr><tr>';
	while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC ))
	{
		#Calculate sub-totals and grand total.
		$line_total=$_SESSION['cart'][$row['book_id']]['price'];
		$subtotal=$_SESSION['cart'][$row['book_id']]['quantity'] * $line_total;
		$total+=$subtotal;
		#Display the row.
		echo "<tr><td>{$row['title']}</td>
		<td><input type=\"text\" size=\"3\"
		name = \"qty[{$row['book_id']}]\"
		value=\"{$_SESSION['cart'][$row['book_id']]['quantity']}\">
		</td><td>@{$row['price']} =</td>
		<td>".number_format($subtotal,2)."</td></tr>";
		
	}
	echo '<tr><td colspan="5">
	Total= '.number_format($total,2).'</td></tr>
	</table>
	<input type="submit" value="Update My Cart">
	</form>';
	mysqli_close($dbc);
}
else
	{
		echo '<p>Your cart is currently empty</p>';
	}
echo '<p><a href="shop.php">Shop</a>
	<a href="checkout.php?total='.$total.'">Checkout</a> |
	<a href="index.php">Home</a> |
	<a href="goodbye.php">Logout</a></p>';
	
	include ('includes/footer.html');
?>