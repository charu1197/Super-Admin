<?php 

session_start();
// Check if the user is not logged in (for verify.php)
if (!isset($_SESSION['admin_email'])) {
    // Redirect to the login page
    header('location: ../forgot-section.php');
    exit();
}


?>