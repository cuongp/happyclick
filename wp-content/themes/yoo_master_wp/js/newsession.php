<?php
session_start();
// Include the random string file
require 'rand.php';

// Begin a new session


// Set the session contents
$_SESSION['captcha_id'] = $str;

?>