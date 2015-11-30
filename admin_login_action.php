<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	require ('connect_db.php');
	require('admin_login_tools.php');
	list ($check,$data)= validate($dbc,$_POST['email'], $_POST['pass']);
	if($check)
	{
		session_start();
		$_SESSION['admin_id']=$data['admin_id'];
		$_SESSION['first_name']=$data['first_name'];
		$_SESSION['last_name']=$data['last_name'];
		$page_title='Administration';
		include('includes/header.html');
		echo "<h1>ADMINISTRATOR HOME<h1>
		<p>You are logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
                $q = "SELECT * FROM orders";
                $result=  mysqli_query($dbc, $q);
                if($result)
          {
                    
               echo '<h2> What would like to do today</h2>';
               echo'<table>';
                echo '<tr><td>'.'Order Id'.'</td>'.'<td>'.'Order Total'.'</td>'.'<td>'.'Site commission(10%)'.'</td></tr>';
	  //-create  while loop and loop through result set 
	  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
                    $amount= $row['amount'];
                    $income= ($amount*0.1);
	            echo 
                 '<tr><td>'.$row['order_id'].'</td>'.
                 '<td>'.$amount.'</td>'.
				'<td>'.$income.'</td></tr>';
		 
                    }
                 echo '</table>';
          }    
		echo '<p><a href= "shop.php">Shop</a> |
		<a href= "goodbye.php">Logout</a> </p>';
	}
	else {$errors=$data;}
	
}
mysqli_close($dbc);
include('includes/footer.html');
?>