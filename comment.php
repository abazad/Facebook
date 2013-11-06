<?php
	session_start();
	
	error_reporting(0);
	
	$header = require("header.php");
	$header2 = require("header2.php");
	$header3 = require("header3.php");
	$footer = require("footer.php");
	$footer2 = require("footer2.php");
	
if($_SESSION['LOGGED_IN']==1)
{
	$fname = $_SESSION['fname'];
	
	if(isset($_POST['message']))
	{
		$connect = mysql_connect('127.0.0.1', 'root', 'm@scotD3FAULT');
		
		if($connect)
		{
			$select = mysql_select_db('feleti');
			
			$date = date("m/d/Y");
			
			$query = mysql_query("INSERT INTO comment (message,user_fname,date) VALUE('" . mysql_real_escape_string($_POST['message']) . "', '" . mysql_real_escape_string($_SESSION['fname']) . "', '" . mysql_real_escape_string($date) . "')");
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
<?php echo($header2); ?>
<html>
	Please leave comment!
	<form action='' method='POST'>
		<textarea name='message' rows='10' columns='50'></textarea>
		<input type='submit' value='Submit'>
	</form>
<?php
	$connect = require("connect.php");
	
	if($connect)
	{
		$select = mysql_select_db('feleti');
	
		$query = mysql_query("SELECT * FROM comment WHERE pic_id='0' ORDER BY id DESC");
		
		if($query)
		{
			while($row = mysql_fetch_object($query))
			{
				echo ("<div>
				<hr align='left' width='30%'>");
				print $row->user_fname;
				echo("<br>");
				print $row->message;
				echo("<br>");
				print $row->date;
				echo("
				</div>
				");
			}
			echo($footer);
		}
		else
		{
			echo("
			Couldn't print comments!
			".$footer);
		}
	}
	else
	{
		echo("
		Couldn't connect
		".$footer);
	}
}
else
{
	echo(
	$header."
	You must be logged in to view this page!
	".$footer2);
}
?>
</html>