<?php

	require("connect.php");
	
	$id = $_GET["user_id"];
	
	$query = mysql_query("SELECT * FROM users WHERE user_id='$id'");
	
	$num_rows = mysql_num_rows($query);
	
	if($num_rows > 0)
	{
		$row = mysql_fetch_object($query);
		$fname = $row->fname;
		$lname = $row->lname;
		print $fname . " " . $lname . " <img src='images/online.png' width='8px' height='8px' />";
	}
	else
	{
		print "Error";
	}
?>