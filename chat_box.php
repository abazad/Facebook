<?php

session_start();

$connect = mysql_connect("127.0.0.1","root","m@scotD3FAULT") or die("life sucks");
mysql_select_db("feleti");

$id = $_SESSION["user_id"];
$user_id = $_GET["user_id"];

$query = mysql_query("SELECT * FROM chat WHERE user_id='$user_id' OR user_id='$id' ORDER BY id DESC");

$num_rows = mysql_num_rows($query);

if($num_rows > 0)
{
	$user_query = mysql_query("SELECT * FROM users WHERE user_id='$user_id'");
	
	$user_num_rows = mysql_num_rows($user_query);
	
	if($user_num_rows > 0)
	{
		$user_row = mysql_fetch_object($user_query);
		$fname = $user_row->fname;
		$lname = $user_row->lname;
		$friend_id = $user_row->user_id;
		
	}
	else
	{
		print "no query for user one" . $user_id;
	}

	print "<table id='friend_chat'>
			<tr>
				<td id='f_head'>
					<a href='Facebook/friend.php?user_id=$friend_id'>" . $fname . " " . $lname . "</a>
				</td>
			</tr>
			<tr>
				<td id='messages' height='30px'>";
					
	while($row = mysql_fetch_object($query))
	{
		$prof_pic = $row->pic;
		$message = $row->message;
		print "		<div class='messages' id='$user_id'>
						<img src='Facebook/upload/$prof_pic.jpeg' width='30px' height='30px' />" . $message . "
					</div>";
	}
	print "		</td>
			</tr>
			<tr>	
				<td id='form'>
					<form name='chatSubmit' onSubmit='return false;'>
						<textarea rows='1' cols='20' name='message' id='message'></textarea><input type='submit' value='Send' onClick='submitMessage($user_id);loadChat($user_id)' />
					</form>
				</td>
			</tr>
		</table>";
}
else
{
	$user_query = mysql_query("SELECT * FROM users WHERE user_id='$user_id'");
	
	$user_num_rows = mysql_num_rows($user_query);
	
	if($user_num_rows > 0)
	{
		$user_row = mysql_fetch_object($user_query);
		$fname = $user_row->fname;
		$lname = $user_row->lname;
		$query_pic = mysql_query("SELECT * FROM profile_pics WHERE user_id='$user_id'");
		if($query_pic)
		{
			$p_row = mysql_fetch_object($query_pic);
			$prof_pic = $p_row->file_name;
		}
		else
		{
			print "no query for pic " . $user_id;
		}
	}
	else
	{
		print "no query for user two" . $user_id;
	}

	print "<table id='friend_chat'>
			<tr>
				<td id='f_head'>
					<a href='friend.php?id=\"$id\"'>" . $fname . " " . $lname . "</a>
				</td>
			</tr>
			<tr>
				<td id='messages' style='overflow:auto;height:30px;'>
				</td>
			</tr>
			<tr>	
				<td id='form'>
					<form name='chatSubmit' onSubmit='return false;'>
						<textarea rows='1' cols='20' name='message' id='message'></textarea><input type='submit' value='Send' onClick='submitMessage();' />
					</form>
				</td>
			</tr>
		</table>";
}

if(isset($_GET["message"]))
{
	$got_message = $_GET["message"];
	
	$user_row = mysql_fetch_object($user_query);
	$fname = $user_row->fname;
	$lname = $user_row->lname;
	$query_pic = mysql_query("SELECT * FROM profile_pics WHERE user_id='$id'");
	if($query_pic)
	{
		$p_row = mysql_fetch_object($query_pic);
		$prof_pic = $p_row->file_name;
	}
	else
	{
		print "no query for pic " . $id;
	}
		
	mysql_query("INSERT INTO chat (user_id,pic,message) VALUES ('" . mysql_real_escape_string($id) . "' , '" . mysql_real_escape_string($prof_pic) . "' , '" . mysql_real_escape_string($got_message) . "') ");
}

?>