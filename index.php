<?php
session_start();
$page_title='Home';
include('includes/header.html');
if ($_SESSION==NULL)#Checks if there are any variables in the $_SESSION[] array
	{#if none exist
		echo '<p>Welcome</p>';
		echo '<p><h2>LOGIN</h2></p>';
		echo '<p>Customer <a href="login.php">Login</p> ';
		echo '<p>Author <a href="author_login.php">Login</p>';

		echo'<p><h2>Register here <a href="register.php">As a customer</a></h2></p>';
		echo'<p><h2> or <a href="author_register.php">As an Author</a></h2></p>';
	}
else#If array $_SESSION has user related variables
	{
		echo "<h1>HOME</h1>
		<p>You are logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
		if(isset($_SESSION['author_id']))
		{
			echo '<p><a href= "author_page.php">Admin Area</a></p>';
		}

		echo'<p><a href="goodbye.php">Logout</a></p>';
	}
$page_title = 'Shop';#Sets the page title
require('connect_db.php');#Connects to the database
$q = "SELECT * FROM books";
$r=mysqli_query($dbc,$q);
if(mysqli_num_rows($r)>0)#Checks if the store has any items listed
{
	echo'<table><tr>';#Opens a table
        echo '<h2>Books Available to buy</h2>';
	while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC))
         #Retrieves the arrays as per the query
	{#Sets image size.
            $img= '<img src='.$row['book_img'].' width="100" height="100"/>';
                    echo 
                    '<td>'.$img.'<br>'.
                    $row['title'].'<br>'.
                    $row['price'].'<br>'.
					$row['summary'].'<br>'.
                    '<a href="added.php?id='.$row['book_id'].
                    '">Add To Cart</a></td>';
	}
	echo '</tr></table>';#Closing of the table
	
		echo '<p><a href ="cart.php">View Cart</a> |
                        <a href="index.php">Home</a> </p>';
        if ($_SESSION!=NULL)#If a user is logged in
        {
            echo ' | <a href="goodbye.php">Logout</a>';
        }
        else
        {#If User is not logged in
            echo 'You\'re currently not logged in' ;
        }
                
}
	else#If there are no items in the store
	{
		echo'<p>There are currently no items in this shop.</p>';
	}


echo '<p>
<a href="forum.php>Forum"</a> |
<a href= "shop.php">Shop</a> ';
include('includes/footer.html');
