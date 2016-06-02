<?php
# Start Session:
session_start();

unset($_SESSION['username']); // Delete username key

// session_destroy();

header('Location: login.php'); // Redirect to login page

?>