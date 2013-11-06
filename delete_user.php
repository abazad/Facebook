<html>
	<head>
		<style type="text/css">
			a:link
			{
			color: #6495ED;
			text-decoration: none;
			font-size: 20px;
			}
			a:visited
			{
			color: #6495ED;
			text-decoration: none;
			font-size: 20px;
			}
			a:hover
			{
			color: #00FFFF;
			
			font-size: 20px;
			}
		</style>
	</head>
<?php

	session_start();
	
	error_reporting(0);

if ($_SESSION['LOGGED_IN']==1)
{
?>

	<form action='check_delete.php' method='POST'>
		Enter username and password to delete user.<br>
		Username: <input type='text' name='username'><br>
		Password: <input type='password' name='password'><br>
		<input type='submit' value='Delete'>
	</form>
<?php
	echo ("
	<br>
	<hr>
	<a href='logout.php'>Logout</a>
	");
}
else
{
	echo ("
	You must be logged in to delete a user!
	<br>
	<hr>
	<a href='home.php'>Login</a>
	");
}

?>

</html>