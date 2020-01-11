<?php
	$hostname="localhost";
	$dbname="recipe";
	$username="root";
	$password="";
	mysql_connect($hostname,$username,$password) or die("server not found");
	mysql_select_db($dbname) or die("database not found");
?>