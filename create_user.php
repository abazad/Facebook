<?php

session_start();

error_reporting(0);

$header = require("header.php");
$header2 = require("header2.php");

if ($_SESSION['LOGGED_IN'])
{
	echo (
	$header."
	You must be logged out in order to create a new user!
	<br>
	<a href='home.php'>Home</a>
	<br>
	<hr>
	<a href='logout.php'>Logout</a>
	");
}
else
{
echo($header);

?>
	<form action = 'check.php' method = 'POST'>
		Enter Username and Password to become a member!<br>
		  Username: 	<input type='text' name='username'><br>
		  Password: 	<input type='password' name='password'><br>
		First Name: 	<input type='text' name='fname'><br>
		 Last Name:		<input type='text' name='lname'><br>
						<input type='submit' value='Create'>
	</form>
<?php
	echo ("
	<br>
	<hr>
	<a href='home.php'>Login</a>
	");
}
?>
	
</html>