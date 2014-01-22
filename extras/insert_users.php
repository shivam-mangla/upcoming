<?php
ini_set('max_execution_time', 0);

$host = "localhost";
$username = "username";
$pwd = "password";
$dbname = "test";

mysql_connect($host, $username, $pwd) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());


$gender = array('Male', 'Female');

for($i=1; $i<=200; $i++)
{

	$username = "user".$i;
	$password = md5("password".$i);
	$email = $i."@gmail.com";
	$sex = $gender[rand(0,1)];
	mysql_query("INSERT INTO `group_users`(`username`, `password`, `contact`, `sex`, `active`, `email`) VALUES
	('$username','$password','999','$sex',1,'$email')");
}


?>