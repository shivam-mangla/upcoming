<?php 

// error_reporting(-1);

include 'core/init.php';
include 'includes/overall/overallheader.php';
// logged_in_redirect();
?>
<div class="container">
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
	$preferences = array(
		'sdate' 		=> 	$_POST['sdate'],
		'edate' 		=> 	$_POST['edate'],
		'stime' 		=> 	$_POST['stime'],
		'etime' 		=> 	$_POST['etime'],
		'time_span' 	=> 	$_POST['time_span']
	);

	echo "should register now";
	print_r($preferences);
	suggest_time($preferences);
	// register_user($register_data);
	//redirect properly

	echo "registeredddd";

	//header('Location: suggest_time.php?success');
	exit();
}else if(empty($errors) === false){
	echo output_errors($errors);
}
?>
  <body>

    <div class="container">

      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Get suggestion for events' timing</h2>

        Starting Date:
        <input type="date" class="input-block-level" name="sdate" placeholder="Starting Date">
        Ending Date:
        <input type="date" class="input-block-level" name="edate" placeholder="Ending Date">
        Starting Time:
        <input type="time" class="input-block-level" name="stime" placeholder="Starting Time">
        Ending Time:
        <input type="time" class="input-block-level" name="etime" placeholder="Ending Time">
        Event Time:
        <input type="time" class="input-block-level" name="time_span" placeholder="Time Span">
        <button class="btn btn-large btn-primary" type="submit" value="suggest">Suggest best time</button>
      </form>
    <script src="js/jquery.js"></script>

  </body>
<?php 
}
include 'includes/overall/overallfooter.php';
?>