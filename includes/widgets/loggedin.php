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
	<button type="submit" name="sortby-date" id="sortby-date" >Sort by date</button>
		<?
			$result = get_event_list($name);
			// echo $result;
			$obj = json_decode($result, true); //parsing json in php
			// print_r($obj);
			//user defined function for sorting data as per the dates
			function compare($a, $b)
			{
				if ($a['start_time'] == $b['start_time'])
				{
					return 0;
				}
				return ($a['start_time'] < $b['start_time']) ? -1 : 1;
			}

			//Sort the events date-wise
			uasort($obj['data'], 'compare');
			// print_r($obj);
			$temp = array();
			foreach($obj['data'] as $item)
			{
				print_r($item);
				echo "<br>";
			}
			$tempArray = array_merge($obj);	//Changing the indices of the array back to 0,1,2...
			// print_r($tempArray);
			for ($i=0; $i < count($obj['data']) ; $i++) 
			{ 
				// echo "<div class='event-details col span_1_of_3'>Name:".$tempArray['data'][$i]['name']."<br>Location:".$tempArray['data'][$i]['location']."<br>Start time:".$tempArray['data'][$i]['start_time']."<br><br></div>";
			}
		?>
	</div>
	
	<div class="section group">
		<div id = "display-output"></div>
	</div>
	
	<script type="text/javascript">
		var object = (<?=$result;?>);
		var frame = document.getElementById('display-output');
		var objectSort = document.getElementById("sortby-date");
		var simpleSearch = document.getElementById("search");
		objectSort.addEventListener("click", 
			var object = (<?=$obj;?>);
			// show_events();
			for (var i = 0; i < object.data.length; i++)
			{
				// var counter = object.data[i];
				// var div = document.createElement("div");
				// div.className = "event-details col span_1_of_3 "
				// div.innerHTML = "Name:" +(counter.name) +"<br><br>Location:" + (counter.location) + "<br><br>Start time:" + (counter.start_time);
				// frame.appendChild(div);
			}
		);

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
			<button class="btn btn-large btn-primary" type="submit" name="Search" id="search">Search</button>
		</form>
	</div>
</div>

		<a href="">Create Events</a><br>
		<a href="">My Events</a><br/>
		<a href="">Wishlist</a><br>

<?php
}
?>