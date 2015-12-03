<?php
// include the configs / constants for the database connection
ini_set('display_errors', 1);
require_once("config/db.php");
session_start();
if (isset($view)) {
    if ($view->errors) {
        foreach ($view->errors as $error) {
            echo $error;
        }
    }
    if ($view->messages) {
        foreach ($view->messages as $message) {
            echo $message;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include("views/bootstraphead.html"); ?>
  	<title>View Cases</title>
    <link href="css/viewcases.css" rel="stylesheet">
  </head>

  <body>

    <?php include("views/logged_in_navbar.php"); ?>
    <div class="container">

    	<?php include("views/view_cases.php"); ?>

    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>