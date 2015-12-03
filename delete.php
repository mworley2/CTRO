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
        <h1>Navbar example</h1>
        <?php
		// include the configs / constants for the database connection
		require_once("config/db.php");

		// load the registration class
		require_once("classes/Delete.php");

		$delete = new Delete();

		?>
        <p>This example is a quick exercise to illustrate how the default, static navbar and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
        </p>
      </div>


    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>