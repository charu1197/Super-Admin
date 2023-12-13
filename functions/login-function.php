<?php
session_start();
require_once "send-verification-function.php";
require_once "../connections/connection.php";

// If user login button
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $connection = connection();

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check for empty fields
    if (empty($email) || empty($password)) {
        $_SESSION['emptyfields'] = "Please fill out all the fields";
        header("location: ../login.php");
        exit();
    }

    $query = 'SELECT * FROM super_admin_users WHERE email = $1';
    $result = pg_query_params($connection, $query, array($email));

    $user = pg_fetch_assoc($result);

    if ($user) {
        // User found, check password
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $_SESSION['admin_name'] = $user['lastname'];
            $_SESSION['admin_email'] = $user['email'];
    
            if ($user['status'] === 'verified') {
                // User is already verified, redirect to index.php
                header('location: ../index.php');
                exit();
            } else {
                // Call the function to send the verification email
                sendVerificationEmail($user, $connection);
    
                // Redirect to the verification page
                header('location: ../verify.php');
                exit();
            }
        } else {
            // Incorrect password
            $error = "";
            $_SESSION['incorrectpass'] = "Incorrect password";
            header("location: ../login.php");
            exit();
        }
    } else {
        // User not found
        $error = "";
        $_SESSION['notregistered'] = "Not registered email";
        header("location: ../login.php");
        exit();
    }

    // Close the connection
    pg_close($connection);
}
?>
