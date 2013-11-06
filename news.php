<?php
session_start();
return "<div class='news1'><div class='news2'>Welcome ".$_SESSION['fname']."</div><div class='news3'>This is where the news goes!</div></div>";
?>