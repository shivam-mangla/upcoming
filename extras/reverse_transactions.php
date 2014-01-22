<?php

ini_set('max_execution_time', 0);

$connect_error = 'Sorry, we\'re experienceing connection problems';
$host = "localhost";
$username = "username";
$pwd = "password";
$dbname = "test";

mysql_connect($host, $username, $pwd) or die($connect_error);
mysql_select_db($dbname) or die($connect_error);

$result = mysql_query("SELECT * FROM `group_expenses`");
	
while($row = mysql_fetch_array($result))
{
	$to = $row['from'];
	$from = $row['to'];
	$am = - ($row['amount']);
	//echo "</br>".$am;
	mysql_query("INSERT INTO `group_expenses` (`from`, `to`, `amount`) VALUES ('$from', '$to', $am)");
}

?>