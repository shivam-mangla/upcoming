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
	<div id = "display-output"></div>

	
	<script type="text/javascript">
		// var object = JSON.parse(<?php echo $result;?>);

		
		var object = (<?=$result;?>);
		for (var i = 0; i < object.data.length; i++)
		{
	 	   	var counter = object.data[i];
	    	// console.log(counter.name);
	    	// frame.innerHTML('counter.name');
    	}
    	
    	var frame = document.getElementById('display-output');
    	for (var i = 0; i < object.data.length; i++)
    	{
    		var counter = object.data[i];
    		var div = document.createElement("div");
    		div.className = "event-details"
    		div.innerHTML = "Name:" +(counter.name) +"<br>Location:" + (counter.location) + "<br>Start time:" + (counter.start_time);
    		// div.innerHTML = div.innerHTML + (counter.location) +(counter.start_time);
    		// div.innerHTML = (counter.start_time);
    		// div.innerHTML = (counter.end_time);
    		// div.innerHTML = (counter.location);
    		frame.appendChild(div);
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
</div>

<?php
}
?>