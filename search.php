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
	require("connect.php");
	
	if($_POST['friend'])
	{
		$user_id = $_SESSION['user_id'];
		$id = $_GET['user_id'];
		$add = mysql_query("INSERT INTO user_to_friend (user_id, user_to_friend_id) VALUES ($id, $user_id), ($user_id, $id)");
	}
	
	$result = mysql_query("SELECT * FROM users WHERE user_id!={$_SESSION['user_id']}");
	
	if($result && mysql_num_rows($result) > 0)
	{
		print $header2 . "<br/>PEOPLE";
		while($row = mysql_fetch_object($result))
		{
			print "<hr align='left' width=10%'><a href = 'friend.php?user_id={$row->user_id}&fname={$row->fname}&lname={$row->lname}'>" . $row->fname . " " . $row->lname . "</a><br/>";
		}
		print $footer;
	}
	else
	{
		echo($header2.
		"Error Occured"
		.$footer);
	}
}
else
{
	echo(
	$header.
	"You must be logged in!
	".$footer2);
}

?>