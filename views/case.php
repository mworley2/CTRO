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
?>

    <?php if ($case_id != 0)//TODO Does the user own the case? security----
    {
        echo '<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">' . $row["case_name"] . '</h3>
    </div>
    <div class="panel-body">
      <h2>Case Style</h2>
      <p>' . $row["style"] . '</p>
      <h2>Case ID</h2>
      <p>' . $row["case_id"] . '</p>
    </div>
  </div>';
    echo' <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Options</h3>
            </div>
            <div class="panel-body">
              <h2>Create Interview With This Case</h2>
              <form method="post" action="createInterview.php" name="Create Interview">

            <label for="case_id_input">Case ID for interview: </label>
            <input id="case_id_input" class="creation_input" type="hidden" name="case_id_for_creation" value="'. $case_id . '" required/>

            <label for="interviewee_input">Interviewee Username: </label>
            <input id="interviewee_input" class="creation_input" type="text" name="interviewee_name" required/>

            <input type="submit" name="create" value="Create Interview"/>
            </form>
            </div>
          </div>';


        echo '<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Delete This Case</h3>
            </div>
            <div class="panel-body">
              <a href="http://web.engr.illinois.edu/~ctrocs411/delete.php?case_id=' . $case_id . '"><button class="btn btn-primary">Delete Case</button></a>
            </div>
          </div>';

        echo '            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Modify This Case</h3>
            </div>
            <div class="panel-body">
<form method="post" action="modify.php" name="Modify Case">

            <input id="case_id_input" class="modification_input" type="hidden" name="case_id_for_modification" value="' . $case_id . '" required/>

            <label for="new_name_input"> New Case Name: </label>
            <input id="new_name_input" class="modification_input" type="text" name="new_name" required/>

            <label for="new_style_input"> New Case Style: </label>
            <input id="new_style_input" class="modification_input" type="text" name="new_style" required/>

            <input type="submit" name="modify" value="Modify Case"/>

        </form>
            </div>
          </div>';

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
<div id="sliderFrame">
    <div id="slider">
        <? echo $sliderContents; ?>
    </div>
</div>
