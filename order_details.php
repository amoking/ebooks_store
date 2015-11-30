<?php
session_start();
if(!isset($_SESSION['customer_id'] ))#checks if user is logged in
{
	require('login_tools.php');
	require('login.php');
	load('login.php');
	load();
}
        $page_title='Order Details';
	include('includes/header.html');
                $customer_id= $_SESSION['customer_id'];
                $id=$_GET['id'];
		require('connect_db.php');
                $q= "SELECT books.*,books.*,order_contents.*
                    FROM books INNER JOIN order_contents
                    ON books.book_id = order_contents.book_id 
                    INNER JOIN orders
                    ON orders.order_id= order_contents.order_id
                    WHERE order_contents.order_id=$id
                        ";


    $r=mysqli_query($dbc,$q);
    if($r)#If there is at least 1 row.
        {
                echo'<table>';
                echo '<h2>'.'ORDER'.'   ' .$id.'    '. 'DETAILS' .'</h2>';
                echo '<tr><td>'.'Book Description'.'</td>'.'<td>'.'Price'.'</td>'.'<td>'.'Quantity'.'</td></tr>';
                while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC))#Retrieve all the data
                {
           
                    echo 
                 '<tr><td>'. 
                 $row['title'].'</td>'.
				'<td>'.$row['price'].'</td>'.
				#$row['summary'].'<br>'.#Display the books
		'<td>'.$row['quantity'].'</td></tr>';
		 
                }
                echo '</table>';
        }
 else {
            echo '<p>No data</p>';
 }

echo '<p>
	<a href= "shop.php">Shop</a> |
	<a href= "goodbye.php">Logout</a> </p>';
	 include('includes/footer.html');

