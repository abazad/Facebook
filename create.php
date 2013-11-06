<?php

session_start();

error_reporting(0);

if ($_SESSION['LOGGED_IN']==1)
{
	echo(
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
	$dbusername = $_POST['dbusername'];
	$dbpassword = $_POST['dbpassword'];
	$dbfname = $_POST['dbfname'];
	$dblname = $_POST['dblname'];
	
	if ($dbusername&&$dbpassword)
	{
		//connect to mysql
		require('connect.php');
		
		//insert new user into database
		$create = mysql_query("INSERT INTO users (username, password, fname, lname) VALUES ('" . mysql_real_escape_string($dbusername) . "', '" . mysql_real_escape_string($dbpassword) . "', '" . mysql_real_escape_string($dbfname) . "', '" . mysql_real_escape_string($dblname) . "')") or die(mysql_error());
			
		$check = mysql_query("SELECT * FROM users WHERE username='$dbusername'") or die("Sorry, Error has occured.
		<br>
		Click <a href='create_user.php'>here</a> to try again.
		");
			
		$check_numrows = mysql_num_rows($check);
			
		if ($check_numrows!=0)
		{
			echo (
			$header."
			<br>
			Congratulations! You have become a new member.<br>
			Click <a href='home.php'>here</a> to login.
			");
		}
		else if($check_numrows==0)
		{
			echo (
			$header."
			SORRY! Error has occured.
			<br>
			Please, click <a href='create_user.php'>here</a> to try again.
			");
		}
	}
	else
	{
		echo (
		$header."
		Sorry, an error has occured.
		<br>
		Please, click <a href='create_user.php'>here</a> to try again.
		");
	}
	
	echo ("
	<br>
	<hr>
	<a href='home.php'>Login</a>
	");
	
}
?>