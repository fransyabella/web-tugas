<?php
session_start();
// Destroy user session
unset($_SESSION['username']);
unset($_SESSION['user_id']);
// Redirect to index.php page
header("Location: index.php");
?>