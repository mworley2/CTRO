<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the registration class
require_once("classes/Delete.php");

$delete = new Delete();

// show the register view (with the registration form, and messages/errors)
?>
<!--
<html>
<head>
    <title>Success</title>
</head>

<body onload="window.back()">
<h1>Success</h1>
</body>
</html>
