<?php
session_start();
require_once "forgot-authentication.php";
require_once "../connections/connection.php";

// If user submits the form
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $connection = connection();

    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Check for empty fields
    if (empty($email)) {
        $_SESSION['emptyfields'] = "Please fill out the email field";
        header("location: ../forgot-section.php");
        exit();
    }

    $query = 'SELECT * FROM super_admin_users WHERE email = $1';
    $result = pg_query_params($connection, $query, array($email));

    $user = pg_fetch_assoc($result);

    if ($user) {

        $_SESSION['admin_name'] = $user['lastname'];
        $_SESSION['admin_email'] = $user['email'];

            sendVerificationEmail($user, $connection);  

            // Redirect to the verification page
            header('location: ../forgot-request.php');
            exit();

    } else {
        // User not found
        $_SESSION['notregistered'] = "Email not found";
        header("location: ../forgot-section.php");
        exit();
    }

    // Close the connection
    pg_close($connection);
}
?>
