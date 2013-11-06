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
	$id = $_GET['user_id'];
	$user_id = $_SESSION['user_id'];
	
	require("connect.php");
	
	$result = mysql_query("SELECT users.* FROM users, user_to_friend WHERE user_to_friend.user_id='{$user_id}' AND users.user_id='$id' AND user_to_friend.user_to_friend_id=users.user_id");

	if($result && mysql_num_rows($result) == 1)
	{
		while($row = mysql_fetch_object($result)){
			$user_id = $row->user_id;
			$fname = $row->fname;
			$lname = $row->lname;
		}
		
		$result = mysql_query("SELECT * FROM profile_pics WHERE id='$user_id'");
		
		while($row = mysql_fetch_object($result)){
			$prof_pic = $row->file_name;
		}
		
		print $header2 . "<img src='upload/$prof_pic' width='30px' height='30px' /> $user_id" . $row->fname . " " . $row->lname . "<br/>" . $footer;
	}
	else
	{
		$person_query = mysql_query("SELECT * FROM users WHERE user_id='$id'");

		$person_num_rows = mysql_num_rows($person_query);

		if($person_num_rows > 0)
		{
			$p_row = mysql_fetch_object($person_query);
			$p_fname = $p_row->fname;
			$p_lname = $p_row->lname;
		}
		else
		{
			print "SELECT * FROM users WHERE user_id='$id'";
		}
		print $header2 . "You are not friends with " . $p_fname . " " . $p_lname . "!";
		print "<br/>
			<form action='search.php?user_id=$id' method='POST'>
				<input type='submit' name='friend' value='Add Friend'>
			</form>
		".$footer;
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