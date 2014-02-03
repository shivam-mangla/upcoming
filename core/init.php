<?php

ob_start();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//as we don't want to show any detailed reports to user
require 'database/connect.php';
require 'config.php';
?>


<!-- Initializing the SDK -->
<!-- <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{your-app-id}',
          status     : true,
          xfbml      : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
 -->

<?
// //'require' means anything below this can use this connection

require 'functions/general.php';
require 'functions/users.php';

// require 'functions/expense_manager.php';

// if(logged_in() === true){
// 	$session_user_id = $_SESSION['user_id'];

// 	//echo $session_user_id;

// 	// $user_data = user_data($session_user_id);	

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