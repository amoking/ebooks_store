<?php
#Connect on ccacolchester  for user amosg6360
#with password '01276360' to database 'amosg6360'.
$dbc=mysqli_connect(
	"mysql.ccacolchester.com", "amosg6360", "01276360","amosg6360")
OR die
	(mysqli_connect_error());
#Set encoding to match PHP script encoding.
	mysqli_set_charset($dbc,'ut8');
        
?>