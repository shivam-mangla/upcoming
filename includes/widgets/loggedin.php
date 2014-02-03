<?php
include 'fb.php';
// to check if any data has been received on this page
if (isset($_POST['Search']))
{
	// receive the text from query field
	$name = $_POST['query'];
		if (isset($_GET['accessToken'])){
		$token = $_GET['accessToken'];

		$url = 'https://graph.facebook.com/search?q='.$name.'&type=event&distance=100&access_token='.$token.'';
		echo "Hi".$token."<br>";
		};
	echo $url;
	$url = preg_replace("/ /", "%20", $url);
	// fetch content from the entered url
	// $homepage = file_get_contents($url);
	// $ll = json_decode($homepage);
	// print_r($ll);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
}
else{
?>

<script type="text/javascript" src="search_autocomplete.js"></script>
<body onload="initialize();">

<div class="container">

	<div class="form-signin">
		<form  action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST" value="Search">
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