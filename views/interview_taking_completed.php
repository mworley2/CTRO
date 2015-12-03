<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery-1.11.3.js"> </script>
    <link href="css/interview.css" rel="stylesheet" type="text/css" />

</head>

<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 12/2/2015
 * Time: 12:17 PM
 */
//require config/db.php ?
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$interviewID = $_GET['interview_id'];

$sql = "SELECT interviews.giver_username, interviews.timeTaken, cases.case_id, cases.case_name, cases.style FROM interviews, uses,cases WHERE interviews.interview_id =" . $interviewID . " AND interviews.interview_id = uses.interview_ID AND uses.case_id = cases.case_id;";
$results = $db_connection->query($sql);
$row = mysqli_fetch_array($results);

echo '<div id="interviewInformation"><ul> <li>You were interviewed by: '. $row['giver_username'] . '</li> <li>Your interview took '. $row['timeTaken'] . ' seconds</li><li> Thank you for using our service!</li></ul> </div>';
echo '<a href="http://web.engr.illinois.edu/~ctrocs411/"> Return Home </a>';

?>

</html>
