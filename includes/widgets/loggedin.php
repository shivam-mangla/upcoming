<?php
include 'fb.php';

var_dump($_POST);

// to check if any data has been received on this page
if (isset($_POST['Search']))
{
	// receive the text from query field
	$name = $_POST['query'];
		$url="werwe";
	 $token = $a_token;
	 echo "using loggedin.php".$token;
			// if (isset($_POST['accessToken'])){
		// $token = $_POST['accessToken'];

		$url = 'https://graph.facebook.com/search?q='.$name.'&type=event&distance=100&access_token='.$token.'';
		echo "<br>Hi".$token."<br>";
		// };
	// echo $url;
	$url = preg_replace("/ /", "%20", $url);
	// fetch content from the entered url
	// $homepage = file_get_contents($url);
	// $ll = json_decode($homepage);
	// print_r($ll);
	?>
	<div id="results">
	<?
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$result = curl_exec($ch);
	// echo "<br><br><br>Result is<br>".$result;
	curl_close($ch);
	?>
	</div>
	<div id="output"></div>
	<script type="text/javascript">
		// var object = JSON.parse(<?php echo $result;?>);
		var object = (<?=$result;?>);
		for (var i = 0; i < object.data.length; i++) {
 	   	var counter = object.data[i];
    	//console.log(counter.counter_name);
    	
    	// document
}
	</script>
	<?
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