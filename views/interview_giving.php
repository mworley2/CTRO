<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery-1.11.3.js"> </script>
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
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

$interview_id = $_POST['interview_id'];


 $sql = "SELECT interviews.interview_id, interviews.taker_username, cases.case_name, cases.style, cases.num_slides, cases.case_id  FROM interviews, uses, cases
        		WHERE interviews.interview_id = '".$interview_id."' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id ";

        $results = $db_connection->query($sql);
        $case_id = -1;

        if($results === FALSE ){
    		echo"Sorry, there is a problem with this interview. Please try again";
		}
		else{
			echo"<h1>Interview</h1>";
            echo"<div>";

			while($row = mysqli_fetch_array($results))
    		{
    			$case_id = $row["case_id"];
    			echo'Case: ' .$row["case_name"].'  <br />
    				Style: ' .$row["style"]. ' <br />
    				Number of slides: ' .$row["num_slides"]. ' <br />
    			 	Interviewee: '.$row["taker_username"].'<br />';
			}
            echo '<a href="Statistics.php?ID=' . $interview_id . '"> Begin Interview</a><br />'; //TODO statistics class inserts start time into "interviews" so change that database
    	    echo '</div>';
        }

 $sql2 = "SELECT  slides.path_to_slide  FROM  slides
        		WHERE slides.case_id = '".$case_id."' ";


        $results2 = $db_connection->query($sql2);
        if($results2 ===FALSE ){
        	echo"second query failed";
        }
        else{

            $sliderContents = "";
            $unlockButtonsContents = "";
            $i = 0;
        	while($row = mysqli_fetch_array($results2) ){

	        	$path_to_slide = $row["path_to_slide"];
	        	$imagepath = 'CTRO/resources/slide_storage/' . $path_to_slide .'.jpg '; //This works on cPanel, had to change the path a bit it just gets the name of the file (not folders)
	        	$additional_string = '<img src= "'.$imagepath.'" width=600 height=400 />';
                $sliderContents = $sliderContents . $additional_string;

                //$unlockButtonsContents = $unlockButtonsContents . '<div rel="' . $i . '" id="unlockButton' . ($i + 1) . '"> L </div>';
                $unlockButtonsContents = $unlockButtonsContents . '<button type="button" value="'. $i . '" onclick="unlockSlide(this.value, ' . $interview_id .')">L</button>';
                $i = $i +1;
        	}
            ?>
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
        //TODO change some permissions somehow (how do we want to do this????) and change the button color to blackish

            $.ajax({
                url: "changePermissions.php",
                type: "POST",
                data: { 'slide_number': number, 'interviewID': interviewID},
            });
        $(this).unbind('click'); //TODO make sure unbind is working for security otherwise things will get really fucked really fast

    }
</script>

</body>

                <?php
        }



    

?>