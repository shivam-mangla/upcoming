<?php

function change_password($user_id, $password){
	$user_id = (int) $user_id;
	$password = md5 ($password);
	//echo "UPDATE users SET password = '". $password . "' WHERE user_id = ". $user_id;
	mysql_query("UPDATE group_users SET password = '". $password . "' WHERE user_id = ". $user_id);
}

function user_data($user_id){
	//echo $user_id;
	$query = "SELECT * FROM group_users WHERE user_id = $user_id";
	//echo "<br>".$query."</br>";
	$result = mysql_query($query) or die();
	if($result){
	while ($row = mysql_fetch_assoc($result)) {
			$user_data = $row;
			//print_r($user_data);
		}
	}
	return	$user_data;	
}

function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	//print_r($register_data);

	$fields = "" . implode (", ", array_keys($register_data)) . "";
	$data = "'" . implode ("', '", $register_data) . "'";

	//echo "INSERT INTO users ($fields) VALUES ($data)";
	//die();

	mysql_query("INSERT INTO group_users ($fields) VALUES ($data)");
}


function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false ;
}

function email_exists($email){
	$email = sanitize($email);
	$query = "SELECT COUNT(user_id) FROM  `group_users` WHERE  email = '$email'";
    $result = mysql_query($query);
    return (mysql_result($result, 0) == 1) ? true : false;
	//return true is showing the result.. there's something wrong with this query
}

function user_exists($username){
	$username = sanitize($username);
	$query = "SELECT COUNT(user_id) FROM  `group_users` WHERE  username = '$username'";
    $result = mysql_query($query);
    return (mysql_result($result, 0) == 1) ? true : false;
	//return true is showing the result.. there's something wrong with this query
}

function user_active($username){
	$username = sanitize($username);
	
	//make 'active' = 1 after email confirmation
	
	$query = "SELECT COUNT(user_id) FROM  `group_users` WHERE  username = '$username' AND 'active' = 0";
    $result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
    return (mysql_result($result, 0) == 1) ? true : false;
}

function user_id_from_username($username){
	$username = sanitize($username);
	$query = "SELECT user_id FROM  group_users WHERE  username = '$username'";
	
	
    $result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
    
	//print_r($result);
	//$row = mysql_fetch_array($result);
	
	//echo $row['user_id'];
	
	return mysql_result($result, 0, 'user_id');
}

function login($username, $password){
	$user_id = user_id_from_username($username);
	
	//echo "userId=". $user_id;

	$username = sanitize($username);
	$password = md5($password);

	$query = "SELECT COUNT(user_id) FROM  `group_users` WHERE  username = '$username' AND password = '$password'";
    $result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
    
	//$row = mysql_fetch_array($result);
	//print_r($row);
    
	return (mysql_result($result, 0) == 1) ? $user_id : false;
}
?>