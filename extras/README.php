<?php
ini_set('max_execution_time', 0);

$host = "localhost";
$username = "username";
$pwd = "password";
$dbname = "test";

mysql_connect($host, $username, $pwd) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

for($i=1; $i<=200; $i++)
{
	for($j=1; $j<=200; $j++)
	{	
		$am = rand(0, 100000);
		mysql_query("INSERT INTO group_expenses (`from`, `to`, `amount`) VALUES ('user$i', 'user$j', $am)");
	}
}
?>