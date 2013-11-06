<?php

error_reporting(0);

$header = require("header.php");

$connect = mysql_connect("127.0.0.1","root","m@scotD3FAULT") or die(
$header."
Connection Failed!");
mysql_select_db("feleti") or die(
require("header.php")."".
mysql_error());

?>

</html>