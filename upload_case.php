<?php
// include the configs / constants for the database connection
require_once("config/db.php");
// load the registration class
require_once("classes/Upload_Case.php");

// create the upload object. when this object is created, it will do all upload stuff automatically
// so this single line handles the entire upload process.
$upload = new Upload_Case();
//echo "in model we are past creating a new object and before the view is instantiated  ";
// show the register view (with the registration form, and messages/errors)
include("views/upload_case.php");