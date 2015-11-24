<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the registration class
require_once("classes/Create_Interview.php");

$create = new Create_Interview();

// show the register view (with the registration form, and messages/errors)
?>