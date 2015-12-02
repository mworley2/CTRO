<?php
require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(isset($_POST['difference'])){
	$timeTaken = $_POST['difference'];
	$thisID = $_POST['interviewID'];
}

//TODO- convert timeTaken from miliseconds to minutes before inserting into db
$sql = "UPDATE interviews SET timeTaken =  " . $timeTaken . "     WHERE interview_id = " . $thisID . ";";
$results = $db_connection->query($sql);

?>

