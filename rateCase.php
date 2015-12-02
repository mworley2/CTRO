<?php
require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$case_rating = $_POST['case_rating'];
$interviewID = $_POST['interviewID'];
$caseID = $_POST['caseID'];


//initially avg_rating and times_rated will be 0
$sql = "SELECT avg_rating, times_rated FROM cases WHERE case_id = ".$caseID." ;";


$results = $db_connection->query($sql);
if($results === FALSE ){
    echo"PROBLEM w rateCase query";
}
else{

	while($row = mysqli_fetch_array($results))
    {
        $times_rated = $row["times_rated"];
        $avg_rating = $row["avg_rating"] ; 
        
    }

    $incr_times_rated = $times_rated + 1;
    $incr_avg_rating = (($avg_rating*$times_rated) + $case_rating) / $incr_times_rated ;

    $sql2 = "UPDATE cases SET times_rated =  " . $incr_times_rated. " , avg_rating = ".$incr_avg_rating ." WHERE case_id = ".$caseID." ;";
	$results2 = $db_connection->query($sql2);
}

//$sql = "UPDATE cases SET avg_rating =  10  WHERE case_id = ".$caseID." ;";





?>