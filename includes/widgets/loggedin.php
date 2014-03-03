<link rel="stylesheet" type="text/css" href="css/events.css">
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
			$obj = json_decode($result, true); //parsing json in php
			function cmp($a, $b)
			{
				if ($a['start_time'] == $b['start_time'])
				{
					return 0;
				}
				return ($a['start_time'] < $b['start_time']) ? -1 : 1;
			}
			uasort($obj['data'], 'cmp');
			print_r($obj);
		?>
	</div>
	<button onclick="custom_sort()">Sort by date</button>
	<div class="section group">
		<div id = "display-output"></div>
	</div>
	
	<script type="text/javascript">
		var object = (<?=$result;?>);
    	var frame = document.getElementById('display-output');
    	for (var i = 0; i < object.data.length; i++)
    	{
    		var counter = object.data[i];
    		var div = document.createElement("div");
    		div.className = "event-details col span_1_of_3 "
    		div.innerHTML = "Name:" +(counter.name) +"<br><br>Location:" + (counter.location) + "<br><br>Start time:" + (counter.start_time);
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
<script src="js/masonry.pkgd.min.js"></script>
// <script>
// var container = document.querySelector('#container1');
// var msnry = new Masonry( container, {
//   // options...
//   itemSelector: '.item',
//   columnWidth: 200
// });
// </script>