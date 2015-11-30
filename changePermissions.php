<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 11/29/2015
 * Time: 5:11 PM
 */
require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$slideIdx = $_POST['slide_number'];
$thisID = $_POST['interviewID'];
$increment = pow(2,$slideIdx);

if($db_connection->connect_errno)
    echo $db_connection->connect_error;

$sql = "UPDATE interviews SET permissions = permissions + " . $increment . " WHERE interview_id = " . $thisID . ";";
$results = $db_connection->query($sql);
?>