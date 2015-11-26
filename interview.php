<?php
// include the configs / constants for the database connection
ini_set('display_errors', 1);
require_once("config/db.php");


require_once("classes/Interview.php");

$interview = new Interview();

include("views/interview.php");
?>