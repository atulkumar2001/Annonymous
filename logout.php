<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the index.html page with a status query parameter
header("Location: index.html?status=loggedout");
exit;
?>
