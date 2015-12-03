<?php         
session_start();
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
    	
      <div class="jumbotron">
        <h1>Deletion Successful!</h1>
        <?php
		// include the configs / constants for the database connection
		require_once("config/db.php");

		// load the registration class
		require_once("classes/Delete.php");

		$delete = new Delete();

		?>
      </div>


    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>