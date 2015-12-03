<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css"/>
    <script src="js/js-image-slider.js" type="text/javascript"></script>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 11/27/2015
 * Time: 4:44 PM
 */
//echo "taking";
function getSlidesStringForSlider()
{
    $interview_id = $_SESSION['interviewID'];
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $myPermissions = 0; //Scoping
    $case_id = -1;
    $sql = "SELECT interviews.permissions, cases.case_id  FROM interviews, uses, cases
        		WHERE interviews.interview_id = '" . $interview_id . "' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id ";
    $results = $db_connection->query($sql);
    while ($row = mysqli_fetch_array($results)) {
        $case_id = $row["case_id"];
        $myPermissions = $row["permissions"];
    }
    if ($results === FALSE) {
        echo "First query failed";
        return;
    }
//NOTE I am doing these in reverse to accomadate binary permissions (the same as chmod 577 for example) you have to subtract the biggest number out first
    $sql2 = "SELECT  slides.path_to_slide, slides.slide_num  FROM  slides
        		WHERE slides.case_id = '" . $case_id . "' ORDER BY slides.slide_num DESC";
    $results2 = $db_connection->query($sql2);
    if ($results2 === FALSE) {
        echo "second query failed";
    } else {
        $varString = "";
        while ($row = mysqli_fetch_array($results2)) {
            $slidenum = $row["slide_num"];
            $checkNumber = pow(2, ($slidenum - 1));
            $imagepath = "";
            if ($myPermissions - $checkNumber >= 0) {
                $path_to_slide = $row["path_to_slide"];
                $imagepath = 'CTRO/resources/slide_storage/' . $path_to_slide . '.jpg '; //This works on cPanel, had to change the path a bit it just gets the name of the file (not folders)
                $myPermissions = $myPermissions - $checkNumber;
            } else {
                $imagepath = 'CTRO/resources/slide_storage/Locked.jpg';
            }
            $additional_string = '<img src= "' . $imagepath . '" width=600 height=400 />';
            $varString = $additional_string . $varString;
        }
        $varString = "'<div id=\"slider\">" . $varString . "</div>'";
        return $varString;
    }
}

$interview_id = $_GET['interview_id'];
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT interviews.taker_username, interviews.permissions, cases.case_name, cases.style, cases.num_slides, cases.case_id  FROM interviews, uses, cases
        		WHERE interviews.interview_id = '" . $interview_id . "' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id ";
$results = $db_connection->query($sql);
$case_id = -1;
$myPermissions = 0;
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
    			 	Interviewer: ' . $row["taker_username"] . '<br />';
        $myPermissions = $row["permissions"];
    }
    echo '</div>';
    // $varString =
}


echo "Rate this Case from 1-5:";
for ($i = 1; $i < 6; $i++) {

    echo '<button type="button" id="button' . $i . '" value="' . $i . '" onclick="rateCase(this.value, ' . $interview_id . ', ' . $case_id . ')"> ' . $i . '</button>';
}
echo '<br />';


?>
<script>
    function rateCase(case_rating, interviewID, caseID) {
        
        $.ajax({
            url: "rateCase.php",
            type: "POST",
            data: {'case_rating': case_rating, 'interviewID': interviewID, 'caseID': caseID}
        });

    }
</script>

<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    var myGlobal = 0;
    function populateSlider() {
        //Note: If the slider container has been set as invisible(e.g. display:none;), make sure set it visible before reload the imageSlider]
        $.ajax({
            type: "POST",
            url: "updateSlider.php",
            datatype: "html",
            data: {'slide_number': 1, 'interviewID': 1},
            success: function (data) {
                setSliderMarkup(data);
            }

        });

    }
    function setSliderMarkup(htmlString) {
        var sliderFrame = document.getElementById("sliderFrame");
        var slider = document.getElementById("slider");
        if (slider != null) {
            var oldStyle = slider.style;
            sliderFrame.innerHTML = htmlString;
            imageSlider.reload();
            document.getElementById("slider").style.background = oldStyle.background;
        }
        else {
            sliderFrame.innerHTML = htmlString;
            imageSlider.reload();
        }
    }
</script>
<script type="text/javascript">
</script>


<div id="sliderFrame"></div>
<div class="div2">
    <input type="button" onclick="populateSlider()" value="Refresh Slides"/>

</body>
<script type="text/javascript"> populateSlider();
    setInterval(populateSlider, 3000); </script>