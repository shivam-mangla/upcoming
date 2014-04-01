<?php 
	error_reporting(-1);
	include 'connect.php';
	include 'model/user_db.php';
	// logged_in_redirect();

	if(empty($_POST) === false)
	{
		
		$fields = array('username','password','password_again','email');
		
		foreach($_POST as $key=>$value)
		{
			if(empty($value) && in_array($key, $fields) === true){	//value of each field in the form
				$errors[] = 'Fields marked with an asterisk are required';
				break 1;
			}
		}

		echo "check error now";

		if(empty($errors) === true)
		{
			// if(user_exists($_POST['username'])){
			// 	$errors[] = "Sorry, the username '" . htmlentities($_POST['username']) . "' is already in use.";
			// }
			if(preg_match("/\\s/", $_POST['username']) == true)
			{
				$regular_exp = preg_match("/\\s/", $_POST['username']);
				var_dump($regular_exp);
				$errors[]="Username must not contain any spaces";
			}

			if(strlen($_POST['password']) < 6)
			{
				$errors[] = "Your password must be at least 6 characters.";
			}
			
			if($_POST['password'] !== $_POST['password_again'])
			{
				$errors[] = "Your passwords don't match";
			}
			
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === FALSE)
			{
				$errors[] = 'Please enter a valid email address';
			}

			// if(email_exists($_POST['email']) === true){
			// $errors[] = "Sorry, the email '" . htmlentities($_POST['email']) . "' is already in use.";
			// }
		}

		echo "There is no error";
	}

	if(isset($_GET['success']) && empty($_GET['success']))
	{
		echo "You've been registered successfully.";
		?>
		</br>
		</br>
		Click here to <a href="index.php" style="color:white;">Home</a></button>
		<?php
	}
	else
	{
		//This else goes till end
		echo "got the info".empty($_POST).empty($errors);
		if(empty($_POST) === false && empty($errors) === true){
			echo "POSTED";
			$register_data = array(
				'username' 		=> 	$_POST['username'],
				'password' 		=> 	$_POST['password'],
				'contact' 		=> 	$_POST['contact'],
				'email' 		=> 	$_POST['email']
			);

			echo "should register now";
			print_r($register_data);
			register_user($register_data);
			//redirect properly
			echo "registeredddd";
			//~ header('Location: register.php?success');
			//~ exit();
		}else if(empty($errors) === false){
			echo output_errors($errors);
		}
?>
	  <body>
		<div class="container">
		  <form class="form-signin" action="" method="POST">
				User name*: <input type="text" name="username"><br/>
				Password: <input type="password" name="password"><br/>
				Re-enter Password: <input type="password" name="password_again"><br/>
				Contact: <input type="text" name="contact"><br/>
				Email: <input type="text" name="email"><br/>
				<input type="submit" name="submit" value="Submit">
		  </form>
	  </body>
<?php 
	}
?>
