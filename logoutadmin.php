<?php
session_start();
// Destroy user session
unset($_SESSION['username']);
// Redirect to index.php page
header("Location: index.php");
?>