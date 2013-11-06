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

if($_SESSION['LOGGED_IN']==1)
{
	$id = $_SESSION['user_id'];
		
	require("connect.php");
	
	$result = mysql_query("SELECT users.user_id, users.fname, users.lname FROM user_to_friend, users WHERE user_to_friend.user_id='{$id}' AND user_to_friend.user_to_friend_id=users.user_id");
	
	if($result && mysql_num_rows($result) > 0)
	{
		print $header2 . "<br/>FRIENDS";
		while($row = mysql_fetch_object($result))
		{
			print "<hr align='left' width=10%'><a href='friend.php?user_id={$row->user_id}'>" . $row->fname . " " . $row->lname . "</a><br />";
		}
		print $footer;
	} else {
		echo (
		$header2.
		"You have no friends
		".$footer);
	}
} else {
	echo(
	$header.
	"You must be logged in!
	".$footer2);
}

?>