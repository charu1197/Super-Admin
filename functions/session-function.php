<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_name'])) {
    header("location: login.php"); // Redirect to the login page if not logged in
    exit();
} else {
    // The user is logged in, and you can use $_SESSION['user_id'] to get the user ID
    $admin = $_SESSION['admin_name'];
}

// Check if the save_data cookie is set
$saveData = isset($_COOKIE['save_data']) && $_COOKIE['save_data'] === 'yes';

// Clear the cookie after reading it
setcookie('save_data', '', time() - 3600, '/'); // Expire the cookie immediately
?>