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
while ($row = mysqli_fetch_array($results)) {
    echo 'Case Name: ' . $row["case_name"] . '  Case Type: ' . $row["style"] . '   Case ID: ' . $row["case_id"] . '<br />';
}

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

    <br/>

    <!-- TODO Create a delete class (simple just needs to delete case from EVERY ONE of our tables) -->
    <h1>Case Deletion</h1>
    <form method="post" action="Delete.php" name="Delete Case">
        <!-- return to this page after executing and updating -->

        <label for="case_id_input">Case ID For Deletion: </label>
        <input id="case_id_input" class="deletion_input" type="text" name="case_id_for_deletion" required/>
        <input type="submit" name="delete" value="Delete"/>
        <!-- There needs to be something that this submission triggers -->

    </form>

    <br/>
    <h1>Case Modification</h1>
    <form method="post" action="Modify.php" name="Modify Case">

        <label for="case_id_input">Case ID For Modification: </label>
        <input id="case_id_input" class="modification_input" type="text" name="case_id_for_modification" required/>

        <label for="new_name_input">New Case Name: </label>
        <input id="new_name_input" class="modification_input" type="text" name="new_name" required/>

        <label for="new_style_input">New Case Style: </label>
        <input id="new_style_input" class="modification_input" type="text" name="new_style" required/>

        <input type="submit" name="modify" value="Modify Case"/>

    </form>

    <br/>

    <h1>Create Interview</h1>
    <form method="post" action="createInterview.php" name="Create Interview">

        <label for="case_id_input">Case ID for interview: </label>
        <input id="case_id_input" class="creation_input" type="text" name="case_id_for_creation" required/>

        <label for="interviewee_input">Interviewee Username: </label>
        <input id="interviewee_input" class="creation_input" type="text" name="interviewee_name" required/>

        <input type="submit" name="create" value="Create Interview"/>
    </form>


    <a href="index.php">Back to Home Page</a>

<? //php echo $_SESSION['user_name']; ?>