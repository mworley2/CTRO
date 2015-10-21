<?php
//show potential errors / feedback (from registration object)
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
$sql = "SELECT cases.case_id, cases.case_name, cases.style FROM cases, owns WHERE cases.case_id = owns.case_id AND owns.user_name = '".$myUsername."';";

$results = $db_connection->query($sql);
$row = NULL;

echo "<h1>View Cases</h1>";
while ($row = mysqli_fetch_array($results))
{
        echo 'Case Name: '. $row["case_name"] .'  Case Type: ' .$row["style"].'   Case ID: '.$row["case_id"].'<br />';
}


?>

<br />
<!-- TODO Create a delete class (simple just needs to delete case from EVERY ONE of our tables) -->
<h1>Case Deletion</h1>
<form method="post" action="Delete.php" name="Delete Case"> <!-- return to this page after executing and updating -->

    <label for="case_id_input">Case ID For Deletion: </label>
    <input id="case_id_input" class="deletion_input" type="text" name="case_id_for_deletion" required />
    <input type="submit"  name="delete" value="Delete" /> <!-- There needs to be something that this submission triggers -->

</form>

<br />
<h1>Case Modification</h1>
    <!-- TODO Create a modify class (can only modify the name and the style at this time) -->
    <form method="post" action="view/view_cases.php" name="Modify Case">

        <label for="case_id_input">Case ID For Modification: </label>
        <input id="case_id_input" class="modification_input" type="text" name="case_id_for_modification" required />

        <label for="new_name_input">New Case Name: </label>
        <input id="new_name_input" class="modification_input" type="text" name="new_name" required />

        <label for="new_style_input">New Case Style: </label>
        <input id="new_style_input" class="modification_input" type="text" name="new_style" required />

        <input type="submit"  name="modify" value="Modify Case" />

    </form>

    <br />
<a href="index.php">Back to Home Page</a>

<?//php echo $_SESSION['user_name']; ?>