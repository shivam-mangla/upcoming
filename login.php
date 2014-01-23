<?php
//will check whether the user is logged in or not

include 'core/init.php';

if (empty($_POST) === false){
	//=== checks for type as well 

	$email = $_POST['email'];
	$password = $_POST['password'];

	//echo $username;

	if(empty($email)===true || empty($password) === true){
		$errors[] = 'Both fields have to be filled';
		//if any of them is empty $errors[] creates errors now
	}else if(user_exists($email) === false){

		$errors[] = 'This username doesn\'t exits. Have you registered';
	// }else if(user_active($email) === false){

	// 	$errors[] = 'You\'re not active. Whom are you trying to befool man?';
	}else{


		if(strlen($password) > 32) {
			$errors[] = "Password is too long";
		}
		
		$login = login($email, $password);

		if($login === false){
			$errors[] = 'That email/password combination is wrong';
		}else{

			//echo "OKAY";
			//set the user's session
			//redirect user to home
			$_SESSION['user_id'] = $login;	//because login returns the suer id
			header('Location: index.php');
			exit();
		}
		
	}
}else{
	echo 'landed';
	header('Location:index.php');
	exit();
}

if(empty($errors) === false){
	?>
<div class="container">
	<h2> We tried to log you in, but... </h2>
	<?php
	echo output_errors($errors);
}
?>
</div>
<?php
include 'includes/overall/overallheader.php';
include 'includes/overall/overallfooter.php';

?>