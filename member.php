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
	echo (
	$header2.
	"Welcome, ".$_SESSION['fname']."!
	<br>
	<a href='delete_user.php'>Delete</a> a user?
	".$footer);
}
else
{
	die(
	$header."
	You must be logged in!
	".$footer2);
}

?>