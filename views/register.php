<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");
// load the registration class
require_once("classes/Registration.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();

// show the register view (with the registration form, and messages/errors)
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<div class="container">
    <form method="post" action="register.php" name="registerform" class="form-signin">
        <h2 class="form-signin-heading">Register</h2>

        <label for="login_input_username" class="sr-only">Username</label>
        <input id="login_input_username" class="login_input form-control form-top" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Username (Alphanumeric Only)" required autofocus>

        <label for="login_input_email" class="sr-only">Email Address</label>
        <input id="login_input_email" class="login_input form-control form-middle" type="email" name="user_email" placeholder="Email Address" required autocomplete="off">

        <label for="login_input_password_new>" class="sr-only">Password</label>
        <input id="login_input_password_new" class="login_input form-control form-middle" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password (Min Length 6)">

        <label for="login_input_password_repeat" class="sr-only">Repeat Password</label>
        <input id="login_input_password_repeat" class="login_input form-control form-bottom" type="passwprd" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password">

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
    </form>
</div>