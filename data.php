<?php
include 'core/init.php';

// to check if any data has been received on this page
if (empty($_POST) === false){
	//=== checks for type as well

	// receive the text from query field
	$name = $_POST['query'];

	echo 'https://graph.facebook.com/search?q='.$name.'&type=event&center=29.8749,77.8899&distance=100&access_token=CAACEdEose0cBANObVZC5GZBigSgsUv2lPBx7HIUp65OmZBA6znd4sI0oYbf5N93VNkSBZCJ08SnnWmgliUi8gRXFAqqfZARAW3pvbWTNKfitZAWUbndSSxKZAFTtKSZAMxBeqOd25DlNDFKbnGukoTlr5xPw7c2M2F9SZCjC30HaYCZBypdrw28LASa5RHEFiv20MZD';
	// fetch content from the entered url
	$homepage = file_get_contents('https://graph.facebook.com/search?q='.$name.'&type=event&center=29.8749,77.8899&distance=100&access_token=CAAF5jYUwp3UBAKklyxcLG9JpUlLCe7j8w7W5VywqGYSBk7IAJpswqPWFsMGDFh1VwRqUIyY0ZA7PZBZCgJsZCN2269ZBvn6UQznFLcUtfwSBV0pbiiGQRlc87RDSEpeaEMxsWnClWjkXHfklK3Y5uMhsXtjTP39Re3kCIRbZBzZBMxiQjQuz7sfEy2zKIeAoQoZD');
	$ll = json_decode($homepage);
	print_r($ll);

}else{
	header('Location:index.php');
	exit();
}

// if(empty($errors) === false){
?>
<div class="container">

</div>
<?php
include 'includes/overall/overallheader.php';
include 'includes/overall/overallfooter.php';

?>