<?php 
include 'connect.php';


$query = "SELECT * FROM  `events`";
$result = mysql_query($query) or die($query."<br/><br/>".mysql_error());

$rows = array();
while($r = mysql_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
    
?>
