<?php

///////////////////////////////////////////////////////////////
// Julia Hunter
// 16 October 2013
// query_students.php
// * implements the query "list the names of students doing xxx"
// * demonstrates error handling
///////////////////////////////////////////////////////////////


	// get the database credentials from the file login.php
	//require_once "login.php";
	
	// try to connect to the database server
	$db_server = mysqli_connect("localhost", "root", "GoodPass");
	
	// cehck that the connection is valid and usable
	if (!$db_server) 
	{
		die("unable to connect to MySQL: " . mysqli_error());
	}

	// select the database, print error if this fails
	// notice the different syntax using "or" this time
	mysqli_select_db($db_server,"ebooks_store" )
		or die("Unable to select database: " . mysqli_error());

	// query the students on Web Programming register
	$query = "SELECT first_name FROM authors  WHERE author_id=1";
	$result = mysqli_query($db_server,$query );
	
	if (!$result)
	{
		die ("Database access failed:".sql_error());
	}

	// print the first name of each student on Web programming register (now print the family name as well)
	while($row = mysqli_fetch_array($result))
	{
		$first_name = $row['first_name'];
		print $first_name . "<br/>";
	}

?>