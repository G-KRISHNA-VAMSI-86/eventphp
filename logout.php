<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

echo "Logout successfully";

// Redirect to login page
header("Location: login.html");
exit();
?>
