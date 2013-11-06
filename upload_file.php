<?php
session_start();

//error_reporting(0);

error_reporting(E_ALL);
ini_set("display_errors", 1);


if($_SESSION["LOGGED_IN"]==1)
{
	$user_id = $_SESSION["user_id"];
	
	if (($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	{
		if($_FILES["file"]["size"] < 100000)
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
		 	 else
			{
				echo "Upload: " . $_FILES["file"]["name"] . "<br />";
				echo "Type: " . $_FILES["file"]["type"] . "<br />";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " KB<br />";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

				if (file_exists("/var/www/html/Feleti/Facebook/upload/" . $_FILES["file"]["name"]))
				{
				  echo $_FILES["file"]["name"] . " already exists. ";
				}
				else
				{
					$save = move_uploaded_file($_FILES["file"]["tmp_name"],
      					"/var/www/html/Feleti/Facebook/upload/" . $_FILES["file"]["name"]);
					echo "Stored in: " . "/var/www/html/Feleti/Facebook/upload/" . $_FILES["file"]["name"] . "<br/>";
				  
				  if($save > 0)
				  {
					require("connect.php");
					
					$query = mysql_query("SELECT * FROM profile_pics") OR die("could not query");
					
					$num_rows = mysql_num_rows($query);
					
					if($num_rows >= 0)
					{
						$pic_id = $num_rows + 1;
						$newname = "pic_" . $pic_id;
						$oldname = $_FILES["file"]["name"];
						$rename = rename("upload/$oldname", "upload/$newname.jpeg");
						
						if($rename)
						{
							$insert =  mysql_query("INSERT INTO profile_pics (user_id, file_name) VALUES ('$user_id', '$newname')") OR die("could not insert");
						}
						else
						{
							echo "FAIL";
						}
					}
					else
					{
						echo "No rows found!";
					}
				  }
				  else
				  {
					echo "error moving file";
				  }
				}
			}
		}
		else
		{
			echo "File size too large! File must be less then 100.0 KB.";
		}
	}
	else
	{
		echo "Invalid file";
	}
}
else
{
	echo ("You must be logged in!");
}
?> 