<?php
	
session_start();

error_reporting(0);
$header = require("header.php");
$header2 = require("header2.php");

if ($_SESSION['LOGGED_IN']==1)
{
	echo (
	$header."
	Sorry, you must be logged out to create a user!
	<br>
	<a href='home.php'>Home</a>
	<br>
	<hr>
	<a href='logout.php'>Logout</a>
	");
}
else
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	
	if ($username&&$password)
	{
		require('connect.php');
		
		$query = mysql_query("SELECT * FROM users WHERE username='$username'");
		
		$numrows = mysql_num_rows($query);
		
		if ($numrows!=0)
		{
			echo (
			$header."
			SORRY! Username is already taken!
			<br>
			Click <a href='create_user.php'>here</a> to try again.
			");
		}
		else
		{
			echo (
			$header."
			Are you sure you want to create this user?
			<br>
			<form action='create.php' method='POST'>
				Username: <input type='text' name='dbusername' value='$username'><br>
				Password: <input type='password' name='dbpassword' value='$password'><br>
				First Name: <input type='text' name='dbfname' value='$fname'><br>
				Last Name: <input type='text' name='dblname' value='$lname'><br>
				<input type='submit' value='Yes'>
			</form>
			<form action='create_user.php'>
				<input type='submit' value='No'>
			</form>
			");
		}
	}
	else
	{
		echo (
		$header."
		Please enter a username and password to become a member.
		<br>
		Click <a href='create_user.php'>here</a> to try again!
		");
	}
	
	echo ("
	<br>
	<hr>
	<a href='home.php'>Login</a>
	");
}

?>