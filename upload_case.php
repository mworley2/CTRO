<?php
// include the configs / constants for the database connection
ini_set('display_errors', 1);
require_once("config/db.php");
// load the registration class
require_once("classes/Upload_Case.php");

// create the upload object. when this object is created, it will do all upload stuff automatically
// so this single line handles the entire upload process.
$upload = new Upload_Case();
// show the register view (with the registration form, and messages/errors) s

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include("views/bootstraphead.html"); ?>
  	<title>Upload Case</title>
    <link href="uploadcase.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
    	<?php include("views/logged_in_navbar.php"); ?>
    	<?php include("views/upload_case.php"); ?>


    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>
