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
 * Time: 12:17 PM
 *
 */
//Include db config?
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$interviewID = $_GET['interview_id'];

$sql = "SELECT interviews.taker_username, interviews.timeTaken, interviews.notes, interviews.rating, cases.case_id, cases.case_name, cases.style, cases.avg_time, cases.avg_rating FROM interviews, uses,cases WHERE interviews.interview_id =" . $interviewID . " AND interviews.interview_id = uses.interview_id AND uses.case_id = cases.case_id;";
$results = $db_connection->query($sql);
echo mysqli_error($db_connection);
$row = mysqli_fetch_array($results);

$takerUsername = $row['taker_username'];
$interviewLength = round($row['timeTaken']);
$interviewerNotes = $row['notes'];
$interviewScore = $row['rating'];

$caseName = $row['case_name'];
$caseStyle = $row['style'];
$avgCaseTime = round($row['avg_time'],2);
$avgCaseRating = round($row['avg_rating'],2);
$caseID = $row['case_id'];

echo '<div id="caseInfo"><ul> <li>Case Name: '. $caseName . '</li> <li>Case Style: ' . $caseStyle . '</li> <li>Average score given out of 5: '. $avgCaseRating . '</li><li>Average time taken: '. $avgCaseTime . '</li></ul> </div>';
echo '<div id="interviewInformation"><ul> <li>Interviewee: '. $takerUsername . '</li> <li>Score given out of 5: '. $interviewScore . '</li><li>Time Taken: '. $interviewLength . '</li></ul> </div>';
echo '<div id="interviewNotesDisplay"><h4>Interviewer Notes:</h4><p>'. $interviewerNotes . '</p> </div>';
echo '<a href="http://web.engr.illinois.edu/~ctrocs411/"> Return Home </a>';
?>
</body>
</html>
