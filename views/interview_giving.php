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
			while($row = mysqli_fetch_array($results))
    		{
    			$case_id = $row["case_id"];
    			echo'Case: ' .$row["case_name"].'  <br />
    				Style: ' .$row["style"]. ' <br />
    				Number of slides: ' .$row["num_slides"]. ' <br />
    			 	Interviewee: '.$row["taker_username"].'<br />';
			}
    	}

 $sql2 = "SELECT  slides.path_to_slide  FROM  slides
        		WHERE slides.case_id = '".$case_id."' ";


        $results2 = $db_connection->query($sql2);
        if($results2 ===FALSE ){
        	echo"second query failed";
        }
        else{
        	while($row = mysqli_fetch_array($results2) ){
	        	$path_to_slide = $row["path_to_slide"];
	        	$imagepath = '../CTRO/' . $path_to_slide .' ';
	        	echo"<img src= ".$imagepath." width=500 height=500 />";

        	}

        }




    

?>