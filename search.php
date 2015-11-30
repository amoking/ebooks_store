<?php
session_start();
       $page_title='Order Details';
	include('includes/header.html');
                #$customer_id= $_SESSION['customer_id'];
                $id=$_GET['go'];
		require('connect_db.php');
	  if(isset($id)){ 
	 if(preg_match("/^[  a-zA-Z]+/", $_POST['subject'])){ 
	  $subject=$_POST['subject']; 
       //-query  the database table 
	  $sql="SELECT * FROM books WHERE title LIKE '%$subject%'"; 
	  //-run  the query against the mysql query function 
	  $result=mysqli_query($dbc,$sql); 
          if($result)
          {
               echo '<h2> Your search for ' .$subject.' results</h2>';
	  //-create  while loop and loop through result set 
	  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
	          $title  =$row['title']; 
	          $price=$row['price']; 
	          $id=$row['book_id']; 
	  //-display the result of the array 
	  echo "<ul>\n"; 
         
	  echo '<li>' .$title." ".'<a href="book_details.php?id= '.$row['book_id'].'">Book Details</a>'.'</li>';
                 
	  echo "</ul>"; 
	  } 
	  }
          else {
                            echo 'No books currently match your search';}
          }
          }
	  else{ 
	  echo  "<p>Please enter a search query</p>"; 
	  } 
	   
	   
          echo '<p>
	<a href= "shop.php">Shop</a> |
	<a href= "goodbye.php">Logout</a> </p>';
	 include('includes/footer.html');


