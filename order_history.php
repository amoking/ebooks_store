<?php
session_start();
$page_title='Order History';
include('includes/header.html');
if(!isset($_SESSION['customer_id'] ))#checks if user is logged in
{
	require('login_tools.php');
	require('login.php');
	load('login.php');
	load();
}
                $customer_id= $_SESSION['customer_id'];
              require('connect_db.php');
                $q= "SELECT *
                    from orders 
                    WHERE
                    orders.customer_id= $customer_id";

    $r=mysqli_query($dbc,$q);
    if($r)#If there is at least 1 row.
        {
                echo'<table>';
                echo '<h2>Recent Orders</h2>';
                echo '<tr><td>'.'ORDER ID'.'</td>'.'<td>'.'AMOUNT'.'</td'.'<td>'.'DATE'.'</td></tr>';
                while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC))#Retrieve all the data
                {
           
                    echo 
                 '<tr><td>'. 
                 $row['order_id'].'</td>'.
				'<td>'.$row['amount'].'</td>'.
				#$row['summary'].'<br>'.#Display the books
		'<td>'.$row['order_date'].'<a href="order_details.php?id= '.$row['order_id'].'">View Details</a>'.'</td></tr>';
		 
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
