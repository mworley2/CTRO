<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the registration class
require_once("classes/Modify_Case.php");

$modify = new Modify_Case();

// show the register view (with the registration form, and messages/errors)
?>