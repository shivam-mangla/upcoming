<html>
	<body>

		<form action="upload_event_on_db.php" method="post" enctype="multipart/form-data">
			Event name*: <input type="text" name="name"><br/>
			Description: <input type="text" name="description"><br/>
			Link: <input type="text" name="link"><br/>
			Image: <input type="file" name="file" id="file"><br/>
			<input type="submit" name="submit" value="Submit">
		</form>

	</body>
</html>
