<?php
// include the configs / constants for the database connection
ini_set('display_errors', 1);
require_once("config/db.php");

include("views/view_cases.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include("views/bootstraphead.html"); ?>
  	<title>View Cases</title>
    <link href="viewcases.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
    	<?php include("views/logged_in_navbar.php"); ?>
    	<?php include("views/view_cases.php"); ?>


    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>