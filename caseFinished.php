<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery-1.11.3.js"> </script>
    <link href="css/interview.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 12/2/2015
 * Time: 2:42 PM
 */

require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$interviewID = $_SESSION['interviewID'];

$sql = "UPDATE interviews SET completed = 1 WHERE interviews.interview_id =" . $interviewID . ";";

$_SESSION['interviewID'] = -1;

header('Location: http://web.engr.illinois.edu/~ctrocs411/index.php');