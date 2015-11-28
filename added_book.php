<?php
session_start();
if(!isset($_SESSION['author_id']))
{
	require('author_login_tools.php');
	require('author_login.php');
	load('author_login.php');
	load();
}
	$page_title='Adding A book';
	include('includes/header.html');
	if(!empty($_POST['book_title']) &&($_POST['book_price']))
	{
        require('connect_db.php');
		$book_title = mysqli_real_escape_string($dbc,trim($_POST['book_title']));
                $book_title=  htmlentities($book_title);
		$book_price= mysqli_real_escape_string($dbc,trim($_POST['book_price']));
                $book_price= htmlentities($book_price);
		$summary= mysqli_real_escape_string($dbc,trim( $_POST['summary']));
                $summary= htmlentities($summary);
		$author_id=$_SESSION['author_id'];
		$q1="SELECT * FROM books WHERE author_id='$author_id'
                        AND title='$book_title'";
		$q2= mysqli_query($dbc,$q1);
		if (mysqli_num_rows($q2)!=0)#Checking if the book already exixts
            {   
              echo '<p>This Book Already exists in your inventory</p>';
              exit();
            }
        else
		   {
				#If book doesn't exist, prepared statement
				$q=$dbc->prepare("INSERT INTO books
				(author_id,title, price,summary)
				VALUES (?,?,?,?)");
				$q->bind_param("isds",$author_id,$book_title,$book_price,$summary);
				$r= $q->execute();
				echo '<p>Book Inserted</p>';
					echo '<p><a href="image_upload.php">Upload Image</a>';
					$r=mysqli_query($dbc,$q1);
					$row= mysqli_fetch_array($r);
					$new_book= $row['title'];
					$new_book_id= $row['book_id'];
					$_SESSION['new_book_id']= $new_book_id;
					$_SESSION['new_book']=$new_book;
			}
        }
            
		else{
			echo '<p>Entry incomplete. Please'.' '.'<a href="add_book.php">Try Again</a></p>';
				exit();
			
		}
        
       echo '<p><a href= "author_page.php">Admin Area</a> |
			<a href= "goodbye.php">Logout</a> </p>'; 	
			include('includes/footer.html');
?>