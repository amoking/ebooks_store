<?php
function load($page='login.php')#Declare a function to load login.php
{
	$url = 'http://'.$_SERVER['HTTP_HOST'].#This dictates the database in current use
						dirname($_SERVER['PHP_SELF']);#Stipulates the server in current use
	$url= rtrim($url,'/\\');#This trims any slashes from the url.
	$url .='/'.$page;#Defines the url and adds a slash before the page name.
	exit();
	header("Location:$url");#Loads the page
	exit();
}
function validate($dbc, $email ='',$pwd='')#Function to validate login attempts
{
		$e= mysqli_real_escape_string($dbc, trim($email));#Escapes any special characters 
		#to avoid codes being run on the database.
		$email= strip_tags($email);

$p= mysqli_real_escape_string($dbc, trim($pwd));
$pwd= strip_tags($pwd);	

        $q= "SELECT *
	FROM customers 
	WHERE email='$e'
	AND password= SHA1('$p')";#Retrieves customer related data
	$r= mysqli_query($dbc,$q);
	if(($r))#If only 1 row matches the data entered by the user.
	{
		$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
		return array(true,$row);
	}
	#If no data is received or more than 1 entries exist.
	else{echo 'Email address and password not found';
        ?>
<h2><a href="register.php">Or Register Here</a></h2>
<h2><a href="author_login.php">Authors Login Here</a> </h2>
        <?php
        }
        
	
        


}

?>