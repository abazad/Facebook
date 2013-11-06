<?php


session_start();

?>

<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
  				$(".comment").click(function(){
    					$(".form").slideToggle("slow");
					$(".comment").hide();
  				});
			});
		</script>
		<style type="text/css">
			div.form
			{
				display:none;
			}
		</style>
	</head>
<center>
<?php

//Required Variables
$news = require("news.php"); //news
$header = require("header.php"); //not logged in
$header2 = require("header2.php"); //logged in
$header3 = require("header3.php"); //admin header
$footer = require("footer.php"); //logout
$footer2 = require("footer2.php"); //login

if($_SESSION["LOGGED_IN"]==1)
{
	$user_id = $_SESSION["user_id"];
	
	$connect = require("connect.php");

	//select picture name from database
	$query = mysql_query("SELECT * FROM profile_pics WHERE user_id='$user_id'") OR die("COULD NOT QUERY!");
	
	$num_rows = mysql_num_rows($query);

	//view pic
	if($num_rows > 0)
	{
		$row = mysql_fetch_object($query);
		$pic = $row->file_name;
		$pic_id = $row->id;
		echo ($header2."<br /><img src='upload/$pic.jpeg' width='720px' height='535px' />
		<br />
		");
	}
	else
	{
		echo("No picture found!");
	}
	//check if comment has been made
	if(isset($_POST['message']))
	{
		if($connect)
		{
			$select = mysql_select_db('feleti');
			
			$date = date("m/d/Y");
			
			//insert comment into database
			$query = mysql_query("INSERT INTO comment (message,user_id,pic_id,user_fname,date) VALUE('" . mysql_real_escape_string($_POST['message']) . "', '" . mysql_real_escape_string($user_id) . "', '" . mysql_real_escape_string($pic_id) . "', '" . mysql_real_escape_string($_SESSION['fname']) . "', '" . mysql_real_escape_string($date) . "')");
		}
		else
		{
			echo(
			$header2."
			Sorry could not query!
			".$footer);
		}
	}
?>
		<center>
			<div class="form">
				<form action="" method="post">
					<textarea name='message' rows='10' columns='50'></textarea><br />
					<input type='submit' value='Submit'>
				</form>
			</div>
			<div class="comment" align="center">
				Comment Here
			</div>
		</center>
<?php
	$connect = mysql_connect('127.0.0.1', 'root', 'm@scotD3FAULT');
	
	if($connect)
	{
		$select = mysql_select_db('feleti');
	
		$query = mysql_query("SELECT * FROM comment WHERE pic_id='$pic_id' ORDER BY id DESC");
		
		if($query)
		{
			while($row = mysql_fetch_object($query))
			{
				$id = $row->user_id;
				$query_pic = mysql_query("SELECT * FROM profile_pics WHERE user_id='$id'");
				if($query_pic)
				{
					$p_row = mysql_fetch_object($query_pic);
					$prof_pic = $p_row->file_name;
				}
				echo("<table border='0' width='450px'>");
				echo ("
					<tr>
						<td width='40px' style='background-color:#E8E8E8'>
							<img src='upload/$prof_pic.jpeg' width='40px' height='40px' />
						</td>
						<td width='460px' style='background-color:#E8E8E8'>");
							echo("<a href='friend.php?user_id={$id}'>");
							print $row->user_fname;
							echo("</a> ");
							print $row->message;
							echo("<br />");
							print $row->date;
				echo("		</td>
					</tr>
					</table>");
			}
						
			echo("</center>".$footer);
		}
		else
		{
			echo(
			$header2."
			Couldn't print comments!
			</center>
			".$footer);
		}
	}
	else
	{
		echo(
		$header2."
		Couldn't connect
		</center>
		".$footer);
	}

}
else
{
	echo("</center>You must be logged in!");
}
?>
</html>