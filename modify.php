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
        <h1>Navbar example</h1>
		<?php
		// include the configs / constants for the database connection
		require_once("config/db.php");

		// load the registration class
		require_once("classes/Modify_Case.php");

		$modify = new Modify_Case();

		// show the register view (with the registration form, and messages/errors)
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