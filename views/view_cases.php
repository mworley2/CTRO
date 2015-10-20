<?php
//show potential errors / feedback (from registration object)
if (isset($view)) {
    if ($view->errors) {
        foreach ($view->errors as $error) {
            echo $error;
        }
    }
    if ($view->messages) {
        foreach ($view->messages as $message) {
            echo $message;
        }
    }
}
//TODO figure out how sessions work and get these working so we can pull this users cases and stuff or however that works?
$myID = $_SESSION['user_id'];

if($_SESSION['user_id'] < 10)
    echo ('<a href="index.php">Special Back ' . $myID . ' to Home Page</a>'); // does this work?

?>


<!-- backlink -->
<a href="index.php">Back to Home Page</a>

<?php echo $_SESSION['user_name']; ?>