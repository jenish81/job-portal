<?php
session_start();

// Clear the session and cookies
session_destroy();
setcookie('username', '', time() - 3600); // Clear the 'Remember Me' cookie

// Redirect to login page
header('Location: index.php');
exit();
?>
