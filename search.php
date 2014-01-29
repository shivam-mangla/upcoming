<?php

echo "Search working";


include 'core/init.php';
include 'includes/overall/overallheader.php';
?>

<script type="text/javascript" src="search_autocomplete.js"></script>
<body onload="initialize();">
<div class="container">

<div class="form-signin">
  <form  action="data.php" method="POST" value="Search">
  <div id="locationField">
	<input id="autocomplete" type="text" class="input-block-level" name="query" placeholder="Place" onFocus="geolocate()" >
	</div>
	<button class="btn btn-large btn-primary" type="submit">Search</button>
  </form>
</div>
</div>
</body>