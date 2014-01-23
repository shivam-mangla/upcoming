<?php

ob_start();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//as we don't want to show any detailed reports to user
require 'database/connect.php';


// //'require' means anything below this can use this connection

require 'functions/general.php';
require 'functions/users.php';

// require 'functions/expense_manager.php';

// if(logged_in() === true){
// 	$session_user_id = $_SESSION['user_id'];

// 	//echo $session_user_id;

// 	$user_data = user_data($session_user_id);	

// 	/*
// 	if(user_active($user_data['username']) === false){
// 		session_destroy();
// 		header('Location: index.php');
// 		exit();
// 	}
// 	*/
// }

// $errors = array();
//this is a method we've created to check our errors
//kind of java stack error output thing I guess
?>