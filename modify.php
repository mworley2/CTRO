<?php         
session_start();
?>

<html lang="en">
  <head>
  	<?php include("views/bootstraphead.html"); ?>
  	<title>Modify Case</title>
  </head>

  <body>

    <div class="container">
    	<?php include("views/logged_in_navbar.php"); ?>
    	
      <div class="jumbotron">
        <h1>Modification Successful</h1>
		<?php
		// include the configs / constants for the database connection
		require_once("config/db.php");

		// load the registration class
		require_once("classes/Modify_Case.php");

		$modify = new Modify_Case();

		// show the register view (with the registration form, and messages/errors)
		?>
      </div>


    </div> <!-- /container -->


    <?php include("views/bootstrapfoot.html"); ?>
  </body>
</html>