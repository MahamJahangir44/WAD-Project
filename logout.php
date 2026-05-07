<?php
session_start();

// Destroy everything in the session
session_destroy();

// Go back to homepage
header("Location: index.php");
exit;
?>
