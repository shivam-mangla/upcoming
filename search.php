<?php

echo "Search working";


include 'core/init.php';
include 'includes/overall/overallheader.php';
?>
<div class="container">

<div class="form-signin">
  <form  action="data.php" method="POST" value="Search">
	<input type="text" class="input-block-level" name="query" placeholder="Place">
	<button class="btn btn-large btn-primary" type="submit">Search</button>
  </form>
</div>
</div>