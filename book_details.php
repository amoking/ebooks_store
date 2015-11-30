<?php
session_start();
if (isset($_GET['id']))
{
    $page_title='Book Details';
	include('includes/header.html');
        $id=$_GET['id'];
	require('connect_db.php');
        $q="SELECT books.*,authors.* FROM books INNER JOIN
              authors on books.author_id=authors.author_id
              WHERE books.book_id= $id
                 ";
        $result=  mysqli_query($dbc, $q);
        if($result){
            echo'<table>';
                echo '<h2>'.'BOOK Details'. '</h2>';
                echo '<tr><td>'.'Title'.'</td>'.'<td>'.'Summary'.'</td>'.'<td>'.'Price'.'</td>'.'<td>'. 'Author'. '</td></tr>';
                echo '<tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            echo '<td>'. $row['title'].'</td>'.'<td>'. $row['summary'].
                                '</td>'.'<td>'. $row['price'].'</td>'.
                                    '<td>'. $row['first_name'].
                                     ' '. $row['last_name'].'</td>'.
                		'<a href="added.php?id='.$row['book_id'].
                                    '">Order Now</a></td>';
            
        }
        echo '</tr></table>';
        }
        
}
          echo '<p>
	<a href= "shop.php">Shop</a> |
	<a href= "index.php">Log In</a> </p>';
	 include('includes/footer.html');

