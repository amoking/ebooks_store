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
        ?>

                        <h2>ORDER <?php echo $id;?> DETAILS</h2>
                
                <table id="order_details">
                <tr><td>Book Description</td> <td>Price</td> <td>Quantity</td></tr>
              <?php
                while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC))#Retrieve all the data
                {
                 $title= $row['title'];
                 $price=$row['price'];
                 $summary=$row['summary'];
                 $quantity=$row['quantity']
                
             ?>
                   
                 <tr><td><?php echo $title?></td><td><?php echo$price?></td><td><?php echo$quantity?></td></tr>
		 
             <?php
                }
                echo '</table>';  
        }
 else {
            echo '<p>No data</p>';
 }
 ?>
 <input type="button" class="closePop" value="Continue Shopping"/>
<?php
	 include('includes/footer.html');

