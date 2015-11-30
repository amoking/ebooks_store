<?php
session_start();
if(!isset($_SESSION['author_id']))
{
	require('author_login_tools.php');
		require('author_login.php');
	load('author_login.php');
	load();
}
	$page_title='What you have sold';
	include('includes/header.html');
        $author_id= $_SESSION['author_id'];
        require('connect_db.php');
        $q= "SELECT books.*,books.*,order_contents.*
                    FROM books INNER JOIN order_contents
                    ON books.book_id = order_contents.book_id 
                    INNER JOIN orders
                    ON orders.order_id= order_contents.order_id
                    WHERE books.author_id=$author_id
                        ";


    $r=mysqli_query($dbc,$q);
    if($r)#If there is at least 1 row.
        {
                echo'<table>';
                echo '<h2>BOOKS YOU\'VE SOLD SO FAR</h2>';
                echo '<tr><td>'.'Order Id'.'</td>'.'<td>'.'Book'.'</td>'.'<td>'.'Price'.'</td>'.'<td>'.'Quantity'.'</td></tr>';
                while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC))#Retrieve all the data
                {
           
                    echo 
                 '<tr><td>'.$row['order_id'].'</td>'.
                 '<td>'.$row['title'].'</td>'.
				'<td>'.$row['price'].'</td>'.
				
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



