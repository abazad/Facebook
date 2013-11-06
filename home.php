<html>
<?php

session_start();

error_reporting(0);

//Required Variables
$news = require("news.php"); //news
$header = require("header.php"); //not logged in
$header2 = require("header2.php"); //logged in
$header3 = require("header3.php"); //admin header
$footer = require("footer.php"); //logout
$footer2 = require("footer2.php"); //login

if ($_SESSION['LOGGED_IN']==1)
{
	if ($_SESSION['Admin']==1)
	{
		echo (
		$header3.
		"<br>
		".$news.
		$footer);
	}
	else
	{
		echo (
		$header2.
		"<br>
		".$news.
		$footer);
	}
}
else
{

	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($username&&$password)
	{

		require('connect.php');
		
		$query = mysql_query("SELECT * FROM users  WHERE username='$username'") or die(
		$header."
		Sorry, could not query
		<br>
		".$footer2);
		
		$numrows = mysql_num_rows($query);
		
		if ($numrows!=0)
		{
			while ($row = mysql_fetch_assoc($query))
			{
				$dbuserid = $row['user_id'];
				$dbusername = $row['username'];
				$dbpassword = $row['password'];
				$dbfname = $row['fname'];
				$dblname = $row['lname'];
			}
		
			// check to see if they match!
			if ($username==$dbusername&&$password==$dbpassword)
			{
				$_SESSION['user_id'] = $dbuserid;
				$_SESSION['username'] = $dbusername;
				$_SESSION['fname'] = $dbfname;
				$_SESSION['lname'] = $dblname;
				$_SESSION['LOGGED_IN'] = 1;
				
				if ($_SESSION['username']==$dbusername||$_SESSION['LOGGED_IN']==1)
				{
					echo (
					$header2.
					"<br>
					".$news.
					$footer);
				}
				else
				{
					die(
					$header."
					You must be logged in!
					".$footer2);
				}
			}
			else
			{
				echo (
				$header."
				Incorrect password!
				".$footer2);
			}
		}
		else
		{
			die(
			$header."
			That user doesn't exist!
			<br>
			Click <a href='create_user.php'>here</a> to create new user!
			".$footer2);
		}

	}
	else
	{
		echo (
		$header."
		<form action = '' method = 'POST'>
			Username: <input type='text' name='username'><br>
			Password: <input type='password' name='password'><br>
			<input type='submit' value='Log In'>
		</form>
		<br>
		<br>
		Not a <a href='create_user.php'>member</a>?
		");
	}
}

?>
</html>