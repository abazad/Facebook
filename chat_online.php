<?php

session_start();

require("connect.php");

$user_id = $_SESSION["user_id"];

$query = mysql_query("SELECT * FROM users WHERE user_id!='$user_id'") OR die("no query");

$num_rows = mysql_num_rows($query);

print "
<table id='friends'>
	<tr>
		<td colspan='3' id='c_head'>
			<p id='c_head'>Chat
		</td>
	</tr>
	<tr id='settings'>
		<td>
			Friends List
		</td>
		<td>
			Options
		</td>
		<td>
		</td>
	</tr>";

if($num_rows > 0)
{
	while($row = mysql_fetch_object($query))
	{
		$id = $row->user_id;
		$fname = $row->fname;
		$lname = $row->lname;
		$query_pic = mysql_query("SELECT * FROM profile_pics WHERE user_id='$id'");
		if($query_pic)
		{
			$p_row = mysql_fetch_object($query_pic);
			$prof_pic = $p_row->file_name;
		}
		else
		{
			print "no query for pic";
		}
		print "<tr id='friends'>
				<td colspan='3' class='link' id='$id' onclick='setTimeout(\"chat_bar($id)\",1000);setTimeout(\"loadChat($id)\",2000);'>";
		print "		<img src='upload/$prof_pic' width='30px' height='30px' /> " . $fname . " " . $lname . "<img src='images/online.png' width='8px' height='8px' class='online' />";
		print "	</td>
			</tr>";
	}
}
else
{
		print "<tr>
				<td colspan='3' class='link'>
					No Friends Online
				</td>
			</tr>";
}
print "</table>";

?>