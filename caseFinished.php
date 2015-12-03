
<?php
/**
 * Created by PhpStorm.
 * User: kleinhansjy
 * Date: 12/2/2015
 * Time: 2:42 PM
 */

require_once("config/db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$interviewID = $_GET['interview_id'];

$sql = "UPDATE interviews SET completed = 1 WHERE interviews.interview_id =" . $interviewID . ";";
$results = $db_connection->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include("views/bootstraphead.html"); ?>
  	<title>Case Finished!</title>
    <script type="text/javascript" src="js/jquery-1.11.3.js"> </script>
    <link href="css/interview.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <div class="container">
    	<?php include("views/logged_in_navbar.php"); ?>


      <div class="jumbotron">
        <h1>Case Finished!</h1>
       	<p> Thank you for completing your case! </p>
      </div>
    </div> <!-- /container -->



    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>

