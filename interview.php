<?php
// include the configs / constants for the database connection
session_start();
ini_set('display_errors', 1);
require_once("config/db.php");

require_once("classes/Interview.php");

$interview = new Interview();
$_SESSION['interviewID'] = $interview->myID;
if ($interview->isTaking() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    //include("views/interview_taking2.php");

    include("views/interview_taking.php");
}
else if ($interview->isGiving() == true )
{
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/interview_giving.php");
}
else
    echo "ERROR, THIS USER ISN'T PART OF THE INTERVIEW";

