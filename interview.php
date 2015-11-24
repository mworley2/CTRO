<?php
// include the configs / constants for the database connection
ini_set('display_errors', 1);
require_once("config/db.php");

// load the registration class
require_once("classes/Interview.php");

$interview = new Interview();

// show the register view (with the registration form, and messages/errors)
?>