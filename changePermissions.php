<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 11/29/2015
 * Time: 5:11 PM
 */
$slideNum = $_POST['slide_number'];
$thisID = $_POST['interview_id'];
$increment = pow(2,$slideNum);
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "UPDATE interviews SET permissions = permissions + " . $increment . " WHERE interview_id = " . $thisID . ";";
$results = $db_connection->query($sql);