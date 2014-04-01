<?php

	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}else{
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			$should_update = true;
			if (file_exists("uploads/" . $_FILES["file"]["name"]))
			{
				echo $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"uploads/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
			}
		}
	} else {
	echo "Invalid file";
	}
?>


<?php
	
	/* To save text data */
	if($should_update === true)
	{
		require('connect.php');

		if(empty($_POST) === false){
			
			$fields = array('name');
			
			foreach($_POST as $key=>$value){
				if(empty($value) && in_array($key, $fields) === true){	//value of each field in the form
					$errors[] = 'Fields marked with an asterisk are required';
					break 1;
				}

			}

			echo "got the info";//.empty($_POST).empty($errors);
			if(empty($_POST) === false && empty($errors) === true){
				echo "POSTED";
				$register_data = array(
					'name' 				=> 	$_POST['name'],
					'description' 		=> 	$_POST['description'],
					'link' 				=> 	$_POST['link'],
					'image'				=> 	$_FILES["file"]["name"] 
				);

				echo "should register now";
				
				$fields = "" . implode (", ", array_keys($register_data)) . "";
				$data = "'" . implode ("', '", $register_data) . "'";
				
				$query = "INSERT INTO events ($fields) VALUES ($data)";
				$result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
				echo $result;
				echo "Event registered successfully";
			}
			else if(empty($errors) === false){
				echo var_dump($errors);
			}
		}else {
			echo "Nothing has been posted";
		}
	}

?>
