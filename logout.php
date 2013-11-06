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
	session_destroy();

		echo (
		$header."
		<br>
		Log out succesful.
		<br>
		If you are not automatically redirected to the home page, click <a href='home.php'>here</a>.
		".$footer2);
}
else
{
	echo (
	$header."
	You are already logged out!
	".$footer2);
}

?>

<META HTTP-EQUIV="refresh" CONTENT="2;URL=home.php">
</html>