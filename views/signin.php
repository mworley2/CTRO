<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<div class="container">
    <form method="post" action="index.php" name="loginform" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>

        <label for="login_input_username" class="sr-only">Username</label>
        <input id="login_input_username" class="form-control" type="text" name="user_name" placeholder="Username" required autofocus>

        <label for="login_input_password">Password</label>
        <input id="login_input_password" class="form-control" type="passwprd" name="user_password" autocomplete="off" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
    </form>

    <h3>No Account? No Problem.</h3>
    <button href="register.php">Register Here</button>
</div>

