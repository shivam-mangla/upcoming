<?php
include 'fb.php';

var_dump($_POST);

// to check if any data has been received on this page
if (isset($_POST['Search']))
{
	// receive the text from query field
	$name = $_POST['query'];
	?>
	<div id="results">
	<?
		$result = get_event_list($name);
		// echo $result;
	?>
	</div>
	<div id="output"></div>
	<script type="text/javascript">
		// var object = JSON.parse(<?php echo $result;?>);
		var frame = document.getElementById('results');
		var object = (<?=$result;?>);
		for (var i = 0; i < object.data.length; i++) {
	 	   	var counter = object.data[i];
	    	// console.log(counter.name);
	    	// frame.innerHTML('counter.name');
	    	for (var i = 0; i < object.data.length; i++)
	    	{
	    		var counter = object.data[i];
	    		$('body').append(counter.name+'<br>');
	    	}
    	}
	</script>
	<?
}

else{
?>

<script type="text/javascript" src="js/search_autocomplete.js"></script>
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
<div id = "results"></div>
</div>

<?php
}
?>