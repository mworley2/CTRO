<?php
//show potential errors / feedback (from registration object)
session_start();
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

echo "SHOW ME SOMETHING";
echo $myID;
print_r($_SESSION);

?>


<!-- backlink -->
<a href="index.php">Back to Home Page</a>

<?//php echo $_SESSION['user_name']; ?>