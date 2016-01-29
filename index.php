 <?php
session_start();
$page_title='Home';
include('includes/header.html');
?>
<div class="wrapper">
    <div id="homeButton">
    <a href="index.php"><img src="images/home.png" alt="Home" ></a>
    </div>
    <div id="socialMedia">
        <p>Place holder for Social media content</p>
    </div>
 
         
<?php
if ($_SESSION==NULL)#Checks if there are any variables in the $_SESSION[] array
	{#if none exist
    
    	
		
	}
else#If array $_SESSION has user related variables
	{
        
?>
        
                <script>
        $(document).ready(function(){
            $("#nav").hide();
        });//end ready
        </script>
        <table id="memberLinks"><tr>
        <?php
		echo "<td>
		<p>{$_SESSION['first_name']} {$_SESSION['last_name']} </p> </td>";
		if(isset($_SESSION['author_id']))
                   
		{
                     $user_type=1;
                     $first_name= $_SESSION['first_name'];
                     $last_name= $_SESSION['last_name'];
                     ?>
                     
        <td> <a href= "author_page.php" class="iframe">Admin Area</a></td>
               <?php
		}
                if(isset ($_SESSION['customer_id'])) {
                    $user_type=2;
                     $first_name= $_SESSION['first_name'];
                    $last_name= $_SESSION['last_name'];
                    ?>
                    
                             <td><a href="order_history.php" class="iframe">Recent Orders</a></td>
                <?php } ?>
                

                             <td><a href="goodbye.php" class="iframe">Logout</a></td>
                             </tr></table>
                
	<?php } ?>
         
<div class="header">
    <a href="shop.php"><img src="images/asset.jpg" alt="Asset Management"></a>        
    <a href="shop.php"><img src="images/relations.jpg" alt="Customer Relations"></a>
    <a href="shop.php"><img src="images/research.jpg" alt="Research Methods"></a>
  </div>

    <div div id="navigation">
<ul id="nav">

            <li><a href= "shop.php">Shop</a> </li>
        
            <li><a href="index.php">Login</a>
                
                 <ul >
                     
                     <li> <a href="login.php" class="iframe">Customer Login</a></li>
                    <li><a href="author_login.php" class="iframe">Author Login</a></li>
                     
                 </ul>
                
             </li>
            <li><a href="shop.php">Register</a> 
                <ul id="loginLoad">
                 <li><a href="register.php" class="iframe">Register as a customer</a></li>
                 <li><a href="author_register.php" class="iframe">As an Author</a> </li>
                 
            </ul>
            </li>
 
</ul>
                         <div id="searchform">
	    <form  method="post" action="search.php?go"> 
                <input  type="text" name="subject" id="searchBox"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form> 
    </div>
    </div>


<div id="main">
    <div id="side-left">
        <p>Numerous users can also work on and complete the same diagram</p> 
        
    </div>
    
    <div id="middle">
<?php
require('connect_db.php');#Connects to the database
$q = "SELECT * FROM books LIMIT 2,4";
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
                    $row['price'].'<br>'
                            ?>
                     <a href="book_details.php?id=<?php echo $row['book_id'];?>
                        "class="iframe">Book Details</a><br>
                  
                    <a href="added.php?id=<?php echo $row['book_id'];?>
                       "class="fancybox"  >Add To Cart</a></td>
                    <?php
	}
	echo '</tr></table>';#Closing of the table
        ?>

        <script>
        
        </script>
</div>	
            <div id="side-right">
            <p>Numerous users can also work on and complete the same diagram</p>
        </div>

</div>
    <div id="footer">
    <?php
		echo ' |
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


 include('includes/footer.html');

?>
    </div>

</div>