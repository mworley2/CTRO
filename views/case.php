<?php
// include the configs / constants for the database connection
ini_set('display_errors', 1);
require_once("config/db.php");


$case_id = $_GET['case_id'];
$_SESSION['interviewID'] = $interview->myID;

$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//show cases
$sql = "SELECT cases.case_id, cases.case_name, cases.style FROM cases WHERE cases.case_id = " . $case_id . ";";

$results = $db_connection->query($sql);
$row = mysqli_fetch_array($results);
if ($case_id != 0)//TODO Does the user own the case? security----
{
    echo 'Case Name: ' . $row["case_name"] . '  Case Type: ' . $row["style"] . '   Case ID: ' . $row["case_id"] . '<br />';
    echo "<h4> Options:</h4>";
    echo "<ul>";

    // TODO  delete case from EVERY ONE of our tables)
    echo '<h4>Create Interview With This Case</h4>
    <form method="post" action="createInterview.php" name="Create Interview">

        <label for="case_id_input">Case ID for interview: </label>
        <input id="case_id_input" class="creation_input" type="hidden" name="case_id_for_creation" value="'. $case_id . '" required/>

        <label for="interviewee_input">Interviewee Username: </label>
        <input id="interviewee_input" class="creation_input" type="text" name="interviewee_name" required/>

        <input type="submit" name="create" value="Create Interview"/>
    </form>';

    echo '<li><a href="http://web.engr.illinois.edu/~ctrocs411/delete.php?case_id=' . $case_id . '"> Delete This Case</a></li>';

    echo '<li> <h4>Modify Case:</h4>   <form method="post" action="modify.php" name="Modify Case">

        <input id="case_id_input" class="modification_input" type="hidden" name="case_id_for_modification" value="' . $case_id . '" required/>

        <label for="new_name_input"> New Case Name: </label>
        <input id="new_name_input" class="modification_input" type="text" name="new_name" required/>

        <label for="new_style_input"> New Case Style: </label>
        <input id="new_style_input" class="modification_input" type="text" name="new_style" required/>

        <input type="submit" name="modify" value="Modify Case"/>

    </form></li>';

    echo "</ul>";


    $sql2 = "SELECT  slides.path_to_slide  FROM  slides
        		WHERE slides.case_id = '" . $case_id . "' ";

    $results2 = $db_connection->query($sql2);
    if ($results2 === FALSE) {
        echo "second query failed";
    } else {

        $sliderContents = "";
        $i = 0;
        while ($row = mysqli_fetch_array($results2)) {
            $path_to_slide = $row["path_to_slide"];
            $imagepath = 'CTRO/resources/slide_storage/' . $path_to_slide . '.jpg '; //This works on cPanel, had to change the path a bit it just gets the name of the file (not folders)
            $additional_string = '<img src= "' . $imagepath . '" width=600 height=400 />';
            $sliderContents = $sliderContents . $additional_string;
            $i = $i + 1;
        }
    }

} else
    echo "ERROR, THIS USER DOESNT OWN THE CASE";

?>
<body>
<div id="sliderFrame">
    <div id="slider">
        <? echo $sliderContents; ?>
    </div>
</div>

<a href="index.php">Back to Home Page</a>