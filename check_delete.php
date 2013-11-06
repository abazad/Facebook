<html>
	<head>
		<link rel="stylesheet" type="text/css" href="main.css" />
		<div class='h1'>
			<div class='h2'>
				Leti's Website
			</div>
		</div>
	</head>
<?php

	session_start();
	
	error_reporting(0);

if ($_SESSION['LOGGED_IN']==1)
{

	//connect to mysql
	require('connect.php');
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if ($username&&$password)
	{
		$query = mysql_query("SELECT * FROM users WHERE username='$username'") or die("Sorry, couldnt query
		<br>
		Click <a href='delete_user.php'>here</a> to try again!
		");
	
		$numrows = mysql_num_rows($query);
	
		if ($numrows!=0)
		{
			echo ("Are you sure you want to delete this user?
			<br>
			<form action='delete.php' method='POST'>
				Username: <input type='text' name='dbusername' value='$username'><br>
				Password: <input type='password' name='dbpassword' value='$password'><br>
				<input type='submit' value='Yes'><br>
			</form>
			<form action='delete_user.php'>
				<input type='submit' value='No'>
			</form>
			");
		}
		else
		{
			echo ("Sorry, couldn't find user!
			<br>
			Click <a href='delete_user.php'>here</a> to try again!
			");
		}
	}
	else
	{
		echo ("Sorry, a problem has occured!
		<br>
		Click <a href='delete_user.php'>here</a> to retry!
		");
	}
	
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