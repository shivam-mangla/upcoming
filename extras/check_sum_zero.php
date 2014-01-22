<?php

ini_set('max_execution_time', 0);

$connect_error = 'Sorry, we\'re experienceing connection problems';
$host = "localhost";
$username = "username";
$pwd = "password";
$dbname = "test";

mysql_connect($host, $username, $pwd) or die($connect_error);
mysql_select_db($dbname) or die($connect_error);

$qu = mysql_query("SELECT SUM(balance) FROM group_users");
$row = mysql_fetch_array($qu);
$taken = $row['SUM(balance)'];
echo $taken;
?>