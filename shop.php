<?php
session_start();#Starts a session
$page_title='Shop';
include('includes/header.html');
echo '<p><a href="admin_page.php">Site Admin</a></p> ';
if ($_SESSION==NULL)#If no one is logged in
	{
		echo '<p>Welcome</p>';
		echo '<p><h2>LOGIN</h2></p>';
		echo '<p>Customer <a href="login.php">Login</p> ';
		echo '<p>Author <a href="author_login.php">Login</p>';

		echo'<p><h2>Register here <a href="register.php">As a customer</a></h2></p>';
		echo'<p><h2> or <a href="author_register.php">As an Author</a></h2></p>';
	}
else

	{
     echo '<p><a href="order_history.php">View Recent Orders</a></p>';
     echo ' <a href="goodbye.php">Logout</a>';#If a user is logged in.
        
	}
?>
<h3>Search Book by Subject</h3> 
	    <form  method="post" action="search.php?go"  id="searchform"> 
	      <input  type="text" name="subject"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form> 
	  </body> 

<?php
require('connect_db.php');#Require a connection to the database
$q = "SELECT * FROM books";#Retrieve all data from the books table.
$r=mysqli_query($dbc,$q);
if(mysqli_num_rows($r)>0)#If there is at least 1 row.
{
	echo'<table><tr>';
        echo '<h2>Books Available to buy</h2>';
	while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC))#Retrieve all the data
	{
            $img= '<img src='.$row['book_img'].' width="100" height="100"/>';
          	echo 
                 '<td>'.$img.'<br>'.
                 $row['title'].'<br>£'.
				$row['price'].'<br>'.
				$row['summary'].'<br>'.#Display the books
		'<a href="added.php?id='.$row['book_id'].
		'">Add To Cart</a></td>';
	}
	echo '</tr></table>';
	
		echo '<p><a href ="cart.php">View Cart</a> |
	
	<a href ="forum.php">Forum</a> |
	<a href="index.php">Home</a> </p>';
         if ($_SESSION!=NULL)#If a user is logged in
        {
            echo ' | <a href="goodbye.php">Logout</a>';
        }
        else
        {
            echo 'You\'re currently not logged in' ;
        }
}
else#If no rows are returned.
{
	echo'<p>There are currently no items in this shop.</p>';
}

include('includes/footer.html');

?>