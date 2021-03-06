<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css"/>
    <link href="css/interview.css" rel="stylesheet" type="text/css"/>
    <script src="js/js-image-slider.js" type="text/javascript"></script>

</head>
<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 11/27/2015
 * Time: 4:44 PM
 */
//echo "giving";

$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$interview_id = $_GET['interview_id'];

$sql = "SELECT interviews.interview_id, interviews.taker_username, cases.case_name, cases.style, cases.num_slides, cases.case_id  FROM interviews, uses, cases
        		WHERE interviews.interview_id = '" . $interview_id . "' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id ";

$results = $db_connection->query($sql);
$case_id = -1;

if ($results === FALSE) {
    echo "Sorry, there is a problem with this interview. Please try again";
} else {
    echo "<h1>Interview</h1>";
    echo "<div>";

    while ($row = mysqli_fetch_array($results)) {
        $case_id = $row["case_id"];
        echo 'Case: ' . $row["case_name"] . '  <br />
    				Style: ' . $row["style"] . ' <br />
    				Number of slides: ' . $row["num_slides"] . ' <br />
    			 	Interviewee: ' . $row["taker_username"] . '<br />';
    }

    echo '</div>';
}

$sql2 = "SELECT  slides.path_to_slide  FROM  slides
        		WHERE slides.case_id = '" . $case_id . "' ";


$results2 = $db_connection->query($sql2);
if ($results2 === FALSE) {
    echo "second query failed";
} else {

    $sliderContents = '<img src= "CTRO/resources/slide_storage/InstructionsGiver.jpg" width=600 height=400 />';
    $unlockButtonsContents = "";
    $i = 0;
    while ($row = mysqli_fetch_array($results2)) {

        $path_to_slide = $row["path_to_slide"];
        $imagepath = 'CTRO/resources/slide_storage/' . $path_to_slide . '.jpg '; //This works on cPanel, had to change the path a bit it just gets the name of the file (not folders)
        $additional_string = '<img src= "' . $imagepath . '" width=600 height=400 />';
        $sliderContents = $sliderContents . $additional_string;

        $unlockButtonsContents = $unlockButtonsContents . '<button type="button" id="button' . $i . '" value="' . $i . '" onclick="unlockSlide(this.value, ' . $interview_id . ')">' . ($i + 2) . '</button>';
        $i = $i + 1;
    }

}


?>

<button onclick='startButton()' id="startButton">Start</button>
<br>
<button onclick="stopButton(<?php echo $interview_id ?>)" id="stopButton">Stop</button>
<br>

<script>

    var startTime;

    function startButton() {
        startTime = Date.now();
        var buttonId  = "startButton";
        document.getElementById(buttonId).disabled = true;
        document.getElementById(buttonId).style.background = "#000000";
        document.getElementById(buttonId).style.outlineColor = "#000000";
        document.getElementById(buttonId).style.color = "#000000";
        document.getElementById("stopButton").style.background = "#ff0000";
    }

    function stopButton(interviewID)
    {
        document.getElementById("stopButton").style.background = "#000000";
        if (startTime)
        {
            var endTime = Date.now();
            var difference = endTime - startTime;
            $.ajax({
                url: "saveInterviewTime.php",
                type: "POST",
                data: {difference: difference, 'interviewID': interviewID}
            });

            startTime = null;
        } else {
            alert('Click the Start button first');
        }
    }

</script>

</head>

<body>
<div id="sliderFrame">
    <div id="slider">
        <? echo $sliderContents; ?>
    </div>
    <div class="navBulletsLockWrapper">
        <? echo $unlockButtonsContents; ?>
    </div>
</div>

<script>
    function unlockSlide(number, interviewID) {
        $.ajax({
            url: "changePermissions.php",
            type: "POST",
            data: {'slide_number': number, 'interviewID': interviewID}
        });
        var buttonId = 'button' + number;
        document.getElementById(buttonId).disabled = true;
        document.getElementById(buttonId).style.background = "#000000";
        document.getElementById(buttonId).style.outlineColor = "#000000";
        document.getElementById(buttonId).style.color = "#000000";
    }
</script>

<textarea placeholder="Enter notes." name="notes" id="textareaID" rows="20"
          style="overflow: hidden; word-wrap: break-word; resize: none; height: 160px; "></textarea>
<br>
<button onclick="getNotes(<?php echo $interview_id ?>)">Add Notes</button>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script language="javascript">

    function getNotes(interviewID) {
        var notes = document.getElementById("textareaID").value;
        if (notes != null) {
            $.ajax({
                url: "saveInterviewNotes.php",
                type: "POST",
                data: {notes: notes, 'interviewID': interviewID}

            }).done(function () {
                alert("Notes Saved Successfully");
            });

        }
        else {
            alert("no notes");
        }
    }

</script>
</br>
<?php

echo "Rate this Case from 1-5: ";
for ($i = 1; $i < 6; $i++) {
    echo '<button type="button" id="RatingButton' . $i . '" value="' . $i . '" onclick="rateCase(this.value, ' . $interview_id . ', ' . $case_id . ')"> ' . $i . '</button>';
}
echo '<br />';

?>

<script>
    function rateCase(case_rating, interviewID, caseID) {
        for(var i = 1; i < 6; i++)
        {
            document.getElementById("RatingButton"+i).disabled = true;
        }
        $.ajax({
            url: "rateCase.php",
            type: "POST",
            data: {'case_rating': case_rating, 'interviewID': interviewID, 'caseID': caseID}
        });

    }

</script>

<div id="finishEverything">
    <a href="caseFinished.php?interview_id=<?php echo $interview_id; ?>">End Case (CANT BE UNDONE)</a>
</div>

</body>

</html>
