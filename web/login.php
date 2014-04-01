<?php
	//will check whether the user is logged in or not
	include 'connect.php';
	include 'model/user_db.php';
	error_reporting(0);
	
	$result = Array();

	if (empty($_POST) === false)
	{
		//=== checks for type as well 

		$username = $_POST['username'];
		$password = $_POST['password'];

		//echo $username;

		if(empty($username)===true || empty($password) === true)
		{
			$errors[] = 'Both fields have to be filled';
			//if any of them is empty $errors[] creates errors now
		}
		
		else if(user_exists($username) === false)
		{
			$errors[] = 'This username doesn\'t exist. Have you registered?';
		}
		
		else
		{
			if(strlen($password) > 32) {
				$errors[] = "Password is too long";
			}
			
			$login = login($username, $password);

			if($login === false){
				$errors[] = 'That username/password combination is wrong';
			}else{
				
				$result["status"] = $login;
				$result["message"] = "Login successful";
				$result["error"] = "";
				//~ header('Location: index.php');
				//~ exit();
			}
		}
		
		if(empty($errors) === false)
		{
			$result["status"] = -1;
			$result["message"] = "Login unsuccessful";
			$result["error"] = $errors;
		}
	}
	else
	{
		$result["status"] = $login;
		$result["message"] = "No data received";
		$result["error"] = "";
	}
	
	echo json_encode($result);
?>
