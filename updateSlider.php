<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 11/30/2015
 * Time: 5:13 PM
 */
    session_start();
    include('config/db.php');



    $interview_id = $_SESSION['interviewID'];
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $myPermissions = 0; //Scoping
    $case_id = -1;

    $sql = "SELECT interviews.permissions, cases.case_id  FROM interviews, uses, cases
        		WHERE interviews.interview_id = '".$interview_id."' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id ";
    $results = $db_connection->query($sql);
    while($row = mysqli_fetch_array($results))
    {
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
            $checkNumber = pow(2, ($slidenum -1));
            $imagepath = "";
            if ($myPermissions - $checkNumber >= 0)
            {
                $path_to_slide = $row["path_to_slide"];
                $imagepath = 'CTRO/resources/slide_storage/' . $path_to_slide . '.jpg '; //This works on cPanel, had to change the path a bit it just gets the name of the file (not folders)
                $myPermissions = $myPermissions - $checkNumber;
            }
            else
            {
                $imagepath = 'CTRO/resources/slide_storage/Locked.jpg';
            }

            $additional_string = '<img src= "' . $imagepath . '" width=600 height=400 />';
            $varString = $additional_string . $varString;
        }
        $additional_string = '<img src="CTRO/resources/slide_storage/Instructions.jpg" width=600 height=400 />';
        $varString = $additional_string . $varString;
        $varString = "<div id=\"slider\">" . $varString . "</div>";
        echo $varString;
    }
?>
