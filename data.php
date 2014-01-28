<?php
//will check whether the user is logged in or not

include 'core/init.php';
echo "init";

if (empty($_POST) === false){
	//=== checks for type as well 
	echo "coming";
	$name = $_POST['query'];
	echo 'https://graph.facebook.com/search?q='.$name.'&type=event&center=29.8749,77.8899&distance=100&access_token=CAACEdEose0cBANObVZC5GZBigSgsUv2lPBx7HIUp65OmZBA6znd4sI0oYbf5N93VNkSBZCJ08SnnWmgliUi8gRXFAqqfZARAW3pvbWTNKfitZAWUbndSSxKZAFTtKSZAMxBeqOd25DlNDFKbnGukoTlr5xPw7c2M2F9SZCjC30HaYCZBypdrw28LASa5RHEFiv20MZD';
	$homepage = file_get_contents('https://graph.facebook.com/search?q='.$name.'&type=event&center=29.8749,77.8899&distance=100&access_token=CAACEdEose0cBANObVZC5GZBigSgsUv2lPBx7HIUp65OmZBA6znd4sI0oYbf5N93VNkSBZCJ08SnnWmgliUi8gRXFAqqfZARAW3pvbWTNKfitZAWUbndSSxKZAFTtKSZAMxBeqOd25DlNDFKbnGukoTlr5xPw7c2M2F9SZCjC30HaYCZBypdrw28LASa5RHEFiv20MZD');
	$ll = json_decode($homepage);
print_r($ll);
	// echo $homepage;

// }else{
// 	echo 'landed';
// 	header('Location:index.php');
// 	exit();
}

// if(empty($errors) === false){
?>
<div class="container">

</div>
<?php
include 'includes/overall/overallheader.php';
include 'includes/overall/overallfooter.php';

?>