<?php
require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(isset($_POST['notes']) ){

	$notes = $_POST['notes']; 
	$thisID = $_POST['interviewID'];
		var_dump($notes);
	//$sql = "UPDATE interviews SET notes =  'wtf'     WHERE interview_id = " . $thisID . ";";

	$sql = "UPDATE interviews SET notes =  " . $notes . "     WHERE interview_id = " . $thisID . ";";
	$results = $db_connection->query($sql);
}

 
?>