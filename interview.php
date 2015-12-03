<?php
// include the configs / constants for the database connection
session_start();
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("views/bootstraphead.html"); ?>
    <title>Interview</title>
  </head>

  <body>

    <div class="container">
        <?php include("views/logged_in_navbar.php"); ?>
        
      <div class="jumbotron">
        <h1>Interview</h1>
        <?php require_once("config/db.php");

        require_once("classes/Interview.php");

        $interview = new Interview($_GET['interview_id']);
        $_SESSION['interviewID'] = $interview->myID;
        if ($interview->isTaking() == true) {

            if ($interview->interviewCompleted == 0)
                include("views/interview_taking.php");
            else if($interview->interviewCompleted == 1)
                include("views/interview_taking_completed.php");
            else
                include("views/you_shouldnt_be_here.php");
        }
        else if ($interview->isGiving() == true )
        {
            if ($interview->interviewCompleted == 0)
                include("views/interview_giving.php"); //Interview is not completed
            else if ($interview->interviewCompleted == 1)
                include("views/interview_giving_completed.php");
            else
                include("views/you_shouldnt_be_here.php");
        }
        else
            echo "ERROR, THIS USER ISN'T PART OF THE INTERVIEW";?>
      </div>


    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>