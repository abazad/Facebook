<html>
	<head>
		<link rel='stylesheet' type='text/css' href='main.css' />
	</head>
<?php
	session_start();
	
	require("connect.php");
	$header2 = require("header2.php");
	
	$user_id = $_SESSION["user_id"];
	$name = $_SESSION["fname"] . " " . $_SESSION["lname"];
	$query = mysql_query("SELECT * FROM profile_pics WHERE user_id='$user_id'") OR die("No Query!");
	$num_rows = mysql_num_rows($query);
	
	if($num_rows != 0) 
	{
		$row = mysql_fetch_object($query);
		$pic = $row->file_name;
	}
	else
		echo "Error, not logged in!";
		
	print $header2 . "
	<table border='0' width='100%' height='100%' align='center' class='test'>
		<tr>
			<td width='25%' height='100%' class='left'>
				<img src='images/dot.gif' width='2px' height='100%' border='' align='right' />
				<div>
					<img src='upload/$pic.jpeg' width='40px' height='40px' border='' align='left' style='margin-top: 5px'/>
					<a href='friend.php?user_id={$user_id}' class='title'>$name</a>
				</div>
				<div height='30px' class='lheadf'>FAVORITES</div>
				<div height='30px' class='lhead'>APPS</div>
				<div height='30px' class='lhead'>GROUPS</div>
			</td>
			<td width='50%' height='100%' class='center'>
				WALL
				(News)
			</td>
			<td width='25%' height='100% class='right'>
				Events
				(Links)
			</td>
		</tr>
	</table>";
?>
</html>