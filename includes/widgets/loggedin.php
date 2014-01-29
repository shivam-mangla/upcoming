<?php

// to check if any data has been received on this page
if (isset($_POST['Search']))
{
	// receive the text from query field
	$name = $_POST['query'];

	echo 'https://graph.facebook.com/search?q='.$name.'&type=event&center=29.8749,77.8899&distance=100&access_token=CAACEdEose0cBANObVZC5GZBigSgsUv2lPBx7HIUp65OmZBA6znd4sI0oYbf5N93VNkSBZCJ08SnnWmgliUi8gRXFAqqfZARAW3pvbWTNKfitZAWUbndSSxKZAFTtKSZAMxBeqOd25DlNDFKbnGukoTlr5xPw7c2M2F9SZCjC30HaYCZBypdrw28LASa5RHEFiv20MZD';
	// fetch content from the entered url
	$homepage = file_get_contents('https://graph.facebook.com/search?q='.$name.'&type=event&center=29.8749,77.8899&distance=100&access_token=CAACEdEose0cBAG8hbG9yHKlP7FXRjZA7Tr1b4NfhYFORuA1s2KqtCQFm3U9oZC8oINxRdkUjxggVtkFbN4F9twIjZBmxXXwRgIkACqjQzZAZAYeIvMAIt2qlWv44GkRlLJeKAhFWjU3mjtxj1WZCZAYmam0mGlsJeMc5TFV2ZBzjfpIs3bAFsFoCTnJIsQGQye4ZD');
	$ll = json_decode($homepage);
	print_r($ll);
}
else{
?>

<script type="text/javascript" src="search_autocomplete.js"></script>
<body onload="initialize();">

<div class="container">

	<div class="form-signin">
		<form  action="" method="POST" value="Search">
			<div id="locationField">
				<input id="autocomplete" type="text" class="input-block-level" name="query" placeholder="Place" onFocus="geolocate()" >
			</div>
			<button class="btn btn-large btn-primary" type="submit" name="Search">Search</button>
		</form>
	</div>

</div>

<?php
}
?>