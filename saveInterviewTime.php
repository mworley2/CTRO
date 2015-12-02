<?php
require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(isset($_POST['difference'])){
	$timeTaken = $_POST['difference']/1000;
	$thisID = $_POST['interviewID'];
}

//TODO- convert timeTaken from miliseconds to minutes before inserting into db
$sql = "UPDATE interviews SET timeTaken =  " . $timeTaken . "     WHERE interview_id = " . $thisID . ";";
$results = $db_connection->query($sql);

//get case id used in this interview
$sql = "SELECT cases.case_id, cases.avg_time, cases.times_taken FROM uses, cases WHERE uses.interview_id = " . $thisID . " AND cases.case_id = uses.case_id ;";
$results = $db_connection->query($sql);

$row = mysqli_fetch_array($results);
$case_id = $row["case_id"];
$avg_time = $row["avg_time"];
$num_times_taken = $row["times_taken"];

//update the case's average time
if($num_times_taken !=0){

	$new_avg_time = ($avg_time + $timeTaken)/$num_times_taken ;
	$sql = "UPDATE cases SET avg_time = ". $new_avg_time ."   WHERE case_id =  ". $case_id.";";

	$results = $db_connection->query($sql);
}
?>

