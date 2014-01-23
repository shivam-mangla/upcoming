<?php 

// error_reporting(-1);

include 'core/init.php';
include 'includes/overall/overallheader.php';
// logged_in_redirect();
?>
<div class="container">
<?php
if(empty($_POST) === false){
	
	// echo "YES, POSTED";
	//print_r($_POST);
	$fields = array('username','password','password_again','email');
	//echo '<pre>'. print_r($_POST, true) . '</pre>';
	
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $fields) === true){	//value of each field in the form
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}

	}

	echo "check error now";

	if(empty($errors) === true){
		// if(user_exists($_POST['username'])){
		// 	$errors[] = "Sorry, the username '" . htmlentities($_POST['username']) . "' is already in use.";
		// }
		if(preg_match("/\\s/", $_POST['username']) == true){
			$regular_exp = preg_match("/\\s/", $_POST['username']);
			var_dump($regular_exp);
			$errors[]="Username must not contain any spaces";
		}

		if(strlen($_POST['password']) < 6){
			$errors[] = "Your password must be at least 6 characters.";
		}
		if($_POST['password'] !== $_POST['password_again']){
			$errors[] = "Your passwords don't match";
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === FALSE){
			$errors[] = 'Please enter a valid email address';
		}

		// if(email_exists($_POST['email']) === true){
		// $errors[] = "Sorry, the email '" . htmlentities($_POST['email']) . "' is already in use.";
		// }
	}

	echo "There is no error";
}

//print_r($errors);
?>

<?php

if(isset($_GET['success']) && empty($_GET['success'])){
	echo "You've been registered successfully.";
	?>
	</br>
	</br>
	Click here to 
	<button class="btn btn-large btn-primary" ><a href="index.php" style="color:white;">Log In</a></button>
	<?php
}

else{ //This else goes till end
//echo "FINALLY POSTED";

echo "got the info".empty($_POST).empty($errors);
if(empty($_POST) === false && empty($errors) === true){
echo "POSTED";
	$register_data = array(
		'username' 		=> 	$_POST['username'],
		'password' 		=> 	$_POST['password'],
		'contact' 		=> 	$_POST['contact'],
		'sex' 			=> 	$_POST['sex'],
		'email' 		=> 	$_POST['email']
	);

	echo "should register now";
	print_r($register_data);
	register_user($register_data);
	//redirect properly

	echo "registeredddd";

	header('Location: register.php?success');
	exit();
}else if(empty($errors) === false){
	echo output_errors($errors);
}
?>
  <body>

    <div class="container">

      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Welcome to GEM</h2>
        <input type="text" class="input-block-level" name="username" placeholder="User Name*">
        <input type="password" class="input-block-level" name="password" placeholder="Password*">
        <input type="password" class="input-block-level" name="password_again" placeholder="Re-type Password*">
        <input type="text" class="input-block-level" name="contact" placeholder="Contact">
		
		<input type="hidden" name="sex" value="" id="btn-input" />
		<div class="btn-group" data-toggle="buttons-radio">  
		  <button id="btn-one" type="button" data-toggle="button" name="sex" value="Male" class="btn btn-primary">Male</button>
		  <button id="btn-two" type="button" data-toggle="button" name="sex" value="Female" class="btn btn-primary">Female</button>
		</div>

		<script>
		  var btns = ['btn-one', 'btn-two'];
		  var input = document.getElementById('btn-input');
		  for(var i = 0; i < btns.length; i++) {
			document.getElementById(btns[i]).addEventListener('click', function() {
			  input.value = this.value;
			});
		  }
		</script>
		
        <input type="text" class="input-block-level" name="email" style="margin-top:20px;" placeholder="Email*">
		
        <button class="btn btn-large btn-primary" type="submit" value="Register">Register</button>
      </form>
    <script src="js/jquery.js"></script>

  </body>
<?php 
}
include 'includes/overall/overallfooter.php';
?>