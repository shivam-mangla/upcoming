<?php

$connect_error = 'Sorry, we\'re experienceing connection problems';
$host = "localhost";
$username = "username";
$pwd = "password";
$dbname = "test";
mysql_connect($host, $username, $pwd) or die($connect_error);
mysql_select_db($dbname) or die($connect_error);

$arr = array('A', 'B', 'C', 'D', 'E', 'F');
//print_r($arr);

$r = rand(0,5);
$ctr = 0;
for($i=0; $i<10000; $i++)
{
	$from = $arr[rand(0,5)];
	$to = $arr[rand(0,5)];
	$am = rand(50, 50000);
	if($from != $to)
	{
		$ctr++;
		mysql_query("INSERT INTO group_expense_manager (`from`, `to`, `amount`) VALUES ('$from', '$to', $am)");
	}
}
echo $ctr;
?>