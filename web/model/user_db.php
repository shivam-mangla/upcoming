<?php

	function register_user($register_data){
		$register_data['password'] = md5($register_data['password']);
		//print_r($register_data);

		$fields = "" . implode (", ", array_keys($register_data)) . "";
		$data = "'" . implode ("', '", $register_data) . "'";

		echo "<br/><br/>INSERT INTO users ($fields) VALUES ($data)";
		//die();

		mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	}

	function email_exists($email){
		$email = sanitize($email);
		$query = "SELECT COUNT(user_id) FROM  `users` WHERE  email = '$email'";
		$result = mysql_query($query);
		return (mysql_result($result, 0) == 1) ? true : false;
	}

	function user_exists($username){
		$query = "SELECT COUNT(user_id) FROM  `users` WHERE  username = '$username'";
		$result = mysql_query($query);
		return (mysql_result($result, 0) == 1) ? true : false;
	}
	
	
	function login($username, $password){
		// $user_id = user_id_from_username($username);
		
		//echo "userId=". $user_id;
		$password = md5($password);

		$query = "SELECT `user_id` FROM  `users` WHERE  username = '$username' AND password = '$password'";
		$result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
		return mysql_result($result, 0, 'user_id');
	}
?>
