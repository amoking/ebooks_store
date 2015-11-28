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
	$errors =array();#Array to store errors.
	if(empty($email))
	{$errors[]='Enter your email address.';}
	else
	{$e= mysqli_real_escape_string($dbc, trim($email));#Escapes any special characters 
		#to avoid codes being run on the database.
		$email= strip_tags($email);}
if (empty($pwd))
{$errors[]= 'Enter your password.';}
else
{$p= mysqli_real_escape_string($dbc, trim($pwd));
$pwd= strip_tags($pwd);	}
if (empty ($errors))
{
	$q= "SELECT customer_id,first_name,last_name
	FROM customers 
	WHERE email='$e'
	AND password= SHA1('$p')";#Retrieves customer related data
	$r= mysqli_query($dbc,$q);
	if(mysqli_num_rows($r)==1)#If only 1 row matches the data entered by the user.
	{
		$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
		return array(true,$row);
	}
	#If no data is received or more than 1 entries exist.
	else{$errors[]= 'Email address and password not found';} 
	return array(false,$errors);
}

}

?>