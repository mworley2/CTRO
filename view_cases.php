<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the registration class
require_once("classes/Upload_Case.php");

// create the upload object. when this object is created, it will do all upload stuff automatically
// so this single line handles the entire upload process.


//$view_cases = new Upload_Case();

// show the register view (with the registration form, and messages/errors)
include("views/view_cases.php");