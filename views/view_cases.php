<?php
//show potential errors / feedback (from registration object)
ini_set('display_errors', 1);
session_start();
if (isset($view)) {
    if ($view->errors) {
        foreach ($view->errors as $error) {
            echo $error;
        }
    }
    if ($view->messages) {
        foreach ($view->messages as $message) {
            echo $message;
        }
    }
}

$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$myUsername = $_SESSION["user_name"];

//show cases
$sql = "SELECT cases.case_id, cases.case_name, cases.style FROM cases, owns WHERE cases.case_id = owns.case_id AND owns.user_name = '" . $myUsername . "';";

$results = $db_connection->query($sql);
$row = NULL;

echo "<h1>View Cases</h1>";

echo "<ul>";
while ($row = mysqli_fetch_array($results)) {
    echo '<li><a href="http://web.engr.illinois.edu/~ctrocs411/case.php?case_id=' . $row["case_id"] .'"> Name: ' . $row["case_name"] . ' Style: ' . $row["style"] . ' ID: ' .  $row["case_id"] .' </a></li>';
}
echo "</ul>";

//show interviews
$sql_interview = "SELECT interviews.interview_id, interviews.giver_username, interviews.taker_username FROM interviews WHERE interviews.taker_username = '" . $myUsername . "' OR interviews.giver_username = '" . $myUsername . "';";

$results = $db_connection->query($sql_interview);
$row2 = NULL;


echo "<h1>My Interviews</h1>";
if ($results === FALSE) {
    echo "FALSE";
} else {
    echo "<ul>";
    while ($row = mysqli_fetch_array($results))
    {
        echo '<li><a href="http://web.engr.illinois.edu/~ctrocs411/interview.php?interview_id=' . $row["interview_id"] .'"> ' . $row["giver_username"] . ' Interviewing ' . $row["taker_username"] . ' In Interview ' .  $row["interview_id"] .' </a></li>';
    }
        echo "</ul>";
}

?>

    <a href="index.php">Back to Home Page</a>

<? //php echo $_SESSION['user_name']; ?>