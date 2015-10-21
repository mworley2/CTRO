<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the registration class
require_once("classes/Upload_Case.php");

// show the register view (with the registration form, and messages/errors)
include("views/view_cases.php");