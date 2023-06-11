<?php
session_start();

// Clear the session and redirect to the sign-in page
session_destroy();
header("Location: log-in.php");
exit();
?>
