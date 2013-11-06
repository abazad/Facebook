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
	
	$username = $_POST['dbusername'];
	$password = $_POST['dbpassword'];
	
	if (($username&&$password)&&($username==$_SESSION['username']))
	{
		require('connect.php');
		
		$query = mysql_query("DELETE FROM users WHERE username='$username' AND password='$password'") or die("Couldnt query
		<br>
		Click <a href='delete_user.php'>here</a> to try again!
		");
		
		$numrows = mysql_num_rows($query);
		
		if ($numrows==0)
		{
			session_destroy();
			
			echo ("User succesfully deleted!
			<br>
			Click <a href='home.php'>here</a> to return to the home page.
			");
		}
		else
		{
			echo ("Sorry could not find user!
			<br>
			Click <a href='delete_user.php'>here</a> to try again!
			");
		}
	}
	else
	{
		echo ("Sorry, you must be logged in as this user to delete this user!
		<br>
		Click <a href='delete_user.php'>here</a> to try again!
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
