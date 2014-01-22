<?php

ini_set('max_execution_time', 0);

$connect_error = 'Sorry, we\'re experienceing connection problems';
$host = "localhost";
$username = "username";
$pwd = "password";
$dbname = "test";

mysql_connect($host, $username, $pwd) or die($connect_error);
mysql_select_db($dbname) or die($connect_error);

$result = mysql_query("SELECT * FROM `group_users`");
	
while($row = mysql_fetch_array($result))
{
	$username = $row['username'];
	
	$qu = mysql_query("SELECT SUM(amount) FROM `group_expenses` WHERE `from` = '$username'");
	//echo "</br>"."SELECT SUM(amount) FROM group_expenses WHERE `from` = '$username'";
	$row = mysql_fetch_array($qu);
	$taken = $row['SUM(amount)'];
	//echo "</br> taken = $taken";


	$qu = mysql_query("SELECT SUM(amount) FROM `group_expenses` WHERE `to` = '$username'");
	$row = mysql_fetch_array($qu);
	$given = $row['SUM(amount)'];
	//echo "</br> given = $given";

	//echo "</br>net balance = ". ($given - $taken);
	$bal = $given - $taken;
	
	mysql_query("UPDATE `group_users` SET `balance` = $bal WHERE `username` = '$username'");
}

?>